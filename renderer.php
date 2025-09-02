<?php

$default = array(
    'flexible_content_key' => 'acf_block_content',
    'depth'                => false,
    'id'                   => false,
);

$args = wp_parse_args( $args, $default );

if ( have_rows( $args['flexible_content_key'], $args['id'] ) ) {
    $block_index = 0;
    while( have_rows( $args['flexible_content_key'], $args['id'] ) ) : the_row();
        
        $block_index++;
        $block_classes = array();
        $block_anchor  = 'echo-block-' . $block_index;
        $block_classes[] = 'echo-block-' . $block_index;
        $block_classes[] = 'echo-block-' . get_row_layout();

        if( have_settings() ) :
            while( have_settings() ): the_setting();
                $block_anchor = get_sub_field('block_anchor') ?: 'echo-block-' . $block_index;
                /* Settings: Background color */
                $block_classes[] = get_sub_field('background_color');
                $block_classes[] = 'remove_top_spacing_' . get_sub_field('remove_top_spacing');
                $block_classes[] = 'remove_bottom_spacing_' . get_sub_field('remove_bottom_spacing');
                /* Settings: CSS */
                $block_classes[] = implode(' ', get_sub_field('css'));
            endwhile;
        endif;

        /* Clean classes, remove 'default' */
        $block_classes = array_diff( $block_classes, ['default'] );

        $block_template = get_row_layout();

        if ( $args['depth'] ) { $block_template = $block_template . '-' . $args['depth']; }

        $delay = $block_index / 100;

        echo sprintf('<section id="%s" class="echo-block %s">', $block_anchor, trim( implode( ' ', $block_classes ) ) );
            get_template_part( 'template-parts/partials/acf/blocks/block', $block_template, array( 'block_index' => $block_index,  'block_id' => $block_index, 'block_template' => $block_template ) );
        echo '</section>';

    endwhile;
}