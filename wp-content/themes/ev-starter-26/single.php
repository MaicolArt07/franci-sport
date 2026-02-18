<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ev-starter
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="page-container">
			<div class="sidebar-col">
				<?php get_template_part('template-parts/sidebar'); ?>
			</div>

			<div class="content-col">
				<?php
				$top_header_options = get_field('top_header', 'option');
				if ($top_header_options) { ?>
					<div class="header-top">
						<?= $top_header_options; ?>
					</div>
				<?php } ?>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile; // End of the loop.
				?>
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
