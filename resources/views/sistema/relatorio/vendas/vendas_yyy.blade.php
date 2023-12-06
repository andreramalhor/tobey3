@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Faturamento (por serviço ou produto)</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <form action="{{ route('relatorio.vendas_yyy') }}" method="POST" autocomplete="off">
              {!! csrf_field() !!}
              <div class="input-group">
                <input type="text" class="form-control form-control-sm reservation" name="dataForm" id="periodo" value="{{ \Carbon\Carbon::parse($dataForm['dt_inicio'])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($dataForm['dt_final'])->format('d/m/Y') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-sm btn-warning">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class='card-body p-0'>
        <table class='table table-sm table-hover no-padding table-valign-middle projects'>
          <thead class='table-dark'>
            <tr>
              <th width="" class='text-left'>Serviço ou Produto</th>
              <th width="5%"  class='text-center'>Qtd</th>
              <th width="10%" class='text-right'>Faturamento</th>
              <th width="10%" class='text-right'>% do Total</th>
              <th width="10%" class='text-right'>Vlr Média</th>
              <th width="10%" class='text-right'>% da Média</th>
            </tr>
          </thead>
          <tbody>
            @php
              $total_valor_medio = 0;
            @endphp
            
            @foreach($vendas_detalhes->groupBy('id_servprod') as $detalhes)
              @php
              $total_valor_medio = $total_valor_medio + ( $detalhes->sum('vlr_final') / $detalhes->sum('quantidade') );
              @endphp
            @endforeach

            @forelse($vendas_detalhes->groupBy('id_servprod')->sortByDesc(function($detalhes) use ($vendas_detalhes)
            {
              return $detalhes->sum('vlr_final') / $vendas_detalhes->sum('vlr_final');
            }) as $id_servprod => $detalhes)
            <tr style='background-color: ghostwhite;' >
              <td width="" class='text-left'>{{ optional($detalhes->first()->kcvkongmlqeklsl)->nome }}</td>
              <td width="5%"  class='text-center'>{{ $detalhes->sum('quantidade') }}</td>
              <td width="10%" class='text-right'>{{ number_format( $detalhes->sum('vlr_final'), 2, ',', '.') }}</td>
              <td width="10%" class='text-right'>{{ number_format( $detalhes->sum('vlr_final') / $vendas_detalhes->sum('vlr_final') * 100, 2, ',', '.') }} %</td>
              <td width="10%" class='text-right'>{{ number_format( $detalhes->sum('vlr_final') / $detalhes->sum('quantidade'), 2, ',', '.') }}</td>
              <td width="10%" class='text-right'>{{ number_format( ( ( $detalhes->sum('vlr_final') / $detalhes->sum('quantidade') ) / $total_valor_medio) * 100, 2, ',', '.') }} %</td>
            </tr>
            @empty
            <tr>
              <td class='text-center' colspan='6'>Não há pagamentos registrados.</td>
            </tr>
            @endforelse
          </tbody>
          <tfoot>
            <tr>
              <td width="" class='text-left' style='border-bottom-width: 0px;'></td>
              <td width="5%"  class='text-center' style='border-bottom-width: 0px;'><b>{{ $vendas_detalhes->sum('quantidade') }}</b></td>
              <td width="10%" class='text-right'><b>{{ number_format( $vendas_detalhes->sum('vlr_final'), 2, ',', '.') }}</b></td>
              <td width="10%" class='text-right'></td>
              <td width="10%" class='text-right'><b>{{ number_format( $total_valor_medio, 2, ',', '.') }}</b></td>
              <td width="10%" class='text-right'></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $('#periodo').daterangepicker({
    format: "DD/MM/YYYY",
    opens: 'left',
    alwaysShowCalendars: true,
    autoclose: true,
    autoclose: true,
    locale: {
      "customRangeLabel": "Selecionar intervalo",
      "format": "DD/MM/YYYY",
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "daysOfWeek": [ "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab" ],
      "monthNames": [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
    },
    firstDay: 1,
    ranges: {
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
