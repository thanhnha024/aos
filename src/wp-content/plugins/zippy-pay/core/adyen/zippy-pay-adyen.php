<?php

namespace ZIPPY_Pay\Core\Adyen;

use Throwable;
use ZIPPY_Pay\Core\ZIPPY_Pay_Core;
use WC_Order;
use Exception;
use ZIPPY_Pay\Src\Logs\ZIPPY_Pay_Logger;
use ZIPPY_Pay\Src\Adyen\ZIPPY_Adyen_Api;

use WC_Admin_Settings;

class ZIPPY_Pay_Adyen
{

	/**
	 * @param $url
	 *
	 * @param $adyen_payment_data
	 *
	 * @return mixed
	 * @throws Throwable
	 */

	public function get_token($url)
	{


		$api = new ZIPPY_Adyen_Api();

		$token = $api->getTokenFromZippy();

		return $token;
	}

	/**
	 * @param WC_Order $order
	 *
	 * @param $adyen_payment_data
	 *
	 * @return mixed
	 * @throws Throwable
	 */
	public function pay($order, $adyen_payment_data)
	{
		$api = new ZIPPY_Adyen_Api();

		try {
			$payload = $this->build_payment_payload($order, $adyen_payment_data);

			$result = $api->adyenCheckout($payload);

			if (is_numeric($result)) {
				$token = $this->get_token(false);

				$result = $api->adyenCheckout($payload, $token);
			}

			if (!$result || !isset($result->Result)) {
				throw new Exception("Checkout Adyen Order Failed.");
			};
		} catch (Throwable $exception) {
			ZIPPY_Pay_Logger::log_checkout($exception->getMessage(), $payload);
			return [];
		}
		return $result;
	}

	/**
	 * @param WC_Order $order_key
	 *
	 * @return mixed
	 *
	 * @throws Throwable
	 */
	public function get_transaction_status($order_key)
	{

		$api = new ZIPPY_Adyen_Api();

		$current_time = date('Y-m-d H:i:s.v');

		$params = array(
			"orderNumber" => ZIPPY_Pay_Core::get_merchant_reference($order_key),
			"updatedFrom" => $current_time
		);
		try {
			$status = $api->getTransactionStatus($params);

			if (is_numeric($status)) {
				$token = $this->get_token(false);
				$status = $api->getTransactionStatus($params, $token);
			}
			if (!$status && !isset($status->result)) {
				throw new Exception("Missing Transaction Status Of Adyen.");
			}
		} catch (Throwable $exception) {
			ZIPPY_Pay_Logger::log($exception->getMessage());
			return [];
		}
		return $status;
	}

	/**
	 * @param $amount
	 *
	 * @return mixed
	 */
	public function get_payment_config()
	{
		try {
			$api = new ZIPPY_Adyen_Api();

			$paymentConfig              = $api->getConfigs();

			if (is_numeric($paymentConfig)) {
				$token = $this->get_token(false);
				$paymentConfig              = $api->getConfigs($token);
			}

			if (!$paymentConfig || !isset($paymentConfig->result)) {
				throw new Exception("Missing Payment Adyen Configs.");
			}
		} catch (Throwable $exception) {
			ZIPPY_Pay_Logger::log($exception->getMessage());
			return [];
		}

		return $paymentConfig->result;
	}

	/**
	 * Builds the required payment payload
	 *
	 * @param WC_Order $order
	 * @param $adyen_payment_data
	 * @return array
	 */
	protected function build_payment_payload(WC_Order $order, $adyen_payment_data)
	{

		$payload = [
			'store' 								 	 => WC_Admin_Settings::get_option(PREFIX . '_merchant_id'), //store_id get from config
			'merchantOrderReference'   => ZIPPY_Pay_Core::get_merchant_reference($order->get_order_key()),
			'reference' 						 	 => $order->get_id(),
			'metadata' 			=> [
				'cardBrand' 					 	 => $adyen_payment_data['paymentMethod']['brand'],
				'orgName' 					 	 	 => ZIPPY_Pay_Core::get_domain_name(),
				'merchantOrderReference' => ZIPPY_Pay_Core::get_merchant_reference($order->get_order_key()),

			],
			'returnUrl'                => str_replace('https:', 'http:', add_query_arg(array(
				'wc-api'      => 'WC_Zippy_Redirect',
				'order_id'   	=> $order->get_id()
			), home_url('/'))),
			'channel'                  => 'Web',
			'amount'        => [
				'currency'               => $order->get_currency(),
				'value'                  => $order->get_total() * 100,
			],
			'paymentMethod'            => $adyen_payment_data['paymentMethod'],
			'browserInfo' 	=> [
				'userAgent'      				 => ZIPPY_Pay_Core::get_user_agent(),
				'acceptHeader'   				 => ZIPPY_Pay_Core::get_http_accept(),
				'language'       				 => ZIPPY_Pay_Core::get_locale(),
				'javaEnabled'    				 => true,
				'colorDepth'     				 => 24,
				'timeZoneOffset' 				 => 0,
				'screenHeight'   				 => 723,
				'screenWidth'    				 => 1536
			],
		];

		return $payload;
	}
}
