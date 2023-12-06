<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-usuarios">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap text-center">#</th>
        <th class="text-nowrap"></th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap">e-Mail</th>
        <th class="text-nowrap text-center">Username</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($usuarios as $usuario)
        <tr>
          <td class="text-nowrap text-center">{{ $usuario->id }}</td>
          <td class="text-nowrap">{!! $usuario->foto_tabela !!}</td>
          <td class="text-nowrap">{{ $usuario->nome }}</td>
          <td class="text-nowrap">{{ $usuario->email }}</td>
          <td class="text-nowrap text-center">{{ $usuario->username }}</td>
          <td class="text-nowrap text-center">
            <a href="{{ route('acl.usuarios.mostrar', $usuario) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @if($usuario->id != 2)
              @can('Usuários.Editar')
                <a href="{{ route('acl.usuarios.editar', $usuario) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan

              @can('Usuários.Excluir')
                <a onClick="usuarios_remover({{$usuario->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
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
