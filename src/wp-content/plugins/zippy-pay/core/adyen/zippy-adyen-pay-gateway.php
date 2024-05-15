<?php

namespace ZIPPY_Pay\Core\Adyen;

use WC_Order;
use WC_Payment_Gateway;
use ZIPPY_Pay\Core\Adyen\ZIPPY_Pay_Adyen;
use ZIPPY_Pay\Core\ZIPPY_Pay_Core;
use WC_Admin_Settings;


defined('ABSPATH') || exit;


class ZIPPY_Adyen_Pay_Gateway extends WC_Payment_Gateway
{
	/**
	 * @var ZIPPY_Pay_Adyen_Config
	 */
	private $zippyConfigs;
	/**
	 * @var string
	 */
	private $merchant_id;

	/**
	 * @var string
	 */
	private $base_url;
	/**
	 * @var string
	 */
	private $secret_key;

	/**
	 * ZIPPY_Adyen_Pay_Gateway constructor.
	 */
	public function __construct()
	{
		$this->id           =  PAYMENT_ADYEN_ID;
		$this->method_title = __(PAYMENT_ADYEN_NAME, PREFIX . '_zippy_payment');
		$this->has_fields   = true;
		$this->init_form_fields();
		$this->init_settings();
		// $this->supports = ['refunds'];// not support refunds
		$this->title = PAYMENT_ADYEN_NAME;
		$this->method_description = __('', PREFIX . '_zippy_payment');
		$this->enabled         = $this->get_option('enabled');
		$this->merchant_id     = trim(WC_Admin_Settings::get_option(PREFIX . '_merchant_id'));
		$this->secret_key      = trim(WC_Admin_Settings::get_option(PREFIX . '_secret_key'));
		$this->base_url        = trim(WC_Admin_Settings::get_option(PREFIX .  '_base_url'));
		add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
		add_action('woocommerce_receipt_' . $this->id, [$this, 'receipt_page']);
		add_action('woocommerce_api_wc_zippy_redirect', [$this, 'handle_payment_redirect']);
	}

	/**
	 * Setup key form fields
	 *
	 */
	public function init_form_fields()
	{

		$this->form_fields = array(
			'enabled'         => array(
				'title'   => __('Enable ' . PAYMENT_ADYEN_NAME, PREFIX . '_zippy_payment'),
				'type'    => 'checkbox',
				'label'   => __('Enable ' . PAYMENT_ADYEN_NAME, PREFIX . '_zippy_payment'),
				'default' => 'no'
			)
		);
	}

	public function is_available()
	{
		return $this->is_gateway_configured();
	}

	/**
	 * Inlude payment data form UI
	 *
	 */
	public function payment_fields()
	{
		if ($this->is_available()) {

			$adyen = new ZIPPY_Pay_Adyen();

			$configs = $adyen->get_payment_config();

			echo ZIPPY_Pay_Core::get_template('payment-fields.php', [
				'configs' => 	$configs,
				'test' => 	'shin',
			], dirname(__FILE__), '/templates');
		}
	}

	/**
	 * Woocomerce process payment
	 *
	 */
	public function process_payment($order_id)
	{

		$order              = new WC_Order($order_id);
		$adyen_payment_data = $this->get_adyen_payment_data();
		$zippy              = new ZIPPY_Pay_Adyen();
		$result = $zippy->pay($order, $adyen_payment_data);

		// Failed Payment
		if (empty($result)) {
			$this->handle_payment_failed();
		}

		return $this->handle_do_payment($result, $order);
	}

	/**
	 *
	 * Handle payment after receive response from Zippy
	 * @param $result
	 *
	 * @param WC_Order $order
	 *
	 * @return mixed
	 */

	private function handle_do_payment($result, $order)
	{

		// Fail payment
		if ($result->StatusName === 'Fail') {
			return $this->handle_payment_failed();
		}

		$status = isset($result->Result->Status) ?  $result->Result->Status : $result->Result->ResultCode;

		$authorition = isset($result->Result->Status) ? 'Authorisation' : 'Authorised';

		//Process Payment
		switch ($status) {
			case $authorition:

				return $this->handle_validate_payment($result->Result, $order);
				break;

			case 'IdentifyShopper':
			case 'RedirectShopper':

				return $this->handle_redirect($result->Result, $order);
				break;

			case 'Pending':
			case 'Received':
				$result = handle_get_transaction_status($order);
				return $this->handle_do_payment($result, $order);
				break;

			default:

				return $this->handle_payment_failed();
				break;
		}
	}

	/**
	 * Handle do payment failed
	 *
	 * @return mixed
	 */

