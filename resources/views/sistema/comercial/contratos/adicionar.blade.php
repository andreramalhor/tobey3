@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="overlay" id="contratos-overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Novo Contrato</h3>
      </div>
      <div class="card-body p-0">
        <div id="stepper1" class="bs-stepper">
          <div class="bs-stepper-header">
            <div class="step" data-target="#content_contratos">
              <button type="button" class="btn step-trigger px-2 pt-3 pb-0">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Aluno</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#content_contratos_detalhes">
              <button type="button" class="btn step-trigger px-2 pt-3 pb-0">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Pedagógico</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#content_contratos_pagamentos">
              <button type="button" class="btn step-trigger px-2 pt-3 pb-0">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Financeiro</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content px-2 pt-0 pb-3">
            <div id="content_contratos" class="content">
              @include('sistema.comercial.contratos.auxiliares.step0_aluno', [ 'clientes' => $clientes ])
            </div>
            
            <div id="content_contratos_detalhes" class="content"></div>
            <div id="content_contratos_pagamentos" class="content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="contrato_resumo">
  {{-- INICIO DA PARTE DE RESUMO  --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Resumo da Venda</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="row invoice-info">
            <h7><b>CLIENTE</b></h7></br>
            <div class="col-sm-2 invoice-col">
              <strong>#ID</strong><br>
              <p class="text-muted mb-1">{{ isset($venda->cliente) ? $venda->cliente->id : '0' }}</p>
            </div>
            
            <div class="col-sm-4 invoice-col">
              <strong>Nome</strong><br>
              <p class="text-muted mb-1">
                {{ isset($venda->cliente) ? $venda->cliente->nome : '(Cliente sem cadastro)' }}{{ isset($venda->cliente) ? ' - ('.$venda->cliente->apelido.')' : '' }}
                @if(isset($venda->cliente))
                &nbsp;&nbsp;<a href="" class="text-muted" data-bs-toggle="modal" data-bs-target="#modal_agendamentos_hoje" style="cursor: pointer;"><b><i class="fa-solid fa-circle-info"></i></b></a>
                @endif
              </p>

            </div>
            
            <div class="col-sm-2 invoice-col">
              <strong>CPF</strong><br>
              @if(!isset($venda->cliente))
              <p class="text-muted">000.000.000.00</p>
              @elseif(isset($venda->cliente) && !isset($venda->cliente->cpf))
              <a class="text-red" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal_cpf"><b><i class="fa-solid fa-triangle-exclamation"></i></b></a>
              @else
              <p class="text-muted" data-bs-toggle="modal" data-bs-target="#modal_cpf">{{ $venda->cliente->cpf }}&nbsp;&nbsp;<a style="cursor: pointer;"><b><i class='fa-solid fa-pencil'></i></b></a></p>
              @endif
            </div>
            
            @if(isset($venda->cliente) && $venda->cliente->saldo_conta != 0)
            <div class="col-sm-2 invoice-col">
              <strong>Saldo em Conta Interna</strong><br>
              <p class="text-muted {{ isset($venda->cliente) && $venda->cliente->saldo_conta >= 0  ? 'text-green' : 'text-red' }}">R$ {{ isset($venda->cliente) ? number_format($venda->cliente->saldo_conta, 2, ',', '.') : '000.000.000.00' }}</p>
            </div>
            @endif
            
            @if(isset($venda->cliente))
            @php $qtd_agendamentos = $venda->cliente->iemzmwadhadlask->where('status', '=', 'Confirmado')->whereBetween('created_at', [\Carbon\Carbon::today()->startOfDay(), \Carbon\Carbon::today()->endOfDay()])->count() @endphp
            @endif
            @if(isset($venda->cliente) && $qtd_agendamentos > 0 )
            <div class="col-sm-2 invoice-col">
              <strong>Serviços Agendados</strong><br>
              <p class="text-muted" data-bs-toggle="modal" data-bs-target="#modal_agendamentos_hoje">{{ $qtd_agendamentos }}&nbsp;&nbsp;<a style="cursor: pointer;"><b><i class='fa-solid fa-calendar-plus text-green'></i></b></a></p>
            </div>
            @endif              
          </div>
          
          <div class="row">
            <div class="col-7">
              <h7 class="pl-0"><b>PRODUTOS / SERVIÇOS</b></h7></br>
              <div class="col-12 table-responsive pl-0">
                <table class="table table-hover table-condensed table-sm table-striped no-padding table-valign-middle">
                  <thead class="table-dark">
                    <tr>
                      <th style="width: 10%;">#ID</th>
                      <th style="width: auto;">Descrição</th>
                      <th style="width: auto;">Profissional</th>
                      <th style="width: 15%;" class="text-right">Valor</th>
                      <th style="width: 10%;" class="text-center">Qtd</th>
                      <th style="width: 15%;" class="text-right">Subtotal</th>
                      <th style="width: 5%;" class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($venda->pdv_vendas_detalhes) && count($venda->pdv_vendas_detalhes) > 0 )
                      @foreach($venda->pdv_vendas_detalhes as $key => $produto)
                      <tr>
                        <td>{{ $produto['id_servprod'] }}</td>
                        <td>{{ $produto['nome'] }}</td>
                        <td>{{ isset($produto['fin_contas_internas']['apelido']) ? $produto['fin_contas_internas']['apelido'] : '' }}</td>
                        <td class="text-right">{{ number_format($produto['vlr_negociado'] + $produto['vlr_dsc_acr'], 2, ',', '.') }}</td>
                        <td class="text-center">{{ $produto['quantidade'] }}</td>
                        <td class="text-right">{{ number_format($produto['vlr_final'], 2, ',', '.') }}</td>
                        <td class="text-center">
                          <a onclick="pdv_vendas_detalhes_excluir({{ $produto["identificador"] }})" class="text-muted text-red" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-times"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    @else
                    <tr>
                      <td colspan="7" class="text-center">Ainda não foi lançado nenhum produto / serviço.</td>
                    </tr>
                    @endif
                  </tbody>
                  @if(isset($venda->pdv_vendas_detalhes) && count($venda->pdv_vendas_detalhes) > 0 )
                  <tfoot>
                    <tr>
                      <th>{{ count($venda->pdv_vendas_detalhes) }}</th>
                      <th></th>
                      <th></th>
                      <th class="text-right">{{ number_format($venda->pdv_vendas_detalhes->sum('vlr_negociado') + $venda->pdv_vendas_detalhes->sum('vlr_dsc_acr'), 2, ',', '.') }}</th>
                      <th class="text-center">{{ $venda->pdv_vendas_detalhes->sum('quantidade') }}</th>
                      <th class="text-right">{{ number_format($venda->pdv_vendas_detalhes->sum('vlr_final'), 2, ',', '.') }}</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  @endif
                </table>
              </div>        
            </div>
            
            <div class="col-5">
              <h7 class="pl-0"><b>PAGAMENTOS</b></h7></br>
              <div class="col-12 table-responsive pl-0">
                <table class="table table-hover table-condensed table-sm table-striped no-padding table-valign-middle">
                  <thead class="table-dark">
                    <tr>
                      <th style="width: auto;">Descrição</th>
                      <th style="width: 15%;" class="text-center">Parcela</th>
                      <th style="width: 20%;" class="text-center">Dt Prevista</th>
                      <th style="width: 15%;" class="text-right">Valor</th>
                      <th style="width: 5%;" class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($venda->pdv_vendas_pagamentos) && count($venda->pdv_vendas_pagamentos) > 0 )
                      @foreach($venda->pdv_vendas_pagamentos as $key => $pagamento)
                      <tr>
                        <td>{{ $pagamento['descricao'] }}</td>
                        <td class="text-center">{{ $pagamento['parcela'] }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($pagamento['dt_prevista'])->format('d/m/Y') ?? 'xx' }}</td>
                        <td class="text-right">{{ number_format($pagamento['valor'], 2, ',', '.') }}</td>
                        <td class="text-center">
                          <a onclick="pdv_vendas_pagamentos_excluir({{ $pagamento["identificador"] }})" class="text-muted text-red" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-times"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    @else
                    <tr>
                      <td colspan="6" class="text-center">Ainda não há registros de pagamentos.</td>
                    </tr>
                    @endif
                  </tbody>
                  @if(isset($venda->pdv_vendas_pagamentos) && count($venda->pdv_vendas_pagamentos) > 0 )
                  <tfoot>
                    <tr>
                      <th>{{ count($venda->pdv_vendas_pagamentos) }}</th>
                      <th></th>
                      <th></th>
                      <th class="text-right">{{ number_format($venda->pdv_vendas_pagamentos->sum('valor'), 2, ',', '.') }}</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  @endif
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

