<?php

/** @var \ZIPPY_Pay\Core\ZIPPY_Adyen_Pay_Gateway $this */
/** @var $action  */
/** @var $return_url */ ?>

<form action="<?php echo $action->url; ?>" method="post" id="psawg_payment_form">
  <?php foreach ($action->data as $key => $value) : ?>
    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
  <?php endforeach; ?>
  <input type="hidden" name="TermUrl" value="<?php echo $return_url; ?>" />
</form>

<script>
  jQuery(document).ready(function() {
    jQuery("#psawg_payment_form").submit();
  });
</script>
