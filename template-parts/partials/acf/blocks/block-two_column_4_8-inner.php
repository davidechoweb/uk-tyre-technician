<?php
    $content   = get_sub_field( 'content' );
    $content_2 = get_sub_field( 'content_2' );
?>
<div class="data-padding-normal">
    <div class="row">
        <div class="col col-12 col-lg-4 pe-lg-4 wysiwyg">
            <?php echo $content ?>
        </div>
        <div class="col col-12 col-lg-8  ps-lg-4 wysiwyg">
            <?php echo $content_2 ?>
        </div>
    </div>
</div>