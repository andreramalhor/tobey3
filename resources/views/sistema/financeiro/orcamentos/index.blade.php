@extends('layouts.app')

@section('content')
<section class="content-header p-0">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Lançamentos</h1>
      </div>
      <div class="col-sm-6 p-0">
        <div class="btn-group float-end p-0 ml-1">
          <!-- <a href="#" onclick="lancamentos_direcionar('lancar')" class="btn btn-primary">Lançar (desativado)</a> -->
        </div>
        <div class="btn-group float-end p-0 ml-1">
          <a href="#" onclick="lancamentos_direcionar('transferencia')" class="btn btn-warning">Transferências</a>
        </div>
        <div class="btn-group float-end p-0 ml-1">
          <a href="#" onclick="lancamentos_direcionar('receita_geral')" class="btn btn-success">Receitas</a>
          <!-- <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false"></button>
          <div class="dropdown-menu dropdown-menu-end" role="menu" style="">
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('despesa.vale')">Vale</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Adiantamento</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Energia</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Internet</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Celular</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a>
          </div> -->
        </div>
        <div class="btn-group float-end p-0 ml-1">
          <a href="#" onclick="lancamentos_direcionar('despesa_geral')" class="btn btn-danger">Despesas</a>
          <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false"></button>
          <div class="dropdown-menu dropdown-menu-end" role="menu" style="">
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('desp_indicou_ganhou')">Campanha Indicou, Ganhou!</a>
            <!-- <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Vale</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Adiantamento</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Energia</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Internet</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Celular</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="row">
@if(isset(\Auth::User()->abcde->first()->id))
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
@else
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
@endif
    <div class="card">
      <div class="overlay" id="overlay-lancamentos">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Lançamentos não confirmados</h3>
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="input-group input-group-sm mb-2">
              <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="lancamentos_tabelar_nao_confirmados()">
              <div class="input-group-append">
                <a class="input-group-text"><i class="fas fa-search"></i></a>
              </div>
            </div>
            &emsp;
            <div class="btn-group">
              <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_lancamentos_filtrar"><i class="fas fa-filter"></i></a>
              @can('Lançamentos.Criar')
                <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_lancamentos_adicionar"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm btn-default" href="{{ route('fin.lancamentos.adicionar', 'sajs') }}"><i class="fas fa-plus"></i></a>
              @endcan
            </div>
            @include('sistema.financeiro.lancamentos.auxiliares.mod_filtro')
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-lancamentos-nao-confirmados">
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
  @if(isset(\Auth::User()->abcde->first()->id))
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <div class="card">
      <div class="overlay" id="overlay-lancamentos-2">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Lançamentos do Caixa: {{ \Auth::User()->abcde->first()->id ?? null }}</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-lancamentos-confirmados">
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
  @endif  
</div>
@include('includes.modal.modal-geral-1')
@endsection

@section('js')
<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  $('.select2').select2({
    dropdownParent: $('#modal-geral-1'),
  });
})

$(document).ready( function()
{
  lancamentos_tabelar_nao_confirmados()
  lancamentos_tabelar_confirmados()
  
  $(document).on('click', '.pagination a', function(event)
  {
    event.preventDefault()
    var page = $(this).attr('href').split('&page=')[1]
    lancamentos_tabelar_nao_confirmados(page)
    lancamentos_tabelar_confirmados(page)
  })
})

function lancamentos_direcionar(direcionamento)
{
  var url = "{{ route('fin.lancamentos.adicionar', ':direcionamento') }}"
  var url = url.replace(':direcionamento', direcionamento)

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#modal-geral-1').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '3652907a' ] )
  .then( function()
  {
    $('#modal-geral-1').modal('show')
  })
}

function lancamentos_tabelar_nao_confirmados(page)
{
  $('#overlay-lancamentos').show()

  // var url = "{{ route('fin.lancamentos.tabelar', ':page') }}"
  // var url = url.replace(':page', 'page='+page)
  var url    = "{{ route('fin.lancamentos.tabelar') }}"  
  var params = url+'?tipo_tabela=a_confirmar'

  var filtro   = $('#form-filtro').serialize()
  var pesquisa = $('#ipt-pesquisa').val()
  // var params   = url+'&'+filtro+'&pesquisa='+pesquisa+'&id_banco='+id_banco


  axios.get(params)
  .then(function(response)
  {
    // console.log(response.data)
    $('#tabela-lancamentos-nao-confirmados').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '6954277a' ] )
  .then( function(response)
  {
    $('#overlay-lancamentos').hide()
  })
}

function lancamentos_tabelar_confirmados(page)
{
  $('#overlay-lancamentos-2').show()

  var url    = "{{ route('fin.lancamentos.tabelar') }}"  
  var params = url+'?tipo_tabela=confirmado'

  axios.get(params)
  .then(function(response)
  {
    // console.log(response.data)
    $('#tabela-lancamentos-confirmados').empty().append(response.data)
  })
@include('includes.catch', [ 'codigo_erro' => '4960519a' ] )
  .then( function(response)
  {
    $('#overlay-lancamentos-2').hide()
  })
}

  function lancamentos_excluir(id)
  {
    $('#overlay-lancamentos').show()

    var url = "{{ route('fin.lancamentos.excluir', ':id') }}"
    var url = url.replace(':id', id)

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '4815691a' ] )
    .then( function(response)
    {
      lancamentos_tabelar_nao_confirmados()
    })
    .then( function(response)
    {
      $('#overlay-lancamentos').hide()
    })
  }

  function lancamentos_restaurar(id)
  {
    $('#overlay-lancamentos').show()

    var url = "{{ route('fin.lancamentos.restaurar', ':id') }}"
    var url = url.replace(':id', id)
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '7422541a' ] )
    .then( function(response)
    {
      lancamentos_tabelar_nao_confirmados()
    })
    .then( function(response)
    {
      $('#overlay-lancamentos').hide()
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
