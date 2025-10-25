<?php 

/**
 * Template part for displaying header layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fannava
*/

// info
$fannava_phone_num = get_theme_mod( 'fannava_phone_num', __( '(629) 555-0129', 'fannava' ) );
$fannava_mail_id = get_theme_mod( 'fannava_mail_id', __( 'info@example.com', 'fannava' ) );
$fannava_address = get_theme_mod( 'fannava_address', __( '6391 Elgin St. Celina, 10299', 'fannava' ) );
$fannava_address_url = get_theme_mod( 'fannava_address_url', __( 'https://goo.gl/maps/qzqY2PAcQwUz1BYN9', 'fannava' ) );

// social setting
$fannava_fb_url = get_theme_mod( 'fannava_fb_url', __( 'https://facebook.com', 'fannava' ) );
$fannava_twitter_url = get_theme_mod( 'fannava_twitter_url', __( 'https://twitter.com', 'fannava' ) );
$fannava_linkedin_url = get_theme_mod( 'fannava_linkedin_url', __( 'https://linkedin.com', 'fannava' ) );
$fannava_youtube_url = get_theme_mod( 'fannava_youtube_url', __( 'https://youtube.com', 'fannava' ) );
$fannava_instagram_url = get_theme_mod( 'fannava_instagram_url', __( 'https://www.instagram.com/', 'fannava' ) );
$fannava_pinterest_url = get_theme_mod( 'fannava_pinterest_url', __( 'https://www.pinterest.com/', 'fannava' ) );

// header right
$fannava_right_contact_switch = get_theme_mod( 'fannava_right_contact_switch', false );
$fannava_button_text = get_theme_mod( 'fannava_button_text', __( 'Get a Quote', 'fannava' ) );
$fannava_button_link = get_theme_mod( 'fannava_button_link', __( '#', 'fannava' ) );

// side info
$fannava_side_info_title = get_theme_mod( 'fannava_side_info_title', __( 'Contact Info', 'fannava' ) );
$fannava_side_info_social_switch = get_theme_mod( 'fannava_side_info_social_switch', false );

?>

<!-- Header Start !-->
<header class="header-area style-2 <?php if ( is_user_logged_in() ) { echo 'login'; } ?>">
    <!-- Header Nav Menu Start -->
    <div class="te-header-menu-area te-sticky-header">
        <div class="container">
            <div class="container">
                <div class="row menu-wrapper">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-6 d-flex align-items-center">
                        <div class="te-logo">
                            <?php fannava_header_logo(); ?>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-6 col-6 d-flex align-items-center justify-content-end">
                        <div class="te-menu d-inline-block">
                            <nav id="main-menu" class="te-main-menu">
                                <?php fannava_header_menu();?>
                            </nav>
                        </div>
                        <!-- Header Button Start !-->
                        <?php if ( !empty( $fannava_right_contact_switch ) ): ?>
                            <div class="te-header-btn">
                                <?php if ( !empty( $fannava_button_text ) ): ?>
                                    <a href="<?php echo esc_html($fannava_button_link); ?>" class="te-quote-btn"><?php echo esc_html($fannava_button_text); ?> <i class="fa-solid fa-arrow-right"></i></a>
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
                <?php fannava_side_logo(); ?>
            </div>
            <div class="te-mobile-nav-menu"></div>
            <div class="te-menu-sidebar-content">
                <div class="te-menu-sidebar-single-widget">
                    <h5 class="te-menu-sidebar-title"><?php echo esc_html($fannava_side_info_title); ?></h5>
                    <div class="te-header-contact-info">
                        <?php if ( !empty( $fannava_address ) ): ?>
                            <span><a href="<?php echo esc_html($fannava_address_url); ?>" target="_blank"><i class="fa-solid fa-location-dot"></i><?php echo esc_html($fannava_address); ?></a></span>
                        <?php endif; ?>
                        <?php if ( !empty( $fannava_mail_id ) ): ?>
                            <span><a href="mailto:<?php echo esc_attr($fannava_mail_id); ?>"><i class="fa-solid fa-envelope"></i><?php echo esc_html($fannava_mail_id); ?></a> </span>	
                        <?php endif; ?>
                        <?php if ( !empty( $fannava_phone_num ) ): ?>
                            <span><a href="tel:<?php echo esc_attr(str_replace(' ', '-', $fannava_phone_num)); ?>"><i class="fa-solid fa-phone"></i><?php echo fannava_kses($fannava_phone_num); ?></a></span>
                        <?php endif; ?>
                    </div>
                    <?php if ( !empty( $fannava_side_info_social_switch ) ): ?>
                        <div class="te-social-profile">
                            <?php if ( !empty( $fannava_fb_url ) OR !empty( $fannava_twitter_url ) OR !empty( $fannava_linkedin_url ) OR !empty( $fannava_youtube_url ) OR !empty( $fannava_instagram_url ) OR !empty( $fannava_pinterest_url ) ): ?>
                                <?php if ( !empty( $fannava_fb_url ) ): ?>
                                    <a href="<?php echo esc_html($fannava_fb_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $fannava_twitter_url ) ): ?>
                                    <a href="<?php echo esc_html($fannava_twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $fannava_linkedin_url ) ): ?>
                                    <a href="<?php echo esc_html($fannava_linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $fannava_youtube_url ) ): ?>
                                    <a href="<?php echo esc_html($fannava_youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $fannava_instagram_url ) ): ?>
                                    <a href="<?php echo esc_html($fannava_instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
                                <?php endif; ?>
                                <?php if ( !empty( $fannava_pinterest_url ) ): ?>
                                    <a href="<?php echo esc_html($fannava_pinterest_url); ?>"><i class="fa-brands fa-pinterest"></i></a>
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

