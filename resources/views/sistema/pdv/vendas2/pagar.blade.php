@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('pdv.vendas.registrar') }}" id="form_venda_create" autocomplete="off">
  @csrf
  <input type="hidden" name="pdv_comanda" id="pdv_comanda" value={{ json_encode($venda) }}>
  <input type="hidden" name="pdv_comanda_detalhes" id="pdv_comanda_detalhes" value={{ json_encode($venda->dfyejmfcrkolqjh) }}>
  <input type="hidden" name="pdv_comanda_pagamentos" id="pdv_comanda_pagamentos">
  <div class="row">
    <div class="col-7" id="box_cliente">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cliente</h3>
        </div>
        <div class="card-body" style="padding-top: 0px">
          <div class="row">
            <div class="col-2">
              <label class="col-form-label">#ID</label>
              <input type="text" class="form-control form-control-sm" value="{{ $venda->id_cliente ?? '#id' }}" readonly="readonly">
            </div>
            <div class="col-8">
              <label class="col-form-label">Nome</label>
              <input type="text" class="form-control form-control-sm" value="{{ $venda->lufqzahwwexkxli->nome ?? $venda->id_cliente ?? 'Nome Cliente' }} ( {{ $venda->lufqzahwwexkxli->apelido ?? '' }} )" readonly="readonly">
            </div>
            <div class="col-2">
              <label class="col-form-label">Saldo Cliente</label>
              <input type="text" class="form-control form-control-sm text-right" value="10.000,00" readonly="readonly">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-5" id="box_valores">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Valores</h3>
        </div>
        <div class="card-body" style="padding-top: 0px">
          <div class="row">
            <div class="col-4">
              <label class="col-form-label">Total</label>
              <input type="text" class="form-control form-control-sm text-right" id="b_vlr_total" value="R$ {{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'),2,",",".") }}" readonly="readonly">
            </div>
            <div class="col-4">
              <label class="col-form-label">Lançado</label>
              <input type="text" class="form-control form-control-sm text-right" id="b_vlr_lancado" value="R$ 0,00" readonly="readonly">
            </div>
            <div class="col-4">
              <label class="col-form-label">Restante</label>
              <input type="text" class="form-control form-control-sm text-right" id="b_vlr_restante" value="R$ {{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'),2,",",".") }}" readonly="readonly">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-3" id="box_forma_pagamento">
      <div class="card">
        <div class="overlay" id="overlay_forma_pagamento">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Formas de Pagamentos</h3>
        </div>
        <div class="card-body" style="padding-top: 0px">
          <div class="row">
            <div class="col-12">
              <label class="col-form-label">Forma de Pagamento</label>
              <select class="form-control form-control-sm" id="forma_pagamento" onchange="formaDePagamento()" autofocus="autofocus">
                <option value="">Selecione...</option>
              </select>
            </div>
            <div class="col-7">
              <label class="col-form-label">Bandeira</label>
              <select class="form-control form-control-sm" id="nome_bandeira" onchange="nomeBandeira()" readonly="readonly">
                <option value=""></option>
              </select>
            </div>
            <div class="col-5">
              <label class="col-form-label">Parc.</label>
              <select class="form-control form-control-sm" id="qtd_parcelas" onchange="qtdParcelas()" readonly="readonly">
                <option value=""></option>
              </select>
            </div>
            <div class="col-7">
              <label class="col-form-label">1º Vencimento</label>
              <input type="date" class="form-control form-control-sm" id="dt_vencimento" readonly="readonly">
            </div>
            <div class="col-5">
              <label class="col-form-label">Valor</label>
              <input type="text" class="form-control form-control-sm text-right" id="valor" value="{{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'),2,",",".") }}" onFocus="this.selectionStart = this.selectionEnd = this.value.length;" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-4">
              <a class="btn btn-default btn-sm" id="b_reset" style="width: 100%;">Resetar</a>
            </div>
            <div class="col-8">
              <a class="btn btn-success btn-sm disabled" id="b_adicionar" style="width: 100%;color:white;">Adicionar Pagamento</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-9" id="box_pagamentos">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pagamentos</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-bordered table-condensed table-sm">
            <thead>
              <tr style="background-color: #222d32; color: white;">
                <th class="text-center">Forma de Pagamento</th>
                <th class="text-center">Bandeira</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Parcela</th>
                <th class="text-center">Dt Prevista</th>
                <th class="text-center text-nowrap"><i class="fas fa-ellipsis-h"></i></th>
              </tr>
            </thead>
            <tbody id="table-pagamentos">
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <a class="btn btn-danger btn-sm" href="{{ route('pdv.vendas.index') }}">Cancelar</a>
          <button type="submit" id="btn_finalizar" class="btn btn-success btn-sm" style="display: none">Finalizar</button>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@push('js')
