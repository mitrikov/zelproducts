<?php 

if( ! defined('ABSPATH')) {
	exit;
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'zelproducts_wrapper_start', 10);
add_action( 'woocommerce_after_main_content', 'zelproducts_wrapper_end', 10);

function zelproducts_wrapper_start() {
	echo '<main class="container_main">';
	echo '<section class="main">';
}

function zelproducts_wrapper_end() { 
	echo '</section>';
	echo '</main>';
}

?>