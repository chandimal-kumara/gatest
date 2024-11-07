<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin', 'acf', 'cpts']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);


/**
 * Global Variables
 */
define("TITLE", "Hello Smashy");
// Retreive the variables using '$varName = TITLE;' in any blade file

define("MOBILE_MENU_POSITION", "Top"); // Top, Bottom, Left, Right

/**
 * Global Variables
 */



/**
 * Allow SVG Files to be Uploaded
 */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );
/**
 * Allow SVG Files to be Uploaded
 */



/**
 * Register Footer Menu
 */
function register_my_menus() {
  register_nav_menus(
      array(
          'footer-menu-primary' => __( 'Footer Primary Menu' ),
          'footer-menu-secondary' => __( 'Footer Secondary Menu' )
      )
  );
}

add_action( 'init', 'register_my_menus' );
/**
 * Register Footer Menu
 */



/**
 * Google Map API Integration
 */
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyBXCgdLb0Rpd0xLmyMwOURVz6VjG236y_w';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
/**
 * Google Map API Integration
 */



/**
 * Remove buttons from tinymce editor
 */

//  Following are the button names
//  bold, italic, bullist, numlist, blockquote, underline, alignjustify, alignleft, aligncenter, alignright, link, unlink, strikethrough, wp_more, spellchecker, wp_adv, dfw, formatselect, hr, forecolor, pastetext, removeformat, charmap, outdent, indent, undo, redo, wp_help

// Remove unwanted WordPress TinyMCE buttons from first row
function bydik_remove_tinymce_buttons_first_row( $buttons ) {
  $remove = array( 'blockquote', 'underline', 'alignjustify', 'alignleft', 'aligncenter', 'link', 'alignright', 'wp_adv', 'wp_more', 'fullscreen' );
  return array_diff( $buttons, $remove );
}

add_filter( 'mce_buttons', 'bydik_remove_tinymce_buttons_first_row', 2000 );

// // Remove unwanted WordPress TinyMCE buttons from second row
function bydik_remove_tinymce_buttons_second_row( $buttons ) {
  $remove = array( 'strikethrough', 'hr', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo', 'wp_help' );
  return array_diff( $buttons, $remove );
}

add_filter( 'mce_buttons_2', 'bydik_remove_tinymce_buttons_second_row', 2020 );
/**
 * Remove buttons from tinymce editor
 */

 /**
 * modify editor tags - it shows only the defined below
 */

// Following are the option to show all tags
// Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre

function wpa_45815($arr){
    $arr['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';
    return $arr;
}
add_filter('tiny_mce_before_init', 'wpa_45815');
 /**
 * modify editor tags - it shows only the defined below
 */

 add_filter('wpcf7_autop_or_not', '__return_false'); //stop form items being wrapped in a paragraph tag

// adding a wrapper to main menu - sub menu
 class submenu_wrap extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}
// adding a wrapper to main menu - sub menu

// adding custom favicon through ACF
function customFavicon() {
    if (get_field('site_favicon','option')) {
        $favicon = get_field('site_favicon','option');
    echo '<link rel="shortcut icon" type="image/png" href="' . $favicon['url'] . '">';
    }
}

add_action( 'admin_head', 'customFavicon' );
add_action( 'wp_head', 'customFavicon' );
// adding custom favicon through ACF

// Limit max menu depth in admin panel
function limit_admin_menu_depth($hook)
{
    if ($hook != 'nav-menus.php') return;

    wp_register_script('limit-admin-menu-depth', get_stylesheet_directory_uri() . '/assets/scripts/routes/header.js', array(), '1.0.0', true);
    wp_localize_script(
        'limit-admin-menu-depth',
        'myMenuDepths',
        array(
            'primary_navigation' => 2, // <-- Set your menu location and max depth here
        )
    );
    wp_enqueue_script('limit-admin-menu-depth');
}
add_action( 'admin_enqueue_scripts', 'limit_admin_menu_depth' );
// Limit max menu depth in admin panel

// add a custom button the toolbar of the editor to add primary + secondary buttons
add_action('admin_head', 'custom_editor_button');
add_filter( 'acf/fields/wysiwyg/toolbars' , 'custom_editor_button');

function custom_editor_button() {
  global $typenow;
  // Check user permissions
  if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
    return;
  }

  // Check if WYSIWYG is enabled
  if ( get_user_option('rich_editing') == 'true') {
    add_filter('mce_external_plugins', 'add_tinymce_plugin');
    add_filter('mce_buttons', 'register_my_button');
  }
}

// Create the custom TinyMCE plugins
function add_tinymce_plugin($plugin_array) {
  $plugin_array['custom_buttons'] = get_template_directory_uri() . '/assets/scripts/routes/tinymce-buttons.js';
  return $plugin_array;
}
// Add the buttons to the TinyMCE array of buttons that display, so they appear in the WYSIWYG editor
function register_my_button($buttons) {
  array_push($buttons, 'custom_buttons');
  return $buttons;
}
// add a custom button the toolbar of the editor to add primary + secondary buttons

// add a dropdown to wp editor to add wrappers to text or add custom headings like the eyebrow heading
function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

function my_mce_before_init_insert_formats( $init_array ) {

    $style_formats = array(
        array(
            'title' => 'Eyebrow Heading',
            'block' => 'span',
            'classes' => 'eyebrow-heading',
            'wrapper' => false,

        ),
    );

    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
// add a dropdown to wp editor to add wrappers to text or add custom headings like the eyebrow heading

// adding custom Admin Area CSS
add_action( 'admin_enqueue_scripts', 'my_admin_style');

function my_admin_style() {
  wp_enqueue_style( 'admin-style', get_stylesheet_directory_uri() . '/admin-style.css' );
}
// adding custom Admin Area CSS


// Adding Custom Image to Login Screen and URL
if( !function_exists( 'custom_login_logo' ) ){
  function custom_login_logo() {
    if (get_field('site_logo','option')) {
      $imageUrl = get_field('site_logo','option')['url'];
    }

    echo '<style> h1 a { background-image: url('.$imageUrl.') !important; margin: 0 !important; background-size: contain !important; width: 100% !important;} </style>';
  }
  add_action( 'login_head', 'custom_login_logo' );
}

if( ! function_exists( 'custom_login_logo_url' ) ){
  add_filter( 'login_headerurl', 'custom_login_logo_url' );
  function custom_login_logo_url() {
      return get_home_url();
  }
}
// Adding Custom Image to Login Screen and URL

// Add "Email Configurations"
include_once 'email-config.php';
// Add "Email Configurations"