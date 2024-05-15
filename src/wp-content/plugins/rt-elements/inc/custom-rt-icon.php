<?php /**
 * Adding custom icon to icon control in Elementor
 */
function rts_add_custom_icons_tab( $tabs = array() ) {

	// Append new icons
	$new_icons = array(
		'linkedin-in',
		'location-dot',
		'message',
		'phone-flip',
		'play',
		'rt-plus',
		'quote-left',
		'check',
		'angle-down',
		'angle-up',
		'angle-right',
		'angle-left',
		'angles-up',
		'arrow-left',
		'arrow-right',
		'arrow-left-long',
		'arrow-right-long',
		'search',
		'user-2',
		'user',
		'cart',
		'plus',
		'basket-shopping'
	);
	

	$dir =  get_template_directory_uri();
	
	$tabs['rts-custom-icons'] = array(
		'name'          => 'rts-custom-icons',
		'label'         => esc_html__( 'RT Custom Icons', 'text-domain' ),
		'prefix'        => 'rt-',
		'displayPrefix' => 'rt',
		'labelIcon'     => 'icon rt-icon',
		'url'           =>  $dir.'/assets/css/rt-icons.css',
		'icons'         => $new_icons,
		'ver'           => '6.0',
	);

	return $tabs;
}

add_filter( 'elementor/icons_manager/additional_tabs', 'rts_add_custom_icons_tab' );