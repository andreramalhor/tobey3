@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-7">
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
            <input type="text" class="form-control form-control-sm text-right" value="0,00" readonly="readonly">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Valores</h3>
      </div>
      <div class="card-body" style="padding-top: 0px">
        <div class="row">
          <div class="col-4">
            <label class="col-form-label">Total</label>
            <input type="text" class="form-control form-control-sm text-right" id="b_vlr_total" value="R$ {{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'), 2, ',', '.') }}" readonly="readonly">
          </div>
          <div class="col-4">
            <label class="col-form-label">Lançado</label>
            <input type="text" class="form-control form-control-sm text-right" id="b_vlr_lancado" value="R$ 0,00" readonly="readonly">
          </div>
          <div class="col-4">
            <label class="col-form-label">Restante</label>
            <input type="text" class="form-control form-control-sm text-right" id="b_vlr_restante" value="R$ {{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'), 2, ',', '.') }}" readonly="readonly">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-3">
    <div class="card">
      <div class="overlay" id="forma_pagamento_overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Formas de Pagamentos</h3>
      </div>
      <div class="card-body" style="padding-top: 0px">
        <div class="row">
          <div class="col-12">
            <label class="col-form-label">Forma de Pagamento</label>
            <select class="form-control form-control-sm" id="forma_pagamento" onchange="forma_pagamento_selecionado()" autofocus="autofocus">
              <option value="">Selecione...</option>
            </select>
          </div>
          <div class="col-7">
            <label class="col-form-label">Bandeira</label>
            <select class="form-control form-control-sm" id="nome_bandeira" onchange="bandeira_selecionado()" readonly="readonly">
              <option value=""></option>
            </select>
          </div>
          <div class="col-5">
            <label class="col-form-label">Parc.</label>
            <select class="form-control form-control-sm" id="qtd_parcelas" onchange="parcela_selecionado()" readonly="readonly">
              <option value=""></option>
            </select>
          </div>
          <div class="col-7">
            <label class="col-form-label">1º Vencimento</label>
            <input type="date" class="form-control form-control-sm" id="dt_vencimento" onchange="vencimento_selecionado()" readonly="readonly">
          </div>
          <div class="col-5">
            <label class="col-form-label">Valor</label>
            <input type="text" class="form-control form-control-sm text-right" id="valor" value="{{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'), 2, ',', '.') }}" onFocus="this.selectionStart = this.selectionEnd = this.value.length;" readonly="readonly">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-4">
            <a class="btn btn-block btn-default btn-sm" id="b_reset" onclick="reset()">Resetar</a>
          </div>
          <div class="col-8">
            <a class="btn btn-block btn-success btn-sm disabled" id="b_adicionar" onclick="adicionar()">Adicionar Pagamento</a>
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
          <tbody id="pagamentos-tabela"></tbody>
        </table>
      </div>
      <div class="card-footer">
        <a class="btn btn-danger btn-sm" href="{{ route('pdv.vendas') }}">Cancelar</a>
        <a class="btn btn-success btn-sm" id="btn_finalizar" style="display: none" onclick="pagamento_enviar()">Finalizar</button>
      </div>
    </div>
  </div>
</div>
@stop
  
@push('js')
<script type="text/javascript">
$(document).ready(function()
{
  fin_formas_pagamentos   = []
  fin_pagamento_escolhido = []
  formas_pagamentos_todos()

  $('#valor').mask('#.##0,00', {
    reverse: true,
    translation: {
      '#': {
        pattern: /-|\d/,
        recursive: true
      }
    },
    onChange: function(value, e)
    {
      e.target.value = value.replace(/(?!^)-/g, '').replace(/^,/, '').replace(/^-,/, '-')
    }
  })
  
  $("#p_resetar").click(function()
  {
    resetar()
  })
  
  $('input').keypress(function (e)
  {
    var code = null
    code = (e.keyCode ? e.keyCode : e.which)                
    return (code == 13) ? false : true
  })
})

