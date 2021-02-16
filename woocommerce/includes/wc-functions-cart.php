<?php
/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'zelproducts_woocommerce_header_cart' ) ) {
			zelproducts_woocommerce_header_cart();
		}
	?>
 */

if( ! defined('ABSPATH')) {
	exit;
}


if ( ! function_exists( 'zelproducts_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function zelproducts_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		zelproducts_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'zelproducts_woocommerce_cart_link_fragment' );

if( WP_DEBUG && WP_DEBUG_DISPLAY && (defined('DOING_AJAX') && DOING_AJAX) ){
	@ ini_set( 'display_errors', 1 );
}

if ( ! function_exists( 'zelproducts_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function zelproducts_woocommerce_cart_link() {
		?>
		<div class="cart_icon">
			<div class="cart_count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></div>
		</div>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Просмотр содержимого корзины', 'zelproducts' ); ?>">Корзина — <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span></a>
			<?php
			/*$item_count_text = sprintf(
				/* translators: number of items in the mini cart. 
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'zelproducts' ),
				WC()->cart->get_cart_contents_count()
			);
			 <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>  */
			?>
		<?php
	}
	
	add_action( 'wc_ajax_get_cart_link', 'zelproducts_woocommerce_cart_link' );

}

if ( ! function_exists( 'zelproducts_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function zelproducts_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php zelproducts_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}