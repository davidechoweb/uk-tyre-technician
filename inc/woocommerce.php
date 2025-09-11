<?php
/**
 * Add WooCommerce support
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function understrap_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add Bootstrap classes to form fields.
		add_filter( 'woocommerce_form_field_args', 'understrap_wc_form_field_args', 10, 3 );
		add_filter( 'woocommerce_form_field_radio', 'understrap_wc_form_field_radio', 10, 4 );
		add_filter( 'woocommerce_quantity_input_classes', 'understrap_quantity_input_classes' );
		add_filter( 'woocommerce_loop_add_to_cart_args', 'understrap_loop_add_to_cart_args' );

		// Wrap the add-to-cart link in `div.add-to-cart-container`.
		add_filter( 'woocommerce_loop_add_to_cart_link', 'understrap_loop_add_to_cart_link' );

		// Add Bootstrap classes to account navigation.
		add_filter( 'woocommerce_account_menu_item_classes', 'understrap_account_menu_item_classes' );
	}
}

// First unhook the WooCommerce content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Then hook in your own functions to display the wrappers your theme requires.
add_action( 'woocommerce_before_main_content', 'understrap_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end', 10 );

if ( ! function_exists( 'understrap_woocommerce_wrapper_start' ) ) {
	/**
	 * Display the theme specific start of the page wrapper.
	 */
	function understrap_woocommerce_wrapper_start() {
		$container = get_theme_mod( 'echo_container_type' );
		if ( false === $container ) {
			$container = '';
		}

		echo '<div class="wrapper echo-block" id="woocommerce-wrapper">';
		echo '<div>';
		echo '<div class="' . esc_attr( $container ) . '" id="content" tabindex="-1">';
		echo '<div class="row">';

		if ( is_shop() || is_product_taxonomy() ) {
			get_template_part( 'global-templates/left-sidebar-check' );
		}

		if ( is_shop() || is_product_taxonomy() ) {
			echo '<main class="col-md-8 site-main" id="product-archive">';
		} else {
			echo '<main class="col-md-12 site-main" id="product-archive">';
		}
	}
}

if ( ! function_exists( 'understrap_woocommerce_wrapper_end' ) ) {
	/**
	 * Display the theme specific end of the page wrapper.
	 */
	function understrap_woocommerce_wrapper_end() {
		echo '</main>';
		get_template_part( 'global-templates/right-sidebar-check' );
		echo '</div><!-- .row -->';
		echo '</div><!-- .container(-fluid) -->';
		echo '</div>';
		echo '</div><!-- #woocommerce-wrapper -->';
	}
}

