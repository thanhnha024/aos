<div class="react-addon-services services-<?php echo esc_attr( $settings['services_style'] ); ?>">
    <div class="services-part">
    			    		       
	    <div class="services-text style5">
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
	    	<?php if(!empty($settings['title'])){ ?>
		    	<div class="services-title">		    		
		    		
		    		<?php if(!empty($settings['title_link'])) : 
		    			$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
		    		?>					    							    			
		    		<<?php echo esc_html($settings['title_tag']);?>  <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <a href="<?php echo esc_url($settings['title_link']);?>" <?php echo wp_kses_post($link_open); ?> ><?php echo esc_html($settings['title']);?></a></<?php echo esc_html($settings['title_tag']);?>>
		    		<?php else: ?>
		    			<<?php echo esc_html($settings['title_tag']);?> <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>><?php if(!empty($settings['title_prefix_icon'])) :?>
		    			<img src="<?php echo esc_url( $settings['title_prefix_icon']['url'] );?>" alt="image"/>
		    		<?php endif;?>	 <?php echo esc_html($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
		    		<?php endif; ?>				    		
		    	</div>
	    	<?php } ?>	

	    	<?php if(!empty($settings['text'])) : ?>
	    		<p <?php  echo wp_kses_post($this->print_render_attribute_string( 'text' )); ?>>  <?php echo wp_kses_post($settings['text']);?></p>	
	    	<?php endif; ?>	

	    	

	    </div>
    	<?php if(!empty($settings['services_btn_text'])){ ?>

	    	<div class="services-btn-part">
	    		<?php 
	    			$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : ''; 		    		 
	    			$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
	    		?>
	    		
    			<a class="services-btn <?php echo esc_html($icon_position); ?>" href="<?php echo esc_url($settings['services_btn_link']);?>" <?php echo wp_kses_post($link_open); ?>>

    				<span <?php echo wp_kses_post($this->print_render_attribute_string( 'services_btn_text' )); ?>>
    					<?php echo esc_html($settings['services_btn_text']);?>    						
    				</span>
    				<i class="rt-arrow-right-long"></i>

    			</a>	    		    		
	    		
	    	</div>
    	<?php } ?>
	</div>
</div>