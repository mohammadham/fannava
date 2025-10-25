<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ekobyte
 */

/** 
 *
 * ekobyte header
 */

function ekobyte_check_header() {
    $ekobyte_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $ekobyte_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );
    
    if ( $ekobyte_header_style == 'header-style-1' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-1' );
    } 
    elseif ( $ekobyte_header_style == 'header-style-2' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    else {

        /** default header style **/
        if ( $ekobyte_default_header_style == 'header-style-2' ) {
            get_template_part( 'template-parts/header/header-2' );
        }
        else {
            get_template_part( 'template-parts/header/header-1' );
        }
    }

}
add_action( 'ekobyte_header_style', 'ekobyte_check_header', 10 );


// header logo
function ekobyte_header_logo() { ?>
    <?php
    
    $ekobyte_static_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
    $ekobyte_site_logo_from_customizer = get_theme_mod( 'logo', $ekobyte_static_logo );
    $ekobyte_site_logo_url_from_page = function_exists('get_field') ? get_field('ekobyte_header_logo') : '';

    $ekobyte_site_logo = !empty($ekobyte_site_logo_url_from_page['url']) ? $ekobyte_site_logo_url_from_page['url'] : $ekobyte_site_logo_from_customizer;
    
    if ( !empty( $ekobyte_site_logo ) ): ?>
        <a href="<?php print esc_url( home_url( '/' ) );?>" class="te-standard-logo">
            <img src="<?php print esc_url( $ekobyte_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'ekobyte' );?>" />
        </a>
        <a href="<?php print esc_url( home_url( '/' ) );?>" class="te-sticky-logo">
            <img src="<?php print esc_url( $ekobyte_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'ekobyte' );?>" />
        </a>
        <a href="<?php print esc_url( home_url( '/' ) );?>" class="te-retina-logo">
            <img src="<?php print esc_url( $ekobyte_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'ekobyte' );?>" />
        </a>
    <?php endif;
}

// footer logo
function ekobyte_footer_logo() {?>
    <?php
        $ekobyte_logo_white = get_template_directory_uri() . '/assets/img/logo/footer-logo-white.png';
        $ekobyte_footer_logo = get_theme_mod( 'footer_logo', $ekobyte_logo_white );
    ?>
    <a href="<?php print esc_url( home_url( '/' ) );?>">
        <img src="<?php print esc_url( $ekobyte_footer_logo );?>" alt="<?php print esc_attr__( 'logo', 'ekobyte' );?>"/>
    </a>
    <?php
}

// side logo
function ekobyte_side_logo() {?>
    <?php
        $ekobyte_side_static_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $ekobyte_side_logo = get_theme_mod( 'side_logo', $ekobyte_side_static_logo );
    ?>
    <a href="<?php print esc_url( home_url( '/' ) );?>">
        <img src="<?php print esc_url( $ekobyte_side_logo );?>" alt="<?php print esc_attr__( 'logo', 'ekobyte' );?>"/>
    </a>
    <?php
}

function ekobyte_mobile_logo() {
    // side info
    $ekobyte_mobile_logo_hide = get_theme_mod( 'ekobyte_mobile_logo_hide', false );

    $ekobyte_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $ekobyte_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $ekobyte_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'ekobyte' );?>" />
        </a>
    </div>
    <?php endif;?>

<?php }

// favicon logo
function ekobyte_favicon_logo_func() {
    $ekobyte_static_favicon = get_template_directory_uri() . '/assets/img/logo/favicon.svg';
    $ekobyte_favicon_url_from_customizer = get_theme_mod( 'favicon_url', $ekobyte_static_favicon );
    $ekobyte_favicon_url_from_page = function_exists('get_field') ? get_field('ekobyte_custom_favicon') : '';

    $ekobyte_favicon = !empty($ekobyte_favicon_url_from_page['url']) ? $ekobyte_favicon_url_from_page['url'] : $ekobyte_favicon_url_from_customizer;
   
?>

<link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url( $ekobyte_favicon );?>">

<?php
}
add_action( 'wp_head', 'ekobyte_favicon_logo_func' );


/**
 * [ekobyte_header_social_profiles description]
 * @return [type] [description]
 */
