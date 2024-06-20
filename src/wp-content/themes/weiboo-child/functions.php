<?php

/*
 * Define Variables
 */
if (!defined('THEME_DIR'))
    define('THEME_DIR', get_template_directory());
if (!defined('THEME_URL'))
    define('THEME_URL', get_template_directory_uri());


/*
 * Include framework files
 */
foreach (glob(THEME_DIR . '-child' . "/includes/*.php") as $file_name) {
    require_once($file_name);
}


add_action('login_form_register', function () {
    wp_redirect('/registration/');
});

function convert_to_webp($upload)
{
    $image_path = $upload['file'];
    // % compression (0-100)
    $compression_quality = 80;
    $supported_mime_types = array(
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
    );
    $image_info = getimagesize($image_path);
    if ($image_info !== false && array_key_exists($image_info['mime'], $supported_mime_types)) {
        $image = imagecreatefromstring(file_get_contents($image_path));
        if ($image) {
            if (imageistruecolor($image)) {
                $webp_path = preg_replace('/\.(jpg|jpeg|png)$/', wp_generate_password(5, false) . '.webp', $image_path);
                imagewebp($image, $webp_path, $compression_quality);
                $upload['file'] = $webp_path;
                $upload['type'] = 'image/webp';
                // Delete corner image
                unlink($image_path);
            } else {
                // If is image 8-bit, doing uncompress
                $upload['file'] = $image_path;
                $upload['type'] = $image_info['mime'];
            }
        }
    }
    return $upload;
}
function convert_to_webp_upload($upload)
{
    $upload = convert_to_webp($upload);
    return $upload;
}
add_filter('wp_handle_upload', 'convert_to_webp_upload');



function exclude_category_from_shop($q)
{
    if (!is_admin() && $q->is_main_query() && is_shop()) {
        $tax_query = (array) $q->get('tax_query');

        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => array('point'), // Change 'point' to your category slug
            'operator' => 'NOT IN',
        );

        $q->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'exclude_category_from_shop');

function exclude_widget_categories($args)
{
    $exclude = 'point'; // Change 'point' to your category slug

    // Get the ID of the category to exclude
    $exclude_cat = get_term_by('slug', $exclude, 'product_cat');

    // Exclude the category ID
    if ($exclude_cat) {
        $args['exclude'] = $exclude_cat->term_id;
    }

    return $args;
}
add_filter('widget_categories_args', 'exclude_widget_categories');
add_filter('woocommerce_product_categories_widget_args', 'exclude_widget_categories');



// add_action('woocommerce_cart_calculate_fees', 'custom_bulk_discount', 20, 1);

// function custom_bulk_discount($cart) {
//     if (is_admin() && !defined('DOING_AJAX')) {
//         return;
//     }
//     $total_quantity = 0;
//     foreach ($cart->get_cart() as $cart_item) {
//         $total_quantity += $cart_item['quantity'];
//     }
// // Discount 5%
//     if ($total_quantity >= 2 && $total_quantity <= 3) {
//         $discount = $cart->subtotal * 0.05;
//         $cart->add_fee(__('Bulk Discount (5%)', 'woocommerce'), -$discount);
//     }
// //Discount 25%
//     if ($total_quantity >= 4) {
//         $discount = $cart->subtotal * 0.25;
//         $cart->add_fee(__('Bulk Discount (25%)', 'woocommerce'), -$discount);
//     }
// }

function custom_woocommerce_shortcode_product_new($atts)
{

    $atts = shortcode_atts(array(
        'columns' => '4',
        'rows' => '1',
    ), $atts, 'product-new');
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'point',
                'operator' => 'NOT IN',
            ),
        ),
    );

    $query = new WP_Query($args);
    ob_start();
    if ($query->have_posts()) {
        echo '<div data-block-name="woocommerce/product-new" data-columns="' . esc_attr($atts['columns']) . '" data-rows="' . esc_attr($atts['rows']) . '" class="wc-block-grid wp-block-product-new wc-block-product-new has-' . esc_attr($atts['columns']) . '-columns">';
        echo '<ul class="wc-block-grid__products -">';

        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $product_id = $product->get_id();
            $product_link = get_permalink($product_id);
            $product_title = get_the_title();
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'woocommerce_thumbnail')[0];
            $product_price = $product->get_price_html();

            echo '<li class="wc-block-grid__product">';
            echo '<a href="' . esc_url($product_link) . '" class="wc-block-grid__product-link"></a>';
            echo '<div class="wc-block-grid__product-image"><img fetchpriority="high" decoding="async" width="300" height="300" src="' . esc_url($product_image) . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="' . esc_attr($product_title) . '"></div>';
            echo '<div class="wc-block-grid__product-title">' . esc_html($product_title) . '</div>';
            echo '<div class="wc-block-grid__product-price price">' . $product_price . '</div>';
            echo '<div class="wp-block-button wc-block-grid__product-add-to-cart"><a href="' . esc_url($product_link) . '" aria-label="Select options for “' . esc_attr($product_title) . '”" data-quantity="1" data-product_id="' . esc_attr($product_id) . '" rel="nofollow" class="wp-block-button__link add_to_cart_button">Select options</a></div>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p>No products found</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('product-new', 'custom_woocommerce_shortcode_product_new');



