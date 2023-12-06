@extends('layouts.app')

@section('content')
@include('sistema.pdv.vendas.modal.sobreOCliente')
@include('sistema.pdv.vendas.modal.agendados')
@include('sistema.pdv.vendas.modal.sobreOProdutoServico')
<form method="POST" action="{{ route('pdv.vendas.store') }}" id="form_venda_create" autocomplete="off">
  <input type="hidden" name="id_venda" value="{{ $venda->id ?? null }}">
  @csrf
  <div class="row">
    <div class="col-4">
      <div class="row">
        {{-- ====================================================================================================================================================================================================== --}}
        <div class="col-12" id="box_cliente">
          <div class="card">
            <div class="overlay" id="overlay_cliente">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
              <h3 class="card-title">Cliente da Comanda <span id="badge_comanda_1" style="display: none;"></span></h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" id="btn_modal_sobreOCliente" href="#modal_sobreOCliente" style="display: none;"><i class="fas fa-fw fa-address-card"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" id="btn_modal_sobreAComanda" href="#modal_sobreAComanda" style="display: none;"><i class="fas fa-fw fa-search"></i></a>
                  <a class="btn btn-sm btn-default" id="change_cliente" onclick="mudarCliente()" style="display: none;"><i class="fas fa-undo"></i></a>
                </div>
                @include('sistema.pdv.vendas.modal.sobreAComanda')
              </div>
            </div>
            <div class="card-body" id="card_select_cliente">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Nome do Cliente<font color="red">*</font></label>
                  <select class="form-control form-control-sm select2" name="id_cliente" onchange="selecionarCliente(this.value)">
                    <option value="">Selecione . . .</option>
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" @if($venda != null && $venda->id_cliente == $cliente->id) selected="selected"  @endif>{{ $cliente->nomes }}</option> @endforeach
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
        <div class="col-12" id="escolher_servprod" style="display: none;">
          <div class="card">
            <div class="overlay" id="overlay_produtosServicos" style="display: none;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
              <h3 class="card-title">Produtos / Serviços</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" href="#modal_sobreOProdutoServico" id="m2_sobreOProdutoServico" style="display: none;"><i class="fas fa-fw fa-search"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" href="#modal_agendados" id="btn_modal_agendados" style="display: none;"><i class="fas fa-fw fa-calendar-alt"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Produto / Serviço<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_servprod_servico" id="id_servprod_servico" onchange="selecionarProdutoServico(this.value)">
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
        <div class="col-12" id="escolher_profissional" style="display: none;">
          <div class="card">
            <div class="overlay" id="overlay_profissional" style="display: none;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
              <h3 class="card-title">Profissional</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#"><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body" style="padding: 5px">
              <div class="row">
                <div class="col-12 radio-group" id="profisionais_radio">
                  <img src="{{ asset('img/atendimentos/pessoas/0.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;"
                  id="idProfissional_" data-value="" data-origem="imagem" onclick="selecionarProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="Espaço Milady" data-original-title="Espaço Milady">
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- ====================================================================================================================================================================================================== --}}
      </div>
    </div>

    <div class="col-8" id="escolher_items" style="display: non^e;">
      <div class="row">
        {{-- ====================================================================================================================================================================================================== --}}
        <div class="col-12">
          <div class="card">
            <div class="overlay" id="overlay_configurar_item" style="display: non^e;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
              <h3 class="card-title">Adicionar Item</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm" id="adicionar_servprod"><i class="fas fa-arrow-alt-circle-down"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label class="col-form-label">Produto / Serviço</label>
                    <input type="text" class="form-control form-control-sm" name="nome_servprod" id="nome_servprod" readonly="readonly">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label class="col-form-label">Valor Tabelado</label>
                    <input type="text" class="form-control form-control-sm text-right" name="vlr_negociado" id="vlr_negociado">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label class="col-form-label">Desc/Acrs</label>
                    <input type="text" class="form-control form-control-sm text-right" name="vlr_dsc_acr" id="vlr_dsc_acr" onchange="corrigirValorFinal(this.value)" onfocus="selecaoDesc( this )" >
                    <div class="btn-group col text-center" style="padding-top: 5px">
                      <button type="button" onclick="menos_reais()" class="btn btn-outline-danger btn-xs"><i class="fas fa-minus-square"></i></button>
                      <button type="button" onclick="menos_cents()" class="btn btn-outline-danger btn-xs"><i class="fas fa-minus"></i></button>
                      <button type="button" onclick="mais_cents()" class="btn btn-outline-success btn-xs"><i class="fas fa-plus"></i></button>
                      <button type="button" onclick="mais_reais()" class="btn btn-outline-success btn-xs"><i class="fas fa-plus-square"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label class="col-form-label">Valor Final</label>
                    <input type="text" class="form-control form-control-sm text-right" name="vlr_final" id="vlr_final" readonly="readonly">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label class="col-form-label">Comissão</label>
                    <div class="custom-control custom-radio">
                      <p style="margin-bottom: 1px">
                        <input class="custom-control-input" type="radio" id="rdo_vlr_pgo" name="customRadio" onchange="selecaoComissao( this )" checked="">
                        <label for="rdo_vlr_pgo" class="custom-control-label">Sob Pago</label>
                      </p>
                      <p style="margin-bottom: 1px">
                        <input class="custom-control-input" type="radio" id="rdo_vlr_tbl" name="customRadio" onchange="selecaoComissao( this )">
                        <label for="rdo_vlr_tbl" class="custom-control-label">Sob Tabelado</label>
                      </p>
                      <p style="margin-bottom: 1px">
                        <input class="custom-control-input" type="radio" id="rdo_vlr_zro" name="customRadio" onchange="selecaoComissao( this )">
                        <label for="rdo_vlr_zro" class="custom-control-label">Zerar</label>
                      </p>

                    </div>
                  </div>


                  {{-- <div class="form-group"> --}}
                    {{-- <div class="btn-group col text-center"> --}}
                      {{-- <button type="button" class="btn btn-info"><i class="fas fa-arrow-alt-circle-down"></i></button> --}}
                      {{-- <button type="button" class="btn btn-danger"><i class="fas fa-minus-square"></i></button> --}}
                    {{-- </div> --}}
                  {{-- </div> --}}
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-2">
                  <div class="description-block">
                    {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                    <h5 class="description-header" id="per_profissional">0 %</h5>
                    <span class="description-text">% PROF.</span>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="description-block">
                    {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                    <h5 class="description-header" id="vlr_comissao">R$ 0,00</h5>
                    <span class="description-text">COMISSAO</span>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="description-block border-right">
                    {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> --}}
                    <h5 class="description-header" id="vlr_venda">R$ 0,00</h5>
                    <span class="description-text">VLR Venda</span>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="description-block border-right">
                    {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> --}}
                    <h5 class="description-header" id="vlr_descontado">R$ 0,00</h5>
                    <span class="description-text">VLR DESCONTADO</span>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="description-block border-right">
                    {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> --}}
                    <h5 class="description-header" id="prc_descontado">0 %</h5>
                    <span class="description-text">Perc. Desc.</span>
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
            <div class="overlay" id="overlay_tabela_itens" style="display: non^e;">
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="card-header">
              <h3 class="card-title">Itens da Venda: <span id="badge_comanda_2"></span></h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" id="pagar_comanda" onclick="pagarComanda()"><i class="fas fa-money-bill-wave-alt"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="row">
                <div class="col-12" id="mostrar-itens">
                  <table id="table-detalhes" class="table table-hover table-bordered table-condensed table-sm">
                    <thead>
                      <tr style="background-color: #222d32; color: white;">
                        <th class="text-center">Perc. Comissão</th>
                        <th class="text-center">Vlr Comissão</th>
                        <th class="text-center">Profissional</th>

                        <th class="text-center">Produto / Serviço</th>
                        <th class="text-center">Vlr Venda</th>
                        <th class="text-center">Dsc ou Acr.</th>
                        <th class="text-center">Vlr Final</th>
                        <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                      </tr>
                    </thead>
                    <tbody id="campos_contatos">
                      <tr>
                        <td class="text-center" colspan="8">Nenhum Serviço / Produto lançado</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
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
// 
// 
// 
  $('#vlr_negociado, #vlr_dsc_acr, #vlr_final').inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': true,
    'placeholder': '0,00',
  });

  pdv_venda =
  {
    id              : {{ $venda->id ?? "null" }},
    id_caixa        : {{ $caixa['db']->id }},
    id_usuario      : {{ Auth::User()->id }},
    id_cliente      : {{ $venda->id_cliente ?? "null" }},
    // qtd_produtos    : null,
    // vlr_prod_serv   : null,
    // vlr_negociados  : null,
    // vlr_dsc_acr     : null,
    // vlr_final       : null,
    status          : 'Aberta',
  };

  dados_do_detalhe_da_venda =
  {
    id               : null,
    id_venda         : {{ $venda->id ?? "null" }},
    id_servprod     : null,
    vlr_venda        : null,
    vlr_negociado    : null,
    vlr_dsc_acr      : null,
    vlr_final        : null,
    obs              : null,
    status           : null,
    profissionais    : [],
  }

  dados_da_conta_interna =
  {
    id               : null,
    id_origem        : null,
    fonte_origem     : 'pdv_vendas_detalhes',
    id_pessoa        : null,
    tipo             : null,
    percentual       : null,
    valor            : null,
    dt_prevista      : null,
    dt_quitacao      : null,
    id_destino       : null,
    fonte_destino    : null,
    status           : null,
  }
  
  dados_do_agendamento = [];
  // {
  //   id               : null,
  //   start            : null,
  //   end              : null,
  {{-- //   id_cliente       : {{ $venda->id_cliente ?? "null" }}, --}}
  //   id_profexec  : null,
  //   id_servprod       : null,
  {{-- //   id_comanda       : {{ $venda->id ?? "null" }}, --}}
  //   valor            : null,
  //   id_criador       : null,
  //   obs              : null,
  //   color            : null,
  //   status           : null,
  //   id_venda_detalhe : null,
  // }
  
  dados_do_cliente =
  {
    id               : null,
    nome             : null,
    apelido          : null,
    cpf              : null,
    instagram        : null,
    foto_perfil      : null,
    saldo            : null,
    observacao       : null,
    tipos            : null,
    vendas           : null,
  }

  dados_do_profissional =
  {

  }

  @if( isset($venda->id) )
  selecionarCliente({{ $venda->id_cliente }});
  @endif

  pdv_venda_detalhe = {};

  fin_conta_interna = {};

  setTimeout(function() {
    $('#overlay_cliente').hide();
  }, 1000);
});
// ==========================================================================================================================================

function selecionarCliente( id_cliente )
{
  console.log('revistado selecionarCliente')
  $('#overlay_cliente').show();   
  
  pdv_venda.id_cliente = id_cliente;
  
  procurar_dados_Cliente();
}

function selecionarProdutoServico( id_servprod )
{
  console.log('selecionarProdutoServico')
  pdv_venda_detalhe.id_servprod = id_servprod;
  
  $('#overlay_produtosServicos').show();
  $('#overlay_profissional').hide();
  $('#overlay_configurar_item').show();

  if( id_servprod != '' )
  {
    $('#m2_sobreOProdutoServico').show();
  }
  else
  {
    $('#m2_sobreOProdutoServico').hide();
  }

  procurar_dados_ProdutoServico( id_servprod , false )
}

pdv_venda_detalhe = {};
function updateOrCreateVenda()
{
  console.log('revisado updateOrCreateVenda')
  console.log('=====================1')
  pdv_venda.pdv_venda_detalhe = pdv_venda_detalhe;
  console.log('=====================2')

  axios.post('{{ route('pdv.vendas.store') }}', pdv_venda)
  .then( function(response)
  {
    // console.log(response)
    if(typeof pdv_venda.id != "number")
    {
      pdv_venda.id = response.data.data.id;

      $('#badge_comanda_1').append(': '+'<span class="badge bg-pink">'+pdv_venda.id+'</span>').show();
      $('#badge_comanda_2').append('<span class="badge bg-pink">'+pdv_venda.id+'</span>').show();
    }

    // toastrjs(response.data.type, response.data.message)

    if(pdv_venda.id != null)
    {
      $("#escolher_servprod").show();
      $('#id_servprod_servico').select2();
    }
  })
@include('includes.catch', [ 'codigo_erro' => '2247748a' ] )
  .then( function()
  {
    procurar_dados_Agendamento();
  })
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_cliente').hide();
      $('#overlay_produtosServicos').hide();
    }, 1000);
    mostrarItens()
  })
}
// ------------------------------------------------------------------------------------------------------------------------------------
function selecionarProfissional(field)
{
  console.log('selecionarProfissional')
  fin_conta_interna.id_pessoa = $(field).attr("data-value")

  url = "{{ route('servico.profServ', [ ':id_servprod', ':id_pessoa' ] ) }}";
  url = url.replace(':id_servprod', [pdv_venda_detalhe.id_servprod] );
  url = url.replace(':id_pessoa', [fin_conta_interna.id_pessoa' ] );

  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    fin_conta_interna.fonte_origem  = 'pdv_vendas_detalhes'
    fin_conta_interna.id_pessoa     = response.data.id_profexec;
    fin_conta_interna.tipo          = 'Comissão';
    fin_conta_interna.percentual    = response.data.prc_comissao;
    fin_conta_interna.valor         = response.data.prc_comissao * pdv_venda_detalhe.vlr_final;
    fin_conta_interna.dt_prevista   = moment().format('YYYY-MM-DD');
    fin_conta_interna.status        = 'Aberto';


    $(field).parent().find('.radio').removeClass('selected');
    $(field).addClass('selected');
    
    $('#overlay_configurar_item').hide();
    $('#vlr_dsc_acr').focus();
    // $('#vlr_dsc_acr').addEventListener('focus', function(){
    //   this.setSelectionRange(0, this.value.lastIndexOf(','));
    //   console.log(this.value.lastIndexOf(',') );
    // });
  



  })
@include('includes.catch', [ 'codigo_erro' => '4824313a' ] )
  .then( function()
  {
    preencher_tela_ConfigProduto()
    console.log('dados da conta interna e produto para configuracao de adicionar item')
  })
  .then( function()
  {
    if ( $('#rdo_vlr_pgo').is(':checked') )
    {
      selecaoComissao( $('#rdo_vlr_pgo') )
    }
    else if ( $('#rdo_vlr_tbl').is(':checked') )
    {
      selecaoComissao( $('#rdo_vlr_tbl') )
    }
    else if ( $('#rdo_vlr_zro').is(':checked') )
    {
      selecaoComissao( $('#rdo_vlr_zro') )
    }

    corrigirValorFinal( 0 )
  })
}


