<?php 

    $btn_text = $settings['pcat_btn_text'];
    $deal_text = $settings['pcat_deal_text'];

    while ( $the_query->have_posts() ) : $the_query->the_post();
        global $product;
        $rating  = $product->get_average_rating();
        $count   = $product->get_rating_count();
        $review_text =  $count == 1 ? 'Review' : 'Reviews';
        $thumb_id = get_post_thumbnail_id();
        $thumb_link = wp_get_attachment_image_src($thumb_id, 'full')[0];

        $product = wc_get_product( get_the_ID() ); ?>
        <div class="product-item swiper-slide">
            <div class="pslider-wrap">
                <div class="row pslider-row">
                    <div class="col-xl-6 col-lg-6 col-md-6 pslider-content">
                        <div class="pslide-content-box">

                        <?php
                        if( !(empty($deal_text)) ){
                            echo wp_kses_post('<p class="p-subtitle">'.$deal_text.'</p>');
                        }
                        ?>
                            <h1 class="p-title"><?php the_title(); ?></h1>
                            
                            <div class="rating-btn d-flex">
                            <?php
                                if( !(empty($deal_text)) ){
                                    ?>
                                    <div class="sbtn">
                                        <a class="p-btn" href="<?php the_permalink() ?>"> <?php echo wp_kses_post($btn_text); ?> </a>
                                    </div>
                                    <?php
                                }
                            ?>
                                <div class="ratings">
                                    <?php weiboo_star_rating(['rating'=> $rating]) ?>
                                   <?php echo wp_kses_post('<p class="review-count"><span>'.$count.' </span>'.$review_text.'</p>'); ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 product-image-position"><?php the_post_thumbnail();?></div>
                </div>
            </div>
        </div>
<?php endwhile;  wp_reset_query();