<?php
    global $weiboo_option; 
    $header_grid2         = "";
    $hide_foot_widgets    =''; 
    $footer_logo_size     = !empty($weiboo_option['footer-logo-height']) ? 'style="height: '.$weiboo_option['footer-logo-height'].'"' : '';

   if (is_home() && !is_front_page() || is_home() && is_front_page()){
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom2', true);
        $hide_foot_widgets =  get_post_meta(get_queried_object_id(), 'hide_foot_widgets', true);
        $footer_logo       =  get_post_meta(get_queried_object_id(), 'footer_logo_img', true);
    }else{
       $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom2', true);
       $hide_foot_widgets =  get_post_meta(get_queried_object_id(), 'hide_foot_widgets', true);
       $footer_logo       =  get_post_meta(get_queried_object_id(), 'footer_logo_img', true);
    }  
    
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($weiboo_option['header_grid2']) ? $weiboo_option['header_grid2'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }

require get_parent_theme_file_path('inc/footer/footer-options.php');

if( $footer_style != '' ) { 
    $footer_style_tech = new WP_Query(array(
            'post_type' => 'rts-footer',
            'posts_per_page' => -1,
            'p' => $footer_style,
     ));
    if ( $footer_style_tech->have_posts() ) {
        while ( $footer_style_tech->have_posts() ) : $footer_style_tech->the_post();
            the_content();
        endwhile;
        wp_reset_postdata();
    }
}

elseif( !empty($weiboo_option['footer_style'])){
    $footer_style = $weiboo_option['footer_style'];
    $footer_style = new WP_Query(array(
        'post_type' => 'rts-footer',
        'posts_per_page' => -1,
        'p' => $weiboo_option['footer_style'],
    )); 
    if ( $footer_style->have_posts() ) {
        while ( $footer_style->have_posts() ) : $footer_style->the_post();
            the_content();
        endwhile;
        wp_reset_postdata();
    }        
}
else{
     get_template_part( 'inc/footer/footer','bottom' ); 
}