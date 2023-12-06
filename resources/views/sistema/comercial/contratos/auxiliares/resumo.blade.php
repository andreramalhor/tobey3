<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_show_venda">
  <div class="modal-dialog modal-xl">
    <div class="overlay" id="overlay_show_venda">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
    <div class="modal-content">
      <div class="modal-header with-border">
        <div class="col-12">
          <div class="row">
            <table width="100%">
              <tr>
                <td rowspan="4" class="text-center" id="col_logo" width="75"><img src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="Espaço Milady" width="75" style="margin-right: 50px;"></td>
                <td><strong id="empresa_nome">{{ $empresa->nome ?? 'Espaço Milady' }}</strong></td>
                <td width="26%" rowspan="4" class="text-center" style="vertical-align: top;"><h4 class="text-left"><strong><font>Recibo de Comanda</font></strong></h4>&emsp;</td>
                <td><strong>ID Comanda: &nbsp;</strong><span id="venda-id"></span></td>
              </tr>
              <tr>
                <td><strong>CNPJ: &nbsp;</strong>{{ $empresa->cnpj ?? '1' }}</td>
                <td><strong>ID Caixa: &nbsp;</strong><a id="link-venda-id_caixa" target="_blank" class="badge bg-pink"><span id="venda-id_caixa"></span></a></td>
              </tr>
              <tr>
                <td><strong>Telefone: &nbsp;</strong>{{ $empresa->telefone_fixo ?? '1' }}</td>
                <td><strong>Data Compra: &nbsp;</strong><span id="venda-created_at"></span></td>
              </tr>
              <tr>
                <td><strong>e-Mail: &nbsp;</strong>{{ $empresa->email ?? 'miladyespaco@gmail.com' }}</td>
                <td><strong id="tem-vendedor" class="d-none">Vendedor: &nbsp;</strong><span id="venda-vendedor"></span></td>
              </tr>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
