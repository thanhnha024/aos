<?php 
    $cat = $settings['portfolio_category']; 
    if(empty($cat)){
    	$best_wp = new wp_Query(array(
				'post_type'      => 'post',
				'posts_per_page' => $settings['per_page'],								
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
			'post_type'      => 'post',
			'posts_per_page' => $settings['per_page'],				
			'tax_query'      => array(
		        array(
					'taxonomy' => 'category',
					'field'    => 'slug', //can be set to ID
					'terms'    => $cat //if field is ID you can reference by cat/term number
		        ),
		    )
		));	  
    }

	while($best_wp->have_posts()): $best_wp->the_post();	
	$cats_show = get_the_term_list( $best_wp->ID, 'category', ' ', '<span class="separator">,</span> ');
	$full_date      = get_the_date();
	$blog_date      = get_the_date('M d y');	
	$post_admin     = get_the_author();						

	
	?>	

		<div class="grid-item">
			<div class="portfolio-item">
				<?php if(has_post_thumbnail()): ?>                    
                    <?php  the_post_thumbnail($settings['thumbnail_size']);?>                    
                <?php endif;?>
                <div class="portfolio-content">                	                    
						<?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
							<span class="p-category"><?php echo $cats_show; ?></span>
						<?php } ?>

						<?php if( !empty($settings['blog_meta_show_hide']) || !empty($settings['blog_avatar_show_hide'])){?>
						<ul class="blog-meta">
							<?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
								<?php if(!empty($full_date)){ ?>
								<li class="blog--date"><i class="rt-calendar-days"></i> <?php echo esc_html($full_date);?></li>
								<?php } ?>
							<?php } ?>
							<?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
								<?php if(!empty($post_admin)){ ?>
								<li class="blog--author"> <i class="rt-user"></i> <span> By </span><span class="authorx"><?php echo esc_html($post_admin);?></span></li>
								<?php } ?>
							<?php } ?>
						</ul>
						<?php } ?>

                	<?php if(get_the_title()):?>
                		<div class="p-title">
                			<a href="<?php the_permalink();?>"><?php the_title();?></a>                    			
                		</div>
                	<?php endif;?>                        	
               	</div>
            </div>

		</div>
	<?php	
	endwhile;
	wp_reset_query();  
 ?>  
