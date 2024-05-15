<?php
    use Elementor\Controls_Manager;
    use Elementor\Group_Control_Image_Size;
    use Elementor\Group_Control_Border;
    use Elementor\Group_Control_Typography;

    defined('ABSPATH') || die();

    class ReacTheme_Elementor_Product_isotop_Widget extends \Elementor\Widget_Base {

        /**
         * Get widget name.
         *
         * Retrieve rsgallery widget name.
         *
         * @since 1.0.0
         * @access public
         *
         * @return string Widget name.
         */
        public function get_name() {
            return 'rt-product-isotop';
        }

        /**
         * Get widget title.
         *
         * Retrieve rsgallery widget title.
         *
         * @since 1.0.0
         * @access public
         *
         * @return string Widget title.
         */
        public function get_title() {
            return __('RT Product Isotop', 'rtelements');
        }

        /**
         * Get widget icon.
         *
         * Retrieve rsgallery widget icon.
         *
         * @since 1.0.0
         * @access public
         *
         * @return string Widget icon.
         */
        public function get_icon() {
            return 'glyph-icon flaticon-grid';
        }

        /**
         * Get widget categories.
         *
         * Retrieve the list of categories the rsgallery widget belongs to.
         *
         * @since 1.0.0
         * @access public
         *
         * @return array Widget categories.
         */
        public function get_categories() {
            return ['pielements_category'];
        }

        /**
         * Register rsgallery widget controls.
         *
         * Adds different input fields to allow the user to change and customize the widget settings.
         *
         * @since 1.0.0
         * @access protected
         */
        protected function register_controls() {

            $this->start_controls_section(
                'content_section',
                [
                    'label' => esc_html__('Content', 'rtelements'),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'product_isotop_style',
                [
                    'label'   => esc_html__('Select Style', 'rtelements'),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        '1' => 'Style 1',
                        '2' => 'Style 2',
                        '3' => 'Style 3',
                    ],
                ]
            );

            $this->add_control(
                'product-type',
                [
                    'label'     => esc_html__('Product Type', 'rtelements'),
                    'type'      => Controls_Manager::SELECT2,
                    'options'   => [
                        'popular'    => esc_html__('Popular', 'rtelements'),
                        'on_sale'    => esc_html__('On Sale', 'rtelements'),
                        'best_rated' => esc_html__('Best Rated', 'rtelements'),
                        'featured'   => esc_html__('Featured', 'rtelements'),
                    ],
                    'multiple'  => true,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'per_page',
                [
                    'label'     => esc_html__('Produce Show Per Page', 'rtelements'),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => -1,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'rt_product_cats',
                [
                    'label'       => esc_html__('Product Categories', 'rsaddon'),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => rselemetns_woocommerce_product_categories(),
                ]
            );

            $this->add_control(
                'filter_title',
                [
                    'label'     => esc_html__('Filter All Title', 'rsaddon'),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => 'All',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'filter_nav_style',
                [
                    'label'       => esc_html__('Filter Style', 'rsaddon'),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'default'    => 'nav_style',
                    'options'   => [
                        'nav_style'    => esc_html__('Nav Style', 'rtelements'),
                        'dropdown_style'    => esc_html__('Dropdown Style', 'rtelements'),
                    ],
                ]
            );

            $this->add_control(
                'filter_title_dropbox',
                [
                    'label'     => esc_html__('Dropdown Boxes Level', 'rsaddon'),
                    'type'      => Controls_Manager::TEXT,                   
                    'separator' => 'before',
                    'condition' => [
                        'filter_nav_style' => 'dropdown_style',
                    ],
                ]
            );
            $this->add_control(
                'filter_title_color',
                [
                    'label'     => esc_html__('Level Color', 'rsaddon'),
                    'type'      => Controls_Manager::COLOR,                   
                    'separator' => 'before',
                    'condition' => [
                        'filter_nav_style' => 'dropdown_style',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rt-isotop-dropdown span.level--filter' => 'color: {{VALUE}};',

                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rts_level_typography',
                    'selector' => '{{WRAPPER}} .rt-isotop-dropdown span.level--filter',
                    'separator' => 'before',     
                    'condition' => [
                        'filter_nav_style' => 'dropdown_style',
                    ],           
                ]
            );  
            $this->add_control(
                'product_columns',
                [
                    'label'     => esc_html__('Columns', 'rtelements'),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => [
                        '2'   => esc_html__('6 Column', 'rtelements'),
                        '20p' => esc_html__('5 Column', 'rtelements'),
                        '3'   => esc_html__('4 Column', 'rtelements'),
                        '4'   => esc_html__('3 Column', 'rtelements'),
                        '6'   => esc_html__('2 Column', 'rtelements'),
                        '1'   => esc_html__('1 Column', 'rtelements'),
                    ],
                    'separator' => 'before',
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
                'radius',
                [
                    'label' => esc_html__( 'Product Image Border Radius', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .product-item .product-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'show__category',
                [
                    'label'        => esc_html__('Show Category', 'plugin-name'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__('Show', 'your-plugin'),
                    'label_off'    => esc_html__('Hide', 'your-plugin'),
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );

            $this->add_control(
                'content__alignment',
                [
                    'label'   => esc_html__('Content Alignment', 'plugin-name'),
                    'type'    => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start'  => [
                            'title' => esc_html__('Left', 'plugin-name'),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'plugin-name'),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'end'    => [
                            'title' => esc_html__('Right', 'plugin-name'),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'start',
                    'toggle'  => true,
                ]
            );
            $this->add_control(
                'image_spacing_custom',
                [
                    'label'      => esc_html__('Item Bottom Gap', 'rtelements'),
                    'type'       => Controls_Manager::SLIDER,
                    'show_label' => true,
                    'separator'  => 'before',
                    'range'      => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'size' => 20,
                    ],

                    'selectors'  => [
                        '{{WRAPPER}} .product-item'       => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .product-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();
            
            $this->start_controls_section(
                'content_section_sale',
                [
                    'label' => esc_html__('Sale Badge', 'rtelements'),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ]
            );           

            $this->add_control(
                'sale_color',
                [
                    'label'     => esc_html__('Sale Text Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .sale-rs' => 'color: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'sale_bg_color',
                [
                    'label'     => esc_html__('Sale Text BG', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .sale-rs' => 'background: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'width',
                [
                    'label' => esc_html__( 'Sale Box Size', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',                       
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .sale-rs' => 'width: {{SIZE}}{{UNIT}} !important; height:{{SIZE}}{{UNIT}} !important; line-height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
                     
            $this->add_responsive_control(
                'sale_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .isotop-style2 .product-item .product-img .sale--box .sale-rs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

                     
            $this->add_responsive_control(
                'sale_gap',
                [
                    'label' => esc_html__( 'Margin', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .isotop-style2 .product-item .product-img .sale--box .sale-rs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->end_controls_section();

            //for new badge controll here
            $this->start_controls_section(
                'content_section_new',
                [
                    'label' => esc_html__('New Badge', 'rtelements'),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'new_text',
                [
                    'label'     => esc_html__('New Text', 'rtelements'),
                    'type'      => Controls_Manager::TEXT,                   
                ]
            );           

            $this->add_control(
                'new_color',
                [
                    'label'     => esc_html__('New Text Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .new' => 'color: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'new_bg_color',
                [
                    'label'     => esc_html__('new Text BG', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .new' => 'background: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'new-width',
                [
                    'label' => esc_html__( 'New Box Size', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',                       
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .new' => 'width: {{SIZE}}{{UNIT}} !important; height:{{SIZE}}{{UNIT}} !important; line-height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
                     
            $this->add_responsive_control(
                'new_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .isotop-style2 .product-item .product-img .sale--box .new' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'new_border_gap',
                [
                    'label' => esc_html__( 'Margin', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .isotop-style2 .product-item .product-img .sale--box .new' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->end_controls_section();

            //hot badge contoll added here

            $this->start_controls_section(
                'content_section_hot',
                [
                    'label' => esc_html__('Hot Badge', 'rtelements'),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'hot_text',
                [
                    'label'     => esc_html__('Hot Text', 'rtelements'),
                    'type'      => Controls_Manager::TEXT,                   
                ]
            );

            

            $this->add_control(
                'hot_color',
                [
                    'label'     => esc_html__('Hot Text Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .hot' => 'color: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'hot_bg_color',
                [
                    'label'     => esc_html__('new Text BG', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .hot' => 'background: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'hot-width',
                [
                    'label' => esc_html__( 'Hot Box Size', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',                       
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .hot' => 'width: {{SIZE}}{{UNIT}} !important; height:{{SIZE}}{{UNIT}} !important; line-height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
                     
            $this->add_responsive_control(
                'hot_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .isotop-style2 .product-item .product-img .sale--box .hot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'hot_gap',
                [
                    'label' => esc_html__( 'Margin', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .isotop-style2 .product-item .product-img .sale--box .new' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->end_controls_section();




            $this->start_controls_section(
                'section_slider_style',
                [
                    'label' => esc_html__('Style', 'rtelements'),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'nav_title_color',
                [
                    'label'     => esc_html__('Navigation Title Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .umrat-filter-h1 .product-filter button' => 'color: {{VALUE}};',

                    ],
                    'condition' => [
                        'filter_nav_style' => 'nav_style',
                    ],
                ]
            );
            $this->add_control(
                'nav_title_active_color',
                [
                    'label'     => esc_html__('Active Navigation Title Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .umrat-filter-h1 .product-filter button.is-checked' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .umrat-filter-h1 .product-filter button:hover'      => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'filter_nav_style' => 'nav_style',
                    ],
                ]
            );
            
            $this->add_control(
                'title_color',
                [
                    'label'     => esc_html__('Product Title Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .weiboo-grid .product-item .product-content .p-title a' => 'color: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );

            

            $this->add_control(
                'title_color_hover',
                [
                    'label'     => esc_html__('Product Title Hover Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .weiboo-grid .product-item .product-content .p-title a:hover' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]

            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rts_product_grid_product_title_typography',
                    'selector' => '{{WRAPPER}} .weiboo-grid .product-item .product-content .p-title a',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'price_color',
                [
                    'label'     => esc_html__('Price Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .weiboo-grid .product-item .product-content .price-html .amount' => 'color: {{VALUE}};',

                    ],
                ]
            );

            $this->add_control(
                'price_color_hover',
                [
                    'label'     => esc_html__('Price Hover Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .weiboo-grid .product-item .product-content .price-html .amount:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );  

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rts_price_typography',
                    'selector' => '{{WRAPPER}} .weiboo-grid .product-item .product-content .price-html .amount bdi',
                    'separator' => 'before',                
                ]
            );

            $this->add_control(
                'add_to_cart_color',
                [
                    'label'     => esc_html__('Add to Cart Text Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .weiboo-grid .product-item .product-content .add_to__cart .add_to_cart_inline a.button' => 'color: {{VALUE}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'add_to_cart_icon_color',
                [
                    'label'     => esc_html__('Add to Cart Icon Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .weiboo-grid .product-item .product-content .add_to__cart .add_to_cart_inline a.button.ajax_add_to_cart:before' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rts_cart_typography',
                    'selector' => '{{WRAPPER}} .weiboo-grid .product-item .product-content .add_to__cart .add_to_cart_inline a.button',
                    'separator' => 'before',                
                ]
            );
            
            $this->end_controls_section();
            $this->start_controls_section(
                'section_dropdown_style',
                [
                    'label' => esc_html__('Dropdown Box Style', 'rtelements'),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'filter_nav_style' => 'dropdown_style',
                    ],
                ]
            );

            $this->add_control(
                'drop_bg',
                [
                    'label'     => esc_html__('Dropdown Boxes Bg', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select' => 'background: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'dordown_boxes_padding',
                [
                    'label' => esc_html__( 'Padding', 'rtelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .product-filter-container .rt-isotop-dropdown .filter-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'dropboxes_height',
                [
                    'label'     => esc_html__('Dropdown Boxes Height', 'rtelements'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select' => 'height: {{SIZE}}{{UNIT}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'dropboxes_width',
                [
                    'label'     => esc_html__('Dropdown Boxes Width', 'rtelements'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 600,
                            'step' => 5,
                        ],                        
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown' => 'max-width: {{SIZE}}{{UNIT}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_box',
                    'label' => esc_html__( 'Border', 'plugin-name' ),
                    'selector' => '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select',
                ]
            );

            $this->add_control(
                'drop_title_color',
                [
                    'label'     => esc_html__('Dropdown Selected Title Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select' => 'color: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rts_dropitem_selected_typography',
                    'selector' => '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select span.current',
                    'separator' => 'before',                
                ]
            );  

            

            $this->add_control(
                'drop_item_title_color',
                [
                    'label'     => esc_html__('Dropdown Item Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select ul.list li' => 'color: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rts_dropitem_typography',
                    'selector' => '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select ul.list li',
                    'separator' => 'before',                
                ]
            );  

            $this->add_control(
                'drop_item_bg_color',
                [
                    'label'     => esc_html__('Dropdown List Backgrond', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select ul.list' => 'background: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_control(
                'drop_item_title__hover_color',
                [
                    'label'     => esc_html__('Dropdown Item Hover Bg', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .filter-select ul.list li.selected,
                         .product-filter-container .rt-isotop-dropdown .filter-select ul.list li:focus, 
                        .product-filter-container .rt-isotop-dropdown .filter-select ul.list li:hover' => 'background: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'drop_item_icon_color',
                [
                    'label'     => esc_html__('Dropdown Boxes Icon Color', 'rtelements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .nice-select:after' => 'border-color: {{VALUE}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'drop_item_icon_with',
                [
                    'label'     => esc_html__('Dropdown Boxes Icon Width', 'rtelements'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .nice-select:after' => 'width: {{SIZE}}{{UNIT}};',

                    ],
                    'separator' => 'before',
                ]
            );

            
            $this->add_control(
                'drop_item_icon_height',
                [
                    'label'     => esc_html__('Dropdown Boxes Icon Height', 'rtelements'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .nice-select:after' => 'height: {{SIZE}}{{UNIT}};',

                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_control(
                'drop_item_icon_position',
                [
                    'label'     => esc_html__('Dropdown Boxes Icon Top/Bottom Positon', 'rtelements'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ '%'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .nice-select:after' => 'top: {{SIZE}}{{UNIT}};',

                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'drop_item_icon_position_left',
                [
                    'label'     => esc_html__('Dropdown Boxes Icon left/right Positon', 'rtelements'),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units' => [ '%'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .product-filter-container .rt-isotop-dropdown .nice-select:after' => 'right: {{SIZE}}{{UNIT}};',

                    ],
                    'separator' => 'before',
                ]
            );
           
           
                

            $this->end_controls_section();
        }

        /**
         * Render rsgallery widget output on the frontend.
         *
         * Written in PHP and used to generate the final HTML.
         *
         * @since 1.0.0
         * @access protected
         */
        protected function render() {

            $settings    = $this->get_settings_for_display();
            $select_type = $settings['product-type'];
            $style       = $settings['product_isotop_style'];
            $isotopStyle = (!empty($style)) ? ' isotop-style' . $style : '';
            $alignment   = $settings['content__alignment'];
            $align_class = (!empty($alignment)) ? ' text-' . $alignment : '';
            $star_align  = ($alignment == 'center') ? ' star-center' : '';
            $show_cat    = $settings['show__category'];
            $pType       = $settings['product-type'];
            $pCat        = $settings['rt_product_cats'];
            if (!empty($pCat)) {
                $pcats = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $pCat,
                    'operator' => 'IN',
                );
            }

            $paged            = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $details_btn_text = !empty($settings['details_btn_text']) ? $settings['details_btn_text'] : 'See Details';

            if (!empty($pType)) {

                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => $settings['per_page'],
                );

                $fearured_ids = [];
                if (in_array('featured', $pType)) {

                    $feat = array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'slug',
                        'terms'    => 'featured',
                        'operator' => 'IN',
                    );
                    if (!empty($pcats) AND is_array($pcats)) {
                        $args2['tax_query'] = ['relation' => 'AND', $pcats, $feat];
                    } else {
                        $args2['tax_query'] = [$feat];
                    }
                    $Q_featured  = new WP_Query($args + $args2);
                    $QP_featured = $Q_featured->posts;
                    if (is_array($QP_featured)) {
                        foreach ($QP_featured as $fet) {
                            $fearured_ids[] = $fet->ID;
                        }
                    }
                }
                $popular_ids = [];
                if (in_array('popular', $pType)) {
                    $args3['meta_key'] = 'total_sales';
                    $args3['orderby']  = 'meta_value_num';
                    $args3['order']    = 'DSC';
                    if (!empty($pcats) AND is_array($pcats)) {
                        $args3['tax_query'][] = $pcats;
                    }
                    $Q_popular  = new WP_Query($args + $args3);
                    $QP_popular = $Q_popular->posts;
                    if (is_array($QP_popular)) {
                        foreach ($QP_popular as $pop) {
                            $popular_ids[] = $pop->ID;
                        }
                    }
                }
                $rating_ids = [];
                if (in_array('best_rated', $pType)) {
                    $args4['meta_key'] = '_wc_average_rating';
                    $args4['orderby']  = 'meta_value_num';
                    $args4['order']    = 'DSC';
                    if (!empty($pcats) AND is_array($pcats)) {
                        $args4['tax_query'][] = $pcats;
                    }
                    $Q_rating  = new WP_Query($args + $args4);
                    $QP_rating = $Q_rating->posts;
                    if (is_array($QP_rating)) {
                        foreach ($QP_rating as $rat) {
                            $rating_ids[] = $rat->ID;
                        }
                    }
                }
                $sale_ids = [];
                if (in_array('on_sale', $pType)) {
                    $sal_meta = array(
                        'key'     => '_sale_price',
                        'compare' => '!=',
                        'value'   => '',
                    );
                    $args5['meta_query'][] = $sal_meta;
                    if (!empty($pcats) AND is_array($pcats)) {
                        $args5['tax_query'][] = $pcats;
                    }
                    $Q_sale  = new WP_Query($args + $args5);
                    $QP_sale = $Q_sale->posts;
                    if (is_array($QP_sale)) {
                        foreach ($QP_sale as $sal) {
                            $sale_ids[] = $sal->ID;
                        }
                    }
                }  
                $final_ids = $rating_ids + $popular_ids + $sale_ids + $fearured_ids;
                if (empty($final_ids)) {
                    return;
                }
                $final_args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => $settings['per_page'],
                    'post__in'       => $final_ids,
                    'orderby'        => 'ID',

                );

            } else {
                $final_args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => $settings['per_page'],
                );
                if (!empty($pcats) AND is_array($pcats)) {
                    $final_args['tax_query'][] = $pcats;
                }

            }

            $Q_final = new WP_Query($final_args);
            $nav_style        = $settings['filter_nav_style'];
            $repeat_style  = '';
            if( $style == '3' ) $repeat_style = ' isotop-style2X';
            $unique = rand(2012, 35120);


        ?>
			<div class="product-filter-container" data-unique="<?php echo esc_attr($unique);?>">
				<?php if (!empty($select_type)) {
                    if ($nav_style=='nav_style'){
                        ?>
                        <div class="umrat-filter-h1">
                            <div class="filter-box button-group filter-box-<?php echo esc_attr($unique);?> button-group-<?php echo esc_attr($unique);?> font-size-0 product-filter portfolio-filterX">
                                <button class="btn-flt button is-checked" data-filter="*"><?php echo $settings['filter_title']; ?></button>
                                    <?php
                                        if (in_array('popular', $select_type)) { ?>
                                            <button class="btn-srt button" data-sort-by="number"><?php esc_html_e( 'Popular', 'rtelements' ); ?></button><?php
                                        }
                                        if (in_array('best_rated', $select_type)) {
                                            ?><button class="btn-srt button" data-sort-by="weight"><?php esc_html_e( 'Best Rated', 'rtelements' ); ?></button><?php
                                        }
                                        if (in_array('on_sale', $select_type)) {
                                            ?><button class="btn-flt button" data-filter=".sale"><?php esc_html_e( 'On Sale', 'rtelements' ); ?></button><?php
                                        }
                                        if (in_array('featured', $select_type)) {
                                            ?><button class="btn-flt button" data-filter=".featured"><?php esc_html_e( 'Featured', 'rtelements' ); ?></button><?php
                                        }
                                    ?>
                            </div>
                        </div>                        
                        <?php
                    }
                    if ($nav_style=='dropdown_style'){
                    ?>
                        <div class="filters filters-<?php echo esc_attr($unique);?> rt-isotop-dropdown">
                           <?php if(!empty($settings['filter_title_dropbox'])): ?>
                             <span class="level--filter"><?php echo $settings['filter_title_dropbox'];?></span>
                            <?php endif; ?>
                            <select class="filter-select rt-nice-select" value-group="size">
                                <option value=""><?php echo $settings['filter_title']; ?></option>

                                <?php
                                if (in_array('popular', $select_type)) { ?>
                                    <option value=".number" data-sort-by="number"><?php esc_html_e( 'Popular', 'rtelements' ); ?></option><?php
                                }
                                if (in_array('best_rated', $select_type)) {
                                    ?><option value=".weight" data-sort-by="weight"><?php esc_html_e( 'Best Rated', 'rtelements' ); ?></option><?php
                                }
                                if (in_array('on_sale', $select_type)) {
                                    ?><option value=".sale" data-filter=".sale"><?php esc_html_e( 'On Sale', 'rtelements' ); ?></option><?php
                                }
                                if (in_array('featured', $select_type)) {
                                    ?><option value=".featured" data-filter=".featured"><?php esc_html_e( 'Featured', 'rtelements' ); ?></option><?php
                                }
                            ?>
                            </select>
                        </div>
            <?php
                    }
            }
             ?>
				<div class="rt-product-style3<?php echo esc_attr($isotopStyle); ?><?php echo esc_attr($repeat_style); ?>">
					<div class="weiboo-grid weiboo-grid-<?php echo esc_attr($unique);?>">
						<div class="row">
							<?php
                                        global $weiboo_option;
                                        $x = 1;
                                        while ($Q_final->have_posts()): $Q_final->the_post();

                                            $post_id      = get_the_ID();
                                            $filter_class = '';

                                            // $p_rating = woocommerce_template_loop_rating();
                                            if (!empty($pType)) {
                                                if (in_array($post_id, $popular_ids)) {
                                                    $filter_class .= ' popular number';
                                                }
                                                if (in_array($post_id, $rating_ids)) {
                                                    $filter_class .= ' best_rated weight';
                                                }
                                                if (in_array($post_id, $fearured_ids)) {
                                                    $filter_class .= ' featured';
                                                }
                                                if (in_array($post_id, $sale_ids)) {
                                                    $filter_class .= ' sale';
                                                }
                                            }

                                            $product     = wc_get_product($post_id);
                                            $rating      = $product->get_average_rating();
                                            $rating_html = wc_get_rating_html($product->get_average_rating());
                                            $is_feat     = $product->is_featured();
                                            $rcount      = $product->get_rating_count();
                                            // echo wc_get_rating_html( $rating, $count );

                                            $content = get_the_content();
                                            $client  = get_post_meta(get_the_ID(), 'client', true);

                                            $p2ndImg = get_post_meta(get_the_ID(), 'rt_product_2nd_img_id', true);
                                            $arating = get_post_meta(get_the_ID(), '_wc_average_rating', true);
                                            $tsale   = get_post_meta(get_the_ID(), 'total_sales', true);
                                            $price   = get_post_meta(get_the_ID(), '_price', true);

                                            $gallery = $product->get_gallery_image_ids();
                                            if($gallery){
                                                array_unshift($gallery, get_post_thumbnail_id());
                                                if($p2ndImg){
                                                    $gallery[] = $p2ndImg;
                                                }
                                            }

                                            // The product average rating (or how many stars this product has)
                                            $average_rating = $product->get_average_rating();

                                            // The product stars average rating html formatted.
                                            $average_rating_html = wc_get_rating_html($average_rating);

                                            // Display stars average rating html
                                            $terms = get_the_terms($product->get_id(), 'product_cat');
                                            // $unique = rand(2012, 35120);
                                            if ($style) {
                                                require plugin_dir_path(__FILE__) . "style" . $style . ".php";
                                            } else {
                                                require plugin_dir_path(__FILE__) . "/style1.php";
                                            }

                                            $x++;
                                        endwhile;
                                        wp_reset_query();

                                    ?>
						</div>
					</div>
				</div>
			</div>
	<?php
        }
    }
?>
