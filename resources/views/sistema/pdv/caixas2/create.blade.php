@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('caixa.store') }}" id="form_pessoa_create" autocomplete="off">
@csrf
<input type="hidden" name="status" value="Aberto">
<input type="hidden" name="dt_abertura" value="{{ \Carbon\Carbon::now() }}">
<input type="hidden" name="id_usuario_abertura" value="{{ Auth::User()->id }}">
<input type="hidden" name="fin_lancamentos" id="fin_lancamentos">

<div class="row">
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="card">
      <div class="overlay" id="overlay_abrir" style="display: none">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Abrir Caixa</h3>
      </div>
      <div class="card-body" style="padding-top: 0px">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label class="col-form-label">Usuário</label>
            <input type="text" class="form-control form-control-sm " value="{{ Auth::User()->nome }}" readonly="readonly">
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label class="col-form-label">Banco</label>
            <select class="form-control form-control-sm" name="id_banco" id="id_banco" onchange="abrirCaixa(this)">
              <option>Selecione . . .</option>
              @foreach($bancos as $key => $banco)
              <option value="{{ $key }}">{{ $banco }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label class="col-form-label">Valor Último Fechamento</label>
            <input type="text" class="form-control form-control-sm text-right" name="vlr_fechamento" placeholder="0,00" readonly="readonly">
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label class="col-form-label">Valor Pendências</label>
            <input type="text" class="form-control form-control-sm text-right" id="vlr_pendencias" placeholder="0,00" readonly="readonly">
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label class="col-form-label">Valor Abertura</label>
            <input type="text" class="form-control form-control-sm text-right" name="vlr_abertura" placeholder="0,00" readonly="readonly">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('pdv.caixas') }}" class="btn btn-secondary btn-sm">Cancel</a>
        <button type="submit" class="btn btn-success btn-sm float-right" style="color: white; display: none;" id="submit_caixa_create">Abrir</button>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <div class="card">
      <div class="overlay" id="overlay_informacoes">
        <i class="fas fa-2x fa-sync-alt fa-spin" id="i_overlay_informacoes" style="display: none;"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Informações sobre o Caixa</h3>
      </div>
      <div class="card-body" style="padding-top: 6px">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <h7><strong>Dados do Último Fechamento</strong></h7>
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th class="text-center">Notas</th>
                  <th class="text-center">Qtd</th>
                </tr>
              </thead>
              <tbody id="tabela-notas">
                <tr>
                  <th>200 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>100 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>50 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>20 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>10 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>50 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>2 reais</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>1 real</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>0,50 centavos</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>0,25 centavos</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>0,10 centavos</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>0,05 centavos</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th>0,01 centavos</th>
                  <td class="text-center">0</td>
                </tr>
                <tr>
                  <th></th>
                  <th class="text-center">R$ 0,00</th>
                </tr>
              </tbody>
            </table>            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
              <h7><strong>Lançamentos Pendentes</strong></h7>
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th class="text-center">#ID</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Valor</th>
                  </tr>
                </thead>
                <tbody id="tabela-pendencias">
                  <tr>
                    <td class="text-center" colspan="4">Escolha o Local de abertura do PDV.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
