<div class="padding-normal">
    <div class="container">
        <?php
            $content = get_sub_field( 'content' );
            get_template_part( 'renderer', '', array( 'flexible_content_key' => 'content', 'depth' => 'inner' ) );
        ?>
    </div>
</div>