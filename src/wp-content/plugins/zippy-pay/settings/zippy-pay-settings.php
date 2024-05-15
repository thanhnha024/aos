<?php

namespace ZIPPY_Pay\Settings;

use WC_Settings_Page;
use WC_Admin_Settings;
use ZIPPY_Pay\Core\ZIPPY_Pay_Core;
use ZIPPY_Pay\Settings\ZIPPY_Fields_Setting;


defined('ABSPATH') || exit;

class ZIPPY_Pay_Settings extends WC_Settings_Page
{

  /**
   * Constructor
   */
  public function __construct()
  {

    $this->id    = 'zippy_payment_getway';
    $this->label = __('Zippy Payment',  PREFIX . 'zippy-settings-tab');
    $this->id_paynow_tab = 'woocommerce_' . PAYMENT_PAYNOW_ID . '_settings';
    $this->id_adyen_tab  = 'woocommerce_' .  PAYMENT_ADYEN_ID . '_settings';
    add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_tab'), 50);
    add_action('admin_enqueue_scripts', array($this, 'admin_scripts_and_styles'));
    add_action('woocommerce_sections_' . $this->id, array($this, 'output_sections'));
    add_action('woocommerce_settings_' . $this->id, array($this, 'output'));
    add_action('woocommerce_settings_save_' . $this->id, array($this, 'save'));

    ZIPPY_Fields_Setting::get_instance();
  }

  /**
   * Add plugin options tab
   *
   * @return array
   */
  public function add_settings_tab($settings_tabs)
  {
    $settings_tabs[$this->id] = __('EPOSPay', PREFIX . 'zippy-settings-tab');
    return $settings_tabs;
  }

  /**
   * Get sections
   *
   * @return array
   */
  public function get_sections()
  {
    //Init Tab 
    $sections = array(
      ''                      => __('General', PREFIX . 'zippy-settings-tab'),
    );

    $has_paynow_tab =  $this->get_payment_status($this->id_paynow_tab, true);

    $has_adyen_tab =  $this->get_payment_status($this->id_adyen_tab, true);

    if (isset($has_adyen_tab) && $has_adyen_tab == 'yes') {
      $sections['zippy_credit_card'] = __('EPOSPay Credit Card', PREFIX . 'zippy-settings-tab');
    }

    if (isset($has_paynow_tab) && $has_paynow_tab == "yes") {
      $sections['zippy_paynow'] = __('EPOSPay Paynow', PREFIX . 'zippy-settings-tab');
    }

    return apply_filters('woocommerce_get_sections_' . $this->id, $sections);
  }

