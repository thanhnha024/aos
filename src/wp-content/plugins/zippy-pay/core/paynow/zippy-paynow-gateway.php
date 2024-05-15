<?php

namespace ZIPPY_Pay\Core\Paynow;

use WC_Payment_Gateway;
use WC_Order;
use ZIPPY_Pay\Core\ZIPPY_Pay_Core;
use ZIPPY_Pay\Src\Paynow\ZIPPY_Paynow_Api;
use ZIPPY_Pay\Src\Paynow\ZIPPY_Paynow_Payment;


defined('ABSPATH') || exit;

class ZIPPY_Paynow_Gateway extends WC_Payment_Gateway
{

	/**
	 * ZIPPY_Paynow_Gateway constructor.
	 */
	public function __construct()
	{

		$this->id           =  PAYMENT_PAYNOW_ID;
		$this->method_title = __(PAYMENT_PAYNOW_NAME, PREFIX . '_zippy_payment');
		$this->icon  =  ZIPPY_PAY_DIR_URL . 'includes/assets/icons/paynow.svg';
		$this->has_fields   = true;
		$this->init_form_fields();
		$this->init_settings();
		$this->title = 'Paynow';
		$this->method_description = __('', PREFIX . '_zippy_payment');
		$this->enabled         = $this->get_option('enabled');
		add_action('woocommerce_receipt_' . $this->id, [$this, 'receipt_page']);
		add_action('woocommerce_thankyou_' . $this->id, [$this, 'handle_send_message_whatsapp']);
		add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
		add_action('woocommerce_api_zippy_paynow_transaction', [$this, 'handle_redirect']);
	}

	/**
	 * Setup key form fields
	 *
	 */
	public function init_form_fields()
	{

		$this->form_fields = [
			'enabled'         => [
				'title'   => __('Enable ' . PAYMENT_PAYNOW_NAME, PREFIX . '_zippy_payment'),
				'type'    => 'checkbox',
				'label'   => __('Enable ' . PAYMENT_PAYNOW_NAME, PREFIX . '_zippy_payment'),
				'default' => 'no'
			],
		];
	}

	/**
	 * Inlude payment data form UI
	 *
	 */
	public function payment_fields()
	{
		$is_active = $this->is_gateway_configured();

		echo ZIPPY_Pay_Core::get_template('message-fields.php', [
			'is_active' => 	$is_active,
		], dirname(__FILE__), '/templates');

		//Popup
		echo ZIPPY_Pay_Core::get_template('pop-up-noti.php', [
			'is_active' => 	$is_active,
		], dirname(__FILE__), '/templates');
	}

	/**
	 * Woocomerce process payment
	 *
	 */
	public function process_payment($order_id)
	{

		$order              = new WC_Order($order_id);

		// // Failed Payment
		if (empty($order)) {
			$this->handle_payment_failed();
		}

		return $this->handle_do_payment($order);
	}


	/**
	 *
	 * Handle payment after receive response from Zippy
	 *
	 * @param WC_Order $order
	 *
	 * @return mixed
	 */

	private function handle_do_payment($order)
	{
		//check order status first
		$api = new ZIPPY_Paynow_Api();

		$order_id = $order->get_id();

		$merchant_id = get_option(PREFIX . '_merchant_id');

		$amout = $order->get_total();

		$status = $api->checkStatusOrder($merchant_id, $order_id, $amout);

		if (isset($status) && $status->result->status == "completed") {
			delete_option('zippy_paynow_redirect_object_' .	$order_id);

			$order->add_order_note(sprintf(__('Payment was complete via ' . PAYMENT_PAYNOW_NAME, PREFIX . '_zippy_payment')));

			$order->payment_complete();

			// should get payment details to log in the order.

			return [
				'result'   => 'success',
				'redirect' => $this->get_return_url($order)
			];
		}
		// always redirect to Zippy
		return $this->handle_payment_redirect($order);
	}

