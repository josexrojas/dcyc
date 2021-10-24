$(document).ready(function() {
	
	//------------- Data tables -------------//
	$('#dataTable').dataTable( {
		"sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
		"sPaginationType": "bootstrap",
		"bJQueryUI": false,
		"bAutoWidth": false,
		"oLanguage": {
			"sSearch": "<span>Filtrar:</span> _INPUT_",
			"sLengthMenu": "<span>_MENU_ registros</span>",
			"oPaginate": { "sFirst": "Primero", "sLast": "Último" }
		}
	});

	$('.dataTables_length select').uniform();
	$('.dataTables_paginate > ul').addClass('pagination');
});