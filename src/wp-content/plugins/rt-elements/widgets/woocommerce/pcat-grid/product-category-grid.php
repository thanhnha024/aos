<?php
/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Product_Category_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rt-product-cat-grid';
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
		return __( 'RT Porduct Category Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-shopping-cart';
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
        return [ 'rsaddon_category' ];
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
		return [ 'product', 'list', 'category' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
    {
    	// Content Controls
        $this->start_controls_section(
            'rs_section_product_grid_settings',
            [
                'label' => esc_html__('Settings', 'rsaddon'),
            ]
        );

		$this->add_control(
			'pcat_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',
				],
			]
		);

        $this->add_control(
            'rs_product_grid_categories',
            [
				'label'       => esc_html__('Product Categories', 'rsaddon'),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     =>rselemetns_woocommerce_product_categories(),
            ]
        );

		$this->add_control(
			'pcat_item_text',
			[
				'label' => esc_html__( 'Item Text', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Items', 'rsaddon' ),
			]
		);
		$this->add_control(
			'pcat_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Items', 'rsaddon' ),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_product_grid_styles',
            [
                'label' => esc_html__('Styles', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'rt_category_typography',
				'selector' => '{{WRAPPER}} .rt-pcat-grid .product-item .pcat-single .pcat-info .pcat-title a',
			]
		);
        
        $this->add_control(
            'rt_category_name_color',
            [
                'label' => esc_html__('Category Name Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-pcat-grid .product-item .pcat-single .pcat-info .pcat-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rts-product-category-section .product-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'rt_category_count_color',
            [
                'label' => esc_html__('Category Count Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
				'separator'=>'after',
                'selectors' => [
                    '{{WRAPPER}} .rt-pcat-grid .product-item .pcat-single .pcat-info .pcat-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rtpcat2 .rts-product-category-section .product-item .contents .item-qnty' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rtpcat-style3 .product-item .contents .item-qnty' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'rt_category_boxes_border',
            [
                'label' => esc_html__('Boxes Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
				'separator'=>'after',
                'selectors' => [
                    '{{WRAPPER}} .rtpcat2 .rts-product-category-section .product-item' => 'border-color: {{VALUE}};',                    
                    '{{WRAPPER}} .rts-product-category-section .product-item' => 'border-color: {{VALUE}};',                    
                ],
            ]
        );



		
		$this->start_controls_tabs( '_tabs_category_' );
		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'pielements' ),
				
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'plugin-name' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .product-item',
				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'pielements' ),
            ]
        ); 
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => esc_html__( 'Background', 'plugin-name' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .product-item:hover',
			]
		);
		$this->add_control(
			'item_count_hover_color',
			[
				'label' => esc_html__( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-item:hover .contents .product-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .product-item:hover .contents .item-qnty' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs( '_tabs_category_' );
		

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $item_text      = $settings['pcat_item_text'];
        $item_text      = !empty($item_text) ? $item_text : '';
        $btn_text       = $settings['pcat_btn_text'];
        $btn_text       = !empty($btn_text) ? $btn_text : '';
        $style          = $settings['pcat_grid_style'];

        
        $unique          = rand(2012,35120);

        $all_pcat = rselemetns_woocommerce_product_categories();
        $pcats = $settings['rs_product_grid_categories'];
        // $pcats = array_reverse($pcats);

        // var_dump($pcats);

        ?>
                <?php
                    if($style){
                        require plugin_dir_path(__FILE__)."/style".$style.".php";
                    }else{
                        require plugin_dir_path(__FILE__)."/style1.php";
                    }
                ?>
        <?php 

    }
}