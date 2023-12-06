@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="overlay" id="overlay-mensagens">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Mensagens do Sistema</h3>
          <div class="card-tools">
            <div class="btn-toolbar">
              <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="mensagens_tabelar()">
                <div class="input-group-append">
                  <a class="input-group-text"><i class="fas fa-search"></i></a>
                </div>
              </div>
              &emsp;
              <div class="btn-group">
                <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_mensagens_filtrar" data-bs-tooltip="tooltip" data-bs-title="Visualizar"><i class="fas fa-filter"></i></a>
                @can('Mensagens.Criar')
                  <a class="btn btn-sm btn-default" onclick="mensagens_adicionar()" data-bs-tooltip="tooltip" data-bs-title="Cadastrar Pessoa"><i class="fas fa-plus"></i></a>
                @endcan
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <dl class="row" id="tabela-mensagens">
            <dt class="col-sm-3">Carregando...</dt>
            <dd class="col-sm-7">Carregando...</dd>
            <dd class="col-sm-2"></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    mensagens_tabelar();
    
    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      mensagens_tabelar(page);
    });
  });
      
  function mensagens_tabelar(page)
  {
    $('#overlay-mensagens').show();
  
    var url = "{{ route('cfg.mensagens.tabelar', ':page') }}";
    var url = url.replace(':page', 'page='+page);
  
    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-mensagens').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '2154598a' ] )
    .then( function(response)
    {
      $('#overlay-mensagens').hide();
    })
  }

  function mensagens_adicionar()
  {
    var url = "{{ route('cfg.mensagens.adicionar') }}";
        
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#offcanva-geral-'+id_cnv).css('width', '100%')      
      $('#offcanva-geral-'+id_cnv).empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '3652665a' ] )
    .then( function(response)
    {
      $('#offcanva-geral-'+id_cnv).offcanvas('show');
      mensagens_tabelar()
    })
  }
  
  function mensagens_excluir(id)
  {
    $('#overlay-mensagens').show();

    var url = "{{ route('cfg.mensagens.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '66513354a' ] )
    .then( function(response)
    {
      mensagens_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-mensagens').hide();
    })
  }

  function mensagens_restaurar(id)
  {
    $('#overlay-mensagens').show();

    var url = "{{ route('cfg.mensagens.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '5335154a' ] )
    .then( function(response)
    {
      mensagens_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-mensagens').hide();
    })
  }
</script>
@endsection
