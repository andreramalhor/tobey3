@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-3">
    <div class="card card-{{ $caixa->cor_status ?? 'default' }} card-outline">
      <div class="card-body box-profile">
        <h3 class="profile-username text-center">#ID do Caixa: {{ $caixa->id }}</h3>
        <p class="text-muted text-center">{{ $caixa->rybeyykhpcgwkgr->nome ?? 'ERRO INDEX CAIXA 1' }} <span class="badge bg-{{ $caixa->cor_status }}">{{ $caixa->status }}</span></p>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Usuário:</b> <a class="float-right">{{ $caixa->kpakdkhqowIqzik->apelido }}</a>
          </li>
          <li class="list-group-item">
            <b>Data do Caixa:</b> <a class="float-right">{{ Carbon\Carbon::parse($caixa->dt_abertura)->format('d/m/Y H:i') }}</a>
          </li>
          @if($caixa->status == 'Fechado')
          <li class="list-group-item">
            <b>Fechado em:</b> <a class="float-right">{{ Carbon\Carbon::parse($caixa->dt_fechamento)->format('d/m/Y H:i') }}</a>
          </li>
          @endif
          @if($caixa->status == 'Validado')
          <li class="list-group-item" style="padding-bottom: 0px">
            <b>Validado em:</b> <a class="float-right">{{ Carbon\Carbon::parse($caixa->dt_validacao)->format('d/m/Y H:i') }}</a>
            <p class="text-muted text-right" style="margin-bottom: 0px">Por: {{ $caixa->leichtmaeskrpdf->apelido ?? 'ERRO SHOW CAIXA 1' }}</p>
          </li>
          @endif
          <li class="list-group-item">
            <b>Aberto com:</b> <a class="float-right">R$ {{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</a>
          </li>
          <li class="list-group-item">
            @if($caixa->status == 'Fechado')
            <b>Fechado com:</b> <a class="float-right">R$ {{ number_format($caixa->vlr_fechamento, 2, ',', '.') }}</a>
            @else
            <b>Saldo Atual:</b> <a class="float-right">R$ {{ number_format($caixa->saldo_atual, 2, ',', '.') }}</a>
            @endif
          </li>
          @if( ($caixa->vlr_fechamento - $caixa->saldo_atual) >= 0.01 || ($caixa->vlr_fechamento - $caixa->saldo_atual) <= -0.01 && $caixa->status != 'Aberto' )
          <li class="list-group-item">
            <b>Diferença:</b>
            @if( ($caixa->vlr_fechamento - $caixa->saldo_atual) > 0 )
            <span class="badge bg-success">Sobrando dinheiro no caixa</span>
            @else
            <span class="badge bg-danger">Faltando dinheiro no caixa</span>
            @endif
            <a class="float-right">R$ {{ number_format($caixa->vlr_fechamento - $caixa->saldo_atual, 2, ',', '.') }}</a>
          </li>
          @endif
        </ul>
      </div>
      @if($caixa->status == 'Aberto')
      <div class="card-footer">
        <a href="{{ route('pdv.caixas.fechar', $caixa->id ) }}" class="btn btn-primary btn-sm float-right">Fechar</a>
      </div>
      @elseif($caixa->status == 'Fechado')
      <div class="card-footer">
        <a href="{{ route('caixa.reopen', $caixa->id ) }}" class="btn btn-warning btn-sm float-left">Reabrir</a>
        <a href="{{ route('pdv.caixas.confirmar', $caixa->id ) }}" class="btn btn-success btn-sm float-right">Validar</a>
      </div>
      @elseif($caixa->status == 'Validado')
      <div class="card-footer">
        <a href="#" class="btn btn-info btn-sm float-right">Imprimir</a>
      </div>
      @endif
    </div>
  </div>
  <div class="col-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#conferencia"          data-bs-toggle="tab">Conferência de Caixa</a></li>
          <li class="nav-item"><a class="nav-link"        href="#comandas"             data-bs-toggle="tab">Comandas</a></li>
          <li class="nav-item"><a class="nav-link"        href="#comandas_pagamentos"  data-bs-toggle="tab">Pgtos Comandas</a></li>
          <li class="nav-item"><a class="nav-link"        href="#transferencias"       data-bs-toggle="tab">Transferências</a></li>
          <li class="nav-item"><a class="nav-link"        href="#saidas"               data-bs-toggle="tab">Saídas</a></li>
          <li class="nav-item"><a class="nav-link"        href="#entradas"             data-bs-toggle="tab">Entradas</a></li>
          
          {{-- <li class="nav-item"><a class="nav-link"        href="#vendas"               data-bs-toggle="tab">Vendas</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link"        href="#pacotes"              data-bs-toggle="tab">Pacotes</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link"        href="#financeiro"           data-bs-toggle="tab">Financeiro</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link"        href="#mensagens"            data-bs-toggle="tab">Mensagens</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link"        href="#anotacoes"            data-bs-toggle="tab">Anotações</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link"        href="#fidelidade"           data-bs-toggle="tab">Fidelidade</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link"        href="#anamneses"            data-bs-toggle="tab">Anamneses</a></li> --}}
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="conferencia">
            <div class="row">
              <div class="col-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Conferência de Caixa</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr style="background-color: #222d32; color: white;" height="30">
                          <th class="text-left">Forma de Pagamento (Comandas)</th>
                          <th class="text-right">Valor</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($pagamentos as $forma)
                        <tr>
                          <td style="padding: 0px 1px" class="text-left">{{ $forma->qmbnkthuczqdsdn->forma ?? $forma->id_forma_pagamento }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($forma->liquido, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                          <td style="padding: 0px 1px" class="text-center" colspan="2">Sem informação</td>
                        </tr>
                        @endforelse
                      </tbody>
                      <tfoot>
                        @if (count($caixa->PDVVendas))
                        <tr>
                          <td style="padding: 0px 1px" class="text-left"><strong>Total</strong></td>
                          <td style="padding: 0px 1px" class="text-right"><strong>{{ number_format($pagamentos->sum('liquido'), 2, ',', '.') }}</strong></td>
                        </tr>
                        @endif
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="comandas">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Comandas</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr style="background-color: #222d32; color: white;" height="30">
                          <th class="text-center">#</th>
                          <th class="text-left">&nbsp;Clientes&emsp;<i class="fas fa-chevron-right"></i>&emsp;Produtos</th>
                          <th class="text-right">Vl. Serviço / Produto</th>
                          <th class="text-right">Vl. Negoc.</th>
                          <th class="text-right">Dsc/Acr</th>
                          <th class="text-right">Vl. Final</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($caixa->PDVVendas->sortBy('id') as $venda)
                        <tr style="background-color: #ececec; font-weight: bold">
                          <td width="5%" style="padding: 0px 1px" class="text-center"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $venda->id }})"><span class="badge bg-pink">{{ $venda->id }}</span></a></td>
                          <td style="padding: 0px 1px" class="text-left" colspan="2"><a href="{{ $venda->lufqzahwwexkxli['nome'] != null ? route('pessoa.show', $venda->lufqzahwwexkxli['id']) : '#' }}">{{ $venda->lufqzahwwexkxli['nome'] != null ? $venda->lufqzahwwexkxli['nome'] : '(Cliente não cadastrado)' }}</a></td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($venda->vlr_prod_serv, 2, ',', '.') }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($venda->vlr_dsc_acr, 2, ',', '.') }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($venda->vlr_final, 2, ',', '.') }}</td>
                        </tr>
                        @forelse($venda->dfyejmfcrkolqjh->sortBy('id') as $detalhesvenda)
                        <tr>
                          <td style="padding: 0px 1px" class="text-right"></td>
                          <td style="padding: 0px 1px" class="text-left">&emsp;{{ $detalhesvenda->kcvkongmlqeklsl->nome ?? $detalhesvenda->id_servprod }}</td>
                          <td style="padding: 0px 1px; color: gray;" class="text-right">{{ number_format($detalhesvenda->vlr_venda, 2, ',', '.') }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($detalhesvenda->vlr_negociado, 2, ',', '.') }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($detalhesvenda->vlr_dsc_acr, 2, ',', '.') }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($detalhesvenda->vlr_final, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                          <td style="padding: 0px 1px" class="text-center" colspan="7"> Não há registro dos produtos dessa comanda.</td>
                        </tr>
                        @endforelse
                        @empty
                        <tr>
                          <td style="padding: 0px 1px" class="text-center" colspan="7"> Não houve comandas nesta data.</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="comandas_pagamentos">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pagamentos das Comandas</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-sm table-bordered">
                      <thead>
                        <tr style="background-color: #222d32; color: white;" height="30">
                          <th style="padding: 0px 1px" class="text-center">#</th>
                          <th style="padding: 0px 1px" class="text-left">&nbsp;Clientes</th>
                          <th width="15%" style="padding: 0px 1px" class="text-center">Dinheiro</th>
                          <th width="15%" style="padding: 0px 1px" class="text-center">Cartão de Débito</th>
                          <th width="15%" style="padding: 0px 1px" class="text-center">Cartão de Crédito</th>
                          <th width="15%" style="padding: 0px 1px" class="text-center">Fiado</th>
                          <th width="15%" style="padding: 0px 1px" class="text-center">Conta Interna</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($caixa->PDVVendas->sortBy('id') as $venda)
                        <tr>
                          <td width="5%" class="text-left"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $venda->id }})"><span class="badge bg-pink">{{ $venda->id }}</span></a></td>
                          <td style="padding: 0px 1px" class="text-left"><a href="{{ $venda->lufqzahwwexkxli['nome'] != null ? route('pessoa.show', $venda->lufqzahwwexkxli['id']) : '#' }}">{{ $venda->lufqzahwwexkxli['nome'] != null ? $venda->lufqzahwwexkxli['nome'] : '(Cliente não cadastrado)' }}</a></td>

                          <td style="padding: 0px 1px" class="text-right">
                            @foreach($venda->xzxfrjmgwpgsnta->groupby('qmbnkthuczqdsdn.forma') as $key => $cada)
                            @if($key == 'Dinheiro')
                            {{ number_format($cada->sum('valor'), 2, ',', '.') }}
                            @endif
                            @endforeach
                          </td>

                          <td style="padding: 0px 1px" class="text-right">
                            @foreach($venda->xzxfrjmgwpgsnta->groupby('qmbnkthuczqdsdn.forma') as $key => $cada)
                            @if($key == 'Cartão de Débito')
                            {{ number_format($cada->sum('valor'), 2, ',', '.') }}
                            @endif
                            @endforeach
                          </td>

                          <td style="padding: 0px 1px" class="text-right">
                            @foreach($venda->xzxfrjmgwpgsnta->groupby('qmbnkthuczqdsdn.forma') as $key => $cada)
                            @if($key == 'Cartão de Crédito')
                            {{ number_format($cada->sum('valor'), 2, ',', '.') }}
                            @endif
                            @endforeach
                          </td>

                          <td style="padding: 0px 1px" class="text-right">
                            @foreach($venda->xzxfrjmgwpgsnta->groupby('qmbnkthuczqdsdn.forma') as $key => $cada)
                            @if($key == 'Fiado')
                            {{ number_format($cada->sum('valor'), 2, ',', '.') }}
                            @endif
                            @endforeach
                          </td>

                          <td style="padding: 0px 1px" class="text-right">
                            @foreach($venda->xzxfrjmgwpgsnta->groupby('qmbnkthuczqdsdn.forma') as $key => $cada)
                            @if($key == 'Conta Interna')
                            {{ number_format($cada->sum('valor'), 2, ',', '.') }}
                            @endif
                            @endforeach
                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td style="padding: 0px 1px" class="text-center" colspan="7"> Não houve comandas nesta data.</td>
                        </tr>
                        @endforelse
                      </tbody>
                      <tfoot>
                        <tr style="background-color: #ececec;">
                          <th class="text-center">{{ $caixa->PDVVendas->count() }}</th>
                          <th></th>
                          <th class="text-right">
                            @foreach($pagamentos as $forma)
                            @if($forma->qmbnkthuczqdsdn->forma == 'Dinheiro')
                            {{ number_format($forma->liquido, 2, ',', '.') }}
                            @endif
                            @endforeach
                          </th>
                          <th class="text-right">
                            @foreach($pagamentos as $forma)
                            @if($forma->qmbnkthuczqdsdn->forma == 'Cartão de Débito')
                            {{ number_format($forma->liquido, 2, ',', '.') }}
                            @endif
                            @endforeach
                          </th>
                          <th class="text-right">
                            @foreach($pagamentos as $forma)
                            @if($forma->qmbnkthuczqdsdn->forma == 'Cartão de Crédito')
                            {{ number_format($forma->liquido, 2, ',', '.') }}
                            @endif
                            @endforeach
                          </th>
                          <th class="text-right">
                            @foreach($pagamentos as $forma)
                            @if($forma->qmbnkthuczqdsdn->forma == 'Fiado')
                            {{ number_format($forma->liquido, 2, ',', '.') }}
                            @endif
                            @endforeach
                          </th>
                          <th class="text-right">
                            @foreach($pagamentos as $forma)
                            @if($forma->qmbnkthuczqdsdn->forma == 'Conta Interna')
                            {{ number_format($forma->liquido, 2, ',', '.') }}
                            @endif
                            @endforeach
                          </th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="transferencias">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Transferências</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-sm table-bordered">
                      <thead>
                        <tr style="background-color: #222d32; color: white;" height="30">
                          <th style="padding: 0px 1px" class="text-center">#</th>
                          <th style="padding: 0px 1px" class="text-left">&nbsp;Origem&emsp;<i class="fas fa-chevron-right"></i>&emsp;Destino</th>
                          <th style="padding: 0px 1px" class="text-right">Valor&ensp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($caixa->FinLancamentos->where('tipo', '=', 'T') as $transferencia)
                        <tr>
                          <td style="padding: 0px 1px" class="text-center">{{ $transferencia->id }}</td>
                          <td style="padding: 0px 1px" class="text-left">{{ $transferencia->informacao }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($transferencia->vlr_final, 2, ',', '.') }}&ensp;</td>
                          @empty
                          <td>
                            <td style="padding: 0px 1px" class="text-center" colspan="3"> Não houve transferêcias neste caixa.</td>
                          </td>
                        </tr>
                        @endforelse
                      </tbody>
                      @if($caixa->FinLancamentos->where('tipo', '=', 'T')->sum('vlr_final') != 0)
                      <tfoot>
                        <tr>
                          <td colspan=2></td>
                          <th class="text-right">{{ number_format($caixa->FinLancamentos->where('tipo', '=', 'T')->sum('vlr_final'), 2, ',', '.') }}</th>
                        </tr>
                      </tfoot>
                      @endif
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="saidas">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Saídas</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-sm table-bordered">
                      <thead>
                        <tr style="background-color: #222d32; color: white;" height="30">
                          <th style="padding: 0px 1px" class="text-center">#</th>
                          <th style="padding: 0px 1px" class="text-left">&nbsp;Pessoa&emsp;<i class="fas fa-chevron-right"></i>&emsp;Descrição</th>
                          <th style="padding: 0px 1px" class="text-right">Valor&ensp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($caixa->FinLancamentos->where('tipo', '=', 'D') as $saidas)
                        <tr>
                          <td style="padding: 0px 1px" class="text-center">{{ $saidas->id }}</td>
                          <td style="padding: 0px 1px" class="text-left"><strong>{{ $saidas->AtdPessoasClientes->apelido ?? $saidas->id_cliente ?? 'Sem Cliente'}}</strong>&ensp;<i class="fas fa-chevron-right"></i>&ensp;{{ $saidas->informacao }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($saidas->vlr_final, 2, ',', '.') }}&ensp;</td>
                          @empty
                          <td>
                            <td style="padding: 0px 1px" class="text-center" colspan="3"> Não houve saídas neste caixa.</td>
                          </td>
                        </tr>
                        @endforelse
                      </tbody>
                      @if($caixa->FinLancamentos->where('tipo', '=', 'D')->sum('vlr_final') != 0)
                      <tfoot>
                        <tr>
                          <td colspan=2></td>
                          <th class="text-right">{{ number_format($caixa->FinLancamentos->where('tipo', '=', 'D')->sum('vlr_final'), 2, ',', '.') }}</th>
                        </tr>
                      </tfoot>
                      @endif
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="entradas">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Entradas</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-sm table-bordered">
                      <thead>
                        <tr style="background-color: #222d32; color: white;" height="30">
                          <th style="padding: 0px 1px" class="text-center">#</th>
                          <th style="padding: 0px 1px" class="text-left">&nbsp;Pessoa&emsp;<i class="fas fa-chevron-right"></i>&emsp;Descrição</th>
                          <th style="padding: 0px 1px" class="text-right">Valor&ensp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($caixa->FinLancamentos->where('tipo', '=', 'R') as $entradas)
                        <tr>
                          <td style="padding: 0px 1px" class="text-center">{{ $entradas->id }}</td>
                          <td style="padding: 0px 1px" class="text-left"><strong>{{ $entradas->AtdPessoasClientes->apelido ?? $entradas->id_cliente ?? 'Sem Cliente'}}</strong>&ensp;<i class="fas fa-chevron-right"></i>&ensp;{{ $entradas->informacao }}</td>
                          <td style="padding: 0px 1px" class="text-right">{{ number_format($entradas->vlr_final, 2, ',', '.') }}&ensp;</td>
                          @empty
                          <td>
                            <td style="padding: 0px 1px" class="text-center" colspan="3"> Não houve entradas neste caixa.</td>
                          </td>
                        </tr>
                        @endforelse
                      </tbody>
                      @if($caixa->FinLancamentos->where('tipo', '=', 'R')->sum('vlr_final') != 0)
                      <tfoot>
                        <tr>
                          <td colspan=2></td>
                          <th class="text-right">{{ number_format($caixa->FinLancamentos->where('tipo', '=', 'R')->sum('vlr_final'), 2, ',', '.') }}</th>
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
  </div>
</div>
@include('sistema.pdv.vendas.auxiliares.resumo')
@endsection
