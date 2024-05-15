<?php
    $col = $settings['rs_product_grid_column'];
    $border = 1;
    while ( $the_query->have_posts() ) : $the_query->the_post();
    global $product;
    $product = wc_get_product( get_the_ID() );
    $rating      = $product->get_average_rating(); 
    if($border <= 6){
        $bottom  = 'border-bottom';
    }else{
        $bottom = '';
    }
    ?>

    <div class="product-item col-lg-<?php echo esc_html($settings['rs_product_grid_column']);?> col-md-6 col-xs-1 <?php echo esc_attr($bottom);?>">
        <div class="wraper">
            <div class="image-section">
            <a href="<?php the_permalink() ?>">
                <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                    echo get_the_post_thumbnail( get_the_ID(), 'shop_single' );
                } else {
                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                }?>
            </a>
            </div>
            <div class="content">                
                
                <?php weiboo_star_rating(['rating' => $rating ]); ?>                
                
                 <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                 <span class="product-price"><?php echo $product->get_price_html(); ?></span>
            </div>
        </div>
    </div>
<?php $border++ ;endwhile;
wp_reset_query();