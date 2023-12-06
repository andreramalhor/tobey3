@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Dívidas</h3>
        @can('Permissões.Criar')
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('dividas.create') }}"><i class="fas fa-plus" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        @endcan
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-dividas">
          <thead class="table-dark">
            <tr>
              <th class="text-nowrap">#</th>
              <th class="text-nowrap">Nome</th>
              <th class="text-nowrap text-left">Observação</th>
              <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            @forelse($dividas as $divida)
              @if( isset($divida->deleted_at) )
                <tr class="table-danger">
              @else
                <tr>
              @endif
                <td class="text-nowrap">{{ $divida->id }}</td>
                <td class="text-nowrap">{{ $divida->id_cliente }}</td>
                <td class="text-nowrap">{{ $divida->observacao ?? '' }}</td>
                <td class="text-nowrap text-center">
                    @can('Dívidas.Detalhes')
                      <a href="{{ route('dividas.show', $divida) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
                    @endcan

                    @can('Dívidas.Editar')
                      <a href="{{ route('dividas.edit', $divida) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
                      @endcan
                      
                      @can('Dívidas.Excluir')
                      @if($divida->deleted_at == null)

                      <a onClick="document.getElementById('deletar_{{ $divida->id }}').submit();" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                      <form action="{{ route('dividas.destroy', $divida) }}" id="deletar_{{ $divida->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                      </form>
                        <!-- <a onClick="dividas_excluir({{$divida->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a> -->
                      @else
                        <!-- <a onClick="dividas_restaurar({{$divida->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a> -->
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
    </div>
  </div>
</div>
@endsection
