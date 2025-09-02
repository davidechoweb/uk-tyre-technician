<?php
    $default = array(
        'title' =>  get_sub_field('title'),
        'subtitle' => get_sub_field('subtitle'),
        'cta' => get_sub_field('cta')
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="hero-banner position-relative text-center">
    <div class="container">
        <?php if ( $args['title'] ) : ?>
        <h1 class="h2 text-white mb-4"><?php echo $args['title']; ?></h1>
        <?php endif; ?>

        <?php if ( $args['subtitle'] ) : ?>
        <p class="h5 text-white mb-4"><?php echo $args['subtitle']; ?></p>
        <?php endif; ?>

        <?php if ( $args['cta'] ) : ?>
        <a class="echo-button--white" href="<?php echo $args['cta']['url']; ?>" target="_blank"><?php echo $args['cta']['title']; ?></a>
        <?php endif; ?>
    </div>
    <img class="bg-img echo-object-fit-cover" src="<?php echo get_template_directory_uri(); ?>/images/hero-banner.png" alt="Hero banner background image">
</div>