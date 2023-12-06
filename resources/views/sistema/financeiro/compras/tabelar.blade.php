<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-funcoes">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Tipo</th>
        <th class="text-nowrap">Fornecedor</th>
        <th class="text-nowrap">Qtd Produtos</th>
        <th class="text-nowrap">Valor</th>
        <th class="text-nowrap">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($compras->sortBy('marca')->sortBy('id_categoria') as $compra)
        @if( isset($compra->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $compra->id }}</td>
          <td class="text-nowrap">{{ $compra->tipo }}</td>
          <td class="text-nowrap">{{ $compra->id_fornecedor }}</td>
          <td class="text-nowrap">{{ $compra->qtd_produtos }}</td>
          <td class="text-nowrap">{{ $compra->vlr_final }}</td>
          <td class="text-nowrap">{{ $compra->status }}</td>
          {{-- <td class="text-nowrap text-center">{{ $compra->slug }}</td> --}}
          <td class="text-nowrap text-center">
            @if($compra->id != 1)

              @can('Permissões.Detalhes')
                <a href="{{ route('acl.funcoes.mostrar', $compra) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
              @endcan

              @can('Permissões.Editar')
                <a href="{{ route('acl.funcoes.editar', $compra) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan
              
              @can('Permissões.Excluir')
                <a onClick="funcoes_excluir({{$compra->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @endcan

            @endif
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
