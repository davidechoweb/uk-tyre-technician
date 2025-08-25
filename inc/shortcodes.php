<?php
/**
 * Wordpress Shortcodes
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Current year shortcode
 *
 * Print out the current year
 */
add_shortcode('current-year', 'current_year_shortcode');
function current_year_shortcode() {
	return date('Y');
}

/**
 * Website by Echo shortcode
 *
 * Credit Echo with creating the website
 */
add_shortcode( 'by-ews', 'by_ews_shortcode' );
function by_ews_shortcode() {
	return '<a class="by-ews" href="https://www.echowebsolutions.co.uk/websites/" target="_blank" rel="noopener">Website by Echo</a>';
}
