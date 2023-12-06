@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Comissões em Aberto</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding">
          <thead>
            <tr>
              <th class="text-left">Profissional</th>
              <th class="text-center">Período</th>
              <th class="text-right">Valor à Receber</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @forelse($aberto->groupby('id_pessoa') as $profissional)
            <tr>
              <td class="text-left">{{ $profissional->first()->xeypqgkmimzvknq->apelido ?? 'ERRO FINANCEIRO COMISSOES INDEX'}}</td>
              <td class="text-center">{{ \Carbon\Carbon::parse($profissional->min('created_at'))->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($profissional->max('created_at'))->format('d/m/Y') }}</td>
              <td class="text-right">{{ number_format($profissional->sum('valor'),2,',','.') }}</td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="{{ route('comissao.pagarProfissional', $profissional->first()->id_pessoa) }}" class="btn btn-default btn-xs"><i class="fa fa-fw fa-search"></i></a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="4">Não há comissões em aberto.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Comissões Pagas</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding">
          <thead>
            <tr>
              <th class="text-left">Profissional > #</th>
              <th class="text-left">Período</th>
              <th class="text-right">Valor à Receber</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pago->groupby('id_pessoa') as $profissional => $comandas)
              <tr>
                <td class="text-left" colspan="4">{{ $comandas->first()->xeypqgkmimzvknq->apelido ?? 'ERRO FINANCEIRO COMISSOES INDEX'}}</td>
              </tr>
              @foreach($comandas->groupby('id_destino') as $lancamento => $comanda)
              <tr>
                <td class="text-left">{{ $comanda->first()->id_destino }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($comanda->min('created_at'))->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($comanda->max('created_at'))->format('d/m/Y') }}</td>
                <td class="text-right">{{ number_format($comanda->sum('valor'),2,',','.') }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="{{ route('comissao.pagoProfissional', [ $profissional, $lancamento ]) }}" class="btn btn-default btn-xs"><i class="fa fa-fw fa-search"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            @empty
            <tr>
              <td class="text-center" colspan="4">Não há comissões pagas.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
