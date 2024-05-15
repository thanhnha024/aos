<?php
    if (is_home() && !is_front_page() || is_home() && is_front_page()){

        $footer_type = get_post_meta(get_queried_object_id(), 'footer_select', true);
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
        if ($header_width_meta != ''){
            $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
        }else{            
            $header_width = !empty($weiboo_option['header-grid']) ? $weiboo_option['header-grid'] : '';
            $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
        }
        $footer_style          = get_post_meta(get_queried_object_id(), 'footer_style', true);
        $footer_bg             = get_post_meta(get_queried_object_id(),'footer_bg', true);
        $footer_bg_img         = get_post_meta(get_queried_object_id(),'footer_bg_img', true);
        $hide_footer_subscribe = get_post_meta(get_queried_object_id(), 'hide_footer_subscribe', true);
        $newsletter_bg_img     = get_post_meta(get_queried_object_id(), 'newsletter_bg_img', true);
        $copyright_bg          = get_post_meta(get_queried_object_id(),'copyright_bg', true);
        $copyright_trans       = get_post_meta(get_queried_object_id(),'copyright_trans', true);
        $bg_pos                = get_post_meta(get_queried_object_id(),'footer_bg_position', true);
        $bg_repeat             = get_post_meta(get_queried_object_id(),'footer_bg_repeat', true);
        $bg_size               = get_post_meta(get_queried_object_id(),'footer_bg_size', true);
        $copy_space            = get_post_meta(get_queried_object_id(),'copyright_padding', true);
        $copy_trans            = ($copyright_trans=="yes") ? 'transparent' : '';
        $footer_bg_img         = ($footer_bg_img) ? $footer_bg_img : '';
        $newsletter_bg_img     = ($newsletter_bg_img) ? $newsletter_bg_img : '';
        $hide_footer_subscribe = ($hide_footer_subscribe) ? $hide_footer_subscribe : '';
        $footer_bg_pos         = ($bg_pos) ? $bg_pos : '';
        $footer_bg_rep         = ($bg_repeat) ? $bg_repeat : '';
        $footer_bg_sizes       = ($bg_size) ? $bg_size : '';
        $footer_bg             = ($footer_bg) ? $footer_bg : '';
        $footer_select         = get_post_meta(get_queried_object_id(),'footer_select', true);
        $footer_select         = ($footer_select) ? $footer_select : '';
        $footer_style          = get_post_meta(get_queried_object_id(),'footer_style', true);

    } else {
        $footer_type = get_post_meta(get_queried_object_id(), 'footer_select', true);
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
        if ($header_width_meta != ''){
            $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
        }else{
            $header_width = !empty($weiboo_option['header-grid']) ? $weiboo_option['header-grid'] : '';
            $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
        }

        $footer_bg             = get_post_meta(get_queried_object_id(),'footer_bg', true);
        $footer_bg_img         = get_post_meta(get_queried_object_id(),'footer_bg_img', true);
        $newsletter_bg_img     = get_post_meta(get_queried_object_id(), 'newsletter_bg_img', true);
        $hide_footer_subscribe = get_post_meta(get_queried_object_id(), 'hide_footer_subscribe', true);
        
        $copyright_bg          = get_post_meta(get_queried_object_id(),'copyright_bg', true);
        $copyright_trans       = get_post_meta(get_queried_object_id(),'copyright_trans', true);
        $bg_pos                = get_post_meta(get_queried_object_id(),'footer_bg_position', true);
        $bg_repeat             = get_post_meta(get_queried_object_id(),'footer_bg_repeat', true);
        $bg_size               = get_post_meta(get_queried_object_id(),'footer_bg_size', true);
        $copy_space            = get_post_meta(get_queried_object_id(),'copyright_padding', true);
        $copy_trans            = ($copyright_trans=="yes") ? 'transparent' : '';
        $footer_bg_img         = ($footer_bg_img) ? $footer_bg_img : '';
        $newsletter_bg_img     = ($newsletter_bg_img) ? $newsletter_bg_img : '';
        $hide_footer_subscribe = ($hide_footer_subscribe) ? $hide_footer_subscribe : '';
        $footer_bg_pos         = ($bg_pos) ? $bg_pos : '';
        $footer_bg_rep         = ($bg_repeat) ? $bg_repeat : '';
        $footer_bg_sizes       = ($bg_size) ? $bg_size : '';
        $footer_bg             = ($footer_bg) ? $footer_bg : '';   
        $footer_style          = get_post_meta(get_queried_object_id(),'footer_style', true);        
}  
