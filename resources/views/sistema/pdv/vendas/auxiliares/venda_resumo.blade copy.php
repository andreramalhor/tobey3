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
            @php
              $qtd_agendamentos = $venda->
                                        cliente->
                                        iemzmwadhadlask->
                                        whereBetween('created_at',
                                        [ 
                                          \Carbon\Carbon::today()->startOfDay(), 
                                          \Carbon\Carbon::today()->endOfDay() 
                                        ])->
                                        count();
            @endphp
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

@if(isset($venda->cliente))
  @include('sistema.atendimentos.pessoas.auxiliares.modal_cpf', [
    'id_pessoa'     => $venda->cliente->id,
    'cpf_anterior'  => $venda->cliente->cpf,
    'then_function' => 'vendas_form_preencher()',
  ])
  
  @if($qtd_agendamentos > 0))
    @include('includes.modal_agendamentos_hoje', [
      'id_pessoa'     => $venda->cliente->id,
      'cpf_anterior'  => $venda->cliente->cpf,
      'then_function' => 'vendas_form_preencher()',
      ])
  @endif
  
@endif