  /**
   * Get setting
   *
   * @return array
   */
  public function get_settings($section = null)
  {

    switch ($section) {

      case 'zippy_credit_card':

        $settings = array(
          'section_title' => $this->show_warning_message(),
          'divider' => ZIPPY_Pay_Core::divider(),
          'enable_credit_card'         => array(
            'title'   => __('Enable EPOSPay Credit Card', PREFIX . 'zippy-settings-tab'),
            'type'    => 'checkbox',
            'label'   => __('Enable EPOSPay Credit Card', PREFIX . 'zippy-settings-tab'),
            'default' => 'no',
            'id'      =>   $this->id_adyen_tab,
            'value'   => $this->get_payment_status($this->id_adyen_tab)
          ),
          'zippy_credit_card_field'         => array(
            'id'       => 'zippy_credit_card_field',
            'title'   => __('Payment methods', PREFIX . 'zippy-settings-tab'),
            'type'      => 'zippy_credit_card_field',
          ),
          'divider' => ZIPPY_Pay_Core::divider(),
          'section_end' => array(
            'type' => 'sectionend',
            'id' => 'zippy_settings_tab_end_credit_card'
          )
        );

        break;

      case 'zippy_paynow':

        $settings = array(
          'section_title' => $this->show_warning_message(),
          'divider' => ZIPPY_Pay_Core::divider(),
          'enable_zippy_paynow'         => array(
            'title'   => __('Enable EPOSPay Paynow', PREFIX . 'zippy-settings-tab'),
            'type'    => 'checkbox',
            'label'   => __('Enable EPOSPay Paynow', PREFIX . 'zippy-settings-tab'),
            'default' => 'no',
            'id'      =>  $this->id_paynow_tab,
            'value'   => $this->get_payment_status($this->id_paynow_tab)
          ),
          'zippy_paynow_field' => array(
            'id'        => 'zippy_paynow_field',
            'type'      => 'zippy_paynow_field',
            'default' => '',
          ),
          'section_end' => array(
            'type' => 'sectionend',
            'id' => 'zippy_settings_tab_end_paynow'
          )
        );

        break;

      default:
        $settings = array(
          'section_title' => $this->show_warning_message(),
          'divider' => ZIPPY_Pay_Core::divider(),
          'merchant_id'       => array(
            'title'   => __('Merchant ID', PREFIX . 'zippy-settings-tab'),
            'type'    => 'text',
            'desc' => __('Your Store ID in the Zippy platform', PREFIX . 'zippy-settings-tab'),
            'default' => '',
            'id'       => PREFIX . '_merchant_id'
          ),
          'secret_key'       => array(
            'title'   => __('Secret Key', PREFIX . 'zippy-settings-tab'),
            'type'    => 'text',
            'desc' => __('Your Secret Key in the Zippy platform', PREFIX . 'zippy-settings-tab'),
            'default' => '',
            'id'       => PREFIX . '_secret_key'
          ),
          'zippy_general_field' => array(
            'id'        => 'zippy_general_field',
            'type'      => 'zippy_general_field',
            'default' => '',
          ),
          'section_end' => array(
            'type' => 'sectionend',
            'id' => 'zippy_settings_tab_end_general'
          )
        );
        break;
    }

    return apply_filters('wc_settings_tab_settings', $settings, $section);
  }

  /**
   * Output the settings
   */
  public function output()
  {
    global $current_section, $hide_save_button;

    // if (!empty($current_section)) $hide_save_button = true;
    $settings = $this->get_settings($current_section);
    WC_Admin_Settings::output_fields($settings);
  }


  /**
   * Save settings
   */
  public function save()
  {
    global $current_section;
    $settings = $this->get_settings($current_section);
    WC_Admin_Settings::save_fields($settings);
    $this->save_settings_for_current_section();

    $this->do_update_options_action();
  }

  /**
   * Update option after save changes
   *
   *
   */
  protected function do_update_options_action($section_id = null)
  {
    global $current_section;

    if (is_null($section_id)) {
      $section_id = $current_section;
    }

    if ($section_id) {
      do_action('woocommerce_update_options_' . $section_id);
    }
  }

  public function admin_scripts_and_styles()
  {
    wp_enqueue_script('admin-epos-js', ZIPPY_PAY_DIR_URL . 'includes/assets/js/admin-epos.js', [], '5.49.0');
    wp_enqueue_style('admin-epos-css', ZIPPY_PAY_DIR_URL . 'includes/assets/css/admin-epos.css', [], '5.49.0');
  }

  protected function show_warning_message()
  {
    $settings_title = array(
      'name'     => __('EPOSPay', PREFIX . 'zippy-settings-tab'),
      'type'     => 'title',
      'desc'     => __('This configuration Integrates with EPOSPay Credit Card & EPOSPay Paynow <span style="color: #cc0000;display: block;">
      ** We only support order totals up to 2 decimals places</span>', PREFIX . 'zippy-settings-tab'),
      'id'       => 'zippy_settings_tab_title_section'
    );
    return $settings_title;
  }

  protected function get_payment_status($id_payment, $is_active_tab = false)
  {
    $payment_settings = get_option($id_payment);

    if ($is_active_tab) {
      $payment_status = is_array($payment_settings) ? $payment_settings['enabled'] : '';
    } else {
      $payment_status = isset($payment_settings['enabled']) ? $payment_settings['enabled'] : $payment_settings;
    }

    return $payment_status;
  }
}
