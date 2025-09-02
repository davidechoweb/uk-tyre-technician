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
                get_template_part( 'renderer' );
            ?>
            <div hidden class="page-schema"><?php echo get_field('page_schema', $post->ID) ?></div>
        </main><!-- #main -->
    </div><!-- .row -->
</div><!-- #page-wrapper -->

<?php
get_footer();