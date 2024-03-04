

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

// $(document).ready(function check(num){
// 	$('.count').prop('disabled', true);
// 	$(document).on('click','.plus',function(){
// 	$('.count').val(parseInt($('.count').val()) + 1 );
// 		if ($('.count').val() >= 100) {
// 			$('.count').val(100); 
// 		}
// 	});
// 	$(document).on('click','.minus',function(){
// 		$('.count').val(parseInt($('.count').val()) - 1 );
// 		if ($('.count').val() <= 1) {
// 			$('.count').val(1);
// 		}
// 	});
//  });



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
    

}
