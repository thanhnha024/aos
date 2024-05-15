<?php 
    $cat = $settings['portfolio_category'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $details_btn_text = !empty($settings['details_btn_text']) ? $settings['details_btn_text'] : 'Case Studies';

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
				'post_type'      => 'rt-portfolios',
				'posts_per_page' => $settings['per_page'],								
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'rt-portfolios',
				'posts_per_page' => $settings['per_page'],				
				'tax_query'      => array(
			        array(
						'taxonomy' => 'rt-portfolio-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
			        ),
			    )
		));	  
    }

	while($best_wp->have_posts()): $best_wp->the_post();
	$cats_show = get_the_term_list( $best_wp->ID, 'rt-portfolio-category', ' ', '<span class="separator">,</span> ');
	$pf_details = get_post_meta( get_the_ID(), 'pf_details', true );



	?>

		<div class="grid-item">
			<div class="portfolio-item content-overlay">
				<?php if(has_post_thumbnail()): ?>
                    <div class="portfolio-img">
                    	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                    	
                        <div class="portfolio-content">                	                    
                            <?php if(get_the_title()):?>
                                <span class="p-category"><?php echo $cats_show; ?></span><br>
                                <div class="p-title">
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>                    			
                                </div>
                            <?php endif;?>
							<div class="pf-excerpt">
								<?php echo waretech_custom_excerpt(14); ?>
							</div>
                            <div class="case-info">
								<?php
								foreach ( (array) $pf_details as $key => $entry ) {

									$title = $desc = '';
								
									if ( isset( $entry['pf_info_title'] ) ) {
										$title = esc_html( $entry['pf_info_title'] );
									}
								
									if ( isset( $entry['pf_info_value'] ) ) {
										$desc = $entry['pf_info_value'];
									}
									echo '<div><b>'. esc_html($title) .'</b> '. esc_html($desc) .'</div>';
								}
								?>
							</div>
                        </div>

                    </div>
                <?php endif;?>
                
            </div>
		</div>
	<?php	
	endwhile;
	wp_reset_query();