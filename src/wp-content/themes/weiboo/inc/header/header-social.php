<?php
global $weiboo_option;
$top_social = $weiboo_option['show-social']; ?>
<div class="header-share">
	<ul class="clearfix">

	<?php 
		if($top_social == '1'){              
		if(!empty($weiboo_option['facebook'])) { ?>
			<li> <a href="<?php echo esc_url($weiboo_option['facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a> </li>
			<?php 
		}

		if(!empty($weiboo_option['twitter'])) { ?>
			<li> <a href="<?php echo esc_url($weiboo_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> </li>
			<?php
		}

		if(!empty($weiboo_option['rss'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> </li>
		<?php
		}

		if (!empty($weiboo_option['pinterest'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> </li>
		<?php }

		if (!empty($weiboo_option['linkedin'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> </li>
		<?php }

		if (!empty($weiboo_option['google'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> </li>
		<?php }

		if (!empty($weiboo_option['instagram'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> </li>
		<?php }

		if(!empty($weiboo_option['vimeo'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo"></i></a> </li>
		<?php }

		if (!empty($weiboo_option['tumblr'])) { ?>
			<li> <a href="<?php  echo esc_url($weiboo_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr"></i></a> </li>
		<?php }

		if (!empty($weiboo_option['youtube'])) { ?>
		<li> <a href="<?php  echo esc_url($weiboo_option['youtube']);?> " target="_blank"><i class="fa fa-youtube"></i></a> </li>
		<?php } 
	} ?>
	</ul>
</div>