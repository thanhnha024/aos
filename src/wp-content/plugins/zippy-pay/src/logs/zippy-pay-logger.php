<?php


namespace ZIPPY_Pay\Src\Logs;

class ZIPPY_Pay_Logger
{

	public static $logger;
	const LOG_FILENAME = 'zippy_pay_woocommerce';

	public static function log($message)
	{
		if (!class_exists('WC_Logger')) {
			return;
		}

		$logger = wc_get_logger();

		$log_entry = sprintf('==== Zippy Payment Log Start [%s] ==== ', date('d/m/Y H:i:s')) . "\n";
		$log_entry .=  $message . "\n";
		$log_entry .= '==== Zippy Pay Log End====' . "\n\n";

		$logger->debug($log_entry, ['source' => self::LOG_FILENAME]);
	}

	public static function log_checkout($message, $payload)
	{
		if (!class_exists('WC_Logger')) {
			return;
		}

		$logger = wc_get_logger();

		$log_entry = sprintf('==== Zippy Payment Log Start [%s] ==== ', date('d/m/Y H:i:s')) . "\n";
		$log_entry .=  $message . "\n";
		$log_entry .= wc_print_r($payload, true) . "\n";
		$log_entry .= '==== Zippy Payment Log End====' . "\n\n";


		$logger->debug($log_entry, ['source' => self::LOG_FILENAME]);
	}
}
