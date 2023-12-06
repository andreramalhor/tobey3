@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="overlay" id="usuarios-overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Usuários</h3>
        @can('Usuários.Criar')
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('acl.usuarios.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        @endcan
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-usuarios">
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
    usuarios_tabelar()
  });

  function usuarios_tabelar()
  {
    $('#usuarios-overlay').show();

    axios.get("{{ route('acl.usuarios.tabelar') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-usuarios').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '9775771a' ] )
    .then( function(response)
    {
      $('#usuarios-overlay').hide();
    })
  }

  function usuarios_remover(id)
  {
    $('#usuarios-overlay').show();

    var url = "{{ route('acl.usuarios.remover', ':id') }}";
    var url = url.replace(':id', id);

    var dados = {
      id: id,
    };
  
    axios.put(url, dados)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '1875666a' ] )
    .then( function(response)
    {
      usuarios_tabelar()
    })
    .then( function(response)
    {
      $('#usuarios-overlay').hide();
    })
  }


// ------------------------------------------------------------------------------------------------------------------------------------------------------------ COPIAR DEPOIS EXCLUIR
  // function usuarios_restaurar(id)
  // {
  //   $('#usuarios-overlay').show();

  //   {{-- var url = "{{ route('acl.usuarios.restaurar', ':id') }}"; --}}
  //   var url = url.replace(':id', id);

  //   axios.post(url)
  //   .then(function(response)
  //   {
  //     console.log(response.data)
  //     toastrjs(response.data.type, response.data.message)
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '9980820a' ] ) --}}
  //   .then( function(response)
  //   {
  //     usuarios_tabelar()
  //   })
  //   .then( function(response)
  //   {
  //     $('#usuarios-overlay').hide();
  //   })
  // }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
