<?php
/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class RTS_Product_Cart extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rt-productcart';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RT Woo Cart', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-multimedia';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'product', 'list', 'category' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
    {
    	$this->start_controls_section(
            'rt_cart_content',
            [
                'label' => esc_html__('Cart Item', 'rsaddon'),
               
            ]
        );

        $this->add_control(
			'cart_icon',
			[
				'label'       => __( 'Cart Icon', 'rtelements' ),
				'type'        => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				]
            ]
		);

          $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_typography',
            [
                'label' => esc_html__('Color &amp; Typography', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_heading',
            [
                'label' => __('Icon', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'cart_icon_color',
            [
				'label'   => esc_html__('Cart Icon Color', 'rsaddon'),
				'type'    => Controls_Manager::COLOR,
				'default' => '#040404',
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'width',
            [
                'label' => esc_html__( 'Cart Icon Box width', 'plugin-name' ),
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
                    '{{WRAPPER}} .menu-cart-area' => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
          $this->add_control(
            'height',
            [
                'label' => esc_html__( 'Cart Icon Box Height', 'plugin-name' ),
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
                    '{{WRAPPER}} .menu-cart-area' => 'height: {{SIZE}}{{UNIT}};',
                   
                ],
            ]
        );
           $this->add_control(
            'line-height',
            [
                'label' => esc_html__( 'Cart Icon Box Line Height', 'plugin-name' ),
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
                    '{{WRAPPER}} .menu-cart-area' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Box Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '.menu-cart-area',
            ]
        );   

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Icon Box Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '.menu-cart-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'align',
			[
				'label'              => __( 'Icon Alignment', 'rtelements' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'   => [
						'title' => __( 'Left', 'rtelements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'rtelements' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'rtelements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				
				'selectors'          => [
					'{{WRAPPER}} .menu-cart-area' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);     

        $this->add_control(
            'cart_number_color',
            [
				'label'   => esc_html__('Cart Count Color', 'rsaddon'),
				'type'    => Controls_Manager::COLOR,
				'default' => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area span.icon-num' => 'color: {{VALUE}};',
                ],
            ]
        );

        
        $this->add_control(
            'cart_count_bg_color',
            [
                'label' => esc_html__('Count Bg Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#B79B6C',
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area span.icon-num' => 'background: {{VALUE}};',
                  

                ],
            ]
        );

    
        $this->add_responsive_control(
			'position',
			[
				'label'     => __( 'Count Bg Top Position', 'rtelements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area span.icon-num' => 'top: {{SIZE}}%;',
				],
			]
		);

        $this->add_responsive_control(
			'position2',
			[
				'label'     => __( 'Count BG Right Position', 'rtelements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'max'  => 100,
						'min'  => -50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area span.icon-num' => 'right: {{SIZE}}%;',
				],
			]
		);

   

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_sale_badge_typography',
                'selector' => '{{WRAPPER}} .product-img span.sale-rs',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_add_to_cart_styles',
            [
                'label' => esc_html__('Add to Cart Button Styles', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('rs_product_grid_add_to_cart_style_tabs');

        $this->start_controls_tab('normal', ['label' => esc_html__('Normal', 'rsaddon')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_color',
            [
                'label' => esc_html__('Button Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_background',
            [
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'background-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_product_grid_add_to_cart_border',
                'selector' => '{{WRAPPER}}.rselements-product-list .product-btn a',
                '{{WRAPPER}} .product-img.overlay .product-btn a', 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_add_to_cart_typography',
                'selector' => '{{WRAPPER}}.rselements-product-list .product-btn a',
                '{{WRAPPER}} .product-img.overlay .product-btn a', 
                
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('rs_product_grid_add_to_cart_hover_styles', ['label' => esc_html__('Hover', 'rsaddon')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_color',
            [
                'label' => esc_html__('Button Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}}  .rselements-product-list .product-btn a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'color: {{VALUE}};',                    
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_background',
            [
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'background-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'border-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'rs_peoduct_grid_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .product-btn a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
		global $woocommerce;
		if ( class_exists( 'WooCommerce' ) ) {?>
			<div class="menu-cart-area">
			<?php \Elementor\Icons_Manager::render_icon( $settings['cart_icon'], [ 'aria-hidden' => 'true' ] ); ?> <span class="icon-num"><?php echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '';?></span>
				
			</div>			
		<?php } 
    	
    }   

}