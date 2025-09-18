<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'echo_container_type' );

$theme_options = get_fields('option');

?>

<nav id="main-nav" class="d-none d-xl-block" aria-labelledby="main-nav-label">
	<div class="header-top">
		<div class="container-fluid d-flex align-items-center justify-content-between">
			<div class="header-left d-flex align-items-center">
				<a href="<?php echo get_home_url(); ?>" class="header-logo">
					<?php
						echo wp_get_attachment_image( $theme_options['logo']['ID'], '', false, [
							'loading'  => 'eager',
							'alt' => 'UK Tyre Technician',
						]);
					?>
				</a>
				<div class="header-left-content d-flex align-items-center">
					<p class="logo-24-7 mb-0 ms-4"><img src="<?php echo get_template_directory_uri(); ?>/images/24-7.svg" alt="Tyre Management"><span class="ms-2">Tyre Management</span></p>
					<div class="contact-details d-flex align-items-center ms-4">
						<p class="phone-number mb-0">CALL <span><?php echo $theme_options['contact_details']['contact_number']; ?></span></p>
						<p class="business-hours mb-0 ms-4"><?php echo $theme_options['contact_details']['business_hours']; ?></p>
					</div>
				</div>
			</div>
			<div class="header-right d-flex align-items-center">
				<?php echo do_shortcode('[aws_search_form]'); ?>
				<a class="my-account-btn echo-button--blue ms-3" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo is_user_logged_in() ? 'My Account' : 'Login/Register'; ?></a>
				<!-- <a href="#" class="login-link ms-3"><span class="icon icon-login"></span></a> -->
				<!-- <a href="#" class="xoo-wsc-cart-trigger mini-basket ms-3">
					<span class="mini-basket-label">BASKET / £0.00</span>
					<span class="icon icon-basket ms-1"><?php echo esc_html( xoo_wsc_cart()->get_cart_count() ) ?></span>
				</a> -->
				<div class="mini-basket ms-3">
					<?php echo do_shortcode('[xoo_wsc_cart]'); ?>
				</div>
			</div>
		</div>
	</div>

	<?php if ( $theme_options['header_text'] ) : ?>
	<div class="header-bottom">
		<p class="mb-0"><?php echo $theme_options['header_text']; ?></p>
	</div>
	<?php endif; ?>

	<div class="header-menu">
		<div class="container-fluid">
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'menu-container',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ms-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
			?>
		</div>
	</div>
</nav><!-- #main-nav -->
