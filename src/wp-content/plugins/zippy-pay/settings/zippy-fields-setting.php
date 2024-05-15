<?php

namespace ZIPPY_Pay\Settings;

use WC_Admin_Settings;
use ZIPPY_Pay\Core\ZIPPY_Pay_Core;

defined('ABSPATH') || exit;

class ZIPPY_Fields_Setting
{

  /**
   * The single instance of the class.
   *
   * @var   ZIPPY_Field_Settings
   */
  protected static $_instance = null;

  /**
   * @return ZIPPY_Field_Settings
   */
  public static function get_instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Constructor
   */
  public function __construct()
  {

    add_action('woocommerce_admin_field_zippy_credit_card_field', array($this, 'zippy_credit_card_settings'));
    add_action('woocommerce_admin_field_zippy_paynow_field', array($this, 'zippy_paynow_settings'));
    add_action('woocommerce_admin_field_zippy_general_field', array($this, 'zippy_general_settings'));
    // add_action("wp_ajax_sync_config_payment_callback", array($this, "sync_config_payment_callback"));
    // add_action("wp_ajax_nopriv_sync_config_payment_callback", array($this, "sync_config_payment_callback"));
  }


  /**
   * Sync config from zippy
   *
   * @return array
   */

  public function sync_config_payment_callback()
  {
    // Example response
    $response = array(
      'status' => 'success',
      'message' => 'AJAX request processed successfully',
    );

    // Send the JSON response
    wp_send_json($response);
  }

  /**
   * Add Additional Settings Of Zippy General Setting
   *
   *
   */
  function zippy_general_settings($current_section = '')
  {
    $merchant_id =   WC_Admin_Settings::get_option(PREFIX . '_merchant_id');

    echo ZIPPY_Pay_Core::get_template('general/setting-fields.php', [
      'params' => $merchant_id,

    ], dirname(__FILE__), '/templates');
  }

  /**
   * Add Additional Settings Of Zippy credit card
   *
   *
   */
  function zippy_credit_card_settings($current_section = '')
  {

    $credit_card_config = get_option('zippy_configs_adyen');

    if(empty($credit_card_config)) return;

    $credit_cards = $credit_card_config->paymentMethods->paymentMethods[0]->brands;

    echo ZIPPY_Pay_Core::get_template('credit-card/setting-fields.php', [
      'cards' => $credit_cards,

    ], dirname(__FILE__), '/templates');
  }

  /**
   * Add Additional Settings Of Zippy Paynow
   *
   *
   */
  function zippy_paynow_settings($current_section = '')
  {

    $config_infor = get_option('zippy_configs_paynow');

    echo ZIPPY_Pay_Core::get_template('paynow/setting-fields.php', [
      'params' => $config_infor,
    ], dirname(__FILE__), '/templates');
  }
}
