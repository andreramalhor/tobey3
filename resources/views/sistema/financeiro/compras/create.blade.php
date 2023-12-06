@extends('layouts.app')

@section('content')
<form id="form_compra_create" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-12" id="box_fornecedor">
      <div class="card">
        <div class="overlay" id="overlay_fornecedor">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Fornecedor<span id="badge_compra_1" style="display: none;"></span></h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" id="change_fornecedor" onclick="mudarForncedor()" style="display: none;"><i class="fas fa-undo"></i></a>
            </div>
          </div>
        </div>
        <div class="card-body" id="card_select_fornecedor" style="padding-top: 0px;">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="id_compra" id="id_compra" value="{{ $compra->id ?? null }}">
              <label class="col-form-label">Nome do Fornecedor<font color="red">*</font></label>
              <select class="form-control form-control-sm select2" name="id_fornecedor" onchange="selecionarForncedor(this)">
                <option value="">Selecione . . .</option>
                @foreach($pessoas as $pessoa)
                <option value="{{ $pessoa->id }}" @if($compra != null && $compra->id_fornecedor == $pessoa->id) selected="selected" @endif >{{ $pessoa->nomes }}</option> @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="card card-widget widget-user-2" id="card_show_fornecedor" style="display: none;">
          <div class="widget-user-header" style="background-color: #dea6c4 !important; padding: 10px;">
            <div class="widget-user-image">
              <img class="img-circle info_profile-pic" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar">
            </div>
            <h5 class="widget-user-desc" id="widget-user-nickname">Apelido</h5>
            <h6 class="widget-user-desc" id="widget-user-name">Nome</h6>
            <p class="widget-user-desc" id="widget-user-desc" style="margin-bottom: 0px">Observação</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12" id="tabela_items">
      <div class="card">
        <div class="overlay" id="overlay_tabela_itens" style="display: none;">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Itens desse Fornecedor</h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" id="pagar_compra" onclick="pagarCompra()"><i class="fas fa-money-bill-wave-alt"></i></a>
            </div>
          </div>
        </div>
        <div class="card-body p-0" style="padding-top: 0px;">
          <div class="row">
            <div class="col-12">
              <table class="table table-sm table-bordered table-hover table-condensed text-nowrap no-padding" id="table-detalhes" style="border-collapse:collapse;margin: auto;">
                <thead>
                  <tr style="background-color: #222d32; color: white;">
                    <th class="text-center">#</th>
                    <th class="text-center">Produto</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Estoque Mín.</th>
                    <th class="text-center">Estoque Máx.</th>
                    <th class="text-center">Estoque Atual</th>
                    <th class="text-center" width="100px">Qtd</th>
                    <th class="text-center" width="100px">Vlr Unit.</th>
                    <th class="text-center" width="100px">Vlr Final</th>
                    <th class="text-center" width="100px">Vlr Venda</th>
                    <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                  </tr>
                </thead>
                <tbody id="mostrar-itens">
                  <tr>
                    <td class="text-center" colspan="9">Escolha primeiro o fornecedor</td>
                  </tr>
                </tbody>
                <tfoot id="mostrar-itens-footer" style="display: none">
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@push('css')
<style type="text/css">
  .radio-group {
    position: relative;
  }

  .radio {
    display:inline-block;
    cursor:pointer;

    border: solid 1px transparent;
  }

  .radio.selected {
    box-shadow: 0px 0px 5px 2px #d34d8d;
  }
</style>
@endpush

@push('js')
<script>
//
$(document).ready(function()
{
  desconto_predefinido    = 0; // Identifica Influencer Digital, Desconto Forncedor VIP ou Preço especial para Sócio ou Colaborador
  tipo_comissao           = "Normal"; // Identifica se comissão será sobre o preço tabelado ou sobre o preço com desconto
  informacoesdapessoa     = 0;

  teste = {};
  fin_compra =
  {
    id              : $('#id_compra').val(),
    id_caixa        : null,
    id_usuario      : {{ Auth::User()->id }} ,
    id_fornecedor   : null,
    qtd_produtos    : 0,
    vlr_produto     : 0,
    vlr_prod_serv   : 0,
    vlr_negociados  : 0,
    vlr_dsc_acr     : 0,
    vlr_final       : 0,
    status          : 'Aberta',
    fin_compra_detalhe : {},
  };

  fin_compra_detalhe = [];

  fin_conta_interna = {};

  $('#overlay_fornecedor').hide();
});
//

