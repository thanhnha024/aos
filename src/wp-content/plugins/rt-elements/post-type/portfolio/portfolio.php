<?php
class ReacTheme_Project_Portfolio{	

	public function __construct() {
		add_action( 'init', array( $this, 'rt_portfolio_register_post_type' ) );		
		add_action( 'init', array( $this, 'rt_create_portfolio_category' ) );
	}

	// Register Portfolio Post Type
	function rt_portfolio_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Portfolio', 'rsaddons'),
			'singular_name'      => esc_html__( 'Portfolio', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Portfolio', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Portfolio', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Portfolio', 'rsaddons'),
			'new_item'           => esc_html__( 'New Portfolio', 'rsaddons'),
			'all_items'          => esc_html__( 'All Portfolio', 'rsaddons'),
			'view_item'          => esc_html__( 'View Portfolio', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Portfolio', 'rsaddons'),
			'not_found'          => esc_html__( 'No Portfolio found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Portfolio', 'rsaddons'),
		);
		
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor', 'excerpt'),		
		);
		register_post_type( 'rt-portfolios', $args );
	}

	function rt_create_portfolio_category() {
		
		register_taxonomy(
			'rt-portfolio-category',
			'rt-portfolios',
			array(
				'label' => esc_html__( 'Portfolio Categories','rsaddons'),			
				'hierarchical' => true,
				'show_admin_column' => true,
			)
		);
	}


}
new ReacTheme_Project_Portfolio();