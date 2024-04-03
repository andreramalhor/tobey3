


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-header">
                <h3 class="card-title">Agendamentos</h3>
                <div class="card-tools">
                    @dd('controller', $resources, $events)
                    <div class="btn-group">
                        @if(is_null(\Auth::User()->wuclsoqsdppaxmf) || is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Gerente Administrativo'))
                        <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_profissionais_mostrar"><i class="fas fa-check"></i></a>
                        <a class="btn btn-sm btn-default" href="{{ route('atd.Xagendamentos.planilhar') }}"><i class="fa-solid fa-sheet-plastic"></i></a>
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
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right" placeholder="Pesquisar" wire:model.live="pesquisar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="criar"><i class="fa fa-plus"></i> Novo serviço</a>
                    </div>
                </div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    @include('livewire.atendimento.agendamento.criar')
    @include('livewire.atendimento.agendamento.editar')
    @include('livewire.atendimento.agendamento.mostrar')
</div>


@section('js')
<script>
    window.addEventListener('livewire:init', event =>{
        console.log(event)
        // $('#start').val('hide');
        // $('#duracao').val('hide');
        // $('#end').val('hide');
        // $('#valor').val('hide');
        $('#obs').val('hide');

    });
	
	window.addEventListener('show-edit-student-modal', event =>{
		$('#editStudentModal').modal('show');
	});
	
	window.addEventListener('show-delete-confirmation-modal', event =>{
		$('#deleteStudentModal').modal('show');
	});
	
	window.addEventListener('show-view-student-modal', event =>{
		$('#viewStudentModal').modal('show');
	});
</script>

<script type="text/javascript"> let objCalendar; </script>
<script>
//
document.addEventListener('livewire:init', function () 
{
	alert(5255)
});

$('#data_x').datepicker({
    language: 'pt-BR', // define o idioma do datapicker
    format: 'dd/mm/yyyy', // define o formato da data
    autoclose: true // fecha automaticamente o datapicker ao selecionar uma data
}).on('changeDate', function (ev)
{
    objCalendar.gotoDate(new Date(ev.date))
});

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
    buttonText:
    {
        resourceTimeGridDay: 'Verical',
        resourceTimelineDay: 'Horizontal',
    },
    
  
    // customButtons: {
    //     promptResource: {
    //         text: '+ rooasm',
    //         click: function() {
    //             var title = prompt('Room name');
    //             if (title) {
    //                 calendar.addResource({
    //                     title: 'Eulênia',
    //                     id: 3
    //                 });
    //             }
    //         }
    //     }
    // },
    // headerToolbar:
    // {
    //     left: 'today',
    //     center: 'title',
    //     right: 'prev,next',
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
    // events: events,
    resources: @json($resources), // Inclui a lista de recursos no formato JSON
    events: @json($events), // Inclui a lista de eventos no formato JSON

    resourceLabelContent: (info) =>
    {
        // console.log(info)
        var html = '<img src="'+info.resource.extendedProps.src_foto+'" class="user-image img-circle" width="35px" alt="'+info.resource.title+'" data-bs-tooltip="tooltip" data-bs-title="'+info.resource.title+'"/></br>'+info.resource.title;
        
        agendamentos_tooltips()
        
        return { html: html }
    },
    
    // events: events_rotas('carregar'),
    
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
        return {!! $events !!};
    }
    
    function agendamentos_criar(informacoes)
    {
        alert(121821);
        Livewire.dispatch('criar', { informacoes : informacoes })
        // Livewire.dispatch('criar', { informacoes : informacoes }).to('agendamento.criar');
    }

    
    function agendamentos_mostrar(informacoes)
    {
        var url = "{{ route('atd.Xagendamentos.mostrar', ':id') }}"
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

{{--
    CRUD
    
    create    criar
    read      mostrar
    update    atualizar
    delete    deletar
    
    
    # create (criar)
    store (armazenar ou salvar)
    # edit (editar)
    update (atualizar)
    # show (mostrar ou exibir)
    destroy (destruir, remover ou deletar)
--}}
