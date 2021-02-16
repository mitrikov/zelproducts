<?php

if( ! defined('ABSPATH')) {
	exit;
}

function zelproducts_slider_function($atts, $content = null) { ?>
	<div class="zelproducts-slider">
  			<?php echo $content; ?>
	  <div class="sim-slider-arrow-left"></div>
	  <div class="sim-slider-arrow-right"></div>
	  <div class="sim-slider-dots"></div>
	</div>
	<?php
}

add_shortcode('zelproducts_slider', 'zelproducts_slider_function');


?>