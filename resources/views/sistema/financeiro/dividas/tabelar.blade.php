<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-bancos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Conta</th>
        <th>Saldo Atual</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($bancos as $banco)
        @if( isset($banco->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $banco->id }}</td>
          <td class="text-nowrap">{{ $banco->nome }}</td>
          <td class="text-nowrap">{{ $banco->conta ?? '' }}</td>
          <td class="text-nowrap text-right">{{ $banco->saldo_atual ?? 'R$ 0,00' }}</td>
          <td class="text-nowrap text-center">
              @can('Bancos.Detalhes')
                <a href="{{ route('fin.bancos.mostrar', $banco) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
              @endcan

              @can('Bancos.Editar')
                <a href="{{ route('fin.bancos.editar', $banco) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan
              
              @can('Bancos.Excluir')
                @if($banco->deleted_at == null)
                  <a onClick="bancos_excluir({{$banco->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                @else
                  <a onClick="bancos_restaurar({{$banco->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
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
