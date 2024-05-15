<?php

//Add ACF options page
if (function_exists('acf_add_options_page')) {
    $parent = acf_add_options_page(__('Site Settings', 'Shin'));
}

// Local JSON acf
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
    $theme_dir = get_stylesheet_directory();
    // Create our directory if it doesn't exist.
    if (!is_dir($theme_dir .= '/acf-field')) {
        mkdir($theme_dir, 0755);
    }
    $path = get_stylesheet_directory() . '/acf-field';
    return $path;
}


add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
    // remove original path (optional)
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-field';
    return $paths;
}