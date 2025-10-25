<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekobyte
 */

$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';

global $post;

if (is_single()) : ?>

    <!-- Post Details Start -->

    <article id="post-<?php the_ID(); ?>" <?php post_class('te-post-item format-gallery'); ?>>
        <div class="te-post-thumbnail post-gallery">
            <?php 
            if( count($gallery_images) ):
                foreach($gallery_images as $image):
                    $id = $image['id'];
                    $title = $image['title'];
                    $full_image_url= $image['full_image_url'];
                    $url= $image['url'];
                    $alt = get_field('photo_gallery_alt', $id);
                ?>
                <a href="<?php echo esc_url($full_image_url); ?>">
                    <img src="<?php echo esc_url($full_image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                </a>
                <?php endforeach; 
            endif;?>
        </div>
        <div class="te-post-content-wrapper">
            <?php get_template_part('template-parts/blog/blog-meta'); ?>
            <h3 class="te-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php if ( has_excerpt() ) { ?>
                <div class="te-post-content">
                    <?php the_excerpt(); ?>
                </div>
            <?php } ?>
            <div class="te-single-post-meta">
                <div class="te-blog-post-tag">
                    <?php print ekobyte_get_tag(); ?>
                </div>
            </div>
        </div>
    </article>

<?php else : ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'te-post-item format-gallery' );?>>
        <div class="post-gallery">
            <?php if( count($gallery_images) ):
                foreach($gallery_images as $image):
                    $id = $image['id'];
                    $title = $image['title'];
                    $full_image_url= $image['full_image_url'];
                    $url= $image['url'];
                    $alt = get_field('photo_gallery_alt', $id);
                ?>
                <a href="<?php echo esc_url($full_image_url); ?>">
                    <img src="<?php echo esc_url($full_image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                </a>
                <?php endforeach; 
            endif;?>
        </div>
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

<?php endif; ?>