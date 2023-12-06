@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Relatório: Último agendamento de cada cliente</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Cliente</th>
              <th class="text-center">Último agendamento</th>
              <th class="text-center">Dias sem vir</th>
            </tr>
          </thead>
          <tbody>
            @foreach($clientes as $cliente)
            <tr>
              <td class="text-center">{{ $cliente->id_cliente }}</td>
              <td class="text-left">{{ $cliente->xhooqvzhbgojbtg->apelido }}</td>
              <td class="text-center">{{ \Carbon\Carbon::parse( $cliente->agd_start )->format('d/m/Y') }}</td>
              <td class="text-center">{{ \Carbon\Carbon::parse( $cliente->agd_start )->diffInDays( \Carbon\Carbon::today()->endOfDay() ) }}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          {{ $clientes->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
console.log()
</script>
@endsection
