<div class="modal fade" id="modal_rsschool" data-bs-backdrop="static" data-bs-keyboard="false">
  <form autocomplete='off'  id='form-lancamentos-id_rsschool'>
    <div class='modal-dialog modal-xs'>
      <div class='modal-content'>
        <div class='modal-header bg-navy' style='padding: 8px 16px'>
          <h5 class='modal-title'>ID RSSCHOOL</h5>
        </div>
        <div class='modal-body'>
          <div class='row'>
          <div class='col-12'>
              <div class='form-group'>
                <label>ID Anterior (Caso já tenha sido gravado)</label>
                <input type='text' class='form-control form-control-sm' id="id_rsschool_antigo" value="" disabled="true">
              </div>
            </div>
            <div class='col-12'>
              <div class='form-group'>
                <label>ID RSSchool</label>
                <input type='text' class='form-control form-control-sm' id="id_rsschool_novo" value="">
              </div>
            </div>
          </div>
        </div>
        <div class='modal-footer justify-content-between' style='padding: 6px 12px'>
          <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
          <a class='btn btn-primary' onclick="submit_id_rsschool()">Gravar</a>
        </div>
      </div>
    </div>
    <input type='hidden' name='id' id='id'>
  </form>
</div>

<script type='text/javascript'>
//
function submit_id_rsschool()
{
  var dados = {
    id_rsschool: $('#id_rsschool_novo').val(),
  };
  
  var url = "{{ route('atd.pessoas.atualizar', ':idd') }}";
  var url = url.replace(':idd', $('#id').val(),);
  
  axios.put(url, dados)
  .then(function(response)
  {
    console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '2998812a' ] )
  .then(function()
  {
    $('#modal_rsschool').modal('hide')
    pessoas_tabelar()
  })
}
</script>
