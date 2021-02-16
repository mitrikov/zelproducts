<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zelproducts
 */

?>

<div class="cart_mobile">
	<ul>
		<li><div class="user_icon"></div><a href="<?php echo site_url('/wp-login.php?action=register'); ?>">Войти</a></li>
		<li><?php zelproducts_woocommerce_cart_link(); ?></li>
	</ul>
</div>

<footer class="footer_content">
		<div class="footer_topLine">
				<?php 
					if ( is_active_sidebar( 'footer_info' ) ) :
						dynamic_sidebar( 'footer_info' );
					else :

					endif; 
				?>

				<!-- <div class="footer_menuHeader">Контакты:</div>
					<ul>
						<li><a href="">Россия, г. Зеленоград корп. 316</a></li>
						<li><a href="">Доставка</a></li>
						<li><a href="">Политика конфиденциальности</a></li>
					<ul> -->
				
				<?php 
					if ( is_active_sidebar( 'footer_timetable' ) ) :
						dynamic_sidebar( 'footer_timetable' );
					else :

					endif; 
				?>
		<!-- 	<div class="footer_timetable">
				<div class="footer_menuHeader">Время работы</div>
				<ul>
					<li>понедельник-пятница: 10-19 ч.</li>
					<li>суббота: 10-18 ч.</li>
					<li>воскресенье — выходной</li>
				</ul>
			</div> -->

			<nav class="footer_menuCategories">
				<div class="footer_menuHeader">Категории товаров</div>
				<?php zelproducts_categories_footer_menu(); ?>
				
			</nav>

			<nav class="footer_menuInfo">
				<div class="footer_menuHeader">Профиль</div>
				<ul>
					<li><a href="<?php echo site_url('/wp-login.php?action=register'); ?>">Вход</a></li>
					<li><a href="">Данные </a></li>
				</ul>
			</nav>
		</div>		
			
			<div class="footer_bottomLine">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zelproducts' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'zelproducts' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s %2$s.', 'zelproducts' ), 'Family Products', '<a href="http://underscores.me/"></a>' );
				?>	
			</div>	
	</footer>

<?php wp_footer(); ?>

</body>
</html>
