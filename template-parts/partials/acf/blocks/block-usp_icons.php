<?php
    $default = array(
        'title' =>  get_sub_field('title'),
        'subtitle' =>  get_sub_field('subtitle'),
        'usp' =>  get_sub_field('usp'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="usp-icons position-relative">
    <div class="container">
        <div class="text-center mb-3 mb-md-5">
            <?php if ( $args['title'] ) : ?>
            <h2 class="h2"><?php echo $args['title']; ?></h2>
            <?php endif; ?>

            <?php if ( $args['subtitle'] ) : ?>
            <p class="lead-text text-blue"><?php echo $args['subtitle']; ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $args['usp'] ) : ?>
        <div class="usps row">
            <?php foreach ( $args['usp'] as $usp ) : ?>
            <div class="usp col-6 col-md-4 text-center">
                <?php
                    echo wp_get_attachment_image( $usp['icon']['ID'], '', false, [
                        'loading'  => 'lazy',
                        'alt' => $usp['label'],
                        'class' => 'mb-3'
                    ]);
                ?>
                <p class="usp-label fst-italic mb-0 fw-bold"><?php echo $usp['label'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>