@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('dividas.update', $divida) }}" autocomplete="off">
@method('PUT')
@csrf
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Editar: {{ $divida->id }}</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-12">
              <input type="text" class="form-control form-control-sm" name="id_cliente" value="{{ $divida->id_cliente }}">
              <input type="hidden" name="atualizada" value="0">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Obsercação</label>
            <div class="col-sm-12">
              <textarea class="form-control form-control-sm" name="observacao" rows="3">{{ $divida->observacao }}</textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="reset" class="btn btn-default btn-sm">Cancelar</a>
          <button type="submit" class="btn btn-success btn-sm float-end">Criar</a>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
