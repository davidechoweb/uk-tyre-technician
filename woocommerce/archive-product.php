<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$theme_options = get_fields('option');

$term = get_queried_object();

?>

<section id="main-wc-page" class="echo-block remove_bottom_spacing_1">
	<div class="padding-normal">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6">
					<h2 class="h2"><?php echo $term->name; ?></h2>
					<div class="text-container">
						<p><?php echo $term->description; ?></p>
						<div class="mt-3">
							<a href="/24hr-breakdown-service" class="echo-button--blue">Get in touch</a><br><br>
							<a href="tel:<?php echo $theme_options['contact_details']['contact_number']; ?>" class="echo-button--green">Call us</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 mt-3 mt-xl-0">
					<img src="<?php echo get_template_directory_uri(); ?>/images/shop-tyre-image.jpg" alt="New & Used Tyres">
				</div>
			</div>
		</div>
	</div>
</section>

<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

?>

<?php
	echo '<div class="echo-block echo-block-contact_form">';
	// page title
	$args = array(
		'title' => 'Get in touch',
		'form' => get_post(274)
	);
	get_template_part( 'template-parts/partials/acf/blocks/block-contact_form', '', $args );
	echo '</div>';
?>

<?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
