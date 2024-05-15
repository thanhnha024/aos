<?php defined('ABSPATH') or die();

if (defined('ABSPATH') && !class_exists('Custom_Core')) {

  class Custom_Core
  {
    public function __construct()
    {
      /* Disable XML-RPC */
      add_filter('xmlrpc_enabled', '__return_false');

      /* Edit teamplate design Post/Page */
      add_filter('use_block_editor_for_post', '__return_false');

      /* Edit teamplate design Post/Page */
      add_filter('use_block_editor_for_post', '__return_false');

      /* ADD SMPT Not Need Plugin */
      add_action('phpmailer_init', array($this, 'setup_phpmailer_init'));

      add_filter('login_headerurl', array($this, 'custom_loginlogo_url'));

      /*  Disable All Update Notifications with Code  */

      add_filter('pre_site_transient_update_core', array($this, 'remove_core_updates'));

      add_filter('pre_site_transient_update_plugins', array($this, 'remove_core_updates'));

      add_filter('pre_site_transient_update_themes', array($this, 'remove_core_updates'));

      // /* Add css in Login Form on Dashboard */

      add_action('login_enqueue_scripts', array($this, 'my_login_stylesheet'));

      // // remove version from head
      remove_action('wp_head', 'wp_generator');

      // // remove version from rss
      add_filter('the_generator', '__return_empty_string');

      add_filter('the_generator', array($this, 'zippy_remove_version_wp'));
    }

    private function setup_phpmailer_init($phpmailer)
    {
      $phpmailer->Host = 'smtp.gmail.com'; // for example, smtp.mailtrap.io
      $phpmailer->Port = 587; // set the appropriate port: 465, 2525, etc.
      $phpmailer->Username = 'dev@zippy.sg'; // your SMTP username
      $phpmailer->Password = 'itmloqkardiuifmk'; // your SMTP password
      $phpmailer->SMTPAuth = true;
      $phpmailer->SMTPSecure = 'tls'; // preferable but optional
      $phpmailer->IsSMTP();
    }

    public function custom_loginlogo_url($url)
    {
      return '/';
    }

    public function remove_core_updates()
    {
      global $wp_version;

      return (object) array('last_checked' => time(), 'version_checked' => $wp_version,);
    }

    public  function my_login_stylesheet()
    {
      $style = '<style type="text/css">body.login div#login h1 a{background-image:url("' . Zippy_Custom_Dir_Url . 'assets/images/logo-zippy.png");width:100%;background-size:100%}#login form#loginform .input,#login form#registerform .input,#login form#lostpasswordform .input{border-width:0px;border-radius:0px;border-bottom:1px solid #d2d2d2;-webkit-box-shadow:unset;box-shadow:unset}#login form .submit .button{background-color:#40A944;width:100%;height:40px;border-width:0px;margin-top:10px}.login .button.wp-hide-pw{color:#40A944}

    </style>';

      echo $style;
    }

    private function zippy_remove_version_wp()
    {
      return '';
    }
  }

  new Custom_Core;
}
