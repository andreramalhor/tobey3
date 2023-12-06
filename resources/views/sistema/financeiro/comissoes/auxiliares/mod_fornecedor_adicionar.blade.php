<div class="modal fade" id="modal_fornecedor_adicionar" aria-hidden="true" style="display: none; color: black;">
  <div class="modal-dialog modal-lg">
    <form autocomplete="off" id="form-fornecedor-adicionar">
      <div class="modal-content">
        <div class="modal-header bg-navy" style="padding: 8px 16px">
          <h5 class="modal-title">Adicionar Serviço</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <label>Serviço</label>
                  <select class="form-control form-control-sm select2" id="adicionar_id_fornecedor">
                    <option>Carregando . . .</option> 
                  </select>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <a class="btn btn-default" data-bs-dismiss="modal">Cancel</a>
          <a class="btn btn-primary" data-bs-dismiss="modal" onclick="categoria_fornecedor_adicionar()">Adicionar</a>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
<script>
$('#modal_fornecedor_adicionar').on('shown.bs.modal', categoria_fornecedor_mostrar)

function categoria_fornecedor_mostrar()
{
    {{--
  // $('#overlay-pessoas').show()
  $("#adicionar_id_fornecedor").append('<option value="">Carregando . . . </option>')
  var url = "{{ route('cat.fornecedores.plucar') }}"
  var url = url.replace(':params', '?params='+params)

  var params = url+'?id_categoria={{ $categoria->id }}&Xid_categoria=!='
--}}
  axios.get(params)
  .then(function(response)
  {
    // console.log(response.data)
    $("#adicionar_id_fornecedor").empty().append('<option value="">Selecione . . . </option>')
    $.each( response.data, function(value, key)
    {
      $("#adicionar_id_fornecedor").append('<option value="'+key+'">'+value+'</option>')
    })
  })
@include('includes.catch', [ 'codigo_erro' => '8193711a' ] )
  .then( function(response)
  {
    $('.select2').select2({
      dropdownParent: $('#modal_fornecedor_adicionar'),
    });
  })
}

function categoria_fornecedor_adicionar()
{
  {{--
  var url = "{{ route('cat.fornecedores.atualizar', ':idd') }}"
  var url = url.replace(':idd', $("#adicionar_id_fornecedor").val())
  var dados = {
    id_categoria: {{ $categoria->id }},
  }
  --}}

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '7475834a' ] )
  .then( function(response)
  {
    $('#fornecedoresMostrarFornecedores').empty()
    mostrarFornecedores(0)
    // $('#overlay-pessoas').hide()
  })
}

function categoria_fornecedor_excluir(id)
{
  {{--
    var url = "{{ route('cat.fornecedores.atualizar', ':idd') }}"
    var url = url.replace(':idd', id)
    
    var dados = {
      id_categoria: 0,
    }
    --}}

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '8294012a' ] )
  .then( function(response)
  {
    $('#fornecedoresMostrarFornecedores').empty()
    mostrarFornecedores(0)
    // $('#overlay-pessoas').hide()
  })
}

</script>
@endpush
