<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$theme_options = get_fields('option');

?>

<nav id="mobile-header" class="d-block d-xl-none navbar p-0" aria-labelledby="main-nav-label">
	<div class="mobile-header-top container-fluid">

		<a href="<?php echo get_home_url(); ?>/home" class="header-logo">
			<?php
				echo wp_get_attachment_image( $theme_options['logo']['ID'], '', false, [
					'loading'  => 'eager',
					'alt' => 'UK Tyre Technician',
				]);
			?>
		</a>

		<div class="d-flex align-items-center">
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="login-link"><span class="icon icon-login"></span></a>
			<!-- <div class="mini-basket ms-2">
				<span class="icon icon-basket ms-1"></span>
			</div> -->
			<div class="mini-basket ms-2">
					<?php echo do_shortcode('[xoo_wsc_cart]'); ?>
				</div>
			<button
				class="navbar-toggler ms-2"
				type="button"
				data-bs-toggle="offcanvas"
				data-bs-target="#navbarNavOffcanvas"
				aria-controls="navbarNavOffcanvas"
				aria-expanded="false"
				aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>"
			>
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>

		<div class="offcanvas offcanvas-end bg-primary" tabindex="-1" id="navbarNavOffcanvas">
			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'offcanvas-body',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav justify-content-end flex-grow-1 pe-3',
					'fallback_cb'     => '',
					'menu_id'         => 'mobile-menu',
					'depth'           => 2,
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</div><!-- .offcanvas -->

	</div><!-- .container(-fluid) -->

	<div class="mobile-search">
		<div class="container-fluid">
			<?php echo do_shortcode('[aws_search_form]'); ?>
		</div>
	</div>

</nav><!-- #main-nav -->
