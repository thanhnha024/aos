<?php

namespace ZIPPY_Pay\Settings;

defined('ABSPATH') || exit;
// var_dump($test);

?>
<?php if (empty($cards)) return; ?>
<table class="form-table" id="zippy_setting_wrapper" style="display: none;">

  <tr>
    <th scope="row" class="titledesc">
      <?php _e('Payment Methods', PREFIX . 'zippy-settings-field'); ?>
    </th>
    <td class="forminp forminp-text">
      <span class="epos-card-brands">
        <?php foreach ($cards as $card) : ?>
          <span class="epos-card-brands_brand-wrapper">
            <img src="<?php echo ZIPPY_PAY_DIR_URL . 'includes/assets/icons/' . $card . '.svg' ?>" alt="" class="epos-brands-image">
          </span>
        <?php endforeach; ?>
      </span>
    </td>
  </tr>
</table>
