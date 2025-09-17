<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'echo_container_type' );

$theme_options = get_fields('option');

$footer_menus = get_nav_menu_locations();

function get_menu_name($id) {
	$menu_obj = wp_get_nav_menu_object( $id );

	return $menu_obj->name;
}

?>

<footer id="footer">
	<div class="footer-top mb-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm">
					<div class="row">
						<div class="col-6 col-xl">
							<p class="menu-label h5 fw-bold text-white"><?php echo get_menu_name($footer_menus['footer_1']); ?></p>
							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_1',
										'menu_class' => 'footer-links list-unstyled mb-0'
									)
								);
							?>
						</div>
						<div class="col-6 col-xl">
							<p class="menu-label h5 fw-bold text-white"><?php echo get_menu_name($footer_menus['footer_2']); ?></p>
							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_2',
										'menu_class' => 'footer-links list-unstyled mb-0'
									)
								);
							?>
						</div>
						<div class="col-6 col-xl mt-5 mt-xl-0">
							<p class="menu-label h5 fw-bold text-white"><?php echo get_menu_name($footer_menus['footer_3']); ?></p>
							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_3',
										'menu_class' => 'footer-links list-unstyled mb-0'
									)
								);
							?>
						</div>
						<div class="col-6 col-xl-4 mt-5 mt-xl-0">
							<p class="menu-label h5 fw-bold text-white"><?php echo get_menu_name($footer_menus['footer_4']); ?></p>
							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_4',
										'menu_class' => 'footer-links list-unstyled mb-0'
									)
								);
							?>
						</div>
					</div>
				</div>
				<div class="contact-column col-12 col-sm-2 mt-5 mt-sm-0">
					<p class="menu-label h5 fw-bold text-white">Contact</p>
					<p class="fw-bold text-white mb-1">Location</p>
					<p class="text-white"><?php echo $theme_options['contact_details']['address']; ?></p>
					<p class="text-white mb-0">
						Tel No: <?php echo $theme_options['contact_details']['contact_number']; ?><br>
						Fax: <?php echo $theme_options['contact_details']['fax_number']; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="h5 fw-bold text-white">Newsletter</p>
					<div class="newsletter-form">
						<?php echo do_shortcode('[contact-form-7 id="3c7294c" title="Newsletter"]'); ?>
					</div>
					<div class="copyright-section">
						<p class="copyright text-white">© <?php echo date('Y') ?> UK TYRE TECHNICIAN</p>
						<p class="bottom-links"><a href="/privacy-policy">Privacy Policy</a><span class="divider">|</span><a href="/cookie-policy">Use of Cookies</a><!--<span class="divider"> |</span><a href="#">Terms of Use</a> --></p>
						<p class="text-white">Web design by <a href="https://www.echowebsolutions.co.uk/web-design-peterborough/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/echo-logo.svg" alt="Echo" style="vertical-align: baseline;"></a></p>
					</div>
				</div>
				<div class="contact-column col-12 col-sm-2">
					<div class="d-flex flex-wrap h-100">
						<div>
							<p class="fw-bold text-white mb-1">Email</p>
							<p class="text-white mb-0"><?php echo $theme_options['contact_details']['contact_email']; ?></p>
						</div>

						<?php if ( $theme_options['social_links'] ) : ?>
						<ul class="social-links d-flex list-unstyled mb-0">
							<?php foreach ( $theme_options['social_links'] as $social_link ) : ?>
							<li><a href="<?php echo $social_link['url'] ?>" target="_blank"><i class="icon icon-<?php echo $social_link['social_media'] ?>"></i></a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

