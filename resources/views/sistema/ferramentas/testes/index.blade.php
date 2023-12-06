@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Área de Testes</h3>
      </div>
      <div class="card-body">
        <h1>TESTES</h1>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">Full screen</button>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('tarefa.create') }}" class="btn btn-info btn-sm float-right"><i class="fas fa-plus"></i> Adicionar Novo Item</a>
        {{-- <button type="button" href="{{ route('tarefa.store') }}" class="btn btn-info btn-sm float-right"><i class="fas fa-plus"></i> Adicionar Novo Item</button> --}}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content" style="height: 95%;">
      <div class="modal-header">
        <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Full screen modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
  $(document).ready(function()
  {
    console.log('area de testes')
  });


</script>
@stop
