@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Dashboard</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <div class="d-flex justify-content-end">
              <div class="input-group">
              @if(Auth::User()->id == 2)
                <select class="form-control form-control-sm select" name="id_cliente" id="id_cliente" onchange="mudar_cliente()" disabled="true">
                  <option value="">...</option>
                </select>
              @else
                <input type="hidden" name="id_cliente" id="id_cliente" value="{{ Auth::User()->id }}">
              @endif
              </div>
              &nbsp&nbsp&nbsp&nbsp
              <div class="input-group" style="width: 500px;">
                <input type="text" class="form-control form-control-sm reservation" name="periodo" id="periodo" value="{{ \Carbon\Carbon::today()->startOf('month')->format('d/m/Y') }} - {{ \Carbon\Carbon::today()->format('d/m/Y') }}">
                <div class="input-group-append">
                  <div class="input-group-text bg-warning">
                    <i class="far fa-calendar-alt"></i>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    @include('sistema.dashboard.clientes.chart_acoes_lead')
  </div>
  <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        @include('sistema.dashboard.clientes.chart_engajamento')
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        @include('sistema.dashboard.clientes.chart_cliques')
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        @include('sistema.dashboard.clientes.chart_mensagens_recebidas')
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        @include('sistema.dashboard.clientes.chart_valor_gasto')
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="small-box bg-warning">
      <div class="overlay" id="overlay-engajamento">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="inner">
        <h3 id="periodo_vlr_engajamento">-</h3>
        <p>Engajamento</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-eye"></i>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="small-box bg-info">
      <div class="overlay" id="overlay-cliques">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="inner">
        <h3 id="periodo_cliques">-</h3>
        <p>Cliques</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-computer-mouse"></i>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="small-box bg-success">
      <div class="overlay" id="overlay-mensagens_recebidas">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="inner">
        <h3 id="periodo_mensagens_recebidas">-</h3>
        <p>Mensagens Recebidas</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-envelope-open-text"></i>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="small-box bg-danger">
      <div class="overlay" id="overlay-vlr_gasto">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="inner">
        <h3 id="periodo_vlr_gasto">R$ - </h3>
        <p>Valor gasto</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-money-bill"></i>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="fa-solid fa-eye"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Engajamento
          <span class="text-muted float-right">Hoje</span>
        </span>
        <span class="info-box-number" id="vlr_engajamento_hoje">-</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fa-solid fa-computer-mouse"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Cliques
          <span class="text-muted float-right">Hoje</span>
        </span>
        <span class="info-box-number" id="cliques_hoje">-</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fa-solid fa-envelope-open-text"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Mensagens Recebidas
          <span class="text-muted float-right">Hoje</span>
        </span>
        <span class="info-box-number" id="mensagens_recebidas_hoje">-</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><i class="fa-solid fa-money-bill"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Valor gasto
          <span class="text-muted float-right">Hoje</span>
        </span>
        <span class="info-box-number" id="vlr_gasto_hoje">-</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    @include('sistema.dashboard.clientes.chart_geral_diaadia')
  </div>
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
  @include('sistema.dashboard.clientes.chart_dados_complemen')
