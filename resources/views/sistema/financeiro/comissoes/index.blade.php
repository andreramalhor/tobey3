@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" id="comissoes-abert_prof">
    <div class="card">
      <div class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Comissões</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
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
  
  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" id="comissoes-fechd_prof">
    <div class="card">
      <div class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Comissões Pagas</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
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
    comissoes_tabelar_abert_prof();
    comissoes_tabelar_fechd_prof();
  });

  function comissoes_tabelar_abert_prof(page)
  {
    $('#overlay-comissoes').show();
  
    var url = "{{ route('fin.comissoes.abert_prof') }}";

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#comissoes-abert_prof').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '7856012a' ] )
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  function comissoes_tabelar_fechd_prof(page)
  {
    $('#overlay-comissoes').show();
  
    var url = "{{ route('fin.comissoes.fechd_prof') }}";

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#comissoes-fechd_prof').empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '7856012a' ] )
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  function comissoes_excluir(id)
  {
    $('#overlay-comissoes').show();

    var url = "{{ route('fin.comissoes.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '6271382a' ] )
    .then( function(response)
    {
      comissoes_tabelar_abert_prof()
    })
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  function comissoes_restaurar(id)
  {
    $('#overlay-comissoes').show();

    var url = "{{ route('fin.comissoes.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
    @include('includes.catch', [ 'codigo_erro' => '6745858a' ] )
    .then( function(response)
    {
      comissoes_tabelar_abert_prof()
    })
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
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


function comissoes_tabelar_abert_prof(page)
{
  $('#overlay_person').show();

  {{-- 
    var url = "{{ route('comssao.load', ':page') }}";
     --}}
  var url = url.replace(':page', 'page='+page);

  var filter = $('#form_filter').serialize();
  var iptSearch = $('#ipt-pesquisa').val();
  var params = url+'&'+filter+'&iptSearch='+iptSearch;

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    $('#comssao_card').empty().append(response.data);
  })
  @include('includes.catch', [ 'codigo_erro' => '8909558a' ] )
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

  comissoes_tabelar_abert_prof()
}

function disablePerson(id)
{
  {{-- 
    var url = "{{ route('comssao.destroy', ':idd') }}";
     --}}

  var url = url.replace(':idd', id);

  axios.delete(url)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message)
  })
  @include('includes.catch', [ 'codigo_erro' => '1865264a' ] )
  .then(function(response)
  {
    comissoes_tabelar_abert_prof()
  })
}

function activatePerson(id)
{
    {{-- 
    var url = "{{ route('comssao.activatePerson', ':idd') }}";
     --}}

  var url = url.replace(':idd', id);

  axios.post(url)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message)
  })
  @include('includes.catch', [ 'codigo_erro' => '3801931a' ] )
  .then(function(response)
  {
    comissoes_tabelar_abert_prof()
  })
}


</script>
@stop -->
