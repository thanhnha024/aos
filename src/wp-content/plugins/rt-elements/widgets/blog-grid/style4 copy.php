<div class="no-gutter blog-item reactheme-blog-grid1">                                                           
    <div class="image-part">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail($settings['thumbnail_size']); ?>
        </a> 
        <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
            <?php if(!empty($full_date)){ ?>
                <span class="date-full"><?php echo get_the_date('M d');?></span>
            <?php } ?>
        <?php } ?>
    </div>                             
    
    <div class="blog-content"> 
            <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                    <div class="cat_list">
                        <?php the_category( ); ?>
                    </div>
            <?php } ?>                                   
           
            
            <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
            <?php } ?>
            <?php if( !empty($settings['blog_meta_show_hide']) || !empty($settings['blog_avatar_show_hide'])){?>
            <ul class="blog-meta">                                            
                <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                    <?php if(!empty($post_admin)){ ?>
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <?php echo esc_html($post_admin);?></li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <?php } ?>
            <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
            <div class="btn-btm d-flex align-items-center justify-content-between">
                
                <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                    <div class="btn-part">
                        <a class="readon-arrow" href="<?php the_permalink(); ?>">
                            <?php echo esc_html($settings['blog_btn_text']);?> <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
         <?php } ?>

    </div>                                

</div>