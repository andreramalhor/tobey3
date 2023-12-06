@extends('layouts.app')

@section('content')
@include('sistema.pdv.vendas2.modal.sobreOCliente')
@include('sistema.pdv.vendas2.modal.agendados')
@include('sistema.pdv.vendas2.modal.sobreOProdutoServico')
<input type="hidden" name="id_venda" value="{{ $venda->id ?? null }}">
<input type="hidden" name="pdv_venda" value="">
<input type="hidden" name="pdv_venda_detalhes" value="">
<input type="hidden" name="fin_conta_interna" value="">
<div class="row">
  <div class="col-3">
    <div class="row">
      {{-- ====================================================================================================================================================================================================== --}}
      <div class="col-12">
        <div class="card">
          <div class="overlay" id="cliente-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div>
          <div class="card-header">
            <h3 class="card-title">Cliente da Comanda <span id="badge_comanda_1" style="display: none;"></span></h3>
          </div>
          <div class="card-body p-3" id="card_select_cliente">
            <div class="row">
              <div class="col-12">
                <label class="col-form-label pt-0">Nome do Cliente<font color="red">*</font></label>
                <select class="form-control form-control-sm select2" name="id_cliente" onchange="cliente_selecionado(this.value)">
                  <option value="0">( Sem Cadastro )</option>
                  @foreach($clientes as $id => $cliente)
                  <option value="{{ $id }}" @if($venda != null && $venda->id_cliente == $id) selected="selected"  @endif>{{ $cliente }}</option> @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="card card-widget widget-user-2" id="card_show_cliente" style="display: none;">
            <div id="widget-user-selo"></div>
            <div class="widget-user-header" style="background-color: #dea6c4 !important; padding: 10px;">
              <div class="widget-user-image">
                <img class="img-circle info_profile-pic" id="widget-user-picture" src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="User Avatar">
              </div>
              <h5 class="widget-user-desc" id="widget-user-nickname">Apelido</h5>
              <h6 class="widget-user-desc" id="widget-user-name">Nome</h6>
              <p class="widget-user-desc" id="widget-user-desc" style="margin-bottom: 0px">Observação</p>
            </div>
          </div>
        </div>
      </div>
      {{-- ====================================================================================================================================================================================================== --}}
      <div class="col-12" id="servprod-box">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title pt-0">Produtos / Serviços</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <label class="col-form-label pt-0">Produto / Serviço<font color="red">*</font></label>
                <select class="form-control form-control-sm select2" name="id_servprod" id="id_servprod" onchange="servprod_selecionado(this.value)">
                  <option value="">Selecione . . .</option>
                  @foreach($produtos_servicos as $categoria => $produtos_servicos)
                  <optgroup label="{{ $categoria }}">  
                    @foreach($produtos_servicos as $servprod)
                    <option value="{{ $servprod->id }}">{{ $servprod->nome }}</option>
                    @endforeach
                  </optgroup>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- ====================================================================================================================================================================================================== --}}
      <div class="col-12" id="colaborador-box" style="display: none;">
        <div class="card">
          <div class="overlay" id="colaborador-overlay" style="display: none;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div>
          <div class="card-header">
            <h3 class="card-title pt-0">Vendedor / Executor</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <label class="col-form-label pt-0">Colaborador</label>
                <select class="form-control form-control-sm" name="id_colaborador" id="id_colaborador" onchange="colaborador_selecionado(this.value)">
                  <option value="">Selecione . . .</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- ====================================================================================================================================================================================================== --}}
    </div>
  </div>

  <div class="col-9" id="escolher_items" style="display: non^e;">
    <div class="row">
      {{-- ====================================================================================================================================================================================================== --}}
      <div class="col-12">
        <div class="card">
          <!-- <div class="overlay" id="servprodadd-overlay"> -->
            <!-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> -->
          <!-- </div> -->
          <div class="card-header">
            <h3 class="card-title">Adicionar Item</h3>
          </div>
          
          <div class="card-body">
            <div class="row">
              <div class="col-10">
                <div class="row">
                  {{-- ====================================================================================================================================================================================================== --}}
                  <div class="col-7">
                    <div class="form-group">
                      <label class="col-form-label pt-0">Produto / Serviço</label>
                      <input type="text" class="form-control form-control-sm" id="nome_servprod" readonly="readonly">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="col-form-label pt-0">Tipo</label>
                      <input type="text" class="form-control form-control-sm" id="tipo_servprod" readonly="readonly">
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="form-group text-center">
                      <label class="col-form-label pt-0">Estoque Atual</label>
                      <input type="text" class="form-control form-control-sm text-center" id="estoque_atual" readonly="readonly">
                    </div>
                  </div>
                  
                  <div class="col-3">
                    <div class="form-group text-center">
                      <label class="col-form-label pt-0">Valor Tabelado</label>
                      <input type="hidden" id="vlr_venda">
                      <input type="text" class="form-control form-control-sm text-right" id="vlr_servprod" readonly="readonly" onchange="atualizarValorFinal( 0 )">
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="form-group text-center">
                      <label class="col-form-label pt-0">Qtd</label>
                      <input type="number" class="form-control form-control-sm text-center" id="quantidade" value="1" onchange="atualizarValorFinal( 0 )">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group text-center">
                      <label class="col-form-label pt-0">Desc/Acrs</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button type="button" onclick="atualizarValorFinal( -1.0 )" class="btn btn-outline-danger btn-xs" style="min-width: 35px;"><small>-1,00</small></button>
                          <button type="button" onclick="atualizarValorFinal( -0.1 )" class="btn btn-outline-danger btn-xs" style="min-width: 35px;"><small>-0,10</small></button>
                        </div>
                        <input type="text" class="form-control form-control-sm text-center" id="vlr_dsc_acr" onchange="atualizarValorFinal( 0 )" value=0>
                        <div class="input-group-append">
                          <button type="button" onclick="atualizarValorFinal( +0.1 )" class="btn btn-outline-success btn-xs" style="min-width: 35px;"><small>+0,10</small></button>
                          <button type="button" onclick="atualizarValorFinal( +1.0 )" class="btn btn-outline-success btn-xs" style="min-width: 35px;"><small>+1,00</small></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group text-center">
                      <label class="col-form-label pt-0 ">Valor Final</label>
                      <input type="text" class="form-control form-control-sm text-right" id="vlr_final" readonly="readonly">
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-2">
                <div class="form-group">
                  <label class="col-form-label pt-0">Comissão</label>
                  <div class="custom-control custom-radio">
                    <p style="margin-bottom: 1px">
                      <input class="custom-control-input" type="radio" id="rdo_vlr_pgo" name="customRadio" onchange="comissao_selecionado( this.id )" checked="">
                      <label for="rdo_vlr_pgo" class="custom-control-label">Sob Pago</label>
                    </p>
                    <p style="margin-bottom: 1px">
                      <input class="custom-control-input" type="radio" id="rdo_vlr_tbl" name="customRadio" onchange="comissao_selecionado( this.id )">
                      <label for="rdo_vlr_tbl" class="custom-control-label">Sob Tabelado</label>
                    </p>
                    <p style="margin-bottom: 1px">
                      <input class="custom-control-input" type="radio" id="rdo_vlr_zro" name="customRadio" onchange="comissao_selecionado( this.id )">
                      <label for="rdo_vlr_zro" class="custom-control-label">Zerar</label>
                    </p>
                  </div>
                </div>
                <div class="form-group">
                  <div class="btn-group btn-block text-center">
                    <button type="button" class="btn btn-info disabled" id="adicionar_servprod" onclick="servprod_adicionar()"><i class="fas fa-arrow-alt-circle-down"></i></button>
                    <button type="button" class="btn btn-danger" onclick="limpar_tudo()"><i class="fas fa-minus-square"></i></button>
                  </div>
                </div>
              </div>  
            </div>
          </div>
          
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-2">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                  <h5 class="description-header" id="per_colaborador">0 %</h5>
                  <span class="description-text">% COLAB.</span>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                  <h5 class="description-header" id="vlr_comissao">R$ 0,00</h5>
                  <span class="description-text">VLR COMISSAO</span>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> --}}
                  <h5 class="description-header" id="vlr_servprod_2">R$ 0,00</h5>
                  <span class="description-text">VLR VENDA</span>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> --}}
                  <h5 class="description-header" id="vlr_desc_acrs">R$ 0,00</h5>
                  <span class="description-text" id="lbl_desc_acrs">DESC. ACRS.</span>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> --}}
                  <h5 class="description-header" id="prc_descontado">0 %</h5>
                  <span class="description-text" id="lbl_descontado">PERC. DESC.</span>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="description-block">
                  {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                  <h5 class="description-header" id="vlr_final_2">R% 0,00</h5>
                  <span class="description-text">VLR. FINAL</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-12">
        <div class="card">
          <div class="overlay" id="tabela_itens-overlay" style="display: none;">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div>
          <div class="card-header pb-1 pt-2">
            <h3 class="card-title pt-2">Itens da Venda<span id="badge_comanda_2"></span></h3>
            <div class="card-tools">          
              <a class="btn btn-info" onclick="vendas_gravar( 'gravar' )"><i class="fas fa-save"></i>. Salvar</a>
              <a class="btn btn-success" onclick="vendas_gravar( 'pagar' )"><i class="fas fa-money-bill-wave-alt"></i>. Pagamento</a>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-12">
                <table class="table table-hover table-bordered table-condensed table-sm" id="produtos-tabela">
                  <thead>
                    <tr style="background-color: #222d32; color: white;">
                      <th class="text-center">#</th>
                      <th class="text-center">Perc. Comissão</th>
                      <th class="text-center">Vlr Comissão</th>
                      <th class="text-center">Profissional</th>
                      
                      <th class="text-center">Produto / Serviço</th>
                      <th class="text-center">Vlr Tabelado</th>
                      <th class="text-center">Dsc ou Acr.</th>
                      <th class="text-center">Qtd</th>
                      <th class="text-center">Vlr Final</th>
                      <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center" colspan="9">Nenhum Serviço / Produto lançado</td>
                    </tr>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
// 
// 
// 
  // $('#vlr_servprod, #vlr_dsc_acr, #vlr_final').inputmask('decimal', {
  //   'alias': 'numeric',
  //   'groupSeparator': '.',
  //   'autoGroup': true,
  //   'digits': 2,
  //   'radixPoint': ",",
  //   'digitsOptional': false,
  //   'allowMinus': true,
  //   'placeholder': '0,00',
  // })

  index = 0
  pdv_venda= {
    id             : {{ $venda->id ?? "null" }},
    id_caixa       : {{ $caixa['db']->id }},
    id_usuario     : {{ Auth::User()->id }},
    id_agendamento : null,
    id_cliente     : {{ $venda->id_cliente ?? 0 }},
    qtd_produtos   : null,
    vlr_prod_serv  : null,
    vlr_servprod   : null,
    vlr_dsc_acr    : null,
    vlr_final      : null,
    status         : 'Aberta',
  }

  pdv_venda_detalhes = {}
  // pdv_venda_detalhes = {
	//   id            : null,
  //   id_venda      : {{ $venda->id ?? "null" }},
	//   id_servprod  : null,
	//   quantidade    : null,
	//   vlr_servprod  : null,
	//   vlr_dsc_acr   : null,
	//   vlr_final     : null,
	//   obs           : null,
	//   status        : null,
  // }

  pdv_venda_pagamentos = {
    id                 : null,
    id_venda           : {{ $venda->id ?? "null" }},
    id_forma_pagamento : null,             
    descricao          : null,       
    parcela            : null,     
    valor              : null,   
    dt_prevista        : null,         
    status             : null,    
  }

  fin_conta_interna = {}
  // fin_conta_interna = {
  //   id            : null,
  //   id_origem     : null,
  //   fonte_origem  : 'pdv_vendas_detalhes',
  //   id_pessoa     : null,
  //   tipo          : null,
  //   percentual    : null,
  //   valor         : null,
  //   dt_prevista   : null,
  //   dt_quitacao   : null,
  //   id_destino    : null,
  //   fonte_destino : null,
  //   status        : null,
  // }

  temp_detalhes      = {
    id_servprod    : null,
    tipo           : null,
    nome           : null,
    tipo_preco     : null,
    vlr_servprod   : null,
    vlr_dsc_acr    : null,
    vlr_final      : null,
    cst_adicional  : null,
    quantidade     : null,
    estoque_min    : null,
    estoque_max    : null,
    estoque_atual  : null,
    descricao      : null,
    status         : null,

    apelido        : null,
    id_colaborador : null,
    prc_comissao   : null,
    tipo_comissao  : null,
    vlr_comissao   : null,
  }

  @if( isset($venda->id) )
    cliente_selecionado({{ $venda->id_cliente }})
  @endif

  setTimeout(function() {
    $('#cliente-overlay').hide()
  }, 500)
})

