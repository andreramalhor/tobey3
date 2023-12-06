@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agendar em Lote</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-4">
            <div class="form-group">
              <label>Cliente</label>
              <select class='form-control form-control-sm select2' id='id_cliente' onchange="cliente_selecionado(this)">
                <option value=''>Selecione o cliente . . .</option>
                @foreach($clientes as $id => $cliente)
                <option value='{{ $id }}'>{{ $cliente }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_cliente" class="pl-1" style="font-size: smaller;">Selecione o cliente . . .</span>
            </div>
            <div class="form-group">
              <label>Serviço</label>
              <select class='form-control form-control-sm select2' id='id_servprod' onchange="servico_selecionado(this)">
                <option value=''>Selecione o serviço . . .</option>
                @foreach($servicos as $id => $servico)
                <option value='{{ $servico->id }}'>{{ $servico->nome }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_servprod" class="pl-1" style="font-size: smaller;">Selecione o serviço . . .</span>
            </div>
            <div class="form-group">
              <label>Profissional</label>
              <select class='form-control form-control-sm select2' id='id_profexec' onchange="profissional_selecionado(this)">
                <option value=''>Selecione o profissional . . .</option>
                @foreach($parceiros as $id => $profissional)
                <option value='{{ $profissional->id }}'>{{ $profissional->apelido }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_profexec" class="pl-1" style="font-size: smaller;">Selecione o profissional . . .</span>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label>Data Inicial</label>
                  <input type="date" class='form-control form-control-sm' id='agendamento_data_inicial' value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
                <div class="col-6">
                  <label>Data Final</label>
                  <input type="date" class='form-control form-control-sm' id='agendamento_data_final' value="{{ \Carbon\Carbon::now()->endOfYear()->format('Y-m-d') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label>Frequência</label>
                  <select class='form-control form-control-sm' id='frequencia'>
                    <option value='Diário'>Diário</option>
                    <option value='Semanal' selected>Semanal</option>
                    <option value='Quinzenal'>Quinzenal</option>
                    <option value='Mensal'>Mensal</option>
                    <option value='Trimestral'>Trimestral</option>
                    <option value='Anual'>Anual</option>
                  </select>
                </div>
                <div class="col-3">
                  <label>De</label>
                  <input type="time" class='form-control form-control-sm' id='agendamento_inicio' value="{{ \Carbon\Carbon::now()->format('H:00') }}">
                </div>
                <div class="col-3">
                  <label>à</label>
                  <input type="time" class='form-control form-control-sm' id='agendamento_final' value="{{ \Carbon\Carbon::now()->addHours(1)->format('H:00') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <a class="btn btn-block btn-sm btn-default" onclick="agendamentos_resetar()" class="btn btn-primary">Resetar</a>
                </div>
                <div class="col-6">
                  <a class="btn btn-block btn-sm btn-success disabled" id="agendamentos_simular" onclick="agendamentos_simular()" class="btn btn-primary">Simular</a>
                </div>
              </div>
            </div>
          </div>
          <form autocomplete='off' class="col-12 col-md-12 col-lg-8" id='form-agendamentos-criar'>
            <div id='agendamentos_simulador'></div>
          </form>
        </div>
      </div>
      <div class="card-footer clearfix">
        @if(!is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
        <button type="button" class="btn btn-primary float-right" onclick="agendamento_criar()">Agendar</button> &nbsp;
        @endif
        <a href="{{ route('atd.agendamentos') }}" class="btn btn-default">Voltar</a>
      </div>
    </div>
  </div>

  @include('sistema.atendimentos.agendamentos.clientes_fixas')
  
</div>
@endsection

@section('js')
<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  duracao_servprod = null;
  $('.select2').select2({
    dropdownParent: $('#modal-geral-'+id_mdl),
  });

  $('#agendamento_criar_overlay').hide();
})

function agendamentos_simular()
{
  $('#agendamentos_simulador').empty();

  tbl_head =  '<table class="table table-sm table-striped no-padding table-valign-middle projects">'+
              '<thead class="table-dark">'+
                '<tr>'+
                  '<th class="text-nowrap">Data</th>'+
                  '<th class="text-nowrap">Dia</th>'+
                  '<th class="text-nowrap">Início</th>'+
                  '<th class="text-nowrap">Final</th>'+
                  '<th class="text-nowrap">Cliente</th>'+
                  '<th class="text-nowrap">Profissional</th>'+
                  '<th class="text-nowrap">Serviço</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>';

  $('#agendamentos_simulador').append(tbl_head);

  var dt_inicio = moment($('#agendamento_data_inicial').val(), 'YYYY-MM-DD').format('YYYY-MM-DD')
  var dt_final  = moment($('#agendamento_data_final').val(), 'YYYY-MM-DD').format('YYYY-MM-DD')

  var dt_movel = dt_inicio;
  var g_id = new Date().getTime();

  while(moment(dt_movel).isSameOrBefore(dt_final))
  {
    var increment = new Date().getTime();
    switch ($('#frequencia').val())
    {
      case 'Diário':
        tbl_body =  '<tr>'+
                      '<td class="text-nowrap">'+moment(dt_movel).format('DD/MM/YYYY')+'</td>'+
                      '<td class="text-nowrap">'+moment(dt_movel).format('dddd')+'</td>'+
                      '<td class="text-nowrap">'+$('#agendamento_inicio').val()+'</td>'+
                      '<td class="text-nowrap">'+$('#agendamento_final').val()+'</td>'+
                      '<td class="text-nowrap">'+$("#id_cliente").find(':selected').text()+'</td>'+
                      '<td class="text-nowrap">'+$("#id_profexec").find(':selected').text()+'</td>'+
                      '<td class="text-nowrap">'+$("#id_servprod").find(':selected').text()+'</td>'+
                      '<td class="text-nowrap text-center">'+
                        '<a href="'+"aaaaaaaaaaaa"+'" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;'+
                        '<a onClick="vendas_excluir('+"aaaaaaaaaaaa"+')" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>'+
                      '</td>'+
                      '<input type="hidden" name="'+increment+'[start]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_inicio').val()+':00'+'" />'+
                      '<input type="hidden" name="'+increment+'[end]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_final').val()+':00'+'" />'+
                      '<input type="hidden" name="'+increment+'[id_cliente]" value="'+$('#id_cliente').val()+'" />'+
                      '<input type="hidden" name="'+increment+'[id_profexec]" value="'+$('#id_profexec').val()+'" />'+
                      '<input type="hidden" name="'+increment+'[id_servprod]" value="'+$('#id_servprod').val()+'" />'+
                      '<input type="hidden" name="'+increment+'[id_criador]" value="{{ \Auth::User()->id }}" />'+
                      '<input type="hidden" name="'+increment+'[status]" value="Fixa" />'+
                      '<input type="hidden" name="'+increment+'[grupo]" value="'+g_id+'" />'+
                    '</tr>';

        $('#agendamentos_simulador tbody').append(tbl_body);
        break;
    

      case 'Semanal':
        if( moment(dt_movel).format('dddd') == moment(dt_inicio).format('dddd') )
        {
          tbl_body =  '<tr>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('DD/MM/YYYY')+'</td>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('dddd')+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_inicio').val()+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_final').val()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_cliente").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_profexec").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_servprod").find(':selected').text()+'</td>'+
                        '<input type="hidden" name="'+increment+'[start]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_inicio').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[end]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_final').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[id_cliente]" value="'+$('#id_cliente').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_profexec]" value="'+$('#id_profexec').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_servprod]" value="'+$('#id_servprod').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_criador]" value="{{ \Auth::User()->id }}" />'+
                        '<input type="hidden" name="'+increment+'[status]" value="Fixa" />'+
                        '<input type="hidden" name="'+increment+'[grupo]" value="'+g_id+'" />'+
                      '</tr>';
  
          $('#agendamentos_simulador tbody').append(tbl_body);
        }
        break;
    

      case 'Quinzenal':
        if( moment(dt_movel).format('dddd') == moment(dt_inicio).format('dddd') && !(moment(dt_movel).diff(moment(dt_inicio), 'days') % 14) )
        {
          tbl_body =  '<tr>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('DD/MM/YYYY')+'</td>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('dddd')+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_inicio').val()+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_final').val()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_cliente").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_profexec").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_servprod").find(':selected').text()+'</td>'+
                        '<input type="hidden" name="'+increment+'[start]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_inicio').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[end]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_final').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[id_cliente]" value="'+$('#id_cliente').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_profexec]" value="'+$('#id_profexec').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_servprod]" value="'+$('#id_servprod').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_criador]" value="{{ \Auth::User()->id }}" />'+
                        '<input type="hidden" name="'+increment+'[status]" value="Fixa" />'+
                        '<input type="hidden" name="'+increment+'[grupo]" value="'+g_id+'" />'+
                      '</tr>';
  
          $('#agendamentos_simulador tbody').append(tbl_body);
        }
        break;
    
        
      case 'Mensal':
        if( moment(dt_movel).format('DD') == moment(dt_inicio).format('DD') )
        {
          tbl_body =  '<tr>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('DD/MM/YYYY')+'</td>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('dddd')+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_inicio').val()+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_final').val()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_cliente").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_profexec").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_servprod").find(':selected').text()+'</td>'+
                        '<input type="hidden" name="'+increment+'[start]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_inicio').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[end]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_final').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[id_cliente]" value="'+$('#id_cliente').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_profexec]" value="'+$('#id_profexec').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_servprod]" value="'+$('#id_servprod').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_criador]" value="{{ \Auth::User()->id }}" />'+
                        '<input type="hidden" name="'+increment+'[status]" value="Fixa" />'+
                        '<input type="hidden" name="'+increment+'[grupo]" value="'+g_id+'" />'+
                      '</tr>';
  
          $('#agendamentos_simulador tbody').append(tbl_body);
        }        
        break;
    

      case 'Trimestral':
        if( moment(dt_movel).format('DD') == moment(dt_inicio).format('DD') && !(moment(dt_movel).diff(moment(dt_inicio), 'month') % 3) )
        {
          tbl_body =  '<tr>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('DD/MM/YYYY')+'</td>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('dddd')+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_inicio').val()+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_final').val()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_cliente").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_profexec").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_servprod").find(':selected').text()+'</td>'+
                        '<input type="hidden" name="'+increment+'[start]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_inicio').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[end]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_final').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[id_cliente]" value="'+$('#id_cliente').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_profexec]" value="'+$('#id_profexec').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_servprod]" value="'+$('#id_servprod').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_criador]" value="{{ \Auth::User()->id }}" />'+
                        '<input type="hidden" name="'+increment+'[status]" value="Fixa" />'+
                        '<input type="hidden" name="'+increment+'[grupo]" value="'+g_id+'" />'+
                      '</tr>';
  
          $('#agendamentos_simulador tbody').append(tbl_body);
        }
        break;

        break;
    
        
      case 'Anual':
        if( moment(dt_movel).format('DD') == moment(dt_inicio).format('DD') && moment(dt_movel).format('MM') == moment(dt_inicio).format('MM'))
        {
          tbl_body =  '<tr>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('DD/MM/YYYY')+'</td>'+
                        '<td class="text-nowrap">'+moment(dt_movel).format('dddd')+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_inicio').val()+'</td>'+
                        '<td class="text-nowrap">'+$('#agendamento_final').val()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_cliente").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_profexec").find(':selected').text()+'</td>'+
                        '<td class="text-nowrap">'+$("#id_servprod").find(':selected').text()+'</td>'+
                        '<input type="hidden" name="'+increment+'[start]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_inicio').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[end]" value="'+moment(dt_movel).format('YYYY/MM/DD')+' '+$('#agendamento_final').val()+':00'+'" />'+
                        '<input type="hidden" name="'+increment+'[id_cliente]" value="'+$('#id_cliente').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_profexec]" value="'+$('#id_profexec').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_servprod]" value="'+$('#id_servprod').val()+'" />'+
                        '<input type="hidden" name="'+increment+'[id_criador]" value="{{ \Auth::User()->id }}" />'+
                        '<input type="hidden" name="'+increment+'[status]" value="Fixa" />'+
                        '<input type="hidden" name="'+increment+'[grupo]" value="'+g_id+'" />'+
                      '</tr>';
  
          $('#agendamentos_simulador tbody').append(tbl_body);
        }        

        break;
        
   
      default:
        break;
    }

    dt_movel = moment(dt_movel).add(1, 'day').format('YYYY-MM-DD')
  }
  
  $('#agendamentos_simulador').append('</tbody></table>');
  $("#agendamentos_simular").addClass('disabled');
}

