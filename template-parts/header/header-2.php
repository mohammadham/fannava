<?php 

/**
 * Template part for displaying header layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekobyte
*/

// info
$ekobyte_topbar_switch = get_theme_mod( 'ekobyte_topbar_switch', false );

$ekobyte_phone_num = get_theme_mod( 'ekobyte_phone_num', __( '(629) 555-0129', 'ekobyte' ) );
$ekobyte_mail_id = get_theme_mod( 'ekobyte_mail_id', __( 'info@example.com', 'ekobyte' ) );
$ekobyte_address = get_theme_mod( 'ekobyte_address', __( '6391 Elgin St. Celina, 10299', 'ekobyte' ) );
$ekobyte_address_url = get_theme_mod( 'ekobyte_address_url', __( 'https://goo.gl/maps/qzqY2PAcQwUz1BYN9', 'ekobyte' ) );

// social setting
$ekobyte_topbar_social_switch = get_theme_mod( 'ekobyte_topbar_social_switch', false );
$ekobyte_fb_url = get_theme_mod( 'ekobyte_fb_url', __( 'https://facebook.com', 'ekobyte' ) );
$ekobyte_twitter_url = get_theme_mod( 'ekobyte_twitter_url', __( 'https://twitter.com', 'ekobyte' ) );
$ekobyte_linkedin_url = get_theme_mod( 'ekobyte_linkedin_url', __( 'https://linkedin.com', 'ekobyte' ) );
$ekobyte_youtube_url = get_theme_mod( 'ekobyte_youtube_url', __( 'https://youtube.com', 'ekobyte' ) );
$ekobyte_instagram_url = get_theme_mod( 'ekobyte_instagram_url', __( 'https://www.instagram.com/', 'ekobyte' ) );
$ekobyte_pinterest_url = get_theme_mod( 'ekobyte_pinterest_url', __( 'https://www.pinterest.com/', 'ekobyte' ) );
// header right
$ekobyte_right_contact_switch = get_theme_mod( 'ekobyte_right_contact_switch', false );
$ekobyte_button_text = get_theme_mod( 'ekobyte_button_text', __( 'Get a Quote', 'ekobyte' ) );
$ekobyte_button_link = get_theme_mod( 'ekobyte_button_link', __( '#', 'ekobyte' ) );

// side info
$ekobyte_side_info_title = get_theme_mod( 'ekobyte_side_info_title', __( 'Contact Info', 'ekobyte' ) );
$ekobyte_side_info_social_switch = get_theme_mod( 'ekobyte_side_info_social_switch', false );

?>

<!-- Header Start !-->
<header class="header-area style-1 <?php if ( is_user_logged_in() ) { echo 'login'; } ?>">
    <!-- Header Top Start -->
    <?php if ( !empty( $ekobyte_topbar_switch ) ): ?>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="te-header-top-wrapper">
                            <div class="header-top-info">
                                <div class="te-header-contact-info">
                                    <?php if ( !empty( $ekobyte_mail_id ) ): ?>
                                        <span><a href="mailto:<?php echo esc_attr($ekobyte_mail_id); ?>"><i class="fa-solid fa-envelope"></i><?php echo esc_html($ekobyte_mail_id); ?></a></span>	
                                    <?php endif; ?>
                                    <?php if ( !empty( $ekobyte_phone_num ) ): ?>
                                        <span><a href="tel:<?php echo esc_attr(str_replace(' ', '-', $ekobyte_phone_num)); ?>"><i class="fa-solid fa-phone"></i><?php echo ekobyte_kses($ekobyte_phone_num); ?></a></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="header-top-info">
                                <?php if ( !empty( $ekobyte_topbar_social_switch ) ): ?>
                                    <div class="te-social-profile">
                                        <?php if ( !empty( $ekobyte_fb_url ) OR !empty( $ekobyte_twitter_url ) OR !empty( $ekobyte_linkedin_url ) OR !empty( $ekobyte_youtube_url ) OR !empty( $ekobyte_instagram_url ) OR !empty( $ekobyte_pinterest_url ) ): ?>
                                            <?php if ( !empty( $ekobyte_fb_url ) ): ?>
                                                <a href="<?php echo esc_html($ekobyte_fb_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                            <?php endif; ?>
                                            <?php if ( !empty( $ekobyte_twitter_url ) ): ?>
                                                <a href="<?php echo esc_html($ekobyte_twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
                                            <?php endif; ?>
                                            <?php if ( !empty( $ekobyte_linkedin_url ) ): ?>
                                                <a href="<?php echo esc_html($ekobyte_linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                            <?php endif; ?>
                                            <?php if ( !empty( $ekobyte_youtube_url ) ): ?>
                                                <a href="<?php echo esc_html($ekobyte_youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
                                            <?php endif; ?>
                                            <?php if ( !empty( $ekobyte_instagram_url ) ): ?>
                                                <a href="<?php echo esc_html($ekobyte_instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
                                            <?php endif; ?>
                                            <?php if ( !empty( $ekobyte_pinterest_url ) ): ?>
                                                <a href="<?php echo esc_html($ekobyte_pinterest_url); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Header Top End -->
    <!-- Header Nav Menu Start -->
    <div class="te-header-menu-area te-sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-6 d-flex align-items-center">
                    <div class="te-logo">
                        <?php ekobyte_header_logo(); ?>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-6 col-6 d-flex align-items-center justify-content-end">
                    <div class="te-menu d-inline-block">
                        <nav id="main-menu" class="te-main-menu">
                            <?php ekobyte_header_menu();?>
                        </nav>
                    </div>
                    <!-- Header Button Start !-->
                    <?php if ( !empty( $ekobyte_right_contact_switch ) ): ?>
                        <div class="te-header-btn">
                            <?php if ( !empty( $ekobyte_button_text ) ): ?>
                                <a href="<?php echo esc_html($ekobyte_button_link); ?>" class="te-quote-btn"><?php echo esc_html($ekobyte_button_text); ?> <i class="fa-solid fa-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <!-- Header Button Start !-->
                    <!-- Mobile Menu Toggle Button Start !-->
                    <div class="te-mobile-menu-bar d-lg-none text-end">
                        <a href="#" class="te-mobile-menu-toggle-btn"><i class="fal fa-bars"></i></a>
                    </div>
                    <!-- Mobile Menu Toggle Button End !-->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Nav Menu End -->
