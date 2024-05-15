<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rt_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function rt_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}



/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function rt_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rt_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rt_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function rt_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'rt_register_gallery_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_register_gallery_metabox() {
	$prefix = 'rt_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-gallery',
		'title'         => esc_html__( 'Gallery Images', 'rs-framework' ),
		'object_types'  => array( 'gallery' ), // Post type
		// 'show_on_cb' => 'rt_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'rt_add_some_classes', // Add classes through a callback.
	) );

	$cmb_project->add_field( array(
	'name' => 'Upload Gallery Images',
	'desc' => '',
	'id'   => 'Screenshot',
	'type' => 'file_list',
	// 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	// 'query_args' => array( 'type' => 'image' ), // Only images attachment
	// Optional, override default text strings
	'text' => array(
		'add_upload_files_text' => 'Upload Files', // default: "Add or Upload Files"
		'remove_image_text' => 'Replacement', // default: "Remove Image"
		'file_text' => 'Replacement', // default: "File:"
		'file_download_text' => 'Replacement', // default: "Download"
		'remove_text' => 'Replacement', // default: "Remove"
	),
) );
	
}

add_action( 'cmb2_admin_init', 'rt_register_header_metabox' );


add_action( 'cmb2_admin_init', 'header_style_register_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function header_style_register_field_metabox() {
	$prefix = 'yourprefix_group_header_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Header Layout', 'rs-function' ),
		'object_types' => array( 'rts-header' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Fixed Header Layout', 'rs-framework' ),
		'desc'    => esc_html__( 'If you active it your header layout will be fixed/absolutue positon', 'rs-framework' ),		
		'id'      => 'header-position',
		'type'    => 'checkbox',
	) );

	
}



