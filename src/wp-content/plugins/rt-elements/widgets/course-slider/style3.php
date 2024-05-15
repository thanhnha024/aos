<?php //******************//


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$cat = $settings['cat'];
 if(empty($cat)){  
	$best_wp = new wp_Query(array(
			'post_type'      => 'lp_course',
			'posts_per_page' => $settings['per_page'],
			'offset'              => $settings['offset'],
			'paged'          => $paged					
	));	  
}   
else{
	$best_wp = new wp_Query(array(
			'post_type'      => 'lp_course',
			'posts_per_page' => $settings['per_page'],
			'paged'          => $paged,
			'offset'              => $settings['offset'],
			'tax_query'      => array(
		        array(
					'taxonomy' => 'course_category',
					'field'    => 'slug', //can be set to ID
					'terms'    => $cat //if field is ID you can reference by cat/term number
		        ),
		    )
	));	  
} ?>


<?php

while($best_wp->have_posts()): $best_wp->the_post();
	$taxonomy       = "course_category";		
	$cats_show           = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
	$excerpt             = get_the_excerpt();
	$the_link = get_permalink();
	$course_id           = get_the_ID();
	$rstheme_course      = LP()->global['course'];
	$course_enroll_count = $rstheme_course->get_users_enrolled();
	$course_enroll_count = $course_enroll_count ? $course_enroll_count : 0;							

	if ( empty( $rstheme_course ) ) return;

	$course_author = get_post_field( 'post_author', $course_id );
	$course_author = get_post_field( 'post_author', $course_id );
	$course_enroll_count = $rstheme_course->get_users_enrolled();
	$course_enroll_count = $course_enroll_count ? $course_enroll_count : 0;	
    
    if ( function_exists( 'learn_press_get_course_rate' ) ) {
		$course_rate_res = learn_press_get_course_rate( $course_id, false );
		$course_rate     = $course_rate_res['rated'];
		$course_rate_total = $course_rate_res['total'];
		$course_rate_text = $course_rate_total > 1 ? esc_html__( 'Reviews', 'rsaddon' ) : esc_html__('Review','rsaddon' );
	}


	$cats_show = ($cats_show) ? $cats_show : '';


	$duration = get_post_meta( $course_id, '_lp_duration', true );
	$duration = absint( $duration );
	$duration = !empty( $duration ) ? $duration : false; 
	$lessons  = $rstheme_course->get_curriculum_items( 'lp_lesson' )? count( $rstheme_course->get_curriculum_items( 'lp_lesson' ) ) : 0; 

		if(!empty($settings['course_des'])){
	        $limit = $settings['course_des'];
	    }
	    else{
	        $limit = 20;
	    }
	?>

	<div class="courses-item">
		<?php if(($settings['show_thums'] == 'yes') ){ ?>
	        <div class="img-part">
	            <a href="<?php the_permalink();?>"> <?php the_post_thumbnail($settings['thumbnail_size']);?></a>
	            <?php if( "style3" != $settings['course_slider_style'] ){ ?>
	            <?php if(($settings['course_multi_color'] == 'custom_style') ){ ?>
	        	    <?php if(($settings['cate_show_hide'] == 'yes') ){ ?>
	        	    	<div class="cats">         		
	        	    		<?php $cat = get_the_terms( $course_id , $taxonomy );?>
	        			 	<ul class="course-categories">                          
	        	                <?php foreach ($cat as $catin ) {                        
	        	                $term_bg    = get_term_meta($catin->term_id, 'course_color', true );
	        	                $term_color = get_term_meta($catin->term_id, 'cat_color', true );
	        	                $term_style = !empty( $term_bg ) ? 'style = "background:'.$term_bg.'; color:'.$term_color.'"': '';?>
	        	                <li><a href="<?php echo get_category_link($catin->term_id);?>"><?php echo $catin->name ;?></a></li> 
	        	                <?php   } ?>
	        	          	</ul>
	        	    	</div>
	        	    <?php } ?>
	            <?php } else { ?>
	        	    <?php if(($settings['cate_show_hide'] == 'yes') ){ ?>
	        	    	<div class="cats">         		
	        	    		<?php $cat = get_the_terms( $course_id , $taxonomy );?>
	        			 	<ul class="course-categories">                          
	        	                <?php foreach ($cat as $catin ) {                        
	        	                $term_bg    = get_term_meta($catin->term_id, 'course_color', true );
	        	                $term_color = get_term_meta($catin->term_id, 'cat_color', true );
	        	                $term_style = !empty( $term_bg ) ? 'style = "background:'.$term_bg.'; color:'.$term_color.'"': '';?>
	        	                <li><a <?php echo $term_style; ?> href="<?php echo get_category_link($catin->term_id);?>"><?php echo $catin->name ;?></a></li> 
	        	                <?php   } ?>
	        	          	</ul>
	        	    	</div>
	        	    <?php } ?>
	            <?php } ?>
	            <?php } ?>

	            <?php if( "style3" == $settings['course_slider_style'] ){ ?>
	            	<?php learn_press_course_price(); ?>
	            <?php } ?>
	        </div>
		<?php } ?>
        <div class="content-part">
        	<?php if(($settings['meta_show_hide'] == 'yes') ){ ?>
	            <ul class="meta-part">
	                <li class="user"><i class="rt-user"></i><?php echo esc_html($course_enroll_count); ?> 
	                <?php echo esc_html__('Students', 'educavo');?></li>
	                <?php if( "style3" != $settings['course_slider_style'] ){ ?>
	                	<li><?php learn_press_course_price(); ?> </li>
	            	<?php } ?>
	            	<li>
        				<div class="lessons">
        					<i class="fas fa-file-alt"></i>
        					<?php echo esc_html($lessons);?> <?php echo esc_html__('Lessons', 'educavo');?>
        				</div>
	            	</li>
	            </ul>
        	<?php } ?>

            <h3 class="title">
            	<a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>
            
            <?php if(($settings['author_show_hide'] == 'yes') ){ ?>
			<div class="course-author">
				<div class="author-img">
	             	<a class="rs-author" href="<?php echo esc_url( learn_press_user_profile_link( $course_author ) );?>">
	             		<?php echo get_avatar( $course_author, 40 ); ?>	
	             	</a>
	            </div>
             	<div class="author-name">
					<a href="<?php echo esc_url( learn_press_user_profile_link( $course_author ) );?>">
						<?php echo get_the_author_meta( 'display_name'); ?>
					</a>
				</div>
        	</div>
        	<?php } ?>
            
            <?php if(($settings['event_content_show_hide'] == 'yes') ){ ?>
                <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
            <?php } ?>

            <?php if( !empty($settings['ratings_show_hide']) || !empty($settings['btn_show_hide'])){?>
	            <div class="bottom-part">
	            	<?php if(($settings['ratings_show_hide'] == 'yes') ){ ?>
		                <div class="info-meta">
		                    <ul>                        
		                        <li class="course-ratings">
		                            <?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );?><div class="course-rating-total">
		                            (<?php echo esc_html( $course_rate_total );?>)</div>
		                        </li>
		                    </ul>
		                </div>
	                <?php } ?>
	                <?php if(($settings['btn_show_hide'] == 'yes') ){ ?>
		                <div class="btn-part">
		                	<a href="<?php the_permalink();?>"><?php echo esc_html($settings['course_btn_text']);?> <i class="flaticon-right-arrow"></i></a>
		                </div>
	            	<?php } ?>
	            </div>
            <?php } ?>
        </div>
	</div>
<?php 	endwhile; 
	wp_reset_query();

?>  
