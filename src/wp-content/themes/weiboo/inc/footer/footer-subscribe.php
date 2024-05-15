<?php 
global $weiboo_option; 
require get_parent_theme_file_path('inc/footer/footer-options.php');
if($hide_footer_subscribe != 'yes'){
if(!empty($weiboo_option['call_tilte']) || !empty($weiboo_option['call_des'])){?>


<?php 
    $call_to_bg_show = !empty( $weiboo_option['call_to_bg']['url']) ? 'style="background:url('.$weiboo_option['call_to_bg']['url'].')"' : '';
    $icon_width        = !empty($weiboo_option['icons_to_d_size']) ? 'style = "max-width: '.$weiboo_option['icons_to_d_size'].'"' : '';

    $news_title_icon   =  get_post_meta(get_queried_object_id(), 'newsletter_title_icon_img', true);
?>


<?php if(is_active_sidebar('footer_top')) { ?>
    <div class="reactheme-newsletter reactheme-newsletters">
        <div class="container">
                <?php if(!empty( $newsletter_bg_img)): ?>
                <div class="newsletter-wrap" style="background-image: url('<?php echo esc_url($newsletter_bg_img); ?>');">
                <?php else:?> 
                <div class="newsletter-wrap" <?php echo wp_kses( $call_to_bg_show, 'weiboo');?>> 
                <?php endif; ?>
                <div class="row y-middle">
                    <div class="col-lg-6">
                        <div class="sec-title">                           

                            <?php if(!empty($weiboo_option['call_tilte'])){?>
                            <div class="title-icon">  
                                <?php if($news_title_icon !=''){ ?>                              
                                
                                <img <?php echo wp_kses($icon_width, 'weiboo');?> src="<?php echo esc_url($news_title_icon); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                                
                                <?php } else { 
                                    if (!empty( $weiboo_option['icons_to_d']['url'] ) ) { ?>
                                    <img <?php echo wp_kses($icon_width, 'weiboo');?> src="<?php echo esc_url( $weiboo_option['icons_to_d']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                                <?php } } ?>

                                <h2 class="title" style="color:<?php echo wp_kses($weiboo_option['call_tilte_color'], 'weiboo'); ?>"><?php echo wp_kses($weiboo_option['call_tilte'], 'weiboo'); ?></h2>
                            </div>
                            <?php } ?>

                            <?php if(!empty($weiboo_option['call_des'])){?>
                            <div class="sub-title" style="color:<?php echo wp_kses($weiboo_option['call_des_color'], 'weiboo'); ?>"><?php echo wp_kses($weiboo_option['call_des'],'weiboo'); ?></div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?php if ( is_active_sidebar( 'footer_top' )):
                            dynamic_sidebar( 'footer_top' );
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }}} ?>