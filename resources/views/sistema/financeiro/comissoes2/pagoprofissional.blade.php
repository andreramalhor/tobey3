@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Comissões Pagas de {{ $pago->first()->xeypqgkmimzvknq->apelido ?? 'ERRO 9D7.EUQ' }}</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Tipo</th>
              <th class="text-center"># Comanda</th>
              <th class="text-center">Data</th>
              <th class="text-left">Cliente</th>
              <th class="text-left">Serviço / Produto</th>
              <th class="text-right">Vlr Serviço</th>
              <th class="text-right">% da Comissão</th>
              <th class="text-right">Valor da Comissão</th>
              <th class="text-center">Editar</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pago->sortBy('dt_prevista')->sortBy('created_at')->groupby('id_venda') as $comandas)
            @foreach ($comandas as $comissao)
            <tr class="{{ $comissao->status }}" onclick="selectRow(this)" id="{{ $comissao->id }}">
              <td class="text-center">{{ $comissao->id }}</td>
              <td class="text-center">{{ $comissao->tipo }}</td>

              @if($comissao->fonte_origem == 'fin_lancamentos' )
              <td class="text-center"> - </td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
              <td class="text-center"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $comissao->alksdjalsVendaPagamento->id_venda ?? 'ERRO VQR.A5Z' }})"><span class="badge bg-pink">{{ $comissao->alksdjalsVendaPagamento->id_venda ?? 'ERRO 2EH.MKU' }}</span></a></td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
              <td class="text-center"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $comissao->krnclwowqamsjls->id_venda ?? 'ERRO 8X9.3MK' }})"><span class="badge bg-pink">{{ $comissao->krnclwowqamsjls->id_venda ?? 'ERRO J8W.A7J - '.$comissao->id }}</span></a></td>
              @elseif($comissao->fonte_origem == 'fin_conta_interna' )
              <td class="text-center"> - </td>
              @endif

              <td class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y H:i') }}</td>

              @if($comissao->fonte_origem == 'fin_lancamentos' )
              <td class="text-left">{{ $comissao->tipo ?? 'ERRO 8HE.T8B'  }}</td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
              <td class="text-left">
                @foreach($comissao->alksdjalsVendaPagamento->PDVVendasVendasPagamentos->dfyejmfcrkolqjh as $servico)
                {{ $servico->kcvkongmlqeklsl->nome ?? 'ERRO 4TP.K9G' }} <br>
                @endforeach
              </td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
              <td class="text-left">{{ $comissao->krnclwowqamsjls->sbbgaqleesuzlus->lufqzahwwexkxli->apelido ?? 'ERRO WZE.88B'}}</td>
              @elseif($comissao->fonte_origem == 'fin_conta_interna' )
              <td class="text-left">{{ $pago->first()->xeypqgkmimzvknq->apelido ?? 'ERRO RG3.8FJ'}}</td>
              @endif

              @if($comissao->fonte_origem == 'fin_lancamentos' )
              <td class="text-left">Espaço Milady</td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
              {{-- @dd('1as;ldasldk;aslkd') --}}
              <td class="text-left">{{ $comissao->alksdjalsVendaPagamento->PDVVendasVendasPagamentos->lufqzahwwexkxli->apelido ?? 'ERRO 3HSMHV' }}</td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
              <td class="text-left">{{ $comissao->krnclwowqamsjls->kcvkongmlqeklsl->nome ?? 'ERRO UWR.RG6'}}</td>
              @elseif($comissao->fonte_origem == 'fin_conta_interna' )
              <td class="text-left">{{ $comissao->tipo }}</td>
              @endif

              @if($comissao->fonte_origem == 'fin_lancamentos' )
              <td class="text-right">{{ number_format($comissao->valor,2,',','.') }}
              @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
              {{-- @dd('fdlsks;fie') --}}
              <td class="text-right">{{ number_format($comissao->alksdjalsVendaPagamento->PDVVendasVendasPagamentos->dfyejmfcrkolqjh->sum('vlr_final'),2,',','.') }}</td>
              @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
              <td class="text-right">{{ number_format($comissao->krnclwowqamsjls->vlr_final ?? 99999,2,',','.') }}</td>
              @elseif($comissao->fonte_origem == 'fin_conta_interna' )
              <td class="text-right">{{ number_format($comissao->valor,2,',','.') }}
              @endif

              <td class="text-right">{{ number_format($comissao->percentual * 100,1,',','.') }} %</td>

              <td class="text-right">{{ number_format($comissao->valor,2,',','.') }}
                {{-- @include('includes.formulario.hidden', ['c_nm' => 'datas', 'c_id' => 'datas', 'c_vl' => $comissao->created_at ]) --}}
                {{-- @include('includes.formulario.hidden', ['c_nm' => 'input', 'c_id' => 'input', 'c_vl' => $comissao->valor ]) --}}
                {{-- @include('includes.formulario.hidden', ['c_nm' => 'profissional', 'c_id' => 'profissional', 'c_vl' => $pago->first()->skdfjlskjflsdjf_NomeProfissional->apelido ])</td> --}}
                <td class="text-center">
                  @if($comissao->fonte_origem != 'fin_lancamentos' AND $comissao->fonte_origem != 'pdv_vendas_pagamentos')
                  {{-- <a href="{{ route('financeiro.comissoes.editComissao', $comissao->id) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i style="width: 10px;" class="fa fa-edit"></i></a> --}}
                  @else
                  @endif
                </td>
              </tr>
              @endforeach
              @endforeach



            {{-- <tr>
              <td class="text-left">{{ $comissao->first()->xeypqgkmimzvknq->apelido ?? 'ERRO FINANCEIRO COMISSOES INDEX'}}</td>
              <td class="text-center">{{ \Carbon\Carbon::parse($comissao->min('created_at'))->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($comissao->max('created_at'))->format('d/m/Y') }}</td>
              <td class="text-right">{{ number_format($comissao->sum('valor'),2,',','.') }}</td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="{{ route('comissao.pagarProfissional', $comissao->first()->id_pessoa) }}" class="btn btn-default btn-xs"><i class="fa fa-fw fa-search"></i></a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="4">Não há comissões em aberto.</td>
            </tr>
            @endforelse --}}
          </tbody>
          <tfoot>
            <tr>
              <th class='text-center'></th>
              <th class='text-center'>{{ $comandas->sortBy('created_at')->count() }}</th>
              <th class='text-center'></th>
              <th class='text-center'></th>
              <th class='text-center'></th>
              <th class='text-center'></th>
              <th class='text-center'></th>
              <th class='text-center'></th>
              <th class='text-right'>{{ number_format($pago->sum('valor'),2,',','.') }}</th>
              <th class='text-center'></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@include('sistema.pdv.vendas.auxiliares.resumo')
@endsection
