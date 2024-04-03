<div class="row">
	<div class="col-12">
    <div class="card">      
      <div class="overlay" id="pessoa_comandas_overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
			<div class="card-body table-responsive rounded p-0">
  			<table class="table table-sm table-striped no-padding table-valign-middle projects">
    			<thead class="table-dark">				
						<tr>
							<th class="text-left" width="15%">Comanda</th>
							<th class="text-left" width="15%">Data</th>
							<th class="text-left" width="">Cliente</th>
							<th class="text-rigth" width="15%">Valor</th>
						</tr>
					</thead>
					<tbody id="pessoa_comandas">
					</tbody>
					<tfoot id="pessoa_comandas_foot">
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
document.querySelector('.nav-link[href="#vendas"]').addEventListener('click', function()
{
	var page = $(this)[0].dataset.page
	pessoas_vendas_listar(page)
})

function pessoas_vendas_listar(page=1)
{
  if( page == 1 )
  {
    $("#pessoa_comandas").empty()
    $("#pessoa_comandas_foot").empty()
  }

  $('#pessoa_comandas_overlay').show()
  $('#pessoa_comandas_carregar_mais').remove()
  $('#pessoa_comandas').append('<tr id="pessoa_comandas_carregando"><td class="text-center" colspan="4"> Carregando ...</td></tr>')

  var url = "{{ route('atd.pessoas.vendas', ':idd') }}"
  var url = url.replace(':idd',  {{ $pessoa->id }} )
  var params = url+'?page='+page

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    collect(response.data.data).each((venda) =>
    {
      produtos = '';
      collect(venda.dfyejmfcrkolqjh).each((detalhe) =>
      {
        produtos = produtos + detalhe.kcvkongmlqeklsl.nome + '</br>';
      })
      $("#pessoa_comandas").append(
        '<tr class="'+(venda.deleted_at != null ? 'bg-danger' : '' )+'">'+
          '<td width="5%" style="padding: 0px 1px" class="text-center"><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal('+venda.id+')"><span class="badge bg-primary">'+venda.id+'</span></a></td>'+
          '<td class="text-left">'+moment(venda.created_at).format('DD/MM/YYYY')+'</td>'+
          '<td class="text-left">'+produtos+'</td>'+
          '<td class="text-right">'+accounting.formatMoney( venda.vlr_final / 1 )+'</td>'+
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      $("#pessoa_comandas_foot").append(
        '<tr id="pessoa_comandas_carregar_mais" style="cursor: pointer;" onclick="pessoas_vendas_listar('+( response.data.current_page + 1 )+')">'+
          '<td class="text-left" colspan="2">Total de Itens: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td>'+
          '<td class="text-center" colspan="2">Mostrar mais vendas...</td>'+
        '</tr>'
      )
    }
    else
    {
      $("#pessoa_comandas_foot").append('<tr><td class="text-left" colspan="4">Total de Itens: '+(response.data.total)+' / '+response.data.total+'</td></tr>')
    }
  })
  @include('includes.catch', [ 'codigo_erro' => '8272907a' ] )
  .then(function(response)
  {
    $('#pessoa_comandas_carregando').remove()
    $('#pessoa_comandas_overlay').hide()
  })
}
</script>