<?php
/**
 * Feature List
 *
 */

use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class ReacTheme_Portfolio_Features_List_Widget extends \Elementor\Widget_Base {


    public function get_name() {
        return 'rt-portfolio-featureslist';
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
        return esc_html__( 'RT Portfolio Features', 'rtelements' );
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
        return [ 'pielements_category' ];
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
        'show_category',
        [
            'label' => esc_html__( 'Show Catgegory', 'rtelements' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'rtelements' ),
            'label_off' => esc_html__( 'Hide', 'rtelements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );
        $this->add_control(
        'show_category_prefix',
        [
            'label' => esc_html__( 'Show Catgegory Title Text', 'rtelements' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Catgegory:', 'rtelements' ),
            'condition' => [
                'show_category' => 'yes',
            ],
        ]
    );
    



       
        $this->add_control(
            'live_preview',
            [
                'label' => esc_html__( 'Live Preview Text', 'rtelements'),
                'default' => esc_html__( 'Live Preview', 'rtelements' ),              
            ]
        );

        $this->add_control(
            'live_preview_link',
            [
                'label' => esc_html__( 'Live Preview Link', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '#', 'rtelements' ),              
            ]
        );

        $this->end_controls_section();
    }
  

	protected function render() {
        $settings = $this->get_settings_for_display();?> 

        <div class="rt-features-list-portfolio-content">
            <h5 class="pinfo--sidebar-title">Project Details</h5>     
                <?php if($settings['show_category'] == 'yes'){
                    $term_obj_list = get_the_terms( get_the_ID(), 'rt-portfolio-category' );
                    ?>
                    <ul class="category-info">
                        <li> <?php if(!empty($settings['show_category_prefix'])) : ?>
                        <b><?php echo $settings['show_category_prefix'].' ';?></b> <?php endif; ?>
                            <?php echo $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));?> </li>
                        
                    </ul>
               <?php }?>
                <?php if ( is_array( $settings['features_list'] ) ) : ?>
                    <ul class="rt-portfolio-features-list">
                    <?php
                    $pf_details = get_post_meta( get_the_ID(), 'pf_details', true );

                    foreach ( (array) $pf_details as $key => $entry ) {
                        $title = $desc = '';
                        if ( isset( $entry['pf_info_title'] ) ) {
                            $title = esc_html( $entry['pf_info_title'] );
                        }
                    
                        if ( isset( $entry['pf_info_value'] ) ) {
                            $desc = $entry['pf_info_value'];
                        }
                        // echo '<div><b>'. esc_html($title) .':</b> '. esc_html($desc) .'</div>';
                        ?>
                        <li class="">
                            <b><?php echo esc_html( $title ); ?></b> <?php echo esc_html( $desc ); ?>
                        </li>
                    <?php
                    }
                    ?>

                        
                    </ul>
                <?php endif; ?>  

                <?php if(!empty($settings['live_preview'] )){ ?>
                   
                    <ul class="live-preview">
                        <li>
                            <a href="<?php echo esc_url($settings['live_preview_link']);?>" target="_blank"><?php echo $settings['live_preview'];?> <i class="rt-arrow-right-long"></i></a>
                        </li>                        
                    </ul>
               <?php }?>          
        </div>


        <?php
    }
}
