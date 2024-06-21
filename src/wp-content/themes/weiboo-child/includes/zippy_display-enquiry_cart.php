<?php 
// Display enquiry cart do_shortcode('[display_enquiry_cart]');
function display_enquiry_cart()
{
  $enquiry_cart = WC()->session->get('enquiry_cart', array());

  if (empty($enquiry_cart)) {
    return;
  }

  ob_start();
?>
  <div class="woocommerce enquiry-cart">
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
      <a class="button enquiry-cart-button" href="/enquiry-cart/" id="send-enquiry">View Enquiry</a>
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
              var row = document.querySelector('tr[data-item-key="' + itemKey + '"]');
              if (row) {
                row.remove();
                location.reload();
              }
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
    });
  </script>
<?php
  return ob_get_clean();
}

add_shortcode('display_enquiry_cart', 'display_enquiry_cart');
//