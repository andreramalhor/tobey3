@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Notas Fiscais</h3>
        <div class="card-tools">
          <div class="form-group" style="margin-bottom: 0px">
            <form action="{{ route('relatorio.nf_cartoes') }}" method="POST" autocomplete="off">
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
        <table class="table table-sm table-head-fixed text-nowrap no-padding">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Data</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">CPF</th>
              <th class="text-left"># Pessoa</th>
              <th class="text-left">Nome Cliente</th>
              <th class="text-right">Valor Total</th>
              <th class="text-left">Serviços</th>
              <th class="text-left">Pagamentos</th>
            </tr>
          </thead>
          <tbody style="font-size: 13px;">
            @foreach($vendas->sortBy('id') as $venda)
            <tr>
              <td class="text-center">{{ $loop->index +1 }}</td>
              <td class="text-center">{{ Carbon\Carbon::parse($venda->created_at)->format('d/m/Y') }}</td>
              <td class="text-center">601</td>
              <td class="text-center"
              @if(!isset($venda->lufqzahwwexkxli->cpf))
              style="background: purple;"
              @endif
              >{{ $venda->lufqzahwwexkxli->cpf ?? '' }}</td>
              <td class="text-center">{{ $venda->id_cliente }}</td>
              <td class="text-left">{{ $venda->lufqzahwwexkxli->nome ?? $venda->id_cliente }}</td>
              <td class="text-right">{{ number_format($venda->xzxfrjmgwpgsnta->sum('valor'), 2, ',', '.') }}</td>
              <td class="text-left">
                @foreach($venda->dfyejmfcrkolqjh as $servicos)
                  {{ $servicos->kcvkongmlqeklsl->nome ?? $servicos->id_servprod }} {{ number_format($servicos->vlr_final, 2, ',', '.') }} {{ $loop->last ? '' : '|' }}
                @endforeach
              </td>
              <td class="text-left">
                @foreach($venda->xzxfrjmgwpgsnta as $pagamento)
                  R$ {{ number_format($pagamento->valor, 2, ',', '.') }} - {{ $pagamento->qmbnkthuczqdsdn->forma }} - {{ $pagamento->qmbnkthuczqdsdn->bandeira }}</br>
                @endforeach
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
      </div>
    </div>
  </div>
</div>
@endsection
