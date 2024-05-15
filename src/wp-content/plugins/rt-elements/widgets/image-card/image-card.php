<?php
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();


class Reactheme_Elementor_Image_Card_Widget extends \Elementor\Widget_Base {

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
		return 'rt-image-card';
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
		return esc_html__( 'RT Image Card', 'rtelements' );
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
				'label' => esc_html__( 'Contents', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'image-card-style',
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
				],
			]
		);


        $this->add_control(
        	'card_title',
        	[
        		'label'       => esc_html__( 'Card Title', 'rtelements' ),
        		'type'        => Controls_Manager::TEXT,
        		'label_block' => true,
        		'default'   => 'Card Title',    		
        		'separator'   => 'before',    		
        	]
        );
        $this->add_control(
        	'card_subtitle',
        	[
        		'label'       => esc_html__( 'Card Sub Title', 'rtelements' ),
        		'type'        => Controls_Manager::TEXT,
        		'label_block' => true,
        		'default'   => 'Card Sub Title',     		
        		'separator'   => 'before',      		
				]
			);
			$this->add_control(
				'card_btn_text',
				[
				'label'       => esc_html__( 'Card Button Text', 'rtelements' ),
				'type'        => Controls_Manager::TEXT,
				'default'   => 'Button',     		
        		'label_block' => true,
        		'separator'   => 'before',        		
        	]
        );


        $this->add_control(
            'card_link',
            [
                'label' => esc_html__('Button Link', 'rtelements'),
                'type' => Controls_Manager::URL,                
            ]
        ); 

		$this->add_control(
			'card_image',
			[
				'label' => esc_html__( 'Card Image', 'rtelements' ),
				'type'  => Controls_Manager::MEDIA,				
				'separator' => 'before',
				'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

			]
		);

		$this->end_controls_section();



        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__( 'Slider Style', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-image--card .contents .title' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Title Typography', 'rtelements' ),
				'name' => 'title__typography',
				'selector' => '{{WRAPPER}} .rt-image--card .contents .title',
			]
		);

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-image--card .sub--title' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Subtitle Typography', 'rtelements' ),
				'name' => 'subtitle__typography',
				'selector' => '{{WRAPPER}} .rt-image--card .sub--title',
			]
		);
        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Button Text Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-image--card .contents .shop-now-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__( 'Button Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-image--card .contents .shop-now-btn' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__( 'Button Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-image--card .contents .shop-now-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_bg_color',
            [
                'label' => esc_html__( 'Button Hover Background', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-image--card .contents .shop-now-btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Button Typography', 'rtelements' ),
				'name' => 'btn__typography',
				'selector' => '{{WRAPPER}} .rt-image--card .contents .shop-now-btn',
			]
		);

        $this->end_controls_section();


		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$placeholder = Utils::get_placeholder_image_src();

		$card_title = (!empty($settings['card_title'])) ? $settings['card_title'] : '';
		$card_subtitle = (!empty($settings['card_subtitle'])) ? $settings['card_subtitle'] : '';
		$card_btn_text = (!empty($settings['card_btn_text'])) ? $settings['card_btn_text'] : '';
		$card_link = (!empty($settings['card_link']['url'])) ? $settings['card_link']['url'] : '#';
		
		$imgId = $settings['card_image']['id'];
		if( !empty($imgId) ){
			$img_link = wp_get_attachment_image_src($imgId, 'large')[0];
		}else{
			$img_link = $placeholder;
		}

		if('style2' == $settings['image-card-style']){
			require plugin_dir_path(__FILE__)."/style2.php";
		} else if('style3' == $settings['image-card-style']){
			require plugin_dir_path(__FILE__)."/style3.php";
		} else if('style4' == $settings['image-card-style']){
			require plugin_dir_path(__FILE__)."/style4.php";
		} else if('style5' == $settings['image-card-style']){
			require plugin_dir_path(__FILE__)."/style5.php";
		} else if('style6' == $settings['image-card-style']){
			require plugin_dir_path(__FILE__)."/style6.php";
		} else{
			require plugin_dir_path(__FILE__)."/default-style.php";
		}

	}	
}