if ( ! function_exists( 'understrap_wc_form_field_args' ) ) {
	/**
	 * Modifies the form field's arguments by input type. The arguments are used
	 * in `woocommerce_form_field()` to build the form fields.
	 *
	 * @see https://woocommerce.github.io/code-reference/namespaces/default.html#function_woocommerce_form_field
	 *
	 * @param array<string,mixed> $args  Form field arguments.
	 * @param string              $key   Value of the fields name attribute.
	 * @param string|null         $value Value of <select> option.
	 *
	 * @return array<string,mixed> Form field arguments.
	 */
	function understrap_wc_form_field_args( $args, $key, $value ) {
		$bootstrap4 = 'bootstrap4' === get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );

		// Add margin to each form field's html element wrapper (<p></p>).
		if ( $bootstrap4 ) {
			$args['class'][] = 'form-group';
		}
		$args['class'][] = 'mb-3';

		// Start field type switch case.
		switch ( $args['type'] ) {
			case 'country':
				/*
				 * WooCommerce will populate a <select> element of type 'country'
				 * with the country names. $args defined for this specific input
				 * type targets only the country <select> element.
				 */

				$args['class'][] = 'single-country';
				break;
			case 'state':
				/*
				 * WooCommerce will populate a <select> element of type 'state'
				 * with the state names. $args defined for this specific input
				 * type targets only the state <select> element.
				 */

				// Add custom data attributes to the form input itself.
				$args['custom_attributes']['data-plugin']      = 'select2';
				$args['custom_attributes']['data-allow-clear'] = 'true';
				$args['custom_attributes']['aria-hidden']      = 'true';
				break;
			case 'checkbox':
				/*
				 * WooCommerce checkbox markup differs from Bootstrap checkbox
				 * markup. We apply Bootstrap classes such that the WooCommerce
				 * checkbox look matches the Bootstrap checkbox look.
				 */

				// Get Bootstrap version specific CSS class base.
				$base = $bootstrap4 ? 'custom-control' : 'form-check';

				if ( isset( $args['label'] ) ) {
					// Wrap the label in <span> tag.
					$args['label'] = "<span class=\"{$base}-label\">{$args['label']}</span>";
				}

				// Add a class to the form input's <label> tag.
				$args['label_class'][] = $base;
				if ( $bootstrap4 ) {
					$args['label_class'][] = 'custom-checkbox';
				}

				// Add a class to the form input itself.
				$args['input_class'][] = $base . '-input';
				break;
			case 'select':
				/*
				 * Targets all <select> elements, except the <select> elements
				 * of type country or of type state.
				 */

				// Add a class to the form input itself.
				$args['input_class'][] = $bootstrap4 ? 'form-control' : 'form-select';

				// Add custom data attributes to the form input itself.
				$args['custom_attributes']['data-plugin']      = 'select2';
				$args['custom_attributes']['data-allow-clear'] = 'true';
				break;
			case 'radio':
				// Get Bootstrap version specific CSS class base.
				$base = $bootstrap4 ? 'custom-control' : 'form-check';

				$args['label_class'][] = $base . '-label';
				$args['input_class'][] = $base . '-input';
				break;
			default:
				$args['input_class'][] = 'form-control';
				break;
		} // End of switch ( $args ).
		return $args;
	}
}

if ( ! function_exists( 'understrap_wc_form_field_radio' ) ) {
	/**
	 * Adjust the WooCommerce checkout/address radio fields to match the look of
	 * Bootstrap radio fields.
	 *
	 * Wraps each radio field (`<input>`+`<label>`) in a `.from-check`.
	 *
	 * If `$args['label']` is set a `<label>` tag is prepended to the radio
	 * fields. `$args['label_class']` is used for the class attribute of this
	 * tag and the class attribute of the actual input labels. Hence, we must
	 * remove the first occurance of the label class added via
	 * `understrap_wc_form_field_args()` that is meant for input labels only.
	 *
	 * @param string              $field The field's HTML incl. the wrapper element.
	 * @param string              $key   The wrapper element's id attribute value.
	 * @param array<string|mixed> $args  An array of field arguments.
	 * @param string|null         $value The field's value.
	 * @return string
	 */
	function understrap_wc_form_field_radio( $field, $key, $args, $value ) {

		// Set up Bootstrap version specific variables.
		if ( 'bootstrap4' === get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' ) ) {
			$wrapper_classes = 'custom-control custom-radio';
			$label_class     = 'custom-control-label';
		} else {
			$wrapper_classes = 'form-check';
			$label_class     = 'form-check-label';
		}

		// Remove the first occurance of the label class if neccessary.
		if ( isset( $args['label'] ) && isset( $args['label_class'] ) ) {
			$strpos = strpos( $field, $label_class );
			if ( false !== $strpos ) {
				$field = substr_replace( $field, '', $strpos, strlen( $label_class ) );

				/*
				 * If $label_class was the only class in $args['label_class']
				 * then there is an empty class attribute now. Let's remove it.
				 */
				$field = str_replace( 'class=""', '', $field );
			}
		}

		// Wrap each radio in a <span.from-check>.
		$field = str_replace( '<input', "<span class=\"{$wrapper_classes}\"><input", $field );
		$field = str_replace( '</label>', '</label></span>', $field );
		if ( isset( $args['label'] ) ) {
			// Remove the closing span tag from the first <label> element.
			$strpos = strpos( $field, '</label>' ) + strlen( '</label>' );
			$field  = substr_replace( $field, '', $strpos, strlen( '</span>' ) );
		}

		return $field;
	}
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
	/**
	 * Check if reviews are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_reviews_enabled() {
		return 'yes' === get_option( 'woocommerce_enable_reviews' );
	}

	/**
	 * Check if reviews ratings are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_review_ratings_enabled() {
		return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
	}
}

if ( ! function_exists( 'understrap_quantity_input_classes' ) ) {
	/**
	 * Add Bootstrap class to quantity input field.
	 *
	 * @param array $classes Array of quantity input classes.
	 * @return array
	 */
	function understrap_quantity_input_classes( $classes ) {
		$classes[] = 'form-control';
		return $classes;
	}
}

