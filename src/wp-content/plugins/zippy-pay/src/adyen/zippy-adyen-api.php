<?php

namespace ZIPPY_Pay\Src\Adyen;

use WC_Admin_Settings;
use ZIPPY_Pay\Core\ZIPPY_Pay_Core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class ZIPPY_Adyen_Api
{
  private $client;

  /**
   * ZIPPY_Adyen_Api constructor.
   */

  public function __construct()
  {
    $this->client = new Client([
      'base_uri' => 'https://rest.zippy.sg',
      'headers' => [
        'Content-Type' => 'application/json',
      ],
      'timeout'  => 10,
    ]);
  }

  /**
   * Api Get Token
   */

  public function getToken()
  {

    $path = '/v1/User/eCommerce/GetToken';

    $domain = ZIPPY_Pay_Core::get_domain_name();

    $timestamp = time();

    $merchant_id =  WC_Admin_Settings::get_option(PREFIX . '_merchant_id');

    $hash_hmac_data = $this->build_hash_hmac($path, $merchant_id, $timestamp, '', 'GET');

    $headers = array(
      'Authorization' => $merchant_id . ':' . $timestamp . ':' .  $domain . ':' . $hash_hmac_data,
    );

    try {
      $response = $this->client->get(
        $path,
        [
          "headers" => $headers
        ]
      );

      $statusCode = $response->getStatusCode();

      if ($statusCode == 200) {
        $response = json_decode($response->getBody());
      } else {
        $response = $statusCode;
      }
    } catch (ConnectException $e) {
      $response = false;
    } catch (RequestException $e) {
      $response = $e->getResponse()->getStatusCode();
    }

    return $response;
  }

  /**
   * @param $url
   *
   * @return mixed
   */
  public function getConfigs($token = '')
  {
    $token = empty($token) && isset($_COOKIE['access_token']) ? $_COOKIE['access_token'] : $token;

    $path = '/v1/payment/adyen/ecommerce/config';

    $timestamp = time();

    $merchant_id =  WC_Admin_Settings::get_option(PREFIX . '_merchant_id');

    $hash_hmac_data = $this->build_hash_hmac($path, $merchant_id, $timestamp, '', 'GET');

    $domain = ZIPPY_Pay_Core::get_domain_name();

    $headers = array(
      'AccessToken' => $token,
      'Authorization' => $merchant_id . ':' . $timestamp . ':' .  $domain . ':' . $hash_hmac_data,
    );

    try {

      $response = $this->client->get(
        $path,
        [
          'headers' => $headers
        ]
      );

      $statusCode = $response->getStatusCode();

      if ($statusCode == 200) {
        $response = json_decode($response->getBody());
      } else {
        $response = $statusCode;
      }
    } catch (ConnectException $e) {
      $response = false;
    } catch (RequestException $e) {
      $response = $e->getResponse()->getStatusCode();
    }

    return $response;
  }

  /**
   * Get Token From Zippy
   */

  public function getTokenFromZippy()
  {
    $token  = $this->getToken();

    $access_token = isset($token->Result->Token) && !empty($token) ? $token->Result->Token : '';

    setcookie("access_token", $access_token); // the first save token

    return $access_token;
  }

  /**
   * Process checkout
   *
   * @param $url
   *
   * @return mixed
   */
  public function adyenCheckout($params = array(), $token = '')
  {

    $token = empty($token) ? $_COOKIE['access_token'] : $token;

    $data = json_encode($params);

    unset($params['paymentMethod'], $params['browserInfo'], $params['returnUrl']);

    $path = '/v1/payment/adyen/ecommerce/payment';

    $timestamp = time();

    $domain = ZIPPY_Pay_Core::get_domain_name();

    $merchant_id =  WC_Admin_Settings::get_option(PREFIX . '_merchant_id');

    $hash_hmac_data = $this->build_hash_hmac($path, $merchant_id, $timestamp,  json_encode($params), 'POST');

    $headers = array(
      'AccessToken' => $token,
      'Authorization' => $merchant_id . ':' . $timestamp . ':' .  $domain . ':' . $hash_hmac_data,
    );

    try {

      $response = $this->client->post(
        $path,
        [
          'headers' => $headers,
          'body' => $data
        ]
      );

      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $response = json_decode($response->getBody());
      } else {
        $response = $statusCode;
      }
    } catch (ConnectException $e) {
      $response = false;
    } catch (RequestException $e) {
      $response = $e->getResponse()->getStatusCode();
    }

    return $response;
  }
  /*
   * @param $url
   *
   * @param $params
   *
   * @return mixed
   */
  public function getTransactionStatus($params = array(), $token = '')
  {
    $token = empty($token) ? $_COOKIE['access_token'] : $token;

    $path = '/v1/payment/adyen/ecommerce/transactionStatus';

    $timestamp = time();

    $merchant_id =  WC_Admin_Settings::get_option(PREFIX . '_merchant_id');

    $hash_hmac_data = $this->build_hash_hmac($path, $merchant_id, $timestamp, '', 'GET');

    $domain = ZIPPY_Pay_Core::get_domain_name();

    $headers = array(
      'AccessToken' => $token,
      'Authorization' => $merchant_id . ':' . $timestamp . ':' .  $domain . ':' . $hash_hmac_data,
    );

    try {

      $response = $this->client->get(
        $path,
        [
          'headers' => $headers,
          'query' => $params
        ]
      );

      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $response = json_decode($response->getBody());
      } else {
        $response = $statusCode;
      }
    } catch (ConnectException $e) {
      $response = false;
    } catch (RequestException $e) {
      $response = $e->getResponse()->getStatusCode();
    }

    return $response;
  }

  /**
   * Build Hash Hmac to send in request
   */

  private function build_hash_hmac($path_query, $merchant_id, $timestamp, $payload, $method)
  {
    $secret_key = WC_Admin_Settings::get_option(PREFIX . '_secret_key');

    $domain = ZIPPY_Pay_Core::get_domain_name();

    $raw_signature =  $secret_key . ":" . $merchant_id   . ":" . $domain  . ":" . $timestamp  . ":" . $method  . ":" . $path_query . ":" . $payload;

    return hash_hmac('sha256', str_replace(' ', '', $raw_signature), $secret_key, false);
  }
}