function product_variation_table_shortcode($atts)
{
    global $product;

    if (!$product || 'product' !== get_post_type($product->get_id())) {
        return '';
    }

    $variations = $product->get_children();
    if (empty($variations)) {
        return 'No variations found';
    }

    $attributes = $product->get_attributes(); // Get all product attributes

    ob_start();
?>
    <div class="table-responsive">
        <table class="product-variation-table">
            <thead>
                <tr>
                    <th>SKU</th>
                    <?php
                    foreach ($attributes as $attribute_name => $attribute) {
                        echo '<th>' . wc_attribute_label($attribute_name) . '</th>';
                    }
                    ?>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($variations as $variation_id) {
                    $variation_obj = new WC_Product_Variation($variation_id);
                ?>
                    <tr>
                        <td><?php echo $variation_obj->get_sku(); ?></td>
                        <?php
                        foreach ($attributes as $attribute_name => $attribute) {
                            $attribute_value = $variation_obj->get_attribute($attribute_name);
                            echo '<td>' . esc_html($attribute_value ? $attribute_value : '-') . '</td>';
                        }
                        ?>
                        <td>
                            <div class="quantity" data-price="<?php echo $variation_obj->get_price(); ?>">
                                <input type="button" value="-" class="qty_button minus">
                                <input type="number" step="1" min="0" max="<?php echo $variation_obj->get_stock_quantity(); ?>" name="quantity" value="0" title="Qty" class="input-text qty text" size="4" data-variation-id="<?php echo $variation_obj->get_id(); ?>" data-price="<?php echo $variation_obj->get_price(); ?>" />
                                <input type="button" value="+" class="qty_button plus">
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="enquiry-button-custom">
        <button id="enquiry-button">Enquiry</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // document.querySelectorAll('.quantity').forEach(function(quantityWrapper) {
            //     var input = quantityWrapper.querySelector('input.qty');
            //     var minusButton = quantityWrapper.querySelector('.minus');
            //     var plusButton = quantityWrapper.querySelector('.plus');

            //     minusButton.addEventListener('click', function() {
            //         var currentValue = parseInt(input.value, 10);
            //         if (!isNaN(currentValue) && currentValue > 0) {
            //             input.value = currentValue - 1;
            //         }
            //     });

            //     plusButton.addEventListener('click', function() {
            //         var currentValue = parseInt(input.value, 10);
            //         var max = parseInt(input.getAttribute('max'), 10);
            //         if (!isNaN(currentValue) && (isNaN(max) || currentValue < max)) {
            //             input.value = currentValue ;
            //         }
            //     });
            // });

            document.getElementById('enquiry-button').addEventListener('click', function() {
                var quantities = document.querySelectorAll('.quantity input.qty');
                var productsToAdd = {
                    cart: [],
                    enquiry: []
                };

                quantities.forEach(function(input) {
                    var quantity = parseInt(input.value, 10);
                    var variationId = input.getAttribute('data-variation-id');
                    var price = input.getAttribute('data-price');
                    if (quantity > 0) {
                        if (price > 0) {
                            productsToAdd.cart.push({
                                variationId: variationId,
                                quantity: quantity
                            });
                        } else {
                            productsToAdd.enquiry.push({
                                variationId: variationId,
                                quantity: quantity
                            });
                        }
                    }
                });

                if (productsToAdd.cart.length > 0 || productsToAdd.enquiry.length > 0) {
                    jQuery.ajax({
                        url: wc_add_to_cart_params.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'add_multiple_to_cart_or_enquiry',
                            products: productsToAdd
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(error) {
                            alert('Failed to process items.');
                        }
                    });
                } else {
                    alert('No products to add.');
                }
            });
        });
    </script>
    <style>
        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity .minus,
        .quantity .plus {
            background-color: #ccc;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .quantity .qty {
            text-align: center;
            margin: 0 5px;
        }

        .product-variation-table .cart {
            border-bottom: 0 !important;
        }

        .product-variation-table .quantity {
            width: 30%;
        }

        .product-variation-table .quantity input {
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 6px;
        }

        .enquiry-button-custom {
            display: flex;
            justify-content: end;
        }

        .product-variation-table .quantity input[type="number"]:focus {
            outline: none;
        }

        .product-variation-table thead {
            background-color: #00a4d8 !important;
        }

        .product-variation-table thead tr th {
            color: #FFF;
            padding: 1rem;
            border: 0;
        }

        .table-responsive {
            border-radius: 10px;
        }

        .product-variation-table td {
            padding: 1rem;
            border: 0;
        }
    </style>
