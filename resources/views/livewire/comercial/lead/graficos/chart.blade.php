<div>
  <x-adminlte.card.card titulo="{{ $titulo ?? 'Título' }}">
    <div id="{{ $id_crt ?? 'chart' }}"></div>
  </x-adminlte.card.card>
</div>

@push('js')
<script>
  var options = {
    chart: {
      type: 'line'
    },
    series: [{
      name: 'leads',
      data: @json($valores)
    }],
    xaxis: {
      categories: @json($rotulos)
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    markers: {
      size: 4,
    }
  }

  var chart = new ApexCharts(document.querySelector("#{{ $id_crt ?? 'chart' }}"), options);

  chart.render();
</script>
@endpush
