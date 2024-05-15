<?php
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class RTS_Topbar_Icon_List_Widget extends \Elementor\Widget_Base {

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
        return 'topbar-icon-list';
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
        return esc_html__( 'RT Icon list', 'rsaddon' );
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
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'header_footer_rts' ];
    }

    public function get_keywords() {
        return [ 'list', 'title', 'features', 'heading', 'plan' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);     

        $this->add_control(
            'field_type',
            [
                'label'        => __( 'Field Type', 'rtelements'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'default',
                'options'      => [
                    'default' => __( 'Default Icon box', 'rtelements'),
                    'mail'      => __( 'Mail Field', 'rtelements'),
                    'phone'      => __( 'Phone Field', 'rtelements'),
                   
                ],               
            ]
        );

        
        $this->add_control(
            'sub-text',
            [
                'label' => esc_html__( 'Sub Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Phone Number', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'        => __( 'Icon Type', 'rtelements'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'default',
                'options'      => [
                    'default' => __( 'Default Icon', 'rtelements'),
                    'theme'      => __( 'Theme Icon', 'rtelements'),                   
                   
                ],               
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],   
                
                'condition' =>[
                    'icon_type' =>  'default'
                ]
                
            ]
        );

        $this->add_control(
			'theme_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::SELECT2,
				'options' => rts_custom_get_icons(),				
				'default' => 'rt-angle-right',
				'separator' => 'before',
                'condition' =>[
                    'icon_type' =>  'theme'
                ]			
			]
		);

        

       
        $this->end_controls_section();


           
        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Sub Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-features-list-content ul li .sub-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .rt-features-list-content ul li .sub-text',
                'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
            ]
        );  

        $this->add_control(
            'more_options_title',
            [
                'label' => esc_html__( 'Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'title_text_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-features-list-content ul li .text-heading' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-features-list-content ul li .text-heading:hover' => 'color: {{VALUE}};',
                ],
                'condition' =>[
                    'field_type' => [ 'mail', 'phone']
                ]
            ]
        ); 


        

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_text_typography',
                'selector' => '{{WRAPPER}} .rt-features-list-content ul li .text-heading',
                'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
            ]
        );          
        

        $this->end_controls_section();       


        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-features-list-content ul li .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rt-features-list-content ul li .icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );    
        
        $this->add_control(
            'icon_width',
            [
                'label' => esc_html__( 'Icon Size', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .rt-features-list .icon svg' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}} ',
                    '{{WRAPPER}} .rt-features-list .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rt-features-list-content ul li .icon',
            ]
        );   

       

        
        $this->end_controls_section();
    }

  

	protected function render() {
        $settings = $this->get_settings_for_display();?> 

        <div class="rt-features-list-content">        

               
                    <ul class="rt-features-list">
                       
                            <li>
                                <?php if ( $settings['icon'] ) : ?>
                                    <div class="icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
                                    
                                <?php endif; ?>
                                <?php if ( $settings['theme_icon'] ) : ?>
                                    <div class="icon"><i class="<?php echo  $settings['theme_icon'];?>"></i></div>
                                    
                                <?php endif; ?>
                                <div class="query-list">

                                    <span class="sub-text"><?php echo wp_kses_post( $settings['sub-text'] ); ?></span>

                                    <?php if('mail' == $settings['field_type']) : ?>

                                        <a href="mailto:<?php echo esc_attr($settings['text']);?>"><span class="text-heading"><?php echo wp_kses_post( $settings['text'] ); ?></span></a>
                                   
                                    <?php elseif('phone' == $settings['field_type']) : ?>
                                        <a href="tel:<?php echo esc_attr(str_replace(" ","",($settings['text'])))?>"><span class="text-heading"><?php echo wp_kses_post( $settings['text'] ); ?></span></a>
                                   
                                        <?php else: ?>
                                        <span class="text-heading"><?php echo wp_kses_post( $settings['text'] ); ?></span>

                                    <?php endif; ?>
                                </div>
                                
                            </li>
                       
                    </ul>
                          
        </div>
        <?php
    }
}
