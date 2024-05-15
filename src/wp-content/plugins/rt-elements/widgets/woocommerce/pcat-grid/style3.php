<div class="rtpcat2 rtpcat-style3 mt-5">
    <div class="rts-product-category-section section-gap">
        <div class="container">
            <div class="row">

                <?php
                $tcat = count($pcats);
                $xx = 1;
                foreach( $pcats as $pcat ) {
                    $catObj = get_term_by('slug', $pcat, 'product_cat');
                    $term_id = $catObj->term_id;
                    // get the thumbnail id using the category term_id
                    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                    $pcat_image_el = wp_get_attachment_image_src($thumbnail_id, 'large');
                    if($pcat_image_el){
                        $pcat_image = $pcat_image_el[0];
                    }else{
                        $pcat_image = '';
                    }

                    $pcat_bg = get_term_meta( $term_id, 'pcat_grid_bg', true );
                    if( !(empty($pcat_bg)) ){
                        $pcat_single_bg = 'style="background-color: '.$pcat_bg.';"';
                    }else{
                        $pcat_single_bg = '';
                    }
                    $pcat_btnc = get_term_meta( $term_id, 'pcat_grid_btn_color', true );
                    if( !(empty($pcat_btnc)) ){
                        $cta_btn_color = 'style="color: '.$pcat_btnc.';"';
                        $cta_btn_hover_bg = 'style="background-color: '.$pcat_btnc.';"';
                    }else{
                        $cta_btn_color = '';
                        $cta_btn_hover_bg = '';
                    }


                    $name   = $catObj->name;
                    $desc   = $catObj->description;
                    $count  = $catObj->count;
                    $img    = $catObj->name;
                    $pcat_link = get_term_link( $pcat, 'product_cat' );
                    if( $tcat == 8 ){


                        if( $xx == 1 ){
                            ?>
                            <div class="col-xl-2">
                                <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-vertical d-block">
                                    <div class="product-thumb">
                                        <img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image">
                                    </div>
                                    <div class="contents">
                                        <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                        <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                        <div class="icon"><i class="rt-arrow-right-long"></i></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-8">
                                <div class="row">                        
    
                            <?php            
                        } elseif(  $xx == 8  ){
    
                            ?>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-vertical product-item-bg">
                                    <div class="product-thumb"><img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image"></div>
                                    <div class="contents">
                                        <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                        <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                    </div>
                                </a>
                            </div>                        
                            
                            <?php
                        }else{
                            ?>
                            <div class="col-xl-4 col-md-6 col-sm-6">
                                <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-horizontal">
                                    <div class="product-thumb"><img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image"></div>
                                    <div class="contents">
                                        <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                        <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                    </div>
                                </a>
                            </div>                        
                            
                            <?php            
                        }


                    }else{
                        ?>
                        <div class="col-xxl-20p col-md-4 col-sm-6">
                            <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-horizontal">
                                <div class="product-thumb"><img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image"></div>
                                <div class="contents">
                                    <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                    <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                </div>
                            </a>
                        </div>                        
                        
                        <?php
                    }

                    $xx++;
                }
                    ?>  
                
            </div>
        </div>
    </div>
</div>
