<?php
/**
 * Blockquote Widget
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Pro_Blockquote_Widget extends \Elementor\Widget_Base {

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
        return 'rsblockquote';
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
        return esc_html__( 'PI Blockquote', 'pielements' );
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
        return 'glyph-icon flaticon-ballot-box';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'blockquote',
            [
                'label' => esc_html__( 'Content', 'pielements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

          
            $this->add_control(
                'blockquote_icon',
                [
                    'label' => esc_html__( 'Icon', 'pielements' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-home',                  
                    'options' => rsaddon_pro_get_icons(),
                ]
            );                  

            $this->add_control(
                'block_content',
                [
                    'label'       => esc_html__( 'Blockquote Content', 'pielements' ),
                    'type'        => Controls_Manager::WYSIWYG,
                    'label_block' => true,
                    'default'     => esc_html__( 'Blockquote Description Here', 'pielements' ),
                ]
            );
            $this->add_control(
                'author_title',
                [
                    'label'       => esc_html__( 'Author', 'pielements' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => false,                    
                    'separator'   => 'before', 
                ]
            );         

        $this->end_controls_section();

        
        $this->start_controls_section(
            'blockquote_style',
            [
                'label' => esc_html__( 'Content', 'pielements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );           
        
        $this->add_control(
            'blockquote_icon_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Icon', 'pielements' ),
                'separator' => 'before',               
            ]
        );
        

        $this->add_control(
            'blockquote_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'pielements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pi-blockquote i.fa' => 'color: {{VALUE}};',
                ],
               
            ]
        );         


        $this->add_responsive_control(
            'blockquote_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'pielements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pi-blockquote i.fa' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'blockquote_icon_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'pielements' ),
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
                    '{{WRAPPER}} .pi-blockquote i.fa' => 'font-size: {{SIZE}}{{UNIT}};',
                ],            
            ]
        );    

       

        $this->add_control(
            'author_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'pielements' ),
                'separator' => 'before',
            ]
        );
            $this->add_control(
                'author_title_color',
                [
                    'label' => esc_html__( 'Title Color', 'pielements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pi-blockquote cite' => 'color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'pielements' ),
                    'selector' => '{{WRAPPER}} .pi-blockquote cite',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                ]
            );

            $this->add_responsive_control(
                'title_gap',
                [
                    'label' => esc_html__( 'Padding', 'pielements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pi-blockquote cite' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

           
            $this->add_control(
                'blockquote_desc_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Description', 'pielements' ),
                    'separator' => 'before',
                ]
            );

             $this->add_control(
                'blockquote_desc_color',
                [
                    'label' => esc_html__( 'Color', 'pielements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pi-blockquote blockquote' => 'color:{{VALUE}};',
                    ],
                ]
            ); 

            $this->add_control(
                'blockquote_desc_bg',
                [
                    'label' => esc_html__( 'Background', 'pielements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pi-blockquote blockquote' => 'background:{{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'blockquote_desc_typography',
                    'label' => esc_html__( 'Typography', 'pielements' ),
                    'selector' => '{{WRAPPER}} .pi-blockquote blockquote',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                ]
            );      
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'item_border',
                    'selector' => '{{WRAPPER}} .pi-blockquote blockquote',
                ]
            );

            $this->add_responsive_control(
                'description_gap',
                [
                    'label' => esc_html__( 'Padding', 'pielements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}}  .pi-blockquote blockquote p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_gap_margin',
                [
                    'label' => esc_html__( 'Margin', 'pielements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pi-blockquote blockquote ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );


        $this->end_controls_section();
    }
  
    protected function render() {
        $settings = $this->get_settings_for_display();       
       
        $bicon = !empty($settings['blockquote_icon']) ? '<i class="'.$settings['blockquote_icon'].'"></i>' : '';       
    
    ?>
    <div class="pi-blockquote">
       <blockquote><?php echo wp_kses_post($bicon); ?>
        <?php  echo wp_kses_post($settings['block_content']);?>
           <?php if(!empty($settings['author_title'])): ?>
                <cite><?php echo esc_html($settings['author_title']); ?></cite>
            <?php endif; ?>
        
       </blockquote>       
    </div>
    <?php
    }
}
