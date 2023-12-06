@extends('layouts.app')

@section('content')
<form method="POST" class="form" action="{{ route('caixa.validated', $caixa->id) }}" autocomplete="off">
@csrf()
{{ method_field('PATCH') }}

<div class="row">
  <div class="col-xs-12">
    <div class="card card-success">
      <div class="card-header with-border nav-tabs-custom">
        <h3 class="card-title">Validação do Caixa</h3>
      </div>
      <div class="card-body">
        <input type="hidden" name="pdv_caixas[dt_validacao]" value="{{ \Carbon\Carbon::now() }}">
        <input type="hidden" name="pdv_caixas[id_usuario_validacao]" value="{{ Auth::User()->id }}">
        <input type="hidden" name="pdv_caixas[status]" value="Validado">
        <div class="row">
          <div class="col-xs-12">
            <table class="table table-hover table-bordered table-condensed">
              <h4 class="text-center"><strong><font color="#1F618D">Pagamentos das Vendas</font></strong></h4>
              <tr style="background-color: #222d32; color: white;">
                <th class="text-center">D/R</th>
                <th class="text-center">Informações</th>
                <th class="text-center">Vlr Bruto</th>
                <th class="text-center">% Taxa Cartão</th>
                <th class="text-center">Vlr Taxa Cartão</th>
                <th class="text-center">Vlr Final</th>
                <th class="text-center">Parcela</th>
                <th class="text-center">Forma de Pagamento</th>
                <th class="text-center">Dt Prevista</th>
              </tr>
              @php
                $indice = 0;
                $vlr_bruto = 0;
                $vlr_desc = 0;
                $vlr_final = 0;
                $vlr_geral = 0;
              @endphp
              @foreach($caixa->PDVVendasPagamentos->groupBy('qmbnkthuczqdsdn.forma') as $tipo => $forma)
                @switch($tipo)
                  @case('Cartão de Débito')
                  @case('Cartão de Crédito')
{{-- @dd($tipo) --}}
                      <td class="text-center" colspan="9" style="background-color: lightgray; color: #1F618D;"><strong>Pagamentos - {{ $tipo }}</strong></td>
                      @foreach($forma as $cada)
                        <tr>
                          <td class="text-center">R</td>
                          <td>{{ 'Comanda nº '.$cada->id_comanda.', de '.$cada->PDVVendasVendasPagamentos->lufqzahwwexkxli->apelido.', com valor total de R$ '.number_format($cada->valor, 2, ',', '.') }}</td>
                          <td class="text-right">{{ number_format($cada->valor, 2, ',', '.') }}</td>
                          <td class="text-right">{{ number_format($cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0, 2, ',', '.') }} % </td>
                          <td class="text-right">{{ number_format($cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0 * $cada->valor / 100, 3, ',', '.') }}</td>
                          <td class="text-right">{{ number_format($cada->valor - ($cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0 * $cada->valor / 100), 2, ',', '.') }}</td>
                          <td class="text-center">{{ $cada->parcela }}</td>
                          <td>{{ $tipo }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($cada->dt_prevista)->format('d/m/Y') }}</td>
                        </tr>
                        <input type="hidden" name="pdv_comandas_pagamentos['.$indice.'][id]"                value="{{ $cada->id }}">
                        <input type="hidden" name="pdv_comandas_pagamentos['.$indice.'][status]"            value="Validado">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][id_pagamento]"       value="{{ $cada->id }}">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][id_forma_pagamento]" value="{{ $cada->id_forma_pagamento }}">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][vlr_real]"           value="{{ $cada->valor }}">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][prc_descontado]"     value="{{ $cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0 }}">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][vlr_final]"          value="{{ $cada->valor - ($cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0 * $cada->valor / 100) }}">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][dt_prevista]"        value="{{ $cada->dt_prevista }}">
                        <input type="hidden" name="fin_pagamentos_cartoes['.$indice.'][status]"             value="Aguardando">
                        @php
                          $indice = $indice + 1;
                          $vlr_bruto = $vlr_bruto + $cada->valor;
                          $vlr_desc = $vlr_desc + ($cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0 * $cada->valor / 100);
                          $vlr_final = $vlr_final + ($cada->valor - ($cada->PDVFormasPagamentosComandasPagamentos->taxa ?? 0 * $cada->valor / 100));
                          $vlr_geral = $vlr_final;
                        @endphp
                      @endforeach
                      <tr>
                        <th class="text-center">{{ $forma->count() }}</th>
                        <th class="text-center"></th>
                        <th class="text-right">{{ number_format($forma->sum('valor'), 2, ',', '.') }}</th>
                        <th class="text-center"></th>
                        <th class="text-right">{{ number_format($vlr_desc, 2, ',', '.') }}</th>
                        <th class="text-right">{{ number_format($vlr_final, 2, ',', '.') }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    @break

                  @case('Dinheiro')
                      <td class="text-center" colspan="9" style="background-color: lightgray; color: #1F618D;"><strong>Pagamentos - {{ $tipo }}</strong></td>
                        <tr>
                          <td class="text-center">R</td>
                          <td>Pagamentos no caixa {{$caixa->id}}, no {{ $tipo }} no dia {{ \Carbon\Carbon::parse($forma->first()->created_at)->format('d/m/Y') }}, nº de comandas: {{$forma->count()}}</td>
                          <td class="text-right">{{ number_format($forma->sum('valor'), 2, ',', '.') }}</td>
                          <td class="text-center"> - </td>
                          <td class="text-center"> - </td>
                          <td class="text-right">{{ number_format($forma->sum('valor'), 2, ',', '.') }}</td>
                          <td class="text-center">{{ $forma->first()->parcela }}</td>
                          <td>{{ $tipo }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($forma->first()->dt_prevista)->format('d/m/Y') }}</td>
                        </tr>
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][tipo]"                    value="R">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_banco]"                value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_conta]"                value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][num_documento]"           value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_cliente]"              value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][informacao]"              value="Pagamentos no caixa {{ $caixa->id }}, no {{ $tipo }} no dia {{ \Carbon\Carbon::parse($forma->first()->created_at)->format('d/m/Y') }}, nº de comandas: {{ $forma->count() }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][vlr_bruto]"               value="{{ $forma->sum('valor') }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][vlr_dsc_acr]"             value="0">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][vlr_final]"               value="{{ $forma->sum('valor') }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][parcela]"                 value="{{ $forma->first()->parcela }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_forma_pagamento]"      value="{{ $forma->first()->id_forma_pagamento }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][descricao]"               value="{{ $tipo }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][dt_vencimento]"           value="{{ $forma->first()->dt_prevista }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][dt_recebimento]"          value="{{ $forma->first()->dt_prevista }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][dt_confirmacao]"          value="{{ Carbon\Carbon::now() }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_usuario_lancamento]"   value="{{ Auth::User()->id }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_usuario_confirmacao]"  value="{{ Auth::User()->id }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_caixa]"                value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][id_lancamento_origem]"    value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][origem]"                  value="{{ null }}">
                        <input type="hidden" name="fin_lancamentos_dinheiro['.$indice.'][status]"                  value="Validado">
                        <tr>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                          <th class="text-right">{{ number_format($forma->sum('valor'), 2, ',', '.') }}</th>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                          <th class="text-right">{{ number_format($forma->sum('valor'), 2, ',', '.') }}</th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                        @php
                          $indice = $indice + 1;
                        @endphp
                    @break

                  @default
                    {{-- {{ dd($tipo) }} --}}
                    {{-- {{ dd($caixa->PDVVendasPagamentos->groupBy('PDVFormasPagamentosComandasPagamentos.forma')) }} --}}
                @endswitch

              @endforeach





              {{-- {{ dd($caixa->PDVVendasPagamentos->groupBy('PDVFormasPagamentosComandasPagamentos.forma')) }} --}}
                {{-- @foreach($forma as $forma) --}}

              {{-- @foreach($caixa->PDVVendasPagamentos->where('id_caixa', $caixa->id) as $forma) --}}
                {{-- @if($forma->PDVFormasPagamentosComandasPagamentos->forma == 'Cartão de Débito' OR $forma->PDVFormasPagamentosComandasPagamentos->forma == 'Cartão de Crédito' )
                  <tr>
                    <td class="text-center">R</td>
                    <td>{{ 'Comanda nº '.$forma->id_comanda.', de '.$forma->PDVComandasComandasPagamentos->AtdPessoasClientesComandas->apelido.', com valor total de R$ '.number_format($forma->PDVComandasComandasPagamentos->vlr_final, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($forma->valor, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($forma->PDVFormasPagamentosComandasPagamentos->taxa ?? 0, 2, ',', '.') }} % </td>
                    <td class="text-right">{{ number_format($forma->PDVFormasPagamentosComandasPagamentos->taxa * $forma->valor / 100, 3, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($forma->valor - ($forma->PDVFormasPagamentosComandasPagamentos->taxa * $forma->valor / 100), 2, ',', '.') }}</td>
                    <td class="text-center">{{ $forma->parcela }}</td>
                    <td>{{ $forma->PDVFormasPagamentosComandasPagamentos->forma }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($forma->dt_prevista)->format('d/m/Y') }}</td>
                  </tr>
                  @include('includes.formulario.hidden', ['c_nm' => 'pdv_comandas_pagamentos['.$indice.'][id]',                  'c_vl'=> $forma->id ])
                  @include('includes.formulario.hidden', ['c_nm' => 'pdv_comandas_pagamentos['.$indice.'][status]',              'c_vl'=> 'Validado' ])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][id_pagamento]',         'c_vl'=> $forma->id ])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][id_forma_pagamento]',   'c_vl'=> $forma->id_forma_pagamento])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][vlr_real]',             'c_vl'=> $forma->valor ])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][prc_descontado]',       'c_vl'=> $forma->PDVFormasPagamentosComandasPagamentos->taxa ])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][vlr_final]',            'c_vl'=> $forma->valor - ($forma->PDVFormasPagamentosComandasPagamentos->taxa * $forma->valor / 100) ])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][dt_prevista]',          'c_vl'=> $forma->dt_prevista ])
                  @include('includes.formulario.hidden', ['c_nm' => 'fin_pagamentos_cartoes['.$indice.'][status]',               'c_vl'=> 'Aguardando' ])
                  @php
                    $indice = $indice + 1;
                    $vlr_bruto = $vlr_bruto + $forma->valor;
                    $vlr_desc = $vlr_desc + ($forma->PDVFormasPagamentosComandasPagamentos->taxa * $forma->valor / 100);
                    $vlr_final = $vlr_final + ($forma->valor - ($forma->PDVFormasPagamentosComandasPagamentos->taxa * $forma->valor / 100));
                    $vlr_geral = $vlr_final;
                  @endphp
              @endif
              @endforeach
              <tr>
                <th class="text-center">{{ $indice }}</th>
                <th class="text-center"></th>
                <th class="text-right">{{ number_format($vlr_bruto, 2, ',', '.') }}</th>
                <th class="text-center"></th>
                <th class="text-right">{{ number_format($vlr_desc, 2, ',', '.') }}</th>
                <th class="text-right">{{ number_format($vlr_final, 2, ',', '.') }}</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <td class="text-center" colspan="9" style="background-color: lightgray; color: #1F618D;"><strong>Pagamentos - Outras Formas</strong></td>
              @php
                $indice = 0;
                $vlr_bruto = 0;
              @endphp
 --}}
{{-- 
              @foreach($caixa->PDVVendasPagamentos as $forma)
 --}}
              {{-- @foreach($caixa->PDVVendasPagamentos->where('id_caixa', $caixa->id) as $forma) --}}
{{-- 
                @if($forma->PDVFormasPagamentosComandasPagamentos->forma != 'Cartão de Débito' AND $forma->PDVFormasPagamentosComandasPagamentos->forma != 'Cartão de Crédito' )
                  <tr>
                    <td class="text-center">R</td>
                    <td>{{ 'Comanda nº '.$forma->id_comanda.', de '.$forma->PDVComandasComandasPagamentos->AtdPessoasClientesComandas->apelido.', com valor total de R$ '.number_format($forma->PDVComandasComandasPagamentos->vlr_final, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($forma->valor, 2, ',', '.') }}</td>
                    <td colspan="2"></td>
                    <td class="text-right">{{ number_format($forma->valor, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $forma->parcela }}</td>
                    <td>{{ $forma->PDVFormasPagamentosComandasPagamentos->forma }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($forma->dt_prevista)->format('d/m/Y') }}</td>
                  </tr>
                  @include('includes.formulario.input', ['c_nm' => 'pdv_comandas_pagamentos['.($indice + 100000).'][id]',       'c_vl'=> $forma->id ])
                  @include('includes.formulario.input', ['c_nm' => 'pdv_comandas_pagamentos['.($indice + 100000).'][status]',   'c_vl'=> 'Validado' ])
 --}}
{{--                   @if($forma->PDVFormasPagamentosComandasPagamentos->recebimento == 'Manual')
                    {{ dd($forma->PDVFormasPagamentosComandasPagamentos) }}
                    @include('includes.formulario.input', ['c_nm' => 'pdv_comandas_pagamentos['.($indice + 100000).'][status]',   'c_vl'=> 'Validado' ])
                    @include('includes.formulario.input', ['c_nm' => 'manual['.$indice.'][id]',       'c_vl'=> $forma->id ])
                  @endif --}}
{{-- 
                  @php
                    $indice = $indice + 1;
                    $vlr_bruto = $vlr_bruto + $forma->valor;
                    $vlr_geral = $vlr_geral + $forma->valor;
                  @endphp
                @endif
              @endforeach
              <tr>
                <th class="text-center">{{ $indice }}</th>
                <th class="text-center"></th>
                <th class="text-right">{{ number_format($vlr_bruto, 2, ',', '.') }}</th>
                <th class="text-center" colspan="2"></th>
                <th class="text-right">{{ number_format($vlr_bruto, 2, ',', '.') }}</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr style="background-color: darkgray;">
                <th class="text-center">{{ $caixa->PDVVendasPagamentos->count() }}</th>
                <th class="text-center"></th>
                <th class="text-right">{{ number_format($caixa->PDVVendasPagamentos->sum('valor'), 2, ',', '.') }}</th>
                <th class="text-center" colspan="2"></th>
                <th class="text-right">{{ number_format($vlr_geral, 2, ',', '.') }}</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
 --}}
            </table>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <table class="table table-hover table-bordered table-condensed">
              <h4 class="text-center"><strong><font color="#6E2C00">Lançamentos Financeiros</font></strong></h4>
              <tr style="background-color: #222d32; color: white;">
                <th class="text-center">D/R</th>
                <th class="text-center">Conta Contábil</th>
                <th class="text-center">Informações</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Parcela</th>
                <th class="text-center">Forma de Pagamento</th>
                <th class="text-center">Dt Previsão</th>
              </tr>
              @php
                $indice = 0
              @endphp
              @foreach($caixa->FinLancamentos->groupBy('tipo') as $tipo => $grupo)
                <td class="text-center" colspan="7" style="background-color: lightgray; color: #6E2C00;"><strong>
                  @if($tipo == "R") Receita
                  @elseif($tipo == "D") Despesa
                  @elseif($tipo == "T") Transferência
                  @endif
                </strong></td>
                @foreach($grupo as $lancamento)
                  <tr>
                    <td class="text-center">{{ $lancamento->tipo }}</td>
                    <td class="text-center text-nowrap">{{ $lancamento->conta ?? 'outro'  }}</td>
                    <td>{{ 'Refetente a '.$lancamento->informacao  }}</td>
                    <td class="text-right">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $lancamento->parcela }}</td>
                    <td>{{ $lancamento->ueifnsjfwefnskd->forma ?? 'Forma de Pagamento não reconhecida' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($lancamento->dt_vencimento)->format('d/m/Y') }}</td>
                  </tr>
                  <input type="hidden" name="fin_lancamentos['.$indice.'][id]"                     value="{{ $lancamento->id }}">
                  <input type="hidden" name="fin_lancamentos['.$indice.'][dt_confirmacao]"         value="{{ \Carbon\Carbon::now() }}">
                  <input type="hidden" name="fin_lancamentos['.$indice.'][id_usuario_confirmacao]" value="{{ Auth::User()->id }}">
                  <input type="hidden" name="fin_lancamentos['.$indice.'][status]"                 value="Validado">
                  @php $indice = $indice + 1 @endphp
                @endforeach
              @endforeach
{{--               <tr style="background-color: darkgray;">
                <th class="text-center">{{ $lancamento->count() }}</th>
                <th class="text-center" colspan="2"></th>
                <th class="text-right">{{ number_format($lancamento->where('tipo', 'R')->sum('vlr_final') - $lancamento->where('tipo', 'D')->sum('vlr_final'), 2, ',', '.') }}</th>
                <th class="text-right">{{ number_format($lancamento->where('tipo', 'T')->sum('vlr_final'), 2, ',', '.') }}</th>
                <th></th>
                <th></th>
              </tr> --}}
            </table>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a class="btn btn-default" href="{{ route('pdv.caixas') }}">Voltar</a>
        <button type="submit" class="btn btn-success">Validar</button>
      </div>
    </div>
  </div>
</div>
</form>
@stop
