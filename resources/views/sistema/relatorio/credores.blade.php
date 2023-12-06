@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de Pessoas com Crédito</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Nome</th>
              <th class="text-right">Saldo</th>
            </tr>
          </thead>
          <tbody>
            @foreach($contas_internas as $conta_interna)
              <tr>
                <td class="text-center"><a href="{{ route('pessoa.show', $conta_interna->id_pessoa ) }}" target="_blank" class="badge bg-pink">{{ $conta_interna->id_pessoa }}</a></td>
                <td class="text-left">{{ $conta_interna->xeypqgkmimzvknq->apelido ?? $conta_interna->id_pessoa ?? 's'}}</td>
                <td class="text-right">{{ number_format($conta_interna->total, 2, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th class="text-right">{{ number_format($contas_internas->sum('total'), 2, ',', '.') }}&emsp;</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
