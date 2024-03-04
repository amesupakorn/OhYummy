

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
	
	//Switch light/dark
	
	$("#switch").on('click', function () {
		if ($("body").hasClass("dark")) {
			$("body").removeClass("dark");
			$("#switch").removeClass("switched");
		}
		else {
			$("body").addClass("dark");
			$("#switch").addClass("switched");
		}
	});  
	
  })(jQuery);


//   document.addEventListener("DOMContentLoaded", function () {
// 	document.querySelectorAll('.minus').forEach(function (button) {
// 		button.addEventListener('click', function () {
// 			const inputField = button.nextElementSibling;
// 			let quantity = parseInt(inputField.value);
// 			if (quantity > 1) {
// 				quantity--;
// 				inputField.value = quantity;
// 				updateTotalPrice(button);
// 			}



// 		});
// 	});

// 	document.querySelectorAll('.plus').forEach(function (button) {
// 		button.addEventListener('click', function updatedata(id) {
// 			const inputField = button.previousElementSibling;
			
// 			let quantity = parseInt(inputField.value);

// 			quantity++;
// 			inputField.value = quantity;
// 			updateTotalPrice(button);

// 			let formData = new URLSearchParams();
// 			countfood = document.getElementById(id).value;
// 			alert(countfood)
// 			formData.append('foodid', id);
// 			formData.append('count', countfood);
			
// 			fetch('./menu.php', {
// 				method: 'POST',
// 				headers: {
// 					'Content-Type': 'application/x-www-form-urlencoded',
// 				},
// 				body: formData.toString()
// 			})
			
// 				});

// 	});

// 	function updateTotalPrice(button) {
// 		const menuCard = button.closest('.menu-card');
		
// 		const priceElement = menuCard.querySelector('.menu-price');
// 		const qtyElement = menuCard.querySelector('.qty');
// 		const totalElement = menuCard.querySelector('.each-total');

// 		const price = parseFloat(priceElement.innerText);
// 		const quantity = parseInt(qtyElement.value);

// 		const totalPrice = price * quantity;
// 		totalElement.innerHTML= '<br>'+ totalPrice.toFixed(2) + ' ฿';

// 	}



	
// 	});


	
// });

function plus(foodid){
	let elemf = document.getElementById(foodid); 
	$(elemf).val(parseInt($(elemf).val()) + 1);
	if ($(elemf).val() >= 100){
		$(elemf).val(100);
	}
	fetchdata(foodid);
}

function fetchdata(foodid){
	let formData = new URLSearchParams();
	countfood = document.getElementById(foodid).value;
    formData.append('foodid', foodid);
    formData.append('count', countfood);

    fetch('./basket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: formData.toString()
    })

	.then(response => {
		if (response.ok) {
			
			setTimeout(function() {
				location.reload();
			}, 500);
			return response.text();
		}
		throw new Error('Network response was not ok.');
	})
	.catch(error => {
		alert('There was a problem with the fetch operation: ' + error.message);
	});

}

function minus(foodid){
	// window.location.reload()
	let elemf = document.getElementById(foodid); 
	$(elemf).val(parseInt($(elemf).val()) - 1 );
	if ($(elemf).val() <= 1){
		$(elemf).val(1);
	}
	fetchdata(foodid)
	
}    



function deleteCard(foodid){
		let formData = new URLSearchParams();
		countfood = document.getElementById(foodid).value;
		deletee = document.getElementById("delete");
		formData.append('foodid', foodid);
		formData.append('delete', '1');

		fetch('./basket.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: formData.toString()
		})

		.then(response => {
			if (response.ok) {
				setTimeout(function() {
					location.reload();
				}, 500);
				return response.text();
			}
			throw new Error('Network response was not ok.');
		})
		.catch(error => {
			alert('There was a problem with the fetch operation: ' + error.message);
		});

		const menuCard = document.getElementById(`${foodid}-card`);
		menuCard.remove();
	
		
}

function updatedatabase(foodid){
	fetchdata(foodid);
}
  
