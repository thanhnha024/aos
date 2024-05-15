<div class="classic-product">
        <div class="row">

<?php
    
    $unique = rand(200,35120);
    $unique2 = $unique + 100;
    $x= 1;
    while ( $the_query->have_posts() ) : $the_query->the_post();
    global $product;
    $post_id = get_the_ID();    
    $product = wc_get_product( $post_id );
    $rating  = $product->get_average_rating();
    $rcount   = $product->get_rating_count();
    $rating_html =  wc_get_rating_html( $product->get_average_rating() );
    $is_feat = $product->is_featured();
    $featID = get_post_thumbnail_id();
    $p2ndImg        = get_post_meta( get_the_ID(), 'rt_product_2nd_img_id', true );
    $gallery = $product->get_gallery_image_ids();

    $all_img = [];
    if($featID){
        $all_img []= $featID;
    }
    if($gallery){
        $all_img = array_merge($all_img, $gallery);
    }
    if($p2ndImg){
        $all_img []= (int)$p2ndImg;
    }
    $img_count =  count($all_img);
    if( $img_count > 4 ){
        $img_count = 4;
    }

    $imgLink = wp_get_attachment_image_src($featID, 'large')[0];

    if($x % 2 == 0){
        ?>
            <div class="col-lg-4 col-mb-6">
                <div class="second-product">
                    <div class="feature-img">
                        <img src="<?php echo esc_url($imgLink); ?>" alt="">
                    </div>
                    <div class="pdetails">
                        <div class="row">
                            <div class="col-10">
                                <div class="product_cats">
                                    <?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ' ); ?>
                                </div>
                                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                <span class="product-price"><?php echo $product->get_price_html(); ?></span>    
                            </div>
                            <div class="col-2 px-0 d-flex align-items-center">
                                <div class="product-cart cart-icon-instedof-text">
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

        <?php
    }else{
        ?>
            <div class="col-lg-8 col-mb-6">
                <div class="row first-product align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-sm-3 hidden-m">
                                <div thumbsSlider="" class="swiper fix-thumb-slider classicThumb-<?php echo esc_attr( $unique); ?>">
                                <div class="swiper-wrapper">

                                    <?php
                                    foreach( $all_img as $pimage ){
                                        $link = wp_get_attachment_image_src($pimage, 'large')[0];
                                        ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo $link;?>" alt="">
                                        </div>
                                        <?php
                                    }						
                                    ?>

                                </div>
                                </div>
                            </div>   
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff;" class="swiper classicp-style classicProduct-<?php echo esc_attr( $unique2); ?>">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach( $all_img as $pimage ){
                                        $link = wp_get_attachment_image_src($pimage, 'large')[0];
                                        ?>
                                        <div class="swiper-slide d-flex align-items-center" style="height: 470px; ">
                                            <img src="<?php echo $link;?>" alt="">
                                        </div>
                                        <?php
                                    }						
                                    ?>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 pinfo">
                        <div class="star-box">
                                <?php weiboo_star_rating(['rating' => $rating]); ?>
                                <span><?php echo esc_html( '('.$rcount .' Reviews)'); ?></span>
                        </div> 
                        <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        <div class="product-price"><?php echo $product->get_price_html(); ?></div>
                        <div class="product-cart">
                            <i class="rt-cart-shopping"></i>
                            <?php woocommerce_template_loop_add_to_cart();?>
                        </div>

                    </div>
                </div>

            </div>

            <script>
                var swiper<?php echo esc_attr( $unique); ?> = new Swiper(".classicThumb-<?php echo esc_attr( $unique); ?>", {
                loop: true,
                direction: "vertical",
                spaceBetween: 10,
                slidesPerView: <?php echo esc_attr( $img_count); ?>,
                freeMode: true,
                watchSlidesProgress: true
                });
                var swiper<?php echo esc_attr( $unique2); ?> = new Swiper(".classicProduct-<?php echo esc_attr( $unique2); ?>", {
                loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                thumbs: {
                    swiper: swiper<?php echo esc_attr( $unique); ?>
                }
                });
            </script>

        <?php

    }
    $x++;
    $unique++;
    $unique2++;
    ?>

    <?php endwhile;  wp_reset_query();?>
    </div>
</div>