	/**
	 * This function will be run after user enter the place order button
	 *
	 */
	private function handle_payment_redirect($order)
	{

		$order_id = $order->get_id();

		$paynow = new ZIPPY_Paynow_Payment($order);

		$api = new ZIPPY_Paynow_Api();

		$paynow_payload = $paynow->build_payment_payload();

		$paynow_response = $api->paynowPayment($paynow_payload);

		if (!isset($paynow_response->Result->redirectUrl)) {
			return $this->handle_payment_failed();
		}

		update_option('zippy_paynow_redirect_object_' . $order_id, $paynow_response);

		return  [
			'result'   => 'success',
			'redirect' => $order->get_checkout_payment_url(true)
		];
	}

	/**
	 * Woocomerce Custom receipt page support redirect checkout.
	 *
	 */
	public function receipt_page($order_id)
	{

		$redirectData = get_option('zippy_paynow_redirect_object_' . $order_id);

		if (!isset($redirectData) || empty($redirectData)) {
			wp_safe_redirect(get_checkout_payment_url(), '301');
			$this->add_notice();
		}

		wp_redirect($redirectData->Result->redirectUrl);
	}


	/**
	 * Woocomerce Custom thankyou page support send message by Whatsapp.
	 *
	 */
	public function handle_send_message_whatsapp($order_id)
	{
		//Send massage by Whatsapp
		if (empty($order_id)) return;

		$config_infor = get_option('zippy_configs_paynow');

		$type = isset($config_infor) ? $config_infor->paymentType : '';

		$domain = ZIPPY_Pay_Core::get_domain_name();

		$config_infor = get_option('zippy_configs_paynow');

		$user_contact = isset($config_infor->merchantContact) ? $config_infor->merchantContact : '';

		echo ZIPPY_Pay_Core::get_template('whatsapp-handle.php', [
			'user_contact' => $user_contact,
			'domain' => $domain,
			'type' => $type,
			'order_id' => $order_id

		], dirname(__FILE__), '/templates');
	}

	/**
	 * This is callback func called after reponse from Zippy 
	 *
	 */
	public function handle_redirect()
	{
		// Check status order 
		$order_id = intval($_REQUEST['order_id']);

		$merchant_id = get_option(PREFIX . '_merchant_id');

		$order = new WC_Order($order_id);

		$amout = $order->get_total();

		if (!isset($_REQUEST['order_id']) || empty($_REQUEST['order_id'])) {
			wp_redirect($order->get_checkout_payment_url());
			exit;
		}

		$api = new ZIPPY_Paynow_Api();

		$status = $api->checkStatusOrder($merchant_id, $order_id, $amout);

		return $this->check_order_status($status, $order);
	}

	private function check_order_status($status, $order)
	{

		$order_id = $order->get_id();

		if (isset($status) && $status->result->status === "completed") {

			delete_option('zippy_paynow_redirect_object_' .	$order_id);

			$order->add_order_note(sprintf(__('Payment was complete via ' . PAYMENT_PAYNOW_NAME, PREFIX . '_zippy_payment')));

			$order->payment_complete();

			// should get payment details to log in the order.

			wp_redirect($this->get_return_url($order));
		} else {
			wp_redirect($order->get_checkout_payment_url()); // Redirect to page pay-order to payment again.
		}
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


	// public function is_available()
	// {
	// 	return $this->is_gateway_configured();
	// }

	private function is_gateway_configured()
	{
		$api = new ZIPPY_Paynow_Api();

		$merchant_id = get_option(PREFIX . '_merchant_id');

		$checkPaynowStatus = $api->checkPaynowIsActive($merchant_id);

		if (empty($checkPaynowStatus['data']) || !$checkPaynowStatus['status']) return false;

		$is_active = $checkPaynowStatus['data']->result->paynowConfig;

		return 	$is_active;
	}

	/**
	 * Add notice when payment failed
	 *
	 * @return mixed
	 */

	private function add_notice()
	{
		return	wc_add_notice(__('Something went wrong with the payment. Please try again using another Credit / Debit Card.', PREFIX . '_zippy_payment'), 'error');
	}
}
