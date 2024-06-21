<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$order = wc_get_order($order);
$is_enquiry_order = 'yes' === $order->get_meta('_is_enquiry_order');
$email_title = $is_enquiry_order ? 'Request a quote #3' . $order->get_order_number() : $email_heading;
$heading = $is_enquiry_order ? 'Thank you for requesting a quote' : $email_heading;
/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>

<?php if ($is_enquiry_order): ?>
	<?php /* translators: %s: Order number */ ?>
	<p><?php printf( esc_html__( 'Just to let you know &mdash; we\'ve received your quote request #%s, and it is now being processed:', 'woocommerce' ), esc_html( $order->get_order_number() ) ); ?></p>
<?php else: ?>
    <?php /* translators: %s: Order number */ ?>
<p><?php printf( esc_html__( 'Just to let you know &mdash; we\'ve received your order #%s, and it is now being processed:', 'woocommerce' ), esc_html( $order->get_order_number() ) ); ?></p>
<?php endif; ?>
<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
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
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
?>