function selecionarForncedor(field)
{
  $('#overlay_tabela_itens').show();
  
  fin_compra.id_fornecedor      = field.value;
  fin_compra_detalhe            = [];
  fin_compra.fin_compra_detalhe = fin_compra_detalhe;

  if(fin_compra.id_fornecedor != "")
  {
    url = "{{ route('produto.produtosDesseFornecedor', ':id') }}";
    url = url.replace(':id', [fin_compra.id_fornecedor] );

    axios.get(url)
    .then( function(response)
    {
      // console.log(response)
      $('#mostrar-itens').empty();

      $.each( response.data, function( key, value )
      {
        $("#mostrar-itens").append(
          '<tr>'+
            '<td class="text-center">'+value.id+'</td>'+
            '<td class="text-left">'+value.nome+'</td>'+
            '<td class="text-left">'+value.qual_categoria_disso.nome+'</td>'+
            '<td class="text-center">'+value.estoque_min+'</td>'+
            '<td class="text-center">'+value.estoque_max+'</td>'+
            '<td class="text-center">'+value.estoque_atual+'</td>'+
            '<td class="text-center" contenteditable="true" class="text-center" data-column="qtd_'+value.id+'" onclick="document.execCommand(\'selectAll\',false,null)" onblur="atualizaValor('+value.id+')">'+0+'</td>'+
            '<td class="text-right" contenteditable="true" class="text-right" data-column="vlr_custo_'+value.id+'" onclick="document.execCommand(\'selectAll\',false,null)" onblur="atualizaValor('+value.id+')">'+ new Intl.NumberFormat('pt-BR', { currency: 'BRL', minimumFractionDigits: 2 }).format(value.vlr_custo)+ '</td>'+
            '<td class="text-right" id="vlr_final_'+value.id+'">R$ 0,00</td>'+
            '<td class="text-right" contenteditable="true" class="text-right" data-column="vlr_venda_'+value.id+'" onclick="document.execCommand(\'selectAll\',false,null)" onblur="atualizaValor('+value.id+')">'+ new Intl.NumberFormat('pt-BR', { currency: 'BRL', minimumFractionDigits: 2 }).format(value.vlr_venda)+ '</td>'+
            '<td class="text-center">'+value.id+'</td>'+
          '</tr>'
        );
      });

      if(response.data.length > 0)
      {
        $("#mostrar-itens-footer").show();
      }

      $("#mostrar-itens-footer").empty();
      $("#mostrar-itens-footer").append(
        '<tr>'+
          '<th class="text-center" colspan="6"></th>'+
          '<th class="text-center" id="qtd_footer">0</th>'+
          '<th class="text-center" colspan="1"></th>'+
          '<th class="text-right" id="vlr_final_footer">0,00</th>'+
          '<th class="text-center" colspan="2"></th>'+
        '</tr>'
        );
    })
@include('includes.catch', [ 'codigo_erro' => '4378793a' ] )
    .then( function()
    {
      setTimeout(function()
      {
        $('#overlay_tabela_itens').hide();
        // $('#overlay_fornecedor').hide();
      }, 500);

      updateOrCreateCompra(fin_compra.id_fornecedor)
    })
  }
}

function updateOrCreateCompra(id_fornecedor)
{
  fin_compra.fin_compra_detalhe = fin_compra_detalhe;

  axios.post('{{ route('compra.store') }}', fin_compra)
  .then( function(response)
  {
    console.log(response)
    if(typeof fin_compra.id != "number")
    {
      fin_compra.id = response.data.data.id;

      $('#badge_compra_1').append(': '+'<span class="badge bg-pink">'+fin_compra.id+'</span>').show();
      $('#badge_compra_2').append('<span class="badge bg-pink">'+fin_compra.id+'</span>').show();
    }

    toastrjs(response.data.type, response.data.message)
    $('#change_fornecedor').show();

    $('#card_select_fornecedor').hide();
    $('#id_compra').val(fin_compra.id);
    $('#num_compra').text(fin_compra.id);
  })
@include('includes.catch', [ 'codigo_erro' => '4569510a' ] )
  .then( function()
  {
    setTimeout(function()
    {
      $('#overlay_produtos').hide();
    }, 500);
  })
}

