<?php
wp_head();
global $weiboo_option;?>
<div class="page-error">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <?php if (!empty($weiboo_option['404_bg']['url'])) {?>
                            <img class="error-image"  src="<?php echo esc_url($weiboo_option['404_bg']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <?php }?>
                        <h2>
                            <span>
                                <?php
                                    if (!empty($weiboo_option['title_404'])) {
                                        echo esc_html($weiboo_option['title_404']);
                                    } else {
                                        echo esc_html__('404', 'weiboo');
                                    }
                                ?>
                            </span>
                            <?php
                                if (!empty($weiboo_option['text_404'])) {
                                    echo esc_html($weiboo_option['text_404']);
                                } else {
                                    echo esc_html__('Opps! Page not found', 'weiboo');
                                }
                            ?>
                        </h2>
                        <h3>
                            <?php echo esc_html__("Sorry, we couldn't find the page you where looking for. We suggest that you return to homepage.", 'weiboo'); ?>
                        </h3>
                        <a class="reacbutton" href="<?php echo esc_url(home_url('/')); ?>"><i class="rt-arrow-left-long"></i>
                            <?php
                                if (!empty($weiboo_option['back_home'])) {
                                    echo esc_html($weiboo_option['back_home']);
                                } else {
                                    esc_html_e('Or back to homepage', 'weiboo');
                                }
                            ?>
                        </a>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div> <!-- .page-error -->
<?php
wp_footer();
