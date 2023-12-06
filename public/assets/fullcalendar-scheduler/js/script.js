$(function(){

	$('.date-time').mask('00/00/0000 00:00:00');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});

$('.saveEvent').click(function(){
	let id 		= $('#modal-calendar #id').val();
	let start = moment($('#modal-calendar #start').val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
	let end 	= moment($('#modal-calendar #end').val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
	let title = $('#modal-calendar #title').val();
	let color = $('#modal-calendar #color').val();

	let Event = {
    id:       id,
    inicio:   start,
    final:    end,
    obs:      title,
		color:    color,
	}

	if (id == '') {
		route = routeEvents('routeEventStore');
	}else{
		route = routeEvents('routeEventUpdate');
		Event.id = id;
		Event._method = 'PUT';
	}
	sendEvent(route, Event)
});

$('.deleteEvent').click(function(){
	let id 		= $('#modal-calendar #id').val();

	let Event = {
    id:       id,
    _method:  'DELETE',
	}

	route = routeEvents('routeEventDestroy');

	sendEvent(route, Event)
});

function sendEvent(route, data_){
	$.ajax({
		url: 			route,
		data: 		data_,
		method: 	'POST',
		dataType: 'json',
		success: function(json){
			// console.log(json)
			if(json){
				objCalendar.refetchEvents();
				$('#modal-calendar').modal('hide');
				// location.reload();
			}
		},
		error: function(json){
			let responseJSON = json.responseJSON.errors;

			$('#message').html(loadErros(responseJSON));
		}
	})
}

function loadErros(response){
	let boxAlert = `<div class="alert alert-danger">`;

	for(let fields in response){
		boxAlert += `<span>${response[fields]}</span></br>`;
	}

	boxAlert += `</div>`;

	return boxAlert.replace(/\,/g, '</br>');
}

function routeEvents(route){
	// $('#calendar').dataset[route];
	return document.getElementById('calendar').dataset[route];
}

function clearMessage(element){
	$(element).text('');
}

function resetForm(form){
	$(form)[0].reset();
}