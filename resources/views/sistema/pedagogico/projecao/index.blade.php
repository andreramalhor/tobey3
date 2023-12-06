@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Quadro de Turmas</h3>
			</div>
			<div class="card-body">
				<table class="table table-bordered text-center">
					<thead class="table-dark">
						<tr>
							<th width="5%" style="vertical-align: middle !important;">Período</th>
							<th width="5%" style="vertical-align: middle !important;">Sala</th>
							<th width="15%">Segunda-Feira<br><small id="span_dia_seg"></small></th>
							<th width="15%">Terça-Feira<br><small id="span_dia_ter"></small></th>
							<th width="15%">Quarta-Feira<br><small id="span_dia_qua"></small></th>
							<th width="15%">Quinta-Feira<br><small id="span_dia_qui"></small></th>
							<th width="15%">Sexta-Feira<br><small id="span_dia_sex"></small></th>
							<th width="15%">Sábado<br><small id="span_dia_sab"></small></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="p-2" style="vertical-align: middle !important;" rowspan="3"><strong>Manhã</strong></td>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 1</strong></td>
							<td class="p-2">
								<span id="sala_1_manha_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_manha_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_manha_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_manha_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_manha_sexta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_manha_sabado"></span>
							</td>
						</tr>
						<tr>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 2</strong></td>
							<td class="p-2">
								<span id="sala_2_manha_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_manha_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_manha_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_manha_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_manha_sexta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_manha_sabado"></span>
							</td>
						</tr>
						<tr>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 3</strong></td>
							<td class="p-2">
								<span id="sala_3_manha_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_manha_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_manha_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_manha_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_manha_sexta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_manha_sabado"></span>
							</td>
						</tr>
						<tr style="background-color: lightgray;">
							<td class="p-2" style="vertical-align: middle !important;" rowspan="3"><strong>Tarde</strong></td>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 1</strong></td>
							<td class="p-2">
								<span id="sala_1_tarde_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_tarde_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_tarde_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_tarde_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_tarde_sexta"></span>
							</td>
							<td class="p-2" rowspan="3"></td>
						</tr>
						<tr style="background-color: lightgrey;">
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 2</strong></td>
							<td class="p-2">
								<span id="sala_2_tarde_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_tarde_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_tarde_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_tarde_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_tarde_sexta"></span>
							</td>
						</tr>
						<tr style="background-color: lightgray;">
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 3</strong></td>
							<td class="p-2">
								<span id="sala_3_tarde_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_tarde_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_tarde_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_tarde_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_tarde_sexta"></span>
							</td>
						</tr>
						<tr>
							<td class="p-2" style="vertical-align: middle !important;" rowspan="3"><strong>Noite</strong></td>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 1</strong></td>
							<td class="p-2">
								<span id="sala_1_noite_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_noite_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_noite_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_noite_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_1_noite_sexta"></span>
							</td>
							<td class="p-2" rowspan="3"></td>
						</tr>
						<tr>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 2</strong></td>
							<td class="p-2">
								<span id="sala_2_noite_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_noite_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_noite_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_noite_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_2_noite_sexta"></span>
							</td>
						</tr>
						<tr>
							<td class="p-2" style="vertical-align: middle !important;"><strong>Sala 3</strong></td>
							<td class="p-2">
								<span id="sala_3_noite_segunda"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_noite_terca"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_noite_quarta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_noite_quinta"></span>
							</td>
							<td class="p-2">
								<span id="sala_3_noite_sexta"></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Segunda-Feira</h3>
			</div>
			<div class="card-body">
				<div id='calendar_seg'></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Terça-Feira</h3>
			</div>
			<div class="card-body">
				<div id='calendar_ter'></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Quarta-Feira</h3>
			</div>
			<div class="card-body">
				<div id='calendar_qua'></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Quinta-Feira</h3>
			</div>
			<div class="card-body">
				<div id='calendar_qui'></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Sexta-Feira</h3>
			</div>
			<div class="card-body">
				<div id='calendar_sex'></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Sábado</h3>
			</div>
			<div class="card-body">
				<div id='calendar_sab'></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script>
	$(document).ready(function()
    {
		turmas_dia_seg = [];
		turmas_dia_ter = [];
		turmas_dia_qua = [];
		turmas_dia_qui = [];
		turmas_dia_sex = [];
		turmas_dia_sab = [];
        turmas_eventos(moment.now(), 'Segunda-Feira')
        turmas_eventos(moment.now(), 'Terça-Feira')
        turmas_eventos(moment.now(), 'Quarta-Feira')
        turmas_eventos(moment.now(), 'Quinta-Feira')
        turmas_eventos(moment.now(), 'Sexta-Feira')
        turmas_eventos(moment.now(), 'Sábado')
		turmas_semana()
	});

	function calendario_seg()
    {
		var calendarEl_seg = document.getElementById('calendar_seg');

		var calendar_seg = new FullCalendar.Calendar(calendarEl_seg, {
			locale: 'pt-br', // the initial locale
			resourceAreaWidth: '15%',
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            // schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives'
			contentHeight: 'auto',
            now: moment.now(),
			slotDuration: {
				days: 1
			},
			hiddenDays: [0, 2, 3, 4, 5, 6], // Ocultar terças, quartas, quintas, sextas, sábados e domingos        (mostrar apenas SEGUNDAS)
			editable: false, // enable draggable events
			selectable: true,
			aspectRatio: 1.8,
            headerToolbar: {
                left: 'today prev,next',
				center: 'title',
				right: 'resourceTimelineMonth,resourceTimelineYear',
			},
			initialView: 'resourceTimelineYear',
			resourceAreaHeaderContent: 'Salas',
			resources: [{
					id: 'a',
					title: 'Multidisplinar 1',
					children: [{
							id: '1m19',
							title: 'Manhã'
						},
						{
							id: '2t19',
							title: 'Tarde'
						},
						{
							id: '3n19',
							title: 'Noite'
						},
					]
				},
				{
					id: 'b',
					title: 'Multidisplinar 2',
					eventColor: 'green',
					children: [{
							id: '1m20',
							title: 'Manhã'
						},
						{
							id: '2t20',
							title: 'Tarde'
						},
						{
							id: '3n20',
							title: 'Noite'
						},
					]
				},
				{
					id: 'c',
					title: 'Multidisplinar 3',
					eventColor: 'orange',
					children: [{
							id: '1m21',
							title: 'Manhã'
						},
						{
							id: '2t21',
							title: 'Tarde'
						},
						{
							id: '3n21',
							title: 'Noite'
						},
					],
				},
			],
			events: turmas_dia_seg,
		});

        calendar_seg.render();
	}

	function calendario_ter()
    {
		var calendarEl_ter = document.getElementById('calendar_ter');

		var calendar_ter = new FullCalendar.Calendar(calendarEl_ter, {
			locale: 'pt-br', // the initial locale
			resourceAreaWidth: '15%',
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			contentHeight: 'auto',
            now: moment.now(),
			slotDuration: {
				days: 1
			},
			hiddenDays: [0, 1, 3, 4, 5, 6], // Ocultar segundas, quartas, quintas, sextas, sábados e domingos      (mostrar apenas TERÇAS)
			editable: false, // enable draggable events
			selectable: true,
			aspectRatio: 1.8,
            headerToolbar: {
                left: 'today prev,next',
				center: 'title',
				right: 'resourceTimelineMonth,resourceTimelineYear',
			},
			initialView: 'resourceTimelineYear',
			resourceAreaHeaderContent: 'Salas',
			resources: [{
					id: 'a',
					title: 'Multidisplinar 1',
					children: [{
							id: '1m19',
							title: 'Manhã'
						},
						{
							id: '2t19',
							title: 'Tarde'
						},
						{
							id: '3n19',
							title: 'Noite'
						},
					]
				},
				{
					id: 'b',
					title: 'Multidisplinar 2',
					eventColor: 'green',
					children: [{
							id: '1m20',
							title: 'Manhã'
						},
						{
							id: '2t20',
							title: 'Tarde'
						},
						{
							id: '3n20',
							title: 'Noite'
						},
					]
				},
				{
					id: 'c',
					title: 'Multidisplinar 3',
					eventColor: 'orange',
					children: [{
							id: '1m21',
							title: 'Manhã'
						},
						{
							id: '2t21',
							title: 'Tarde'
						},
						{
							id: '3n21',
							title: 'Noite'
						},
					],
				},
			],
			events: turmas_dia_ter,
		});

        calendar_ter.render();
	}

	function calendario_qua()
    {
		var calendarEl_qua = document.getElementById('calendar_qua');

		var calendar_qua = new FullCalendar.Calendar(calendarEl_qua, {
			locale: 'pt-br', // the initial locale
			resourceAreaWidth: '15%',
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			contentHeight: 'auto',
            now: moment.now(),
			slotDuration: {
				days: 1
			},
			hiddenDays: [0, 1, 2, 4, 5, 6], // Ocultar segundas, terças, quintas, sextas, sábados e domingos       (mostrar apenas QUARTAS)
			editable: false, // enable draggable events
			selectable: true,
			aspectRatio: 1.8,
            headerToolbar: {
                left: 'today prev,next',
				center: 'title',
				right: 'resourceTimelineMonth,resourceTimelineYear',
			},
			initialView: 'resourceTimelineYear',
			resourceAreaHeaderContent: 'Salas',
			resources: [{
					id: 'a',
					title: 'Multidisplinar 1',
					children: [{
							id: '1m19',
							title: 'Manhã'
						},
						{
							id: '2t19',
							title: 'Tarde'
						},
						{
							id: '3n19',
							title: 'Noite'
						},
					]
				},
				{
					id: 'b',
					title: 'Multidisplinar 2',
					eventColor: 'green',
					children: [{
							id: '1m20',
							title: 'Manhã'
						},
						{
							id: '2t20',
							title: 'Tarde'
						},
						{
							id: '3n20',
							title: 'Noite'
						},
					]
				},
				{
					id: 'c',
					title: 'Multidisplinar 3',
					eventColor: 'orange',
					children: [{
							id: '1m21',
							title: 'Manhã'
						},
						{
							id: '2t21',
							title: 'Tarde'
						},
						{
							id: '3n21',
							title: 'Noite'
						},
					],
				},
			],
			events: turmas_dia_qua,

		});

		calendar_qua.render();
	}

	function calendario_qui()
    {
		var calendarEl_qui = document.getElementById('calendar_qui');

		var calendar_qui = new FullCalendar.Calendar(calendarEl_qui, {
			locale: 'pt-br', // the initial locale
			resourceAreaWidth: '15%',
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			contentHeight: 'auto',
            now: moment.now(),
			slotDuration: {
				days: 1
			},
			hiddenDays: [0, 1, 2, 3, 5, 6], // Ocultar segundas, terças, quartas, sextas, sábados e domingos       (mostrar apenas QUINTAS)
			editable: false, // enable draggable events
			selectable: true,
			aspectRatio: 1.8,
            headerToolbar: {
                left: 'today prev,next',
				center: 'title',
				right: 'resourceTimelineMonth,resourceTimelineYear',
			},
			initialView: 'resourceTimelineYear',
			resourceAreaHeaderContent: 'Salas',
			resources: [{
					id: 'a',
					title: 'Multidisplinar 1',
					children: [{
							id: '1m19',
							title: 'Manhã'
						},
						{
							id: '2t19',
							title: 'Tarde'
						},
						{
							id: '3n19',
							title: 'Noite'
						},
					]
				},
				{
					id: 'b',
					title: 'Multidisplinar 2',
					eventColor: 'green',
					children: [{
							id: '1m20',
							title: 'Manhã'
						},
						{
							id: '2t20',
							title: 'Tarde'
						},
						{
							id: '3n20',
							title: 'Noite'
						},
					]
				},
				{
					id: 'c',
					title: 'Multidisplinar 3',
					eventColor: 'orange',
					children: [{
							id: '1m21',
							title: 'Manhã'
						},
						{
							id: '2t21',
							title: 'Tarde'
						},
						{
							id: '3n21',
							title: 'Noite'
						},
					],
				},
			],
			events: turmas_dia_qui,

		});

		calendar_qui.render();
	}

	function calendario_sex()
    {
		var calendarEl_sex = document.getElementById('calendar_sex');

		var calendar_sex = new FullCalendar.Calendar(calendarEl_sex, {
			locale: 'pt-br', // the initial locale
			resourceAreaWidth: '15%',
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			contentHeight: 'auto',
            now: moment.now(),
			slotDuration: {
				days: 1
			},
			hiddenDays: [0, 1, 2, 3, 4, 6], // Ocultar segundas, terças, quartas, quintas, sábados e domingos      (mostrar apenas SEXTAS)
			editable: false, // enable draggable events
			selectable: true,
			aspectRatio: 1.8,
            headerToolbar: {
                left: 'today prev,next',
				center: 'title',
				right: 'resourceTimelineMonth,resourceTimelineYear',
			},
			initialView: 'resourceTimelineYear',
			resourceAreaHeaderContent: 'Salas',
			resources: [{
					id: 'a',
					title: 'Multidisplinar 1',
					children: [{
							id: '1m19',
							title: 'Manhã'
						},
						{
							id: '2t19',
							title: 'Tarde'
						},
						{
							id: '3n19',
							title: 'Noite'
						},
					]
				},
				{
					id: 'b',
					title: 'Multidisplinar 2',
					eventColor: 'green',
					children: [{
							id: '1m20',
							title: 'Manhã'
						},
						{
							id: '2t20',
							title: 'Tarde'
						},
						{
							id: '3n20',
							title: 'Noite'
						},
					]
				},
				{
					id: 'c',
					title: 'Multidisplinar 3',
					eventColor: 'orange',
					children: [{
							id: '1m21',
							title: 'Manhã'
						},
						{
							id: '2t21',
							title: 'Tarde'
						},
						{
							id: '3n21',
							title: 'Noite'
						},
					],
				},
			],
			events: turmas_dia_sex,

		});

		calendar_sex.render();
	}

	function calendario_sab()
    {
		var calendarEl_sab = document.getElementById('calendar_sab');

		var calendar_sab = new FullCalendar.Calendar(calendarEl_sab, {
			locale: 'pt-br', // the initial locale
			resourceAreaWidth: '15%',
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			contentHeight: 'auto',
            now: moment.now(),
			slotDuration: {
				days: 1
			},
			hiddenDays: [0, 1, 2, 3, 4, 5], // Ocultar segundas, terças, quartas, quintas, sextas e domingos       (mostrar apenas SÁBADOS)
			editable: false, // enable draggable events
			selectable: true,
			aspectRatio: 1.8,
			headerToolbar: {
                left: 'today prev,next',
				center: 'title',
				right: 'resourceTimelineMonth,resourceTimelineYear',
			},
			initialView: 'resourceTimelineYear',
			resourceAreaHeaderContent: 'Salas',
			resources: [{
					id: 'a',
					title: 'Multidisplinar 1',
					children: [{
							id: '1m19',
							title: 'Manhã'
						},
					]
				},
				{
					id: 'b',
					title: 'Multidisplinar 2',
					eventColor: 'green',
					children: [{
							id: '1m20',
							title: 'Manhã'
						},
					]
				},
				{
					id: 'c',
					title: 'Multidisplinar 3',
					eventColor: 'orange',
					children: [{
							id: '1m21',
							title: 'Manhã'
						},
					],
				},
			],
			events: turmas_dia_sab,

		});

		calendar_sab.render();
	}

	function turmas_eventos(dt_referencia = moment(), dia_semana)
    {
		$('#overlay-turmas').show();

		var dt_refere = moment(dt_referencia);
		var dt_inicio_semana = dt_refere.startOf('isoWeek').format("YYYY-MM-DD");;

		var url = "{{ route('ped.turmas.pesquisar') }}";
		var params = '?dt_inicio=' + dt_inicio_semana + '&dia_semana=' + dia_semana;
		var params = url + params;

		axios.get(params)
		.then(function(response)
		{
            // console.log(response.data)
            eventos = [];

            (response.data).forEach(turma =>
            {
                i_turma = turma;
                // console.log(i_turma)
                testHorario = fazer_ResourseID(turma.horario);
                testSala    = turma.sala;

                i_turma.resourceId = testHorario+testSala;
                i_turma.color      = turma_legenda_cor_curso(turma.id_curso);

                // novo_turma = eventos.push(i_turma);

                switch (dia_semana)
                {
                    case 'Segunda-Feira':
                        turmas_dia_seg.push(i_turma);
                        break;
                    case 'Terça-Feira':
                        turmas_dia_ter.push(i_turma);
                        break;
                    case 'Quarta-Feira':
                        turmas_dia_qua.push(i_turma);
                        break;
                    case 'Quinta-Feira':
                        turmas_dia_qui.push(i_turma);
                        break;
                    case 'Sexta-Feira':
                        turmas_dia_sex.push(i_turma);
                        break;
                    case 'Sábado':
                        turmas_dia_sab.push(i_turma);
                        break;
                    default:
                        alert('s');
                        break;
                };
            })
        })
@include('includes.catch', [ 'codigo_erro' => '6565257a' ] )
		.then(function()
        {
            calendario_seg();
            calendario_ter();
            calendario_qua();
            calendario_qui();
            calendario_sex();
            calendario_sab();
        })
	}

    function fazer_ResourseID( horario )
    {
        switch (horario)
        {
            case 'Manhã':
                return '1m';
                break
            case 'Tarde':
                return '2t';
                break
            case 'Noite':
                return '3n';
                break
            default:
                return 'm';
                break
        }
    }

	function turmas_semana(dt_referencia = moment()) {
		$('#overlay-turmas').show();

		var dt_refere = moment(dt_referencia);
		var dt_inicio_semana = dt_refere.startOf('isoWeek').format("YYYY-MM-DD");;

		var url = "{{ route('ped.turmas.pesquisar') }}";
		var params = '?dt_inicio=' + dt_inicio_semana;
		var params = url + params;

		axios.get(params)
			.then(function(response) {
				// console.log(response.data)
				$('#span_dia_seg').append(moment(dt_inicio_semana).add(0, 'days').format('DD/MM/YYYY'))
				$('#span_dia_ter').append(moment(dt_inicio_semana).add(1, 'days').format('DD/MM/YYYY'));
				$('#span_dia_qua').append(moment(dt_inicio_semana).add(2, 'days').format('DD/MM/YYYY'));
				$('#span_dia_qui').append(moment(dt_inicio_semana).add(3, 'days').format('DD/MM/YYYY'));
				$('#span_dia_sex').append(moment(dt_inicio_semana).add(4, 'days').format('DD/MM/YYYY'));
				$('#span_dia_sab').append(moment(dt_inicio_semana).add(5, 'days').format('DD/MM/YYYY'));

				collect(response.data).each((turma) =>
                {
					switch (turma.sala)
                    {
						case 19:
							var part_1 = 'sala_1';
							break
						case 20:
							var part_1 = 'sala_2';
							break
						case 21:
							var part_1 = 'sala_3';
							break
					}

					switch (turma.horario) {
						case 'Manhã':
							var part_2 = 'manha';
							break
						case 'Tarde':
							var part_2 = 'tarde';
							break
						case 'Noite':
							var part_2 = 'noite';
							break
						default:
							var part_2 = 'manha';
							break
					}

					switch (turma.dia_semana) {
						case 'Segunda-Feira':
							var part_3 = 'segunda';
							break
						case 'Terça-Feira':
							var part_3 = 'terca';
							break
						case 'Quarta-Feira':
							var part_3 = 'quarta';
							break
						case 'Quinta-Feira':
							var part_3 = 'quinta';
							break
						case 'Sexta-Feira':
							var part_3 = 'sexta';
							break
						case 'Sábado':
							var part_3 = 'sabado';
							break
					}

					var local_turma = part_1 + '_' + part_2 + '_' + part_3;
					$('#' + local_turma + '').append(turma_fazer_ficha(turma))
				});
			})
			@include('includes.catch', [ 'codigo_erro' => '4264042a' ] )
			.then(function()
            {
				$('#overlay-turmas').hide();
			})
	}

	function turma_fazer_ficha(turma) {
		return '<div class="rounded text-center bg-' + turma_legenda_cor_curso(turma.id_curso) + ' m-1">' + turma.title + '' +
			'<br/><small>Início: ' + moment(turma.dt_inicio).format('DD/MM/YYYY') + '</small>' +
			'<br/><small>Final: ' + moment(turma.dt_final).format('DD/MM/YYYY') + '</small>' +
			'</div>';

		// return '<div class="info-box bg-gradient-'+turma_legenda_cor_curso(turma.id_curso)+' m-1">'+
		//           '<div class="info-box-content">'+
		//             '<span class="info-box-number">'+turma.id_curso +'  -  '+ turma.sigla+'</span>'+
		//             // '<span class="progress-description">'+turma.cbntdakklaoyfih.nome+'</span>'+
		//             '<span class="progress-description"><small>Início: '+moment(turma.dt_inicio).format('DD/MM/YYYY')+'</small></span>'+
		//             '<span class="progress-description"><small>Final: '+moment(turma.dt_final).format('DD/MM/YYYY')+'</small></span>'+
		//           '</div>'+
		//         '</div>';
	}

	function turma_legenda_cor_curso(curso) {
		switch (curso) {
			case 84:
			case 185:
			case 189:
				return 'purple';
				break;
			case 194:
				return 'orange';
				break;
			case 206:
				return 'red';
				break;
			case 207:
				return 'maroon';
				break;
			case 216:
				return 'yellow';
				break;
			case 270:
				return 'gray';
				break;
			case 167:
			case 290:
			case 295:
			case 326:
				return 'pink';
				break;
			default:
				return 'primary';
				break
		}

		// Barbeiro: Grey
		// Cabeleireiro: Purple
		// Depilação: Yellow
		// Designer de Sobrancelhas: Orange
		// Manicure e Pedicure: Pink
		// Maquiagem Profissional: Red
		// Massagem: Green
		// Designer de Cilios: Brown
		// Micropigmentação: Fuschia (Roxo)
	}
</script>
@stop

@section('js')
<style>
	body {
		margin: 0;
		padding: 0;
		font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 1100px;
		margin: 50px auto;
	}
</style>
@stop