function ekobyte_header_social_profiles() {
    $ekobyte_topbar_fb_url = get_theme_mod( 'ekobyte_topbar_fb_url', __( '#', 'ekobyte' ) );
    $ekobyte_topbar_twitter_url = get_theme_mod( 'ekobyte_topbar_twitter_url', __( '#', 'ekobyte' ) );
    $ekobyte_topbar_instagram_url = get_theme_mod( 'ekobyte_topbar_instagram_url', __( '#', 'ekobyte' ) );
    $ekobyte_topbar_linkedin_url = get_theme_mod( 'ekobyte_topbar_linkedin_url', __( '#', 'ekobyte' ) );
    $ekobyte_topbar_youtube_url = get_theme_mod( 'ekobyte_topbar_youtube_url', __( '#', 'ekobyte' ) );
    ?>
        <ul>
        <?php if ( !empty( $ekobyte_topbar_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $ekobyte_topbar_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_topbar_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $ekobyte_topbar_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_topbar_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $ekobyte_topbar_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_topbar_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $ekobyte_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_topbar_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $ekobyte_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

function ekobyte_footer_social_profiles() {
    $ekobyte_footer_fb_url = get_theme_mod( 'ekobyte_footer_fb_url', __( '#', 'ekobyte' ) );
    $ekobyte_footer_twitter_url = get_theme_mod( 'ekobyte_footer_twitter_url', __( '#', 'ekobyte' ) );
    $ekobyte_footer_instagram_url = get_theme_mod( 'ekobyte_footer_instagram_url', __( '#', 'ekobyte' ) );
    $ekobyte_footer_linkedin_url = get_theme_mod( 'ekobyte_footer_linkedin_url', __( '#', 'ekobyte' ) );
    $ekobyte_footer_youtube_url = get_theme_mod( 'ekobyte_footer_youtube_url', __( '#', 'ekobyte' ) );
    ?>

        <ul>
        <?php if ( !empty( $ekobyte_footer_fb_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $ekobyte_footer_fb_url );?>">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_footer_twitter_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $ekobyte_footer_twitter_url );?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_footer_instagram_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $ekobyte_footer_instagram_url );?>">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_footer_linkedin_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $ekobyte_footer_linkedin_url );?>">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $ekobyte_footer_youtube_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $ekobyte_footer_youtube_url );?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif;?>
        </ul>
<?php
}

/**
 * [ekobyte_header_menu description]
 * @return [type] [description]
 */
function ekobyte_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'ekobyte_Navwalker_Class::fallback',
            'walker'         => new ekobyte_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [ekobyte_footer_menu description]
 * @return [type] [description]
 */
function ekobyte_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'ekobyte_Navwalker_Class::fallback',
        'walker'         => new ekobyte_Navwalker_Class,
    ] );
}

/**
 *
 * ekobyte footer
 */
add_action( 'ekobyte_footer_style', 'ekobyte_check_footer', 10 );

function ekobyte_check_footer() {
    $ekobyte_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
    $ekobyte_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

    if ( $ekobyte_footer_style == 'footer-style-1' ) {
        get_template_part( 'template-parts/footer/footer-1' );
    } 
    elseif ( $ekobyte_footer_style == 'footer-style-2' ) {
        get_template_part( 'template-parts/footer/footer-2' );
    }
    else {

        /** default footer style **/
        if ( $ekobyte_default_footer_style == 'footer-style-2' ) {
            get_template_part( 'template-parts/footer/footer-2' );
        } 
        else {
            get_template_part( 'template-parts/footer/footer-1' );
        }

    }
}


// ekobyte copyright text
function ekobyte_copyright_text() {
    $current_year = date('Y');
    $pre_text = 'Copyright © '.$current_year;
    $customizer_text = get_theme_mod( 'ekobyte_copyright', esc_html__( 'Ekobyte. All Rights Reserved', 'ekobyte' ) );
    if( $customizer_text == ''){
        $customizer_text = "Ekobyte. All Rights Reserved";
    }
    $merged_text = $pre_text . " " .$customizer_text;
    echo esc_html( $merged_text );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'ekobyte_pagination' ) ) {

    function _ekobyte_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navigation
    function ekobyte_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _ekobyte_pagi_callback( $pagi );
    }
}


// header top bg color
function ekobyte_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'ekobyte_breadcrumb_bg_color', '#222' );
    wp_enqueue_style( 'ekobyte-custom', EKOBYTE_THEME_CSS_DIR . 'ekobyte-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'ekobyte-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'ekobyte_breadcrumb_bg_color' );



// ekobyte_kses_intermediate
function ekobyte_kses_intermediate( $string = '' ) {
    return wp_kses( $string, ekobyte_get_allowed_html_tags( 'intermediate' ) );
}

function ekobyte_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function ekobyte_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}