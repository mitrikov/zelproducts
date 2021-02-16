<?php 

if( ! defined('ABSPATH')) {
	exit;
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'zelproducts_wrapper_start', 10);
add_action( 'woocommerce_after_main_content', 'zelproducts_wrapper_end', 10);

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 6 );

function zelproducts_wrapper_start() {
	echo '<main class="container_main">';
	echo '<section class="main">';
}

function zelproducts_wrapper_end() { 
	echo '</section>';
	echo '</main>';
}



//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_output_all_notices', 10 );

add_action('woocommerce_after_shop_loop_item_title', 'zelproducts_after_shop_loop_item_title_short_description', 5);

function zelproducts_after_shop_loop_item_title_short_description() {
	global $product;

	if ( ! $product->post->post_excerpt ) return;
	?>
	<div itemprop="description" class="woocommerce-products-short_description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
	</div>
	<?php
}


add_action('woocommerce_after_shop_loop_item_title', 'zelproducts_loop_bottom_part_wrapper_start', 8);

function zelproducts_loop_bottom_part_wrapper_start() { ?>
	<div class="loop_bottom_part_wrapper">
		<div class="loop_bottom_part_content">
<?php }

add_action('woocommerce_after_shop_loop_item', 'zelproducts_loop_bottom_part_wrapper_end', 15);

function zelproducts_loop_bottom_part_wrapper_end() { ?>
		</div>
	</div>
<?php }

//Добавляем выбор количества к товарам на основной странице
add_action( 'woocommerce_after_shop_loop_item', 'custom_quantity_field_archive', 0, 9 );

function custom_quantity_field_archive() {
	$product = wc_get_product( get_the_ID() );
	if ( ! $product->is_sold_individually() && 'variable' != $product->product_type && $product->is_purchasable() ) {
		woocommerce_quantity_input( array( 
			'min_value' => 1, 
			'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity(),
			'product_name' => '',
			'placeholder' => '',
			'classes' => 'loop-input-qty quantity qty'
		));
	}

}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'zelproducts_template_loop_product_thumbnail', 10);

function zelproducts_template_loop_product_thumbnail() {
	$product = wc_get_product( get_the_ID() );
	$imageId = $product->get_image_id();
	$src = '';
	
	$imageId ? $src = wp_get_attachment_image_src( $imageId, "medium")[0] : $src = wc_placeholder_img_src("thumbnail");

	echo '<img src="'. $src.'">';
}

//remove_action('woocommerce_cart_item_thumbnail', 'woocommerce_template_cart_thumbnail', 10);
add_action('woocommerce_cart_item_thumbnail', 'zelproducts_template_cart_thumbnail', 10, 2);


function zelproducts_template_cart_thumbnail($product_image, $cart_item) {
	if( is_cart() ) {
		$product = $cart_item['data'];
		$imageId = $product->get_image_id();
		$src = '';

		$imageId ? $src = wp_get_attachment_image_src( $imageId, "medium")[0] : $src = wc_placeholder_img_src("thumbnail");

		$product_image = '<img src="'. $src.'">';
	}

	return $product_image;
}


// замена стандартных текстов
function rog_shop_strings( $translated_text, $text, $domain ) {
	
	if( 'woocommerce' === $domain ) {
	
		switch ( $translated_text ) {
			case 'Подытог' :
			$translated_text = 'Сумма';
			break;

			case 'Купон:' :
			$translated_text = 'Промокод:';
			break;

			case 'Код купона' :
			$translated_text = 'Номер скидочной карты';
			break;

			case 'Применить купон' :
			$translated_text = 'Применить';
			break;
		}
	
	}
	
	return $translated_text;
}
add_filter( 'gettext', 'rog_shop_strings', 20, 3 );

?>