<script>
//
function showVenda(id)
{
  $('#overlay_show_venda').show();
  $('#z').modal('show');

  var url = "{{ route('pdv.vendas.modal', ':idd') }}";
  var url = url.replace(':idd', id);

  axios.get(url)
  .then( function(response)
  {
    console.log(response)
    // $("#venda-id").text(response.data.id);                            // ========================================================================================================= Dados do Cliente

    // $("#venda-id_caixa").text(response.data.id_caixa);
    // var link_id_caixa = "{{ route('pdv.caixas.mostrar', ':idd') }}";
    // var link_id_caixa = link_id_caixa.replace(':idd', response.data.id_caixa);
    // $("#link-venda-id_caixa").attr("href", link_id_caixa).attr("target", "_blank")

    // $("#venda-created_at").text(moment(response.data.created_at).format('DD/MM/YYYY kk:mm'));
    
    // // if(response.data._id_vendedor != null)
    // // {
    // //   $("#tem-vendedor").removeClass('d-none')
    // //   $("#venda-vendedor").text(response.data.lufqzahwwexkxli.apelido);
    // // }
    // // else
    // // {
    // //   $("#tem-vendedor").addClass('d-none')
    // // }

    // $("#venda-id_cliente").text(response.data.id_cliente);
    // var link_id_cliente = "{{ route('pessoa.show', ':idd') }}";
    // var link_id_cliente = link_id_cliente.replace(':idd', response.data.id_cliente);
    // $("#link-venda-id_cliente").attr("href", link_id_cliente)

    // $("#venda-apelido_cliente").text(response.data.lufqzahwwexkxli.apelido);
    
    // if(response.data.lufqzahwwexkxli.cpf != null)
    // {
    //   $("#tem-cpf").removeClass('d-none')
    //   $("#venda-cliente_cpf").text(response.data.lufqzahwwexkxli.cpf_cnpj);
    // }
    // else
    // {
    //   $("#tem-cpf").addClass('d-none')
    // }

    // $("#venda-detalhes").empty();                                       // ========================================================================================================= Itens Vendidos
    // $("#venda-detalhes-foot").empty();
    // if((response.data.dfyejmfcrkolqjh).length > 0)
    // {
    //   (response.data.dfyejmfcrkolqjh).forEach((obj, i) => {
    //     console.log(obj)
    //     $("#venda-detalhes").append(
    //       '<tr>'+
    //         '<td class="text-left">'+obj.id_servprod+'</td>'+
    //         '<td class="text-left">'+obj.kcvkongmlqeklsl.nome+'</td>'+
    //         '<td class="text-left">'+((obj.hgihnjekboyabez == null) ? ' - ' : obj.hgihnjekboyabez.xeypqgkmimzvknq.apelido)+'</td>'+
    //         '<td class="text-right">'+Number(obj.vlr_final).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</td>'+
    //       '</tr>');
    //   });

    //   $("#venda-detalhes-foot").append(
    //     '<tr>'+
    //       '<td class="text-left"><strong>Itens: '+(response.data.dfyejmfcrkolqjh).length+'</strong></td>'+
    //       '<td class="text-left"></td>'+
    //       '<td class="text-left"></td>'+
    //       '<td class="text-right"><strong>'+Number(parseFloat(response.data.dfyejmfcrkolqjh.reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.vlr_final), 0))).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</strong></td>'+
    //     '</tr>');
    // }
    // else
    // {
    //   $("#venda-detalhes").append(
    //     '<tr>'+
    //     '<td class="text-center" colspan="5">Não foram registrados produtos nesta venda</td>'+
    //     '</tr>');
    // }

    // $("#venda-pagamentos").empty();                                 // ========================================================================================================= Dados do Pagamento
    // $("#venda-pagamentos-foot").empty();
    // if((response.data.xzxfrjmgwpgsnta).length > 0)
    // {
    //   (response.data.xzxfrjmgwpgsnta).forEach((obj, i) => {

    //     (obj.p_d_v_formas_pagamentos_vendas_pagamentos.forma  != obj.p_d_v_formas_pagamentos_vendas_pagamentos.bandeira) ? bandeira = ' - '+obj.p_d_v_formas_pagamentos_vendas_pagamentos.bandeira    : bandeira = '';
    //     (obj.p_d_v_formas_pagamentos_vendas_pagamentos.parcela > 1)                                                      ? parcela  = ' ('+obj.p_d_v_formas_pagamentos_vendas_pagamentos.parcela+'x)' : parcela  = '';

    //     $("#venda-pagamentos").append(
    //       '<tr>'+
    //       '<td class="text-left"><strong>Forma: </strong>'+
    //       '<span>'+obj.p_d_v_formas_pagamentos_vendas_pagamentos.forma+'</span>'+
    //       '<span>'+bandeira+parcela+'</span>'+
    //       '</td>'+
    //       '<td class="text-center"><strong>Parcela: </strong><span>'+obj.parcela+'</span></td>'+
    //       '<td class="text-center"><strong>Data prevista: </strong><span>'+moment(obj.dt_prevista).format('DD/MM/YYYY')+'</span></td>'+
    //       '<td class="text-right"><strong>Valor: </strong><span>'+Number(obj.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</span></td>'+
    //       '</tr>');
    //   })
      
    //   $("#venda-pagamentos-foot").append(
    //     '<tr>'+
    //       '<td></td>'+
    //       '<td></td>'+
    //       '<td></td>'+
    //       '<td class="text-right"><strong>Total: '+Number(parseFloat(response.data.xzxfrjmgwpgsnta.reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.valor), 0))).toLocaleString('pt-BR', { minimumFractionDigits: 2 })+'</strong></td>'+
    //     '</tr>');
    // }
    // else
    // {
    //   $("#venda-pagamentos").append(
    //     '<tr>'+
    //     '<td class="text-center" colspan="5">Não foi registrado pagamento nesta venda</td>'+
    //     '</tr>');
    // }
  })
@include('includes.catch', [ 'codigo_erro' => '8500694a' ] )
  .then( function()
  {
    $('#overlay_show_venda').hide();
  })
}
</script>
@endpush
