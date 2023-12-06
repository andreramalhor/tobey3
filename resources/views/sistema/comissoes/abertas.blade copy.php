@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class='card card-primary'>
      <div class='card-header'>
        <h3 class='card-title'>Vendas</h3>
      </div>
      <div class='card-body p-0'>
        <table class='table table-sm table-hover no-padding table-valign-middle'>
          <thead class='table-dark'>
            <tr>
              <th width="8%" class='text-left'>Data Prevista</th>
              <th width="3%" class='text-center'>#</th>
              <th width="13%" class='text-left'>Tipo</th>
              <th width="19%" class='text-center'># Comanda</th>
              <th width="10%" class='text-left'>Data da Comanda</th>
              <th width="11%" class='text-left'>Cliente</th>
              <th width="15%" class='text-left'>Serv./Produto</th>
              <th width="6%" class='text-center'>% Comissão</th>
              <th width="7%" class='text-right'>Vlr. Commissão</th>
              <th width="8%" class='text-right'>Saldo</th>
            </tr>
          </thead>
          <tbody>
            @php
              $saldo = 0;
            @endphp
            @forelse($abertas->sortBy('dt_prevista')->groupby('dt_prevista') as $dt_prevista => $comissoes)
              @if($comissoes->count() != 0)
              <tr data-widget='expandable-table' aria-expanded='true' style='background-color: ghostwhite;' >
                <td colspan="1" class="text-left"><i class='expandable-table-caret fas fa-caret-right fa-fw'></i> {{ \Carbon\Carbon::parse($dt_prevista)->format('d/m/Y') }}</td>
                <td colspan="7" class="text-right"></td>
                <td colspan="1" class="text-right">{{ number_format( $comissoes->sum('valor'), 2, ',', '.') }}</td>
                <td colspan="1" class="text-right">{{ number_format( $comissoes->sum('valor') + $saldo, 2, ',', '.') }}</td>
              </tr>
              <tr class='expandable-body'>
                <td colspan='10'>
                  <div class='p-0'>
                    <table class='table table-hover m-0' style="width: -webkit-fill-available;">
                      <tbody>
                        @foreach($comissoes->sortBy('dt_prevista') as $aberta)
                          @if($aberta->valor != 0)
                          <tr data-widget='expandable-table'>
                            <td width="8%" class='text-left p-0 border-0'></td>
                            <td width="3%" class='text-center p-0 border-0'>{{ $aberta->id }}</td>
                            <td width="13%" class='text-left p-0 border-0'>{{ $aberta->tipo == 'Fiado' ? 'Serviço' : $aberta->tipo }}</td>
  
                            @if($aberta->fonte_origem == 'pdv_vendas_pagamentos' )
                              <td width="19%" class='text-center p-0 border-0'><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $aberta->sflfmensjwleneb->id_venda ?? 'ERROR 562542' }})"><span class="badge bg-primary">{{ $aberta->sflfmensjwleneb->id_venda ?? 'ERROR 562542' }}</span></td>
                            @elseif($aberta->fonte_origem == 'pdv_vendas_detalhes' )
                              <td width="19%" class='text-center p-0 border-0'><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $aberta->skfmwuorwmlpdlm->id ?? 'ERROR 562542' }})"><span class="badge bg-pink">{{ $aberta->skfmwuorwmlpdlm->id ?? 'ERROR 562542' }}</span></td>
                            @elseif($aberta->fonte_origem == 'fin_lancamentos' )
                              <td width="19%" class='text-center p-0 border-0'> - </td>
                            @elseif($aberta->fonte_origem == 'fin_conta_interna' )
                              <td width="19%" class='text-center p-0 border-0'>{{ $aberta->tipo }}</td>
                            @else
                              <td width="19%" class='text-center p-0 border-0'>{{ $aberta->tipo }}</td>
                            @endif
  
                            <td width="10%" class='text-left p-0 border-0'>{{ \Carbon\Carbon::parse($aberta->created_at)->format('d/m/Y H:i') }}</td>
  
                            @if($aberta->fonte_origem == 'pdv_vendas_pagamentos' )
                              <td width="11%" class='text-center p-0 border-0'>{{ $aberta->tipo }}</td>
                            @elseif($aberta->fonte_origem == 'pdv_vendas_detalhes' )
                              <td width="11%" class='text-left p-0 border-0'>{{ $aberta->skfmwuorwmlpdlm->lufqzahwwexkxli->apelido ?? $aberta->skfmwuorwmlpdlm->id_cliente  ?? $aberta->id_origem ?? 'ERROR 256635' }}</td>
                            @elseif($aberta->fonte_origem == 'fin_lancamentos' )
                            <td width="11%" class='text-left p-0 border-0'> - </td>
                            @elseif($aberta->fonte_origem == 'fin_conta_interna' )
                            <td width="11%" class='text-left p-0 border-0'>{{ $aberta->fonte_origem }}</td>
                            @else
                              <td width="11%" class='text-left p-0 border-0'> - </td>
                            @endif
  
                            @if($aberta->fonte_origem == 'pdv_vendas_pagamentos' )
                              @if(isset($aberta->sflfmensjwleneb->yshghlsawerrgvd->dfyejmfcrkolqjh))
                                <td width="15%" class='text-left p-0 border-0'>
                                @foreach($aberta->sflfmensjwleneb->yshghlsawerrgvd->dfyejmfcrkolqjh as $detalhe)
                                  {{ $detalhe->kcvkongmlqeklsl->nome ?? 'Erro 431.241'}}</br>
                                @endforeach
                                </td>
                              @else
                                {{ 'Erro 524.477'}} <br>
                              @endif
                            @elseif($aberta->fonte_origem == 'pdv_vendas_detalhes' )
                            <td width="15%" class='text-left p-0 border-0'>{{ $aberta->ygferchrtuwewhq->nome ?? $aberta->id_origem ?? 'ERROR 745214' }}</td>
                            @elseif($aberta->fonte_origem == 'fin_lancamentos' )
                            <td width="15%" class='text-left p-0 border-0'>{{ $aberta->tipo }}</td>
                            @elseif($aberta->fonte_origem == 'fin_conta_interna' )
                            <td width="15%" class='text-left p-0 border-0'>{{ $aberta->fonte_origem }}</td>
                            @else
                              <td width="15%" class='text-left p-0 border-0'> - </td>
                            @endif
  
                            <td width="6%" class='text-center p-0 border-0'>{{ number_format( $aberta->percentual * 100, 1, ',', '.') }} %</td>
  
                            <td width="7%" class='text-right p-0 border-0'>{{ number_format( $aberta->valor, 2, ',', '.') }}</td>
                            @php
                              $saldo = $saldo + $aberta->valor;      
                            @endphp    
                            <td width="8%" class='text-right py-0 px-2 border-0'>{{ number_format( $saldo, 2, ',', '.') }}</td>
                          </tr>
  
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </td>
              </tr>
              @endif
            @empty
            <tr>
              <td class='text-center' colspan='10'>Não há pagamentos registrados.</td>
            </tr>
            @endforelse
          </tbody>
          <tfoot>
            <tr>
              <th class='text-right' colspan='10'>{{ number_format( $abertas->sum('valor'), 2, ',', '.') }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

<!-- 
@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    comissoes_tabelar_abert_prof();
  });

  function comissoes_tabelar_abert_prof(page)
  {
    $('#overlay-comissoes').show();
  
    var url = "{{ route('fin.comissoes.abert_prof') }}";

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#comissoes-abert_prof').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '2016683a' ] )
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  function comissoes_excluir(id)
  {
    $('#overlay-comissoes').show();

    var url = "{{ route('fin.comissoes.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '8987689a' ] )
    .then( function(response)
    {
      comissoes_tabelar_abert_prof()
    })
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  function comissoes_restaurar(id)
  {
    $('#overlay-comissoes').show();

    var url = "{{ route('fin.comissoes.restaurar', ':id') }}";
    var url = url.replace(':id', id);
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '312497a' ] )
    .then( function(response)
    {
      comissoes_tabelar_abert_prof()
    })
    .then( function(response)
    {
      $('#overlay-comissoes').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection -->
