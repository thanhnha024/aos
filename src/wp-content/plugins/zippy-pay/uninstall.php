<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}
define('PREFIX', 'zippy_payment_getway');


// We need to remove all key in config plugin after unintall plugin.

delete_option(PREFIX . '_test_mode');
delete_option(PREFIX . '_merchant_id');
delete_option(PREFIX . '_base_url');
delete_option(PREFIX . '_secret_key');
