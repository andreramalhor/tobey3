<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-permissao">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap text-center">Ordem</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap">Menu</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($permissoes as $permissao)
        @if( isset($permissao->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          
          <td class="text-nowrap">{{ $permissao->id }}</td>
          <td class="text-nowrap text-center">{{ $permissao->ordem }}</td>

          <td class="text-nowrap">
          @switch($permissao->nivel)
            @case(1)
              <i class="fa-solid fa-circle fa-xs"></i>
              @break
            @case(2)
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-turn-up fa-rotate-90"></i>
              @break
            @case(3)
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-turn-up fa-rotate-90"></i>
              @break
          @endswitch
          &nbsp;{{ $permissao->nome }}
          </td>
        
          <td class="text-nowrap">{{ $permissao->menu }}</td>
          <td class="text-nowrap text-center">
            @can('Permissões.Detalhes')
              <a href="{{ route('acl.permissoes.mostrar', $permissao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Permissões.Editar')
              <a href="{{ route('acl.permissoes.editar', $permissao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan
            
          </div>
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
