<div class="rts-posters-section rt-image--card">
	<a href="<?php echo esc_url($card_link); ?>" class="product-box product-box-medium product-box-medium2">
		<div class="contents">
		<?php
			if( !empty($card_subtitle) ){
			?>
			<span class="pretitle sub--title"><?php echo wp_kses_post($card_subtitle); ?></span>
			<?php
			}
		
			if( !empty($card_title) ){
			?>
			<h1 class="product-title title"><?php echo wp_kses_post($card_title); ?></h1>
			<?php
			}
			if( !empty($card_btn_text) ){
			?>
			<div class="view-collections go-btn shop-now-btn">
				<?php echo wp_kses_post($card_btn_text); ?>
			</div>
			<?php
			}
		?>
		</div>
		<div class="product-thumb">
			<?php
				if( !empty($img_link) ){
					?>
					<img src="<?php echo esc_url($img_link); ?>" alt="shop-now">
				<?php
				}
			?>
		</div>
	</a>
</div>