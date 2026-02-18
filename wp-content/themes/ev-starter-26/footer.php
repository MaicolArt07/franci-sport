<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ev-starter
 */

$footer_left_widget = get_field('footer_left_widget', 'option');
$footer_logos = get_field('footer_logos', 'option');
$footer_copy = get_field('footer_copy', 'option');
$footer_logo = get_field('footer_logo', 'option');
?>

	<footer id="colophon" class="site-footer">
		<div class="footer-container">
				<div class="mb-4">
					<?php
					$custom_logo_id = get_theme_mod('custom_logo');
					$home_url = get_home_url();
					$custom_logo_url = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : '';

					echo '<a class="custom-logo-link" href="'.$home_url.'">';
					
					echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

					echo '</a>';
					?>
				</div>
				
				<?php
					if ( $footer_copy ) { ?>
						<div class="footer-copy">
							<?= $footer_copy; ?>
						</div>
				<?php } ?>
				
				<div class="footer-nav-wrap">
					<!-- <h4 class="footer-subtitle">Liens utiles</h4> -->

					<?php 
						wp_nav_menu( array(
							'menu' => 4, 
							'container' => 'nav',
							'menu_class' => 'menu',
							'fallback_cb' => false 
						) );
					?>
				</div>

				<?php
					if ( $footer_left_widget ) { ?>
						<div class="footer-widget">
							<?= $footer_left_widget; ?>
						</div>
				<?php } ?>

				<?php 
					if ( $footer_logos ) { ?>
						<div class="footer-logos">
							<?php foreach( $footer_logos as $item) { ?>
								<?= $item['logo_url'] ? '<a href="'. $item['logo_url']. '" target="_blank" rel="nofollow noreferrer noopener">' : '' ?>
								
									<img src="<?= $item['logo'] ?>" >
									
								<?= $item['logo_url'] ? '</a>' : '' ?>
							<?php } ?>
						</div>
				<?php } ?>

		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