// =========================================================================================================================================

function cliente_selecionado( id_cliente )
{
  console.log('revistado cliente_selecionado')
  $('#cliente-overlay').show()   
  
  pdv_venda.id_cliente = id_cliente
  
  setTimeout(function() {
    $('#cliente-overlay').hide()
    $('#servprod-box').show()
    $('#servprod-overlay').hide()
    $('#id_servprod').select2()
  }, 500)
}

function servprod_selecionado( id_servprod )
{
  console.log('revistado servprod_selecionado')
  $('#servprod-overlay').show()   
  $('#colaborador-overlay').show()

  temp_detalhes.id_servprod = id_servprod

  $.when(servprod_buscar( id_servprod ), colaboradores_buscar( id_servprod ))
  .then(function ()
  {
    setTimeout(function() {
      $('#servprod-overlay').hide()   
      $('#id_colaborador').select2()
      atualizar_dados()
    }, 500)
  })
}

function servprod_buscar( id_servprod )
{
  limpar_tudo()
  url = "{{ route('cat.servprod.buscar', ':id_servprod' ) }}"
  url = url.replace(':id_servprod', id_servprod )
  
  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    temp_detalhes.id_servprod    = response.data.id
    temp_detalhes.tipo           = response.data.tipo
    temp_detalhes.nome           = response.data.nome
    temp_detalhes.tipo_preco     = response.data.tipo_preco
    temp_detalhes.vlr_venda      = response.data.vlr_venda
    temp_detalhes.vlr_servprod   = response.data.vlr_venda
    temp_detalhes.vlr_dsc_acr    = 0
    temp_detalhes.vlr_final      = response.data.vlr_venda
    temp_detalhes.cst_adicional  = response.data.cst_adicional
    temp_detalhes.quantidade     = 1
    temp_detalhes.estoque_min    = response.data.estoque_min
    temp_detalhes.estoque_max    = response.data.estoque_max
    temp_detalhes.estoque_atual  = response.data.estoque_atual
    temp_detalhes.descricao      = response.data.descricao
    temp_detalhes.status         = response.data.status
    
    temp_detalhes.apelido        = ' - '
    temp_detalhes.id_colaborador = null
    temp_detalhes.prc_comissao   = 0
    temp_detalhes.tipo_comissao  = ' - '
    temp_detalhes.vlr_comissao   = 0
  })
