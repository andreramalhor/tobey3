<div class="card">
	<div class="overlay" id="overlay_mensagens_recebidas">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<div class="card-header ui-sortable-handle" style="cursor: move;">
		<h3 class="card-title">Mensagens Recebidas</h3>
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
				{{-- <canvas id="chart_mensagens_recebidas"></canvas> --}}
				<canvas id="chart_mensagens_recebidas" height="111" width="222" style="display: block; width: 222px; height: 111px;" class="chartjs-render-monitor"></canvas>
			</div>
		</div>
	</div>
</div>


@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatasMensagensRecebidas('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	var cardsCtx_mensagens_recebidas   = $('#chart_mensagens_recebidas');
	var cardsChart_mensagens_recebidas = new Chart (cardsCtx_mensagens_recebidas);

	function ajustarDatasMensagensRecebidas(dt_inicio, dt_final)
	{
		id_cliente = $('#id_cliente')[0].value;
		$("#overlay_mensagens_recebidas").show();

		var url = "{{ route('dashboard.chart_mensagensRec', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
		// console.log(response.data)
		createCardsChart_mensagens_recebidas(response.data);
	})
	}

	function createCardsChart_mensagens_recebidas(informacoes)
	{
		labels = [ collect(informacoes).plucar('data') ]
		informacoes = [ collect(informacoes).plucar('mensagens_recebidas') ]

		cardsChart_mensagens_recebidas.destroy();
		cardsChart_mensagens_recebidas = new Chart (cardsCtx_mensagens_recebidas,
		{
			type: 'line',
			data:
			{
				labels: labels[0].items,
				datasets:
				[
					{
						label: 'Mensagens Recebidas',
						data: informacoes[0].items,
						borderColor: '#28a745',
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

	  $("#overlay_mensagens_recebidas").hide();
	}
</script>
@endpush