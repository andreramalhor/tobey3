@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="overlay-pessoas">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Pessoas (Geral)</h3>
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="input-group input-group-sm mb-2">
            <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="pessoas_tabelar()">
            <div class="input-group-append">
              <a class="input-group-text"><i class="fas fa-search"></i></a>
            </div>
          </div>
          &emsp;
          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pessoas_filtrar" data-bs-tooltip="tooltip" data-bs-title="Visualizar"><i class="fas fa-filter"></i></a>
            @can('Pessoas.Criar')
              <a class="btn btn-sm btn-default" onclick="pessoas_adicionar()" data-bs-tooltip="tooltip" data-bs-title="Cadastrar Pessoa"><i class="fas fa-plus"></i></a>
            @endcan
          </div>
          @include('sistema.atendimentos.pessoas.auxiliares.mod_filtro')
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-pessoas">
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
@include('sistema.atendimentos.pessoas.auxiliares.modal_rsschool')
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    pessoas_tabelar();
    
    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      pessoas_tabelar(page);
    });
  });
      
  function pessoas_tabelar(page)
  {
    $('#overlay-pessoas').show();
  
    var url = "{{ route('atd.pessoas.tabelar', ':page') }}";
    var url = url.replace(':page', 'page='+page);
  
    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-pessoas').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '6687785a' ] )
    .then( function(response)
    {
      $('#overlay-pessoas').hide();
    })
  }

  function pessoas_adicionar()
  {
    var url = "{{ route('atd.pessoas.adicionar') }}";
        
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#offcanva-geral-'+id_cnv).css('width', '100%')      
      $('#offcanva-geral-'+id_cnv).empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '3136658a' ] )
    .then( function(response)
    {
      $('#offcanva-geral-'+id_cnv).offcanvas('show');
      pessoas_tabelar()
    })
  }
  
  function pessoas_excluir(id)
  {
    $('#overlay-pessoas').show();

    var url = "{{ route('atd.pessoas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '8517418a' ] )
    .then( function(response)
    {
      pessoas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-pessoas').hide();
    })
  }

  function pessoas_restaurar(id)
  {
    $('#overlay-pessoas').show();

    var url = "{{ route('atd.pessoas.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '3420674a' ] )
    .then( function(response)
    {
      pessoas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-pessoas').hide();
    })
  }

  function pessoas_idrsschool(id, id_rsschool)
  {
    $('#id_rsschool_antigo').val(id_rsschool);
    $('#id_rsschool_novo').val(id_rsschool);
    $('#id').val(id);
 
    $('#modal_rsschool').modal('show');
  }  

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
