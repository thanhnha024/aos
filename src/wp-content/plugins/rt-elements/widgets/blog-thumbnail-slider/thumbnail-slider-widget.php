<?php
/**
 * Elementor rs Thumbnail Slider Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Pielemetns_Elementor_thumbnail_slider_Widget extends \Elementor\Widget_Base {

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
		return 'rsthumbnail-slider';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Post Thumbnail Slider', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-slider-1';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'pielements_category'];
    }

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {		

		$category_dropdown[0] = 'Select Category';
		
		$terms  = get_terms( array( 'taxonomy' => "category", 'fields' => 'id=>name' ) );		
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		} 


		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => [		
						
				]+ $category_dropdown,
				'multiple' => true,	
				'separator' => 'before',		
			]

		);
		


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Blog Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '6', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Category Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Blog Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_cat_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pi-thumbnail-slider .cat_list li a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ]                
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pi-thumbnail-slider .slider-content .blog-name a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pi-thumbnail-slider .slider-content .blog-name a:hover' => 'color: {{VALUE}};',
                ],                
            ]

            
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => 
                    '{{WRAPPER}} .pi-thumbnail-slider .slider-section .item .slider-content .blog-name a',
			]
		);

		$this->end_controls_section();

	

		$this->end_controls_tab();
		$this->end_controls_section();
		

	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();       
        $unique = rand(100,31120);

        ?>
			<div class="pi-blog-grid blog-grid pi-thumbnail-slider">
				<div id="piaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="slider-section sliderthumbnail">
				 	<?php 
				        $cat = $settings['category'];      
				

					    if(empty($cat)){
				        	$pi_query = new wp_Query(array(
				        			'post_type'      => 'post',
									'posts_per_page' => $settings['per_page'],				
							));	  
				        }   
				        else{
				        	$pi_query = new wp_Query(array(
				        			'post_type'      => 'post',
									'posts_per_page' => $settings['per_page'],
									'tax_query'      => array(
								        array(
											'taxonomy' => 'category',
											'field'    => 'term_id', 
											'terms'    => $cat 
								        ),
								    )
							));	  
				        }
					  
				        
						while($pi_query->have_posts()): $pi_query->the_post(); 

    						$full_date      = get_the_date();
    						$blog_date      = get_the_date('d M y');	
    						$post_admin     = get_the_author();    						
                            $categories     = get_the_category();                          
    						
    						if(!empty($settings['blog_word_show'])){
    							$limit = $settings['blog_word_show'];
    						}
    						else{
    							$limit = 20;
    						}
						?>                        
                        <div class="item">
                        	<div class="content-overlay">
	                            <a class="pointer-events" href="<?php the_permalink();?>">
	                                <?php the_post_thumbnail('husina_banners_size'); ?>
	                            </a>
	                            <div class="slider-content">
	                                <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
	                                    <ul class="cat_list">
	                                       <?php
	                                        foreach ($categories as $value) {
	                                            if ( ! empty( $value ) ) {
	                                                echo '<li><a href="' . esc_url( get_category_link( $value->term_id ) ) . '">' . esc_html( $value->name ) . '</a></li>';
	                                            }
	                                        }                                            
	                                       ?>
	                                    </ul>
	                                <?php } ?>

	                                <div class="blog-name"><a class="pointer-events" href="<?php the_permalink();?>"><?php the_title();?></a></div>
	                                <div class="slider-admin">          
	                                   <?php 
	                                   	$datetime1 = new DateTime( $full_date );
	                                   	$datetime2 = new DateTime(); // current date
	                                   	$interval = $datetime1->diff( $datetime2 );
	                                   	
	                                   ?>
	                                    <div class="blog-meta">
	                                    	<?php if(!empty(get_the_author_meta('nickname'))){
	                                    		echo $id =  get_the_author_meta('nickname');
	                                    	}else {
	                                    	 	if(!empty($post_admin)){ ?>
	                                    	
	                                        	<span class="admin"><i class="fa fa-user"></i> <?php echo esc_html($post_admin);?></span>
	                                        	<?php } 
	                                    	}
	                                    	echo ' - '. $interval->format( '%a days old' ); ?>
	                                    </div>                                   

	                                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
	                                        <span class="title"><a href="#"><i class="fa fa-user"></i>
	                                            <?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?> 
	                                        </a></span>
	                                    <?php } ?> 
	                                </div>
	                            </div> 
	                        </div>
                        </div>					
					<?php
					endwhile;
					wp_reset_query();?>
                </div>
                <div class="slider-nav-thumbnail">
                    <?php while($pi_query->have_posts()): $pi_query->the_post();?>                            
	                    <div class="item">
	                    	<div class="item-inner">
		                        <div class="image-thumb>"><?php the_post_thumbnail('husina_thumbnail_size'); ?></div>
		                        <div class="thum-title"><?php the_title(); ?></div>
		                    </div>
	                    </div>  
                    <?php endwhile;
                    wp_reset_query();?>
                </div>
			</div>
            <script type="text/javascript"> 
            jQuery(document).ready(function(){
            var sliderthumbnail = jQuery('.sliderthumbnail');
                if(sliderthumbnail.length){
                    jQuery('.sliderthumbnail').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        cssEase: 'ease-in-out',
                        fade: true,
                        asNavFor: '.slider-nav-thumbnail',
                    });
                }
                var slidernavthumbnail = jQuery('.slider-nav-thumbnail');
                if(slidernavthumbnail.length){
                    jQuery('.slider-nav-thumbnail').slick({
                        slidesToShow: 4,
                        asNavFor: '.sliderthumbnail',
                        dots: false,
                        arrows : false,
                        focusOnSelect: true,
                        centerMode:false,                        
                        responsive: [
                            {
                              breakpoint: 768,
                              settings: {
                                slidesToShow: 2
                              }
                            },
                            {
                              breakpoint: 591,
                              settings: {
                                slidesToShow: 2
                              }
                            }
                        ]
                    });
                }
            });
    </script>
		<?php

	}
}?>