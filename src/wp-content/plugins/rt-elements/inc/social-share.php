<?php

//Template for social share buttons
function weiboo_social_share_button(){

    $permalink  = get_the_permalink();
    $title      = get_the_title();
    $media      = urlencode( get_the_post_thumbnail_url( get_the_ID(), 'full'));
    $twitUser   = 'devmahbub';
    $facebook   = esc_url( 'https://www.facebook.com/sharer/sharer.php?u='.$permalink ) ;
    $pinterest  = esc_url( 'http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$media.'&amp;description='.$title );
    $twitter    = esc_url( 'http://twitter.com/share?text='.$title.'&amp;url='.$permalink.'&via='.$twitUser );
    $linkedin   = esc_url( 'https://www.linkedin.com/shareArticle?url='.$permalink.'&title='.$title );
    $tpTwt      = "<p class='weiboo-tooltip twt-colour'>Tweet This</p>";
    // Titles for tooltip
    $tpFB       = "<p class='weiboo-tooltip fb-colour'>".esc_html__( 'Share on Facebook', 'devmahbub' )."</p>";
    $tpTwt      = "<p class='weiboo-tooltip twt-colour'>".esc_html__( 'Tweet This', 'devmahbub' )."</p>";
    $tpIn       = "<p class='weiboo-tooltip in-colour'>".esc_html__( 'Share on Linkedin', 'devmahbub' )."</p>";
    $tpPin      = "<p class='weiboo-tooltip pin-colour'>".esc_html__( 'Pin It', 'devmahbub' )."</p>";
    // $showName = true;
?>

<div class="mx-auto p0 weiboo-social-share-btns">
    <h5 class="social-title d-inline-block"><?php esc_html_e( 'Share: ', 'weiboo' ); ?></h5>
    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tpPin; ?>">
        <div class="button-border social-btn-wrap d-inline-block mt-2 mx-auto">
            <a href="<?php echo $pinterest; ?>" class="pill-button pin-color social-tran text-dark w-100 text-center" target="_blank">
                 <i class="fab fa-pinterest-p"></i>
            </a>
        </div>  
    </div>  
    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tpIn; ?>">
        <div class="button-border social-btn-wrap d-inline-block mt-2 mx-auto">
            <a href="<?php echo $linkedin; ?>" class="pill-button in-color social-tran text-dark w-100 text-center" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>  
    </div>  
    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tpFB; ?>">
        <div class="button-border social-btn-wrap d-inline-block mt-2 mx-auto">
            <a href="<?php echo $facebook; ?>" class="pill-button fb-color social-tran text-dark w-100 text-center" target="_blank"><i class="fab fa-facebook-f"></i></a>
        </div>  
    </div>  
    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tpTwt; ?>">
        <div class="button-border social-btn-wrap d-inline-block mt-2 mx-auto">
            <a href="<?php echo $twitter;?>" class="pill-button twt-color social-tran text-dark w-100 text-center" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>  
    </div>  
</div>

<?php
}
add_action('woocommerce_share','weiboo_social_share_button');
