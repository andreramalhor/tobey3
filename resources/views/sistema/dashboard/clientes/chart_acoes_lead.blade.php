<div class="card">
	<div class="overlay" id="overlay_acoes_lead">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<div class="card-header ui-sortable-handle" style="cursor: move;">
		<h3 class="card-title">Ações do Lead Facebook e Instagram</h3>
	</div>
	<div class="card-body">
		<br>
		<div class="chart-responsive">
			<div class="chartjs-size-monitor">
				<div class="chartjs-size-monitor-expand">
					<div class=""></div>
				</div>
				<div class="chartjs-size-monitor-shrink">
					<div class=""></div>
				</div>
			</div>
			{{-- <canvas id="chart_acoes_lead"></canvas> --}}
			<canvas id="chart_acoes_lead" class="chartjs-render-monitor"></canvas>
		</div>
		<br>
		<div class="d-flex justify-content-center">
			<span class="mr-2">
				<i class="fas fa-square text-warning"></i> Interações
			<span>
			<span class="mr-2">
				<i class="fas fa-square text-info"></i> Cliques
			<span>
			<span class="mr-2">
				<i class="fas fa-square text-success"></i> Mensagens
			<span>
			<span class="mr-2">
				<i class="fas fa-square text-purple"></i> Comentários
			<span>
		</div>
	</div>
	<div class="card-footer p-0">
		<ul class="nav nav-pills flex-column">
			<li class="nav-item">
				<a href="#" class="nav-link">
					United States of America
					<span class="float-right text-danger">
						<i class="fas fa-arrow-down text-sm"></i>
					12%</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">
					India
					<span class="float-right text-success">
						<i class="fas fa-arrow-up text-sm"></i> 4%
					</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">
					China
					<span class="float-right text-warning">
						<i class="fas fa-arrow-left text-sm"></i> 0%
					</span>
				</a>
			</li>
		</ul>
	</div>
</div>

@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatas_acoes_lead('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	var chart_acoes_lead   = $('#chart_acoes_lead');
	var cardsChart_chart_lead = new Chart (chart_acoes_lead);

	function ajustarDatas_acoes_lead(dt_inicio, dt_final)
	{
		labels_acoes_lead = ["Interações", "Cliques", "Mensagens", "Comentários"],
		
		$("#overlay_acoes_lead").show();
		id_cliente = $('#id_cliente')[0].value;

		var url = "{{ route('dashboard.chart_acoes_lead', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
			// console.log(response.data);
			createCardsChart_chart_lead(labels_acoes_lead, response.data);
		})
	}

	function createCardsChart_chart_lead(labels_acoes_lead, informacoes_acoes_lead)
	{
		informacoes_acoes_lead = [ collect(informacoes_acoes_lead).flatten() ]

		cardsChart_chart_lead.destroy();
		cardsChart_chart_lead = new Chart (chart_acoes_lead,
		{
			type: 'pie',
			data:
			{
				labels: labels_acoes_lead,
				datasets:
				[{
					backgroundColor: ["#ffc107", "#17a2b8", "#28a745", "#605ca8" ],
					data: informacoes_acoes_lead[0].items,
				}]
			},
			options:
			{
				legend:
				{
					display: false,
					position: 'left',
				},
			},
	});

		$("#overlay_acoes_lead").hide();
	}
</script>
@endpush