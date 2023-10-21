<table class="table table-sm">
    <thead class="table-dark">
        {{ $header}}
    </thead>
    <tbody>
        <tr>
            @forelse($conjunto as $item)
            <td class="text-center">{{ $item->id }}</td>
            <td class="text-center">
                {{ \Carbon\Carbon::parse($item->dt_pagamento)->format('d/m/Y') }}
            </td>
            <td>
                {{ $item->qexgzmnndqxmyks->apelido ?? '' }}
            </td>
            <td>
                <small>{{ $item->yaapdycfbplzkeg->nome ?? '' }}</small><br>
            </td>
            <td class="text-right text-{{ $item->color }}"><strong>{{ number_format($item->vlr_final, 2, ',', '.') }}</strong></td>
        </tr>
        @empty
        <tr>
            <th colspan="7" class="text-center">Não há resultados para essa pesquisa.</th>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{ number_format($conjunto->sum('vlr_final'), 2, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>