@extends('layouts.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Produtos</h1>
      </div>
{{--       <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Widgets</li>
        </ol>
      </div> --}}
    </div>
  </div>
</section>
<form id="form_compra">
@csrf
  <div class="row" id="foreach-produtos">
    <div class="col-md-12">
        
      Carregando . . .
    </div>
  </div>
</form>
<div class="row">
  <div class="col-12">
    <a href="{{ route('fin.compras') }}" class="btn btn-secondary">Cancelar</a>
    <a class="btn btn-success float-right" style="color:white" onclick="compra_proximo()" id="btn_compra_proximo">Próximo</a>
  </div>
</div>
<br>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready( function()
  {
    produtos_foreach()
  });

  function produtos_foreach()
  {
    $('#overlay-produtos').show();

    axios.get("{{ route('cat.produtos.listar_compras') }}")
    .then(function(response)
    {
      // console.log(response.data)
      $('#foreach-produtos').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '9639850a' ] )
    .then( function(response)
    {
      $('#overlay-produtos').hide();
    })
  }


  function menos( id_qnt ) 
  {
    var qnt = parseInt( document.getElementById('qtd_['+id_qnt+']').value );
    if( qnt > 0 )
    {
      document.getElementById('qtd_['+id_qnt+']').value = qnt - 1; 
    }

    var vlr_unitario_text = document.getElementById('vlr_unitario_['+id_qnt+']').innerHTML;
    var vlr_unitario = parseFloat(vlr_unitario_text.replace("R$ ", "").replace(".", "").replace(",", ".")).toFixed(2);
    
    var vlr_total = vlr_unitario * qnt;
    document.getElementById('total_['+id_qnt+']').innerHTML = 'Total: '+(vlr_total).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });
    // calc_total();
  } 

  function mais( id_qnt )
  {
    var qtd = document.getElementById('qtd_['+id_qnt+']').value = parseInt( document.getElementById('qtd_['+id_qnt+']').value ) + 1;

    var vlr_unitario_text = document.getElementById('vlr_unitario_['+id_qnt+']').innerHTML;
    var vlr_unitario = parseFloat(vlr_unitario_text.replace("R$ ", "").replace(".", "").replace(",", ".")).toFixed(2);
    
    var vlr_total = vlr_unitario * qtd;
    document.getElementById('total_['+id_qnt+']').innerHTML = 'Total: '+(vlr_total).toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' });

    // calc_total();
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

  function compra_proximo()
  {
    var produtos = $('#form_compra').serialize();

    axios.post("{{ route('compra.store1') }}", produtos)
    .then( function(response)
    {
      console.log(response)
      window.location.href = response.data.redirect
      // toastrjs(response.data.typ, response.data.msg)
    })
@include('includes.catch', [ 'codigo_erro' => '7731411a' ] )
    .then( function()
    {
      // $("#cancelar_criacao_tarefa").click();
      // $('#overlay_tasks').hide();
    })
  }


</script>
@endsection
