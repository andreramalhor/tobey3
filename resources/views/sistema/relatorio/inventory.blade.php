@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista Estoque</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Serviço/Produto</th>
              <th class="text-center">Valor Tabela</th>
              <th class="text-center">Estoque Mínimo</th>
              <th class="text-center">Estoque Máximo</th>
              <th class="text-center">Estoque Atual</th>
              <th class="text-right">Valor Custo</th>
            </tr>
          </thead>
          <tbody>
            @foreach($produtos->sortBy('nome') as $produto)
              <tr>
                <td class="text-center">{{ $produto->id }}</td>
                <td class="text-left">{{ $produto->nome ?? 'error2' }}</td>
                <td class="text-center">{{ number_format($produto->vlr_venda, 2, ',', '.') }}</td>
                <td class="text-center">{{ number_format($produto->estoque_minimo, 0, ',', '.') }}</td>
                <td class="text-center">{{ number_format($produto->estoque_maximo, 0, ',', '.') }}</td>
                <td class="text-center">{{ number_format($produto->estoque_atual, 0, ',', '.') }}</td>
                <td class="text-right">{{ isset($produto->vlr_custo) ? number_format($produto->vlr_custo, 2, ',', '.') : '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          {{-- @if(isset($dataForm)) --}}
          {{-- {{ $produtos->appends($dataForm)->links() }} --}}
          {{-- @else --}}
          {{-- {{ $produtos->links() }} --}}
          {{-- @endif --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $('#periodo').daterangepicker(
  {
    format: "DD/MM/YYYY",
    opens: 'left',
    alwaysShowCalendars: true,
    autoclose: true,
    autoclose: true,
    locale:
    {
      "customRangeLabel": "Selecionar intervalo",
      "format": "DD/MM/YYYY",
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "daysOfWeek": [ "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab" ],
      "monthNames": [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
    },
    firstDay: 1,
    ranges:
    {
      'Hoje': [moment(), moment()],
      'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
      'Este mês': [moment().startOf('month'), moment().endOf('month')],
      'Mês anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
  }, function(start, end, label)
  {
    $('#periodo').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
  });
</script>
@endsection
