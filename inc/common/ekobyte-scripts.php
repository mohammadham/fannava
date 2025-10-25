<?php

/**
 * ekobyte_scripts description
 * @return [type] [description]
 */
function ekobyte_scripts() {

    
    // google fonts
    wp_enqueue_style( 'ekobyte-fonts', ekobyte_fonts_url(), array(), '1.0.0' );
    // all css
    
    wp_enqueue_style( 'bootstrap', EKOBYTE_THEME_CSS_DIR.'bootstrap.min.css', array() );
    wp_enqueue_style( 'fontawesome', EKOBYTE_THEME_CSS_DIR.'fontawesome.min.css', array() );
    wp_enqueue_style( 'magnific-popup', EKOBYTE_THEME_CSS_DIR.'magnific-popup.css', array() );
    wp_enqueue_style( 'slick', EKOBYTE_THEME_CSS_DIR.'slick.css', array() );
    wp_enqueue_style( 'meanmenu', EKOBYTE_THEME_CSS_DIR.'meanmenu.css', array() );
    wp_enqueue_style( 'nice-select', EKOBYTE_THEME_CSS_DIR.'nice-select.css', array() );
    wp_enqueue_style( 'animate', EKOBYTE_THEME_CSS_DIR.'animate.css', array() );
    wp_enqueue_style( 'ekobyte-core', EKOBYTE_THEME_CSS_DIR . 'ekobyte-core.css', [], time() );
    wp_enqueue_style( 'ekobyte-style', get_stylesheet_uri() );

    // all js
   
    // wp_enqueue_script( 'jquery', EKOBYTE_THEME_JS_DIR . 'jquery.js', false, true );
    wp_enqueue_script( 'bootstrap', EKOBYTE_THEME_JS_DIR . 'bootstrap.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', EKOBYTE_THEME_JS_DIR . 'jquery.nice-select.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', EKOBYTE_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-counterup', EKOBYTE_THEME_JS_DIR . 'jquery.counterup.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'waypoints', EKOBYTE_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-meanmenu', EKOBYTE_THEME_JS_DIR . 'jquery.meanmenu.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-magnific-popup', EKOBYTE_THEME_JS_DIR . 'jquery.magnific-popup.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'inview', EKOBYTE_THEME_JS_DIR . 'inview.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', EKOBYTE_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'tilt-jquery', EKOBYTE_THEME_JS_DIR . 'tilt.jquery.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope', EKOBYTE_THEME_JS_DIR . 'isotope.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'circletype', EKOBYTE_THEME_JS_DIR . 'circletype.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-lettering', EKOBYTE_THEME_JS_DIR . 'jquery.lettering.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-imagesloaded', EKOBYTE_THEME_JS_DIR . 'jquery.imagesloaded.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'scrolltotop', EKOBYTE_THEME_JS_DIR . 'scrolltotop.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'ekobyte-main', EKOBYTE_THEME_JS_DIR . 'ekobyte-main.js', [ 'jquery' ], time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ekobyte_scripts' );

/*
Register Fonts
 */
function ekobyte_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'ekobyte' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&family=Inter:wght@400;500;600;700&family=Spline+Sans:wght@400;500;600;700&display=swap';
    }
    return $font_url;
}
