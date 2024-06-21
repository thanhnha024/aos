<?php

/**
 * Admin new order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order);
$is_enquiry_order = 'yes' === $order->get_meta('_is_enquiry_order');
$email_title = $is_enquiry_order ? 'Request a quote #1' . $order->get_order_number() : $email_heading;


/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action('woocommerce_email_header', $email_title, $email); ?>

<?php /* translators: %s: Customer billing full name */ ?>
<?php if ($is_enquiry_order): ?>
    <p><?php printf(esc_html__('You have received a quote request from %s:', 'woocommerce'), $order->get_formatted_billing_full_name()); ?></p>
<?php else: ?>
    <p><?php printf(esc_html__('You have received the following order from %s:', 'woocommerce'), $order->get_formatted_billing_full_name()); ?></p>
<?php endif; ?>
<?php

/*
 * Output order details
 */
// do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

?>

<h2><?php echo $email_title ?></h2>
<table cellspacing="0" cellpadding="6" style="width: 100%; margin-bottom: 30px" border="1">
	<thead>
		<tr>
			<th scope="col" style="text-align:left;"><?php esc_html_e('Product', 'woocommerce'); ?></th>
			<th scope="col" style="text-align:left;"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
			<?php if (!$is_enquiry_order) : ?>
				<th scope="col" style="text-align:left;"><?php esc_html_e('Price', 'woocommerce'); ?></th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($order->get_items() as $item_id => $item) {
			// Skip over shipping and fee lines.
			if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
				continue;
			}
		?>
			<tr>
				<td style="text-align:left;"><?php
												// Product name.
												echo wp_kses_post(apply_filters('woocommerce_order_item_name', $item->get_name(), $item, false));

												// Product SKU.
												if ($is_enquiry_order && is_object($item->get_product()) && $item->get_product()->get_sku()) {
													echo ' (#' . $item->get_product()->get_sku() . ')';
												}
												?></td>
				<td style="text-align:left;"><?php echo esc_html($item->get_quantity()); ?></td>
				<?php if (!$is_enquiry_order) : ?>
					<td style="text-align:left;"><?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?></td>
				<?php endif; ?>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>
<?php




/*
 * Output order meta
 */
do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);

/*
 * Output customer details
 */
do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);

/*
 * Output additional content
 */
if ($additional_content) {
	echo wp_kses_post(wpautop(wptexturize($additional_content)));
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action('woocommerce_email_footer', $email);
