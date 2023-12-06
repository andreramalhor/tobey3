@extends('layouts.app')

@section('content')
<form action="{{ route('acl.permissoes.gravar') }}" method="POST" id="form_clientes_adicionar" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Criar Permissão</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Nível</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="nivel" id="nivel" placeholder="Nível">
            </div>
          </div>
          <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Ordem</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="ordem" id="ordem" placeholder="Ordem">
            </div>
          </div>
          <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Menu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="menu" id="menu" placeholder="Menu">
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
      <a href="{{ route('acl.permissoes') }}" class="btn btn-secondary">Cancelar</a>
      <button type="submit" class="btn btn-success float-right">Criar</button>
    </div>
  </div>
</form>
@endsection
