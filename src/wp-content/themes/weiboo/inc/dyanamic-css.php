<?php
/*
dynamic css file. please don't edit it. it's update automatically when settins changed
*/
add_action('wp_head', 'weiboo_custom_colors', 160);
function weiboo_custom_colors() { 
global $weiboo_option;	
/***styling options
------------------*/
	if(!empty($weiboo_option['body_bg_color']))
	{
	 $body_bg          = $weiboo_option['body_bg_color'];
	}	
	
	$site_color       = !empty($weiboo_option['primary_color']) ? $weiboo_option['primary_color'] : '';
	$secondary_color  = !empty($weiboo_option['secondary_color']) ? $weiboo_option['secondary_color'] : '';	
	$link_color       = !empty($weiboo_option['link_text_color']) ? $weiboo_option['link_text_color'] : '';
	$link_hover_color = !empty($weiboo_option['link_hover_text_color']) ? $weiboo_option['link_hover_text_color'] : '';
	
	//typography extract for body
		
	$body_typography_font      = !empty($weiboo_option['opt-typography-body']['font-family']) ? $weiboo_option['opt-typography-body']['font-family'] : '';
	$body_typography_font_size = !empty($weiboo_option['opt-typography-body']['font-size']) ? $weiboo_option['opt-typography-body']['font-size'] : '' ;

	//typography extract for menu
	$menu_typography_color       = !empty($weiboo_option['opt-typography-menu']['color']) ? $weiboo_option['opt-typography-menu']['color'] : '' ;	
	$menu_typography_weight      = !empty($weiboo_option['opt-typography-menu']['font-weight']) ? $weiboo_option['opt-typography-menu']['font-weight']: '';	
	$menu_typography_font_family = !empty($weiboo_option['opt-typography-menu']['font-family']) ? $weiboo_option['opt-typography-menu']['font-family'] : '';

	$menu_typography_font_fsize  = !empty($weiboo_option['opt-typography-menu']['font-size']) ? $weiboo_option['opt-typography-menu']['font-size'] : '';
		

	//typography extract for heading
	
	$h1_typography_color= !empty($weiboo_option['opt-typography-h1']['color'])? $weiboo_option['opt-typography-h1']['color']: '';	

	if(!empty($weiboo_option['opt-typography-h1']['font-weight'])) {
		$h1_typography_weight=$weiboo_option['opt-typography-h1']['font-weight'];
	}
		
	$h1_typography_font_family = !empty($weiboo_option['opt-typography-h1']['font-family']) ? $weiboo_option['opt-typography-h1']['font-family'] : '' ;

	$h1_typography_font_fsize = !empty($weiboo_option['opt-typography-h1']['font-size']) ? $weiboo_option['opt-typography-h1']['font-size'] : '';	

	if(!empty($weiboo_option['opt-typography-h1']['line-height'])) {
		$h1_typography_line_height=$weiboo_option['opt-typography-h1']['line-height'];
	}
	
	$h2_typography_color = !empty($weiboo_option['opt-typography-h2']['color']) ? $weiboo_option['opt-typography-h2']['color'] : '';	

	$h2_typography_font_fsize = !empty($weiboo_option['opt-typography-h2']['font-size']) ? $weiboo_option['opt-typography-h2']['font-size'] : '';	
	if(!empty($weiboo_option['opt-typography-h2']['font-weight'])){
		$h2_typography_font_weight=$weiboo_option['opt-typography-h2']['font-weight'];
	}	

	$h2_typography_font_family = !empty($weiboo_option['opt-typography-h2']['font-family']) ? $weiboo_option['opt-typography-h2']['font-family'] : '' ;

	$h2_typography_font_fsize = !empty($weiboo_option['opt-typography-h2']['font-size']) ? $weiboo_option['opt-typography-h2']['font-size'] : '';	

	if(!empty($weiboo_option['opt-typography-h2']['line-height'])){
		$h2_typography_line_height=$weiboo_option['opt-typography-h2']['line-height'];
	}
	
	$h3_typography_color = !empty($weiboo_option['opt-typography-h3']['color']) ? $weiboo_option['opt-typography-h3']['color'] : '';	

	if(!empty($weiboo_option['opt-typography-h3']['font-weight'])){
		$h3_typography_font_weightt=$weiboo_option['opt-typography-h3']['font-weight'];
	}	

	$h3_typography_font_family = !empty($weiboo_option['opt-typography-h3']['font-family']) ? $weiboo_option['opt-typography-h3']['font-family']: '';

	$h3_typography_font_fsize  = !empty($weiboo_option['opt-typography-h3']['font-size']) ? $weiboo_option['opt-typography-h3']['font-size'] : '';	

	if(!empty($weiboo_option['opt-typography-h3']['line-height'])){
		$h3_typography_line_height = $weiboo_option['opt-typography-h3']['line-height'];
	}

	$h4_typography_color = !empty($weiboo_option['opt-typography-h4']['color']) ? $weiboo_option['opt-typography-h4']['color'] : '';	

	if(!empty($weiboo_option['opt-typography-h4']['font-weight'])){
		$h4_typography_font_weight = $weiboo_option['opt-typography-h4']['font-weight'];
	}	

	$h4_typography_font_family = !empty($weiboo_option['opt-typography-h4']['font-family']) ? $weiboo_option['opt-typography-h4']['font-family'] : '';

	$h4_typography_font_fsize  = !empty($weiboo_option['opt-typography-h4']['font-size']) ? $weiboo_option['opt-typography-h4']['font-size'] : '';	

	if(!empty($weiboo_option['opt-typography-h4']['line-height'])) {
		$h4_typography_line_height = $weiboo_option['opt-typography-h4']['line-height'];
	}
	
	$h5_typography_color = !empty($weiboo_option['opt-typography-h5']['color']) ? $weiboo_option['opt-typography-h5']['color'] : '';	

	if(!empty($weiboo_option['opt-typography-h5']['font-weight'])) {
		$h5_typography_font_weight = $weiboo_option['opt-typography-h5']['font-weight'];
	}	

	$h5_typography_font_family = !empty($weiboo_option['opt-typography-h5']['font-family']) ? $weiboo_option['opt-typography-h5']['font-family'] : '';

	$h5_typography_font_fsize  = !empty($weiboo_option['opt-typography-h5']['font-size']) ? $weiboo_option['opt-typography-h5']['font-size'] : '';	

	if(!empty($weiboo_option['opt-typography-h5']['line-height'])) {
		$h5_typography_line_height = $weiboo_option['opt-typography-h5']['line-height'];
	}
	
	$h6_typography_color = !empty($weiboo_option['opt-typography-6']['color']) ? $weiboo_option['opt-typography-6']['color'] : '';	

	if(!empty($weiboo_option['opt-typography-6']['font-weight'])) {
		$h6_typography_font_weight = $weiboo_option['opt-typography-6']['font-weight'];
	}

	$h6_typography_font_family = !empty($weiboo_option['opt-typography-6']['font-family']) ? $weiboo_option['opt-typography-6']['font-family'] : '';

	$h6_typography_font_fsize  = !empty($weiboo_option['opt-typography-6']['font-size']) ? $weiboo_option['opt-typography-6']['font-size'] : '';

	if(!empty($weiboo_option['opt-typography-6']['line-height'])) {
		$h6_typography_line_height = $weiboo_option['opt-typography-6']['line-height'];
	}
	

$body_color  = !empty($weiboo_option['body_text_color']) ? $weiboo_option['body_text_color'] : '' ;	?>

<!-- Typography -->
<?php if(!empty($body_color)){

	global $weiboo_option;

?>

<style>
	
	body{
		background:<?php echo sanitize_hex_color($body_bg); ?>;
		color:<?php echo sanitize_hex_color($body_color); ?> !important;
		<?php if(!empty($body_typography_font)){ ?>
			font-family: <?php echo esc_attr($body_typography_font);?> !important;   
		<?php } ?> 
	    font-size: <?php echo esc_attr($body_typography_font_size);?> !important;
	}

	.single-product .yith-wcwl-add-button span{
		display:none
	}
	.single-teams .theme_btn,
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce .wc-forward, 
	.woocommerce button.button, 
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt, .woocommerce button.button.alt, 
	.woocommerce input.button.alt,
	.woocommerce button.button.alt.disabled,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
	.woocommerce.single-product .product-type-simple .summary .cart .single_add_to_cart_button{
		background: <?php echo sanitize_hex_color($weiboo_option['btn_bg_color']);?>;
		border-color: <?php echo sanitize_hex_color($weiboo_option['btn_bg_color']);?>;
		color: <?php echo sanitize_hex_color($weiboo_option['btn_text_color']);?>;
	}
	.single-teams .theme_btn:hover,
	.woocommerce #respond input#submit:hover, 
	.woocommerce a.button:hover, 
	.woocommerce .wc-forward:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover,
	.woocommerce button.button.alt.disabled:hover{
		color: <?php echo sanitize_hex_color($weiboo_option['btn_txt_hover_color']);?>;
		background: <?php echo sanitize_hex_color($weiboo_option['btn_bg_hover']);?>;
		border-color: <?php echo sanitize_hex_color($weiboo_option['btn_bg_hover_border']);?>
		
	}

	h1{
		<?php if(!empty($h1_typography_color)) { ?>
			 color: <?php echo sanitize_hex_color($h1_typography_color);?>;
		<?php
	 }?>
		<?php if(!empty($h1_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($h1_typography_font_family);?>;   
		<?php } ?>
		font-size:<?php echo esc_attr($h1_typography_font_fsize);?>;
		<?php if(!empty($h1_typography_weight)){
		?>
		font-weight:<?php echo esc_attr($h1_typography_weight);?>;
		<?php }?>
		
		<?php if(!empty($h1_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h1_typography_line_height);?>;
		<?php }?>		
	}

	h2{
		color:<?php echo sanitize_hex_color($h2_typography_color);?>;
		<?php if(!empty($h2_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($h2_typography_font_family);?>;   
		<?php } ?> 
		font-size:<?php echo esc_attr($h2_typography_font_fsize);?>;
		<?php if(!empty($h2_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h2_typography_font_weight);?>;
		<?php }?>
		
		<?php if(!empty($h2_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h2_typography_line_height);?>
		<?php }?>
	}

	h3{
		color:<?php echo sanitize_hex_color($h3_typography_color);?> ;
		<?php if(!empty($h3_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($h3_typography_font_family);?>;   
		<?php } ?> 
		font-size:<?php echo esc_attr($h3_typography_font_fsize);?>;
		<?php if(!empty($h3_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h3_typography_font_weight);?>;
		<?php }?>
		
		<?php if(!empty($h3_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h3_typography_line_height);?>;
		<?php }?>
	}

	h4{
		color:<?php echo sanitize_hex_color($h4_typography_color);?>;
		<?php if(!empty($h4_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($h4_typography_font_family);?>;   
		<?php } ?>
		font-size:<?php echo esc_attr($h4_typography_font_fsize);?>;
		<?php if(!empty($h4_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h4_typography_font_weight);?>;
		<?php }?>
		
		<?php if(!empty($h4_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h4_typography_line_height);?>;
		<?php }?>
		
	}

	h5{
		color:<?php echo sanitize_hex_color($h5_typography_color);?>;
		<?php if(!empty($h5_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($h5_typography_font_family);?>;   
		<?php } ?>
		font-size:<?php echo esc_attr($h5_typography_font_fsize);?>;
		<?php if(!empty($h5_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h5_typography_font_weight);?>;
		<?php }?>
		
		<?php if(!empty($h5_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h5_typography_line_height);?>;
		<?php }?>
	}

	h6{
		color:<?php echo sanitize_hex_color($h6_typography_color);?> ;
		<?php if(!empty($h6_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($h6_typography_font_family);?>;   
		<?php } ?>
		font-size:<?php echo esc_attr($h6_typography_font_fsize);?>;
		<?php if(!empty($h6_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h6_typography_font_weight);?>;
		<?php }?>
		
		<?php if(!empty($h6_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h6_typography_line_height);?>;
		<?php }?>
	}

	.menu-area .navbar ul li > a,
	.sidenav .widget_nav_menu ul li a{
		<?php if(!empty($menu_typography_weight)){ ?>
			font-weight: <?php echo esc_attr($menu_typography_weight);?>;   
		<?php } ?>
		<?php if(!empty($menu_typography_font_family)){ ?>
			font-family: <?php echo esc_attr($menu_typography_font_family);?>;   
		<?php } ?>
		font-size:<?php echo esc_attr($menu_typography_font_fsize); ?>;
	} 

   
 
	.reactheme-footer .recent-post-widget .show-featured .post-desc i,	
	.reactheme-heading .title-inner .sub-text,
	.reactheme-services-default .services-wrap .services-item .services-icon i,	
	.reactheme-blog .blog-item .blog-slidermeta span.category a:hover,
	.btm-cate li a:hover,	
	.ps-navigation ul a:hover span,	
	.reactheme-portfolio-style5 .portfolio-item .portfolio-content a,
	.reactheme-services1.services-left.border_style .services-wrap .services-item .services-icon i:hover,
	.reactheme-services1.services-right .services-wrap .services-item .services-icon i:hover,
	.reactheme-galleys .galley-img .zoom-icon:hover,
	#about-history-tabs ul.tabs-list_content li:before,
	#reactheme-header.header-style-3 .header-inner .logo-section .toolbar-contact-style4 ul li i,
	#sidebar-services .widget.widget_nav_menu ul li.current-menu-item a,
	#sidebar-services .widget.widget_nav_menu ul li a:hover,
	.single-teams .team-inner ul li i,
	#reactheme-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a, 
	#reactheme-header.header-transparent .menu-area .navbar ul li .sub-menu li.current_page_item > a,	
	.team-grid-style1 .team-item .team-content1 h3.team-name a, 
	.reactheme-team-grid.team-style5 .team-item .normal-text .person-name a,
	.reactheme-team-grid.team-style4 .team-wrapper .team_desc .name a,
	.reactheme-team-grid.team-style4 .team-wrapper .team_desc .name .designation,	
	.contact-page1 .form-button .submit-btn i:before,	
	.single-teams .ps-informations h2.single-title,
	.single-teams .ps-informations ul li.phone a:hover, .single-teams .ps-informations ul li.email a:hover,
	.single-teams .siderbar-title,
	.single-teams .team-detail-wrap-btm.team-inner .appointment-btn a,
	ul.check-icon li:before,
	.reactheme-project-section .project-item .project-content .title a:hover,
	.subscribe-text i, .subscribe-text .title, .subscribe-text span a:hover,
	
	.reactheme-blog-details .bs-meta li i,			
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.woocommerce ul.products li.product .price,
	.woocommerce div.product p.price ins, .woocommerce div.product span.price ins, .woocommerce ul.products li.product .price ins,
	.woocommerce ul.products li .woocommerce-loop-product__title a:hover,
	.woocommerce-message, .woocommerce-error, .woocommerce-info, .woocommerce-message,
	.woocommerce-message::before, .woocommerce-info::before{
		color:<?php echo sanitize_hex_color($secondary_color); ?>;
	}

	.portfolio-slider-data .slick-next, 
	.portfolio-slider-data .slick-prev,
	.ps-navigation ul a:hover span,
	ul.chevron-right-icon li:before,
	.sidenav .footer-contact-ul li i,			
	.reactheme-portfolio.style2 .portfolio-slider .portfolio-item .portfolio-content h3.p-title a:hover,
	#reactheme-header.header-style5 .stuck.sticky .menu-area .navbar ul > li.active a,
	#reactheme-header .menu-area .navbar ul > li.active a,	
	.reactheme-sl-social-icons a:hover,
	.reactheme-portfolio.vertical-slider.style4 .portfolio-slider .portfolio-item:hover .p-title a{
		color:<?php echo sanitize_hex_color($secondary_color); ?>;
	}

		
	
	html input[type="button"]:hover, input[type="reset"]:hover,
	.reactheme-video-2 .popup-videos:before,
	.sidenav .widget-title:before,
	.reactheme-team-grid.team-style5 .team-item .team-content,
	.reactheme-team-grid.team-style4 .team-wrapper .team_desc::before,
	.reactheme-services-style4:hover .services-icon i,
	.team-grid-style1 .team-item .social-icons1 a:hover i,
	.loader__bar,
	.reactheme-blog-grid .blog-img a.float-cat,
	#sidebar-services .download-btn ul li,
	.transparent-btn:hover,
	.reactheme-portfolio-style2 .portfolio-item .portfolio-img .read_more:hover,
	.reactheme-video-2 .popup-videos,
	.reactheme-blog-details .blog-item.style2 .category a, .reactheme-blog .blog-item.style2 .category a, .blog .blog-item.style2 .category a,
	.reactheme-blog-details .blog-item.style1 .category a, .reactheme-blog .blog-item.style1 .category a, .blog .blog-item.style1 .category a,
	#mobile_menu .submenu-button,	
	.icon-button a,
	.team-grid-style1 .team-item .image-wrap .social-icons1, .team-slider-style1 .team-item .image-wrap .social-icons1,
	.reactheme-heading.style8 .title-inner:after,
	.reactheme-heading.style8 .description:after,
	#slider-form-area .form-area input[type="submit"],
	.services-style-5 .services-item:hover .services-title,
	#sidebar-services .reactheme-heading .title-inner h3:before,	
	#reactheme-contact .contact-address .address-item .address-icon::before,
	.team-slider-style4 .team-carousel .team-item:hover,
	#reactheme-header.header-transparent .btn_quote a:hover,
	.react-sideabr .tagcloud a:hover,
	.reactheme-heading.style2:after,
	.reactheme-blog-details .bs-info.tags a:hover,
	.mfp-close-btn-in .mfp-close,
	.top-services-dark .reactheme-services .services-style-7.services-left .services-wrap .services-item,
	.single-teams .team-inner h3:before,
	.single-teams .team-detail-wrap-btm.team-inner,
	::selection,
	.reactheme-heading.style2 .title:after,
	.reacbutton:hover,
	.reactheme-blog-details #reply-title:before,
	.reactheme-footer #wp-calendar th,
	.service-carousel.services-dark .services-sliders2 .services-desc:before, 
	.service-carousels.services-dark .services-sliders2 .services-desc:before,
	.reactheme-services .services-style-9 .services-wrap:after,
	 blockquote cite::before,	
	 blockquote::after,	
	.react-sideabr .widget-title::after,
	.portfolio-slider-data .slick-dots li.slick-active, 
	.portfolio-slider-data .slick-dots li:hover,
	.reactheme-portfolio.vertical-slider.style4 .portfolio-slider .portfolio-item .p-title a:before,
	.reactheme-team-grid.team-style4 .team-wrapper:hover .team_desc,

	.submit-btn .wpcf7-submit,	
	.reactheme-heading.style6 .title-inner .sub-text:after,
	.react-sideabr.dynamic-sidebar .service-singles .menu li.current-menu-item a,
	.react-sideabr.dynamic-sidebar .service-singles .menu li a:hover,
	.single-teams .team-skill .reactheme-progress .progress-bar,	

	.reactheme-unique-slider .reactheme-addon-slider button:hover,
	.reactheme-blog-grid1.blog-item .image-part span.date-full,
	.woocommerce span.onsale,
	.change-wooproduct-view .rts-cursor-pointer:hover,
	.react-sideabr .widget_search button, .react-sideabr .bs-search button,
	.single .tag-line a
	{
		background:<?php echo sanitize_hex_color($site_color); ?>;
	}
	
	.portfolio-slider-data .slick-dots li,
	.lp-list-table thead tr th{
		background:<?php echo sanitize_hex_color($site_color); ?>;
	}	

	.react-sideabr .recent-post-widget .post-desc a:hover,
	.reactheme-breadcrumbs .breadcrumbs-title span.current-item,
	.full-blog-content .blog-title a:hover,
	.woocommerce.single-product .product-type-simple .summary .price .amount bdi{
		color:<?php echo sanitize_hex_color($site_color); ?>;
	}

	.team-slider-style1 .team-item .team-content1 h3.team-name a:hover,
	.reactheme-service-grid .service-item .service-content .service-button .reacbutton.rs_button:hover:before,
	.reactheme-heading.style6 .title-inner .sub-text,	
	.reactheme-heading.style7 .title-inner .sub-text,
	.reactheme-portfolio-style1 .portfolio-item .portfolio-content .pt-icon-plus:before,
	.team-grid-style1 .team-item .team-content1 h3.team-name a, 
	.service-reacbuttons:hover,
	.service-reacbuttons:before:hover{
		color:<?php echo sanitize_hex_color($secondary_color); ?> !important;
	}	

	.reactheme-services-style3 .bg-img a,
	.reactheme-services-style3 .bg-img a:hover{
		background:<?php echo sanitize_hex_color($secondary_color); ?>;
		border-color: <?php echo sanitize_hex_color($secondary_color); ?>;
	}
	.reactheme-service-grid .service-item .service-content .service-button .reacbutton.rs_button:hover{
		border-color: <?php echo sanitize_hex_color($secondary_color); ?>;;
		color: <?php echo sanitize_hex_color($secondary_color); ?>;
	}


	.team-grid-style3 .team-img .team-img-sec:before,
	#loading,	
	#sidebar-services .bs-search button:hover, 
	.team-slider-style3 .team-img .team-img-sec:before,
	.reactheme-blog-details .blog-item.style2 .category a:hover, 
	.reactheme-blog .blog-item.style2 .category a:hover, 
	.blog .blog-item.style2 .category a:hover,
	.icon-button a:hover,
	.reactheme-blog-details .blog-item.style1 .category a:hover, 
	.reactheme-blog .blog-item.style1 .category a:hover, 
	.blog .blog-item.style1 .category a:hover,	
	.fullwidth-services-box .services-style-2:hover,	
	.post-meta-dates,	
	#top-to-bottom i
	
	{
		background: <?php echo sanitize_hex_color($site_color); ?>;
	}

	html input[type="button"], input[type="reset"], input[type="submit"]{
		background: <?php echo sanitize_hex_color($secondary_color); ?>;
	}

	<?php if(!empty($weiboo_option['breadcrumb_top_gap']) && !empty($weiboo_option['breadcrumb_bottom_gap'])) : ?>
		.reactheme-breadcrumbs .breadcrumbs-inner,
		#reactheme-header.header-style-3 .reactheme-breadcrumbs .breadcrumbs-inner{
			padding-top:<?php echo esc_attr($weiboo_option['breadcrumb_top_gap']); ?>;			
			padding-bottom:<?php echo esc_attr($weiboo_option['breadcrumb_bottom_gap']); ?>;			
	}
	<?php endif; ?>

	<?php if(!empty($weiboo_option['mobile_breadcrumb_top_gap']) && !empty($weiboo_option['mobile_breadcrumb_bottom_gap'])) : ?>
		@media only screen and (max-width: 767px) {
		.reactheme-breadcrumbs .breadcrumbs-inner,
		#reactheme-header.header-style-3 .reactheme-breadcrumbs .breadcrumbs-inner{
					padding-top:<?php echo esc_attr($weiboo_option['mobile_breadcrumb_top_gap']); ?>;			
					padding-bottom:<?php echo esc_attr($weiboo_option['mobile_breadcrumb_bottom_gap']); ?>;			
			}
		}
	<?php endif; ?>
	

	.reactheme-video-2 .overly-border,
	.single-teams .ps-informations ul li.social-icon i{
		border-color:<?php echo sanitize_hex_color($secondary_color); ?> !important;
	}
	.portfolio-filter button:hover, 
	.portfolio-filter button.active,
	.team-grid-style1 .team-item .team-content1 h3.team-name a:hover,	
	.reactheme-blog-details .bs-img .blog-date span.date, 
	.reactheme-blog .bs-img .blog-date span.date, 
	.blog .bs-img .blog-date span.date, 
	.reactheme-blog-details .blog-img .blog-date span.date, 
	.reactheme-blog .blog-img .blog-date span.date, 
	.blog .blog-img .blog-date span.date,	
	.reactheme-portfolio-style5 .portfolio-item .portfolio-content a:hover,
	#cl-testimonial.cl-testimonial9 .single-testimonial .cl-author-info li,
	#cl-testimonial.cl-testimonial9 .single-testimonial .image-testimonial p i,
	.reactheme-services1.services-left.border_style .services-wrap .services-item .services-icon i,
	.reactheme-services1.services-right .services-wrap .services-item .services-icon i,	
	.reactheme-portfolio.style2 .portfolio-slider .portfolio-item .portfolio-img .portfolio-content .categories a:hover,	
	.full-blog-content .btm-cate .tag-line i,
	.reactheme-team-grid.team-style5 .team-item .normal-text .person-name a:hover,
	.service-reacbuttons:hover, .service-reacbuttons:hover:before{
		color: <?php echo sanitize_hex_color($secondary_color); ?>;
	}

	.reactheme-team-grid.team-style4 .team-wrapper .team_desc:before,
	.reactheme-team-grid.team-style5 .team-item .normal-text .team-text:before,
	.reactheme-services3 .slick-arrow,
	.single-teams .ps-image .ps-informations,
	.slidervideo .slider-videos,
	.slidervideo .slider-videos:before,	
	.service-reacbutton,
	.service-carousel .owl-dots .owl-dot.active,	
	.reactheme-blog-details .bs-img .categories .category-name a, 
	.reactheme-blog .bs-img .categories .category-name a, 
	.blog .bs-img .categories .category-name a, 
	.reactheme-blog-details .blog-img .categories .category-name a, 
	.reactheme-blog .blog-img .categories .category-name a, 
	.blog .blog-img .categories .category-name a{
		background: <?php echo sanitize_hex_color($secondary_color); ?>;
	}

	.reactheme-blog-details .bs-img .blog-date:before, 
	.reactheme-blog .bs-img .blog-date:before, 
	.blog .bs-img .blog-date:before, 
	.reactheme-blog-details .blog-img .blog-date:before, 
	.reactheme-blog .blog-img .blog-date:before, 
	.blog .blog-img .blog-date:before{		
		border-bottom: 0 solid;
    	border-bottom-color: <?php echo sanitize_hex_color($secondary_color); ?>;
    	border-top: 80px solid transparent;
    	border-right-color: <?php echo sanitize_hex_color($secondary_color); ?>;
    }
	.team-grid-style3 .team-img:before, .team-slider-style3 .team-img:before{
		border-bottom-color: <?php echo sanitize_hex_color($secondary_color); ?>;   			
	}
	.team-grid-style3 .team-img:after, .team-slider-style3 .team-img:after{
		border-top-color: <?php echo sanitize_hex_color($secondary_color); ?>;   	
	}

	.reactheme-blog .blog-meta .blog-title a:hover,	
	#team-list-style .team-name a:hover,
	#team-list-style .team-social i:hover,
	#team-list-style .social-info .phone a:hover,	
	.react-sideabr .widget_categories ul li a:hover,
	a:hover, a:focus, a:active,
	.reactheme-blog .blog-meta .blog-title a:hover,
	.reactheme-blog .blog-item .blog-meta .categories a:hover,
	.react-sideabr ul a:hover{
		color: <?php echo sanitize_hex_color($link_hover_color); ?>;
	}

	a{
		color: <?php echo sanitize_hex_color($link_color); ?>;
	}
	.reactheme-blog-details .bs-img .categories .category-name a:hover, 
	.reactheme-blog .bs-img .categories .category-name a:hover, 
	.blog .bs-img .categories .category-name a:hover, 
	.reactheme-blog-details .blog-img .categories .category-name a:hover, 
	.reactheme-blog .blog-img .categories .category-name a:hover, 
	.blog .blog-img .categories .category-name a:hover,
	#reactheme-header.header-style-4 .logo-section .times-sec{
		background: <?php echo sanitize_hex_color($secondary_color); ?>;
	}
	.reacbutton,
	.reactheme-heading.style3 .description:after,
	.team-grid-style1 .team-item .social-icons1 a i, .team-slider-style1 .team-item .social-icons1 a i,
	.owl-carousel .owl-nav [class*="owl-"]:hover,
	button, html input[type="button"], input[type="reset"],
	.reactheme-service-grid .service-item .service-img:before,
	.reactheme-service-grid .service-item .service-img:after,
	#reactheme-contact .contact-address .address-item .address-icon::after,
	.reactheme-services1.services-left.border_style .services-wrap .services-item .services-icon i:hover,
	.reactheme-services1.services-right .services-wrap .services-item .services-icon i:hover,
	.reactheme-service-grid .service-item .service-content::before,
	.reactheme-services-style4 .services-item .services-icon i,
	#reactheme-services-slider .img_wrap:before,
	#reactheme-services-slider .img_wrap:after,	
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec::before,
	.services-style-5 .services-item .icon_bg,		
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec:before,
	.reactheme-porfolio-details.project-gallery .file-list-image:hover .p-zoom:hover,	
	.team-slider-style2 .team-item-wrap .team-img .team-img-sec:before,
	.reactheme-team-grid.team-style5 .team-item .normal-text .social-icons a i:hover
	{
		background: <?php echo sanitize_hex_color($secondary_color); ?>;
	}
	#reactheme-header.header-style-4 .logo-section .times-sec:after{
		border-bottom-color: <?php echo sanitize_hex_color($secondary_color); ?>;
	}
	.reactheme-services1.services-left.border_style .services-wrap .services-item .services-icon i,
	.reactheme-services1.services-right .services-wrap .services-item .services-icon i,
	#cl-testimonial.cl-testimonial10 .slick-arrow,	
	.team-grid-style2 .team-item-wrap .team-img img, .team-slider-style2 .team-item-wrap .team-img img,
	.contact-sec .wpcf7-form .wpcf7-text, .contact-sec .wpcf7-form .wpcf7-textarea{
		border-color: <?php echo sanitize_hex_color($secondary_color); ?> !important;
	}

	<?php 
		if(!empty($weiboo_option['link_hover_text_color'])){
			?>
			#reactheme-services-slider .item-thumb .owl-dot.service_icon_style.active .tile-content a, 
			#reactheme-services-slider .item-thumb .owl-dot.service_icon_style:hover .tile-content a,
			.team-grid-style2 .appointment-bottom-area .app_details:hover a, 
			.team-slider-style2 .appointment-bottom-area .app_details:hover a{
				color: <?php echo sanitize_hex_color($weiboo_option['link_hover_text_color']); ?> !important;	
			}
		<?php
		}
	?>

	<?php if(!empty($weiboo_option['container_size'])) : ?>
		@media only screen and (min-width: 1300px) {
			.container{
				max-width:<?php echo esc_attr($weiboo_option['container_size']); ?>;
			}
		}
	<?php endif; ?>

	<?php if(!empty($weiboo_option['preloader_bg_color'])) : ?>
		#weiboo-load{
			background: <?php echo sanitize_hex_color($weiboo_option['preloader_bg_color']); ?>;  
		}
	<?php endif; ?>


	
	<?php if(!empty($weiboo_option['body_bg_color'])) : ?>
		body.archive.tax-product_cat{
			background: <?php echo sanitize_hex_color($weiboo_option['body_bg_color']); ?> !important;  
		}
	<?php endif; ?>


</style>

<?php
	}
	 
	if(is_home() && !is_front_page() || is_home() && is_front_page()){

		$padding_top        = get_post_meta(get_queried_object_id(), 'content_top', true);
		$padding_bottom     = get_post_meta(get_queried_object_id(), 'content_bottom', true);
		
		$footer_padd_top    = get_post_meta(get_queried_object_id(), 'footer_padd_top', true);
		$footer_padd_bottom = get_post_meta(get_queried_object_id(), 'footer_padd_bottom', true);

  		if($padding_top != '' || $padding_bottom != ''){
	  	?>
	  	  <style>
	  	  	.main-contain #content,
	  	  	body.reactheme-pages-btm-gap .main-contain #content{
	  	  		<?php if(!empty($padding_top)): ?>padding-top:<?php echo esc_attr($padding_top); endif;?>;
	  	  		<?php if(!empty($padding_bottom)): ?>padding-bottom:<?php echo esc_attr($padding_bottom); endif;?>;
	  	  	}
	  	  </style>	
	  	<?php
	  	}

   		if($footer_padd_top != '' || $footer_padd_bottom != ''){
 	  	?>
 	  	  <style>
 	  	  	.reactheme-footer .footer-top{
 	  	  		<?php if(!empty($footer_padd_top)): ?>padding-top:<?php echo esc_attr($footer_padd_top); endif;?>;
 	  	  		<?php if(!empty($footer_padd_bottom)): ?>padding-bottom:<?php echo esc_attr($footer_padd_bottom); endif;?>;
 	  	  	}
 	  	  </style>	
 	  	  <?php
 	 	} 		
  }
  	else{ 
		$padding_top        = get_post_meta(get_the_ID(), 'content_top', true);
		$padding_bottom     = get_post_meta(get_the_ID(), 'content_bottom', true);
		
		$footer_padd_top    = get_post_meta(get_the_ID(), 'footer_padd_top', true);
		$footer_padd_bottom = get_post_meta(get_the_ID(), 'footer_padd_bottom', true);

  		if($padding_top != '' || $padding_bottom != ''){
	  	?>
	  	  <style>
	  	  	.main-contain #content,
	  	  	body.reactheme-pages-btm-gap .main-contain #content{
	  	  		<?php if(!empty($padding_top)): ?>padding-top:<?php echo esc_attr($padding_top); endif;?>;
	  	  		<?php if(!empty($padding_bottom)): ?>padding-bottom:<?php echo esc_attr($padding_bottom); endif;?>;
	  	  	}
	  	  </style>	
	  	<?php
	  }

		if($footer_padd_top != '' || $footer_padd_bottom != ''){
	  	?>
	  	  <style>
	  	  	.reactheme-footer .footer-top{
	  	  		<?php if(!empty($footer_padd_top)): ?>padding-top:<?php echo esc_attr($footer_padd_top); endif;?> !important;
	  	  		<?php if(!empty($footer_padd_bottom)): ?>padding-bottom:<?php echo esc_attr($footer_padd_bottom); endif;?> !important;
	  	  	}
	  	  </style>	
	  	  <?php
	 	} 
  }
		$logo_bg_colors                 = get_post_meta(get_the_ID(), 'logo_bg_color', true);
		$logo_height                    = get_post_meta(get_the_ID(), 'logo_height_page', true);
		$sticky_logo_height             = get_post_meta(get_the_ID(), 'sticky_logo_height_page', true);
		
		$topbar_area_bg                 = get_post_meta(get_the_ID(), 'topbar-area-bg', true);
		$topbar_text_color              = get_post_meta(get_the_ID(), 'topbar-text-color', true);
		$topbar_link_hovercolors        = get_post_meta(get_the_ID(), 'topbar_link_hovercolor', true);
		$topbar_border_color            = get_post_meta(get_the_ID(), 'topbar-border-color', true);
		$topbar_button_bgs              = get_post_meta(get_the_ID(), 'topbar-button-bg', true);
		$topbar_button_texts            = get_post_meta(get_the_ID(), 'topbar-button-text', true);
		$topbar_button_bg_hovers        = get_post_meta(get_the_ID(), 'topbar-button-bg-hover', true);
		$topbar_button_text_hover       = get_post_meta(get_the_ID(), 'topbar-button-text-hover', true);
		
		$topbar_icons_color             = get_post_meta(get_the_ID(), 'topbar-icon-color', true);
		$topbar_social_color            = get_post_meta(get_the_ID(), 'topbar-social-icon-color', true);
		$topbar_social_hover_color      = get_post_meta(get_the_ID(), 'topbar-social-hovereactheme-color', true);
		
		$menu_bg_sbg                    = get_post_meta(get_the_ID(), 'menu-type-bg', true);
		$menu_texts_colors              = get_post_meta(get_the_ID(), 'menu-text-color', true);
		$menu_texts_hover_colors        = get_post_meta(get_the_ID(), 'menu-text-hover-color', true);
		$menu_border_colors             = get_post_meta(get_the_ID(), 'menu_border_color', true);
		$menu_bg_dropdowncolors         = get_post_meta(get_the_ID(), 'menu_bg_dropdowncolor', true);
		$menu_text_dropdowncolors       = get_post_meta(get_the_ID(), 'menu_text_dropdowncolor', true);
		
		
		$menu_sticky_bgcolors           = get_post_meta(get_the_ID(), 'menu_sticky_bgcolor', true);
		$menu_sticky_txtcolors          = get_post_meta(get_the_ID(), 'menu_type_sticky_textc', true);
		$menu_sticky_txt_hovercolors    = get_post_meta(get_the_ID(), 'menu_sticky_txt_hovercolor', true);
		
		
		$search_icon_colors             = get_post_meta(get_the_ID(), 'search-icon-color', true);
		$search_icon_color_hovers       = get_post_meta(get_the_ID(), 'search-icon-color-hover', true);

		$cart_icon_colors               = get_post_meta(get_the_ID(), 'cart-icon-color', true);
		$cart_icon_color_hovers         = get_post_meta(get_the_ID(), 'cart-icon-color-hover', true);


		$register_icon_colors           = get_post_meta(get_the_ID(), 'register-icon-color', true);
		$register_icon_color_hovers     = get_post_meta(get_the_ID(), 'register-icon-color-hover', true);
		
		
		
		$newsletter_bgs                 = get_post_meta(get_the_ID(), 'newsletter_bg', true);
		$newsletter_sub_colors          = get_post_meta(get_the_ID(), 'newsletter_sub_color', true);
		$newsletter_title_colors        = get_post_meta(get_the_ID(), 'newsletter_title_color', true);
		$input_bg_colors                = get_post_meta(get_the_ID(), 'input_bg_color', true);
		$input_placeholder_color        = get_post_meta(get_the_ID(), 'input_placeholder_color', true);
		$inputs_colors                  = get_post_meta(get_the_ID(), 'inputs_color', true);
		$button_n_bg_colors             = get_post_meta(get_the_ID(), 'button_n_bg_colors', true);
		$button_n_txt_colors            = get_post_meta(get_the_ID(), 'button_n_txt_colors', true);
		$button_n_bg_colors_hovers      = get_post_meta(get_the_ID(), 'button_n_bg_colors_hover', true);
		$button_n_txt_colors_hovers     = get_post_meta(get_the_ID(), 'button_n_txt_colors_hover', true);
		
		
		$header_hamburger_colors        = get_post_meta(get_the_ID(), 'head_hamburger_color', true);
		$header_hamburger_colors2       = get_post_meta(get_the_ID(), 'offcanvas-icon-color-hover', true);
		$head_hamburger_bg_coloras      = get_post_meta(get_the_ID(), 'head_hamburger_bg_color', true);
		$footer_title_color             = get_post_meta(get_the_ID(), 'footer_title_color', true);
		$footer_btn_bg_colors           = get_post_meta(get_the_ID(), 'footer_btn_bg_color', true);
		$footer_btn_text_colors         = get_post_meta(get_the_ID(), 'footer_btn_text_color', true);
		$footer_links_colors            = get_post_meta(get_the_ID(), 'footer_link_colorss', true);
		$footer_arrows_color            = get_post_meta(get_the_ID(), 'footer_in_bg_color', true);
		$footer_top_border_color        = get_post_meta(get_the_ID(), 'footer_top_border_color', true);
		$sticky_hamburger_color         = get_post_meta(get_the_ID(), 'sticky_hamburgers_color', true);
		$copyright_border_color         = get_post_meta(get_the_ID(), 'copyright_border', true);
		$footer_primary_hover           = get_post_meta(get_the_ID(), 'footer_primary_hover_color', true);
		$footer_border_color            = get_post_meta(get_the_ID(), 'footer_border_color', true);
		$footer_all_is_colors           = get_post_meta(get_the_ID(), 'footer_all_icon_colors', true);
		$footer_socials_bg_colorss      = get_post_meta(get_the_ID(), 'footer_socials_bg_colors', true);
		$footer_socials_ic_colors       = get_post_meta(get_the_ID(), 'footer_socials_icon_colors', true);

		$footer_socials_bg_hover_colors     = get_post_meta(get_the_ID(), 'footer_socials_hover_bg_colors', true);
		$footer_socials_icon_hover_colors       = get_post_meta(get_the_ID(), 'footer_socials_icon_hover_colors', true);

		
		
		$footer_txt_colors              = get_post_meta(get_the_ID(), 'footer_texts_color', true);
		$footer_in_icon_colors          = get_post_meta(get_the_ID(), 'footer_in_icon_color', true);
		$primary_colors                 = get_post_meta(get_the_ID(), 'primary-colors', true);
		
		$quote_button_bg_colors         = get_post_meta(get_the_ID(), 'quote_button_bg_color', true);
		$quote_button_colors            = get_post_meta(get_the_ID(), 'quote_button_color', true);
		$quote_button_bg_hover_colors   = get_post_meta(get_the_ID(), 'quote_button_bg_hover_color', true);
		$quote_button_hover_colors      = get_post_meta(get_the_ID(), 'quote_button_hover_color', true);
		$menu_text_hover_dropdowncolors = get_post_meta(get_the_ID(), 'menu_text_hover_dropdowncolor', true);
		$banner_title_color             = get_post_meta(get_the_ID(), 'banner_title_color', true);
		$banner_menu_color              = get_post_meta(get_the_ID(), 'banner_menu_color', true);
		
		if( empty($weiboo_option['enable_global'])) :

		?>

		<style>	 
	  	  	<?php 
  	  		if(!empty($logo_height)): ?>
				.header-logo .custom-logo-area img {					
		  	  		max-height:<?php echo esc_attr($logo_height);?> !important;
				}
			<?php endif; ?>
				
	  	  	<?php 
  	  		if(!empty($sticky_logo_height)): ?>
				.header-logo .custom-sticky-logo img {					
		  	  		max-height:<?php echo esc_attr($sticky_logo_height);?> !important;
				}
			<?php endif; ?>	

			<?php 
  	  		if(!empty($banner_title_color)): ?>
				body .reactheme-breadcrumbs .page-title {					
		  	  		color:<?php echo sanitize_hex_color($banner_title_color);?> !important;
				}
			<?php endif; ?>	

	  	  	<?php 
  	  		if(!empty($banner_menu_color)): ?>
  	  			body .reactheme-breadcrumbs .breadcrumbs-title .current-item,
				body .reactheme-breadcrumbs .breadcrumbs-title span a span {					
		  	  		color:<?php echo sanitize_hex_color($banner_menu_color);?> !important;
				}
				body .reactheme-breadcrumbs .breadcrumbs-title span a:after, 
  	  			body .reactheme-breadcrumbs .breadcrumbs-title span a:before {					
		  	  		background-color:<?php echo sanitize_hex_color($banner_menu_color);?> !important;
				}
			<?php endif; ?>	

	  	  	
	  		<?php 
	  	  		if(!empty($newsletter_bgs)): ?>
		  	  	body .reactheme-newsletter .newsletter-wrap{			  	  		
	  	  			background:<?php echo sanitize_hex_color($newsletter_bgs);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($newsletter_sub_colors)): ?>
		  	  	body .reactheme-newsletter .newsletter-wrap .sub-title{			  	  		
	  	  			color:<?php echo sanitize_hex_color($newsletter_sub_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($newsletter_title_colors)): ?>
		  	  	body .reactheme-newsletter .newsletter-wrap .title{			  	  		
	  	  			color:<?php echo sanitize_hex_color($newsletter_title_colors);?> !important;
		  	  	}
			<?php endif;?>	


			

	  		<?php 
	  	  		if(!empty($input_bg_colors)): ?>
		  	  	body .reactheme-newsletter .mc4wp-form-fields .newsletter-form input{			  	  		
	  	  			background:<?php echo sanitize_hex_color($input_bg_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($inputs_colors)): ?>
		  	  	body .mc4wp-form-fields .newsletter-form input{			  	  		
	  	  			color:<?php echo sanitize_hex_color($inputs_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($input_placeholder_color)): ?>
		  	  	::-webkit-input-placeholder {
		  	  	  	color:<?php echo esc_attr($input_placeholder_color);?> !important;
		  	  	}
		  	  	:-ms-input-placeholder {
		  	  	  	color:<?php echo esc_attr($input_placeholder_color);?> !important;
		  	  	}
		  	  	::placeholder {
		  	  	  	color:<?php echo esc_attr($input_placeholder_color);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($button_n_bg_colors)): ?>
		  	  	body .mc4wp-form-fields .newsletter-form button{			  	  		
	  	  			background:<?php echo sanitize_hex_color($button_n_bg_colors);?> !important;
		  	  	}
			<?php endif;?>
	  		

	  		<?php 
	  	  		if(!empty($button_n_txt_colors)): ?>
		  	  	body .mc4wp-form-fields .newsletter-form button{			  	  		
	  	  			color:<?php echo sanitize_hex_color($button_n_txt_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($button_n_bg_colors_hovers)): ?>
		  	  	body .mc4wp-form-fields .newsletter-form button:hover{			  	  		
	  	  			background:<?php echo sanitize_hex_color($button_n_bg_colors_hovers);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($button_n_txt_colors_hovers)): ?>
		  	  	body .reactheme-newsletter .mc4wp-form-fields .newsletter-form button:hover{			  	  		
	  	  			color:<?php echo sanitize_hex_color($button_n_txt_colors_hovers);?> !important;
		  	  	}
			<?php endif;?>


	  		<?php 
	  		if(!empty($footer_links_colors)): ?>
	  			body .reactheme-footer a, 
	  			body .reactheme-footer .footer-contact-ul li a, 
	  			body .reactheme-footer .widget.widget_nav_menu ul li a,
	  			body .reactheme-footer .menu-footer-menu-container #footer-menu li a{
	  				color:<?php echo sanitize_hex_color($footer_links_colors);?>;
	  			}
	  		<?php endif; ?>

	  		<?php 
	  	  		if(!empty($logo_bg_colors)): ?>
		  	  	body header#reactheme-header.header-style-4.header-style7 .logo-areas,
		  	  	body header#reactheme-header.header-style-4.header-style7 .logo-area, 
		  	  	body header#reactheme-header.header-style-4.header-style6 .logo-area, 
		  	  	body header#reactheme-header.header-style-4.header-style6 .logo-areas{			  	  		
	  	  			background:<?php echo esc_attr($logo_bg_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($footer_arrows_color)): ?>
		  	  	body .footer-subscribe input[type="submit"]{			  	  		
	  	  			background:<?php echo sanitize_hex_color($footer_arrows_color);?>;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($search_icon_colors)): ?>
		  	  	body #reactheme-header .sticky_search i:before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($search_icon_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($cart_icon_colors)): ?>
		  	  	body .menu-cart-area i{			  	  		
	  	  			color:<?php echo sanitize_hex_color($cart_icon_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($register_icon_colors)): ?>
		  	  	body .user-icons a{			  	  		
	  	  			color:<?php echo sanitize_hex_color($register_icon_colors);?> !important;
		  	  	}
			<?php endif;?>	

			<?php 
	  	  		if(!empty($register_icon_colors)): ?>
		  	  	body .user-icons a{			  	  		
	  	  			border-color:<?php echo sanitize_hex_color($register_icon_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($register_icon_color_hovers)): ?>
		  	  	body .user-icons a:hover{			  	  		
	  	  			color:<?php echo sanitize_hex_color($register_icon_color_hovers);?> !important;
		  	  	}
			<?php endif;?>	

			<?php 
	  	  		if(!empty($register_icon_color_hovers)): ?>
		  	  	body .user-icons a:hover{			  	  		
	  	  			border-color:<?php echo sanitize_hex_color($register_icon_color_hovers);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($cart_icon_colors)): ?>
		  	  	body #reactheme-header.header-style5 .menu-cart-area > a{			  	  		
	  	  			border-color:<?php echo sanitize_hex_color($cart_icon_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($cart_icon_colors)): ?>
		  	  	body #reactheme-header.header-style3 .menu-cart-area > a{			  	  		
	  	  			border-color:<?php echo sanitize_hex_color($cart_icon_colors);?> !important;
		  	  	}
			<?php endif;?>
			
			<?php 
	  	  		if(!empty($search_icon_color_hovers)): ?>
		  	  	body #reactheme-header .sticky_search:hover i:before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($search_icon_color_hovers);?> !important;
		  	  	}
			<?php endif;?>	

			<?php 
	  	  		if(!empty($cart_icon_color_hovers)): ?>
		  	  	body .menu-cart-area i:hover,
		  	  	#reactheme-header.header-style5 .menu-cart-area > a:hover i:before,
		  	  	body #reactheme-header.header-style5 .menu-cart-area > a:hover,
		  	  	body .header-style1.header-style3 .menu-cart-area i:hover{			  	  		
	  	  			color:<?php echo sanitize_hex_color($cart_icon_color_hovers);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($cart_icon_color_hovers)): ?>
		  	  	body #reactheme-header.header-style5 .menu-cart-area > a:hover{			  	  		
	  	  			border-color:<?php echo sanitize_hex_color($cart_icon_color_hovers);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($menu_border_colors)): ?>
		  	  	body #reactheme-header.header-style-3 .header-inner .box-layout{			  	  		
	  	  			border-color:<?php echo esc_attr($menu_border_colors);?>;
		  	  	}
			<?php endif;?>


	  		<?php 
	  	  		if(!empty($footer_in_icon_colors)): ?>
		  	  	body .footer-subscribe .paper-plane:before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_in_icon_colors);?>;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($footer_btn_bg_colors)): ?>
		  	  	body .footer-btn-wrap .footer-btn,
		  	  	body ul.footer_social li{			  	  		
	  	  			background:<?php echo sanitize_hex_color($footer_btn_bg_colors);?>;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($footer_btn_text_color)): ?>
		  	  	body .footer-btn-wrap .footer-btn,
		  	  	body .reactheme-footer .widget ul li .fa{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_btn_text_color);?>;
		  	  	}
			<?php endif;?>			

	  		<?php 
	  	  		if(!empty($menu_bg_dropdowncolors)): ?>
		  	  	body .menu-area .navbar ul li ul.sub-menu{			  	  		
	  	  			background:<?php echo sanitize_hex_color($menu_bg_dropdowncolors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($primary_colors)): ?>
	  	  		.reactheme-rev-btn2:after, 
	  	  		.reactheme-rev-btn2:before,
	  	  		.cate-slider-style3 .contents .vies-more a,
	  	  		.rev-btn:hover .reactheme-rev-btn1:after, 
	  	  		.rev-btn:hover .reactheme-rev-btn1:before,	  	  		
		  	  	body #top-to-bottom i, body .spinner,		  	  	
		  	  	.mfp-close-btn-in .mfp-close,
		  	  	#mobile_menu .submenu-button,
		  	  	body .reactheme-addon-slider .slick-dots li button,
		  	  	body .menu-wrap-off .inner-offcan .nav-link-container .close-button,
		  	  	.reactheme-footer .footer-top .mc4wp-form-fields input[type="submit"],
		  	  	ul.footer_social li a:hover,
		  	  	.reactheme-blog-grid1.blog-item .image-part span.date-full,
		  	  	.rsaddon-unique-slider.slider-style-1.rs-addon-slider .slick-next:hover, .rsaddon-unique-slider.slider-style-1.rs-addon-slider .slick-prev:hover,
		  	  	.reactheme-footer .footer-top h3.footer-title:before,		  	 
				body	.slick-slider .slick-dots li button{			  	  		
	  	  			background:<?php echo sanitize_hex_color($primary_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($primary_colors)): ?>
	  	  		body .faq-simple .elementor-accordion-item .elementor-tab-title.elementor-active{			  	  		
	  	  			background:<?php echo sanitize_hex_color($primary_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($primary_colors)): ?>
		  	  	body .rsaddon-unique-slider .blog-content .blog-footer .blog-meta i,
		  	  	.reactheme-footer .footer-contact-ul li i,
		  	  	.rev-btn:hover .reactheme-rev-btn1,		  	  
		  	  	.reactheme-portfolio-style3 .portfolio-item .portfolio-content h4 a:hover,		  	  	
		  	  	.reactheme-footer .recent-post-widget .show-featured .post-desc i,
		  	  	body .sidenav .footer-contact-ul li a:hover, .sidenav ul.footer_social li a:hover i,
		  	  	body .sidenav .widget_nav_menu ul > li.current-menu-item > a, .sidenav .widget_nav_menu ul > li > a:hover,
		  	  	body .about__paragraph2 a,
		  	  	.reactheme-footer .copyright a,
		  	  	.reactheme-footer a:hover, .reactheme-footer .widget.widget_nav_menu ul li a:hover,
		  	  	.menu-area .navbar ul li:hover a:before,
		  	  	.reactheme-blog-grid1.blog-item .blog-content .blog-meta span.author,
		  	  	.rsaddon-unique-slider .reactheme-blog-grid1.blog-item .cat_list ul li a,
		  	  	.reactheme-footer .footer-contact-ul li span.time{			  	  		
	  	  			color:<?php echo sanitize_hex_color($primary_colors);?> !important;
		  	  	}
		  	  	.reactheme-footer .footer-contact-ul li span.time{
		  	  		border-color:<?php echo sanitize_hex_color($primary_colors);?> !important;
		  	  	}

			<?php endif;?>


	  		

	  		<?php 
	  	  		if(!empty($menu_sticky_bgcolors)): ?>
		  	  	body #reactheme-header .menu-sticky.sticky .menu-area, 
		  	  	body #reactheme-header.header-style-3 .header-inner.sticky .box-layout,
		  	  	body #reactheme-header.header-style-3 .header-inner.sticky,
		  	  	body #reactheme-header.header-style-3.header-style-2 .sticky-wrapper .header-inner.sticky .box-layout{  		
	  	  			background:<?php echo sanitize_hex_color($menu_sticky_bgcolors);?> !important;
		  	  	}
			<?php endif;?>

	  		
			<?php 
	  	  		if(!empty($footer_all_is_colors)): ?>
		  	  	body .reactheme-footer .footer-contact-ul li i:before,
		  	  	body .reactheme-footer .recent-post-widget .show-featured .post-desc i{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_all_is_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($footer_all_is_colors)): ?>
		  	  	body .reactheme-footer .widget.widget_nav_menu ul li a::before, 
		  	  	body .reactheme-footer .widget.widget_pages ul li a::before, 
		  	  	body .reactheme-footer .widget.widget_archive ul li a::before, 
		  	  	body .reactheme-footer .widget.widget_categories ul li a::before{			  	  		
	  	  			background:<?php echo sanitize_hex_color($footer_all_is_colors);?> !important;
		  	  	}
			<?php endif;?>


	  		<?php 
	  	  		if(!empty($menu_sticky_txt_hovercolors)): ?>
	  	  		body #reactheme-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a, 
	  	  		body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a, 
	  	  		body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a, 
	  	  		body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li.current_page_item > a,
	  	  		body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li.current-menu-item page_item a, 
	  	  		body #reactheme-header.header-style-4 .menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a, 
	  	  		body #reactheme-header.header-style-4 .menu-sticky.sticky .menu-area .menu > li.current-menu-ancestor > a,
	  	  		body #reactheme-header.header-style5 .menu-area .navbar ul > li.current-menu-ancestor > a, 
	  	  		body #reactheme-header .header-inner.menu-sticky.sticky .menu-area .navbar ul li:hover::after,
	  	  		body #reactheme-header.header-style5 .header-inner .menu-area .navbar ul > li.current-menu-ancestor > a, 
	  	  		body #reactheme-header.header-style5 .header-inner.menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
	  	  		body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a,
		  	  	body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul > li:hover > a, 
		  	  	body #reactheme-header.header-style-4 .header-inner.sticky .btn_quote .toolbar-sl-share ul > li a:hover, 
		  	  	body #reactheme-header.header-style-4 .header-inner.sticky .menu-cart-area i:hover, 
		  	  	body #reactheme-header.header-style-4 .header-inner.sticky .sidebarmenu-search i:hover, 
		  	  	body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul li ul.submenu > li.current-menu-ancestor > a{
	  	  			color:<?php echo sanitize_hex_color($menu_sticky_txt_hovercolors);?> !important;
		  	  	}
			<?php endif;?>

			
			<?php 
	  	  		if(!empty($menu_sticky_txt_hovercolors)): ?>
		  	  	body #reactheme-header.header-style5 .header-inner.menu-sticky.stuck.sticky .navbar ul > li.menu-item-has-children.hover-minimize:hover > a:after,
		  	  	body #reactheme-header .header-inner.menu-sticky.stuck.sticky .navbar ul > li.menu-item-has-children.hover-minimize > a:after
		  	  	{			  	  		
	  	  			background:<?php echo sanitize_hex_color($menu_sticky_txt_hovercolors);?> !important;
		  	  	}
			<?php endif;?>
			
			


	  		<?php 
	  	  		if(!empty($menu_text_dropdowncolors)): ?>
		  	  	body .menu-area .navbar ul > li ul.sub-menu li > a,
		  	  	body #reactheme-header .menu-area .navbar ul li.mega ul li a, 
		  	  	body #reactheme-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a, 
		  	  	body #reactheme-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor li a,

		  	  	body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li a{
	  	  			color:<?php echo sanitize_hex_color($menu_text_dropdowncolors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($menu_text_hover_dropdowncolors)): ?>
	  	  		body #reactheme-header.header-style-4 .menu-area .navbar ul > li ul.sub-menu li.current_page_item a,
	  	  		body #reactheme-header .menu-area .navbar ul > li ul.sub-menu li.current_page_item a,
	  	  		body #reactheme-header .menu-area .navbar ul > li ul.sub-menu li.current_page_item a,
	  	  		body #reactheme-header .menu-area .navbar ul li ul.sub-menu li:hover > a,
		  	  	body #reactheme-header.single-header.header-style5 .menu-area .navbar ul li ul.sub-menu li:hover > a,
		  	  	body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li.current_page_item a,
		  	  	body #reactheme-header .menu-sticky.sticky .menu-area .navbar ul > li .sub-menu > li a:hover
		  	  	{
	  	  			color:<?php echo sanitize_hex_color($menu_text_hover_dropdowncolors);?> !important;
		  	  	}
			<?php endif;?>



	  		<?php 
	  	  		if(!empty($topbar_area_bg)): ?>
		  	  	body #reactheme-header .toolbar-area{			  	  		
	  	  			background:<?php echo sanitize_hex_color($topbar_area_bg);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($topbar_text_color)): ?>
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul.reactheme-contact-info li a, 
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li a, 
		  	  	body .tops-btn .btn_login a,
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul.reactheme-contact-info li,
		  	  	body #reactheme-header .toolbar-area,
		  	  	body #reactheme-header .toolbar-area .toolbar-sl-share ul li,
		  	  	body #reactheme-header .toolbar-area .toolbar-sl-share ul li a.quote-buttons,
		  	  	body #reactheme-header.header-style5 .toolbar-area .opening,
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li i, 
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li i:before, 
		  	  	body #reactheme-header .toolbar-area .toolbar-sl-share ul li a.quote-buttons::before,
		  	  	body #reactheme-header .toolbar-area .toolbar-sl-share ul li a i{			  	  		
	  	  			color:<?php echo sanitize_hex_color($topbar_text_color);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($topbar_link_hovercolors)): ?>
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul.reactheme-contact-info li a:hover, 
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li a:hover, 
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li:hover i:before,
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li i:hover, 
		  	  	body .tops-btn .btn_login a:hover,
		  	  	body #reactheme-header .toolbar-area .toolbar-sl-share ul li a i:hover{			  	  		
	  	  			color:<?php echo sanitize_hex_color($topbar_link_hovercolors);?> !important;
		  	  	}
			<?php endif;?>


	  		<?php 
	  	  		if(!empty($topbar_border_color)): ?>
		  	  	body #reactheme-header .toolbar-area .toolbar-contact ul li,
		  	  	body #reactheme-header .toolbar-area .opening,
		  	  	body #reactheme-header.header-style5 .toolbar-area,
		  	  	body #reactheme-header.header-style5 .toolbar-area .opening{			  	  		
	  	  			border-color:<?php echo esc_attr($topbar_border_color);?> !important;
		  	  	}
			<?php endif;?>

	  		

	  		<?php 
	  	  		if(!empty($topbar_social_color)): ?>
		  	  	body .toolbar-area .toolbar-sl-share i, 
		  	  	body .toolbar-area .toolbar-sl-share i::before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($topbar_social_color);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($topbar_social_hover_color)): ?>
		  	  	body .toolbar-area .toolbar-sl-share i:hover, 
		  	  	body .toolbar-area .toolbar-sl-share a:hover i:before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($topbar_social_hover_color);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($topbar_icons_color)): ?>
		  	  	body .toolbar-area .toolbar-contact i, 
		  	  	body .toolbar-area .opening i, 
		  	  	body .toolbar-area .opening i:before, 
		  	  	body .toolbar-area .toolbar-contact i::before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($topbar_icons_color);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($topbar_button_bgs)): ?>
		  	  	body .tops-btn .quote-buttons{			  	  		
	  	  			background:<?php echo sanitize_hex_color($topbar_button_bgs);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($topbar_button_texts)): ?>
		  	  	body .tops-btn .quote-buttons{			  	  		
	  	  			color:<?php echo sanitize_hex_color($topbar_button_texts);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($topbar_button_bg_hovers)): ?>
		  	  	body .tops-btn .quote-buttons:hover{			  	  		
	  	  			background:<?php echo esc_attr($topbar_button_bg_hovers);?> !important;
		  	  	}
			<?php endif;?>	

			<?php 
	  	  		if(!empty($topbar_button_text_hover)): ?>
		  	  	body .tops-btn .quote-buttons:hover{			  	  		
	  	  			color:<?php echo esc_attr($topbar_button_text_hover);?> !important;
		  	  	}
			<?php endif;?>


	  		<?php 
	  	  		if(!empty($menu_texts_colors)): ?>
		  	  	body .menu-area .navbar ul > li > a,
		  	  	body #reactheme-header.header-style-3 .reactheme-contact-location i.phone-icon::before,
		  	  	body #reactheme-header.header-style-3 .reactheme-contact-location .contact-inf a,
		  	  	body #reactheme-header.header-style1 .category-menu .menu li::after, 
		  	  	body #reactheme-header.header-style-4 .category-menu .menu li::after,
		  	  	body #reactheme-header.header-style5 .sticky_search i::before{			  	  		
	  	  			color:<?php echo sanitize_hex_color($menu_texts_colors);?> !important;
		  	  	}
			<?php endif;?>


	  		<?php 
	  	  		if(!empty($menu_texts_hover_colors)): ?>
		  	  	body .menu-area .navbar ul > li:hover > a,
		  	  	#reactheme-header.header-style5 .menu-area .navbar ul > li.current_page_item ul > a, 
		  	  	#reactheme-header .menu-area .navbar ul li.mega ul > li > a:hover, 
		  	  	.menu-area .navbar ul li ul.sub-menu li:hover > a, 
		  	  	#reactheme-header.header-style5 .stuck.sticky .menu-area .navbar ul > li.active a, 
		  	  	#reactheme-header .menu-area .navbar ul > li.active a,
		  	  	body #reactheme-header.header-style1 .category-menu .menu li:hover:after, 
		  	  	body #reactheme-header.header-style-4 .category-menu .menu li:hover:after,
		  	  	#reactheme-header .menu-area .navbar ul li.mega ul li a:hover, 
		  	  	body .menu-area .navbar ul > li.current-menu-ancestor > a,
		  	  	#reactheme-header.header-style5 .menu-area .navbar ul > li.current-menu-ancestor > a, 
		  	  	#reactheme-header.header-style5 .header-inner .menu-area .navbar ul > li.current-menu-ancestor > a, 
		  	  	#reactheme-header .menu-area .navbar ul li.mega ul > li.current-menu-item > a,  
		  	  	#reactheme-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor li a:hover,
		  	  	body #reactheme-header.header-style-4 .menu-area .menu > li.current_page_item > a,
		  	  	body #reactheme-header.header-style-3 .reactheme-contact-location .contact-inf a:hover,
		  	  	body #reactheme-header .menu-area .menu > li.current_page_item > a
		  	  	{			  	  		
	  	  			color:<?php echo sanitize_hex_color($menu_texts_hover_colors);?> !important;
		  	  	}
			<?php endif;?>		

	  		<?php 
	  	  		if(!empty($menu_sticky_txtcolors)): ?>
		  	  	body #reactheme-header .header-inner.sticky .menu-area .navbar ul li a,
		  	  	body #reactheme-header.header-style1 .header-inner.sticky .category-menu .menu li:after,
		  	  	body #reactheme-header.header-style-4 .header-inner.sticky .category-menu .menu li:after{
	  	  			color:<?php echo sanitize_hex_color($menu_sticky_txtcolors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($menu_sticky_txtcolors)): ?>
		  	  	body .header-inner.sticky .offcanvas-icon span.dot1, 
		  	  	body .header-inner.sticky .offcanvas-icon span.dot2, 
		  	  	body .header-inner.sticky .offcanvas-icon span.dot3{
	  	  			background:<?php echo sanitize_hex_color($menu_sticky_txtcolors);?> !important;
		  	  	}
			<?php endif;?>		

	  		<?php 
	  	  		if(!empty($menu_texts_hover_colors)): ?>
		  	  	body #reactheme-header.header-style5 .header-inner .menu-area .navbar ul > li.menu-item-has-children.hover-minimize:hover > a:after,
		  	  	body #reactheme-header .menu-area .navbar ul > li.menu-item-has-children.hover-minimize > a:after
		  	  	{			  	  		
	  	  			background:<?php echo sanitize_hex_color($menu_texts_hover_colors);?> !important;
		  	  	}
			<?php endif;?>			

	  		<?php 
	  	  		if(!empty($footer_socials_bg_colorss)): ?>
		  	  	body #reactheme-footer ul.footer_social li a
		  	  	{			  	  		
	  	  			background:<?php echo sanitize_hex_color($footer_socials_bg_colorss);?> !important;
		  	  	}
			<?php endif;?>	

			<?php if(!empty( $footer_socials_bg_hover_colors )):  ?>
				body #reactheme-footer ul.footer_social li a:hover{
					background: <?php echo sanitize_hex_color( $footer_socials_bg_hover_colors ); ?> !important;
				}
			<?php endif;?>	

			<?php if(!empty( $footer_socials_icon_hover_colors )): ?>
				body #reactheme-footer ul.footer_social li a{
					color: <?php echo sanitize_hex_color( $footer_socials_icon_hover_colors ); ?> !important;
				}
			<?php endif;?>	

	  		<?php 
	  	  		if(!empty($footer_socials_ic_colors)): ?>
		  	  	body #reactheme-footer ul.footer_social li a
		  	  	{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_socials_ic_colors);?> !important;
		  	  	}
			<?php endif;?>			


	  		<?php 
	  	  		if(!empty($quote_button_bg_colors)): ?>
		  	  	body #reactheme-header .btn_quote a,
		  	  	body #reactheme-header.header-style1.header1 .btn_apply a{			  	  		
	  	  			background:<?php echo sanitize_hex_color($quote_button_bg_colors);?> !important;
		  	  	}
		  	  	#reactheme-header .btn_quote a{
		  	  		border-color:<?php echo sanitize_hex_color($quote_button_bg_colors);?> !important;
		  	  	}
			<?php endif;?>

	  		<?php 
	  	  		if(!empty($quote_button_colors)): ?>
		  	  	body #reactheme-header .btn_quote a,
		  	  	body #reactheme-header.header-style1.header1 .btn_apply a{			  	  		
	  	  			color:<?php echo sanitize_hex_color($quote_button_colors);?> !important;
		  	  	}

			<?php endif;?>

	  		<?php 
	  	  		if(!empty($quote_button_bg_hover_colors)): ?>
		  	  	body #reactheme-header .btn_quote a:hover,
		  	  	body #reactheme-header.header-style1.header1 .btn_apply a:hover{			  	  		
	  	  			background:<?php echo sanitize_hex_color($quote_button_bg_hover_colors);?> !important;
		  	  	}
		  	  	#reactheme-header .btn_quote a:hover{
		  	  		border-color:<?php echo sanitize_hex_color($quote_button_bg_hover_colors);?> !important;
		  	  	}
			<?php endif;?>
	  		<?php 
	  	  		if(!empty($quote_button_hover_colors)): ?>
		  	  	body #reactheme-header .btn_quote a:hover,
		  	  	#reactheme-header.header-style1.header1 .btn_apply a:hover{			  	  		
	  	  			color:<?php echo sanitize_hex_color($quote_button_hover_colors);?> !important;
		  	  	}
			<?php endif;?>

		
			<?php 
	  	  		if(!empty($footer_title_color)): ?>
		  	  	body .reactheme-footer .footer-top h3.footer-title,
		  	  	body .footer-subscribe .newsletter-title
		  	  	{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_title_color);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($footer_border_color)): ?>
		  	  	body .reactheme-footer .footer-top .mc4wp-form-fields input[type="email"]{			  	  		
	  	  			border-color:<?php echo esc_attr($footer_border_color);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($footer_top_border_color)): ?>
		  	  	body .footer-subscribe .subscribe-bg,
		  	  	body .footer-bottom .copyright_border,
		  	  	body .footer-bottom .container
		  	  	{			  	  		
	  	  			border-color:<?php echo esc_attr($footer_top_border_color);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($footer_border_color)): ?>
		  	  	body .footer-subscribe input[type="email"]{			  	  		
	  	  			border-color:<?php echo esc_attr($footer_border_color);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($footer_txt_colors)): ?>
		  	  	body .reactheme-footer .footer-top, 
		  	  	body .footer-bottom .copyright p,
		  	  	body .reactheme-footer .footer-top .mc4wp-form-fields i,
		  	  	body .reactheme-footer .footer-top .mc4wp-form-fields input[type=email]::placeholder,
		  	  	body .reactheme-footer .footer-top .mc4wp-form-fields input[type=email],
		  	  	body .reactheme-footer .footer-top .mc4wp-form-fields input[type=text]::placeholder,
		  	  	body .reactheme-footer .footer-top .mc4wp-form-fields input[type=text],
		  	  	.footer-top ul.footer_social > li > a,
		  	  	.reactheme-footer .recent-post-widget .show-featured .post-desc a,
		  	  	.reactheme-footer .recent-post-widget .show-featured .post-desc span,
		  	  	body .reactheme-footer{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_txt_colors);?> !important;
		  	  	}
			<?php endif;?>

			<?php 
	  	  		if(!empty($footer_btn_text_colors)): ?>
		  	  	body #reactheme-footer .footer-btn-wrap a.footer-btn{			  	  		
	  	  			color:<?php echo sanitize_hex_color($footer_btn_text_colors);?> !important;
		  	  	}
			<?php endif;?>

			

			<?php 
	  	  		if(!empty($footer_txt_colors)): ?>
		  	  	body .footer-subscribe input[type="email"]::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  	  		color:<?php echo sanitize_hex_color($footer_txt_colors);?> !important;
		  	  	}
		  	  	body .footer-subscribe input[type="email"]::-moz-placeholder { /* Firefox 19+ */
		  	  		color:<?php echo sanitize_hex_color($footer_txt_colors);?> !important;
		  	  	}
		  	  	body .footer-subscribe input[type="email"]:-ms-input-placeholder { /* IE 10+ */
		  	  		color:<?php echo sanitize_hex_color($footer_txt_colors);?> !important;
		  	  	}
		  	  	body .footer-subscribe input[type="email"]:-moz-placeholder { /* Firefox 18- */
		  	  	  	color:<?php echo sanitize_hex_color($footer_txt_colors);?> !important;
		  	  	}
			<?php endif;?>


			<?php 
	  	  		if(!empty($copyright_border_color)): ?>
		  	  	body .footer-bottom{			  	  		
	  	  			border-color:<?php echo esc_attr($copyright_border_color);?> !important;
		  	  	}
			<?php endif;?>

			
			<?php 
	  	  		if(!empty($menu_sticky_txt_hovercolors)): ?>
		  	  	body #reactheme-header .header-inner.sticky .category-menu .menu li:hover:after, 
		  	  	body #reactheme-header.header-style1 .header-inner.sticky .category-menu .menu li:hover::after, 
		  	  	body #reactheme-header.header-style-4 .header-inner.sticky .category-menu .menu li:hover::after
		  	  	{			  	  		
	  	  			color:<?php echo sanitize_hex_color($menu_sticky_txt_hovercolors);?> !important;
		  	  	}
			<?php endif;?>	

			<?php 
	  	  		if(!empty($menu_sticky_txt_hovercolors)): ?>
		  	  	body #reactheme-header .header-inner.sticky ul.offcanvas-icon a:hover span.dot1, 
		  	  	body #reactheme-header .header-inner.sticky ul.offcanvas-icon a:hover span.dot2, 
		  	  	body #reactheme-header .header-inner.sticky ul.offcanvas-icon a:hover span.dot3
		  	  	{			  	  		
	  	  			background:<?php echo sanitize_hex_color($menu_sticky_txt_hovercolors);?> !important;
		  	  	}
			<?php endif;?>

	  	  	<?php 
  	  		if(!empty($footer_primary_hover)): ?>
				.footer-top ul.footer_social > li > a:hover,
				.reactheme-blog .blog-meta .blog-title a:hover,
				.reactheme-footer.footerdark .footer-top .widget.widget_nav_menu ul li a:hover,
				.reactheme-footer a:hover,
				.reactheme-footer .widget a:hover,
				body .reactheme-footer .recent-post-widget .show-featured .post-desc a:hover,
				.reactheme-footer .footer-contact-ul li a:hover,
				.reactheme-footer.footerdark .footer-bottom .copyright p a:hover,
				.reactheme-footer.footerdark .footer-top .footer-contact-ul li a:hover,
				.reactheme-footer.footerdark .footer_social li a:hover .fa,
				ul.unorder-list li:before {					
		  	  		color:<?php echo sanitize_hex_color($footer_primary_hover);?> !important;
				}
			<?php endif; ?>
		  	</style>
	<?php endif;
}
?>