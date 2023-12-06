@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="overlay-modulos">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Módulos</h3>
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="input-group input-group-sm mb-2">
            <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="modulos_tabelar()">
            <div class="input-group-append">
              <a class="input-group-text"><i class="fas fa-search"></i></a>
            </div>
          </div>
          &emsp;
          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_modulos_filtrar"><i class="fas fa-filter"></i></a>
            @can('modulos.Criar')
              <a class="btn btn-sm btn-default" href="{{ route('ped.modulos.adicionar') }}"><i class="fas fa-plus"></i></a>
            @endcan
          </div>
          @include('sistema.pedagogico.modulos.auxiliares.mod_filtro')
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-modulos">
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
    modulos_tabelar();

    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      modulos_tabelar(page);
    });
  });

  function modulos_tabelar(page)
  {
    $('#overlay-modulos').show();

    var url = "{{ route('ped.modulos.tabelar', ':page') }}";
    var url = url.replace(':page', 'page='+page);

    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-modulos').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '2188753a' ] )
    .then( function(response)
    {
      $('#overlay-modulos').hide();
    })
  }

  function modulos_excluir(cod)
  {
    $('#overlay-modulos').show();

    var url = "{{ route('ped.modulos.excluir', ':cod') }}";
    var url = url.replace(':cod', cod);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '9867212a' ] )
    .then( function(response)
    {
      modulos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-modulos').hide();
    })
  }

  function modulos_restaurar(cod)
  {
    $('#overlay-modulos').show();

    var url = "{{ route('ped.modulos.restaurar', ':cod') }}";
    var url = url.replace(':cod', cod);

    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '5004013a' ] )
    .then( function(response)
    {
      modulos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-modulos').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
