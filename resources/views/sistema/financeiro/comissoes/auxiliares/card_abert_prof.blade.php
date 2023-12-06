<div class="card">
  <div class="card-header">
    <h3 class="card-title">Comissões em aberto</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm table-striped no-padding text-nowrap">
      <thead class="table-dark">
        <tr>
          <th class="text-left py-1">Profissional</th>
          <th class="text-center py-1">Período</th>
          <th class="text-right py-1">Comissao</th>
          <th class="text-center py-1"><i class="fas fa-ellipsis-h"></i></th>
        </tr>
      </thead>
      <tbody>
        @php $saldo = 0 @endphp
        @forelse($colaboradores as $colaborador)
        <tr>
          <td class="text-left">{{ $colaborador->apelido ?? 'Profissinal não identificado'}}</td>
          <td class="text-center">{{ \Carbon\Carbon::parse($colaborador->opmnhtrvanmesd->min('created_at'))->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($colaborador->opmnhtrvanmesd->max('created_at'))->format('d/m/Y') }}</td>
          <td class="text-right">{{ number_format($colaborador->opmnhtrvanmesd->where('status', '=', 'Em Aberto')->sum('valor'), 2, ',', '.') }}</td>
          <td class="text-center">
          @can('Financeiro.Editar')
            <a href="{{ route('fin.comissoes.prof_abert', $colaborador->id) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Ver" data-original-title="Ver"><i class="fa-solid fa-search"></i></a>
          @endcan
          </td>
        </tr>
        @php $saldo = $saldo + $colaborador->opmnhtrvanmesd->where('status', '=', 'Em Aberto')->sum('valor') @endphp
        @empty
        <tr>
          <td class="text-center" colspan="4">Não há comissões em aberto.</td>
        </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th class="text-left">{{ $colaboradores->count() }}</th>
          <th></th>
          <th class="text-right p-1">{{ number_format($saldo, 2, ',', '.') }}</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
