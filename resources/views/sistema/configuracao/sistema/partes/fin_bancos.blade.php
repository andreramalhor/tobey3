<div class="col-4">
  <div class="card">
    <div class="overlay" id="overlay_bancos">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Bancos</h3>
      <div class="card-tools">
        <div class="btn-group">
          <a class="btn b btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modal_pessoas_bancos" id="modal_bancos"><i class="fas fa-plus"></i></a>
          <a class="btn b btn-default btn-sm" onclick="load_Bancos()"><i class="fas fa-sync-alt"></i></a>
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
        <tbody id="tabela-bancos">
          <tr>
            <td class="text-center" colspan="7">Carregando ...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_pessoas_bancos">
  <form method="POST" autocomplete="off" id="form_add_bancos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adicionar Banco</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            @include('includes.form.text', [ 'colunas' => '9', 'name' => 'nome', 'id' => 'nome', 'label' => 'Nome', 'value' => null ])
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-default btn-xs" data-bs-dismiss="modal" id='cancel_pessoas_bancos'>Cancel</a>
          <a class="btn btn-primary btn-xs" style="color:white" onclick="criarBancos()">Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>


@push('js')
<script type="text/javascript">
  $(document).ready( function() {
    load_Bancos()
  });

  function load_Bancos() {
    $('#overlay_bancos').show();

    axios.get("{{ route('sistema.load_Bancos') }}")
    .then(function(response) {
      $('#tabela-bancos').empty();
      
      (response.data).forEach((obj, i) => {
        if(obj.id == 1 || obj.id == 2)
        {
          disabled = 'disabled';
        }
        else
        {
          disabled = '';
        }

        $('#tabela-bancos').append(
          '<tr>'+
          '<td class="text-center">'+obj.id+'</td>'+
          '<td class="text-left">'+obj.nome+'</td>'+
          '<td class="text-center">'+
          '<div class="btn-group">'+
          '<a onclick="apagarBancos('+obj.id+');" class="btn btn-outline-danger btn-xs '+disabled+'" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-times"></i></a>'+
          '</div>'+
          '</td>'+
          '</tr>'
          );
      });
    })
@include('includes.catch', [ 'codigo_erro' => '2542120a' ] )
    .then( function(response) {
      $('#overlay_bancos').hide();
    })
  }

  function criarBancos() {
    let dados = $('#form_add_bancos').serialize();

    axios.post('{{ route('sistema.store_Bancos') }}', dados)
    .then( function(response) {
      // console.log(response)
      toastrjs( response.data.type, response.data.message )
      $('#cancel_pessoas_bancos').click();
      load_Bancos();
    })
@include('includes.catch', [ 'codigo_erro' => '8309045a' ] )
  }

  function apagarBancos(id) {
    url = "{{ route('sistema.delete_Bancos', ':id') }}";
    url = url.replace(':id', id );

    axios.post(url)
    .then(function(response) {
      toastrjs( response.data.type, response.data.message )
      $('#cancel_pessoas_bancos').click();
      load_Bancos();
    })
@include('includes.catch', [ 'codigo_erro' => '9596688a' ] )
  }

  $("#cancel_pessoas_bancos").on('click', function(e) {
    e.preventDefault();
    
    $('#nome').val("");
    $('#descricao').val("");
    $('#categoria').val("");
  });

</script>
@endpush
