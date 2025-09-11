<?php

$application_terms = get_terms( array(
    'taxonomy'   => 'application',
    'hide_empty' => false,
));

$brands = get_terms( array(
    'taxonomy'   => 'product_brand',
    'hide_empty' => false,
));

$tread_width = get_terms( array(
    'taxonomy'   => 'tread-width',
    'hide_empty' => false,
));

$profile = get_terms( array(
    'taxonomy'   => 'profile',
    'hide_empty' => false,
));

$rim_size = get_terms( array(
    'taxonomy'   => 'rim-size',
    'hide_empty' => false,
));

?>

<aside class="product-filter-wrap col-md-4">
    <p class="filter-title h5 fw-light mb-3"><span>FILTERS</span></p>
    <form id="product-filter">
        <div class="row mb-4">
            <?php if ( ! empty( $tread_width ) && ! is_wp_error( $tread_width ) ) : ?>
            <div class="col-12 mb-4">
                <p class="h5 fw-bold fst-normal text-capitalize mb-3">Tread Width</p>
                <select name="tread-width" class="echo-form-field w-100">
                    <option value="">Select</option>
                    <?php
                        foreach ( $tread_width as $term ) :
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                        endforeach;
                    ?>
                </select>
            </div>
            <?php endif; ?>
            
            <?php if ( ! empty( $rim_size ) && ! is_wp_error( $rim_size ) ) : ?>
            <div class="col-12 mb-4">
                <p class="h5 fw-bold fst-normal text-capitalize mb-3">Rim Size</p>
                <select name="rim-size" class="echo-form-field w-100">
                    <option value="">Select</option>
                    <?php
                        foreach ( $rim_size as $term ) :
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                        endforeach;
                    ?>
                </select>
            </div>
            <?php endif; ?>

            <?php if ( ! empty( $profile ) && ! is_wp_error( $profile ) ) : ?>
            <div class="col-12">
                <p class="h5 fw-bold fst-normal text-capitalize mb-3">Profile</p>
                <select name="profile" class="echo-form-field w-100">
                    <option value="">Select</option>
                    <?php
                        foreach ( $profile as $term ) :
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                        endforeach;
                    ?>
                </select>
            </div>
            <?php endif; ?>
        </div>

        <div class="accordion">
            <?php if ( ! empty( $application_terms ) && ! is_wp_error( $application_terms ) ) : ?>
            <div class="acc-item">
                <p class="h5 acc-title fw-bold fst-normal text-capitalize">Application <i class="icon icon-plus"></i> <i class="icon icon-minus"></i></p>
                <div class="acc-content">
                    <ul class="list-unstyled">
                        <?php foreach ( $application_terms as $term ) : ?>
                        <li class="mb-2">
                            <label class="echo-checkbox-label">
                                <input type="checkbox" class="echo-form-field" name="application[]" value="<?php echo $term->slug; ?>">
                                <?php echo $term->name; ?>
                            </label>
                        </li> 
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <div class="acc-item">
                <p class="h5 acc-title fw-bold fst-normal text-capitalize">Tyre Quality <i class="icon icon-plus"></i> <i class="icon icon-minus"></i></p>
                <div class="acc-content">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <label class="echo-checkbox-label">
                                <input type="checkbox" class="echo-form-field" name="tyre_quality[]" value="New">
                                New
                            </label>
                        </li>
                        <li class="mb-2">
                            <label class="echo-checkbox-label">
                                <input type="checkbox" class="echo-form-field" name="tyre_quality[]" value="Factory Run">
                                Factory Run
                            </label>
                        </li>
                        <li class="mb-2">
                            <label class="echo-checkbox-label">
                                <input type="checkbox" class="echo-form-field" name="tyre_quality[]" value="Retread">
                                Retread
                            </label>
                        </li>
                        <li class="mb-2">
                            <label class="echo-checkbox-label">
                                <input type="checkbox" class="echo-form-field" name="tyre_quality[]" value="Part Worn">
                                Part Worn
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

            <?php if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) : ?>
            <div class="acc-item">
                <p class="h5 acc-title fw-bold fst-normal text-capitalize">Brand <i class="icon icon-plus"></i> <i class="icon icon-minus"></i></p>
                <div class="acc-content">
                    <ul class="list-unstyled">
                        <?php foreach ( $brands as $term ) : ?>
                        <li class="mb-2">
                            <label class="echo-checkbox-label">
                                <input type="checkbox" class="echo-form-field" name="brand[]" value="<?php echo $term->slug; ?>">
                                <?php echo $term->name; ?>
                            </label>
                        </li> 
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </form>
    <div class="banner bg-primary p-4">
        <h4 class="h4 text-white">Couldn't find what you are looking for?</h4>
        <p class="text-white mb-0">Contact our sales team and we can try to source them for you.</p>
    </div>
