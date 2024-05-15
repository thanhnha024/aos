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

class Rsaddon_Elementor_Pro_Product_Category_Widget extends \Elementor\Widget_Base {

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
		return 'rs-product-category';
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
		return __( 'RT Porduct Category', 'rsaddon' );
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
            'rt_slider_style',
            [
                'label'   => esc_html__( 'Select Style', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [					
                    'style1' => esc_html__( 'Style 1', 'rtelements'),
                    'style2' => esc_html__( 'Style 2', 'rtelements'),
                ],
            ]
        );

        $this->end_controls_section();

                $this->start_controls_section(
                    'content_slider',
                    [
                        'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                        'tab' => Controls_Manager::TAB_CONTENT,
                    ]
                );

            
                $this->add_control(
                    'col_xl',
                    [
                        'label'   => esc_html__( 'Wide Screen > 1399px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '4.5' => esc_html__( '4.5 Column', 'rsaddon' ),
                            '5' => esc_html__( '5 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_lg',
                    [
                        'label'   => esc_html__( 'Desktops > 1199px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '4.5' => esc_html__( '4.5 Column', 'rsaddon' ),
                            '5' => esc_html__( '5 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_md',
                    [
                        'label'   => esc_html__( 'Laptop > 991px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                     
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_sm',
                    [
                        'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 2,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_xs',
                    [
                        'label'   => esc_html__( 'Tablets < 768px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 1,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slides_ToScroll',
                    [
                        'label'   => esc_html__( 'Slide To Scroll', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 2,         
                        'options' => [
                            '1' => esc_html__( '1 Item', 'rsaddon' ),
                            '2' => esc_html__( '2 Item', 'rsaddon' ),
                            '3' => esc_html__( '3 Item', 'rsaddon' ),
                            '4' => esc_html__( '4 Item', 'rsaddon' ),                   
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );      

                $this->add_control(
                    'slider_dots',
                    [
                        'label'   => esc_html__( 'Navigation Dots', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_nav',
                    [
                        'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',           
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'pcat_prev_text',
                    [
                        'label' => esc_html__( 'Previous Text', 'rsaddon' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Previous', 'rsaddon' ),
                        'placeholder' => esc_html__( 'Type your title here', 'rsaddon' ),
                        'condition' => [
                            'slider_nav' => 'true',
                        ],
                    ]
                );
                $this->add_control(
                    'pcat_next_text',
                    [
                        'label' => esc_html__( 'Next Text', 'rsaddon' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Next', 'rsaddon' ),
                        'placeholder' => esc_html__( 'Type your title here', 'rsaddon' ),
                        'condition' => [
                            'slider_nav' => 'true',
                        ],

                    ]
                );

                $this->add_control(
                    'slider_autoplay',
                    [
                        'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',           
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_autoplay_speed',
                    [
                        'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3000,          
                        'options' => [
                            '1000' => esc_html__( '1 Seconds', 'rsaddon' ),
                            '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                            '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                            '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                            '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_interval',
                    [
                        'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3000,          
                        'options' => [
                            '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                            '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                            '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                            '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                            '1000' => esc_html__( '1 Seconds', 'rsaddon' ),     
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_loop',
                    [
                        'label'   => esc_html__( 'Loop', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_centerMode',
                    [
                        'label'   => esc_html__( 'Center Mode', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'item_gap_custom',
                    [
                        'label' => esc_html__( 'Item Gap', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'show_label' => true,               
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
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
                    '{{WRAPPER}} .rt-product--category .pcat-single .pcat-info .pcat-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rt_category_name_bg',
            [
                'label' => esc_html__('Category Name Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-product--category .pcat-single .pcat-info .pcat-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rt_category_count_color',
            [
                'label' => esc_html__('Category Count Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-product--category .pcat-single .pcat-info .pcat-count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rt_category_count_bg',
            [
                'label' => esc_html__('Category Count Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-product--category .pcat-single .pcat-info .pcat-count' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $col_xl          = $settings['col_xl'];
        $col_xl          = !empty($col_xl) ? $col_xl : 3;
        $slidesToShow    = $col_xl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval        = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        // $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';

        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $item_text       = $settings['pcat_item_text'];
        $item_text       = !empty($item_text) ? $item_text : '';
        $item_gap        = $settings['item_gap_custom']['size'];
        $item_gap        = !empty($item_gap) ? $item_gap : '30';
        $prev_text       = $settings['pcat_prev_text'];
        $prev_text       = !empty($prev_text) ? $prev_text : '';
        $next_text       = $settings['pcat_next_text'];
        $next_text       = !empty($next_text) ? $next_text : '';
        $unique = rand(2012,35120);

        $all_pcat = rselemetns_woocommerce_product_categories();
        $pcats = $settings['rs_product_grid_categories'];
        $sstyle = $settings['rt_slider_style'];
        ?>

        <div class="rsaddon-unique-slider rt-product--category rtpc-<?php echo esc_attr($sstyle); ?>">
            <div class="swiper mySwiper-<?php echo esc_attr($unique); ?> rt_widget_sliders">
      			<div class="swiper-wrapper">

                <?php
                foreach($pcats as $pcat ) {
                    $catObj = get_term_by('slug', $pcat, 'product_cat');
                    $term_id = $catObj->term_id;
                    // get the thumbnail id using the category term_id
                    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true ); 
                    // get the image URL
                    $pcat_image = wp_get_attachment_image_src($thumbnail_id, 'large')[0];

                    $name = $catObj->name;
                    $count = $catObj->count;
                    $desc  = $catObj->description;
                    $img = $catObj->name;
                    $pcat_link = get_term_link( $pcat, 'product_cat' );

                    if($sstyle){
                        require plugin_dir_path(__FILE__)."/$sstyle.php";
                    }else{
                        require plugin_dir_path(__FILE__)."/style1.php";
                    }
                }
                ?>

        </div>
        <?php
            if( $sliderDots == 'true' ) echo '<div class="swiper-pagination bg-primary"></div>';

            if( $sliderNav == 'true' ){
                echo '<div class="product-cat-next">'. $next_text .'</div><div class="product-cat-prev">'. $prev_text .'</div>';
            } 
        ?>

    </div>
    	</div>
        <script type="text/javascript"> 
            jQuery(document).ready(function(){
                jQuery( '.rt_widget_sliders' ).each(function( index ) {        
                var swiper = new Swiper(".mySwiper-<?php echo esc_attr($unique); ?>", {				
                    slidesPerView: 1,
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    slidesPerGroup: 1,
                    loop: <?php echo esc_attr($infinite ); ?>,
                    autoplay: <?php echo esc_attr($slider_autoplay); ?>,
                    autoplay: {
                        delay: <?php echo esc_attr($interval); ?>,
                    },
                    disableOnInteraction: true,
                    spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    navigation: {
                        nextEl: ".product-cat-next",
                        prevEl: ".product-cat-prev",
                    },
                    breakpoints: {
                        
                        <?php
                        echo (!empty($col_xs)) ?  '575: { slidesPerView: '. $col_xs .' },' : '';
                        echo (!empty($col_sm)) ?  '767: { slidesPerView: '. $col_sm .' },' : '';
                        echo (!empty($col_md)) ?  '991: { slidesPerView: '. $col_md .' },' : '';
                        echo (!empty($col_lg)) ?  '1199: { slidesPerView: '. $col_lg .' },' : '';
                        ?>
                        1399: {
                            slidesPerView: <?php echo esc_attr($col_xl); ?>,
                            spaceBetween:  <?php echo esc_attr($item_gap); ?>
                        }
                    }
                });
            });
        });
        </script>

        <?php 

    }
}