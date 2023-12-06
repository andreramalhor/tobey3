<div class="modal fade" id="modal_cpf" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Corrigir CPF</h5>
        <input type="hidden" id="corrigir_cpf_id" value="{{ $id_pessoa ?? null }}">
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>CPF</label>
              <input type="text" class="form-control form-control-sm text-center cpf" id="corrigir_cpf_cpf" value="{{ $cpf_anterior ?? null }}">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a class="btn btn-sm btn-default" data-bs-dismiss="modal">Cancelar</a>
        <a class="btn btn-sm btn-primary" onclick="cpf_alterar()">Alterar</a>
      </div>
    </div>
  </div>
</div>

<script type='text/javascript'>
//
$(document).ready(function()
{
  inputMasksActivate()
})

function cpf_alterar()
{
  var dados = {
    cpf: $('#corrigir_cpf_cpf').val(),
  };

  var url = "{{ route('atd.pessoas.atualizar', ':idd') }}";
  var url = url.replace(':idd', $('#corrigir_cpf_id').val());
  
  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '6868809a' ] )
  .then(function()
  {
    {{ $then_function }}
    $('#modal_cpf').modal('hide')
  })
}
</script>
