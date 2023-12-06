@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista de aniversariantes do Mês</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <form action="{{ route('relatorio.aniversariantes') }}" method="POST" autocomplete="off">
            {!! csrf_field() !!}
              <div class="input-group">
                <select class="form-control form-control-sm" name="dataForm" id="select_mes">
                  <option value="01" @if(isset($dataForm) && $dataForm == '01' ) selected @elseif( 1 == \Carbon\Carbon::today()->month ) selected @endif>Janeiro</option>
                  <option value="02" @if(isset($dataForm) && $dataForm == '02' ) selected @elseif( 2 == \Carbon\Carbon::today()->month ) selected @endif>Fevereiro</option>
                  <option value="03" @if(isset($dataForm) && $dataForm == '03' ) selected @elseif( 3 == \Carbon\Carbon::today()->month ) selected @endif>Março</option>
                  <option value="04" @if(isset($dataForm) && $dataForm == '04' ) selected @elseif( 4 == \Carbon\Carbon::today()->month ) selected @endif>Abril</option>
                  <option value="05" @if(isset($dataForm) && $dataForm == '05' ) selected @elseif( 5 == \Carbon\Carbon::today()->month ) selected @endif>Maio</option>
                  <option value="06" @if(isset($dataForm) && $dataForm == '06' ) selected @elseif( 6 == \Carbon\Carbon::today()->month ) selected @endif>Junho</option>
                  <option value="07" @if(isset($dataForm) && $dataForm == '07' ) selected @elseif( 7 == \Carbon\Carbon::today()->month ) selected @endif>Julho</option>
                  <option value="08" @if(isset($dataForm) && $dataForm == '08' ) selected @elseif( 8 == \Carbon\Carbon::today()->month ) selected @endif>Agosto</option>
                  <option value="09" @if(isset($dataForm) && $dataForm == '09' ) selected @elseif( 9 == \Carbon\Carbon::today()->month ) selected @endif>Setembro</option>
                  <option value="10" @if(isset($dataForm) && $dataForm == '10' ) selected @elseif( 10 == \Carbon\Carbon::today()->month ) selected @endif>Outubro</option>
                  <option value="11" @if(isset($dataForm) && $dataForm == '11' ) selected @elseif( 11 == \Carbon\Carbon::today()->month ) selected @endif>Novembro</option>
                  <option value="12" @if(isset($dataForm) && $dataForm == '12' ) selected @elseif( 12 == \Carbon\Carbon::today()->month ) selected @endif>Dezembro</option>
                </select>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-sm btn-warning">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="servico-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Nome</th>
              <th class="text-left">Apelido</th>
              <th class="text-center">Dt Nascimento</th>
              <th class="text-center">Idade</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pessoas as $pessoa)
            @if(\Carbon\Carbon::parse($pessoa->dt_nascimento)->day == \Carbon\Carbon::today()->day && \Carbon\Carbon::parse($pessoa->dt_nascimento)->month == \Carbon\Carbon::today()->month)
              <tr class="bg-warning">
            @else
              <tr>
            @endif
                <td class="text-center">{{ $pessoa->id }}</td>
                <td class="text-left">{{ $pessoa->nome }}</td>
                <td class="text-left">{{ $pessoa->apelido }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->age }} anos</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          @if(isset($dataForm))
          {{ $pessoas->appends($dataForm)->links() }}
          @else
          {{ $pessoas->links() }}
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