<script type="text/javascript">
  $(document).ready(function(){
    pesquisarFormasDePagamentos()

    $('#valor').mask('#.##0,00', {
      reverse: true,
      translation: {
        '#': {
          pattern: /-|\d/,
          recursive: true
        }
      },
      onChange: function(value, e) {
        e.target.value = value.replace(/(?!^)-/g, '').replace(/^,/, '').replace(/^-,/, '-');
      }
    });

    $("#b_adicionar").click(function() {
      adicionar();
    });

    $("#p_resetar").click(function() {
      resetar();
    });

    $('input').keypress(function (e) {
      var code = null;
      code = (e.keyCode ? e.keyCode : e.which);                
      return (code == 13) ? false : true;
    });
  });

  pdv_comanda_totais                = {};
  pdv_comanda_totais.total_pedido   = parseFloat({{ $venda->dfyejmfcrkolqjh->sum('vlr_final') }});
  pdv_comanda_totais.total_lancado  = 0;
  pdv_comanda_totais.vlr_restante   = pdv_comanda_totais.total_pedido - pdv_comanda_totais.total_lancado;
  pdv_comanda_totais.troco          = 0;
  pdv_comanda_totais.vale           = 0;
  pdv_comanda_totais.credito_casa   = 0;

  pdv_comanda_pagamentos = [];

  pagamento_escolhido            = {};
  pagamento_escolhido.distinct   = 'forma';
  pagamento_escolhido.forma      = null;
  pagamento_escolhido.bandeira   = null;
  pagamento_escolhido.parcela    = null;
  pagamento_escolhido.prazo      = null;

  function formaDePagamento() {
    pagamento_escolhido.distinct     = 'bandeira';
    pagamento_escolhido.forma        = $('#forma_pagamento').val();
    pagamento_escolhido.bandeira     = null;
    pagamento_escolhido.parcela      = null;
    pagamento_escolhido.prazo        = null;

    $('#nome_bandeira').attr({'readonly': true});
    $('#qtd_parcelas').attr({'readonly': true}).val(1);
    $('#dt_vencimento').attr({'readonly': true}).val(moment().format('YYYY-MM-DD'));
    $('#prazo_entre').attr({'readonly': true});
    $('#valor').attr({'readonly': true});

    pesquisarFormasDePagamentos()
  }

  function nomeBandeira() {
    pagamento_escolhido.distinct     = 'parcela';
    pagamento_escolhido.forma        = $('#forma_pagamento').val();
    pagamento_escolhido.bandeira     = $('#nome_bandeira').val();
    pagamento_escolhido.parcela      = null;
    pagamento_escolhido.prazo        = null;

    $('#qtd_parcelas').attr({'readonly': true});
    $('#dt_vencimento').attr({'readonly': true}).val(moment().format('YYYY-MM-DD'));
    $('#prazo_entre').attr({'readonly': true});
    $('#valor').attr({'readonly': true});

    pesquisarFormasDePagamentos()
  };

  function qtdParcelas() {
    pagamento_escolhido.distinct     = 'prazo';
    pagamento_escolhido.forma        = $('#forma_pagamento').val();
    pagamento_escolhido.bandeira     = $('#nome_bandeira').val();
    pagamento_escolhido.parcela      = $('#qtd_parcelas').val();
    pagamento_escolhido.prazo        = null;

    $('#dt_vencimento').attr({'readonly': true}).val(moment().format('YYYY-MM-DD'));
    $('#prazo_entre').attr({'readonly': true});
    $('#valor').attr({'readonly': true});

    pesquisarFormasDePagamentos()
    ajustarData()
  };

  function ajustarData() {
    $("#dt_vencimento").attr({"readonly": true}).val(moment().add(todosPagamentos[0].pri_vcto, 'days').format('YYYY-MM-DD'));

    if ( todosPagamentos[0].tipo == "Prazo" && todosPagamentos[0].recebimento == "Manual" )
    {
      $("#dt_vencimento").attr({"readonly": false}).focus();
    }
    ajustar_valor()
  }

  $('#valor').bind('click keyup change' , ajustar_valor);
  function ajustar_valor(e) {
    let valor_lanc = $('#valor').val();
    let valor_real = valor_lanc.replace(/[^\.^\,^\d,/-]/g, "").replace(".","").replace(",",".");
    
    if (valor_real == 0)
    {
      $('#valor').val('')
    }

    if (e == undefined)
    {
      $("#valor").attr({"readonly": false}).val(parseFloat(pdv_comanda_totais.vlr_restante).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString()).focus();
    }
    else
    {
      if(e.originalEvent.keyCode === 109 || e.originalEvent.keyCode === 189)
    // if(e.originalEvent.keyCode === 109 || e.originalEvent.keyCode === 189 || e.originalEvent.keyCode === 173)
  {
    valor_real = valor_real * -1
    $("#valor").val(parseFloat(valor_real).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.').toString()).focus();
  }
  $("#valor").attr({"readonly": false}).val();
}
$("#b_adicionar").removeClass('disabled');
}

indice = 1;
function adicionar()
{
  let valor_lanc = $('#valor').val();
  let valor_real = valor_lanc.replace(/[^\.^\,^\d,/-]/g, "").replace(".","").replace(",",".");

  if (todosPagamentos.length > 1)
  {
    alert('selecionar mais')
  }
  else
  {
    for( i=0 ; i < todosPagamentos[0].parcela ; i++ )
    {
      pagamento =
      {
        'id_forma_pagamento'  : todosPagamentos[0].id,
        'identificacao'       : 'linha_'+indice,
        'identificacao_x'     : 'linha_'+indice+"_"+i,
        'forma_pagamento'     : todosPagamentos[0].forma,
        'bandeira'            : todosPagamentos[0].bandeira,
        'tipo'                : todosPagamentos[0].tipo,
        'valor'               : parseFloat(valor_real / todosPagamentos[0].parcela),
        'd_valor'             : reais(parseFloat(valor_real / todosPagamentos[0].parcela)),
        'parcela'             : ('00' + ( i + 1 )).slice(-2)+'/'+('00' + todosPagamentos[0].parcela).slice(-2),
        'prazo'               : todosPagamentos[0].prazo,
        'status'              : 'Aguardando Validação',
        'dt_recebimento'      : datar( i, $('#dt_vencimento').val(), todosPagamentos[0].pri_vcto ),
        'd_dt_recebimento'    : moment(datar( i, $('#dt_vencimento').val(), todosPagamentos[0].pri_vcto )).format('DD/MM/YYYY'),      
        'acoes'               : '<a onclick="apagar(\'linha_'+indice+'\');"><span class="badge badge-danger"><i class="fas fa-times" aria-hidden="true"></i></span></a>',
      };
      
      pdv_comanda_pagamentos.push(pagamento);
    }
    indice++;
  }
  atualizarTabela();
  atualizaValor();

  $("#forma_pagamento").val(null).change();
  $('#nome_bandeira').attr({'readonly': true});
}

function datar( i, dt_vencimento, prazo_entre )
{
  var prazo = i * prazo_entre;

  if (i == 0)
  {
    data_retorno = moment(dt_vencimento).format('YYYY-MM-DD');
  }
  else
  {
    data_retorno = moment(dt_vencimento).add(prazo, 'days').format('YYYY-MM-DD');
  }

  return data_retorno;
}

function reais( valor )
{
  return valor.toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });
}

