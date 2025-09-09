<?php
    $default = array(
        'title' =>  get_sub_field('title'),
        'form' =>  get_sub_field('form'),
    );
    
    $args = wp_parse_args( $args, $default );

    $theme_options = get_fields('option');
?>
<div class="contact-form position-relative">
    <div class="container">
        <div class="row justify-content-between align-items-center mb-5">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                <h2 class="h2 mb-3 mb-sm-0">Get in touch</h2>
            </div>
            <div class="col-12 col-sm-6 d-flex justify-content-center justify-content-sm-end">
                <p class="logo-24-7 mb-0">
                    <img src="<?php echo get_template_directory_uri() ?>/images/24-7.svg" alt="Tyre Management">
                    <span class="fw-bold ms-2">Tyre Management</span>
                </p>
            </div>
        </div>
        <div class="form">
            <?php echo do_shortcode('[contact-form-7 id="' . $args['form']->ID . '"]'); ?>
        </div>
    </div>
    <div class="contact-details">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start align-items-center">
                    <div class="phone-wrap d-flex align-items-center">
                        <img class="me-3" src="<?php echo get_template_directory_uri(); ?>/images/tel-icon.svg" alt="<?php echo $theme_options['contact_details']['contact_number']; ?>">
                        <div class="d-block d-xl-flex">
                            <p class="phone mb-0">
                                <span class="label">CALL</span> <?php echo $theme_options['contact_details']['contact_number']; ?>
                            </p>
                            <p class="business-hours mb-0 ms-0 ms-xl-5">
                                Mon - Fri 8am - 5pm<br class="d-none d-xl-block">
                                Saturday 8am - 12pm
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start align-items-center">
                    <div class="email-wrap d-block d-xl-flex align-items-center">
                        <p class="email mb-0">
                            <img class="me-3" src="<?php echo get_template_directory_uri(); ?>/images/email-icon.svg" alt="<?php echo $theme_options['contact_details']['contact_email']; ?>">
                            <span class="label">Email</span> <?php echo $theme_options['contact_details']['contact_email']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>