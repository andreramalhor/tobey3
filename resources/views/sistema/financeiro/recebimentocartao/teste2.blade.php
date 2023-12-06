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
  var total   = [];
  
  var setacao = {
    'credito' : {
      'vlr_real'    : [],
      'vlr_desc'    : [],
      'vlr_receber' : [],
    },
    'debito' : {
      'vlr_real'    : [],
      'vlr_desc'    : [],
      'vlr_receber' : [],
    }
  }
  
  axios.get("{{ route('chart.cartoes_semanal') }}")
  .then( function(response)
  {
    // console.log(response.data)
    collect(response.data).each(function(valor, indice)
    {
      setacao.credito.vlr_real.push(collect(valor).where('saskld__forma_de__pagamento.forma', 'Cartão de Crédito').sum('vlr_real'))
      setacao.credito.vlr_desc.push(collect(valor).where('saskld__forma_de__pagamento.forma', 'Cartão de Crédito').sum('vlr_desc'))
      setacao.credito.vlr_receber.push(collect(valor).where('saskld__forma_de__pagamento.forma', 'Cartão de Crédito').sum('vlr_receber'))
      setacao.debito.vlr_real.push(collect(valor).where('saskld__forma_de__pagamento.forma', 'Cartão de Débito').sum('vlr_real'))
      setacao.debito.vlr_desc.push(collect(valor).where('saskld__forma_de__pagamento.forma', 'Cartão de Débito').sum('vlr_desc'))
      setacao.debito.vlr_receber.push(collect(valor).where('saskld__forma_de__pagamento.forma', 'Cartão de Débito').sum('vlr_receber'))
    })

    collect(response.data).each((elemento, indice) =>
    {
      moment(indice).isSame(moment(), 'day') ? labels.push('Hoje') : labels.push(moment(indice).format('D/MMM'));

      total.push(collect(elemento).sum('vlr_real'))
    })

    creatVisitsChart(labels, total, setacao);
  })
}

function formadorDataset(rotulacao, datacao)
{
  tudoaqui =
  {
    label: null,
    data: [],
    borderWidth: 1,
    backgroundColor: definiCor('x')
  }

  tudoaqui.label           = defineLabel(rotulacao);
  tudoaqui.data            = datacao.vlr_real;
  tudoaqui.borderWidth     = 1;
  tudoaqui.backgroundColor = definiCor(rotulacao);

  return tudoaqui;
}

function defineLabel(rotulacao)
{
  switch (rotulacao)
  {
    case 'credito':
      return 'Cartões de Crédito';
      break;
    case 'debito':
      return('Cartões de Débito');
      break;
    default:
      return(`ERRORA6s5a99X`); 
  }
}

function definiCor(rotulacao)
{
  switch (rotulacao)
  {
    case 'credito':
      return '#f36';
      break;
    case 'debito':
      return('#C3C');
      break;
    default:
      return(`ERRORA6s5a99X`); 
  }

  var cores = ["#f36", "#C3C", "#fc0", "#FC6", "#9C0", 'black', 'green', 'blue', 'orange' ];

  return cores[x];
}


