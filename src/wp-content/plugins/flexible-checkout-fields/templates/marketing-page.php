<?php
/**
 * @var WPDesk\FlexibleSubscriptions\Vendor\WPDesk\Library\Marketing\Boxes\MarketingBoxes $boxes
 */

defined( 'ABSPATH' ) || exit;
?>
<style>
#marketing-page-wrapper {
	max-width: 1100px;
}

#marketing-page-wrapper header ol, #marketing-page-wrapper header ul {
	padding: 16px;
}

#marketing-page-wrapper header li {
	margin-bottom: 6px;
}

#marketing-page-wrapper header h3 {
	margin: 1em 0;
}

</style>
<div class="wrap">
	<div id="marketing-page-wrapper">
		<?php echo wp_kses_post( $boxes->get_boxes()->get_all() ); ?>
	</div>
</div>
