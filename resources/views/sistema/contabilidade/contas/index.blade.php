@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <div class="overlay" id="overlay-contas">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Contas Contábil</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle" id="tabela-contas">
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
    contas_tabelar();
  });

  function contas_tabelar()
  {
    $('#overlay-contas').show();
  
    var url = "{{ route('con.contas.tabelar') }}";

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-contas').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '239116a' ] )
    .then( function(response)
    {
      $('#overlay-contas').hide();
    })
  }

  function contas_excluir(id)
  {
    $('#overlay-contas').show();

    var url = "{{ route('con.contas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '3262146a' ] )
    .then( function(response)
    {
      contas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-contas').hide();
    })
  }

  function contas_restaurar(id)
  {
    $('#overlay-contas').show();

    var url = "{{ route('con.contas.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '3265431a' ] )
    .then( function(response)
    {
      contas_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-contas').hide();
    })
  }

  function contas_idrsschool(id, id_rsschool)
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
