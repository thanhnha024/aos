<?php 

add_action('wp_footer', 'weiboo_modal_pop');
function weiboo_modal_pop() {
	global $weiboo_option;
	$wsm_title = $weiboo_option['wsm_title'];
	$wsm_subtitle = $weiboo_option['wsm_subtitle'];
	$wsm_shortcode = $weiboo_option['wsm_shortcode'];
	$wsm_notice = $weiboo_option['wsm_info_notice'];
	$wsm_bg = $weiboo_option['wsm_bg']['id'];
	$banner = wp_get_attachment_image_src($wsm_bg, 'large')[0];
	$wsm_enabled = $weiboo_option['enable_subscription_modal'];
	if( !$wsm_enabled == 1 ) return;
	if( empty($wsm_shortcode) && $banner == '' ) return;
    ?>
	<div class="modal fade modal-lg " id="weibooSubscriptionModal" tabindex="-1" aria-labelledby="weibooSubscriptionModalLabel" aria-hidden="true" data-bs-backdrop="static">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
			<div class="modal-body position-relative p-0">
	          <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="<?php echo esc_html('Close'); ?>"></button>
			    <div class="row align-items-center rounded">
			    	<?php 
			    		if( $banner ){
			    			?>
					      <div class="col d-none d-md-block p-0 subscription-image-col">
					      	<img src="<?php echo esc_url($banner);?>" alt="<?php echo esc_html('Subscription Modal'); ?>" class="subs-image">
					      </div>			    				
			    			<?php
			    		}
			    		if( $wsm_shortcode ){
			    			?>
					      <div class="col subscription-box-col">
					      	<div class="subscription-box py-3 ps-3 pe-4">
						      	<h3 class="modal-title mb-3" id="weibooSubscriptionModalLabel"><?php echo esc_html($wsm_title); ?></h3>
								<p class="subscription-subtitle mb-2"><?php echo esc_html($wsm_subtitle); ?></p>
						      	<?php echo do_shortcode($wsm_shortcode); ?>
						      	<p class="info-notice mt-2 fw-bold"><?php echo esc_html($wsm_notice); ?></p>
					      	</div>
					      </div>			    				
			    			<?php
			    		}
			    	?>
			    </div>
			</div>
	    </div>
	  </div>
	</div>
    <?php
}