@push('js')
<script>
//
$(document).ready(function()
{
  index_d = 0
  index_p = 0

  temp = {}
  temp.com_contratos_detalhes   = {}
  temp.com_contratos_pagamentos = {}
  temp.ger_formas_pagamentos = {}
  temp.com_contratos_detalhes.fin_contas_internas = {}
  temp.ger_formas_pagamentos.fin_contas_internas = {}

  com_contratos = []
  com_contratos_detalhes = []
  com_contratos_pagamentos = []
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
  $('#contratos-overlay').show()
  // contratos_form_preencher()

  if(event.detail.indexStep == 0)
  {
    $('#contratos-overlay').show()
    cliente_selecionado(0)
  }
  else if(event.detail.indexStep == 1)
  {
    $('#contratos-overlay').show()
    servprod_carregar()
  }
  else if(event.detail.indexStep == 2)
  {
    pagamentos_carregar()
  }

  setTimeout(function() {
    $('#contratos-overlay').hide()
  }, 500);
})

function servprod_carregar()
{
  var url    = "{{ route('com.contratos.etapa_servprod') }}";  

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#content_contratos_detalhes').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '8135944a' ] )
  .then(function()
  {
    $('.select2').select2();
    
    setTimeout(function() {
      $('#contratos-overlay').hide()
    }, 500);
  })
}

