<?php

namespace WPDesk\FCF\Free\Settings\Option;

use WPDesk\FCF\Free\Settings\Tab\LogicTab;

/**
 * {@inheritdoc}
 */
class LogicAdvOption extends OptionAbstract {

	const FIELD_NAME = 'conditional_logic_adv';

	/**
	 * {@inheritdoc}
	 */
	public function get_option_name(): string {
		return self::FIELD_NAME;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_option_tab(): string {
		return LogicTab::TAB_NAME;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_option_type(): string {
		return self::FIELD_TYPE_INFO_ADV;
	}

	public function get_option_label(): string {
		$url            = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-section-custom-upgrade' );
		$url_woo_fields = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-woocommerce-default-upgrade' );
		$url_cart       = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-cart-upgrade' );
		$url_user       = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-user-role-upgrade' );
		$url_shipping   = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-shipping-upgrade' );
		$url_payment    = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-payment-upgrade' );
		$url_date       = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-date-upgrade' );
		$url_fields     = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-fcf-upgrade' );
		$url_fpf        = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-docs-fpf-upgrade' );
		$url_upgrade    = apply_filters( 'flexible_checkout_fields/short_url', '#', 'fcf-settings-field-tab-logic-upgrade' );

		return '<p>' . __( 'Set multiple conditions <b>(OR)</b> under one or more condition groups <b>(AND)</b>. Add conditional logic based on:', 'flexible-checkout-fields' ) . '</p>
			<ul>
				<li><a href="' . esc_url( $url_woo_fields ) . '" target="_blank">' . _x( 'WooCommerce default fields', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_cart ) . '" target="_blank">' . _x( 'Cart', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_user ) . '" target="_blank">' . _x( 'User role', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_shipping ) . '" target="_blank">' . _x( 'Shipping method', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_payment ) . '" target="_blank">' . _x( 'Payment method', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_date ) . '" target="_blank">' . _x( 'Date', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_fields ) . '" target="_blank">' . _x( 'Flexible Checkout Fields’ fields', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
				<li><a href="' . esc_url( $url_fpf ) . '" target="_blank">' . _x( 'Flexible Product Fields’ fields', 'pro-features-list', 'flexible-checkout-fields' ) . '</a></li>
			</ul>
			<p><a href="' . esc_url( $url_upgrade ) . '" target="_blank" class="fcfArrowLink">' . __( 'Upgrade to PRO', 'flexible-checkout-fields' ) . '</a>
		</p>';
	}
}
