<?php //******************//


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$cat = $settings['cat'];
 if(empty($cat)){
    $best_wp = new wp_Query(array(
            'post_type'           => 'sfwd-courses',
            'posts_per_page'      => $settings['course_per'],
            'ignore_sticky_posts' => 1,
            'offset'              => $settings['offset'],                           
    ));   
}   
else{
    $best_wp = new wp_Query(array(
        'post_type'           => 'sfwd-courses',
        'posts_per_page'      => $settings['course_per'],
        'ignore_sticky_posts' => 1,
        'offset'              => $settings['offset'],                       
        'tax_query' => array(
            array(
                'taxonomy' => 'ld_course_category',
                'field'    => 'term_id', //can be set to ID
                'terms'    =>  $cat//if field is ID you can reference by cat/term number
            ),
        )
    ));   
} ?>
<?php
	

while($best_wp->have_posts()): $best_wp->the_post();

		$taxonomy       = "ld_course_category";	

		$cats_show           = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
        $excerpt = get_the_excerpt();

		global $post; 
        $post_id    = $post->ID;
        $course_id  = $post_id;
        $user_id    = get_current_user_id();
        $current_id = $post->ID;
        $options    = get_option('sfwd_cpt_options');
        $currency   = null;

        if ( ! is_null( $options ) ) {
            if ( isset($options['modules'] ) && isset( $options['modules']['sfwd-courses_options'] ) && isset( $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'] ) )
                $currency = $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'];

        }

        if( is_null( $currency ) )
            $currency = 'USD';

        $course_options = get_post_meta($post_id, "_sfwd-courses", true);

        
        
        $price          = $course_options && isset($course_options['sfwd-courses_course_price']) ? $course_options['sfwd-courses_course_price'] : esc_html__( 'Free', 'rsaddon' );
        
        $has_access     = sfwd_lms_has_access( $course_id, $user_id );
        $is_completed   = learndash_course_completed( $user_id, $course_id );

        if( $price     == '' )
        $price         .= esc_html__( 'Free', 'rsaddon' );
        
        if ( is_numeric( $price ) ) {
        if ( $currency == "USD" )
         $price         = '$' . $price;
        else
         $price         .= ' ' . $currency;
        }
        
        $class         = '';
        $price_text   = '';
        
        if ( $has_access && ! $is_completed ) {
        $class         = 'ld_course_grid_price ribbon-enrolled';
        $price_text   = esc_html__( 'Enrolled', 'rsaddon' );
        } elseif ( $has_access && $is_completed ) {
        $class         = 'ld_course_grid_price';
        $price_text   = esc_html__( 'Completed', 'rsaddon' );
        } else {
        $class         = ! empty( $course_options['sfwd-courses_course_price'] ) ? 'ld_course_grid_price price_' . $currency : 'ld_course_grid_price free';
        $price_text   = $price;
        }   

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

	            <?php if(($settings['course_multi_color'] == 'custom_style') ){ ?>
	        	    <?php if(($settings['cate_show_hide'] == 'yes') ){ ?>
	        	    	<div class="cats">         		
	        	    		<?php $cat = get_the_terms( $post_id , $taxonomy );?>
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
	        	    		<?php $cat = get_the_terms( $post_id , $taxonomy );?>
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
	        </div>
		<?php } ?>
        <div class="content-part">
        	<?php if(($settings['meta_show_hide'] == 'yes') ){ ?>
	            <ul class="meta-part">	                
	                <li><span><?php  echo esc_html($price_text); ?></span></li>
	            </ul>
        	<?php } ?>

            <h3 class="title">
            	<a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>           
       
            <?php if(($settings['event_content_show_hide'] == 'yes') ){ ?>
                <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
            <?php } ?>

           
            <div class="bottom-part">
                <div class="en-btn">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo esc_html__("Enroll Now", 'educavo');?>
                    </a>
                </div>	
                           
                <?php if(($settings['btn_show_hide'] == 'yes') ){ ?>
	                <div class="btn-part">
	                	<a href="<?php the_permalink();?>"><?php echo esc_html($settings['course_btn_text']);?> <i class="flaticon-right-arrow"></i></a>
	                </div>
            	<?php } ?>                
            </div>
          
        </div>
	</div>
<?php 	endwhile; 
	wp_reset_query();

?> 
