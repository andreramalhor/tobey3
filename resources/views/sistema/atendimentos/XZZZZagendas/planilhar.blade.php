@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="agendamentos-overlay">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Agendamentos</h3>
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="input-group input-group-sm mb-2">
            <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="agendamentos_tabelar()">
            <div class="input-group-append">
              <a class="input-group-text"><i class="fas fa-search"></i></a>
            </div>
          </div>
          &emsp;
          <div class="btn-group">
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_agendamentos_filtrar"><i class="fas fa-filter"></i></a>
            @can('Agendamentos.Criar')
              <a class="btn btn-sm btn-default" href="{{ route('atd.agendamentos.adicionar_l') }}"><i class="fas fa-square-plus"></i></a>
              <a class="btn btn-sm btn-default" href="{{ route('atd.agendamentos.adicionar') }}"><i class="fas fa-plus"></i></a>
            @endcan
          </div>
          @include('sistema.atendimentos.agendamentos.auxiliares.mod_filtro')
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-agendamentos">
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
    agendamentos_tabelar();
    
    $(document).on('click', '.pagination a', function(event)
    {
      event.preventDefault();
      console.log($(this))
      var page = $(this).attr('href').split('?page=')[1];
      agendamentos_tabelar(page);
    });
  });

  function agendamentos_tabelar(page)
  {
    console.log(page)
    $('#agendamentos-overlay').show();
  
    var url = "{{ route('atd.agendamentos.tabelar', ':page') }}";
    var url = url.replace(':page', '?page='+page);
  
    var filtro   = $('#form-filtro').serialize();
    var pesquisa = $('#ipt-pesquisa').val();
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

    axios.get(params)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-agendamentos').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '1970057a' ] )
    .then( function(response)
    {
      $('#agendamentos-overlay').hide();
    })
  }

  function agendamentos_excluir(id)
  {
    $('#agendamentos-overlay').show();

    var url = "{{ route('atd.agendamentos.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '7547928a' ] )
    .then( function(response)
    {
      agendamentos_tabelar()
    })
    .then( function(response)
    {
      $('#agendamentos-overlay').hide();
    })
  }

  function agendamentos_restaurar(id)
  {
    $('#agendamentos-overlay').show();

    var url = "{{ route('atd.agendamentos.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '4100516a' ] )
    .then( function(response)
    {
      agendamentos_tabelar()
    })
    .then( function(response)
    {
      $('#agendamentos-overlay').hide();
    })
  }

  function agendamentos_idrsschool(id, id_rsschool)
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
