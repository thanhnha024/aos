<?php
/* @wordpress-plugin
 * Plugin Name:       Zippy Pay
 * Plugin URI:
 * Description:       Accept adyen payments on your WooCommerce shop
 * Version:           2.0.0
 * WC requires at least: 3.0
 * WC tested up to: 6.7
 * Author:            Zippy
 * Author URI:        https://zippy.sg/
 * Text Domain:       zippy-and-woocommerce
 * license:           GPL-2.0+
 * license URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

namespace ZIPPY_Pay;

use ZIPPY_Pay\Core\Adyen\ZIPPY_Adyen_Pay_Integration;
use ZIPPY_Pay\Core\Paynow\ZIPPY_Paynow_Integration;
use ZIPPY_Pay\Settings\Zippy_Pay_Ajax_Handle;

define('ZIPPY_PAY_DIR_URL', plugin_dir_url(__FILE__));
define('ZIPPY_PAY_DIR_PATH', plugin_dir_path(__FILE__));
define('ZIPPY_PAY_ENDPOINT', plugin_dir_path(__FILE__));
define('PGAWC_VERSION', '1.0.0');
define('PAYMENT_ADYEN_NAME', 'Online Payment');
define('PAYMENT_PAYNOW_NAME', 'Paynow');
define('PREFIX', 'zippy_payment_getway');
define('PAYMENT_ADYEN_ID', 'zippy_adyen_payment');
define('PAYMENT_PAYNOW_ID', 'zippy_paynow_payment');

require ZIPPY_PAY_DIR_PATH . '/vendor/autoload.php';
require ZIPPY_PAY_DIR_PATH . '/includes/autoload.php';

ZIPPY_Adyen_Pay_Integration::get_instance();

ZIPPY_Paynow_Integration::get_instance();

Zippy_Pay_Ajax_Handle::get_instance();

