<?php 

if( ! defined('ABSPATH')) {
	exit;
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function slug_disable_woocommerce_block_styles() {
  wp_dequeue_style( 'wc-block-style' );
  wp_deregister_style( 'wc-block-editor' );
  wp_deregister_style( 'wc-block-style' );
}
add_action( 'wp_enqueue_scripts', 'slug_disable_woocommerce_block_styles' );



?>