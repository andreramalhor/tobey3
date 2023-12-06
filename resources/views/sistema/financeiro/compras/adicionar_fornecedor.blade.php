@extends('layouts.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dados da Compra</h1>
      </div>
{{--       <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Widgets</li>
        </ol>
      </div> --}}
    </div>
  </div>
</section>
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Compras</h3>
      </div>
      <div class="card-body">
        <div id="stepper1" class="bs-stepper">
          <div class="bs-stepper-header" role="tablist">
            <div class="step active" data-bs-target="#test-l-1">
              <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1" aria-selected="true">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Fornecedor</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-bs-target="#test-l-2">
              <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2" aria-selected="false" disabled="disabled">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Produtos</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-bs-target="#test-l-3">
              <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3" aria-selected="false" disabled="disabled">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Detalhes</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-bs-target="#test-l-4">
              <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4" aria-selected="false" disabled="disabled">
                <span class="bs-stepper-circle">4</span>
                <span class="bs-stepper-label">Pagamento</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content">
            <form id="formulario_geral" onsubmit="return false">  @csrf
              <div id="test-l-1" role="tabpanel" class="bs-stepper-pane active dstepper-block" aria-labelledby="stepper1trigger1">
                <div class="form-group">
                  <label for="id_fornecedor">Fornecedor</label>
                  <select class="form-control form-control-sm select2" id="id_fornecedor" name="dados_compra[id_fornecedor]">
                    <option>Carregando</option>
                  </select>
                </div>
                <a href="{{ route('fin.compras') }}" class="btn btn-primary float-start">Cancelar</a>
                <button type="button" class="btn btn-primary float-end" onclick="produtos_foreach()">Próximo</button>
                <br>
              </div>
              <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                <input type="hidden" name="dados_produtos" id="dados_produtos">
                <div class="section" id="foreach-produtos">
                  Carregando . . .
                </div>
                <button type="button" class="btn btn-primary float-start" onclick="stepper1.previous()">Anterior</button>
                <button type="button" class="btn btn-primary float-end" onclick="stepper1.next()">Próximo</button>
                <br>
              </div>
              <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                <div class="row">
                  <div class="col-3">
                    <label class="col-form-label">Data do pedido</label>
                    <input type="date" class="form-control form-control-sm" name="dados_compra[dt_pedido]" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                  </div>
                  <div class="col-3">
                    <label class="col-form-label">Data do Prevista</label>
                    <input type="date" class="form-control form-control-sm" name="dados_compra[dt_nascimento]" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                  </div>
                  <div class="col-2">
                    <label class="col-form-label">Qtd de Produtos</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" name="dados_compra[total_qtd_compra]" id="total_qtd_compra" value="0" readonly>
                  </div> 
                  <div class="col-2">
                    <label class="col-form-label">Qtd de Itens</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" name="dados_compra[total_itens_compra]" id="total_itens_compra" value="0" readonly>
                  </div> 

                  <div class="col-2">
                    <label class="col-form-label">Valor da Compra</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" name="dados_compra[total_custo_compra]" id="total_custo_compra" value="0,00" onchange="calc_vlr_total_da_compra()">
                  </div>  

                  <div class="col-2">
                    <label class="col-form-label">Frete</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" name="dados_compra[vlr_frete]" id="vlr_frete" value="0,00" onchange="calc_vlr_total_da_compra()">
                  </div>  

                  <div class="col-2">
                    <label class="col-form-label">Outros custos</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" name="dados_compra[vlr_outros_custos]" id="vlr_outros_custos" value="0,00" onchange="calc_vlr_total_da_compra()">
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Valor Total</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" name="dados_compra[vlr_total_compra]" id="vlr_total_compra" value="0,00" onchange="calc_vlr_total_da_compra()">
                  </div>
                </div>

                <button type="button" class="btn btn-primary float-start" onclick="stepper1.previous()">Anterior</button>
                <button type="button" class="btn btn-primary float-end" onclick="stepper1.next()">Próximo</button>
                <br>
              </div>
              <div id="test-l-4" role="tabpanel" class="bs-stepper-pane text=center" aria-labelledby="stepper1trigger4">
                <div class="row">

                  <div class="col-2">
                    <label class="col-form-label">Valor Restante</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" id="vlr_geral_compra" value="0" readonly>
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Valor da Parcela</label>
                    <input type="text" class="form-control form-control-sm text-right n_decimal" id="vlr_parcela" value="0">
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Data de Vencimento</label>
                    <input type="date" class="form-control form-control-sm" id="x_dt_vencimento" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Forma de Pagamento</label>
                    <select class="form-control form-control-sm" id="forma_de_pagamento" style="margin: 2px 0px">
                      <option value="">Tipo de Faturamento</option>
                      <option value="Boleto" selected="selected">Boleto</option>
                      <option value="Dinheiro">Dinheiro</option>
                      <option value="Cartão de Crédito">Cartão de Crédito</option>
                      <option value="Cartão de Débito">Cartão de Débito</option>
                      <option value="Cheque">Cheque</option>
                      <option value="Depósito em Conta">Depósito em Conta</option>
                      <option value="Nota Promissória">Nota Promissória</option>
                      <option value="Outros">Outros</option>
                    </select>
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Data de Vencimento</label>
                    <input type="date" class="form-control form-control-sm" id="x_dt_vencimento" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                  </div>

                  <div class="col-1">
                    <label class="col-form-label">Ações</label>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm" id="adicionar_parcela">
                        <i style="width: 10.5px;" class="fa fa-plus"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-sm" onclick="limpar_campos()">
                        <i style="width: 10.5px;" class="fa fa-undo"></i>
                      </button>
                    </div>
                  </div>

                </div>

                <hr>
                
                <div class="box-body" id="dtl_parcelas"></div>
                

                <button type="button" class="btn btn-primary mt-5 float-start" onclick="stepper1.previous()">Anterior</button>
                <button type="button" class="btn btn-primary mt-5 float-end" id="enviar_informacoes">Concluir</button>
                <br>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-footer">
        Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    stepper1 = new Stepper(document.querySelector('#stepper1'))
    fornecedores_foreach()

    $('.n_decimal').mask('#.##0,00', {
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
  });

  function fornecedores_foreach()
  {
    $('#overlay-fornecedores').show();
    
    var url = "{{ route('atd.pessoas.listar_fornecedores', ':tp') }}"
    var url = url.replace(':tp', "mode==&tp=Fornecedor")

    axios.get(url)
    .then( function(response)
    {
      // console.log(response.data)
      collect(response.data).sortBy('nome').each((data) =>
      {
        $("#id_fornecedor").append('<option value="'+data.id+'">'+data.nome+'</option>')
      })
    })
@include('includes.catch', [ 'codigo_erro' => '3416819a' ] )
    .then( function()
    {
      $("#overlay-fornecedor").hide()
    })
  }

  function produtos_foreach()
  {
    $('#overlay-produtos').show();

    axios.get("{{ route('cat.produtos.listar_compras') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#foreach-produtos').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '5476084a' ] )
    .then( function(response)
    {
      $('#overlay-produtos').hide();
      stepper1.next()
    })
  }

  function menos( id_qnt ) 
  {
    var qnt = parseInt( document.getElementById('qtd_['+id_qnt+']').value );
    if( qnt > 0 )
    {
      document.getElementById('qtd_['+id_qnt+']').value = qnt - 1; 
    }

    var vlr_unitario_text = document.getElementById('vlr_unitario_['+id_qnt+']').innerHTML;
    var vlr_unitario = parseFloat(vlr_unitario_text.replace("R$ ", "").replace(".", "").replace(",", ".")).toFixed(2);

    var vlr_total = vlr_unitario * qnt;
    document.getElementById('total_['+id_qnt+']').innerHTML = 'Total: '+(vlr_total).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });
    // calc_total();
  } 

  function mais( id_qnt )
  {
    var qtd = document.getElementById('qtd_['+id_qnt+']').value = parseInt( document.getElementById('qtd_['+id_qnt+']').value ) + 1;

    var vlr_unitario_text = document.getElementById('vlr_unitario_['+id_qnt+']').innerHTML;
    var vlr_unitario = parseFloat(vlr_unitario_text.replace("R$ ", "").replace(".", "").replace(",", ".")).toFixed(2);
    
    var vlr_total = vlr_unitario * qtd;
    document.getElementById('total_['+id_qnt+']').innerHTML = 'Total: '+(vlr_total).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });

    // calc_total();
  }

  function calc_total()
  {
    var aberto = parseFloat(document.getElementById('vlr_abertura').value).toFixed(2);
    var saldo_final = parseFloat(document.getElementById('vlr_atual').value).toFixed(2);

    var total = parseFloat(
      (nota200  = $('#nota200').val()  * 200)  +
      (nota100  = $('#nota100').val()  * 100)  +
      (nota50   = $('#nota50').val()   * 50)   +
      (nota20   = $('#nota20').val()   * 20)   +
      (nota10   = $('#nota10').val()   * 10)   +
      (nota5    = $('#nota5').val()    * 5)    +
      (nota2    = $('#nota2').val()    * 2)    +
      (moeda100 = $('#moeda100').val() * 1.00) +
      (moeda50  = $('#moeda50').val()  * 0.50) +
      (moeda25  = $('#moeda25').val()  * 0.25) +
      (moeda10  = $('#moeda10').val()  * 0.10) +
      (moeda5   = $('#moeda5').val()   * 0.05) +
      (moeda1   = $('#moeda1').val()   * 0.01)).toFixed(2)

    
    $("#vlr_fechamento").val(total);

    var tot = document.getElementById("total").innerHTML =           (total-0).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });
    var res = document.getElementById("resto").innerHTML = (saldo_final-total).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });

    if (   ( parseFloat(saldo_final) - parseFloat(total) ) == 0   )
    {
      $("#btn_fechar").show();
    }
    else
    {
      $("#btn_fechar").hide();
    }
  }

  function fornecedor_proximo()
  {
    var fornecedores = $('#form_fornecedor').serialize();

    axios.post("{{ route('fin.compras.create2') }}", fornecedores)
    .then( function(response)
    {
      // console.log(response)
      window.location.href = response.data.redirect
    })
@include('includes.catch', [ 'codigo_erro' => '5032550a' ] )
    .then( function()
    {
      // alert('s')
      // $("#cancelar_criacao_tarefa").click();
      // $('#overlay_tasks').hide();
    })
  }

  function calc_vlr_total_da_compra()
  {
    var total_custo_compra  = accounting.unformat($('#total_custo_compra').val());
    var vlr_frete           = accounting.unformat($('#vlr_frete').val());
    var vlr_outros_custos   = accounting.unformat($('#vlr_outros_custos').val());
    var vlr_total_compra    = accounting.unformat($('#vlr_total_compra').val());

    var vlr_total_da_compra = total_custo_compra + vlr_frete + vlr_outros_custos + vlr_total_compra;

    $('#vlr_geral_compra').val(accounting.formatMoney(vlr_total_da_compra, ""));
    $('#vlr_parcela').val(accounting.formatMoney(vlr_total_da_compra, ""));
  }

  var parcela = 0;
  $("#adicionar_parcela").click(function(event)
  {
    adicionar_menu();
    adicionar_parcelas();
  });

  function limpar_campos()
  {
    $("#dtl_parcelas").empty();
    $('#btn_avancar').hide();
    calc_vlr_total_da_compra();
    parcela = 0;
  }

  function adicionar_menu()
  {
    if ( parcela == 0 )
    {
      var linha =
      '<div class="row">'+
      '<div class="col-md-1 form-group" id="l_parcela">'+
      '<label for="l_parcela">Parcela</label>'+
      '</div>'+
      '<div class="col-md-2 form-group" id="l_tipo">'+
      '<label for="l_tipo">Tipo</label>'+
      '</div>'+
      '<div class="col-md-2 form-group" id="l_dt_vcto">'+
      '<label for="l_dt_vcto">Data de Vencimento</label>'+
      '</div>'+
      '<div class="col-md-2 form-group" id="l_vlr_bru">'+
      '<label for="l_vlr_bru">Valor</label>'+
      '</div>'+
      '<div class="col-md-1 form-group" id="l_desc">'+
      '<label for="l_desc">Desc.</label>'+
      '</div>'+
      '<div class="col-md-2 form-group" id="l_vlr_liq">'+
      '<label for="l_vlr_liq">Valor Líquido</label>'+
      '</div>'+
      '<div class="col-md-2 form-group" id="l_form_rbto">'+
      '<label for="l_form_rbto">Forma de Pagamento</label>'+
      '</div>'+
      '</div>';

      $("#dtl_parcelas").append(linha);
    }
    else
    {
      console.log('Parcela: '+(parcela+1) );
    }

  }
