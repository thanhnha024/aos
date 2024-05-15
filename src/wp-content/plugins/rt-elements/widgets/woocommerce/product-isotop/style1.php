<div data-rating="<?php echo $arating; ?>" data-sell="<?php echo $price; ?>" class="element-item col-xxl-<?php echo esc_html($settings['product_columns']);?> col-lg-3 col-md-6 col-xs-1 grid-item <?php echo $filter_class;?>">
	<div class="product-item content-overlay">
		<?php if(has_post_thumbnail()): ?>
			<div class="product-img<?php echo esc_attr($star_align); ?>">
			<?php
			if(empty($gallery)){
				?>
				<a href="<?php the_permalink();?>" class="feature--image">					
					<?php echo get_the_post_thumbnail( get_the_ID(),$settings['thumbnail_size']);?>
				</a>						
				<?php
				if( !empty($p2ndImg) ){
					$img2_link = wp_get_attachment_image_src( $p2ndImg, $settings['thumbnail_size'] )[0];

					?>
					<a href="<?php the_permalink();?>" class="p-2nd--image">
						<img src="<?php echo esc_url($img2_link);?>" alt="Product 2nd Image">
					</a>						
					<?php
				}
			}else{
				?>
				<div class="product-image--slider">
					<div class="swiper-wrapper">
						<?php
						foreach( $gallery as $pimage ){
						// Display the image URL
							$link = wp_get_attachment_image_src($pimage, $settings['thumbnail_size'])[0];
							// Display Image instead of URL
							?>
							<div class="swiper-slide">
							<a href="<?php the_permalink();?>" class="feature--image">
								<img src="<?php echo esc_url($link) ;?>" alt="">
							</a>
							</div>
							<?php
						}
						?>
					</div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
				<?php
			}
				if ( $product->is_on_sale() )  {    
					?>
					<div class="sale--box">
						<?php woocommerce_show_product_loop_sale_flash();?>
					</div>	 
					<?php
				}
			?>
				<div class="quick-wish">
					<div class="weiboo-quick">
						<?php if ( function_exists( 'YITH_WCQV_Frontend' ) && $weiboo_option['wc_quickview_icon']  ): ?>
							<a href="" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() );?>"><i class="far fa-eye"></i></a>
						<?php endif; ?>
					</div>
					<div class="weiboo-wishlist">
						<?php if ( class_exists( 'YITH_WCWL_Shortcode' ) && $weiboo_option['wc_wishlist_icon'] ): ?>
							<?php
								$args = array(
									'browse_wishlist_text' => '<i class="fa fa-check"></i>',
									'already_in_wishslist_text' => '',
									'product_added_text' => '',
									'icon' => 'fa-heart-o',
									'label' => '',
									'link_classes' => 'add_to_wishlist single_add_to_wishlist alt wishlist-icon',
								);
							?>
							<?php echo YITH_WCWL_Shortcode::add_to_wishlist( $args );?>	
							<?php endif; ?>
					</div>
				</div>	 
			</div>
		<?php endif;?>
		<div class="product-content<?php echo esc_attr($align_class); ?>">
			<div class="vertical-middle">
				<div class="vertical-middle-cell">
					
					<?php if($show_cat == 'yes'):?>
						<div class="product_cats">
							<?php echo get_the_term_list( $post->ID, 'product_cat', '', ', ' ); ?>
						</div>
					<?php endif;?>
					<?php if(get_the_title()):?>
						<h4 class="p-title" data-sell="<?php echo $arating; ?>"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					<?php endif;?>
					<div class="price--cart">
						<p class="price-html"><?php echo $product->get_price_html(); ?></p>
						<div class="add_to__cart">
							<?php echo do_shortcode( '[add_to_cart id='.$post_id.' show_price="false"]' );?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>