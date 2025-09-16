<?php
/**
 * Template Name: Default Page Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div id="page-wrapper">
    <div>
        <main id="primary">
            <?php
                if ( is_cart() ) {
                    echo '<section class="echo-block">';
                        echo '<div class="basket-block">';
                            echo '<div class="container">';
                                echo do_shortcode( '[woocommerce_cart]' );
                            echo '</div>';
                        echo '</div>';
                    echo '</section>';
                } elseif ( is_checkout() ) {
                    echo '<section class="echo-block">';
                        echo '<div class="checkout-block">';
                            echo '<div class="container">';
                                echo do_shortcode( '[woocommerce_checkout]' );
                            echo '</div>';
                        echo '</div>';
                    echo '</section>';
                 } elseif ( is_account_page() ) {
                    echo '<section class="echo-block">';
                        echo '<div class="checkout-block">';
                            echo '<div class="container">';
                                echo do_shortcode( '[woocommerce_my_account]' );
                            echo '</div>';
                        echo '</div>';
                    echo '</section>';
                } else {
                    get_template_part( 'renderer' );
                }
            ?>
            <div hidden class="page-schema"><?php echo get_field('page_schema', $post->ID) ?></div>
        </main><!-- #main -->
    </div><!-- .row -->
</div><!-- #page-wrapper -->

<?php
get_footer();