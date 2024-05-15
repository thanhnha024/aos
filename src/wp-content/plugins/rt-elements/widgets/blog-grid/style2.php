<div class="row align-items-center no-gutter blog-item reactheme-blog-grid1">                    
    <?php if($x%2==1){?>    
        <div class="col-md-6 1">
            <div class="image-part">
                <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="blog-content">
            
               <?php if( !empty($settings['blog_meta_show_hide']) || !empty($settings['blog_avatar_show_hide'])){?>
                <ul class="blog-meta">
                    <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                        <?php if(!empty($blog_date)){ ?>
                        <li><i class="fa fa-calendar-check-o"></i> <?php echo esc_html($blog_date);?></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                        <?php if(!empty($post_admin)){ ?>
                        <li><i class="fa fa-user-o"></i><?php echo esc_html($post_admin);?></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <?php } ?>
                <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                    <div class="cat_list">
                        <?php the_category( ); ?>
                    </div>
                <?php } ?>
                <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                    <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                <?php } ?>
                <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                    <div class="btn-part">
                        <a class="readon-arrow" href="<?php the_permalink(); ?>">
                            <?php echo esc_html($settings['blog_btn_text']);?> <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else {?>     
        <div class="col-md-6 2">
            <div class="blog-content">
            
               <?php if( !empty($settings['blog_meta_show_hide']) || !empty($settings['blog_avatar_show_hide'])){?>
                <ul class="blog-meta">
                    <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                        <?php if(!empty($blog_date)){ ?>
                        <li> <i class="fa fa-calendar-check-o"></i> <?php echo esc_html($blog_date);?></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                        <?php if(!empty($post_admin)){ ?>
                        <li> <i class="fa fa-user-o"></i><?php echo esc_html($post_admin);?></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <?php } ?>
                <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                    <div class="cat_list">
                        <?php the_category( ); ?>
                    </div>
                <?php } ?>
                <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                    <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                <?php } ?>
                <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                    <div class="btn-part">
                        <a class="readon-arrow" href="<?php the_permalink(); ?>">
                            <?php echo esc_html($settings['blog_btn_text']);?> <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="image-part">
                <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a> 
            </div>
        </div>
   <?php } ?>

</div>