</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
    todos_clientes();
    atualizarDados('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    atualizarDadosHoje('{{ \Carbon\Carbon::today()->format('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}')
    // ajustarDatas_acoes_lead('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}')
    // ajustarDatasEngajamento('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    // ajustarDatasCliques('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    // ajustarDatasMensagensRecebidas('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    {{-- ajustarDatasValorGasto('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}'); --}}
    // ajustarDatasEstDiaaDia('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
  });

  function todos_clientes()
  {
    var url = "{{ route('pessoas.clientes.todos_clientes') }}";

    axios.get(url)
    .then( function(response)
    {
      // console.log(response.data)
      $("#id_cliente").empty().append('<option value="">Selecione . . . </option>')
      collect(response.data).sortBy('nome').each((data) =>
      {
        $("#id_cliente").append('<option value="'+data.id+'">'+data.nome+'</option>')
      })
    })
@include('includes.catch', [ 'codigo_erro' => '4821233a' ] )
    .then( function()
    {
      $("#id_cliente").prop("disabled", false);
    })

  }

  $('#periodo').daterangepicker({
    format: "DD/MM/YYYY",
    opens: 'left',
    alwaysShowCalendars: true,
    autoclose: true,
    autoclose: true,
    locale: {
      "customRangeLabel": "Selecionar intervalo",
      "format": "DD/MM/YYYY",
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "daysOfWeek": [ "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab" ],
      "monthNames": [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
    },
    firstDay: 1,
    ranges: {
      'Hoje': [moment(), moment()],
      'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
      'Este mês': [moment().startOf('month'), moment().endOf('month')],
      'Mês anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
  },function(start, end)
  {
    atualizarDados(start, end)
    ajustarDatas_acoes_lead(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasEngajamento(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasCliques(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasMensagensRecebidas(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasValorGasto(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasEstDiaaDia(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));

    // $('#periodo').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
  });

  function atualizarDados(start, end)
  {
    resposta(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'interacoes');
    resposta(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'mensagens_recebidas');
    resposta(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'cliques');
    resposta(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'vlr_gasto');
  }

  function atualizarDadosHoje(start, end)
  {
    respostaHoje(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'interacoes');
    respostaHoje(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'mensagens_recebidas');
    respostaHoje(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'cliques');
    respostaHoje(moment(start).format('YYYY-MM-DD'), moment(end).format('YYYY-MM-DD'), 'vlr_gasto');
  }

  function resposta(start, end, informacao)
  {
    id_cliente = $('#id_cliente')[0].value;

    rodarSpins()
    var url = "{{ route('dashboard.soma_informacao', ':d') }}";
    var url = url.replace(':d', "dt_inicio="+start+"&dt_final="+end+"&dado="+informacao+"&id_cliente="+id_cliente);

    axios.post(url)
    .then( function(response)
    {
      // console.log(response.data)
      switch (informacao)
      {
        case 'interacoes':
        $('#periodo_vlr_engajamento').html(response.data.toLocaleString('pt-br', {minimumFractionDigits: 0}));
        setTimeout(function()
        {
          $('#overlay-engajamento').hide();
        }, 500)
        break;
        case 'mensagens_recebidas':
        $('#periodo_mensagens_recebidas').html(response.data.toLocaleString('pt-br', {minimumFractionDigits: 0}));
        setTimeout(function()
        {
          $('#overlay-mensagens_recebidas').hide();
        }, 500)
        break;
        case 'cliques':
        $('#periodo_cliques').html(response.data.toLocaleString('pt-br', {minimumFractionDigits: 0}));
        setTimeout(function()
        {
          $('#overlay-cliques').hide();
        }, 500)
        break;
        case 'vlr_gasto':
        $('#periodo_vlr_gasto').html(response.data.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'}));
        setTimeout(function()
        {
          $('#overlay-vlr_gasto').hide();
        }, 500)
        break;
        default:
      }

      return response.data;
    })
  }

  function respostaHoje(start, end, informacao)
  {
    id_cliente = $('#id_cliente')[0].value;

    rodarSpins()
    var url = "{{ route('dashboard.soma_informacao', ':d') }}";
    var url = url.replace(':d', "dt_inicio="+start+"&dt_final="+end+"&dado="+informacao+"&id_cliente="+id_cliente);

    axios.post(url)
    .then( function(response)
    {
      switch (informacao)
      {
        case 'interacoes':
        $('#vlr_engajamento_hoje').html(response.data.toLocaleString('pt-br', {minimumFractionDigits: 0}));
        setTimeout(function()
        {
          $('#overlay-engajamento').hide();
        }, 500)
        break;
        case 'mensagens_recebidas':
        $('#mensagens_recebidas_hoje').html(response.data.toLocaleString('pt-br', {minimumFractionDigits: 0}));
        setTimeout(function()
        {
          $('#overlay-mensagens_recebidas').hide();
        }, 500)
        break;
        case 'cliques':
        $('#cliques_hoje').html(response.data.toLocaleString('pt-br', {minimumFractionDigits: 0}));
        setTimeout(function()
        {
          $('#overlay-cliques').hide();
        }, 500)
        break;
        case 'vlr_gasto':
        $('#vlr_gasto_hoje').html(response.data.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'}));
        setTimeout(function()
        {
          $('#overlay-vlr_gasto').hide();
        }, 500)
        break;
        default:
      }

      return response.data;
    })
  }

  function rodarSpins()
  {
    $('#overlay-engajamento').show();
    $('#overlay-mensagens_recebidas').show();
    $('#overlay-cliques').show();
    $('#overlay-vlr_gasto').show();
  }

  function mudar_cliente()
  {
    periodo = $('#periodo')[0].value;

    datas = periodo.split(' - ')
    start = moment(datas[0], 'DD/MM/YYYY').format('YYYY-MM-DD')
    end   = moment(datas[1], 'DD/MM/YYYY').format('YYYY-MM-DD')

    atualizarDados(start, end)
    ajustarDatas_acoes_lead(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasEngajamento(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasCliques(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasMensagensRecebidas(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasValorGasto(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    ajustarDatasEstDiaaDia(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"));
    atualizarDadosHoje('{{ \Carbon\Carbon::today()->format('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}')
    ajustarDatasmes_dados_complem('{{ \Carbon\Carbon::today()->format('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}')
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
