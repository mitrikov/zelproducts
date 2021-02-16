<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Zelproducts
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

if( ! defined('ABSPATH')) {
	exit;
}

function zelproducts_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'zelproducts_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function zelproducts_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'zelproducts_pingback_header' );


add_action( 'wp_ajax_search', 'zelproducts_search_callback' );
add_action( 'wp_ajax_nopriv_search', 'zelproducts_search_callback' );

function zelproducts_search_callback() {

	if(! wp_verify_nonce($_POST['nonce'], 'myajax-nonce')) wp_die('На воротник');

		$arg = array(
			'posts_per_page' => 10,
			'post_type' => array('post', 'product'),
			'post_status' => 'publish',
			's' => $_POST['s'],
			'meta_query' => array(
                'key' => '_price',
                'value' => 5,
                'type' => 'NUMERIC'
            )
		);
		
		$query = new WP_Query($arg);
		$json_data = ob_start(PHP_OUTPUT_HANDLER_CLEANABLE);
		
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
		?>
			<div class="result_item clear">
				<a href="<?php the_permalink(); ?>">
				<?php
					if(has_post_thumbnail()) {
						the_post_thumbnail(array('class'=>'post_thumbnail'));
					} else {
				?>
						<img src="<?php bloginfo('template_directory'); ?>/images/noimage.png" />
				<?php } ?>
				<?php $product = wc_get_product( get_the_ID() ); ?>
				<span><?php the_title(); ?></span>

				<?php echo $product->get_price_html(); ?>
				</a>
			</div>
		<?php } ?>
		<a href="<?php echo site_url('/?s=' . $arg['s']); ?>" class="header_searchForm_link">Посмотреть все результаты...</a>
		<?php 
		}
		$json_data = ob_get_clean();
		wp_send_json($json_data);

		wp_die();

	
	 // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
}


add_action( 'woocommerce_before_shop_loop', 'zelproducts_category_search' );

function zelproducts_category_search() { 
	// global $wp_query;
 //    $terms_post = get_the_terms( $post->cat_ID , 'product_cat' );
 //    foreach ($terms_post as $term_cat) { 
 //    $term_cat_id = $term_cat->term_id; 
 //    echo $term_cat_id;
	// }
	?>
	<!-- <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	  <div>
	    <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
	    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
	    <input type="hidden" name="cat" value="<?php echo $terms[key($terms)]->slug; ?>">
	    <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
	  </div>
	</form> -->
<?php } 



?>