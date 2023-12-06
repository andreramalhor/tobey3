@extends('layouts.app')

@section('content')
<div class="col-4">
  <div class="card">
    <div class="overlay" id="overlay-cliente">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Cliente</h3>
      <div class="card-tools">
        <div class="btn-group"></div>
      </div>
    </div>
    <div class="card-body p-3" id="card_select_cliente">
      <div class="row">
        <div class="col-12">
          <label class="col-form-label pt-0">Nome do Cliente<font color="red">*</font></label>
          <select class="form-control form-control-sm select2" name="id_cliente" onchange="selecionarCliente(this.value)">
            <option value="">Selecione . . .</option>
            @foreach($clientes as $id => $cliente)
            <option value="{{ $id }}">{{ $cliente }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="card card-widget widget-user-2" id="card_show_cliente">
      <div id="widget-user-selo"></div>
      <div class="widget-user-header" style="background-color: #dea6c4 !important; padding: 10px; border-top-left-radius: 0px; border-top-right-radius: 0px;">
        <div class="widget-user-image">
          <img class="img-circle info_profile-pic" id="widget-user-picture" src="{{ asset('img/Atendimentos/Pessoas/Perfil/0.png') }}" alt="User Avatar">
        </div>
        <h5 class="widget-user-desc" id="widget-user-nickname">Apelido</h5>
        <h6 class="widget-user-desc" id="widget-user-name">Nome</h6>
        <p class="widget-user-desc" id="widget-user-desc" style="margin-bottom: 0px">Observação</p>
      </div>
    </div>
  </div>
</div>

<div class="col-4">
  <div class="card">
    <div class="overlay" id="overlay-servprod">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Serviços / Produtos</h3>
      <div class="card-tools">
        <div class="btn-group"></div>
      </div>
    </div>
    <div class="card-body p-3" id="servprod">
      <div class="row">
        <div class="col-12">
          <label class="col-form-label pt-0">Serviço<font color="red">*</font></label>
          <select class="form-control form-control-sm select2" name="servprod" onchange="selecionarCliente(this.value)">
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
    <div class="card card-widget widget-user-2" id="servprod">
      <div id="widget-user-selo"></div>
      <div class="widget-user-header" style="background-color: #dea6c4 !important; padding: 10px; border-top-left-radius: 0px; border-top-right-radius: 0px;">
        <div class="widget-user-image">
          <img class="img-circle info_profile-pic" id="widget-user-picture" src="{{ asset('img/Atendimentos/Pessoas/Perfil/0.png') }}" alt="User Avatar">
        </div>
        <h5 class="widget-user-desc" id="widget-user-nickname">Apelido</h5>
        <h6 class="widget-user-desc" id="widget-user-name">Nome</h6>
        <p class="widget-user-desc" id="widget-user-desc" style="margin-bottom: 0px">Observação</p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
<style type="text/css">

</style>
@endpush

@push('js')
<script>
//
$(document).ready(function()
{
  pdv_venda =
  {
    id              : {{ $venda->id ?? "null" }},
    id_caixa        : {{ $caixa['db']->id }},
    id_usuario      : {{ Auth::User()->id }},
    id_cliente      : {{ $venda->id_cliente ?? "null" }},
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
    $('#overlay-cliente').hide();
  }, 1000);
});
// ==========================================================================================================================================

function selecionarCliente(id)
{
  $('#overlay-cliente').show();

  pdv_venda.id_cliente = id



  setTimeout(function() {
    $('#overlay-cliente').hide();
  }, 250);
}



</script>
@endpush
