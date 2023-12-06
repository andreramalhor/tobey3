@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Comissões</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <form action="{{ route('relatorio.comissoes') }}" method="POST" autocomplete="off">
            {!! csrf_field() !!}
              <div class="input-group">
                {{-- @dd(\Carbon\Carbon::today()->year) --}}
                <select class="form-control form-control-sm" name="ano">
                  <option value='2015' @if(isset($ano) && $ano == '2015' ) selected @elseif( !isset($ano) && 2015 == \Carbon\Carbon::today()->year ) selected @endif > 2015</option>
                  <option value='2016' @if(isset($ano) && $ano == '2016' ) selected @elseif( !isset($ano) && 2016 == \Carbon\Carbon::today()->year ) selected @endif > 2016</option>
                  <option value='2017' @if(isset($ano) && $ano == '2017' ) selected @elseif( !isset($ano) && 2017 == \Carbon\Carbon::today()->year ) selected @endif > 2017</option>
                  <option value='2018' @if(isset($ano) && $ano == '2018' ) selected @elseif( !isset($ano) && 2018 == \Carbon\Carbon::today()->year ) selected @endif > 2018</option>
                  <option value='2019' @if(isset($ano) && $ano == '2019' ) selected @elseif( !isset($ano) && 2019 == \Carbon\Carbon::today()->year ) selected @endif > 2019</option>
                  <option value='2020' @if(isset($ano) && $ano == '2020' ) selected @elseif( !isset($ano) && 2020 == \Carbon\Carbon::today()->year ) selected @endif > 2020</option>
                  <option value='2021' @if(isset($ano) && $ano == '2021' ) selected @elseif( !isset($ano) && 2021 == \Carbon\Carbon::today()->year ) selected @endif > 2021</option>
                  <option value='2022' @if(isset($ano) && $ano == '2022' ) selected @elseif( !isset($ano) && 2022 == \Carbon\Carbon::today()->year ) selected @endif > 2022</option>
                  <option value='2023' @if(isset($ano) && $ano == '2023' ) selected @elseif( !isset($ano) && 2023 == \Carbon\Carbon::today()->year ) selected @endif > 2023</option>
                  <option value='2024' @if(isset($ano) && $ano == '2024' ) selected @elseif( !isset($ano) && 2024 == \Carbon\Carbon::today()->year ) selected @endif > 2024</option>
                  <option value='2025' @if(isset($ano) && $ano == '2025' ) selected @elseif( !isset($ano) && 2025 == \Carbon\Carbon::today()->year ) selected @endif > 2025</option>
                  <option value='2026' @if(isset($ano) && $ano == '2026' ) selected @elseif( !isset($ano) && 2026 == \Carbon\Carbon::today()->year ) selected @endif > 2026</option>
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
              <th class="text-left">Profissional</th>
              <th class="text-right" width="8%">Jan</th>
              <th class="text-right" width="8%">Fev</th>
              <th class="text-right" width="8%">Mar</th>
              <th class="text-right" width="8%">Abr</th>
              <th class="text-right" width="8%">Mai</th>
              <th class="text-right" width="8%">Jun</th>
              <th class="text-right" width="8%">Jul</th>
              <th class="text-right" width="8%">Ago</th>
              <th class="text-right" width="8%">Set</th>
              <th class="text-right" width="8%">Out</th>
              <th class="text-right" width="8%">Nov</th>
              <th class="text-right" width="8%">Dez</th>
              <th class="text-right" width="8%">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comissoes->groupby('id_pessoa') as $profissional => $comissao)
              <tr>
                <td>{{ $comissao->first()->xeypqgkmimzvknq->apelido }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%">{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</td>
                <td class="text-right" width="8%"><b>{{ number_format( $comissoes->where('id_pessoa', '=', $profissional)->sum('valor'), 2, ',', '.') }}</b></td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Total</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 1)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 2)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 3)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 4)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 5)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 6)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 7)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 8)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 9)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 10)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 11)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%">{{ number_format( $comissoes->where('month', '=', 12)->sum('valor'), 2, ',', '.') }}</th>
              <th class="text-right" width="8%"><b>{{ number_format( $comissoes->sum('valor'), 2, ',', '.') }}</b></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
