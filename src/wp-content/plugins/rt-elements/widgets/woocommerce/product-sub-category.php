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

class Rsaddon_Elementor_Pro_Product_Sub_Category_Widget extends \Elementor\Widget_Base {

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
		return 'rt-product-sub-cat';
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
		return __( 'RT Porduct Sub Category', 'rsaddon' );
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

        
        $this->add_control(
            'rt_category_name_color',
            [
                'label' => esc_html__('Category Name Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-pcat-grid .product-item .pcat-single .pcat-info .pcat-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'rt_category_count_color',
            [
                'label' => esc_html__('Category Count Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-pcat-grid .product-item .pcat-single .pcat-info .pcat-count' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $item_text       = $settings['pcat_item_text'];
        $item_text       = !empty($item_text) ? $item_text : '';
        $btn_text       = $settings['pcat_btn_text'];
        $btn_text       = !empty($btn_text) ? $btn_text : '';

        
        $unique          = rand(2012,35120);

        $all_pcat = rselemetns_woocommerce_product_categories();
        $pcats = $settings['rs_product_grid_categories'];

        ?>
<div class="rt-psubcat">
    <div class="row">


                <?php
                foreach($pcats as $pcat ) {
                    $catObj = get_term_by('slug', $pcat, 'product_cat');
                    $term_id = $catObj->term_id;

                    $pchild = get_categories( array( 'parent' => $term_id ) );


                    $children = get_terms( 'product_cat', array(
                        'parent'    => $term_id,
                        'hide_empty' => false
                    ) );

                    // get the thumbnail id using the category term_id
                    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                    $pcat_image = wp_get_attachment_image_src($thumbnail_id, 'large')[0];

                    // $icon_id = get_term_meta( $term_id, 'rt_pcat_icon_id', true );
                    // if( $icon_id ){
                    //     $pcat_icon = wp_get_attachment_image_src($icon_id, 'large')[0];
                    // }

                    $pcat_bg = get_term_meta( $term_id, 'pcat_grid_bg', true );
                    if( !(empty($pcat_bg)) ){
                        $pcat_single_bg = 'style="background-color: '.$pcat_bg.';"';
                    }else{
                        $pcat_single_bg = '';
                    }
                    $pcat_btnc = get_term_meta( $term_id, 'pcat_grid_btn_color', true );
                    if( !(empty($pcat_btnc)) ){
                        $cta_btn_color = 'style="color: '.$pcat_btnc.';"';
                        $cta_btn_hover_bg = 'style="background-color: '.$pcat_btnc.';"';
                    }else{
                        $cta_btn_color = '';
                        $cta_btn_hover_bg = '';
                    }

                    $name   = $catObj->name;
                    $desc   = $catObj->description;
                    $count  = $catObj->count;
                    $img    = $catObj->name;
                    $pcat_link = get_term_link( $pcat, 'product_cat' );
                    ?>
                    <div class="col-lg-3">
                        <div class="psubcat-single d-flex flex-column justify-content-between">
                            <div class="info-content">

                                <h4 class="pcat-titlle"><?php echo $name; ?></h4>
                                <ul class="subcat-list">
                                    <?php 
                                    if ( $children ) { 
                                        foreach( $children as $subcat ){
                                            echo '<li><a href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . '</a></li>';
                                        }
                                    }                            
                                    ?>
                                </ul>
                                <div class="all-cat-btn">
                                    <a href="#">
                                        <button><?php echo 'All '.$name; ?> <i aria-hidden="true" class="rt rt-arrow-right-long"></i></button>
                                    </a>
                                </div>

                            </div>

                            <div class="cat-thumb">
                                    <a href="<?php echo esc_url($pcat_link) ; ?>">
                                        <img class="cat-image" src="<?php echo esc_url($pcat_image) ; ?>" alt="Product Categories">
                                    </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>



</div>
</div>

        

        <?php 

    }
}


