@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Função</h3>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item"><a class="nav-link " href="#sobre" data-bs-toggle="tab">Sobre</a></li>
          <li class="nav-item"><a class="nav-link active" href="#usuarios" data-bs-toggle="tab">Usuários</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane" id="sobre">
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
                <div class="col-sm-10 invoice-col">
                  {{ $funcao->nome }}
                </div>

                <div class="col-sm-12 invoice-col">
                    <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Slug</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                    {{ $funcao->slug ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Descrição</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $funcao->descricao ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                    <strong class="text-muted">Permissões</strong><br>
                </div>
                <div class="col-sm-3 invoice-col">
                    <strong>Permissões</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Permissões.Editar',     'local' => 'Editar' ])
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Funções</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Funções.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Pessoas</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Pessoas.Excluir',    'local' => 'Excluir' ])
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted"></strong><br>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Teste_1</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_1.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_1.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_1.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_1.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_1.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>CRM</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'CRM.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'CRM.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'CRM.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'CRM.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'CRM.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Teste_3</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_3.Excluir',    'local' => 'Excluir' ])
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted"></strong><br>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Teste_4</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_4.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Teste_5</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_5.Excluir',    'local' => 'Excluir' ])
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Teste_6</strong><br>
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Menu',       'local' => 'Menu' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Detalhes',   'local' => 'Detalhes' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Criar',      'local' => 'Criar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Editar',     'local' => 'Editar' ])
                  @include('sistema.sistema.acl.funcoes.auxiliares.inc_mostrar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => 'Teste_6.Excluir',    'local' => 'Excluir' ])
                </div>

                <br><br>
              </div>
            </div>
          </div>
          <div class="tab-pane active" id="usuarios">
            <div class="card card-secondary">
              <!-- <div class="overlay" id="overlay-funcoes-usuarios"> -->
                <!-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> -->
              <!-- </div> -->
              <div class="card-header">
                <h3 class="card-title">Usuários</h3>
                @can('Permissões.Criar')
                  <div class="card-tools">
                    @can('Funções.Editar')
                      <div class="btn-toolbar">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_funcoes_usuarios_incluir"><i class="fas fa-plus" aria-hidden="true" style="color:black;"></i></a>
                        </div>
                        @include('sistema.sistema.acl.funcoes.auxiliares.mod_usuario_incluir')
                      </div>
                    @endcan
                  </div>
                @endcan
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle" id="tabela-funcoes-usuarios">
                  <thead>
                    <tr>
                      <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">Carregando...</td>
                    </tr>
                  </tbody>
                </table>
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
    <a href="{{ route('acl.funcoes') }}" class="btn btn-secondary">Voltar</a>
  </div>
</div>
<br>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
    funcoes_usuarios_tabelar()
  });

  function funcoes_usuarios_tabelar()
  {
    $('#overlay-funcoes-usuarios').show();

    var url = "{{ route('acl.funcoes.usuarios.tabelar', ':id') }}";
    var url = url.replace(':id', {{ $funcao->id }});

    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#tabela-funcoes-usuarios').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '8813771a' ] )
    .then( function(response)
    {
      $('#overlay-funcoes-usuarios').hide();
    })
  }

  function funcoes_usuario_remover(id)
  {
    $('#overlay-funcoes-usuarios').show();

    var url = "{{ route('acl.funcoes.usuarios.remover', ':id') }}";
    var url = url.replace(':id', {{ $funcao->id }});

    axios.post(url, [{
      id_pessoa: id,
    }])
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
      $('#tabela-funcoes-usuarios').empty().append(response.data)
    })
@include('includes.catch', [ 'codigo_erro' => '2753202a' ] )
    .then( function(response)
    {
      funcoes_usuarios_tabelar();
    })
    .then( function(response)
    {
      $('#overlay-funcoes-usuarios').hide();
    })
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endpush