@include('includes.catch', [ 'codigo_erro' => '6514975a' ] )
  .then( function()
  {
    if( ( temp_detalhes.tipo == 'Produto' && temp_detalhes.estoque_atual > 0 ) || temp_detalhes.tipo == 'Serviço')
    {
      servprod_preencher_dados()
      $('#colaborador-box').show()
    }
    else if ( temp_detalhes.tipo == 'Consumo' || temp_detalhes.tipo == 'Burocracia' )
    {
      alert('Burocracia ou Consumo')
      servprod_preencher_dados()
      $('#colaborador-box').hide()
    }
    else
    {
      alert('Não temos este produto no estoque. Selecione outro produto')
      $('#colaborador-box').hide()  
    }
  })
}

function servprod_preencher_dados()
{
  $('#nome_servprod').val(temp_detalhes.nome)
  $('#tipo_servprod').val(temp_detalhes.tipo)
  $('#vlr_venda').val(temp_detalhes.vlr_venda)
  $('#adicionar_servprod').removeClass('disabled').prop('disabled', false)

  switch (temp_detalhes.tipo)
  {
    case 'Produto':
      $('#estoque_atual').val(temp_detalhes.estoque_atual)
      break
  
    case 'Serviço':
      $('#estoque_atual').val(' - ')
      break
  
    case 'Consumo':
    case 'Burocracia':
      $('#estoque_atual').val(' - ')
      break
  }

  switch (temp_detalhes.tipo_preco)
  {
    case 'Preço fixo':
      $('#vlr_servprod').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_servprod) )).prop('readonly', true)
      $('#quantidade').val(1)
      $('#vlr_dsc_acr').val(accounting.formatMoney( 0 ))
      $('#vlr_final').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_final) )).prop('readonly', true)
      $('#rdo_vlr_pgo').click()
      // $('#rdo_vlr_pgo').prop('checked', true)
      // $('#rdo_vlr_tbl').prop('checked', false)
      // $('#rdo_vlr_zro').prop('checked', false)
      temp_detalhes.tpo_comissao = 'Sob Valor Final'
      comissao_calcular()
      break
      
    case 'Preço variável':
      $('#vlr_servprod').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_servprod) )).prop('readonly', false)
      $('#quantidade').val(1)
      $('#vlr_dsc_acr').val(accounting.formatMoney( 0 ))
      $('#vlr_final').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_final) )).prop('readonly', false)
      $('#rdo_vlr_pgo').click()
      // $('#rdo_vlr_pgo').prop('checked', false)
      // $('#rdo_vlr_tbl').prop('checked', true)
      // $('#rdo_vlr_zro').prop('checked', false)
      temp_detalhes.tpo_comissao = 'Sob Valor Final'
      comissao_calcular()
      break
        
    case 'Consumo':
    case 'Burocracia':
      $('#vlr_servprod').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_servprod) )).prop('readonly', true)
      $('#quantidade').val(1)
      $('#vlr_dsc_acr').val(accounting.formatMoney( 0 ))
      $('#vlr_final').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_final) )).prop('readonly', true)
      $('#rdo_vlr_zro').click()
      // $('#rdo_vlr_pgo').prop('checked', false)
      // $('#rdo_vlr_tbl').prop('checked', false)
      // $('#rdo_vlr_zro').prop('checked', true)
      temp_detalhes.tpo_comissao = 'Comissão Zerada'
      comissao_calcular()
      break
  
    default:
      $('#vlr_servprod').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_servprod) )).prop('readonly', true)
      $('#quantidade').val(1)
      $('#vlr_dsc_acr').val(accounting.formatMoney( 0 ))
      $('#vlr_final').val(accounting.formatMoney( parseFloat(temp_detalhes.vlr_final) )).prop('readonly', true)
      $('#rdo_vlr_pgo').click()
      // $('#rdo_vlr_pgo').prop('checked', true)
      // $('#rdo_vlr_tbl').prop('checked', false)
      // $('#rdo_vlr_zro').prop('checked', false)
      temp_detalhes.tpo_comissao = 'Sob Valor Final'
      break
  }
}