/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_register_header_metabox() {
	$prefix = 'rt_'; 

  /**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Page Options', 'rs-framework' ),
		'object_types'  => array( 'page','post','teams','rt-portfolios','services','product','archive' ), // Post type
		'vertical_tabs' => true, // Set vertical tabs, default false
		'tabs' => array(
            array(
                'id'    => 'tab-1',
                'icon' => 'dashicons-admin-page',
                'title' => 'Page Settings',
                'fields' => array(
                    'primary-colors',
                    'page_bg',
                    'content_top',
                    'content_bottom'
                ),
            ),
            array(
                'id'    => 'tab-2',
                'icon' => 'dashicons-admin-generic',
                'title' => 'Header Settings',
                'fields' => array(
                    'header_logo_img',
                    'header_sticky_logo_img',
                    'header_select',
                    'header_width_custom',
                    'select-logo',
                    'header_menu_top',
                    'left_header_menu',
                    'right_header_menu',
                    'select-search',
                    'search_icon_color',
                    'show-off-canvas'
                ),
            ),
            array(
                'id'    => 'tab-3',
                'icon' => 'dashicons-buddicons-topics',
                'title' => 'Topbar Settings',
                'fields' => array(
                    'select-top',
                   	'topbar-area-bg',
                   	'topbar-text-color',
                   	'topbar_link_hovercolor',
                   	'topbar-border-color',
                   	'social-icon-color'
                ),
            ),
            array(
                'id'    => 'tab-9',
                'icon' => 'dashicons-format-image',
                'title' => 'Banner Settings',
                'fields' => array(
                    'banner_image',
                    'banner_hide',
                    'select-title',
                    'select-bread',                   
                    'content_banner',                   
                    'intro_content_banner'             
                ),
            ),
            array(
                'id'    => 'tab-4',
                'icon' => 'dashicons-menu',
                'title' => 'Mainmenu Settings',
                'fields' => array(
                   	'menu-type',
                   	'center-menus',
                   	'menu-hides',
                   	'main_menu_top',
                   	'main_menu_bottom',
                   	'sticky_main_menu_top',
                   	'sticky_main_menu_bottom',
                   	'menu-type-bg',
                   	'menu_border_color',
                   	'menu-text-color',
                   	'menu-text-hover-color',
                   	'menu_sticky_bgcolor',
                   	'menu_sticky_txtcolor',
                   	'menu_sticky_txt_hovercolor',
                   	'menu_bg_dropdowncolor',
                   	'menu_text_dropdowncolor',
                   	'menu_text_hover_dropdowncolor',
                   	'show-cart-icon',
                   	'cart_icon_color'
                ),
            ),
            array(
                'id'    => 'tab-5',
                'icon' => 'dashicons-external',
                'title' => 'Mouse Pointer',
                'fields' => array(
                    'mouse-pointer'
                ),
            ),
            array(
                'id'    => 'tab-6',
                'icon' => 'dashicons-menu-alt3',
                'title' => 'Humburger Settings',
                'fields' => array(
                    'head_hamburger_color',
                    'head_hamburger_colors2',
                    'sticky_hamburgert_color',
                    'sticky_hamburgert_secondary_color'
                ),
            ),
            array(
                'id'    => 'tab-7',
                'icon' => 'dashicons-button',
                'title' => 'Quote Button',
                'fields' => array(
                    'show-quote',
                    'quote_btn_text',
                    'quote_button_bg_color',
                    'quote_button_color',
                    'quote_button_bg_hover_color',
                    'quote_button_hover_color'
                ),
            ),
            array(
                'id'    => 'tab-8',
                'icon' => 'dashicons-screenoptions',
                'title' => 'Footer Settings',
                'fields' => array(
                	'footer_style',
                    'footer__top__padding',
                    'hide_footer_subscribe',
                    'hide_footer',
                    'hide_foot_widgets',
                    'header_width_custom2',
                    'footer_bg_img',
                    'footer_bg_position',
                    'footer_bg',
                    'footer_logo_img',
                    'footer_top_border_color',
                    'footer_title_color',
                    'footer_texts_color',
                    'footer_link_colorss',
                    'footer_primary_hover_color',
                    'footer_border_color',
                    'footer_in_bg_color',
                    'footer_in_icon_color',
                    'footer_all_icon_colors',
                    'footer_socials_bg_colors',
                    'footer_socials_icon_colors',
                    'footer_btn_bg_color',
                    'footer_btn_text_color'
                   
                ),
            ),

            array(
                'id'    => 'tab-9',
                'icon' => 'dashicons-info-outline',
                'title' => 'Copyright Settings',
                'fields' => array(                   
                    'copyright_trans',
                    'copyright_bg',
                    'copyright_border',
                    'copyright_padding'
                ),
            ),      

            

        )
		
	) );

function get_myposttype_options($argument) {
	$args = array(
		'post_type' => $argument, 
		'posts_per_page' => -1,
		'orderby' => 'title',
    	'order'   => 'ASC');
	$loop = new WP_Query($args);
	if($loop->have_posts()) {  
	    while($loop->have_posts()) : $loop->the_post();
	        //
	        $varID = get_the_id();
	        $varName = get_the_title();
	        $pageArray[$varID]=$varName;
	    endwhile; 
	    return  $pageArray;  
	}
	
}

	//Page Settings meta field
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Primary Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your background', 'rs-framework' ),
		'id'      => 'primary-colors',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Select Page Background Image', 'rs-framework' ),
		'desc' => esc_html__( 'Upload an image or enter a URL for page banner.', 'rs-framework' ),
		'id'   => 'page_bg',
		'type' => 'file',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Content Top Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(100px)', 'rs-framework' ),
		'default' => esc_attr__( '100px', 'rs-framework' ),
		'id'      => 'content_top',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Content Bottom Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(100px)', 'rs-framework' ),
		'default' => esc_attr__( '100px', 'rs-framework' ),
		'id'      => 'content_bottom',
		'type'    => 'text_medium',
	) );



	//header settings meta field
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Custom Header Logo', 'cmb2' ),
		'desc'    => esc_html__( 'Select header logo', 'cmb2' ),
		'id'      => 'header_logo_img',
		'type'    => 'file',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Custom Sticky Logo', 'cmb2' ),
		'desc'    => esc_html__( 'Select Sticky logo', 'cmb2' ),
		'id'      => 'header_sticky_logo_img',
		'type'    => 'file',		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Header Style', 'rs-framework' ),
		'desc'             => esc_html__( 'chosse your individual header style', 'rs-framework' ),
		'id'               => 'header_select',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options' => get_myposttype_options('rts-header'),
	) );


	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Header Width', 'rs-framework' ),
		'desc'             => esc_html__( 'Choose your individual header width', 'rs-framework' ),
		'id'               => 'header_width_custom',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'container' => esc_html__( 'Container', 'rs-framework' ),
			'full' => esc_html__( 'Container Fluid', 'rs-framework' ),
				
		),
	) );
   
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Logo Type', 'rs-framework' ),
		'desc'             => esc_html__( 'You can select logo type', 'rs-framework' ),
		'id'               => 'select-logo',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'light' => esc_html__( 'Light', 'rs-framework' ),
			'dark'  => esc_html__( 'Dark', 'rs-framework' ),			
			'icon'  => esc_html__( 'Default Icon', 'rs-framework' ),			
			'icon2' => esc_html__( 'Light icon', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Header Top Margin', 'rs-framework' ),
		'desc'    => esc_html__( 'example(10px)', 'rs-framework' ),
		'id'      => 'header_menu_top',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Header Left Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(15px)', 'rs-framework' ),
		'id'      => 'left_header_menu',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Header Right Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(15px)', 'rs-framework' ),
		'id'      => 'right_header_menu',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Header Search', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide search', 'rs-framework' ),
		'id'               => 'select-search',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Search Icon Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Search Icon color', 'cmb2' ),
		'id'      => 'search_icon_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show off Canvas', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide off canvas', 'rs-framework' ),
		'id'               => 'show-off-canvas',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );
	
	// Topbar
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Top Bar', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide topbar', 'rs-framework' ),
		'id'               => 'select-top',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Topbar Area Background', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your background', 'rs-framework' ),
		'id'      => 'topbar-area-bg',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Topbar Text Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your color', 'rs-framework' ),
		'id'      => 'topbar-text-color',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Topbar Link Hover Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your link color', 'rs-framework' ),
		'id'      => 'topbar_link_hovercolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Topbar Border Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your color', 'rs-framework' ),
		'id'      => 'topbar-border-color',		
		'type'    => 'colorpicker',
		'default' => '',
	) );	

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Social Icon Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse icon Color', 'rs-framework' ),
		'id'      => 'social-icon-color',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	// Main Menu

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Menu Type', 'rs-framework' ),
		'desc'             => esc_html__( 'You can select menu type', 'rs-framework' ),
		'id'               => 'menu-type',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'light' => esc_html__( 'Light', 'rs-framework' ),
			'dark' => esc_html__( 'Dark', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Main Menu Center', 'rs-framework' ),
		'desc'             => esc_html__( 'Main menu center here', 'rs-framework' ),
		'id'               => 'center-menus',
		'type'             => 'select',
		'show_option_none' => '',
		'options'          => array(
			'no' => esc_html__( 'Default', 'rs-framework' ),
			'yes' => esc_html__( 'Main Menu Center', 'rs-framework' ),			
			'left' => esc_html__( 'Main Menu Left', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Main menu Show or Hide (Desktop)', 'rs-framework' ),
		'desc'             => esc_html__( 'You Can Show or Hide Main menu', 'rs-framework' ),
		'id'               => 'menu-hides',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Main Menu Top Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(45px)', 'rs-framework' ),
		'id'      => 'main_menu_top',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Main Menu Bottom Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(45px)', 'rs-framework' ),
		'id'      => 'main_menu_bottom',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Menu Top Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(45px)', 'rs-framework' ),
		'id'      => 'sticky_main_menu_top',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Menu Bottom Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(45px)', 'rs-framework' ),
		'id'      => 'sticky_main_menu_bottom',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Menu Area Background', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your background', 'rs-framework' ),
		'id'      => 'menu-type-bg',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Menu Area Border Color(only header style 3)', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your border color', 'rs-framework' ),
		'id'      => 'menu_border_color',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Main Menu Text Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your Text Color', 'rs-framework' ),
		'id'      => 'menu-text-color',		
		'type'    => 'colorpicker',
		'default' => '',
	) );
	

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Main Menu Text Hover Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your Text Color', 'rs-framework' ),
		'id'      => 'menu-text-hover-color',		
		'type'    => 'colorpicker',
		'default' => '',
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Menu Bg Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your sticky bg color', 'rs-framework' ),
		'id'      => 'menu_sticky_bgcolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Menu Text Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your sticky text color', 'rs-framework' ),
		'id'      => 'menu_sticky_txtcolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Menu Hover Text Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your sticky hover text color', 'rs-framework' ),
		'id'      => 'menu_sticky_txt_hovercolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Dropdown Menu Background Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your Bg Color', 'rs-framework' ),
		'id'      => 'menu_bg_dropdowncolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Dropdown Menu Text Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your text color', 'rs-framework' ),
		'id'      => 'menu_text_dropdowncolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Dropdown Menu hover Text Color', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your hover text color', 'rs-framework' ),
		'id'      => 'menu_text_hover_dropdowncolor',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Cart Icon Show At Menu Area', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide cart icon', 'rs-framework' ),
		'id'               => 'show-cart-icon',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );
	
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Cart Icon Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Cart Icon color', 'cmb2' ),
		'id'      => 'cart_icon_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	// Mouse Pointer
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Mouse Pointer Style Show or Hide', 'rs-framework' ),
		'desc'             => esc_html__( 'You Can Show or Hide Pointer Style', 'rs-framework' ),
		'id'               => 'mouse-pointer',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );


	// Humburger
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Hamburger Dots Primary Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Hamburger Dots color', 'cmb2' ),
		'id'      => 'head_hamburger_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Hamburger Dots Secondary Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Hamburger Dots color', 'cmb2' ),
		'id'      => 'head_hamburger_colors2',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Hamburger Dots Primary Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Sticky Hamburger Dots color', 'cmb2' ),
		'id'      => 'sticky_hamburgert_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Sticky Hamburger Dots Secondary Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Sticky Hamburger Dots color', 'cmb2' ),
		'id'      => 'sticky_hamburgert_secondary_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	// Quote Button
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Quote Button', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide quote button', 'rs-framework' ),
		'id'               => 'show-quote',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Quote Button Text', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter Quote Button Text', 'rs-framework' ),
		'id'      => 'quote_btn_text',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Quote Button Background Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Quote Button Background color', 'cmb2' ),
		'id'      => 'quote_button_bg_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Quote Button Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Quote Button color', 'cmb2' ),
		'id'      => 'quote_button_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Quote Button Hover Bg color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Quote Button Bg Border color', 'cmb2' ),
		'id'      => 'quote_button_bg_hover_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Quote Button Hover Color', 'cmb2' ),
		'desc'    => esc_html__( 'Choose Quote Button Hover color', 'cmb2' ),
		'id'      => 'quote_button_hover_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );


	//Footer Custom field here

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select footer Style', 'rs-framework' ),
		'desc'             => esc_html__( 'chosse your individual footer style', 'rs-framework' ),
		'id'               => 'footer_style',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options' => get_myposttype_options('rts-footer'),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Top Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(100px)', 'rs-framework' ),
		'id'      => 'footer__top__padding',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Hide Footer Call to Action', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide footer call to action here', 'rs-framework' ),
		'id'               => 'hide_footer_subscribe',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'no' => esc_html__( 'No', 'rs-framework' ),
			'yes' => esc_html__( 'Yes', 'rs-framework' ),		
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Hide Footer', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide footer here', 'rs-framework' ),
		'id'               => 'hide_footer',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'no' => esc_html__( 'No', 'rs-framework' ),
			'yes' => esc_html__( 'Yes', 'rs-framework' ),		
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Hide Footer Widgets', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide footer widgets here', 'rs-framework' ),
		'id'               => 'hide_foot_widgets',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'no' => esc_html__( 'No', 'rs-framework' ),
			'yes' => esc_html__( 'Yes', 'rs-framework' ),		
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Footer Width', 'rs-framework' ),
		'desc'             => esc_html__( 'Choose your individual header width', 'rs-framework' ),
		'id'               => 'header_width_custom2',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'container' => esc_html__( 'Container', 'rs-framework' ),
			'full' => esc_html__( 'Container Fluid', 'rs-framework' ),
				
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Background Image', 'cmb2' ),
		'desc'    => esc_html__( 'select footer background image', 'cmb2' ),
		'id'      => 'footer_bg_img',
		'type'    => 'file',		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Background Position', 'rs-function' ),
		'desc'             => esc_html__( 'choose background position', 'rs-function' ),
		'id'               => 'footer_bg_position',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'center center' => esc_html__( 'Center Center', 'rs-function' ),
			'center top'    =>  esc_html__( 'Center Top', 'rs-function' ),			
			'center bottom' =>  esc_html__( 'Center Bottom', 'rs-function' ),			
			'left top'      =>  esc_html__( 'Left Top', 'rs-function' ),			
			'left bottom'   =>  esc_html__( 'Left Bottom', 'rs-function' ),			
			'right top'     =>  esc_html__( 'Right Top', 'rs-function' ),			
			'right bottom'  =>  esc_html__( 'Right Bottom', 'rs-function' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Background', 'cmb2' ),
		'desc'    => esc_html__( 'select footer background', 'cmb2' ),
		'id'      => 'footer_bg',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Logo', 'cmb2' ),
		'desc'    => esc_html__( 'Select footer logo', 'cmb2' ),
		'id'      => 'footer_logo_img',
		'type'    => 'file',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Top Border Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Top Border Color', 'cmb2' ),
		'id'      => 'footer_top_border_color',
		'type'    => 'colorpicker',
		'default' => '',
		'options' => array( 'alpha' => true ),		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Title Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Title Color', 'cmb2' ),
		'id'      => 'footer_title_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Text Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Text Color', 'cmb2' ),
		'id'      => 'footer_texts_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Link Text Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Link Text Color', 'cmb2' ),
		'id'      => 'footer_link_colorss',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Link Hover Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Link Hover Color', 'cmb2' ),
		'id'      => 'footer_primary_hover_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );
	
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer input Border Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Border Color', 'cmb2' ),
		'id'      => 'footer_border_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer input Bg Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer input Bg Color', 'cmb2' ),
		'id'      => 'footer_in_bg_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer input Button Icon Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Button Icon Color', 'cmb2' ),
		'id'      => 'footer_in_icon_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Icon Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Icon Color', 'cmb2' ),
		'id'      => 'footer_all_icon_colors',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Social Icon Bg Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Social Icon Bg Color', 'cmb2' ),
		'id'      => 'footer_socials_bg_colors',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Social Icon Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Social Icon Color', 'cmb2' ),
		'id'      => 'footer_socials_icon_colors',
		'type'    => 'colorpicker',
		'default' => '',		
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Button Bg Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Button Bg Color', 'cmb2' ),
		'id'      => 'footer_btn_bg_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Button Text Color', 'cmb2' ),
		'desc'    => esc_html__( 'Footer Button Text Color', 'cmb2' ),
		'id'      => 'footer_btn_text_color',
		'type'    => 'colorpicker',
		'default' => '',		
	) );
	
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Copyright Background Transparent', 'rs-framework' ),
		'desc'             => esc_html__( 'Choose copyright background Transparent', 'rs-framework' ),
		'id'               => 'copyright_trans',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'no' => esc_html__( 'No', 'rs-framework' ),
			'yes' => esc_html__( 'Yes', 'rs-framework' ),
				
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Copyright Background', 'cmb2' ),
		'desc'    => esc_html__( 'select copyright background', 'cmb2' ),
		'id'      => 'copyright_bg',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Copyright Border Color', 'cmb2' ),
		'desc'    => esc_html__( 'select border color', 'cmb2' ),
		'id'      => 'copyright_border',
		'type'    => 'colorpicker',
		'default' => '',
		'options' => array( 'alpha' => true ),		
	) );


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Copyright Padding', 'cmb2' ),
		'desc'    => esc_html__( 'example(10px 5px)', 'rs-framework' ),
		'id'      => 'copyright_padding',
		'type'    => 'text_medium',
		'default' => esc_attr__( '0px', 'rs-framework' ),		
	) );


	//Banner Custom field here

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Select Banner Image', 'rs-framework' ),
		'desc' => esc_html__( 'Upload an image or enter a URL for page banner.', 'rs-framework' ),
		'id'   => 'banner_image',
		'type' => 'file',
	) );
    
    $cmb_demo->add_field( array(
		'name'             => esc_html__( 'Banner Hide', 'rs-framework' ),
		'desc'             => esc_html__( 'You Can Show or Hide Banner', 'rs-framework' ),
		'id'               => 'banner_hide',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Page Title', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide page title', 'rs-framework' ),
		'id'               => 'select-title',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Breadcurmbs', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide  breadcurmbs here', 'rs-framework' ),
		'id'               => 'select-bread',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	));


	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Page Banner Text', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter some text in banner', 'rs-framework' ),
		'id'      => 'content_banner',
		'type'    => 'textarea_small',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Page Banner Intro Text', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter some intro text in banner', 'rs-framework' ),
		'id'      => 'intro_content_banner',
		'type'    => 'textarea_small',
	) );
}


/**** Skill Meta ***/

add_action( 'cmb2_admin_init', 'trainert_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function trainert_register_repeatable_group_field_metabox() {
	$prefix = 'rt_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Team Member Skill', 'rs-function' ),
		'object_types' => array( 'teams' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => 'member_skill',
		'type'        => 'group',
		'description' => esc_html__( 'Team Member Personal Skills', 'rs-function' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Skill {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Skill', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove Skill', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Skill Title', 'rs-function' ),
		'id'         => 'skill_title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Skill Level', 'rs-function' ),
		'id'         => 'skill_level',
		'type'       => 'text',
		'desc' => esc_html__( 'add skill level as like (35%) out 100%', 'rs-function' ),
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );		

}



//page section metabox

add_action( 'cmb2_admin_init', 'rt_register_client_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_register_client_metabox() {
	$prefix = 'rt_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'            => $prefix . 'client',
		'title'         => esc_html__( 'Link Setting', 'rs-framework' ),
		'object_types'  => array( 'rsclient' ), // Post type
		// 'show_on_cb' => 'rt_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'rt_add_some_classes', // Add classes through a callback.
	) );	

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Enter Logo Link here', 'rs-framework' ),
		'desc'    => esc_html__( 'http://rstheme.com', 'rs-framework' ),		
		'id'      => 'client_link',
		'type'    => 'text_medium',
	) );
}




