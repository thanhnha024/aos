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
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Product_Slider_Widget extends \Elementor\Widget_Base {

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
		return 'rs-product-slider';
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
		return __( 'RTS Porduct Slider', 'rtelements' );
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
		return 'glyph-icon flaticon-shopping-cart';
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
        return [ 'rsaddon_category' ];
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
    	// Content Controls
        $this->start_controls_section(
            'rs_section_product_grid_settings',
            [
                'label' => esc_html__('Product Settings', 'rtelements'),
            ]
        );
        $this->add_control(
            'rs_product_grid_product_filter',
            [
                'label' => esc_html__('Filter By', 'rtelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent-products',
                'options' => [
					'recent-products'       => esc_html__('Recent Products', 'rtelements'),
					'featured-products'     => esc_html__('Featured Products', 'rtelements'),
					'best-selling-products' => esc_html__('Best Selling Products', 'rtelements'),
					'sale-products'         => esc_html__('Sale Products', 'rtelements'),
					'top-products'          => esc_html__('Top Rated Products', 'rtelements'),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'large',
                'separator' => 'before',
                'exclude'   => [
                    'custom',
                ],
                'separator' => 'before',
            ]
        );

     
         $this->add_control(
            'rs_product_grid_products_count',
            [
				'label'   => __('Products Count', 'rtelements'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 1000,
				'step'    => 1,
            ]
        );

        $this->add_control(
            'rs_product_grid_categories',
            [
				'label'       => esc_html__('Product Categories', 'rtelements'),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     =>rselemetns_woocommerce_product_categories(),
            ]
        );
		$this->add_control(
			'show_pcats',
			[
				'label' => esc_html__( 'Show Categoris', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'No',
			]
		);

        $this->add_control(
            'rt_pslider_style',
            [
                'label' => esc_html__('Style Preset', 'rtelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
					'style1' => esc_html__('Default', 'rtelements'),					
					'style2' => esc_html__('Style 2', 'rtelements'),
					'style3' => esc_html__('Style 3', 'rtelements'),
					'style4' => esc_html__('Style 4', 'rtelements'),
					'style5' => esc_html__('Style 5', 'rtelements'),
					'style6' => esc_html__('Style 6', 'rtelements'),
					'style7' => esc_html__('Style 7', 'rtelements'),
                ],
            ]
        );
        $this->add_control(
            'pcat_deal_text',
            [
                'label' => esc_html__( 'Deal Description', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Hot Deal In This Week', 'rtelements' ),
                'placeholder' => esc_html__( 'Write your deal quote', 'rtelements' ),
                'condition' => [ 'rt_pslider_style' => ['style3','style5'] ],
            ]
        );
        $this->add_control(
            'pcat_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '<i class="rt-cart-shopping"></i> Shop Now</a>', 'rtelements' ),
                'placeholder' => esc_html__( 'Shop Now', 'rtelements' ),
                'condition' => [ 'rt_pslider_style'=> ['style3','style5'] ],
            ]
        );       

        $this->add_control(
            'rt_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'rtelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
					'default' => esc_html__('Default', 'rtelements'),					
					'fade' => esc_html__('Fade', 'rtelements'),
					'flip' => esc_html__('Flip', 'rtelements'),
					'cube' => esc_html__('Cube', 'rtelements'),
					'coverflow' => esc_html__('Coverflow', 'rtelements'),
					'creative' => esc_html__('Creative', 'rtelements'),
					'cards' => esc_html__('Cards', 'rtelements'),
                ],
            ]
        );


        $this->end_controls_section();

                $this->start_controls_section(
                    'content_slider',
                    [
                        'label' => esc_html__( 'Slider Settings', 'rtelements' ),
                        'tab' => Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'col_xl',
                    [
                        'label'   => esc_html__( 'Wide Screen > 1399px', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rtelements' ), 
                            '2' => esc_html__( '2 Column', 'rtelements' ),
                            '3' => esc_html__( '3 Column', 'rtelements' ),
                            '4' => esc_html__( '4 Column', 'rtelements' ),
                            '4.5' => esc_html__( '4.5 Column', 'rtelements' ),
                            '5' => esc_html__( '5 Column', 'rtelements' ),
                            '5.5' => esc_html__( '5.5 Column', 'rtelements' ),
                            '6' => esc_html__( '6 Column', 'rtelements' ),                 
                        ],
                        'separator' => 'before',
                    ]
                    
                );
            
                $this->add_control(
                    'col_lg',
                    [
                        'label'   => esc_html__( 'Desktops > 1199px', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rtelements' ), 
                            '2' => esc_html__( '2 Column', 'rtelements' ),
                            '3' => esc_html__( '3 Column', 'rtelements' ),
                            '4' => esc_html__( '4 Column', 'rtelements' ),
                            '6' => esc_html__( '6 Column', 'rtelements' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_md',
                    [
                        'label'   => esc_html__( 'Desktops > 991px', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rtelements' ), 
                            '2' => esc_html__( '2 Column', 'rtelements' ),
                            '3' => esc_html__( '3 Column', 'rtelements' ),
                            '4' => esc_html__( '4 Column', 'rtelements' ),
                            '6' => esc_html__( '6 Column', 'rtelements' ),                     
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_sm',
                    [
                        'label'   => esc_html__( 'Tablets > 767px', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 2,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rtelements' ), 
                            '2' => esc_html__( '2 Column', 'rtelements' ),
                            '3' => esc_html__( '3 Column', 'rtelements' ),
                            '4' => esc_html__( '4 Column', 'rtelements' ),
                            '6' => esc_html__( '6 Column', 'rtelements' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_xs',
                    [
                        'label'   => esc_html__( 'Tablets < 768px', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 1,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rtelements' ), 
                            '2' => esc_html__( '2 Column', 'rtelements' ),
                            '3' => esc_html__( '3 Column', 'rtelements' ),
                            '4' => esc_html__( '4 Column', 'rtelements' ),
                            '6' => esc_html__( '6 Column', 'rtelements' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slides_ToScroll',
                    [
                        'label'   => esc_html__( 'Slide To Scroll', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 2,         
                        'options' => [
                            '1' => esc_html__( '1 Item', 'rtelements' ),
                            '2' => esc_html__( '2 Item', 'rtelements' ),
                            '3' => esc_html__( '3 Item', 'rtelements' ),
                            '4' => esc_html__( '4 Item', 'rtelements' ),                   
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );      

                $this->add_control(
                    'slider_dots',
                    [
                        'label'   => esc_html__( 'Navigation Dots', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rtelements' ),
                            'false' => esc_html__( 'Disable', 'rtelements' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_nav',
                    [
                        'label'   => esc_html__( 'Navigation Nav', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',           
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rtelements' ),
                            'false' => esc_html__( 'Disable', 'rtelements' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'pcat_prev_text',
                    [
                        'label' => esc_html__( 'Previous Text', 'rtelements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Previous', 'rtelements' ),
                        'placeholder' => esc_html__( 'Type your title here', 'rtelements' ),
                        'condition' => [
                            'slider_nav' => 'true',
                        ],
                    ]
                );
        
                $this->add_control(
                    'pcat_next_text',
                    [
                        'label' => esc_html__( 'Next Text', 'rtelements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Next', 'rtelements' ),
                        'placeholder' => esc_html__( 'Type your title here', 'rtelements' ),
                        'condition' => [
                            'slider_nav' => 'true',
                        ],
        
                    ]
                );
        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'rtelements' ),
                    '2000' => esc_html__( '2 Seconds', 'rtelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'rtelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'rtelements' ), 
                    '5000' => esc_html__( '5 Seconds', 'rtelements' ), 
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                          
            ]
            
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'rtelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'rtelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'rtelements' ), 
                    '2000' => esc_html__( '2 Seconds', 'rtelements' ), 
                    '1000' => esc_html__( '1 Seconds', 'rtelements' ),     
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__( 'Stop On Interaction', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

                $this->add_control(
                    'slider_loop',
                    [
                        'label'   => esc_html__( 'Loop', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rtelements' ),
                            'false' => esc_html__( 'Disable', 'rtelements' ),
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_centerMode',
                    [
                        'label'   => esc_html__( 'Center Mode', 'rtelements' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rtelements' ),
                            'false' => esc_html__( 'Disable', 'rtelements' ),
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'item_gap_custom',
                    [
                        'label' => esc_html__( 'Item Gap', 'rtelements' ),
                        'type' => Controls_Manager::SLIDER,
                        'show_label' => true,               
                        'range' => [
                            'px' => [
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'size' => 15,
                        ],          

                    ]
                ); 
                        
                $this->end_controls_section();



        $this->start_controls_section(
            'rs_product_grid_styles',
            [
                'label' => esc_html__('Products Styles', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_background_color',
            [
                'label' => esc_html__('Content Background Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_peoduct_grid_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => false,
                        ],
                    ],
                    'color' => [
                        'default' => '#eee',
                    ],
                ],
                'selector' => '{{WRAPPER}} .rselements-product-list',                
            ]
        );        

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_typography',
            [
                'label' => esc_html__('Color &amp; Typography', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_heading',
            [
                'label' => __('Product Title', 'rtelements'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_color',
            [
                'label' => esc_html__('Product Title Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list h4 a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper.pslider-style3 .pslider-wrap .pslider-row .pslider-content .pslide-content-box .p-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_title_typography',
                'selector' => '{{WRAPPER}} .rselements-product-list h4 a',
            ]
        );

        $this->add_control(
            'rs_product_grid_product_price_heading',
            [
                'label' => __('Product Price', 'rtelements'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_price_color',
            [
                'label' => esc_html__('Product Price Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_price_typography',
                'selector' => '{{WRAPPER}} .rselements-product-list .product-price',
            ]
        );

       
        $this->add_control(
            'rs_product_grid_sale_badge_heading',
            [
                'label' => __('Sale Badge', 'rtelements'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_sale_badge_color',
            [
                'label' => esc_html__('Sale Badge Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .product-img span.sale-rs' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rselements-product-list span ins' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_sale_badge_background',
            [
                'label' => esc_html__('Sale Badge Background', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff2a13',
                'selectors' => [
                    '{{WRAPPER}} .product-img span.sale-rs' => 'background-color: {{VALUE}};', 
                    '{{WRAPPER}} .rselements-product-list span ins' => 'background-color: {{VALUE}};',                  
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
                'label' => esc_html__('Add to Cart Button Styles', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('rs_product_grid_add_to_cart_style_tabs');

        $this->start_controls_tab('normal', ['label' => esc_html__('Normal', 'rtelements')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_color',
            [
                'label' => esc_html__('Button Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .swiper.pslider-style3 .pslider-wrap .pslider-row .pslider-content .pslide-content-box .rating-btn .p-btn' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .pslider-style5 .product-item .rselements-product-list .price--cart .product-btn a:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_background',
            [
                'label' => esc_html__('Button Background Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'background-color: {{VALUE}};',                   
                    '{{WRAPPER}} .swiper.pslider-style3 .pslider-wrap .pslider-row .pslider-content .pslide-content-box .rating-btn .p-btn' => 'background-color: {{VALUE}};',                   
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

        $this->start_controls_tab('rs_product_grid_add_to_cart_hover_styles', ['label' => esc_html__('Hover', 'rtelements')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_color',
            [
                'label' => esc_html__('Button Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .rselements-product-list .product-btn a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'color: {{VALUE}};',                    
                    '{{WRAPPER}} .swiper.pslider-style3 .pslider-wrap .pslider-row .pslider-content .pslide-content-box .rating-btn .p-btn:hover' => 'color: {{VALUE}};',                    
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_background',
            [
                'label' => esc_html__('Button Background Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .swiper.pslider-style3 .pslider-wrap .pslider-row .pslider-content .pslide-content-box .rating-btn .p-btn:hover' => 'background-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'rtelements'),
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
                'label' => esc_html__('Border Radius', 'rtelements'),
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
        
       

        $col_xl          = $settings['col_xl'];
        $col_xl          = !empty($col_xl) ? $col_xl : 3;
        $slidesToShow    = $col_xl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval        = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs']; 
        $item_gap = $settings['item_gap_custom']['size'];
        $item_gap = !empty($item_gap) ? $item_gap : '30';
        $prev_text = $settings['pcat_prev_text'];
        $prev_text = !empty($prev_text) ? $prev_text : '';
        $next_text = $settings['pcat_next_text'];
        $next_text = !empty($next_text) ? $next_text : '';
        $unique = rand(2012,35120);

        $all_pcat = rselemetns_woocommerce_product_categories();
        $pcats = $settings['rs_product_grid_categories'];

        if( $slider_autoplay =='true' ){
            $slider_autoplay = 'autoplay: { ' ;
            $slider_autoplay .= 'delay: '.$interval;
            if(  $pauseOnHover =='true'  ){
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            }else{
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if(  $pauseOnInter =='true'  ){
                $slider_autoplay .= ', disableOnInteraction: true';
            }else{
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        }else{
            $slider_autoplay = 'autoplay: false' ;
        }

       
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['rs_product_grid_products_count'] ?: 4,
            'order' => 'DESC',
        ];

        if (!empty($settings['rs_product_grid_categories'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $settings['rs_product_grid_categories'],
                    'operator' => 'IN',
                ],
            ];
        }

        if ($settings['rs_product_grid_product_filter'] == 'featured-products') {
            $args['tax_query'] = [
                [
					'taxonomy' => 'product_visibility',
                    'field' => 'name',
					'terms' => 'featured'
				]
            ];
        } else if ($settings['rs_product_grid_product_filter'] == 'best-selling-products') {
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        } else if ($settings['rs_product_grid_product_filter'] == 'sale-products') {
            $args['meta_query'] = [
                'relation' => 'OR',
                [
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ], [
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ],
            ];
        } else if ($settings['rs_product_grid_product_filter'] == 'top-products') {
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        }
        $effect = $settings['rt_pslider_effect'];

        if($effect== 'fade'){
            $seffect = "effect: 'fade', fadeEffect: { crossFade: true, },";
        }elseif($effect== 'cube'){
            $seffect = "effect: 'cube',";
        }elseif($effect== 'flip'){
            $seffect = "effect: 'flip',";
        }elseif($effect== 'coverflow'){
            $seffect = "effect: 'coverflow',";
        }elseif($effect== 'creative'){
            $seffect = "effect: 'creative', creativeEffect: { prev: { translate: [0, 0, -400], }, next: { translate: ['100%', 0, 0], }, },";
        }elseif($effect== 'cards'){
            $seffect = "effect: 'cards',";
        }else{
            $seffect = '';
        }

        $pstyle = $settings['rt_pslider_style'];
        $show_cat = $settings['show_pcats'];
        $the_query = new WP_Query( $args );
        global $weiboo_option;

        $repeat_style  = '';
        if( $pstyle == 'style7' ) $repeat_style = ' pslider-style6';
        ?>
        <div class="<?php echo esc_attr($repeat_style); ?> Xrsaddon-unique-slider rt--pslider pslider-<?php echo esc_attr($pstyle); ?> swiper rt_slider-<?php echo esc_attr($unique); ?>">
            <?php
                if( $sliderNav == 'true' ){
                    echo '<div class="rt-slider-navigation"><div class="rt-slider-prev">'. $prev_text .'</div><div class="rt-slider-next">'. $next_text .'</div></div>';
                }
            ?>
            <?php
                if( $sliderDots == 'true' ) echo '<div class="swiper-pagination"></div>';
            ?>
            <div id="Xrsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="swiper-wrapper rs-addon-slider">
                <?php         	
                if($pstyle){
                    require plugin_dir_path(__FILE__)."/$pstyle.php";
                }else{
                    require plugin_dir_path(__FILE__)."/style1.php";
                }

                ?>
            </div>   
                
        </div>
        
        <script type="text/javascript">
            jQuery(document).ready(function(){
                var swiper = new Swiper(".rt_slider-<?php echo esc_attr($unique); ?>", {				
                    slidesPerView: 1,
                                    
                    <?php echo $seffect; ?>
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    loop:  <?php echo esc_attr($infinite ); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,

                    spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    },
                    navigation: {
                        nextEl: ".rt-slider-next",
                        prevEl: ".rt-slider-prev",
                    },
                    breakpoints: {
                            
                            <?php
                            echo (!empty($col_xs)) ?  '575: { slidesPerView: '. $col_xs .' },' : '';
                            echo (!empty($col_sm)) ?  '767: { slidesPerView: '. $col_sm .' },' : '';
                            echo (!empty($col_md)) ?  '991: { slidesPerView: '. $col_md .' },' : '';
                            echo (!empty($col_lg)) ?  '1199: { slidesPerView: '. $col_lg .' },' : '';
                            ?>
                            1399: {
                                slidesPerView: <?php echo esc_attr($col_xl); ?>,
                                spaceBetween:  <?php echo esc_attr($item_gap); ?>
                            }
                        }                    
                });
            });
        </script>
        <?php 
    	
    }   

}