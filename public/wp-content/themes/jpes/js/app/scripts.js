(function ($, root, undefined) {
	$(function () {
		'use strict';
		// DOM ready, take it away
		// Set this variable with the desired height
		var navbar = $('.navbar-move'),
			body = $('body');
		var offsetPixels = navbar.offset().top;
		if($(window).width() > 768) {
			offsetPixels += 60;
		}

		$(window).on('load scroll', function() {
			if ($(window).scrollTop() > offsetPixels) {
				navbar.addClass('fixed');
				body.addClass('navbar-fixed');
			} else {
				navbar.removeClass('fixed');
				body.removeClass('navbar-fixed');
			}
		});
	});
})(jQuery, this);

$(function() {
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			var top = $('.navbar-move').height();
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - top
				}, 1000);
				return false;
			}
		}
	});
});