function creatVisitsChart(labels, data, todosDados)
{
  var cores = ["#f36", "#C3C", "#fc0", "#FC6", "#9C0", 'black', 'green', 'blue', 'orange' ];
  var dataSetado = [];

  collect(todosDados).each(function(dados, rotulo)
  {
    // console.log(rotulo)
    // console.log(dados)
    console.log('============================================================================================================')
    dataSetado.push(formadorDataset(rotulo, dados))
  })
    console.log(dataSetado)

  // var todos_os_dados = credito;



        //   label: 'Cartão',
        // data: data,
        // borderWidth: 1,
        // backgroundColor: cores[0],

  var datared = [
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  ];
  var greenData = [
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  Math.random(),
  ];

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

// var visitsChart = new Chart (visitsCtx,
// {
//   type: 'bar',
//   data:
//   {
//     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//     datasets: [
//     {
//       label: '# of Votes',
//       data: [12, 19, 3, 5, 2, 3],
//       backgroundColor:
//       [
//         'rgba(255, 99, 132, 0.2)',
//         'rgba(54, 162, 235, 0.2)',
//         'rgba(255, 206, 86, 0.2)',
//         'rgba(75, 192, 192, 0.2)',
//         'rgba(153, 102, 255, 0.2)',
//         'rgba(255, 159, 64, 0.2)'
//         ],
//       borderColor:
//       [
//         'rgba(255, 99, 132, 1)',
//         'rgba(54, 162, 235, 1)',
//         'rgba(255, 206, 86, 1)',
//         'rgba(75, 192, 192, 1)',
//         'rgba(153, 102, 255, 1)',
//         'rgba(255, 159, 64, 1)'
//         ],
//       borderWidth: 1
//     }]
//   },
//   options:
//   {
//     scales:
//     {
//       y:
//       {
//         beginAtZero: true
//       }
//     },
//     legend:
//     {
//       display: true,
//       position: 'bottom',
//       labels:
//       {
//         color: 'rgb(255, 99, 132)'
//       }
//     }
//   }
// });

// function marcarVarios( status )
// {
//   let itens = document.getElementsByName('fin_receber_cartoes[]');

//   if(status)
//   {
//     $('#acao').html('<i class="far fa-fw fa-square" onclick="marcarVarios(false);"></i>');

//     fin_recebCartoes = [];
//     var i = 0;
//     for( i = 0 ; i < itens.length ; i++ )
//     {
//       itens[i].checked = status;
//       $('#linha_'+ itens[i].value).addClass("bg-pink");

//       let parcela = {
//         id          : itens[i].value,
//         valor       : parseFloat($(itens[i]).attr('data-valor')),
//         dt_prevista : $(itens[i]).attr('data-dt_prevista'),
//       };

//       fin_recebCartoes.push(parcela)      
//     }
//   }
//   else
//   {
//     $('#acao').html('<i class="far fa-fw fa-check-square" onclick="marcarVarios(true);"></i>');

//     var i = 0;
//     for( i = 0 ; i < itens.length ; i++ )
//     {
//       itens[i].checked = status;
//       $('#linha_'+ itens[i].value).removeClass("bg-pink");
//     }

//     fin_recebCartoes = [];
//   }

//   let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)

//   $('#vlr_final').val(total);

//   let JSONString = JSON.stringify(fin_recebCartoes);
//   $("#fin_recebCartoes").val(JSONString);
// }

function selectRow( id_campo )
{
  let row = $('#linha_'+ id_campo );

  if($(row).hasClass('bg-pink'))
  {
    row.removeClass("bg-pink");
    $('#check_'+ id_campo ).prop("checked", false)

    item = fin_recebCartoes.findIndex(val => val.id == id_campo);

    fin_recebCartoes.splice(item, 1);

    let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)
    $('#vlr_final').val(total);
  }
  else
  {
    row.addClass("bg-pink");
    $('#check_'+ id_campo ).prop("checked", true)

    let parcela = {
      id             : $('#check_'+ id_campo ).val(),
      dt_prevista    : $('#check_'+ id_campo ).attr('data-dt_prevista'),
      forma          : $('#check_'+ id_campo ).attr('data-forma'),
      bandeira       : $('#check_'+ id_campo ).attr('data-bandeira'),
      vlr_real       : parseFloat($('#check_'+ id_campo ).attr('data-vlr_real')),
      vlr_descontado : parseFloat($('#check_'+ id_campo ).attr('data-vlr_descontado')),
      prc_descontado : parseFloat($('#check_'+ id_campo ).attr('data-prc_descontado')),
      vlr_final      : parseFloat($('#check_'+ id_campo ).attr('data-vlr_final')),
    };

    fin_recebCartoes.push(parcela)      

    let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)
    $('#vlr_final').val(total);
  }

  let JSONString = JSON.stringify(fin_recebCartoes);
  $("#fin_recebCartoes").val(JSONString);
}

