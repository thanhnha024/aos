<?php
 /*
 Plugin Name: Change wp-admin login
 Plugin URI: https://wordpress.org/plugins/change-wp-admin-login/
 Description: Change wp-admin login to whatever you want. example: http://www.example.com/my-login. Go under Settings and then click on "Permalinks" and change your URL under "Change wp-admin login".
 Version: 1.1.8
 Author: wpexpertsio
 Author URI: https://wpexperts.io/
 Text Domain: change-wp-admin-login
 Domain Path: /languages

Copyright 2023  Saad lqbal (email : saad@objects.ws)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

// Acknowledgements to Ella van Durpe (https://wordpress.org/plugins/rename-wp-login/), some of whose code was used
// in the development of this plug-in. This plugin (https://wordpress.org/plugins/rename-wp-login/) don't have any copyright policy.

 */

 /* Do not access this file directly */

 defined('ABSPATH') or die('°_°’');


 /* ------------------------------------------
// Constants ---------------------------
--------------------------------------------- */

/* Set plugin version constant. */

if( ! defined( 'NS_Change_WP_Admin_Login_Version' ) ) {
	define( 'NS_Change_WP_Admin_Login_Version', '1.1.8' );
}

/* Set plugin name. */

if( ! defined( 'NS_Change_WP_Admin_Login_Name' ) ) {
	define( 'NS_Change_WP_Admin_Login_Name', 'Change wp-admin login' );
}

/* Set constant path to the plugin directory. */

if ( ! defined( 'NS_Change_WP_Admin_Login_Path' ) ) {
	define( 'NS_Change_WP_Admin_Login_Path', plugin_dir_path( __FILE__ ) );
}

/* Set the constant path to the plugin directory URI. */

if ( ! defined( 'NS_Change_WP_Admin_Login_Base_Uri' ) ) {
	define( 'NS_Change_WP_Admin_Login_Base_Uri', plugin_dir_url( __FILE__ ) );
}

/* ------------------------------------------
// i18n ----------------------------
--------------------------------------------- */
load_plugin_textdomain( 'change-wp-admin-login', false, basename( dirname( __FILE__ ) ) . '/languages' );

/* ------------------------------------------
// Includes ---------------------------
--------------------------------------------- */
require_once NS_Change_WP_Admin_Login_Path . 'includes/class-change-wp-admin-login.php';
