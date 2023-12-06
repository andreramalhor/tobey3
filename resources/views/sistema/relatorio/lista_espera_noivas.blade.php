@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de Espera - Inauguração Sala de Noivas</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Nome Completo</th>
              <th class="text-left">e-Mail</th>
              <th class="text-center">Telefone</th>
              <th class="text-center">Data do Casamento</th>
              <th class="text-center">Data do Cadastro</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dados as $dado)
              <tr>
                <td class="text-center">{{ $dado->id }}</td>
                <td class="text-left">{{ $dado->nome_completo ?? 'Não cadastrou nome'}}</td>
                <td class="text-left">{{ $dado->email ?? 'Não cadastrou e-mail'}}</td>
                <td class="text-center">{{ $dado->telefone ?? 'Não cadastrou telefone'}}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($dado->data_casamento)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($dado->created_at)->format('d/m/Y H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
