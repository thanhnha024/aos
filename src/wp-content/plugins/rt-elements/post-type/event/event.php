<?php

global $echooling_option;
// Register Event Post Type
function rt_event_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Events', 'rtelements' ),
		'singular_name'      => esc_html__( 'Event', 'rtelements' ),
		'add_new'            => esc_html_x( 'Add New Event', 'rtelements'),
		'add_new_item'       => esc_html__( 'Add New Event', 'rtelements' ),
		'edit_item'          => esc_html__( 'Edit Event', 'rtelements' ),
		'new_item'           => esc_html__( 'New Event', 'rtelements' ),
		'all_items'          => esc_html__( 'All Events', 'rtelements' ),
		'view_item'          => esc_html__( 'View Event', 'rtelements' ),
		'search_items'       => esc_html__( 'Search Events', 'rtelements' ),
		'not_found'          => esc_html__( 'No Events found', 'rtelements' ),
		'not_found_in_trash' => esc_html__( 'No Events found in Trash', 'rtelements' ),
		'parent_item_colon'  => esc_html__( 'Parent Event:', 'rtelements' ),
		'menu_name'          => esc_html__( 'RT Event', 'rtelements' ),
	);
	global $echooling_option;
	$event_slug = (!empty($echooling_option['event_slug']))? $echooling_option['event_slug'] :'event';
	$args = array(
		'labels'             => $labels,
		'public'             => true,	
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'rewrite' => 		 array('slug' => $event_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail','editor', 'tags' ),		
	);
	register_post_type( 'rt-events', $args );
}
add_action( 'init', 'rt_event_register_post_type' );
function rt_create_event() {
	register_taxonomy(
		'rt-event-category',
		'rt-events',
		array(
			'label' => __( 'Event Categories','rtelements' ),
			'rewrite' => array( 'slug' => 'rt-event-category' ),
			'hierarchical' => true,
			'show_admin_column' => true,	
		)
	);
}
add_action( 'init', 'rt_create_event' );