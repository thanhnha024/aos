<?php
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;

defined( 'ABSPATH' ) || die();

class ReacTheme_Tutor_Course_Grid_Widget extends \Elementor\Widget_Base {

	/**
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'react-course-grid-tutor';
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
		return __( 'RT Tutor Course Grid', 'rtelements' );
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
		return 'glyph-icon flaticon-network';
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
			'course_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',			
                    '3' => 'Style 3',
                    '4' => 'Style 4',           
                    '5' => 'Style 5',           
                    '6' => 'Style 6',           
                    '7' => 'Style 7',           
				],											
			]
		);		

		$this->add_control(
			'cat',
			[
				'label'   => esc_html__( 'Category', 'rtelements' ),
				'type'    => Controls_Manager::SELECT2,			
				'options'   => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',					
			]

		);		

		
		$this->add_responsive_control(
			'course_col',
			[
				'label'   => esc_html__( 'Columns', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 4,			
				'options' => [
					'6' => esc_html__( '2 Column', 'rtelements' ),
					'4' => esc_html__( '3 Column', 'rtelements' ),
					'3' => esc_html__( '4 Column', 'rtelements' ),
					'2' => esc_html__( '6 Column', 'rtelements' ),
					'12' => esc_html__( '1 Column', 'rtelements' ),					
				],
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
			'show_dec',
			[
				'label' => __( 'Show Description', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rtelements' ),
				'label_off' => __( 'Hide', 'rtelements' ),				
				'default' => 'no',
			]
		);

         $this->add_control(
            'show_cates',
            [
                'label' => esc_html__( 'Show Category', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ], 
                'condition' => [
                    'course_grid_style' => '1',
                ],              
            ]
        ); 

        $this->add_control(
            'show_btms',
            [
                'label' => esc_html__( 'Show Ratings & Button', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],
                'condition' => [
                    'course_grid_style' => '1',
                ],               
            ]
        ); 
        $this->add_control(
            'itesms_padding',
            [
                'label' => esc_html__( 'Padding (Item)', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .react_course_style1 .courses-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_grid_style' => '1',
                ],
            ]
        ); 

        $this->add_control(
            'course_per',
            [
                'label' => esc_html__( 'Course Per Page', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'example 3', 'rtelements' ),
                'separator' => 'before',                
            ]
        );
    

        $this->add_control(
            'pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show/Hide', 'rtelements' ),
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
			'offset',
			[
				'label' => esc_html__( 'Course offset', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'You can write how many course offset. ex(2)', 'rtelements' ),
				'separator' => 'before',				
			]
		); 		

        $this->end_controls_section(); 


        $this->start_controls_section(
            'filter_section',
            [
                'label' => esc_html__( 'Filter Settings', 'rtelements' ),                
            ]
        );

        $this->add_control(
            'show_filter',
            [
                'label' => esc_html__( 'Show Filter', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],               
            ]
        );  
 

        $this->add_control(
            'filter_title',
            [
                'label' => esc_html__( 'Filter Default Title', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All',
                'condition' => [
                    'show_filter' => 'yes',
                ],                  
            ]
        );

        $this->add_responsive_control(
            'align_filter',
            [
                'label' => esc_html__( 'Alignment (Filter Menu)', 'rtelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rtelements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rtelements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rtelements' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rtelements' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .courses-filter' => 'text-align: {{VALUE}}'
                ],
                'condition' => [
                    'show_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_cat_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-filter button' => 'background: {{VALUE}};',                    
                ],
                'condition' => [
                    'show_filter' => 'yes',
                ],              
            ]            
        ); 

        $this->add_control(
            'filter_category_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-filter button' => 'color: {{VALUE}};',                    
                ], 
                'condition' => [
                    'show_filter' => 'yes',
                ],               
            ]            
        );

        $this->add_control(
            'filter_cat_bg_hover_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-filter button:hover, {{WRAPPER}} .courses-filter button.active' => 'background: {{VALUE}};',                    
                ], 
                'condition' => [
                    'show_filter' => 'yes',
                ],             
            ]            
        );  

        $this->add_control(
            'filter_category_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-filter button:hover, {{WRAPPER}} .courses-filter button.active' => 'color: {{VALUE}};',                    
                ],
                'condition' => [
                    'show_filter' => 'yes',
                ],                
            ]            
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rtelements' ),
                'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .courses-filter button',     
                'condition' => [
                    'show_filter' => 'yes',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .courses-filter button',
                'condition' => [
                    'show_filter' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_category_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .courses-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_filter' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_margin',
            [
                'label' => esc_html__( 'Item Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .courses-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_filter' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'rtelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .courses-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_filter' => 'yes',
                ],
            ]
        );        

        $this->end_controls_section();


        $this->start_controls_section(
            'rate_settings',
            [
                'label' => esc_html__( 'Ratings Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'course_grid_style' => '5'
                ],
            ]
        );

        $this->add_control(
            'ratings_show_hide',
            [
                'label' => esc_html__( 'Ratings Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],  
                'condition' => [
                    'course_grid_style' => '5'
                ],              
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'btn_settings',
            [
                'label' => esc_html__( 'Button Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'course_grid_style' => '5'
                ],
            ]
        );

        $this->add_control(
            'btn_show_hide',
            [
                'label' => esc_html__( 'Button Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],  
                'condition' => [
                    'course_grid_style' => '5'
                ],              
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Style Section Area      
        $this->start_controls_section(
			'section_course_style',
			[
				'label' => esc_html__( 'Course Style', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rtelements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rtelements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rtelements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rtelements' ),
                        'icon' => 'fa fa-align-right',
                    ],
                   
                ],
                'toggle' => false,
                'default' => 'left',
                'prefix_class' => 'rs-testimonial--',
                'selectors' => [
                    '{{WRAPPER}} .courses-item' => 'text-align: {{VALUE}}'
                ]
               
            ]
        );


        $this->start_controls_tabs( '_tabs_style_button' );

        $this->start_controls_tab(
            '_tab_left_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rtelements' ),
            ]
        );

        $this->add_control(
            'course_bg_color',
            [
                'label' => esc_html__( 'Course Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style2 .course-wrap' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_border_color',
            [
                'label' => esc_html__( 'Course Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,               
                'selectors' => [
                    '{{WRAPPER}} .courses-item' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style6 .courses-item .content-part .meta-part' => 'border-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part span.price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style5 .courses-item .content-part .course-price span.price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style6 .courses-item .img-part .course-price span.price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style2 .course-wrap .price-btn span.price' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'price_bg_color',
            [
                'label' => esc_html__( 'Price Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .meta-part li span.price' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style5 .courses-item .content-part .course-price span.price' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style6 .courses-item .img-part .course-price span.price' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style2 .course-wrap .price-btn a' => 'background: {{VALUE}};',
                ],                
            ]
        );

        

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__( 'Category Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .meta-part li.cat a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .courses-item .content-part .meta-part li:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .front-part .content-part .cat a' => 'color: {{VALUE}};',
                ],                
            ]
        );

        

        $this->add_control(
            'd_meta_icons_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .far' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .courses-item .content-part .fas' => 'color: {{VALUE}};',
                ],                
            ]
        );



        $this->add_control(
            'less_color',
            [
                'label' => esc_html__( 'Lessons', 'rtelements' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .meta-part li.lesson' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .courses-item .content-part .meta-part li.lesson:before' => 'background: {{VALUE}};',
                ],                               
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .front-part .content-part .title a' => 'color: {{VALUE}};',
                ],                
            ]
        );


        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__( 'Meta Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'course_grid_style' => ['1', '5', '6', '7'],
                ],
                'selectors' => [
                    
                    '{{WRAPPER}} .react_course_style5 .courses-item .content-part .meta-part li i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .info-meta li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style6 .courses-item .content-part .meta-part li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style7 .courses-item .content-part .meta-part li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style7 .courses-item .avatar-image' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label' => esc_html__( 'Ratings Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .course-ratings .review-stars-rated .review-stars.empty, 
                    .course-ratings .review-stars-rated .review-stars.filled' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'rating_color_count',
            [
                'label' => esc_html__( 'Ratings Count Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .course-ratings .course-rating-total' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Button Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .btn-part a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style2 .course-wrap .price-btn a i:before' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'btn_border_color',
            [
                'label' => esc_html__( 'Button Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'course_grid_style' => ['1'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .btn-part a' => 'border-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__( 'Button Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .btn-part a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style2 .course-wrap .price-btn a i:before' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_grid_style' => ['5', '6', '7'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_content_border',
                'selector' => '{{WRAPPER}} .react_course_style7 .courses-item .content-part',
                'condition' => [
                    'course_grid_style' => ['7'],
                ],
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '.react_course_style7 .courses-item .content-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_grid_style' => ['7'],
                ],
            ]
        );  

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_left_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rtelements' ),
            ]
        );

        $this->add_control(
            'hover_course_bg_color',
            [
                'label' => esc_html__( 'Course Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap:hover' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_course_border_color',
            [
                'label' => esc_html__( 'Course Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,              
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover' => 'border-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_price_color',
            [
                'label' => esc_html__( 'Price Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover .content-part .meta-part li span.price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style5 .courses-item:hover .content-part .course-price span.price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .price-btn .price:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_price_bg_color',
            [
                'label' => esc_html__( 'Price Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover .content-part .meta-part li span.price' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style5 .courses-item:hover .content-part .course-price span.price' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .react_course_style2 .course-wrap .price-btn a' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_cat_color',
            [
                'label' => esc_html__( 'Category Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover .content-part .meta-part li.cat a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .inner-part .content-part .cat a:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'less_color_hover',
            [
                'label' => esc_html__( 'Lessons & User Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover .content-part .meta-part' => 'color: {{VALUE}};',
                ], 
                'condition' => [
                    'course_grid_style' => ['5', '6'],
                ],              
            ]
        );

        $this->add_control(
            'hover_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .title a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .inner-part .content-part .title a:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );


        $this->add_control(
            'hover_meta_color',
            [
                'label' => esc_html__( 'Meta Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .info-meta li:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .inner-part .content-part .course-meta li:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_btn_color',
            [
                'label' => esc_html__( 'Button Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .btn-part a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .course-wrap .price-btn a:hover i:before' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_btn_border_color',
            [
                'label' => esc_html__( 'Button Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'course_grid_style' => ['1'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .courses-item:hover .content-part .bottom-part .btn-part a' => 'border-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'hover_btn_bg_color',
            [
                'label' => esc_html__( 'Button Background Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .courses-item .content-part .bottom-part .btn-part a:hover' => 'background: {{VALUE}};',
                ],                
            ]
        );
 

        $this->end_controls_tab();
        $this->end_controls_tabs();
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

		$settings = $this->get_settings_for_display(); 

	        $cat = $settings['cat'];
            global $post, $authordata;
            
            if(($settings['pagination_show_hide'] == 'yes')){
                global  $paged;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    	       	 if(empty($cat)){   
    	        	$best_wp = new wp_Query(array(
    						'post_type'           => 'courses',
    						'posts_per_page'      => $settings['course_per'],
    						'ignore_sticky_posts' => 1,
    						'offset'              => $settings['offset'],
                            'paged'               => $paged
    				));	  
    	        }   
    	        else{
    	        	$best_wp = new wp_Query(array(
    					'post_type'           => 'courses',
    					'posts_per_page'      => $settings['course_per'],
    					'ignore_sticky_posts' => 1,
    					'offset'              => $settings['offset'],
                        'paged'          => $paged,
    					'tax_query' => array(
    				        array(
    							'taxonomy' => 'course-category',
    							'field'    => 'slug', //can be set to ID
    							'terms'    =>  $cat//if field is ID you can reference by cat/term number
    				        ),
    				    )
    				));	  
    	        }
            }else{
                 if(empty($cat)){   
                    $best_wp = new wp_Query(array(
                        'post_type'           => 'courses',
                        'posts_per_page'      => $settings['course_per'],
                        'ignore_sticky_posts' => 1,
                        'offset'              => $settings['offset'],                           
                    ));   
                }   
                else{
                    $best_wp = new wp_Query(array(
                        'post_type'           => 'courses',
                        'posts_per_page'      => $settings['course_per'],
                        'ignore_sticky_posts' => 1,
                        'offset'              => $settings['offset'],                       
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'course-category',
                                'field'    => 'slug', //can be set to ID
                                'terms'    =>  $cat//if field is ID you can reference by cat/term number
                            ),
                        )
                    ));   
                }
            }
	    ?>

        <?php if ( 'yes' === $settings['show_filter'] ){ ?>
            <div class="courses-filter">
                <button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']);?></button>
                <?php 
                    $taxonomy ="";
                    $taxonomy = "course-category";                
                    foreach ($cat as $cat) {                
                    $term = get_term_by('slug', $cat, $taxonomy);
                    $term_name  =  $term->name;
                    $term_slug  =  $term->slug;
                ?>
                    <button data-filter=".filter_<?php echo esc_html($term_slug);?>"><?php echo esc_html($term_name);?></button>
                <?php  } ?>
            </div> 
        <?php } ?> 
		
		<div class="react-courses react_course_style<?php echo esc_attr($settings['course_grid_style']); ?>">	
			<div class="row grids">
				<?php 	
						//Style One		

					if('1' == $settings['course_grid_style']){                     

						while($best_wp->have_posts()): $best_wp->the_post();
                            $taxonomy        = "course-category";			
                            $cats_show       = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                            $excerpt         = get_the_excerpt();
                            $the_link        = get_permalink();
                            $course_id       = get_the_ID();
                            $course_duration = get_tutor_course_duration_context();
                            $course_students = tutor_utils()->count_enrolled_users_by_course();     
                            $tutor_lesson_count    = tutor_utils()->get_lesson_count_by_course( );
                            $tutor_course_duration = get_tutor_course_duration_context();                       
                            $course_students = !empty($course_students) ? $course_students : 0;

                            $terms = get_the_terms($best_wp->ID, "course-category");
                            $termsString = "";
                            $termsSlug   = "";

                            foreach ( $terms as $term ) { 
                                $termsString .= 'filter_'.$term->slug.' '; 
                                $termsSlug .= $term->name;
                            }
                        ?>

						<div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-6 col-sm-12 <?php echo $termsString;?>">
							<div class="courses-item">
                                <div class="img-part">
                                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail($settings['thumbnail_size']);?></a>
                                </div>
                                <div class="content-part">
                                    <ul class="meta-part">                                        
                                        <?php if ( 'yes' === $settings['show_cates'] ){ ?> 
                                            <li class="cat"><?php echo $cats_show; ?></li>
                                        <?php } ?>

                                            <li class="cat lesson"><?php echo $tutor_lesson_count; ?> Lessons</li>
                                      
                                    </ul>
                                    <h3 class="title">
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                    </h3>

                                    <?php if ($settings['show_dec'] == 'yes') : ?>
										<div class="text"><?php echo educavo_custom_excerpt(30);?></div>
									<?php endif ;?>	

                                    <?php if ( 'yes' === $settings['show_btms'] ){ ?> 
                                        <div class="bottom-part">
                                            <div class="info-meta">
                                                <ul>
                                                    <li class="user">
                                                        <div class="tutor-single-loop-meta">
                                                            <i class="tutor-icon-clock"></i> <span><?php echo $tutor_course_duration;?> </span>
                                                        </div>
                                                    </li>
                                                    

                                                </ul>
                                            </div>
                                            <div class="course-price">
                                                <div class="tutor-course-loop-price">
                                                    <?php
                                                        $course_id = get_the_ID();
                                                        $price_html = '<span class="price">'.__('Free', 'rtelements').'</span>';
                                                        if (tutor_utils()->is_course_purchasable()) {
                                                                $product_id = tutor_utils()->get_course_product_id($course_id);
                                                                $product    = wc_get_product( $product_id );
                                                            if ( $product ) {
                                                                $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                                            }
                                                        }
                                                         echo $price_html;
                                                    ?>
                                                 </div>
                                             </div><!-- price item -->
                                        </div>
                                    <?php } ?>
                                </div>
                        	</div>


						</div>
					<?php 	endwhile; 
							wp_reset_query();
					}

					//Style Two
					if('2' == $settings['course_grid_style']){
						while($best_wp->have_posts()): $best_wp->the_post();
                        $taxonomy            = "course-category";			
                        $cats_show           = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span>');
                        $excerpt             = get_the_excerpt();
                        $course_id           = get_the_ID();
                        

						
                        $course_color        = get_post_meta(get_the_ID(), 'course_color', true);	
                        $course_border_color = ($course_color) ? 'style = "border-color: '.$course_color.'"': '';
                        $course_title_color  = ($course_color) ? 'style = "color: '.$course_color.'"': ''; 

                        $icon         = get_post_meta( get_the_ID(), 'course_image', true );
                        $icon_course  = (!empty($icon)) ? '<img src="'.$icon.'" alt="">' : '';
                        $key_1_values = get_post_meta( get_the_ID(), 'course_image' ); 

                        $course_duration = get_tutor_course_duration_context();
                        $course_students = tutor_utils()->count_enrolled_users_by_course();
                            
                        $course_students = !empty($course_students) ? $course_students : 0;?>



                        <div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-6 col-sm-12">
                            <div class="course-wrap">
                                <div class="front-part">
                                    <div class="img-part">
                                        <?php echo $icon_course; ?>
                                    </div>
                                    <div class="content-part">
                                        <span class="cat"><?php echo $cats_show; ?></span>
                                        <h3 class="title"><a href="<?php the_permalink();?>" <?php echo $course_title_color;?>><?php the_title();?></a></h3>
                                    </div>
                                </div>
                                <div class="inner-part">
                                    <div class="content-part">
                                        <span class="cat"><?php echo $cats_show; ?></span>
                                        <h3 class="title"><a href="<?php the_permalink();?>" <?php echo $course_title_color;?>><?php the_title();?></a></h3>

                                        <ul class="course-meta">
                                            <li class="course-user"><i class="rt-user"></i><?php echo $course_students; ?></li>
                                            <li class="course-ratings">
                                               <?php $course_rating = tutor_utils()->get_course_rating();?>
                                                   <div class="course-rating-total"> 
                                                    <?php tutor_utils()->star_rating_generator($course_rating->rating_avg);?></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="price-btn">
                                    <a href="<?php the_permalink();?>"><div class="course-price">
                                            <div class="tutor-course-loop-price">
                                                <?php
                                                $course_id = get_the_ID();
                                                $price_html = '<span class="price">'.__('Free', 'rtelements').'</span>';
                                                if (tutor_utils()->is_course_purchasable()) {
                                                    $product_id = tutor_utils()->get_course_product_id($course_id);
                                                    $product    = wc_get_product( $product_id );
                                                    if ( $product ) {
                                                        $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                                    }
                                                }
                                                    echo $price_html;
                                                ?>
                                            </div>
                                        </div><!-- price item -->  <i class="flaticon-next"></i></a>
                                </div>
                            </div>
                        </div>
						<?php 	endwhile; 
								wp_reset_query();
						}

                        //Style Three
                    if('3' == $settings['course_grid_style']){

                            while($best_wp->have_posts()): $best_wp->the_post();
                            $taxonomy        = "course_category";            
                            $cats_show       = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                            $excerpt         = get_the_excerpt();
                            $the_link        = get_permalink();
                            $course_id       = get_the_ID();                                             
                                                
                            $course_students = tutor_utils()->count_enrolled_users_by_course();     
                            $tutor_lesson_count    = tutor_utils()->get_lesson_count_by_course( );
                            $tutor_course_duration = get_tutor_course_duration_context();                       
                            $course_students = !empty($course_students) ? $course_students : 0;                            

                            $terms = get_the_terms($best_wp->ID, "course-category");
                            $termsString = "";
                            $termsSlug   = "";

                            foreach ( $terms as $term ) { 
                                $termsString .= 'filter_'.$term->slug.' '; 
                                $termsSlug .= $term->name;
                            }
                            ?>

                            <div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-6 col-sm-12 <?php echo $termsString;?>">
                                <div class="courses-item">
                                    <div class="img-part">
                                        <?php
                                              
                                        echo $cats_show  = get_the_term_list( $best_wp->ID, 'course-category', ' ', '<span class="separator">,</span> '); ?>
                                         <?php the_post_thumbnail($settings['thumbnail_size']);?>
                                    </div>
                                    <div class="content-part">
                                       <div class="course-price">
                                            <div class="tutor-course-loop-price">
                                                <?php
                                                $course_id = get_the_ID();
                                                $price_html = '<span class="price">'.__('Free', 'rtelements').'</span>';
                                                if (tutor_utils()->is_course_purchasable()) {
                                                    $product_id = tutor_utils()->get_course_product_id($course_id);
                                                    $product    = wc_get_product( $product_id );
                                                    if ( $product ) {
                                                        $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                                    }
                                                }
                                                    
                                                ?>
                                            </div>
                                        </div><!-- price item --> 
                                         <ul class="meta-part">                                        
                                            <li class="course-ratings">
                                                <?php $course_rating = tutor_utils()->get_course_rating();?>
                                                <div class="course-rating-total"> 
                                                    <?php tutor_utils()->star_rating_generator($course_rating->rating_avg);?>                                                     
                                                </div>
                                            </li>

                                            <li class="cat lesson"> <i class="tutor-icon-clock"></i> <span><?php echo $tutor_course_duration;?> </span></li>
                                      
                                    </ul>
                                        <h3 class="title">
                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                        </h3>

                                        <?php if ($settings['show_dec'] == 'yes') : ?>
                                                <div class="text"><?php echo educavo_custom_excerpt(30);?></div>
                                            <?php endif ;?> 

                                        <div class="bottom-part">
                                            <div class="info-meta">
                                                <ul>
                                                     
                                                        <li class="user">
                                                           <div class="tutor-single-loop-meta">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><?php echo $tutor_lesson_count; ?> Lessons</span> 
                                                            </div>
                                                        </li> 
                                                   
                                                    
                                                </ul>
                                            </div>
                                            <div class="btn-part">
                                               <?php echo $price_html;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php   endwhile; 
                            wp_reset_query();
                        } ?>

                <?php   
                    if('4' == $settings['course_grid_style']){                           

                        while($best_wp->have_posts()): $best_wp->the_post();
                        $taxonomy  = "course-category";            
                        $cats_show = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                        $excerpt   = get_the_excerpt();
                        $the_link  = get_permalink();
                        $course_id = get_the_ID();
                        $course_duration = get_tutor_course_duration_context();
                        $course_students = tutor_utils()->count_enrolled_users_by_course();
                        $course_students = !empty($course_students) ? $course_students : 0;
                         $tutor_lesson_count    = tutor_utils()->get_lesson_count_by_course( );
                        ?>
                        <div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-12 col-sm-12">
                            <div class="courses-item">
                                <div class="img-part">
                                    <a href="<?php the_permalink();?>"> <?php the_post_thumbnail($settings['thumbnail_size']);?></a>
                                </div>
                                <div class="content-part">
                                    <ul class="meta-part">
                                        <li>
                                            <div class="course-price">
                                                <div class="tutor-course-loop-price">
                                                    <?php
                                                        $course_id = get_the_ID();
                                                        $price_html = '<span class="price">'.__('Free', 'rtelements').'</span>';
                                                        if (tutor_utils()->is_course_purchasable()) {
                                                            $product_id = tutor_utils()->get_course_product_id($course_id);
                                                            $product    = wc_get_product( $product_id );
                                                            if ( $product ) {
                                                                $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                                            }
                                                        }
                                                        echo $price_html;
                                                    ?>
                                                 </div>
                                            </div><!-- price item --> 
                                        </li>                            
                                            
                                    
                                    </ul>
                                    <h3 class="title">
                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                    </h3>

                                    <?php if ($settings['show_dec'] == 'yes') : ?>
                                        <div class="text"><?php echo educavo_custom_excerpt(30);?></div>
                                    <?php endif ;?> 

                                    <div class="bottom-part">
                                        <div class="info-meta">
                                            <ul>                                             
                                                <li class="price">
                                                    <?php if(!empty($course_duration)) { ?>
                                                        
                                                        <i class='fas tutor-icon-clock'></i> <span><?php echo $course_duration; ?></span>
                                                       
                                                    <?php } ?>
                                            </li>
                                             <li class="cat lesson"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><?php echo $tutor_lesson_count; ?> Lessons</li>
                                            </ul>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>


                        </div>
                    <?php   endwhile; 
                        wp_reset_query();
                    }

                    if('6' == $settings['course_grid_style']){                           

                    while($best_wp->have_posts()): $best_wp->the_post();
                    $taxonomy            = "course-category";            
                    $cats_show           = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                    $excerpt             = get_the_excerpt();
                    $the_link            = get_permalink();
                    $course_id           = get_the_ID();
                                         

                   ?>

                    <div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-6 col-sm-12">
                       <div class="courses-item">
                           <div class="img-part">
                               <a href="<?php the_permalink();?>"> <?php the_post_thumbnail($settings['thumbnail_size']);?></a>                             
                               <div class="course-price">
                                    <div class="tutor-course-loop-price">
                                        <?php
                                        $course_id = get_the_ID();
                                        $price_html = '<span class="price">'.__('Free', 'tutor').'</span>';
                                        if (tutor_utils()->is_course_purchasable()) {
                                            $product_id = tutor_utils()->get_course_product_id($course_id);
                                            $product    = wc_get_product( $product_id );
                                            if ( $product ) {
                                                $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                            }
                                        }
                                            echo $price_html;
                                        ?>
                                    </div>
                                </div><!-- price item --> 
                           </div>
                           <div class="content-part">
                                <div class="course-ratings">
                                   <?php $course_rating = tutor_utils()->get_course_rating();?>
                                   <div class="course-rating-total"> 
                                    <?php tutor_utils()->star_rating_generator($course_rating->rating_avg);?></div>
                                </div>                                                              
                                <h3 class="title">
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                </h3>

                               <?php if ($settings['show_dec'] == 'yes') : ?>
                                    <div class="text"><?php echo educavo_custom_excerpt(30);?></div>
                                <?php endif ;?>  

                                <div class="tutor-course-loop-meta">
                                <?php
                                    $course_duration = get_tutor_course_duration_context();
                                    $course_students = tutor_utils()->count_enrolled_users_by_course();

                                    $course_students = !empty($course_students) ? $course_students : 0;
                                   
                                ?>                           
                                 
                             
                                </div>                                                    
                                
                                <ul class="meta-part">
                                    <li class="price">
                                        <?php if(!empty($course_duration)) { ?>
                                            
                                            <i class='fas tutor-icon-clock'></i> <span><?php echo $course_duration; ?></span>
                                           
                                    <?php } ?>
                                    </li>
                                
                                    <li class="user">
                                       <div class="tutor-single-loop-meta">
                                            <i class='fas tutor-icon-user'></i><span><?php echo $course_students; ?></span>
                                        </div>
                                    </li> 
                                                                 
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php   endwhile; 
                        wp_reset_query();
                    }


                    // Style 7
                if('7' == $settings['course_grid_style']){  

                    while($best_wp->have_posts()): $best_wp->the_post();
                        $taxonomy        = "course_category";            
                        $cats_show       = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                        $excerpt         = get_the_excerpt();
                        $the_link        = get_permalink();
                        $course_id       = get_the_ID();
                        $course_duration = get_tutor_course_duration_context();
                        $course_students = tutor_utils()->count_enrolled_users_by_course();
                        
                        $course_students = !empty($course_students) ? $course_students : 0;
                        $profile_url     = tutor_utils()->profile_url($authordata->ID);
                    ?>

                        <div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-6 col-sm-12">
                           <div class="courses-item">
                               <div class="img-part">
                                   <a href="<?php the_permalink();?>"> <?php the_post_thumbnail($settings['thumbnail_size']);?></a>
                                  <div class="course-price">
                                    <div class="tutor-course-loop-price">
                                        <?php
                                        $course_id = get_the_ID();
                                        $price_html = '<span class="price">'.__('Free', 'tutor').'</span>';
                                        if (tutor_utils()->is_course_purchasable()) {
                                            $product_id = tutor_utils()->get_course_product_id($course_id);
                                            $product    = wc_get_product( $product_id );
                                            if ( $product ) {
                                                $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                            }
                                        }
                                            echo $price_html;
                                        ?>
                                    </div>
                                </div><!-- price item --> 
                               </div>
                               <div class="content-part">
                                    <ul class="meta-part">
                                        <li class="price">
                                             <i class='fas tutor-icon-clock'></i> <span><?php echo $course_duration; ?></span>                                            
                                        </li>
                                        <li class="user">
                                            <i class="rt-user"></i><?php echo $course_students; ?> <?php echo esc_html__('Students', 'educavo');?>
                                        </li>                                    
                                    </ul>                                                             
                                    <h3 class="title">
                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                    </h3>
                                   <?php if ($settings['show_dec'] == 'yes') : ?>
                                        <div class="text"><?php echo educavo_custom_excerpt(30);?></div>
                                    <?php endif ;?> 
                                    <div class="avatar-image">
                                        <a href="<?php echo $profile_url; ?>"> <?php echo get_avatar( get_the_author_meta( $course_id ), 32 );   echo get_the_author(); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php   endwhile; 
                        wp_reset_query();
                    }

                    //Style Five
                    if('5' == $settings['course_grid_style']){

                        while($best_wp->have_posts()): $best_wp->the_post();
                            $taxonomy        = "course-category";            
                            $cats_show       = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                            $excerpt         = get_the_excerpt();
                            $the_link        = get_permalink();
                            $course_id       = get_the_ID();                      
                            $course_duration = get_tutor_course_duration_context();

                            $course_students = tutor_utils()->count_enrolled_users_by_course();
                            $course_students = !empty($course_students) ? $course_students : 0;
                         
                       ?>

                        <div class="cource-block col-lg-<?php echo $settings['course_col']; ?> col-md-6 col-sm-12">
                            <div class="courses-item">
                                <div class="img-part">
                                    <a href="<?php the_permalink();?>"> <?php the_post_thumbnail($settings['thumbnail_size']);?></a>
                                </div>
                                <div class="content-part">
                                    <div class="course-price">
                                        <div class="tutor-course-loop-price">
                                            <?php
                                            $course_id = get_the_ID();
                                            $price_html = '<span class="price">'.__('Free', 'tutor').'</span>';
                                            if (tutor_utils()->is_course_purchasable()) {
                                                $product_id = tutor_utils()->get_course_product_id($course_id);
                                                $product    = wc_get_product( $product_id );
                                                if ( $product ) {
                                                    $price_html = '<span class="price"> '.$product->get_price_html() . '</span> ';
                                                }
                                            }
                                                echo $price_html;
                                            ?>
                                        </div>
                                    </div><!-- price item -->
                                    
                                    <h3 class="title">
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                    </h3>

                                    <?php if ($settings['show_dec'] == 'yes') : ?>
                                            <div class="text"><?php echo educavo_custom_excerpt(30);?></div>
                                        <?php endif ;?> 

                                    <ul class="meta-part">
                                        <li class="user">
                                            <i class="rt-user"></i><?php echo $course_students; ?> <?php echo esc_html__('Students', 'educavo');?>
                                        </li>
                                        <li class="price">
                                            <?php if(!empty($course_duration)) { ?>                                            
                                                <i class='fas tutor-icon-clock'></i> <span><?php echo $course_duration; ?></span>
                                           
                                            <?php } ?>
                                        </li>
                                    </ul>    

                                    <div class="bottom-part">                                        
                                        <?php if(($settings['ratings_show_hide'] == 'yes') ){ ?>
                                            <div class="info-meta">
                                                <ul>                                                
                                                    <li class="course-ratings">
                                                       <?php $course_rating = tutor_utils()->get_course_rating();?>
                                                           <div class="course-rating-total"> 
                                                            <?php tutor_utils()->star_rating_generator($course_rating->rating_avg);?></div>
                                                    </li>
                                                </ul>
                                            </div> 
                                        <?php } ?>
                                        <?php if(($settings['btn_show_hide'] == 'yes') ){ ?>
                                            <div class="btn-part">
                                                <a href="<?php the_permalink();?>"><i class="flaticon-right-arrow"></i></a>                                
                                            </div>   
                                        <?php } ?>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php   endwhile; 
                        wp_reset_query();
                    }
                    $paginate = paginate_links( array(
                        'total' => $best_wp->max_num_pages
                    ));

                if(!empty($paginate ) && ($settings['pagination_show_hide'] == 'yes')){ ?>
                    <div class="rs-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
                <?php } ?>  			
		   </div>  
		</div>		
		<?php 	

	}
    public function getCategories(){
            if ( ! function_exists('tutor')) {
                return [];
            }           
       
            $terms = get_terms( array(
                'taxonomy'    => 'course-category',
                'hide_empty'  => true            
            )); 

            $cat_list = [];            
            
             foreach($terms as $post) {
              $cat_list[$post->slug]  = [$post->name];
             }     
            return $cat_list;
        }  
}?>