// Timeline Year
add_action( 'cmb2_admin_init', 'rt_register_timeline_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_register_timeline_metabox() {
	$prefix = 'rt_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'            => $prefix . 'timeline',
		'title'         => esc_html__( 'Timeline Settings', 'rs-framework' ),
		'object_types'  => array( 'timelines' ), // Post type
		// 'show_on_cb' => 'rt_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'rt_add_some_classes', // Add classes through a callback.
	) );	

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Enter Period of Time', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter Period of Time i.e year of experience or year', 'rs-framework' ),		
		'id'      => 'year',
		'type'    => 'text_medium',
	) );
}


add_action( 'cmb2_admin_init', 'rt_service_project_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_service_project_metabox() {
	$prefix = 'rt_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-service',
		'title'         => esc_html__( 'Service Thumb Image', 'brickx' ),
		'object_types'  => array( 'services' ), // Post type
		
	) );

	$cmb_project->add_field( array(
		'name' => 'Upload Thumb Image',
		'desc' => '',
		'id'   => 'service-thumb',
		'type' => 'file',
	) );

	$cmb_project->add_field( array(
		'name' => 'Upload Hover Thumb Image',
		'desc' => '',
		'id'   => 'service-thumb-hover',
		'type' => 'file',
	) );
}

//department post type metabox
add_action( 'cmb2_admin_init', 'rt_department_project_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_department_project_metabox() {
	$prefix = 'rt_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'icon-department',
		'title'         => esc_html__( 'Department Section', 'brickx' ),
		'object_types'  => array( 'mp-event' ), // Post type
		
	) );

	$cmb_project->add_field( array(
		'name' => 'Upload department icon',
		'desc' => '',
		'id'   => 'icon-thumb',
		'type' => 'file',
		
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Department Except', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter some text', 'rs-framework' ),
		'id'      => 'content_dept',
		'type'    => 'textarea_small',
	) );
}


