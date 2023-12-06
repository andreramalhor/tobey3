@extends('layouts.app')

@section('content')
<div class="row">
  @include('sistema.financeiro.comissoes.modal.criarajuste')
  <div class="col-12">
    <div class="card">
      <div class="overlay" id="overlay_comissoes">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <form action="{{ route('comissao.pagamentoComissoes') }}" method="POST" autocomplete="off" id="form_pagarProfissional">
        @csrf()
        <div class="card-header">
          <h3 class="card-title">Comissões em Aberto de {{ $aberto->first()->xeypqgkmimzvknq->apelido ?? 'ERRO 9D7.EUQ' }}</h3>
          <input type="text"  ="id_pessoa" value="{{ $aberto->first()->id_pessoa }}">
          <input type="text" name="nome_profissional" value="{{ $aberto->first()->xeypqgkmimzvknq->apelido ?? 'ERRO 9D7.A88' }}">
          <input type="text" id="vlr_final" name="vlr_final" value="">
          <input type="text" id="fin_comissoes" name="fin_comissoes" value="">
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" data-bs-toggle="modal" href="#modal_criarAjuste" ><i class="far fa-fw fa-plus-square"></i></a>
              <a class="btn btn-sm btn-default" id="acao"><i class="far fa-fw fa-check-square" onclick="marcarTodos(true);"></i></a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-sm table-head-fixed text-nowrap no-padding">
            <thead>
              <tr>
                <th class="text-center"></th>
                <th class="text-center">#</th>
                <th class="text-center">Tipo</th>
                <th class="text-center"># Comanda</th>
                <th class="text-center">Data</th>
                <th class="text-left">Cliente</th>
                <th class="text-left">Serviço / Produto</th>
                <th class="text-right">Vlr Serviço</th>
                <th class="text-right">% da Comissão</th>
                <th class="text-right">Valor da Comissão</th>
                <th class="text-center">Editar</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($aberto->sortBy('dt_prevista')->sortBy('created_at')->groupby('id_venda') as $comandas)
                @foreach ($comandas->groupby('dt_prevista') as $dt_prevista => $data)
                  <tr 
                    class="dt_prevista {{ $dt_prevista }}"
                    id="tr_linha_{{ $dt_prevista }}"
                    onclick="selectDtPrevista( '{{ $dt_prevista }}', true )"
                    style="background-color: rgb(200, 200, 200);"
                    data-name="previstiano"
                    data-status="false">
                    <td colspan="11" class="text-left">{{ \Carbon\Carbon::parse($dt_prevista)->format('d/m/Y') }}</td>
                  </tr>
                  @foreach ($data as $comissao)
                    <tr class="{{ $comissao->status }}" onclick="selectRow({{ $comissao->id }})" id="linha_{{ $comissao->id }}">
                      <td class="text-center">
                        <input type="checkbox"
                          id="check_{{ $comissao->id }}"
                          name="fin_conta_interna[]"
                          value="{{ $comissao->id }}"
                          data-name="comissaoriano"
                          data-id="{{ $comissao->id }}"
                          data-valor="{{ $comissao->valor }}"
                          data-dt_prevista="{{ $comissao->dt_prevista }}"
                          data-status="false">
                      </td>
                      {{-- <td class="text-left">{{ $comissao->id }} - ({{ $comissao->id_origem }} - {{ $comissao->fonte_origem }})</td> --}}
                      <td class="text-left">{{ $comissao->id }}</td>
                      <td class="text-center">{{ $comissao->tipo }}</td>

                      @if($comissao->fonte_origem == 'fin_lancamentos' )
                        <td class="text-center"> - </td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
                        <td class="text-center"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $comissao->alksdjalsVendaPagamento->id_venda ?? 'ERRO VQR.A5Z' }})"><span class="badge bg-pink">{{ $comissao->alksdjalsVendaPagamento->id_venda ?? 'ERRO 2EH.MKU' }}</span></a></td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
                        <td class="text-center"><a href="" data-bs-toggle="modal" onclick="showVenda({{ $comissao->krnclwowqamsjls->id_venda ?? 'ERRO 8X9.3MK' }})"><span class="badge bg-pink">{{ $comissao->krnclwowqamsjls->id_venda ?? 'ERRO J8W.A7J' }}</span></a></td>
                      @elseif($comissao->fonte_origem == 'fin_conta_interna' )
                        <td class="text-center"> - </td>
                      @endif

                      <td class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y H:i') }}</td>

                      @if($comissao->fonte_origem == 'fin_lancamentos' )
                        <td class="text-left">{{ $comissao->tipo ?? 'ERRO 8HE.T8B' }}</td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
                        <td class="text-left">
                          @foreach($comissao->alksdjalsVendaPagamento->PDVVendasVendasPagamentos->dfyejmfcrkolqjh as $servico)
                          {{ $servico->kcvkongmlqeklsl->nome ?? 'ERRO 4TP.K9G' }} <br>
                          @endforeach
                        </td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
                        <td class="text-left">{{ $comissao->krnclwowqamsjls->sbbgaqleesuzlus->lufqzahwwexkxli->apelido ?? 'ERRO WZE.88B'}}</td>
                      @elseif($comissao->fonte_origem == 'fin_conta_interna' )
                        <td class="text-left">{{ $aberto->first()->xeypqgkmimzvknq->apelido ?? 'ERRO RG3.8FJ'}}</td>
                      @endif

                      @if($comissao->fonte_origem == 'fin_lancamentos' )
                        <td class="text-left">Espaço Milady</td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
                        <td class="text-left">{{ $comissao->alksdjalsVendaPagamento->PDVVendasVendasPagamentos->lufqzahwwexkxli->apelido ?? 'ERRO 3HSMHV' }}</td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
                        <td class="text-left">{{ $comissao->krnclwowqamsjls->kcvkongmlqeklsl->nome ?? 'ERRO UWR.RG6'}}</td>
                      @elseif($comissao->fonte_origem == 'fin_conta_interna' )
                        <td class="text-left">{{ $comissao->tipo }}</td>
                      @endif

                      @if($comissao->fonte_origem == 'fin_lancamentos' )
                        <td class="text-right">{{ number_format($comissao->valor,2,',','.') }}
                      @elseif($comissao->fonte_origem == 'pdv_vendas_pagamentos' )
                        <td class="text-right">{{ number_format($comissao->alksdjalsVendaPagamento->PDVVendasVendasPagamentos->dfyejmfcrkolqjh->sum('vlr_final'),2,',','.') }}</td>
                      @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes' )
                        <td class="text-right">{{ number_format($comissao->krnclwowqamsjls->vlr_final ?? 0,2,',','.') }}</td>
                      @elseif($comissao->fonte_origem == 'fin_conta_interna' )
                        <td class="text-right">{{ number_format($comissao->valor,2,',','.') }}
                      @endif

                      <td class="text-right">{{ number_format($comissao->percentual * 100,1,',','.') }} %</td>

                      <td class="text-right">{{ number_format($comissao->valor,2,',','.') }}
                      {{-- @include('includes.formulario.hidden', ['c_nm' => 'datas', 'c_id' => 'datas', 'c_vl' => $comissao->created_at ]) --}}
                      {{-- @include('includes.formulario.hidden', ['c_nm' => 'input', 'c_id' => 'input', 'c_vl' => $comissao->valor ]) --}}
                      {{-- @include('includes.formulario.hidden', ['c_nm' => 'profissional', 'c_id' => 'profissional', 'c_vl' => $aberto->first()->skdfjlskjflsdjf_NomeProfissional->apelido ])</td> --}}
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="{{ route('comissao.editarComissao', $comissao->id) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></a>
                          @if($comissao->fonte_origem != 'fin_lancamentos' AND $comissao->fonte_origem != 'pdv_vendas_pagamentos')
                            {{-- <a href="{{ route('financeiro.comissoes.editComissao', $comissao->id) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i style="width: 10px;" class="fa fa-edit"></i></a> --}}
                          @else
                          @endif
                        </div>
                      </td>

                      {{-- <tr>
                        <td class="text-left">{{ $comissao->first()->xeypqgkmimzvknq->apelido ?? 'ERRO FINANCEIRO COMISSOES INDEX'}}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($comissao->min('created_at'))->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($comissao->max('created_at'))->format('d/m/Y') }}</td>
                        <td class="text-right">{{ number_format($comissao->sum('valor'),2,',','.') }}</td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="{{ route('comissao.pagarProfissional', $comissao->first()->id_pessoa) }}" class="btn btn-default btn-xs"><i class="fa fa-fw fa-search"></i></a>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td class="text-center" colspan="4">Não há comissões em aberto.</td>
                      </tr>
                      @endforelse --}}
                    </tr>
                  @endforeach
                @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th class='text-center'></th>
                <th class='text-center'>{{ $comandas->sortBy('created_at')->count() }}</th>
                <th class='text-center'></th>
                <th class='text-center'></th>
                <th class='text-center'></th>
                <th class='text-center'></th>
                <th class='text-center'></th>
                <th class='text-center'></th>
                <th class='text-right'>{{ number_format($aberto->sum('valor'),2,',','.') }}</th>
                <th class='text-center' id="tetstetete"></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="card-footer">
          <button type="reset" class="btn btn-default btn-sm">Voltar</button>
          <button type="submit" class="btn btn-success btn-sm pull-right">Efetuar Pagamento</button>
        </div>
      </form>
    </div>
  </div>
