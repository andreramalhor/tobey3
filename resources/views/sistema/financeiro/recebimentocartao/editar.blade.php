<form autocomplete='off' id='form-recebimento_cartoes-editar'>
  <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
      <div class='modal-header bg-navy' style='padding: 8px 16px'>
        <h5 class='modal-title'>Detalhes da Venda no Cartão: # {{ $recebimento->id }}</h5>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class='col-1'>
            <div class='form-group'>
              <label>#</label>
              <input type="text" class='form-control form-control-sm' id='id' value='{{ $recebimento->id }}' readonly='true'>            </div>
          </div>
          <div class='col-1'>
            <div class='form-group'>
              <label># Venda</label>
              <input type="text" class='form-control form-control-sm' value='{{ $recebimento->qjslcnhfdjsftre->id }}' readonly='true'>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Forma de Pagamento</label>
              <input type="text" class='form-control form-control-sm' value='{{ $recebimento->gevmgwjvzgdexwm->forma }}' readonly='true'>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Bandeira</label>
              <select class='form-control form-control-sm' id="bandeira" onchange='calcular_valores("bandeira")'>
                <option {{ $recebimento->gevmgwjvzgdexwm->bandeira == "MasterCard" ? "selected" : "" }}>MasterCard</option>                
                <option {{ $recebimento->gevmgwjvzgdexwm->bandeira == "Visa" ? "selected" : "" }}>Visa</option>                
                <option {{ $recebimento->gevmgwjvzgdexwm->bandeira == "Elo" ? "selected" : "" }}>Elo</option>                
              </select>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Data Prevista</label>
              <input type="date" class='form-control form-control-sm' name='dt_prevista' value='{{ Carbon\Carbon::parse($recebimento->dt_prevista)->format("Y-m-d") }}' onchange='calcular_valores("dt_prevista")'>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Valor Bruto</label>
              <input type="text" class='form-control form-control-sm text-rigth' id='vlr_real' value='{{ number_format($recebimento->vlr_real, 2, ",", ".") }}' readonly='true'>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Taxa</label>
              <input type="text" class='form-control form-control-sm text-rigth' id='taxa2' value='{{ number_format($recebimento->gevmgwjvzgdexwm->taxa, 2, ",", ".") }}' onchange='calcular_valores("taxa")'>
              <input type="hidden" name='taxa' id='taxa' value='{{ $recebimento->gevmgwjvzgdexwm->taxa }}'>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Valor Descontado</label>
              <input type="text" class='form-control form-control-sm text-rigth' id='vlr_desc2' value='{{ number_format($recebimento->vlr_final - $recebimento->vlr_real, 2, ",", ".") }}' onchange='calcular_valores("vlr_desc")'>
              <input type="hidden" name='vlr_desc' id='vlr_desc' value='{{ $recebimento->vlr_final - $recebimento->vlr_real }}'>
            </div>
          </div>
          <div class='col-3'>
            <div class='form-group'>
              <label>Valor Líquido</label>
              <input type="text" class='form-control form-control-sm text-rigth' id='vlr_final2' value='{{ number_format($recebimento->vlr_final, 2, ",", ".") }}' onchange='calcular_valores("vlr_final")'>
              <input type="hidden" name='vlr_final' id='vlr_final' value='{{ $recebimento->vlr_final }}'>
            </div>
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between' style='padding: 6px 12px'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        <a class='btn btn-primary' id='submit-recebimento_cartoes-editar' style='display: none;'>Efetivar</a>
      </div>
    </div>
  </div>
</form>

<script type='text/javascript'>
//
function calcular_valores( item_alterado )
{
  vlr_real  = accounting.unformat($('#vlr_real').val())
  vlr_desc  = accounting.unformat($('#vlr_desc2').val())
  taxa      = accounting.unformat($('#taxa2').val())
  vlr_final = accounting.unformat($('#vlr_final2').val())

  switch (item_alterado)
  {
    case 'vlr_desc':
      taxa      = vlr_desc * -100 / vlr_real
      vlr_final = vlr_real + vlr_desc
      break;

    case 'taxa':
      vlr_desc  = vlr_real * taxa / -100
      vlr_final = vlr_real + vlr_desc
      break;
      
    case 'vlr_final':
      vlr_desc  = vlr_final - vlr_real
      taxa      = vlr_desc * -100 / vlr_real
      break;
      
    case 'dt_prevista':
      break;
      
    case 'bandeira':
      break;
  }
  
  $('#vlr_desc2').val(accounting.formatMoney(vlr_desc, ''))
  $('#taxa2').val(accounting.formatMoney(taxa, ''))
  $('#vlr_final2').val(accounting.formatMoney(vlr_final, ''))

  $('#vlr_desc').val(vlr_desc)
  $('#taxa').val(taxa)
  $('#vlr_final').val(vlr_final)

  $('#submit-recebimento_cartoes-editar').show()
}


$('#submit-recebimento_cartoes-editar').click(function(event)
{
  event.preventDefault()

  var url = "{{ route('fin.rec_cartoes.atualizar', ':idd') }}";
  var url = url.replace(':idd', $('#id').val(),);

  dados = $('#form-recebimento_cartoes-editar').serialize()
  
  axios.put(url, dados)
  .then(function(response)
  {
    console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '1469745a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    recCartoes_tabelar()
  })
})

</script>
