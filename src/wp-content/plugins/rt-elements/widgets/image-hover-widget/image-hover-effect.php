<?php
/**
 * Image hover widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Image_Hover_Effect_Widget extends \Elementor\Widget_Base {
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
        return 'rs-image-hover-effect';
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
        return esc_html__( 'RS Image Hover Effect', 'rsaddon' );
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
        return 'glyph-icon flaticon-image';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_image_content',
            [
                'label' => esc_html__( 'Image Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 

        $this->add_control(
            'hover_effect_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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
                ]
            ]
        );

        $this->add_control(
            'rs_image_effect',
            [
                'label'         => __('Effect', 'rsaddon'),
                'label_block'   => true,
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'default'                                  => esc_html__('Default', 'rsaddon'),
                    'rs-image-fade'                     => esc_html__('Fade', 'rsaddon'),
                    'rs-image-fade-in-up'               => esc_html__('Fade In Up', 'rsaddon'),
                    'rs-image-fade-in-down'             => esc_html__('Fade In Down', 'rsaddon'),
                    'rs-image-fade-in-left'             => esc_html__('Fade In Left', 'rsaddon'),
                    'rs-image-fade-in-right'            => esc_html__('Fade In Right', 'rsaddon'),
                    'rs-image-slide-up'                 => esc_html__('Slide Up', 'rsaddon'),
                    'rs-image-slide-down'               => esc_html__('Slide Down', 'rsaddon'),
                    'rs-image-slide-left'               => esc_html__('Slide Left', 'rsaddon'),
                    'rs-image-slide-right'              => esc_html__('Slide Right', 'rsaddon'),
                    'rs-image-reveal-up'                => esc_html__('Reveal Up', 'rsaddon'),
                    'rs-image-reveal-down'              => esc_html__('Reveal Down', 'rsaddon'),
                    'rs-image-reveal-left'              => esc_html__('Reveal Left', 'rsaddon'),
                    'rs-image-reveal-right'             => esc_html__('Reveal Right', 'rsaddon'),
                    'rs-image-push-up'                  => esc_html__('Push Up', 'rsaddon'),
                    'rs-image-push-down'                => esc_html__('Push Down', 'rsaddon'),
                    'rs-image-push-left'                => esc_html__('Push Left', 'rsaddon'),
                    'rs-image-push-right'               => esc_html__('Push Right', 'rsaddon'),
                    'rs-image-hinge-up'                 => esc_html__('Hinge Up', 'rsaddon'),
                    'rs-image-hinge-down'               => esc_html__('Hinge Down', 'rsaddon'),
                    'rs-image-hinge-left'               => esc_html__('Hinge Left', 'rsaddon'),
                    'rs-image-hinge-right'              => esc_html__('Hinge Right', 'rsaddon'),
                    'rs-image-flip-horiz'               => esc_html__('Flip Horizontal', 'rsaddon'),
                    'rs-image-flip-vert'                => esc_html__('Flip Vertical', 'rsaddon'),
                    'rs-image-flip-diag-1'              => esc_html__('Flip Crosss 1', 'rsaddon'),
                    'rs-image-flip-diag-2'              => esc_html__('Flip Crosss 2', 'rsaddon'),
                    'rs-image-shutter-out-horiz'        => esc_html__('Shutter Out Horizontal', 'rsaddon'),
                    'rs-image-shutter-out-vert'         => esc_html__('Shutter Out Vertical', 'rsaddon'),
                    'rs-image-shutter-out-diag-1'       => esc_html__('Shutter Out Crosss 1', 'rsaddon'),
                    'rs-image-shutter-out-diag-2'       => esc_html__('Shutter Out Crosss 2', 'rsaddon'),
                    'rs-image-shutter-in-horiz'         => esc_html__('Shutter In Horizontal', 'rsaddon'),
                    'rs-image-shutter-in-vert'          => esc_html__('Shutter In Vertical', 'rsaddon'),
                    'rs-image-shutter-in-out-horiz'     => esc_html__('Shutter In Out Horizontal', 'rsaddon'),
                    'rs-image-shutter-in-out-vert'      => esc_html__('Shutter In Out Vertical', 'rsaddon'),
                    'rs-image-shutter-in-out-diag-1'    => esc_html__('Shutter In Out Crosss 1', 'rsaddon'),
                    'rs-image-shutter-in-out-diag-2'    => esc_html__('Shutter In Out Crosss 2', 'rsaddon'),
                    'rs-image-fold-up'                  => esc_html__('Fold Up', 'rsaddon'),
                    'rs-image-fold-down'                => esc_html__('Fold Down', 'rsaddon'),
                    'rs-image-fold-left'                => esc_html__('Fold Left', 'rsaddon'),
                    'rs-image-fold-right'               => esc_html__('Fold Right', 'rsaddon'),
                    'rs-image-zoom-in'                  => esc_html__('Zoom In', 'rsaddon'),
                    'rs-image-zoom-out'                 => esc_html__('Zoom Out', 'rsaddon'),
                    'rs-image-zoom-out-up'              => esc_html__('Zoom Out Up', 'rsaddon'),
                    'rs-image-zoom-out-down'            => esc_html__('Zoom Out Down', 'rsaddon'),
                    'rs-image-zoom-out-left'            => esc_html__('Zoom Out Left', 'rsaddon'),
                    'rs-image-zoom-out-right'           => esc_html__('Zoom Out Right', 'rsaddon'),
                    'rs-image-zoom-out-flip-vert'       => esc_html__('Zoom Out Flip Vertical', 'rsaddon'),
                    'rs-image-zoom-out-flip-horiz'      => esc_html__('Zoom Out Flip Horizontal', 'rsaddon'),
                    'rs-image-blur'                     => esc_html__('Blur', 'rsaddon'),
                    'rs-image-move-left'                => esc_html__('Image Move Left', 'rsaddon'),
                    'rs-image-move-right'               => esc_html__('Image Move Right', 'rsaddon'),
                    'rs-image-move-top'                 => esc_html__('Image Move Top', 'rsaddon'),
                    'rs-image-move-bottom'              => esc_html__('Image Move Bottom', 'rsaddon'),
                    'rs-image-top-down'                 => esc_html__('Image Scroll Top To Down', 'rsaddon'),
                ],
                'default'       => 'default',
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
            ]
        );

        $this->add_responsive_control(
            'image_transition',
            [
                'label' => esc_html__( 'Transition', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.10,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image-hover-effect .image-part img' => 'transition: {{SIZE}}s;',
                    '{{WRAPPER}} .rs-image-hover-effect .image-overlay' => 'transition: {{SIZE}}s;',
                    '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'transition: {{SIZE}}s;',
                ],
            ]
        ); 
            

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_content',
            [
                'label' => esc_html__( 'Image Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 

            $this->add_control(
                'show_image_content',
                [
                    'label'        => esc_html__( 'Show Content', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_responsive_control(
                'align',
                [
                    'label' => esc_html__( 'Text Alignment', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-prefix' => 'text-align: {{VALUE}}',
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .description-text' => 'text-align: {{VALUE}}'
                    ],
                    'default'   => 'left',
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'rs_image_align',
                [
                    'label'   => esc_html__('Horizontal Alignment', 'rsaddon'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'=> [
                            'title' => esc_html__('Left', 'rsaddon'),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center'    => [
                            'title' => esc_html__('Center', 'rsaddon'),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'flex-end'  => [
                            'title' => esc_html__('Right', 'rsaddon'),
                            'icon'  => 'eicon-text-align-right',
                        ]
                    ],
                    'default'   => 'flex-start',
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'align-items: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'rs_image_vertical_align',
                [
                    'label'   => esc_html__('Vertical Alignment', 'rsaddon'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start'=> [
                            'title' => esc_html__('Top', 'rsaddon'),
                            'icon'  => 'eicon-v-align-top',
                        ],
                        'center'    => [
                            'title' => esc_html__('Middle', 'rsaddon'),
                            'icon'  => 'eicon-v-align-middle',
                        ],
                        'flex-end'  => [
                            'title' => esc_html__('Bottom', 'rsaddon'),
                            'icon'  => 'eicon-v-align-bottom',
                        ]
                    ],
                    'default'   => 'flex-end',
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'justify-content: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_title',
                [
                    'label'       => esc_html__( 'Image Title', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'Image Title',
                    'placeholder' => esc_html__( 'Image Title', 'rsaddon' ),
                    'separator'   => 'before',

                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}}  .rs-image-hover-effect .image-content .title-part .image-title-part .image-title',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_title_link',
                [
                    'label'       => esc_html__( ' Title Link', 'rsaddon' ),
                    'type'        => Controls_Manager::URL,
                    'label_block' => true, 

                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_title_tag',
                [
                    'label' => esc_html__( 'Title HTML Tag', 'rsaddon' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'h1'  => [
                            'title' => esc_html__( 'H1', 'rsaddon' ),
                            'icon' => 'eicon-editor-h1'
                        ],
                        'h2'  => [
                            'title' => esc_html__( 'H2', 'rsaddon' ),
                            'icon' => 'eicon-editor-h2'
                        ],
                        'h3'  => [
                            'title' => esc_html__( 'H3', 'rsaddon' ),
                            'icon' => 'eicon-editor-h3'
                        ],
                        'h4'  => [
                            'title' => esc_html__( 'H4', 'rsaddon' ),
                            'icon' => 'eicon-editor-h4'
                        ],
                        'h5'  => [
                            'title' => esc_html__( 'H5', 'rsaddon' ),
                            'icon' => 'eicon-editor-h5'
                        ],
                        'h6'  => [
                            'title' => esc_html__( 'H6', 'rsaddon' ),
                            'icon' => 'eicon-editor-h6'
                        ]
                    ],
                    'default' => 'h2',
                    'toggle' => false,

                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'show_prefix',
                [
                    'label'        => esc_html__( 'Show Prefix', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',

                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_title_prefix',
                [
                    'label'       => esc_html__( 'Title Prefix', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'Prefix',
                    'placeholder' => esc_html__( 'Prefix', 'rsaddon' ),
                    'separator'   => 'before',

                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_prefix_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .prefix-part .title-prefix',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_description_text',
                [
                    'label' => esc_html__( 'Description Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,              
                    'default' => esc_html__( '', 'rsaddon' ),
                    'separator' => 'before',

                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_description_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .description-part .description-text',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_btn_part',
                [
                    'label' => esc_html__( 'Button Part', 'rsaddon' ),
                    'type'  => Controls_Manager::HEADING,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_btn_text',
                [
                    'label'       => esc_html__( 'Button Text', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => '',
                    'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
                    'separator'   => 'before',
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'btn_link',
                [
                    'label'       => esc_html__( ' Button Link', 'rsaddon' ),
                    'type'        => Controls_Manager::URL,
                    'label_block' => true, 
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],                     
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'image_btn_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'show_btn_icon',
                [
                    'label'        => esc_html__( 'Show Icon', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'btn_icon',
                [
                    'label'     => esc_html__( 'Icon', 'rsaddon' ),
                    'type'      => Controls_Manager::ICON,
                    'options'   => rsaddon_pro_get_icons(),             
                    'default'   => 'fa fa-angle-right',
                    'separator' => 'before',

                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],              
                ]
            );

            $this->add_control(
                'image_btn_icon_position',
                [
                    'label' => esc_html__( 'Icon Position', 'rsaddon' ),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'options' => [
                        'before' => [
                            'title' => esc_html__( 'Before', 'rsaddon' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'after' => [
                            'title' => esc_html__( 'After', 'rsaddon' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'after',
                    'toggle' => false,
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],
                ]
            ); 

            $this->add_control(
                'btn_icon_spacing',
                [
                    'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10
                    ],
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'btn_hover_icon_spacing',
                [
                    'label' => esc_html__( 'Icon Spacing in Hover', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15
                    ],
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-before:hover i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-after:hover i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            

        $this->end_controls_section();

        $this->start_controls_section(
            'image_normal_effect',
            [
                'label' => esc_html__( 'Image Effect in Normal', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-part img',
                ]
            );

            $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-part img, {{WRAPPER}} .rs-image-hover-effect .image-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-part img',
                ]
            );            

            $this->add_control(
                'image_overlay',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_overlay_enable',
                [
                    'label'        => esc_html__( 'Overlay', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'image_overlay_color',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-overlay',
                    'condition' => [
                        'image_overlay_enable' => 'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_overlay_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'image_overlay_enable' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'image_opacity',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Opacity', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_opacity_enable',
                [
                    'label'        => esc_html__( 'Opacity', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_responsive_control(
                'image_opacity_range',
                [
                    'label' => esc_html__( 'Opacity in Normal', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-part img' => 'opacity: {{SIZE}};',
                    ],
                    'condition' => [
                        'image_opacity_enable' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'image_blur',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Blur', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_blur_enable',
                [
                    'label'        => esc_html__( 'Blur', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_responsive_control(
                'image_blur_range',
                [
                    'label' => esc_html__( 'Blur in Normal', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-part img' => 'filter: blur({{SIZE}}{{UNIT}});',
                    ],
                    'condition' => [
                        'image_blur_enable' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'image_zoom',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Zoom', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_zoom_enable',
                [
                    'label'        => esc_html__( 'Zoom', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_responsive_control(
                'image_zoom_range',
                [
                    'label' => esc_html__( 'Zoom in Normal', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-part img' => 'transform: scale({{SIZE}});',
                    ],
                    'condition' => [
                        'image_zoom_enable' => 'yes'
                    ],
                ]
            );
            

        $this->end_controls_section();

        $this->start_controls_section(
            'image_hover_effect',
            [
                'label' => esc_html__( 'Image Effect in Hover', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'image_border_hover',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect:hover .image-part img',
                ]
            );

            $this->add_responsive_control(
                'image_border_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-part img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect:hover .image-part img',
                ]
            );

            $this->add_control(
                'image_overlay_hover',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'image_overlay_enable_hover',
                [
                    'label'        => esc_html__( 'Overlay', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'image_overlay_color_hover',
                    'label' => esc_html__( 'Overlay', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect:hover .image-overlay',
                    'condition' => [
                        'image_overlay_enable_hover' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_overlay_border_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'image_overlay_enable_hover' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'image_opacity_hover',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Opacity', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_opacity_enable_hover',
                [
                    'label'        => esc_html__( 'Opacity', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_responsive_control(
                'image_opacity_range_hover',
                [
                    'label' => esc_html__( 'Opacity in Hover', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-part img' => 'opacity: {{SIZE}};',
                    ],
                    'condition' => [
                        'image_opacity_enable_hover' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'image_blur_hover',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Blur', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_blur_enable_hover',
                [
                    'label'        => esc_html__( 'Blur', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_responsive_control(
                'image_blur_range_hover',
                [
                    'label' => esc_html__( 'Blur in Hover', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-part img' => 'filter: blur({{SIZE}}{{UNIT}});',
                    ],
                    'condition' => [
                        'image_blur_enable_hover' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'image_zoom_hover',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image Zoom', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'image_zoom_enable_hover',
                [
                    'label'        => esc_html__( 'Zoom', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Enable', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Disable', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => '',
                ]
            );

            $this->add_responsive_control(
                'image_zoom_range_hover',
                [
                    'label' => esc_html__( 'Zoom in Hover', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-part img' => 'transform: scale({{SIZE}});',
                    ],
                    'condition' => [
                        'image_zoom_enable_hover' => 'yes'
                    ],
                ]
            );
            

        $this->end_controls_section();

        $this->start_controls_section(
            'content_normal_effect',
            [
                'label' => esc_html__( 'Content Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image_content' => 'yes',
                ],
            ]
        );

            $this->add_responsive_control(
                'content_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_bg',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content'
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content ',
                ]
            );

            $this->add_responsive_control(
                'content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'content_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content ',
                ]
            );

            $this->add_control(
                'image_title_prefix_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Title Prefix', 'rsaddon' ),
                    'separator' => 'before',
                    'condition' => [
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'title_prefix_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .prefix-part .title-prefix' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'title_hover_prefix_color',
                [
                    'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-content .title-part .prefix-part .title-prefix' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'title_prefix_spacing',
                [
                    'label' => esc_html__( 'Prefix Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .prefix-part .title-prefix' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_title_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Title', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .image-title-part .image-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'title_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-content .title-part .image-title-part .image-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'title_spacing',
                [
                    'label' => esc_html__( 'Title Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .image-title-part .image-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_description_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Description', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .description-part .description-text' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'description_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-content .description-part .description-text' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'description_spacing',
                [
                    'label' => esc_html__( 'Description Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .description-part .description-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_button_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Button', 'rsaddon' ),
                    'separator' => 'before',
                    'condition' => [
                        'image_btn_text!' => '',
                    ],
                ]
            );
            

            $this->start_controls_tabs( 'normal_image_btn_tabs' );

                $this->start_controls_tab(
                    'image_normal_btn_tabs_normal',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                        'condition' => [
                            'image_btn_text!' => '',
                        ],
                    ]                    
                );

                $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'rsaddon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_bg',
                            'label' => esc_html__( 'Background', 'rsaddon' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow',
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'normal_button_border_transition',
                        [
                            'label' => esc_html__( 'Transition', 'rsaddon' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0.10,
                                    'max' => 1,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn, 
                                {{WRAPPER}}  .rs-image-hover-effect .image-content .button-part .image-btn i' => 'transition: {{SIZE}}s;',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );
                    

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'image_normal_btn_tabs_hover',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                        'condition' => [
                            'image_btn_text!' => '',
                        ],
                    ]
                );

                    $this->add_control(
                        'normal_button_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'normal_button_padding_hover',
                        [
                            'label' => esc_html__( 'Padding', 'rsaddon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'normal_button_bg_hover',
                            'label' => esc_html__( 'Background', 'rsaddon' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover',
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'normal_button_border_hover',
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover',
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'normal_button_border_radius_hover',
                        [
                            'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'normal_button_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover',
                            'condition' => [
                                'image_btn_text!' => '',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_normal_effect_hover',
            [
                'label' => esc_html__( 'Content in Hover', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image_content_hover' => 'yes',
                ],
            ]
        );           
            

        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

            
            $this->add_inline_editing_attributes( 'image_title', 'basic' );
            $this->add_render_attribute( 'image_title', 'class', 'image-title' );

            $this->add_inline_editing_attributes( 'image_title_hover', 'basic' );
            $this->add_render_attribute( 'image_title_hover', 'class', 'image-title' );

            $this->add_inline_editing_attributes( 'image_title_prefix', 'basic' );
            $this->add_render_attribute( 'image_title_prefix', 'class', 'title-prefix' );

            $this->add_inline_editing_attributes( 'image_title_prefix_hover', 'basic' );
            $this->add_render_attribute( 'image_title_prefix_hover', 'class', 'title-prefix' );

            $this->add_inline_editing_attributes( 'image_description_text', 'basic' );
            $this->add_render_attribute( 'image_description_text', 'class', 'description-text' );

            $this->add_inline_editing_attributes( 'image_description_text_hover', 'basic' );
            $this->add_render_attribute( 'image_description_text_hover', 'class', 'description-text' );

            $this->add_inline_editing_attributes( 'image_btn_text', 'basic' );
            $this->add_render_attribute( 'image_btn_text', 'class', 'btn-text' );

            $this->add_inline_editing_attributes( 'image_btn_text_hover', 'basic' );
            $this->add_render_attribute( 'image_btn_text_hover', 'class', 'btn-text' );
        ?>

        <div class="rs-image-hover-effect">
       
                   

            <div class="animation-effect <?php echo esc_html( $settings['rs_image_effect'] );?>">
                <?php if((!empty($settings['image_overlay_enable'])) || (!empty($settings['image_overlay_enable_hover']))) : ?>
                    <div class="image-overlay"></div>
                <?php endif; ?>
                        
                <div class="image-part">
                    <?php if(!empty($settings['hover_effect_image']['id'])) : 

                        echo wp_get_attachment_image( $settings['hover_effect_image']['id'], $settings['thumbnail_size'] );?> 

                        <?php else: ?>
                            <img src="<?php echo esc_url( $settings['hover_effect_image']['url'] );?>" alt="image"/>
                    <?php endif; ?>
                </div>
                <?php if(!empty($settings['show_image_content'])) : ?>
                    <div class="image-content">
                        <?php if(!empty($settings['image_title'])){ ?>
                            <div class="title-part">
                                <?php if((!empty($settings['image_title_prefix']))) { ?>
                                    <div class="prefix-part">
                                        <div <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_title_prefix' )); ?>> <?php echo esc_html($settings['image_title_prefix']);?> </div>
                                    </div>
                                <?php } ?>                            
                                <div class="image-title-part">
                                    <<?php echo esc_html($settings['image_title_tag']);?>  <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_title' )); ?>> <a href="<?php echo esc_url($settings['image_title_link']['url']);?>" > <?php echo esc_html($settings['image_title']);?></a></<?php echo esc_html($settings['image_title_tag']);?>>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if(!empty($settings['image_description_text'])){ ?>
                                <div class="description-part">
                                    <div <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_description_text' )); ?>> <?php echo wp_kses_post($settings['image_description_text']);?> </div>
                                </div>
                            <?php } ?>

                            <?php if(!empty($settings['image_btn_text'])){ ?>
                                <div class="button-part">
                                    <?php 
                                        $btn_icon_position = $settings['image_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                    ?>
                                    <a class="image-btn <?php echo esc_html($btn_icon_position); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_btn_text' )); ?>>             
                                        <span <?php echo wp_kses_post($this->print_render_attribute_string('image_btn_text'));?>><?php echo esc_html($settings['image_btn_text']);?></span>
                                        <?php if(!empty($settings['btn_icon'])) : ?>
                                            <i class="fa <?php echo esc_html($settings['btn_icon']);?>"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php } ?>
                    </div>                   
                <?php endif; ?>
            </div>
        </div>        
    <?php
    }
}