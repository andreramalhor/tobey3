<div class="card">
	<div class="overlay" id="overlay_cliques">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<div class="card-header ui-sortable-handle" style="cursor: move;">
		<h3 class="card-title">Cliques</h3>
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
				{{-- <canvas id="chart_cliques"></canvas> --}}
				<canvas id="chart_cliques" height="111" width="222" style="display: block; width: 222px; height: 111px;" class="chartjs-render-monitor"></canvas>
			</div>
		</div>
	</div>
</div>


@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatasCliques('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	var cardsCtx_cliques   = $('#chart_cliques');
	var cardsChart_cliques = new Chart (cardsCtx_cliques);

	function ajustarDatasCliques(dt_inicio, dt_final)
	{
		id_cliente = $('#id_cliente')[0].value;
		$("#overlay_cliques").show();

		var url = "{{ route('dashboard.chart_cliques', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
		// console.log(response.data)
		createCardsChart_cliques(response.data);
	})
	}

	function createCardsChart_cliques(informacoes)
	{
		labels = [ collect(informacoes).plucar('data') ]
		informacoes = [ collect(informacoes).plucar('cliques') ]

		cardsChart_cliques.destroy();
		cardsChart_cliques = new Chart (cardsCtx_cliques,
		{
			type: 'line',
			data:
			{
				labels: labels[0].items,
				datasets:
				[
				{
					label: 'Cliques',
					data: informacoes[0].items,
					borderColor: '#17a2b8',
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

	  $("#overlay_cliques").hide();
	}
</script>
@endpush