function agendamentos_resetar()
{
  $("#id_cliente").val($("#id_cliente option:first").val()).trigger('change');
  $("#id_profexec").val($("#id_profexec option:first").val()).trigger('change');
  $("#id_servprod").val($("#id_servprod option:first").val()).trigger('change');

  $("#agendamento_feedback_cliente").text('Selecione o cliente . . .');
  $("#agendamento_feedback_profexec").text('Selecione o profissional . . .');
  $("#agendamento_feedback_servprod").text('Selecione o serviço . . .');

  $("#agendamentos_simular").addClass('disabled');
  $('#agendamentos_simulador').empty();

  verificar_campos()
}

function cliente_selecionado( campo )
{
  if( $('#id_cliente').val() != '' )
  {
    url = "{{ route('atd.pessoas.procurar', ':id') }}";
    url = url.replace(':id', campo.value );
  
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      asset = "{{ asset('/img/atendimentos/pessoas/:id.png') }}";
      asset = asset.replace(':id', response.data.id );
  
      $('#agendamento_feedback_cliente').text('('+response.data.id+') '+response.data.nome+' - '+moment(response.data.dt_nascimento, 'YYYY-MM-DD').format('DD/MM/YYYY'))
    })
@include('includes.catch', [ 'codigo_erro' => '4099633a' ] )
    .then(function()
    {
      verificar_campos()
    })
  }
}

