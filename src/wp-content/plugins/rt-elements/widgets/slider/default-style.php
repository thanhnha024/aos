<div class="react-addon-services services-<?php echo esc_attr( $settings['services_style'] ); ?>">
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
	    				<?php if($settings['services_style'] == 'style5'){
	    					?>
	    					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
	    					<?php
	    				}
	    				
	    				else{ ?>

	    				<i class="rt-arrow-right-long"></i>
	    		  <?php	}?>

	    			</a>	    		    		
		    		
		    	</div>
	    	<?php } ?>

	    </div>
	</div>
</div>