</div>
@include('sistema.pdv.vendas.auxiliares.resumo')
@stop

@push('js')
<script type="text/javascript">
//
fin_comissoes = [];

$(document).ready(function()
{
  $("#x_valor").inputmask("decimal", {
    'alias': 'numeric',
    'prefix': 'R$ ',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': true,
    'placeholder': '0,00',
  });

  $("#overlay_comissoes").hide();
});

$("#form_criarAjuste").change(function()
{
  let valor = $("#x_valor").val().replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
  $("#valor").val(valor);

  let descricao = $("#descricao").val();
  $("#tipo").val(descricao);
})

function marcarTodos( status )
{
  let g_comissoes = document.querySelectorAll("[data- ='comissaoriano']");
  let g_previstas = document.querySelectorAll("[data- ='previstiano']");
  console.log(g_previstas)

  if(status)
  {
    $('#acao').html('<i class="far fa-fw fa-square" onclick="marcarTodos(false);"></i>');
    
    $.each(g_previstas, function( index, value )
    {
      // console.log(index)
      // console.log(value)
      console.log(value)
      $('#tr_linha_2020-12-29').data('status', 23);
      $(value).data('status', 'askdksakd');
      console.log(value)
    });
  
    fin_comissoes = [];
    var i = 0;
    for( i = 0 ; i < g_comissoes.length ; i++ )
    {
      g_comissoes[i].checked = status;
      $('#linha_'+ g_comissoes[i].value).addClass("bg-pink");

      let comissao = {
        id          : g_comissoes[i].value,
        valor       : parseFloat($(g_comissoes[i]).attr('data-valor')),
        dt_prevista : $(g_comissoes[i]).attr('data-dt_prevista'),
      };

      fin_comissoes.push(comissao)      
    }
  }
  else
  {
    $('#acao').html('<i class="far fa-fw fa-check-square" onclick="marcarTodos(true);"></i>');

    var i = 0;
    for( i = 0 ; i < g_comissoes.length ; i++ )
    {
      g_comissoes[i].checked = status;
      $('#linha_'+ g_comissoes[i].value).removeClass("bg-pink");
    }
    
    fin_comissoes = [];
    console.log(fin_comissoes)
  }
  
  let JSONString = JSON.stringify(fin_comissoes);
  $("#fin_comissoes").val(JSONString);

  somaTotal()
}

