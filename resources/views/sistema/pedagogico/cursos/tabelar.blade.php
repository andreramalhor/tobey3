<div class="card-body table-responsive p-0" id="card-cursos">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-cursos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">Cod</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Sigla</th>
        <th class="text-nowrap text-center">Duração<br><small>(horas)</small></th>
        <th class="text-nowrap text-center">Tipo<br>curso</th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($cursos as $curso)
        @if( isset($curso->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $curso->cod }}</td>
          <td class="text-nowrap">{{ $curso->nome }}</td>
          <td class="text-nowrap text-center">{{ $curso->sigla }}</td>
          <td class="text-nowrap text-center">{{ $curso->duracao }}</td>
          <td class="text-nowrap text-center">{{ $curso->tipo_curso }}</td>
          <td class="text-nowrap text-center">{!! $curso->status !!}</td>

          <td class="text-nowrap text-center">
            @can('Cursos.Detalhes')
              <a href="{{ route('ped.cursos.mostrar', $curso) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Cursos.Editar')
              <a href="{{ route('ped.cursos.editar', $curso) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Cursos.Excluir')
              @if($curso->deleted_at == null)
                <a onClick="cursos_excluir({{$curso->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onClick="cursos_restaurar({{$curso->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
              @endif
            @endcan
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="7">Não há resultados.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $cursos->appends($dataForm)->links() }}
    @else
    {{ $cursos->links() }}
    @endif
  </div>
</div>