function selectCategoria( situacao, dt_prevista, forma, bandeira )
{
  let itens = $("[data-name='fin_receber_cartoes[]']");
  let status = true;
  // let status = $('#acao_' + dt_prevista).attr('data-status');

  var i = 0;
  for( i = 0 ; i < itens.length ; i++ )
  {
    let cartao = $(itens[i]);

    if (situacao == 'nivel_1')
    {
      if ( cartao.attr('data-dt_prevista') == dt_prevista )
      {
        itens[i].checked = status;
        $('#linha_'+ itens[i].value).addClass("bg-pink");
        atualizarArray ( itens[i].value )
      }
    }
    else if (situacao == 'nivel_2')
    {
      if ( cartao.attr('data-dt_prevista') == dt_prevista && cartao.attr('data-forma') == forma )
      {
        itens[i].checked = status;
        $('#linha_'+ itens[i].value).addClass("bg-pink");
        atualizarArray ( itens[i].value )
      }
    }
    else if (situacao == 'nivel_3')
    {
      if ( cartao.attr('data-dt_prevista') == dt_prevista && cartao.attr('data-forma') == forma && cartao.attr('data-bandeira') == bandeira )
      {
        itens[i].checked = status;
        $('#linha_'+ itens[i].value).addClass("bg-pink");
        atualizarArray ( itens[i].value )
      }
    }

    let JSONString = JSON.stringify(fin_recebCartoes, null, 4);
    $("#fin_recebCartoes").val(JSONString);
    document.getElementById("fin_recebCartoesdois").innerHTML = fin_recebCartoes;


    

  //     if( (cartao.attr('data-dt_prevista') == dt_prevista) || ( (forma != null ) && cartao.attr('data-forma') == forma) || ( (bandeira != null ) && cartao.attr('data-bandeira') == bandeira) )
  //     {
  //       itens[i].checked = true;
  //     }
  //     else
  //     {
  //       conso ('NAO')
  //     }
}

function atualizarArray ( id_campo )
{
  let parcela = {
    id             : $('#check_'+ id_campo ).val(),
    dt_prevista    : $('#check_'+ id_campo ).attr('data-dt_prevista'),
    forma          : $('#check_'+ id_campo ).attr('data-forma'),
    bandeira       : $('#check_'+ id_campo ).attr('data-bandeira'),
    vlr_real       : parseFloat($('#check_'+ id_campo ).attr('data-vlr_real')),
    vlr_descontado : parseFloat($('#check_'+ id_campo ).attr('data-vlr_descontado')),
    prc_descontado : parseFloat($('#check_'+ id_campo ).attr('data-prc_descontado')),
    vlr_final      : parseFloat($('#check_'+ id_campo ).attr('data-vlr_final')),
  };

  fin_recebCartoes.push(parcela) 
}
  // let status = $('#acao_' + dt_prevista).attr('data-status');
  // let itens = document.getElementsByName('fin_receber_cartoes[]');

  // if(status)
  // {
  //   $('#acao_'+dt_prevista).html('<i class="far fa-fw fa-check-square">');
  //   $('#acao_'+dt_prevista).attr('data-status', 'true');

  //   fin_recebCartoes = [];
  //   var i = 0;
  //   for( i = 0 ; i < itens.length ; i++ )
  //   {
  //     if( $(itens[i]).attr('data-dt_prevista') == dt_prevista )
  //     {
  //       itens[i].checked = status;
  //     }
  //     $('#linha_'+ itens[i].value).addClass("bg-pink");

  //     let parcela = {
  //       id          : itens[i].value,
  //       valor       : parseFloat($(itens[i]).attr('data-valor')),
  //       dt_prevista : $(itens[i]).attr('data-dt_prevista'),
  //     };

  //   //   fin_recebCartoes.push(parcela)      
  //   }
  // }
  // else
  // {
  //   $('#acao_'+dt_prevista).html('<i class="far fa-fw fa-square">');
  //   $('#acao_'+dt_prevista).attr('data-status', 'false');

  //   var i = 0;
  //   for( i = 0 ; i < itens.length ; i++ )
  //   {
  //     itens[i].checked = status;
  //     $('#linha_'+ itens[i].value).removeClass("bg-pink");
  //   }

  //   // fin_recebCartoes = [];
  // }

  // // let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)

  // // $('#vlr_final').val(total);


}
</script>
@endpush