<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zelproducts
 */

/**
if ( ! is_active_sidebar( 'footer_info' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'footer_info' ); ?>
</aside>

<!-- #secondary -->
*/
?>