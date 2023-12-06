@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Recebimentos Cartão de Crédito</h3>
        </div>
      </div>
      <div class="card-body">
        <div class="position-relative mb-4">
          <div style="height: 350px;width: 100%;">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          @foreach($recebimentos->where('s') as $recebimento)
          <div class="col-sm-{{ 12 / count($recebimentos) }}">
            <div class="description-block {{ !$loop->last ? 'border-right' : '' }}">
              <span class="description-percentage"><span class="text-success">{{ number_format($recebimento->vlr_real,2,',','.') }}</span> - <span class="text-danger">{{ number_format($recebimento->vlr_desc,2,',','.') }}</span></span>
              <h5 class="description-header">R$ {{ number_format($recebimento->vlr_receber,2,',','.') }}</h5>
              <p style="margin-bottom: 0px;"><strong>{{ $recebimento->gevmgwjvzgdexwm->forma }}</strong></p>
              <p><small>{{ $recebimento->gevmgwjvzgdexwm->bandeira }}</small></p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Recebimento em Cartões em Aberto</h3>
        <div class="card-tools">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" href="#modal_bancos" ><i class="far fa-fw fa-plus-square"></i></a>
            <a class="btn btn-sm btn-default" id="acao"><i class="far fa-fw fa-check-square" onclick="marcarVarios(true);"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding">
          <thead>
            <tr>
              <th class="text-left">Qtd</th>
              <th class="text-left">Data Prevista</th>
              <th class="text-left">Forma de Pagamento</th>
              <th class="text-left">Bandeira</th>
              <th class="text-left">Taxa</th>
              <th class="text-right">Vlr real</th>
              <th class="text-right">Vlr Desc.</th>
              <th class="text-right">Vlr Líquido</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recebimentos as $recebimento)
            <tr>
              <td class="text-left">{{ $recebimento->qtd_recebimentos }}</td>
              <td class="text-left">{{ Carbon\Carbon::parse($recebimento->dt_prevista)->format('d/m/Y') }}</td>
              <td class="text-left">{{ $recebimento->gevmgwjvzgdexwm->forma }}</td>
              <td class="text-left">{{ $recebimento->gevmgwjvzgdexwm->bandeira }}</td>
              <td class="text-left">{{ $recebimento->gevmgwjvzgdexwm->taxa }} %</td>
              <td class="text-right">{{ number_format($recebimento->vlr_real,2,',','.') }}</td>
              <td class="text-right">{{ number_format($recebimento->vlr_desc,2,',','.') }}</td>
              <td class="text-right"></td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center" colspan="5"></th>
              <th class="text-right">{{ number_format($recebimentos->sum('vlr_real'),2,',','.') }}</th>
              <th class="text-right">{{ number_format($recebimentos->sum('vlr_desc'),2,',','.') }}</th>
              <th class="text-right">{{ number_format($recebimentos->sum('vlr_receber'),2,',','.') }}&emsp;</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="card-footer">
        <button type="reset" class="btn btn-default btn-sm">Voltar</button>
        <button type="submit" class="btn btn-success btn-sm pull-right">Confirmar Recebimento</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('js')
<script type="text/javascript">
//
fin_recebCartoes = [];

$(document).ready(function()
{
  $("#overlay_recebCartoes").hide();
  busca_recCartoes('s')
});

var visitsCtx   = $('#myChart');
var visitsChart = new Chart (visitsCtx);

$('.visits').click(function()
{
  var id = $(this).attr('id').replace('visits_', '');
  busca_recCartoes(id);
})


