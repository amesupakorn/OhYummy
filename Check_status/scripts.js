/* Please ❤ this if you like it! */


(function ($) {
	"use strict";

	$(function () {
		var header = $(".start-style");
		$(window).scroll(function () {
			var scroll = $(window).scrollTop();

			if (scroll >= 10) {
				header.removeClass('start-style').addClass("scroll-on");
			} else {
				header.removeClass("scroll-on").addClass('start-style');
			}
		});
	});

	//Menu On Hover

	$('body').on('mouseenter mouseleave', '.nav-item', function (e) {
		if ($(window).width() > 1000) {
			var _d = $(e.target).closest('.nav-item'); _d.addClass('show');
			setTimeout(function () {
				_d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
			}, 1);
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

$(".step").click(function () {
	$(this).addClass("active").prevAll().addClass("active");
	$(this).nextAll().removeClass("active");
});

$(".step01").click(function () {
	$("#line-progress").css("width", "8%");
	$(".step1").addClass("active").siblings().removeClass("active");
});

$(".step02").click(function () {
	$("#line-progress").css("width", "50%");
	$(".step2").addClass("active").siblings().removeClass("active");
});

$(".step03").click(function () {
	$("#line-progress").css("width", "100%");
	$(".step3").addClass("active").siblings().removeClass("active");
});

