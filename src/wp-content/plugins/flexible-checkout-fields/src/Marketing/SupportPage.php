<?php

namespace WPDesk\FCF\Free\Marketing;

use WPDesk\FCF\Free\Settings\Menu;
use WPDesk\FCF\Free\Settings\Page;
use WPDesk\FCF\Free\Service\TemplateLoader;
use FcfVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use FcfVendor\WPDesk\Library\Marketing\Boxes\Assets;
use FcfVendor\WPDesk\Library\Marketing\Boxes\MarketingBoxes;

/**
 * Add remote page with support and marketing content. This will be overwritten by the PRO version
 * of the plugin.
 */
class SupportPage implements Hookable {

	/** @var TemplateLoader */
	private $template;

	public function __construct( TemplateLoader $template ) {
		$this->template = $template;
	}

	public function hooks(): void {
		add_action( 'flexible_checkout_fields/after_settings', [ $this, 'render_marketing_page' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'load_assets_for_marketing_page' ] );
	}

	/**
	 * Check if the page should be rendered.
	 *
	 * @return bool
	 */
	private function should_render_page(): bool {
		if ( ! isset( $_GET['page'] ) || ( $_GET['page'] !== Page::SETTINGS_PAGE ) ) { // phpcs:ignore
			return false;
		}
		$current_tab = $_GET['tab'] ?? Menu::MENU_TAB_SECTIONS; // phpcs:ignore

		return Menu::MENU_TAB_MARKETING === $current_tab;
	}

	/**
	 * A function to render the marketing page.
	 */
	public function render_marketing_page(): void {
		if ( ! $this->should_render_page() ) {
			return;
		}

		$local = \get_locale();
		if ( $local === 'en_US' ) {
			$local = 'en';
		}
		$plugin_slug = $this->is_pro_active() ? 'flexible-checkout-fields-pro' : 'flexible-checkout-fields';

		echo $this->template->load_template( // phpcs:ignore
			'marketing-page',
			[
				'boxes' => new MarketingBoxes( $plugin_slug, $local ), // phpcs:ignore
			]
		);
	}

	/**
	 * Loads the assets for the marketing page.
	 *
	 * @return void
	 */
	public function load_assets_for_marketing_page(): void {
		Assets::enqueue_assets();
		Assets::enqueue_owl_assets();
	}

	/**
	 * A function to check if the pro version is active.
	 *
	 * @return bool
	 */
	private function is_pro_active(): bool {
		return \is_plugin_active( 'flexible-checkout-fields-pro/flexible-checkout-fields-pro.php' );
	}
}
