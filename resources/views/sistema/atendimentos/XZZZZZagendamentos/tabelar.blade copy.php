<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-vendas">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Caixa</th>
        <th class="text-nowrap">Cliente</th>
        <th class="text-nowrap text-center">Qtd Produtos</th>
        <th class="text-nowrap">Vlr Final</th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($vendas as $venda)
        @if( isset($venda->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $venda->id }}</td>
          <td class="text-nowrap">{{ $venda->id_caixa }}</td>
          <td class="text-nowrap">{{ $venda->id_cliente }}</td>
          <td class="text-nowrap text-center">{{ $venda->qtd_produtos }}</td>
          <td class="text-nowrap text-center">{{ $venda->vlr_final }}</td>
          <td class="text-nowrap text-center">{{ $venda->status }}</td>
          {{--
          <td class="text-nowrap">
            @if(isset($venda->dt_nascimento))
            {{ \Carbon\Carbon::parse($venda->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($venda->dt_nascimento)->age }} anos)
            @endif
          </td>

  --}}
          <td class="text-nowrap text-center">
            @can('Vendas.Detalhes')
              <a href="{{ route('pdv.vendas.mostrar', $venda) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan
{{-- 
  @can('Vendas.Editar')
  <a href="{{ route('pdv.vendas.editar', $venda->id) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
  @endcan
  --}}
            
            @can('Vendas.Excluir')
              @if($venda->deleted_at == null)
                <a onClick="vendas_excluir({{$venda->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onClick="vendas_restaurar({{$venda->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
              @endif
            @endcan
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="8">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $vendas->appends($dataForm)->links() }}
    @else
    {{ $vendas->links() }}
    @endif
  </div>
</div>
