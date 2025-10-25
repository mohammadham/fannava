<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fannava
 */

$fannava_blog_btn = get_theme_mod( 'fannava_blog_btn', 'ادامه مطلب' );
$fannava_blog_btn_switch = get_theme_mod( 'fannava_blog_btn_switch', true );

?>

<?php if ( !empty( $fannava_blog_btn_switch ) ): ?>
    <a href="<?php the_permalink();?>" class="te-theme-btn">
        <?php print esc_html( $fannava_blog_btn );?> <i class="fa-solid fa-arrow-right"></i>
    </a>
<?php endif;?>