if ( ! function_exists( 'understrap_loop_add_to_cart_link' ) ) {
	/**
	 * Wrap add to cart link in container.
	 *
	 * @param string $html Add to cart link HTML.
	 * @return string Add to cart link HTML.
	 */
	function understrap_loop_add_to_cart_link( $html ) {
		return '<div class="add-to-cart-container">' . $html . '</div>';
	}
}

if ( ! function_exists( 'understrap_loop_add_to_cart_args' ) ) {
	/**
	 * Add Bootstrap button classes to add to cart link.
	 *
	 * @param array<string,mixed> $args Array of add to cart link arguments.
	 * @return array<string,mixed> Array of add to cart link arguments.
	 */
	function understrap_loop_add_to_cart_args( $args ) {
		if ( isset( $args['class'] ) && ! empty( $args['class'] ) ) {
			if ( ! is_string( $args['class'] ) ) {
				return $args;
			}

			// Remove the `button` class if it exists.
			if ( false !== strpos( $args['class'], 'button' ) ) {
				$args['class'] = explode( ' ', $args['class'] );
				$args['class'] = array_diff( $args['class'], array( 'button' ) );
				$args['class'] = implode( ' ', $args['class'] );
			}

			$args['class'] .= ' btn btn-outline-primary';
		} else {
			$args['class'] = 'btn btn-outline-primary';
		}

		if ( 'bootstrap4' === get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' ) ) {
			$args['class'] .= ' btn-block';
		}

		return $args;
	}
}

if ( ! function_exists( 'understrap_account_menu_item_classes' ) ) {
	/**
	 * Add Bootstrap classes to the account navigation.
	 *
	 * @param string[] $classes Array of classes added to the account menu items.
	 * @return string[] Array of classes added to the account menu items.
	 */
	function understrap_account_menu_item_classes( $classes ) {
		$classes[] = 'list-group-item';
		$classes[] = 'list-group-item-action';
		if ( in_array( 'is-active', $classes, true ) ) {
			$classes[] = 'active';
		}
		return $classes;
	}
}

/* Function to create extra rules for the sale badge */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
// add_action( 'woocommerce_before_single_product_summary', 'bbloomer_new_badge_shop_page', 10 );

