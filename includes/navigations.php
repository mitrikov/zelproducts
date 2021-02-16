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
				'menu_id'        => 'categories-menu',
				'menu_class'	 => 'categories',
			)
		);
	}

	function zelproducts_promo_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'promo',
				// 'menu_id'        => 'promo-menu',
				'menu_class'	 => 'promo-menu',
			)
		);
	}

	function zelproducts_categories_footer_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'categories_footer',
			)
		);
	}

	function zelproducts_categories_mobile_menu() {
		wp_nav_menu(
			array(
				'theme_location' => 'categories_mobile',
			)
		);
	}

?>