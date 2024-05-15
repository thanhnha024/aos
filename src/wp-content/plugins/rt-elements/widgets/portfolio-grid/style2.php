
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
$termsArray  = get_the_terms( $best_wp->ID, 'rt-portfolio-category' );  //Get the terms for this particular item
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
                    	<a class="pf-btn" href="<?php the_permalink();?>"><i class="rt-arrow-right-long"></i></a>
                    </div>
                <?php endif;?>
                <div class="portfolio-content">
                    <div class="vertical-middle">
                        <div class="vertical-middle-cell">
                        	<span class="p-category"><?php echo wp_kses_post($cats_show); ?></span>
                        	<?php if(get_the_title()):?>
                        		<h4 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        	<?php endif;?>
                        	
                        </div>
                    </div>
                </div>
            </div>

	</div>
<?php	
endwhile;
wp_reset_query();  
?>  
