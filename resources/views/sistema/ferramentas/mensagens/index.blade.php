@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-3">
    <a href="compose.html" class="btn btn-primary btn-block mb-3">Criar Mensagem</a>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Origem</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item active">
            <a href="#" class="nav-link">
              <i class="fas fa-inbox"></i> Site
              <span class="badge bg-primary float-right">12</span>
            </a>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-envelope"></i> Lixeira
            </a>
          </li>
        <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-file-alt"></i> Drafts
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-filter"></i> Junk
              <span class="badge bg-warning float-right">65</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-trash-alt"></i> Trash
              a
            </a>
          </li>
        -->
        </ul>
      </div> 
    </div>
    
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Rótulos</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle text-danger"></i>Importante
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle text-warning"></i>Promoções
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle text-primary"></i>Social
            </a>
          </li>
        </ul>
      </div>      
    </div>
  </div>
  
  <div class="col-md-9">
    <div class="card card-primary card-outline" id="mensagens_card">
      <div class="overlay" id="mensagens_overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-body">
        <div class="text-center">
          <i class="fas fa-ellipsis-h"></i>
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    mensagens_tabelar()
  });

  function mensagens_tabelar()
  {
    $('#mensagens_overlay').show();

    axios.get("{{ route('frm.mensagens.tabelar') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#mensagens_card').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '5317350a' ] )
    .then( function(response)
    {
      $('#mensagens_overlay').hide();
    })
  }

  function mensagens_excluir(id)
  {
    $('#mensagens_overlay').show();

    var url = "{{ route('frm.mensagens.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '3434591' ] )
    .then( function(response)
    {
      mensagens_tabelar()
    })
    .then( function(response)
    {
      $('#mensagens_overlay').hide();
    })
  }


// ------------------------------------------------------------------------------------------------------------------------------------------------------------ COPIAR DEPOIS EXCLUIR
  // function mensagens_restaurar(id)
  // {
  //   $('#mensagens_overlay').show();

  //   {{-- var url = "{{ route('frm.mensagens.restaurar', ':id') }}"; --}}
  //   var url = url.replace(':id', id);

  //   axios.post(url)
  //   .then(function(response)
  //   {
  //     console.log(response.data)
  //     toastrjs(response.data.type, response.data.message)
  //   })
  {{-- @include('includes.catch', [ 'codigo_erro' => '2224918a' ] ) --}}
  //   .then( function(response)
  //   {
  //     mensagens_tabelar()
  //   })
  //   .then( function(response)
  //   {
  //     $('#mensagens_overlay').hide();
  //   })
  // }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
