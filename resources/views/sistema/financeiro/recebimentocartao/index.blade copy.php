@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="overlay" id="overlay_recebCartoes">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <form action="{{ route('lancamentos.confirmarCartoes') }}" method="POST" autocomplete="off" id="form_recebCartoes">
        {{-- <input type="hidden" name="fin_recebCartoes" id="fin_recebCartoes"> --}}
        <textarea name="fin_recebCartoes" id="fin_recebCartoes" cols="100" rows="10"></textarea>
        <code >
          <pre id="fin_recebCartoesdois" style="border: 1px solid #7A7A7A;">
          </pre>
        </code>
        
        @csrf()
        @include('sistema.financeiro.recebimentocartao.modal.bancos')
        <div class="card-header">
          <h3 class="card-title">Recebimento em Cartões em Aberto</h3>
          <div class="card-tools">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" data-bs-toggle="modal" href="#modal_bancos" ><i class="far fa-fw fa-plus-square"></i></a>
              <a class="btn btn-sm btn-default" id="acao"><i class="far fa-fw fa-check-square" onclick="marcarVarios(true);"></i></a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-sm table-head-fixed text-nowrap no-padding">
            <thead>
              <tr>
                <th class="text-left"></th>
                <th class="text-left">Data Prevista</th>
                <th class="text-left">Forma de Pagamento</th>
                <th class="text-left">Bandeira</th>
                <th class="text-left">#</th>
                <th class="text-center"># Pagamento</th>
                <th class="text-center"># Venda</th>
                <th class="text-center">Vlr real</th>
                <th class="text-center">Vlr Desc.</th>
                <th class="text-center">Vlr Líquido</th>
              </tr>
            </thead>
            <tbody>
              @php $indice = 0 @endphp
              @foreach($cartoes->sortBy('dt_prevista')->groupBy('dt_prevista') as $dt_prevista => $previstos)
              <tr onclick="selectCategoria( 'nivel_1', '{{ $dt_prevista }}', null, null)" style="background-color: gray;">
                <th class="text-center" id="acao_{{ $dt_prevista }}" data-status="false"><i class="far fa-fw fa-square"></i></th>
                <th class="text-left" colspan="5">{{ Carbon\Carbon::parse($dt_prevista)->format('d/m/Y') }}</th>
                <th class="text-center"></th>
                <th class="text-center">{{ number_format($previstos->sum('vlr_real'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($previstos->sum('vlr_real') - $previstos->sum('vlr_final'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($previstos->sum('vlr_final'),2,',','.') }}</th>
              </tr>
              @foreach($previstos->groupBy('gevmgwjvzgdexwm.forma') as $forma => $tipo)
              <tr onclick="selectCategoria( 'nivel_2', '{{ $dt_prevista }}', '{{ $forma }}', null)" style="background-color: darkgray;">
                <th class="text-center" id="acao_{{ $forma }}" data-status="false"><i class="far fa-fw fa-square"></i></th>
                <th class="text-center"></th>
                <th class="text-left" colspan="5">{{ $forma }}</th>
                <th class="text-center">{{ number_format($tipo->sum('vlr_real'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($tipo->sum('vlr_real') - $tipo->sum('vlr_final'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($tipo->sum('vlr_final'),2,',','.') }}</th>
              </tr>
              @foreach($previstos->groupBy('gevmgwjvzgdexwm.bandeira') as $bandeira => $recebimetos)
              <tr onclick="selectCategoria( 'nivel_3', '{{ $dt_prevista }}', '{{ $forma }}', '{{ $bandeira }}')" style="background-color: lightgray;">
                <th class="text-center" id="acao_{{ $bandeira }}" data-status="false"><i class="far fa-fw fa-square"></i></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-left" colspan="4">{{ $bandeira }}</th>
                <th class="text-center">{{ number_format($recebimetos->sum('vlr_real'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($recebimetos->sum('vlr_real') - $recebimetos->sum('vlr_final'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($recebimetos->sum('vlr_final'),2,',','.') }}</th>
              </tr>
              @foreach($recebimetos as $parcela)
              <tr class="{{ $parcela->status_comissao }}" onclick="selectRow({{ $parcela->id }})" id="linha_{{ $parcela->id }}">
                <td class="text-center">
                  <input
                  type="checkbox"
                  id="check_{{ $parcela->id }}"
                  data-name="fin_receber_cartoes[]"
                  data-dt_prevista="{{ $parcela->dt_prevista }}"
                  data-forma="{{ $parcela->gevmgwjvzgdexwm->forma }}"
                  data-bandeira="{{ $bandeira }}"
                  data-vlr_real="{{ $parcela->vlr_real }}"
                  data-vlr_descontado="{{ $parcela->prc_descontado * $parcela->vlr_real / 100  }}"
                  data-prc_descontado="{{ $parcela->prc_descontado }}"
                  data-vlr_final="{{ $parcela->vlr_final }}"
                  value="{{ $parcela->id }}">

                </td>
                <td class="text-center"><input type="date" class="text-center" value="{{ Carbon\Carbon::parse($parcela->dt_prevista)->format('Y-m-d') }}"></td>
                <td class="text-center"></td>
                <td class="text-center">{{ $parcela->gevmgwjvzgdexwm->forma }}</td>
                <td class="text-center">{{ $parcela->id }}</td>
                <td class="text-center">{{ $parcela->id_pagamento }}</td>
                <td class="text-center">{{ $parcela->hthgoawwqzbxhdh->id_venda ?? 'asdkalsjdklsa' }}</td>
                <td class="text-center">{{ number_format($parcela->vlr_real,2,',','.') }}</td>
                <td class="text-center">{{ number_format($parcela->vlr_real - $parcela->vlr_final,2,',','.') }}</td>
                <td class="text-center"><input type="number" class="text-center" name="vlr_real" id="valor_real_{{ $parcela->id }}" value="{{ $parcela->vlr_final }}" class="text-right" onchange="recalcular(this)" step="0.01"></td>
              </tr>
              @php $indice = $indice + 1 @endphp
              @endforeach
              @endforeach
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th class="text-center" colspan="6"></th>
                <th class="text-center">{{ number_format($cartoes->sum('vlr_real'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($cartoes->sum('vlr_real') - $cartoes->sum('vlr_final'),2,',','.') }}</th>
                <th class="text-center">{{ number_format($cartoes->sum('vlr_final'),2,',','.') }}</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="card-footer">
          <button type="reset" class="btn btn-default btn-sm">Voltar</button>
          <button type="submit" class="btn btn-success btn-sm pull-right">Confirmar Recebimento</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@push('js')
<script type="text/javascript">
//
fin_recebCartoes = [];

$(document).ready(function()
{
  $("#overlay_recebCartoes").hide();
});

// function marcarVarios( status )
// {
//   let itens = document.getElementsByName('fin_receber_cartoes[]');

//   if(status)
//   {
//     $('#acao').html('<i class="far fa-fw fa-square" onclick="marcarVarios(false);"></i>');

//     fin_recebCartoes = [];
//     var i = 0;
//     for( i = 0 ; i < itens.length ; i++ )
//     {
//       itens[i].checked = status;
//       $('#linha_'+ itens[i].value).addClass("bg-pink");

//       let parcela = {
//         id          : itens[i].value,
//         valor       : parseFloat($(itens[i]).attr('data-valor')),
//         dt_prevista : $(itens[i]).attr('data-dt_prevista'),
//       };

//       fin_recebCartoes.push(parcela)      
//     }
//   }
//   else
//   {
//     $('#acao').html('<i class="far fa-fw fa-check-square" onclick="marcarVarios(true);"></i>');

//     var i = 0;
//     for( i = 0 ; i < itens.length ; i++ )
//     {
//       itens[i].checked = status;
//       $('#linha_'+ itens[i].value).removeClass("bg-pink");
//     }

//     fin_recebCartoes = [];
//     console.log(fin_recebCartoes)
//   }

//   let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)

//   $('#vlr_final').val(total);

//   let JSONString = JSON.stringify(fin_recebCartoes);
//   $("#fin_recebCartoes").val(JSONString);
// }

function selectRow( id_campo )
{
  let row = $('#linha_'+ id_campo );

  if($(row).hasClass('bg-pink'))
  {
    row.removeClass("bg-pink");
    $('#check_'+ id_campo ).prop("checked", false)

    item = fin_recebCartoes.findIndex(val => val.id == id_campo);

    fin_recebCartoes.splice(item, 1);

    let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)
    $('#vlr_final').val(total);
  }
  else
  {
    row.addClass("bg-pink");
    $('#check_'+ id_campo ).prop("checked", true)

    let parcela = {
      id             : $('#check_'+ id_campo ).val(),
      dt_prevista    : $('#check_'+ id_campo ).attr('data-dt_prevista'),
      forma          : $('#check_'+ id_campo ).attr('data-forma'),
      bandeira       : $('#check_'+ id_campo ).attr('data-bandeira'),
      vlr_real       : parseFloat($('#check_'+ id_campo ).attr('data-vlr_real')),
      vlr_descontado : parseFloat($('#check_'+ id_campo ).attr('data-vlr_descontado')),
      prc_descontado : parseFloat($('#check_'+ id_campo ).attr('data-prc_descontado')),
      vlr_final      : parseFloat($('#check_'+ id_campo ).attr('data-vlr_final')),
    };

    fin_recebCartoes.push(parcela)      

    let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)
    $('#vlr_final').val(total);
  }

  let JSONString = JSON.stringify(fin_recebCartoes);
  $("#fin_recebCartoes").val(JSONString);
}

function selectCategoria( situacao, dt_prevista, forma, bandeira )
{
  let itens = $("[data-name='fin_receber_cartoes[]']");
  let status = true;
  // let status = $('#acao_' + dt_prevista).attr('data-status');

  var i = 0;
  for( i = 0 ; i < itens.length ; i++ )
  {
    let cartao = $(itens[i]);

    if (situacao == 'nivel_1')
    {
      if ( cartao.attr('data-dt_prevista') == dt_prevista )
      {
        itens[i].checked = status;
        $('#linha_'+ itens[i].value).addClass("bg-pink");
        atualizarArray ( itens[i].value )
      }
    }
    else if (situacao == 'nivel_2')
    {
      if ( cartao.attr('data-dt_prevista') == dt_prevista && cartao.attr('data-forma') == forma )
      {
        itens[i].checked = status;
        $('#linha_'+ itens[i].value).addClass("bg-pink");
        atualizarArray ( itens[i].value )
      }
    }
    else if (situacao == 'nivel_3')
    {
      if ( cartao.attr('data-dt_prevista') == dt_prevista && cartao.attr('data-forma') == forma && cartao.attr('data-bandeira') == bandeira )
      {
        itens[i].checked = status;
        $('#linha_'+ itens[i].value).addClass("bg-pink");
        atualizarArray ( itens[i].value )
      }
    }

    let JSONString = JSON.stringify(fin_recebCartoes, null, 4);
    $("#fin_recebCartoes").val(JSONString);
    document.getElementById("fin_recebCartoesdois").innerHTML = fin_recebCartoes;


    
    // console.log(fin_recebCartoes)

  //     if( (cartao.attr('data-dt_prevista') == dt_prevista) || ( (forma != null ) && cartao.attr('data-forma') == forma) || ( (bandeira != null ) && cartao.attr('data-bandeira') == bandeira) )
  //     {
  //       itens[i].checked = true;
  //     }
  //     else
  //     {
  //       console.log ('NAO')
  //     }
}

function atualizarArray ( id_campo )
{
  let parcela = {
    id             : $('#check_'+ id_campo ).val(),
    dt_prevista    : $('#check_'+ id_campo ).attr('data-dt_prevista'),
    forma          : $('#check_'+ id_campo ).attr('data-forma'),
    bandeira       : $('#check_'+ id_campo ).attr('data-bandeira'),
    vlr_real       : parseFloat($('#check_'+ id_campo ).attr('data-vlr_real')),
    vlr_descontado : parseFloat($('#check_'+ id_campo ).attr('data-vlr_descontado')),
    prc_descontado : parseFloat($('#check_'+ id_campo ).attr('data-prc_descontado')),
    vlr_final      : parseFloat($('#check_'+ id_campo ).attr('data-vlr_final')),
  };

  fin_recebCartoes.push(parcela) 
}
  // let status = $('#acao_' + dt_prevista).attr('data-status');
  // let itens = document.getElementsByName('fin_receber_cartoes[]');

  // if(status)
  // {
  //   $('#acao_'+dt_prevista).html('<i class="far fa-fw fa-check-square">');
  //   $('#acao_'+dt_prevista).attr('data-status', 'true');

  //   fin_recebCartoes = [];
  //   var i = 0;
  //   for( i = 0 ; i < itens.length ; i++ )
  //   {
  //     if( $(itens[i]).attr('data-dt_prevista') == dt_prevista )
  //     {
  //       itens[i].checked = status;
  //     }
  //     $('#linha_'+ itens[i].value).addClass("bg-pink");

  //     let parcela = {
  //       id          : itens[i].value,
  //       valor       : parseFloat($(itens[i]).attr('data-valor')),
  //       dt_prevista : $(itens[i]).attr('data-dt_prevista'),
  //     };

  //   //   fin_recebCartoes.push(parcela)      
  //   }
  // }
  // else
  // {
  //   $('#acao_'+dt_prevista).html('<i class="far fa-fw fa-square">');
  //   $('#acao_'+dt_prevista).attr('data-status', 'false');

  //   var i = 0;
  //   for( i = 0 ; i < itens.length ; i++ )
  //   {
  //     itens[i].checked = status;
  //     $('#linha_'+ itens[i].value).removeClass("bg-pink");
  //   }

  //   // fin_recebCartoes = [];
  //   // console.log(fin_recebCartoes)
  // }

  // // let total = fin_recebCartoes.reduce((anterior, atual) => anterior + atual.valor, 0)

  // // $('#vlr_final').val(total);

  // // console.log(total)

}
</script>
@endpush