<?php

    return ob_get_clean();
}

add_shortcode('product_variation_table', 'product_variation_table_shortcode');

add_action('wp_ajax_add_multiple_to_cart_or_enquiry', 'add_multiple_to_cart_or_enquiry');
add_action('wp_ajax_nopriv_add_multiple_to_cart_or_enquiry', 'add_multiple_to_cart_or_enquiry');

function add_multiple_to_cart_or_enquiry()
{
    if (isset($_POST['products']) && is_array($_POST['products'])) {
        $products = $_POST['products'];

        // Process cart products
        if (!empty($products['cart'])) {
            foreach ($products['cart'] as $product) {
                $variation_id = intval($product['variationId']);
                $quantity = intval($product['quantity']);
                if ($variation_id > 0 && $quantity > 0) {
                    WC()->cart->add_to_cart($variation_id, $quantity);
                }
            }
        }
        // Process enquiry products
        if (!empty($products['enquiry'])) {
            foreach ($products['enquiry'] as $product) {
                $variation_id = intval($product['variationId']);
                $quantity = intval($product['quantity']);
                if ($variation_id > 0 && $quantity > 0) {
                    $enquiry_cart = WC()->session->get('enquiry_cart', array());
                    $enquiry_cart[] = array(
                        'variation_id' => $variation_id,
                        'quantity' => $quantity
                    );
                    WC()->session->set('enquiry_cart', $enquiry_cart);
                }
            }
        }

        wp_send_json_success('Products processed successfully.');
    } else {
        wp_send_json_error('No products to process.');
    }
}







function display_enquiry_cart()
{
    $enquiry_cart = WC()->session->get('enquiry_cart', array());

    if (empty($enquiry_cart)) {
        return 'Your enquiry cart is empty.';
    }

    ob_start();
?>
    <div class="enquiry-cart">
        <h2>Enquiry Cart</h2>
        <ul class="woocommerce-mini-cart cart_list product_list_widget">
            <?php
            foreach ($enquiry_cart as $key => $item) {
                $product = wc_get_product($item['variation_id']);
                $product_name = $product->get_name();
                $product_link = $product->get_permalink();
                $product_image = $product->get_image();
                $quantity = $item['quantity'];
            ?>
                <li class="woocommerce-mini-cart-item mini_cart_enquiry_item" data-item-key="<?php echo $key; ?>">
                    <div class="enquiry-product-remove">
                        <a href="#" class="remove remove_from_cart_button remove-enquiry-item" aria-label="Remove <?php echo $product_name; ?> from cart" data-item-key="<?php echo $key; ?>">×</a>
                    </div>
                    <div class="enquiry-product-info">
                        <a href="<?php echo $product_link; ?>">
                            <?php echo $product_name; ?>
                        </a>
                        <span class="empuiry-quantity"><?php echo $quantity; ?> items</span>
                    </div>
                    <a class="enquiry-product-image" href="<?php echo $product_link; ?>">
                        <?php echo $product_image; ?>

                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
        <div class="enquiry-cart-actions">
            <a class="button enquiry-cart-button" href="/enquiry-cart-2" id="send-enquiry">View Enquiry</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-enquiry-item').forEach(function(button) {
                button.addEventListener('click', function() {
                    var itemKey = this.getAttribute('data-item-key');
                    jQuery.ajax({
                        url: wc_add_to_cart_params.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'remove_enquiry_item',
                            item_key: itemKey
                        },
                        success: function(response) {
                            // Remove the table row
                            var row = document.querySelector('tr[data-item-key="' + itemKey + '"]');
                            if (row) {
                                row.remove();
                            }
                            // Check if the cart is empty
                            if (document.querySelectorAll('.enquiry-cart-table tbody tr').length === 0) {
                                document.querySelector('.enquiry-cart').innerHTML = 'Your enquiry cart is empty.';
                            }

                            loadingIndicator.style.display = 'none';
                        },
                        error: function(error) {
                            loadingIndicator.style.display = 'none';
                        }
                    });
                });
            });

            document.getElementById('send-enquiry').addEventListener('click', function() {
                // Implement the logic to send the enquiry
                alert('Send enquiry logic to be implemented.');
            });
        });
    </script>
    <style>
        .enquiry-cart {
            border-top: 3px double #e9e6ed;
            padding-top: 20px;
        }

        .enquiry-cart h2 {
            font-size: 20px;
            font-weight: 500;
        }

        .enquiry-cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .enquiry-cart-table th,
        .enquiry-cart-table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .enquiry-cart-actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .enquiry-cart-actions button {
            padding: 10px 20px;
            background-color: #00a4d8;
            color: white;
            border: none;
            cursor: pointer;
        }

        .loading-indicator {
            display: none;
            margin: 10px 0;
            color: #00a4d8;
            font-weight: bold;
        }

        .remove-enquiry-item {
            line-height: 20px !important;
            top: 3px !important;
            margin: 0 0 !important;

        }

        .enquiry-product-info {
            width: 60%;
        }

        .enquiry-product-info a {
            color: #404040;
            padding-bottom: 5px;
        }

        .enquiry-product-image {
            width: 30%;
        }

        .enquiry-product-remove {
            width: 10%;
        }

        .mini_cart_enquiry_item {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .enquiry-product-image img {
            width: 70px !important;
        }

        .enquiry-cart-button {
            background-color: transparent !important;
            color: #040404 !important;
            border: 1px solid #040404 !important;
            cursor: pointer !important;
            width: 100% !important;
            text-align: center !important;
        }

        .enquiry-cart-button:hover {
            background-color: #040404 !important;
            color: white !important;
        }
    </style>
<?php
    return ob_get_clean();
}

