@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <form action="{{ route('lancamentos.cartoesconfirmados') }}" method="POST" autocomplete="off" id="form_recebCartoes">
        @csrf()
        <div class="card-header">
          <h3 class="card-title">Confirmar Recebimentos dos Cartões</h3>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-sm table-head-fixed text-nowrap no-padding">
            <thead>
              <tr>
                <th class="text-center">Tipo</th>
                <th class="text-center">Banco</th>
                <th class="text-center">Informação</th>
                <th class="text-center">Vlr Bruto</th>
                <th class="text-center">Vlr Desc.</th>
                <th class="text-center">Vlr Líquido</th>
                <th class="text-center">Forma de Pagamento</th>
                <th class="text-center">Dt Vencimento</th>
                <th class="text-center">Dt Recebimento</th>
                <th class="text-center">ID #</th>
              </tr>
            </thead>
            <tbody>
              @php $indice = 0 @endphp
              @foreach($recebidos->groupBy('dt_prevista') as $dt_prevista => $previstos)
                @foreach($previstos->groupBy('forma') as $tipo => $forma)
                  @foreach($forma->groupBy('bandeira') as $bandeira => $confirmados)
                  <tr>
                    <td class="text-center">R</td>
                    <td class="text-center">{{ $banco->nome }}</td>
                    <td class="text-center">{{ $tipo }} - {{ $bandeira }}</td>
                    <td class="text-center">{{ number_format($confirmados->sum('vlr_real'),2,',','.') }}</td>
                    <td class="text-center">{{ number_format($confirmados->sum('vlr_final') - $confirmados->sum('vlr_real'),2,',','.') }}</td>
                    <td class="text-center">{{ number_format($confirmados->sum('vlr_final'),2,',','.') }}</td>
                    <td class="text-center">Depósito</td>
                    <td class="text-center">{{ Carbon\Carbon::parse($confirmados->first()->dt_prevista)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ Carbon\Carbon::parse($dt_prevista)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $confirmados->first()->id }}</td>
                    
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][tipo]"                        value="R">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_banco]"                    value="{{ $banco->id }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_conta]"                    value={{NULL}}>
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][num_documento]"               value="Recebimento Cartões">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_cliente]"                  value={{NULL}}>
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][informacao]"                  value="{{ $tipo.' - '.$bandeira }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][vlr_bruto]"                    value="{{ $confirmados->sum('vlr_real') }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][vlr_dsc_acr]"                 value="{{ $confirmados->sum('vlr_final') - $confirmados->sum('vlr_real') }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][vlr_final]"                   value="{{ $confirmados->sum('vlr_final') }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][parcela]"                     value="01/01">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_forma_pagamento]"          value="81">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][descricao]"                   value="Depósito">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][dt_vencimento]"               value="{{ $confirmados->first()->dt_prevista }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][dt_recebimento]"              value="{{ $dt_prevista }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][dt_confirmacao]"              value="{{ \Carbon\Carbon::today() }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_usuario_lancamento]"       value="{{ Auth::User()->id }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_usuario_confirmacao]"      value="{{ Auth::User()->id }}">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_caixa]"                    value={{NULL}}>
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][id_lancamento_origem]"        value={{NULL}}>
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][origem]"                      value="fin_pagamentos_cartoes">
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][status]"                      value="Confirmado">
                    @foreach($confirmados as $key => $tiny)
                    <input type="hidden" name="fin_lancamentos[{{ $indice }}][fin_pagamentos_cartoes][{{ $key }}]" value="{{ json_encode($tiny) }}">
                    @endforeach
                  @php $indice = $indice + 1 @endphp
                  @endforeach
                @endforeach
              @endforeach
              <input type="hidden" name="fin_recebCartoes" value="{{ $recebidos }}">
            </tbody>
            <tfoot>
              <tr>
                <th class="text-center" colspan="3"></th>
                <th class="text-center">{{ number_format($recebidos->sum('vlr_real'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($recebidos->sum('vlr_final') - $recebidos->sum('vlr_real'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($recebidos->sum('vlr_final'),2,',','.') }}</th>
                <th class="text-center" colspan="4"></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="card-footer">
          <button type="reset" class="btn btn-default btn-sm">Voltar</button>
          <button type="submit" class="btn btn-success btn-sm pull-right">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