	private function handle_validate_payment($result, $order)
	{
		$order_id = strval($order->get_id());

		$amount   = floatval($order->get_total() * 100);

		$currency   = $order->get_currency();

		$order_id_response   = $result->OrderId;

		$amount_response   = $result->Amount;

		$currency_response   = $result->Currency;

		if (
			$order_id === $order_id_response &&
			$amount == $amount_response &&
			$currency == $currency_response
		) {
			return $this->handle_success_payment($result, $order);
		}
		$this->handle_payment_failed();
	}
	/**
	 * Handle do payment failed
	 *
	 * @return mixed
	 */

	private function handle_payment_failed()
	{

		$this->add_notice();
		return false;
	}

	/**
	 * Handle do payment success
	 *
	 * @param $result
	 *
	 * @param WC_Order $order
	 *
	 * @return mixed
	 */

	private function handle_success_payment($result, $order)
	{
		$order_id = $order->get_id();
		update_post_meta((int) $order_id, '_woocommerce_zippy_pay_data', $result);

		$order->payment_complete();
		$order->add_order_note(sprintf(__('Payment was complete via ' . PAYMENT_ADYEN_NAME, PREFIX . '_zippy_payment')));

		return [
			'result'   => 'success',
			'redirect' => $this->get_return_url($order)
		];
	}

	/**
	 * Woocomerce Custom receipt page support redirect.
	 *
	 */
	public function receipt_page($order_id)
	{
		$action = get_option('zippy_redirect_object_' . $order_id);

		if (!isset($action->url)) {
			return;
		}
		$endpoint = add_query_arg('wc-api', 'wc_adyen_redirect', trailingslashit(get_home_url()));

		$return_url = add_query_arg('order_id', $order_id, $endpoint);

		echo ZIPPY_Pay_Core::get_template('form-redirect.php', [
			'return_url' => 	$return_url,
			'action' => 	$action,
		], dirname(__FILE__), '/templates');
	}

	private function handle_redirect($result, $order)
	{

		$order_id = $order->get_id();

		update_option('zippy_redirect_object_' . $order_id, $result->Action);

		return  [
			'result'   => 'success',
			'redirect' => $order->get_checkout_payment_url(true)
		];
	}

	/**
	 * This is callback func called after authorization on adyen.
	 *
	 */
	public function handle_payment_redirect()
	{

		$order_id = intval($_REQUEST['order_id']);

		$order = new WC_Order($order_id);

		$action = get_option('zippy_redirect_object_' . $order_id);

		if (!$action) {
			wp_redirect($order->get_checkout_payment_url());
			exit;
		}

		$status = $this->handle_get_transaction_status($order);

		return $this->handle_do_payment_redirect($status, $order);
	}

	/**
	 * Handle get payment-status for payment case: pending,received and redirect
	 *
	 * @param $result
	 *
	 * @param WC_Order $order
	 *
	 * @return mixed
	 */
	private function handle_get_transaction_status($order)
	{
		$zippy     = new ZIPPY_Pay_Adyen($this->zippyConfigs);
		$order_key = $order->get_order_key();

		for ($i = 0; $i < 2; $i++) {

			if ($i > 0) sleep(5);

			$status = $zippy->get_transaction_status($order_key);

			if (isset($status->Result->Success) && $status->Result->Success === true) break;
		}

		return $status;
	}

	/**
	 * Handle payment redirect after authorization on adyen.
	 *
	 * @param $result
	 *
	 * @param WC_Order $order
	 *
	 * @return mixed
	 */

	private function handle_do_payment_redirect($status, $order)
	{

		$order_id = $order->get_id();
		// Fail payment
		if (isset($status) && $status->Result->Success === true) {

			delete_option('zippy_redirect_object_' .	$order_id);

			$order->add_order_note(sprintf(__('Payment was complete via ' . PAYMENT_ADYEN_NAME, PREFIX . '_zippy_payment')));

			$order->payment_complete();

			// should get payment details to log in the order.

			wp_redirect($this->get_return_url($order)); // Redirect to page thank you.
		}

		//Process Payment when redirect

		else {
			wp_redirect($order->get_checkout_payment_url()); // Redirect to page pay-order to payment again.
		}
	}

	/**
	 *
	 * @return array
	 */
	private function get_adyen_payment_data()
	{
		if (!isset($_REQUEST['zippy_pay_payment_data'])) {
			return [];
		}

		$payment_data = json_decode(stripcslashes($_REQUEST['zippy_pay_payment_data']), true);

		return ZIPPY_Pay_Core::recursive_sanitize_text_field($payment_data);
	}

	private function is_gateway_configured()
	{

		if ($this->enabled === 'yes') {
			return ($this->merchant_id && $this->secret_key);
		}

		return false;
	}

	private function add_notice()
	{
		return	wc_add_notice(__('Something went wrong with the payment. Please try again using another Credit / Debit Card.', PREFIX . '_zippy_payment'), 'error');
	}
}
