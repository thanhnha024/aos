<?php
    /* All Functions for woocommerce
    -----------------------------------------*/
    /*-------------------------------------
    #. Theme supports for WooCommerce
    ---------------------------------------*/

    function weiboo_add_woocommerce_support() {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
    }
    add_action('after_setup_theme', 'weiboo_add_woocommerce_support');

    add_filter('get_the_archive_title_prefix', '__return_empty_string');

    function weiboo_wc_shop_thumb_area() {
        get_template_part('template-parts/wo-templates/content', 'shop-thumb');
    }

    /* Shop hide default page title */
    function weiboo_wc_hide_page_title() {
        return false;
    }

    function weiboo_wc_loop_product_title() {
        echo '<h2 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
    }

    function weiboo_wc_loop_shop_per_page() {
        global $weiboo_option;
        $layout = !empty($weiboo_option['wc_num_product']) ? $weiboo_option['wc_num_product'] : 9;
        return $layout;
    }
    add_action('loop_shop_per_page', 'weiboo_wc_loop_shop_per_page');

    // Change number or products per row
    if (!function_exists('weiboo_loop_columns')) {
        function weiboo_loop_columns() {
            global $weiboo_option;
            $layout_col = !empty($weiboo_option['wc_num_product_per_row']) ? $weiboo_option['wc_num_product_per_row'] : 3;

            if (isset($_GET['shop-layout'])) {
                if ($_GET['shop-layout'] == 'full') {
                    $weiboo_option['shop-layout'] = 'full';
                    $layout_col                   = 4;
                }
            }
            return $layout_col;
        }
    }
    add_filter('loop_shop_columns', 'weiboo_loop_columns');

    //Count number work with ajax
    function weiboo_header_cart_count($fragments) {
        global $woocommerce;
    ob_start();?>
	<span class="icon-num"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
        $fragments['span.icon-num'] = ob_get_clean();
            return $fragments;
        }
        //Change related item products quantity
        add_filter('woocommerce_output_related_products_args', 'weiboo_related_products_args');
        function weiboo_related_products_args($args) {
            $ppp = 4;
            $pc  = 4;
            global $weiboo_option;
            if ($weiboo_option) {
                $ppp = $weiboo_option['single_releted_products'];
                $pc  = $weiboo_option['single_releted_products_col'];
            }
            $args['posts_per_page'] = $ppp; // related products
            $args['columns']        = $pc; // arranged in columns
            return $args;
        }

        function after_shop_loop_item_title() {
            return false;
        }

        /*All hoocks for woocommerce*
        -------------------------------------------*/

        /* Header cart count number */
        add_filter('woocommerce_add_to_cart_fragments', 'weiboo_header_cart_count');

        /* Breadcrumb */
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

        /* Shop loop */
        remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
        add_filter('woocommerce_show_page_title', 'weiboo_wc_hide_page_title');
        add_action('woocommerce_before_shop_loop_item_title', 'weiboo_wc_shop_thumb_area', 11);
        function weiboo_get_all_products_id_name() {
            $args = array(
                'posts_per_page' => -1,
                'post_type'      => array('product', 'product_variation'),
            );
            $products   = [];
            $Q_products = new WP_Query($args);
            $QP_product = $Q_products->posts;
            if (is_array($QP_product)) {
                foreach ($QP_product as $prod) {
                    $products[$prod->ID] = get_the_title($prod->ID);
                }
            }
            return $products;
        }

        // Woocommerce single page

        // Right column
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 4);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

        // To change add to cart text on single product page
        function woocommerce_custom_single_add_to_cart_text() {
            return __('<i class="rt-basket-shopping"></i> Add to Cart', 'weiboo');
        }

        // To change add to cart text on product archives(Collection) page
        function woocommerce_custom_product_add_to_cart_text() {
            return __('Buy Now', 'weiboo');
        }

        add_filter('woocommerce_checkout_fields', 'weiboo_override_checkout_fields');

        function weiboo_override_checkout_fields($fields) {
            $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__('First Name', 'weiboo');
            $fields['shipping']['shipping_last_name']['placeholder']  = esc_html__('Last Name', 'weiboo');
            $fields['billing']['billing_first_name']['placeholder']   = esc_html__('First Name', 'weiboo');
            $fields['billing']['billing_last_name']['placeholder']    = esc_html__('Last Name', 'weiboo');
            $fields['billing']['billing_company']['placeholder']      = esc_html__('Business Name', 'weiboo');
            $fields['billing']['billing_company']['label']            = esc_html__('Business Name', 'weiboo');
            $fields['shipping']['shipping_company']['placeholder']    = esc_html__('Company Name', 'weiboo');
            $fields['billing']['billing_email']['placeholder']        = esc_html__('Email Address', 'weiboo');
            $fields['billing']['billing_phone']['placeholder']        = esc_html__('Phone', 'weiboo');
            $fields['billing']['billing_state']['placeholder']        = esc_html__('State', 'weiboo');
            $fields['billing']['billing_city']['placeholder']         = esc_html__('City', 'weiboo');
            $fields['billing']['billing_postcode']['placeholder']     = esc_html__('Post Code', 'weiboo');
            return $fields;
        }

        if (!function_exists('woocommerce_template_single_rating')) {

            /**
             * Output the product rating.
             */
            function woocommerce_template_single_rating() {
                if (post_type_supports('product', 'comments')) {
                    wc_get_template('single-product/rating.php');
                }
            }
        }

        add_filter('woocommerce_sale_flash', 'weiboo_add_percentage_to_sale_badge', 20, 3);
        function weiboo_add_percentage_to_sale_badge($html, $post, $product) {
            if ($product->is_type('variable')) {
                $percentages = array();

                // Get all variation prices
                $prices = $product->get_variation_prices();

                // Loop through variation prices
                foreach ($prices['price'] as $key => $price) {
                    // Only on sale variations
                    if ($prices['regular_price'][$key] !== $price) {
                        // Calculate and set in the array the percentage for each variation on sale
                        $percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
                    }
                }
                // We keep the highest value
                $percentage = max($percentages) . '%';

            } elseif ($product->is_type('grouped')) {
                $percentages = array();

                // Get all variation prices
                $children_ids = $product->get_children();

                // Loop through variation prices
                foreach ($children_ids as $child_id) {
                    $child_product = wc_get_product($child_id);

                    $regular_price = (float) $child_product->get_regular_price();
                    $sale_price    = (float) $child_product->get_sale_price();

                    if ($sale_price != 0 || !empty($sale_price)) {
                        // Calculate and set in the array the percentage for each child on sale
                        $percentages[] = round(100 - ($sale_price / $regular_price * 100));
                    }
                }
                // We keep the highest value
                $percentage = max($percentages) . '%';

            } else {
                $regular_price = (float) $product->get_regular_price();
                $sale_price    = (float) $product->get_sale_price();

                if ($sale_price != 0 || !empty($sale_price)) {
                    $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
                } else {
                    return $html;
                }
            }

            global $weiboo_option;
            $gallery_option = ' sale-';

            if (isset($_GET['product-layout'])) {
                if ($_GET['product-layout'] == 'two') {
                    $gallery_option .= 'left-thumb';
                } elseif ($_GET['product-layout'] == 'three') {
                    $gallery_option .= 'right-thumb';
                }
            } else {
                $gallery_option .= (!empty($weiboo_option['single-gallery-layout'])) ? $weiboo_option['single-gallery-layout'] : 'default-thumb';
            }

            return '<span class="onsale sale-rs' . $gallery_option . '">' . esc_html__('-', 'weiboo') . $percentage . '</span>';
        }

        //Example weiboo_star_rating(['rating' => 4]);
        function weiboo_star_rating($args = array()) {
            $defaults = array(
                'rating' => 0,
                'type'   => 'rating',
                'number' => 0,
                'echo'   => true,
            );
            $parsed_args = wp_parse_args($args, $defaults);

            // Non-English decimal places when the $rating is coming from a string.
            $rating = (float) str_replace(',', '.', $parsed_args['rating']);

            // Convert percentage to star rating, 0..5 in .5 increments.
            if ('percent' === $parsed_args['type']) {
                $rating = round($rating / 10, 0) / 2;
            }

            // Calculate the number of each type of star needed.
            $full_stars  = floor($rating);
            $half_stars  = ceil($rating - $full_stars);
            $empty_stars = 5 - $full_stars - $half_stars;

            if ($parsed_args['number']) {
                /* translators: 1: The rating, 2: The number of ratings. */
                $format = _n('%1$s rating based on %2$s rating', '%1$s rating based on %2$s ratings', 'weiboo');
                $title  = sprintf($format, number_format_i18n($rating, 1), number_format_i18n($parsed_args['number']));
            } else {
                /* translators: %s: The rating. */
                $title = sprintf(__('%s rating', 'weiboo'), number_format_i18n($rating, 1));
            }

            $output = '<div class="star-rating">';

            $output .= str_repeat('<i class="star star-full rt-star" aria-hidden="true"></i>', $full_stars);
            $output .= str_repeat('<i class="star star-half rt-star-half-stroke-solid" aria-hidden="true"></i>', $half_stars);
            $output .= str_repeat('<i class="star star-empty rt-star-regular" aria-hidden="true"></i>', $empty_stars);
            $output .= '</div>';

            if ($parsed_args['echo']) {
                echo wp_kses_post($output);
            }

            return $output;
        }

        // Get recent post to show new badge
        function weiboo_is_recent_post() {
            $post_date = get_the_time('U');
            $sec       = time() - $post_date;
            $day       = intval($sec / (60 * 60 * 24));

            global $weiboo_option;
            $show_new = !empty($weiboo_option['wc_show_new']) ? $weiboo_option['wc_show_new'] : true;
            $new_days = !empty($weiboo_option['wc_new_product_days']) ? $weiboo_option['wc_new_product_days'] : 15;

            $newMetaDisable = get_post_meta(get_the_ID(), 'disable_new_badge', true);

            if (!$newMetaDisable) {
                if ($show_new) {
                    return $day <= $new_days ? true : false;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        // Invert Sale and Original Price
        add_filter('woocommerce_format_sale_price', 'weiboo_invert_formatted_sale_price', 10, 3);
        function weiboo_invert_formatted_sale_price($price, $regular_price, $sale_price) {
        return '<ins>' . (is_numeric($sale_price) ? wc_price($sale_price) : $sale_price) . '</ins> <del>' . (is_numeric($regular_price) ? wc_price($regular_price) : $regular_price) . '</del>';
    }

add_action('woocommerce_before_shop_loop', 'weiboo_add_list_products', 31);
function weiboo_add_list_products(){
    ?>
        <div class="change-wooproduct-view float-end d-sm-flex d-none">
            <div class="pgrid-view rts-cursor-pointer text-center border  p-1 px-2 ">
                <i class="rt-grid-2"></i>
            </div>
            <div class="plist-view rts-cursor-pointer text-center border  p-1 px-2">
                <i class="rt-list"></i>
            </div>
        </div>
    <?php
}

add_action('woocommerce_after_shop_loop_item_title', 'bitsy_add_products_short_descin_archive', 2);
function bitsy_add_products_short_descin_archive(){
    ?>
        <p class="product-archive-shorts mb-1"><?php echo weiboo_custom_excerpt(20); ?></p>
    <?php
}

add_action('woocommerce_shop_loop_item_title', 'bitsy_add_products_desc_box_before', 1);
function bitsy_add_products_desc_box_before(){
    ?>
        <div class="product-bottom">
    <?php
}

add_action('woocommerce_after_shop_loop_item', 'bitsy_add_products_desc_box_after', 10000);
function bitsy_add_products_desc_box_after(){
    ?>
        </div>
    </div>

    <?php
}
