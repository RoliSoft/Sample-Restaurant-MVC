$(document).ready(function () {

	if (window.location.hash.startsWith('#item-')) {
		var id = window.location.hash.substr(1);
		var el = $('tr.' + id);

		if (el) {
			el.addClass('highlight');

			var offset   = el.offset();
			offset.left -= 20;
			offset.top  -= 20;

			$('html, body').animate({
				scrollTop:  offset.top,
				scrollLeft: offset.left
			});
		}
	}

	if ($('.food-wells-soup,.food-wells-main,.food-wells-dessert').length) {
		setTimeout(function () {
			$('.food-wells-soup').css('min-height', Math.max.apply(null,
				$('.food-wells-soup').map(function () {
					return $(this).outerHeight();
				}).get()
			));
			$('.food-wells-main').css('min-height', Math.max.apply(null,
				$('.food-wells-main').map(function () {
					return $(this).outerHeight();
				}).get()
			));
			$('.food-wells-dessert').css('min-height', Math.max.apply(null,
				$('.food-wells-dessert').map(function () {
					return $(this).outerHeight();
				}).get()
			));
		}, 50);
	}

	if ($('.datepicker,.datetimepicker').length) {
		$('.datetimepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});

		$('.datepicker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	}

});