function apagar( index )
{
  item = pdv_comanda_pagamentos.findIndex(val => val.identificacao == index);
    // pdv_comanda_pagamentos.splice(item, 1);

    while(item >= 0)
    {
      pdv_comanda_pagamentos.splice(item, 1);
      item = pdv_comanda_pagamentos.findIndex(val => val.identificacao == index);
    }

    atualizarTabela();
    atualizaValor();
  // resetar();
}



function atualizaValor()
{
  let dinheiro        = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Dinheiro').reduce((anterior, atual) => anterior + atual.valor, 0)
  let cartao_debito   = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Cartão de Débito').reduce((anterior, atual) => anterior + atual.valor, 0)
  let cartao_credito  = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Cartão de Crédito').reduce((anterior, atual) => anterior + atual.valor, 0)
  let cheque          = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Cheque').reduce((anterior, atual) => anterior + atual.valor, 0)
  let deposito        = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Depósito').reduce((anterior, atual) => anterior + atual.valor, 0)
  let fiado           = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Fiado').reduce((anterior, atual) => anterior + atual.valor, 0)
  let credito_casa    = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Conta Interna').reduce((anterior, atual) => anterior + atual.valor, 0);

  pdv_comanda_totais.total_lancado  = pdv_comanda_pagamentos.reduce((anterior, atual) => anterior + atual.valor, 0);
  pdv_comanda_totais.vlr_restante   = pdv_comanda_totais.total_pedido - pdv_comanda_totais.total_lancado;

  if(credito_casa > 0) {

  } else {

  }

  pdv_comanda_totais.troco          = 0;
  pdv_comanda_totais.vale           = 0;
  pdv_comanda_totais.credito_casa   = 0;

  // console.log('----------------------------')
  // console.log(pdv_comanda_totais)
  // console.log('============================')


  //   if(pdv_comanda_totais.total_pedido >= pdv_comanda_totais.total_lancado) {
  //     $("#troco").val(reais(0));
  //   } else {
  //     $("#troco").val(reais(pdv_comanda_totais.total_lancado - pdv_comanda_totais.total_pedido));
  //   }

  $("#b_vlr_total").val(reais(pdv_comanda_totais.total_pedido));
  $("#b_vlr_lancado").val(reais(pdv_comanda_totais.total_lancado));
  $("#b_vlr_restante").val(reais(pdv_comanda_totais.vlr_restante));

  if ( pdv_comanda_totais.vlr_restante < 0.01 && pdv_comanda_totais.vlr_restante > -0.01 ) {
    $("#btn_finalizar").show();
  } else {
    $("#btn_finalizar").hide();
  }

  var JSONString = JSON.stringify(pdv_comanda_pagamentos);
  $("#pdv_comanda_pagamentos").val(JSONString);
}

