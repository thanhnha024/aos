        </div><!-- .content -->
    </div><!-- .container -->
</div><!-- .main-container -->

<?php
global $weiboo_option;
require get_parent_theme_file_path('inc/footer/footer-options.php');
$header_grid2 = "";
$hide_footer  ='';
$hide_footer  =  get_post_meta(get_queried_object_id(), 'hide_footer', true);
if($hide_footer != 'yes'):
$footer_logo_size = !empty($weiboo_option['footer-logo-height']) ? 'style="height: '.$weiboo_option['footer-logo-height'].'"' : '';
if (is_home() && !is_front_page() || is_home() && is_front_page()){

    $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom2', true);
    $footer_logo       =  get_post_meta(get_queried_object_id(), 'footer_logo_img', true);
    
} else {
    $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom2', true);
    $footer_logo       =  get_post_meta(get_queried_object_id(), 'footer_logo_img', true);
}  
    
if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{  
    $header_width = !empty($weiboo_option['header-grid2']) ? $weiboo_option['header-grid2'] : '';
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}
$footer_gap = '';
if($hide_footer_subscribe != 'yes'  && is_active_sidebar( 'footer_top') ){
    $footer_gap = 'reactheme-footer-top-gap';
}
$footer_style_option = !empty($weiboo_option['footer_style']) ? $weiboo_option['footer_style'] : '';
$footer_class = '';
if( $footer_style == 'footer2' || $footer_style_option == 'style2'  ){
    $footer_class = 'footer-style-2';
}
if( $footer_style == 'footer3' || $footer_style_option == 'style3'  ){
    $footer_class = 'footer-style-3';
}

$footer_select = !empty($footer_select) ? $footer_select : '';

if(!empty( $footer_bg_img)):?>
    <footer id="reactheme-footer" class="ff <?php echo esc_attr($footer_select);?> reactheme-footer footer-style-1 <?php echo esc_attr($footer_class);?> <?php echo esc_attr($footer_gap); ?>" style="background-image: url('<?php echo esc_url($footer_bg_img); ?>'); <?php if (!empty($footer_bg_pos)): ?> background-position: <?php echo esc_attr($footer_bg_pos); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg_rep)): ?> background-repeat: <?php echo esc_attr($footer_bg_rep); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg_sizes)): ?> background-size: <?php echo esc_attr($footer_bg_sizes); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg)): ?> background-color: <?php echo esc_attr($footer_bg) ?> <?php endif; ?>">

<?php elseif(!empty( $footer_bg)):?>
    <footer id="reactheme-footer" class="<?php echo esc_attr($footer_select);?> reactheme-footer footer-style-1 <?php echo esc_attr($footer_class);?> <?php echo esc_attr($footer_gap); ?>" style="background: <?php echo esc_attr($footer_bg);?> !important; <?php if (!empty($footer_bg_rep)): ?> background-repeat: <?php echo esc_attr($footer_bg_rep); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg_sizes)): ?> background-size: <?php echo esc_attr($footer_bg_sizes); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg_pos)): ?> background-position: <?php echo esc_attr($footer_bg_pos);?> !important; <?php endif; ?>">

<?php elseif( !empty( $weiboo_option['footer_bg_image']['url'])):?>
    <footer id="reactheme-footer" class="<?php echo esc_attr($footer_select);?> reactheme-footer footer-style-1 <?php echo esc_attr($footer_class);?> <?php echo esc_attr($footer_gap); ?>" style="background-image: url('<?php echo esc_url($weiboo_option['footer_bg_image']['url']);?>'); <?php if (!empty($footer_bg_rep)): ?> background-repeat: <?php echo esc_attr($footer_bg_rep); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg_sizes)): ?> background-size: <?php echo esc_attr($footer_bg_sizes); ?> !important; <?php endif; ?> <?php if (!empty($footer_bg_pos)): ?> background-position: <?php echo esc_attr($footer_bg_pos); ?> !important; <?php endif; ?>">
    <?php else:?>
        <footer id="reactheme-footer" class="<?php echo esc_attr($footer_select);?> reactheme-footer footer-style-1 <?php echo esc_attr($footer_class);?> <?php echo esc_attr($footer_gap); ?>" >
<?php
endif; ?>
<?php 
 get_template_part( 'inc/footer/footer','top' ); 

?>


</footer>
<?php endif; ?>
</div><!-- #page -->
<?php 
if(!empty($weiboo_option['show_top_bottom'])){
?>
 <!-- start top-to-bottom  -->
<div id="top-to-bottom">
    <i class="rt-angles-up"></i>
</div>   
<?php } 
 wp_footer(); ?>
  </body>
</html>
