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

})(jQuery);


function updateRefreshTime() {
    var now = new Date();
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    var refreshTime = hours + ':' + minutes;
    document.getElementById('refreshTime').textContent = refreshTime;
}

// Call updateRefreshTime() function when page is loaded
updateRefreshTime();

// Call updateRefreshTime() function whenever page is refreshed
window.onbeforeunload = function() {
    updateRefreshTime();
};