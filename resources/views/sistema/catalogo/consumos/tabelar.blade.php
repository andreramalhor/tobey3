<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-funcoes">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Slug</th>
        <th>Descrição</th>
        <th class="text-nowrap text-center">Usuários</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($produtos as $produto)
        @if( isset($produto->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $produto->id }}</td>
          <td class="text-nowrap">{{ $produto->nome }}</td>
          <td class="text-nowrap text-center">{{ $produto->slug }}</td>
          <td class="">{{ $produto->descricao }}</td>
          <td class="text-nowrap">
            <ul class="list-inline">
              @if(isset($produto->znufwevbqgruklz[0]))
              <li class="list-inline-item">
                <img src="{{ $produto->znufwevbqgruklz[0]->foto_perfil }}" alt="{{ $produto->znufwevbqgruklz[0]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
              </li>
              @endif
              @if(isset($produto->znufwevbqgruklz[1]))
              <li class="list-inline-item">
                <img src="{{ $produto->znufwevbqgruklz[1]->foto_perfil }}" alt="{{ $produto->znufwevbqgruklz[1]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
              </li>
              @endif
              @if(isset($produto->znufwevbqgruklz[2]))
              <li class="list-inline-item">
                <img src="{{ $produto->znufwevbqgruklz[2]->foto_perfil }}" alt="{{ $produto->znufwevbqgruklz[2]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
              </li>
              @endif
              @if(isset($produto->znufwevbqgruklz[3]))
              <li class="list-inline-item">
                <img src="{{ $produto->znufwevbqgruklz[3]->foto_perfil }}" alt="{{ $produto->znufwevbqgruklz[3]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
              </li>
              @endif
              @if(isset($produto->znufwevbqgruklz[4]))
              <li class="list-inline-item">
                <img src="{{ $produto->znufwevbqgruklz[4]->foto_perfil }}" alt="{{ $produto->znufwevbqgruklz[4]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
              </li>
              @endif
            </ul>
          </td>

          <td class="text-nowrap text-center">
            @if($produto->id != 1)

              @can('Permissões.Detalhes')
                <a href="{{ route('acl.funcoes.mostrar', $produto) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
              @endcan

              @can('Permissões.Editar')
                <a href="{{ route('acl.funcoes.editar', $produto) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan
              
              @can('Permissões.Excluir')
                <a onClick="funcoes_excluir({{$produto->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
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
