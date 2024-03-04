/* Please ❤ this if you like it! */
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

  //booktime

//   let bookedTimes = [];

// function bookTime() {
//     const selectedDate = document.getElementById('date').value;
//     const selectedTime = document.getElementById('time').value;
//     const dateTime = `${selectedDate} ${selectedTime}`;

//     if (bookedTimes.includes(dateTime)) {
//         alert('This time slot is already booked. Please choose another time.');
//     } else {
//         bookedTimes.push(dateTime);
//         alert('คุณจองโต๊ะเรียบร้อย!');
//     }
// }

// //จองเวลา
// let selectedTimeSlot = null;

//         function selectTime(element) {
//             if (selectedTimeSlot) {
//                 // ถ้ามีเวลาที่ถูกเลือกอยู่แล้ว
//                 // ให้ลบคลาส 'selected' ออกจากเวลาที่ถูกเลือก
//                 selectedTimeSlot.classList.remove('selected');
//             }

//             // เลือกเวลาใหม่
//             selectedTimeSlot = element;
//             // เพิ่มคลาส 'selected' ในเวลาที่ถูกเลือก
//             selectedTimeSlot.classList.add('selected');
//         }

