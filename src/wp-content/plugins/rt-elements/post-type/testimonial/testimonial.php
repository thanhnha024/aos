<?php
class ReacTheme_Testimonial_Post_Type{
	public function __construct() {
		add_action( 'init', array( $this, 'reactheme_testimonial_register_post_type' ) );		
		add_action( 'init', array( $this, 'reactheme_testimoanl_create_taxonomy' ) );		
	}

	function reactheme_testimonial_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Testimonial', 'rtelements'),
			'singular_name'      => esc_html__( 'Testimonial', 'rtelements'),
			'add_new'            => esc_html__( 'Add New Testimonial', 'rtelements'),
			'add_new_item'       => esc_html__( 'Add New Testimonial', 'rtelements'),
			'edit_item'          => esc_html__( 'Edit Testimonial', 'rtelements'),
			'new_item'           => esc_html__( 'New Testimonial', 'rtelements'),
			'all_items'          => esc_html__( 'All Testimonial', 'rtelements'),
			'view_item'          => esc_html__( 'View Testimonial', 'rtelements'),
			'search_items'       => esc_html__( 'Search Testimonials', 'rtelements'),
			'not_found'          => esc_html__( 'No Testimonials found', 'rtelements'),
			'not_found_in_trash' => esc_html__( 'No Testimonials found in Trash', 'rtelements'),
			'parent_item_colon'  => esc_html__( 'Parent Testimonial:', 'rtelements'),
			'featured_image'     => esc_html__('Author Image'),
			'set_featured_image' => esc_html__('Upload Author Image'),
			'menu_name'          => esc_html__( 'Testimonials', 'rtelements'),
		);	
		
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail', 'editor' )
		);
		register_post_type( 'rt-testimonials', $args );
	}

	function reactheme_testimoanl_create_taxonomy() {
		
		register_taxonomy(
			'rt-testimonial-category',
			'rt-testimonials',
			array(
				'label'             => esc_html__( 'Testimonial Categories','rtelements'),			
				'hierarchical'      => true,
				'show_admin_column' => true,		
			)
		);
	}



}
new ReacTheme_Testimonial_Post_Type();