<table class="table table-sm table-striped no-padding table-valign-middle projects">
  <thead class="table-dark">
    <tr>
      <!-- <th class="text-left">#</th> -->
      <th class="text-center">Cód. Aluno</th>
      <th class="text-left">Aluno</th>
      <th class="text-center">Contrato</th>
      <th class="text-center">Turma</th>
      <th class="text-center">Parcela</th>
      <th class="text-right">Dt. Vencimento</th>
      <th class="text-right">Vlr. Bruto</th>
      <th class="text-right">Vlr. Desc.</th>
      <th class="text-right">Vlr. Líquido</th>
      <th class="text-right">Status</th>
      <th class="text-right">Vlr. Pago</th>
      <th class="text-right">Dt. Pagamento</th>
      <th class="text-center">...</th>
    </tr>
  </thead>
  <tbody>
    @forelse($a_receber as $conta)
    <tr>
      <!-- <td class="text-center"><input type="checkbox" name="id_recebimento[{{ $conta->id }}]" value="{{ $conta->id }}"></td> -->
      <td class="text-center">{{ $conta->id_pessoa }}</td>
      <td class="text-left">{{ $conta->nome }}</td>
      <td class="text-center">{{ $conta->num_aluno }}</td>
      <td class="text-center">{{ $conta->turma }}</td>
      <td class="text-center">{{ $conta->parcela }}</td>
      <td class="text-right">{{ \Carbon\Carbon::parse($conta->dt_vencimento)->format('d/m/Y') }}</td>
      <td class="text-right">{{ number_format($conta->vlr_bruto, 2, ',', '.') }}</td>
      <td class="text-right">{{ number_format($conta->vlr_desconto_acrescimo, 2, ',', '.') }}</td>
      <td class="text-right">{{ number_format($conta->vlr_liquido, 2, ',', '.') }}</td>
      <td class="text-right">{{ $conta->status }}</td>
      <td class="text-right">{{ $conta->vlr_final == null ? '' : number_format($conta->vlr_final, 2, ',', '.') }}</td>
      <td class="text-right">{{ $conta->dt_pagamento == null ? '' : \Carbon\Carbon::parse($conta->dt_pagamento)->format('d/m/Y') }}</td>
      <td class="text-nowrap text-center">
        @can('A Receber.Detalhes')
        <a href="{{ route('fin.rec_cartoes.mostrar', $conta->id) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
        @endcan
        
        @can('A Receber.Editar')
        <a href="" data-bs-toggle="modal" onclick="aReceber_editar({{ $conta->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
        @endcan
        
        @can('A Receber.Editar')
        <a href="" data-bs-toggle="modal" onclick="aReceber_selecionar({{ $conta->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-arrow-right"></i></a>&nbsp;&nbsp;
        @endcan
        
        @can('A Receber.Excluir')
        <a onClick="funcoes_excluir({{ $conta->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
        @endcan
      </td>
    </tr>
    </tr>
    @empty
    <tr>
      <td class="text-center" colspan="14">Não há comissões em aberto.</td>
    </tr>
    @endforelse
  </tbody>
  <tfoot>
    <tr>
      <th class="text-left">{{ $a_receber->count() }}</th>
      <th class="text-center"></th>
      <th class="text-left"></th>
      <th class="text-center"></th>
      <th class="text-center"></th>
      <th class="text-center"></th>
      <th class="text-right"></th>
      <th class="text-right">{{ number_format($a_receber->sum('vlr_bruto'), 2, ',', '.') }}</th>
      <th class="text-right">{{ number_format($a_receber->sum('vlr_desconto_acrescimo'), 2, ',', '.') }}</th>
      <th class="text-right">{{ number_format($a_receber->sum('vlr_liquido'), 2, ',', '.') }}</th>
      <th class="text-right"></th>
      <th class="text-right">{{ number_format($a_receber->sum('vlr_final'), 2, ',', '.') }}</th>
      <th class="text-right"></th>
      <th class="text-center"></th>
    </tr>
  </tfoot>
</table>
