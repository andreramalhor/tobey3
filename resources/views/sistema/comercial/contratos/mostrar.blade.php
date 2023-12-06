@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-3">
    <div class="card">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{ $pessoa->foto_perfil }}" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">{{ $pessoa->apelido }}</h3>
        <p class="text-muted text-center">{{ $pessoa->nome }}</p>
        <hr>
        <span class="text-center">
          <strong><i class="fas fa-birthday-cake mr-1"></i> Dt Nascimento</strong>
          @if(isset($pessoa->dt_nascimento))
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->age }} anos)</font></p>
          @else
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> - </font></p>
          @endif
        </span>
        <span class="text-center">
          <strong><i class="far fa-id-card mr-1"></i> {{ $pessoa->label_cpf_cnpj }} </strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $pessoa->cpf ?? "-" }}</font></p>
        </span>
        <span class="text-center">
          <strong><i class="far fa-file-alt mr-1"></i> Observação</strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $pessoa->observacao ?? "-" }}</font></p>
        </span>
        @can('Equipe.Alterar Senha')
          @if(isset($pessoa->krdhcnrxogfuwla) AND $pessoa->id == Auth::User()->id)
            <a href="{{ route('atd.equipe.alterar_senha', $pessoa->id) }}" class="btn btn-primary btn-block"><b>Alterar Senha</b></a>
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
        @forelse($pessoa->ginthgfwxbdhwtu->sortbyDesc('whatsapp') as $contato)
          <p class="text-muted" style="margin-bottom: 2px"><font size="2">
            <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
            ({{ $contato->ddd }}) {{ $contato->telefone }}
            @if($contato->whatsapp)
            <a class="float-right btn btn-default btn-xs" href="https://api.whatsapp.com/send?phone=55{{ $contato->tellink }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="WhatsaApp"><i class="fab fa-whatsapp"></i></a>
            @endif
          </font></p>
        @empty
          <p class="text-muted"><font size="2,8">Não há contatos cadastrados.</font></p>
        @endforelse
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Localização</strong>
        @forelse($pessoa->uqbchiwyagnnkip as $endereco)
          <p class="text-muted" style="margin-bottom: 2px"><font size="2"> 
            <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
            {{ $endereco->logradouro }}, {{ $endereco->numero }} {{ $endereco->complemento != null ? "(".$endereco->complemento.")" : "" }} - {{ $endereco->bairro }} <br>
            {{ $endereco->cidade }} - {{ $endereco->uf }}
          </p></font>
        @empty
          <p class="text-muted"><font size="2,8">Não há endereços cadastrados.</font></p>
        @endforelse
        <hr>
        <strong><i class="fas fa-vector-square mr-1"></i> Midias Sociais</strong>
        @if(isset($pessoa->instagram) || isset($pessoa->facebook))
          <p class="text-muted" style="margin-bottom: 2px"><font size="2"> 
            <span style="font-size: 7px;"></span>
            @if($pessoa->instagram)
              <a class="btn btn-default btn-xs" href="https://www.instagram.com/{{ $pessoa->instagram }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Instagram"><i class="fa-brands fa-instagram"></i></a> {{ $pessoa->instagram }}
            @endif
            <br>
            @if($pessoa->facebook)
              <a class="btn btn-default btn-xs" href="https://www.facebook.com/{{ $pessoa->facebook }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Facebook"><i class="fa-brands fa-facebook"></i></a> {{ $pessoa->facebook }}
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
          <li class="nav-item"><a class="nav-link active" href="#painel" data-bs-toggle="tab">Painel</a></li>
          <li class="nav-item"><a class="nav-link" href="#financeiro" data-bs-toggle="tab">Financeiro</a></li>
          <li class="nav-item"><a class="nav-link" href="#vendas" data-bs-toggle="tab">Vendas</a></li>
          <li class="nav-item"><a class="nav-link" href="#sobre" data-bs-toggle="tab">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#tipo" data-bs-toggle="tab">Tipo</a></li>
          @can('Funções.Detalhes')
          <li class="nav-item"><a class="nav-link" href="#comissoes_produtos" data-bs-toggle="tab">Comissões Produtos</a></li>
          <li class="nav-item"><a class="nav-link" href="#comissoes_servicos" data-bs-toggle="tab">Comissões Serviços</a></li>
          @endcan
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class=" tab-pane active" id="painel">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_painel')
          </div>
          <div class="tab-pane" id="financeiro">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_financeiro')
          </div>
          <div class="tab-pane" id="vendas">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_vendas')
          </div>
          <div class="tab-pane" id="sobre">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_sobre')
          </div>
          <div class="tab-pane" id="tipo">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_tipo')
          </div>
          <div class="tab-pane" id="comissoes_produtos">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_comissoes_p')
          </div>
          <div class="tab-pane" id="comissoes_servicos">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_comissoes_s')
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
    case '#financeiro':
      // $('#mostrarFinanceiro').empty()
      mostrarFinanceiro()
      break

    case '#vendas':
      $('#produtosMostrarVendas').empty()
      mostrarVendas(1)
      break
  
    case '#compras':
      $('#produtosMostrarCompras').empty()
      mostrarCompras(1)
      break
      
    case '#comissoes_produtos':
      mostrarProdutos(1)
      break

    case '#comissoes_servicos':
      mostrarServicos(1)
      break
  

    case '#sobre':
    case '#painel':
    case '#fornecedores':
      
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
  
  var url = "{{ route('atd.pessoas.vendas', ':idd') }}"
  var url = url.replace(':idd',  {{ $pessoa->id }} )
  var params = url+'?page='+page

  axios.get(params)
  .then(function(response)
  {
    // console.log(response)
    collect(response.data.data).each((venda) =>
    {
      produtos = '';
      collect(venda.dfyejmfcrkolqjh).each((detalhe) =>
      {
        produtos = produtos + detalhe.kcvkongmlqeklsl.nome + '</br>';
      })
      $("#produtosMostrarVendas").append(
        '<tr class="'+(venda.deleted_at != null ? 'bg-danger' : '' )+'">'+
          '<td width="5%" style="padding: 0px 1px" class="text-center"><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal('+venda.id+')"><span class="badge bg-primary">'+venda.id+'</span></a></td>'+
          '<td class="text-left">'+moment(venda.created_at).format('DD/MM/YYYY')+'</td>'+
          '<td class="text-left">'+produtos+'</td>'+
          '<td class="text-right">'+accounting.formatMoney( venda.vlr_final / 1 )+'</td>'+
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
@include('includes.catch', [ 'codigo_erro' => '3352807a' ] )
  .then(function(response)
  {
    $('#carregandoPaginaVendas').remove()
    $('#produto_overlay').hide()
  })
}

@if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif

</script>
@endpush