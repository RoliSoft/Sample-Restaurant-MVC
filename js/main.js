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

	$('.datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss'
	});

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

});