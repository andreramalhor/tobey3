<form autocomplete='off' id='form-agendamentos-editar'>
  <div class="modal-dialog">
    {{-- <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;"> --}}
    <div class="modal-content" style="height: 95%;">
      <!-- <div class="overlay" id="agendamento_editar_overlay"></div> -->
      <div class="modal-header" style="padding: 8px 16px;">
        <h4 class="modal-title">Editar Agendamento: {{ $agendamento->id ?? '#id' }}</span></h4>
        <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12 order-1">
          {{-- <div class="col-12 col-md-12 col-lg-4 order-1"> --}}
            <div class="form-group">
              <label>Cliente</label>
              <select class='form-control form-control-sm select2' name='id_cliente' onchange="cliente_selecionado(this)">
                <option value=''>Selecione o cliente . . .</option>
                @foreach($clientes as $id => $cliente)
                <option value='{{ $id }}' {{ $agendamento->id_cliente == $id ? 'selected' : '' }}>{{ $cliente }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_cliente" class="pl-1" style="font-size: smaller;">Selecione o cliente . . .</span>
            </div>
            <div class="form-group">
              <label>Profissional</label>
              <select class='form-control form-control-sm select2' name='id_profexec' id='id_profexec' onchange="profissional_selecionado(this)">
                <option value=''>Selecione o profissional . . .</option>
                @foreach($parceiros as $id => $profissional)
                <option value='{{ $profissional->id }}' {{ $agendamento->id_profexec == $profissional->id ? 'selected' : '' }}>{{ $profissional->nome }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_profexec" class="pl-1" style="font-size: smaller;">{{ $agendamento->hhmaqpijffgfhmj->apelido }}</span>
            </div>
            <div class="form-group">
              <label>Serviço</label>
              <select class='form-control form-control-sm select2' name='id_servprod' onchange="servico_selecionado(this)">
                <option value=''>Selecione o serviço . . .</option>
                @foreach($servicos as $id => $servico)
                <option value='{{ $servico->id }}' {{ $agendamento->id_servprod == $servico->id ? 'selected' : '' }}>{{ $servico->nome }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_servprod" class="pl-1" style="font-size: smaller;">Selecione o serviço . . .</span>
            </div>
            <div class="form-group">
              <label>Obs</label>
              <input type="text" class='form-control form-control-sm' name='obs' value='{{ $agendamento->obs ?? "" }}' />
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label>Data</label>
                  <input type="hidden" id='id' value="{{ $agendamento->id }}">
                  <input type="hidden" id='start' name='start' value="{{ \Carbon\Carbon::parse($agendamento->start)->format('Y-m-d H:i:s') }}">
                  <input type="hidden" id='end' name='end' value="{{ \Carbon\Carbon::parse($agendamento->end)->format('Y-m-d\ H:i:s') }}">
                  <input type="hidden" name='id_criador' value="{{ $agendamento->id_criador }}">
                  <input type="hidden" name='status' value="{{ $agendamento->status }}">
                  <input type="date" class='form-control form-control-sm' id='agendamento_data' value="{{ \Carbon\Carbon::parse($agendamento->start)->format('Y-m-d') }}" onchange="ajustar_horas()">
                </div>
                <div class="col-3">
                  <label>de</label>
                  <input type="time" class='form-control form-control-sm' id='agendamento_inicio' value="{{ \Carbon\Carbon::parse($agendamento->start)->format('H:i') }}" onchange="ajustar_horas()">
                </div>
                <div class="col-3">
                  <label>à</label>
                  <input type="time" class='form-control form-control-sm' id='agendamento_final' value="{{ \Carbon\Carbon::parse($agendamento->end)->format('H:i') }}" onchange="ajustar_horas()">
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        @if(is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Gerente Administrativo'))
        <button type="button" class="btn btn-primary" onclick="agendamento_editar()">Editar</button>
        @endif
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  duracao_servprod = "{{ \Carbon\Carbon::parse($agendamento->start)->diff($agendamento->end)->format('%H:%I:%S') }}"
  $('.select2').select2({
    dropdownParent: $('#modal-geral-1'),
  });

  // $('#agendamento_editar_overlay').hide();
})

function cliente_selecionado( campo )
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
@include('includes.catch', [ 'codigo_erro' => '6393784a' ] )
}

function servico_selecionado( campo )
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
@include('includes.catch', [ 'codigo_erro' => '5132373a' ] )
  .then(function ()
  {
    ajustar_horas()
  })
}

function ajustar_horas()
{
  let data_start = moment($('#agendamento_data').val()+' '+$('#agendamento_inicio').val()+'00', "YYYY-MM-DD HH:mm:ss")
  let data_end   = moment(data_start).add(duracao_servprod.split(':')[0], 'hours').add(duracao_servprod.split(':')[1], 'minutes').add(duracao_servprod.split(':')[2], 'seconds')

  $('#start').val(moment(data_start, "YYYY-MM-DD HH:mm").format('YYYY-MM-DD HH:mm:ss'))
  $('#end').val(moment(data_end, "YYYY-MM-DD HH:mm").format('YYYY-MM-DD HH:mm:ss'))
  $('#agendamento_final').val(moment(data_end, "YYYY-MM-DD HH:mm").format('HH:mm'))
}

function profissional_selecionado()
{
  $('#agendamento_feedback_profexec').text($('#id_profexec').find(':selected').text())
}

function agendamento_editar()
{
  url = "{{ route('atd.agendamentos.atualizar', ':id') }}";
  url = url.replace(':id', $('#id').val() );

  dados = $('#form-agendamentos-editar').serialize()
  
  axios.put( url, dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);
  })
@include('includes.catch', [ 'codigo_erro' => '6517317a' ] )
  .then(function ()
  {
    $('#modal-geral-1').modal('hide')
    agendamentos_recarregar()
  })  
}    
</script>