function formas_pagamentos_todos()
{
  $("#forma_pagamento_overlay").show()
  
  axios.post('{{ route("sistema.list_FormasDePagamentos") }}')
  .then( function(response)
  {
    // console.log(response.data)
    fin_formas_pagamentos = collect(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '5545052a' ] )
  .then( function()
  {
    formas_pagamentos_mostrar()
  })
  .then( function()
  {
    setTimeout(function()
    {
      $('#forma_pagamento_overlay').hide()
    }, 500)
  })
}

function formas_pagamentos_mostrar()
{
  esc_formas = fin_formas_pagamentos.unique( item => item.forma )
  
  $("#forma_pagamento").empty().append("<option value=''>Selecione...</option>")
  esc_formas.each((item) =>
  {
    $("#forma_pagamento").append("<option value='"+item.forma+"'>"+item.forma+"</option>")
  })
}

function forma_pagamento_selecionado()
{
  esc_bandeiras = fin_formas_pagamentos.filter( (value, key) => value.forma == $('#forma_pagamento').val() ).unique( item => item.bandeira )

  $("#nome_bandeira").empty()
  esc_bandeiras.each((item) =>
  {
    $("#nome_bandeira").append("<option value='"+item.bandeira+"'>"+item.bandeira+"</option>")
  })
  $("#nome_bandeira").change()

  $('#nome_bandeira').attr({'readonly': ( esc_bandeiras.items.length == 1 ) })
}

function bandeira_selecionado()
{
  esc_parcelas = fin_formas_pagamentos.filter( (value, key) => (value.forma == $('#forma_pagamento').val()) && (value.bandeira == $('#nome_bandeira').val()) )

  $("#qtd_parcelas").empty()
  esc_parcelas.each((item) =>
  {
    $("#qtd_parcelas").append("<option value='"+item.parcela+"'>"+item.parcela+"</option>")
  })
  $("#qtd_parcelas").change()

  $('#qtd_parcelas').attr({'readonly': ( esc_parcelas.items.length == 1 ) })
  ajustar_valor()
}

function parcela_selecionado()
{
  sel_parcelas = fin_formas_pagamentos.filter( (value, key) => (value.forma == $('#forma_pagamento').val()) && (value.bandeira == $('#nome_bandeira').val()) && (value.parcela == $('#qtd_parcelas').val()) )

  data_ajustar( sel_parcelas )
  ajustar_valor()
}

function vencimento_selecionado()
{
  sel_vencimento = fin_formas_pagamentos.filter( (value, key) => (value.forma == $('#forma_pagamento').val()) && (value.bandeira == $('#nome_bandeira').val()) && (value.parcela ==  $('#qtd_parcelas').val()) )

  data_ajustar( sel_vencimento )
}

function data_ajustar( sel_parcelas )
{
  $("#dt_vencimento").attr({"readonly": true}).val(moment().add(sel_parcelas.items[0].pri_vcto, 'days').format('YYYY-MM-DD'))
  
  if ( sel_parcelas.items[0].tipo == "Prazo" && sel_parcelas.items[0].recebimento == "Manual" )
  {
    $("#dt_vencimento").attr({"readonly": false}).focus()
  }

  $("#valor").attr({"readonly": false})
}

indice = 1
function adicionar()
{
  fin_pagamento_escolhido = fin_formas_pagamentos.filter( (value, key) => (value.forma == $('#forma_pagamento').val()) && (value.bandeira == $('#nome_bandeira').val()) && (value.parcela == $('#qtd_parcelas').val()) )

  if (fin_pagamento_escolhido.items.length != 1)
  {
  }
  else
  {
    for( i=0 ; i < fin_pagamento_escolhido.all()[0].parcela ; i++ )
    {
      parcela =
      {
        'id_forma_pagamento'  : fin_pagamento_escolhido.items[0].id,
        'identificacao'       : 'linha_'+indice,
        'identificacao_x'     : 'linha_'+indice+"_"+i,
        'forma_pagamento'     : fin_pagamento_escolhido.items[0].forma,
        'bandeira'            : fin_pagamento_escolhido.items[0].bandeira,
        'tipo'                : fin_pagamento_escolhido.items[0].tipo,
        'valor'               : accounting.unformat($('#valor').val()) / fin_pagamento_escolhido.items[0].parcela,
        'parcela'             : ('00' + ( i + 1 )).slice(-2)+'/'+('00' + fin_pagamento_escolhido.items[0].parcela).slice(-2),
        'prazo'               : fin_pagamento_escolhido.items[0].prazo,
        'status'              : 'Aguardando Validação',
        'dt_prevista'         : datar( i, $('#dt_vencimento').val(), fin_pagamento_escolhido.items[0].pri_vcto ),       
        'acoes'               : '<a onclick="apagar(\'linha_'+indice+'\')"><span class="badge badge-danger"><i class="fas fa-times" aria-hidden="true"></i></span></a>',
      }
      
      pdv_comanda_pagamentos.push(parcela)   
    }
    indice++
  }
  tabela_atualizar()
  valor_atualizar()
  ajustar_valor()
}

function tabela_atualizar()
{
  $('#pagamentos-tabela').empty()
  
  $.each( pdv_comanda_pagamentos, function( key, pagamento )
  {
    $('#pagamentos-tabela').append(
      '<tr>'+
        '<td class="text-center">'+pagamento.forma_pagamento+'</td>'+
        '<td class="text-center">'+pagamento.bandeira+'</td>'+
        '<td class="text-center">'+pagamento.tipo+'</td>'+
        '<td class="text-center">'+accounting.formatMoney( pagamento.valor )+'</td>'+
        '<td class="text-center">'+pagamento.parcela+'</td>'+
        '<td class="text-center">'+moment(pagamento.dt_prevista).format('DD/MM/YYYY')+'</td>'+
        '<td class="text-center">'+pagamento.acoes+'</td>'+
      '</tr>'
    )
  })
}


// ====================================================================================================================================================

pdv_comanda_totais                = {}
pdv_comanda_totais.total_pedido   = parseFloat({{ $venda->dfyejmfcrkolqjh->sum('vlr_final') }})
pdv_comanda_totais.total_lancado  = 0
pdv_comanda_totais.vlr_restante   = pdv_comanda_totais.total_pedido - pdv_comanda_totais.total_lancado
pdv_comanda_totais.troco          = 0
pdv_comanda_totais.vale           = 0
pdv_comanda_totais.credito_casa   = 0

pdv_comanda_pagamentos = []

//   $('#nome_bandeira').attr({'readonly': true})
//   $('#qtd_parcelas').attr({'readonly': true}).val(1)
//   $('#dt_vencimento').attr({'readonly': true}).val(moment().format('YYYY-MM-DD'))
//   $('#prazo_entre').attr({'readonly': true})
//   $('#valor').attr({'readonly': true})
//   $('#qtd_parcelas').attr({'readonly': true})
//   $('#dt_vencimento').attr({'readonly': true}).val(moment().format('YYYY-MM-DD'))
//   $('#prazo_entre').attr({'readonly': true})
//   $('#valor').attr({'readonly': true})
//   $('#dt_vencimento').attr({'readonly': true}).val(moment().format('YYYY-MM-DD'))
//   $('#prazo_entre').attr({'readonly': true})
//   $('#valor').attr({'readonly': true})


$('#valor').bind('click keyup change' , ajustar_valor)
function ajustar_valor(e)
{
  if (e != undefined)
  {
    if(e.originalEvent.keyCode === 109 || e.originalEvent.keyCode === 189 || e.originalEvent.keyCode === 173)
    {
      $("#valor").attr({"readonly": false}).val(accounting.formatMoney( accounting.unformat($('#valor').val()) * -1 , '')).focus()
    }
    $("#valor").attr({"readonly": false}).val()
  }
  
  if (pdv_comanda_totais.vlr_restante == 0)
  {
    $('#valor').val(accounting.formatMoney( 0 , '').replace(/(?!^)-/g, '')).attr({"readonly": false}).val()
    $("#b_adicionar").addClass('disabled')
  }
  else
  {
    $("#b_adicionar").removeClass('disabled')
  }
  
  if( $("#forma_pagamento option:selected").val() == 'Outros' )
  {
    $("#b_adicionar").removeClass('disabled')
  }
}

function datar( i, dt_vencimento, prazo_entre )
{
  var prazo = i * prazo_entre
  
  if (i == 0)
  {
    data_retorno = moment(dt_vencimento).format('YYYY-MM-DD')
  }
  else
  {
    data_retorno = moment(dt_vencimento).add(prazo, 'days').format('YYYY-MM-DD')
  }
  
  return data_retorno
}

function apagar( index )
{
  item = pdv_comanda_pagamentos.findIndex(val => val.identificacao == index)
  
  while(item >= 0)
  {
    pdv_comanda_pagamentos.splice(item, 1)
    item = pdv_comanda_pagamentos.findIndex(val => val.identificacao == index)
  }
  
  tabela_atualizar()
  valor_atualizar()
  // resetar()
}

function valor_atualizar()
{
  let dinheiro        = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Dinheiro').reduce((anterior, atual) => anterior + atual.valor, 0)
  let cartao_debito   = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Cartão de Débito').reduce((anterior, atual) => anterior + atual.valor, 0)
  let cartao_credito  = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Cartão de Crédito').reduce((anterior, atual) => anterior + atual.valor, 0)
  let cheque          = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Cheque').reduce((anterior, atual) => anterior + atual.valor, 0)
  let deposito        = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Depósito').reduce((anterior, atual) => anterior + atual.valor, 0)
  let fiado           = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Fiado').reduce((anterior, atual) => anterior + atual.valor, 0)
  let credito_casa    = pdv_comanda_pagamentos.filter((dados) => dados.forma_pagamento === 'Conta Interna').reduce((anterior, atual) => anterior + atual.valor, 0)

  pdv_comanda_totais.total_lancado  = pdv_comanda_pagamentos.reduce((anterior, atual) => anterior + atual.valor, 0)
  pdv_comanda_totais.vlr_restante   = pdv_comanda_totais.total_pedido - pdv_comanda_totais.total_lancado

  // if(credito_casa > 0)
  // {
  // }
  // else
  // {
  // }

  // pdv_comanda_totais.troco          = 0
  // pdv_comanda_totais.vale           = 0
  // pdv_comanda_totais.credito_casa   = 0

  // console.log('----------------------------')
  // console.log(pdv_comanda_totais)
  // console.log('============================')


  //   if(pdv_comanda_totais.total_pedido >= pdv_comanda_totais.total_lancado) {
  //     $("#troco").val(accounting.formatMoney( 0)) )  //   } else {
  //     $("#troco").val(accounting.formatMoney( pdv_comanda_totais.total_lancado )- pdv_comanda_totais.total_pedido))
  //   }

  $("#b_vlr_total").val(accounting.formatMoney( pdv_comanda_totais.total_pedido ))
  $("#b_vlr_lancado").val(accounting.formatMoney( pdv_comanda_totais.total_lancado ))
  $("#b_vlr_restante").val(accounting.formatMoney( pdv_comanda_totais.vlr_restante , ''))

  if ( pdv_comanda_totais.vlr_restante == 0)
  {
    $("#btn_finalizar").show()
  }
  else
  {
    $("#btn_finalizar").hide()
  }
}

function pagamento_enviar()
{
  url = "{{ route('pdv.vendas.pago', ':id' ) }}"
  url = url.replace(':id', {{ $venda->id }} )
 
  axios.post(url, pdv_comanda_pagamentos)
  .then( function(response)
  {
    console.log(response.data)
    toastrjs(response.data.type, response.data.message)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '9214793a' ] )
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endpush
