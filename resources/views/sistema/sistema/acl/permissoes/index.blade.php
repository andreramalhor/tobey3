@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="overlay-permissoes">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Permissões</h3>
      @can('Permissões.Criar')
      <div class="card-tools">
        <div class="btn-toolbar">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('acl.permissoes.adicionar') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      @endcan
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-permissoes">
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
    permissoes_tabelar()
  });

  function permissoes_tabelar()
  {
    $('#overlay-permissoes').show();

    axios.get("{{ route('acl.permissoes.tabelar') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-permissoes').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '2189492a' ] )
    .then( function(response)
    {
      $('#overlay-permissoes').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
