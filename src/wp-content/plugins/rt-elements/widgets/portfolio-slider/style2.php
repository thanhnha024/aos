<?php 
    $cat = $settings['portfolio_category']; 
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
	?>	

		<div class="grid-item">
			<div class="portfolio-item">
				<?php if(has_post_thumbnail()): ?>                    
                    <?php  the_post_thumbnail($settings['thumbnail_size']);?>                    
                <?php endif;?>
                <div class="portfolio-content">                	                    
                	<?php if(get_the_title()):?>
                		<div class="p-title">
                			<span class="p-category"><?php echo $cats_show; ?></span>
                			<a href="<?php the_permalink();?>"><?php the_title();?></a>                    			
                		</div>
                	<?php endif;?>                        	
                       
               	</div>
          
                   <a class="pf-btn" href="<?php the_permalink();?>"><i class="rt-arrow-right-long"></i></a>
             
            </div>

		</div>
	<?php	
	endwhile;
	wp_reset_query();  
 ?>  
