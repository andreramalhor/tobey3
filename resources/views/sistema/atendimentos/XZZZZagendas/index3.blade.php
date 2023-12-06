<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href='{{ asset('assets/fullcalendar/lib/main.css') }}' rel='stylesheet' />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href='{{ asset('assets/fullcalendar/css/style.css') }}' rel='stylesheet' />

</head>
<body>
  @include('sistema.atendimentos.agendas.modal-calendar')
  <div id='wrap'>

    <div id='external-events'>
      <h4>Draggable Events</h4>

      <div id='external-events-list'>
        <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event' data-event='{"id": "99", "obs": "Teste Drag", "color": "#c402d3", "inicio": "12:00:00", "final": "12:30:00"}'>
          <div class='fc-event-main'>My Event 1</div>
        </div>
      </div>

      <p>
        <input type='checkbox' id='drop-remove' />
        <label for='drop-remove'>remove after drop</label>
      </p>
    </div>

    <div id='calendar-wrap'>
      <div
      id='calendar'
      data-route-load-events='{{ route('agenda.routeLoadEvents') }}'
      data-route-event-store='{{ route('agenda.routeEventStore') }}'
      data-route-event-update='{{ route('agenda.routeEventUpdate') }}'
      data-route-event-destroy='{{ route('agenda.routeEventDestroy') }}'
      ></div>
    </div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src='{{ asset('assets/fullcalendar/lib/main.js') }}'></script>
  <script src='{{ asset('assets/fullcalendar/lib/locales-all.js') }}'></script>

  <script type="text/javascript"> let objCalendar; </script>

  <script src='{{ asset('assets/fullcalendar/js/script.js') }}'></script>
  <script src='{{ asset('assets/fullcalendar/js/calendar.js') }}'></script>
</body>
</html>
