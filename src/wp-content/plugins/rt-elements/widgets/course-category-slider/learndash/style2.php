
<?php	
	$settings = $this->get_settings_for_display();
	$cat = $settings['cats'];
	
	if(!empty( $cat )){
	foreach ($cat as $catid) {
		$icon = get_term_meta($catid, 'category_icon', true);
		$icon_cat = (!empty($icon)) ? '<img src="'.$icon.'" alt="">' : '';
		$icon2 = get_term_meta($catid, 'category_illustration_img', true);
		$icon_color = get_term_meta($catid, 'course_color', true);
		$icon_cat2 = (!empty($icon2)) ? '<img src="'.$icon2.'" alt="">' : '';
		$icon_color = !empty($icon_color) ? 'style="background:'.$icon_color.'"' : "#fff9c5";

		$term_link = get_term_by('slug', $catid, 'ld_course_category');
		$term_link = get_term_link( $term_link);
		$term_name = get_term( $catid )->name;
		$term      = get_term( $catid, 'ld_course_category' );	
		$get_link  = get_template_directory_uri();


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
                	<div class="contents">
                		<?php echo $icon_cat; ?> 
                		<h3 class="title">
                			<a href="<?php echo $term_link; ?>"><?php echo $term_name = get_term( $catid )->name;?></a>
                		</h3>  
                		<?php echo '<span class="course-qnty">'.$n.' '.$course_valu.'</span>';?> 
                		
                		<div class="vies-more"><a href="<?php echo $term_link; ?>"><?php echo esc_html__('View More', 'educavo'); ?> </a></div>
                	</div>
           		</div>              
            </div>
    	</div>
	<?php }
  }
?>
