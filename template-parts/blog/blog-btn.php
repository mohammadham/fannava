<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekobyte
 */

$ekobyte_blog_btn = get_theme_mod( 'ekobyte_blog_btn', 'Learn More' );
$ekobyte_blog_btn_switch = get_theme_mod( 'ekobyte_blog_btn_switch', true );

?>

<?php if ( !empty( $ekobyte_blog_btn_switch ) ): ?>
    <a href="<?php the_permalink();?>" class="te-theme-btn">
        <?php print esc_html( $ekobyte_blog_btn );?> <i class="fa-solid fa-arrow-right"></i>
    </a>
<?php endif;?>