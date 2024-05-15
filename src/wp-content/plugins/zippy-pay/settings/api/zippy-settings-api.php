<?php

namespace ZIPPY_Pay\Settings\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

defined('ABSPATH') || exit;

class ZIPPY_Settings_Api
{
  /**
   * @var Client
   */
  private static $client;

  /**
   * ZIPPY_Settings_Api constructor.
   */

  public function __construct()
  {
    self::$client = new Client([
      'base_uri' => 'https://rest.zippy.sg/',
      'timeout'  => 6,
    ]);
  }
  public static function GetConfigs()
  {
    $merchant_id = get_option(PREFIX . '_merchant_id');


    if (self::$client === null) {
      new self();
    }
    try {


      $configs = self::$client->request("GET", "v1/payment/ecommerce/paymentoptions", ['query' => ['merchantId' => $merchant_id]]);

      if ($configs->getStatusCode() == 200) {
        $response = array(
          'status' => true,
          'message' => 'Sync config is successfully',
          'data' => json_decode($configs->getBody())
        );
      }
    } catch (ClientException $e) {
      $response = array(
        'status' => $e->getResponse()->getStatusCode(),
        'message' => 'Store config is failed',
      );
    } catch (ConnectException $e) {
      $response = array(
        'status' => false,
        'message' => 'Store config is failed',
      );
    }

    return $response;
  }
}
