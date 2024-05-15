<div class="rt-image--card card-style-2">
	<div class="shop-now-box shop-now-box2">
		<a href="<?php echo esc_url($card_link); ?>" class="picture">
			
			<?php
				if( !empty($img_link) ){
					?>
					<img src="<?php echo esc_url($img_link); ?>" alt="shop-now">
				<?php
				}
			?>			
		</a>
		<div class="contents">
			<?php
				if( !empty($card_subtitle) ){
				?>
				<span class="collection-text-2 sub--title"><?php echo wp_kses_post($card_subtitle); ?></span>
				<?php
				}
			
				if( !empty($card_title) ){
				?>
				<h2 class="title"><?php echo wp_kses_post($card_title); ?></h2>
				<?php
				}
				if( !empty($card_btn_text) ){
				?>
				<a href="<?php echo esc_url($card_link); ?>" class="shop-now-btn shop-now-btn1"><?php echo wp_kses_post($card_btn_text); ?></a>
				<?php
				}
			?>
		</div>
	</div>
</div>
