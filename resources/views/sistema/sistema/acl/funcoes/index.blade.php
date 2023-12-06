@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="overlay" id="overlay-funcoes">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Funções</h3>
        @can('Permissões.Criar')
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('acl.funcoes.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        @endcan
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-funcoes">
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
<script type="text/javascript">
  $(document).ready( function()
  {
    funcoes_tabelar()
  });

  function funcoes_tabelar()
  {
    $('#overlay-funcoes').show();

    axios.get("{{ route('acl.funcoes.tabelar') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-funcoes').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '9228363a' ] )
    .then( function(response)
    {
      $('#overlay-funcoes').hide();
    })
  }

  function funcoes_excluir(id)
  {
    $('#overlay-funcoes').show();

    var url = "{{ route('acl.funcoes.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '8483508a' ] )
    .then( function(response)
    {
      funcoes_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-funcoes').hide();
    })
  }


// ------------------------------------------------------------------------------------------------------------------------------------------------------------ COPIAR DEPOIS EXCLUIR
  // function funcoes_restaurar(id)
  // {
  //   $('#overlay-funcoes').show();

  //   {{-- var url = "{{ route('acl.funcoes.restaurar', ':id') }}"; --}}
  //   var url = url.replace(':id', id);

  //   axios.post(url)
  //   .then(function(response)
  //   {
  //     console.log(response.data)
  //     toastrjs(response.data.type, response.data.message)
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '6655681a' ] ) --}}
  //   .then( function(response)
  //   {
  //     funcoes_tabelar()
  //   })
  //   .then( function(response)
  //   {
  //     $('#overlay-funcoes').hide();
  //   })
  // }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
