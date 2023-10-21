
<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $titulo }}</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#{{ $mes_id_crt }}" data-bs-toggle="tab">Mês</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#{{ $ano_id_crt }}" data-bs-toggle="tab">Ano</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content p-0">
                <div class="chart tab-pane active" id="{{ $mes_id_crt }}">

                </div>
                <div class="chart tab-pane" id="{{ $ano_id_crt }}">

                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    var mes_options = {
        chart: {
            type: 'line'
        },
        series: [{
            name: 'leads',
            data: @json($mes_valores)
        }],
        xaxis: {
            categories: @json($mes_rotulos)
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 4,
        }
    }
    var mes_chart = new ApexCharts(document.querySelector("#{{ $mes_id_crt }}"), mes_options);
    mes_chart.render();

    var ano_options = {
        chart: {
            type: 'line'
        },
        series: [{
            name: 'leads',
            data: @json($ano_valores)
        }],
        xaxis: {
            categories: @json($ano_rotulos)
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 4,
        }
    }
    var ano_chart = new ApexCharts(document.querySelector("#{{ $ano_id_crt }}"), ano_options);
    ano_chart.render();
</script>
@endpush
