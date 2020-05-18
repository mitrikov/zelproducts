<?php 

if( ! defined('ABSPATH')) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */
function zelproducts_scripts() {
	wp_enqueue_style( 'zelproducts-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'zelproducts-style', 'rtl', 'replace' );

	wp_enqueue_script( 'zelproducts-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'zelproducts-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zelproducts_scripts' );


 ?>