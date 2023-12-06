@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
{{-- 
      <div class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
 --}}
      <div class="card-header">
        <h3 class="card-title">Lista Geral de agendamentos</h3>

        {{-- <div class="card-tools">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('pessoa.create') }}" ><i class="fas fa-plus"></i></a>
            <a class="btn btn-sm btn-default"><i class="fas fa-filter"></i></a>
          </div>
        </div> --}}

      </div>
      <div class="card-body table-responsive p-0">
      {{-- <div class="card-body table-responsive p-0" style="height: 480px;"> --}}
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="agendamento-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">start</th>
              <th class="text-center">id_cliente</th>
              <th class="text-center">titulo</th>
              <th class="text-center">id_profexec</th>
              <th class="text-center">id_servprod</th>
              <th class="text-center">id_comanda</th>
              <th class="text-center">valor</th>
              <th class="text-center">id_criador</th>
              <th class="text-center">obs</th>
              <th class="text-center">status</th>
              <th><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            @forelse($agendamentos as $agendamento)
            <tr>
              <td>{{ $agendamento->id }}</td>
              <td>{{ $agendamento->start }}</td>
              <td>{{ $agendamento->kdfalsjdlkCLIENTEasjdlaskjdlkasjd->apelido ?? $agendamento->id_cliente }}</td>
              <td>{{ $agendamento->title }}</td>
              <td>{{ $agendamento->kdfalsjdlkPROFISSIONALasjdlaskjdlkasjd->apelido ?? $agendamento->id_profexec }}</td>
              <td>{{ $agendamento->kdfalsjdlkSERVICOPRODUTOasjdlaskjdlkasjd->nome ?? $agendamento->id_servprod }}</td>
              <td>{{ $agendamento->id_comanda }}</td>
              <td>{{ $agendamento->valor }}</td>
              <td>{{ $agendamento->id_criador }}</td>
              <td>{{ $agendamento->obs }}</td>
              <td>{{ $agendamento->status }}</td>
              <td>...</td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="8">Ainda não há agendamentos cadastrados.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right">
          @if(isset($dataForm))
          {{ $agendamentos->appends($dataForm)->links() }}
          @else
          {{ $agendamentos->links() }}
          @endif
        </div>
      </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
