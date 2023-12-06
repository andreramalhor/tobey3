<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-servicos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap text-center">#</th>
        <th class="text-nowrap text-center">Foto</th>
        <th class="text-nowrap text-center">Categoria</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Marca</th>
        <th class="text-nowrap text-right">Valor<br>Custo</th>
        <th class="text-nowrap text-right">Valor<br>Venda</th>
        <th class="text-nowrap text-center">Duração</th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($servicos as $servico)
        @if(isset($servico->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap text-center">{{ $servico->id }}</td>
          <td class="text-nowrap text-center">{!! $servico->imagem_servprod !!}</td>
          <td class="text-nowrap text-center">{{ $servico->ecgklyqfdcoguyj->nome ?? ($servico->id_categoria != 0 ? $servico->id_categoria : 'Não categorizado') }}</td>
          <td class="text-nowrap">{{ $servico->nome }}</td>
          <td class="text-nowrap text-center">{{ $servico->marca }}</td>
          <td class="text-nowrap text-right">{{ number_format($servico->vlr_custo, 2, ',', '.') }}</td>
          <td class="text-nowrap text-right">{{ number_format($servico->vlr_venda, 2, ',', '.') }}</td>
          <td class="text-nowrap text-center">{{ $servico->duracao }}</td>
          <td class="text-nowrap text-center">{{ $servico->ativo }}</td>
          <td class="text-nowrap text-center">
            @can('Serviços.Visualizar')
              <a href="{{ route('cat.servicos.mostrar', $servico) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Serviços.Editar')
              <a href="{{ route('cat.servicos.editar', $servico) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan
            
            @can('Serviços.Excluir')
              @if($servico->deleted_at == null)
                <a onClick="servicos_excluir({{$servico->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onClick="servicos_restaurar({{$servico->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
              @endif
            @endcan
          </td>
        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="10">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $servicos->appends($dataForm)->links() }}
    @else
    {{ $servicos->links() }}
    @endif
  </div>
</div>
