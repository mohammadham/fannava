<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekobyte
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;
?>

<div class="blog-area">
    <div class="container">
        <div class="row">
			<!-- Blog Post List Start -->
            <div class="col-lg-<?php print esc_attr( $blog_column );?> te-blog-post">
				<?php if (have_posts()) : ?>
					<header class="page-header d-none">
						<?php
						the_archive_title('<h1 class="page-title">', '</h1>');
						the_archive_description('<div class="archive-description">', '</div>');
						?>
					</header><!-- .page-header -->
					<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part('template-parts/content', get_post_type());
					endwhile;
					?>
					<div class="te-basic-pagination">
						<?php ekobyte_pagination('<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>', '', ['class' => '']); ?>
					</div>
				<?php
				else :
					get_template_part('template-parts/content', 'none');
				endif;
				?>
			</div>
			<!-- Blog Post List End -->
			
			<!-- Blog Sidebar Start -->
			<?php if (is_active_sidebar('blog-sidebar')) : ?>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
			<!-- Blog Sidebar End -->
		</div>
    </div>
</div>
<?php
get_footer();