// ====================================================================== Adicionar Parcelas

function adicionar_parcelas()
{
  if ( accounting.unformat($("#vlr_geral_compra").val()) > 0 && accounting.unformat($("#vlr_parcela").val()) <= accounting.unformat($("#vlr_geral_compra").val()) && accounting.unformat($("#vlr_parcela").val()) != 0 )
  {
    parcela = parcela + 1;

    vlr_geral_compra   = accounting.unformat($("#vlr_geral_compra").val());
    vlr_parcela        = accounting.unformat($("#vlr_parcela").val());
    x_dt_vencimento    = $("#x_dt_vencimento").val();
    forma_de_pagamento = $("#forma_de_pagamento").val();

    valor_restante = vlr_geral_compra - vlr_parcela;
    $("#vlr_geral_compra").val(accounting.formatMoney(valor_restante, ""));

    id_parcela = ("00" + (parcela)).slice(-2);

    p_parcela      = '<input class="form-control form-control-sm text-center" name="dados_parcelas['+parcela+'][parcela]"          type="text"   value="'+id_parcela+'"                                      style="margin: 2px 0px" readonly="readonly">';
    p_tipo         = '<input class="form-control form-control-sm text-center" name="dados_parcelas['+parcela+'][tipo]"             type="text"   value="Parcela"                                             style="margin: 2px 0px" readonly="readonly">';
    p_dt_vcto      = '<input class="form-control form-control-sm text-center" name="dados_parcelas['+parcela+'][dt_vencimento]"    type="date"   value="'+x_dt_vencimento+'"                                 style="margin: 2px 0px" readonly="readonly">';
    p_vlr_bru      = '<input class="form-control form-control-sm text-right" name="dados_parcelas['+parcela+'][p_vlr_bru]"         type="text"   value="'+accounting.formatMoney(valor_restante, "")+'"      style="margin: 2px 0px" readonly="readonly">';
    p_desc         = '<input class="form-control form-control-sm text-center" name="dados_parcelas['+parcela+'][p_desc]"           type="text"   value="'+1.11+'"                                            style="margin: 2px 0px" readonly="readonly">';
    p_vlr_liq      = '<input class="form-control form-control-sm text-right" name="dados_parcelas['+parcela+'][p_vlr_liq]"         type="text"   value="'+accounting.formatMoney(vlr_parcela, "")+'"         style="margin: 2px 0px" readonly="readonly">';
    p_form_rbto    = '<input class="form-control form-control-sm" name="dados_parcelas['+parcela+'][p_form_rbto]"                  type="text"   value="'+forma_de_pagamento+'"                              style="margin: 2px 0px" readonly="readonly">';

  //     var vcto_parce = moment(vcto_parce).add(1, 'day').add((parseFloat(i).toFixed(2) - parseFloat(1).toFixed(2)), 'month').format('YYYY-MM-DD');

  $("#l_parcela").append(p_parcela);
  $("#l_tipo").append(p_tipo);
  $("#l_dt_vcto").append(p_dt_vcto);
  $("#l_vlr_bru").append(p_vlr_bru);
  $("#l_desc").append(p_desc);
  $("#l_vlr_liq").append(p_vlr_liq);
  $("#l_form_rbto").append(p_form_rbto);
  
}
else if ( accounting.unformat($("#vlr_geral_compra").val()) <= 0 )
{
  alert('Valor restante é menor ou igual a zero!')
}
else if ( accounting.unformat($("#vlr_parcela").val()) > accounting.unformat($("#vlr_geral_compra").val()) )
{
  alert('Valor da parcela é maior do que o valor da compra!')
}
else if ( accounting.unformat($("#vlr_parcela").val()) == 0 )
{
  alert('Valor da parcela é igual a zero!')
}
else
{
  alert('FIMmmmm')
}

  //   $('#btn_avancar').show();

  //   $("#vlr_liq_curso").val( ( parseFloat(vlr_geral_compra).toFixed(2) - ( parseFloat(vlr_geral_compra).toFixed(2) * parseFloat(porcentagem_descon).toFixed(2) / 100 ) ) );
}

$("#enviar_informacoes").on('click', function()
{
  var formulario_geral = $('#formulario_geral').serialize();
  
  axios.post("{{ route('fin.compras.create2') }}", formulario_geral)
  .then( function(response)
  {
    // console.log(response)
    window.location.href = response.data.redirect
  })
@include('includes.catch', [ 'codigo_erro' => '5132464a' ] )
  .then( function()
  {
    // alert('s')
    // $("#cancelar_criacao_tarefa").click();
    // $('#overlay_tasks').hide();
  })
})

</script>
@endsection
