
<?php	
	$settings = $this->get_settings_for_display();
	$cat = $settings['cats'];
	$taxonomy = 'ld_course_category';
	
	if(!empty($cat)){
		$cat      = $settings['cat'];	
		$catstyle  = 1;
	}
	else{
		$args_cat = array(
            'taxonomy'     => $taxonomy,
            'number' => 6,
            'hide_empty' => true,
        
        );
		$cat = get_categories($args_cat);	
		$catstyle  = 2;			
		
	}
if(!empty($cat)){
foreach ($cat as $catid) {
	if($catstyle == 2) :
		$term       = get_term_by('slug', $catid->slug, 'ld_course_category');
	else :
		$term       = get_term_by('slug', $catid, 'ld_course_category');
endif;
		$icon2 = get_term_meta($term->term_id, 'category_illustration_img', true);
		$icon_color = get_term_meta($term->term_id, 'course_color', true);
		$icon_cat2 = (!empty($icon2)) ? '<img src="'.$icon2.'" alt="">' : '';
		$icon_color = !empty($icon_color) ? 'style="background:'.$icon_color.'"' : "#fff9c5";
		
		$term_link = get_term_link( $term_link);
		$term_name = $term->name;
		$term_link  = get_term_link($term->slug, 'ld_course_category');	


		$args = array(
		   'post_type' => 'sfwd-courses',
		   'tax_query' => array(
		        array(
		          'taxonomy' => 'ld_course_category',
		          'field' => 'slug',
		          'terms' => $catid,
		        )
		    )
		);


		$obj_name = new WP_Query($args);
		$n = str_pad($obj_name->post_count, 2, '0', STR_PAD_LEFT); 

		if($n>1){
			$course_valu = "Courses"; 
		} else {
			$course_valu = "Course"; 
		}
					
        ?>
        <div class="team-item">
        	<div class="categories-items">
                <div class="cate-images">
                	<?php echo $icon_cat2; ?> 
                	<div class="contents"><h3 class="title"><a href="<?php echo $term_link; ?>"><?php echo $term_name;?></a></h3>
                		<div class="des-text"><?php echo category_description( $term->term_id ); ?></div> 

                	<div class="btn-inner d-flex justify-content-between">	               	
	                	<?php echo '<span class="course-qnty">'.$n.' '.$course_valu.'</span>';?> 
	                	<div class="vies-more"><a href="<?php echo $term_link; ?>"><?php echo esc_html__('View More', 'educavo'); ?> </a></div>
	                </div>
                	</div>
           		</div>              
            </div>
    	</div>
	<?php 
  }
}
?>
