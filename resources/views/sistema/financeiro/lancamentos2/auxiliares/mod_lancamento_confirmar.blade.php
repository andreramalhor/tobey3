<div class="modal fade" id="modal_lancamentos_confirmar" aria-hidden="true" style="display: none; color: black;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        {{-- <div class="overlay-modal-lancamento-mostrar"> --}}
          {{-- <i class="fas fa-2x fa-sync fa-spin"></i> --}}
        {{-- </div> --}}
      <div class="modal-header bg-navy" style="padding: 8px 16px">
        <h5 class="modal-title">Confirmar Lançamento</h5>
      </div>
      <div class="modal-body">
        <form id="form_lancamentos_confirmar" onchange="teste()">
        @csrf
          <div class="row">
            <div class="col-1">
              <div class="form-group">
                <label>ID</label>
                <input type="text" class="form-control form-control-sm" id="confirmar_id" name="confirmar[id]" disabled>
                <input type="hidden" id="confirmar_id_cliente" name="confirmar[id_cliente]">
                <input type="hidden" id="confirmar_id_criador" name="confirmar[id_criador]" value="{{ Auth::User()->id }}">
                <input type="hidden" id="confirmar_status" name="confirmar[status]" value="Confirmado">
                <input type="hidden" id="confirmar_dt_confirmacao" name="confirmar[dt_confirmacao]" value="{{ \Carbon\Carbon::now() }}">
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Tipo</label>
                <select class="form-control form-control-sm" id="confirmar_tipo" name="confirmar[tipo]" disabled>
                  <option value="">Carregando. . . </option>
                  <option value="E">Entrada</option>
                  <option value="S">Saída</option>
                </select>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control form-control-sm" id="confirmar_nome" name="confirmar[nome]" disabled>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Tipo de Cobrança</label>
                <input type="text" class="form-control form-control-sm" id="confirmar_tipo_cobranca" name="confirmar[tipo_cobranca]" disabled>
              </div>
            </div>
            <div class="col-1">
              <div class="form-group">
                <label>Parc.</label>
                <input type="text" class="form-control form-control-sm" id="confirmar_parcela" name="confirmar[parcela]" disabled>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Data de Vencimento</label>
                <input type="date" class="form-control form-control-sm" id="confirmar_dt_vencimento" name="confirmar[dt_vencimento]" disabled>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Valor Original</label>
                <input type="number" class="form-control form-control-sm text-right" id="confirmar_vlr_original" name="confirmar[vlr_original]" disabled>
              </div>
            </div>
            <div class="col-7">
              <div class="form-group">
                <label>Descrição</label>
                <input type="text" class="form-control form-control-sm" id="confirmar_descricao" name="confirmar[descricao]">
              </div>
            </div>
            
            <br>
            
            <div class="col-3">
              <div class="form-group">
                <label>Banco</label>
                <select class="form-control form-control-sm" id="confirmar_id_banco" name="confirmar[id_banco]">
                  <option value="">Carregando. . . </option>
                  <option value="1">C6 Bank</option>
                  <option value="2">ASAAS</option>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Forma de Pagamento</label>
                <select class="form-control form-control-sm" id="confirmar_forma_pagamento" name="confirmar[forma_pagamento]">
                  <option value="">Carregando. . . </option>
                  <option value="PIX">PIX</option>
                  <option value="Boleto">Boleto</option>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Data do Pagamento</label>
                <input type="date" class="form-control form-control-sm" id="confirmar_dt_pagamento" name="confirmar[dt_pagamento]" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Valor</label>
                <input type="number" class="form-control form-control-sm text-right" id="confirmar_vlr_final" name="confirmar[vlr_final]" step="0.01">
              </div>
            </div>
   
  

            <div class="row">
              <div class="col-3">
                <div class="form-group p-1">
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" id="confirmar_taxa_boleto">
                    <label class="custom-control-label" for="confirmar_taxa_boleto">Taxa de Boleto</label>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="form-group p-0">
                  <span id="campo_tx_boleto"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-3">
                <div class="form-group p-1">
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" id="confirmar_taxa_nf">
                    <label class="custom-control-label" for="confirmar_taxa_nf">Tava de NF</label>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="form-group p-0">
                  <span id="campo_tx_nf"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-3">
                <div class="form-group p-1">
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" id="confirmar_taxa_mensagem">
                    <label class="custom-control-label" for="confirmar_taxa_mensagem">Taxa Menssageira</label>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="form-group p-0">
                  <span id="campo_tx_mensagem"></span>
                </div>
              </div>
            </div>

          </div>
        </form>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <button type="button" class="btn btn-default btn-sm" onclick="lancamentos_limpar()" data-bs-dismiss="modal">cancelar</button>
          <button type="button" class="btn btn-primary btn-sm disabled" onclick="lancamentos_confirmar()" id="lancamentos_confirmar" data-bs-dismiss="modal">Confirmar</button>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
