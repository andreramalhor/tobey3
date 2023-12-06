<table class="table table-striped projects table-sm no-padding table-valign-middle">
  <thead class="table-dark">
    <tr>
      <th class="text-nowrap text-center">#</th>
      <th class="text-nowrap text-center">Foto</th>
      <th class="text-nowrap">Nome</th>
      <th class="text-nowrap">e-Mail</th>
      <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($usuarios as $usuario)
    <tr>
      <td class="text-center">{{ $usuario->id }}</td>
      <td class="text-center">
        <img src="{{ $usuario->foto_perfil }}" alt="{{ $usuario->nome }}" class="img-circle img-size-32 mr-2" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
      </td>
      <td>{{ $usuario->nome }}</td>
      <td>{{ $usuario->email }}</td>
      <td class="text-center">
        @can('Funções.Excluir')
          <a onClick="funcoes_usuario_remover({{$usuario->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
        @endcan
      </td>
    </tr>
    @endforeach
  </tbody>
</table>