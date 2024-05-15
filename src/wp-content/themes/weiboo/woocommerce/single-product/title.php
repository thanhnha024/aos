<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$post_id = get_the_ID();
$product = wc_get_product( $post_id ); 
$status = $product->get_stock_status();

// 'onbackorder' , 'outofstock' , 'instock'

if( $status == 'instock' ){
	$stock = 'In Stock';
} elseif( $status == 'onbackorder' ){
	$stock = '<i class="rt-check"></i> Backorders';
} elseif( $status == 'outofstock' ){
	$stock = 'Out Of Stock';
}else{
	$stock = 'In Stock';
}
?>
<h1 class="product_title entry-title"><?php the_title(); ?> <span class="stock <?php echo esc_attr($status); ?>"><?php echo wp_kses_post($stock); ?></span></h1>