<?php 

if( ! defined('ABSPATH')) {
	exit;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function zelproducts_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Подвал — информарция', 'zelproducts' ),
			'id'            => 'footer_info',
			'description'   => 'Перетащите сюда виджеты, чтобы добавить их в подвал.',
			'before_widget' => '<section id="%1$s" class="footer_menuInfo %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer_menuHeader">',
			'after_title'   => '</h2>',
		)
	);

		register_sidebar(
		array(
			'name'          => esc_html__( 'Подвал — время работы', 'zelproducts' ),
			'id'            => 'footer_timetable',
			'description'   => 'Перетащите сюда виджеты, чтобы добавить их в подвал.',
			'before_widget' => '<section id="%1$s" class="footer_menuInfo %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer_menuHeader">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zelproducts_widgets_init' );

?>