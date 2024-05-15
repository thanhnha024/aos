
<?php	
	$settings = $this->get_settings_for_display();
		
	$cat = $settings['cat'];
    $taxonomy       = 'course_category';
    if(!empty($cat)){		
	foreach ($cat as $catid) {

        $term       = get_term_by('slug', $catid, 'course_category');   
        $icon       = get_term_meta($term->term_id, 'category_icon', true);
        $icon_cat   = (!empty($icon)) ? '<img src="'.$icon.'" alt="">' : '';
        $icon2      = get_term_meta($term->term_id, 'category_illustration_img', true);
        $icon_color = get_term_meta($term->term_id, 'course_color', true);
        $icon_cat2  = (!empty($icon2)) ? '<img src="'.$icon2.'" alt="">' : '';
        $icon_color = !empty($icon_color) ? 'style="background:'.$icon_color.'"' : "#fff9c5";		
        $term_link  = get_term_link($term->slug, $taxonomy);						
        $term_name  =  $term->name;
        $get_link   = get_template_directory_uri();	
        $args = array(
           'post_type' => 'lp_course',
           'tax_query' => array(
                array(
                  'taxonomy' => 'course_category',
                  'field' => 'slug',
                  'terms' => $catid,
                )
            )
        );

        $obj_name = new WP_Query($args);

        $n = $obj_name->post_count; 				
        ?>
        <div class="team-item ">
        	<div class="categories-items">
                <div class="cate-images <?php echo ($settings['align'])?>"> 

                    <?php if(($settings['cat_icon_image'] == 'cat_image') ){ 
                        echo $icon_cat2; 
                    } ?>
                    

                	 
                	<div class="contents">
                        <?php if(($settings['cat_icon_image'] == 'cat_icon') ){ 
                            echo $icon_cat; 
                        } ?>

                		<h3 class="title">
                			<a href="<?php echo $term_link; ?>"><?php echo $term_name;?></a>
                		</h3>  
                		<span class="course-qnty">
	                		<?php
            	            	$n = str_pad($n, 2, '0', STR_PAD_LEFT);	            	            		
                                printf( _nx( '%s Course', '%s Courses', $n, 'Courses', 'rsaddon' ),  $n );
                            ?> 
                        </span>  

                        <?php if($settings['readmore_show_hide'] == 'yes') { ?>
                		
                		    <div class="vies-more"><a href="<?php echo $term_link; ?>"><?php echo esc_html__('View More', 'educavo'); ?> </a></div>
                        <?php } ?>
                	</div>
           		</div>              
            </div>
    	</div>
	<?php }
}