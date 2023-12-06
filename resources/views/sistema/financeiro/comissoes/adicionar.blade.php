@extends('layouts.app')

@section('content')
<div class="row">
  <div class="card-group">
    <div class="col-md-3">
      @include('sistema.catalogo.produtos.auxiliares.card_foto_produto')
    </div>
    <form id="form_produtos_adicionar">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            @include('sistema.catalogo.produtos.auxiliares.card_produto')
          </div>
          <div class="col-md-12">
            @include('sistema.catalogo.produtos.auxiliares.card_sobre_precos')
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-6">
      @include('sistema.catalogo.produtos.auxiliares.card_composicao_custos')
    </div>
    <div class="col-md-6">
      @include('sistema.catalogo.produtos.auxiliares.card_impostos')
    </div>
  </form>
</div>


  <div class="row">
    <div class="col-12">
      <a href="{{ route('cat.produtos') }}" class="btn btn-secondary">Cancelar</a>
      <a class="btn btn-success float-right" style="color:white" id="btn_produto_gravar">Cadastrar</a>
    </div>
  </div>
</form>
<br>



<!-- `consumo_medio` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci', -->
<!-- 
  `cmv_prod_serv`
  CMV (Custo da Mercadoria Vendida) é a soma de tudo que a empresa gasta para comprar, produzir e estocar seus produtos e
  mercadorias até que eles sejam comercializados. Inclui o pagamento dos fornecedores, custo do frete, incidência de impostos,
  seguros, dentre outros gastos.
  
  

	`curva_abc`
  A curva ABC tem, como principal finalidade, classificar todos os produtos que compõem o estoque de uma empresa de acordo
  com o grau de importância de cada um deles. Essa classificação pode ser feita de acordo com os preços de custo ou preços
  de venda de cada produto do estoque.





  `ativo` INT(10) NULL DEFAULT NULL,
  `duracao` TIME NULL DEFAULT NULL,
  `fidelidade_pontos_ganhos` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `fidelidade_pontos_necessarios` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `======` TIME NULL DEFAULT NULL,
  `unidade` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `=======` TIME NULL DEFAULT NULL,
  `estoque_min` CHAR(50) NULL DEFAULT '1' COLLATE 'utf8mb4_unicode_ci',
  `estoque_max` CHAR(50) NULL DEFAULT '2' COLLATE 'utf8mb4_unicode_ci',
  
  `
  `id_fornecedor` INT(10) NULL DEFAULT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
  `status` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
-->
  
<!--
  *MARGEM DE CUSTO 
  Este cálculo é simples: basta dividir o lucro bruto pela receita, e multiplicar o resultado da divisão por 100.
  Se você vender um produto a R$ 10 e a produção custar R$ 5, você ganhará R$ 5.
  Esse valor é o lucro bruto e ele representa, nesse caso, uma margem bruta de 50%.

  *MARGEM DE CONTRIBUICAO valor e percentual
  Para encontrar a Margem de Contribuição, é preciso realizar a seguinte conta:
  Margem de Contribuição = Valor das Vendas – (Custos Variáveis + Despesas Variáveis).


  <label class="col-form-label">Tempo de Retorno</label>
  <input type="text" class="form-control form-control-sm" name="tempo_retorno">


  
  Ver depois MARGEM DE LUCRO, MARGEM BRUTA, MARGEM LÍQUIDA, MARGEM DE CONTRIBUIÇÃO
  https://clubedotrade.com.br/blog/margem-de-preco/#:~:text=Este%20c%C3%A1lculo%20%C3%A9%20simples%3A%20basta,resultado%20da%20divis%C3%A3o%20por%20100.&text=Se%20voc%C3%AA%20vender%20um%20produto,uma%20margem%20bruta%20de%2050%25.
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

$("[name='nome']").on('change', function (e)
{
  let nome = (e.target.value).split(" ");
  let ulti = (nome.length) - 1;
  let apelido = nome[0]+" "+nome[ulti];
  if (ulti == 0)
  {
    $("[name='apelido']").val(nome[0]);
  }
  else
  {
    $("[name='apelido']").val(apelido);
    $("[name='apelido']").change();
  }
});

function validar(item)
{
  let valor = item.value;
  let campo = item.name;

  var dados = {
    valor: valor,
    campo: campo,
  };
  
  {{--
    var url = "{{ route('cat.produtos.validar', ':idd') }}";
    axios.post('{{ route('cat.produtos.gravar') }}', dados)
    var url = url.replace(':idd', {{ $produto->id ?? null }});
  --}}

  axios.put(url, dados)
  .then(function(response)
  {
    // console.log(response)
    if(response.data.type == 'error')
    {
      toastrjs(response.data.type, response.data.message )
      $("#btn_produto_gravar").addClass('disabled');
      $("[name='"+item.name+"']").removeClass('is-warning');
      $("[name='"+item.name+"']").removeClass('is-valid');
      $("[name='"+item.name+"']").addClass('is-invalid');
    }
    else
    {
      $("[name='"+item.name+"']").removeClass('is-warning');
      $("[name='"+item.name+"']").removeClass('is-invalid');
      $("[name='"+item.name+"']").addClass('is-valid');
      $("#btn_produto_gravar").removeClass('disabled');
    }


    // if(valor == 'instagram')
    // {
    //   let imagem_perfil = $("#imagem_perfil").val();
    //   $("#produto_picture").attr('src', imagem_perfil);
    //   toastrjs('success', 'Foto do perfil atualizada.')
    //   $("#instagram_address").attr('href', 'https://www.instagram.com/'+instagram);
    // }
  })
@include('includes.catch', [ 'codigo_erro' => '6705097a' ] )
};

$("#btn_produto_gravar").click(function(event)
{
  event.preventDefault();

  let dados = $('#form_produtos_adicionar').serialize();

  axios.post('{{ route('cat.produtos.gravar') }}', dados)
  .then(function(response)
  {
    // console.log(response)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '5136489a' ] )
});


function produto_avatar_gravar()
{
  const formData = new FormData();
  const imagefile = document.querySelector('#image');
  formData.append("image", imagefile.files[0]);

  let dados = $('#form_produtos_adicionar_avatar');
  // let dados = $('#form_produtos_adicionar_avatar').serialize();
  
  axios.post('{{ route('cat.produtos.avatar') }}', formData,
  {
    headers:
    {
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(function(response)
  {
    // console.log(response)
    imagem = $('#imagem_temp').val(response.data);
    $("#produto_picture").attr('src', response.data );
  })
@include('includes.catch', [ 'codigo_erro' => '3609860a' ] )
  .then()
  {
    $('#imagem_enviar').hide();
    $('#imagem_cancelar').show();
  }
}

function produtos_avatar_remove()
{
  foto = {
    temp_foto: $('#imagem_temp').val()
  };

  axios.post('{{ route('cat.produtos.avatar_remove') }}', foto)
  .then(function(response)
  {
    // console.log(response)
    imagem = $('#imagem_temp').val('');
    $("#produto_picture").attr('src', $('#imagem_padrao').val() );
  })
@include('includes.catch', [ 'codigo_erro' => '6818128a' ] )
  .then()
  {
    $('#imagem_enviar').show();
    $('#imagem_cancelar').hide();
  }
}
</script>
@endsection
