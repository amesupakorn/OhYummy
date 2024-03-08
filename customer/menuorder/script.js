

(function($) { "use strict";

	$(function() {
		var header = $(".start-style");
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
		
			if (scroll >= 10) {
				header.removeClass('start-style').addClass("scroll-on");
			} else {
				header.removeClass("scroll-on").addClass('start-style');
			}
		});
	});		
		
	//Menu On Hover
		
	$('body').on('mouseenter mouseleave','.nav-item',function(e){
			if ($(window).width() > 1000) {
				var _d=$(e.target).closest('.nav-item');_d.addClass('show');
				setTimeout(function(){
				_d[_d.is(':hover')?'addClass':'removeClass']('show');
				},1);
			}
	});	


		
		
  })(jQuery);

  (function ($) {
	"use strict";
	// Auto-scroll
	$('#myCarousel').carousel({
	  interval: 2000
	});
  
	// On carousel scroll
	$("#myCarousel").on("slide.bs.carousel", function (e) {
	  var $e = $(e.relatedTarget);
	  var idx = $e.index();
	  var itemsPerSlide = 7;
	  var totalItems = $(".carousel-item").length;
	  if (idx >= totalItems - (itemsPerSlide - 1)) {
		var it = itemsPerSlide -
			(totalItems - idx);
		for (var i = 0; i < it; i++) {
		  // append slides to end 
		  if (e.direction == "left") {
			$(
			  ".carousel-item").eq(i).appendTo(".carousel-inner");
		  } else {
			$(".carousel-item").eq(0).appendTo(".carousel-inner");
		  }
		}
	  }
	});
  })
  (jQuery);

function filter(elem){
	let m = document.querySelectorAll('.card');
	let b = document.querySelector(".mainboxx");
	m.forEach(item => {
		if (item.classList.contains(elem)){
			item.style.visibility = 'visible';
		} else {
			item.style.visibility = 'hidden';
			b.removeChild(item);
			b.appendChild(item)
		}
	});



}



function plus(foodid){
	let elemf = document.getElementById(foodid); 
	$(elemf).val(parseInt($(elemf).val()) + 1);
	if ($(elemf).val() >= 100){
		$(elemf).val(100);
	}

}

function minus(foodid){
	let elemf = document.getElementById(foodid); 
	$(elemf).val(parseInt($(elemf).val()) - 1 );
	if ($(elemf).val() <= 1){
		$(elemf).val(1);
	}

	
}       

function updateBasket(id) {
	
    // ส่งค่า table_status และ tableID ไปยัง PHP script ด้วย Fetch API
	
    let formData = new URLSearchParams();
	countfood = document.getElementById(id).value;
    formData.append('foodid', id);
    formData.append('count', countfood);

	fetch('./menu.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: formData.toString()	
	})
	.then(response => {
		setTimeout(function() {
			location.reload();
		}, 1000);
		return response.text();
	})
	.catch(error => {
		alert('There was a problem with the fetch operation: ' + error.message);
	});
}
	


var counter = 10;

// When we click "Add to Basket"...
$('.custom-btn3').click(function(){
  // Add the animation class
  // Increase the counter
  counter++;
  // Add the new counter to the basket after 1s
  var buttonCount = setTimeout(function(){
    $('.basket').attr('data-count', counter);
  }, 1000);
  // Remove the animation classes after 1.5s
  var wait = setTimeout(function(){
    $('.item--helper, .basket').removeClass('added');
  }, 1500);
});

function alertlogin(){
	Swal.fire({
		title: "โปรดติดต่อหน้าร้าน",
		icon: "warning",
		confirmButtonColor: "#3085d6",
		confirmButtonText: "โอเค"
	  })
}

