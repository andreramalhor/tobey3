<div class="col-4">
  <div class="card">
    <div class="overlay" id="overlay_cargos">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Cargos</h3>
      <div class="card-tools">
        <div class="btn-group">
          <a class="btn b btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modal_cargos_cargos" id="Cargos_cargos"><i class="fas fa-plus"></i></a>
          <a class="btn b btn-default btn-sm" onclick="load_Cargos()"><i class="fas fa-sync-alt"></i></a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-left">Nome</th>
            <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
          </tr>
        </thead>
        <tbody id="tabela-cargos">
          <tr>
            <td class="text-center" colspan="7">Carregando ...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_cargos_cargos">
  <form method="POST" autocomplete="off" id="form_add_cargos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adicionar Cargo</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            @include('includes.form.text', [ 'colunas' => '12', 'name' => 'nome', 'id' => 'nome', 'label' => 'Nome', 'value' => null ])
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-default btn-xs" data-bs-dismiss="modal" id='cancel_cargos_cargos'>Cancel</a>
          <a class="btn btn-primary btn-xs" style="color:white" onclick="criarCargos()">Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>


@push('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    load_Cargos()
  });

  function load_Cargos()
  {
    $('#overlay_cargos').show();

    axios.get("{{ route('sistema.load_Cargos') }}")
    .then(function(response)
    {
      $('#tabela-cargos').empty();
      
      (response.data).forEach((obj, i) =>
      {
        $('#tabela-cargos').append(
          '<tr>'+
          '<td class="text-center">'+obj.id+'</td>'+
          '<td class="text-left">'+obj.nome+'</td>'+
          '<td class="text-center">'+
          '<div class="btn-group">'+
          '<a onclick="apagarCargos('+obj.id+');" class="btn btn-outline-danger btn-xs" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-times"></i></a>'+
          '</div>'+
          '</td>'+
          '</tr>'
          );
      });
    })
@include('includes.catch', [ 'codigo_erro' => '8183160a' ] )
    .then( function(response)
    {
      $('#overlay_cargos').hide();
    })
  }

  function criarCargos()
  {
    let dados = $('#form_add_cargos').serialize();

    axios.post('{{ route('sistema.store_Cargos') }}', dados)
    .then( function(response)
    {
      // console.log(response)
      toastrjs( response.data.type, response.data.message )
      $('#cancel_cargos_cargos').click();
      load_Cargos();
    })
@include('includes.catch', [ 'codigo_erro' => '4314079a' ] )
  }

  function apagarCargos(id)
  {
    url = "{{ route('sistema.delete_Cargos', ':id') }}";
    url = url.replace(':id', id );

    axios.post(url)
    .then(function(response)
    {
      toastrjs( response.data.type, response.data.message )
      $('#cancel_cargos_cargos').click();
      load_Cargos();
    })
@include('includes.catch', [ 'codigo_erro' => '9614048a' ] )
  }

  $("#cancel_cargos_cargos").on('click', function(e)
  {
    e.preventDefault();
    
    $('#nome').val("");
    $('#descricao').val("");
    $('#categoria').val("");
  });

</script>
@endpush
