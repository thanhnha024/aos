<div class="react-addon-services services-<?php echo esc_attr( $settings['services_style'] ); ?>">
    <div class="services-part">
	<a href="product-details.html" class="product-box product-box-medium product-box-medium2">
		<div class="contents">
			<?php if(!empty($settings['title_prefix'])) : ?>
				<span class="pretitle"><?php echo $settings['title_prefix']; ?></span>
			<?php endif; ?>
			<h1 class="product-title"><?php echo wp_kses_post($settings['title']);?></h1>

			<div class="view-collections go-btn">
				<?php echo wp_kses_post($settings['services_btn_text']);?>
			</div>
		</div>
		<div class="product-thumb">
			<img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="product-thumb">
		</div>
	</a>
	</div>
</div>