function servico_selecionado( campo )
{
  if( $('#id_servprod').val() != '' )
  {
    url = "{{ route('cat.servprod.procurar', ':id') }}";
    url = url.replace(':id', campo.value );
  
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      duracao_servprod = response.data.duracao;
      $('#agendamento_feedback_servprod').text('Duração: '+moment(response.data.duracao, 'HH:mm:ss').format('HH:mm'))
      
    })
    @include('includes.catch', [ 'codigo_erro' => '6114499a' ] )
    .then(function ()
    {
      ajustar_horas()
      verificar_campos()
    })
  }
}

function ajustar_horas()
{
  data_start = moment($('#agendamento_data_inicial').val()+' '+$('#agendamento_inicio').val()+'00', "YYYY-MM-DD HH:mm:ss").format('YYYY-MM-DD HH:mm:ss')
  data_end   = moment(data_start).add(duracao_servprod.split(':')[0], 'hours').add(duracao_servprod.split(':')[1], 'minutes').add(duracao_servprod.split(':')[2], 'seconds').format('YYYY-MM-DD HH:mm:ss')
  
  $('#agendamento_final').val(moment(data_end, "YYYY-MM-DD HH:mm").format('HH:mm'))

  verificar_campos()
}

function verificar_campos()
{
  if( $('#id_cliente').val() != '' && $('#id_profexec').val() != '' && $('#id_servprod').val() != ''  )
  {
    $("#agendamentos_simular").removeClass('disabled');
  }
  else
  {
    $("#agendamentos_simular").addClass('disabled');
  }
}

function profissional_selecionado()
{
  $('#agendamento_feedback_profexec').text($('#id_profexec').find(':selected').text())

  verificar_campos()
}

function agendamento_criar()
{
  url = "{{ route('atd.agendamentos.gravar_lote') }}"

  dados = $('#form-agendamentos-criar').serialize()
  
  axios.post( url, dados)
  .then(function(response)
  {
    //  console.log(response)
    toastrjs(response.data.type, response.data.message);
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '7414822a' ] )
  .then(function ()
  {
    verificar_campos()
  })  
}    
</script>
@endsection
