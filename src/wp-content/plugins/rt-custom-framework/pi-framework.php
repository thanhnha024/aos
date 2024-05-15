<?php
/**
* Plugin Name: RT Custom Framework
* Plugin URI: https://codecanyon.net/user/reacthemes
* Description: Echooling Framework plugin for page metabox
* Version: 1.0
* Author: ReacThemes
* Author URI: http://www.reactheme.com
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die( 'You shouldnt be here' );
}

/**
* Function when plugin is activated
*
* @param void
*
*/
//Including file that manages all template

//All Post type include here

$dir = plugin_dir_path( __FILE__ );
//For team
require_once $dir .'/metaboxes/page-header.php';
require_once $dir .'/metaboxes/custom-metabox.php';
require_once $dir .'/metaboxes/cmb2/init.php';

/**
 * Implement widgets
 */
require_once $dir . '/widgets/post_recent_widget.php';
require_once $dir . '/widgets/contact.php';
require_once $dir . '/widgets/social-icon.php';
require_once $dir . '/widgets/product-categories.php';