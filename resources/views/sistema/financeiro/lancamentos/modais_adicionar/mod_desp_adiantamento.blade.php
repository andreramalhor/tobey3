<form autocomplete='off' id='form-lancamentos-desp_adiantamento'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header bg-navy' style='padding: 8px 16px'>
        <h5 class='modal-title'>Vale / Adiantamento</h5>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class='col-6'>
            <div class='form-group'>
              <label>Colaborador</label>
              <select class='form-control form-control-sm select2' id='colaborador' name='0[id_pessoa]'>
                <option value=''>Selecione o Colaborador . . .</option>
                @foreach($pessoas as $id => $nome)
                  <option value='{{ $id }}'>{{ $nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class='col-4'>
            <div class='form-group'>
              <label>Descrição</label>
              <input type='text' class='form-control form-control-sm' id='d_informacao' name='0[informacao]'>
            </div>
          </div>
          <div class='col-2'>
            <div class='form-group'>
              <label>Valor</label>
              <input type='text' class='form-control form-control-sm dinheiro text-right' id="d_vlr_final" name='0[vlr_final]' placeholder='0,00'>
            </div>
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between' style='padding: 6px 12px'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        <a class='btn btn-primary' id='submit-desp_adiantamento' style='display: none;'>Efetivar</a>
      </div>
    </div>
  </div>

  <input type='hidden' name='0[tipo]'                   value='D'>
  <input type='hidden' name='0[id_banco]'               value='{{ \Auth::User()->abcde->first()->id_banco ?? null }}'>
  <input type='hidden' name='0[id_conta]'               value='167'>
  <input type='hidden' name='0[num_documento]'          value=''>
  <input type='hidden' name='0[vlr_bruto]'              value='0'                            id='vlr_bruto'>
  <input type='hidden' name='0[vlr_dsc_acr]'            value='0'>
  <input type='hidden' name='0[vlr_final]'              value='0'                            id='vlr_final'>
  <input type='hidden' name='0[parcela]'                value='01/01'>
  <input type='hidden' name='0[id_forma_pagamento]'     value='1'>
  <input type='hidden' name='0[descricao]'              value='Dinheiro'>
  <input type='hidden' name='0[dt_vencimento]'          value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='0[dt_recebimento]'         value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='0[dt_confirmacao]'         value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='0[id_usuario_lancamento]'  value='{{ Auth::user()->id }}'>
  <input type='hidden' name='0[id_usuario_confirmacao]' value='{{ Auth::user()->id }}'>
  <input type='hidden' name='0[id_caixa]'               value='{{ \Auth::User()->abcde->first()->id ?? null }}'>
  <input type='hidden' name='0[id_lancamento_origem]'   value=''>
  <input type='hidden' name='0[origem]'                 value=''>
  <input type='hidden' name='0[status]'                 value='Confirmado'>

  <input type='hidden' name='tipo'                      value='desp_adiantamento'>
</form>

<script type='text/javascript'>
//
$('#form-lancamentos-desp_adiantamento').change(function()
{
  d_vlr_final = accounting.unformat( $('#d_vlr_final').val() )

  $('#vlr_bruto').val(d_vlr_final)
  $('#vlr_final').val(d_vlr_final)

  if($('#d_vlr_final').val() != '')
  {
    $('#submit-desp_adiantamento').show()
  }
  else
  {
    $('#submit-desp_adiantamento').hide()
  }
})

$('#submit-desp_adiantamento').click(function(event)
{
  event.preventDefault()

  dados = $('#form-lancamentos-desp_adiantamento').serialize()
  
  axios.post('{{ route('fin.lancamentos.gravar') }}', dados)
  .then(function(response)
  {
    console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '8476909a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    lancamentos_tabelar_nao_confirmados()
    lancamentos_tabelar_confirmados()
  })
})

</script>
