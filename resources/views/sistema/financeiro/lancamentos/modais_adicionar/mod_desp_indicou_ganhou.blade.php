<form autocomplete='off' id='form-lancamentos-desp_indicou_ganhou'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header bg-navy' style='padding: 8px 16px'>
        <h5 class='modal-title'>Campanha de Inidicação: Indicou, Ganhou!</h5>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class='col-6' id='div_premiado'>
            <div class='form-group'>
              <label>Premiado (Aluno que indicou):</label>
              <select class='form-control form-control-sm select2' id='premiado' name='0[id_cliente]'>
                <option value=''>Selecione a premiado . . .</option>
                @foreach($pessoas as $id => $nome)
                  <option value='{{ $id }}'>{{ $nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class='col-6' id='div_indicado'>
            <div class='form-group'>
              <label>Aluno indicado:</label>
              <select class='form-control form-control-sm select2' id='indicado'>
                <option value=''>Selecione o aluno indicado . . .</option>
                @foreach($pessoas as $id => $nome)
                  <option value='{{ $id }}'>{{ $nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between' style='padding: 6px 12px'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        <a class='btn btn-primary' id='submit-desp_indicou_ganhou' style='display: none;'>Efetivar</a>
      </div>
    </div>
  </div>

  <input type='hidden' name='0[tipo]'                   value='D'>
  <input type='hidden' name='0[id_banco]'               value='{{ \Auth::User()->abcde->first()->id_banco ?? null }}'>
  <input type='hidden' name='0[id_conta]'               value='167'>
  <input type='hidden' name='0[num_documento]'          value=''>
  <input type='hidden' name='0[informacao]'             value=''                                     id='informacao'>
  <input type='hidden' name='0[vlr_bruto]'              value='20'>
  <input type='hidden' name='0[vlr_dsc_acr]'            value='0'>
  <input type='hidden' name='0[vlr_final]'              value='20'>
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

  <input type='hidden' name='tipo'                      value='desp_indicou_ganhou'>
</form>

<script type='text/javascript'>
//
$('#form-lancamentos-desp_indicou_ganhou').change(function()
{
  indicado    = $('#indicado option:selected').text()
  id_indicado = $('#indicado option:selected').val()

  $('#informacao').val('Premiado pela indicação do novo aluno: ('+id_indicado+') '+indicado)

  if($('#premiado').val() != '' && $('#indicado').val() != '')
  {
    $('#submit-desp_indicou_ganhou').show()
  }
  else
  {
    $('#submit-desp_indicou_ganhou').hide()
  }
})

$('#submit-desp_indicou_ganhou').click(function(event)
{
  event.preventDefault()

  dados = $('#form-lancamentos-desp_indicou_ganhou').serialize()
  
  axios.post('{{ route('fin.lancamentos.gravar') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '2913282a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    lancamentos_tabelar_nao_confirmados()
    lancamentos_tabelar_confirmados()
  })
})

</script>
