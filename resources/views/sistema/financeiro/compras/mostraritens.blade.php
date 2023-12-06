<table id="table-detalhes" class="table table-hover table-bordered table-condensed table-sm">
  <thead>
    <tr style="background-color: #222d32; color: white;">
      <th class="text-center">Perc. Comissão</th>
      <th class="text-center">Vlr Comissão</th>
      <th class="text-center">Profissional</th>

      <th class="text-center">Produto / Serviço</th>
      <th class="text-center">Vlr Venda</th>
      {{-- <th class="text-center">Vlr Negociado</th> --}}
      <th class="text-center">Dsc ou Acr.</th>
      <th class="text-center">Vlr Final</th>
      <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
    </tr>
  </thead>
  <tbody id="campos_contatos">
    @forelse($itens as $item)
    <tr>
      <td class="text-right">{{ number_format(($item->pqwnldkwjfencsb->percentual ?? 0) * 100, 1, ',', '.') }} %</td>
      <td class="text-right">{{ number_format(($item->pqwnldkwjfencsb->valor ?? 0), 2, ',', '.') }}</td>
      <td class="text-left">{{ $item->pqwnldkwjfencsb->DetalhesDoProfissionalQueFezEssaComanda->apelido ?? 'Profissional' }}</td>
      
      <td class="text-left">{{ $item->kcvkongmlqeklsl->nome ?? 'Prod / Serv' }}</td>
      <td class="text-right">{{ number_format($item->vlr_venda, 2, ',', '.') }}</td>
      {{-- <td class="text-right">{{ number_format($item->vlr_negociado, 2, ',', '.') }}</td> --}}
      <td class="text-right">{{ number_format($item->vlr_dsc_acr, 2, ',', '.') }}</td>
      <td class="text-right">{{ number_format($item->vlr_final, 2, ',', '.') }}</td>
      <td class='text-center'>
        <div class="btn-group">
          <a onclick='apagarItem({{ $item->id }})' class="btn btn-danger btn-xs"> <i style="width: 10px;" class="fas fa-times"></i></a>
        </div>
      </td>
    </tr>
    @empty
    <tr>
      <td class="text-center" colspan="8">Nenhum Serviço / Produto lançado</td>
    </tr>
    @endforelse
  </tbody>
  @if (count($itens) > 0)
  <tfoot>
    <tr>
      <th class='text-right'>{{ number_format($itens->sum('vlr_final') - $itens->sum('pqwnldkwjfencsb.valor'), 2, ',', '.') }}</th>
      <th class='text-right'>{{ number_format($itens->sum('pqwnldkwjfencsb.valor'), 2, ',', '.') }}</th>
      <th class='text-center'></th>
      <th class='text-center'></th>
      <th class='text-right'>{{ number_format($itens->sum('vlr_venda'), 2, ',', '.') }}</th>
      <th class='text-right'>{{ number_format($itens->sum('vlr_dsc_acr'), 2, ',', '.') }}</th>
      <th class='text-right'>{{ number_format($itens->sum('vlr_final'), 2, ',', '.') }}</th>
      <th class='text-center'></th>
    </tr>
  </tfoot>
  @endif
</table>
