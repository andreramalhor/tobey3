@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="overlay" id="vendas-overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Nova Venda</h3>
      </div>
      <div class="card-body p-0">
        <div id="stepper1" class="bs-stepper">
          <div class="bs-stepper-header">
            <div class="step" data-target="#content_vendas">
              <button type="button" class="btn step-trigger px-2 pt-3 pb-0">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Cliente</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#content_vendas_detalhes">
              <button type="button" class="btn step-trigger px-2 pt-3 pb-0">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Serviços</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#content_vendas_pagamentos">
              <button type="button" class="btn step-trigger px-2 pt-3 pb-0">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Pagamento</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content px-2 pt-0 pb-3">
            <div id="content_vendas" class="content">
              @include('sistema.pdv.vendas.auxiliares.step0_cliente', [ 'clientes' => $clientes ])
            </div>
            
            <div id="content_vendas_detalhes" class="content"></div>
            <div id="content_vendas_pagamentos" class="content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="venda_resumo"></div>
@endsection

@push('js')
<script>
//
$(document).ready(function()
{
  index_d = 0
  index_p = 0

  temp = {}
  temp.pdv_vendas_detalhes   = {}
  temp.pdv_vendas_pagamentos = {}
  temp.ger_formas_pagamentos = {}
  temp.pdv_vendas_detalhes.fin_contas_internas = {}
  temp.ger_formas_pagamentos.fin_contas_internas = {}

  pdv_vendas = []
  pdv_vendas_detalhes = []
  pdv_vendas_pagamentos = []
})

var stepper1 = new Stepper(document.querySelector('#stepper1'),
{
  linear: true,
  animation: true
})

var stepperEl = document.querySelector('#stepper1')
var stepper = new Stepper(stepperEl)

stepperEl.addEventListener('shown.bs-stepper', function (event)
{
  $('#vendas-overlay').show()
  vendas_form_preencher()

  if(event.detail.indexStep == 0)
  {
    $('#vendas-overlay').show()
    cliente_selecionado(0)
  }
  else if(event.detail.indexStep == 1)
  {
    $('#vendas-overlay').show()
    servprod_carregar()
  }
  else if(event.detail.indexStep == 2)
  {
    pagamentos_carregar()
  }

  setTimeout(function() {
    $('#vendas-overlay').hide()
  }, 500);
})

function servprod_carregar()
{
  var url    = "{{ route('pdv.vendas.etapa_servprod') }}";  

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#content_vendas_detalhes').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '8194186a' ] )
  .then(function()
  {
    $('.select2').select2();
    
    setTimeout(function() {
      $('#vendas-overlay').hide()
    }, 500);
  })
}

function pagamentos_carregar()
{
  var url = "{{ route('pdv.vendas.etapa_pagamento') }}";  

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#content_vendas_pagamentos').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '1306247a' ] )
  .then(function()
  {
    $('.select2').select2();
    setTimeout(function() {
      $('#vendas-overlay').hide()
    }, 500);
  })
}

function vendas_form_preencher()
{
  $('#vendas-overlay').hide()

  var url = "{{ route('pdv.vendas.resumo') }}";  
  
  dados = {
    pdv_vendas : pdv_vendas,
    pdv_vendas_detalhes : pdv_vendas_detalhes,
    pdv_vendas_pagamentos : pdv_vendas_pagamentos,
  }

  axios.post(url, dados)
  .then(function(response)
  {
    console.log(response.data)
    $('#venda_resumo').empty().append(response.data)
  })
  @include('includes.catch', [ 'codigo_erro' => '7392385a' ] )
  .then(function()
  {
    setTimeout(function() {
      $('#vendas-overlay').hide()
    }, 500);
  })
}

function pdv_vendas_detalhes_excluir( identificador )
{
  index = collect(pdv_vendas_detalhes).firstWhere('identificador', identificador)
  
  pdv_vendas_detalhes = collect(pdv_vendas_detalhes).reject(value => value.identificador == index.identificador )
  
  vendas_form_preencher()
}
  

function pdv_vendas_pagamentos_excluir( identificador )
{
  index = collect(pdv_vendas_pagamentos).firstWhere('identificador', identificador)
  
  pdv_vendas_pagamentos = collect(pdv_vendas_pagamentos).reject(value => value.identificador == index.identificador )
  
  formaspagamentos_verifica_valores()
  vendas_form_preencher()
}

function vendas_registrar()
{
  $('#vendas-overlay').show()

  var url = "{{ route('pdv.vendas.gravar') }}";  
  
  dados = {
    pdv_vendas : pdv_vendas,
    pdv_vendas_detalhes : pdv_vendas_detalhes,
    pdv_vendas_pagamentos : pdv_vendas_pagamentos,
  }

  axios.post(url, dados)
  .then(function(response)
  {
    console.log(response.data)
    toastrjs(response.data.type, response.data.message);
    window.location.href = response.data.redirect;
  })
  @include('includes.catch', [ 'codigo_erro' => '2478768a' ] )
  .then(function()
  {
    setTimeout(function() {
      $('#vendas-overlay').hide()
    }, 5000);
  })
}
</script>
@endpush
