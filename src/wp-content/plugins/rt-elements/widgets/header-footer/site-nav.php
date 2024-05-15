<?php
/**
 * Elementor Classes.
 *
 * @package rtelements
 */
// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Nav Menu.
 */
class RTS_Navigation_Menu extends Widget_Base {
	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'navigation-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Navigation Menu', 'rtelements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'header_footer_rts' ];
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Check if the Elementor is updated.
	 *
	 * @since 1.3.0
	 *
	 * @return boolean if Elementor updated.
	 */
	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Register Nav Menu controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'rtelements' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'rtelements' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'rtelements' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'rtelements' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
		
		$this->add_control(
			'enable_responsive_view',
			[
				'label' => esc_html__( 'Enable Menu Responsive view', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rtelements' ),
				'label_off' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'yes',
							
			]
		);
		$this->add_control(
			'expand_on_click',
			[
				'label' => esc_html__( 'Expand Only on Click', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rtelements' ),
				'label_off' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'yes',
				'default'      => 'no',
							
			]
		);


		
		$this->end_controls_section();

			$this->start_controls_section(
				'section_layout',
				[
					'label' => __( 'Layout', 'rtelements' ),
				]
			);

			$this->add_control(
				'layout',
				[
					'label'   => __( 'Layout', 'rtelements' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'rtelements' ),
						'vertical'   => __( 'Vertical', 'rtelements' )
					],
				]
			);

			$this->add_control(
			'enable_two_column',
			[
				'label' => esc_html__( 'Enable Two Column Menu', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rtelements' ),
				'label_off' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'    => [
						'layout' => [ 'vertical' ],
				],
			]
		);

			$this->add_responsive_control(
				'navmenu_align',
				[
					'label'        => __( 'Alignment', 'rtelements' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
						'left'    => [
							'title' => __( 'Left', 'rtelements' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'rtelements' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'rtelements' ),
							'icon'  => 'eicon-h-align-right',
						],
						
					],
					'default'      => 'center',
					'selectors' => [
						'{{WRAPPER}} .menu-area' => 'text-align: {{VALUE}}'
					],
					'condition'    => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
					'prefix_class' => 'hfe-nav-menu__align-',
				]
			);


			$this->add_control(
				'submenu_icon',
				[
					'label'        => __( 'Submenu Icon', 'rtelements' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'arrow',
					'options'      => [
						'arrow'   => __( 'Arrows', 'rtelements' ),
						'plus'    => __( 'Plus Sign', 'rtelements' ),
						
					],
					'prefix_class' => 'hfe-submenu-icon-',
				]
			);

			
	

		
		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __( 'Main Menu', 'rtelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

			
			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				[
					'label'              => __( 'Horizontal Padding', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .navbar ul > li' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .menu-item a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-nav-menu__layout-vertical .menu-item ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-nav-menu__layout-vertical .menu-item ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-nav-menu__layout-vertical .menu-item ul ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_menu_item',
				[
					'label'              => __( 'Vertical Padding', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .navbar ul.menu > li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_space_between',
				[
					'label'              => __( 'Space Between', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .menu-area .navbar ul.menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav:not(.hfe-nav-menu__layout-horizontal) .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
						'(tablet)body:not(.rtl) {{WRAPPER}}.hfe-nav-menu__breakpoint-tablet .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(mobile)body:not(.rtl) {{WRAPPER}}.hfe-nav-menu__breakpoint-mobile .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(tablet)body {{WRAPPER}} nav.hfe-nav-menu__layout-vertical .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0px',
						'(mobile)body {{WRAPPER}} nav.hfe-nav-menu__layout-vertical .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0px',
					],
					'condition'          => [
						'layout!' => 'expandible',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_row_space',
				[
					'label'              => __( 'Menu Item Right Gap', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 16,
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .navbar ul > li.menu-item-has-children > a' => 'margin-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .menu-area .icon2 .navbar ul > li.menu-item-has-children > a' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);			


			$this->add_control(
				'pointer',
				[
					'label'     => __( 'Link Hover Effect', 'rtelements' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => [
						'none'        => __( 'None', 'rtelements' ),
						'underline'   => __( 'Underline', 'rtelements' ),
						'overline'    => __( 'Overline', 'rtelements' ),
						'double-line' => __( 'Double Line', 'rtelements' ),
						'framed'      => __( 'Framed', 'rtelements' ),
						'text'        => __( 'Text', 'rtelements' ),
					],
					'condition' => [
						'layout' => [ 'horizontal' ],
					],
				]
			);

		$this->add_control(
			'animation_line',
			[
				'label'     => __( 'Animation', 'rtelements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => 'Fade',
					'slide'    => 'Slide',
					'grow'     => 'Grow',
					'drop-in'  => 'Drop In',
					'drop-out' => 'Drop Out',
					'none'     => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		

		$this->add_control(
			'animation_text',
			[
				'label'     => __( 'Animation', 'rtelements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => 'Grow',
					'shrink' => 'Shrink',
					'sink'   => 'Sink',
					'float'  => 'Float',
					'skew'   => 'Skew',
					'rotate' => 'Rotate',
					'none'   => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'text',
				],
			]
		);

		$this->add_control(
			'style_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'menu_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .menu-area .navbar ul li a',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );
			$this->start_controls_tab(
				'tab_menu_item_normal',
				[
					'label' => __( 'Normal', 'rtelements' ),
				]
			);

				$this->add_control(
					'color_menu_item',
					[
						'label'     => __( 'Text Color', 'rtelements' ),
						'type'      => Controls_Manager::COLOR,
						'global'    => [
							'default' => Global_Colors::COLOR_TEXT,
						],
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .menu-area .navbar ul li a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'bg_color_main_menu',
					[
						'label'     => __( 'Background Color', 'rtelements' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .menu-area .navbar ul.menu > li' => 'background-color: {{VALUE}}',
						],
						
					]
				);

				

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					[
						'label' => __( 'Hover', 'rtelements' ),
					]
				);

					$this->add_control(
						'color_menu_item_hover',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li:hover > a,
								{{WRAPPER}} .menu-area .navbar ul > li.menu-item-has-children:hover > a:before,
								
								{{WRAPPER}} .menu-area .navbar ul li.current-menu-item a' => 'color: {{VALUE}}',
							],
						]
					);					


				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					[
						'label' => __( 'Active', 'rtelements' ),
					]
				);

					$this->add_control(
						'color_menu_item_active',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li.current-menu-item a,
								{{WRAPPER}} .menu-area .navbar ul > li.current-menu-ancestor a:before,
								{{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor a' => 'color: {{VALUE}}',
							],
						]
					);

				
					

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border_item',
					'label' => esc_html__( 'Border', 'rtelements' ),
					'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu > li',
				]
			);
			

			$this->add_responsive_control(
				'meniu_border_radius',
				[
					'label'              => __( 'Border Radius', 'rtelements' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .navbar ul.menu > li'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'icon_options',
				[
					'label' => esc_html__( 'Parent Menu Icon', 'plugin-name' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'parent_icon_style',
				[
					'label' => esc_html__( 'Select Icon', 'plugin-name' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'icon1',
					'options' => [
						'icon1'  => esc_html__( 'Plus', 'plugin-name' ),
						'icon2' => esc_html__( 'Arrow', 'plugin-name' ),						
					],
				]
			);

				

			$this->add_control(
				'parent_icon_style__color',
				[
					'label'     => __( 'Icon Color', 'rtelements' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .menu-area .navbar ul > li.menu-item-has-children > a:before' => 'color: {{VALUE}} !important',
					],
				]
			);



			$this->add_control(
				'more_options',
				[
					'label' => esc_html__( 'Sticky Menu Color', 'plugin-name' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_menu_item_style_stikcy' );

				$this->start_controls_tab(
					'stikcy_menu_item_normal',
					[
						'label' => __( 'Normal', 'rtelements' ),
					]
				);

					$this->add_control(
						'sticky_color_menu_item',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_TEXT,
							],
							'default'   => '',
							'selectors' => [
								'.sticky .menu-area .navbar ul li a' => 'color: {{VALUE}} !important',
							],
						]
					);

					

				$this->end_controls_tab();

				$this->start_controls_tab(
					'sticky_menu_item_hover',
					[
						'label' => __( 'Hover', 'rtelements' ),
					]
				);

					$this->add_control(
						'sticky_color_menu_item_hover',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li a:hover,
								
								{{WRAPPER}} .menu-area .navbar ul li.current-menu-item a' => 'color: {{VALUE}}',
							],
						]
					);					


				$this->end_controls_tab();

				$this->start_controls_tab(
					'sticky_menu_item_active',
					[
						'label' => __( 'Active', 'rtelements' ),
					]
				);

					$this->add_control(
						'sticky_color_menu_item_actve',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li.current-menu-item a,
								{{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor a' => 'color: {{VALUE}}',
							],
						]
					);

				
					

				$this->end_controls_tab();

			$this->end_controls_tabs();

			

		$this->end_controls_section();

	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'rtelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'dropdown_description',
				[
					'raw'             => __( '<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'rtelements' ),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
					'condition'       => [
						'layout!' => [
							'expandible',
							'flyout',
						],
					],
				]
			);

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

				$this->start_controls_tab(
					'tab_dropdown_item_normal',
					[
						'label' => __( 'Normal', 'rtelements' ),
					]
				);

					$this->add_control(
						'color_dropdown_item',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li a' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_control(
						'bg_color_menu_item',
						[
							'label'     => __( 'Background Color', 'header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu' => 'background-color: {{VALUE}}',
							],
							
						]
					);


					

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_hover',
					[
						'label' => __( 'Hover', 'rtelements' ),
					]
				);

					$this->add_control(
						'color_dropdown_item_hover',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li:hover> a 
								' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_hover',
						[
							'label'     => __( 'Background Color', 'header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li:hover' => 'background-color: {{VALUE}}',
							],
							
						]
					);				

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_active',
					[
						'label' => __( 'Active', 'rtelements' ),
					]
				);

				$this->add_control(
					'color_dropdown_item_active',
					[
						'label'     => __( 'Text Color', 'rtelements' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li.current-menu-item > a,
						
							{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li.current-menu-ancestor >  a
						
							' => 'color: {{VALUE}}',

						],
					]
				);
				$this->add_control(
						'bg_color_menu_item_active',
						[
							'label'     => __( 'Background Color', 'header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li.current-menu-item' => 'background-color: {{VALUE}}',
							],
							
						]
					);		

			
				$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'dropdown_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'separator' => 'before',
					'selector'  => '
							{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li a',
				]
			);


			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'label' => esc_html__( 'Border', 'rtelements' ),
					'selector' => '{{WRAPPER}} .menu-area .sub-menu',
				]
			);
			

			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label'              => __( 'Border Radius', 'rtelements' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .sub-menu'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'dropdown_box_shadow',
					'exclude'   => [
						'box_shadow_position',
					],
					'selector'  => '{{WRAPPER}} .menu-area ul.sub-menu
								',
					'separator' => 'after',
				]
			);

			$this->add_responsive_control(
				'width_dropdown_item',
				[
					'label'              => __( 'Dropdown Width (px)', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'default'            => [
						'size' => '220',
						'unit' => 'px',
					],
					'selectors'          => [						
						'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
						
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				[
					'label'              => __( 'Horizontal Padding', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li a,
						{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
						{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav.hfe-dropdown-expandible a.hfe-sub-menu-item,
						{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				[
					'label'              => __( 'Vertical Padding', 'rtelements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu li a,
						 {{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'frontend_available' => true,
				]
			);

			
			$this->add_control(
				'heading_dropdown_divider',
				[
					'label'     => __( 'Divider', 'rtelements' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'dropdown_divider_border',
				[
					'label'       => __( 'Border Style', 'rtelements' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => [
						'none'   => __( 'None', 'rtelements' ),
						'solid'  => __( 'Solid', 'rtelements' ),
						'double' => __( 'Double', 'rtelements' ),
						'dotted' => __( 'Dotted', 'rtelements' ),
						'dashed' => __( 'Dashed', 'rtelements' ),
					],
					'selectors'   => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child)
						' => 'border-bottom-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_border_color',
				[
					'label'     => __( 'Border Color', 'rtelements' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c4c4c4',
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

			$this->add_control(
				'dropdown_divider_width',
				[
					'label'     => __( 'Border Width', 'rtelements' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'default'   => [
						'size' => '1',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

		$this->end_controls_section();


		//Responsive menu icon settings

		$this->start_controls_section(
			'resonsive_menu',
			[
				'label'     => __( 'Responsive Menu Style', 'rtelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'all_typography_responsive',
					'label'    => __( 'Typography', 'rtelements' ),
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'selector' => '.sidenav .widget_nav_menu ul li a',
				]
			);
			
			$this->start_controls_tabs( '_menu_text_style' );

				$this->start_controls_tab(
					'_test_responsive_normal',
					[
						'label' => __( 'Normal', 'rtelements' ),
					]
				);

					$this->add_control(
						'all_text_color_responsive',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'.sidenav .widget_nav_menu ul li a' => 'color: {{VALUE}};',
							],
						]
					);
				
				$this->end_controls_tab();

				$this->start_controls_tab(
					'responsive_text_hover',
					[
						'label' => __( 'Hover', 'rtelements' ),
					]
				);

					$this->add_control(
						'all_hover_color_responsive',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'.sidenav .widget_nav_menu ul li a:hover' => 'color: {{VALUE}};',
							],
						]
					);	


				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'menu_icon_bg_responsive',
				[
					'label'     => __( 'Responsive Menu Icon Bg', 'rtelements' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'#mobile_menu .submenu-button' => 'background: {{VALUE}};',
						'.menu-wrap-off .inner-offcan .nav-link-container .close-button' => 'background: {{VALUE}};'
					],
				]
			);
			$this->add_control(
				'menu_icon_responsive',
				[
					'label'     => __( 'Responsive Menu Icon Color', 'rtelements' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'#mobile_menu .submenu-button:after' => 'color: {{VALUE}};',
						'.menu-wrap-off .inner-offcan .nav-link-container .close-button' => 'color: {{VALUE}};'
					],
				]
			);

		$this->end_controls_section();

		//menu trigger icon

		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Menu Trigger & Close Icon', 'rtelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal2',
			[
				'label' => __( 'Normal', 'rtelements' ),
			]
		);

		$this->add_control(
			'toggle_color2',
			[
				'label'     => __( 'Color', 'rtelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.hfe-nav-menu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.hfe-nav-menu-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color2',
			[
				'label'     => __( 'Background Color', 'rtelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.offcanvas-icon .nav-link-container .nav-menu-link span' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'more_options_stikcy2',
			[
				'label' => esc_html__( 'Sticky Mobile Icon Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sticky_background_color2',
			[
				'label'     => __( 'Background Color', 'rtelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.sticky .offcanvas-icon .nav-link-container .nav-menu-link span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover2',
			[
				'label' => __( 'Hover', 'rtelements' ),
			]
		);

		$this->add_control(
			'toggle_hover_color2',
			[
				'label'     => __( 'Color', 'rtelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.hfe-nav-menu-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.hfe-nav-menu-icon:hover svg' => 'fill: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'toggle_hover_background_color',
			[
				'label'     => __( 'Background Color', 'rtelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-nav-menu-icon:hover' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		
		$this->end_controls_tabs();

		$this->add_control(
			'more_options_icon',
			[
				'label' => esc_html__( 'Burger Icon Box Style', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
            'width',
            [
                'label' => esc_html__( 'Burger Icon Box width', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .mobilehum ul.offcanvas-icon .nav-link-container' => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
          $this->add_control(
            'height',
            [
                'label' => esc_html__( 'Burger Icon Box Height', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [                    
                    '{{WRAPPER}} .mobilehum ul.offcanvas-icon .nav-link-container' => 'height: {{SIZE}}{{UNIT}};',
                   
                ],
            ]
        );
           $this->add_control(
            'line-height',
            [
                'label' => esc_html__( 'Burger Icon Box Line Height', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .mobilehum ul.offcanvas-icon .nav-link-container' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Box Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '.mobilehum ul.offcanvas-icon .nav-link-container',
            ]
        );   

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Icon Box Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '.mobilehum ul.offcanvas-icon .nav-link-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
			'style_button',
			[
				'label'     => __( 'Button', 'rtelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'all_typography',
					'label'    => __( 'Typography', 'rtelements' ),
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
				]
			);
			$this->add_responsive_control(
				'padding',
				[
					'label'              => __( 'Padding', 'rtelements' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', 'em', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->start_controls_tabs( '_button_style' );

				$this->start_controls_tab(
					'_button_normal',
					[
						'label' => __( 'Normal', 'rtelements' ),
					]
				);

					$this->add_control(
						'all_text_color',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_color',
							'label'          => __( 'Background Color', 'rtelements' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'all_border',
							'label'    => __( 'Border', 'rtelements' ),
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
						]
					);

					$this->add_control(
						'all_border_radius',
						[
							'label'      => __( 'Border Radius', 'rtelements' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'all_button_box_shadow',
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'all_button_hover',
					[
						'label' => __( 'Hover', 'rtelements' ),
					]
				);

					$this->add_control(
						'all_hover_color',
						[
							'label'     => __( 'Text Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_hover_color',
							'label'          => __( 'Background Color', 'rtelements' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_control(
						'all_border_hover_color',
						[
							'label'     => __( 'Border Hover Color', 'rtelements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'      => 'all_button_hover_box_shadow',
							'selector'  => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover',
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 * @since 1.5.2
	 * @param string $atts link attributes.
	 * @access public
	 */
	public function handle_link_attrs( $atts ) {

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 * @since 1.6.0
	 * @param string $value link attributes.
	 * @access public
	 */
	public function handle_li_values( $value ) {

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Get the menu and close icon HTML.
	 *
	 * @since 1.5.2
	 * @param array $settings Widget settings array.
	 * @access public
	 */
	public function get_menu_close_icon( $settings ) {
		$menu_icon     = '';
		$close_icon    = '';
		$icons         = [];
		$icon_settings = [
			$settings['dropdown_icon'],
			$settings['dropdown_close_icon'],
		];

		foreach ( $icon_settings as $icon ) {
			if ( $this->is_elementor_updated() ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon(
					$icon,
					[
						'aria-hidden' => 'true',
						'tabindex'    => '0',
					]
				);
				$menu_icon = ob_get_clean();
			} else {
				$menu_icon = '<i class="' . esc_attr( $icon ) . '" aria-hidden="true" tabindex="0"></i>';
			}

			array_push( $icons, $menu_icon );
		}

		return $icons;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render() { 
	$settings = $this->get_settings_for_display();		
	$class_responsvie =  $settings['enable_responsive_view'] == 'yes' ? 'primary-menu': '';
	$class_click_expand =  $settings['expand_on_click'] == 'yes' ? ' expand-on-click': '';
	?>
	<div class="menu-area <?php echo esc_attr($settings['layout'].$class_click_expand);?>">         
		<div class="menu_one <?php echo esc_attr($settings['parent_icon_style']);?> <?php echo $settings['enable_two_column'];?>">							 
			<div class="col-cell menu-responsive <?php echo esc_attr($class_responsvie);?>">  
				<?php
				$menus = $this->get_available_menus();
				if ( empty( $menus ) ) {
					return false;
				}
				$args = [
					'echo'        => false,
					'menu'        => $settings['menu'],
					'menu_class'  => 'menu',						
					'fallback_cb' => '__return_empty_string',
					'container'   => '',
					'walker'      => '',
				];
				$menu_html = wp_nav_menu( $args );

				
					// User has assigned menu to this location;
					// output it
					?>
					<nav class="nav navbar">
						<div class="navbar-menu">
							<?php
								echo $menu_html ;
							?>
						</div>
					</nav>
					<?php
				
				?>
			</div>			
			
		<div class="sidebarmenu-area text-right mobilehum <?php echo esc_attr($class_responsvie);?>">                                    
			<ul class="offcanvas-icon">
				<li class="nav-link-container"> 
					<a href='#' class="nav-menu-link menu-button">
						<span class="dot1"></span>
						<span class="dot2"></span>
						<span class="dot3"></span>
						<span class="dot4"></span>
						<span class="dot5"></span>
						<span class="dot6"></span>
						<span class="dot7"></span>
						<span class="dot8"></span>
						<span class="dot9"></span>                                          
					</a> 
				</li>
			</ul>                                       
		</div>      
		</div>
	</div>		 
	<?php }		
}