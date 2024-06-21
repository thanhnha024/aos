<?php
// Display single product do_shortcode('[single_product_enquiry]')
function single_product_enquiry_shortcode($atts)
{
    global $product;

    if (!$product || 'product' !== get_post_type($product->get_id())) {
        return '';
    }

    ob_start();
    ?>
    <div class="enquiry-button-single">
        <button id="single-enquiry-button" data-product-id="<?php echo $product->get_id(); ?>">Enquiry</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('single-enquiry-button').addEventListener('click', function() {
                var productId = this.getAttribute('data-product-id');
                var quantity = 1;

                jQuery.ajax({
                    url: wc_add_to_cart_params.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'add_single_to_enquiry',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // location.reload();
                    },
                    error: function(error) {
                        alert('Failed to process the enquiry.');
                    }
                });
            });
        });
    </script>
    <?php

    return ob_get_clean();
}

add_shortcode('single_product_enquiry', 'single_product_enquiry_shortcode');

add_action('wp_ajax_add_single_to_enquiry', 'add_single_to_enquiry');
add_action('wp_ajax_nopriv_add_single_to_enquiry', 'add_single_to_enquiry');

function add_single_to_enquiry()
{
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = intval($_POST['product_id']);
        $quantity = intval($_POST['quantity']);

        if ($product_id > 0 && $quantity > 0) {
            $enquiry_cart = WC()->session->get('enquiry_cart', array());
            $enquiry_cart[] = array(
                'product_id' => $product_id,
                'quantity' => $quantity
            );
            WC()->session->set('enquiry_cart', $enquiry_cart);

            wp_send_json_success('Product added to enquiry cart.');
        } else {
            wp_send_json_error('Invalid product ID or quantity.');
        }
    } else {
        wp_send_json_error('No product ID or quantity specified.');
    }
}

function add_to_enquiry_cart()
{
  if (isset($_POST['products']) && is_array($_POST['products'])) {
    $products = $_POST['products'];

    // Process enquiry product
    if (!empty($products['enquiry'])) {
      $product = reset($products['enquiry']); // Get the first (and only) product in the enquiry array
      $product_id = intval($product['productId']);
      $quantity = intval($product['quantity']);

      if ($product_id > 0 && $quantity > 0) {
        $enquiry_cart = WC()->session->get('enquiry_cart', array());
        $enquiry_cart[] = array(
          'product_id' => $product_id,
          'quantity' => $quantity
        );
        WC()->session->set('enquiry_cart', $enquiry_cart);

       
      } else {
        wp_send_json_error('Invalid product ID or quantity.');
      }
    } else {
      wp_send_json_error('No products to process.');
    }
  } else {
    wp_send_json_error('Invalid request.');
  }
}

?>
