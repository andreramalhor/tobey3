@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-3">
    <div class="card">
      <div class="card-body box-profile">
        <p class="text-muted text-center m-0">CATEGORIA</p>
        <h3 class="profile-username text-center">{{ $categoria->nome }}</h3>
        <p class="text-muted text-center">{{ $categoria->descricao }}</p>
        <hr>
        <span class="text-center">
          <strong><i class="fa-solid fa-font-awesome"></i> Tipo</strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> {{ $categoria->tipo }} </font></p>
        </span>
      </div>
    </div>
  </div>

    <div class="col-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#painel" data-bs-toggle="tab">Painel</a></li>
            <li class="nav-item"><a class="nav-link" href="#produtos" data-bs-toggle="tab">Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="#servicos" data-bs-toggle="tab">Serviços</a></li>
            <li class="nav-item"><a class="nav-link" href="#financeiro" data-bs-toggle="tab">Financeiro</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="painel">
              @include('sistema.catalogo.categorias.auxiliares.inc_mostrar_painel')
            </div>
            <div class="tab-pane" id="produtos">
              @include('sistema.catalogo.categorias.auxiliares.inc_mostrar_produtos')
            </div>
            <div class="tab-pane" id="servicos">
              @include('sistema.catalogo.categorias.auxiliares.inc_mostrar_servicos')
            </div>
            <div class="tab-pane" id="financeiro">
              @include('sistema.catalogo.produtos.auxiliares.inc_mostrar_financeiro')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e)
{
  switch (e.target.hash)
  {
    case '#produtos':
      $('#produtosMostrarProdutos').empty()
      mostrarProdutos(0)
      break
      
    case '#servicos':
      $('#servicosMostrarServicos').empty()
      mostrarServicos(0)
      break
      
    default:
      alert(e.target.href)
      break
  }
})

// # PAINEL PRODUTOS ================================================================================================
$(document).ready(function()
{  
  $(document).on('click', '#proximaPaginaProdutos', function(event)
  {
    event.preventDefault()
    var page = $(this)[0].dataset.page
    mostrarProdutos(page)
  })
})

function mostrarProdutos(page)
{
  $('#produto_overlay').show()
  $('#proximaPaginaProdutos').remove()
  $('#produtosMostrarProdutosFoot').empty()
  $('#produtosMostrarProdutos').append('<tr id="carregandoPaginaProdutos"><td class="text-center" colspan="9"> Carregando ...</td></tr>')
  
  var url = "{{ route('cat.categorias.produtos', ':idd') }}"
  var url = url.replace(':idd',  {{ $categoria->id }} )
  var params = url+'?page='+page

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    collect(response.data.data).sortByDesc('nome').each((data) =>
    {
      $("#produtosMostrarProdutos").append(
        '<tr>'+
          '<td class="text-center">'+data.id+'</td>'+
					'<td class="text-center">'+data.imagem_servprod+'</td>'+
					'<td class="text-left">'+data.nome+'</td>'+
					'<td class="text-left">'+( data.marca == null ? '' : data.marca )+'</td>'+
					'<td class="text-center">'+( data.tipo == null ? '' : data.tipo )+'</td>'+
					'<td class="text-center">'+data.estoque_atual+'</td>'+
					'<td class="text-right">'+accounting.formatMoney(( data.vlr_custo_estoque == null ? 0 : data.vlr_custo_estoque ), "", 2, ".", ",")+'</td>'+
					'<td class="text-right">'+accounting.formatMoney(data.vlr_venda == null ? 0 : data.vlr_venda, "", 2, ".", ",")+'</td>'+
          @can('Produtos.Editar')          
            '<td class="text-center"><a onClick="categoria_produto_excluir('+data.id+')" href="" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fas fa-times"></i></a></td>'+
          @endcan
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      $("#produtosMostrarProdutosFoot").append('<tr id="proximaPaginaProdutos" data-page="'+( response.data.current_page + 1 )+'"><td class="text-left" colspan="3">Total de Itens: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td><td class="text-left" colspan="6"><a class="pe-auto" href="#">Mostrar mais produtos...</a></td></tr>')
    }
    else
    {
      $("#produtosMostrarProdutosFoot").append('<tr><td class="text-left" colspan="9">Total de Itens: '+(response.data.total)+' / '+response.data.total+'</td></tr>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '2620173a' ] )
  .then(function(response)
  {
    $('#carregandoPaginaProdutos').remove()
    $('#produto_overlay').hide()
  })
}

// # PAINEL SERVIÇOS ================================================================================================
$(document).ready(function()
{  
  $(document).on('click', '#proximaPaginaServicos', function(event)
  {
    event.preventDefault()
    var page = $(this)[0].dataset.page
    mostrarServicos(page)
  })
})

function mostrarServicos(page)
{
  $('#servico_overlay').show()
  $('#proximaPaginaServicos').remove()
  $('#servicosMostrarServicosFoot').empty()
  $('#servicosMostrarServicos').append('<tr id="carregandoPaginaServicos"><td class="text-center" colspan="9"> Carregando ...</td></tr>')
  
  var url = "{{ route('cat.categorias.servicos', ':idd') }}"
  var url = url.replace(':idd',  {{ $categoria->id }} )
  var params = url+'?page='+page

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    collect(response.data.data).sortByDesc('nome').each((data) =>
    {
      $("#servicosMostrarServicos").append(
        '<tr>'+
          '<td class="text-center">'+data.id+'</td>'+
					'<td class="text-center">'+data.imagem_servprod+'</td>'+
					'<td class="text-left">'+data.nome+'</td>'+
					'<td class="text-center">'+( data.tipo == null ? '' : data.tipo )+'</td>'+
					'<td class="text-center">'+data.duracao+'</td>'+
					'<td class="text-right">'+accounting.formatMoney(data.vlr_venda == null ? 0 : data.vlr_venda, "", 2, ".", ",")+'</td>'+
          @can('Serviços.Editar')
            '<td class="text-center"><a onClick="categoria_servico_excluir('+data.id+')" href="#" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fas fa-times"></i></a></td>'+
          @endcan
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      $("#servicosMostrarServicosFoot").append('<tr id="proximaPaginaServicos" data-page="'+( response.data.current_page + 1 )+'"><td class="text-left" colspan="3">Total de Itens: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td><td class="text-left" colspan="6"><a class="pe-auto" href="#">Mostrar mais serviços...</a></td></tr>')
    }
    else
    {
      $("#servicosMostrarServicosFoot").append('<tr><td class="text-left" colspan="9">Total de Itens: '+(response.data.total)+' / '+response.data.total+'</td></tr>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '1943613a' ] )
  .then(function(response)
  {
    $('#carregandoPaginaServicos').remove()
    $('#produto_overlay').hide()
  })
}

</script>
@endpush