function colaboradores_buscar( id_servprod )
{
  url = "{{ route('cat.servprod.executor', ':id_servprod' ) }}"
  url = url.replace(':id_servprod', id_servprod )
  
  axios.get(url)
  .then( function(response)
  {
    // console.log(response.data)
    temp_colaboradores = []
    temp_colab         = []
    
    $('#id_colaborador').empty().append('<option>Selecione . . .</option>')
    $.each( (response.data), function( key, value )
    {
      // console.log(value)
      temp_colab = { "id_colaborador": value.id_profexec, "apelido": value.dwsdjqwqwekowqe.apelido , "prc_comissao": value.prc_comissao }
      temp_colaboradores.push( temp_colab )
      $('#id_colaborador').append('<option value="'+value.id_profexec+'">'+value.dwsdjqwqwekowqe.apelido+'</option>')
    })
  })
@include('includes.catch', [ 'codigo_erro' => '1114432a' ] )
  .then( function()
  {
    $('#colaborador-overlay').hide()
  })
}

function colaborador_selecionado( id_colaborador )
{
  $('#colaborador-overlay').show()

  t_index = temp_colaboradores.findIndex(val => val.id_colaborador == id_colaborador)
  
  temp_detalhes.id_colaborador = temp_colaboradores[t_index].id_colaborador
  temp_detalhes.apelido        = temp_colaboradores[t_index].apelido
  temp_detalhes.prc_comissao   = temp_colaboradores[t_index].prc_comissao

  temp_detalhes.tipo_comissao  = temp_detalhes.tipo_comissao
  temp_detalhes.vlr_comissao   = parseFloat(temp_colaboradores[t_index].prc_comissao) * parseFloat(temp_detalhes.vlr_final)

  setTimeout(function() {
    $('#servprod-overlay').hide()   
    $('#colaborador-overlay').hide()
    $('#id_colaborador').select2()
    $('#quantidade').val(1)
    comissao_calcular()
    atualizar_dados()
    atualizarValorFinal( 0 )
  }, 500)
}