function selecaoDesc( field )
{
  field.addEventListener("focus", function (event)
  {
    this.setSelectionRange(0, this.value.lastIndexOf(','));
  });

  
  elemento = document.getElementById('vlr_dsc_acr');
  // elemento.setSelectionRange(0, this.value.lastIndexOf(','));
  elemento.setSelectionRange(0, this.length);

  console.log(elemento.value)
}

function selecaoComissao( field )
{
  // console.log(field)
  switch( field.id )
  {
    case 'rdo_vlr_pgo':
      alert(rdo_vlr_pgo)
      fin_conta_interna.valor = pdv_venda_detalhe.vlr_final * fin_conta_interna.percentual;
      break;
      
    case 'rdo_vlr_tbl':
      alert(rdo_vlr_tbl)
      fin_conta_interna.valor = pdv_venda_detalhe.vlr_venda * fin_conta_interna.percentual;
      break;

    case 'rdo_vlr_zro':
      alert(rdo_vlr_zro)
      fin_conta_interna.percentual = 0;
      fin_conta_interna.valor = 0;
      break;
  }
}







$('#adicionar_servprod').on('click', function(e)
{
  console.log("'#adicionar_servprod').on('click'")
  let m0_qtd_produtos = parseInt($('#m0_qtd_produtos').val()) + 1;
  $('#m0_qtd_produtos').val(m0_qtd_produtos);
  let m0_vlr_prod_serv = parseFloat($('#m0_vlr_prod_serv').val(), 2) + parseFloat(pdv_venda_detalhe.vlr_final, 2);
  $('#m0_vlr_prod_serv').val(m0_vlr_prod_serv);
  let m0_vlr_negociados = parseFloat($('#m0_vlr_negociados').val(), 2) + parseFloat(pdv_venda_detalhe.vlr_final, 2);
  $('#m0_vlr_negociados').val(m0_vlr_negociados);
  let m0_vlr_dsc_acr = 0;
  $('#m0_vlr_dsc_acr').val(m0_vlr_dsc_acr);

  $('#overlay_configurar_item').show();
  $('#overlay_tabela_itens').show();

  pdv_venda.qtd_produtos    = m0_qtd_produtos;
  pdv_venda.vlr_prod_serv   = m0_vlr_prod_serv;
  pdv_venda.vlr_negociados  = m0_vlr_negociados;
  pdv_venda.vlr_dsc_acr     = m0_vlr_dsc_acr;

  pdv_venda.pdv_venda_detalhe = pdv_venda_detalhe;
  pdv_venda.fin_conta_interna = fin_conta_interna;

  axios.post('{{ route('pdv.vendas.store') }}', pdv_venda)
  .then( function(response) {
    // console.log(response)
    mostrarItens()
  })
@include('includes.catch', [ 'codigo_erro' => '4079351a' ] )
  .then( function() {
    setTimeout(function() {
      $('#overlay_configurar_item').hide();
      $('#overlay_tabela_itens').hide();
    }, 500);
  })
})

