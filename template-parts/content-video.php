<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fannava
 */

$fannava_video_url = function_exists('get_field') ? get_field('audio_or_video_link') : NULL;

if (is_single()) :
?>

    <!-- Post Details Start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('te-post-item'); ?>>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-video">
            <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                <div class="popup-video-wrapper">
                    <div class="video-btn">
                        <?php if (!empty($fannava_video_url)) : ?>
                            <a href="<?php print esc_url($fannava_video_url); ?>" class="mfp-iframe video-play">
                                <i class="fa-solid fa-play" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
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

    <article id="post-<?php the_ID(); ?>" <?php post_class('te-post-item format-video'); ?>>
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-video">
            <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                <div class="popup-video-wrapper">
                    <div class="video-btn">
                        <?php if (!empty($fannava_video_url)) : ?>
                            <a href="<?php print esc_url($fannava_video_url); ?>" class="mfp-iframe video-play">
                                <i class="fa-solid fa-play" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
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

<?php
endif; ?>