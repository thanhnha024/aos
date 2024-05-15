<?php
/**
 * Main Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class RTelements_Elementor_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'rtelements' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_header_footer_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'rsaddon_register_plugin_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'rsaddon_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'rsaddon_register_plugin_admin_styles' ] );
		$this->include_files();		
	}


	public function rsaddon_register_plugin_styles() {

		$dir = plugin_dir_url(__FILE__);        
        wp_enqueue_style( 'custom-elements', $dir.'assets/css/elements.css' );
        wp_enqueue_style( 'swiper-bundle-css', $dir.'assets/css/swiper-bundle.min.css' );
        wp_enqueue_style( 'nice-select-css', $dir.'assets/css/nice-select.css' );
        //enqueue javascript   		  
        wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'rsaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);       	
        wp_enqueue_script( 'swiper-bundle-js', $dir.'assets/js/swiper-bundle.min.js', array('jquery'), '823');

        wp_enqueue_script( 'time-circle-js', $dir.'assets/js/time-circle.js', array('jquery'), '823');
        // wp_enqueue_script( 'jquery-dropzie', $dir.'assets/js/jquery.dropzie.js', array('jquery'), '823');
        wp_enqueue_script( 'jquery-nice-select', $dir.'assets/js/jquery.nice-select.js', array('jquery'), '823');
    }

    public function rsaddon_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'rsaddons-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function rsaddon_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/rs-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
        require( __DIR__ . '/inc/subscription-modal.php' );
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'pielements_category',
            [
                'title' => esc_html__('RT Elementor Addons', 'pielements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_header_footer_category( $elements_manager ) {
        $elements_manager->add_category(
            'header_footer_rts',
            [
                'title' => esc_html__('RTS Header Footer Elements', 'pielements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pielements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pielements' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pielements' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		
		require_once( __DIR__ . '/widgets/heading/heading.php' );	
		require_once( __DIR__ . '/widgets/paragaraph-quote/quote.php' );	
		require_once( __DIR__ . '/widgets/image-widget/image.php' );		
		require_once( __DIR__ . '/widgets/portfolio-features-list/feature-list.php' );
		require_once( __DIR__ . '/widgets/team-member/team-grid-widget.php' );
		require_once( __DIR__ . '/widgets/services/service-grid.php' );
		require_once( __DIR__ . '/widgets/video/rt-video.php' );
		require_once( __DIR__ . '/widgets/button/button.php' );
		require_once( __DIR__ . '/widgets/services/service-slider.php' );
		require_once( __DIR__ . '/widgets/slider/slider.php' );
		require_once( __DIR__ . '/widgets/testimonial-slider/testimonail-slider-widget.php' );
		require_once( __DIR__ . '/widgets/portfolio-slider/portfolio-slider-widget.php' );
		require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );	
		require_once( __DIR__ . '/widgets/tab/tab.php' );
		require_once( __DIR__ . '/widgets/counter/rt-counter.php' );
		require_once( __DIR__ . '/widgets/cf7/contact-cf7.php' );
		require_once( __DIR__ . '/widgets/logo-widget/logo.php' );
		require_once( __DIR__ . '/widgets/blog-slider/blog-slider-widget.php' );
		require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
		require_once( __DIR__ . '/widgets/progress/rs-progress.php' );	
		require_once( __DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php' );
		require_once( __DIR__ . '/widgets/accordion/accordion.php' );
		require_once( __DIR__ . '/widgets/timeline-widget/timeline.php' );
		require_once( __DIR__ . '/widgets/featured-image/image.php' );
		require_once( __DIR__ . '/widgets/mailchimp/mailchimp.php' );
		require_once( __DIR__ . '/widgets/social-icon/social-icon.php' );
		require_once( __DIR__ . '/widgets/image-card/image-card.php' );
		
		//header footer elements
		require_once( __DIR__ . '/widgets/header-footer/topbar-icon.php' );
		require_once( __DIR__ . '/widgets/header-footer/site-search.php' );
		require_once( __DIR__ . '/widgets/header-footer/site-canvas.php' );
		require_once( __DIR__ . '/widgets/header-footer/site-logo.php' );
		require_once( __DIR__ . '/widgets/header-footer/site-nav.php' );
		require_once( __DIR__ . '/widgets/header-footer/single-page-nav.php' );
		require_once( __DIR__ . '/widgets/header-footer/copyright.php' );
		require_once( __DIR__ . '/widgets/header-footer/copyright.php' );



		//require_once( __DIR__ . '/widgets/dual-heading/dual-heading.php' );
		//require_once( __DIR__ . '/widgets/animated-heading/animated-heading.php' );		
		//require_once( __DIR__ . '/widgets/team-member-slider/team-slider-widget.php' );		
		
		
			
		
		require_once( __DIR__ . '/widgets/cta/cta.php' );
		//require_once( __DIR__ . '/widgets/testimonial/testimonail-widget.php' );
		
		//require_once( __DIR__ . '/widgets/flip-box/flip-box.php' );
		
		//require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
		require_once( __DIR__ . '/widgets/iconbox/rs-iconbox.php' );			
		
		//require_once( __DIR__ . '/widgets/number/rs-number.php' );		
		//require_once( __DIR__ . '/widgets/progress-pie/progress-pie.php' );
		require_once( __DIR__ . '/widgets/countdown/countdown.php' );
		//require_once( __DIR__ . '/widgets/contact-box/contact-box.php' );		
		require_once( __DIR__ . '/widgets/tooltip/rs-tooltip.php' );
		require_once( __DIR__ . '/widgets/marquee/marquee.php' );
		//require_once( __DIR__ . '/widgets/static-product/static-product.php' );	
		//require_once( __DIR__ . '/widgets/faq/rs-faq.php' );	

		//require_once( __DIR__ . '/widgets/image-hover-widget/image-hover-effect.php' );	
		//require_once( __DIR__ . '/widgets/business-hour/rs-hour.php' );	
		
		//require_once( __DIR__ . '/widgets/dual-button/dual-button.php' );
		//require_once( __DIR__ . '/widgets/blog-thumbnail-slider/thumbnail-slider-widget.php' );
		//require_once( __DIR__ . '/widgets/blog-category-slider/blog-category-widget.php' );
		//require_once( __DIR__ . '/widgets/instagram/instagram.php' );
		//require_once( __DIR__ . '/widgets/blockquote/blockquote.php' );		

		if(class_exists('woocommerce')):
			require_once( __DIR__ . '/widgets/woocommerce/pcat-grid/product-category-grid.php' );
			require_once( __DIR__ . '/widgets/woocommerce/product-grid/product-grid.php' );
			require_once( __DIR__ . '/widgets/woocommerce/product-slider/product-slider.php' );
			require_once( __DIR__ . '/widgets/woocommerce/classic-product/classic-product.php' );
			require_once( __DIR__ . '/widgets/woocommerce/cart.php' );
			require_once( __DIR__ . '/widgets/woocommerce/product-categories/product-categories.php' );	
			require_once( __DIR__ . '/widgets/woocommerce/product-sub-category.php' );	
			require_once( __DIR__ . '/widgets/woocommerce/product-list.php' );
			require_once( __DIR__ . '/widgets/woocommerce/product-isotop/product-isotop.php' );
			require_once( __DIR__ . '/widgets/woocommerce/category-dropdown.php' );
		endif;	


		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Heading_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Image_Card_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Portfolio_Features_List_Widget() );			
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Sservices_Grid_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Video_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Button_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Testimonial_Slider_Widget() );			
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Image_Showcase_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Testimonial_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \back_pro_timeline_Showcase_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Blog_Grid_Widget () );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Tab_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Counter_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_CF7_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Logo_Showcase_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Portfolio_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Blog_Slider_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Pricing_Table_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Progress_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Team_Grid_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Portfolio_Grid_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Widget_Accordion() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Services_Slider_Widget() );	

		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Site_Logo() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Navigation_Menu() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Single_Navigation_Menu() );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Topbar_Icon_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Featured_Image_Showcase_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Search_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Offcanvas() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Copyright_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Quote_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Mailchimp_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_CTA_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Icon_Box_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Soical_Icon_Showcase_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSTooltip_Box_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Marquee_Widget() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Instagram_Widget());

		//\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Soical_Icon_Showcase_Widget() );
		
		/*\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Heading_dual_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Animated_Heading_Widget());		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Team_Slider_Pro_Widget() );		
		
		
		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Testimonial_Grid_Widget() );
			
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Flip_Box_Widget() );
		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Advance_Tab_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSIcon_Box_Widget() );			
				
			
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSnumber_Grid_Widget() );
		
			
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Progress_Pie_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RScontactbox_Grid_Widget() );

		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSStatic_Product_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Faq_Widget() );
		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Image_Hover_Effect_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Business_Hour_Widget() );
		
		
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Dual_Button_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Pielemetns_Elementor_thumbnail_slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_blog_category_slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Instagram_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Blockquote_Widget());*/
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Countdown_Widget() );
		
		if(class_exists('woocommerce')):
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_Grid_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_Category_Grid_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Product_Cart() );			
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_Slider_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Classic_Product_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_Category_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_Sub_Category_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_List_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Product_isotop_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Product_Category_Dropdown_Widget() );
		endif;
		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
		add_action( 'elementor/elements/categories_registered', [$this, 'resgister_header_footer_category'] );
	}
}
RTelements_Elementor_Extension::instance();