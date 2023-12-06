@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Permissão</h3>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item"><a class="nav-link active" href="#sobre" data-bs-toggle="tab">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#usuarios" data-bs-toggle="tab">Funções</a></li>
        </ul>
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
                  {{ $permissao->id }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Nome</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $permissao->nome }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Nível</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $permissao->nivel ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Ordem</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $permissao->ordem ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Menu</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $permissao->menu ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Descrição</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  {{ $permissao->descricao ?? '-' }}
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>
                
              </div>
            </div>
          </div>
          <div class="tab-pane " id="usuarios">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Funções</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped projects table-sm no-padding table-valign-middle">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-nowrap text-center">#</th>
                      <th class="text-nowrap">Nome</th>
                      <th class="text-nowrap text-center">Slug</th>
                      <th class="text-nowrap">Descrição</th>
                      <th class="text-nowrap text-center">Usuários</th>
                      <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($permissao->DZJVXINAWJWTNFA as $funcao)
                      @if( isset($funcao->deleted_at) )
                        <tr class="table-danger">
                      @else
                        <tr>
                      @endif
                        <td class="text-nowrap">{{ $funcao->id }}</td>
                        <td class="text-nowrap">{{ $funcao->nome }}</td>
                        <td class="text-nowrap text-center">{{ $funcao->slug }}</td>
                        <td class="">{{ $funcao->descricao }}</td>
                        <td class="text-nowrap">
                          <ul class="list-inline">
                            @if(isset($funcao->znufwevbqgruklz[0]))
                            <li class="list-inline-item">
                              <img src="{{ $funcao->znufwevbqgruklz[0]->foto_perfil }}" alt="{{ $funcao->znufwevbqgruklz[0]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
                            </li>
                            @endif
                            @if(isset($funcao->znufwevbqgruklz[1]))
                            <li class="list-inline-item">
                              <img src="{{ $funcao->znufwevbqgruklz[1]->foto_perfil }}" alt="{{ $funcao->znufwevbqgruklz[1]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
                            </li>
                            @endif
                            @if(isset($funcao->znufwevbqgruklz[2]))
                            <li class="list-inline-item">
                              <img src="{{ $funcao->znufwevbqgruklz[2]->foto_perfil }}" alt="{{ $funcao->znufwevbqgruklz[2]->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'">
                            </li>
                            @endif
                          </ul>
                        </td>

                        <td class="text-nowrap text-center">
                          @can('Permissões.Detalhes')
                            <a href="{{ route('acl.funcoes.mostrar', $funcao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
                          @endcan

                          @can('Permissões.Editar')
                            <a href="{{ route('acl.funcoes.editar', $funcao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
                          @endcan
                          
                          @can('Permissões.Excluir')
                            @if($funcao->deleted_at == null)
                              <a href="{{ route('pessoa.show', $funcao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                            @else
                              <a href="{{ route('pessoa.show', $funcao) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
                            @endif
                          @endcan

                        </div>
                      </td> 
                    </tr>
                    @empty
                    <tr>
                      <td class="text-center" colspan="8">Não há resultados para essa tabela.</td>
                    </tr>
                    @endforelse
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
    <a href="{{ route('acl.permissoes') }}" class="btn btn-secondary">Voltar</a>
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

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
