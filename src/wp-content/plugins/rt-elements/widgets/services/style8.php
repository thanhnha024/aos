<div class="react-addon-services services-<?php echo esc_attr( $settings['services_style'] ); ?>">
    <div class="services-part">
		<a href="#" class="product-box product-box-medium">
			<div class="contents">
					<?php if(!empty($settings['title_prefix'])) : ?>
		    			<span class="pretitle"><?php echo $settings['title_prefix']; ?></span>
		    		<?php endif; ?>	
				<h1 class="product-title"><?php echo wp_kses_post($settings['title']);?></h1>
				<?php echo wp_kses_post($settings['text']);?>
			</div>
			<div class="product-thumb">
				<?php if(!empty($settings['selected_image'])) :?>
	    			<img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="product-thumb"/>
	    		<?php endif;?>
			</div>
		</a>
	</div>
</div>