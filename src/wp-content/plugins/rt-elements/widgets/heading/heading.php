<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Reactheme_Elementor_Heading_Widget extends \Elementor\Widget_Base {

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
		return 'react-heading';
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
		return esc_html__( 'RT Heading', 'rtelements' );
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
		return 'glyph-icon flaticon-letter';
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
				'label' => esc_html__( 'Heading Info', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Heading Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'rtelements'),
					'style1'  => esc_html__( 'Border Right', 'rtelements'),
					'style2'  => esc_html__( 'Border Bottom', 'rtelements'),
					'style3'  => esc_html__( 'Border Left', 'rtelements' ),
					'style4'  => esc_html__( 'Border Top', 'rtelements' ),					
					'style6'  => esc_html__( 'Border Top Left', 'rtelements' ),
					'style7'  => esc_html__( 'Border Top Right', 'rtelements' ),
					'style8'  => esc_html__( 'Boder Left Vertical Style', 'rtelements' ),
					'style9'  => esc_html__( 'Heading Image Style', 'rtelements' ),
					'style5'  => esc_html__( 'Heading Bracket Style', 'rtelements' ),
					'style10' => esc_html__( 'Heading Left Rotate Style', 'rtelements' ),
					'style11' => esc_html__( 'Heading Right Rotate Style', 'rtelements' ),
					'style12'  => esc_html__( 'Border Top Left Right', 'rtelements' ),
					'style13'  => esc_html__( 'Sub Heading Left Right Image', 'rtelements' ),
					'style14'  => esc_html__( 'Heading with Button', 'rtelements' ),
					
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Heading Text', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Heading Style', 'rtelements' ),				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_stroke',
			[
				'label' => esc_html__( 'Enable Title Stroke', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rtelements' ),
				'label_off' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'yes',
				'default' => 'no',
				
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Select Heading Tag', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [						
					'h1' => esc_html__( 'H1', 'rtelements'),
					'h2' => esc_html__( 'H2', 'rtelements'),
					'h3' => esc_html__( 'H3', 'rtelements' ),
					'h4' => esc_html__( 'H4', 'rtelements' ),
					'h5' => esc_html__( 'H5', 'rtelements' ),
					'h6' => esc_html__( 'H6', 'rtelements' ),				
					
				],
			]
		);

		$this->add_control(
			'image-left-sub',
			[
				'label' => esc_html__( 'Choose Sub Heading Left Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style13',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'image-right-sub',
			[
				'label' => esc_html__( 'Choose Sub Heading Rihgt Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style13',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__( 'Sub Heading Text', 'rtelements' ),
				'type'      => Controls_Manager::TEXT,				
				'default'   => esc_html__( 'Sub Heading', 'rtelements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Heading Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style9',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_postition',
			[
				'label'   => esc_html__( 'Select Image Position', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [						
					'top' => esc_html__( 'Top', 'rtelements'),
					'bottom' => esc_html__( 'Bottom', 'rtelements'),						
					
				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_postition_width',
			[
				'label' => esc_html__( 'Image With', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size'=> '150',
				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .title-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_postition_left_right',
			[
				'label' => esc_html__( 'Image Left/right Position', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -400,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					
				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .title-img img' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'watermark',
			[
				'label' => esc_html__( 'Watermark Text', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Watermark', 'rtelements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content',
			[
				'label'   => esc_html__( 'Description', 'rtelements' ),
				'type'    => Controls_Manager::WYSIWYG,
				'rows'    => 10,			
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
                    '{{WRAPPER}} .react-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );


		
		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_button',
			[
				'label' => esc_html__( 'Button Info', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => 'style14',
				],
			]
		);
		$this->add_control(
            'button',
            [
                'label' => esc_html__( 'Button', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('View More', 'rsaddon'),
				'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( ' Button Link', 'rsaddon' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,						
			]
		);

		$this->add_control(
            'show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
		

		 $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
                'condition' => [
					'show_icon' => 'yes',
				],	                
            ]
        );

		$this->end_controls_section();

			

		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading Style', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
	    $this->add_control(
            'title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'rtelements' ),
                'separator' => 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rtelements' ),
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .react-heading .title-inner .title',
			]
		);

		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .react-heading .title-inner .title' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .react-heading .title-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'watermark_typography',
				'label' => esc_html__( 'Watermark Typography', 'rtelements' ),
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .react-heading .title-inner .title span.watermark',
			]
		);

        $this->add_control(
            'sub_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Sub Title', 'rtelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography', 'rtelements' ),
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .react-heading .title-inner .sub-text',
			]
		);

		$this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .react-heading .title-inner .sub-text' => 'color: {{VALUE}};',
                ],                
            ]
        );

		$this->add_control(
            'subtitle_highlight_color',
            [
                'label' => esc_html__( 'Subtitle Highlight Background', 'rtelements' ),
                // 'desc' => esc_html__( 'Add span tag to apply background style', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .react-heading .title-inner .sub-text span' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__( 'Subtitle Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .react-heading .title-inner .sub-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'des_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'rtelements' ),
                'separator' => 'before',
            ]
        ); 

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Description Typography', 'rtelements' ),
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .react-heading .description p',
			]
		);

		$this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .react-heading .description' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react-heading .description p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react-heading .description p a' => 'color: {{VALUE}};',
                ],                
            ]
        ); 

        $this->add_control(
            'desc_color_strong',
            [
                'label' => esc_html__( 'Description Strong Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .react-heading .description strong' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .react-heading .description p strong' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_sec_typography',
				'label' => esc_html__( 'Description Strong Typography', 'rtelements' ),
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .react-heading .description strong',
			]
		);

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Description Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .react-heading .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );         

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'border_color',
                'label' => esc_html__( 'Border Color', 'elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
             
				'selector' => '{{WRAPPER}} .react-heading.style2:after',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
                
            ]
        );           

		$this->end_controls_section();

			$this->start_controls_section(
				    '_section_style_button',
				    [
				        'label' => esc_html__( 'Button', 'rsaddon' ),
				        'tab' => Controls_Manager::TAB_STYLE,
				        'condition' => [
							'style' => 'style14',
						],
				    ]
				);

				$this->add_control(
		            'btn_style',
		            [
		                'label' => esc_html__( 'Button Style', 'rsaddon' ),
		                'type' => Controls_Manager::HEADING,
		                'separator' => 'before',
		            ]
		        );

		        $this->add_responsive_control(
				    'btn_width',
				    [
				        'label' => esc_html__( 'Width', 'rsaddon' ),
				        'type' => Controls_Manager::SLIDER,
				        'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .react-heading .rt-button a' => 'width: {{SIZE}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_responsive_control(
		            'btn_position',
		            [
		                'label' => esc_html__( 'Position', 'rsaddon' ),
		                'type' => Controls_Manager::SELECT,
						'default' => '14',
		                'options' => [
		                    '-2' => esc_html__( 'Left', 'rsaddon'),
							'14' => esc_html__( 'Right', 'rsaddon'),
		                ],
		                'toggle' => true,
		                'selectors' => [
		                    '{{WRAPPER}} .react-heading .rt-button a' => 'order: {{VALUE}};'
		                ],
						'separator' => 'before',
		            ]
		        );

		        $this->add_responsive_control(
		            'btn_align',
		            [
		                'label' => esc_html__( 'Alignment', 'rsaddon' ),
		                'type' => Controls_Manager::CHOOSE,
		                'options' => [
		                    'left' => [
		                        'title' => esc_html__( 'Left', 'rsaddon' ),
		                        'icon' => 'eicon-text-align-left',
		                    ],
		                    'center' => [
		                        'title' => esc_html__( 'Center', 'rsaddon' ),
		                        'icon' => 'eicon-text-align-center',
		                    ],
		                    'right' => [
		                        'title' => esc_html__( 'Right', 'rsaddon' ),
		                        'icon' => 'eicon-text-align-right',
		                    ],
		                    'justify' => [
		                        'title' => esc_html__( 'Justify', 'rsaddon' ),
		                        'icon' => 'eicon-text-align-justify',
		                    ],
		                ],
		                'toggle' => true,
		                'selectors' => [
		                    '{{WRAPPER}} .react-heading .rt-button a' => 'text-align: {{VALUE}}'
		                ]
		            ]
		        );

				$this->start_controls_tabs( '_tabs_button' );

				$this->start_controls_tab(
		            'style_normal_tab',
		            [
		                'label' => esc_html__( 'Normal', 'rsaddon' ),
		            ]
		        ); 

				$this->add_control(
				    'btn_text_color',
				    [
				        'label' => esc_html__( 'Text Color', 'rsaddon' ),
				        'type' => Controls_Manager::COLOR,		      
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a' => 'color: {{VALUE}};',
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Background::get_type(),
					[
						'name' => 'background_normal',
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .rt-button a',
					]
				);

				$this->add_control(
		            'btn_opacity',
		            [
		                'label' => esc_html__( 'Opacity', 'rsaddon' ),
		                'type' => Controls_Manager::SLIDER,
		                'range' => [
		                    'px' => [
		                        'max' => 1,
		                        'min' => 0.10,
		                        'step' => 0.01,
		                    ],
		                ],
		                'selectors' => [
		                    '{{WRAPPER}} .rt-button a' => 'opacity: {{SIZE}};',
		                ],
		            ]
		        );

				$this->add_responsive_control(
				    'link_padding',
				    [
				        'label' => esc_html__( 'Padding', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_responsive_control(
				    'link_margin',
				    [
				        'label' => esc_html__( 'Margin', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Typography::get_type(),
				    [
				        'name' => 'btn_typography',
				        'selector' => '{{WRAPPER}} .rt-button a',
				        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				    ]
				);

				$this->add_group_control(
				    Group_Control_Border::get_type(),
				    [
				        'name' => 'button_border',
				        'selector' => '{{WRAPPER}} .rt-button a',
				    ]
				);

				$this->add_control(
				    'button_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Box_Shadow::get_type(),
				    [
				        'name' => 'button_box_shadow',
				        'selector' => '{{WRAPPER}} .rt-button a',
				    ]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'style_hover_tab',
		            [
		                'label' => esc_html__( 'Hover', 'rsaddon' ),
		            ]
		        ); 

				$this->add_control(
				    'btn_text_hover_color',
				    [
				        'label' => esc_html__( 'Text Color', 'rsaddon' ),
				        'type' => Controls_Manager::COLOR,		      
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a:hover' => 'color: {{VALUE}};',
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Background::get_type(),
					[
						'name' => 'background',
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .rt-button a:hover',
					]
				);

				$this->add_control(
		            'btn_hover_opacity',
		            [
		                'label' => esc_html__( 'Opacity', 'rsaddon' ),
		                'type' => Controls_Manager::SLIDER,
		                'range' => [
		                    'px' => [
		                        'max' => 1,
		                        'min' => 0.10,
		                        'step' => 0.01,
		                    ],
		                ],
		                'selectors' => [
		                    '{{WRAPPER}} .rt-button:hover a' => 'opacity: {{SIZE}};',
		                ],
		            ]
		        );

				$this->add_responsive_control(
				    'link_hover_padding',
				    [
				        'label' => esc_html__( 'Padding', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}}  .rt-button a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_responsive_control(
				    'link_hover_margin',
				    [
		                'label'      => esc_html__( 'Margin', 'rsaddon' ),
		                'type'       => Controls_Manager::DIMENSIONS,
		                'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Typography::get_type(),
				    [
		                'name'     => 'btn_hover_typography',
		                'selector' => '{{WRAPPER}}  .rt-button a',
		                'scheme'   => Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				    ]
				);

				$this->add_group_control(
				    Group_Control_Border::get_type(),
				    [
		                'name'     => 'button_hover_border',
		                'selector' => '{{WRAPPER}} .rt-button a',
				    ]
				);

				$this->add_control(
				    'button_hover_border_radius',
				    [
		                'label'      => esc_html__( 'Border Radius', 'rsaddon' ),
		                'type'       => Controls_Manager::DIMENSIONS,
		                'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Box_Shadow::get_type(),
				    [
		                'name'     => 'button_hover_box_shadow',
		                'selector' => '{{WRAPPER}} .rs-cta:hover .rt-button a',
				    ]
				);

				$this->add_control(
		            'hover_animation',
		            [
		                'label' => esc_html__( 'Hover Animation', 'rsaddon' ),
		                'type' => Controls_Manager::HOVER_ANIMATION,
		            ]
		        );

				$this->end_controls_tab();
				$this->end_controls_tabs();

		        $this->add_control(
		            'btn_icon_style',
		            [
		                'label'     => esc_html__( 'Button Icon', 'rsaddon' ),
		                'type'      => Controls_Manager::HEADING,
		                'separator' => 'before',
		                'condition' => [
		                    'show_icon' => 'yes'
		                ],
		            ]
		        );

				$this->start_controls_tabs( '_tabs_button_icon' );

				$this->start_controls_tab(
		            'btn_icon_normal_tab',
		            [
		                'label' => esc_html__( 'Normal', 'rsaddon' ),
		                'condition' => [
		                    'show_icon' => 'yes'
		                ],
		            ]
		        ); 

				$this->add_control(
				    'btn_icon_spacing',
				    [
				        'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
				        'type' => Controls_Manager::SLIDER,
				        'default' => [
				            'size' => 10
				        ],
				        'range' => [
				            'px' => [
				                'min' => -100,
				                'max' => 100,
				            ],
				        ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
				        ],
				        'condition' => [
							'show_icon' => 'yes',
						],	
				    ]
				);


				$this->add_control(
				    'icon_text_color',
				    [
				        'label' => esc_html__( 'Color', 'rsaddon' ),
				        'type' => Controls_Manager::COLOR,		      
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a i' => 'color: {{VALUE}};',
				        ],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
				    ]
				);

				$this->add_control(
				    'icon_background',
				    [
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => ['{{WRAPPER}} .rt-button a i' => 'background: {{VALUE}};',],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
					]
				);

				$this->add_responsive_control(
				    'icon_padding',
				    [
				        'label' => esc_html__( 'Padding', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
				    ]
				);

				$this->add_control(
				    'icon_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
				    ]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'btn_icon_hover_tab',
		            [
		                'label' => esc_html__( 'Hover', 'rsaddon' ),
		                'condition' => [
		                    'show_icon' => 'yes'
		                ],
		            ]
		        ); 

				$this->add_control(
				    'btn_icon_hover_spacing',
				    [
				        'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
				        'type' => Controls_Manager::SLIDER,
				        'default' => [
				            'size' => 10
				        ],
				        'range' => [
				            'px' => [
				                'min' => -100,
				                'max' => 100,
				            ],
				        ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
				        ],
				        'condition' => [
							'show_icon' => 'yes',
						],	
				    ]
				);

				$this->add_control(
				    'icon_hover_color',
				    [
				        'label' => esc_html__( 'Color', 'rsaddon' ),
				        'type' => Controls_Manager::COLOR,		      
				        'selectors' => [
				            '{{WRAPPER}} .rt-button:hover a i' => 'color: {{VALUE}};',
				        ],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
				    ]
				);

				$this->add_control(
				    'icon_hover_background',
				    [				
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => ['{{WRAPPER}} .rt-button:hover a i'=> 'background: {{VALUE}};',],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
					]
				);

				$this->add_responsive_control(
				    'icon_hover_padding',
				    [
				        'label' => esc_html__( 'Padding', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', 'em', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button:hover a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
			            'condition' => [
			                'show_icon' => 'yes'
			            ],
				    ]
				);

				$this->add_control(
				    'icon_hover_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .rt-button:hover a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
			            'condition' => [
			                'show_icon' => 'yes'
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
		$watermark_text = ($settings['watermark']) ? '<span class="watermark">'.($settings['watermark']).'</span>' : '';

		$main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title"><span class="watermark">'.$settings['watermark'].'</span>'.wp_kses_post($settings['title']).'</'.$settings['title_tag'].'>' : '';

		
		if( "style4"==	$settings['style'] || "style4 Lite"== $settings['style'] || "style6"== $settings['style'] || "style6 Lite"==$settings['style'] || "style7" == $settings['style'] || "style7 Lite"== $settings['style'] ){
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text">'.($settings['subtitle']).'</span>' : '';
		}
		elseif ( "style5" == $settings['style'] ){
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text title-upper">[ <span class="sub-text title-upper">'.($settings['subtitle']).'</span> ] </span>' : '';
		}
		else{
			$sub_text       = ($settings['subtitle'])  ? '<span class="sub-text ">'.($settings['subtitle']) .'</span>' : '';
		}

		$titleimg    = $settings['image'] ? '<img src="' . $settings['image']['url'] . '" alt="title-image" />' : '';

		$topimage    = $settings['image_postition'] == 'top' ? '<div class="title-img top"> '.$titleimg .'</div>' : "";

		$bottomimage = $settings['image_postition'] == 'bottom' ? '<div class="title-img bottom-img">'.$titleimg .'</div>' : "";

		

		if( "style9" == $settings['style'] ){
			$main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title" ><span class="watermark">'.$settings['watermark'].'</span>'.($settings['title']).'</'.$settings['title_tag'].'>' : '';
		}

		
		if( "style13" == $settings['style'] ){
			$sub_left_image = $settings['image-left-sub']['url'] ? '<img  class = "line-1-img" src="' . $settings['image-left-sub']['url'] . '" alt="title-image" />' : '';
			$sub_right_image = $settings['image-right-sub']['url'] ? '<img class = "line-2-img" src="' . $settings['image-right-sub']['url'] . '" alt="title-image" />' : '';
			$sub_text  =   '<div class="sub-content">'.$sub_left_image .$sub_text. $sub_right_image.'</div>';
		}
		    
        // Fill $html var with data
      ?>
	  
        <div class="react-heading <?php echo esc_attr($settings['style']);?> <?php echo esc_attr($settings['align']);?>">
        	<div class="title-inner <?php echo $settings['enable_stroke'];?>">        		      		
	            <?php 
					echo wp_kses_post($topimage);
					
					echo wp_kses_post($sub_text);
					echo wp_kses_post($main_title);
					echo wp_kses_post($bottomimage) ;
				?>
	        </div>
	        <?php if ($settings['content']) { ?>
            	<div class="description">
            		<?php echo wp_kses_post($settings['content']);?>            		
            	</div>
        	<?php } ?>

	        <?php if(!empty($settings['btn_text'])): ?>
	
				<div class="rt-button">

					<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : '';?>

					<a class="readon react_button elementor-animation-<?php echo esc_html($settings['hover_animation']);?>" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php echo esc_attr($target);?>>				
						<span <?php echo wp_kses_post($this->print_render_attribute_string('btn_text'));?>><?php echo esc_html($settings['btn_text']);?></span>

						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</a>

				</div>
	        <?php endif; ?>    
        </div>
        <?php 		
	}
}?>