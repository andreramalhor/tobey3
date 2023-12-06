<form id="fasfdasdf">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
        {{-- <div class="overlay" id="overlay-mod_add_conta"> --}}
      {{-- <i class="fas fa-2x fa-sync fa-spin"></i> --}}
    {{-- </div> --}}
    <div class="modal-header bg-navy" style="padding: 8px 16px">
      <h5 class="modal-title">Adicionar Conta Contábil</h5>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
          <div class="form-group">
            <label>Conta Pai</label>
            <select class="form-control form-control-sm" name="conta_pai" readonly="true">
              <option value="{{ $conta->id }}">{{ $conta->titulo }}</option> 
            </select>
            <input type="hidden" name="nivel" value={{ $conta->nivel + 1 }}>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
          <div class="form-group">
            <label>Título da Conta</label>
            <input type="text" class="form-control form-control-sm" name="titulo">
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
          <div class="form-group" style="padding-top: 10px;">
            <label></label>
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
              <input type="checkbox" class="custom-control-input" id="tem_lancamento" name="tem_lancamento" value="1" checked>
              <label class="custom-control-label" for="tem_lancamento">Recebe Lançamentos</label>
            </div>
          </div>
        </div>
        {{-- <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
          <div class="form-group" style="padding-top: 10px;">
            <label></label>
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
              <input type="checkbox" class="custom-control-input" id="imprime" name="imprime" value="1" checked>
              <label class="custom-control-label" for="imprime">Imprime</label>
            </div>
          </div>
        </div> --}}
        {{-- <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
          <div class="form-group" style="padding-top: 10px;">
            <label></label>
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
              <input type="checkbox" class="custom-control-input" id="soma" name="soma" value="1" checked>
              <label class="custom-control-label" for="soma">Soma</label>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="modal-footer justify-content-between" style="padding: 6px 12px">
      <a class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
      <a class="btn btn-primary" id='submit_add_conta_contabil'>Adicionar</a>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
//
$(document).ready(function()
{
  contas_contabeis()
  bancos_plucar()
});

$("#submit_add_conta_contabil").on('click', function (e)
{
  e.preventDefault();

  var url = "{{ route('con.contas.gravar') }}"
  var params = $('#fasfdasdf').serialize();

  axios.post(url,params)
  .then(res => {
    console.log(res)
    toastrjs(res.data.type, res.data.message)
  })
  @include('includes.catch', [ 'codigo_erro' => '5431543a' ] )
  .then(() => {
    contas_tabelar()
  })

});

function contas_contabeis()
{
  axios.get('{{ route('con.contas.plucar') }}')
  .then(function(response)
  {
    // console.log(response)
    $("[name='0[id_conta]']").empty().append('<option>Selecione . . . </option>');
    
    collect(response.data).each((value, key) => {
      $("[name='0[id_conta]']").append('<option value="'+value.id+'">'+value.conta+' - '+value.titulo+'</option>');
    });
  })
  @include('includes.catch', [ 'codigo_erro' => '6248995a' ] )
}

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
      $('#mod_add_conta-overlay').hide()
    }, 500);
  })
}

$('#mod_add_conta').change(function()
{
  d_vlr_bruto   = accounting.unformat( $('#d_vlr_bruto').val() )
  d_vlr_dsc_acr = accounting.unformat( $('#d_vlr_dsc_acr').val() )

  $('#d_vlr_final').val( accounting.formatMoney( d_vlr_bruto + d_vlr_dsc_acr ))
  
  $('#vlr_bruto').val( accounting.unformat( d_vlr_bruto ))
  $('#vlr_dsc_acr').val( accounting.unformat( d_vlr_dsc_acr ))
  $('#vlr_final').val( accounting.unformat( d_vlr_bruto + d_vlr_dsc_acr ))

  if(accounting.unformat($('#vlr_final').val()) == 0 )
  {
    $('#submit-mod_add_conta').hide()
  }
  else
  {
    $('#submit-mod_add_conta').show()
  }
})

$('#submit-mod_add_conta').click(function(event)
{
  $('#mod_add_conta-overlay').show()
  
  event.preventDefault()

  dados = $('#mod_add_conta').serialize()
  
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
      $('#modal-geral-1').modal('hide')
      $('#mod_add_conta-overlay').hide()
    }, 500);
  })
})

</script>

