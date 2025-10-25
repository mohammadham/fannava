<?php

/**
 * Template part for displaying footer layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekobyte
 */
?>

<!--- Start Footer !-->
<footer class="footer style-1">
    <div class="te-footer-sec">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="te-footer-widget">
                        <?php dynamic_sidebar('footer-2-1'); ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 footer-nav-widget">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="te-footer-widget te_widget_nav_menu">
                                <?php dynamic_sidebar('footer-2-2'); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="te-footer-widget te_widget_nav_menu">
                                <?php dynamic_sidebar('footer-2-3'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="te-footer-widget">
                        <?php dynamic_sidebar('footer-2-4'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="te-footer-bottom-wrapper">
                        <div class="te-copyright-text">
                            <p><?php print ekobyte_copyright_text(); ?></p>
                        </div>
                        <div class="te-footer-bottom-menu">
                            <?php ekobyte_footer_menu(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--- End Footer !-->

<!-- Scroll Up Section Start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</div>