<?php
/**
 * Echo Theme functions and definitions
 *
 * @package EchoTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$echo_theme_inc_dir = 'inc';

// Array of files to include.
$echo_theme_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/cpt.php',                             // Register custom post types.
	'/wp-overrides.php',                    // Override default Wordpress functions & settings
	'/plugin-overrides.php',                // Override plugin functions & settings
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/shortcodes.php',                      // Library of shortcodes
	'/blocks.php',                          // ACF Blocks
	'/menu.php',                          // ACF Blocks
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$echo_theme_includes[] = '/wc-overrides.php'; // Override default WooCommerce functions & settings
	$echo_theme_includes[] = '/woocommerce.php'; // WooCommerce functions
}

// Include files.
foreach ( $echo_theme_includes as $file ) {
	require_once get_theme_file_path( $echo_theme_inc_dir . $file );
}

// Contact number shortcode
function my_contact_number_shortcode() {
    // You can output any HTML here
    $html = '<div class="contact-number-shortcode">';
    $html .= '<a href="tel:01476 401571"><img src="'.get_template_directory_uri().'/images/tel-icon.svg"><span>01476 401571</span></a>';
    $html .= '</div>';

    return $html;
}
add_shortcode( 'contact_number', 'my_contact_number_shortcode' );

// Disable /users rest routes
add_filter('rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});

add_action( 'send_headers', 'wc_prevent_clickjacking', 10 );
function wc_prevent_clickjacking() { 
    header( 'X-FRAME-OPTIONS: SAMEORIGIN' );
}

// Start session on init
add_action( 'init', function() {
    if ( ! session_id() ) {
        session_start();
    }
}, 1 );

// Redirect first-time visitors to a landing page
add_action( 'template_redirect', function() {
    // ID of your landing page (replace 123 with your actual page ID)
    $landing_page_id  = 24;
    $landing_page_url = get_permalink( $landing_page_id );

    // Safety: never run this in admin, login, or AJAX
    if ( is_admin() || wp_doing_ajax() || is_user_logged_in() ) {
        return;
    }

    // If first visit and not already on landing page → redirect
    if ( empty( $_SESSION['visited'] ) ) {
        $_SESSION['visited'] = true;

        if ( ! is_page( $landing_page_id ) ) {
            wp_redirect( $landing_page_url );
            exit;
        }
    }
});