add_shortcode('display_enquiry_cart', 'display_enquiry_cart');

// AJAX handler to remove an item from the enquiry cart
function remove_enquiry_item()
{
    $item_key = isset($_POST['item_key']) ? sanitize_text_field($_POST['item_key']) : '';
    if ($item_key === '') {
        wp_send_json_error(array('message' => 'Invalid item key.'));
    }

    $enquiry_cart = WC()->session->get('enquiry_cart', array());
    if (isset($enquiry_cart[$item_key])) {
        unset($enquiry_cart[$item_key]);
        WC()->session->set('enquiry_cart', $enquiry_cart);
        wp_send_json_success();
    } else {
        wp_send_json_error(array('message' => 'Item not found in the enquiry cart.'));
    }
}
add_action('wp_ajax_remove_enquiry_item', 'remove_enquiry_item');
add_action('wp_ajax_nopriv_remove_enquiry_item', 'remove_enquiry_item');




//Update cart count

add_filter('woocommerce_cart_contents_count', 'custom_cart_contents_count', 9999, 1);

function custom_cart_contents_count($count)
{
    $count = 0;
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $count += $cart_item['quantity'];
    }
    $enquiry_cart = WC()->session->get('enquiry_cart', array());
    $enquiry_cart_count = array_sum(wp_list_pluck($enquiry_cart, 'quantity'));
    if (empty($enquiry_cart_count)) {
        return $count;
    } else {
        return $count + $enquiry_cart_count;
    }
}

function add_points_widget_to_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    echo '<a class="cart-contents" href="' . wc_get_cart_url() . '">' . WC()->cart->get_cart_contents_count() . '</a>';
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
add_filter('add_to_cart_fragments', 'add_points_widget_to_fragment');


function display_enquiry_cart_page()
{
    $enquiry_cart = WC()->session->get('enquiry_cart', array());

    if (empty($enquiry_cart)) {
        return 'Your enquiry cart is empty.';
    }

    ob_start();
?>
    <div class="enquiry-table">
        <table class="enquiry-cart-table">
            <thead>
                <tr>

                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($enquiry_cart as $key => $item) {
                    $product = wc_get_product($item['variation_id']);
                    $product_name = $product->get_name();
                    $product_link = $product->get_permalink();
                    $product_image = $product->get_image();
                    $quantity = $item['quantity'];
                ?>
                    <tr class="table_cart_enquiry_item" data-item-key="<?php echo $key; ?>">
                        <td>
                            <div class="enquiry-product-image">
                                <a href="<?php echo $product_link; ?>">
                                    <?php echo $product_image; ?>
                                </a>
                            </div>
                            <div class="enquiry-product-info">
                                <a href="<?php echo $product_link; ?>">
                                    <?php echo $product_name; ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <?php echo $quantity; ?> items
                        </td>
                        <td >
                            <a href="#" class="remove remove-enquiry-item" aria-label="Remove <?php echo $product_name; ?> from cart" data-item-key="<?php echo $key; ?>">×</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>

    <style>

        .enquiry-product-image img {
            max-width: 70px;
            height: auto;
        }
.table_cart_enquiry_item td{
    width: 100%;
}
    </style>
<?php
    return ob_get_clean();
}

add_shortcode('display_enquiry_cart_page', 'display_enquiry_cart_page');
