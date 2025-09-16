<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>

<div class="row">
    <div class="myaccount-nav col-xl-4">
        <?php
            do_action( 'woocommerce_account_navigation' );
        ?>
    </div>

    <div class="myaccount-content col-xl-8 mt-3 mt-xl-0">
        <div class="woocommerce-MyAccount-content">
            <h4 class="h4"><?php echo preg_replace( '/[^a-z0-9]/i', ' ', WC()->query->get_current_endpoint() ?: "Hello " . $current_user->display_name ); ?></h4>
            <?php
                /**
                 * My Account content.
                 *
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_content' );
            ?>
        </div>
    </div>
</div>