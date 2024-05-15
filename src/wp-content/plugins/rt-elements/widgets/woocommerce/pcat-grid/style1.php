
<div class="rt-pcat-grid">
    <div class="rt_widget_pcat_grid">
        <div class="row">
            <?php
            foreach($pcats as $pcat ) {
                $catObj = get_term_by('slug', $pcat, 'product_cat');
                $term_id = $catObj->term_id;
                // get the thumbnail id using the category term_id
                $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                $icon_id = get_term_meta( $term_id, 'rt_pcat_icon_id', true );               
                // get the image URL
                $pcat_image = wp_get_attachment_image_src($thumbnail_id, 'large')[0];
                $pcat_icon = wp_get_attachment_image_src($icon_id, 'large')[0];             
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
                $icon_image = get_term_meta( $term_id, 'rt_pcat_image', true );
                ?>
                    <div class="product-item col-xl-3 px-2">
                        <div class="pcat-single" <?php echo $pcat_single_bg; ?>>
                            <div class="pcat-info">
                                <img class="icon-image" src="<?php echo esc_url($pcat_icon) ; ?>" width="337" height="340" alt="Product Categories">
                                <h4 class="pcat-title">
                                    <a href="<?php echo esc_url($pcat_link) ; ?>"><?php echo wp_kses_post(nl2br($desc)) ; ?></a>
                                </h4>
                                <div class="cat-image-style-1">
                                    <img class="cat-image" src="<?php echo esc_url($icon_image);?>" atl="cat-iamge">
                                </div>
                                <p class="pcat-count" <?php echo $cta_btn_color; ?>>
                                <?php echo esc_html($count.' '.$item_text); ?>
                                </p>
                                <a class="cta-btn" <?php echo $cta_btn_color; ?> href="<?php echo esc_url($pcat_link) ; ?>"><?php echo esc_html($btn_text); ?></a>
                                <a class="cta-btn cta-btn-hover" <?php echo $cta_btn_hover_bg; ?> href="<?php echo esc_url($pcat_link) ; ?>"><?php echo esc_html($btn_text); ?></a>
                            </div> 
                            <div class="pcat-img">						
                                <a href="<?php echo esc_url($pcat_link) ; ?>">
                                    <img class="cat-image" src="<?php echo esc_url($pcat_image) ; ?>" width="337" height="340" alt="Product Categories">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>
</div>