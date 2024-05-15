<div class="rs-team-grid rs-team team-grid-<?php echo esc_html($settings['team_grid_style']); ?> <?php echo esc_html($settings['team_grid_popup']);?>">
	<?php if($settings['show_filter'] == 'filter_show'){
		$grid = 'grid';

	}else{
		$grid = "";
	}?>
	<div class="row <?php echo esc_attr( $grid );?>">
		 	<?php //******************//
		 		$x = 1;
		        $cat = $settings['team_category'];
		      
		        
		        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				if(empty($cat)){
		        	$best_wp = new wp_Query(array(
							'post_type'      => 'teams',
							'posts_per_page' => $settings['per_page'],
							'paged'          => $paged					
					));	  
		        }   
		        else{
		        	$best_wp = new wp_Query(array(
							'post_type'      => 'teams',
							'posts_per_page' => $settings['per_page'],
							'paged'          => $paged,
							'tax_query'      => array(
						        array(
									'taxonomy' => 'team-category',
									'field'    => 'slug', //can be set to ID
									'terms'    => $cat //if field is ID you can reference by cat/term number
						        ),
						    )
					));	  
		        }

				while($best_wp->have_posts()): $best_wp->the_post();	

					$termsArray  = get_the_terms( $best_wp->ID, "team-category" );  //Get the terms for this particular item
					$termsString = ""; //initialize the string that will contain the terms
					$termsSlug   = "";

					foreach ( $termsArray as $term ) { 
						$termsString .= 'filter_'.$term->slug.' '; 
						$termsSlug .= $term->name;
					}					

				    $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';			
				    $content = get_the_content();									   
					//retrive social icon values			
					$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
					$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
					$instagram = get_post_meta( get_the_ID(), 'instagram', true );
					$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
					$show_phone  = get_post_meta( get_the_ID(), 'phone', true );
					$show_email  = get_post_meta( get_the_ID(), 'email', true );
					
					$fb   ='';
					$tw   ='';
					$gp   ='';
					$ldin ='';
				
					if($facebook!=''){
						$fb='<a href="'.$facebook.'" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a> ';
					}
					if($twitter!=''){
						$tw='<a href="'.$twitter.'" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>';
					}
					if($instagram!=''){
						$gp='<a href="'.$instagram.'" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a> ';
					}
					if($linkedin!=''){
						$ldin='<a href="'.$linkedin.'" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
					}
				?>		
			
					<div class="col-lg-<?php echo esc_html($settings['team_columns']);?> col-md-6 <?php echo $termsString;?> grid-item">	

						<div class="team-item">
							<div class="team-inner-wrap">
								<div class="image-wrap">
									<a class="pointer-events"  href="#rs_popupBox2_<?php echo esc_attr($x);?>" data-effect="mfp-zoom-in">
										<?php the_post_thumbnail($settings['thumbnail_size']); ?>
									</a>
									
							    </div>
						    	<div class="team-content">	
						    		<div class="team-title nolink"><?php echo esc_html( $designation );?></div>							            
						    		<h3 class="team-name"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
						                
						    	    <?php if( $fb || $gp || $tw || $ldin ): ?>
						    			<div class="social-icons">
						    				<?php echo wp_kses_post($fb);						    					
						    					echo wp_kses_post($tw);
						    					echo wp_kses_post($gp);
						    					echo wp_kses_post($ldin);
						    				?>
						            	</div>
						        	<?php endif; ?>   
						    	</div>
							</div>				    
						</div>

					</div>
						

				<?php	
				$x++;
				endwhile;
				wp_reset_query();  
	         ?>  
	</div>
</div>