// $('#table-pagamentos').DataTable({
//   processing: true,
//   serverSide: false,
//   paging: false,
//   bFilter: false,
//   bInfo: false,
//   ordering: false,
//   // autoWidth: true,
//   data: pdv_comanda_pagamentos,
//   columns: [
//   {data: 'forma_pagamento',   name: 'forma_pagamento',   class: 'text-center', orderable: false, searchable: false },
//   {data: 'bandeira',          name: 'bandeira',          class: 'text-center', orderable: false, searchable: false },
//   {data: 'tipo',              name: 'tipo',              class: 'text-center', orderable: false, searchable: false },
//   {data: 'd_valor',           name: 'd_valor',           class: 'text-center', orderable: false, searchable: false },
//   {data: 'parcela',           name: 'parcela',           class: 'text-center', orderable: false, searchable: false },
//   {data: 'd_dt_recebimento',  name: 'd_dt_recebimento',  class: 'text-center', orderable: false, searchable: false },
//   {data: 'acoes',             name: 'acoes',             class: 'text-center', orderable: false, searchable: false },
//   ],
//   "language": {
//     "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
//   },
// });

function atualizarTabela()
{
  $('#table-pagamentos').empty();

  $.each( pdv_comanda_pagamentos, function( key, pagamento ) {
  $('#table-pagamentos').append(
    '<tr>'+
      '<td class="text-center">'+pagamento.forma_pagamento+'</td>'+
      '<td class="text-center">'+pagamento.bandeira+'</td>'+
      '<td class="text-center">'+pagamento.tipo+'</td>'+
      '<td class="text-center">'+pagamento.d_valor+'</td>'+
      '<td class="text-center">'+pagamento.parcela+'</td>'+
      '<td class="text-center">'+pagamento.d_dt_recebimento+'</td>'+
      '<td class="text-center">'+pagamento.acoes+'</td>'+
    '</tr>'
    );
  });
}

