@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agendas</h3>

        <div class="card-tools">
          <div class="btn-group">
            @if(is_null(\Auth::User()->wuclsoqsdppaxmf) || is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Gerente Administrativo'))
              <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_profissionais_mostrar"><i class="fas fa-check"></i></a>
              <a class="btn btn-sm btn-default" href="{{ route('atd.agendamentos.planilhar') }}"><i class="fa-solid fa-sheet-plastic"></i></a>
            @endif
            <a class="btn btn-sm btn-default" data-bs-toggle="dropdown">
              <i class="fas fa-calendar"></i>
            </a>
            <div class="dropdown-menu" role="menu">
              <div id="data_x"></div>
            </div>
            <a class="btn btn-sm btn-default" onclick="agendamentos_recarregar()"><i class="fas fa-arrow-rotate-right"></i></a>
          </div>
        </div>
      </div>

            
        {{-- <div class="pagination pagination-sm float-right" style="margin: 5px 7px;"></div> --}}

        {{-- <div class="card-tools">
          <div class="pagination pagination-sm float-right" style="margin: 5px 7px;"></div>
        </div> --}}

      <div
        id='calendar'
        data-carregar="{{ route('atd.agendamentos.carregar') }}"
        data-gravar="{{ route('atd.agendamentos.gravar') }}"
        data-atualizar="{{ route('atd.agendamentos.atualizar', ':id') }}"
        {{--
          data-route-event-update="{{ route('agenda.routeEventUpdate') }}"
          data-route-event-destroy="{{ route('agenda.routeEventDestroy') }}"
        --}}
      ></div>
    </div>
  </div>
</div>
@include('sistema.atendimentos.agendamentos.auxiliares.mod_profissionais_mostrar')  {{-- Modal para definir quais são os profissionais que irão aparecer na agenda e a ordem deles  --}}
@endsection

@section('js')
<script type="text/javascript"> let objCalendar; </script>
<script>
//
$('#data_x').datepicker({
    language: 'pt-BR', // define o idioma do datapicker
    format: 'dd/mm/yyyy', // define o formato da data
    autoclose: true // fecha automaticamente o datapicker ao selecionar uma data
  }).on('changeDate', function (ev)
{
  objCalendar.gotoDate(new Date(ev.date))
});

var resources = [
  { id: 'r1', title: 'Recurso 1' },
  { id: 'r2', title: 'Recurso 2' },
  { id: 'r3', title: 'Recurso 3' }
];

var events = [
    { id: 'e1', title: 'Evento 1', start: '2023-04-15T10:00:00', end: '2023-04-15T12:00:00', resourceId: 'r1' },
    { id: 'e2', title: 'Evento 2', start: '2023-04-15T14:00:00', end: '2023-04-15T16:00:00', resourceId: 'r2' },
    { id: 'e3', title: 'Evento 3', start: '2023-04-15T09:00:00', end: '2023-04-15T11:00:00', resourceId: 'r1' }

];

var calendarEl = document.getElementById('calendar')

var calendar = new FullCalendar.Calendar(calendarEl,
{
  schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
  locale: 'pt-br',
  nowIndicator: true,
  
  height: 'auto', 
  dayMaxEventRows: true,    
  dayMaxEvents: true,    
  eventMaxStack: 4,
  dayHeaders:true,
  
  initialView: 'resourceTimeGridDay',
  // slotDuration: '01:00:00',
  slotMinTime: '07:00:00',
  slotMaxTime: '21:00:00',
  businessHours:
  {
    daysOfWeek: [ 2, 3, 4, 5, 6 ],
    startTime: '08:00',
    endTime: '20:00',
  },
  editable: true,
  selectable: true,
  selectMirror: true,
  dayMaxEvents: false, // allow "more" link when too many events
  headerToolbar: {
    // left: 'promptResource today prev,next',
    left: 'today prev,next',
    center: 'title',
    right: 'resourceTimeGridDay,resourceTimelineDay'
  },
  buttonText: {
    resourceTimeGridDay: 'Verical',
    resourceTimelineDay: 'Horizontal',
  },

  // customButtons: {
    //   promptResource: {
      //     text: '+ rooasm',
      //     click: function() {
        //       var title = prompt('Room name');
        //       if (title) {
          //         calendar.addResource({
            //           title: 'Eulênia',
            //           id: 3
            //         });
            //       }
            //     }
            //   }
            // },
            // headerToolbar:
            // {
              //   left: 'today',
              //   center: 'title',
              //   right: 'prev,next',
              // },
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
  allDaySlot: false,
  
  resourceOrder: 'area,ordem',
  
  resources: function(fetchInfo, successCallback, failureCallback)
  {
    retornar_resources()
    .then((returnEvents) => {
      // console.log(returnEvents);
      successCallback(returnEvents);
    })
    @include('includes.catch', [ 'codigo_erro' => '6161302a' ] )
  },
  
  resourceLabelContent: (info) =>
  {
    // console.log(info)
    var html = '<img src="'+info.resource.extendedProps.imageSrc+'" class="user-image img-circle" width="35px" alt="'+info.resource.title+'" data-bs-tooltip="tooltip" data-bs-title="'+info.resource.title+'"/></br>'+info.resource.extendedProps.primeiroNome;
    
    agendamentos_tooltips()

    return { html: html }
  },

  events: events_rotas('carregar'),
  
  @can('Agendas.Editar')
  eventDrop: function(element)
  {
    if(confirm("Confirmar modificação do agendamento?"))
    {
      let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
      let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');
      
      let novoEvento = {
        _method:  'PUT',
        id              : element.event.id,
        title           : element.event.title,
        obs             : element.event.obs,
        start           : start,
        end             : end,
        id_profexec     : element.event._def.resourceIds[0],
      };
      
      delete element.id;
      
      processarEvento(events_rotas('atualizar'), novoEvento);
    }
    else
    {
      element.revert();
      toastrjs('error', 'Agendamento não modificado');
    }
  },
  @endcan
  
  @can('Agendas.Editar')
  eventResize: function(element)
  {
    if(confirm("Confirmar modificação do agendamento?"))
    {
      let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
      let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');
      
      let novoEvento = {
        _method:  'PUT',
        id              : element.event.id,
        title           : element.event.title,
        obs             : element.event.obs,
        start           : start,
        end             : end,
        id_profexec     : element.event._def.resourceIds[0],
      };
      
      delete element.id;
      
      processarEvento(events_rotas('atualizar'), novoEvento);
    }
    else
    {
      element.revert();
      toastrjs('error', 'Agendamento não modificado');
    }        
  },
  @endcan
  
  @can('Agendas.Criar')
  select: function(arg)
  {
    agendamentos_criar(arg) 
  },
  @endcan
  
  @can('Agendas.Visualizar')
  eventClick: function(arg)
  {
    agendamentos_mostrar(arg)
  },
  @endcan
  

//   resourceLabelContent: function(resourceObj)
//   {
//     var containerElement = document.createElement('div');
//     containerElement.innerHTML = '<img src="https://cdn4.buysellads.net/uu/1/134955/1685040254-deisgndotdev3.jpg" alt="Imagem" />12s';
//     return containerElement;
  
    
//     // console.log(resourceObj)
//     // return '<img src="https://cdn4.buysellads.net/uu/1/134955/1685040254-deisgndotdev3.jpg" alt="Imagem" />aaaa';

//     // if(resourceObj.roomtype != 'Manage' )
//     // {
//     //     var roomid = resourceObj.id;
//     //     var roomno = resourceObj.roomno;
//     //     var msg = 'Peform some action on '+roomno+' ?';
//     //     if(resourceObj.roomstatus == 'C')
//     // {
//     //         labelTds.last().empty();
//     //         labelTds.last().append(
//     //             '<div style="text-align:center">' +
//     //             '<img src="../../images/image1.png" width="20" height="20" onclick="confirm(\''+msg+'\');">' +
//     //             '</div>'
//     //         );
//     //     };
//     //     if(resourceObj.roomstatus == 'L')
//     // {
//     //         labelTds.last().empty();
//     //         labelTds.last().append(
//     //             '<div style="text-align:center">' +
//     //             '<img src="../../images/image2.png" width="20" height="20">' +
//     //             '</div>'
//     //         );
//     //     };
//     // };
//   }
});

// Reinderizar
objCalendar = calendar;
calendar.render();


async function retornar_resources()
{
  salas_parceiras = [];

  let response = await fetch("{{ route('atd.pessoas.agenda_ordem') }}")
  let data     = await response.json();
  
  collect(data).each((value, key) =>
  {
    salas_parceiras.push(
    {
      'id': value.oewoekdwjzsdlkd.id,
      'title': value.oewoekdwjzsdlkd.apelido,
      'imageSrc': value.oewoekdwjzsdlkd.foto_perfil,
      'ordem': value.ordem,
      'area': value.area,
      'primeiroNome': value.oewoekdwjzsdlkd.apelido.split(' ')[0]
    })
  })
  
  return salas_parceiras;
}''

function processarEvento(rota, evento)
{
  url = rota.replace(':id', evento.id );

  axios.post(url, evento)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);

    objCalendar.refetchEvents();
  })
  @include('includes.catch', [ 'codigo_erro' => '4905394a' ] )
}

// FUNCOES ===========================================================================================================================
function events_rotas(route)
{
  return $('#calendar').data(route);
}

function agendamentos_criar(informacoes)
{
  var url = "{{ route('atd.agendamentos.criar') }}"

  axios.post(url, informacoes)
  .then(function(response)
  {
    // console.log(response.data)
    $('#modal-geral-'+id_mdl).empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '6717184a' ] )
  .then( function()
  {
    $('#modal-geral-'+id_mdl).modal('show')
  })
}

function agendamentos_mostrar(informacoes)
{
  var url = "{{ route('atd.agendamentos.mostrar', ':id') }}"
  var url = url.replace(':id', informacoes.event._def.publicId )

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#modal-geral-'+id_mdl).empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '2814604a' ] )
  .then( function()
  {
    $('#modal-geral-'+id_mdl).modal('show');
  })
}

function agendamentos_recarregar()
{
  objCalendar.refetchEvents()
  objCalendar.refetchResources();
}

function agendamentos_tooltips()
{
  setTimeout(() => {
    var tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]');
    var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  }, 500);
}

</script>
@stop
