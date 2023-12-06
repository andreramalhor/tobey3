<form autocomplete='off' id='form-lancamentos-receita_geral'>
  <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
      <div class='modal-header bg-navy' style='padding: 8px 16px'>
        <h5 class='modal-title'>Receitas Gerais</h5>
      </div>
      <div class='modal-body'>
        <div class='row'>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class='form-group'>
              <label>Conta</label>
              <select class='form-control form-control-sm select2' name='0[id_conta]'>
                <option value=''>Carregando . . .</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
            <div class='form-group'>
              <label>Banco</label>
              <select class='form-control form-control-sm select2' name='0[id_banco]'>
                <option value=''>Carregando . . .</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
            <div class='form-group'>
              <label>Forma Pgto</label>
              <select class='form-control form-control-sm select2' name='0[id_forma_pagamento]'>
                <option value='1'>Dinheiro</option>
                <option value='2'>Cartão de Débito</option>
                <option value='3'>Cartão de Crédito</option>
                <option value='84'>PIX</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class='form-group'>
              <label>Pessoa</label>
              <select class='form-control form-control-sm select2' id='pessoa' name='0[id_cliente]'>
                <option value=''>Selecione a pessoa . . .</option>
                @foreach($pessoas as $id => $nome)
                <option value='{{ $id }}'>{{ $nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Data de Vencimento</label>
              <input type='date' class='form-control form-control-sm' name='0[dt_vencimento]' value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class='form-group'>
              <label>Data de Pagamento</label>
              <input type='date' class='form-control form-control-sm' name='0[dt_pagamento]' value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
            <div class='form-group'>
              <label>Valor Bruto</label>
              <input type='text' class='form-control form-control-sm text-right' id='d_vlr_bruto' placeholder='0,00'>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
            <div class='form-group'>
              <label>Valor Desc./Acrs.</label>
              <input type='text' class='form-control form-control-sm text-right' id='d_vlr_dsc_acr' placeholder='0,00'>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
            <div class='form-group'>
              <label>Valor Final</label>
              <input type='text' class='form-control form-control-sm text-right' id='d_vlr_final' placeholder='0,00' readonly>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class='form-group'>
              <label>Descrição</label>
              <textarea type='text' class='form-control form-control-sm' name='0[informacao]' placeholder='Informação sobre a despesa'></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class='modal-footer justify-content-between' style='padding: 6px 12px'>
        <a class='btn btn-default' data-bs-dismiss='modal'>Cancelar</a>
        <a class='btn btn-primary' id='submit-receita_geral' style='display: none;'>Efetivar</a>
      </div>
    </div>
  </div>
  
  <input type='hidden' name='0[tipo]'                   value='R'>
  <input type='hidden' name='0[id_banco]'               value='{{ \Auth::User()->abcde->first()->id_banco ?? null }}'>
  <input type='hidden' name='0[num_documento]'          value=''>
  <input type='hidden' name='0[vlr_bruto]'              value='0'                  id="vlr_bruto" >
  <input type='hidden' name='0[vlr_dsc_acr]'            value='0'                  id="vlr_dsc_acr" >
  <input type='hidden' name='0[vlr_final]'              value='0'                  id="vlr_final" >
  <input type='hidden' name='0[parcela]'                value='01/01'>
  <input type='hidden' name='0[descricao]'              value='Dinheiro'>
  <input type='hidden' name='0[dt_confirmacao]'         value='{{ \Carbon\Carbon::today() }}'>
  <input type='hidden' name='0[id_usuario_lancamento]'  value='{{ Auth::user()->id }}'>
  <input type='hidden' name='0[id_usuario_confirmacao]' value='{{ Auth::user()->id }}'>
  <input type='hidden' name='0[id_caixa]'               value='{{ \Auth::User()->abcde->first()->id ?? null }}'>
  <input type='hidden' name='0[id_lancamento_origem]'   value=''>
  <input type='hidden' name='0[origem]'                 value=''>
  <input type='hidden' name='0[status]'                 value='Confirmado'>

  <input type='hidden' name='tipo'                      value='receita_geral'>
</form>

<script type='text/javascript'>
//
contas_contabeis()
function contas_contabeis()
{
  axios.get('{{ route('con.contas.plucar') }}')
  .then(function(response)
  {
    // console.log(response)
    $("[name='0[id_conta]']").empty().append('<option>Selecione . . . </option>');
    
    collect(response.data).each((value, key) => {
      $("[name='0[id_conta]']").append('<option value="'+value.id+'">'+value.conta+' - '+value.descricao+'</option>');
    });
  })
  @include('includes.catch', [ 'codigo_erro' => '6248995a' ] )
}

bancos_plucar()
function bancos_plucar()
{
  axios.get("{{ route('fin.bancos.plucar') }}")
  .then( function(response)
  {
    // console.log(response.data)
    $("[name='0[id_banco]']").empty().append('<option>Selecione . . .</option>');
    $.each(response.data, function (id, nome)
    {
      $("[name='0[id_banco]']").append('<option value='+id+'>'+nome+'</option>')
    });
  })
  @include('includes.catch', [ 'codigo_erro' => '3871342a' ] )
  .then( function()
  {
    if ({{ \Auth::User()->abcde->first()->id_banco ?? 0 }} == 0 )
    {
      $("[name='0[id_banco]']").val( $("[name='0[id_banco]'] option:first").val() ).trigger('change');
    }
    else
    {
      $("[name='0[id_banco]']").val( "{{ \Auth::User()->abcde->first()->id_banco ?? 0 }}" ).trigger('change');
    }
    
    setTimeout(() => {
      $('#mod_receita_geral-overlay').hide()
    }, 500);
  })
}

$('#form-lancamentos-receita_geral').change(function()
{
  d_vlr_bruto   = accounting.unformat( $('#d_vlr_bruto').val() )
  d_vlr_dsc_acr = accounting.unformat( $('#d_vlr_dsc_acr').val() )

  $('#d_vlr_final').val( accounting.formatMoney( d_vlr_bruto + d_vlr_dsc_acr ))
  
  $('#vlr_bruto').val( accounting.unformat( d_vlr_bruto ))
  $('#vlr_dsc_acr').val( accounting.unformat( d_vlr_dsc_acr ))
  $('#vlr_final').val( accounting.unformat( d_vlr_bruto + d_vlr_dsc_acr ))

  if(accounting.unformat($('#vlr_final').val()) == 0 )
  {
    $('#submit-receita_geral').hide()
  }
  else
  {
    $('#submit-receita_geral').show()
  }
})

$('#submit-receita_geral').click(function(event)
{
  $('#mod_receita_geral-overlay').show()
  
  event.preventDefault()

  dados = $('#form-lancamentos-receita_geral').serialize()
  
  axios.post('{{ route('fin.lancamentos.gravar') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    toastrjs(response.data.type, response.data.message )
  })
  @include('includes.catch', [ 'codigo_erro' => '3874646a' ] )
  .then(function()
  {
    $('#modal-geral-1').modal('hide')
    lancamentos_tabelar_nao_confirmados()
    lancamentos_tabelar_confirmados()
    
    setInterval(() => {
      $('#mod_receita_geral-overlay').hide()
    }, 500);
  })
})

</script>
  