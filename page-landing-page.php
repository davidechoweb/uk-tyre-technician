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

$theme_options = get_fields('option');

?>

<div id="page-wrapper">
    <div>
        <main id="landing-page">
            <?php if ( $theme_options['top_text'] ) : ?>
            <div class="top-text mb-3">
                <p class="mb-0 text-center"><?php echo $theme_options['top_text']; ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ( $theme_options['pages'] ) : ?>
            <section class="landing-page-content">
                <div class="row h-100 g-3">
                    <div class="homepage col-12 col-md-6">
                        <div class="position-relative h-100">
                            <div class="content-wrap flex-fill">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/uk-tyre.png" alt="Tyre" class="tyre-deco">
                                <div class="box">
                                    <h3 class="h3"><img class="landing-page-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/uk-tyre-logo.png" alt=""></h3>
                                    <a href="<?php echo home_url(); ?>/home" class="echo-button--blue">Homepage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ( $theme_options['pages'] as $page ) : ?>
                        <div class="col-12 col-md-6">
                            <div class="position-relative h-100">
                                <?php
                                    echo wp_get_attachment_image( $page['background_image']['ID'], '', false, [
                                        'loading'  => 'lazy',
                                        'class'    => 'echo-object-fit-cover'
                                    ]);
                                ?>
                                <div class="content-wrap flex-fill">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/uk-tyre.png" alt="Tyre" class="tyre-deco">
                                    <div class="box">
                                        <h3 class="h3"><?php echo $page['page']['title']; ?></h3>
                                        <a href="<?php echo $page['page']['url']; ?>" class="echo-button--blue">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
        </main><!-- #main -->
    </div><!-- .row -->
</div><!-- #page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>