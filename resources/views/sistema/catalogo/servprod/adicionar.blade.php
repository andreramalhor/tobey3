@extends('layouts.app')

@section('content')
<form id="form_servsprods_adicionar">
  <div class="row">
    {{--
      <div class="card-group">
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
          @include('sistema.catalogo.servprod.auxiliares.card_foto_servprod')
        </div>
      </div>
    --}}
    <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
      @include('sistema.catalogo.servprod.auxiliares.card_servprod')
    </div>
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
      @include('sistema.catalogo.servprod.auxiliares.card_sobre_precos')
    </div>
  </div>
  
  {{-- <div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
      @include('sistema.catalogo.servprod.auxiliares.card_composicao_custos')
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
      @include('sistema.catalogo.servprod.auxiliares.card_impostos')
    </div>
  </div> --}}
  
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <a href="{{ route('cat.servprod', $tipo) }}" class="btn btn-secondary">Cancelar</a>
      <a class="btn btn-success float-right" style="color:white" id="btn_servprod_gravar">Cadastrar</a>
    </div>
  </div>  

</form>

<br>


<!-- `consumo_medio` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci', -->
<!-- 
  `cmv_prod_serv`
  CMV (Custo da Mercadoria Vendida) é a soma de tudo que a empresa gasta para comprar, produzir e estocar seus servsprods e
  mercadorias até que eles sejam comercializados. Inclui o pagamento dos fornecedores, custo do frete, incidência de impostos,
  seguros, dentre outros gastos.
  
  

	`curva_abc`
  A curva ABC tem, como principal finalidade, classificar todos os servsprods que compõem o estoque de uma empresa de acordo
  com o grau de importância de cada um deles. Essa classificação pode ser feita de acordo com os preços de custo ou preços
  de venda de cada servprod do estoque.





  `ativo` INT(10) NULL DEFAULT NULL,
  `fidelidade_pontos_ganhos` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `fidelidade_pontos_necessarios` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `======` TIME NULL DEFAULT NULL,
  `unidade` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `=======` TIME NULL DEFAULT NULL,
  `estoque_min` CHAR(50) NULL DEFAULT '1' COLLATE 'utf8mb4_unicode_ci',
  `estoque_max` CHAR(50) NULL DEFAULT '2' COLLATE 'utf8mb4_unicode_ci',
  
  `
  `id_fornecedor` INT(10) NULL DEFAULT NULL,
  `status` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
-->
  
<!--
  *MARGEM DE CUSTO 
  Este cálculo é simples: basta dividir o lucro bruto pela receita, e multiplicar o resultado da divisão por 100.
  Se você vender um servprod a R$ 10 e a produção custar R$ 5, você ganhará R$ 5.
  Esse valor é o lucro bruto e ele representa, nesse caso, uma margem bruta de 50%.

  *MARGEM DE CONTRIBUICAO valor e percentual
  Para encontrar a Margem de Contribuição, é preciso realizar a seguinte conta:
  Margem de Contribuição = Valor das Vendas – (Custos Variáveis + Despesas Variáveis).


  <label class="col-form-label">Tempo de Retorno</label>
  <input type="text" class="form-control form-control-sm" name="tempo_retorno">


  
  Ver depois MARGEM DE LUCRO, MARGEM BRUTA, MARGEM LÍQUIDA, MARGEM DE CONTRIBUIÇÃO
  https://clubedotrade.com.br/blog/margem-de-preco/#:~:text=Este%20c%C3%A1lculo%20%C3%A9%20simples%3A%20basta,resultado%20da%20divis%C3%A3o%20por%20100.&text=Se%20voc%C3%AA%20vender%20um%20servprod,uma%20margem%20bruta%20de%2050%25.
-->



@endsection

@section('js')
<script type="text/javascript">
// $(document).ready(function()
// {
  // $("[name='cpf'").inputmask({
  //   mask: ["999.999.999-99", "99.999.999/9999-99", ],
  //   keepStatic: true
  // })
// });


function validar(item)
{
  let valor = item.value;
  let campo = item.name;

  var dados = {
    valor: valor,
    campo: campo,
  };
  
    var url = "{{ route('cat.servprod.validar', ':servprod') }}";
    {{--// axios.post('{ route('cat.servprod.gravar') }}', dados)--}}
    var url = url.replace(':servprod', 'Serviço');
    // var url = url.replace(':servprod', {{ $servprod->id ?? null }});

  axios.put(url, dados)
  .then(function(response)
  {
    console.log(response)
    // if(response.data.type == 'error')
    // {
    //   toastrjs(response.data.type, response.data.message )
    //   $("#btn_servprod_gravar").addClass('disabled');
    //   $("[name='"+item.name+"']").removeClass('is-warning');
    //   $("[name='"+item.name+"']").removeClass('is-valid');
    //   $("[name='"+item.name+"']").addClass('is-invalid');
    // }
    // else
    // {
    //   $("[name='"+item.name+"']").removeClass('is-warning');
    //   $("[name='"+item.name+"']").removeClass('is-invalid');
    //   $("[name='"+item.name+"']").addClass('is-valid');
    //   $("#btn_servprod_gravar").removeClass('disabled');
    // }


    // if(valor == 'instagram')
    // {
    //   let imagem_perfil = $("#imagem_perfil").val();
    //   $("#servprod_picture").attr('src', imagem_perfil);
    //   toastrjs('success', 'Foto do perfil atualizada.')
    //   $("#instagram_address").attr('href', 'https://www.instagram.com/'+instagram);
    // }
  })
  @include('includes.catch', [ 'codigo_erro' => '7966838a' ] )
};

$("#btn_servprod_gravar").click(function(event)
{
  event.preventDefault();

  var url = "{{ route('cat.servprod.validar', ':servprod') }}";
  var url = url.replace(':servprod', 'Serviço');


  // var url = "{ route('cat.servprod.gravar', ':tipo') }}";
  // var url = url.replace(':tipo', '{{ $tipo }}');
  
  let dados = $('#form_servsprods_adicionar').serialize();
  
  axios.post(url, dados)
  .then(function(response)
  {
    // console.log(response)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '9804087a' ] )
})

</script>
@endsection
