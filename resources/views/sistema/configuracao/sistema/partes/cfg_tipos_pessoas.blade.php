<div class="col-4">
  <div class="card">
    <div class="overlay" id="overlay_tipos_de_pessoas">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Tipo de Pessoas</h3>
      <div class="card-tools">
        <div class="btn-group">
          <a class="btn b btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modal_pessoas_tipodepessoa" id="modal_tipodepessoa"><i class="fas fa-plus"></i></a>
          <a class="btn b btn-default btn-sm" onclick="load_TiposDePessoas()"><i class="fas fa-sync-alt"></i></a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-left">Tipo</th>
            <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
          </tr>
        </thead>
        <tbody id="tabela-tipos_de_pessoas">
          <tr>
            <td class="text-center" colspan="3">Carregando ...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_pessoas_tipodepessoa">
  <form method="POST" autocomplete="off" id="form_add_tipodepessoa">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adicionar Tipo de Pessoa</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            @include('includes.form.text', [ 'colunas' => '3', 'name' => 'nome', 'id' => 'nome', 'label' => 'Nome', 'value' => null ])
            @include('includes.form.text', [ 'colunas' => '5', 'name' => 'descricao', 'id' => 'descricao', 'label' => 'Descrição', 'value' => null ])
            @include('includes.form.text', ['colunas' => '4', 'name' => 'categoria',  'id' => 'categoria', 'label' => 'Categoria', 'value' => null ])
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-default btn-xs" data-bs-dismiss="modal" id='cancel_pessoas_tipodepessoa'>Cancel</a>
          <a class="btn btn-primary btn-xs" style="color:white" onclick="criarTipo_de_Pessoa()">Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>


@push('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    load_TiposDePessoas()
  });

  function load_TiposDePessoas()
  {
    // console.log(response)
    $('#overlay_tipos_de_pessoas').show();

    axios.get("{{ route('sistema.load_TiposDePessoas') }}")
    .then(function(response)
    {
      $('#tabela-tipos_de_pessoas').empty();
      
      (response.data).forEach((obj, i) => {
        if(obj.id == 1)
        {
          disabled = 'disabled';
        }
        else
        {
          disabled = '';
        }

        $('#tabela-tipos_de_pessoas').append(
          '<tr>'+
            '<td class="text-center">'+obj.id+'</td>'+
            '<td class="text-left">'+obj.nome+'</td>'+
            '<td class="text-center">'+
              '<div class="btn-group">'+
                '<a onclick="apagarTipo_de_Pessoa('+obj.id+');" class="btn btn-outline-danger btn-xs '+disabled+'" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-times"></i></a>'+
              '</div>'+
            '</td>'+
          '</tr>'
          );
      });
    })
@include('includes.catch', [ 'codigo_erro' => '4936972a' ] )
    .then(function(response)
    {
      $('#overlay_tipos_de_pessoas').hide();
    })
  }

  function criarTipo_de_Pessoa()
  {
    let dados = $('#form_add_tipodepessoa').serialize();

    axios.post('{{ route('sistema.store_TiposDePessoas') }}', dados)
    .then(function(response)
    {
      // console.log(response)
      toastrjs( response.data.type, response.data.message )
      $('#cancel_pessoas_tipodepessoa').click();
      load_TiposDePessoas();
    })
@include('includes.catch', [ 'codigo_erro' => '8811880a' ] )
  }

  function apagarTipo_de_Pessoa(id)
  {
    url = "{{ route('sistema.delete_TiposDePessoas', ':id') }}";
    url = url.replace(':id', id );

    axios.post(url)
    .then(function(response)
    {
      toastrjs( response.data.type, response.data.message )
      $('#cancel_pessoas_tipodepessoa').click();
      load_TiposDePessoas();
    })
@include('includes.catch', [ 'codigo_erro' => '8313632a' ] )
  }

  $("#cancel_pessoas_tipodepessoa").on('click', function(e)
  {
    e.preventDefault();
    
    $('#nome').val("");
    $('#descricao').val("");
    $('#categoria').val("");
  });

</script>
@endpush
