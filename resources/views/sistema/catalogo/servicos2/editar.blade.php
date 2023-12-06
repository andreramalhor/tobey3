@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Editar Função</h3>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="sobre">
            <div class="row">
              <div class="row invoice-info">
                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted"># ID</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $funcao->id }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>
                
                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Nome</strong><br>
                </div>
                <div class="col-sm-5 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $funcao->nome }}" placeholder="Nome" onchange="funcoes_editar(this)">
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Slug</strong><br>
                </div>
                <div class="col-sm-5 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="slug" id="slug" value="{{ $funcao->slug }}" placeholder="Slug" disabled>
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Descrição</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="descricao" id="descricao" value="{{ $funcao->descricao }}" placeholder="Descrição" onchange="funcoes_editar(this)">
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>
                
                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Permissões</strong><br>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Permissões</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Editar',     'local' => 'Editar' ])
                </div>

                <div class="col-sm-3 invoice-col">
                  <strong>Funções</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Pessoas</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Excluir',    'local' => 'Excluir' ])
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted"></strong><br>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Financeiro</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Financeiro.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Financeiro.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Financeiro.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Financeiro.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Financeiro.Excluir',    'local' => 'Excluir' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Financeiro.Dashboard',  'local' => 'Dashboard' ])
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Teste_2</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_2.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_2.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_2.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_2.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_2.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Teste_3</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Excluir',    'local' => 'Excluir' ])
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted"></strong><br>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Teste_4</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Teste_5</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Teste_6</strong><br>
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Menu',       'local' => 'Menu' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Detalhes',   'local' => 'Detalhes' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Criar',      'local' => 'Criar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Editar',     'local' => 'Editar' ])
                   @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Excluir',    'local' => 'Excluir' ])
                </div>

                <br><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="{{ route('acl.funcoes') }}" class="btn btn-secondary">Finalizar e Voltar</a>
  </div>
</div>
<br>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
  });

  function funcoes_editar(item)
  {    
    var url  = "{{ route('acl.funcoes.atualizar', $funcao->id) }}";

    axios.put(url, [{
      [item.name]: item.value,
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '6594397a' ] )
  }

  function funcoes_permissoes_verificar(item)
  {
    let permissao = item.id;

    $(item).attr( 'checked', true )
    if ($(item).is(':checked'))
    {
      $(item).attr( 'checked', true )
      funcoes_permissoes_adicionar(permissao, 'on')
    }
    else
    {
      $(item).attr( 'checked', false )
      funcoes_permissoes_adicionar(permissao, 'off')
    }
  }

  function funcoes_permissoes_adicionar(permissao, status)
  {
    var url = "{{ route('acl.funcoes.permissoes', $funcao->id) }}";

    axios.post(url, [{
      permissao: permissao,
      status   : status
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '5676521a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