function selectDtPrevista( dt_prevista, status )
{
  let g_comissoes = $("[data- ='fin_conta_interna[]']");
  
  var i = 0;
  for( i = 0 ; i < g_comissoes.length ; i++ )
  {
    let comissao = $(g_comissoes[i]);
    
    if ( comissao.attr('data-dt_prevista') == dt_prevista )
    {
      if (status)
      {
        $('#linha_'+ g_comissoes[i].value).addClass("bg-pink");
      }
      else
      {
        $('#linha_'+ g_comissoes[i].value).removeClass("bg-pink");
      }

      g_comissoes[i].checked = status;
      atualizarArray( g_comissoes[i].value , status )
    }
  }
  
  let JSONString = JSON.stringify(fin_comissoes);
  $("#fin_comissoes").val(JSONString);
  // $("#tr_linha_"+dt_prevista).attr("onclick", selectDtPrevista( dt_prevista, false ));
  if (status)
  {
    $("#tr_linha_"+dt_prevista).attr("onclick", "selectDtPrevista( '"+dt_prevista+"', false )");
  }
  else
  {
    $("#tr_linha_"+dt_prevista).attr("onclick", "selectDtPrevista( '"+dt_prevista+"', true )");
  }

}

function selectRow( id_campo )
{
  let row = $('#linha_'+ id_campo );

  if($(row).hasClass('bg-pink'))
  {
    row.removeClass("bg-pink");
    $('#check_'+ id_campo ).prop("checked", false)

    item = fin_comissoes.findIndex(val => val.id == id_campo);

    fin_comissoes.splice(item, 1);

    somaTotal()
  }
  else
  {
    row.addClass("bg-pink");
    $('#check_'+ id_campo ).prop("checked", true)
    
    let comissao = {
      id          : $('#check_'+ id_campo ).val(),
      valor       : parseFloat($('#check_'+ id_campo ).attr('data-valor')),
      dt_prevista : $($('#check_'+ id_campo )).attr('data-dt_prevista'),
    };

    fin_comissoes.push(comissao)      

    somaTotal()
  }

  let JSONString = JSON.stringify(fin_comissoes);
  $("#fin_comissoes").val(JSONString);
}

