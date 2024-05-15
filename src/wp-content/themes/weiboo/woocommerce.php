<?php
get_header();
global $weiboo_option;

if(isset($_GET['shop-layout'])){
	if( $_GET['shop-layout'] == 'full' ){
		$weiboo_option['shop-layout'] = 'full';
	}elseif( $_GET['shop-layout'] == 'left' ){
		$weiboo_option['shop-layout'] = 'left-col';
	}
}

// Layout class
$weiboo_layout_class = 'col-sm-12 col-xs-12';

if(!empty($weiboo_option['shop-layout']) ) {
	if (  $weiboo_option['shop-layout'] == 'full' ) {
		$weiboo_layout_class = 'col-sm-12 col-xs-12';
	}
	elseif( $weiboo_option['shop-layout'] == 'left-col' || $weiboo_option['shop-layout'] == 'right-col'){
		$weiboo_layout_class = 'col-md-9 col-xs-12';
	}
	else{
		$weiboo_layout_class = 'col-sm-12 col-xs-12';
	}
}
?>
<div class="row">
	<?php
		if(!empty($weiboo_option['disable-sidebar']) && is_product()){
			?>
			<div class="col-sm-12 col-xs-12">
			    <?php					
					woocommerce_content();
				?>
			</div>
			<?php
		}else{				
			if ( !empty($weiboo_option['shop-layout']) && $weiboo_option['shop-layout'] == 'left-col'  ) {
				get_sidebar('woocommerce');
			}
			?>    			
		    <div class="<?php echo esc_attr($weiboo_layout_class);?>">
			    <?php					
					woocommerce_content();
   				 ?>
		    </div>
			<?php
			if (!empty($weiboo_option['shop-layout']) &&  $weiboo_option['shop-layout'] == 'right-col'  ) {
				get_sidebar('woocommerce');
			}	
		}
	?>
</div>

<?php
get_footer();