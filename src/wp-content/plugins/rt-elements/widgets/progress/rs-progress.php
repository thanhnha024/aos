<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Reactheme_Elementor_Progress_Widget extends \Elementor\Widget_Base {

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
		return 'rt-progress-bar';
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
		return esc_html__( ' RT Progress Bar', 'rsaddon' );
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
		return 'glyph-icon flaticon-progress';
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
			'section_progress',
			[
				'label' => esc_html__( 'Progress Bar', 'rs-addon' ),
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percentage', 'rs-addon' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'label_block' => true,
			]
		);

		$this->add_control( 'rs_progress_bar_style', [
			'label' => esc_html__( 'Style', 'rs-addon' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'style1',
			'options' => [
				'style1' => esc_html__( 'Style 1', 'rs-addon' ),
				'style2' => esc_html__( 'Style 2', 'rs-addon' ),
			],
		] );

		$this->add_control( 'rs_linear_bar_style', [
			'label' => esc_html__( 'Linear Background Style', 'rs-addon' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'basic',
			'options' => [
				'basic' => esc_html__( 'Basic', 'rs-addon' ),
				'striped' => esc_html__( 'Striped', 'rs-addon' ),
				'animation' => esc_html__( 'Striped Animation', 'rs-addon' ),
			],
		] );

		$this->add_control( 'display_percentage', [
			'label' => esc_html__( 'Display Percentage', 'rs-addon' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'show',
			'options' => [
				'show' => esc_html__( 'Show', 'rs-addon' ),
				'hide' => esc_html__( 'Hide', 'rs-addon' ),
			],
		] );


		$this->add_control(
			'rs_progress_inner_text',
			[
				'label' => esc_html__( 'Title Text', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Web Designer', 'rs-addon' ),
				'default' => esc_html__( 'Web Designer', 'rs-addon' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'rs_view',
			[
				'label' => esc_html__( 'View', 'rs-addon' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rs_section_progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'rs-addon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rs_bar_inline_color',
			[
				'label' => esc_html__( 'Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-skill-bar .skillbar .skillbar-title' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rs_bar_inner_typography',
				'selector' => '{{WRAPPER}} .rs-skill-bar .skillbar .skillbar-title',
				'exclude' => [
					'line_height',
				],
			]
		);

		$this->add_control(
			'rs_bar_height',
			[
				'label' => esc_html__( 'Height', 'rs-addon' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rs-skill-bar .skillbar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-skill-bar .skillbar .skillbar-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-skill-bar.style2 .skillbar .skillbar-title' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'rs_inner_percent',
			[
				'label' => esc_html__( 'Percent Style', 'rs-addon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_bar_percent_color',
			[
				'label' => esc_html__( 'Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-skill-bar .skillbar .skill-bar-percent' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rs_bar_percent_typography',
				'selector' => '{{WRAPPER}} .rs-skill-bar .skillbar .skill-bar-percent',
				'exclude' => [
					'line_height',
				],
			]
		);

		$this->add_responsive_control(
		    'progress_bar_percent_position',
		    [
		        'label' => esc_html__( 'Position Vertical', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-skill-bar .skillbar .skill-bar-percent' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'rs_inner_text_heading',
			[
				'label' => esc_html__( 'Background Color', 'rs-addon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_area_title_bg_color',
			[
				'label' => esc_html__( 'Title Background', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-skill-bar.style2 .skillbar .skillbar-title' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'rs_progress_bar_style' => 'style2',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'rs_bar_bg_animate_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-skill-bar .skillbar .skillbar-bar',
            ]
        );

		$this->add_control(
			'rs_area_bar_bg_color',
			[
				'label' => esc_html__( 'Gray Area Background Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-skill-bar .skillbar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render progress widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'rs_progress_inner_text', 'basic' );
        $this->add_render_attribute( 'rs_progress_inner_text', 'class', 'skillbar-title' );

		$this->add_render_attribute( 'progress-bar', [
			'class' => 'skillbar',
			'data-percent' => $settings['percent']['size'],
		] );?>

		<div class="rs-skill-bar <?php echo esc_html($settings['rs_linear_bar_style']); ?>  <?php echo esc_html($settings['rs_progress_bar_style']); ?>"> 
            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'progress-bar' ) ); ?>> 
                <span <?php echo wp_kses_post( $this->get_render_attribute_string( 'rs_progress_inner_text' ) ); ?>><?php echo esc_html($settings['rs_progress_inner_text']); ?></span>
                <p class="skillbar-bar"></p>
                <?php if($settings['display_percentage'] == 'show') {?>
	                <span class="skill-bar-percent"></span> 
	            <?php } ?>
            </div>
        </div>

        <script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.skillbar').skillBars({  
		            from: 0,    
		            speed: 4000,    
		            interval: 100,  
		            decimals: 0,    
		        });
			});
		</script>

		<?php
	}
}
