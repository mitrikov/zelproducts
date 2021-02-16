jQuery(function( $ ) {
	let searchQueryData = {
		s : '',
		action : 'search',
		nonce : search.nonce,
	};

	$('.header_searchText').on('keyup', function (e) {
		e.preventDefault();
		if(this.value.length>=4) {
			searchQueryData.s = this.value;
	
			$.ajax({
				url : search.url,
				data : searchQueryData,
				type : 'POST',
				dataType : 'json',
				beforeSend : function(xhr){

				},

				success : function(data){
					
					if(data) {
						$(".header_searchForm_results").html(data);
						$(".header_searchForm_results").show();
						$(".header_searchText").css("border-radius", 0);
					} else {
						$(".header_searchForm_results").empty();
						$(".header_searchForm_results").hide();
						$(".header_searchText").css("border-radius", 15);
					}
				}
			});
		} else { 
			$(".header_searchForm_results").hide();
			$(".header_searchText").css("border-radius", 15);
		}
	});

	$('.header_searchText').on('focus', function (e) {
		// e.preventDefault();
		// if($(".header_searchForm_results").html()) {
		 	//$(".header_searchForm_results").show();
		 	//$(".header_searchText").css("border-radius", 0);
		//}
	});

	window.onclick = function(event) { 
		var target = $( event.target );
		//console.log(target.is( '.header_searchText'));
		if(!target.is( '.header_searchText')) { 
			$(".header_searchForm_results").hide();
			$(".header_searchText").css("border-radius", 15);
		} else {
			$(".header_searchForm_results").show();
			if($(".header_searchForm_results").html())$(".header_searchText").css("border-radius", 0);
		}
	}
});