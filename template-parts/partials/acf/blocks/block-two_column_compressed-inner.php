<?php
    $content   = get_sub_field( 'content' );
    $content_2 = get_sub_field( 'content_2' );
?>
<div class="data-padding-normal pt-0">
    <div class="row justify-content-center">
        <div class="col col-12 col-lg-5 px-lg-5 wysiwyg">
            <?php echo $content ?>
        </div>
        <div class="col col-12 col-lg-5 px-lg-5 wysiwyg">
            <?php echo $content_2 ?>
        </div>
    </div>
</div>