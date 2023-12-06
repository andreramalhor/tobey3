@extends('layouts.app')

@section('content')
<div class="book">
  <div class="page">
    <div class="subpage">
      <div class="invoice p-3 mb-3">
        </br>
        <div class="row">
          <div class="h4 text-center border-bottom">Relatório de fechamento diário de caixa</div>
          <div class="col-6">
            <h5><i class="fas fa-globe"></i>{{  $empresa->nome ?? 'Nome da empresa'}}</h5>
          </div>
          <div class="col-6">
            <small class="float-right h7">Date: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</small>
          </div>
        </div>
        
        </br>
        
        <div class="row">
          <div class="col-sm-3 invoice-col">
            <spam class="border-bottom">CAIXA</spam>
            <address>
              <strong>#: </strong>{{ $caixa->id }}<br>
              <strong>Local: </strong>{{ $caixa->rybeyykhpcgwkgr->nome }}<br>
              <strong>Status: </strong>{{ $caixa->status }}<br>
            </address>
          </div>
          
          <div class="col-sm-3 invoice-col">
            <spam class="border-bottom">DATAS</spam>
            <address>
              <strong>Abertura: </strong>{{ \Carbon\Carbon::parse($caixa->dt_abertura )->format('d/m/Y H:i:s') }}<br>
              @if(isset($caixa->dt_fechamento))
              <strong>Fechamento: </strong>{{ \Carbon\Carbon::parse($caixa->dt_fechamento )->format('d/m/Y H:i:s') }}<br>
              @else
              <strong>Fechamento: </strong> - <br>
              @endif
              
              @if(isset($caixa->dt_validacao))
              <strong>Validação: </strong>{{ \Carbon\Carbon::parse($caixa->dt_validacao )->format('d/m/Y H:i:s') }}<br>
              @else
              <strong>Validação: </strong> - <br>
              @endif
            </address>
          </div>

          <div class="col-sm-3 invoice-col">
            <spam class="border-bottom">USUÁRIOS</spam>
            <address>
              <strong>Abertura: </strong>{{ $caixa->kpakdkhqowIqzik->apelido }}<br>
              @if(isset($caixa->dt_fechamento))
              <strong>Fechamento: </strong>{{ $caixa->kpakdkhqowIqzik->apelido }}<br>
              @else
              <strong>Fechamento: </strong> - <br>
              @endif
              
              @if(isset($caixa->dt_validacao))
              <strong>Validação: </strong>{{ $caixa->leichtmaeskrpdf->apelido }}<br>
              @else
              <strong>Validação: </strong> - <br>
              @endif
            </address>
          </div>
    
          <div class="col-sm-3 invoice-col">
            <spam class="border-bottom">VALORES</spam>
            <address>
              <strong>Abertura: </strong>R$ {{ number_format($caixa->vlr_abertura, 2, ',', '.') }}<br>
              <strong>Fechamento: </strong>R$ {{ number_format($caixa->vlr_fechamento, 2, ',', '.') }}<br>
              @if(isset($caixa->dt_validacao))
              <strong>Diferença: </strong>R$ {{ number_format($caixa->vlr_fechamento - $caixa->saldo_atual, 2, ',', '.') }}<br>
              @endif
            </address>
          </div>            
        </div>

        <br>

        <div class="row">
          <div class="col-12 table-responsive">
            <spam class="border-bottom">MOVIMENTAÇÕES DO CAIXA</spam>
            <table class="table table-sm table-striped no-padding table-valign-middle projects">
              <thead class="table-dark">
                <tr class="border">
                  <th class="pl-3 pr-3">Hora</th>
                  <th class="pl-3 pr-3 border-left">Tipo</th>
                  <th class="pl-3 pr-3 border-left" colspan="2">Cliente</br><small>Descrição</small><small class="float-right">Preço</small></th>
                  <th class="pl-3 pr-3 border-left text-right">Dinheiro</th>
                  <th class="pl-3 pr-3 border-left text-right">Outros</br><small>Prazo</small></th>
                  <th class="pl-3 pr-3 border-left text-right">Saldo Dinheiro</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border">
                  <td  class="pl-3 pr-3 p-0">{{ \Carbon\Carbon::parse($caixa->dt_abertura )->format('H:i') }}</td>
                  <td  class="pl-3 pr-3 p-0 border-left" colspan="3">Abertura do Caixa</td>
                  <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</td>
                  <td  class="pl-3 pr-3 p-0 border-left text-right"> - </td>
                  <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</td>
                </tr>
                @php $saldo_dinheiro = $caixa->vlr_abertura; @endphp
                @foreach($caixa->rtafathibgwfust->concat($caixa->wskcngeadbjhpdu)->sortBy('created_at') as $lancamento)
                <tr class="border">
                  <td  class="pl-3 pr-3 p-0">{{ \Carbon\Carbon::parse($lancamento->created_at )->format('H:i') }}</td>

                  @if($lancamento->getTable() == 'pdv_vendas')
                  <td  class="pl-3 pr-3 p-0 border-left">Venda</td>
                  @elseif($lancamento->getTable() == 'fin_lancamentos' && $lancamento->tipo == 'R')
                  <td  class="pl-3 pr-3 p-0 border-left">Lançamento - Entrada</td>
                  @elseif($lancamento->getTable() == 'fin_lancamentos' && $lancamento->tipo == 'D')
                  <td  class="pl-3 pr-3 p-0 border-left">Lançamento - Saída</td>
                  @elseif($lancamento->getTable() == 'fin_lancamentos' && $lancamento->tipo == 'T')
                  <td  class="pl-3 pr-3 p-0 border-left">Transferências</td>
                  @else
                  <td  class="pl-3 pr-3 p-0 border-left">ERROR</td>
                  @endif
                  
                  @if($lancamento->getTable() == 'pdv_vendas')
                  <td  class="pl-3 pr-3 p-0 border-left" colspan="2">
                    <a>
                      {{ $lancamento->lufqzahwwexkxli->apelido ?? '' }}
                    </a>
                    @foreach($lancamento->dfyejmfcrkolqjh as $detalhe)
                    <br>
                    <small>
                      {{ $detalhe->kcvkongmlqeklsl->nome }}   
                    </small>
                    <small class=float-right>
                      {{ number_format($detalhe->vlr_final, 2, ',', '.') }}   
                    </small>
                      @endforeach 
                  </td>
                  
                  
                  @elseif($lancamento->getTable() == 'fin_lancamentos')
                  <td  class="pl-3 pr-3 p-0 border-left" colspan="2">
                    <a>
                      {{ $lancamento->qexgzmnndqxmyks->apelido ?? ' ' }}
                    </a>
                    <br>
                    <small>
                      {{ $lancamento->informacao }}   
                    </small>
                  </td>
                  @endif

                              
                  @if($lancamento->getTable() == 'pdv_vendas')
                    <td  class="pl-3 pr-3 p-0 border-left text-right">
                      {{ number_format($lancamento->xzxfrjmgwpgsnta()->where('id_forma_pagamento', '=', 1)->sum('valor'), 2, ',', '.') }}
                    </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right">
                      {{ number_format($lancamento->xzxfrjmgwpgsnta()->where('id_forma_pagamento', '!=', 1)->sum('valor'), 2, ',', '.') }}
                    </td>
                    @php $saldo_dinheiro = $saldo_dinheiro + $lancamento->xzxfrjmgwpgsnta()->where('id_forma_pagamento', '=', 1)->sum('valor'); @endphp
                    <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($saldo_dinheiro, 2, ',', '.') }}</td>

                  @elseif($lancamento->getTable() == 'fin_lancamentos' && $lancamento->id_forma_pagamento == 1 && $lancamento->tipo == 'D' )
                    @php $saldo_dinheiro = $saldo_dinheiro - $lancamento->vlr_final; @endphp
                    <td  class="pl-3 pr-3 p-0 border-left text-right">
                      {{ number_format($lancamento->vlr_final * -1, 2, ',', '.') }}
                    </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right"> - </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($saldo_dinheiro, 2, ',', '.') }}</td>

                  @elseif($lancamento->getTable() == 'fin_lancamentos' && $lancamento->id_forma_pagamento == 1 && $lancamento->tipo == 'R' )
                    @php $saldo_dinheiro = $saldo_dinheiro + $lancamento->vlr_final; @endphp
                    <td  class="pl-3 pr-3 p-0 border-left text-right">
                      {{ number_format($lancamento->vlr_final, 2, ',', '.') }}
                    </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right"> - </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($saldo_dinheiro, 2, ',', '.') }}</td>

                  @elseif($lancamento->getTable() == 'fin_lancamentos' && $lancamento->id_forma_pagamento == 1 && $lancamento->tipo == 'T' )
                    @php $saldo_dinheiro = $saldo_dinheiro + $lancamento->vlr_final; @endphp
                    <td  class="pl-3 pr-3 p-0 border-left text-right">
                      {{ number_format($lancamento->vlr_final, 2, ',', '.') }}
                    </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right"> - </td>
                    <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($saldo_dinheiro, 2, ',', '.') }}</td>

                  @else
                  <td  class="pl-3 pr-3 p-0 border-left">ERROR</td>
                  @endif
                </tr>
                @endforeach
                @if(isset($caixa->dt_fechamento))
                <tr class="border">
                  <td  class="pl-3 pr-3 p-0">{{ \Carbon\Carbon::parse($caixa->dt_fechamento )->format('H:i') }}</td>
                  <td  class="pl-3 pr-3 p-0 border-left" colspan="3">Fechamento do Caixa</td>
                  <td  class="pl-3 pr-3 p-0 border-left text-right"> - </td>
                  <td  class="pl-3 pr-3 p-0 border-left text-right"> - </td>
                  <td  class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($caixa->vlr_fechamento, 2, ',', '.') }}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>  
        </div>
        
        </br>

        <div class="row">
          <div class="col-4 table-responsive">
            <spam class="border-bottom">FORMA DE PAGAMENTOS DAS VENDAS</spam>
            <table class="table table-sm table-striped no-padding table-valign-middle projects">
              <thead class="table-dark">
                <tr class="border">
                  <th class="pl-3 pr-3">Pagamento</th>
                  <th class="pl-3 pr-3 border-left text-right">Valor</th>
                </tr>
              </thead>
              <tbody>
                @foreach($caixa->ssqlnxsbyywplan->sortby('id_forma_pagamento')->groupby('id_forma_pagamento') as $key => $pagamentos)
                <tr class="border">
                  <td class="pl-3 pr-3 p-0 text-left">
                    @if($pagamentos->first()->qmbnkthuczqdsdn->forma != $pagamentos->first()->qmbnkthuczqdsdn->bandeira )
                      {{ $pagamentos->first()->qmbnkthuczqdsdn->forma }} - {{ $pagamentos->first()->qmbnkthuczqdsdn->bandeira }}
                    @else
                      {{ $pagamentos->first()->qmbnkthuczqdsdn->forma }}
                    @endif
                    
                    @if($pagamentos->first()->qmbnkthuczqdsdn->parcela > 1 && $pagamentos->first()->qmbnkthuczqdsdn->prazo > 1)
                      ( {{ $pagamentos->first()->qmbnkthuczqdsdn->parcela }}x )
                    @endif
                  </td>
                  <td class="pl-3 pr-3 p-0 border-left text-right">{{ number_format($pagamentos->sum('valor'), 2, ',', '.') }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr class="border">
                  <th></th>
                  <th class="pl-3 pr-3 p-0 text-right">{{ number_format($caixa->ssqlnxsbyywplan->sum('valor'), 2, ',', '.') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
          
          <div class="col-4"></div>

          <div class="col-4 table-responsive">
            <spam class="border-bottom">RESUMO</spam>
            <table class="table table-sm table-striped no-padding table-valign-middle projects">
              <thead class="table-dark">
                <tr class="border">
                  <th class="pl-3 pr-3">Descrição</th>
                  <th class="pl-3 pr-3 border-left text-right">Valor</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border">
                  <th class="pl-3 pr-3 p-0 text-left">Valor em Caixa Inicial</th>
                  <th class="pl-3 pr-3 border-left text-right">R$ {{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</td>
                </tr>
                <tr class="border">
                  <th class="pl-3 pr-3 p-0 text-left">Entradas em Dinheiro</th>
                  <th class="pl-3 pr-3 border-left text-right">R$ {{ number_format(
                    $caixa->ssqlnxsbyywplan->where('id_forma_pagamento', '=', 1)->sum('valor') +
                    $caixa->wskcngeadbjhpdu->where('tipo', '=', 'R')->sum('vlr_final') +
                    $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                    , 2, ',', '.') }}</td>
                </tr>
                <tr class="border">
                  <th class="pl-3 pr-3 p-0 text-left">Saídas em Dinheiro</th>
                  <th class="pl-3 pr-3 border-left text-right">R$ - {{ number_format(
                    $caixa->wskcngeadbjhpdu->where('tipo', '=', 'D')->sum('vlr_final') +
                    $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                    , 2, ',', '.') }}</td>
                </tr>
                @if(
                  ($caixa->vlr_abertura) + 
                    (
                      $caixa->ssqlnxsbyywplan->where('id_forma_pagamento', '=', 1)->sum('valor') +
                      $caixa->wskcngeadbjhpdu->where('tipo', '=', 'R')->sum('vlr_final') +
                      $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                    ) - 
                    (
                      $caixa->wskcngeadbjhpdu->where('tipo', '=', 'D')->sum('vlr_final') +
                      $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                    ) == ($caixa->vlr_fechamento)
                )
                  <tr class="border">
                    <th class="pl-3 pr-3 p-0 text-left">Valor em Caixa no Fechamento</th>
                    <th class="pl-3 pr-3 border-left text-right">R$ {{ number_format(
                      ($caixa->vlr_abertura) + 
                      (
                        $caixa->ssqlnxsbyywplan->where('id_forma_pagamento', '=', 1)->sum('valor') +
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'R')->sum('vlr_final') +
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                      ) - 
                      (
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'D')->sum('vlr_final') +
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                      )
                      , 2, ',', '.') }}</td>
                  </tr>
                @else
                <tr class="border">
                  <th class="pl-3 pr-3 p-0 text-left">Valor em Caixa no Fechamento</th>
                    <th class="pl-3 pr-3 border-left text-right">R$ {{ number_format(
                      ($caixa->vlr_abertura) + 
                      (
                        $caixa->ssqlnxsbyywplan->where('id_forma_pagamento', '=', 1)->sum('valor') +
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'R')->sum('vlr_final') +
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                      ) - 
                      (
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'D')->sum('vlr_final') +
                        $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final')
                      )
                      , 2, ',', '.') }}</td>
                  </tr>
                @endif              
              </tbody>
              <!-- <tfoot>
                <tr class="border">
                  <th></th>
                  <th class="pl-3 pr-3 p-0 text-right">{{-- number_format($caixa->ssqlnxsbyywplan->sum('valor'), 2, ',', '.') --}}</th>
                </tr>
              </tfoot> -->
            </table>
          </div>
        </div>
        
        <div class="row no-print">
          <div class="col-12">
            <a onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Imprimir</a>
            <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> SubmitPayment</button> -->
            <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-download"></i> Generate PDF</button> -->
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
@endsection
        


@section('js')
<script>
  window.print();
</script>
@endsection

@section('style')
<style>
body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  font: 12pt "Tahoma";
}
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}
.page {
  width: 210mm;
  min-height: 297mm;
  padding: 20mm;
  margin: 10mm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
  padding: 0.5cm;
  border: 3px black solid;
  height: 280mm;
  outline: 1cm white solid;
}

@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;        
  }
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
</style>
@endsection