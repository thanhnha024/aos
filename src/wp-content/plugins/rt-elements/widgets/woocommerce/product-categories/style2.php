<?php
    $pcat_image = wp_get_attachment_image_src($thumbnail_id, 'weiboo-pcat')[0];
?>
<div class="product-item swiper-slide">
    <div class="pcat-single">
        <div class="pcat-img">						
            <a href="<?php echo esc_url($pcat_link) ; ?>">
                <img src="<?php echo esc_url($pcat_image) ; ?>" width="338" height="450" alt="Product Categories">
            </a>
        </div>
        <div class="pcat-desc">
            <?php
                if($desc){
                    echo esc_html($desc) ;
                }else{
                    echo esc_html($name) ;
                }
            ?>
        </div>
        <div class="pcat-info">
            <p class="pcat-count">
                <?php echo wp_kses_post($count.' <span> '.$item_text.'</span>'); ?>
            </p>
        </div>                        
    </div>
</div>