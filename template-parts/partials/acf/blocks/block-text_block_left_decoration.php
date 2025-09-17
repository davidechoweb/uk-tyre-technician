<?php
    $default = array(
        'content_1' =>  get_sub_field('content_1'),
        'content_2' =>  get_sub_field('content_2'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="text-block-left-decoration">
    <div class="position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="deco"></div>
                <div class="content-1 col-xl-6">
                    <div><?php echo $args['content_1'] ?></div>
                </div>
                <div class="content-2 col-xl-6">
                    <?php echo $args['content_2'] ?>
                </div>
            </div>
        </div>
    </div>
</div>