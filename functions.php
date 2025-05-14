<?php
/**
 * Theme functions and definitions for Twenty Twenty-Five Child – MCD
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'MCD_THEME_DIR', get_stylesheet_directory() );
define( 'MCD_THEME_URI', get_stylesheet_directory_uri() );

/**
 * Enqueue theme styles and scripts
 */
function mcd_enqueue_assets() {
    $theme_uri = MCD_THEME_URI;
    $theme_dir = MCD_THEME_DIR;

    // Enqueue the child theme's stylesheet
    wp_enqueue_style(
        'mcd-child-style',
        $theme_uri . '/assets/css/styles.css',
        [],
        filemtime( $theme_dir . '/assets/css/styles.css' )
    );

    // Enqueue the child theme's JavaScript
    wp_enqueue_script(
        'mcd-child-script',
        $theme_uri . '/assets/js/script.js',
        ['jquery'],
        filemtime( $theme_dir . '/assets/js/script.js' ),
        true
    );

    // Enqueue Slick styles
    wp_enqueue_style(
        'slick-css',
        $theme_uri . '/assets/slick/slick.css',
        [],
        null
    );

    wp_enqueue_style(
        'slick-theme-css',
        $theme_uri . '/assets/slick/slick-theme.css',
        [],
        null
    );

    // Enqueue Slick JS
    wp_enqueue_script(
        'slick-js',
        $theme_uri . '/assets/slick/slick.min.js',
        ['jquery'],
        null,
        true
    );

    // Localize script AFTER registering/enqueuing it
    wp_localize_script( 'mcd-child-script', 'mcd_ajax_object', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'mcd_insights_nonce' )
    ] );
}
add_action( 'wp_enqueue_scripts', 'mcd_enqueue_assets' );


/**
 * Include custom post types and other modular files
 */
require_once MCD_THEME_DIR . '/inc/post-types/insights.php';
require_once MCD_THEME_DIR . '/inc/post-types/services.php';
require_once MCD_THEME_DIR . '/inc/post-types/projects.php';
require_once MCD_THEME_DIR . '/inc/post-types/testimonials.php';

/**
 * Enqueue custom scripts for ajax functionality
 */
require_once MCD_THEME_DIR . '/inc/ajax/insights-ajax.php';

/**
 * Enqueue custom scripts for shortcodes functionality
 */
require_once MCD_THEME_DIR . '/inc/shortcodes/about-specialist.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/insights-category-list.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/services-features.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/services-card-features.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/services-area.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/services-result.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/services-result-general.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/services-levels.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/projects-result.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/projects-services.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/projects-images.php';
require_once MCD_THEME_DIR . '/inc/shortcodes/projects-before-after.php';

/**
 * Enqueue JotForm script
 * This script is used to embed JotForm forms into the theme.
 */
// function custom_enqueue_jotform_script() {
//     wp_enqueue_script(
//         'jotform-embed',
//         'https://cdn.jotfor.ms/agent/embedjs/0196b0b2ab4f7195a22586335e5b4c53700a/embed.js?skipWelcome=1&maximizable=1',
//         array(),
//         null,
//         true
//     );
// }
// add_action('wp_enqueue_scripts', 'custom_enqueue_jotform_script');
