<form autocomplete='off' id='form-lancamentos-transferencia'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header bg-navy' style='padding: 8px 16px'>
        <h5 class='modal-title'>Realizar Transferência</h5>
      </div>
      <div class='modal-body'>
      <div class='row'>
          <div class='col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5' id='div_origem'>
            <div class='form-group'>
              <label>De:</label>
              <select class='form-control form-control-sm' id='origem' name='0[id_banco]' onchange='origem_escolhido(this.value)'>
                <option value=''>Selecione a origem . . .</option>
                @foreach($bancos as $id => $banco)
                  <option value='{{ $id }}'>{{ $banco }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
            <div class='form-group'>
              <label>Cx:</label>
              <select class='form-control form-control-sm' id='caixa_origem'>
                <option value=''>-</option>
              </select>
            </div>
          </div>
          <div class='col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5' id='div_destino'>
            <div class='form-group'>
              <label>Para:</label>
              <select class='form-control form-control-sm' id='destino' name='1[id_banco]'>
                <option value=''>Selecione primeiro a origem . . .</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
            <div class='form-group'>
              <label>Cx:</label>
              <select class='form-control form-control-sm' id='caixa_destino'>
                <option value=''>-</option>
              </select>
            </div>
          </div>
          <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'></div>
          <div id='div_valor' class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' style='display: none'>
            <label for='valor'>Valor a ser transferido</label>
            <input type='text' class='form-control form-control-sm text-right' id='valor' placeholder='0,00'>
          </div>
          <div class='col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'></div>
        </div>
      </div>
      <div class='modal-footer justify-content-between' style='padding: 6px 12px'>
        <a class='btn btn-default' data-bs-dismiss='modal' id='cancel_modal_transferencia'>Cancelar</a>
        <a class='btn btn-primary' id='submit-transferencia'>Efetivar</a>
      </div>
    </div>
  </div>

  <input type='hidden' name='0[tipo]'                   value='T'>
  <input type='hidden' name='0[id_banco]'               value=''                           id='ori_id_banco'>
  <input type='hidden' name='0[id_conta]'               value='3'>
  <input type='hidden' name='0[num_documento]'          value=''>
  <input type='hidden' name='0[id_cliente]'             value=''>
  <input type='hidden' name='0[informacao]'             value=''                           id='ori_informacao'>
  <input type='hidden' name='0[vlr_bruto]'              value=''                           id='ori_vlr_bruto'>
  <input type='hidden' name='0[vlr_dsc_acr]'            value='0'>
  <input type='hidden' name='0[vlr_final]'              value=''                           id='ori_vlr_liquido'>
  <input type='hidden' name='0[parcela]'                value='01/01'>
  <input type='hidden' name='0[id_forma_pagamento]'     value='1'>
  <input type='hidden' name='0[descricao]'              value='Dinheiro'>
  <input type='hidden' name='0[dt_vencimento]'          value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='0[dt_recebimento]'         value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='0[dt_confirmacao]'         value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='0[id_usuario_lancamento]'  value='{{ Auth::user()->id }}'>
  <input type='hidden' name='0[id_usuario_confirmacao]' value='{{ Auth::user()->id }}'>
  <input type='hidden' name='0[id_caixa]'               value=''                           id='ori_id_caixa'>
  <input type='hidden' name='0[id_lancamento_origem]'   value=''>
  <input type='hidden' name='0[origem]'                 value=''>
  <input type='hidden' name='0[status]'                 value='Confirmado'>

  <input type='hidden' name='1[tipo]'                   value='T'>
  <input type='hidden' name='1[id_banco]'               value=''                           id='des_id_banco'>
  <input type='hidden' name='1[id_conta]'               value='3'>
  <input type='hidden' name='1[num_documento]'          value=''>
  <input type='hidden' name='1[id_cliente]'             value=''>
  <input type='hidden' name='1[informacao]'             value=''                           id='des_informacao'>
  <input type='hidden' name='1[vlr_bruto]'              value=''                           id='des_vlr_bruto'>
  <input type='hidden' name='1[vlr_dsc_acr]'            value='0'>
  <input type='hidden' name='1[vlr_final]'              value=''                           id='des_vlr_liquido'>
  <input type='hidden' name='1[parcela]'                value='01/01'>
  <input type='hidden' name='1[id_forma_pagamento]'     value='1'>
  <input type='hidden' name='1[descricao]'              value='Dinheiro'>
  <input type='hidden' name='1[dt_vencimento]'          value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='1[dt_recebimento]'         value='{{ \Carbon\Carbon::Today() }}'>
  <input type='hidden' name='1[dt_confirmacao]'         value=''                           id='des_dt_confirmacao'>
  <input type='hidden' name='1[id_usuario_lancamento]'  value='{{ Auth::user()->id }}'>
  <input type='hidden' name='1[id_usuario_confirmacao]' value='{{ Auth::user()->id }}'>
  <input type='hidden' name='1[id_caixa]'               value=''                           id='des_id_caixa'>
  <input type='hidden' name='1[id_lancamento_origem]'   value=''>
  <input type='hidden' name='1[origem]'                 value=''>
  <input type='hidden' name='1[status]'                 value=''                           id='des_status'>
  
  <input type='hidden' name='tipo'                      value='transferencia'>
</form>

<script type='text/javascript'>
//
$(document).ready(function()
{
  // $('#valor').inputmask('decimal', {
  //   'alias': 'numeric',
  //   'groupSeparator': '.',
  //   'autoGroup': true,
  //   'digits': 2,
  //   'radixPoint': ',',
  //   'digitsOptional': false,
  //   'allowMinus': false,
  //   'placeholder': '0,00',
  // })
})

$('#valor').change(function()
{
  valor   = accounting.unformat( $('#valor').val() )
  
  $('#vlr_final').val(valor)
  $('#vlr_bruto').val(valor)
})

function origem_escolhido(event)
{
  $('#div_valor').hide()
  
  url = '{{ route('fin.banco.transferencia', ':id') }}'
  url = url.replace(':id',  $('#origem').val())
  
  axios.get(url)
  .then(function(response)
  {
    // console.log(response)
    $('#destino').empty()
    $('#destino').append('<option value="">Selecione ...</option>')
    $.each(response.data, function (key, value)
    {
      $('#destino').append('<option value="' + value.id + '">' + value.nome + '</option>')
    })
 })
@include('includes.catch', [ 'codigo_erro' => '6909781a' ] )
  .then()
  {
    url = '{{ route('pdv.caixas.locais', ':id') }}'
    url = url.replace(':id',  $('#origem').val())

    axios.get(url)
    .then(function(response)
    {
      // console.log(response)
      $('#caixa_origem').empty()
      if((response.data).length > 0)
      {
        $('#caixa_origem').append('<option value="">[  ]</option>')
        $.each(response.data, function (key, value)
        {
          $('#caixa_origem').append('<option value="' + value.id + '" selected>' + value.id+ '</option>')
        })
      }
      else
      {
        $('#caixa_origem').append('<option value="">-</option>')
      }
    })
@include('includes.catch', [ 'codigo_erro' => '5602952a' ] )
  }
}

$('#destino').change(function()
{  
  url = '{{ route('pdv.caixas.locais', ':id') }}'
  url = url.replace(':id',  $('#destino').val())

  axios.get(url)
  .then(function(response)
  {
    // console.log(response)
    $('#caixa_destino').empty()
    if((response.data).length > 0)
    {
      $('#caixa_destino').append('<option value="">[  ]</option>')
      $.each(response.data, function (key, value)
      {
        $('#caixa_destino').append('<option value="' + value.id + '" selected>' + value.id+ '</option>')
      })
    }
    else
    {
      $('#caixa_destino').append('<option value="">-</option>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '7339093a' ] )
  .then()
  {
    $('#div_valor').show()
  }
})

$('#form-lancamentos-transferencia').change(function()
{
  valor          = accounting.unformat( $('#valor').val() )
  
  ori_banco      = $('#origem option:selected').text()
  des_banco      = $('#destino option:selected').text()
  
  ori_id_banco   = $('#origem option:selected').val()
  des_id_banco   = $('#destino option:selected').val()
  
  ori_id_caixa   = $('#caixa_origem option:selected').val()
  des_id_caixa   = $('#caixa_destino option:selected').val()
  
  
  $('#ori_vlr_bruto').val(parseFloat(valor * -1).toFixed(2))
  $('#ori_vlr_liquido').val(parseFloat(valor * -1).toFixed(2))
  $('#des_vlr_bruto').val(parseFloat(valor).toFixed(2))
  $('#des_vlr_liquido').val(parseFloat(valor).toFixed(2))
  
  $('#ori_informacao').val('Transferência do(a) '+ori_banco+' para o(a) '+des_banco)
  $('#des_informacao').val('Transferência do(a) '+ori_banco+' para o(a) '+des_banco)
  
  $('#ori_id_banco').val(ori_id_banco)
  $('#des_id_banco').val(des_id_banco)
  
  $('#ori_id_caixa').val(ori_id_caixa)
  $('#des_id_caixa').val(des_id_caixa)
  
  if($('#des_id_caixa').val() == '')
  {
    $('#des_status').val('À Confirmar')
    $('#des_dt_confirmacao').val()
  }
  else
  {
    $('#des_status').val('Confirmado')
    $('#des_dt_confirmacao').val('{{ \Carbon\Carbon::Today() }}')
  }
  
  if($('#ori_id_caixa').val() == '')
  {
    $('#ori_status').val('À Confirmar')
    $('#ori_dt_confirmacao').val()
  }
  else
  {
    $('#ori_status').val('Confirmado')
    $('#ori_dt_confirmacao').val('{{ \Carbon\Carbon::Today() }}')
  }
})


$('#submit-transferencia').click(function(event)
{
  event.preventDefault()

  dados = $('#form-lancamentos-transferencia').serialize()
  
  axios.post('{{ route('fin.lancamentos.gravar') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
@include('includes.catch', [ 'codigo_erro' => '6679914a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    lancamentos_tabelar_nao_confirmados()
    lancamentos_tabelar_confirmados()
  })
})

</script>