</header>
<!-- Header End !-->
<!-- Menu sidebar Section Start -->
<div class="te-menu-sidebar-area">
    <div class="te-menu-sidebar-wrapper">
        <div class="te-menu-sidebar-close">
            <button class="te-menu-sidebar-close-btn" id="menu_sidebar_close_btn">
                <i class="fal fa-times"></i>
            </button>
        </div>
        <div class="te-menu-sidebar-content">
            <div class="te-menu-sidebar-logo">
                <?php ekobyte_side_logo(); ?>
            </div>
            <div class="te-mobile-nav-menu"></div>
            <div class="te-menu-sidebar-content">
                <div class="te-menu-sidebar-single-widget">
                    <h5 class="te-menu-sidebar-title"><?php echo esc_html($ekobyte_side_info_title); ?></h5>
                    <div class="te-header-contact-info">
                        <?php if ( !empty( $ekobyte_address ) ): ?>
                            <span><a href="<?php echo esc_html($ekobyte_address_url); ?>" target="_blank"><i class="fa-solid fa-location-dot"></i><?php echo esc_html($ekobyte_address); ?></a></span>
                        <?php endif; ?>
                        <?php if ( !empty( $ekobyte_mail_id ) ): ?>
                            <span><a href="mailto:<?php echo esc_attr($ekobyte_mail_id); ?>"><i class="fa-solid fa-envelope"></i><?php echo esc_html($ekobyte_mail_id); ?></a> </span>	
                        <?php endif; ?>
                        <?php if ( !empty( $ekobyte_phone_num ) ): ?>
                            <span><a href="tel:<?php echo esc_attr(str_replace(' ', '-', $ekobyte_phone_num)); ?>"><i class="fa-solid fa-phone"></i><?php echo ekobyte_kses($ekobyte_phone_num); ?></a></span>
                        <?php endif; ?>
                    </div>
                    <?php if ( !empty( $ekobyte_side_info_social_switch ) ): ?>
                        <div class="te-social-profile">
                            <?php if ( !empty( $ekobyte_fb_url ) OR !empty( $ekobyte_twitter_url ) OR !empty( $ekobyte_linkedin_url ) OR !empty( $ekobyte_youtube_url )): ?>
                                <?php if ( !empty( $ekobyte_fb_url ) ): ?>
                                    <a href="<?php echo esc_html($ekobyte_fb_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $ekobyte_twitter_url ) ): ?>
                                    <a href="<?php echo esc_html($ekobyte_twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $ekobyte_linkedin_url ) ): ?>
                                    <a href="<?php echo esc_html($ekobyte_linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $ekobyte_youtube_url ) ): ?>
                                    <a href="<?php echo esc_html($ekobyte_youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Menu sidebar Section Start -->
<div class="te-body-overlay"></div>