//
function abrirCaixa(field)
{
  var fin_lancamentos = [];
  let dados = $('#form_pessoa_create').serialize();
  
  axios.post('{{ route('caixa.procurar') }}', dados)
  .then( function (response)
  {
    // console.log(response.data)
    $('#overlay_abrir').show();
    $('#overlay_informacoes, i_overlay_informacoes').show();

    if(response.data != 'undefined' )
    {
      // let debitos        = response.data.wskcngeadbjhpdu.filter((dados) => dados.tipo === 'D').reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.vlr_final), 0);
      // let creditos       = response.data.wskcngeadbjhpdu.filter((dados) => dados.tipo === 'R').reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.vlr_final), 0);
      // let transferencias = response.data.wskcngeadbjhpdu.filter((dados) => dados.tipo === 'T').reduce((anterior, atual) => parseFloat(anterior) + parseFloat(atual.vlr_final), 0);
      // let totais         = creditos-debitos+transferencias;

      // $("[name='vlr_fechamento']").val(new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(response.data.vlr_fechamento));
      // $("[id='vlr_pendencias']").val(new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(totais));
      // $("[id='vlr_atual']").val(new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(parseFloat(response.data.vlr_fechamento)+parseFloat(totais)));
      $("[name='vlr_abertura']").val(response.data.vlr_fechamento);

      $('#tabela-notas').empty().append(
        '<tr>'+
          '<th>200 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota200">'+response.data.nota200+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>100 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota100">'+response.data.nota100+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>50 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota50">'+response.data.nota50+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>20 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota20">'+response.data.nota20+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>10 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota10">'+response.data.nota10+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>50 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota5">'+response.data.nota5+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>2 reais</th>'+
          '<td class="text-center"><input type="hidden" name="nota2">'+response.data.nota2+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>1 real</th>'+
          '<td class="text-center"><input type="hidden" name="moeda100">'+response.data.moeda100+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>0,50 centavos</th>'+
          '<td class="text-center"><input type="hidden" name="moeda50">'+response.data.moeda50+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>0,25 centavos</th>'+
          '<td class="text-center"><input type="hidden" name="moeda25">'+response.data.moeda25+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>0,10 centavos</th>'+
          '<td class="text-center"><input type="hidden" name="moeda10">'+response.data.moeda10+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>0,05 centavos</th>'+
          '<td class="text-center"><input type="hidden" name="moeda5">'+response.data.moeda5+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th>0,01 centavos</th>'+
          '<td class="text-center"><input type="hidden" name="moeda1">'+response.data.moeda1+'</td>'+
        '</tr>'+
        '<tr>'+
          '<th></th>'+
          '<th class="text-center">'+new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(response.data.vlr_fechamento)+'</th>'+
        '</tr>'
      )

      $('[name="nota200"]').val(response.data.nota200)
      $('[name="nota100"]').val(response.data.nota100)
      $('[name="nota50"]').val(response.data.nota50)
      $('[name="nota20"]').val(response.data.nota20)
      $('[name="nota10"]').val(response.data.nota10)
      $('[name="nota5"]').val(response.data.nota5)
      $('[name="nota2"]').val(response.data.nota2)
      $('[name="moeda100"]').val(response.data.moeda100)
      $('[name="moeda50"]').val(response.data.moeda50)
      $('[name="moeda25"]').val(response.data.moeda25)
      $('[name="moeda10"]').val(response.data.moeda10)
      $('[name="moeda5"]').val(response.data.moeda5)
      $('[name="moeda1"]').val(response.data.moeda1)

      $('#tabela-pendencias').empty();
    
      // (response.data.wskcngeadbjhpdu).forEach((obj, i) =>
      // {
      //   $('#tabela-pendencias').append(
      //     '<tr>'+
      //       '<td class="text-center">'+obj.id+'</td>'+
      //       '<td class="text-center"><span class="badge bg-'+corBagde(obj.tipo)+'">'+obj.tipo+'</span></td>'+
      //       '<td class="text-center">'+obj.informacao+'</td>'+
      //       '<td class="text-right"><font color='+corFonte(obj.tipo, obj.vlr_final)+'>'+new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(obj.vlr_final)+'</font></td>'+
      //     '</tr>'
      //   );

      //   fin_lancamentos.push(obj.id);
      // })
    
      // var JSONString = JSON.stringify(fin_lancamentos);
      // $("#fin_lancamentos").val(JSONString);

      // $('#tabela-pendencias').append(
      //   '<tr>'+
      //   '<th colspan="3"></tH>'+
      //   '<th class="text-right"><font color='+corFonte('T', totais)+'>'+new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(totais)+'</th>'+
      //   '</tr>'
      // );
    }

    $('#submit_caixa_create').show();
    
  })
  @include('includes.catch', [ 'codigo_erro' => '4525966a' ] )
  .then( function()
  {
    setTimeout(function() {
      $('#overlay_abrir').hide();
      $('#overlay_informacoes').hide();
    }, 500);
  })

  function corBagde(tipo)
  {
    if (tipo == 'R')
    {
      return 'success';
    }
    else if (tipo == 'D')
    {
      return 'danger';
    }
    else
    {
      return 'warning';
    }
  }

  function corFonte(tipo, vlr_final)
  {
    if (tipo == 'D' || vlr_final < 0)
    {
      return 'red';
    }
    else
    {
      return 'black';
    }
  }
};
</script>
@endsection