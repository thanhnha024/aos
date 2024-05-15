<div class="swiper-slide">
    <div  class="single--item">
        <div class="content--box">
            <?php if(!empty($title)):?>
                <h2 class="slider-title"><?php echo wp_kses_post($title); ?></h2>
            <?php endif;?>
            <?php if(!empty($sub_title)):?>
                <p class="slider-subtitle">
					<?php echo wp_kses_post($sub_title); ?>
					<?php if(!empty($btn_text)):?>
						<a class="slider-btn" <?php echo esc_attr($target); ?> href="<?php echo esc_url($link); ?>"><?php echo wp_kses_post($btn_text); ?></a>
					<?php endif;?>
				</p>
            <?php endif;?>
        </div>
    </div>
</div>