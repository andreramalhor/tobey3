@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-3">
    <div class="card">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="border border-secondaty rounded" src="{{ $servprod->imagem }}" alt="{{ $servprod->nome }}" width="200px">
        </div>
        <h3 class="profile-username text-center">{{ $servprod->nome }}</h3>
        <p class="text-muted text-center">{{ $servprod->descricao }}</p>
        <hr>
        <span class="text-center">
          <strong><i class="fa-solid fa-font-awesome"></i> Tipo</strong>
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> {{ $servprod->tipo }} </font></p>
        </span>
        <span class="text-center">
          <strong><i class="fa-solid fa-box-archive"></i> Categoria</strong>
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> {{ $servprod->ecgklyqfdcoguyj->nome ?? $servprod->id_catgoria ?? '(Não categorizado)' }} </font></p>
        </span>
        <span class="text-center">
          <strong><i class="fa-regular fa-copyright"></i> Marca</strong>
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> {{ $servprod->marca }} </font></p>
        </span>
        <span class="text-center">
          <strong><i class="fa-solid fa-money-bill"></i> Valor de Venda</strong>
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">R$ {{ number_format($servprod->vlr_venda, 2, ',', '.') }} </font></p>
        </span>
        <span class="text-center">
          <strong><i class="far fa-id-card mr-1"></i> {{ $servprod->label_cpf_cnpj }} </strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $servprod->cpf ?? "-" }}</font></p>
        </span>
        <span class="text-center">
          <strong><i class="far fa-file-alt mr-1"></i> Observação</strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $servprod->observacao ?? "-" }}</font></p>
        </span>
        @can('Equipe.Alterar Senha')
          @if(isset($servprod->krdhcnrxogfuwla) AND $servprod->id == Auth::User()->id)
            <a href="{{ route('atd.equipe.alterar_senha', $servprod->id) }}" class="btn btn-primary btn-block"><b>Alterar Senha</b></a>
          @endif
        @endcan
      </div>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Sobre</h3>
      </div>
      <div class="card-body">
        <strong><i class="fas fa-phone mr-1"></i> Contatos</strong>
{{--
  @forelse($servprod->ginthgfwxbdhwtu->sortbyDesc('whatsapp') as $contato)
  <p class="text-muted" style="margin-bottom: 2px"><font size="2">
    <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
    ({{ $contato->ddd }}) {{ $contato->telefone }}
    @if($contato->whatsapp)
    <a class="float-right btn btn-default btn-xs" href="https://api.whatsapp.com/send?phone=55{{ $contato->tellink }}" target="_black" data-bs-tt="tooltip" title="WhatsaApp"><i class="fab fa-whatsapp"></i></a>
    @endif
  </font></p>
  @empty
  <p class="text-muted"><font size="2,8">Não há contatos cadastrados.</font></p>
  @endforelse
  <hr>
  <strong><i class="fas fa-map-marker-alt mr-1"></i> Localização</strong>
        @forelse($servprod->uqbchiwyagnnkip as $endereco)
          <p class="text-muted" style="margin-bottom: 2px"><font size="2"> 
            <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
            {{ $endereco->logradouro }}, {{ $endereco->numero }} {{ $endereco->complemento != null ? "(".$endereco->complemento.")" : "" }} - {{ $endereco->bairro }} <br>
            {{ $endereco->cidade }} - {{ $endereco->uf }}
          </p></font>
          @empty
          <p class="text-muted"><font size="2,8">Não há endereços cadastrados.</font></p>
          @endforelse
 --}}
          <hr>
        <strong><i class="fas fa-vector-square mr-1"></i> Midias Sociais</strong>
        @if(isset($servprod->instagram) || isset($servprod->facebook))
          <p class="text-muted" style="margin-bottom: 2px"><font size="2"> 
            <span style="font-size: 7px;"></span>
            @if($servprod->instagram)
              <a class="btn btn-default btn-xs" href="https://www.instagram.com/{{ $servprod->instagram }}" target="_black" data-bs-tt="tooltip" title="Instagram"><i class="fa-brands fa-instagram"></i></a> {{ $servprod->instagram }}
            @endif
            <br>
            @if($servprod->facebook)
              <a class="btn btn-default btn-xs" href="https://www.facebook.com/{{ $servprod->facebook }}" target="_black" data-bs-tt="tooltip" title="Facebook"><i class="fa-brands fa-facebook"></i></a> {{ $servprod->facebook }}
            @endif
        @else
          <p class="text-muted"><font size="2,8">Não há mídias sociais cadastrados.</font></p>
        @endif

        </p></font>
      </div>
    </div>
  </div>
  <div class="col-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          {{-- <li class="nav-item"><a class="nav-link active" href="#painel" data-bs-toggle="tab">Painel</a></li> --}}
          <li class="nav-item"><a class="nav-link active" href="#sobre" data-bs-toggle="tab">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#vendas" data-bs-toggle="tab">Vendas</a></li>
          @if( $tipo == 'produtos')
            <li class="nav-item"><a class="nav-link" href="#compras" data-bs-toggle="tab">Compras</a></li>
          @endif
          {{-- <li class="nav-item"><a class="nav-link" href="#financeiro" data-bs-toggle="tab">Financeiro</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link" href="#tipo" data-bs-toggle="tab">Tipo</a></li> --}}
          {{-- <li class="nav-item"><a class="nav-link" href="#fornecedores" data-bs-toggle="tab">Fornecedores</a></li> --}}
          <li class="nav-item"><a class="nav-link" href="#comissoes" data-bs-toggle="tab">Comissões</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          {{-- <div class="tab-pane active" id="painel"> --}}
            {{-- @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_painel') --}}
          {{-- </div> --}}
          <div class="tab-pane active" id="sobre">
            @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_sobre')
          </div>
          <div class="tab-pane" id="vendas">
            @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_vendas')
          </div>
          @if( $tipo == 'produtos')
            <div class="tab-pane" id="compras">
              @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_compras')
            </div>
          @endif
          <div class="tab-pane" id="financeiro">
            @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_financeiro')
          </div>
          <div class="tab-pane" id="tipo">
            @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_tipo')
          </div>
          <div class="tab-pane" id="fornecedores">
            @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_fornecedores')
          </div>
          <div class="tab-pane" id="comissoes">
          @include('sistema.catalogo.servprod.auxiliares.inc_mostrar_comissoes')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('sistema.pdv.vendas.auxiliares.resumo')
@endsection

@push('js')
<script type="text/javascript">
$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e)
{
  switch (e.target.hash)
  {
    case '#vendas':
      $('#produtosMostrarVendas').empty()
      mostrarVendas(1)
      break
  
      case '#compras':
      $('#produtosMostrarCompras').empty()
      mostrarCompras(1)
      break
  
      case '#sobre':
      case '#painel':
      case '#fornecedores':
      case '#comissoes':
      break      
  
    default:
      alert(e.target.href)
      break
  }
})

// # PAINEL VENDAS ================================================================================================
$(document).ready(function()
{  
  $(document).on('click', '#proximaPaginaVendas', function(event)
  {
    event.preventDefault()
    var page = $(this)[0].dataset.page
    mostrarVendas(page)
  })
})

function mostrarVendas(page=1)
{
  $('#produto_overlay').show()
  $('#proximaPaginaVendas').remove()
  $('#produtosMostrarVendas').append('<tr id="carregandoPaginaVendas"><td class="text-center" colspan="4"> Carregando ...</td></tr>')
  
  var url = "{{ route('pdv.vendas.porproduto', ':idd') }}"
  var url = url.replace(':idd',  {{ $servprod->id }} )
  var params = url+'?page='+page

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    collect(response.data.data).each((data) =>
    {
      $("#produtosMostrarVendas").append(
        '<tr class="'+(data.deleted_at != null ? 'bg-danger' : '' )+'">'+
          '<td width="5%" style="padding: 0px 1px" class="text-center"><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal('+data.id_venda+')"><span class="badge bg-primary">'+data.id_venda+'</span></a></td>'+
          // '<td class="text-left"><span class="badge bg-primary">'+data.id_venda+'</span></td>'+
          '<td class="text-left">'+moment(data.created_at).format('DD/MM/YYYY')+'</td>'+
          '<td class="text-left">'+(data.sbbgaqleesuzlus.id_cliente == null ? 'Cliente não cadastrado' : data.sbbgaqleesuzlus.lufqzahwwexkxli.nome)+'</td>'+
          '<td class="text-right">'+accounting.formatMoney(data.vlr_final, "R$ ", 2, ".", ",")+'</td>'+
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      $("#produtosMostrarVendasFoot").append('<tr id="proximaPaginaVendas" data-page="'+( response.data.current_page + 1 )+'"><td class="text-left" colspan="2">Total de Itens: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td><td class="text-center" colspan="2"><a class="pe-auto" href="#">Mostrar mais vendas...</a></td></tr>')
    }
    else
    {
      $("#produtosMostrarVendasFoot").append('<tr><td class="text-left" colspan="4">Total de Itens: '+(response.data.total)+' / '+response.data.total+'</td></tr>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '7133101a' ] )
  .then(function(response)
  {
    $('#carregandoPaginaVendas').remove()
    $('#produto_overlay').hide()
  })
}

// # PAINEL COMPRAS ================================================================================================
$(document).ready(function()
{  
  $(document).on('click', '#proximaPaginaCompras', function(event)
  {
    event.preventDefault()
    var page = $(this)[0].dataset.page
    mostrarCompras(page)
  })
})

function mostrarCompras(page)
{
  $('#produto_overlay').show()
  $('#proximaPaginaCompras').remove()
  $('#produtosMostrarCompras').append('<tr id="carregandoPaginaCompras"><td class="text-center" colspan="5"> Carregando ...</td></tr>')
  
  var url = "{{ route('compra.porproduto', ':idd') }}"
  var url = url.replace(':idd',  {{ $servprod->id }} )
  var params = url+'?page='+page
  
  axios.get(params)
  .then(function(response)
  {
    collect(response.data.data).sortByDesc('id_compra').each((data) =>
    {
      $("#produtosMostrarCompras").append(
        '<tr class="'+(data.deleted_at != null ? 'bg-danger' : '' )+'">'+
          '<td width="5%" style="padding: 0px 1px" class="text-center"><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal('+data.id_compra+')"><span class="badge bg-primary">'+data.id_compra+'</span></a></td>'+
        // '<td class="text-left"><span class="badge bg-primary">'+data.id_compra+'</span></td>'+
          '<td class="text-left">'+moment(data.created_at).format('DD/MM/YYYY')+'</td>'+
          '<td class="text-left">'+data.aldkekciajsgqwp.ysfyhzfsfarfdha.nome+'</td>'+
          '<td class="text-center">'+data.qtd+'</td>'+
          '<td class="text-right">'+accounting.formatMoney(data.vlr_final, "R$ ", 2, ".", ",")+'</td>'+
        '</tr>'
      )
    })
    
    if( response.data.current_page < response.data.last_page )
    {
      $("#produtosMostrarComprasFoot").append('<tr id="proximaPaginaCompras" data-page="'+( response.data.current_page + 1 )+'"><td class="text-left">Total de Compras: '+(response.data.per_page*response.data.current_page)+' / '+response.data.total+'</td><td class="text-center" colspan="3"><a class="pe-auto" href="#">                       Mostrar mais Compras...</a></td></tr>')
    }
    else
    {
      $("#produtosMostrarComprasFoot").append('<tr><td class="text-left" colspan="2">Total de Compras: '+(response.data.total)+' / '+response.data.total+'</td><td class="text-right" colspan="3">Qtd comprada: '+collect(response.data.data).sum('qtd')+'</td></tr>')
    }
  })
@include('includes.catch', [ 'codigo_erro' => '2773062a' ] )
  .then(function(response)
  {
    $('#carregandoPaginaCompras').remove()
    $('#produto_overlay').hide()
  })
}

// # PAINEL FINANCEIRO ================================================================================================


</script>
@endpush