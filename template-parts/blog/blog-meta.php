<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekobyte
 */

$categories = get_the_terms($post->ID, 'category');

$ekobyte_blog_date = get_theme_mod('ekobyte_blog_date', true);
$ekobyte_blog_comments = get_theme_mod('ekobyte_blog_comments', true);
$ekobyte_blog_cat = get_theme_mod('ekobyte_blog_cat', true);
?>

<div class="te-post-meta">
    <?php if ( !empty($ekobyte_blog_cat) ): ?>
        <?php if ( !empty( $categories[0]->name ) ): ?>  
            <span><i class="fa-light fa-folder-open"></i> <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> </span>
        <?php endif;?>
    <?php endif;?>
    <?php if (!empty($ekobyte_blog_date)) : ?>
        <span><i class="fa-regular fa-clock"></i><?php the_time(get_option('date_format')); ?></span>
    <?php endif; ?>
    <?php if (!empty($ekobyte_blog_comments)) : ?>
        <span><a href="<?php comments_link(); ?>"><i class="fa-regular fa-comments"></i> <?php comments_number(); ?> </a></span>
    <?php endif; ?>
</div>
