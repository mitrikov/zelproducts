/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
import { Swal } from "sweetalert";


( function( $ ) {
	const stickyTriggerPosY = 235;
	const mobileBreakPoint = 920;

	let stickyHeader2 = $(".categories-container");
	let main = $('.main');
	let stickerFooterVisibleStyles = {'visibility' : 'visible','bottom' : 0 };
	
	let isSubmenuMouseOver = false; //Переменная указывает наведена ли мышь на подменю
	let isMenuMouseOver = false; //Переменная указывает наведена ли мышь на меню

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
     });

    
	const menuItems = '.side-menu > .menu-kategorii-container > .categories > .menu-item';
	const subMenuItems = '.side-menu > .menu-kategorii-container > .categories > .menu-item > .sub-menu';
	const mobileMenuItems = '.header_categories_mobile > .menu-kategorii-container > .mobile-menu > .menu-item';
	const catalogMenuBack = 'li > .catalog-menu__back:first-child'
	
	//console.log($(subMenuItems));

    let toggleMenu = (e) => { //Переключение видимости основного меню
     	$(e.target).parents().find('.side-menu .menu-kategorii-container').toggleClass('visible');
     }

	let closeMenu = (e) => { //Закрытие основного меню
		let el = e.target.className; 
		let isMenuElem = el == "menu-button" || el == "menu-button-text" || el == "menu" || el == "menu-item" || el == "sub-menu visible" || el == "catalog-menu__back" || e.target.tagName == "A";
					
		if(!isMenuElem) {
			$(".side-menu .menu-kategorii-container").removeClass("visible");
		}
	}

    let showSubmenu = (e) => { //Показ подменю
     	$(e.target).parent().find('.sub-menu').addClass('visible');
     }

	let hideSubmenu = (e) => { //Скрытие подменю
		$(e.target).parent().find('.sub-menu').removeClass('visible');
	}

	let showSubmenuFromSubmenu = (e) => { //Переключение видимости подменю, вызываемое из подменю
		$(e.target).closest('.sub-menu').addClass('visible');
	}

	let hideSubmenuFromSubmenu = (e) => { //Переключение видимости подменю, вызываемое из подменю
		$(e.target).closest('.sub-menu').removeClass('visible');
	}

	let hideSubmenuMobile = (e) => { //Скрывает подменю на мобильной версии
		$(e.target).parents().find('.appearFromRight').removeClass('appearFromRight');
		console.log($(e.target).parents().find('.appearFromRight'));
	}

	let addMainCategoryToSubmenus = (menuItemsSelector, mobile) => { // Добавляет пункт основной категории в подменю
		items = $(menuItemsSelector);
		let arrow = '';

		if(mobile) { // Добавляем стрелочку возврата только для мобильного меню
			arrow = '<a href="#href" class="catalog-menu__back"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M.236 7.799a.704.704 0 01-.23-.517c0-.187.077-.373.23-.516L7.56.214a.826.826 0 011.11 0 .695.695 0 010 1.032L2.795 6.483h13.395a.81.81 0 010 1.619H2.818l5.852 5.216a.696.696 0 010 1.033.826.826 0 01-1.109 0L.236 7.8z" fill="#002D72"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M.236 7.799a.704.704 0 01-.23-.517c0-.187.077-.373.23-.516L7.56.214a.826.826 0 011.11 0 .695.695 0 010 1.032L2.795 6.483h13.395a.81.81 0 010 1.619H2.818l5.852 5.216a.696.696 0 010 1.033.826.826 0 01-1.109 0L.236 7.8z" fill="#fff"></path></svg></a>';
			//arrow.addEventListener('click', (e) => { hideSubmenuMobile(e) });
		}
		
		for(let item of items) {
			let currentCat = item.querySelector('a');
			let currentLink = currentCat.getAttribute('href');
			let currentName = currentCat.innerText;
			let subMenu = item.querySelector('.sub-menu');
			let currentSubMenuHTML = subMenu.innerHTML;

			subMenu.innerHTML = '<li>' + arrow + '<a href="' + currentLink + '" class="catalog-menu__back">' + currentName + '</a></li>' + currentSubMenuHTML;
		}
	}
	

    $('.menu-button').on('click', (e) => toggleMenu(e)); //Показ основного меню категорий при клике
    $(document).on('click', (e) => closeMenu(e));

    $(menuItems).on('mouseover', (e) => { showSubmenu(e); }); //Показ подменю категорий при наведении курсора на пункты меню
	$(menuItems).on('mouseout', (e) => { hideSubmenu(e); }); //Скрытие подменю категорий при наведении курсора на пункты меню
	$(subMenuItems).on('mouseover', (e) => { showSubmenuFromSubmenu(e); }); //Показ подменю категорий при наведении курсора на подпункты меню
	$(subMenuItems).on('mouseout', (e) => { hideSubmenuFromSubmenu(e); }); //Скрытие подменю категорий при наведении курсора на подпункты меню
	

	addMainCategoryToSubmenus(menuItems, false);
	addMainCategoryToSubmenus(mobileMenuItems, true);
	
	$(catalogMenuBack).on('click', (e) => { hideSubmenuMobile(e) }); //Скрывает подменю на мобильной версии


	 let toggleSubmenuMobile = (e) => { //Toggle мобильного подменю
     	let subMenu = $(e.target).parent().find('.sub-menu');
     	subMenu.toggleClass('appearFromRight');
     }    

    $('.mobile-menu > .menu-item').on('click', (e) => { //Показ подменю категорий в мобильной версии
 		e.preventDefault();
 		toggleSubmenuMobile(e);
     });


    
    // $("#billing_address_2_field").prepend("<div class=\"checkout-container\">");
	// $("#billing_address_2_field").append("</div>");
	//$("</div>").after("#billing_email_field");
	
	let mainPaddingTop = parseInt(main.css("padding-top"));
	let stickyHeader2Height = parseInt(stickyHeader2.css("height"));

	$(window).on("scroll", (e) => { // Прилипание блока с каталогом товаров к шапке
		let scrollY = window.scrollY;
		if (window.innerWidth >= mobileBreakPoint) { // Если это версия для ПК
			if(scrollY >= stickyTriggerPosY) {
				stickyHeader2.addClass("sticky_header2");
				main.css("padding-top", mainPaddingTop + stickyHeader2Height);
				trigger = true;
			} else if (scrollY < stickyTriggerPosY) {
				stickyHeader2.removeClass("sticky_header2");
				main.css("padding-top", mainPaddingTop);
			}
		} else {
			stickyHeader2.removeClass("sticky_header2");
			main.css("padding-top", mainPaddingTop);
		}
	})
	
}( jQuery ) );

