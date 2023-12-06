@extends('layouts.app')

@section('content')
@if(Auth::User()->id == 2)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Dashboard</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <div class="d-flex justify-content-end">
              <div class="input-group">
                <select class="form-control form-control-sm select" name="id_cliente" id="id_cliente" onchange="mudar_cliente()">
                  <option value="11304">IE Caratinga</option>
                  <option value="11305">IE Teó</option>
                </select>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@else
<input type="hidden" name="id_cliente" id="id_cliente" value="{{ Auth::User()->id }}">
@endif
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Financeiro 2022</h5>
      </div>
      <div class="card-body">
        <div class="row">

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">JAN</span>
              <h6 class="description-header" id="vlr_jan"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_jan"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">FEV</span>
              <h6 class="description-header" id="vlr_fev"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_fev"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">MAR</span>
              <h6 class="description-header" id="vlr_mar"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_mar"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">ABR</span>
              <h6 class="description-header" id="vlr_abr"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_abr"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">MAI</span>
              <h6 class="description-header" id="vlr_mai"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_mai"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">JUN</span>
              <h6 class="description-header" id="vlr_jun"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_jun"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">JUL</span>
              <h6 class="description-header" id="vlr_jul"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_jul"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">AGO</span>
              <h6 class="description-header" id="vlr_ago"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_ago"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">SET</span>
              <h6 class="description-header" id="vlr_set"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_set"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">OUT</span>
              <h6 class="description-header" id="vlr_out"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_out"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block border-right">
              <span class="description-text">NOV</span>
              <h6 class="description-header" id="vlr_nov"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_nov"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

          <div class="col-1">
            <div class="description-block">
              <span class="description-text">DEZ</span>
              <h6 class="description-header" id="vlr_dez"><i class="fas fa-spinner fa-pulse"></i></h6>
              <span class="description-percentage text-warning" id="status_dez"><i class="fa-solid fa-circle"></i></span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    @include('sistema.financeiro.dashboard.inc_faturas')
  </div>
</div>
{{-- <div class="row">
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
</div> --}}

{{-- <div class="row">
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="small-box bg-warning">
      <div class="overlay" id="overlay-engajamento">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="inner">
        <h3 id="vlr_soma_saldo_final_c6">-</h3>
        <p>Saldo C6</p>
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
        <h3 id="vlr_soma_saldo_final_asaas">-</h3>
        <p>Saldo ASAAS</p>
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
        <h3 id="vlr_soma_saldo_final_geral">-</h3>
        <p>Saldo Geral</p>
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
</div> --}}

@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    mensalidade_mes()
    dashboard_saldo_final_c6()
    dashboard_saldo_final_asaas()
    dashboard_saldo_final_geral()
    $('#overlay-dashboard').hide();
    atualizarDados('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    atualizarDadosHoje('{{ \Carbon\Carbon::today()->format('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}')
    // ajustarDatas_acoes_lead('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}')
    // ajustarDatasEngajamento('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    // ajustarDatasCliques('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    // ajustarDatasMensagensRecebidas('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
    {{-- ajustarDatasValorGasto('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}'); --}}
    // ajustarDatasEstDiaaDia('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
  });

  function mensalidade_mes()
  {
    var url = "{{ route('fin.lancamentos.mensalidades', ':id' ) }}";
    var url = url.replace(':id',  $('#id_cliente').val() );

    axios.get(url)
    .then( function(response)
    {
      // console.log(response.data)
      collect(response.data).each((value, indice) =>
      {
        var parcela = parseFloat(value.vlr_final).toFixed(2);

        if( moment(value.dt_vencimento).isSame('2022-01-01', 'month') )
        {
          $('#vlr_jan').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_jan').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_jan').removeClass('text-warning').addClass('text-danger')
          }
        }


        if( moment(value.dt_vencimento).isSame('2022-02-01', 'month') )
        {
          $('#vlr_fev').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_fev').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_fev').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-03-01', 'month') )
        {
          $('#vlr_mar').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_mar').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_mar').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-04-01', 'month') )
        {
          $('#vlr_abr').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_abr').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_abr').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-05-01', 'month') )
        {
          $('#vlr_mai').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_mai').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_mai').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-06-01', 'month') )
        {
          $('#vlr_jun').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_jun').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_jun').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-07-01', 'month') )
        {
          $('#vlr_jul').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_jul').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_jul').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-08-01', 'month') )
        {
          $('#vlr_ago').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_ago').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_ago').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-09-01', 'month') )
        {
          $('#vlr_set').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_set').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_set').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-10-01', 'month') )
        {
          $('#vlr_out').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_out').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_out').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-11-01', 'month') )
        {
          $('#vlr_nov').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_nov').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_nov').removeClass('text-warning').addClass('text-danger')
          }
        }

        if( moment(value.dt_vencimento).isSame('2022-12-01', 'month') )
        {
          $('#vlr_dez').html( (parcela).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) )
          if( value.status == 'Confirmado')
          {
            $('#status_dez').removeClass('text-warning').addClass('text-success')
          }
          else if( value.status == 'Aguarando')
          {
            $('#status_dez').removeClass('text-warning').addClass('text-danger')
          }
        }

      })
})

}

function dashboard_saldo_final_c6()
{

    // axios.get(url)
    // .then( function(response)
    // {
    //   // console.log(response.data)
    //   $('#vlr_soma_saldo_final_c6').html(response.data.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'}));
    // })
  }

  function dashboard_saldo_final_asaas()
  {
    {{-- //   var url = "{{ route('fin.dashboard_saldo_final_asaas') }}"; --}}
  //   // var url = url.replace(':d', "dt_inicio="+start+"&dt_final="+end+"&dado="+informacao+"&id_cliente="+id_cliente);

  //   axios.get(url)
  //   .then( function(response)
  //   {
  //     // console.log(response.data)
  //     $('#vlr_soma_saldo_final_asaas').html(response.data.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'}));
  //   })
}

function dashboard_saldo_final_geral()
{
  {{-- var url = "{{ route('fin.dashboard_saldo_final_geral') }}"; --}}
    // var url = url.replace(':d', "dt_inicio="+start+"&dt_final="+end+"&dado="+informacao+"&id_cliente="+id_cliente);

    // axios.get(url)
    // .then( function(response)
    // {
    //   // console.log(response.data)
    //   $('#vlr_soma_saldo_final_geral').html(response.data.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'}));
    // })
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