function atualizarArray( id_campo , status )
{
  if (status)
  {
    let conta_interna = {
      id             : $('#check_'+ id_campo ).val(),
      dt_prevista    : $('#check_'+ id_campo ).attr('data-dt_prevista'),
      valor          : parseFloat($('#check_'+ id_campo ).attr('data-valor')),
      // vlr_real       : parseFloat($('#check_'+ id_campo ).attr('data-vlr_real')),
      // vlr_descontado : parseFloat($('#check_'+ id_campo ).attr('data-vlr_descontado')),
      // prc_descontado : parseFloat($('#check_'+ id_campo ).attr('data-prc_descontado')),
      // vlr_final      : parseFloat($('#check_'+ id_campo ).attr('data-vlr_final')),


                      // {{-- value="{{ $comissao->id }}" --}}
                      // {{-- data-valor="{{ $comissao->valor }}" --}}
                      // {{-- data-dt_prevista="{{ $comissao->dt_prevista }}"> --}}

    };

    fin_comissoes.push(conta_interna)

    somaTotal()
  }
  else
  {
    item = fin_comissoes.findIndex(val => val.id == id_campo);

    fin_comissoes.splice(item, 1);

    somaTotal()
  }
}

function somaTotal()
{
  let total = fin_comissoes.reduce((anterior, atual) => anterior + atual.valor, 0)
  $('#vlr_final').val(total);
  $('#tetstetete').text(total);
}

</script>
@endpush