<script>
//
function modal_lancamento_confirnar(id)
{
  $('#modal_lancamentos_confirmar').modal('show');

  var url = "{{ route('fin.lancamentos.mostrar_modal', ':idd') }}";
  var url = url.replace(':idd', id);

  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    $("#confirmar_id").val(response.data.id)
    $("#confirmar_id_cliente").val(response.data.id_cliente)
    $("#confirmar_tipo").val(response.data.tipo)
    $("#confirmar_nome").val(response.data.nome)
    $("#confirmar_tipo_cobranca").val(response.data.tipo_cobranca)
    $("#confirmar_parcela").val(response.data.parcela)
    $("#confirmar_dt_vencimento").val(response.data.dt_vencimento)
    $("#confirmar_vlr_original").val(parseFloat(response.data.vlr_original).toFixed(2))
    
    $("#confirmar_id_banco").val(response.data.id_banco)
    $("#confirmar_forma_pagamento").val(response.data.forma_pagamento)
    $("#confirmar_vlr_final").val(parseFloat(response.data.vlr_final).toFixed(2))

    $("#confirmar_dt_vencimento").val(response.data.dt_vencimento)
    $("#confirmar_descricao").val(response.data.descricao)
  })
}



//     $("#venda-id_caixa").text(response.data.id_caixa);
{{-- //     var link_id_caixa = "{{ route('pdv.caixas.mostrar', ':idd') }}"; --}}
//     var link_id_caixa = link_id_caixa.replace(':idd', response.data.id_caixa);
//     $("#link-venda-id_caixa").attr("href", link_id_caixa).attr("target", "_blank")

//     $("#venda-created_at").text(moment(response.data.created_at).format('DD/MM/YYYY kk:mm'));
    
//     if(response.data._id_vendedor != null)
//     {
//       $("#tem-vendedor").removeClass('d-none')
//       $("#venda-vendedor").text(response.data.atd_pessoas_clientes_vendas.apelido);
//     }
//     else
//     {
//       $("#tem-vendedor").addClass('d-none')
//     }

//     $("#venda-id_cliente").text(response.data.id_cliente);
//     var link_id_cliente = "{{ route('pessoa.show', ':idd') }}";
//     var link_id_cliente = link_id_cliente.replace(':idd', response.data.id_cliente);
//     $("#link-venda-id_cliente").attr("href", link_id_cliente)

//     $("#venda-apelido_cliente").text(response.data.atd_pessoas_clientes_vendas.apelido);
    
//     if(response.data.atd_pessoas_clientes_vendas.cpf != null)
//     {
//       $("#tem-cpf").removeClass('d-none')
//       $("#venda-cliente_cpf").text(response.data.atd_pessoas_clientes_vendas.doc_cpf);
//     }
//     else
//     {
//       $("#tem-cpf").addClass('d-none')
//     }

//     $("#venda-detalhes").empty();                                       // ========================================================================================================= Itens Vendidos
//     $("#venda-detalhes-foot").empty();
//     if((response.data.dfyejmfcrkolqjh).length > 0)
//     {
//       (response.data.dfyejmfcrkolqjh).forEach((obj, i) => {
//         $("#venda-detalhes").append(
//           '<tr>'+
//             '<td class="text-left">'+obj.id_servprod+'</td>'+
//             '<td class="text-left">'+obj.kcvkongmlqeklsl.nome+'</td>'+
//             '<td class="text-left">'+obj.hgihnjekboyabez.xeypqgkmimzvknq.apelido+'</td>'+
//             '<td class="text-right">'+Number(obj.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</td>'+
//           '</tr>');
//       });

//       $("#venda-detalhes-foot").append(
//         '<tr>'+
//           '<td class="text-left"><strong>Itens: '+(response.data.dfyejmfcrkolqjh).length+'</strong></td>'+
//           '<td class="text-left"></td>'+
//           '<td class="text-left"></td>'+
//           '<td class="text-right"><strong>'+Number(parseFloat(response.data.dfyejmfcrkolqjh.reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.vlr_final), 0))).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</strong></td>'+
//         '</tr>');
//     }
//     else
//     {
//       $("#venda-detalhes").append(
//         '<tr>'+
//         '<td class="text-center" colspan="5">Não foram registrados produtos nesta venda</td>'+
//         '</tr>');
//     }

//     $("#venda-pagamentos").empty();                                 // ========================================================================================================= Dados do Pagamento
//     $("#venda-pagamentos-foot").empty();
//     if((response.data.xzxfrjmgwpgsnta).length > 0)
//     {
//       (response.data.xzxfrjmgwpgsnta).forEach((obj, i) => {

//         (obj.p_d_v_formas_pagamentos_vendas_pagamentos.forma  != obj.p_d_v_formas_pagamentos_vendas_pagamentos.bandeira) ? bandeira = ' - '+obj.p_d_v_formas_pagamentos_vendas_pagamentos.bandeira    : bandeira = '';
//         (obj.p_d_v_formas_pagamentos_vendas_pagamentos.parcela > 1)                                                      ? parcela  = ' ('+obj.p_d_v_formas_pagamentos_vendas_pagamentos.parcela+'x)' : parcela  = '';

//         $("#venda-pagamentos").append(
//           '<tr>'+
//           '<td class="text-left"><strong>Forma: </strong>'+
//           '<span>'+obj.p_d_v_formas_pagamentos_vendas_pagamentos.forma+'</span>'+
//           '<span>'+bandeira+parcela+'</span>'+
//           '</td>'+
//           '<td class="text-center"><strong>Parcela: </strong><span>'+obj.parcela+'</span></td>'+
//           '<td class="text-center"><strong>Data prevista: </strong><span>'+moment(obj.dt_prevista).format('DD/MM/YYYY')+'</span></td>'+
//           '<td class="text-right"><strong>vlr_final: </strong><span>'+Number(obj.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</span></td>'+
//           '</tr>');
//       })
      
//       $("#venda-pagamentos-foot").append(
//         '<tr>'+
//           '<td></td>'+
//           '<td></td>'+
//           '<td></td>'+
//           '<td class="text-right"><strong>Total: '+Number(parseFloat(response.data.xzxfrjmgwpgsnta.reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.vlr_final), 0))).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</strong></td>'+
//         '</tr>');
//     }
//     else
//     {
//       $("#venda-pagamentos").append(
//         '<tr>'+
//         '<td class="text-center" colspan="5">Não foi registrado pagamento nesta venda</td>'+
//         '</tr>');
//     }
{{-- @include('includes.catch', [ 'codigo_erro' => '7132481a' ] ) --}}
//   .then( function()
//   {
//     $('#overlay-modal-lancamento-mostrar').hide();
//   })

function lancamentos_limpar()
{
  $("#confirmar_id").val('')
  $("#confirmar_id_cliente").val('')
  $("#confirmar_tipo").val('')
  $("#confirmar_nome").val('')
  $("#confirmar_tipo_cobranca").val('')
  $("#confirmar_parcela").val('')
  $("#confirmar_dt_vencimento").val('')
  $("#confirmar_vlr_original").val('')

  $("#confirmar_id_banco").val('')
  $("#confirmar_forma_pagamento").val('')
  $("#confirmar_vlr_final").val('')

  $("#confirmar_dt_vencimento").val('')
  $("#confirmar_descricao").val('')
  $('#modal_lancamentos_confirmar').modal('hide');
}

function teste()
{
  if( $("#confirmar_id_banco").val() == '' || $("#confirmar_forma_pagamento").val() == '' )
  {
    $("#lancamentos_confirmar").addClass('disabled');
  }
  else
  {
    $("#lancamentos_confirmar").removeClass('disabled');
  }
}

$( "#confirmar_taxa_boleto" ).change(function()
{
  if( $("#confirmar_taxa_boleto").is(':checked') )
  {
    // Taxa de Cobrança
    // Taxa
    $("#campo_tx_boleto").append('<input type="number" class="form-control form-control-sm text-right p-0" id="confirmar_vlr_taxa_boleto" name="extras[vlr_taxa_boleto]" step="0.01" value="1.99">')    
  }
  else
  {
    $("#campo_tx_boleto").empty() 
  }
});

$( "#confirmar_taxa_nf" ).change(function()
{
  if( $("#confirmar_taxa_nf").is(':checked') )
  {
    // Taxa de emissão de Nota Fiscal de Serviço
    // Taxa
    $("#campo_tx_nf").append('<input type="number" class="form-control form-control-sm text-right p-0" id="confirmar_vlr_taxa_nf" name="extras[vlr_taxa_nf]" step="0.01" value="0.99">')    
  }
  else
  {
    $("#campo_tx_nf").empty() 
  }
});

$( "#confirmar_taxa_mensagem" ).change(function()
{
  if( $("#confirmar_taxa_mensagem").is(':checked') )
  {
    // Taxa de mensageria
    // Taxa
    $("#campo_tx_mensagem").append('<input type="number" class="form-control form-control-sm text-right p-0" id="confirmar_vlr_taxa_mensagem" name="extras[vlr_taxa_mensagem]" step="0.01" value="0.89">')    
  }
  else
  {
    $("#campo_tx_mensagem").empty() 
  }
});


function lancamentos_confirmar(id)
{
  var dados = $("#form_lancamentos_confirmar").serialize();

  var url = "{{ route('fin.lancamentos.confirmar', ':id') }}"
  var url = url.replace(':id', $("#confirmar_id").val())

  axios.post(url, dados)
  .then( function(response)
  {
    // alert('oK, lancado')
    console.log(response)
  //   pss_pessoas = collect(response.data)
  //   $("#id_cliente").empty().append('<option value="">Selecione . . . </option>')
  //   pss_pessoas.sortBy('nomes').each((data) =>
  //   {
  //     $("#id_cliente").append('<option value="'+data.id+'">'+data.nomes+'</option>')
  //   })
  })
@include('includes.catch', [ 'codigo_erro' => '4272628a' ] )
  .then( function()
  {
    $('#modal_lancamentos_confirmar').modal('hide');
  })
}
</script>
@endpush

{{-- 
@push('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  $(window).on('shown.bs.modal', function()
  { 
    $('#id_cliente').select2({
      dropdownParent: $('#modal_lancamentos_confirmar'),
    });
  });

  pessoas_carregar()
  pss_todos = []
});

function pessoas_carregar()
{
 
}
</script>
@endpush --}}