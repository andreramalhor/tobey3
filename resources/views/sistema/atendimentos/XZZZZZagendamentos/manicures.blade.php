<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('assets/fullcalendar-scheduler/lib/main.css') }}" rel='stylesheet' />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="{{ asset('assets/fullcalendar-scheduler/css/style.css') }}" rel='stylesheet' />

</head>
<body>
  @include('sistema.atendimentos.agendas.modal-calendar')
  <div id='calendar-wrap'>
    <div
    id='calendar'
    data-route-load-events='{{ route('agenda.manicureRouteLoadEvents') }}'
    data-route-event-store='{{ route('agenda.manicureRouteEventStore') }}'
    data-route-event-update='{{ route('agenda.manicureRouteEventUpdate') }}'
    data-route-event-destroy='{{ route('agenda.manicureRouteEventDestroy') }}'
    ></div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src='{{ asset('assets/fullcalendar-scheduler/lib/main.js') }}'></script>
  <script src='{{ asset('assets/fullcalendar-scheduler/lib/locales-all.js') }}'></script>

  <script type="text/javascript"> let objCalendar; </script>

  <script src='{{ asset('assets/fullcalendar-scheduler/js/script.js') }}'></script>
  <script src='{{ asset('assets/fullcalendar-scheduler/js/calendar.js') }}'></script>
</body>
</html>
