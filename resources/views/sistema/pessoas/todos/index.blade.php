@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="overlay" id="overlay_todos">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Pessoas</h3>
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="input-group input-group-sm mb-2">
              <input type="text" class="form-control form-control-sm" id="ipt_search" onkeyup="carregarTodos()">
              <div class="input-group-append">
                <a class="input-group-text"><i class="fas fa-search"></i></a>
              </div>
            </div>
            &emsp;
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('pessoas.cadastrar') }}" ><i class="fas fa-plus"></i></a>
              <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_filter"><i class="fas fa-filter"></i></a>
            </div>
          </div>
        </div>
      </div>
      @include('sistema.pessoas.todos.modal.filter')
      <div class="card-body table-responsive p-0" id="card_todos">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="pessoa-list">
          <thead>
            <tr>
              <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">Carregando...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
//
$(document).ready(function()
{
  carregarTodos();
  
  $(document).on('click', '.pagination a', function(event)
  {
    event.preventDefault();
    var page = $(this).attr('href').split('&page=')[1];
    carregarTodos(page);
  });
});

function carregarTodos(page)
{
  $('#overlay_todos').show();

  var url = "{{ route('pessoas.todos.listar', ':page') }}";
  var url = url.replace(':page', 'page='+page);

  var filter = $('#form_filter').serialize();
  var iptSearch = $('#ipt_search').val();
  var params = url+'&'+filter+'&iptSearch='+iptSearch;

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    $('#card_todos').empty().append(response.data);
  })
@include('includes.catch', [ 'codigo_erro' => '8454361a' ] )
  .then(function(response)
  {

    $('#overlay_todos').hide();
  })
}

function cleanFilter(page)
{
  $('#apelido').val('')
  $('#ipt_search').val('')
  $('#sexo').val('')
  $('#dt_nascimento').val('')
  $('#cpf').val('')
  $('#qtd_page').val(10)
  $('#ordenar_por').val('apelido')
  $('#ordem').val('asc')

  carregarTodos()
}

function disablePerson(id)
{
  var url = "{{ route('pessoa.destroy', ':idd') }}";
  var url = url.replace(':idd', id);

  axios.delete(url)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '9346695a' ] )
  .then(function(response)
  {
    carregarTodos()
  })
}

function ativarPessoa(id)
{
  var url = "{{ route('pessoa.ativarPessoa', ':idd') }}";
  var url = url.replace(':idd', id);

  axios.post(url)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '6577164a' ] )
  .then(function(response)
  {
    carregarTodos()
  })
}

@if(session()->exists('resposta'))
toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
@endif
</script>
@stop