function atualizarValorFinal( valor )
{
  vlr_servprod  = accounting.unformat($('#vlr_servprod').val())
  quantidade    = accounting.unformat($('#quantidade').val())
  vlr_dsc_acr   = accounting.unformat($('#vlr_dsc_acr').val()) + valor
  
  $('#vlr_dsc_acr').val( accounting.formatMoney( vlr_dsc_acr) )
  
  vlr_final     = ( vlr_servprod + vlr_dsc_acr ) * quantidade
  $('#vlr_final').val( accounting.formatMoney( vlr_final) )

  temp_detalhes.vlr_dsc_acr = vlr_dsc_acr
  temp_detalhes.vlr_final   = vlr_final

  comissao_calcular()
  atualizar_dados()
}

function limpar_tudo()
{
  $('#nome_servprod').val('')
  $('#tipo_servprod').val('')
  $('#estoque_atual').val('')
  $('#vlr_servprod').val('')
  $('#vlr_dsc_acr').val('')
  $('#vlr_final').val('')
  $('#quantidade').val('')

  $('#rdo_vlr_pgo').prop('checked', true).prop('disabled', false)
  $('#rdo_vlr_tbl').prop('checked', false).prop('disabled', false)
  $('#rdo_vlr_zro').prop('checked', false).prop('disabled', false)
  $('#adicionar_servprod').prop('disabled', true)
}