function busca_recCartoes(date)
{
  var labels  = [];
  
  var cartoes = {
    'confirmado' : {
      'credito' : {
        'vlr_receber' : [],
      },
      'debito' : {
        'vlr_receber' : [],
      },
    },
    'aguardando' : {
      'credito' : {
        'vlr_receber' : [],
      },
      'debito' : {
        'vlr_receber' : [],
      },
    },
  }
  
  axios.get("{{ route('chart.cartoes_semanal') }}")
  .then( function(response)
  {
    // console.log(response.data)
    collect(response.data).each((dia, indice) =>
    {
      moment(indice).isSame(moment(), 'day') ? labels.push('Hoje') : labels.push(moment(indice).format('D/MMM'));

      if(collect(dia).has(["Aguardando Validação"]))
      {
        cartoes.aguardando.credito.vlr_receber.push(collect(dia["Aguardando Validação"]["Cartão de Crédito"]).sum('vlr_receber'))
        cartoes.aguardando.debito.vlr_receber.push(collect(dia["Aguardando Validação"]["Cartão de Débito"]).sum('vlr_receber'))
      }
      else
      {
        cartoes.aguardando.credito.vlr_receber.push(0)
        cartoes.aguardando.debito.vlr_receber.push(0)
      }

      if(collect(dia).has(["Recebido"]))
      {
        cartoes.confirmado.credito.vlr_receber.push(collect(dia["Recebido"]["Cartão de Crédito"]).sum('vlr_receber'))
        cartoes.confirmado.debito.vlr_receber.push(collect(dia["Recebido"]["Cartão de Débito"]).sum('vlr_receber'))
      }
      else
      {
        cartoes.confirmado.credito.vlr_receber.push(0)
        cartoes.confirmado.debito.vlr_receber.push(0)
      }
    })

    creatVisitsChart(labels, cartoes);
  })
}

function formadorDataset(dado, status, forma)
{
  datatseti =
  {
    label: null,
    data: [],
    borderWidth: 1,
    backgroundColor: null
  }

  datatseti.label           = defineLabel(forma, status);
  datatseti.data            = dado.vlr_receber;
  datatseti.borderWidth     = 1;
  datatseti.backgroundColor = definiCor(forma, status);

  return datatseti;
}

function defineLabel(forma, status)
{
  if (forma == 'credito')
  {
    if ( status == 'aguardando')
    {
      return 'Cartões de Crédito (Aguardando Confirmação)';
    }
    else if (status == 'confirmado')
    {
      return 'Cartões de Crédito (Confimado)';
    }
  }
  else if (forma == 'debito')
  {
    if ( status == 'aguardando')
    {
      return 'Cartões de Débito (Aguardando Confirmação)';
    }
    else if (status == 'confirmado')
    {
      return 'Cartões de Débito (Confirmado)';
    }
  }
}

function definiCor(forma, status)
{
  if (forma == 'credito')
  {
    if ( status == 'aguardando')
    {
      return '#e56b97';
    }
    else if (status == 'confirmado')
    {
      return '#d81b60';
    }
  }
  else if (forma == 'debito')
  {
    if ( status == 'aguardando')
    {
      return '#9b64f6';
    }
    else if (status == 'confirmado')
    {
      return '#6610f2';
    }
  }
    
  var cores = ["#f36", "#C3C", "#fc0", "#FC6", "#9C0", 'black', 'green', 'blue', 'orange' ];

  return 'black';
  return cores[0];
}


function creatVisitsChart(labels, todosDados)
{
  var cores = ["#f36", "#C3C", "#fc0", "#FC6", "#9C0", 'black', 'green', 'blue', 'orange' ];
  var dataSetado = [];

  collect(todosDados).each(function(dados, status)
  {
    collect(collect(dados)).each((dado, forma) =>
    {
      dataSetado.push(formadorDataset(dado, status, forma))
    })
  })

  visitsChart.destroy();
  visitsChart = new Chart (visitsCtx,
  {
    type: 'bar',
    data:
    {
      labels: labels,
      datasets: dataSetado
    },
    options:
    {
      responsive: true,
      maintainAspectRatio: false,
      parsing:
      {
        xAxisKey: 'x',
      },
      legend:
      {
        display: false
      },
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    },
  });
}
</script>
@endpush