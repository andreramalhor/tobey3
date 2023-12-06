<div class="modal fade" id="modal_lancamento_saida" aria-hidden="true" style="display: none; color: black;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        {{-- <div class="overlay-modal-lancamento-mostrar"> --}}
          {{-- <i class="fas fa-2x fa-sync fa-spin"></i> --}}
        {{-- </div> --}}
      <div class="modal-header bg-red" style="padding: 8px 16px">
        <h5 class="modal-title">Saída</h5>
      </div>
      <div class="modal-body">
        <form id="form_lancamentos_saida" onchange="teste()">
        @csrf
          <div class="row">
            <div class="col-7">
              <div class="form-group">
                <label>Cliente</label>
                <input type="text" class="form-control form-control-sm" id="saida_cliente" name="saida[cliente]">
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label>Categoria</label>
                <input type="text" class="form-control form-control-sm" id="saida_categoria" name="saida[categoria]">
              </div>
            </div>
            <div class="col-7">
              <div class="form-group">
                <label>Descrição</label>
                <input type="text" class="form-control form-control-sm" id="saida_descricao" name="saida[descricao]">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Banco</label>
                <select class="form-control form-control-sm" id="saida_id_banco" name="saida[id_banco]">
                  <option value="">Carregando. . . </option>
                  <option value="1">C6 Bank</option>
                  <option value="2">ASAAS</option>
                  <option value="3">Caixa</option>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Forma de Pagamento</label>
                <input type="text" class="form-control form-control-sm" id="saida_forma_pagamento" name="saida[forma_pagamento]">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Valor</label>
                <input type="number" class="form-control form-control-sm text-right" id="saida_vlr_final" name="saida[vlr_final]" step="0.01">
              </div>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <button type="button" class="btn btn-default btn-sm" onclick="lancamentos_limpar()" data-bs-dismiss="modal">cancelar</button>
          <button type="button" class="btn btn-primary btn-sm" onclick="lancamentos_saida()" id="lancamentos_saida" data-bs-dismiss="modal">saida</button>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
<script>
//
function modal_lancamento_saida(id)
{
  $('#modal_lancamentos_saida').modal('show');

  var url = "{{ route('fin.lancamentos.mostrar_modal', ':idd') }}";
  var url = url.replace(':idd', id);

  axios.get(url)
  .then( function(response)
  {
    // console.log(response)
    $("#saida_id").val(response.data.id)
    $("#saida_id_cliente").val(response.data.id_cliente)
    $("#saida_tipo").val(response.data.tipo)
    $("#saida_nome").val(response.data.nome)
    $("#saida_tipo_cobranca").val(response.data.tipo_cobranca)
    $("#saida_parcela").val(response.data.parcela)
    $("#saida_dt_vencimento").val(response.data.dt_vencimento)
    $("#saida_vlr_original").val(parseFloat(response.data.vlr_original).toFixed(2))
    
    $("#saida_id_banco").val(response.data.id_banco)
    $("#saida_forma_pagamento").val(response.data.forma_pagamento)
    $("#saida_vlr_final").val(parseFloat(response.data.vlr_final).toFixed(2))

    $("#saida_dt_vencimento").val(response.data.dt_vencimento)
    $("#saida_descricao").val(response.data.descricao)
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
{{-- @include('includes.catch', [ 'codigo_erro' => '335603a' ] ) --}}
//   .then( function()
//   {
//     $('#overlay-modal-lancamento-mostrar').hide();
//   })

function lancamentos_limpar()
{
  $("#saida_id").val('')
  $("#saida_id_cliente").val('')
  $("#saida_tipo").val('')
  $("#saida_nome").val('')
  $("#saida_tipo_cobranca").val('')
  $("#saida_parcela").val('')
  $("#saida_dt_vencimento").val('')
  $("#saida_vlr_original").val('')

  $("#saida_id_banco").val('')
  $("#saida_forma_pagamento").val('')
  $("#saida_vlr_final").val('')

  $("#saida_dt_vencimento").val('')
  $("#saida_descricao").val('')
  $('#modal_lancamentos_saida').modal('hide');
}

function teste()
{
  if( $("#saida_id_banco").val() == '' || $("#saida_forma_pagamento").val() == '' )
  {
    $("#lancamentos_saida").addClass('disabled');
  }
  else
  {
    $("#lancamentos_saida").removeClass('disabled');
  }
}

$( "#saida_taxa_boleto" ).change(function()
{
  if( $("#saida_taxa_boleto").is(':checked') )
  {
    // Taxa de Cobrança
    // Taxa
    $("#campo_tx_boleto").append('<input type="number" class="form-control form-control-sm text-right p-0" id="saida_vlr_taxa_boleto" name="extras[vlr_taxa_boleto]" step="0.01" value="1.99">')    
  }
  else
  {
    $("#campo_tx_boleto").empty() 
  }
});

$( "#saida_taxa_nf" ).change(function()
{
  if( $("#saida_taxa_nf").is(':checked') )
  {
    // Taxa de emissão de Nota Fiscal de Serviço
    // Taxa
    $("#campo_tx_nf").append('<input type="number" class="form-control form-control-sm text-right p-0" id="saida_vlr_taxa_nf" name="extras[vlr_taxa_nf]" step="0.01" value="0.99">')    
  }
  else
  {
    $("#campo_tx_nf").empty() 
  }
});

$( "#saida_taxa_mensagem" ).change(function()
{
  if( $("#saida_taxa_mensagem").is(':checked') )
  {
    // Taxa de mensageria
    // Taxa
    $("#campo_tx_mensagem").append('<input type="number" class="form-control form-control-sm text-right p-0" id="saida_vlr_taxa_mensagem" name="extras[vlr_taxa_mensagem]" step="0.01" value="0.89">')    
  }
  else
  {
    $("#campo_tx_mensagem").empty() 
  }
});


function lancamentos_saida(id)
{
  var dados = $("#form_lancamentos_saida").serialize();

  var url = "{{ route('fin.lancamentos.saida') }}"

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
@include('includes.catch', [ 'codigo_erro' => '1805003a' ] )
  .then( function()
  {
    $('#modal_lancamentos_saida').modal('hide');
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
      dropdownParent: $('#modal_lancamentos_saida'),
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