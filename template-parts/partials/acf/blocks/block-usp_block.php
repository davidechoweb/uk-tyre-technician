<?php
    $default = array(
        'usp' =>  get_sub_field('usp'),
        'image' =>  get_sub_field('image'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="usp-block position-relative">
    <div class="container">
        <ul class="usp-list list-unstyled mb-0">
            <?php foreach ( $args['usp'] as $usp ) : ?>
            <li><span><p class="h5 mb-0"><?php echo $usp['text']; ?></p></span></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
        echo wp_get_attachment_image( $args['image']['ID'], '', false, [
            'loading'  => 'eager',
            'alt' => 'Background',
            'class' => 'echo-object-fit-cover'
        ]);
    ?>
</div>