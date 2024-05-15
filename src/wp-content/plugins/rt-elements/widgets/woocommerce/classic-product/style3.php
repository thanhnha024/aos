<?php
    while ( $the_query->have_posts() ) : $the_query->the_post();
    global $product;
    $product = wc_get_product( get_the_ID() ); //set the global product object ?>
    <div class="product-item classic-three col-lg-<?php echo esc_html($settings['rs_product_grid_column']);?> col-md-6 col-xs-1">
        <div class="item-box">
            <div class="product-img">
                <a href="<?php the_permalink() ?>">
                    <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                        echo get_the_post_thumbnail( get_the_ID(), 'large' );
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
                <span class="product-price"><?php echo $product->get_price_html(); ?></span>
            </div>
        </div>
    </div>
<?php endwhile;
wp_reset_query();
