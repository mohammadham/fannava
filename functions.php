<?php

/**
 * ekobyte functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ekobyte
 */

if ( !function_exists( 'ekobyte_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ekobyte_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on ekobyte, use a find and replace
         * to change 'ekobyte' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'ekobyte', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'ekobyte' ),
            'category-menu' => esc_html__( 'Category Menu', 'ekobyte' ),
            'footer-menu' => esc_html__( 'Footer Menu', 'ekobyte' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'ekobyte_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        remove_theme_support( 'widgets-block-editor' );

        add_image_size( 'ekobyte-case-details', 1170, 600, [ 'center', 'center' ] );
    }
endif;
add_action( 'after_setup_theme', 'ekobyte_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ekobyte_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'ekobyte_content_width', 640 );
}
add_action( 'after_setup_theme', 'ekobyte_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */

define( 'EKOBYTE_THEME_DIR', get_template_directory() );
define( 'EKOBYTE_THEME_URI', get_template_directory_uri() );
define( 'EKOBYTE_THEME_CSS_DIR', EKOBYTE_THEME_URI . '/assets/css/' );
define( 'EKOBYTE_THEME_JS_DIR', EKOBYTE_THEME_URI . '/assets/js/' );
define( 'EKOBYTE_THEME_INC', EKOBYTE_THEME_DIR . '/inc/' );



// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require EKOBYTE_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require EKOBYTE_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require EKOBYTE_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */
include_once EKOBYTE_THEME_INC . 'kirki-customizer.php';
include_once EKOBYTE_THEME_INC . 'class-ekobyte-kirki.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require EKOBYTE_THEME_INC . 'jetpack.php';
}

/**
 * include ekobyte functions file
 */
require_once EKOBYTE_THEME_INC . 'class-navwalker.php';
require_once EKOBYTE_THEME_INC . 'class-tgm-plugin-activation.php';
require_once EKOBYTE_THEME_INC . 'add_plugin.php';
require_once EKOBYTE_THEME_INC . '/common/ekobyte-breadcrumb.php';
require_once EKOBYTE_THEME_INC . '/common/ekobyte-scripts.php';
require_once EKOBYTE_THEME_INC . '/common/ekobyte-widgets.php';

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ekobyte_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'ekobyte_pingback_header' );

// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function ekobyte_move_comment_textarea_to_bottom( $fields ) {
    $comment_field       = $fields[ 'comment' ];
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'ekobyte_move_comment_textarea_to_bottom' );


// ekobyte_comment 
if ( !function_exists( 'ekobyte_comment' ) ) {
    function ekobyte_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = 'Reply';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>
            <li id="comment-<?php comment_ID();?>" class="comment">
                <div class="te-comments-item">
                    <div class="te-comments-avatar">
                        <?php print get_avatar( $comment, 102, null, null, [ 'class' => [] ] );?>
                    </div>
                    <div class="te-comments-text">
                        <div class="te-avatar-name">
                            <h5><?php print get_comment_author_link();?></h5>
                            <span><?php comment_time( get_option( 'date_format' ) );?></span>
                            <?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) );?>
                        </div>
                        <?php comment_text();?>
                    </div>
                </div>
        <?php
    }
}

/**
 * Replace comment reply link class
 */
function ekobyte_comment_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='comment-reply-link te-comment-reply", $class );
	return $class;
}

add_filter( 'comment_reply_link', 'ekobyte_comment_reply_link_class' );


/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'ekobyte_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function ekobyte_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// ekobyte_search_filter_form
if ( !function_exists( 'ekobyte_search_filter_form' ) ) {
    function ekobyte_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="sidebar__widget-px"><div class="search-px"><form class="sidebar__search p-relative" action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"> <i class="far fa-search"></i>  </button>
		</form></div></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'ekobyte' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'ekobyte_search_filter_form' );
}

add_action( 'admin_enqueue_scripts', 'ekobyte_admin_custom_scripts' );

function ekobyte_admin_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css',array());
    wp_register_script( 'ekobyte-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'ekobyte-admin-custom' );
}

/** Load custom CSS */
function ekobyte_custom_css() {
    ?>
    <style type="text/css">
        .who-we-are .left-images .smaill-img::before {
            background-image: url(<?php echo esc_url(get_template_directory_uri() ."/assets/img/who-we-are/shap.png");?>);
        }
        .our-simple-step.v1:before {
            background-image: url(<?php echo esc_url(get_template_directory_uri() ."/assets/img/our-simple-step/v1/bg-shap.png");?>);
        }
        .our-simple-step.v2:before {
            background-image: url(<?php echo esc_url(get_template_directory_uri() ."/assets/img/our-simple-step/v2/bg-shap.png");?>);
        }
        @media (min-width: 1200px){
            .our-tema.shap-bg:after {
                background-image: url(<?php echo esc_url(get_template_directory_uri() ."/assets/img/team/shap.png");?>);
            }
        }
        .counter-section::before {
            background-image: url(<?php echo esc_url(get_template_directory_uri() ."/assets/img/counter/bg-shap.png");?>);
        }
    </style>
    <?php
}
add_action('wp_head', 'ekobyte_custom_css');

/** Plugin register for ocdi */
function ocdi_register_plugins( $plugins ) {
    $theme_plugins = [
        [
            'name'         => esc_html__( 'Ekobyte Core ', 'ekobyte' ),
            'slug'         => 'ekobyte-core',
            'source'       => esc_url( 'https://techsometimes.com/products/wp/ekobyte-source/ekobyte-core.zip' ),
            'required'     => true,
            'external_url' => esc_url( 'https://techsometimes.com/products/wp/ekobyte-source/ekobyte-core.zip' ),
        ],
        [
            'name'     => esc_html__( 'Elementor Page Builder', 'ekobyte' ),
            'slug'     => 'elementor',
            'required' => true,
        ],
        
        [ // A WordPress.org plugin repository example.
            'name'     => 'Advanced Custom Fields', // Name of the plugin.
            'slug'     => 'advanced-custom-fields', // Plugin slug - the same as on WordPress.org plugin repository.
            'required' => true,                     // If the plugin is required or not.
        ],
        [
            'name'     => esc_html__( 'ACF Photo Gallery Field', 'ekobyte' ),
            'slug'     => 'navz-photo-gallery',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'WP Classic Editor', 'ekobyte' ),
            'slug'     => 'classic-editor',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'ekobyte' ),
            'slug'     => 'contact-form-7',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'ekobyte' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
        array(
            'name'     =>  esc_html__('Kirki Customizer Framework','ekobyte'),
            'slug'     => 'kirki',
            'required' => true,
        ), 
        array(
            'name'     =>  esc_html__('Breadcrumb NavXT','ekobyte'),
            'slug'     => 'breadcrumb-navxt',
            'required' => true,
        )    
    ];
   
    return array_merge( $plugins, $theme_plugins );
  }
  add_filter( 'ocdi/register_plugins', 'ocdi_register_plugins' );
