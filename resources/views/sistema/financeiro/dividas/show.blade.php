@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">ID: {{ $divida->id }}</h3>
      </div>
      <div class="card-body">
        <p style="padding: 0px !important;">
          <label style="padding: 0px !important;">Cliente</label>
          <h5 style="padding: 0px !important;">
            {{ $divida->id_cliente }}
          </h5>
        </p>
        </br></br>
        <p style="padding: 0px !important;">
          <label style="padding: 0px !important;">Obervação</label>
          <h6 style="padding: 0px !important;">
            {{ $divida->observacao }}
          </h6>
        </p>  
        </br></br>
        <p style="padding: 0px !important;">
          <label style="padding: 0px !important;">Criado Em</label>
          <h6 style="padding: 0px !important;">
            {{ \Carbon\Carbon::parse($divida->created_at)->format('d/m/Y') }}
          </h6>
        </p>  
        </br></br>
        <p style="padding: 0px !important;">
          <label style="padding: 0px !important;">Criado Por</label>
          <h6 style="padding: 0px !important;">
            Usuário: {{ $divida->criado_por }}
          </h6>
        </p>  
      </div>
      <div class="card-footer">
        <a href="{{ route('dividas.index') }}" class="btn btn-default btn-sm">Voltar</a>
      </div>
    </div>
  </div>
</div>
@endsection
