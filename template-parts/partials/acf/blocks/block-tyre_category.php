<?php
    $default = array(
        'title' =>  get_sub_field('title'),
        'categories' =>  get_sub_field('categories'),
    );
    
    $args = wp_parse_args( $args, $default );
?>
<div class="tyre-category position-relative">
    <div class="container">
        <?php if ( $args['title'] ) : ?>
        <p class="block-title mb-3"><span><?php echo $args['title']; ?></span></p>
        <?php endif; ?>

        <?php if ( $args['categories'] ) : ?>
        <div class="tyre-categories row">
            <?php foreach ( $args['categories'] as $key => $category ) : ?>
            <div class="col-md-4 <?php echo ( $key != 0 ) ? 'mt-4 mt-xl-0' : ''; ?>">
                <div class="top-part mb-3">
                    <p class="category-title h2 mb-0 text-center text-wite"><?php echo $category['title'] ?></p>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tyre-category-image.jpg" class="w-100" alt="<?php echo $category['title'] ?>" loading="lazy">
                </div>
                <?php if ( $category['cta'] ) : ?>
                <div class="cta-group">
                    <?php if ( $category['cta']['cta_title'] ) : ?>
                    <p class="cta-label"><span><?php echo $category['cta']['cta_title']; ?></span></p>
                    <?php endif; ?>
                    <div class="ctas row">
                        <?php foreach ( $category['cta']['ctas'] as $cta ) : ?>
                        <div class="cta col">
                            <a href="<?php echo $cta['cta']['url']; ?>" target="<?php echo $cta['cta']['target']; ?>"><?php echo $cta['cta']['title']; ?></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        function equalizeCategoryTitles() {
            var maxHeight = 0;

            // Reset heights first (important on resize)
            $('.category-title').css('height', 'auto');

            // Find tallest
            $('.category-title').each(function() {
                var h = $(this).outerHeight();
                if (h > maxHeight) {
                    maxHeight = h;
                }
            });

            // Apply tallest height
            $('.category-title').css('height', maxHeight + 'px');
        }

        // Run on load
        equalizeCategoryTitles();

        // Run again on window resize
        $(window).on('resize', function() {
            equalizeCategoryTitles();
        });
    });
</script>