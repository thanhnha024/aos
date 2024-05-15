<?php
    while ( $the_query->have_posts() ) : $the_query->the_post();
    $post_id = get_the_ID();
    $product = wc_get_product( $post_id );
    global $product;

    //$product = wc_get_product( get_the_ID() ); //set the global product object

    // The product average rating (or how many stars this product has)
    $arating = $product->get_average_rating();
    $is_feat = $product->is_featured();
    // The product stars average rating html formatted.
    $termsc = get_the_terms( $product->get_id(), 'product_cat' );
    $terms = get_the_terms( $product->get_id(), 'product_visibility' );


    $stock = '';
    $Qstock = $product->get_stock_quantity();
    $backorder = $product->backorders_allowed();
    $status = $product->get_stock_status();

    // 'onbackorder' , 'outofstock' , 'instock'
    
    if( $status == 'instock' ){
        $stock = 'In Stock';
    } elseif( $status == 'onbackorder' ){
        $stock = '<i class="rt-check"></i> Backorders';
    } elseif( $status == 'outofstock' ){
        $stock = 'Out Of Stock';
    }else{
        $stock = '';
    }


    ?>
    <div class="product-item pstyle4 col-xxl-<?php echo esc_html($settings['rs_product_grid_column']);?> col-md-6 col-xs-1">
        <div class="item-wrap">
            <div class="rating-stock d-flex justify-content-between align-items-center">
                <div class="ratings">
                    <?php weiboo_star_rating(['rating' => $arating]); ?>
                </div>
                <div class="instock">
                    <?php echo wp_kses_post($stock); ?>
                </div>
            </div>
            <div class="item-inner">
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
                            echo get_the_post_thumbnail( get_the_ID(), 'weiboo-h5p-sm' );
                        } else {
                            echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                        } ?>
                    </a>
                </div>
                <div class="rselements-product-list">
                    <div class="product_cats">
                        <?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ' ); ?>
                    </div>
                    <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                    <div class="price-wish d-flex justify-content-between align-items-center">
                        <div class="price">
                            <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                        </div>
                        <div class="add-wish">
                            <!-- <i class="far fa-heart"></i> -->
                            <div class="weiboo-wishlist">
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

                        </div>                
                    </div>
                </div>                
            </div>
            <div class="cart-view  d-flex justify-content-between align-items-center">
                <div class="product-btn">
                    <i class="rt-basket-shopping"></i>
                    <?php woocommerce_template_loop_add_to_cart();?>
                </div>
                <div class="quick-view">
                    <div class="weiboo-quick">
                        <?php if ( function_exists( 'YITH_WCQV_Frontend' ) && $weiboo_option['wc_quickview_icon']  ): ?>
                            <a href="" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() );?>"><i class="far fa-eye"></i></a>
                        <?php endif; ?>
                    </div>
                </div>    
            </div>

        </div>

    </div>
<?php endwhile;
wp_reset_query();

