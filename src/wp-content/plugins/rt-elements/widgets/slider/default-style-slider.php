<div class="react-addon-services services-style1">
    <div class="services-part">
    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
    		<div class="services-icon">
	    		<?php if(!empty($settings['selected_icon'])) : ?>
	    			<i class="fa <?php echo esc_html( $settings['selected_icon'] );?>"></i>
	    		<?php endif; ?>
	    		<?php if(!empty($settings['selected_image'])) :?>
	    			<img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/>
	    		<?php endif;?>
    		</div>	
    	<?php }?>		    		       
	    <div class="services-text style5">
	    	<?php if(!empty($settings['title'])){ ?>
		    	<div class="services-title">	
		    		<?php if(!empty($settings['title_prefix'])) : ?>
		    			<span><?php echo $settings['title_prefix']; ?></span>
		    		<?php endif; ?>
		    		<?php if(!empty($settings['title_link'])) : 
		    			$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
		    		?>					    							    			
		    		<<?php echo esc_html($settings['title_tag']);?>  <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <a href="<?php echo esc_url($settings['title_link']);?>" <?php echo wp_kses_post($link_open); ?> ><?php echo esc_html($settings['title']);?></a></<?php echo esc_html($settings['title_tag']);?>>
		    		<?php else: ?>
		    			<<?php echo esc_html($settings['title_tag']);?> <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <?php echo esc_html($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
		    		<?php endif; ?>				    		
		    	</div>
	    	<?php } ?>	

	    	<?php if(!empty($settings['text'])) : ?>
	    		<p <?php  echo wp_kses_post($this->print_render_attribute_string( 'text' )); ?>>  <?php echo wp_kses_post($settings['text']);?></p>	
	    	<?php endif; ?>	

	    	
	    </div>
	</div>
</div>