<?php
function weiboo_scripts() {
	//register styles
	global $weiboo_option;
	wp_enqueue_style( 'boostrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'rt-icons', get_template_directory_uri() .'/assets/css/rt-icons.css');
	
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css');
	wp_enqueue_style( 'swiper-bundle-css', get_template_directory_uri().'/assets/css/swiper-bundle.min.css' );
	wp_enqueue_style( 'weiboo-style-default', get_template_directory_uri() .'/assets/css/theme.css' );
	wp_enqueue_style( 'weiboo-style-responsive', get_template_directory_uri() .'/assets/css/responsive.css' );
	wp_enqueue_style( 'weiboo-google-fonts', 'https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap', false ); 
	wp_enqueue_style( 'weiboo-style', get_stylesheet_uri() );	
		
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'swiper-bundle-js', get_template_directory_uri().'/assets/js/swiper-bundle.min.js', array('jquery'), '823');

	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array('jquery'), '20151215', true );	
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '20151215', true );	
	wp_enqueue_script( 'isotope-weiboo', get_template_directory_uri() . '/assets/js/isotope-weiboo.js', array('jquery', 'imagesloaded'), '20151215', true );	
	wp_enqueue_script('weiboo-classie', get_template_directory_uri() . '/assets/js/classie.js', array('jquery'), '201513434', true);	

	
	if ( is_page_template( 'page-single.php' ) ) {
		wp_enqueue_script( 'jquery-nav', get_template_directory_uri() . '/assets/js/jquery.easing.min.js', array('jquery'), '20151215', true );
	}
	wp_enqueue_script('weiboo-mobilemenu', get_template_directory_uri() . '/assets/js/mobilemenu.js', array('jquery'), '201513434', true);
	wp_enqueue_script('weiboo-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '201513434', true);	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'weiboo_scripts' );



add_action( 'admin_enqueue_scripts', 'weiboo_load_admin_styles' );
function weiboo_load_admin_styles($screen) {
	wp_enqueue_style( 'weiboo-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', true, '1.0.0' );
	wp_enqueue_script( 'weiboo-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '20151215', true );
} 