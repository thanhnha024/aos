<?php 
    while ( $the_query->have_posts() ) : $the_query->the_post();
        global $product;
        $is_feat = $product->is_featured();
        $product = wc_get_product( get_the_ID() ); //set the global product object ?>
        <div class="product-item swiper-slide">
            <div class="product-img">
                <div class="sale--box">
                        <?php
                        if ( $product->is_on_sale() )  {    
                            woocommerce_show_product_loop_sale_flash();
                        }
                        $is_new = weiboo_is_recent_post();
                        if ($is_new){
                            ?> <span class="new"><?php esc_html_e( 'NEW', 'rtelemenets' ); ?></span>  <?php
                        }
                        if( $is_feat ){
                            ?> <span class="hot"><?php esc_html_e( 'HOT', 'rtelemenets' ); ?></span>  <?php
                        }
                        ?>
                    </div>	
                <a href="<?php the_permalink() ?>">
                    <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                        echo get_the_post_thumbnail( get_the_ID(), 'shop_single' );
                    } else {
                        echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                    } ?>
                </a>
            </div>
            <div class="rselements-product-list">
                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <div class="price--cart">
                    <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                    <div class="product-btn">
                       <?php woocommerce_template_loop_add_to_cart();?>
                    </div>
                </div>
            </div>
            
        </div>
        <?php endwhile;  wp_reset_query();