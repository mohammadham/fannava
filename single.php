<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ekobyte
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
?>

<div class="blog-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?> te-blog-details-wrapper">
				<!-- Post Details Start -->
				<?php
				while ( have_posts() ):
					the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					get_template_part( 'template-parts/biography' );

				endwhile; // End of the loop.
				?>

				<div class="te-blog-post-nav">
					<?php if ( get_previous_post_link() ): ?>
						<div class="te-post-navigation">
							<div class="theme-navigation b-next-post text-left">
								<span><?php print esc_html__( 'Prev Post', 'ekobyte' );?></span>
								<h4><?php print get_previous_post_link( '%link ', '%title' );?></h4>
							</div>
						</div>
					<?php endif;?>
					<?php if ( get_next_post_link() ): ?>
						<div class="te-post-navigation">
							<div class="theme-navigation b-next-post text-left text-md-right">
								<span><?php print esc_html__( 'Next Post', 'ekobyte' );?></span>
								<h4><?php print get_next_post_link( '%link ', '%title' );?></h4>
							</div>
						</div>
					<?php endif;?>
				</div>
				<?php 
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ):
						comments_template();
					endif;
				?>
				<!-- Post Details End -->
			</div>

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
<!--- Blog End !-->

<?php
get_footer();
