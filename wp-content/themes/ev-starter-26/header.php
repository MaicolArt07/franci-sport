<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ev-starter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!-- <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'> -->
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Geist' rel='stylesheet'>
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ev-starter' ); ?></a>

<header id="masthead" class="site-header" style="background-color: #0b0b0c; color: #fff;">
	<div class="container-fluid d-flex justify-content-center align-items-center flex-wrap padding-header gap-header">

		<!-- IZQUIERDA: LOGO -->
		<div class="d-flex align-items-center header-logo">
			<?php
			$custom_logo_id = get_theme_mod('custom_logo');
			$home_url = get_home_url();
			$custom_logo_url = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : '';

			if ($custom_logo_url) {
				echo '<a href="' . esc_url($home_url) . '" class="d-flex align-items-center">';
				echo '<img src="' . esc_url($custom_logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" style="height: 45.26px;">';
				echo '</a>';
			} else {
				echo '<h1><a href="' . esc_url($home_url) . '" style="color:#fff;">' . get_bloginfo('name') . '</a></h1>';
			}
			?>
			<!-- BOTÓN MÓVIL -->
			<button class="navbar-toggler d-lg-none text-gray collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation" style="color:#fff; margin-top: -20px;">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>

		<!-- CENTRO: MENÚ -->
		<nav id="site-navigation" class="main-navigation d-none d-lg-block">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'menu-1',
				'menu_class'     => 'nav flex-row',
				'container'      => false,
				'link_before'    => '<span style="color: #88888f; font-weight: 500; font-size: 18px">',
				'link_after'     => '</span>',
			));
			?>
		</nav>

		<!-- DERECHA: BADGE + TEXTO -->
		<div class="d-flex align-items-center gap-header-2 text-end">
			<span class="badge more-18">18+</span>
			<small class="text-header">
				Jouer Comporte des Risques: Endettement, Isolement, Dépendance.<br>
				Pour être aidé, appelez le 09-74-75-13-13 (Appel non surtaxé)
			</small>
		</div>

	</div>

	<!-- MENÚ MÓVIL -->
	<div class="collapse d-lg-none" id="mobileMenu">
		<?php
			wp_nav_menu(array(
				'theme_location' => 'menu-1',
				'menu_class'     => 'nav mt-4',
				'container'      => false,
				'link_before'    => '<span style="color: #fff; font-weight: 500; font-size: 18px">',
				'link_after'     => '</span>',
			));
		?>
	</div>
</header>



	
