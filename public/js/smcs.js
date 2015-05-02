;(function() {
	'use strict';
	
	$(document).on('submit', function(e) {
		e.preventDefault();
		
		var form = $(e.target),
			output = $('#output');
		
		$.ajax(form.attr('action'), {
			type: 'POST',
			contentType: 'application/json',
			data: JSON.stringify({
				"group"       : $('#group').val(),
				"current_year": $('#current-year').val(),
				"esv_period"  : $('#esv-period').val(),
				"from"        : $('#from').val(),
				"to"          : $('#to').val(),
				"language"    : $('#language').val()
			}),
			success: function(data) {
				output.html(data);
			},
			error: function(xhr) {
				if (xhr.status == 422) {
					var ul = $('<ul></ul>');
					for (var e in xhr.responseJSON) {
						ul.append($('<li></li>')
							.html(window.SMCS.lang[e] + ': ')
							.append(xhr.responseJSON[e]));
					}
					output.html(ul);
				}
			}
		});
	});
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$(document).ready(function() {
		$('.yearpicker').datetimepicker({
			viewMode: 'years',
			format: 'YYYY',
			locale: window.SMCS.locale
		});
		
		$('.datepicker').datetimepicker({
			viewMode: 'days',
			format: 'DD.MM.YYYY',
			locale: window.SMCS.locale
		});
	});
}());
