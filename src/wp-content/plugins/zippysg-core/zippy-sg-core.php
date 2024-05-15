<?php
/* Plugin Name: ZippySG Core
Plugin URI: https://zippy.sg/
Description: Don't Remove. Extends Code important.
Version: 3.0 Author: Zippy SG
Author URI: https://zippy.sg/
License: GNU General Public
License v3.0 License
URI: https://zippy.sg/
Domain Path: /languages

Copyright 2024

*/

defined('ABSPATH') or die('°_°’');

/* ------------------------------------------
 // Constants
 ------------------------------------------------------------------------ */
/* Set plugin version constant. */

if (!defined('Zippy_Custom_WP_Core_Version')) {
	define('Zippy_Custom_WP_Core_Version', '1.1.8');
}

/* Set plugin name. */

if (!defined('Zippy_Custom_WP_Core_Name')) {
	define('Zippy_Custom_WP_Core_Name', 'ZippySG Core');
}

/* Set constant path to the plugin directory. */

if (!defined('Zippy_Custom_WP_Core')) {
	define('Zippy_Custom_WP_Core', plugin_dir_path(__FILE__));
}

/* Set constant url to the plugin directory. */

if (!defined('Zippy_Custom_Dir_Url')) {
	define('Zippy_Custom_Dir_Url', plugin_dir_url(__FILE__));

}

/* ------------------------------------------
// i18n
---------------------------- --------------------------------------------- */

load_plugin_textdomain('zippy-sg-core', false, basename(dirname(__FILE__)) . '/languages');

/* ------------------------------------------
// Includes
 --------------------------- --------------------------------------------- */

require_once Zippy_Custom_WP_Core . 'includes/class-zippy-change-wp-admin-login.php';

require_once Zippy_Custom_WP_Core . 'includes/class-zippy-custom-core.php';
