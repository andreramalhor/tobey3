@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="overlay-caixas">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Caixas</h3>
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="input-group input-group-sm mb-2">
          <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="caixas_tabelar()">
            <div class="input-group-append">
              <a class="input-group-text"><i class="fas fa-search"></i></a>
            </div>
          </div>
          &emsp;
          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_caixas_filtrar"><i class="fas fa-filter"></i></a>
            @can('Caixas.Abrir')
            <a class="btn btn-sm btn-default" href="{{ route('pdv.caixas.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
            @endcan
          </div>
          @include('sistema.pdv.caixas.auxiliares.mod_filtro')
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-caixas">
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
    caixas_tabelar();
    
    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      caixas_tabelar(page);
    });
  });


  function caixas_tabelar(page)
  {
    $('#overlay-caixas').show();
  
    var url = "{{ route('pdv.caixas.tabelar', ':page') }}";
    var url = url.replace(':page', 'page='+page);
    
    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;
  
    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-caixas').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '4005472a' ] )
    .then( function(response)
    {
      $('#overlay-caixas').hide();
    })
  }

  function caixas_excluir(id)
  {
    $('#overlay-caixas').show();

    var url = "{{ route('pdv.caixas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '1500378a' ] )
    .then( function(response)
    {
      caixas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-caixas').hide();
    })
  }

  function caixas_restaurar(id)
  {
    $('#overlay-caixas').show();

    var url = "{{ route('pdv.caixas.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '9773211a' ] )
    .then( function(response)
    {
      caixas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-caixas').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection



 

<!-- 
@section('js')
<script>
//


function caixas_tabelar(page)
{
  $('#overlay_person').show();

  {{-- 
    var url = "{{ route('caixa.load', ':page') }}";
     --}}
  var url = url.replace(':page', 'page='+page);

  var filter = $('#form_filter').serialize();
  var iptSearch = $('#ipt-pesquisa').val();
  var params = url+'&'+filter+'&iptSearch='+iptSearch;

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    $('#caixa_card').empty().append(response.data);
  })
  include('includes.catch', [ 'codigo_erro' => '7788011a' ] )
  .then(function(response)
  {

    $('#overlay_person').hide();
  })
}

function cleanFilter(page)
{
  $('#apelido').val('')
  $('#ipt-pesquisa').val('')
  $('#sexo').val('')
  $('#dt_nascimento').val('')
  $('#cpf').val('')
  $('#qtd_page').val(10)
  $('#ordenar_por').val('apelido')
  $('#ordem').val('asc')

  caixas_tabelar()
}

function disablePerson(id)
{
  {{-- 
    var url = "{{ route('caixa.destroy', ':idd') }}";
     --}}

  var url = url.replace(':idd', id);

  axios.delete(url)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message)
  })
  include('includes.catch', [ 'codigo_erro' => '5693442a' ] )
  .then(function(response)
  {
    caixas_tabelar()
  })
}

function activatePerson(id)
{
    {{-- 
    var url = "{{ route('caixa.activatePerson', ':idd') }}";
     --}}

  var url = url.replace(':idd', id);

  axios.post(url)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message)
  })
  include('includes.catch', [ 'codigo_erro' => '2118983a' ] )
  .then(function(response)
  {
    caixas_tabelar()
  })
}


</script>
@stop -->