function pesquisarFormasDePagamentos()
{
  $("#overlay_forma_pagamento").show();

  axios.post('{{ route("sistema.list_FormasDePagamentos") }}', pagamento_escolhido)
  .then( function(response) {
    // console.log(response)
    todosPagamentos = response.data;

    switch (pagamento_escolhido.distinct) {
      case 'forma':
      result = Array.from(new Set(todosPagamentos.map(s=>s.forma)))

      .map(forma => {
        return {
          id          : todosPagamentos.find(s=> s.forma === forma).id,
          forma       : forma,
          tipo        : todosPagamentos.find(s=> s.forma === forma).tipo,
          bandeira    : todosPagamentos.find(s=> s.forma === forma).bandeira,
          parcela     : todosPagamentos.find(s=> s.forma === forma).parcela,
          taxa        : todosPagamentos.find(s=> s.forma === forma).taxa,
          prazo       : todosPagamentos.find(s=> s.forma === forma).prazo,
          recebimento : todosPagamentos.find(s=> s.forma === forma).recebimento,
        };
      });

      $("#forma_pagamento").empty();
      $("#forma_pagamento").append("<option value=''>Selecione...</option>");
      $.each( result, function( key, value ) {
        $("#forma_pagamento").append("<option value='"+value.forma+"'>"+value.forma+"</option>");
      });
      break;

      case 'bandeira':
      result = Array.from(new Set(todosPagamentos.map(s=>s.bandeira)))
      .map(bandeira => {
        return {
          id            : todosPagamentos.find(s=> s.bandeira === bandeira).id,
          forma         : todosPagamentos.find(s=> s.bandeira === bandeira).forma,
          tipo          : todosPagamentos.find(s=> s.bandeira === bandeira).tipo,
          bandeira      : bandeira,
          parcela       : todosPagamentos.find(s=> s.bandeira === bandeira).parcela,
          taxa          : todosPagamentos.find(s=> s.bandeira === bandeira).taxa,
          prazo         : todosPagamentos.find(s=> s.bandeira === bandeira).prazo,
          recebimento   : todosPagamentos.find(s=> s.bandeira === bandeira).recebimento,
        };
      });

      $("#nome_bandeira").empty();
      if (result.length < 2) {
        $.each( result, function( key, value ) {
          $("#nome_bandeira").append("<option selected value='"+value.bandeira+"'>"+value.bandeira+"</option>");
        });
        $("#nome_bandeira").attr({"readonly": true});
        $("#nome_bandeira").change();
        pesquisarFormasDePagamentos();
      } else {
        $("#nome_bandeira").append("<option value=''>Selecione...</option>");
        $.each( result, function( key, value ) {
          $("#nome_bandeira").append("<option value='"+value.bandeira+"'>"+value.bandeira+"</option>");
        });
        $("#nome_bandeira").attr({"readonly": false}).focus();
      }
      break;

      case 'parcela':
      result = Array.from(new Set(todosPagamentos.map(s=>s.parcela)))
      .map(parcela => {
        return {
          id            : todosPagamentos.find(s=> s.parcela === parcela).id,
          forma         : todosPagamentos.find(s=> s.parcela === parcela).forma,
          tipo          : todosPagamentos.find(s=> s.parcela === parcela).tipo,
          bandeira      : todosPagamentos.find(s=> s.parcela === parcela).bandeira,
          parcela       : parcela,
          taxa          : todosPagamentos.find(s=> s.parcela === parcela).taxa,
          prazo         : todosPagamentos.find(s=> s.parcela === parcela).prazo,
          recebimento   : todosPagamentos.find(s=> s.parcela === parcela).recebimento,
        };
      });

      $("#qtd_parcelas").empty();
      if (result.length < 2) {
        $.each( result, function( key, value ) {
          $("#qtd_parcelas").append("<option selected value='"+value.parcela+"'>"+value.parcela+"</option>");
        });
        $("#qtd_parcelas").attr({"readonly": true});
        $("#qtd_parcelas").change();
        pesquisarFormasDePagamentos();
      } else {
        $("#qtd_parcelas").append("<option value=''>Selecione...</option>");
        $.each( result, function( key, value ) {
          if( key == 0 ) {
            $("#qtd_parcelas").append("<option selected value='"+value.parcela+"'>"+value.parcela+"</option>");
          } else {
            $("#qtd_parcelas").append("<option value='"+value.parcela+"'>"+value.parcela+"</option>");
          }
        });
        $("#qtd_parcelas").attr({"readonly": false}).focus();
        $("#qtd_parcelas").change();
        pesquisarFormasDePagamentos();
      }
      break;

      case 'prazo':
      if(todosPagamentos.length == 1 && todosPagamentos[0].tipo == 'Prazo' && todosPagamentos[0].recebimento == 'Manual') {
        $("#dt_vencimento").attr({"readonly": false}).focus();
        $("#valor").attr({"readonly": false});
      } else {
        $("#iddaforma").val('ERRO');
      }
      break;
      
      default:
    }
  })
@include('includes.catch', [ 'codigo_erro' => '4425886a' ] )
.then( function()
{
  setTimeout(function()
  {
    $('#overlay_forma_pagamento').hide();
  }, 500);
})
};
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush