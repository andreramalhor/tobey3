<div class="card">
	<div class="overlay" id="overlay_valorgasto">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<div class="card-header ui-sortable-handle" style="cursor: move;">
		<h3 class="card-title">Valor Gasto</h3>
	</div>
	<div class="card-body">
		<div class="position-relative mb-12">
			<div class="chart-responsive">
				<div class="chartjs-size-monitor">
					<div class="chartjs-size-monitor-expand">
						<div class=""></div>
					</div>
					<div class="chartjs-size-monitor-shrink">
						<div class=""></div>
					</div>
				</div>
				{{-- <canvas id="chart_valorgasto"></canvas> --}}
				<canvas id="chart_valorgasto" height="111" width="222" style="display: block; width: 222px; height: 111px;" class="chartjs-render-monitor"></canvas>
			</div>
		</div>
	</div>
</div>


@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatasValorGasto('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	var cardsCtx_valorgasto   = $('#chart_valorgasto');
	var cardsChart_valorgasto = new Chart (cardsCtx_valorgasto);

	function ajustarDatasValorGasto(dt_inicio, dt_final)
	{
		id_cliente = $('#id_cliente')[0].value;
		$("#overlay_valorgasto").show();

		var url = "{{ route('dashboard.chart_valorGasto', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
		// console.log(response.data)
		createCardsChart_valorgasto(response.data);
	})
	}

	function createCardsChart_valorgasto(informacoes)
	{
		labels = [ collect(informacoes).plucar('data') ]
		informacoes = [ collect(informacoes).plucar('vlr_gasto') ]

		cardsChart_valorgasto.destroy();
		cardsChart_valorgasto = new Chart (cardsCtx_valorgasto,
		{
			type: 'bar',
			data:
			{
				labels: labels[0].items,
				datasets:
				[
				{
					label: 'Valor Gasto',
					data: informacoes[0].items,
          backgroundColor: '#dc3545',
					borderColor: '#dc3545',
					fill: false,
					cubicInterpolationMode: 'monotone',
					tension: 0.5
				},
				]
			},
			options:
			{
				responsive: true,
				legend:
				{
					display: false,
				},
				plugins:
				{
					title:
					{
						display: true,
						text: 'Chart.js Line Chart - Cubic interpolation mode'
					},
				},
				interaction:
				{
					intersect: false,
				},
				scales:
				{
					x:
					{
						display: true,
						title:
						{
							display: true
						}
					},
					y:
					{
						display: true,
						title:
						{
							display: true,
							text: 'Value'
						},
						suggestedMin: -10,
						suggestedMax: 200
					}
				}
			},	  
		});

	  $("#overlay_valorgasto").hide();
	}
</script>
@endpush