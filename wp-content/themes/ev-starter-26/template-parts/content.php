<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ev-starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="section section-page-cover">
		<div class="section-inner">
			<div class="heading">
				<?php the_title( '<h1 class="entry-title">', '</h1>' );; ?>
				<?php the_excerpt('<p class="archive-description">', '</p>'); ?>
			</div>
		</div>
	</section>

	<?php ev_starter_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ev-starter' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
