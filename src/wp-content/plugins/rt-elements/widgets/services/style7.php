<?php
if( $settings['show_image_right'] == 'yes' ){
	$row_reverse = ' flex-row-reverse';
}else{
	$row_reverse = '';
}
?>
<div class="react-addon-services services-<?php echo esc_attr( $settings['services_style'] ); ?>">
    <div class="single-work d-flex align-items-center<?php echo esc_attr( $row_reverse ); ?> justify-content-between">
		<span>
			<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>	    		
		    		<?php if(!empty($settings['selected_icon'])) : ?>
		    			<i class="fa <?php echo esc_html( $settings['selected_icon'] );?>"></i>
		    		<?php endif; ?>
		    		<?php if(!empty($settings['selected_image'])) :?>
		    			<img class="service-img7" src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/>
		    		<?php endif;?>	    		
	    	<?php }?>
		</span>
		<h5 class="title"><?php echo wp_kses_post($settings['title']);?></h5>
		<?php if( !empty($settings['title_prefix_number'])){?>
	    	<div class="number"><?php echo esc_html($settings['title_prefix_number']);?></div>
	    <?php } ?>
			<?php
			if( $settings['show_title_chevron'] ){
				?>
			<i class="rt-angle-right ml-5 style7-chevron"></i>	
			<?php
			}
			?>		
	</div>
</div>