function bbloomer_new_badge_shop_page() {
	global $product;

	$StockQ=$product->get_stock_quantity();

	// you can add custom messages via ACF and a color option so the client can add their own message
	$message = get_field( 'custom_badge_text', $product->get_ID() );
	$color = get_field( 'custom_badge_color', $product->get_ID() );

	if ($message) {

		echo apply_filters( 'woocommerce_sale_flash', '<span class="special-badge '. $color .' ">' . esc_html__( $message, 'woocommerce' ) . '</span>', $product );
	
	} elseif ( $product->is_on_sale() ) {

		echo apply_filters( 'woocommerce_sale_flash', '<span class="special-badge sale">' . esc_html__( 'On Sale', 'woocommerce' ) . '</span>', $product );

	} elseif ( $StockQ > 0 ) {

		echo apply_filters( 'woocommerce_sale_flash', '<span class="special-badge instock blue">' . esc_html__( 'In Stock', 'woocommerce' ) . '</span>', $product );

	} elseif( $StockQ <= 0 ) {
		
		if ( $product->backorders_allowed() ) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="special-badge outstock grey">' . esc_html__( 'Pre Orderaa', 'woocommerce' ) . '</span>', $product );
		} else {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="special-badge outstock">' . esc_html__( 'Out of Stock', 'woocommerce' ) . '</span>', $product );
		}

	} else {
		echo apply_filters( 'woocommerce_sale_flash', '<span class="special-badge instock blue">' . esc_html__( 'In Stock', 'woocommerce' ) . '</span>', $product );
	}
}

//remove zoom from single product image on hover
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

// disable breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// remove result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// remove default filter
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Shop/Archive pages
add_filter( 'woocommerce_product_add_to_cart_text', function( $text, $product ) {
    // Example: change text depending on product type
    if ( $product->is_type( 'simple' ) ) {
        return __( 'Buy Now', 'uk-tyre-technician' );
    }
    // if ( $product->is_type( 'variable' ) ) {
    //     return __( 'Choose Options', 'uk-tyre-technician' );
    // }
    return $text;
}, 10, 2 );

// disable price on product cards
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

add_action( 'woocommerce_after_shop_loop_item_title', 'my_add_content_inside_product_link', 15 );
function my_add_content_inside_product_link() {
	global $product; 

	$terms = wp_get_post_terms( $product->get_id(), 'rating');

	if ( $terms[0]->name == 'Premium' ) {
		echo '<span class="rating-badge"><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><span>' . $terms[0]->name . '</span></span>';
	} elseif ( $terms[0]->name == 'Mid Range' ) {
		echo '<span class="rating-badge"><i class="icon icon-star"></i><i class="icon icon-star"></i><i class="icon icon-star"></i><span>' . $terms[0]->name . '</span></span>';
	}
}

// allow products filter by acf fields
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'product' ) ) {

        if ( isset( $_GET['tyre_quality'] ) && ! empty( $_GET['tyre_quality'] ) ) {
            $tyre_qualities = (array) $_GET['tyre_quality'];

            $meta_query = (array) $query->get( 'meta_query' );

            $meta_query[] = array(
                'key'     => 'quality', // your ACF field name
                'value'   => $tyre_qualities,
                'compare' => 'IN'
            );

            $query->set( 'meta_query', $meta_query );
        }
    }
});

add_filter( 'woocommerce_pagination_args', function( $args ) {
    $args['prev_text'] = '&#x276E;';
    $args['next_text'] = '&#x276F;';
    return $args;
});

// Change placeholder globally (product pages + archives)
add_filter( 'woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder', 10 );
function custom_woocommerce_placeholder( $src ) {
    // Use your custom image
    $src = get_stylesheet_directory_uri() . '/images/tyre-placeholder.jpg';
    return $src;
}

// Also override the function WooCommerce calls for HTML <img> output
add_filter( 'woocommerce_placeholder_img', 'custom_woocommerce_placeholder_img' );
function custom_woocommerce_placeholder_img( $image_html ) {
    $src = get_stylesheet_directory_uri() . '/images/tyre-placeholder.jpg';
    $image_html = '<img src="' . esc_url( $src ) . '" alt="Placeholder" class="woocommerce-placeholder wp-post-image" />';
    return $image_html;
}

// remove related product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Add custom HTML below the product title on single product page
add_action( 'woocommerce_single_product_summary', 'html_below_product_title', 6 );
function html_below_product_title() {
	global $product;
    echo '<div class="serial-number">Serial No: ' . get_field( 'tyre_details', $product->get_id() )['serial_number'] . '</div>';
}