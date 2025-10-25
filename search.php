<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package fannava
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;
?>

<!-- Blog Start !-->
<div class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-<?php print esc_attr( $blog_column );?> te-blog-post">
				<?php
				if (have_posts()) :
					if (is_home() && !is_front_page()) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>
					
					<?php
					/* Start the Loop */
					while (have_posts()) : the_post(); ?>
						<?php
						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part('template-parts/content', get_post_format()); ?>
					<?php
					endwhile;
					?>

					<div class="te-basic-pagination">
						<?php fannava_pagination('<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>', '', ['class' => '']); ?>
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
<!-- Blog End !-->

<?php
get_footer();