function mostrarItens()
{
  console.log('revisado mostrarItens')
  $('#overlay_tabela_itens').show();

  url = "{{ route('pdv.vendas.mostrarItens', ':id') }}";
  url = url.replace(':id', [pdv_venda.id] );

  axios.get(url)
  .then( function(response)
  {
    // console.log(response.data)
    $('#mostrar-itens').empty().append(response.data)
  })
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_tabela_itens').hide();
    }, 500);
  })
};

function apagarItem(id)
{
  console.log('apagarItem')
  let qtd_produtos = parseInt($('#qtd_produtos').val()) - 1;
  $('#qtd_produtos').val(qtd_produtos);

  $('#overlay_tabela_itens').show();

  url = "{{ route('pdv.vendas.apagarItem', ':id') }}";
  url = url.replace(':id', [id] );

  axios.get(url)
  .then( function(response) {
    // console.log(response)
    // toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '1660627a' ] )
  .then( function() {
    setTimeout(function() {
      $('#overlay_tabela_itens').hide();
    }, 500);

    mostrarItens()
  })
}

function pagarComanda()
{
  console.log('pagarComanda')
  url = "{{ route('pdv.vendas.pagar', ':id') }}";
  url = url.replace(':id',pdv_venda.id);

  window.location.href = url;
}

function menos_reais()
{
  console.log('menos_reais')
  pdv_venda_detalhe.vlr_dsc_acr   = parseFloat($("#vlr_dsc_acr").val().replace(/\./g, '').replace(',', '.')) - 1;
  corrigirValorFinal( pdv_venda_detalhe.vlr_dsc_acr )
};

function menos_cents()
{
  console.log('menos_cents')
  pdv_venda_detalhe.vlr_dsc_acr   = parseFloat($("#vlr_dsc_acr").val().replace(/\./g, '').replace(',', '.')) - 0.1;

  corrigirValorFinal( pdv_venda_detalhe.vlr_dsc_acr )
};

function mais_cents()
{
  console.log('mais_cents')
  pdv_venda_detalhe.vlr_dsc_acr   = parseFloat($("#vlr_dsc_acr").val().replace(/\./g, '').replace(',', '.')) + 0.1;

  corrigirValorFinal( pdv_venda_detalhe.vlr_dsc_acr )
};

function mais_reais()
{
  console.log('mais_reais')
  pdv_venda_detalhe.vlr_dsc_acr   = parseFloat($("#vlr_dsc_acr").val().replace(/\./g, '').replace(',', '.')) + 1;

  corrigirValorFinal( pdv_venda_detalhe.vlr_dsc_acr )
};


function corrigirValorFinal( valor )
{
  console.log('corrigirValorFinal')

  if($.isNumeric(pdv_venda_detalhe.vlr_dsc_acr))
  {
    pdv_venda_detalhe.vlr_dsc_acr = valor;
  }
  else
  {
    pdv_venda_detalhe.vlr_dsc_acr = parseFloat(valor.replace(/\./g, '').replace(',', '.'));
  }

  pdv_venda_detalhe.vlr_final = parseFloat(pdv_venda_detalhe.vlr_negociado) + parseFloat(pdv_venda_detalhe.vlr_dsc_acr);
  

  // definir valor da comissao... por enquanto engessado.. depois tenho q deixa-lo dinamico
  fin_conta_interna.valor = pdv_venda_detalhe.vlr_final * fin_conta_interna.percentual;

  $('#vlr_dsc_acr').val(Number(pdv_venda_detalhe.vlr_dsc_acr).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
  $('#vlr_final').val(Number(pdv_venda_detalhe.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));  

  valor_1 = pdv_venda_detalhe.vlr_venda;
  valor_2 = pdv_venda_detalhe.vlr_final;
  valor_3 = 100;
  valor_4 = 100 - ( valor_2 * valor_3 / valor_1 ); 

  
  $('#per_profissional').text(Number(fin_conta_interna.percentual * 100).toLocaleString('pt-BR', { minimumFractionDigits: 1 })+' %');                                                           // NOVO
  $('#vlr_comissao').text( ( fin_conta_interna.valor ).toLocaleString('pt-BR', { minimumFractionDigits: 2 }) );                                              // NOVO
  $('#prc_descontado').text( valor_4.toLocaleString('pt-BR', { minimumFractionDigits: 1 }) +' %');                                                                                              // NOVO
  $('#vlr_venda').text(Number(pdv_venda_detalhe.vlr_venda).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));                                                                              // NOVO
  $('#vlr_descontado').text(Number(pdv_venda_detalhe.vlr_dsc_acr * -1).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));                                                                  // NOVO
  $('#vlr_final_2').text(Number(pdv_venda_detalhe.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));                                                                            // NOVO
}




// ========================================================================================================================================
function analisarDescontos( tipo )
{
  console.log('revisado analisarDescontos')
  // switch (tipo)
  // {
  //   case 'Colaborador':
  
  //     dados_da_conta_interna.desconto_predefinido = -0.3;                        // Colaborador = desconto de 30% do valor serviço
  //     dados_da_conta_interna.tipo_comissao        = "Final";                     // Colaborador = comissão para o profissional em cima do valor pago
  //     dados_da_conta_interna.selo                 = "Colaborador";               // Definição do Selo  = Colaborador
  //     dados_da_conta_interna.cor_selo             = "pink";

  //     $('#rdo_vlr_pgo').attr('checked', true);
  //     $('#rdo_vlr_tbl').attr('disabled', true);
  //     $('#rdo_vlr_zro').attr('checked', false);
  //     selecaoComissao( $('#rdo_vlr_pgo') )
  //     break;

  //   case 'Cliente VIP':
  //     dados_da_conta_interna.desconto_predefinido = "VIP";                       // Cliente VIP = paga apenas o valor destinado a comissão
  //     dados_da_conta_interna.tipo_comissao        = "Comissão";                  // Cliente VIP = comissão para o profissional em cima do valor tabelado do serviço
  //     dados_da_conta_interna.selo                 = "VIP";                       // Definição do Selo  = Cliente VIP
  //     dados_da_conta_interna.cor_selo             = "yellow";

  //     $('#rdo_vlr_pgo').attr('disabled', true);
  //     $('#rdo_vlr_tbl').attr('checked', true);
  //     $('#rdo_vlr_zro').attr('checked', false);
  //     selecaoComissao( $('#rdo_vlr_tbl') )
  //     break;

  //   case 'Influencer Digital':
  //     dados_da_conta_interna.desconto_predefinido = -1;                          // Influencer Digital = desconto 100% do valor serviço
  //     dados_da_conta_interna.tipo_comissao        = "Tabelado";                  // Influencer Digital = comissão para o profissional em cima do valor tabelado do serviço
  //     dados_da_conta_interna.selo                 = "Influencer Digital";        // Definição do Selo  = Influencer Digital
  //     dados_da_conta_interna.cor_selo             = "purple"; 

  //     $('#rdo_vlr_pgo').attr('disabled', true);
  //     $('#rdo_vlr_tbl').attr('checked', true);
  //     $('#rdo_vlr_zro').attr('checked', false);
  //     selecaoComissao( $('#rdo_vlr_tbl') )
  //     break;

  //   default:
  //     dados_da_conta_interna.desconto_predefinido = 0;                           // Identifica Influencer Digital, Desconto Cliente VIP ou Preço especial para Sócio ou Colaborador
  //     dados_da_conta_interna.tipo_comissao        = "Normal";                    // Identifica se comissão será sobre o preço tabelado ou sobre o preço com desconto
  //     dados_da_conta_interna.selo                 = '';                          // Nome que ficará na Badge
  //     dados_da_conta_interna.cor_selo             = '';

  //     $('#rdo_vlr_pgo').attr('checked', true);
  //     $('#rdo_vlr_tbl').attr('disabled', false);
  //     $('#rdo_vlr_zro').attr('checked', false);
  //     selecaoComissao( $('#rdo_vlr_pgo') )
  //     break;
  // }
}






function gravar_editar_Venda()
{
  console.log('gravar_editar_Venda')

}

function gravar_editar_VendaDetalhe()
{
  console.log('gravar_editar_VendaDetalhe')

}

function gravar_editar_ContaInterna()
{
  console.log('gravar_editar_ContaInterna')

}

function gravar_editar_Agendamento()
{
  console.log('gravar_editar_Agendamento')

}

function procurar_dados_Cliente()
{
  console.log('revistado procurar_dados_Cliente')
  
  // url = "{{ route('pessoa.find', ':id') }}";
  // url = url.replace(':id', [pdv_venda.id_cliente] );

  // axios.post(url)
  // .then( function(response)
  // {
  //   // console.log(response)
  //   dados_do_cliente.id          = response.data.id;
  //   dados_do_cliente.nome        = response.data.nome;
  //   dados_do_cliente.apelido     = response.data.apelido;
  //   dados_do_cliente.cpf         = response.data.cpf;
  //   dados_do_cliente.instagram   = response.data.instagram;
  //   dados_do_cliente.foto_perfil = response.data.foto_perfil;
  //   dados_do_cliente.saldo       = response.data.saldo;
  //   dados_do_cliente.observacao  = response.data.observacao;
  //   dados_do_cliente.tipos       = response.data.dsnewksmasknasj;
  //   dados_do_cliente.vendas      = response.data.eidwuedoeduzdsd;
  //   dados_do_cliente.vendas      = [];
  // })
  {{-- @include('includes.catch', [ 'codigo_erro' => '5038036a' ] ) --}}
  // .then( function()
  // {
  //   $('#btn_modal_sobreOCliente').show();   
    preencher_modal_Cliente();
  // })
  // .then( function()
  // {
    preencher_tela_Principal();
  // })
  // .then( function()
  // {
    updateOrCreateVenda();
  // })
}

function procurar_dados_Agendamento()
{
  console.log('revisado procurar_dados_Agendamento')
  // axios.post('{{ route('agenda.procurarAgendamentos') }}', pdv_venda )
  // .then( function(response)
  // {
  //   // console.log(response.data)
  //   $.each( response.data, function( key, value )
  //   {
  //     agendamento = {
  //       id                : value.id,
  //       start             : value.start,
  //       id_cliente        : value.id_cliente,
  //       id_profexec   : value.id_profexec,
  //       id_servprod        : value.id_servprod,
  //       id_comanda        : pdv_venda.id,
  //       valor             : value.valor,
  //       obs               : value.obs,
  //       status            : value.status,
  //       comanda           : pdv_venda.id,
  //       id_venda_detalhe  : pdv_venda_detalhe.id,
  //       badge             : value.badge,
  //       nome_profissional : value.hhmaqpijffgfhmj.apelido,
  //       nome_servico      : value.zlpekczgsltqgwg.nome,
  //     }
   
  //     dados_do_agendamento.push(agendamento);
  //   });
  // })
  // .then( function()
  // {
    preencher_modal_Agendamento();
  // })
  // .then( function()
  // {
  //   console.log('s')
  //   // pesquisar sobre o produto
  //   // pesquisar sobre o profissional
  //   // enviar dados para o banco de dados
  // });
}

function procurar_dados_DetalhesVenda( id_servprod_servico )
{
  console.log('procurar_dados_DetalhesVenda')

  // .then( function()
  // {
  //   setTimeout(function() {
  //     $('#overlay_produtosServicos').hide();
  //   }, 500);
  //   $('#sobreOProdutoServico').show();
  // })
  // .then( function()
  // {
  // })
  // .then( function()
  // {

  // })
  url = "{{ route('pessoa.profExec', ':id') }}";
  url = url.replace(':id', [id_servprod_servico] );

  axios.get(url)
}

function procurar_dados_ProdutoServico( id_servprod_servico, mostrar )
{
  console.log('procurar_dados_ProdutoServico')
  url_servico = "{{ route('cat.servicos.encontrar', ':id') }}";
  url_servico = url_servico.replace(':id', id_servprod_servico );

  axios.get(url_servico)
  .then( function(response)
  {
    // console.log(response)
    pdv_venda_detalhe.id_venda      = pdv_venda.id;
    pdv_venda_detalhe.id_servprod  = response.data.id;
    pdv_venda_detalhe.vlr_venda     = response.data.vlr_venda;
    pdv_venda_detalhe.vlr_negociado = response.data.vlr_venda;
    pdv_venda_detalhe.vlr_dsc_acr   = 0;
    pdv_venda_detalhe.vlr_final     = response.data.vlr_venda;
    pdv_venda_detalhe.tipo          = response.data.tipo;
    pdv_venda_detalhe.nome          = response.data.nome;
    pdv_venda_detalhe.marca         = response.data.marca;
    pdv_venda_detalhe.categoria     = response.data.qual_categoria_disso.nome;
    pdv_venda_detalhe.tipo_preco    = response.data.tipo_preco;
    pdv_venda_detalhe.duracao       = response.data.duracao;
    pdv_venda_detalhe.status        = 'Aberta';
  })
@include('includes.catch', [ 'codigo_erro' => '4574148a' ] )
  .then( function()
  {
    procurar_dados_ProfissionaisCapacitados( id_servprod_servico, mostrar )
  })
}

function procurar_dados_ProfissionaisCapacitados( id_servprod_servico, mostrar )
{
  console.log('procurar_dados_ProfissionaisCapacitados')
  url = "{{ route('pessoa.profExec', ':id') }}";
  url = url.replace(':id', [id_servprod_servico] );

  axios.get(url)
  .then( function(response)
  {
    console.log(response.data)
    pdv_venda_detalhe.profissionais         = response.data;
    dados_do_detalhe_da_venda.profissionais = response.data;
  })
@include('includes.catch', [ 'codigo_erro' => '6025821a' ] )
  .then( function()
  {
    preencher_Profissionais()
  })
  .then( function()
  {
    preencher_modal_ProdutoServico( id_servprod_servico, mostrar )
  })
  .then( function()
  {
    $('#modal_agendados').modal('hide');
    $('#escolher_profissional').show();
    $('#overlay_profissional').hide();
    $("#profisionais_radio").empty();
    $.each( pdv_venda_detalhe.profissionais, function( key, value )
    {
      let fotoProfissional = '<img src="'+value.foto_perfil+'" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="idProfissional_'+value.id+'" data-value="'+value.id+'" onclick="selecionarProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="'+value.apelido+'" data-original-title="'+value.apelido+'">';
      $("#profisionais_radio").append(fotoProfissional);
    });
  })
  .then( function()
  {
    console.log(mostrar)
    if(mostrar)
    {
      // $('#idProfissional_'+)
      // idProfissional_
      console.log('saa1')
    }
    else
    {
      console.log('saa3')
    }
    // esc_modal_ProdutoServico( id_servprod_servico, mostrar )
  })
  // .then( function()
  // {
  //   $('#escolher_profissional').show();
  // })
  // .then( function()
  // {
  //   setTimeout(function() {
  //     $('#overlay_profissional').hide();
  //   }, 1000);
  // })

}

function procurar_dados_ContaInterna()
{
  console.log('procurar_dados_ContaInterna')

}

// function procurar_dados_Agendamentqo()
// {

// }

function mudarCliente()
{
  console.log('mudarCliente')
  $('#card_select_cliente').show();
  $('#card_show_cliente').hide();
  $('#change_cliente').hide();
};

function preencher_tela_Principal()
{
  console.log('revisado preencher_tela_Principal')
  // $("#widget-user-selo").empty();
  // $("#widget-user-picture").attr('src', dados_do_cliente.foto_perfil);
  // $("#widget-user-nickname").empty().append('<span class="badge bg-pink bg-sm">'+dados_do_cliente.id+'</span>   ').append(dados_do_cliente.apelido+'   ')
  // $("#widget-user-saldo").empty().text(dados_do_cliente.saldo+'  ').append('');
  // $("#widget-user-name").empty().text(dados_do_cliente.nome);
  
  // console.log('preencher_tela_Principal              '+ dados_do_cliente.observacao)
  // if(dados_do_cliente.observacao != undefined)
  // {
  //   $("#widget-user-desc").empty().html('<span>'+dados_do_cliente.observacao+'</span>');
  // }
  // else
  // {
  //   $("#widget-user-desc").empty().html('<span>&nbsp;</span>');
  // }


  // if(dados_da_conta_interna.selo == undefined || dados_da_conta_interna.selo == '')
  // {
  //   $("#widget-user-selo").empty();
  // }
  // else
  // {
  //   $("#widget-user-selo").empty().append('<div class="ribbon-wrapper ribbon-lg">'+
  //     '<div class="ribbon bg-'+dados_da_conta_interna.cor_selo+'">'+
  //     '<font style="font-size: .6rem;">'+dados_da_conta_interna.selo+'</font>'+
  //     '</div>'+
  //     '</div>');
  // }

  // $('#card_select_cliente').hide();
  // $('#card_show_cliente').show();
  // $('#change_cliente').show();
}

function preencher_Profissionais()
{
  console.log('preencher_Profissionais')
  if ( (pdv_venda_detalhe.profissionais).length > 0 )
  {
    $('#m2_profissionais').empty();
    $.each( pdv_venda_detalhe.profissionais, function( key, value )
    {
      $('#m2_profissionais').append('<tr>'+
          '<td class="text-center">'+value.apelido+'</td>'+
          '<td class="text-center">'+Number(value.executo_tais_servicos[0].prc_comissao * 100).toLocaleString('pt-BR', { minimumFractionDigits: 0 })+' %</td>'+
        '</tr>');
    });
  }
  else
  {
    $('#m2_profissionais').empty().append('<tr><td class="text-center" colspan="2">Nenhuma profissional executa esse serviço.</td></tr>');
  }
}

function preencher_tela_ConfigProduto()
{
  console.log('preencher_tela_ConfigProduto')
  $('#nome_servprod').val(pdv_venda_detalhe.nome);
  $('#vlr_negociado').val(Number(pdv_venda_detalhe.vlr_venda).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
  $('#vlr_dsc_acr').val(Number(pdv_venda_detalhe.vlr_dsc_acr).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
  $('#vlr_final').val(Number(pdv_venda_detalhe.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));

  corrigirValorFinal( 0 )
// "per_profissional
// "vlr_comissao
// "vlr_venda
// "vlr_descontado
// "prc_descontado
// "vlr_final_2

  // $('#vlr_venda').text(pdv_venda_detalhe.vlr_venda);                                              // NOVO
  // $('#vlr_descontado').text(pdv_venda_detalhe.vlr_venda - pdv_venda_detalhe.vlr_final);                             // NOVO
  // $('#prc_descontado').text(pdv_venda_detalhe.vlr_venda+' %');                                       // NOVO
  // $('#vlr_final_2').text(pdv_venda_detalhe.vlr_final);                                                 // NOVO

}

function preencher_TipoCliente()
{
  console.log('revisado preencher_TipoCliente')
  // // PREENCHER O CAMPO TIPO
  // if ( (dados_do_cliente.tipos) != null && (dados_do_cliente.tipos).length > 0 )
  // {
  //   $('#m1_tipos').empty();
  //   $.each( dados_do_cliente.tipos, function( key, value )
  //   {
  //     $('#m1_tipos').append('<tr>'+
  //       '<td class="text-center">'+value.nome+'</td>'+
  //       '</tr>');
  //   });
  // }
  // else
  // {
  //   $('#m1_tipos').empty().append('<tr><td colspan="2" class="text-center">Nenhum Tipo</td></tr>');
  // }

  // if(dados_do_cliente.tipos.filter(x => x.nome === 'Colaborador').length > 0 || dados_do_cliente.tipos.filter(x => x.nome === 'Profissional').length > 0)
  // {
  //   analisarDescontos( 'Colaborador' )
  // }
  // else if(dados_do_cliente.tipos.filter(x => x.nome === 'Cliente VIP').length > 0)
  // {
  //   analisarDescontos( dados_do_cliente.tipos.filter(x => x.nome === 'Cliente VIP')[0].nome )
  // }
  // else if(dados_do_cliente.tipos.filter(x => x.nome === 'Influencer Digital').length > 0)
  // {
  //   analisarDescontos( dados_do_cliente.tipos.filter(x => x.nome === 'Influencer Digital')[0].nome )
  // }
  // else(dados_do_cliente.tipos.filter(x => x.nome === 'Influencer Digital').length > 0)
  // {
  //   analisarDescontos( 'Cliente' )
  // }
}

$('#btn_modal_sobreOCliente').on('click', function(){
  alert('aslkaslk preencher_modal_Cliente()')
  // preencher_modal_Cliente()
})

function preencher_modal_Cliente()
{
  console.log('revisado preencher_modal_Cliente')
  // // LEVAR IMAGEM ATUALIZADA DO INSTAGRAM PARA MODAL SOBRE O CLIENTE
  // if (dados_do_cliente.instagram != null)
  // {
  //   axios.get('https://www.instagram.com/'+dados_do_cliente.instagram+'?__a=1')
  //   .then(function(response)
  //   {
  //     // console.log(response)
  //     $('#m1_picture').attr('src', response.data.graphql.user.profile_pic_url);                                                                         // corrigir essa parte depois
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '2897359a' ] ) --}}
  // }
  // else
  // { // CASO DE ERRO, COLOCA A IMAGEM DO INSTITUTO EMBELLEZE
  //   $('#m1_picture').attr('src', $('#widget-user-picture').attr('src'));
  // }

  // // PREENCHER INFORMACOES DO MODAL SOBRE O CLIENTE
  // $('#m1_id').val(dados_do_cliente.id);
  // $('#m1_nome').val(dados_do_cliente.nome);
  // $('#m1_apelido').val(dados_do_cliente.apelido);
  // $('#m1_cpf').val(dados_do_cliente.cpf);
  // $('#m1_instagram').val(dados_do_cliente.instagram);
  // $('#m1_observacao').val(dados_do_cliente.observacao);

  // // PREENCHER O CAMPO VENDAS ATENRIRES
  // if ((dados_do_cliente.vendas).length > 0)
  // {
  //   $('#m1_vendas').empty();
  //   $.each( dados_do_cliente.vendas, function( key, value )
  //   {
  //     // let x = document.URL;
  //     let asset = 'https://www.crm-ie.tech/PDV/venda/'+value.id_venda;

  //     $('#m1_vendas').append('<tr>'+
  //       '<td class="text-center"><a class="badge bg-pink" target="_blank" href="'+asset+'">'+value.id_venda+'</a></td>'+
  //       '<td class="text-center">'+moment(value.created_at).format('DD/MM/YYYY HH:mm:ss')+'</td>'+
  //       '<td class="text-center">'+value.kcvkongmlqeklsl.nome+'</td>'+
  //       '<td class="text-center">'+value.profissional_que_fez_esse_servico.apelido+'</td>'+
  //       '<td class="text-right">'+Number(value.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</td>'+
  //       '</tr>');
  //   });
  // }
  // else
  // {
  //   $('#m1_vendas').empty().append('<tr><td colspan="5" class="text-center">Não há vendas registradas para essa pessoa.</td></tr>');
  // }

  preencher_TipoCliente();
  preencher_modal_Comanda();                                                                                                                                          // mudar de lugar depois
}

