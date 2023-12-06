<table class="table table-sm table-striped no-padding table-valign-middle projects">
  <thead class="table-dark">
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Data Prevista</th>
      <th class="text-center"># Venda</th>
      <th class="text-center">Data da Venda</th>
      <th class="text-left">Forma de Pagamento</th>
      <th class="text-left">Bandeira</th>
      <th class="text-center">Parcela</th>
      <th class="text-center">Taxa</th>
      <th class="text-right">Vlr Bruto</th>
      <th class="text-right">Vlr Desc.</th>
      <th class="text-right">Vlr Líquido</th>
      <th class="text-center"></th>
    </tr>
  </thead>
  <tbody>
    @forelse($rec_cartoes->groupBy('gevmgwjvzgdexwm.forma') as $forma => $formas)
    <tr class="bg-success">
      <th class="text-center" colspan="2">{{ $forma }}</th>
      <th class="text-center" colspan="6"></th>
      <th class="text-right">{{ number_format($formas->sum('vlr_real'), 2, ',', '.') }}</th>
      <th class="text-right">{{ number_format($formas->sum('vlr_final') - $formas->sum('vlr_real'), 2, ',', '.') }}</th>
      <th class="text-right">{{ number_format($formas->sum('vlr_final'), 2, ',', '.') }}</th>
      <th class="text-center"></th>
    </tr>
      @foreach($formas->groupBy('gevmgwjvzgdexwm.bandeira') as $bandeira => $cartoes)
      <tr class="bg-lime">
        <th class="text-center" colspan="2">{{ $bandeira }}</th>
        <th class="text-center" colspan="6"></th>
        <th class="text-right">{{ number_format($cartoes->sum('vlr_real'), 2, ',', '.') }}</th>
        <th class="text-right">{{ number_format($cartoes->sum('vlr_final') - $cartoes->sum('vlr_real'), 2, ',', '.') }}</th>
        <th class="text-right">{{ number_format($cartoes->sum('vlr_final'), 2, ',', '.') }}</th>
        <th class="text-center"></th>
      </tr>
        @foreach($cartoes as $cartao)
        <tr>
          <td class="text-center"><input type="checkbox" name="id_recebimento[{{ $cartao->id }}]" value="{{ $cartao->id }}"></td>
          <td class="text-center">{{ Carbon\Carbon::parse($cartao->dt_prevista)->format('d/m/Y') }}</td>
          <td class="text-center">
            <a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $cartao->qjslcnhfdjsftre->id }})">
              <span class="badge bg-pink">{{ $cartao->qjslcnhfdjsftre->id }}</span>
            </a>
          </td>
          <td class="text-center">{{ Carbon\Carbon::parse($cartao->qjslcnhfdjsftre->created_at)->format('d/m/Y') }}</td>
          <td class="text-left">{{ $cartao->gevmgwjvzgdexwm->forma }}</td>
          <td class="text-left">{{ $cartao->gevmgwjvzgdexwm->bandeira }}</td>
          <td class="text-center">{{ $cartao->hthgoawwqzbxhdh->parcela }}</td>
          <td class="text-center">{{ $cartao->gevmgwjvzgdexwm->taxa }} %</td>
          <td class="text-right">{{ number_format($cartao->vlr_real, 2, ',', '.') }}</td>
          <td class="text-right">{{ number_format($cartao->vlr_final - $cartao->vlr_real, 2, ',', '.') }}</td>
          <td class="text-right">{{ number_format($cartao->vlr_final, 2, ',', '.') }}</td>
          <td class="text-nowrap text-center">
            @can('Recebimento Cartões.Detalhes')
            <a href="{{ route('fin.rec_cartoes.mostrar', $cartao->id) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan
            
            @can('Recebimento Cartões.Editar')
            <a href="" data-bs-toggle="modal" onclick="recCartoes_editar({{ $cartao->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan
            
            @can('Recebimento Cartões.Excluir')
            <a onClick="funcoes_excluir({{ $cartao->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
            @endcan
          </td>
        </tr>
        @endforeach
      @endforeach
    @empty
    <tr>
      <td class="text-center" colspan="12">Não há resultados para essa tabela.</td>
    </tr>
    @endforelse
  </tbody>
  <tfoot>
    <tr>
      <th class="text-center" colspan="8"></th>
      <th class="text-right">{{ number_format($rec_cartoes->sum('vlr_real'), 2, ',', '.') }}</th>
      <th class="text-right">{{ number_format($rec_cartoes->sum('vlr_final') - $rec_cartoes->sum('vlr_real'), 2, ',', '.') }}</th>
      <th class="text-right">{{ number_format($rec_cartoes->sum('vlr_final'), 2, ',', '.') }}</th>
      <th class="text-center"></th>
    </tr>
  </tfoot>
</table>
