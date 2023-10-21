<div>
  <x-adminlte.card.card titulo="{{ $titulo ?? 'Título' }}">
    <div id="{{ $id_crt ?? 'chart' }}"></div>
  </x-adminlte.card.card>  
</div>

@push('js')
<script>
  var options = {
    chart: {
      type: 'bar',
      height: 350
    },
    series: [{
      name: 'Receitas',
      data: @json($receita),
      color: '#4CAF50'
    },
    {
      name: 'Despesas',
      data: @json($despesa),
      color: '#C70039'
    }],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: @json($rotulos)
    },
    yaxis: {
      title: {
        text: 'R$ '
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return "R$ " + val
        }
      }
    },    
    markers: {
      size: 4,
    }
  }
  
  var chart = new ApexCharts(document.querySelector("#{{ $id_crt ?? 'chart' }}"), options);

  chart.render();
</script>
@endpush
