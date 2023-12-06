<div class="card-body table-responsive p-0" id="card-modulos">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-modulos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">Cod</th>
        <th class="text-nowrap">Descrição</th>
        <th class="text-nowrap text-center">Carga<br>horária</th>
        <th class="text-nowrap text-center">Qtd de<br>aulas</th>
        <th class="text-nowrap text-center">id<br>curso</th>
        <th class="text-nowrap text-center">Sigla</th>
        <th class="text-nowrap text-center">Tipo</th>
        <th class="text-nowrap text-center">Valor</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($modulos as $modulo)
        @if( isset($modulo->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $modulo->cod }}</td>
          <td class="text-nowrap">{{ $modulo->descricao }}</td>
          <td class="text-nowrap text-center">{{ $modulo->carga_horaria }}</td>
          <td class="text-nowrap text-center">{{ $modulo->qtd_aulas }}</td>
          <td class="text-nowrap text-center">{{ $modulo->id_curso }}</td>
          <td class="text-nowrap text-center">{{ $modulo->sigla }}</td>
          <td class="text-nowrap text-center">{{ $modulo->tipo }}</td>
          <td class="text-nowrap text-center">{{ $modulo->valor }}</td>
          <td class="text-nowrap text-center">
            @can('Módulos.Visualizar')
              <a href="{{ route('ped.modulos.mostrar', $modulo->cod) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Módulos.Editar')
              <a href="{{ route('ped.modulos.editar', $modulo->cod) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Módulos.Excluir')
              @if($modulo->deleted_at == null)
                <a onClick="modulos_excluir({{$modulo->cod}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onClick="modulos_restaurar({{$modulo->cod}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
              @endif
            @endcan
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="9">Não há resultados.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $modulos->appends($dataForm)->links() }}
    @else
    {{ $modulos->links() }}
    @endif
  </div>
</div>
