<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ekobyte_widgets_init() {

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'ekobyte' ),
        'id'            => 'blog-sidebar',
        'description'          => esc_html__( 'Set Your Blog Widget', 'ekobyte' ),
        'before_widget' => '<div id="%1$s" class="sidebar__widget mb-60 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="te-widget-title"><h4 class="wp-block-heading">',
        'after_title'   => '</h4></div>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'ekobyte' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'ekobyte' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer__widget footer-default-widget footer-col-'.$num.' mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="te-footer-widget-title">',
            'after_title'   => '</h2>',
        ] );
    }

    // footer 2
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {

        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'ekobyte' ), $num ),
            'id'            => 'footer-2-' . $num,
            'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'ekobyte' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer__widget footer-default-widget footer__widget-2 footer-col-2-'.$num.' mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="te-footer-widget-title">',
            'after_title'   => '</h2>',
        ] );
    }

}
add_action( 'widgets_init', 'ekobyte_widgets_init' );