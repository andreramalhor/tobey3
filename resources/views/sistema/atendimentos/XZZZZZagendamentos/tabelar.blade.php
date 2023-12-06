<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">{{ $parceiro->id ?? \Auth::User()->id }} - {{ $parceiro->apelido ?? \Auth::User()->apelido }}</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <div id="calendar_{{ $parceiro->id ?? \Auth::User()->id }}"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-geral" data-bs-backdrop="static" data-bs-keyboard="false">

</div>

@push('js')
<script>
  var calendarEl = document.getElementById('calendar_{{ $parceiro->id ?? \Auth::User()->id }}');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'pt-br',
    // timeZone: 'UTC',
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
    headerToolbar: false,
    themeSystem: 'bootstrap5',
    height: 'auto',    
    initialView: 'timeGridDay',
    allDaySlot: false,
    slotEventOverlap: false,     // amotoa multiplos eventos no mesmo horário
    eventMaxStack: 1,
    initialDate: $('#dt_agenda').val(), 
    slotDuration: '01:00:00',
    slotMinTime: '08:00:00',
    slotMaxTime: '20:00:00',
    nowIndicator: true,
    businessHours:
    [
      {
        daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],   // tirar o 1 (segunda)
        startTime: '10:00', 
        endTime: '12:00',
      },
      {
        daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],   // tirar o 1 (segunda)
        startTime: '13:00',                 // inicio horario de almoco
        endTime: '19:00',                   // fim horario de almoco
      },
    ],
    dayHeaders:true,
    slotLabelFormat:
    {
      hour: '2-digit',
      // minute: '2-digit',
      hour12: false,
      omitZeroMinute: true,
      meridiem: 'short'
    },
    events: eventos_data( $('#dt_agenda').val() , {{ $parceiro->id ?? \Auth::User()->id }}),
    // eventSources:
    // [
    //   {
    //     events: eventos_data( $('#dt_agenda').val() ),
    //     color: 'yellow',   // an option!
    //     textColor: 'black' // an option!
    //   }
    // ],
    dateClick: function(info)
    {
      console.log(info)
      agendas_adicionar({{ $parceiro->id ?? \Auth::User()->id }})
      // alert('selected ' + info.startStr + ' to ' + info.endStr);

      // alert('dia click')
      // console.log('Clicked on: ' + info.dateStr);
      // console.log('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
      // console.log('Current view: ' + info.view.type);
      // change the day's background color just for fun
      // info.dayEl.style.backgroundColor = 'red';
      // info.dayEl.style.backgroundColor = 'red';
      // info.jsEvent.target.bgColor = 'red'
    },
    eventClick: function(info)
    {
      console.log(info)
      

    //   // alert('evento click')
    //   // alert('Event: ' + info.event.title);
    //   // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    //   // alert('View: ' + info.view.type);

    //   // change the border color just for fun
    //   info.el.style.bgColor = 'blue';
    }
  });
  calendar.render();

  function eventos_data( dt_agenda , id_parceiro)
  {
    var url       = "{{ route('atd.agendamentos.tabelar2') }}";
    var params   = url+'?dt_agenda='+dt_agenda+'&id_parceiro='+id_parceiro;

    return params;
  }

  function agendas_adicionar(id_parceiro)
  {
    axios.get("{{ route('atd.agendamentos.adicionar') }}?id_parceiro="+id_parceiro)
    .then(function(response)
    {
      // console.log(response)
      $('#modal-geral-1').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '9635211a' ] )
    .then(function()
    {
      $('#modal-geral-1').modal('show')
      setTimeout(function()
      {
        $('#overlay_create').hide();
      }, 1000);
      // lancamentos_tabelar_nao_confirmados()
      // lancamentos_tabelar_confirmados()
    })
  }
</script>
@endpush
