@extends('layouts.app')

@section('content')
<div class="row 
  @if(is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
    d-none
  @else
    d-none
  @endif
  ">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="input-group">
              <label class="col-form-label">Cliente</label>
              <select class="form-control form-control-sm select2" id="fast_id_pessoa" onchange="verificaCliente()">
                <option>Selecione . . .</option>
                @foreach($clientes as $cliente)
                <option data-apelido="{{ $cliente->apelido }}" value="{{ $cliente->id }}">{{ $cliente->nomes }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-4">
            <div class="input-group">
              <label class="col-form-label">Serviço</label>
              <select class="form-control form-control-sm select2" id="fast_id_servprod" onchange="fastServico(this)">
                <option>Selecione . . .</option>
                @foreach($servicos as $servico)
                  <option data-duracao="{{ $servico->duracao }}" data-valor="{{ $servico->vlr_venda }}" value="{{ $servico->id }}">{{ $servico->nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div id='evento-externo-unico' style="display: none;">              
              <div id="evento-personalizado" style="cursor: move; display:inline-flex;" data-event="{'id': '99', 'id_servprod':'34', 'duration': '01:00:00', 'valor': '18.00'}" class="btn btn-default btn-sm">Manicure</div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div id='external-events'>
            <div id='evento-externo-listagem' style="display: none;">
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"34", "duration": "01:00:00", "valor": "18.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Manicure</a>               </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"35", "duration": "01:00:00", "valor": "18.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Pedicure</a>               </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"36", "duration": "02:00:00", "valor": "35.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Mãos e Pés</a>             </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"54", "duration": "01:00:00", "valor": "25.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Dsgn Sobranc.</a>          </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"55", "duration": "01:00:00", "valor": "35.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Dsgn Sobranc. c/ Henna</a> </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"6",  "duration": "01:00:00", "valor": "50.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Corte</a>                  </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"1",  "duration": "01:00:00", "valor": "25.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Escova P</a>               </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"2",  "duration": "01:00:00", "valor": "30.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Escova M</a>               </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"3",  "duration": "01:00:00", "valor": "35.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Escova M+</a>              </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"4",  "duration": "01:00:00", "valor": "40.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Escova G</a>               </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"29", "duration": "01:00:00", "valor": "50.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Tratamento Promoção</a>    </div>
              <div id='fc-event' style="cursor: move; display:inline-flex;" data-event='{"id": "99", "id_servprod":"11", "duration": "01:30:00", "valor": "80.00"}'><a style="margin: auto 5px" class="btn btn-default btn-sm">Coloração</a>              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- include('sistema.atendimentos.pessoas.modal.create') -->

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agenda</h3>

        <div class="card-tools">
          <div class="pagination pagination-sm float-right" style="margin: 5px 7px;"></div>

          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_profissionais_mostrar"><i class="fas fa-check"></i></a>
            <!-- <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_agendamento_create"><i class="fas fa-plus"></i></a> -->
            <a class="btn btn-sm btn-default" href="{{ route('atd.agendamentos.planilhar') }}"><i class="fa-solid fa-sheet-plastic"></i></a>
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_agenda_configuracao" onclick="agendamentos_recarregar()"><i class="fas fa-arrow-rotate-right"></i></a>
            <!-- <a class="btn btn-sm btn-default" onclick="objCalendar.render()"><i class="fas fas fa-undo-alt"></i></a> -->

            {{-- <a class="btn btn-sm btn-default" >Right</a> --}}
          </div>
          <!-- include('sistema.atendimentos.agendamentos.modal.create') -->
          <!-- include('sistema.atendimentos.agendamentos.modal.show') -->
          <!-- include('sistema.atendimentos.agendamentos.modal.sobreOCliente') -->
          <!-- include('sistema.atendimentos.agendamentos.modal.mod_agenda_config') -->
        </div>
      </div>
      <div
      id='calendar'
      data-carregar="{{ route('atd.agendamentos.carregar') }}"
      data-gravar="{{ route('atd.agendamentos.gravar') }}"
      data-atualizar="{{ route('atd.agendamentos.atualizar', ':id') }}"
      {{--
        --}}
        {{--
          {{-- data-route-event-update="{{ route('agenda.routeEventUpdate') }}' --}"
        data-route-event-destroy="{{ route('agenda.routeEventDestroy') }}"
        --}}
      ></div>
      {{-- @dd($agendamentos) --}}
    </div>
  </div>
</div>
@include('sistema.atendimentos.agendamentos.auxiliares.mod_profissionais_mostrar')
@include('includes.modal.modal-geral-1')
@endsection

@section('js')
<script type="text/javascript"> let objCalendar; </script>
<script>
// 
finalizadao = {};  // dd
document.addEventListener('DOMContentLoaded', function() {
  /* initialize the external events
  -----------------------------------------------------------------*/
  var containerEl = $('#evento-externo-listagem').get(0);
  new FullCalendar.Draggable(containerEl,
  {
    itemSelector: '#fc-event',
    eventData: function(eventEl) {
      return {
        title: eventEl.innerText.trim()
      }
    }
  });
  
  var containerEm = $('#evento-externo-unico').get(0);
  new FullCalendar.Draggable(containerEm,
  {
    itemSelector: '#evento-personalizado',
    eventData: function(eventEl) {
      return {
        title: eventEl.innerText.trim()
      }
    }
  });
  
  
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
      left: 'promptResource today prev,next',
      center: 'title',
      right: 'resourceTimelineDay,resourceTimelineWeek'
    },
    customButtons: {
      promptResource: {
        text: '+ room',
        click: function() {
          var title = prompt('Room name');
          if (title) {
            calendar.addResource({
              title: title
            });
          }
        }
      }
    },
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
    resources:
    [
      @foreach($profissionais as $key => $profissional )
      { id: '{{ $profissional->id }}', title: '{{ $profissional->apelido }}', color: 'red', backgroundColor: 'blue', area: 'Cabeleireira', ordem: {{ $key }} },
      @endforeach
    ],
    resourceRender: function(info)
    {
      console.log(info)
      info.el.style.backgroundColor = 'red'
    },
    events: events_rotas('carregar'),

    @can('Agendas.Editar')
    drop: function(element)
    {
      alert('drop')
      let evento = JSON.parse(element.draggedEl.dataset.event);
      
      let duracao = (evento.duration).split(':');
      let horas = duracao[0];
      let minutos = duracao[1];
      let segundos = duracao[2];
      
      let start = moment(`${element.dateStr}`).format('YYYY-MM-DD HH:mm:ss');
      let end   = moment(`${element.dateStr}`).add(horas, 'hours').add(minutos, 'minutes').add(segundos, 'seconds').format('YYYY-MM-DD HH:mm:ss')
      
      
      finalizadao.start            = start;
      finalizadao.end              = end;
      finalizadao.id_cliente       = $('#fast_id_pessoa').val();
      finalizadao.id_profexec      = element.resource._resource.id;
      finalizadao.id_servprod      = evento.id_servprod;
      finalizadao.valor            = evento.valor;
      finalizadao.id_criador       = '{{ Auth::User()->id }}';
      finalizadao.obs              = evento.title;
      finalizadao.color            = evento.color;
      finalizadao.status           = 'Agendado';
      finalizadao.m_start          = start;
      finalizadao.m_end            = end;
      finalizadao.m_duracao        = evento.duration;
      
      delete evento.id;
      
      processarEvento(events_rotas('gravar'), finalizadao);
    },
    @endcan

    @can('Agendas.Editar')
    eventDrop: function(element)
    {
      // toastrjs('warning', 'Confirmar modificação do agendamento?');
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
      // console.log(arg)
      agendamentos_criar(arg) 
      
      
      
      // escolhiProfissional( arg.resource._resource.id )
      // $('#id_profexec').attr('disabled', false);
      // $('#id_profexec').val(arg.resource._resource.id);
      // $('#id_servprod').val();
      
      // $('#modal_agendamento_create #start').val(moment(arg.start).format('YYYY-MM-DDTHH:mm'));
      // $('#modal_agendamento_create #end').val(moment(arg.end).format('YYYY-MM-DDTHH:mm'));
      // $('#modal_agendamento_create').modal();
    },
    @endcan

    @can('Agendas.Ver')
    eventClick: function(arg)
    {
      agendamentos_mostrar(arg)
      $('#MS_titulo_modal').text('Agendamento: # '+arg.event._def.publicId)
      $('#MS_id').val(arg.event._def.publicId)
      $('#MS_id_cliente').val(arg.event._def.extendedProps.xhooqvzhbgojbtg.apelido)
      $('#MS_id_servprod').val(arg.event._def.extendedProps.zlpekczgsltqgwg.nome)
      $('#MS_id_profexec').val(arg.event.extendedProps.id_profexec)
      $('#MS_start').val(moment(arg.event.start).format('YYYY-MM-DDTHH:mm'))
      $('#MS_end').val(moment(arg.event.end).format('YYYY-MM-DDTHH:mm'))
      $('#MS_duracao').val(
        moment({ 
          hour   : moment.duration(moment(arg.event.end).diff(moment(arg.event.start)))._data.hours,  
          minute : moment.duration(moment(arg.event.end).diff(moment(arg.event.start)))._data.minutes, 
        }).format('HH:mm')
      )
      $('#MS_valor').val(arg.event.extendedProps.valor)
      $('#MS_obs').val(arg.event.extendedProps.obs)
      $('#MS_status').text(arg.event.extendedProps.status)
      
      if(arg.event.extendedProps.status == 'Agendado')
      {
        $("#MS_status").attr('class', '');
        $('#MS_status').addClass('badge bg-warning');
      }
      else if(arg.event.extendedProps.status == 'Confirmado')
      {
        $("#MS_status").attr('class', '');
        $('#MS_status').addClass('badge bg-success');
      }
      else if(arg.event.extendedProps.status == 'Finalizado')
      {
        $("#MS_status").attr('class', '');
        $('#MS_status').addClass('badge bg-primary');
      }
      else if(arg.event.extendedProps.status == 'Atrasado')
      {
        $("#MS_status").attr('class', '');
        $('#MS_status').addClass('badge bg-orange'); 
      }
      else if(arg.event.extendedProps.status == 'Faltou')
      {
        $("#MS_status").attr('class', '');            
        $('#MS_status').addClass('badge bg-danger');
      }
      
      $('#modal_agendamento_show').modal('show')
    },
    @endcan
    dateClick: function(arg)
    {
      // alert('dateClick')
      
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
//     route = events_rotas('gravar');
//   }else{
//     route = events_rotas('atualizar');
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

//   route = events_rotas('routeEventDestroy');

//   sendEvent(route, Event)
// });

function processarEvento(rota, evento)
{
  url = rota.replace(':id', evento.id );

  // console.log(evento)
  axios.post(url, evento)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);

    objCalendar.refetchEvents();
  })
@include('includes.catch', [ 'codigo_erro' => '7669200a' ] )
}

// FUNCOES ===========================================================================================================================
function events_rotas(route)
{
  return $('#calendar').data(route);
}

function verificaCliente()
{
  if($('#fast_id_pessoa').val() != "Selecione . . .")
  {
    $('#evento-externo-listagem').show();
    $('#evento-externo-unico').show();
  }
  else
  {
    $('#evento-externo-listagem').hide();
    $('#evento-externo-unico').hide();
  }
}

function fastServico(campo)
{
  var value     = campo.value;
  var texto     = campo.options[campo.selectedIndex].text;
  var duracao   = $('#fast_id_servprod').find(':selected').data('duracao');
  var valor     = $('#fast_id_servprod').find(':selected').data('valor');

  if($('#fast_id_pessoa').val() != "Selecione . . .")
  {
    var apelido      = $('#fast_id_pessoa').find(':selected').data('apelido');
    var dadosServico = '{"id": "99", "id_servprod":"'+value+'", "duration": "'+duracao+'", "valor": "'+valor+'"}'; 
      $('#evento-personalizado').attr("data-event", dadosServico );
      $('#evento-personalizado').text(''+apelido+' ('+texto+')');
  }
  else
  {
    var apelido      = '';
    var dadosServico = '{"id": "99", "id_servprod":"34", "duration": "01:00:00", "valor": "18.00"}'; 
      $('#evento-personalizado').attr("data-event", dadosServico );
      $('#evento-personalizado').text('Manicure');
  }
}

function agendamentos_criar(informacoes)
{
  var url = "{{ route('atd.agendamentos.criar') }}"

  axios.post(url, informacoes)
  .then(function(response)
  {
    // console.log(response.data)
    $('#modal-geral-1').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '5017685a' ] )
  .then( function()
  {
    $('#modal-geral-1').modal('show')
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
    $('#modal-geral-1').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '5448702a' ] )
  .then( function()
  {
    $('#modal-geral-1').modal('show')
  })
}

function agendamentos_recarregar()
{
  objCalendar.refetchEvents()
}

</script>
@stop
