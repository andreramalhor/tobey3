@extends('layouts.app')

@section('content')
<form action="{{ route('cat.categorias.gravar') }}" method="POST" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Criar Categoria</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Tipo</label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm" name="tipo" id="tipo">
                <option value="Serviço">Serviço</option>
                <option value="Produto">Produto</option>
                <option value="Consumo">Consumo</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Descrição</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="descricao" id="descricao" placeholder="Descrição">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('cat.categorias') }}" class="btn btn-secondary">Cancelar</a>
      <button type="submit" class="btn btn-success float-right">Criar</button>
    </div>
  </div>
</form>
@endsection