function comissao_selecionado( field )
{
  switch( field )
  {
    case 'rdo_vlr_pgo':
      $('#rdo_vlr_pgo').prop('checked', true)
      $('#rdo_vlr_tbl').prop('checked', false)
      $('#rdo_vlr_zro').prop('checked', false)
      temp_detalhes.tpo_comissao = 'Sob Valor Final'
      break
      
    case 'rdo_vlr_tbl':
      $('#rdo_vlr_pgo').prop('checked', false)
      $('#rdo_vlr_tbl').prop('checked', true)
      $('#rdo_vlr_zro').prop('checked', false)
      temp_detalhes.tpo_comissao = 'Sob Valor Tabelado'
      break

    case 'rdo_vlr_zro':
      $('#rdo_vlr_pgo').prop('checked', false)
      $('#rdo_vlr_tbl').prop('checked', false)
      $('#rdo_vlr_zro').prop('checked', true)
      temp_detalhes.tpo_comissao = 'Comissão Zerada'
      break
    }
  
  comissao_calcular()
  atualizar_dados()
}

function comissao_calcular()
{
  switch( temp_detalhes.tpo_comissao )
  {
    case 'Sob Valor Final':
      temp_detalhes.vlr_comissao = parseFloat(temp_detalhes.prc_comissao) * parseFloat(temp_detalhes.vlr_final)
      break
      
    case 'Sob Valor Tabelado':
      temp_detalhes.vlr_comissao = parseFloat(temp_detalhes.prc_comissao) * parseFloat(temp_detalhes.vlr_venda * $('#quantidade').val())  
      break
      
    case 'Comissão Zerada':
      temp_detalhes.vlr_comissao = 0 
      break
  }

}

function servprod_adicionar()
{
  $('#adicionar_servprod').addClass('disabled').prop('disabled', true)

  setInterval(() => {
    $('#adicionar_servprod').removeClass('disabled').prop('disabled', false)
  }, 1500 )

  $('#tabela_itens-overlay').hide()

  pdv_venda_detalhes[index] = {
    "id"               : index,
    "id_venda"         : {{ $venda->id ?? "null" }},
    "id_servprod"     : temp_detalhes.id_servprod,
    "quantidade"       : $('#quantidade').val(),
    "vlr_venda"        : $('#vlr_venda').val(),
    "vlr_negociado"    : accounting.unformat( $('#vlr_servprod').val() ),
    "vlr_dsc_acr"      : accounting.unformat( $('#vlr_dsc_acr').val() ),
    "vlr_final"        : accounting.unformat( $('#vlr_final').val() ),
    "obs"              : null,
    "status"           : null,
    "nome"             : temp_detalhes.nome,
    fin_conta_interna  : {
      "fonte_origem"        : 'pdv_vendas_detalhes',
      "id_pessoa"           : temp_detalhes.id_colaborador,
      "tipo"                : temp_detalhes.tpo_comissao,
      "percentual"          : temp_detalhes.prc_comissao,
      "valor"               : temp_detalhes.vlr_comissao,
      "dt_prevista"         : '{{ \Carbon\Carbon::today() }}',
      "dt_quitacao"         : null,
      "id_destino"          : null,
      "fonte_destino"       : null,
      "status"              : 'Em Aberto',
      "apelido"             : temp_detalhes.apelido,
    }
  }

  servprod_tabelar()

  index = index + 1

  $('#tabela_itens-overlay').hide()
}

function servprod_remover( index )
{
  delete pdv_venda_detalhes[index]

  toastrjs('warning', 'Item removido com sucesso.' )

  servprod_tabelar()
}

