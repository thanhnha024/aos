<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class ReacTheme_Elementor_Blog_Slider_Widget extends \Elementor\Widget_Base {

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
        return 'rt-blog-slider';
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
        return __( 'RT Blog Slider', 'rtelements' );
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
        return 'glyph-icon flaticon-slider-3';
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
        return [ 'pielements_category' ];
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
                'label' => esc_html__( 'Content', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'portfolio_slider_style',
            [
                'label'   => esc_html__( 'Select Style', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',               
                'options' => [
                    '1' => 'Style 1',
                    '2' => 'Style 2',
                    '3' => 'Style 3',               
                ],                                          
            ]
        );


        $this->add_control(
            'portfolio_category',
            [
                'label'   => esc_html__( 'Category', 'rtelements' ),
                'type'    => Controls_Manager::SELECT2, 
                'default' => 0,         
                'options' => $this->getCategories(),
                'multiple' => true, 
                'separator' => 'before',        
            ]

        );

        

        $this->add_control(
            'per_page',
            [
                'label' => esc_html__( 'Blog Show Per Page', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'example 3', 'rtelements' ),
                'separator' => 'before',
            ]
        );      

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'details_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'rtelements' ),
                'type' => Controls_Manager::TEXT,               
                'separator' => 'before',
                 'condition' => [
                    'portfolio_slider_style' => '3',
                ],  
            ]
        ); 



         

        $this->end_controls_section();
       

        $this->start_controls_section(
            'meta_section',
            [
                'label' => esc_html__( 'Meta Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Author Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Category Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_meta_show_hide',
            [
                'label' => esc_html__( 'Date Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'blog_readmore_show_hide',
            [
                'label' => esc_html__( 'Read More Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
                'separator' => 'before',
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
            'slider_centers_pad3',
            [
                'label'   => esc_html__( 'Center Mode Padding', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',                
                'separator' => 'before',    
                'condition' => [
                    'slider_centerMode' => 'true',
                ]                       
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
            'slider_centers_pad',
            [
                'label'   => esc_html__( 'Center Mode Padding', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',                
                'separator' => 'before',    
                'condition' => [
                    'slider_centerMode' => 'true',
                ]                       
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
            'slider_centers_pad2',
            [
                'label'   => esc_html__( 'Center Mode Padding', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',                
                'separator' => 'before',    
                'condition' => [
                    'slider_centerMode' => 'true',
                ]                       
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
            'slider_centerMode_pad',
            [
                'label'   => esc_html__( 'Center Mode Padding', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',                
                'separator' => 'before',    
                'condition' => [
                    'slider_centerMode' => 'true',
                ]                       
            ]           
        );

        $this->add_responsive_control(
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

                'selectors' => [
                    '{{WRAPPER}} .rt_widget_sliders .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 
                
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Content', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        

         $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                  
                    '{{WRAPPER}} .portfolio-item .p-title a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );



        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item .p-title  a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .reactheme-blog-grid1.blog-item .blog-content .title a',                    
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cat_grad_bg',
                'label' => esc_html__( 'Category Background', 'elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rt-blog-slider.rt-blog-style2 .portfolio-item .portfolio-content .p-category',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
                
            ]
        );


        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title .p-category a, {{WRAPPER}} .p-category a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );

        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title .p-category a:hover, {{WRAPPER}} .p-category a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );  

        $this->add_control(
            'icon_color6',
            [
                'label' => esc_html__( 'Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-icon i' => 'color: {{VALUE}};',                   

                ], 
                'condition' => [
                    'portfolio_slider_style' => '6',
                ],               
            ]
        ); 

        $this->add_control(
            'icon_bg_color6',
            [
                'label' => esc_html__( 'Icon Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-icon i' => 'background: {{VALUE}};',                   

                ], 
                'condition' => [
                    'portfolio_slider_style' => '6',
                ],               
            ]
        ); 

        $this->add_control(
            'item_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-6 .portfolio-item:before' => 'background: {{VALUE}};',                   

                ], 
                'condition' => [
                    'portfolio_slider_style' => '6',
                ],               
            ]
        ); 

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_bg_color',
                'label' => esc_html__( 'Text Background Color', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
                    'portfolio_slider_style' => '5',
                ],
                'selector' => '{{WRAPPER}} .slider-style-5 .rt-portfolio4 .portfolio-item .portfolio-inner'
            ]
        );


        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .slider-style-5 .rt-portfolio4 .portfolio-item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rt-portfolio-style3 .portfolio-item .portfolio-img:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rt-portfolio-style2 .portfolio-item:before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'style_overly_bg',
                'label' => esc_html__( 'Overlay Background Color', 'rtelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rt-portfolio-slider.slider-style-6 .portfolio-item:after',
                'condition' => [
                    'portfolio_slider_style' => '6'
                ]
            ]
        );
      
        $this->add_control(
            'arrow_options',
            [
                'label' => esc_html__( 'Arrow Style', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'arrow_left_position',
            [
                'label'      => esc_html__( 'Left Position', 'rtelements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_centerMode' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-5 .rt_widget_sliders .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rt_widget_sliders .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );  

        $this->add_responsive_control(
            'arrow_right_position',
            [
                'label'      => esc_html__( 'Right Position', 'rtelements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_centerMode' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-portfolio-slider.slider-style-5 .rt_widget_sliders .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rt_widget_sliders .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );


        // $this->add_control(
        //     'navigation_arrow_background',
        //     [
        //         'label' => esc_html__( 'Background', 'rtelements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .rt_widget_sliders .slick-next,{{WRAPPER}} .rt_widget_sliders .slick-prev' => 'background: {{VALUE}};',
        //             '{{WRAPPER}} .rt_widget_sliders .slick-next,{{WRAPPER}} .rt_widget_sliders .slick-next' => 'background: {{VALUE}};',

        //         ],                
        //     ]
        // );

        $this->start_controls_tabs( 'tabs_toggle_arrow_bg' );

        $this->start_controls_tab(
            'tab_toggle_normal',
            [
                'label' => __( 'Normal', 'rtelements'),
            ]
        );


		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_sliderarrow_bg',
                'label' => esc_html__( 'Arrow Background', 'elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rt-blog-slider.rt-blog-style2 .rt_widget_sliders .slick-arrow',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );



        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_toggle_hover',
            [
                'label' => __( 'Hover', 'rtelements'),
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_sliderarrow_bg_hover',
                'label' => esc_html__( 'Arrow Background', 'elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rt-blog-slider.rt-blog-style2 .rt_widget_sliders .slick-arrow:hover',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();













        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt_widget_sliders .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rt_widget_sliders .slick-prev::before' => 'color: {{VALUE}};',

                ],                
            ]
        );

         $this->add_control(
            'bullet_options',
            [
                'label' => esc_html__( 'Bullet Style', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt_widget_sliders .slick-dots li button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );



        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt_widget_sliders .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rt_widget_sliders .slick-dots li.slick-active button' => 'background: {{VALUE}};',

                ],                
            ]
        );

          $this->add_control(
            'bullet_spacing_custom',
            [
                'label' => esc_html__( 'Top Gap', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 25,
                ],          

                'selectors' => [
                    '{{WRAPPER}} .rt_widget_sliders .slick-dots' => 'margin-bottom:-{{SIZE}}{{UNIT}};',                    
                ],
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

        $settings              = $this->get_settings_for_display();             
        $slidesToShow          = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;     
        $autoplaySpeed         = $settings['slider_autoplay_speed'];
        $interval              = $settings['slider_interval'];
        $slidesToScroll        = $settings['slides_ToScroll'];
        $slider_autoplay       = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover          = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots            = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav             = $settings['slider_nav'] == 'true' ? 'true' : 'false';      
        $infinite              = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode            = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $slider_centerMode_pad = !empty($settings['slider_centerMode_pad']) ? $settings['slider_centerMode_pad'] : '400px';
        $col_lg                = $settings['col_lg'];
        $col_md                = $settings['col_md'];
        $col_sm                = $settings['col_sm'];
        $col_xs                = $settings['col_xs'];
        $slider_centers_pad    = $settings['slider_centers_pad'];
        $slider_centers_pad2   = $settings['slider_centers_pad2'];
        $slider_centers_pad3   = $settings['slider_centers_pad3'];

        $unique = rand(2012,35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs', 'slider_centerMode_pad', 'slider_centers_pad', 'slider_centers_pad2', 'slider_centers_pad3');  

        ?>   

        <div class="rsaddon-unique-slider rs-addon-slider rt-blog-slider rt-blog rt-blog-style<?php echo esc_attr($settings['portfolio_slider_style']); ?> slider-style-<?php echo esc_attr($settings['portfolio_slider_style']); ?> ">
            <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rt_widget_sliders row">
             <?php  if('1' == $settings['portfolio_slider_style']){ 
                    include plugin_dir_path(__FILE__)."/style1.php";
                }

                if('2' == $settings['portfolio_slider_style']){
                    include plugin_dir_path(__FILE__)."/style2.php";
                }

                if('3' == $settings['portfolio_slider_style']){
                    include plugin_dir_path(__FILE__)."/style3.php";
                }
                            
                
            ?>
        </div>
        <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
    </div>
    <script type="text/javascript"> 
        jQuery(document).ready(function(){
            jQuery( '.rt_widget_sliders' ).each(function( index ) {        
            var slider_id       = jQuery(this).attr('id'); 
            var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
          
            if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            jQuery('#'+slider_id).not('.slick-initialized').slick({
            slidesToShow    : parseInt(slider_conf.col_lg),
            centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
            dots            : (slider_conf.sliderDots)  == "true" ? true : false,
            arrows          : (slider_conf.sliderNav) == "true" ? true : false,
            autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
            slidesToScroll  : parseInt(slider_conf.slidesToScroll),
            centerPadding   : slider_conf.slider_centerMode_pad,
            autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
            pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
            loop : false,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_md),
                    slidesToScroll: 1,              
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    centerPadding   : slider_conf.slider_centers_pad3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_sm),
                    slidesToScroll: 1,
                    centerPadding   : slider_conf.slider_centers_pad,
                }
            }, 
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: parseInt(slider_conf.col_xs),
                    slidesToScroll: 1,
                    centerPadding   : slider_conf.slider_centers_pad2,
                }
            }, 
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    slidesToScroll: 1,
                    centerPadding   : '0px',
                }
            }]
            });
        }
       
        });
    });
    </script>
    <?php 
    }
    public function getCategories(){
        $cat_list = [];
            if ( post_type_exists( 'post' ) ) { 
            $terms = get_terms( array(
                'taxonomy'    => 'category',
                'hide_empty'  => true            
            ) );
            
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }
}?>