function pagamentos_carregar()
{
  var url = "{{ route('com.contratos.etapa_pagamento') }}";  

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#content_contratos_pagamentos').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '2242814a' ] )
  .then(function()
  {
    $('.select2').select2();
    setTimeout(function() {
      $('#contratos-overlay').hide()
    }, 500);
  })
}

// function contratos_form_preencher()
// {
//   $('#contratos-overlay').hide()

//   var url = "{{ route('com.contratos.resumo') }}";  
  
//   dados = {
//     com_contratos : com_contratos,
//     com_contratos_detalhes : com_contratos_detalhes,
//     com_contratos_pagamentos : com_contratos_pagamentos,
//   }

//   axios.post(url, dados)
//   .then(function(response)
//   {
//     // console.log(response.data)
//     $('#contrato_resumo').empty().append(response.data)
//   })
{{-- @include('includes.catch', [ 'codigo_erro' => '5261062a' ] ) --}}
//   .then(function()
//   {
//     setTimeout(function() {
//       $('#contratos-overlay').hide()
//     }, 500);
//   })
// }

function com_contratos_detalhes_excluir( identificador )
{
  index = collect(com_contratos_detalhes).firstWhere('identificador', identificador)
  
  com_contratos_detalhes = collect(com_contratos_detalhes).reject(value => value.identificador == index.identificador )
  
  // contratos_form_preencher()
}
  

function com_contratos_pagamentos_excluir( identificador )
{
  index = collect(com_contratos_pagamentos).firstWhere('identificador', identificador)
  
  com_contratos_pagamentos = collect(com_contratos_pagamentos).reject(value => value.identificador == index.identificador )
  
  formaspagamentos_verifica_valores()
  // contratos_form_preencher()
}

function contratos_registrar()
{
  $('#contratos-overlay').show()

  var url = "{{ route('com.contratos.gravar') }}";  
  
  dados = {
    com_contratos : com_contratos,
    com_contratos_detalhes : com_contratos_detalhes,
    com_contratos_pagamentos : com_contratos_pagamentos,
  }

  axios.post(url, dados)
  .then(function(response)
  {
    console.log(response.data)
    toastrjs(response.data.type, response.data.message);
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '6381506a' ] )
  .then(function()
  {
    setTimeout(function() {
      $('#contratos-overlay').hide()
    }, 5000);
  })
}
</script>
@endpush
