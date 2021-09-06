/*price range*/

 $('#sl2').slider();

 		$('.catalog').dcAccordion({
			speed: 300
		});

 		function showCart(cart){
 			$('#cart .modal-body').html(cart);
 			$('#cart').modal();
		}

		$('#cart .modal-body').on('click', '.del-item', function () {
			var id = $(this).data('id');
			$.ajax({
				url: '/cart/del-item',
				data: {id: id},
				type: 'GET',
				success: function(res){
					if(!res) alert('Ошибка!');
					// console.log(res);
					showCart(res);
				},
				error: function(){
					alert('Ошибка!');
				}
			});
		});


		$('#cart-page').on('click', '.del-item', function () {
			var id = $(this).data('id');
			$.ajax({
				url: '/cart/del-item',
				data: {id: id},
				type: 'GET',
				success: function(res){
					if(!res) alert('Ошибка!');
					$('#cart-page').html(res);
					if(res.indexOf("Корзина")) location.reload();

				},
				error: function(){
					alert('Ошибка!');
				}
			});
		});


 		function getCart() {
			$.ajax({
				url: '/cart/show',
				type: 'GET',
				success: function(res){
					if(!res) alert('Ошибка!');
					showCart(res);
				},
				error: function(){
					alert('Ошибка!');
				}
			});
			return false;
		}
		function clearCart(){
			$.ajax({
				url: '/cart/clear',
				type: 'GET',
				success: function(res){
					if(!res) alert('Ошибка!');
					showCart(res);
				},
				error: function(){
					alert('Ошибка!');
				}
			});
		}



		
$('.features_items').on('click', '.add-to-cart', function (e) {
	e.preventDefault();
	var id = $(this).data('id'),
		qty = $('#qty').val();
	$.ajax({
		url: '/cart/add',
		data: {id: id, qty: qty},
		type: 'GET',
		success: function(res){
			if(!res) alert('Ошибка!');
			// console.log(res);
			showCart(res);
		},
		error: function(){
			alert('Ошибка!');
		}
	});
});

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});


/**
 * Лайтбокс
 * https://www.jqueryscript.net/lightbox/image-viewer-smooth-animations.html
 */

 $(".zoom-button").click(function(){
	
	$("#full-image").attr("src", $(".images img").attr("src"));
	$('#image-viewer').show();
  });
  
  $("#image-viewer .close").click(function(){
	$('#image-viewer').hide();
  });
  
  /**
   * Carusel inner click
   */

$(" #similar-product .carousel-inner a").on("click", function(e){
	e.preventDefault();
	let id = $(this).data('id'); 
	let idimage = $(this).data('idimage'); 
	$.ajax({
		url:'/product/get-full-image',
		data: {id: id, idimage: idimage},
		type:'GET',
		success: function(res){
		
			$(".view-product img").attr("src",  res ) ;

	   },
		error: function(){
			alert("error");
		}
	})
	
});

function getPrice(){
	// let priceVal = $(".slider").slider(options);
	let priceVal = $(".tooltip-inner").text();
	let num =  priceVal.split(' : ');
	let id = $('.category-id').data('id');
	// let priceVal = slider.getValue
	// alert( num[0] );

	$.ajax({
		url:'/category/filter',
		data:{low: num[0], hight: num[1], id: id},
		method: 'GET',
		success: function(res){
			$(res).replaceAll(".dump");
		},
		error: function(){

		}

	})

}


