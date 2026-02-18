<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ev-starter
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section class="error-404 not-found">
			<div class="err-404">404</div>
			<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', 'ev-starter' ); ?></h1>
		</section><!-- .error-404 -->
	</main><!-- #main -->

<?php
get_footer();
