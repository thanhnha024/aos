<div class="swiper-slide"> 
    <div class="slider-content-area single--item">  
        
        <div class="content--box">
        <?php if(!empty($sub_title)):?>
                <p class="slider-subtitle"><?php echo wp_kses_post($sub_title); ?></p>
            <?php endif;?>
            <?php if(!empty($title)):?>
                <h2 class="slider-title"><?php echo wp_kses_post($title); ?></h2>
            <?php endif;?>
            <div class="desc"><?php echo $description;?></div>
           
            <?php if(!empty($btn_text)):?>
                <a class="slider-btn" <?php echo esc_attr($target); ?> href="<?php echo esc_url($link); ?>"><?php echo wp_kses_post($btn_text); ?></a>
            <?php endif;?>

        </div>
        <?php $img_gap = !empty($img_gap ) ? 'style="margin-right:'. $img_gap .'"' : '';?>
        <div  class="single--item-img">
                <img <?php echo $img_gap ; ?> src="<?php echo $image; ?>" alt="slide-img" />
        </div>
    </div>
</div> 