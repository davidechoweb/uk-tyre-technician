<?php
    $default = array(
        'title' =>  get_sub_field('title'),
        'logos' =>  get_sub_field('logos'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="brands position-relative">
    <div class="container">
        <?php if ( $args['title'] ) : ?>
        <p class="h5 text-center text-blue mb-3 mb-md-5"><span><?php echo $args['title']; ?></span></p>
        <?php endif; ?>
    </div>

    <?php if ( $args['logos'] ) : ?>
    <div class="brands-container">
        <div class="brands-slider">
            <?php foreach ( $args['logos'] as $logo ) : ?>
            <div class="col">
                <div class="logo">
                    <?php
                        echo wp_get_attachment_image( $logo['ID'], '', false, [
                            'loading'  => 'lazy',
                        ]);
                    ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
    .brands .tns-nav {
        display: none;
    }

    .brands button[data-action=stop] {
        display: none;
    }
</style>

<script>
    var slider = tns({
        "container": ".brands-slider",
        "items": 1,
        "controls": false,
        "responsive": {
            "640": {
                "items": 2
            },
            "960": {
                "items": 4
            },
            "1200": {
                "items": 6
            }
        },
        "swipeAngle": false,
        "speed": 400,
        "autoplay": true,
    });
</script>