function servprod_tabelar()
{
  $('#produtos-tabela tbody').empty()
  $('#produtos-tabela tfoot').empty()
  collect(pdv_venda_detalhes).each((value, key) => {
    linha = '<tr>'+
              '<td class="text-center">'+ key +'</td>'+
              '<td class="text-center">'+ parseFloat( pdv_venda_detalhes[key].fin_conta_interna.percentual ) * 100 +' %</td>'+
              '<td class="text-center">'+ accounting.formatMoney( pdv_venda_detalhes[key].fin_conta_interna.valor ) +'</td>'+
              '<td class="text-center">'+ pdv_venda_detalhes[key].fin_conta_interna.apelido +'</td>'+
              '<td class="text-center">'+ pdv_venda_detalhes[key].nome +'</td>'+
              '<td class="text-center">'+ accounting.formatMoney( accounting.unformat( pdv_venda_detalhes[key].vlr_negociado , "." ) )+'</td>'+
              '<td class="text-center">'+ accounting.formatMoney( accounting.unformat( pdv_venda_detalhes[key].vlr_dsc_acr , "." ) )+'</td>'+
              '<td class="text-center">'+ pdv_venda_detalhes[key].quantidade +'</td>'+
              '<td class="text-center">'+ accounting.formatMoney( accounting.unformat( pdv_venda_detalhes[key].vlr_final , "." ) )+'</td>'+
              '<td class="text-center"><a class="btn btn-xs btn-danger p-0" style="width: 20px; height: 20px;" onclick="servprod_remover('+key+')"><i class="fas fa-times"></i></a></td>'+
            '<tr>'
    
    $('#produtos-tabela tbody').append(linha)
  })


  var vlr_comissao = 0;     var vlr_final = 0;      var quantidade = 0;
  $.each(pdv_venda_detalhes, function(index, value)
  {
    var s_vlr_comissao = parseInt(value.fin_conta_interna.valor, 10);
    var s_vlr_final    = parseInt(value.vlr_final, 10);
    var s_quantidade   = parseInt(value.quantidade, 10);
    vlr_comissao += s_vlr_comissao;
    vlr_final += s_vlr_final;
    quantidade += s_quantidade;
  });
   
  $('#produtos-tabela tfoot').append('<tr>'+
    '<th colspan="1" class="text-center">'+collect(pdv_venda_detalhes).count()+'</th>'+
    '<th colspan="1"></th>'+
    '<th colspan="1" class="text-center">'+accounting.formatMoney( accounting.unformat( vlr_comissao , "." ) )+'</th>'+
    '<th colspan="1"></th>'+
    '<th colspan="1"></th>'+
    '<th colspan="1"></th>'+
    '<th colspan="1"></th>'+
    '<th colspan="1" class="text-center">'+ quantidade +'</th>'+
    '<th colspan="1" class="text-center">'+accounting.formatMoney( accounting.unformat( vlr_final , "." ) )+'</th>'+
    '<th colspan="1"></th>'+
  '</tr>')

  // $('#produtos-tabela tfoot').append('<tr>'+
  //   '<td colspan="2"></td>'+
  //   '<td colspan="1">'+fin_conta_interna.reduce((anterior, atual) => anterior + atual.valor, 0)+'</td>'+
  //   '<td colspan="2"></td>'+
  //   '<td colspan="1">'+pdv_venda_detalhes.reduce((anterior, atual) => anterior + atual.vlr_servprod, 0)+'</td>'+
  //   '<td colspan="1">'+pdv_venda_detalhes.reduce((anterior, atual) => anterior + atual.vlr_dsc_acr, 0)+'</td>'+
  //   '<td colspan="1">'+pdv_venda_detalhes.reduce((anterior, atual) => anterior + atual.vlr_final, 0)+'</td>'+
  //   '<td colspan="1"></td>'+
  // '</tr>')
}

function atualizar_dados()
{
  $('#per_colaborador').text(    parseFloat( temp_detalhes.prc_comissao).toFixed(2) * 100 +' %'                                                                                                )
  $('#vlr_comissao').text(       accounting.formatMoney( temp_detalhes.vlr_comissao )                                                                                                          )
  $('#vlr_servprod_2').text(     accounting.formatMoney( accounting.unformat( temp_detalhes.vlr_servprod , "." ) )                                                                             )
  $('#vlr_desc_acrs').text(      accounting.formatMoney( accounting.unformat( temp_detalhes.vlr_dsc_acr , "." ) )                                                                              )
  $('#lbl_desc_acrs').text(      (( temp_detalhes.vlr_dsc_acr <= 0) ? 'VLR DESCONTADO' : 'VLR ACRESCIDO')                                                                                      )
  $('#prc_descontado').text(     (((( accounting.unformat($('#vlr_dsc_acr').val()) * -1) / accounting.unformat($('#vlr_servprod').val())) * 100) ).toFixed(2)+' %'                             )
  $('#lbl_descontado').text(     (((( accounting.unformat($('#vlr_servprod').val()) / accounting.unformat($('#vlr_dsc_acr').val())) * 100) - 100 ) <= 0 )  ? 'PRC DESCONTADO' : 'PRC ACRESCIDO')
  $('#vlr_final_2').text(        accounting.formatMoney( accounting.unformat( temp_detalhes.vlr_final , "." ) )                                                                                )
}

