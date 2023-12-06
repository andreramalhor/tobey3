@extends('layouts.app')

@section('content')
<form method="POST" class="form" action="{{ route('pdv.caixas.closed', $caixa->id) }}" onchange="calc_total();" autocomplete="off">
  @csrf()
  {{ method_field('PATCH') }}
  <input type="hidden" name="status"         id="status"         value="Fechado">
  <input type="hidden" name="id_caixa"       id="id_caixa"       value="{{ $caixa->id }}">
  <input type="hidden" name="dt_fechamento"  id="dt_fechamento">
  <input type="hidden" name="vlr_fechamento" id="vlr_fechamento">

  <div class="row">
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card card-{{ $caixa->cor_status ?? 'default' }} card-outline">
          <div class="card-body box-profile">
            <h3 class="profile-username text-center">#ID do Caixa: {{ $caixa->id }}</h3>
            <p class="text-muted text-center">{{ $caixa->rybeyykhpcgwkgr->nome ?? 'ERRO INDEX CAIXA 1' }} <span class="badge bg-{{ $caixa->cor_status }}">{{ $caixa->status }}</span></p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Usuário:</b> <a class="float-right">{{ $caixa->kpakdkhqowIqzik->apelido }}</a>
              </li>
              <li class="list-group-item">
                <b>Data do Caixa:</b> <a class="float-right">{{ Carbon\Carbon::parse($caixa->dt_abertura)->format('d/m/Y H:i') }}</a>
              </li>
              <li class="list-group-item">
                <b>Aberto com:</b> <a class="float-right">R$ {{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</a>
              </li>
              <li class="list-group-item">
                <b>Saldo Atual:</b> <a class="float-right" id="saldo_atual">R$ {{ number_format($caixa->saldo_atual, 2, ',', '.') }}</a>
              </li>
              <li class="list-group-item">
                <b>Diferença da Contagem:</b> <a class="float-right"><span id="vlr_restante">R$ -,--</span></a>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            <a class="btn btn-default" href="{{ url()->previous() }}">Voltar</a>
            <button type="submit" id="btn_fechar" class="btn btn-danger float-end disabled">Fechar Caixa</button>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card card-outline">
          <div class="card-header">
            <h3 class="card-title text-left">Resumo</h3>
          </div>
          <div class="card-body p-0">
            <table class="table">
              <tbody>
                @foreach($caixa->ssqlnxsbyywplan->groupby('qmbnkthuczqdsdn.forma') as $key => $cada)
                <tr>
                  <td class="align-middle">{{ $key }}</td>
                  <td class="align-middle text-center">( {{ $cada->groupBy('id_venda')->count() }} )</td>
                  <td class="align-middle text-right">
                    R$ {{ number_format($cada->sum('valor'), 2, ',', '.') }}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title text-left">Contagem das Notas</h3>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <tbody>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota200.png') }}" alt="200 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota200')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota200')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota200">{{ $caixa->nota200 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota200">R$ {{ number_format($caixa->nota200 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota200" id="nota200">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota100.png') }}" alt="100 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota100')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota100')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota100">{{ $caixa->nota100 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota100">R$ {{ number_format($caixa->nota100 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota100" id="nota100">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota50.png') }}" alt="50 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota50')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota50')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota50">{{ $caixa->nota50 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota50">R$ {{ number_format($caixa->nota50 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota50" id="nota50">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota20.png') }}" alt="20 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota20')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota20')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota20">{{ $caixa->nota20 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota20">R$ {{ number_format($caixa->nota20 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota20" id="nota20">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota10.png') }}" alt="10 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota10')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota10')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota10">{{ $caixa->nota10 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota10">R$ {{ number_format($caixa->nota10 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota10" id="nota10">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota5.png') }}" alt="5 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota5')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota5')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota5">{{ $caixa->nota5 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota5">R$ {{ number_format($caixa->nota5 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota5" id="nota5">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota2.png') }}" alt="2 reais" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('nota2')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('nota2')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_nota2">{{ $caixa->nota2 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_nota2">R$ {{ number_format($caixa->nota2 * 200, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="nota2" id="nota2">
                </td>
              </tr>
            </tbody>
          </table>
        </div>    
      </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
              <h3 class="card-title text-left">Contagem das Moedas</h3>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <tbody>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda100.png') }}" alt="1 real" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('moeda100')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('moeda100')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_moeda100">{{ $caixa->moeda100 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_moeda100">R$ {{ number_format($caixa->moeda100 * 0.100, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="moeda100" id="moeda100">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda50.png') }}" alt="50 centavos" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('moeda50')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('moeda50')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_moeda50">{{ $caixa->moeda50 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_moeda50">R$ {{ number_format($caixa->moeda50 * 0.50, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="moeda50" id="moeda50">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda25.png') }}" alt="25 centavos" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('moeda25')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('moeda25')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_moeda25">{{ $caixa->moeda25 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_moeda25">R$ {{ number_format($caixa->moeda25 * 0.25, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="moeda25" id="moeda25">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda10.png') }}" alt="10 centavos" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('moeda10')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('moeda10')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_moeda10">{{ $caixa->moeda10 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_moeda10">R$ {{ number_format($caixa->moeda10 * 0.10, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="moeda10" id="moeda10">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda5.png') }}" alt="5 centavos" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('moeda5')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('moeda5')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_moeda5">{{ $caixa->moeda5 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_moeda5">R$ {{ number_format($caixa->moeda5 * 0.5, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="moeda5" id="moeda5">
                </td>
              </tr>
              <tr>
                <td class="align-middle">
                  <img style="height: 40px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda1.png') }}" alt="1 centavo" />
                </td>
                <td class="align-middle">
                  <div class="btn-group-vertical">
                    <a class="btn btn-sm btn-primary" onclick="mais('moeda1')"> + </a>
                    <a class="btn btn-sm btn-danger" onclick="menos('moeda1')"> - </a>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span id="qtd_moeda1">{{ $caixa->moeda1 ?? 0 }}</span>
                </td>
                <td class="align-middle text-center">=</td>
                <td class="align-middle text-right">
                  <b><span id="vlr_moeda1">R$ {{ number_format($caixa->moeda1 * 0.1, 2, ',', '.') }}</span></b>
                  <input type="hidden" name="moeda1" id="moeda1">
                </td>
              </tr>
            </tbody>
          </table>
        </div>    
      </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
              <h3 class="card-title text-left">Automáticos</h3>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <tbody>
            @forelse($caixa->ssqlnxsbyywplan->sortBy('id_forma_pagamento')->groupBy('qmbnkthuczqdsdn.forma') as $forma => $pagamentos)
              @if($forma == "Dinheiro")
                <tr>
                  <td class="align-middle" colspan="2">{{ $forma }}</td>
                  <td class="align-middle text-right" id="vlr_especie">R$ 0,00</td>
                </tr>
              @else
                <tr>
                  <td class="align-middle">{{ $forma }}</td>
                  <td class="align-middle">{{ $pagamentos->groupBy('id_venda')->count() }}</td>
                  <td class="align-middle text-right">R$ {{ number_format( $pagamentos->sum('valor'), 2, ',', '.') }}</td>
                </tr>
                @foreach($pagamentos->groupBy('id_venda') as $id_venda => $pagamento)
                  @foreach($pagamento->groupBy('qmbnkthuczqdsdn.bandeira') as $bandeira => $valores)
                    <tr style="background-color: lightgrey;">
                      <td class="text-left">
                        <input type="checkbox" name="chk_automaticos">
                        &nbsp;&nbsp;&nbsp;{{ $bandeira }}</td>
                      <td class="text-left">{{ $id_venda }}</td>
                      <td class="text-right">{{ number_format( $valores->sum('valor'), 2, ',', '.') }}</td>
                    </tr>
                  @endforeach
                @endforeach
              @endif
            @empty
            <tr>
              <td class='text-center' colspan='2'>Não há pagamentos registrados.</td>
            </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('js')
<script type="text/javascript">
  calc_total()

  function menos( id_qtd ) 
  {
    var qnt = $('#qtd_'+id_qtd).text()
    
    if( qnt > 0 )
    $('#qtd_'+id_qtd).text( Number($('#qtd_'+id_qtd).text()) - 1)
    
    calc_total()
  } 
  
  function mais( id_qtd )
  {
    $('#qtd_'+id_qtd).text( Number($('#qtd_'+id_qtd).text()) + 1)

    calc_total()
  }

  function calc_total()
  {
    var aberto      = accounting.unformat( $('#vlr_abertura').text() )
    var saldo_atual = accounting.unformat( $('#saldo_atual').text() )
    
    $('#vlr_nota200').text( accounting.formatMoney( $('#qtd_nota200').text() * 200 ))
    $('#vlr_nota100').text( accounting.formatMoney( $('#qtd_nota100').text() * 100 ))
    $('#vlr_nota50').text( accounting.formatMoney( $('#qtd_nota50').text() * 50 ))
    $('#vlr_nota20').text( accounting.formatMoney( $('#qtd_nota20').text() * 20 ))
    $('#vlr_nota10').text( accounting.formatMoney( $('#qtd_nota10').text() * 10 ))
    $('#vlr_nota5').text( accounting.formatMoney( $('#qtd_nota5').text() * 5 ))
    $('#vlr_nota2').text( accounting.formatMoney( $('#qtd_nota2').text() * 2 ))
    $('#vlr_moeda100').text( accounting.formatMoney( $('#qtd_moeda100').text() * 1.00 ))
    $('#vlr_moeda50').text( accounting.formatMoney( $('#qtd_moeda50').text() * 0.50 ))
    $('#vlr_moeda25').text( accounting.formatMoney( $('#qtd_moeda25').text() * 0.25 ))
    $('#vlr_moeda10').text( accounting.formatMoney( $('#qtd_moeda10').text() * 0.10 ))
    $('#vlr_moeda5').text( accounting.formatMoney( $('#qtd_moeda5').text() * 0.05 ))
    $('#vlr_moeda1').text( accounting.formatMoney( $('#qtd_moeda1').text() * 0.01 ))
    
    $('#nota200').val( accounting.unformat( $('#qtd_nota200').text() ))
    $('#nota100').val( accounting.unformat( $('#qtd_nota100').text() ))
    $('#nota50').val( accounting.unformat( $('#qtd_nota50').text() ))
    $('#nota20').val( accounting.unformat( $('#qtd_nota20').text() ))
    $('#nota10').val( accounting.unformat( $('#qtd_nota10').text() ))
    $('#nota5').val( accounting.unformat( $('#qtd_nota5').text() ))
    $('#nota2').val( accounting.unformat( $('#qtd_nota2').text() ))
    $('#moeda100').val( accounting.unformat( $('#qtd_moeda100').text() ))
    $('#moeda50').val( accounting.unformat( $('#qtd_moeda50').text() ))
    $('#moeda25').val( accounting.unformat( $('#qtd_moeda25').text() ))
    $('#moeda10').val( accounting.unformat( $('#qtd_moeda10').text() ))
    $('#moeda5').val( accounting.unformat( $('#qtd_moeda5').text() ))
    $('#moeda1').val( accounting.unformat( $('#qtd_moeda1').text() ))
    
    var vlr_especie = 
      (nota200  = accounting.unformat( $('#qtd_nota200').text()  ) * 200)  +
      (nota100  = accounting.unformat( $('#qtd_nota100').text()  ) * 100)  +
      (nota50   = accounting.unformat( $('#qtd_nota50').text()  )  * 50)   +
      (nota20   = accounting.unformat( $('#qtd_nota20').text()  )  * 20)   +
      (nota10   = accounting.unformat( $('#qtd_nota10').text()  )  * 10)   +
      (nota5    = accounting.unformat( $('#qtd_nota5').text()  )   * 5)    +
      (nota2    = accounting.unformat( $('#qtd_nota2').text()  )   * 2)    +
      (moeda100 = accounting.unformat( $('#qtd_moeda100').text()  )* 1.00) +
      (moeda50  = accounting.unformat( $('#qtd_moeda50').text()  ) * 0.50) +
      (moeda25  = accounting.unformat( $('#qtd_moeda25').text()  ) * 0.25) +
      (moeda10  = accounting.unformat( $('#qtd_moeda10').text()  ) * 0.10) +
      (moeda5   = accounting.unformat( $('#qtd_moeda5').text()  )  * 0.05) +
      (moeda1   = accounting.unformat( $('#qtd_moeda1').text()  )  * 0.01)

    $("#vlr_especie").text( accounting.formatMoney(vlr_especie) )

    $("#vlr_restante").text( accounting.formatMoney(Number((saldo_atual).toFixed(2)) - Number((vlr_especie).toFixed(2))) )
    $("#vlr_fechamento").val( accounting.unformat(Number((vlr_especie).toFixed(2) + Number((aberto).toFixed(2))) ) )
    $("#dt_fechamento").val( moment().format('YYYY-MM-DD HH:mm:ss') )

    if ( Number((saldo_atual).toFixed(2)) - Number((vlr_especie).toFixed(2)) ==  0 && $('[name="chk_automaticos"]:checked').length == $('[name="chk_automaticos"]').length )
    {
      $("#btn_fechar").removeClass('disabled')
    }
    else
    {
      $("#btn_fechar").addClass('disabled')
    }
  }

  function atualizarContadores()
  {
    if (confirm('Deseja gravar posição dos contadores das notas?'))
    {
      let id_caixa = $('#id_caixa').val()
      let nota200  = $('#nota200').val()
      let nota100  = $('#nota100').val()
      let nota50   = $('#nota50').val()
      let nota20   = $('#nota20').val()
      let nota10   = $('#nota10').val()
      let nota5    = $('#nota5').val()
      let nota2    = $('#nota2').val()
      let moeda100 = $('#moeda100').val()
      let moeda50  = $('#moeda50').val()
      let moeda25  = $('#moeda25').val()
      let moeda10  = $('#moeda10').val()
      let moeda5   = $('#moeda5').val()
      let moeda1   = $('#moeda1').val()

      axios.post("{{ route('caixa.atualizarContadores') }}",
      {
        id_caixa  : id_caixa, 
        nota200   : nota200,
        nota100   : nota100,
        nota50    : nota50,
        nota20    : nota20,
        nota10    : nota10,
        nota5     : nota5,
        nota2     : nota2,
        moeda100  : moeda100,
        moeda50   : moeda50,
        moeda25   : moeda25,
        moeda10   : moeda10,
        moeda5    : moeda5,
        moeda1    : moeda1, 
      })
      .then(function(response)
      {
        console.log(response)
        toastrjs(response.data.type, response.data.message)
      })
  @include('includes.catch', [ 'codigo_erro' => '7581636a' ] )
      .then(function ()
      {
        alert('ass')
      })

    }
  }

</script>
@stop