/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function rt_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'rs-framework' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function rt_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}

add_action( 'cmb2_admin_init', 'rt_portfoloio_metas' );
/**
 * Define the metabox and field configurations.
 */
function rt_portfoloio_metas() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'rt_portfolio_metas',
		'title'         => __( 'Portfolio Details', 'rs-framework' ),
		'object_types'  => array( 'rt-portfolios', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );


	$group_field_id = $cmb->add_field( array(
		'id'          => 'pf_details',
		'type'        => 'group',
		'description' => __( 'Provide Your projects details', 'rs-framework' ),
		// 'repeatable'  => false, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'       => __( 'Info {#}', 'rs-framework' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'        => __( 'Add Another Info', 'rs-framework' ),
			'remove_button'     => __( 'Remove Info', 'rs-framework' ),
			'sortable'          => true,
			// 'closed'         => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'rs-framework' ), // Performs confirmation before removing group.
		),
	) );

	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Information Title',
		'id'   => 'pf_info_title',
		'type' => 'text',
		'description' => __( 'Portfolio Information name. Ex: Budget', 'rs-framework' ),
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	
	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Information Value',
		'id'   => 'pf_info_value',
		'type' => 'text',
		'description' => __( 'Portfolio Information value. Ex: $30K', 'rs-framework' ),

		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );


}

