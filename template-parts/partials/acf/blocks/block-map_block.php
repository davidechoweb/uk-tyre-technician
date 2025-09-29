<?php
    $default = array(
        'title' =>  get_sub_field('title'),
        'subtitle' =>  get_sub_field('subtitle'),
        'map_image' =>  get_sub_field('map_image'),
        'map_image_mobile' =>  get_sub_field('map_image_mobile'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="map-block position-relative">
    <div class="header text-lg-center">
        <div class="container">
            <?php if ( $args['title'] ) : ?>
            <h2 class="h2 text-white"><?php echo $args['title']; ?></h2>
            <?php endif; ?>

            <?php if ( $args['subtitle'] ) : ?>
            <p class="subtitle text-white mb-0"><?php echo $args['subtitle']; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="map-section">
        <picture>
            <source 
                srcset="<?php echo wp_get_attachment_image_url( $args['map_image_mobile']['ID'], 'full' ); ?>" 
                media="(max-width: 767px)">
            <img 
                src="<?php echo wp_get_attachment_image_url( $args['map_image']['ID'], 'full' ); ?>" 
                alt="<?php echo esc_attr( get_post_meta( $args['map_image']['ID'], '_wp_attachment_image_alt', true ) ); ?>" 
                loading="lazy"
            >
        </picture>
    </div>
</div>