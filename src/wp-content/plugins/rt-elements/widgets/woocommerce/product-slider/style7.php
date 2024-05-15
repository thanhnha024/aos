<?php 
    while ( $the_query->have_posts() ) : $the_query->the_post();
        global $product;
        $product = wc_get_product( get_the_ID() );  
        $is_feat = $product->is_featured();
        $rating      = $product->get_average_rating();
        ?>
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
                <div class="quick-action-btns">
                    <div class="cta-single cta-plus">
                        <i class="rt-plus"></i>
                    </div>
                    <div class="cta-single cta-quickview">
                        <?php if ( function_exists( 'YITH_WCQV_Frontend' ) && $weiboo_option['wc_quickview_icon']  ): ?>
							<a href="" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() );?>"><i class="far fa-eye"></i></a>
						<?php endif; ?>
                    </div>
                    <div class="cta-single cta-wishlist">
                        <?php if ( class_exists( 'YITH_WCWL_Shortcode' ) && $weiboo_option['wc_wishlist_icon'] ): ?>
							<?php
								$args = array(
									'browse_wishlist_text' => '<i class="fa fa-check"></i>',
									'already_in_wishslist_text' => '',
									'product_added_text' => '',
									'icon' => 'fa-heart-o',
									'label' => '',
									'link_classes' => 'add_to_wishlist single_add_to_wishlist alt wishlist-icon',
								);
							?>
							<?php echo YITH_WCWL_Shortcode::add_to_wishlist( $args );?>	
							<?php endif; ?>
                    </div>
                    <div class="cta-single product-btn cta-addtocart cart-icon-instedof-text">
                        <?php woocommerce_template_loop_add_to_cart();?>
                    </div>
                </div>
                <a href="<?php the_permalink() ?>">
                    <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                        echo get_the_post_thumbnail( get_the_ID(), 'weiboo-pcat' );
                    } else {
                        echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
                    } ?>
                </a>
            </div>
            <div class="rselements-product-list">
                <div class="star-box">
                    <?php weiboo_star_rating(['rating' => $rating ]); ?>
                </div>
                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <span class="product-price">
                    <?php echo $product->get_price_html(); ?>
                </span>
            </div>
            
        </div>
        <?php endwhile;  wp_reset_query();