@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="overlay-turmas">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Turmas</h3>
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="input-group input-group-sm mb-2">
            <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="turmas_tabelar()">
            <div class="input-group-append">
              <a class="input-group-text"><i class="fas fa-search"></i></a>
            </div>
          </div>
          &emsp;
          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_turmas_filtrar"><i class="fas fa-filter"></i></a>
            @can('Turmas.Criar')
              <a class="btn btn-sm btn-default" href="{{ route('ped.turmas.adicionar') }}"><i class="fas fa-plus"></i></a>
            @endcan
          </div>
          @include('sistema.pedagogico.turmas.auxiliares.mod_filtro')
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-turmas">
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
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    turmas_tabelar();

    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      turmas_tabelar(page);
    });
  });

  function turmas_tabelar(page)
  {
    $('#overlay-turmas').show();

    var url = "{{ route('ped.turmas.tabelar', ':page') }}";
    var url = url.replace(':page', 'page='+page);

    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-turmas').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '9141007a' ] )
    .then( function(response)
    {
      $('#overlay-turmas').hide();
    })
  }

  function turmas_excluir(cod)
  {
    $('#overlay-turmas').show();

    var url = "{{ route('ped.turmas.excluir', ':cod') }}";
    var url = url.replace(':cod', cod);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '1902633a' ] )
    .then( function(response)
    {
      turmas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-turmas').hide();
    })
  }

  function turmas_restaurar(cod)
  {
    $('#overlay-turmas').show();

    var url = "{{ route('ped.turmas.restaurar', ':cod') }}";
    var url = url.replace(':cod', cod);

    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '3623549a' ] )
    .then( function(response)
    {
      turmas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-turmas').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
