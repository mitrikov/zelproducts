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
	<input id="menu__toggle" type="checkbox" />
  		<label class="menu__btn" for="menu__toggle">
    			<span></span>
  		</label>
<header class="header_content">

	<div class="header">

		
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
					<input type="submit" class="header_searchButton" value="Поиск">
				</form>
				<div class="header_searchForm_results"></div>
			</div>
		</div>

		<div class="header_menuRight">
			<ul>
				<li><div class="user_icon"></div><a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" alt="<?php esc_attr_e( 'Войти', 'textdomain' ); ?>">Войти</a></li>
				<li><?php zelproducts_woocommerce_cart_link(); ?></li>
			</ul>
		</div>

		
	</div>
	<div class="header_categories_mobile">
			<?php
				zelproducts_categories_mobile_menu();
			?>
		</div>
</header>

	<div class="promo_content">
		<div class="promo_container">
			<?php the_custom_logo(); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<div class="promo_title">
						<!-- <h1 class="promo_titleText">Магазин <span>для всей семьи</span></h1>
						<h2 class="promo_adress">г. Зеленоград, к. 316</h2> -->
					</div>
				</a>
			<div class="promo_backgroundImageLeft"></div>
			<div class="promo_backgroundImageRight"></div>
			<div class="promo_backgroundTexture"></div>
		</div>
	</div>
	
	<nav class="categories-container">
		<div class="side-menu">
			<button class="menu-button">
				<span class="icon-hamburger">
					<svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 1H1M13.5 5.875H1M13.5 10.75H1" stroke="#fff" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg>
				</span>
				<span class="menu-button-text">Каталог товаров</span>
			</button>
			
			<?php zelproducts_categories_menu(); ?>
			
		</div>
		
		<div class="categories-content">
		<?php 
			zelproducts_promo_menu();
			
		?>
	</div>
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