function atualizaValor( field )
{
  let id_servprod  = field;
  let qtd_produto = parseInt($("[data-column='qtd_"+field+"']")[0].innerHTML);
  let vlr_custo   = stringToNumber($("[data-column='vlr_custo_"+field+"']")[0].innerHTML);
  let vlr_venda   = stringToNumber($("[data-column='vlr_venda_"+field+"']")[0].innerHTML);
  
  let indice_prod = fin_compra_detalhe.findIndex(val => val.id_servprod == id_servprod);

  if( !isNaN(qtd_produto) && qtd_produto > 0 )
  {
    if( indice_prod == -1 )
    {
      let produto = {
        id_compra     : fin_compra.id,
        id_servprod    : id_servprod,
        qtd           : qtd_produto,
        vlr_compra    : vlr_custo,
        vlr_negociado : 0,
        vlr_dsc_acr   : 0,
        vlr_final     : vlr_custo * qtd_produto,
        status        : 'Aberto',
      }
      fin_compra_detalhe.push(produto);
    }
    else
    {
      fin_compra_detalhe[indice_prod].id_compra     = fin_compra.id;
      fin_compra_detalhe[indice_prod].id_servprod    = id_servprod;
      fin_compra_detalhe[indice_prod].qtd           = qtd_produto;
      fin_compra_detalhe[indice_prod].vlr_negociado = 0,
      fin_compra_detalhe[indice_prod].vlr_dsc_acr   = 0,
      fin_compra_detalhe[indice_prod].vlr_compra    = vlr_custo;
      fin_compra_detalhe[indice_prod].vlr_final     = vlr_custo * qtd_produto;
      fin_compra_detalhe[indice_prod].status        = 'Aberto';
    }
  }
  else
  {
    if( fin_compra_detalhe[indice_prod].qtd > 0 )
    {
      fin_compra_detalhe.splice(indice_prod, 1);
    }
  } let este_agendamento = dados_do_agendamento.filter(x => x.id === id_agendamento);


  let qtd_total = fin_compra_detalhe.reduce( ( quantidade, item )  => quantidade + item.qtd, 0 );
  let vlr_final = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(( qtd_produto * vlr_custo ).toFixed(2));

  let vlr_total = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(fin_compra_detalhe.reduce( ( valor_final, item ) => valor_final + (item.qtd * item.vlr_compra), 0 ));

  $("#vlr_final_"+id_servprod).text(vlr_final)
  $("#qtd_footer").text(qtd_total)
  $("#vlr_final_footer").text(vlr_total)
  
  fin_compra.qtd_produtos = qtd_total;
  fin_compra.vlr_final    = stringToNumber(vlr_total);

  $("[data-column='vlr_custo_"+field+"']")[0].innerHTML = new Intl.NumberFormat('pt-BR', { currency: 'BRL', minimumFractionDigits: 2 }).format(vlr_custo)
}

function pagarCompra()
{
  $('#overlay_fornecedor').show();
  $('#overlay_tabela_itens').show();

  fin_compra.fin_compra_detalhe = fin_compra_detalhe;

  axios.post('{{ route('compra.storePagamento') }}', fin_compra)
@include('includes.catch', [ 'codigo_erro' => '4435784a' ] )
  .then( function()
  {
    setTimeout(function()
    {
      $('#overlay_fornecedor').hide();
      $('#overlay_tabela_itens').hide();
    }, 500);
  })

  url = "{{ route('compra.pagar', ':id') }}";
  url = url.replace(':id',fin_compra.id);

  window.location.href = url;
}

function mudarForncedor()
{
  $('#card_select_fornecedor').show();
  $('#change_fornecedor').hide();
}

function stringToNumber( valor )
{
  return parseFloat( valor.replace('R$','').replace(/\./g, '').replace(',', '.'));
}

</script>
@endpush