add_action( 'cmb2_admin_init', 'rt_product_metabox' );
/**
 * Define the metabox and field configurations.
 */
function rt_product_metabox() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'rt_product__meta',
		'title'         => __( 'RT Metabox', 'rs-framework' ),
		'object_types'  => array( 'product', ), // Post type
		'context'       => 'side',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	$cmb->add_field( array(
		'name'    => 'Product 2nd Image',
		'desc'    => 'This Image will show on the product hover on the home page if no gallery image is uploaded.',
		'id'      => 'rt_product_2nd_img',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );
	$cmb->add_field( array(
		'name' => 'Disable New Badge',
		'desc' => 'Check for only disable the new badge for this post',
		'id'   => 'disable_new_badge',
		'type' => 'checkbox',
	) );

}



add_action( 'cmb2_admin_init', 'rt_testimonial_metabox' );
/**
 * Define the metabox and field configurations.
 */
function rt_testimonial_metabox() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'testimonial_info_meta',
		'title'         => __( 'Testimonial Info', 'rs-framework' ),
		'object_types'  => array( 'rt-testimonials', ), // Post type
		'context'       => 'top',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	$cmb->add_field( array(
		'name'    => 'Review Title',
		'desc'    => 'Give Your Review A Title.',
		'id'      => 'rt_review__title',
		'type'    => 'text',
		
	) );

	$cmb->add_field( array(
		'name'    => 'Author Designation',
		'desc'    => 'Your Designation.',
		'id'      => 'designation',
		'type'    => 'text',
	) );

	$cmb->add_field( array(
		'name'             => 'Select Ratings',
		'desc'             => 'Select ratings',
		'id'               => 'ratings',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'1'   => __( '1', 'rs-framework' ),
			'1.5' => __( '1.5', 'rs-framework' ),
			'2'   => __( '2', 'rs-framework' ),
			'2.5' => __( '2.5', 'rs-framework' ),
			'3'   => __( '3', 'rs-framework' ),
			'3.5' => __( '3.5', 'rs-framework' ),
			'4'   => __( '4', 'rs-framework' ),
			'4.5' => __( '4.5', 'rs-framework' ),
			'5'   => __( '5', 'rs-framework' ),
		),
	) );


}




add_action( 'cmb2_admin_init', 'rt_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function rt_register_taxonomy_metabox() {

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => 'rt_pcat_info',
		'title'            => esc_html__( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'product_cat' ), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Icon', 'cmb2' ),
		'desc' => esc_html__( 'Add Product Category Icon Image', 'cmb2' ),
		'id'   => 'rt_pcat_icon',
		'type' => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Add Icon'
		),
		'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
	) );

	$cmb_term->add_field( array(
		'name'    => 'Category Grid Item Background',
		'id'      => 'pcat_grid_bg',
		'type'    => 'colorpicker',
		'options' => array(
			'alpha' => true, 
		),
		) );
		
	$cmb_term->add_field( array(
		'name'    => 'Category Grid Item Button Color',
		'id'      => 'pcat_grid_btn_color',
		'type'    => 'colorpicker',
		'desc' 	  => esc_html__( 'Try to pick a similar color like icon ', 'cmb2' ),
		'options' => array(
			'alpha' => true, 
		),
	) );		

}



