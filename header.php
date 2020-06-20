<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zelproducts
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header_content">
	<div class="header">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zelproducts' ); ?></a>
		
		<nav class="header_menuLeft">
			<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'zelproducts' ); ?></button> -->
			<?php
				zelproducts_primary_menu();
			?>
		</nav>

		<div class="header_searchFormContainer">
			<div class="header_searchForm">
				<form method="get" action="<?php echo home_url( '/' ) ?>">
					<input class="header_searchText" name="s" placeholder="Поиск продуктов">
					<input type="submit" class="header_searchButton" title="Поиск">
				</form>
			</div>
		</div>

		<div class="header_menuRight">
			<ul>
				<li><div class="user_icon"></div><a href="<?php echo site_url('/wp-login.php?action=register'); ?>">Войти</a></li>
				<li><?php zelproducts_woocommerce_cart_link(); ?></li>
			</ul>
		</div>
	</div>
</header>

	<div class="promo_content">
		<div class="promo_container">
			<?php the_custom_logo(); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<div class="promo_title">
						<h1 class="promo_titleText">Магазин <span>для всей семьи</span></h1>
						<h2 class="promo_adress">г. Зеленоград, к. 316</h2>
					</div>
				</a>
			<div class="promo_backgroundImageRight"></div>
			<div class="promo_backgroundTexture"></div>
		</div>
	</div>
	
	<nav class="categories_content">
	<?php zelproducts_categories_menu(); ?>
	</nav>
			<!-- <?php
			the_custom_logo();

			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$zelproducts_description = get_bloginfo( 'description', 'display' );
			if ( $zelproducts_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $zelproducts_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div> -->
