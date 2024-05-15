<?php
function weiboo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'weiboo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This is sidebar area for blog post and single post.', 'weiboo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Page Sidebar', 'weiboo' ),
		'id'            => 'sidebar_shop',
		'description'   => esc_html__( 'This is main shop page sidebar.', 'weiboo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
			
}
add_action( 'widgets_init', 'weiboo_widgets_init' );

// Register new widget for Woocommerce products Category
