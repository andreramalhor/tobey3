@extends('layouts.app')

@section('content')
<div class="row" style="display: none;">
  <div id="evento-externo-unico">              
    <div id="evento-personalizado" style="cursor: move; display:inline-flex;" data-event="{'id': '99', 'id_servprod':'34', 'duration': '01:00:00', 'valor': '18.00'}" class="btn btn-default btn-sm">Manicure</div>
  </div>
  <div id="external-events">
    <div id="evento-externo-listagem">
      <div id="fc-event" style="cursor: move; display:inline-flex;" data-event="{'id': '99', 'id_servprod':'34', 'duration': '01:00:00', 'valor': '18.00'}"><a style="margin: auto 5px" class="btn btn-default btn-sm">Manicure</a>               </div>
      <div id="fc-event" style="cursor: move; display:inline-flex;" data-event="{'id': '99', 'id_servprod':'35', 'duration': '01:00:00', 'valor': '18.00'}"><a style="margin: auto 5px" class="btn btn-default btn-sm">Pedicure</a>               </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agendas</h3>
      
        <div class="card-tools">
          <div class="btn-group">
            @if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_profissionais_mostrar"><i class="fas fa-check"></i></a>
            <a class="btn btn-sm btn-default" href="{{ route('atd.agendamentos.planilhar') }}"><i class="fa-solid fa-sheet-plastic"></i></a>
            @endif
            <a class="btn btn-sm btn-default" onclick="agendamentos_recarregar()"><i class="fas fa-arrow-rotate-right"></i></a>
          </div>
        </div>

        <div class="pagination pagination-sm float-right" style="margin: 5px 7px;"></div>

        <div class="card-tools">
          <div class="form-group mb-0">
            <div class="input-group">
              <div class="input-group-prepend">
                <a href="#" class="btn btn-sm btn-default" onclick="ajustar_datas( 'menos' )">
                  <i class="fas fa-chevron-left"></i>
                </a>
              </div>
              <input type="text" class="form-control form-control-sm text-center" id="datepicker" value="{{ \Carbon\Carbon::today()->format('d/m/Y') }}" onchange="ajustar_datas()">
              <div class="input-group-append">
                <a href="#" class="btn btn-sm btn-default" onclick="ajustar_datas( 'mais' )">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>
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
$(function ()
{
  $('#datepicker').datepicker({
    format: "dd/mm/yyyy",
    todayBtn: "linked",
    language: "pt-BR",
    orientation: "bottom auto",
    autoclose: true,
    forceParse: false,
    todayHighlight: true,
  });
});

document.addEventListener('DOMContentLoaded', function()
{
  /* initialize the external events
  -----------------------------------------------------------------*/
  // var containerEl = $('#evento-externo-listagem').get(0);
  // new FullCalendar.Draggable(containerEl,
  // {
  //   itemSelector: '#fc-event',
  //   eventData: function(eventEl)
  //   {
  //     return
  //     {
  //       title: eventEl.innerText.trim()
  //     }
  //   }
  // });
  
  // var containerEm = $('#evento-externo-unico').get(0);
  // new FullCalendar.Draggable(containerEm,
  // {
  //   itemSelector: '#evento-personalizado',
  //   eventData: function(eventEl)
  //   {
  //     return {
  //       title: eventEl.innerText.trim()
  //     }
  //   }
  // });
  
  
  /* initialize the calendar
  -----------------------------------------------------------------*/
  var calendarEl = $('#calendar').get(0);
  var calendar = new FullCalendar.Calendar(calendarEl, {
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

    resourceRender: function(info)
    {
      // console.log(info)
      info.el.style.backgroundColor = 'red'
    },
    events: events_rotas('carregar'),
    datepicker: '#datepicker',

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

    @can('Agendas.Ver')
    eventClick: function(arg)
    {
      agendamentos_mostrar(arg)
    },
    @endcan
  });
  
  // Reinderizar
  objCalendar = calendar;
  calendar.render();
});

async function retornar_resources()
{
  salas_parceiras = [];

  let response = await fetch("{{ route('atd.pessoas.agenda_ordem') }}")
  let data     = await response.json();
  
  collect(data).each((value, key) =>
  {
    salas_parceiras.push({ 'id': value.oewoekdwjzsdlkd.id, 'title': value.oewoekdwjzsdlkd.apelido, 'ordem': value.ordem, 'area': value.area })
  })
  
  return salas_parceiras;
}

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
    $('#modal-geral-'+id_mdl).modal('show')
  })
}

function agendamentos_recarregar()
{
  objCalendar.refetchEvents()
  objCalendar.refetchResources();
}

function ajustar_datas( alualiza = 0 )
{
  $('#overlay_recbimentos_cartoes').show()

  datepicker = moment( $('#datepicker').val(), "DD/MM/YYYY" );
 
  if( alualiza == 'menos' )
  {
    $('#datepicker').val( datepicker.subtract(1, 'days').format('DD/MM/YYYY') )
  }
  else if( alualiza == 'mais' )
  {
    $('#datepicker').val( datepicker.add(1, 'days').format('DD/MM/YYYY') )
  }

  // atualizarCartoes()
}
</script>
@stop
