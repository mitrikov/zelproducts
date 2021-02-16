<?php 

if( ! defined('ABSPATH')) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */

add_action( 'wp_enqueue_scripts', 'zelproducts_scripts' );

function zelproducts_scripts() {
	wp_enqueue_style( 'zelproducts-reset', get_template_directory_uri() . '/assets/css/reset.css');
	wp_enqueue_style( 'zelproducts-content', get_template_directory_uri() . '/assets/css/content.css');
	wp_enqueue_style( 'zelproducts-header', get_template_directory_uri() . '/assets/css/header.css');
	wp_enqueue_style( 'zelproducts-header-adaptive', get_template_directory_uri() . '/assets/css/header-adaptive.css');
	wp_enqueue_style( 'zelproducts-burger-menu', get_template_directory_uri() . '/assets/css/burger-menu.css'); 
	wp_enqueue_style( 'zelproducts-categories', get_template_directory_uri() . '/assets/css/categories.css');
	wp_enqueue_style( 'zelproducts-footer', get_template_directory_uri() . '/assets/css/footer.css');
	wp_enqueue_style( 'zelproducts-loop-products', get_template_directory_uri() . '/assets/css/loop-products.css');
	wp_enqueue_style( 'zelproducts-loop-products-adaptive', get_template_directory_uri() . '/assets/css/loop-products-adaptive.css');
	wp_enqueue_style( 'zelproducts-single-product', get_template_directory_uri() . '/assets/css/single-product.css');
	wp_enqueue_style( 'zelproducts-checkout', get_template_directory_uri() . '/assets/css/checkout.css');
	wp_enqueue_style( 'zelproducts-checkout-adaptive', get_template_directory_uri() . '/assets/css/checkout-adaptive.css');
	wp_enqueue_style( 'zelproducts-cart', get_template_directory_uri() . '/assets/css/cart.css');
	wp_enqueue_style( 'zelproducts-cart-adaptive', get_template_directory_uri() . '/assets/css/cart-adaptive.css');
	wp_enqueue_style( 'zelproducts-slider', get_template_directory_uri() . '/assets/css/slider.css');
	wp_enqueue_style( 'zelproducts-my-account', get_template_directory_uri() . '/assets/css/my-account.css');
	
	wp_enqueue_style( 'zelproducts-style', get_stylesheet_uri(), array(), _S_VERSION );
	 
	

	wp_enqueue_style( 'zelproducts-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
	wp_enqueue_style( 'zelproducts-fonts2', 'https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap');
	wp_style_add_data( 'zelproducts-style', 'rtl', 'replace' );

	wp_enqueue_script( 'zelproducts-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'zelproducts-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'zelproducts-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'zelproducts-slider', get_template_directory_uri() . '/assets/js/slider.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( is_page('checkout') ) {
		wp_enqueue_script('zelproducts-yandex-api', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=589950b5-8240-429e-9ecf-14bce81560f9');
		wp_enqueue_script( 'zelproducts-map', get_template_directory_uri() . '/assets/js/map.js');
	}

	wp_enqueue_script('ajax-search', get_template_directory_uri() . '/assets/js/ajax-search.js');
	wp_localize_script('ajax-search', 'search', array(
	 	'url' => admin_url('admin-ajax.php'),
	 	'nonce' => wp_create_nonce('myajax-nonce'),
	 ));


	wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/js/sweetalert2.all.min.js');
	wp_enqueue_style('sweetalert', get_template_directory_uri() . '/assets/js/sweetalert2.min.css');

}

add_action( 'wp_enqueue_scripts', 'wcs_dequeue_quantity' );

function wcs_dequeue_quantity() {
    wp_dequeue_style( 'wcqib-css' );
    wp_dequeue_style( 'wc-block-style' );
}

 ?>