function preencher_modal_Comanda()
{
  console.log('revisado preencher_modal_Comanda')
  // // PREENCHER INFORMACOES DO MODAL SOBRE A COMANDA
  // $('#m0_id_comanda').val(pdv_venda.id);
  // $('#m0_id_cliente').val(pdv_venda.id_cliente);
  // $('#m0_nome_cliente').val(dados_do_cliente.nome);

  // // $('#btn_modal_sobreAComanda').modal('show');
  // // $('#modal_sobreOCliente').modal('show');
}

function preencher_modal_Agendamento()
{
  console.log('revisado preencher_modal_Agendamento')
  // if( (dados_do_agendamento) != null && dados_do_agendamento.length > 0)
  // {
  //   $('#btn_modal_agendados').show();

  //   $('#m3_agendamentos').empty();
  //   $.each( dados_do_agendamento, function( key, value )
  //   {
  //     $('#m3_agendamentos').append('<tr id="agendamento_'+value.id+'">'+
  //       '<td class="text-center">'+value.id+'</td>'+
  //       '<td class="text-center">'+moment(value.start).format('DD/MM/YYYY')+'</td>'+
  //       '<td class="text-center">'+moment(value.start).format('H:mm')+'</td>'+
  //       '<td class="text-center">'+value.nome_servico+'</td>'+
  //       '<td class="text-right">'+Number(value.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</td>'+
  //       '<td class="text-left">'+value.obs+'</td>'+
  //       '<td class="text-center"><span class="badge badge-'+value.badge+' bg-sm">'+value.status+'</span></td>'+
  //       '<td class="text-center">'+
  //       '<div class="btn-group">'+
  //       '<a onclick="procurar_dados_ProdutoServico('+value.id_servprod+', true)" class="btn btn-default btn-xs"><i class="fa fa-fw fa-search"></i></a>'+
  //       '<a onclick="editarAgendamento('+value.id+')" class="btn btn-warning btn-xs"><i class="fa fa-fw fa-edit"></i></a>'+
  //       '<a onclick="adicionarNaTela('+value.id+')" class="btn btn-info btn-xs"><i class="fa fa-fw fa-check"></i></a>'+
  //       '<a onclick="adicionarNaComanda('+value.id+')" class="btn btn-success btn-xs"><i class="fa fa-fw fa-check-double"></i></a>'+
  //       '<td class="text-center">'+value.nome_profissional+'</td>'+
  //       '<td class="text-center">50%</td>'+
  //       '</div>'+
  //       '</td>'+
  //       '</tr>');
  //   });
    
  //   $('#modal_agendados').modal('show');
  // }
  // else
  // {
  //   $('#m3_agendamentos').empty();
  //   $('#btn_modal_agendados').hide();
  // }
}

