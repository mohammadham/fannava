<?php

/**
 * fannava_scripts description
 * @return [type] [description]
 */
function fannava_scripts() {

    
    // Shabnam Persian Font
    wp_enqueue_style( 'shabnam-font', FANNAVA_THEME_CSS_DIR.'shabnam-font.css', array(), '1.0.0' );
    
    // all css
    wp_enqueue_style( 'bootstrap', FANNAVA_THEME_CSS_DIR.'bootstrap.min.css', array() );
    wp_enqueue_style( 'fontawesome', FANNAVA_THEME_CSS_DIR.'fontawesome.min.css', array() );
    wp_enqueue_style( 'magnific-popup', FANNAVA_THEME_CSS_DIR.'magnific-popup.css', array() );
    wp_enqueue_style( 'slick', FANNAVA_THEME_CSS_DIR.'slick.css', array() );
    wp_enqueue_style( 'meanmenu', FANNAVA_THEME_CSS_DIR.'meanmenu.css', array() );
    wp_enqueue_style( 'nice-select', FANNAVA_THEME_CSS_DIR.'nice-select.css', array() );
    wp_enqueue_style( 'animate', FANNAVA_THEME_CSS_DIR.'animate.css', array() );
    wp_enqueue_style( 'fannava-core', FANNAVA_THEME_CSS_DIR . 'fannava-core.css', [], time() );
    wp_enqueue_style( 'fannava-style', get_stylesheet_uri() );
    
    // RTL Support
    wp_enqueue_style( 'fannava-rtl', FANNAVA_THEME_CSS_DIR.'fannava-rtl.css', array(), '1.0.0' );
    wp_style_add_data( 'fannava-rtl', 'rtl', 'replace' );

    // all js
   
    // wp_enqueue_script( 'jquery', FANNAVA_THEME_JS_DIR . 'jquery.js', false, true );
    wp_enqueue_script( 'bootstrap', FANNAVA_THEME_JS_DIR . 'bootstrap.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', FANNAVA_THEME_JS_DIR . 'jquery.nice-select.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', FANNAVA_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-counterup', FANNAVA_THEME_JS_DIR . 'jquery.counterup.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'waypoints', FANNAVA_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-meanmenu', FANNAVA_THEME_JS_DIR . 'jquery.meanmenu.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-magnific-popup', FANNAVA_THEME_JS_DIR . 'jquery.magnific-popup.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'inview', FANNAVA_THEME_JS_DIR . 'inview.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', FANNAVA_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'tilt-jquery', FANNAVA_THEME_JS_DIR . 'tilt.jquery.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope', FANNAVA_THEME_JS_DIR . 'isotope.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'circletype', FANNAVA_THEME_JS_DIR . 'circletype.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-lettering', FANNAVA_THEME_JS_DIR . 'jquery.lettering.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-imagesloaded', FANNAVA_THEME_JS_DIR . 'jquery.imagesloaded.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'scrolltotop', FANNAVA_THEME_JS_DIR . 'scrolltotop.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'fannava-main', FANNAVA_THEME_JS_DIR . 'fannava-main.js', [ 'jquery' ], time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'fannava_scripts' );

/*
Register Fonts
 */
function fannava_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'fannava' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&family=Inter:wght@400;500;600;700&family=Spline+Sans:wght@400;500;600;700&display=swap';
    }
    return $font_url;
}
