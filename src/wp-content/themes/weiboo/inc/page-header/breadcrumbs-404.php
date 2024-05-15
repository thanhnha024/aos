<?php
    global $weiboo_option;    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($weiboo_option['header-grid']) ? $weiboo_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php 
    $post_meta_data = '';
    if(!empty($weiboo_option['page_banner_main']['url'])):
      $post_meta_data = $weiboo_option['page_banner_main']['url'];
    endif;
 
if($post_meta_data !=''){   
?>
<div class="reactheme-breadcrumbs porfolio-details">
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($post_meta_data); ?>')">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">             
                
                <h1 class="page-title">
                    <?php echo esc_html__("404 Page",'weiboo');?>
                </h1>            
                 
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php }


    else{
      ?>
    <div class="reactheme-breadcrumbs porfolio-details">
    <div class="breadcrumbs-single">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">             
                
                <h1 class="page-title">
                    <?php echo esc_html__("404 Page",'weiboo');?>
                </h1>            
                 
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    <?php } 

    
?>