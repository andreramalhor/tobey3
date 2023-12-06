<div class="card">
	<div class="overlay" id="overlay_engajamento">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<div class="card-header ui-sortable-handle" style="cursor: move;">
		<h3 class="card-title">Engajamento</h3>
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
				{{-- <canvas id="chart_engajamento"></canvas> --}}
				<canvas id="chart_engajamento" height="111" width="222" style="display: block; width: 222px; height: 111px;" class="chartjs-render-monitor"></canvas>
			</div>
		</div>
	</div>
</div>


@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatasEngajamento('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	var cardsCtx_engajamento   = $('#chart_engajamento');
	var cardsChart_engajamento = new Chart (cardsCtx_engajamento);

	function ajustarDatasEngajamento(dt_inicio, dt_final)
	{
		id_cliente = $('#id_cliente')[0].value;
		$("#overlay_engajamento").show();

		var url = "{{ route('dashboard.chart_engajamento', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
		// console.log(response.data)
		createCardsChart_engajamento(response.data);
	})
	}

	function createCardsChart_engajamento(informacoes)
	{
		labels = [ collect(informacoes).plucar('data') ]
		informacoes = [ collect(informacoes).plucar('interacoes') ]

		cardsChart_engajamento.destroy();
		cardsChart_engajamento = new Chart (cardsCtx_engajamento,
		{
			type: 'line',
			data:
			{
				labels: labels[0].items,
				datasets:
				[
				{
					label: 'Interações',
					data: informacoes[0].items,
					borderColor: '#ffc107',
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

	  $("#overlay_engajamento").hide();
	}
</script>
@endpush