<?php

/**
 * Output the shortcode right after the closing <a> tag
 */

 function echo_add_menu_popup($item_output, $item) {
    
    if ( ! get_post_meta( $item->ID, '_menu_item_html', true ) ) {
        return $item_output;
    }

    $popup  = '<div class="dropdown-menu drop-slide drop-animate echo-menu-shortcode">';
    $popup .= do_shortcode( get_post_meta( $item->ID, '_menu_item_html', true ) );
    $popup .= '</div>';

    return $item_output . $popup;

}

add_filter('walker_nav_menu_start_el', 'echo_add_menu_popup', 15, 2);

/**
 * Add a shortcode field
 */

 function echo_menu_item_desc( $item_id, $item, $depth ) {
    if ( $depth !== 0 ) { return; }
	$menu_item_desc = get_post_meta( $item_id, '_menu_item_html', true );
	?>
	<div style="clear: both;">
	    <span class="description"><?php _e( "Custom HTML / shortcode", 'menu-item-desc' ); ?></span><br />
	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
	    <div class="logged-input-holder">
	        <input type="text" class="widefat" name="menu_item_desc[<?php echo $item_id ;?>]" id="menu-item-desc-<?php echo $item_id ;?>" value="<?php echo esc_attr( $menu_item_desc ); ?>" />
	    </div>
	</div>
	<?php
}

add_action( 'wp_nav_menu_item_custom_fields', 'echo_menu_item_desc', 10, 3 );

/**
 * Save the shortcode 
 */

 function echo_save_menu_item_html( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST['menu_item_desc'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['menu_item_desc'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_menu_item_html', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_html' );
	}
}

add_action( 'wp_update_nav_menu_item', 'echo_save_menu_item_html', 10, 2 );

/**
 * Add class on nav item if it has a shortcode
 */
function echo_nav_menu_css_class( $atts, $menu_item, $args, $depth ) {

    if ( ! get_post_meta( $menu_item->ID, '_menu_item_html', true ) ) {
        return $atts;
    }

    $atts['data-toggle']    = 'dropdown';
    $atts['data-bs-toggle'] = 'dropdown';
    $atts['data-bs-auto-close'] = 'outside';
    $atts['aria-haspopup']  = 'true';
    $atts['aria-expanded']  = 'false';

    if (!isset($atts["class"])) {
        $atts["class"] = '';
    }

    $atts["class"] .= " icon icon-chevron-down dropdown";

    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'echo_nav_menu_css_class', 10, 4 );

// employee
function employee_shortcode() {
    ob_start();
    $theme_options = get_fields('option');
    $empoloyee_menu = $theme_options['employee_menu'];
?>
<div class="employee-menu menu-container container text-color--white">
    <div class="row">
        <div class="links-wrap col-xl-8">
            <a href="#" class="mega-menu-back d-block d-xl-none"><span class="icon-chevron-left"></span>Back</a>
            <h3 class="menu-heading"><?php echo $empoloyee_menu['menu_heading']; ?></h3>
            <?php if ( $empoloyee_menu['links'] ) : ?>
            <ul class="mega-menu-links d-xl-flex flex-wrap list-unstyled">
                <?php foreach ( $empoloyee_menu['links'] as $link ) : ?>
                <li><a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="photo-wrap col-4 d-none d-xl-block">
            <?php
                echo wp_get_attachment_image( $empoloyee_menu['image']['ID'], '', false, [
                    'loading'  => 'lazy',
                    'alt' => 'PJH Law',
                ]);
            ?>
        </div>
    </div>
</div>
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('employee_shortcode', 'employee_shortcode');

// employer
function employer_shortcode() {
    ob_start();
    $theme_options = get_fields('option');
    $empoloyer_menu = $theme_options['employer_menu'];
?>
<div class="employer-menu menu-container container text-color--white">
    <div class="row">
        <div class="links-wrap col-xl-8">
            <a href="#" class="mega-menu-back d-block d-xl-none"><span class="icon-chevron-left"></span>Back</a>
            <h3 class="menu-heading"><?php echo $empoloyer_menu['menu_heading']; ?></h3>
            <?php if ( $empoloyer_menu['links'] ) : ?>
            <ul class="mega-menu-links d-xl-flex flex-wrap list-unstyled">
                <?php foreach ( $empoloyer_menu['links'] as $link ) : ?>
                <li><a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="photo-wrap col-4 d-none d-xl-block">
            <?php
                echo wp_get_attachment_image( $empoloyer_menu['image']['ID'], '', false, [
                    'loading'  => 'lazy',
                    'alt' => 'PJH Law',
                ]);
            ?>
        </div>
    </div>
</div>
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('employer_shortcode', 'employer_shortcode');

// news
function news_shortcode() {
    ob_start();
    $theme_options = get_fields('option');
    $news_menu = $theme_options['news_menu'];
?>
<div class="news-menu menu-container container text-color--white">
    <div class="row">
        <div class="links-wrap col-xl-4">
            <a href="#" class="mega-menu-back d-block d-xl-none"><span class="icon-chevron-left"></span>Back</a>
            <h3 class="menu-heading"><?php echo $news_menu['menu_heading']; ?></h3>
            <?php if ( $news_menu['links'] ) : ?>
            <ul class="mega-menu-links d-flex flex-wrap list-unstyled">
                <?php foreach ( $news_menu['links'] as $link ) : ?>
                <li><a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="articles-wrap col-8 d-none d-xl-block">
            <?php if ($news_menu['articles']) : ?>
            <div class="row gx-5">
                <?php foreach ( $news_menu['articles'] as $article ) : ?>
                <div class="col-4">
                    <div class="article-card bg-white">
                        <div class="img-wrap">
                            <?php
                                if ( get_post_thumbnail_id($article->ID) ) {
                                    echo wp_get_attachment_image( get_post_thumbnail_id( $article->ID ), '', false, [
                                        'loading'  => 'lazy',
                                        'alt' => $article->post_title,
                                        'class' => 'echo-object-fit-cover'
                                    ]);
                                } else {
                                    echo '<img class="echo-object-fit-cover" src="' . get_template_directory_uri() . '/img/default-card-image.jpg" alt="' . $article->post_title . '">';
                                }
                            ?>
                        </div>
                        <div class="info-wrap">
                            <p class="h4 text-color--black"><?php echo $article->post_title; ?></p>
                            <p class="text-color--black"><?php echo get_custom_excerpt(get_the_ID(), 8); ?></p>
                            <a href="<?php echo get_the_permalink(); ?>" class="echo-button--primary">Read More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('news_shortcode', 'news_shortcode');

// about
function about_shortcode() {
    ob_start();
    $theme_options = get_fields('option');
    $about_menu = $theme_options['about_menu'];
?>
<div class="about-menu menu-container container text-color--white">
    <div class="row">
        <div class="links-wrap col-xl-4">
            <a href="#" class="mega-menu-back d-block d-xl-none"><span class="icon-chevron-left"></span>Back</a>
            <h3 class="menu-heading"><?php echo $about_menu['menu_heading']; ?></h3>
            <?php if ( $about_menu['links'] ) : ?>
            <ul class="mega-menu-links d-flex flex-wrap list-unstyled">
                <?php foreach ( $about_menu['links'] as $link ) : ?>
                <li><a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="photo-wrap col-8 d-none d-xl-block">
            <?php
                echo wp_get_attachment_image( $about_menu['image']['ID'], '', false, [
                    'loading'  => 'lazy',
                    'alt' => 'PJH Law',
                ]);
            ?>
        </div>
    </div>
</div>
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('about_shortcode', 'about_shortcode');