<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ev-starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		$use_page_template = get_field('use_page_template');

		if ($use_page_template) {
			$template_page_id = $use_page_template;
			
			$template_page = get_post($template_page_id);
			if ($template_page) {
				echo apply_filters('the_content', $template_page->post_content);
			} else {
				echo '<p>Template page content not found.</p>';
			}
		} else {
			the_content();
		} ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
