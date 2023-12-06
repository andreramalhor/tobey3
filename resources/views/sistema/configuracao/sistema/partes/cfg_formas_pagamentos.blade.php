<div class="col-8">
  <div class="card">
    <div class="overlay" id="overlay_formas_de_pagamentos">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="card-header">
      <h3 class="card-title">Formas de Pagamentos</h3>
      <div class="card-tools">
        <div class="btn-group">
          <a class="btn b btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modal_cnf_formadepagamento" id="modal_formadepagamento"><i class="fas fa-plus"></i></a>
          <a class="btn b btn-default btn-sm" onclick="load_FormasDePagamentos()"><i class="fas fa-sync-alt"></i></a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-left">Forma</th>
            <th class="text-left">Tipo</th>
            <th class="text-left">Bandeira</th>
            <th class="text-left">Parcela</th>
            <th class="text-left">Taxa</th>
            <th class="text-left">Prazo</th>
            <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
          </tr>
        </thead>
        <tbody id="tabela-formas_de_pagamentos">
          <tr>
            <td class="text-center" colspan="3">Carregando ...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_cnf_formadepagamento">
  <form method="POST" autocomplete="off" id="form_add_formadepagamento">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adicionar Forma de Pagamento</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            @include('includes.form.text', [ 'colunas' => '6', 'name' => 'forma', 'id' => 'forma', 'label' => 'Forma', 'value' => null ])
            @include('includes.form.text', [ 'colunas' => '6', 'name' => 'tipo', 'id' => 'tipo', 'label' => 'Tipo', 'value' => null ])
            @include('includes.form.text', ['colunas' => '6', 'name' => 'bandeira',  'id' => 'bandeira', 'label' => 'Bandeira', 'value' => null ])
            @include('includes.form.text', ['colunas' => '2', 'name' => 'parcela',  'id' => 'parcela', 'label' => 'Parcela', 'value' => null ])
            @include('includes.form.text', ['colunas' => '2', 'name' => 'taxa',  'id' => 'taxa', 'label' => 'Taxa', 'value' => null ])
            @include('includes.form.text', ['colunas' => '2', 'name' => 'prazo',  'id' => 'prazo', 'label' => 'Prazo', 'value' => null ])
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-default btn-xs" data-bs-dismiss="modal" id='cancel_cnf_formadepagamento'>Cancel</a>
          <a class="btn btn-primary btn-xs" style="color:white" onclick="criarForma_de_Pagamento()">Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>


@push('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    load_FormasDePagamentos()
  });

  function load_FormasDePagamentos()
  {
    // console.log(response)
    $('#overlay_formas_de_pagamentos').show();

    axios.get("{{ route('sistema.load_FormasDePagamentos') }}")
    .then(function(response)
    {
      $('#tabela-formas_de_pagamentos').empty();
      
      (response.data).forEach((obj, i) => {
        if(obj.id == 1)
        {
          disabled = 'disabled';
        }
        else
        {
          disabled = '';
        }

        $('#tabela-formas_de_pagamentos').append(
          '<tr>'+
            '<td class="text-center">'+obj.id+'</td>'+
            '<td class="text-left">'+obj.forma+'</td>'+
            '<td class="text-left">'+obj.tipo+'</td>'+
            '<td class="text-left">'+obj.bandeira+'</td>'+
            '<td class="text-left">'+obj.parcela+'</td>'+
            '<td class="text-left">'+obj.prazo+'</td>'+
            '<td class="text-center">'+
              '<div class="btn-group">'+
                '<a onclick="apagarForma_de_Pagamento('+obj.id+');" class="btn btn-outline-danger btn-xs '+disabled+'" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-times"></i></a>'+
              '</div>'+
            '</td>'+
          '</tr>'
          );
      });
    })
@include('includes.catch', [ 'codigo_erro' => '3652432a' ] )
    .then(function(response)
    {
      $('#overlay_formas_de_pagamentos').hide();
    })
  }

  function criarForma_de_Pagamento()
  {
    let dados = $('#form_add_formadepagamento').serialize();

    axios.post('{{ route('sistema.store_FormasDePagamentos') }}', dados)
    .then(function(response)
    {
      // console.log(response)
      toastrjs( response.data.type, response.data.message )
      $('#cancel_cnf_formadepagamento').click();
      load_FormasDePagamentos();
    })
@include('includes.catch', [ 'codigo_erro' => '9421318a' ] )
  }

  function apagarForma_de_Pagamento(id)
  {
    url = "{{ route('sistema.delete_FormasDePagamentos', ':id') }}";
    url = url.replace(':id', id );

    axios.post(url)
    .then(function(response)
    {
      toastrjs( response.data.type, response.data.message )
      $('#cancel_cnf_formadepagamento').click();
      load_FormasDePagamentos();
    })
@include('includes.catch', [ 'codigo_erro' => '3488935a' ] )
  }

  $("#cancel_cnf_formadepagamento").on('click', function(e)
  {
    e.preventDefault();
    
    $('#nome').val("");
    $('#descricao').val("");
    $('#categoria').val("");
  });

</script>
@endpush
