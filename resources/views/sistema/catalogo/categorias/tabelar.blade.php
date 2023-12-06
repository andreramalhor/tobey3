<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-categorias">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Tipo</th>
        <th>Descrição</th>
        <th class="text-nowrap text-center">Qtd Produtos</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($categorias as $categoria)
        @if( isset($categoria->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $categoria->id }}</td>
          <td class="text-nowrap">{{ $categoria->nome }}</td>
          <td class="text-nowrap text-center">{{ $categoria->tipo }}</td>
          <td class="">{{ $categoria->descricao }}</td>
          <td class="text-nowrap text-center">{{ $categoria->QDZU9JO2W4UA3WE->count() }}</td>
          <td class="text-nowrap text-center">
            @can('Permissões.Detalhes')
              <a href="{{ route('cat.categorias.mostrar', $categoria->id) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Permissões.Editar')
              <a href="{{ route('cat.categorias.editar', $categoria->id) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan
            
            @can('Permissões.Excluir')
              <a onClick="categorias_excluir({{$categoria->id}})" href="" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
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
