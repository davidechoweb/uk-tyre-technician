<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div class="wrapper" id="error-404-wrapper">

	<section class="echo-block">

		<div class="container" id="content" tabindex="-1">

			<header class="page-header">

			<h1 class="h1 uk-text-bold"><?php esc_html_e( '404', 'understrap' ); ?></h1>
			<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'understrap' ); ?></p>

			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'understrap' ); ?></p>
			</div>

		</div><!-- #content -->

	</section>

</div><!-- #error-404-wrapper -->

<?php
get_footer();
