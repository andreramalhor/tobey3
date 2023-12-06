    <div class="card">
			<div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Dados Complementares do Mês</h3>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
          <p class="text-success text-xl">
            <i class="fa-solid fa-person text-success"></i>
          </p>
          <p class="d-flex flex-column text-right">
           <span class="font-weight-bold" id="mes_dados_complem_CL">-</span>
          <span class="text-muted">Custo por LEAD engajado</span>
        </p>
      </div>
      <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
        <p class="text-warning text-xl">
          <i class="fa-brands fa-gripfire"></i>
        </p>
        <p class="d-flex flex-column text-right">
          <span class="font-weight-bold" id="mes_dados_complem_LQ">-</span>
          <span class="text-muted">LEADs Quentes</span>
        </p>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-0">
        <p class="text-danger text-xl">
          <i class="fa-solid fa-people-group"></i>
        </p>
        <p class="d-flex flex-column text-right">
          <span class="font-weight-bold" id="mes_dados_complem_CPM">-</span>
          <span class="text-muted">CPM</span>
        </p>
      </div>
    </div>
  </div>


@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatasmes_dados_complem('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	function ajustarDatasmes_dados_complem(dt_inicio, dt_final)
	{
		id_cliente = $('#id_cliente')[0].value;
		$("#overlay_est_dia_dia").show();

		var url = "{{ route('dashboard.chart_mes_dados_complem', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
			console.log(response.data)
			// createCardsChart_mes_dados_complem(response.data);

// mes_dados_complem_CL
// mes_dados_complem_LQ
// mes_dados_complem_CPM
		})
	}
	

	  $("#overlay_est_dia_dia").hide();

</script>
@endpush