function preencher_modal_ProdutoServico( id_servprod_servico, mostrar )
{
  console.log('preencher_modal_ProdutoServico')
  // PREENCHER INFORMACOES DO MODAL SOBRE O PRODUTO
  $('#m2_id').val(pdv_venda_detalhe.id_servprod);
  $('#m2_tipo').val(pdv_venda_detalhe.tipo);
  $('#m2_nome').val(pdv_venda_detalhe.nome);
  $('#m2_marca').val(pdv_venda_detalhe.marca);
  $('#m2_categoria').val(pdv_venda_detalhe.categoria);
  $('#m2_tipo_preco').val(pdv_venda_detalhe.tipo_preco);
  $('#m2_duracao').val(pdv_venda_detalhe.duracao);
  $('#m2_vlr_venda').val(Number(pdv_venda_detalhe.vlr_venda).toLocaleString('pt-BR', { minimumFractionDigits: 2 }));

  if( mostrar )
  {
    $('#modal_sobreOProdutoServico').modal('show');
  }

  setTimeout(function() {
    $('#overlay_produtosServicos').hide();
  }, 500);
}

function adicionarNaTela( id_agendamento )
{
  console.log('adicionarNaTela')
  let este_agendamento = dados_do_agendamento.filter(x => x.id === id_agendamento);

  dados_do_detalhe_da_venda =
  {
    id_venda         : pdv_venda.id,
    id_servprod     : este_agendamento[0].id_servprod,
    vlr_venda        : este_agendamento[0].valor,
    vlr_negociado    : 0,
    vlr_dsc_acr      : 0,
    vlr_final        : este_agendamento[0].valor,
    obs              : este_agendamento[0].obs,
    status           : 'Aberta',
  }

  selecionarProdutoServico( dados_do_detalhe_da_venda.id_servprod )  
}

