<?php
    $default = array(
        'logos' =>  get_sub_field('logos'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="accreditation-logo position-relative">
    <div class="container">
        <?php if ( $args['logos'] ) : ?>
        <div class="acc-logos row">
            <?php foreach ( $args['logos'] as $logo ) : ?>
            <div class="col">
                <div class="logo text-center">
                    <?php
                        echo wp_get_attachment_image( $logo['logo']['ID'], '', false, [
                            'loading'  => 'lazy',
                            'alt' => $logo['label'],
                            'class' => 'mb-3'
                        ]);
                    ?>
                    <?php if ( $logo['label'] ) : ?>
                    <p class="acc-logo-label mb-0"><?php echo $logo['label']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .accreditation-logo .tns-nav {
        display: none;
    }

    .accreditation-logo button[data-action=stop] {
        display: none;
    }
</style>

<script>
    var slider = tns({
        "container": ".acc-logos",
        "items": 1,
        "controls": false,
        "responsive": {
            "640": {
                "items": 2
            },
            "1200": {
                "items": 3
            }
        },
        "swipeAngle": false,
        "speed": 400,
        "autoplay": true,
    });
</script>