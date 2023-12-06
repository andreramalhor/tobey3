@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Relatório Geral de Vendas</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <form action="{{ route('relatorio.vendas') }}" method="POST" autocomplete="off">
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
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Data/Hora</th>
              <th class="text-center">Caixa</th>
              <th class="text-left">Cliente</th>
              <th class="text-center">Tipo</th>
              <th class="text-left">Serviço /<br>Produto</th>
              <th class="text-left">Profissional</th>
              <th class="text-right">Valor<br>Tabelado</th>
              <th class="text-right">Valor<br>Venda</th>
              <th class="text-right">Valor<br>Desc. / Acrsc.</th>
              <th class="text-right">Valor<br>Final</th>
              <th class="text-center">% Comissão<br>Profissional</th>
              <th class="text-right">Comissão<br>Profissional</th>
              <th class="text-right">Lucro<br>Bruto</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($vendas->sortBy('created_at') as $venda)
              @foreach ($venda->dfyejmfcrkolqjh->sortBy('created_at') as $servico)
              <tr>
                <td class="text-center">{{ $venda->id }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($servico->created_at)->format('d/m/Y H:i:s') }}</td>
                <td class="text-center">{{ $venda->id_caixa }}</td>
                <td class="text-left">{{ optional(optional($servico->sbbgaqleesuzlus)->lufqzahwwexkxli)->apelido ?? '(Cliente sem cadastro)' }}</td>
                <td class="text-center">{{ optional($servico->kcvkongmlqeklsl)->tipo }}</td>
                <td class="text-left">{{ optional($servico->kcvkongmlqeklsl)->nome ?? 'Erro Prod./Serv.' }}</td>
                <td class="text-left">{{ !isset($servico->hgihnjekboyabez) ? '(Não informado)' : optional(optional($servico->hgihnjekboyabez)->xeypqgkmimzvknq)->apelido ?? 'error3' }}</td>
                <td class="text-center">{{ number_format(optional($servico->kcvkongmlqeklsl)->vlr_venda, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($servico->vlr_negociado, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($servico->vlr_dsc_acr, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($servico->vlr_final, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format(!isset($servico->hgihnjekboyabez) ? 0 : optional($servico->hgihnjekboyabez)->percentual * 100 ?? 9999, 1, ',', '.') }} %</td>
                <td class="text-center">{{ number_format(!isset($servico->hgihnjekboyabez) ? 0 : optional($servico->hgihnjekboyabez)->valor ?? 9999999999, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format(($servico->vlr_final ?? 99999) - (!isset($servico->hgihnjekboyabez) ? 0 : optional($servico->hgihnjekboyabez)->valor ?? 9999999999), 2, ',', '.') }}</td>
              </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          @if(isset($dataForm))
          {{ $vendas->appends($dataForm)->links() }}
          @else
          {{ $vendas->links() }}
          @endif
        </div>
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