function vendas_gravar( destino )
{
  dados = {
    pdv_venda          : pdv_venda,
    pdv_venda_detalhes : pdv_venda_detalhes,
    fin_conta_interna  : fin_conta_interna,
    tmp_destino        : destino
  }
  
  axios.post('{{ route('pdv.vendas.gravar') }}', dados)
  .then( function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '4476789a' ] )
}

// ========================================================================================================================================
function analisarDescontos( tipo )
{
  console.log('revisado analisarDescontos')
  // switch (tipo)
  // {
  //   case 'Colaborador':
  
  //     dados_da_conta_interna.desconto_predefinido = -0.3                        // Colaborador = desconto de 30% do valor serviço
  //     dados_da_conta_interna.tipo_comissao        = "Final"                     // Colaborador = comissão para o colaborador em cima do valor pago
  //     dados_da_conta_interna.selo                 = "Colaborador"               // Definição do Selo  = Colaborador
  //     dados_da_conta_interna.cor_selo             = "pink"

  //     $('#rdo_vlr_pgo').attr('checked', true)
  //     $('#rdo_vlr_tbl').attr('disabled', true)
  //     $('#rdo_vlr_zro').attr('checked', false)
  //     comissao_selecionado( '#rdo_vlr_pgo' )
  //     break

  //   case 'Cliente VIP':
  //     dados_da_conta_interna.desconto_predefinido = "VIP"                       // Cliente VIP = paga apenas o valor destinado a comissão
  //     dados_da_conta_interna.tipo_comissao        = "Comissão"                  // Cliente VIP = comissão para o colaborador em cima do valor tabelado do serviço
  //     dados_da_conta_interna.selo                 = "VIP"                       // Definição do Selo  = Cliente VIP
  //     dados_da_conta_interna.cor_selo             = "yellow"

  //     $('#rdo_vlr_pgo').attr('disabled', true)
  //     $('#rdo_vlr_tbl').attr('checked', true)
  //     $('#rdo_vlr_zro').attr('checked', false)
  //     comissao_selecionado( '#rdo_vlr_tbl' )
  //     break

  //   case 'Influencer Digital':
  //     dados_da_conta_interna.desconto_predefinido = -1                          // Influencer Digital = desconto 100% do valor serviço
  //     dados_da_conta_interna.tipo_comissao        = "Tabelado"                  // Influencer Digital = comissão para o colaborador em cima do valor tabelado do serviço
  //     dados_da_conta_interna.selo                 = "Influencer Digital"        // Definição do Selo  = Influencer Digital
  //     dados_da_conta_interna.cor_selo             = "purple" 

  //     $('#rdo_vlr_pgo').attr('disabled', true)
  //     $('#rdo_vlr_tbl').attr('checked', true)
  //     $('#rdo_vlr_zro').attr('checked', false)
  //     comissao_selecionado( '#rdo_vlr_tbl' )
  //     break

  //   default:
  //     dados_da_conta_interna.desconto_predefinido = 0                           // Identifica Influencer Digital, Desconto Cliente VIP ou Preço especial para Sócio ou Colaborador
  //     dados_da_conta_interna.tipo_comissao        = "Normal"                    // Identifica se comissão será sobre o preço tabelado ou sobre o preço com desconto
  //     dados_da_conta_interna.selo                 = ''                          // Nome que ficará na Badge
  //     dados_da_conta_interna.cor_selo             = ''

  //     $('#rdo_vlr_pgo').attr('checked', true)
  //     $('#rdo_vlr_tbl').attr('disabled', false)
  //     $('#rdo_vlr_zro').attr('checked', false)
  //     comissao_selecionado( '#rdo_vlr_pgo' )
  //     break
  // }
}

</script>
@endpush