</aside>

<script>
    jQuery(document).ready(function($) {
        $(".acc-title").on("click", function() {
            var $item = $(this).closest(".acc-item");

            if ($item.hasClass("active")) {
                // If it's already open, close it
                $item.removeClass("active").find(".acc-content").slideUp();
            } else {
                // Close all others
                $(".acc-item.active").removeClass("active").find(".acc-content").slideUp();

                // Open the clicked one
                $item.addClass("active").find(".acc-content").slideDown();
            }
        });

        // Optional: start with all collapsed
        $(".acc-content").hide();
    });

    jQuery(document).ready(function($) {

        // ===== Update URL & reload when filter changes =====
        $("#product-filter select, #product-filter input[type='checkbox']").on("change", function() {
            let params = new URLSearchParams(window.location.search);

            // Clear all existing filter params first
            $("#product-filter select, #product-filter input[type='checkbox']").each(function() {
                let name = $(this).attr("name");

                if ($(this).is(":checkbox")) {
                    params.delete(name); // reset checkboxes
                } else {
                    params.delete(name); // reset selects
                }
            });

            // Add only active values
            $("#product-filter select, #product-filter input[type='checkbox']:checked").each(function() {
                let name = $(this).attr("name");
                let val = $(this).val();

                if ($(this).is(":checkbox")) {
                    params.append(name, val);
                } else if (val) {
                    params.set(name, val);
                }
            });

            // Refresh page with new parameters
            window.location.search = params.toString();
        });


        // ===== Preselect filters from URL =====
        // function applyActiveFilters() {
        //     let params = new URLSearchParams(window.location.search);

        //     // Dropdowns
        //     $("#product-filter select").each(function() {
        //         let name = $(this).attr("name");
        //         if (params.has(name)) {
        //             $(this).val(params.get(name));
        //         }
        //     });

        //     // Checkboxes
        //     $("#product-filter input[type='checkbox']").each(function() {
        //         let name = $(this).attr("name");
        //         let val = $(this).val();
        //         if (params.getAll(name).includes(val)) {
        //             $(this).prop("checked", true);
        //             $(this).parent('.echo-checkbox-label').addClass('checked-label');
        //         }
        //     });
        // }

        // applyActiveFilters();

        function applyActiveFilters() {
            let params = new URLSearchParams(window.location.search);

            // Track which accordion sections should open
            let openAccordions = [];

            // Dropdowns
            $("#product-filter select").each(function() {
                let name = $(this).attr("name");
                if (params.has(name)) {
                    $(this).val(params.get(name));
                    // Open the parent accordion if this select is inside one
                    let accItem = $(this).closest(".acc-item");
                    if (accItem.length) {
                        openAccordions.push(accItem);
                    }
                }
            });

            // Checkboxes
            $("#product-filter input[type='checkbox']").each(function() {
                let name = $(this).attr("name");
                let val = $(this).val();
                if (params.getAll(name).includes(val)) {
                    $(this).prop("checked", true);
                    $(this).parent('.echo-checkbox-label').addClass('checked-label');

                    // Open the parent accordion if this checkbox is inside one
                    let accItem = $(this).closest(".acc-item");
                    if (accItem.length) {
                        openAccordions.push(accItem);
                    }
                }
            });

            // Open accordions with active filters
            openAccordions.forEach(function(accItem) {
                accItem.addClass("active").find(".acc-content").show(); // show instead of slideDown to avoid animation on load
            });
        }

        applyActiveFilters();

    });
</script>