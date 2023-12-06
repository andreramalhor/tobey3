@extends('layouts.app')

@section('content')
<form action="{{ route('acl.funcoes.gravar') }}" method="POST" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Criar Função</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Slug</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="slug" id="slug" placeholder="Slug">
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
      <a href="{{ route('acl.funcoes') }}" class="btn btn-secondary">Cancelar</a>
      <button type="submit" class="btn btn-success float-right">Criar</button>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">

  $("#nome").keyup(function()
  {
    var Text = $(this).val();
    Text = Text.toLowerCase().trim();
    Text = Text.replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
    $("#slug").val(Text);
  })
</script>
@endsection
