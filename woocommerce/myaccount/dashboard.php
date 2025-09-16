<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="row">
    <div class="col-xl-6">
        <div class="echo-form-box">
            <h4 class="h4 uk-margin-medium-top">Recent Orders</h4>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ) ?>" class="echo-button echo-button--blue">View orders</a>
        </div>
    </div>
    <div class="col-xl-6 mt-4 mt-xl-0">
        <div class="echo-form-box">
            <h4 class="h4 uk-margin-medium-top">Your Addresses</h4>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ) ?>" class="echo-button echo-button--blue">Manage addresses</a>
        </div>
    </div>
    <div class="col-xl-6 mt-4">
        <div class="echo-form-box">
            <h4 class="h4 uk-margin-medium-top">Account Details</h4>
            <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ) ?>" class="echo-button echo-button--blue">Edit your password</a>
        </div>
    </div>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */