@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista Geral de Caixas</h3>
        <div class="card-tools">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('caixa.create') }}" ><i class="fas fa-cash-register fa-fw"></i></a>
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter fa-fw"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th width="20px" class="text-center">#</th>
              <th>Local</th>
              <th>Usuário</th>
              <th>Abertura</th>
              <th>Fechamento</th>
              <th>Validação</th>
              <th class="text-right">Saldo Aberura</th>
              <th class="text-right">Saldo Fechamento</th>
              <th class="text-center">Status</th>
              <th width="50px"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            @foreach($caixas as $caixa)
            <tr>
              <td class="text-center">{{ $caixa->id }}</td>
              <td>{{ $caixa->rybeyykhpcgwkgr->nome ?? 'ERRO INDEX CAIXA 1' }}</td>
              <td>{{ isset($caixa->kpakdkhqowIqzik->nome) ? $caixa->kpakdkhqowIqzik->apelido : $caixa->id_usuario_abertura }}</td>
              <td>{{ \Carbon\Carbon::parse($caixa->dt_abertura)->format('d/m/Y H:i') }}</td>
              <td>{{ isset($caixa->dt_fechamento) ? \Carbon\Carbon::parse($caixa->dt_fechamento)->format('d/m/Y H:i') : '' }}</td>
              <td>{{ isset($caixa->dt_validacao) ? \Carbon\Carbon::parse($caixa->dt_validacao)->format('d/m/Y H:i') : '' }}</td>
              <td class="text-right">{{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</td>
              <td class="text-right">{{ number_format($caixa->vlr_fechamento, 2, ',', '.') }}</td>
              <td class="text-center">
                <span class="badge badge-{{ $caixa->cor_status }}">{{ $caixa->status }}</span>
              </td>
              <td class="text-left">
                <div class="btn-group">
                  <a href="{{ route('pdv.caixas.mostrar', $caixa->id) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fas fa-search fa-fw"></i></a>
                </div>




                <div class="btn-group">
                
                @if ($caixa->id_usuario_abertura == Auth::User()->id && $caixa->status == 'Aberto')
                  <a href="{{ route('caixa.close', $caixa->id) }}" class="btn btn-info btn-xs" data-bs-tooltip="tooltip" data-bs-title="Fechar" data-original-title="Fechar"><i class="fas fa-lock fa-fw"></i></a>
                @endif
                
                @if ( $caixa->status != 'Validado' &&
                    $caixa->status != 'Aberto' &&
                    \Carbon\Carbon::parse($caixa->dt_abertura)->isSameDay(\Carbon\Carbon::now()) &&
                    $caixa->id_usuario_abertura == Auth::User()->id )
                  <a href="{{ route('caixa.reopen', $caixa->id) }}" class="btn btn-warning btn-xs" data-bs-tooltip="tooltip" data-bs-title="Reabrir" data-original-title="Reabrir"><i class="fas fa-unlock-alt fa-fw"></i></a>
                  <a href="{{ route('pdv.caixas.confirmar', $caixa->id) }}" class="btn btn-success btn-xs" data-bs-tooltip="tooltip" data-bs-title="Validar" data-original-title="Validar"><i class="fas fa-lock fa-fw"></i></a>
                @endif
                
                @if ($caixa->status != 'Validado' && $caixa->status != 'Aberto')
                  @can('Validar.Caixas')
                    <a href="{{ route('pdv.caixas.confirmar', $caixa->id) }}" class="btn btn-success btn-xs" data-bs-tooltip="tooltip" data-bs-title="Validar" data-original-title="Validar"><i class="fas fa-pen-nib fa-fw"></i></a>
                  @endcan
                @endif
                
                </div>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          @if(isset($dataForm))
          {{ $caixas->appends($dataForm)->links() }}
          @else
          {{ $caixas->links() }}
          @endif
        </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@stop
