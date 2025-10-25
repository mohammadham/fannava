<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fannava
 */

if (is_single()) : ?>

    <!-- Post Details Start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('te-post-item'); ?>>
    
        <?php if (has_post_thumbnail()) : ?>
        <div class="te-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full'); ?>
            </a>
        </div>
        <?php endif; ?>

        <div class="te-post-content-wrapper">
            <?php get_template_part('template-parts/blog/blog-meta'); ?>
            <h3 class="te-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="te-post-content">
                <?php the_content(); ?>
            </div>
            <div class="te-single-post-meta">
                <div class="te-blog-post-tag">
                    <?php print fannava_get_tag(); ?>
                </div>
            </div>
        </div>
    </article>

<?php else : ?>
    <!-- Blog Start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('te-post-item format-image'); ?>>
        <?php if (has_post_thumbnail()) : ?>
            <div class="te-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="te-post-content-wrapper">
            <h3 class="te-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php get_template_part('template-parts/blog/blog-meta'); ?>
            <div class="te-post-content">
                <?php the_excerpt(); ?>
            </div>
            <div class="te-read-more">
                <?php get_template_part('template-parts/blog/blog-btn'); ?>
            </div>
        </div>
    </article>
    <!-- Blog End -->

<?php endif; ?>