<div class="card">
	<div class="overlay" id="overlay_est_dia_dia">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<div class="card-header ui-sortable-handle" style="cursor: move;">
		<h3 class="card-title">Estatísticas Gerais do dia-a-dia</h3>
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
				<canvas id="chart_est_dia_dia" class="chartjs-render-monitor"></canvas>
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
	</div>
</div>


@push('js')
<script type="text/javascript">
	$(document).ready(function()
	{
		// atualizarTudo()
		ajustarDatasEstDiaaDia('{{ \Carbon\Carbon::today()->startOfMonth('Y-m-d') }}', '{{ \Carbon\Carbon::today()->format('Y-m-d') }}');
	});

	var cardsCtx_est_dia_dia   = $('#chart_est_dia_dia');
	var cardsChart_est_dia_dia = new Chart (cardsCtx_est_dia_dia);

	function ajustarDatasEstDiaaDia(dt_inicio, dt_final)
	{
		$("#overlay_est_dia_dia").show();
		id_cliente = $('#id_cliente')[0].value;

		var url = "{{ route('dashboard.chart_estDiaaDia', ':d') }}";
		var url = url.replace(':d', "dt_inicio="+dt_inicio+"&dt_final="+dt_final+"&id_cliente="+id_cliente);

		axios.post(url)
		.then( function(response)
		{
			// console.log(response.data)
			createCardsChart_EstDiaaDia(response.data);
		})
	}
	
	function calculos(informacoes, tipo)
	{
		novo_interacoes          = []; 
		novo_cliques             = [];
		novo_mensagens_recebidas = []; 
		novo_comentarios         = []; 
		novo_vlr_gasto           = [];

		collect(informacoes).each((value, key) => {
		  let soma = value.interacoes + value.cliques + value.mensagens_recebidas + value.comentarios;

		  let calc_interacoes          = value.interacoes / soma * value.vlr_gasto;
		  novo_interacoes.push(calc_interacoes)
		  
		  let calc_cliques             = value.cliques / soma * value.vlr_gasto;
		  novo_cliques.push(calc_cliques)
		  
		  let calc_mensagens_recebidas = value.mensagens_recebidas / soma * value.vlr_gasto;
		  novo_mensagens_recebidas.push(calc_mensagens_recebidas)
		  
		  let calc_comentarios         = value.comentarios / soma * value.vlr_gasto;
		  novo_comentarios.push(calc_comentarios)
		  		});
		
		switch (tipo)
		{
		  case 'interacoes':
		  	return novo_interacoes;
		  case 'cliques':
		  	return novo_cliques;
		  case 'mensagens_recebidas':
		  	return novo_mensagens_recebidas;
		  case 'comentarios':
		  	return novo_comentarios;
		  default:
		  	console.log(`Sorry, we are out of ${tipo}.`);
		}
	}

	function createCardsChart_EstDiaaDia(informacoes)
	{
		labels              = [ collect(informacoes).plucar('data') ]
		interacoes          = [ collect(informacoes).plucar('interacoes') ]
		cliques             = [ collect(informacoes).plucar('cliques') ]
		mensagens_recebidas = [ collect(informacoes).plucar('mensagens_recebidas') ]
		comentarios         = [ collect(informacoes).plucar('comentarios') ]
		vlr_gasto           = [ collect(informacoes).plucar('vlr_gasto') ]

		cardsChart_est_dia_dia.destroy();
		cardsChart_est_dia_dia = new Chart (cardsCtx_est_dia_dia,
		{
			type: 'bar',
			data:
			{
				labels: labels[0].items,
				datasets:
				[
					{
						label: 'Engajamento',
						data: calculos(informacoes, 'interacoes'),
						backgroundColor: '#ffc107',
						borderColor: '#ffc107',
						stack: 'Stack 0',
					},
					{
						label: 'Cliques',
						data: calculos(informacoes, 'cliques'),
						backgroundColor: '#17a2b8',
						borderColor: '#17a2b8',
						stack: 'Stack 0',
					},
					{
						label: 'Mensagens Recebidas',
						data: calculos(informacoes, 'mensagens_recebidas'),
						backgroundColor: '#28a745',
						borderColor: '#28a745',
						stack: 'Stack 0',
					},
					{
						label: 'Comentários',
						data: calculos(informacoes, 'comentarios'),
						backgroundColor: '#605ca8',
						borderColor: '#605ca8',
						stack: 'Stack 0',
					},
					{
						type: 'line',
						label: 'Valor Gasto',
						data: vlr_gasto[0].items,
 						borderColor: '#dc3545',
						backgroundColor: '#dc3545',
						fill: false,
						cubicInterpolationMode: 'monotone',
						tension: 0.5
					},
				]
			},
			options:
			{
				tooltips:
				{
          callbacks:
          {
          	label: function(item, tudo)
          	{          		
          		switch (item.datasetIndex)
          		{
							  case 0:
          				return parseFloat((item.yLabel / tudo.datasets[4].data[item.index] * 100)).toFixed(1)+"%";
							  case 1:
          				return parseFloat((item.yLabel / tudo.datasets[4].data[item.index] * 100)).toFixed(1)+"%";
							  case 2:
          				return parseFloat((item.yLabel / tudo.datasets[4].data[item.index] * 100)).toFixed(1)+"%";
							  case 3:
          				return parseFloat((item.yLabel / tudo.datasets[4].data[item.index] * 100)).toFixed(1)+"%";
							  case 4:
          				return item.yLabel.toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });
							  default:
							    console.log(`Sorry, we are out of ${item.datasetIndex}.`);
							}
          	},
          }
        },
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

	  $("#overlay_est_dia_dia").hide();
	}
</script>
@endpush