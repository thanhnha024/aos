<?php
    global $weiboo_option;    
    $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);

    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($weiboo_option['header-grid']) ? $weiboo_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }

    $post_menu_type = get_post_meta(get_queried_object_id(), 'menu-type', true);
    $post_meta_data = get_post_meta(get_queried_object_id(), 'banner_image', true);
    $content_banner = get_post_meta(get_queried_object_id(), 'content_banner', true); 
    $post_id        = get_the_id();
    $author_id      = get_post_field ('post_author', $post_id);
    $display_name   = get_the_author_meta( 'display_name' , $author_id );
 ?>

<div class="reactheme-breadcrumbs porfolio-details">
<?php if($post_meta_data !='') { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $post_meta_data );?>')">
        <div class="<?php echo esc_attr($header_width);?>">
          <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                      <?php if(get_the_category()): ?>
                      <ul class="single--post-cat">
                        <li>                                                      
                            <?php
                                //tag add
                                $seperator = ', '; // blank instead of comma
                                $after = '';
                                $before = '';
                                echo '<div class="tag-line">';                              
                                the_category(' '); 
                                echo '</div>';
                              ?> 
                            </li>
                      </ul>
                        <?php
                    endif;
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                        <h1 class="page-title">
                            <?php if($content_banner !=''){
                                echo esc_html($content_banner);
                            } else {
                                the_title();
                            }
                            ?>
                        </h1>
                    <?php } 
                        
                    ?>   
                    <ul class="bs-meta">
                        <li>
                            <i class="rt-calendar-days" aria-hidden="true"></i>
                            <span class="p-date">
                                <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                            </span>
                        </li>
                         <li>
                             <span class="p-user">
                                 <span class="author-name">
                                     <span class="author-name"><i class="rt-user" aria-hidden="true"></i> <?php echo esc_html($display_name); ?></span>
                                 </span>
                             </span>
                         </li>                               
                         <li class="post-view comment-right">
                             <i class="rt-comments" aria-hidden="true"></i> <?php echo get_comments_number( '0', '1', '%' ); ?> 
                         </li>
                    </ul>     
                </div>
            </div>
          </div>
        </div>
    </div>
<?php }

elseif (!empty($weiboo_option['breadcrumb_bg_color'])) {?>
    <div class="breadcrumbs-single" style="background:<?php echo esc_attr($weiboo_option['breadcrumb_bg_color']);?>">
        <div class="<?php echo esc_attr($header_width);?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                            <?php if(get_the_category()): ?>
                            <ul class="single--post-cat">
                              <li>                                                      
                                  <?php
                                      //tag add
                                      $seperator = ', '; // blank instead of comma
                                      $after = '';
                                      $before = '';
                                      echo '<div class="tag-line">';                              
                                      the_category(' '); 
                                      echo '</div>';
                                    ?> 
                                  </li>
                            </ul>
                              <?php
                          endif;
                    
                        $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                        <?php if( $post_meta_title != 'hide' ){             
                        ?>
                            <h1 class="page-title">
                                <?php if($content_banner !=''){
                                    echo esc_html($content_banner);
                                } else {
                                    the_title();
                                }
                                ?>
                            </h1>
                        <?php }                         
                        ?>  
                        <ul class="bs-meta">
                            <li>
                                 <span class="p-user">
                                     <span class="author-name">
                                         <span class="author-name"><i class="rt-user" aria-hidden="true"></i> <?php echo esc_html($display_name); ?></span>
                                     </span>
                                 </span>
                             </li>  
                            <li>
                                <i class="rt-calendar-days" aria-hidden="true"></i>
                                <span class="p-date">
                                    <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                </span>
                            </li>
                                                          
                             <li class="post-view comment-right">
                                 <i class="rt-comments" aria-hidden="true"></i> <?php echo get_comments_number( '0', '1', '%' ); ?> 
                             </li>
                        </ul>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }

elseif (!empty($weiboo_option['blog_banner']['url'])) {?>
<div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $weiboo_option['blog_banner']['url'] );?>')">
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                        <?php if(get_the_category()): ?>
                        <ul class="single--post-cat">
                          <li>                                                      
                              <?php
                                  //tag add
                                  $seperator = ', '; // blank instead of comma
                                  $after = '';
                                  $before = '';
                                  echo '<div class="tag-line">';                              
                                  the_category(' '); 
                                  echo '</div>';
                                ?> 
                              </li>
                        </ul>
                          <?php
                      endif;
                
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                        <h1 class="page-title">
                            <?php if($content_banner !=''){
                                echo esc_html($content_banner);
                            } else {
                                the_title();
                            }
                            ?>
                        </h1>
                    <?php }                         
                    ?>  
                    <ul class="bs-meta">
                        <li>
                             <span class="p-user">
                                 <span class="author-name">
                                     <span class="author-name"><i class="rt-user" aria-hidden="true"></i> <?php echo esc_html($display_name); ?></span>
                                 </span>
                             </span>
                         </li>  
                        <li>
                            <i class="rt-calendar-days" aria-hidden="true"></i>
                            <span class="p-date">
                                <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                            </span>
                        </li>
                                                      
                         <li class="post-view comment-right">
                             <i class="rt-comments" aria-hidden="true"></i> <?php echo get_comments_number( '0', '1', '%' ); ?> 
                         </li>
                    </ul>  
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php }else{?>
    <div class="reactheme-breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                        <?php if(get_the_category()): ?>
                        <ul class="single--post-cat">
                          <li>                                                      
                              <?php
                                  //tag add
                                  $seperator = ', '; // blank instead of comma
                                  $after = '';
                                  $before = '';
                                  echo '<div class="tag-line">';                              
                                  the_category(' '); 
                                  echo '</div>';
                                ?> 
                              </li>
                        </ul>
                          <?php
                      endif;
                        $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                        <?php if( $post_meta_title != 'hide' ){             
                        ?>
                            <h1 class="page-title">
                                <?php if($content_banner !=''){
                                    echo esc_html($content_banner);
                                } else {
                                    the_title();
                                }
                                ?>
                            </h1>
                        <?php }                             
                        ?>  
                        <ul class="bs-meta">
                            <li>
                                 <span class="p-user">
                                     <span class="author-name">
                                         <span class="author-name"><i class="rt-user" aria-hidden="true"></i> <?php echo esc_html($display_name); ?></span>
                                     </span>
                                 </span>
                             </li>  
                            <li>
                                <i class="rt-calendar-days" aria-hidden="true"></i>
                                <span class="p-date">
                                    <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                </span>
                            </li>
                                                          
                             <li class="post-view comment-right">
                                 <i class="rt-comments" aria-hidden="true"></i> <?php echo get_comments_number( '0', '1', '%' ); ?> 
                             </li>
                        </ul>       
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</div>