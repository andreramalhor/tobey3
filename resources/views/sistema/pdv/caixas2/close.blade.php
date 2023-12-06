@extends('layouts.app')

@section('content')
<form method="POST" class="form" action="{{ route('pdv.caixas.closed', $caixa->id) }}" oninput="calc_total();" autocomplete="off">
  @csrf()
  {{ method_field('PATCH') }}

  <input type="hidden" name="dt_fechamento"  id="dt_fechamento"  value="{{ \Carbon\Carbon::now() }}">
  <input type="hidden" name="vlr_fechamento" id="vlr_fechamento" value="0">
  <input type="hidden" name="status"         id="status"         value="Fechado">
  <input type="hidden" name="vlr_abertura"   id="vlr_abertura"   value="{{ $caixa->vlr_abertura }}">
  <input type="hidden" name="vlr_atual"      id="vlr_atual"      value="{{ $caixa->saldo_atual }}">
  <input type="hidden" name="id_caixa"       id="id_caixa"       value="{{ $caixa->id }}">

  <div class="row">
    <div class="col-md-12">
      <div class="card card-solid">
        <div class="card-header with-border">
          <h3 class="card-title">Fechar Caixa {{ $caixa->id_banco }}, #ID {{ $caixa->id }}, aberto por {{ $caixa->kpakdkhqowIqzik->apelido }}</h3>
          <div class="card-tools">
            <div class="btn-group">
              {{-- <a class="btn btn-sm btn-default" data-bs-toggle="modal" id="btn_modal_sobreOCliente" href="#modal_sobreOCliente" style="display: none;"><i class="fas fa-fw fa-address-card"></i></a> --}}
              {{-- <a class="btn btn-sm btn-default" data-bs-toggle="modal" id="btn_modal_sobreAComanda" href="#modal_sobreAComanda" style="display: none;"><i class="fas fa-fw fa-search"></i></a> --}}
              {{-- <a class="" id="change_cliente" onclick="mudarCliente()" style="display: none;"><i class="fas fa-undo"></i></a> --}}
              <a class="btn btn-sm btn-default" onclick="atualizarContadores()"><i class="fas fa-fw fa-save"></i></a>
            </div>
          </div>
        </div>
        <div class="card-header with-border">
          <div class="row">
            <div class="col-sm-2">
              <div class="description-block border-right">
                {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                <h5 class="description-header" id="per_profissional">Aberto em:</h5>
                <span class="description-text">{{ Carbon\Carbon::parse($caixa->dt_abertura)->format('d/m/Y H:i') }}</span>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="description-block border-right">
                {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                <h5 class="description-header" id="vlr_comissao">Aberto com:</h5>
                <span class="description-text">R$ {{ number_format($caixa->vlr_abertura, 2, ',', '.') }}</span>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="description-block border-right">
                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> --}}
                <h5 class="description-header" id="vlr_venda">Saldo Atual:</h5>
                <span class="description-text">R$ {{ number_format($caixa->saldo_atual, 2, ',', '.') }}</span>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="description-block border-right">
                {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> --}}
                <h5 class="description-header" id="vlr_descontado">Fechando em:</h5>
                <span class="description-text">{{ Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="description-block border-right">
                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> --}}
                <h5 class="description-header">Fechando com:</h5>
                <span class="description-text" id="total">R$ 0,00</span>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="description-block">
                {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                <h5 class="description-header">Diferença:</h5>
                <span class="description-text" id="resto">R$ 0,00</span>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota200.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota200')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota200" id="nota200" value="{{ $caixa->nota200 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota200' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
            </div>
            <div class="col-2" style="padding-top: 7px;">
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota100.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota100')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota100" id="nota100" value="{{ $caixa->nota100 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota100' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda100.png') }}" height="40" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'moeda100')"> - </button>
                </div>
                <input type="number" class="form-control" name="moeda100" id="moeda100" value="{{ $caixa->moeda100 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'moeda100' )"> + </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota50.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota50')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota50" id="nota50" value="{{ $caixa->nota50 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota50' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda50.png') }}" height="40" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'moeda50')"> - </button>
                </div>
                <input type="number" class="form-control" name="moeda50" id="moeda50" value="{{ $caixa->moeda50 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'moeda50' )"> + </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota20.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota20')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota20" id="nota20" value="{{ $caixa->nota20 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota20' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda25.png') }}" height="40" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'moeda25')"> - </button>
                </div>
                <input type="number" class="form-control" name="moeda25" id="moeda25" value="{{ $caixa->moeda25 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'moeda25' )"> + </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota10.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota10')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota10" id="nota10" value="{{ $caixa->nota10 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota10' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda10.png') }}" height="40" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'moeda10')"> - </button>
                </div>
                <input type="number" class="form-control" name="moeda10" id="moeda10" value="{{ $caixa->moeda10 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'moeda10' )"> + </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota5.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota5')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota5" id="nota5" value="{{ $caixa->nota5 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota5' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda5.png') }}" height="40" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'moeda5')"> - </button>
                </div>
                <input type="number" class="form-control" name="moeda5" id="moeda5" value="{{ $caixa->moeda5 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'moeda5' )"> + </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/nota2.png') }}" height="50" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'nota2')"> - </button>
                </div>
                <input type="number" class="form-control" name="nota2" id="nota2" value="{{ $caixa->nota2 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'nota2' )"> + </button>
                </div>
              </div>
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <img style="position: relative;left: 80%;transform: translateX(-50%);margin-bottom: 10px;" src="{{ asset('/img/PDV/Caixas/Moedas/moeda1.png') }}" height="40" width="auto">
            </div>
            <div class="col-2" style="padding-top: 7px;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-danger" onclick="menos( 'moeda1')"> - </button>
                </div>
                <input type="number" class="form-control" name="moeda1" id="moeda1" value="{{ $caixa->moeda1 ?? 0 }}" step="1" min="0" style="text-align:center;">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="mais( 'moeda1' )"> + </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-default" href="{{ url()->previous() }}">Voltar</a>
          <button type="submit" id="btn_fechar" class="btn btn-danger" style="display: none;">Fechar Caixa</button>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('js')
<script type="text/javascript">
  function id(el)
  {
    return document.getElementById(el);
  }

  function menos( id_qnt ) 
  {
    var qnt = parseInt( id( id_qnt ).value );
    if( qnt > 0 )
      id( id_qnt ).value = qnt - 1; 

    calc_total();
  } 

  function mais( id_qnt )
  {
    id( id_qnt ).value = parseInt( id( id_qnt ).value ) + 1;

    calc_total();
  }

  function calc_total()
  {
    var aberto = parseFloat(document.getElementById('vlr_abertura').value).toFixed(2);
    var saldo_final = parseFloat(document.getElementById('vlr_atual').value).toFixed(2);

    var total = parseFloat(
      (nota200  = $('#nota200').val()  * 200)  +
      (nota100  = $('#nota100').val()  * 100)  +
      (nota50   = $('#nota50').val()   * 50)   +
      (nota20   = $('#nota20').val()   * 20)   +
      (nota10   = $('#nota10').val()   * 10)   +
      (nota5    = $('#nota5').val()    * 5)    +
      (nota2    = $('#nota2').val()    * 2)    +
      (moeda100 = $('#moeda100').val() * 1.00) +
      (moeda50  = $('#moeda50').val()  * 0.50) +
      (moeda25  = $('#moeda25').val()  * 0.25) +
      (moeda10  = $('#moeda10').val()  * 0.10) +
      (moeda5   = $('#moeda5').val()   * 0.05) +
      (moeda1   = $('#moeda1').val()   * 0.01)).toFixed(2)

    
    $("#vlr_fechamento").val(total);

    var tot = document.getElementById("total").innerHTML =           (total-0).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });
    var res = document.getElementById("resto").innerHTML = (saldo_final-total).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });

    if (   ( parseFloat(saldo_final) - parseFloat(total) ) == 0   )
    {
      $("#btn_fechar").show();
    }
    else
    {
      $("#btn_fechar").hide();
    }
  }

  function atualizarContadores()
  {
    if (confirm('Deseja gravar posição dos contadores das notas?'))
    {
      let id_caixa = $('#id_caixa').val();
      let nota200  = $('#nota200').val();
      let nota100  = $('#nota100').val();
      let nota50   = $('#nota50').val();
      let nota20   = $('#nota20').val();
      let nota10   = $('#nota10').val();
      let nota5    = $('#nota5').val();
      let nota2    = $('#nota2').val();
      let moeda100 = $('#moeda100').val();
      let moeda50  = $('#moeda50').val();
      let moeda25  = $('#moeda25').val();
      let moeda10  = $('#moeda10').val();
      let moeda5   = $('#moeda5').val();
      let moeda1   = $('#moeda1').val();

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
        toastrjs(response.data.type, response.data.message);
      })
  @include('includes.catch', [ 'codigo_erro' => '5238709a' ] )
      .then(function ()
      {
        alert('ass')
      })

    }
  }

</script>
@stop
