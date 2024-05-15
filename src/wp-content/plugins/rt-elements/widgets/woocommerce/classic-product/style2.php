<div class="row">
    <?php
        while ( $the_query->have_posts() ) : $the_query->the_post();
        global $product;
        $product = wc_get_product( get_the_ID() ); //set the global product object
        $rating  = $product->get_average_rating();
        $rcount   = $product->get_rating_count();
        
        ?>
        <div class="product-item classic-two col-lg-<?php echo esc_html($settings['rs_product_grid_column']);?> col-md-6 col-xs-1">
            <div class="item-box d-flex flex-column justify-content-center">
                <div class="product-img">
                    <?php if ( $product->is_on_sale() ) {
                        //  woocommerce_show_product_loop_sale_flash();
                        } ?>
                    <a href="<?php the_permalink() ?>">
                        <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                            echo get_the_post_thumbnail( get_the_ID(), 'weiboo-h5p-lg' );
                        } else {
                            echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                        } ?>
                    </a>
                </div>
                <div class="rselements-product-list">
                    <div class="star-box">
                        <?php weiboo_star_rating(['rating' => $rating]); ?>
                        <span><?php echo esc_html( '('.$rcount .' Reviews)'); ?></span>
                    </div> 
                    <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                    <div class="price-n-cart">
                        <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                </div>            
            </div>

        </div>
    <?php
        endwhile;
        wp_reset_query();
    ?>
</div>
