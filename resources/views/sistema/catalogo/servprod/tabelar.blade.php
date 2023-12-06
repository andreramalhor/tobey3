<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-servprod">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap text-center">#</th>
        @if($tipo != 'servicos')
          <th class="text-nowrap text-center">Foto</th>
        @endif
        <th class="text-nowrap text-center">Categoria</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">Marca</th>
        <th class="text-nowrap text-right">Valor<br>Custo</th>
        <th class="text-nowrap text-right">Valor<br>Venda</th>
        @if($tipo == 'produtos')
          <th class="text-nowrap text-center">Estoque<br>Min | Máx | Atual</th>
        @else
          <th class="text-nowrap text-center">Duração</th>
        @endif
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($servsprods as $servprod)
        @if(isset($servprod->deleted_at))
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap text-center">{{ $servprod->id }}</td>
          @if($tipo != 'servicos')
            <td class="text-nowrap text-center">{!! $servprod->imagem_servprod !!}</td>
          @endif
          <td class="text-nowrap text-center">{{ $servprod->ecgklyqfdcoguyj->nome ?? ($servprod->id_categoria != 0 ? $servprod->id_categoria : 'Não categorizado') }}</td>
          <td class="text-nowrap">{{ $servprod->nome }}</td>
          <td class="text-nowrap text-center">{{ $servprod->marca }}</td>
          <td class="text-nowrap text-right">{{ number_format($servprod->vlr_custo, 2, ',', '.') }}</td>
          <td class="text-nowrap text-right">{{ number_format($servprod->vlr_venda, 2, ',', '.') }}</td>
          @if($tipo == 'produtos')
            <td class="text-nowrap text-center">{{ $servprod->estoque_min }} | {{ $servprod->estoque_max }} | {{ $servprod->estoque_atual }}</td>
          @else
            <td class="text-nowrap text-center">{{ $servprod->duracao }}</td>
          @endif
          <td class="text-nowrap text-center">{{ $servprod->ativo }}</td>
          <td class="text-nowrap text-center">
            @can($servprod->tipo.'s.Visualizar')
              <a href="{{ route('cat.servprod.mostrar', [ $tipo, 'id'=> $servprod->id ]) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can($servprod->tipo.'s.Editar')
              <a href="{{ route('cat.servprod.editar', [ $tipo, $servprod->id ]) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan
            
            @can($servprod->tipo.'s.Excluir')
              @if($servprod->deleted_at == null)
                <a onclick="servprod_excluir('{{ $tipo }}', {{ $servprod->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir" style="cursor: pointer;"><i class="fa-solid fa-trash"></i></a>
              @else
                <a onclick="servprod_restaurar('{{ $tipo }}', {{ $servprod->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar" style="cursor: pointer;"><i class="fa-solid fa-recycle"></i></a>
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
    {{ $servsprods->appends($dataForm)->links() }}
    @else
    {{ $servsprods->links() }}
    @endif
  </div>
</div>

<script>
function servprod_excluir(tipo, id)
{
  $('#overlay-servprod').show();

  var url = "{{ route('cat.servprod.excluir', [':tipo', ':id']) }}";
  var url = url.replace(':tipo', tipo);
  var url = url.replace(':id', id);

  axios.delete(url)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '8370016a' ] )
  .then( function(response)
  {
    servprod_tabelar()
  })
  .then( function(response)
  {
    $('#overlay-servprod').hide();
  })
}

function servprod_restaurar(tipo, id)
{
  $('#overlay-servprod').show();

  var url = "{{ route('cat.servprod.restaurar', [':tipo', ':id']) }}";
  var url = url.replace(':tipo', tipo);
  var url = url.replace(':id', id);
  
  axios.post(url)
  .then(function(response)
  {
    // console.log(response.data)
    toastrjs(response.data.type, response.data.message)
  })
@include('includes.catch', [ 'codigo_erro' => '6634789a' ] )
  .then( function(response)
  {
    servprod_tabelar()
  })
  .then( function(response)
  {
    $('#overlay-servprod').hide();
  })
}
</script>