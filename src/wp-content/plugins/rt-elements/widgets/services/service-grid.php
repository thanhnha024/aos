<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Reactheme_Elementor_Sservices_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rt-service-grid';
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
		return esc_html__( 'RT Services Grid', 'rtelements' );
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
		return 'glyph-icon flaticon-support';
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function register_controls() {
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Services Global', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		

		$this->add_control(
			'services_style',
			[
				'label'   => esc_html__( 'Select Services Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rtelements'),
					'style2' => esc_html__( 'Style 2', 'rtelements'),
					'style3' => esc_html__( 'Style 3', 'rtelements'),
					'style4' => esc_html__( 'Style 4', 'rtelements'),
					'style5' => esc_html__( 'Style 5', 'rtelements'),
					'style6' => esc_html__( 'Style 6', 'rtelements'),
					'style7' => esc_html__( 'Style 7', 'rtelements'),
					'style8' => esc_html__( 'Style 8', 'rtelements'),
					'style9' => esc_html__( 'Style 9', 'rtelements'),
					'style10' => esc_html__( 'Style 10', 'rtelements'),
					'style11' => esc_html__( 'Style 11', 'rtelements'),
				],
			]
		);

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rtelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rtelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rtelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rtelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rtelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .react-addon-services .services-part' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_control(
        	'title_prefix_number',
        	[
        		'label'       => esc_html__( 'Services Number', 'rtelements' ),
        		'type'        => Controls_Manager::TEXT,
        		'label_block' => true,
        		'default'     => '',				
        		'separator'   => 'before',
        		'condition' => ['services_style' => ['style5', 'style6', 'style7']],
        		
        	]
        );

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_prefix_shadow_typography',
		        'label' => esc_html__( 'Typography', 'rtelements' ),
		        'selector' => '{{WRAPPER}}  .react-addon-services .services-part .shadow-text',
		        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
		        'separator'   => 'before',
        		'condition' => ['services_style' => ['style5', 'style6', 'style7']],
		    ]
		);	

		$this->add_control(
		    'title_prefix_color',
		    [
		        'label' => esc_html__( 'Services Number Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .shadow-text' => 'color: {{VALUE}};',
		        ],
		         'separator'   => 'before',
        		'condition' => ['services_style' => ['style5', 'style6', 'style7']],
		    ]
		);

		
		$this->end_controls_section();

		$this->start_controls_section(
		    '_services_full_part_style',
		    [
		        'label' => esc_html__( 'Services Full Part', 'rtelements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		        'condition' => [
		            'services_style' => 'style2'
		        ],
		    ]
		);

		$this->add_control(
		    'services_full_part_overlay_color',
		    [
		        'label' => esc_html__( 'Overlay Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services.services-style2::before' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon / Image', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rtelements'),
					'image' => esc_html__( 'Image', 'rtelements'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rtelements' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'default'   => 'fa fa-smile-o',
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon',
				],				
			]
		);
		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rtelements' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'show_image_right',
			[
				'label' => esc_html__( 'Show Image To Right', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'condition' => [
		            'services_style' => 'style7',
		        ],

			]
		);
		
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'f_background_normal',
                'label' => esc_html__( 'Background', 'elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .single-work.flex-row-reverse:before',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
				'condition' => [
					'show_image_right' => 'yes',
				],

                
            ]
        );

		$this->end_controls_section();
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title & Description', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
	
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Services Title', 'rtelements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Services Title',
				'placeholder' => esc_html__( 'Services Title', 'rtelements' ),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'title_prefix',
			[
				'label'       => esc_html__( 'Services Title Prefix', 'rtelements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '',				
				'separator'   => 'before',
			]
		);
		

		$this->add_control(
			'title_link',
			[	'label_block' => true,
				'label' => esc_html__( 'Title Link', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '#', 'rtelements' ),	
				'condition' => ['services_style' => ['style6', 'style7', 'style1', 'style2', 'style3', 'style4']],		
			]
		);

		$this->add_control(
			'link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rtelements'),
					'yes' => esc_html__( 'Yes', 'rtelements'),					

				],
				'condition' => ['services_style' => ['style6', 'style7', 'style1', 'style2', 'style3', 'style4']],	
			]
		);

		$this->add_control(
		    'title_tag',
		    [
		        'label' => esc_html__( 'Title HTML Tag', 'rtelements' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'h1'  => [
		                'title' => esc_html__( 'H1', 'rtelements' ),
		                'icon' => 'eicon-editor-h1'
		            ],
		            'h2'  => [
		                'title' => esc_html__( 'H2', 'rtelements' ),
		                'icon' => 'eicon-editor-h2'
		            ],
		            'h3'  => [
		                'title' => esc_html__( 'H3', 'rtelements' ),
		                'icon' => 'eicon-editor-h3'
		            ],
		            'h4'  => [
		                'title' => esc_html__( 'H4', 'rtelements' ),
		                'icon' => 'eicon-editor-h4'
		            ],
		            'h5'  => [
		                'title' => esc_html__( 'H5', 'rtelements' ),
		                'icon' => 'eicon-editor-h5'
		            ],
		            'h6'  => [
		                'title' => esc_html__( 'H6', 'rtelements' ),
		                'icon' => 'eicon-editor-h6'
		            ]
		        ],
		        'default' => 'h2',
		        'toggle' => false,
		    ]
		);

		$this->add_responsive_control(
		    'title_prefix_show',
		    [
		        'label' => esc_html__( 'Title Prefix Enable/Disable', 'rtelements' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'block' => esc_html__( 'Enable', 'rtelements'),
		        	'none' => esc_html__( 'Disable', 'rtelements'),		

		        ],
		        'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .react-addon-services .services-part .services-text .services-title .title::before' => 'display: {{VALUE}}'
                ],
		    ]
		);
		
		
		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Services Text', 'rtelements' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,				
				'default' => esc_html__( 'Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator.', 'rtelements' ),
				'separator' => 'before',
			]			
		);

		$this->end_controls_section();		


		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_title_chevron',
			[
				'label' => esc_html__( 'Show Chevron after Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
		            'services_style' => 'style7',
		        ],


			]
		);


		$this->add_control(
			'services_btn_text',
			[
				'label' => esc_html__( 'Services Button Text', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( 'Services Button Text', 'rtelements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__( 'Services Button Link', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( '#', 'rtelements' ),			
			]
		);

		$this->add_control(
			'services_btn_link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rtelements'),
					'yes' => esc_html__( 'Yes', 'rtelements'),
					

				],
			]
		);

		$this->add_control(
			'services_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => Controls_Manager::ICON,
				'options' => rsaddon_pro_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',			
			]
		);

		$this->add_control(
		    'services_btn_icon_position',
		    [
		        'label' => esc_html__( 'Icon Position', 'rtelements' ),
		        'type' => Controls_Manager::CHOOSE,
		        'label_block' => false,
		        'options' => [
		            'before' => [
		                'title' => esc_html__( 'Before', 'rtelements' ),
		                'icon' => 'eicon-h-align-left',
		            ],
		            'after' => [
		                'title' => esc_html__( 'After', 'rtelements' ),
		                'icon' => 'eicon-h-align-right',
		            ],
		        ],
		        'default' => 'after',
		        'toggle' => false,
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		    ]
		); 

		$this->add_control(
		    'services_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		       
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-text .services-btn-part .services-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .react-addon-services .services-part .services-text .services-btn-part .services-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_media_style',
		    [
		        'label' => esc_html__( 'Icon / Image', 'rtelements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'icon_size',
		    [
		        'label' => esc_html__( 'Size', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .services-icon i:before' => 'font-size: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'icon_line_height',
		    [
		        'label' => esc_html__( 'Line Height', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'line-height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ],

		        'separator' => 'before',

		    ]
		);

		$this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Width', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon img' => 'width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .single-work img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'icon_type' => 'image'
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_height',
		    [
				'label'      => esc_html__( 'Height', 'rtelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'icon_type' => 'image'
		        ],
		        'separator' => 'before',
		    ]
		);				


		$this->add_control(
		    'offset_toggle',
		    [
		        'label' => esc_html__( 'Offset', 'rtelements' ),
		        'type' => Controls_Manager::POPOVER_TOGGLE,
		        'label_off' => esc_html__( 'None', 'your-plugin' ),
		        'label_on' => esc_html__( 'Custom', 'your-plugin' ),
		        'return_value' => 'yes',
		    ]
		);

		$this->start_popover();

		$this->add_responsive_control(
		    'media_offset_x',
		    [
		        'label' => esc_html__( 'Offset Left', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'render_type' => 'ui',

		    ]
		);

		$this->add_responsive_control(
		    'media_offset_y',
		    [
		        'label' => esc_html__( 'Offset Top', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            // Media translate styles
		            '(desktop){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}) !important;',
		            '(tablet){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}) !important;',
		            '(mobile){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}) !important;',
		            // Body text styles
		            '{{WRAPPER}} .services-text' => 'margin-top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_popover();

		$this->add_responsive_control(
		    'media_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'media_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon > img, {{WRAPPER}} .services-icon,{{WRAPPER}} .react-addon-services.services-style7 .single-work .service-img7' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'media_border',
		        'selector' => '{{WRAPPER}} .services-icon > img, {{WRAPPER}} .services-icon',
		    ]
		);

		$this->add_responsive_control(
		    'media_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .services-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'media_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .services-icon > img, {{WRAPPER}} .react-addon-services.services-style3 .services-part .services-icon, {{WRAPPER}} .services-icon'
		    ]
		);

		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .services-part .services-icon' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Hover Background Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container .services-part .services-icon' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_effect',
		    [
		        'label' => esc_html__( 'Effect Enable/Disable', 'rtelements' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => [
		        	'block' => esc_html__( 'Enable', 'rtelements'),
		        	'none' => esc_html__( 'Disable', 'rtelements'),		

		        ],
		        'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .react-addon-services .services-part .services-icon::after' => 'display: {{VALUE}}'
                ],
		    ]
		);

		$this->add_control(
		    'icon_effect_color',
		    [
		        'label' => esc_html__( 'Effect Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'icon_effect' => 'block'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-icon::after' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_bg_rotate',
		    [
		        'label' => esc_html__( 'Background Rotate', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'deg' ],
		        'default' => [
		            'unit' => 'deg',
		        ],
		        'range' => [
		            'deg' => [
		                'min' => 0,
		                'max' => 360,
		            ],
		        ],
		        'selectors' => [
		            // Icon box transform styles
		            '(desktop){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(tablet){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(mobile){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		        ],
		    ]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Title & Description', 'rtelements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'content_padding',
		    [
		        'label' => esc_html__( 'Content Box Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .services-style8 .product-box.product-box-medium' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .react-addon-services .single-work' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .react-addon-services.services-style3 .services-part .services-text .services-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .services-text',
		    ]
		);

		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		$this->add_responsive_control(
		    'content_bottom_border',
		    [
		        'label' => esc_html__( 'Bottom Border Enable/Disable', 'rtelements' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'block' => esc_html__( 'Enable', 'rtelements'),
		        	'none' => esc_html__( 'Disable', 'rtelements'),		

		        ],
		        'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .react-addon-services .services-part::after' => 'display: {{VALUE}};',
                ],
		    ]
		);			

		$this->add_responsive_control(
		    'fixed_bottom_border',
		    [
		        'label' => esc_html__( 'Fixed Bottom Border', 'rtelements' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'unset' => esc_html__( 'Enable', 'rtelements'),
		        	'' => esc_html__( 'Disable', 'rtelements'),		

		        ],
		        'default' => 'unset',
                'selectors' => [
                    '{{WRAPPER}} .react-addon-services .services-part::after' => 'width: {{VALUE}};',
                ],
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		    ]
		);		

		$this->add_responsive_control(
		    'content_bottom_border_width',
		    [
		        'label' => esc_html__( 'Border Width', 'rtelements' ),		        
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part::after' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'fixed_bottom_border' => 'unset',
		        ],
		    ]
		);

		$this->add_control(
		    'offset_border',
		    [
		        'label' => esc_html__( 'Offset', 'rtelements' ),
		        'type' => Controls_Manager::POPOVER_TOGGLE,
		        'label_off' => esc_html__( 'None', 'your-plugin' ),
		        'label_on' => esc_html__( 'Custom', 'your-plugin' ),
		        'return_value' => 'yes',
		    ]
		);

		$this->start_popover();

		$this->add_responsive_control(
		    'border_offset_x',
		    [
		        'label' => esc_html__( 'Offset Left', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'render_type' => 'ui',

		    ]
		);

		$this->add_responsive_control(
		    'border_offset_y',
		    [
		        'label' => esc_html__( 'Offset Top', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            // Media translate styles
		            '(desktop){{WRAPPER}} .react-addon-services .services-part::after' => '-ms-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}});',
		            '(tablet){{WRAPPER}} .react-addon-services .services-part::after' => '-ms-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}});',
		            '(mobile){{WRAPPER}} .react-addon-services .services-part::after' => '-ms-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}});',
		            // Body text styles
		        ],
		    ]
		);
		$this->end_popover();	


		$this->add_responsive_control(
		    'content_bottom_border_height',
		    [
		        'label' => esc_html__( 'Bottom Border Height', 'rtelements' ),		        
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part::after' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		    ]
		);


		$this->add_responsive_control(
		    'content_bottom_border_left',
		    [
		        'label' => esc_html__( 'Start Point', 'rtelements' ),		        
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part::after' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'content_bottom_border_color',
		    [
		        'label' => esc_html__( 'Bottom Border Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part::after' => 'background:  {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .services-text'
		    ]
		);

		$this->add_control(
		    'title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'rtelements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'title_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .single-work h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .services-style8 .product-box.product-box-medium .contents .product-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .react-addon-services .services-part .services-text .services-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .single-work h5,
		            {{WRAPPER}} .react-addon-services .services-part .product-box .contents .product-title,
					{{WRAPPER}}  .react-addon-services .single-work h5 a' => 'color: {{VALUE}}',
		             '{{WRAPPER}} .react-addon-services .services-part .services-text .services-title .title, {{WRAPPER}} .react-addon-services .services-part .services-title .title, {{WRAPPER}}  .react-addon-services .services-part .services-text .services-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [

		        	'{{WRAPPER}} .react-addon-services .single-work:hover h5,
		        	{{WRAPPER}}  .react-addon-services:hover .services-part .services-text .services-title .title,
					{{WRAPPER}} .react-addon-services .services-part .services-title .title:hover,
		            {{WRAPPER}}   .react-addon-services .services-part .services-text .services-title .title a:hover' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services.services-style5 .services-title .title a' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services.services-style5 .services-title .title' => 'color: {{VALUE}}',
		        ],
		    ]
		);		


		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography_others',
		        'label' => esc_html__( 'Typography', 'rtelements' ),
		        'selector' => '{{WRAPPER}}  .react-addon-services .services-part .services-title .title',
		        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
		        'condition' => ['services_style' => ['style1', 'style2', 'style3', 'style4', 'style5', 'style6']],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rtelements' ),
		        'selector' => '{{WRAPPER}} .react-addon-services .single-work h5',
		        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
		        'condition' => ['services_style' => [ 'style7']],
		    ]
		);

		$this->add_control(
		    'title_color_prefix',
		    [
		        'label' => esc_html__( 'Title Prefix Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
					'{{WRAPPER}} .react-addon-services .services-part .product-box .contents .pretitle,
		            {{WRAPPER}} .react-addon-services.services-style1 .services-title span' => 'color: {{VALUE}}',
		        ],
		    ]
		);	

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_prefix_typography',
		        'label' => esc_html__( 'Typography', 'rtelements' ),
		        'selector' => '{{WRAPPER}}  .react-addon-services.services-style1 .services-title span',
		        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
		    ]
		);	
		
		$this->add_control(
		    'description_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Description', 'rtelements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'description_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-txt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rts-posters-section1.section-9 .container .product-box-medium5 .contents .go-btn' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .product-box .contents p, {{WRAPPER}} .react-addon-services .services-part .services-txt' => 'color: {{VALUE}}',
		            
		        ],
		    ]
		);

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part .services-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rtelements' ),
		        'selector' => '{{WRAPPER}} .react-addon-services .services-part .services-txt',
		        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rtelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn,
		        {{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn',
		        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .services-btn',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rtelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn',
		    ]
		);

		$this->add_control(
		    'hr',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_tab_button_normal',
		    [
		        'label' => esc_html__( 'Normal', 'rtelements' ),
		    ]
		);
		// .react-addon-services .services-part .product-box .go-btn
		$this->add_control(
		    'link_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .product-box .go-btn, {{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .react-addon-services .services-btn-part .services-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .react-addon-services.services-style4 .services-part .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .react-addon-services .services-part .services-btn-part .services-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'rtelements' ),
		    ]
		);

		$this->add_control(
		    'button_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part .services-btn-part .services-btn, {{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part .services-btn-part:focus .services-btn',
		            '{{WRAPPER}}  .react-addon-services .services-part .product-box .go-btn:hover, {{WRAPPER}}  .react-addon-services.services-style4 .services-part .services-btn-part .services-btn:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}}  .react-addon-services.services-style1 .services-part .services-btn-part .services-btn:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}}  .react-addon-services .services-btn-part .services-btn:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}}  .react-addon-services .services-part .services-btn-part .services-btn:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part .services-btn-part .services-btn, {{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part:focus .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}}  .react-addon-services.services-style4 .services-part .services-btn-part .services-btn:hover' => 'background: {{VALUE}};',
		            '{{WRAPPER}} .react-addon-services .services-btn-part .services-btn:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'rtelements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part .services-btn-part, {{WRAPPER}} .elementor-widget-container .react-addon-services .services-part .services-btn-part .services-btn:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'rtelements' ),
		        'type' => Controls_Manager::SLIDER,
		        
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .react-addon-services .services-part .services-btn-part .services-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .elementor-widget-container .react-addon-services .services-part .services-btn-part .services-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();			
		$this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title' );
        $this->add_inline_editing_attributes( 'text', 'basic' );
        $this->add_render_attribute( 'text', 'class', 'services-txt' );
        $this->add_inline_editing_attributes( 'services_btn_text', 'basic' );
        $this->add_render_attribute( 'services_btn_text', 'class', 'btn_text' );	

		if('style4' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style4.php";
		}
		elseif('style3' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style3.php";
		}
		elseif('style2' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style2.php";
		}
		elseif('style5' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style5.php";
		}elseif('style6' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style6.php";
		}elseif('style7' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style7.php";
		}elseif('style8' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style8.php";
		}elseif('style9' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style9.php";
		}elseif('style10' == $settings['services_style']){
			require plugin_dir_path(__FILE__)."/style10.php";
		}
		else{
			require plugin_dir_path(__FILE__)."/default-style.php";
		}
	}	
}