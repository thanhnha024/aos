<?php

/** @var $link */

/** @var $message */

/** @var $user_contact */

/** @var $type */

?>

<?php if (isset($domain) && isset($user_contact) && $type == 'manual' && isset($order_id)) : ?>
  <script>
    window.onload = function() {
      var link = document.createElement('a');
      link.href = "<?php echo ('https://wa.me/' . $user_contact . '?text=Hello%2C%20I%20have%20made%20payment%20for%20Order%20%23' . $order_id . '%20in%20' . $domain . '%2C%20Thank%20You!%0A%0APRESS%20SEND%20%3E%3E%3E'); ?>";
      link.target = '_blank';
      link.click();
    };
  </script>
<?php endif; ?>
