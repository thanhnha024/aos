<?php
    $url = plugin_dir_url( __FILE__ );

    $best_wp = new wp_Query(array(
            'post_type'      => 'rt-testimonials',
            'posts_per_page' => $settings['per_page'],
    ));

    while($best_wp->have_posts()): $best_wp->the_post();
        $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

        $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';
        
    ?>                           
        
    <div class="testimonial-item swiper-slide <?php echo esc_attr( $settings['align'] );?>
        <?php echo esc_attr($settings['title_position']);?>">
       
        <div class="testimonial-item-elements">
            <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                <div class="ratings">
                    <?php weiboo_star_rating([ 'rating' => $ratings ]); ?>
                </div>
            <?php endif;?> 


            <?php if('top' == $settings['title_position']) {?>   
                
                

            <div class="testimonial-content">                                   
                <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                    <div class="image-wrap">                                    
                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>                                                   
                    </div>
                <?php endif;?>                     
                    
            </div>                           

            <div class="item-content <?php echo esc_attr($settings['_design']);?>"> 
                <div class="testimonial-information">
                            
                            <?php if(get_the_title()):?>                         
                                <div class="testimonial-name"><?php the_title();?></div>
                            <?php endif;?>
                            <?php if( $designation ):?>
                                <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                            <?php endif; ?>
                        </div>
                <?php if(!empty($settings['icon'])){
                    ?>
                    <span><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
                    <?php
                }
                    the_content();
                
                ?>  
            </div>  
    <?php }?> 
            <?php if('bottom' == $settings['title_position']) {
                
                ?>                               
                <div class="testimonial-content ">                                   
                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                        <div class="image-wrap">                                    
                            <?php the_post_thumbnail($settings['thumbnail_size']); ?>                                                   
                        </div>
                    <?php endif;?>  

                    <?php
                        if($settings['review_quote_image']){
                            ?>
                            <img src="<?php echo esc_url($settings['review_quote_image']['url']);?>" alt="Quote icon" class="quote--icon">
                            <?php
                        }
                        ?>

                    <?php the_content(); ?>
                    
                        <div class="testimonial-information">
                            
                            <?php if(get_the_title()):?>                         
                                <div class="testimonial-name"><?php the_title();?></div>
                            <?php endif;?>
                            <?php if( $designation ):?>
                                <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                            <?php endif; ?>
                        </div>
                
                </div>
        <?php }?>                       
        </div>
    </div>
        
    <?php   
    endwhile;
    wp_reset_query();  
    ?>  