function adicionarNaComanda( id_agendamento )
{
  console.log('adicionarNaComanda')
  let este_agendamento = dados_do_agendamento.filter(x => x.id === id_agendamento);

  dados_do_detalhe_da_venda =
  {
    id_venda         : pdv_venda.id,
    id_servprod     : este_agendamento[0].id_servprod,
    vlr_venda        : este_agendamento[0].valor,
    vlr_negociado    : 0,
    vlr_dsc_acr      : 0,
    vlr_final        : este_agendamento[0].valor,
    obs              : este_agendamento[0].obs,
    status           : 'Aberta',
  }

  selecionarProdutoServico( dados_do_detalhe_da_venda.id_servprod )  

  // url = "{{ route('agenda.update', ':id') }}";
  // url = url.replace(':id', [id_agendamento] );

  // axios.post(url)
  // .then( function(response)
  // {
  //   console.log(response)
  //   // dados_do_cliente.id          = response.data.id;
  //   // dados_do_cliente.nome        = response.data.nome;
  //   // dados_do_cliente.apelido     = response.data.apelido;
  //   // dados_do_cliente.cpf         = response.data.cpf;
  //   // dados_do_cliente.instagram   = response.data.instagram;
  //   // dados_do_cliente.foto_perfil = response.data.foto_perfil;
  //   // dados_do_cliente.saldo       = response.data.saldo;
  //   // dados_do_cliente.observacao  = response.data.observacao;
  //   // dados_do_cliente.tipos       = response.data.dsnewksmasknasj;
  //   // dados_do_cliente.vendas      = response.data.eidwuedoeduzdsd;
  // })
  {{-- @include('includes.catch', [ 'codigo_erro' => '6790960a' ] ) --}}
  // .then( function()
  // {
  //   preencher_TipoClient&e( dados_do_cliente.tipos );
  // })


}
</script>
@endpush
