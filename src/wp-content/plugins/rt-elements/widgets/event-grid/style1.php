<?php
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
$start_date       = get_post_meta( get_the_ID(), 'ev_start_date', true);
$ev_location       = get_post_meta( get_the_ID(), 'ev_location', true);
$ev_start_time    = get_post_meta( get_the_ID(), 'ev_start_time', true);
$ev_end_time   = get_post_meta( get_the_ID(), 'ev_end_time', true);
$ev_location = ($ev_location) ? $ev_location : '';

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
			</div>
		<?php } ?>
	    <div class="content-part">
	    	<?php if(!empty($settings['show_meta'])) { ?>
			            <div class="date-part">
			            	<span><?php echo $newDate = date('j', strtotime($start_date)); ?>  </span>
			                <div class="date">			                	
			                	<?php echo $newDate = date("M, Y", strtotime($start_date)); ?>  
			                </div>
			            </div>
			        <?php } ?>

	    	<?php if(!empty($settings['add_event']) || !empty($settings['tim_event'])) { ?>
	    		<div class="time-secs">
			    	
			    	<?php if(!empty($settings['tim_event'])) { ?>
				    <div class="time"><?php echo wp_kses_post($ev_start_time); ?> - <?php echo wp_kses_post($ev_end_time); ?></div>
					<?php } ?>
				</div>
			<?php } ?>

	    	<?php if(!empty($settings['show_cates'])) { ?>
	    	<?php if( "tops" != $settings['cate_position'] ){ ?>
		    	<div class="categorie">
		    	    <?php echo get_the_term_list( $best_wp->ID, 'event-category', '', '  |  ' ); ?>	
		    	</div>
	    	<?php } ?>
	    	<?php } ?>

	    	
	        <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	        
	        <?php if(!empty($settings['show_meta']) || !empty($settings['show_btn'])) { ?>
		        <div class="event-btm">
			        
			        <?php if(!empty($settings['add_event'])) { ?>
			    			<div class="address"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg><?php echo wp_kses_post($ev_location); ?> </div>
			 		<?php } ?>

			        <?php if($settings['show_btn'] == 'yes') { ?>
			            <div class="btn-part">
			                <a class="join-btn" href="<?php the_permalink(); ?>">
			                    <?php echo esc_html($settings['event_btn_text']);?>
			                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
			                </a>
			            </div>
			        <?php } ?>
			    </div>
		    <?php } ?>
		    
	    </div>
	</div>
</div>

<?php
endwhile;
wp_reset_query();  
?>  
