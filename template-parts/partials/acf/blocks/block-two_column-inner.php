<?php
    $content   = get_sub_field( 'content' );
    $content_2 = get_sub_field( 'content_2' );
?>
<div class="data-padding-normal">
    <div class="row">
        <div class="col col-12 col-lg-6 pe-lg-4 wysiwyg mb-4 mb-lg-0">
            <?php echo $content ?>
        </div>
        <div class="col col-12 col-lg-6  ps-lg-4 wysiwyg mb-4 mb-lg-0">
            <?php echo $content_2 ?>
        </div>
    </div>
</div>