<?php //******************//
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$settings = $this->get_settings_for_display(); 
$cat = $settings['cat'];
 if(empty($cat)){
	$best_wp = new wp_Query(array(
		'post_type'           => 'rt-events',
		'posts_per_page'      => $settings['course_per'],
		'ignore_sticky_posts' => 1,
		'offset'              => $settings['offset']
	));	  
}   
else{
	$best_wp = new wp_Query(array(
			'post_type'        => 'rt-events',
			'posts_per_page'      => $settings['course_per'],
			'ignore_sticky_posts' => 1,
			'offset'              => $settings['offset'],
			'tax_query' => array(
			array(
				'taxonomy' => 'rt-event-category',
				'field'    => 'slug', //can be set to ID
				'terms'    =>  $cat//if field is ID you can reference by cat/term number
			),
		)
	));	  
}

		 	
while($best_wp->have_posts()): $best_wp->the_post();

$start_date    = get_post_meta( get_the_ID(), 'ev_start_date', true);
$ev_location   = get_post_meta( get_the_ID(), 'ev_location', true);
$ev_start_time = get_post_meta( get_the_ID(), 'ev_start_time', true);
$ev_end_time   = get_post_meta( get_the_ID(), 'ev_end_time', true);

$ev_location   = ($ev_location) ? $ev_location : '';
$ev_start_time = ($ev_start_time) ? $ev_start_time : '';
$ev_end_time   = ($ev_end_time) ? $ev_end_time : '';

$event_color      = get_post_meta(get_the_ID(), 'event_color', true);
$event_color_main = ($event_color) ? 'style = "color: '.$event_color.'"': '';
$event_bg         = ($event_color) ? 'style = "background: '.$event_color.'"': '';	
 
	if(!empty($settings['event_des'])){
        $limit = $settings['event_des'];
    }
    else{
        $limit = 20;
    }
?>	


<div class="event-item col-lg-<?php echo $settings['event_col']; ?> col-md-6">
	<div class="events-short">

		<?php if(!empty($settings['show_thum'])) { ?>
			<div class="featured-img">
				<a href="<?php the_permalink();?>"> <?php the_post_thumbnail($settings['thumbnail_size']);?></a>
				<?php if(!empty($settings['show_cates'])) { ?>
					<?php if( "tops" == $settings['cate_position'] ){ ?>
						<div class="categorie">
						    <?php echo get_the_term_list( $best_wp->ID, 'event-category', '', '  |  ' ); ?>	
						</div>
					<?php } ?>
				<?php } ?>
				<?php if( "tops" == $settings['meta_position'] ){ ?>
					<div class="dates">
						<?php echo $newDate = date("M j, Y", strtotime($start_date)); ?>  
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	    <div class="content-part">
	    	<?php if(!empty($settings['show_cates'])) { ?>
		    	<?php if( "tops" != $settings['cate_position'] ){ ?>
			    	<div class="categorie">
			    	    <?php echo get_the_term_list( $best_wp->ID, 'event-category', '', '  |  ' ); ?>	
			    	</div>
		    	<?php } ?>
	    	<?php } ?>	

	    	<h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	        <div class="time-sec">
	        	<?php if(!empty($settings['tims_event'])) { ?>
	        	<div class="timesec"><i class="fa flaticon-clock"></i> <?php echo wp_kses_post($ev_start_time); ?> -  
	        	<?php echo wp_kses_post($ev_end_time); ?> </div>
	        	<?php } ?>
		        <?php if(!empty($settings['add_event'])) { ?>
		        	<div class="address"><i class="fa fa-map-o"></i> <?php echo wp_kses_post($ev_location); ?></div>
		        <?php } ?>
	        </div>
	        
	        <?php if(($settings['event_content_show_hide'] == 'yes') ){ ?>
	            <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
	        <?php } ?>

	        <?php if(!empty($settings['show_btn'])) { ?>
		        <div class="event-btm">
			        <?php if(!empty($settings['show_meta'])) { ?>
			        	<?php if( "tops" != $settings['meta_position'] ){ ?>
				            <div class="date-part">
				                <div class="date">
				                	<i class="fa fa-calendar-check-o"></i><?php echo $newDate = date("M j, Y", strtotime($start_date)); ?>  
				                </div>
				            </div>
			        	<?php } ?>
			        <?php } ?>

			        <?php if($settings['show_btn'] == 'yes') { ?>
			            <div class="btn-part">
			                <a class="join-btn" href="<?php the_permalink(); ?>">
			                    <?php echo esc_html($settings['event_btn_text']);?>
			                </a>
			            </div>
			        <?php } ?>
			    </div>
		    <?php } ?>
		    <?php if(!empty($settings['tim_event'])) { ?>
		    <div class="time"><i class="fa flaticon-clock"></i> <?php echo wp_kses_post($ev_start_time); ?></div>
			<?php } ?>		    
	    </div>
	</div>
</div>


<?php
endwhile;
wp_reset_query();  
?>  
