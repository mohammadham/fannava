<?php

/**
 * Template part for displaying footer layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fannava
 */
 
$footer_bg_img = get_theme_mod('fannava_footer_bg');
$fannava_footer_bg_url_from_page = function_exists('get_field') ? get_field('fannava_footer_bg') : '';
$fannava_footer_bg_color_from_page = function_exists('get_field') ? get_field('fannava_footer_bg_color') : '';

// bg image
$bg_img = !empty($fannava_footer_bg_url_from_page['url']) ? $fannava_footer_bg_url_from_page['url'] : $footer_bg_img;

// social link
$fannava_footer_social_switch = get_theme_mod( '$fannava_footer_social_switch', false );
$fannava_footer_social_connect_text = get_theme_mod( 'fannava_footer_social_connect_text', __( 'Follow us:', 'fannava' ) );
$fannava_footer_fb_url = get_theme_mod( 'fannava_fb_url', __( 'https://facebook.com', 'fannava' ) );
$fannava_footer_twitter_url = get_theme_mod( 'fannava_twitter_url', __( 'https://twitter.com', 'fannava' ) );
$fannava_footer_linkedin_url = get_theme_mod( 'fannava_linkedin_url', __( 'https://linkedin.com', 'fannava' ) );
$fannava_footer_youtube_url = get_theme_mod( 'fannava_youtube_url', __( 'https://youtube.com', 'fannava' ) );
$fannava_footer_instagram_url = get_theme_mod( 'fannava_instagram_url', __( 'https://www.instagram.com/', 'fannava' ) );
$fannava_footer_pinterest_url = get_theme_mod( 'fannava_pinterest_url', __( 'https://www.pinterest.com/', 'fannava' ) );

?>

<!--- Start Footer !-->
<footer class="footer style-2">
    <div class="te-footer-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="te-footer-social-wrapper">
                        <div class="te-footer-logo">
                            <?php fannava_footer_logo(); ?>
                        </div>
                        <?php if ( !empty( $fannava_footer_social_switch ) ): ?>
                            <div class="te-social-widget">
                                <?php if ( !empty( $fannava_footer_social_connect_text ) ): ?>
                                    <span><?php echo esc_html($fannava_footer_social_connect_text); ?></span>
                                <?php endif; ?>
                                <div class="te-social-profile">
                                    <?php if ( !empty( $fannava_footer_fb_url ) OR !empty( $fannava_footer_twitter_url ) OR !empty( $fannava_footer_linkedin_url ) OR !empty( $fannava_footer_youtube_url ) OR !empty( $fannava_footer_instagram_url ) OR !empty( $fannava_footer_pinterest_url ) ): ?>
                                        <?php if ( !empty( $fannava_footer_fb_url ) ): ?>
                                            <a href="<?php echo esc_html($fannava_footer_fb_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                        <?php endif; ?>
                                        <?php if ( !empty( $fannava_footer_twitter_url ) ): ?>
                                            <a href="<?php echo esc_html($fannava_footer_twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
                                        <?php endif; ?>
                                        <?php if ( !empty( $fannava_footer_linkedin_url ) ): ?>
                                            <a href="<?php echo esc_html($fannava_footer_linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                        <?php endif; ?>
                                        <?php if ( !empty( $fannava_footer_youtube_url ) ): ?>
                                            <a href="<?php echo esc_html($fannava_footer_youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
                                        <?php endif; ?>
                                        <?php if ( !empty( $fannava_footer_instagram_url ) ): ?>
                                            <a href="<?php echo esc_html($fannava_footer_instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
                                        <?php endif; ?>
                                        <?php if ( !empty( $fannava_footer_pinterest_url ) ): ?>
                                            <a href="<?php echo esc_html($fannava_footer_pinterest_url); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4')) : ?>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="te-footer-widget">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12 footer-nav-widget">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="te-footer-widget te_widget_nav_menu">
                                    <?php dynamic_sidebar('footer-2'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="te-footer-widget te_widget_nav_menu">
                                    <?php dynamic_sidebar('footer-3'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="te-footer-widget">
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="te-footer-bottom-wrapper">
                        <div class="te-copyright-text">
                            <p><?php print fannava_copyright_text(); ?></p>
                        </div>
                        <div class="te-footer-bottom-menu">
                            <?php fannava_footer_menu(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="te-footer-bg">
        <?php if ( !empty( $bg_img ) ): ?>
            <img src="<?php print esc_url( $bg_img );?>" alt="<?php print esc_attr__( 'Footer BG Image', 'fannava' );?>" />
        <?php endif; ?>
    </div>
</footer>
<!--- End Footer !-->
<!-- Scroll Up Section Start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</div>
<!-- Scroll Up Section End -->