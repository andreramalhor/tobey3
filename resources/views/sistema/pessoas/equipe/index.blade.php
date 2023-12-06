@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="overlay" id="overlay_equipe">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Equipe</h3>
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="input-group input-group-sm mb-2">
              <input type="text" class="form-control form-control-sm" id="ipt_search" onkeyup="carregarEquipe()">
              <div class="input-group-append">
                <a class="input-group-text"><i class="fas fa-search"></i></a>
              </div>
            </div>
            &emsp;
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('pessoas.equipe.adicionar') }}" ><i class="fas fa-plus"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0" id="card_equipe">
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
  carregarEquipe();
  
  $(document).on('click', '.pagination a', function(event)
  {
    event.preventDefault();
    var page = $(this).attr('href').split('&page=')[1];
    carregarEquipe(page);
  });
});

function carregarEquipe(page)
{
  $('#overlay_equipe').show();

  var url = "{{ route('pessoas.equipe.listar', ':page') }}";
  var url = url.replace(':page', 'page='+page);

  var filter = $('#form_filter').serialize();
  var iptSearch = $('#ipt_search').val();
  var params = url+'&'+filter+'&iptSearch='+iptSearch;

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    $('#card_equipe').empty().append(response.data);
  })
@include('includes.catch', [ 'codigo_erro' => '9608784a' ] )
  .then(function(response)
  {

    $('#overlay_equipe').hide();
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

  carregarEquipe()
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
@include('includes.catch', [ 'codigo_erro' => '5846384a' ] )
  .then(function(response)
  {
    carregarEquipe()
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
@include('includes.catch', [ 'codigo_erro' => '6383016a' ] )
  .then(function(response)
  {
    carregarEquipe()
  })
}

@if(session()->exists('resposta'))
toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
@endif
</script>
@stop
