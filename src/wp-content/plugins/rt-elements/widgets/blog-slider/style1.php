<?php 
	$cat   = $settings['portfolio_category'];

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
	<div class="align-items-center no-gutter blog-item reactheme-blog-grid1 col-md-12">

    <div class="col-top">
        <div class="image-part">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
            </a> 
       
         <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
            <div class="cat_list">
                <?php the_category( ); ?>
            </div>
        <?php } ?>
         </div>
    </div>
    <div class="col-bottom">
        <div class="blog-content">        
           <?php if( !empty($settings['blog_meta_show_hide']) || !empty($settings['blog_avatar_show_hide'])){?>
            <ul class="blog-meta">
                <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                    <?php if(!empty($full_date)){ ?>
                    <li> <?php echo esc_html($full_date);?></li>
                    <?php } ?>
                <?php } ?>
                <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                    <?php if(!empty($post_admin)){ ?>
                    <li>/ <span> By </span><span class="author"><?php echo esc_html($post_admin);?></span></li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <?php } ?>
           
            <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
            
            
        </div>
    </div>
</div>
	<?php	
	endwhile;
	wp_reset_query();  
 ?>  
