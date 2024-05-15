<?php

namespace ZIPPY_Pay\Src\Paynow;

defined('ABSPATH') || exit;

class ZIPPY_Paynow_Payment
{

  /**
   * Paynow constructor.
   *
   * @param ZIPPY_Paynow_Payment $order_id
   */
  public function __construct($order)
  {
    $this->order = $order;
  }

  /**
   * Build Payment Payload
   *
   * @param ZIPPY_Paynow_Payment $order_id
   */
  public function build_payment_payload()
  {
    $order_id = $this->order->get_id();

    if (empty($order_id)) return;

    $total = $this->order->get_total();

    $callback_url = str_replace('https:', 'http:', add_query_arg(array(
      'wc-api'      => 'zippy_paynow_transaction',
      'order_id'     => $order_id
    ), home_url('/')));

    $payload = array(
      "OrderId" => $order_id,
      "Amount" => $total,
      "CallbackUrl" => $callback_url,
    );

    $key = get_option(PREFIX . '_secret_key');

    $payload_encode = array(
      "Data" => $this->encodePayload($payload, $key)
    );

    return $payload_encode;
  }

  function encodePayload($payload, $key)

  {
    $string = json_encode($payload);

    $ivSize = openssl_cipher_iv_length('AES-256-CBC');

    $hash = hash('sha256', $key, true);

    $iv = openssl_random_pseudo_bytes($ivSize);

    $encrypted = openssl_encrypt($string, 'AES-256-CBC', $hash, OPENSSL_RAW_DATA, $iv);

    return base64_encode($iv . $encrypted);
  }
}
