@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DRE</h3>
        <div class="card-tools">
          <div class="btn-group">
            {{-- <a class="btn btn-sm btn-default" href="{{ route('comissao.create') }}" ><i class="fas fa-plus"></i></a> --}}
            {{-- <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a> --}}
          </div>
        </div>
        {{-- @include('sistema.financeiro.lancamentos.modal.pesquisa') --}}
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-hover text-nowrap no-padding projects table-bordered" id="comissao-list">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Conta</th>
              <th>Título</th>
              <th class="text-center">Jan</th>
              <th class="text-center">Fev</th>
              <th class="text-center">Mar</th>
              <th class="text-center">Abr</th>
              <th class="text-center">Mai</th>
              <th class="text-center">Jun</th>
              <th class="text-center">Jul</th>
              <th class="text-center">Ago</th>
              <th class="text-center">Set</th>
              <th class="text-center">Out</th>
              <th class="text-center">Nov</th>
              <th class="text-center">Dez</th>
              <th class="text-center">TOT</th>
            </tr>
          </thead>       
          <tbody>
            @forelse ($contas as $conta)
              @if( $conta->nivel == 0)
                <tr style="background-color:#FF33FF; font-weight: bold;">
              @elseif($conta->nivel == 1)
                <tr style="background-color:#FFE6FF;">
              @else
                <tr>
              @endif
                <td>{{ $conta->id }}</td>
                <td>{{ $conta->conta }}</td>
                <td>{{ str_repeat('___', $conta->nivel).$conta->descricao }}</td>
                @if($conta->id == 1)
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</strong></td>
                  <td class="text-right"><strong>{{ number_format( $pagamentos_vendas->whereNotIn('id_forma_pagamento', [82, 83] )->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</strong></td>
                @elseif($conta->id == 4)
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('id_forma_pagamento', '=', 1)->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                @elseif($conta->id == 5)
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Crédito' )->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                @elseif($conta->id == 61)
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->where('qmbnkthuczqdsdn.forma', '=', 'Cartão de Débito' )->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                @elseif($conta->id == 62)
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $pagamentos_vendas->whereIn('id_forma_pagamento', [80, 81, 84, 85] )->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                @else
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                  <td class="text-right">{{ number_format( $lancamentos->where('id_conta', '=', $conta->id)->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                @endif                
              </tr>
              @if($conta->id == 6)
                @foreach ($comissoes->groupby('id_pessoa') as $profissional => $comissao)
                  <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $comissao->first()->xeypqgkmimzvknq->apelido ?? $comissao->id_pessoa }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                  </tr>
                @endforeach
              @endif
            @empty
              <tr>
                <td colspan="15"> Não há contas contábeis cadastradas.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right">
        {{-- @if(isset($dataForm))
          {{ $servicos->appends($dataForm)->links() }}
        @else
          {{ $servicos->links() }}
        @endif --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
