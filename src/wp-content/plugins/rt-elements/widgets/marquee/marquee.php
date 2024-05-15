<?php
/**
 * Marquee widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Marquee_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *    
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rt-marquee';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RT Marquee', 'rtelements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Marquee Content', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Marquee Image', 'rtelements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Marquee Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'rtelements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'offer_name',
            [
                'label' => esc_html__('Offer Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Offer', 'rtelements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rtelements'),
                'type' => Controls_Manager::URL,                
            ]
        ); 

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
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
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => esc_html__( 'Style', 'rtelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        

        $this->add_control(
            'field_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-marquee .Marquee-tag h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'offer_color',
            [
                'label' => esc_html__( 'Offer Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-marquee .Marquee-tag h3 span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'marquee_bg',
            [
                'label' => esc_html__( 'Marquee Bg', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-marquee .Marquee-tag' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => esc_html__( 'Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .rt-marquee .Marquee-tag h3',
                'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_responsive_control(
			'space_between',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Marquee Width', 'plugin-name' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .rt-marquee .Marquee-tag' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'animation_speed',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Marquee Animation Delay', 'plugin-name' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .rt-marquee .Marquee-content' => 'animation: marquee {{SIZE}}s linear infinite running;',
				],
			]
		);

        $this->add_responsive_control(
            'field_padding_input',
            [
                'label' => esc_html__( 'Marquee Area Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-marquee .Marquee-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin_input',
            [
                'label' => esc_html__( 'Marquee Area Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-marquee .Marquee-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();


        if ( empty($settings['logo_list'] ) ) {
            return;
        }

        ?>

        <div class="rt-marquee">
            <div class="Marquee">
                <div class="Marquee-content">
                <?php
                    foreach ( $settings['logo_list'] as $index => $item ) :
                        $IMG_ID = $item['image']['id']; 
                        $size = $settings['thumbnail_size'];
                        if(!empty($IMG_ID)):
                            $image = wp_get_attachment_image_src($IMG_ID, $size )[0];
                        endif;
                        $title = !empty($item['name']) ? $item['name'] : '';
                        $offer_name = !empty($item['offer_name']) ? $item['offer_name'] : '';
                        $link = !empty($item['link']['url']) ? $item['link']['url'] : '';
                        $target = !empty($item['link']['is_external']) ? 'target=_blank' : '';  

                        ?>
                        <div class="Marquee-tag">
                            <h3 class="mb-0 me-5"><?php echo wp_kses_post($title);?><?php echo ' ';?><span><?php echo wp_kses_post($offer_name);?></span></h3>
                            <?php if (!empty($image) ) { ?>
                                <div class="marquee-image">
                                    <a href="<?php echo esc_url($link);?>">
                                        <img src="<?php echo esc_attr($image);?>" alt="Shop Now">
                                    </a>
                                </div>
                            <?php } ?>
                            
                        </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
<?php
    }
}