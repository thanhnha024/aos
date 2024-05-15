<?php 
    $cat = $settings['portfolio_category'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

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

    $x=1;
 	$details_btn_text = !empty($settings['details_btn_text']) ? $settings['details_btn_text'] : 'Case Details';
	while($best_wp->have_posts()): $best_wp->the_post();	
		
		$content       = get_the_content();
		$client        = get_post_meta( get_the_ID(), 'client', true );
		$location      = get_post_meta( get_the_ID(), 'location', true );
		$surface_area  = get_post_meta( get_the_ID(), 'surface_area', true );
		$created       = get_post_meta( get_the_ID(), 'created', true );
		$date          = get_post_meta( get_the_ID(), 'date', true );
		$project_value = get_post_meta( get_the_ID(), 'project_value', true );

		$cats_show = get_the_term_list( $best_wp->ID, 'rt-portfolio-category', ' ', '<span class="separator">,</span> ');
		$termsArray  = get_the_terms( $best_wp->ID, "rt-portfolio-category" );  //Get the terms for this particular item
		$termsString = ""; //initialize the string that will contain the terms
		$termsSlug   = "";

		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}		
								
	?>

		<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-6 col-xs-1 grid-item <?php echo $termsString;?>">
			<div class="portfolio-item content-overlay">
			
			<?php if(has_post_thumbnail()): ?>
                <div class="portfolio-img">
                	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                </div>
            <?php endif;?>
            <div class="portfolio-content">
                <div class="vertical-middle">
                    <div class="vertical-middle-cell">
                    	<p class="p-category"><?php echo $cats_show; ?></p>
                    	<?php if(get_the_title()):?>
                    		<h4 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    	<?php endif;?>	
                    	<div class="portfolio-text"><?php echo waretech_custom_excerpt(10);?></div>		        	
                    </div>
                </div>
            </div>
            <a class="read-btn link-button" href="<?php the_permalink();?>"><?php echo esc_html(  $details_btn_text  );?> <span class="f-right"><i class="rt-arrow-right-long"></i></span></a>
        </div>
    </div>
	        

		
	<?php
	$x++;	
	endwhile;
	wp_reset_query();  
 ?>  
