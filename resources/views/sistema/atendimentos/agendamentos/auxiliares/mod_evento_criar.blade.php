<form autocomplete='off' id='form-agendamentos-criar'>
  <div class="modal-dialog">
  {{-- <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;"> --}}
    <div class="modal-content" style="height: 95%;">
      <div class="overlay" id="agendamento_criar_overlay"></div>
      <div class="modal-header" style="padding: 8px 16px;">
        <h4 class="modal-title">Criar Agendamento</span></h4>
        <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="row">
          {{-- <div class="col-12 col-md-12 col-lg-4"> --}}
          <div class="col-12 col-md-12 col-lg-12">
            <div class="form-group">
              <label><small><b>Cliente</b></small></label>
              <select class='form-control form-control-sm select2' name='id_cliente' onchange="cliente_selecionado(this)">
                <option value=''>Selecione o cliente . . .</option>
                @foreach($clientes as $id => $cliente)
                <option value='{{ $id }}'>{{ $cliente }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_cliente" class="pl-1" style="font-size: smaller;">Selecione o cliente . . .</span>
            </div>
          </div>
          <div class="col-8 col-md-8 col-lg-8">
            <div class="form-group">
              <label><small><b>Serviço</b></small></label>
              <select class='form-control form-control-sm select2' name='id_servprod' onchange="servico_selecionado(this)">
                <option value=''>Selecione o serviço . . .</option>
                @foreach($servicos as $id => $servico)
                <option value='{{ $servico->id }}'>{{ $servico->nome }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_servprod" class="pl-1" style="font-size: smaller;">Selecione o serviço . . .</span>
            </div>
          </div>
          <div class="col-4 col-md-4 col-lg-4">
            <div class="form-group">
              <label><small><b>Valor</b></small></label>
              <input type="text" class='form-control form-control-sm text-right' name='vlr_venda' value='0,00' />
            </div>
          </div>
          <div class="col-6 col-md-6 col-lg-6">
            <div class="form-group">
              <label><small><b>Profissional</b></small></label>
              <select class='form-control form-control-sm select2' name='id_profexec' onchange="profissional_selecionado(this)">
                <option value=''>Selecione o profissional . . .</option>
                @foreach($parceiros as $id => $profissional)
                <option value='{{ $profissional->id }}' {{ $informacoes['resource']['id'] == $profissional->id ? 'selected' : '' }}>{{ $profissional->apelido }}</option>
                @endforeach
              </select>
              <span id="agendamento_feedback_profexec" class="pl-1" style="font-size: smaller;">{{ $informacoes['resource']['title'] }}</span>
            </div>
          </div>
          <div class="col-3 col-md-3 col-lg-3">
            <div class="form-group">
              <label><small><b>Comissão (%)</b></small></label>
              <input type="text" class='form-control form-control-sm text-center' name='agd_comissoes[prc_comissao]' value='00' onchange='ajustar_comissao()' />
            </div>
          </div>
          <div class="col-3 col-md-3 col-lg-3">
            <div class="form-group">
              <label><small><b>Comissão (R$)</b></small></label>
              <input type="text" class='form-control form-control-sm text-right' name='agd_comissoes[vlr_comissao]' value='0,00' onchange='ajustar_comissao()' />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-12">
            <div class="form-group">
              <label><small><b>Observação</b></small></label>
              <input type="text" class='form-control form-control-sm' name='obs' />
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-12">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label><small><b>Data</b></small></label>
                  <input type="hidden" name='start' value="{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $informacoes['start'])->subHour(3)->format('Y-m-d H:i:s') }}">
                  <input type="hidden" name='end' value="{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $informacoes['end'])->subHour(3)->format('Y-m-d\ H:i:s') }}">
                  <input type="hidden" name='id_criador' value="{{ \Auth::User()->id }}">
                  <input type="hidden" name='status' value="Agendado">
                  <input type="date" class='form-control form-control-sm' id='agendamento_data' value="{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $informacoes['start'])->subHour(3)->format('Y-m-d') }}" onchange="ajustar_horas()">
                </div>
                <div class="col-3">
                  <label><small><b>de</b></small></label>
                  <input type="time" class='form-control form-control-sm' id='agendamento_inicio' value="{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $informacoes['start'])->subHour(3)->format('H:i') }}" onchange="ajustar_horas()">
                </div>
                <div class="col-3">
                  <label><small><b>à</b></small></label>
                  <input type="time" class='form-control form-control-sm' id='agendamento_final' value="{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.v\Z', $informacoes['end'])->subHour(3)->format('H:i') }}" onchange="ajustar_horas()">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        @if(is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Gerente Administrativo'))
        <div class="btn-group">
          <button type="button" class="btn btn-primary" onclick="agendamento_criar()">Agendar</button>
          <button type="button" class="btn btn-primary" onclick="agendamento_criar_e_mensagem()"><i class="fa-brands fa-whatsapp"></i></button>
        </div>
        @endif
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  duracao_servprod = "{{ \Carbon\Carbon::parse($informacoes['start'])->diff($informacoes['end'])->format('%H:%I:%S') }}"
  $('.select2').select2({
    dropdownParent: $('#modal-geral-1'),
  });

  $('#agendamento_criar_overlay').hide();
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

    if (response.data.whatsapp != null)
    {
      $('#agendamento_feedback_cliente').append('  <a href="https://api.whatsapp.com/send?phone=55'+response.data.whatsapp+'" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '8357627a' ] )
}

function servico_selecionado( campo )
{
  url = "{{ route('cat.servprod.procurar', ':id') }}";
  url = url.replace(':id', campo.value );

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    duracao_servprod  = response.data.duracao;
    profsexec_servprod = response.data.aksjaldjfwjlwfp;
    vlr_venda_servprod = response.data.vlr_venda * 1
    
    $('#agendamento_feedback_servprod').text('Duração: '+moment(response.data.duracao, 'HH:mm:ss').format('HH:mm'))
    $('[name="vlr_venda"]').val(accounting.formatMoney(vlr_venda_servprod, ''))
    ajustar_comissao()
  })
  @include('includes.catch', [ 'codigo_erro' => '6871822a' ] )
  .then(function ()
  {
    ajustar_horas()
  })
}

function ajustar_horas()
{
  let data_start = moment($('#agendamento_data').val()+' '+$('#agendamento_inicio').val()+'00', "YYYY-MM-DD HH:mm:ss")
  let data_end   = moment(data_start).add(duracao_servprod.split(':')[0], 'hours').add(duracao_servprod.split(':')[1], 'minutes').add(duracao_servprod.split(':')[2], 'seconds')

  $('[name="start"]').val(moment(data_start, "YYYY-MM-DD HH:mm").format('YYYY-MM-DD HH:mm:ss'))
  $('[name="end"]').val(moment(data_end, "YYYY-MM-DD HH:mm").format('YYYY-MM-DD HH:mm:ss'))
  $('#agendamento_final').val(moment(data_end, "YYYY-MM-DD HH:mm").format('HH:mm'))
}

function ajustar_comissao()
{
  id_profexec = $('[name="id_profexec"]').find(':selected').val()
  id_servprod = $('[name="id_servprod"]').find(':selected').val()

  selecionado = collect(profsexec_servprod).where('id_servprod', id_servprod*1).where('id_profexec', id_profexec*1).first()

  $('[name="agd_comissoes[prc_comissao]"]').val(selecionado.prc_comissao*100)
  $('[name="agd_comissoes[vlr_comissao]"]').val(accounting.formatMoney(vlr_venda_servprod * selecionado.prc_comissao, ''))

  
  $('#agendamento_feedback_profexec').text('Comissão (%): '+ selecionado.prc_comissao*100+' | Comissão (R$): '+accounting.formatMoney(vlr_venda_servprod * selecionado.prc_comissao, ''))
}

function calcular_comissao()
{
  alert()
}

function profissional_selecionado()
{
  $('#agendamento_feedback_profexec').text($('[name="id_profexec"]').find(':selected').text())
  ajustar_comissao()
}
 
function agendamento_criar()
{
  url = "{{ route('atd.agendamentos.gravar') }}"

  dados = $('#form-agendamentos-criar').serialize()
  
  axios.post( url, dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);
  })
  @include('includes.catch', [ 'codigo_erro' => '7197311a' ] )
  .then(function ()
  {
    $('#modal-geral-1').modal('hide')
    agendamentos_recarregar()
  })
}    

function agendamento_criar_e_mensagem()
{
  url = "{{ route('atd.agendamentos.gravar') }}"

  dados = $('#form-agendamentos-criar').serialize()

  axios.post( url, dados)
  .then(async function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message);
    
    const dados = {
      area: 'Agendamento (criação)',
      id_agendamento: response.data.data.id
    };

    const mensagem = await enviar_mensagem(dados)
    console.log('-================================')
    console.log(response)
    console.log(response.data)
    console.log(response.data.data)
    console.log(response.data.data.xhooqvzhbgojbtg)
    console.log(response.data.data.xhooqvzhbgojbtg.whatsapp)
    console.log(mensagem)
    console.log('-================================')
    window.open('https://api.whatsapp.com/send?phone=55' + response.data.data.xhooqvzhbgojbtg.whatsapp + '&text=' + mensagem + '');
  })
  @include('includes.catch', [ 'codigo_erro' => '7197311a' ] )
  .then(function ()
  {
    $('#modal-geral-1').modal('hide')
    agendamentos_recarregar()
  })
}

async function enviar_mensagem(dados)
{
  return new Promise(function (resolve, reject)
  {
    axios.post("{{ route('cfg.mensagens.preencher') }}", dados)
    .then(function (response)
    {
      // console.log(response)
      resolve(response.data);
    })
    @include('includes.catch', [ 'codigo_erro' => '1876451a' ] )
  })
}
</script>
