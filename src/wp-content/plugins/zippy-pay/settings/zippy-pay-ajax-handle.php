<?php

namespace ZIPPY_Pay\Settings;

use ZIPPY_Pay\Settings\Api\ZIPPY_Settings_Api;

class Zippy_Pay_Ajax_Handle
{

  /**
   * The single instance of the class.
   *
   * @var   Zippy_Pay_Ajax_Handle
   */
  protected static $_instance = null;

  /**
   * @return Zippy_Pay_Ajax_Handle
   */
  public static function get_instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  public function __construct()
  {
    // Register the AJAX action for authenticated users
    add_action('wp_ajax_sync_config_payment', array($this, 'sync_config_payment_callback'));

    // Register the AJAX action for non-authenticated users
    add_action('wp_ajax_nopriv_sync_config_payment',  array($this, 'sync_config_payment_callback'));

    add_action('zippy_is_active_paynow', array($this, 'zippy_active_paynow_callback'));

    add_action('zippy_is_active_adyen', array($this, 'zippy_active_adyen_callback'));
  }

  function sync_config_payment_callback()
  {

    $response =  ZIPPY_Settings_Api::GetConfigs();

    if (!($response['status']) || empty($response)) wp_send_json($response);

    //Store config
    $paynow_config = $response['data']->result->paynowConfig;

    $adyen_config = $response['data']->result->adyenConfig;

    $is_paynow_store_success = update_option('zippy_configs_paynow', $paynow_config);

    $is_adyen_store_success = update_option('zippy_configs_adyen', $adyen_config);

    do_action('zippy_is_active_paynow', $paynow_config);

    do_action('zippy_is_active_adyen', $adyen_config);

    unset($response['data']);
    // Send the JSON response

    wp_send_json($response);
  }

  public function zippy_active_paynow_callback($paynow_config)
  {
    if (empty($paynow_config)) return;

    $is_active_paynow = array(
      'enabled' => $this->convert_bool_enabled($paynow_config->isEnabled)
    );

    //Store config
    return update_option('woocommerce_zippy_paynow_payment_settings', apply_filters('woocommerce_settings_api_sanitized_fields_' . PAYMENT_PAYNOW_ID, $is_active_paynow), 'yes');
  }

  public function zippy_active_adyen_callback($adyen_config)
  {
    if (empty($adyen_config)) return;

    $is_active_adyen = array(
      'enabled' => $this->convert_bool_enabled($adyen_config->isEnabled)
    );

    //Store config
    return update_option('woocommerce_zippy_adyen_payment_settings', apply_filters('woocommerce_settings_api_sanitized_fields_' . PAYMENT_ADYEN_ID, $is_active_adyen), 'yes');
  }

  public function convert_bool_enabled($bool)
  {

    return isset($bool) && $bool == 'true' ? 'yes' : 'no';
  }
}
