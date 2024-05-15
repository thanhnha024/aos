<div class="product-item swiper-slide">
    <div class="pcat-single">
        <div class="pcat-img">						
            <a href="<?php echo esc_url($pcat_link) ; ?>">
                <img src="<?php echo esc_url($pcat_image) ; ?>" width="337" height="340" alt="Product Categories">
            </a>
        </div>
        <div class="pcat-info">
            <p class="pcat-count">
                <?php echo esc_html($count.' '.$item_text); ?>
            </p>
            <h4 class="pcat-title">
                <a href="<?php echo esc_url($pcat_link) ; ?>"><?php echo esc_html($name) ; ?>
                    <i class="rt-arrow-right-long"></i>
                </a>
            </h4>
        </div>                        
    </div>
</div>