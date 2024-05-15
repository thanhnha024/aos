<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Reactheme_Elementor_Video_Widget extends \Elementor\Widget_Base {

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
		return 'react-video';
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
		return __( 'RT Video', 'pielements' );
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
		return [ 'video' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_counter',
			[
				'label' => esc_html__( 'Content', 'pielements' ),
			]
		);

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Title Alignment', 'pielements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'pielements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'pielements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'pielements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'pielements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default'     => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .react-video' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_control(
			'react_video_style',
			[
				'label'   => esc_html__( 'Select Video Style', 'pielements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'pielements'),
					'style2' => esc_html__( 'Style 2', 'pielements'),
				],
			]
		);

	
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Enter Link Here', 'pielements' ),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__( 'Video link here', 'pielements' ),				
				'separator' => 'before',
			]
		);
	
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Background Image', 'pielements' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'separator' => 'before',
			]
		);

			$this->add_control(
			'react_video_title',
			[
				'label' => esc_html__( 'Video Title', 'pielements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
		);
			
		
	
		
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Video Description', 'pielements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,	
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__( 'Add your video description here..', 'pielements' ),
				'separator' => 'before',
			]
			
		);
	
		
		$this->add_control(
			'react_video_subtitle',
			[
				'label' => esc_html__( 'Video Subtitle', 'pielements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
			
		);
	
		
		$this->add_control(
			'react_video_btn',
			[
				'label' => esc_html__( 'Button Text', 'pielements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'separator' => 'before',
				'default'     => 'Button Text',
				'placeholder' => esc_html__( 'Add button text here..', 'pielements' ),
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
			
		);
		
		$this->add_control(
			'react_video_btn_link',
			[
				'label' => esc_html__( 'Button Link Text', 'pielements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'separator' => 'before',
				'default'     => '#',
				'placeholder' => esc_html__( 'Add button link here..', 'pielements' ),
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
			
		);


		
		
		$this->end_controls_section();

				
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Content', 'pielements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_style2',
			[
				'label' => esc_html__( 'Title Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .video_title' => 'color: {{VALUE}};',
				],				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_title_text',				
				'selector' => '{{WRAPPER}} .video_title',
				
			]
		);


		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Content Text Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .video-desc' => 'color: {{VALUE}};',
				],

				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_text',				
				'selector' => '{{WRAPPER}} .video-desc',
				
			]
		);

		$this->add_responsive_control(
            'video_title_postion',
            [
                'label' => esc_html__( 'Content Position Vertical', 'pielements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
               'range' => [
                   'px' => [
                       'min' => -500,
                       'max' => 500,
                   ],
               ],                
                'selectors' => [
                    '{{WRAPPER}} .react-video .video-desc' => 'top: {{SIZE}}px;',                   
                ],
            ]
        );

        $this->add_responsive_control(
		    'video_full_area_padding',
		    [
		        'label' => esc_html__( 'Area Padding', 'pielements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .react-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'pielements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'icon_btn',
			[
				'label' => esc_html__( 'Button Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video.style2 .rs-icon-inner .rs-icon-btn a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
		);


		$this->add_control(
			'icon_btn_hover',
			[
				'label' => esc_html__( 'Button Hover Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video.style2 .rs-icon-inner .rs-icon-btn a:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'pielements' ),
				'name' => 'typography_btn',				
				'selector' => '{{WRAPPER}} .react-video.style2 .rs-icon-inner .rs-icon-btn a',
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
		);

		$this->add_control(
			'btn_bg',
			[
				'label' => esc_html__( 'Button Background Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video.style2 .rs-icon-inner .rs-icon-btn a' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
		);

		$this->add_control(
			'btn_bg_hover',
			[
				'label' => esc_html__( 'Button Hover Background Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video.style2 .rs-icon-inner .rs-icon-btn a:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .react-video.style2 .rs-icon-inner .rs-icon-btn a:before' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
		            'react_video_style' => 'style2'
		        ],
			]
		);


		$this->add_control(
			'icon_box_width',
			[
				'label' => esc_html__( 'Icon Box Size', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-video .popup-videos' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video .popup-videos i:before' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Icon Typography', 'pielements' ),
				'name' => 'typography_icon',				
				'selector' => '{{WRAPPER}} .react-video .popup-videos i',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_top_position',
			[
				'label' => esc_html__( 'Icon Top Position', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-video .popup-videos i' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label' => esc_html__( 'Icon Box Background Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video .popup-videos' => 'background: {{VALUE}};',
					'{{WRAPPER}} .react-video .popup-videos:before' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'icon_border',
			[
				'label' => esc_html__( 'Icon Border Color', 'pielements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .react-video .overly-border' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
            'video_icon_postion_ver',
            [
                'label' => esc_html__( 'Icon Box Position Vertical', 'pielements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                
                'selectors' => [
                    '{{WRAPPER}} .react-video .overly-border' => 'top: {{SIZE}}%;',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'video_icon_postion_ht',
            [
                'label' => esc_html__( 'Icon Box Position Horizontal', 'pielements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                
                'selectors' => [
                    '{{WRAPPER}} .react-video .overly-border' => 'left: {{SIZE}}%;',                   
                ],
            ]
        );


		$this->end_controls_section();

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
		$rand = rand(12, 3330);

		$this->add_inline_editing_attributes( 'description', 'basic' );
        $this->add_render_attribute( 'description', 'class', 'video-desc' ); 

		?>
  		<div class="react-video video-item-<?php echo esc_attr($rand);?> <?php echo esc_html($settings['align']);?> <?php echo esc_html($settings['react_video_style']);?>" <?php if(!empty($settings['image']['url'])):?>style="background: url(<?php echo esc_url($settings['image']['url']);?>);"<?php endif;?>>


   				<?php if($settings['react_video_style'] == 'style1') { ?>	
  						<div class="overly-border">
						    <a class="popup-videos" href="<?php echo esc_url($settings['video_link']);?>">
								<i class="rt-play"></i>
							</a>
						</div>

				    <?php if( !empty( $settings['description']) || !empty( $settings['react_video_subtitle']) ) : ?>
				    	<div <?php echo wp_kses_post($this->print_render_attribute_string('description')); ?>>
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif; ?>

				<?php }; ?>

				<?php if($settings['react_video_style'] == 'style2') : ?>	
  					
  				<div class="overly-border">
						    <a class="popup-videos" href="<?php echo esc_url($settings['video_link']);?>">
								<i class="fa fa-play"></i>
							</a>
						</div>

				    
				<?php endif; ?>  
				    
			</div>	


		<script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.popup-videos').magnificPopup({
			        disableOn: 10,
			        type: 'iframe',
			        mainClass: 'mfp-fade',
			        removalDelay: 160,
			        preloader: false,

			        fixedContentPos: false
			    }); 
			});
		</script>
    
<?php 
	}
}