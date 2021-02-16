/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	// wp.customize( 'blogname', function( value ) {
	// 	value.bind( function( to ) {
	// 		$( '.site-title a' ).text( to );
	// 	} );
	// } );
	// wp.customize( 'blogdescription', function( value ) {
	// 	value.bind( function( to ) {
	// 		$( '.site-description' ).text( to );
	// 	} );
	// } );

	// // Header text color.
	// wp.customize( 'header_textcolor', function( value ) {
	// 	value.bind( function( to ) {
	// 		if ( 'blank' === to ) {
	// 			$( '.site-title, .site-description' ).css( {
	// 				clip: 'rect(1px, 1px, 1px, 1px)',
	// 				position: 'absolute',
	// 			} );
	// 		} else {
	// 			$( '.site-title, .site-description' ).css( {
	// 				clip: 'auto',
	// 				position: 'relative',
	// 			} );
	// 			$( '.site-title a, .site-description' ).css( {
	// 				color: to,
	// 			} );
	// 		}
	// 	} );
	// } );
	let stickerFooterVisibleStyles = {'visibility' : 'visible','bottom' : 0 }

	if(parseInt($('.cart_mobile .cart_count').text()) == 0) {
		$('.cart_mobile').css({'visibility' : 'none'});
	} else {
		$('.cart_mobile').css(stickerFooterVisibleStyles);
	}

	function sleep(ms) {
		ms += new Date().getTime();
		while (new Date() < ms){}
	} 

	async function updateCartLink() { //Обновляет сумму и кол-во товара в шапке
		return fetch('/?wc-ajax=get_cart_link', { //document.location.origin + '/wp-admin/admin-ajax.php'
			method: 'POST',
		}).then((response) => {
			return response.text();
		}).then((result) => {
			if(result) {
				$('.header_menuRight > ul > li:nth-child(2)').html(result);
				$('.cart_mobile > ul > li:nth-child(2)').html(result);
				$('.cart_mobile').css(stickerFooterVisibleStyles);
			}
		}); 
	}


	jQuery( document ).on( 'click', '.plus, .minus', function() { //Добавляет количество к свойствам тега
		var dataQuantity = jQuery( this ).closest( '.loop_bottom_part_wrapper' ).find( '.add_to_cart_button'),
			qty = jQuery( this ).closest( '.quantity' ).find( '.qty');
			dataQuantity.attr('data-quantity', qty.val());
	});
	

	$('body').on('added_to_cart', function() { //Уведомление о добавлении товара в корзину
		Swal.fire({
		  toast: true,
		  position: 'top',
		  icon: 'success',
		  title: 'Товар добавлен в корзину!',
		  showConfirmButton: false,
		  timer: 1500,
		   showClass: {
   			 	popup: 'mt-10'
 			 }
		});

		updateCartLink();

	});

	$('#menu__toggle').on('change', function(e) { //Блокирует скрол при открытии мобильного меню
		$('body').toggleClass('scroll_lock');
	});

	let timeout;
	
	jQuery('div.woocommerce').on('change', '.qty', function(){ //Обновляет корзину при изменении количества товара
        if ( timeout !== undefined ) {
			clearTimeout( timeout );
		}
 		
		timeout = setTimeout(function() {
			$("[name='update_cart']").trigger("click");
		}, 1000)
     });

     $('body').on('updated_cart_totals', function() {
     	updateCartLink();
     })
	
}( jQuery ) );
