<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

			<?php if (have_posts()): ?>

				<header class="page-header">
					<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
				</header><!-- .page-header -->

				<div class="posts-grid">
					<?php
					/* Start the Loop */
					while (have_posts()):
						the_post();
						?>

						<div class="post-card">
							<?php ev_starter_post_thumbnail(); ?>

							<div class="card-body">
								<?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

								<div class="post-date">
									<?php
										echo 'Publié le ' . get_the_date('d/m/Y') . ' ' . get_the_time('H:i');
									?>
								</div>
							</div>

						</div>

						<?php

					endwhile;

			else:

				get_template_part('template-parts/content', 'none');

			endif;
			?>
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
