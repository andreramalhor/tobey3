@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agenda</h3>

        <div class="card-tools">
          <div class="pagination pagination-sm float-right" style="margin: 5px 7px;"></div>

          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-target="#modal_agendamento_create"><i class="fas fa-plus"></i></a>
            @include('sistema.atendimentos.agendamentos.Modal.create')
            {{-- @include('sistema.atendimentos.agendamentos.Modal.show') --}}
            @include('sistema.atendimentos.agendamentos.Modal.sobreOCliente')

            {{-- <a class="btn btn-sm btn-default" ><i class="fas fa-filter"></i></a> --}}
            {{-- <a class="btn btn-sm btn-default" >Right</a> --}}
          </div>
        </div>
      </div>
      <div
      id='calendar'
      data-route-load-events='{{ route('agenda.routeLoadEvents') }}'
      data-route-event-store='{{ route('agenda.routeEventStore') }}'
      data-route-event-update='{{ route('agenda.routeEventUpdate') }}'
      data-route-event-destroy='{{ route('agenda.routeEventDestroy') }}'
      ></div>
      {{-- @dd($agendamentos) --}}
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript"> let objCalendar; </script>
<script>
  document.addEventListener('DOMContentLoaded', function() {

  /* initialize the external events
  -----------------------------------------------------------------*/

  // var containerEl = document.getElementById('external-events-list');
  // new FullCalendar.Draggable(containerEl, {
  //   itemSelector: '.fc-event',
  //   eventData: function(eventEl) {
  //     return {
  //       title: eventEl.innerText.trim()
  //     }
  //   }
  // });

  /* initialize the calendar
  -----------------------------------------------------------------*/

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
    locale: 'pt-br',
    nowIndicator: true,

    initialView: 'resourceTimeGridDay',
    slotMinTime: '06:00:00',
    slotMaxTime: '20:00:00',
    businessHours:
    {
      daysOfWeek: [ 2, 3, 4, 5, 6 ],
      startTime: '08:00',
      endTime: '20:00',
    },
    editable: true,
    selectable: true,
    selectMirror: true,
      dayMaxEvents: true, // allow "more" link when too many events
      headerToolbar:
      {
        left: 'today',
        center: 'title',
        right: 'prev,next',
      },
      views:
      {
        resourceTimeGridDay:
        {
          titleFormat:
          {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: '2-digit'
          },
        },
      },
      droppable: true, // this allows things to be dropped onto the calendar
      // navLinks: true,
      // dayMaxEventRows: true, // eventeLimit
      // selectable: true,
      // editable: true,

      // // uncomment this line to hide the all-day slot
      //allDaySlot: false,
      resourceOrder: 'area,ordem',
      resources:
      [
      @foreach($profissionais as $key => $profissional )
      { id: '{{ $profissional->id }}', title: '{{ $profissional->apelido }}', area: 'Cabeleireira', ordem: {{ $key }} },
      @endforeach
        // { id: 2,  title: 'Samira',    area: 'Produção',       ordem: 2, eventColor: 'green' },
        // { id: 3,  title: 'Silésia',   area: 'Cabeleireira',   ordem: 3, eventColor: 'orange' },
        // { id: 4,  title: 'Mona',      area: 'Unhas',          ordem: 4, eventColor: 'red' },
        // { id: 5,  title: 'Priscila',  area: 'Unhas',          ordem: 5, eventColor: 'blue' },
        // { id: 6,  title: 'Larysse',   area: 'Cabeleireira',   ordem: 6, eventColor: 'purple' },
        // { id: 7,  title: 'Karen',     area: 'Unhas',          ordem: 7, eventColor: 'yellow' },
        // { id: 8,  title: 'Monique',   area: 'Unhas',          ordem: 8, eventColor: 'violet' },
        // { id: 9,  title: 'Leila',     area: 'Cabeleireira',   ordem: 9, eventColor: 'aqua' },
        // { id: 10, title: 'Manu',      area: 'Unhas',          ordem: 10, eventColor: 'gray' },
        // { id: 11, title: 'Adriana',   area: 'Estética',       ordem: 11, eventColor: 'gold' },
        // { id: 12, title: 'Cida',      area: 'Massagem',       ordem: 12, eventColor: 'brown' },
        // { id: 13, title: 'Sabrina',   area: 'Cabeleireira',   ordem: 13, eventColor: 'pink' },
        // { id: 14, title: 'Sheila',    area: 'Cabeleireira',   ordem: 14, eventColor: 'coral' },
        ],
        events: routeEvents('routeLoadEvents'),
        drop: function(element)
        {
          alert('drop function')
        },
        eventDrop: function(element)
        {
          let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
          let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');

          let newEvent = {
            _method:  'PUT',
            id              : element.event.id,
            obs             : element.event.title,
            start           : start,
            end             : end,
            id_profexec : element.event._def.resourceIds[0],
          };

          sendEvent(routeEvents('routeEventUpdate'), newEvent);
        },
        eventResize: function(element)
        {
          let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
          let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');

          let newEvent = {
            _method:  'PUT',
            id              : element.event.id,
            obs             : element.event.title,
            start           : start,
            end             : end,
            id_profexec : element.event._def.resourceIds[0],
          };

          sendEvent(routeEvents('routeEventUpdate'), newEvent);
        },
        select: function(arg)
        {
          escolhiProfissional( arg.resource._resource.id )
          $('#id_profexec').attr('disabled', false);
          $('#id_profexec').val(arg.resource._resource.id);
          $('#id_servprod').val();

          $('#modal_agendamento_create #start').val(moment(arg.start).format('YYYY-MM-DDTHH:mm'));
          $('#modal_agendamento_create #end').val(moment(arg.end).format('YYYY-MM-DDTHH:mm'));
          $('#modal_agendamento_create').modal();
        },
        eventClick: function(arg)
        {
          console.log(arg)

        // $('#modal_agendamento_create #start').val(moment(arg.start).format('YYYY-MM-DDTHH:mm'));
        // $('#modal_agendamento_create #end').val(moment(arg.end).format('YYYY-MM-DDTHH:mm'));
        // $('#id_profexec').val(arg.resource._resource.id);
        // $('#modal_agendamento_create').modal();

        // console.log(start)
        // console.log(end)
        // console.log(
        //  'select',
        //  arg.startStr,
        //  arg.endStr,
        //  arg.resource ? arg.resource.id : '(no resource)'
         // );
      },
      dateClick: function(arg)
      {

        // console.log(('dateClick')
        // $('#id_profexec').val(arg.resource._resource.id);
        // $('#start').val(moment(arg.date).format('YYYY-MM-DDTHH:mm'));
        // $('#start').val(moment(arg.date).format('YYYY-MM-DDTHH:mm'));
        // $('#end').val(moment(arg.date).add(1, 'hours').format('YYYY-MM-DDTHH:mm'));
        // $('#obs').val(moment(arg.date).format('YYYY-MM-DDTHH:mm'));
        // $('#modal_agendamento_create').modal();




        // $('#obs').html(arg.resource.id);


        // alert('1')
        // console.log(
        //  'dateClick',
        //  arg.date,
        //  arg.resource ? arg.resource.id : '(no resource)'
        // );
      },
    });

  // Reinderizar

  objCalendar = calendar;
  calendar.render();
});

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$(function(){

  // $('.date-time').mask('00/00/0000 00:00:00');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});

// $('.saveEvent').click(function(){
//   let id    = $('#modal-calendar #id').val();
//   let start = moment($('#modal-calendar #start').val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
//   let end   = moment($('#modal-calendar #end').val(), 'DD/MM/YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
//   let title = $('#modal-calendar #title').val();
//   let color = $('#modal-calendar #color').val();

//   let Event = {
//     id:       id,
//     start:   start,
//     end:    end,
//     obs:      title,
//     color:    color,
//   }

//   if (id == '') {
//     route = routeEvents('routeEventStore');
//   }else{
//     route = routeEvents('routeEventUpdate');
//     Event.id = id;
//     Event._method = 'PUT';
//   }
//   sendEvent(route, Event)
// });

// $('.deleteEvent').click(function(){
//   let id    = $('#modal-calendar #id').val();

//   let Event = {
//     id:       id,
//     _method:  'DELETE',
//   }

//   route = routeEvents('routeEventDestroy');

//   sendEvent(route, Event)
// });

function sendEvent(route, data_)
{
  $.ajax({
    url:      route,
    data:     data_,
    method:   'POST',
    dataType: 'json',
    success: function(json)
    {
      console.log(json)
      if(json){
        // objCalendar.refetchEvents();
        $('#modal-calendar').modal('hide');
        // location.reload();
      }
    },
    error: function(json)
    {
      console.log(json)
      let responseJSON = json.responseJSON.errors;

      $('#message').html(loadErros(responseJSON));
    }
  })
}

function loadErros(response)
{
  console.log(response)
  let boxAlert = `<div class="alert alert-danger">`;

  for(let fields in response)
  {
    boxAlert += `<span>${response[fields]}</span></br>`;
  }

  boxAlert += `</div>`;

  return boxAlert.replace(/\,/g, '</br>');
}

function routeEvents(route){
  // console.log(document.getElementById('calendar').dataset[route])
  // $('#calendar').dataset[route];
  return document.getElementById('calendar').dataset[route];
}

// function clearMessage(element)
// {
//   $(element).text('');
// }

// function resetForm(form)
// {
//   $(form)[0].reset();
// }

</script>
@stop
