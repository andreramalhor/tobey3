<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-produtos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap text-center">#</th>
        <th class="text-nowrap text-center">Foto</th>
        <th class="text-nowrap text-center">Categoria</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Marca</th>
        <th class="text-nowrap text-right">Valor<br>Custo</th>
        <th class="text-nowrap text-right">Valor<br>Venda</th>
        <th class="text-nowrap text-center">Estoque<br>Min | Máx | Atual</th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($comissoes as $comissoao)
        @if(isset($comissoao->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap text-center">{{ $comissoao->id }}</td>
          <td class="text-nowrap text-center">{!! $comissoao->imagem_servprod !!}</td>
          <td class="text-nowrap text-center">{{ $comissoao->ecgklyqfdcoguyj->nome ?? ($comissoao->id_categoria != 0 ? $comissoao->id_categoria : 'Não categorizado') }}</td>
          <td class="text-nowrap">{{ $comissoao->nome }}</td>
          <td class="text-nowrap text-center">{{ $comissoao->marca }}</td>
          <td class="text-nowrap text-right">{{ number_format($comissoao->vlr_custo, 2, ',', '.') }}</td>
          <td class="text-nowrap text-right">{{ number_format($comissoao->vlr_venda, 2, ',', '.') }}</td>
          <td class="text-nowrap text-center">{{ $comissoao->estoque_min }} | {{ $comissoao->estoque_max }} | {{ $comissoao->estoque_atual }}</td>
          <td class="text-nowrap text-center">{{ $comissoao->ativo }}</td>
          <td class="text-nowrap text-center">
            @can('Financeiro.Visualizar')
              <a href="{{ route('cat.servprod.mostrar', $comissoao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Financeiro.Editar')
              <a href="{{ route('cat.servprod.editar', $comissoao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan
            
            @can('Financeiro.Excluir')
              @if($comissoao->deleted_at == null)
                <a onClick="produtos_excluir({{$comissoao->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onClick="produtos_restaurar({{$comissoao->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
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
    {{ $comissoes->appends($dataForm)->links() }}
    @else
    {{ $comissoes->links() }}
    @endif
  </div>
</div>
