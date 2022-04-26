<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	register_nav_menus(
		array(
			'primary' => 'Основное',
			'secondary' => 'Вторичное',
			'categories' => 'Меню категорий',
			'categories_footer' => 'Меню категорий подвал',
			'categories_mobile' => 'Мобильное меню категорий',
			'promo' => 'Промо-меню (Акции, новинки и т. д)'
		)
	);

	function zelproducts_primary_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
			)
		);
	}

	function zelproducts_categories_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'categories',
				'menu_class'	 => 'categories',
				'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			)
		);
	}

	function zelproducts_promo_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'promo',
				'menu_class'	 => 'promo-menu',
				'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			)
		);
	}

	function zelproducts_categories_footer_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'categories_footer',
				'menu_class'	 => 'footer-menu',
				'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			)
		);
	}

	function zelproducts_categories_mobile_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'categories_mobile',
				'menu_class'	 => 'mobile-menu',
				'items_wrap' => '<ul class="%2$s">%3$s</ul>',
			)
		);
	}

?>