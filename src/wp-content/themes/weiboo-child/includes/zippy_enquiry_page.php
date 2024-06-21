<?php
// do_shortcode('[display_enquiry_cart_page]')
function display_enquiry_cart_page()
{
    $enquiry_cart = WC()->session->get('enquiry_cart', array());

    if (empty($enquiry_cart)) {
        return 'Your enquiry cart is empty.';
    }

    ob_start();
    ?>
    <div class="woocommerce enquiry-table">
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
                            <div class="d-flex align-items-center enquiry-product">
                                <div class="product-image">
                                    <a href="<?php echo $product_link; ?>">
                                        <?php echo $product_image; ?>
                                    </a>
                                </div>
                                <div class="enquiry-product-info">
                                    <a href="<?php echo $product_link; ?>">
                                        <?php echo $product_name; ?>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-product-quantity w-100 d-flex justify-content-center">
                                <?php echo $quantity; ?> items
                            </div>
                        </td>
                        <td>
                            <div class="enquiry-product-remove w-100 d-flex justify-content-center">
                                <a href="#" class="remove remove-enquiry-item" aria-label="Remove <?php echo $product_name; ?> from cart" data-item-key="<?php echo $key; ?>">×</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="enquiry-form">
        <h2>Send Enquiry</h2>
        <form method="post" action="">
            <p>
                <label for="enquiry_name">Your Name<span class="text-danger">*</span></label>
                <input type="text" id="enquiry_name" name="enquiry_name" required>
            </p>
            <p>
                <label for="enquiry_email">Your Email<span class="text-danger">*</span></label>
                <input type="email" id="enquiry_email" name="enquiry_email" required>
            </p>
            <p>
                <label for="enquiry_message">Message</label>
                <textarea id="enquiry_message" name="enquiry_message" rows="4"></textarea>
            </p>
            <p>
                <button type="submit" name="send_enquiry" value="1">Send Enquiry</button>
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST['send_enquiry']) && $_POST['send_enquiry'] == 1) {
        handle_enquiry_form_submission($enquiry_cart);
    }

    return ob_get_clean();
}

function handle_enquiry_form_submission($enquiry_cart)
{
    $name = sanitize_text_field($_POST['enquiry_name']);
    $email = sanitize_email($_POST['enquiry_email']);
    $message = sanitize_textarea_field($_POST['enquiry_message']);

    // Create a new WooCommerce order
    $order = wc_create_order();

    foreach ($enquiry_cart as $item) {
        $product = wc_get_product($item['variation_id']);
        $quantity = $item['quantity'];

        $order->add_product($product, $quantity);
    }

    // Set order billing details
    $order->set_address(array(
        'first_name' => $name,
        'email'      => $email
    ), 'billing');

    // Add the message as order meta
    $order->update_meta_data('_enquiry_message', $message);

    $order->update_meta_data('_is_enquiry_order', 'yes');
    // Set order status to pending and save the order
    $order->update_status('processing', 'Enquiry placed by customer.');

    // Send WooCommerce order email
    WC()->mailer()->get_emails()['WC_Email_New_Order']->trigger($order->get_id());

    echo '<div class="woocommerce-message">Your enquiry has been sent successfully as an order.</div>';
    // Clear the enquiry cart
    WC()->session->set('enquiry_cart', array());

    $order->save(); // Ensure the order is saved with the new meta data
}

function add_enquiry_message_to_order_email($order, $sent_to_admin, $plain_text, $email)
{
    if ($sent_to_admin && $order->get_meta('_is_enquiry_order') === 'yes') {
        $enquiry_message = $order->get_meta('_enquiry_message');
        if ($enquiry_message) {
            echo '<h2>Message</h2><p>' . nl2br(esc_html($enquiry_message)) . '</p>';
        }
    }
}
add_action('woocommerce_email_order_meta', 'add_enquiry_message_to_order_email', 10, 4);

add_shortcode('display_enquiry_cart_page', 'display_enquiry_cart_page');


?>
