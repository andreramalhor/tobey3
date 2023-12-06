@extends('layouts.app')

@section('content')
<div class="card">
  <form method="POST" action="{{ route('tarefa.store') }}" autocomplete="off">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="card-header">
      <h3 class="card-title">Adicionar Nova Tarefa</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" placeholder="Tarefa">
            <input type="hidden" name="user_id" value="{{ \Auth::User()->id }}">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label>Select</label>
            <select class="form-control" name="status">
              <option value="Geral">Geral</option>
              <option value="Atrasado">Atrasado</option>
              <option value="No Prazo">No Prazo</option>
              <option value="Feito">Feito</option>
              <option value="Urgente">Urgente</option>
              <option value="Atrasado">Atrasado</option>
            </select>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label>Responsável</label>
            <select class="form-control" name="responsavel">
              <option value="1">Fulano</option>
              <option value="2">Ciclano</option>
              <option value="3">Beltrano</option>
              <option value="4">Joãozinho</option>
              <option value="5" selected>Eu</option>
              <option value="6">Outro</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
      <button type="button" href="{{ route('tarefa.index') }}" class="btn btn-default btn-sm float-right">Cancelar</button>
    </div>
  </form>
</div>
@endsection
