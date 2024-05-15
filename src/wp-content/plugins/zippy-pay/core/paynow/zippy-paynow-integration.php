<?php

namespace ZIPPY_Pay\Core\Paynow;

use ZIPPY_Pay\Core\Paynow\ZIPPY_Paynow_Gateway;

class ZIPPY_Paynow_Integration
{

    /**
     * The single instance of the class.
     *
     * @var   ZIPPY_Paynow_Integration
     */
    protected static $_instance = null;

    /**
     * @return ZIPPY_Paynow_Integration
     */
    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * ZIPPY_Paynow_Integration constructor.
     */
    public function __construct()
    {

        if (!$this->is_woocommerce_active()) {
            return;
        }

        add_filter('woocommerce_payment_gateways',  array($this, 'add_zippy_paynow_to_woocommerce'));
        add_action('plugins_loaded',  array($this, 'zippy_paynow_load_plugin_textdomain'));
    }

    public function add_zippy_paynow_to_woocommerce($gateways)
    {

        $gateways[] = ZIPPY_Paynow_Gateway::class;
        return $gateways;
    }

    public function init_zippy_payment_gateway()
    {
        include ZIPPY_PAY_DIR_PATH . '/zippy-payment-getway.php';
    }

    public function zippy_paynow_load_plugin_textdomain()
    {
        load_plugin_textdomain('payment-gateway-for-zippy-and-woocommerce', false, basename(dirname(__FILE__)) . '/languages/');
    }


    private function is_woocommerce_active()
    {
        $active_plugins = (array) get_option('active_plugins', array());

        if (is_multisite()) {
            $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
        }

        return in_array('woocommerce/woocommerce.php', $active_plugins) || array_key_exists('woocommerce/woocommerce.php', $active_plugins);
    }
}
