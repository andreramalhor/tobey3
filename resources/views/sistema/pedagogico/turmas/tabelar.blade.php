<div class="card-body table-responsive p-0" id="card-turmas">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-turmas">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">Cod</th>
        <th class="text-nowrap text-center">Sigla</th>
        <th class="text-nowrap text-center">Curso</th>
        <th class="text-nowrap text-center">Data<br>início</th>
        <th class="text-nowrap text-center">Data<br>final</th>
        <th class="text-nowrap text-center">Dia da<br>semana</th>
        <th class="text-nowrap text-center">Horário</th>
        <th class="text-nowrap text-center">Sala</th>
        <th class="text-nowrap text-center">Máximo de<br>aluno</th>
        <th class="text-nowrap text-center">Instrutor</th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($turmas as $turma)
        @if( isset($turma->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $turma->cod }}</td>
          <td class="text-nowrap text-center">{{ $turma->sigla }}</td>
          <td class="text-nowrap">{{ $turma->cbntdakklaoyfih->nome ?? $turma->id_curso }}</td>
          <td class="text-nowrap text-center">{{ \Carbon\Carbon::parse($turma->dt_inicio)->format('d/m/Y') }}</td>
          <td class="text-nowrap text-center">{{ \Carbon\Carbon::parse($turma->dt_final)->format('d/m/Y') }}</td>
          <td class="text-nowrap text-center">{{ $turma->dia_semana }}</td>
          <td class="text-nowrap text-center">{{ $turma->horario }}</td>
          <td class="text-nowrap text-center">{{ $turma->sala }}</td>
          <td class="text-nowrap text-center">{{ $turma->max_alunos }}</td>
          <td class="text-nowrap">{{ $turma->sfhqwlkqwqwdlhk->apelido ?? $turma->id_instrutor }}</td>
          <td class="text-nowrap text-center">{!! $turma->status !!}</td>
          <td class="text-nowrap text-center">
            @can('Turmas.Visualizar')
              <a href="{{ route('ped.turmas.mostrar', $turma->cod) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Turmas.Editar')
              <a href="{{ route('ped.turmas.editar', $turma->cod) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Turmas.Excluir')
              @if($turma->deleted_at == null)
                <a onClick="turmas_excluir({{$turma->cod}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onClick="turmas_restaurar({{$turma->cod}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
              @endif
            @endcan
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="12">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $turmas->appends($dataForm)->links() }}
    @else
    {{ $turmas->links() }}
    @endif
  </div>
</div>
