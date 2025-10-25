<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package farmus
 */

$ekobyte_audio_url = function_exists( 'get_field' ) ? get_field( 'audio_or_video_link' ) : NULL;
if ( is_single() ): 
?>

    <!-- Post Details Start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('te-post-item'); ?>>
    
        <div class="post-audio embed-responsive">
            <?php if ( !empty( $ekobyte_audio_url ) ): ?>
                <?php echo wp_oembed_get( $ekobyte_audio_url ); ?>
            <?php endif; ?>
        </div>

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
                    <?php print ekobyte_get_tag(); ?>
                </div>
            </div>
        </div>
    </article>

<?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'te-post-item format-audio' );?>>
        <div class="post-audio embed-responsive">
            <?php if ( !empty( $ekobyte_audio_url ) ): ?>
                <?php echo wp_oembed_get( $ekobyte_audio_url ); ?>
            <?php endif; ?>
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


