<?php

get_header();?>
<div id="reactheme-blog" class="reactheme-blog blog-page">
   <?php
       //checking blog layout form option
       $col         = '';
       $blog_layout = '';
       $column      = '';
       $blog_grid   = '';

       if (!empty($weiboo_option['blog-layout']) || !is_active_sidebar('sidebar-1')) {
           $blog_layout = !empty($weiboo_option['blog-layout']) ? $weiboo_option['blog-layout'] : '';
           $blog_grid   = !empty($weiboo_option['blog-grid']) ? $weiboo_option['blog-grid'] : '';
           $blog_grid   = !empty($blog_grid) ? $blog_grid : '12';
           if ($blog_layout == 'full' || !is_active_sidebar('sidebar-1')) {
               $layout = 'full-layout';
               $col    = '-full';
               $column = 'sidebar-none';
           } elseif ($blog_layout == '2left') {
               $layout = 'full-layout-left';
           } elseif ($blog_layout == '2right') {
               $layout = 'full-layout-right';
           } else {
               $col         = '';
               $blog_layout = '';
           }
       } else {
           $col         = '';
           $blog_layout = '';
           $layout      = '';
           $blog_grid   = '12';
       }
   ?>

    <div class="row padding-<?php echo esc_attr($layout) ?>">
        <div class="contents-sticky col-md-12 col-lg-8<?php echo esc_attr($col); ?><?php echo esc_attr($layout); ?>">
            <div class="row">
                <?php
                    if (have_posts()):
                        /* Start the Loop */
                        while (have_posts()): the_post();

                            $post_id   = get_the_id();
                            $author_id = $post->post_author;
                            $no_thumb  = "";

                            if (!has_post_thumbnail()) {
                                $no_thumb = "no-thumbs";
                            }?>

		                    <div class="col-sm-<?php echo esc_attr($blog_grid); ?> col-xs-12">
		                        <article <?php post_class();?>>
		                            <div class="blog-item <?php echo esc_attr($no_thumb); ?>">
		                                <?php if (has_post_thumbnail()) {?>
		                                    <div class="blog-img">
		                                       <a href="<?php the_permalink();?>">
		                                            <?php
                                                        the_post_thumbnail();
                                                    ?>
		                                        </a>
		                                        <?php
                                                if (!empty($weiboo_option['blog-category'])) {
                                                    if ($weiboo_option['blog-category'] == 'show') {
                                                        if (get_the_category()): 
                                                            echo '<div class="tag-line">';
                                                                the_category(', ');
                                                            echo '</div>';
                                                        ?>
		                                                <?php endif;
                                                    }
                                                } else {
                                                    if (get_the_category()): ?>

	                                                <?php
                                                        //tag add
                                                        $seperator = ', '; // blank instead of comma
                                                        $after     = '';
                                                        $before    = '';
                                                        echo '<div class="tag-line">';
                                                    ?>

                                                    <?php
                                                        the_category(', ');
                                                         echo '</div>';
                                                    ?>

	                                            <?php
                                                    endif;
                                                }?>

                                                <?php if (!empty($weiboo_option['blog-author-post'])) {
                                                    if ($weiboo_option['blog-author-post'] == 'show'): 
                                                ?>

                                               <div class="author">
                                                   <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                                    <?php
                                                        $last_name  = get_user_meta($author_id, 'last_name', true);
                                                        $first_name = get_user_meta($author_id, 'first_name', true);
                                                        if (!empty($first_name) && !empty($last_name)) {
                                                            echo esc_html($first_name) . ' ' . esc_html($last_name);
                                                        } else {
                                                            echo get_the_author();
                                                        }
                                                    ?>
                                               </div>

                                           <?php endif;} else {?>

                                               <div class="author">
                                               <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                                <?php
                                                    $last_name  = get_user_meta($author_id, 'last_name', true);
                                                            $first_name = get_user_meta($author_id, 'first_name', true);
                                                            if (!empty($first_name) && !empty($last_name)) {
                                                                echo esc_html($first_name) . ' ' . esc_html($last_name);
                                                            } else {
                                                                echo get_the_author();
                                                        }?>
                                               </div>

                                          <?php }
                                              ;?>

                                    </div><!-- .blog-img -->
                                <?php }
                                ?>
                                <div class="full-blog-content">
                                    <div class="title-wrap">

                                        <h3 class="blog-title">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_title();?>
                                            </a>
                                        </h3>
                                  </div>

                                    <div class="blog-desc">
                                        <?php echo weiboo_custom_excerpt(30); ?>
                                    </div>

                                      <div class="blog-meta">
                                          <ul class="btm-cate">
                                            <?php
                                                if (!empty($weiboo_option['blog-date'])):
                                                if ($weiboo_option['blog-date'] == 1): ?>
	                                                     <li>
	                                                       <div class="blog-date">
	                                                         <i class="rt-calendar-days"></i>	                                                                                          <?php $post_date = get_the_date();
                                                                                                  echo esc_attr($post_date);?>
	                                                       </div>
	                                                     </li>
	                                                   <?php endif;
                                                           else:
                                                               if (empty($weiboo_option['blog-date'])):
                                                           ?>
	                                                       <li>
	                                                           <div class="blog-date">
	                                                               <i class="rt-calendar-days"></i>	                                                                                                <?php $post_date = get_the_date();
                                                                                                        echo esc_attr($post_date);?>
	                                                           </div>
	                                                       </li>
	                                                    <?php endif;
                                                            endif;
                                                        $commnets = get_comments_number('0', '1', '%');?>
                                                <li class="comments">
                                                    <i class="rt-comments" aria-hidden="true"></i>
                                                    <?php if ($commnets == '1') {
                                                            echo esc_html($commnets);
                                                            echo esc_html__(' Comment', 'weiboo');
                                                        } else {
                                                            echo esc_html($commnets);
                                                            echo esc_html__(' Comments', 'weiboo');
                                                    }?>

                                                </li>
                                        </ul>
                                    </div>

                                    <?php

                                    if (!empty($weiboo_option['blog_readmore'])): ?>
                                            <div class="blog-button<?php echo esc_attr($no_view); ?>">
                                                <a href="<?php the_permalink();?>">
                                                    <?php echo esc_html($weiboo_option['blog_readmore']); ?>
                                                </a>
                                            </div>
                                    <?php endif;?>
                            </div>
                          </div>
                        </article>
                    </div>

                <?php
                    endwhile;
                ?>
            </div>
            <div class="pagination-area">
                <?php
                    the_posts_pagination();
                ?>
            </div>
            <?php
                else:
                    get_template_part('template-parts/content', 'none');
            endif;?>
        </div>
        <?php if ($layout != 'full-layout'):
                get_sidebar();
            endif;
        ?>
    </div>

</div>
<?php get_footer();