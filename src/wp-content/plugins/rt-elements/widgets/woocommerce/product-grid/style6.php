<?php
    $col = $settings['rs_product_grid_column'];
    if( $col =='12' ){
        $col = 'col-lg-12';
    }else{
        $col = 'col-lg-12 col-md-6 col-xs-1';
    }
    while ( $the_query->have_posts() ) : $the_query->the_post();
    global $product;
    $product = wc_get_product( get_the_ID() ); //set the global product object ?>
    <div class="product-item product-style-two <?php echo esc_attr($col);?>">
        <div class="product-inner">
            <div class="product-img">
                <?php if ( $product->is_on_sale() ) {
                        woocommerce_show_product_loop_sale_flash();
                    } ?>
                <a href="<?php the_permalink() ?>">
                    <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                        echo get_the_post_thumbnail( get_the_ID(), 'large' );
                    } else {
                        echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                    } ?>
                </a>
            </div>
            <div class="rselements-product-list">
                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <div class="price-n-cart">
                    <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                    <div class="product-btn">
                        <?php woocommerce_template_loop_add_to_cart();?>
                    </div>
                </div>
            </div>            
        </div>

    </div>
<?php endwhile;
wp_reset_query();