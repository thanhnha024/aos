<?php

/*** Child Theme Function  ***/
function weiboo_theme_enqueue_scripts() {
	wp_register_style( 'childstyle', get_template_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action('wp_enqueue_scripts', 'weiboo_theme_enqueue_scripts', 11);


function tishonator_woo_variations_limit( $limit ) {
	$limit = 2000;

	return $limit;
}
add_filter( 'woocommerce_rest_batch_items_limit',
  'tishonator_woo_variations_limit' );


/*** Add text before add to cart ***/
add_action( 'woocommerce_single_product_summary', 'add_test_before_add_to_cart', 20 );
function add_test_before_add_to_cart() {
    if ( get_field('buy_more_save_more')){
        the_field('buy_more_save_more');
    }
}

// <!-- ---####*** Change text  ***####--- -->
function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Ship to a different address?' :
        $translated_text = __( 'To allow AOS PTE LTD to ship products to customer’s address.', 'woocommerce' );
        break;
        case 'Order notes' :
        $translated_text = __( 'Additional information', 'woocommerce' );
        break;
    }
    return $translated_text;
}
add_filter('gettext', 'wc_billing_field_strings', 20, 3);

//* Add custom message to WordPress login page
function smallenvelop_login_message( $message ) {
    if ( empty($message) ){
        return "<p style='text-align:center'>Welcome to AOS Pte Ltd. If you don't have an account, please access to <a href='https://aospteltd.com.sg/'>aospteltd.com.sg</a> website</p>";
    } else {
        return $message;
    }
}
add_filter( 'login_message', 'smallenvelop_login_message' );add_filter( 'login_message', 'smallenvelop_login_message' );
