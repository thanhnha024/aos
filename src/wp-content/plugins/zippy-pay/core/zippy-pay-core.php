<?php

namespace ZIPPY_Pay\Core;

defined('ABSPATH') || exit;


class ZIPPY_Pay_Core
{


  /**
   * Recursive sanitation for an array
   *
   * @param $array
   *
   * @return mixed
   */
  public static function recursive_sanitize_text_field($array)
  {
    foreach ($array as $key => &$value) {
      if (is_array($value)) {
        $value = self::recursive_sanitize_text_field($value);
      } else {
        $value = sanitize_text_field($value);
      }
    }

    return $array;
  }

  public static function separator()
  {
    return [
      'title'       => '',
      'type'        => 'title',
      'description' => '<hr>'
    ];
  }

  public static function divider()
  {
    return array(
      'id'          => PREFIX . '_divider',
      'name'       => __('', PREFIX . 'woocommerce-settings-tab'),
      'type'        => 'title',
      'desc' => '<hr>'
    );
  }

  /**
   * Gets the client IP
   *
   * @return string
   */
  public static function get_client_ip()
  {

    $ip = $_SERVER['REMOTE_ADDR'];

    if (empty($ip)) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    if (empty($ip)) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip; //'192.168.0.1'
  }

  /**
   * Get the Locale
   *
   * @return string
   */

  public static function get_locale()
  {
    return str_replace(['_informal', '_formal'], '', get_locale());
  }
  /**
   * Get the userAgent
   *
   * @return string
   */

  public static function get_user_agent()
  {
    return $_SERVER['HTTP_USER_AGENT'];
  }

  /**
   * Get the userAgent
   *
   * @return string
   */

  public static function get_http_accept()
  {
    return $_SERVER['HTTP_ACCEPT'];
  }

  /**
   * Get the userAgent
   *
   * @return string
   */

  public static function get_reference($order_id)
  {
    return $_SERVER['HTTP_HOST'] . '_' . $order_id;
  }

  public static function get_domain_name()
  {
    $domain_name = explode(".", $_SERVER['HTTP_HOST']);
    $domain = isset($domain_name[0]) ? $domain_name[0] : $_SERVER['HTTP_HOST'];
    return $domain;
  }

  /**
   * Retrieves the shop domain used for generating origin keys.
   *
   * @return string
   */
  public static function get_origin_domain()
  {

    $incl_port = get_option('incl_server_port', 'yes');
    $protocol  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $port      = in_array($_SERVER['SERVER_PORT'], ['80', '443']) ? '' : ':' . $_SERVER['SERVER_PORT'];
    $domain    = 'yes' === $incl_port ? $protocol . $_SERVER['HTTP_HOST'] . $port : $protocol . $_SERVER['HTTP_HOST'];

    return $domain;
  }

  public static function get_merchant_reference($order_key)
  {

    return md5($order_key . '_' . self::get_origin_domain());
  }

  /**
   * Gets content of a given path file.
   *
   * @param string $template_name - the end part of the file path including the template name
   * @param array $vars - arguments passed to the template
   * @param string $absolute_path - plugin's DIR_PATH
   * @param mixed $relative_path - relative path added between the absolute path and the template name
   * @return string $content
   */
  public static function get_template($template_name, $vars = array(), $absolute_path = '', $relative_path = '')
  {

    extract($vars);

    $content = '';

    $template_name = empty($absolute_path) && empty($relative_path) ? $template_name : trim($template_name, "/\\");
    $absolute_path = empty($absolute_path) ? '' : trailingslashit($absolute_path);
    $relative_path = empty($relative_path) ? '' : trailingslashit(trim($relative_path, "/\\"));

    $template = $absolute_path . $relative_path . $template_name;

    //check for template in plugin's folder `includes/`
    if (file_exists(ZIPPY_PAY_DIR_PATH . $relative_path . $template_name)) {
      $template = ZIPPY_PAY_DIR_PATH . $relative_path . $template_name;
    }

    $template = apply_filters_deprecated(PREFIX . '\util\get_template\path_file', [$template, $vars], '1.0.0', PREFIX . '\util\get_template\template');
    $template = apply_filters(PREFIX . '\util\get_template\template', $template, $template_name, $absolute_path, $relative_path);

    if (file_exists($template)) {

      ob_start();

      include $template;

      $content = ob_get_clean();
    }

    return $content;
  }
}
