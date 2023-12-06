@extends('layouts.app')

@section('content')
<div class="row">
  @dd($profissionais)
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="btn btn-sm btn-default">
                  <i class="fas fa-fw fa-user"></i>
                </span>
              </div>
              <select class="form-control form-control-sm select2" id="fast_id_pessoa" onchange="verificaCliente()">
                <option>Selecione . . .</option>
                @foreach($clientes as $cliente)
                <option data-apelido="{{ $cliente->apelido }}" value="{{ $cliente->id }}">{{ $cliente->nomes }}</option>
                @endforeach
              </select>
              <div class="input-group-append">
                <span class="btn btn-sm btn-warning">
                  <a data-bs-toggle="modal" data-target="#modal_pessoas_create" id="modal_create"><i class="fas fa-fw fa-user-plus"></i></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="btn btn-sm btn-default">
                  <i class="fas fa-fw fa-concierge-bell"></i>
                </span>
              </div>
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
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agenda</h3>

        <div class="card-tools">
          <div class="pagination pagination-sm float-right" style="margin: 5px 7px;"></div>

          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-target="#modal_agendamento_create"><i class="fas fa-plus"></i></a>
            @include('sistema.atendimentos.agendamentos.modal.create')
            @include('sistema.atendimentos.agendamentos.modal.show')
            @include('sistema.atendimentos.agendamentos.modal.sobreOCliente')

            {{-- <a class="btn btn-sm btn-default" ><i class="fas fa-filter"></i></a> --}}
            {{-- <a class="btn btn-sm btn-default" >Right</a> --}}
          </div>
        </div>
      </div>
      <div
      id='calendar'
      data-carregar="{{ route('atd.agendamentos.carregar') }}"
      data-atualizar="{{ route('atd.agendamentos.atualizar') }}"
      data-route-event-store="{{ route('agenda.routeEventStore') }}"
      {{-- data-route-event-update="{{ route('agenda.routeEventUpdate') }}' --}"
      data-route-event-destroy="{{ route('agenda.routeEventDestroy') }}"
      ></div>
      {{-- @dd($agendamentos) --}}
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript"> let objCalendar; </script>
<script>
  finalizadao = {};
  document.addEventListener('DOMContentLoaded', function() {

  /* initialize the external events
  -----------------------------------------------------------------*/
  
  var containerEl = document.getElementById('evento-externo-listagem');
  // console.log(containerEl)
  new FullCalendar.Draggable(containerEl, {
    itemSelector: '#fc-event',
    eventData: function(eventEl) {
      return {
        title: eventEl.innerText.trim()
      }
    }
  });
  
  var containerEl = document.getElementById('evento-externo-unico');
  // console.log(containerEl)
  new FullCalendar.Draggable(containerEl, {
    itemSelector: '#evento-personalizado',
    eventData: function(eventEl) {
      return {
        title: eventEl.innerText.trim()
      }
    }
  });

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
      // resourceOrder: 'area,ordem',
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
        events: routeEvents('carregar'),
        drop: function(element)
        {
          let Evento = JSON.parse(element.draggedEl.dataset.event);
          
          let duracao = (Evento.duration).split(':');
          let horas = duracao[0];
          let minutos = duracao[1];
          let segundos = duracao[2];

          let start = moment(`${element.dateStr}`).format('YYYY-MM-DD HH:mm:ss');
          let end   = moment(`${element.dateStr}`).add(horas, 'hours').add(minutos, 'minutes').add(segundos, 'seconds').format('YYYY-MM-DD HH:mm:ss')

          
          finalizadao.start            = start;
          finalizadao.end              = end;
          finalizadao.id_cliente       = $('#fast_id_pessoa').val();
          finalizadao.id_profexec  = element.resource._resource.id;
          finalizadao.id_servprod       = Evento.id_servprod;
          finalizadao.valor            = Evento.valor;
          finalizadao.id_criador       = '{{ Auth::User()->id }}';
          finalizadao.obs              = Evento.title;
          finalizadao.color            = Evento.color;
          finalizadao.status           = 'Agendado';
          finalizadao.m_start          = start;
          finalizadao.m_end            = end;
          finalizadao.m_duracao        = Evento.duration;
          
          delete Event.id;

          processarEvento(routeEvents('routeEventStore'), finalizadao);
        },
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
              id_profexec : element.event._def.resourceIds[0],
            };

            processarEvento(routeEvents('atualizar'), novoEvento);
          }
          else
          {
            element.revert();
            toastrjs('error', 'Agendamento não modificado');
          }
        },
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
              id_profexec : element.event._def.resourceIds[0],
            };

            processarEvento(routeEvents('atualizar'), novoEvento);
          }
          else
          {
            element.revert();
            toastrjs('error', 'Agendamento não modificado');
          }        
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
          // console.log(arg)
          $('#modal_agendamento_show').modal('show')
          $('#MS_titulo_modal').text('Agendamento: # '+arg.event.id)
          $('#MS_id').val(arg.event.id)
          $('#MS_id_cliente').val(arg.event.extendedProps.kdfalsjdlk_c_l_i_e_n_t_easjdlaskjdlkasjd.apelido)
          $('#MS_id_servprod').val(arg.event.extendedProps.zlpekczgsltqgwg.nome)
          $('#MS_id_profexec').val(arg.event.extendedProps.id_profexec)
          $('#MS_start').val(moment(arg.event.start).format('YYYY-MM-DDTHH:mm'))
          $('#MS_duracao').val(arg.event.extendedProps.zlpekczgsltqgwg.duracao)
          $('#MS_end').val(moment(arg.event.end).format('YYYY-MM-DDTHH:mm'))
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
//     route = routeEvents('atualizar');
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

function processarEvento(rota, evento)
{
  axios.post(rota, evento)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);

    objCalendar.refetchEvents();
  })
@include('includes.catch', [ 'codigo_erro' => '1932929a' ] )
}

function sendEvent(route, data_)
{
  alert('excluir funcao')
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

// FUNCOES ===========================================================================================================================
function routeEvents(route)
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
