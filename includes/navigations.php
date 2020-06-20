<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	register_nav_menus(
		array(
			'primary' => 'Основное',
			'secondary' => 'Вторичное',
			'categories' => 'Меню категорий',
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


?>