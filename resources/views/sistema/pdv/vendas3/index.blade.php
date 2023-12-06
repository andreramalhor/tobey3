@extends('layouts.app')

@section('content')
  @if(!isset(Auth::User()->abcde->first()->id))
  {{--
    <script>window.location = "{{ route('pdv.caixas') }}"</script>
  --}}
  @else
    <section class="content-header p-0">
      <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1><small>Vendas do Caixa: </small>{{ Auth::User()->abcde->first()->id ?? null }}</h1>
        </div>
        <div class="col-sm-2 p-0">
          <div class="input-group input-group-sm mb-2">
            <input type="hidden" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="vendas_tabelar()">
            <!-- <div class="input-group-append"> -->
              <!-- <a class="input-group-text"><i class="fas fa-search"></i></a> -->
            <!-- </div> -->
          </div>
        </div>
        <div class="col-sm-2 p-0">
          <div class="btn-group">
            <a href="{{ route('com.leads') }}" class="btn btn-default">Ver Todos</a>
            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <div class="dropdown-menu dropdown-menu-end" role="menu" style="">
              <a class="dropdown-item" href="#">Finalizadas</a>
              <a class="dropdown-item" href="#">Abertas</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Perdidos</a>
              <a class="dropdown-item" href="#">Ganhos</a>
            </div>
          </div>
          <a class="btn btn-primary float-end" href="{{ route('pdv.vendas.adicionar') }}">Realizar Venda</a>
        </div>
      </div>
    </div>
  </section>  
  @endif
  <div class="overlay" id="overlay-vendas">
    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
  </div>

  <div class="col-12" id="tabela-vendas"></div>
@endsection
    
@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    vendas_tabelar();
    
    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      var page = $(this).attr('href').split('&page=')[1];
      vendas_tabelar(page);
    });
  });

  function vendas_tabelar(page)
  {
    $('#overlay-vendas').show();
  
    var url = "{{ route('pdv.vendas.tabelar', ':page') }}";
    var url = url.replace(':page', 'page='+page);
  
    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-vendas').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '5615208a' ] )
    .then( function(response)
    {
      $('#overlay-vendas').hide();
    })
  }

  function vendas_excluir(id)
  {
    $('#overlay-vendas').show();

    var url = "{{ route('pdv.vendas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '4315765a' ] )
    .then( function(response)
    {
      vendas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-vendas').hide();
    })
  }

  function vendas_restaurar(id)
  {
    $('#overlay-vendas').show();

    var url = "{{ route('pdv.vendas.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '5911735a' ] )
    .then( function(response)
    {
      vendas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-vendas').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
