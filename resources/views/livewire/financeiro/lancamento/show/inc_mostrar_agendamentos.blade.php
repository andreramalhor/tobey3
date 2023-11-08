<div class="row">
	<div class="col-12">
    <div class="card">      
      <div class="overlay" id="pessoa_agendamentos_overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
			<div class="card-body table-responsive rounded p-0">
  			<table class="table table-sm table-striped no-padding table-valign-middle projects">
    			<thead class="table-dark">				
						<tr>
							<th class="text-left" width="">#</th>
							<th class="text-left" width="">Data</th>
							<th class="text-left" width="">Início</th>
							<th class="text-left" width="">Fim</th>
							<th class="text-left" width="">Profissional</th>
							<th class="text-left" width="">Serv. / Prod.</th>
							<th class="text-left" width=""># Comanda</th>
							<th class="text-left" width="">Status</th>
							<th class="text-rigth" width="">Valor</th>
							<th class="text-left" width="">Agendado em:</th>
						</tr>
					</thead>
					<tbody id="pessoa_agendamentos">
					</tbody>
					<tfoot id="pessoa_agendamentos_foot">
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
document.querySelector('.nav-link[href="#agendamentos"]').addEventListener('click', function()
{
	var page = $(this)[0].dataset.page
	pessoas_agendamentos_listar(page)
})

function pessoas_agendamentos_listar(page=1)
{
  if( page == 1 )
  {
    $("#pessoa_agendamentos").empty()
    $("#pessoa_agendamentos_foot").empty()
  }

  $('#pessoa_agendamentos_overlay').show()
  $('#pessoa_agendamentos_carregar_mais').remove()
  $('#pessoa_agendamentos').append('<tr id="pessoa_agendamentos_carregando"><td class="text-center" colspan="10"> Carregando ...</td></tr>')

  var url = "{{ route('atd.pessoas.agendamentos', ':idd') }}"
  var url = url.replace(':idd',  {{ $pessoa->id }} )
  var params = url+'?page='+page

  axios.get(params)
  .then(function(response)
  {
    console.log(response)
    collect(response.data.data).each((agendamento) =>
    {
      $("#pessoa_agendamentos").append(
        '<tr class="'+(agendamento.deleted_at != null ? 'bg-danger' : '' )+'">'+
          // '<td width="5%" style="padding: 0px 1px" class="text-center"><a href="" data-bs-toggle="modal" onclick="agendamentos_mostrar_modal('+agendamento.id+')"><span class="badge bg-primary">'+agendamento.id+'</span></a></td>'+
          '<td class="text-left" width="">'+agendamento.id+'</td>'+
          '<td class="text-left" width="">'+moment(agendamento.start).format('DD/MM/YYYY')+'</td>'+
          '<td class="text-left" width="">'+moment(agendamento.start).format('H:mm')+'</td>'+
          '<td class="text-left" width="">'+moment(agendamento.end).format('H:mm')+'</td>'+
          '<td class="text-left" width="">'+agendamento.hhmaqpijffgfhmj.apelido+'</td>'+
          '<td class="text-left" width="">'+agendamento.zlpekczgsltqgwg.nome+'</td>'+
          '<td class="text-center" width=""><a href="" data-bs-toggle="modal" onclick="agendamentos_mostrar_modal('+(agendamento.id_comanda == null ? '' : agendamento.id_comanda)+')"><span class="badge bg-primary">'+(agendamento.id_comanda == null ? '' : agendamento.id_comanda)+'</span></a></td>'+
          '<td class="text-center" width=""><span class="badge" style="background-color: '+agendamento.color+'">'+agendamento.status+'</span></td>'+
          '<td class="text-rigth" width="">'+accounting.formatMoney( agendamento.valor )+'</td>'+
          '<td class="text-left" width=""><small>'+moment(agendamento.created_at).format('DD/MM/YYYY HH:mm')+'</small></td>'+
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      $("#pessoa_agendamentos_foot").append(
        '<tr id="pessoa_agendamentos_carregar_mais" style="cursor: pointer;" onclick="pessoas_agendamentos_listar('+( response.data.current_page + 1 )+')">'+
          '<td class="text-left" colspan="4">Total de Itens: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td>'+
          '<td class="text-center" colspan="6">Mostrar mais agendamentos...</td>'+
        '</tr>'
      )
    }
    else
    {
      $("#pessoa_agendamentos_foot").append('<tr><td class="text-left" colspan="10">Total de Itens: '+(response.data.total)+' / '+response.data.total+'</td></tr>')
    }
  })
  @include('includes.catch', [ 'codigo_erro' => '5438796a' ] )
  .then(function(response)
  {
    $('#pessoa_agendamentos_carregando').remove()
    $('#pessoa_agendamentos_overlay').hide()
  })
}
</script>