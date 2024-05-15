<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function weiboo_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'weiboo_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function weiboo_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'weiboo_pingback_header' );

/**  kses_allowed_html */

function weiboo_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'weiboo': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}

add_filter( 'wp_kses_allowed_html', 'weiboo_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function weiboo_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'weiboo' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Jost:400;500;600;700;800;900&display=swap' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

function weiboo_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', weiboo_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'weiboo_studio_scripts' );

//Favicon Icon
function weiboo_site_icon() {
 if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {     
    global $weiboo_option;
     
    if(!empty($weiboo_option['rs_favicon']['url']))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($weiboo_option['rs_favicon']['url'])); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'weiboo_site_icon');


//excerpt for specific section
function weiboo_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'read more', 'weiboo' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'weiboo_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'weiboo_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  $post_id = $post->ID;
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  } 
  else { 
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';    
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }    
    else {     
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );      
      if ( $readmore ) {
        $output .= apply_filters( 'weiboo_wpex_readmore_link', $readmore_link );
      }
    }
  }
  // Apply filters and echo
  return apply_filters( 'weiboo_wpex_get_excerpt', $output );
}

//Demo content file include here

function weiboo_import_files() {
  return array(
    array(
        'import_file_name'           => 'weiboo Demo Import',
        'categories'                 => array( 'Business' ),
        'import_file_url'            => trailingslashit( get_template_directory_uri() ) . 'inc/demo-data/weiboo-content.xml',
             
        'import_redux'               => array(
        array(
          'file_url'    => trailingslashit( get_template_directory_uri() ) . 'inc/demo-data/weiboo-options.json',
          'option_name' => 'weiboo_option',
        ),
      ),
     
      'import_notice'  => esc_html__( 'Note: For making demo site just click "Import Demo Data" button. During demo data installation please do not refresh the page.', 'weiboo' ),      
    ),
    
  );
}

add_filter( 'pt-ocdi/import_files', 'weiboo_import_files' );
function weiboo_after_import_setup() {
  // Assign menus to their locations.
	$main_menu     = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id,      
    )
  );
  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );
  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID ); 
  
}
add_action( 'pt-ocdi/after_import', 'weiboo_after_import_setup' );
add_filter( 'use_widgets_block_editor', '__return_false' );