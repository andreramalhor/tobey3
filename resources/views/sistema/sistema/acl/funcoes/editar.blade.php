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

                @foreach($permissoes->groupBy('grupo') as $grupo => $bloco_permissoes)
                  @if($loop->index % 3 == 0 && !$loop->first )
                  <div class="col-sm-2 invoice-col">
                      <strong class="text-muted"></strong><br>
                  </div>
                  @endif

                  @if($loop->index % 3 == 0 || $loop->index % 3 == 1 )
                      <div class="col-sm-3 invoice-col">
                  @else
                      <div class="col-sm-4 invoice-col">
                  @endif
                  <strong>{{ $grupo }}</strong><br>
                  @foreach($bloco_permissoes as $permissao)
                      @include('sistema.sistema.acl.funcoes.auxiliares.inc_editar_color_checkbox', [ 'funcao_permissoes' => $funcao->YXWBGTOOPLYJJAZ, 'nome_permissao' => $permissao->nome, 'local' => $permissao->descricao, 'id' => $permissao->id ])
                  @endforeach
                  </div>

                  @if($loop->index % 3 == 2)
                  <div class="col-sm-12 invoice-col">
                      <br>
                  </div>
                  @endif

                @endforeach

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
@include('includes.catch', [ 'codigo_erro' => '5863810a' ] )
  }

  function funcoes_permissoes_verificar(item)
  {
    let id_permissao = item.id;

    $(item).attr( 'checked', true )
    if ($(item).is(':checked'))
    {
      $(item).attr( 'checked', true )
      funcoes_permissoes_adicionar(id_permissao, 'on')
    }
    else
    {
      $(item).attr( 'checked', false )
      funcoes_permissoes_adicionar(id_permissao, 'off')
    }
  }

  function funcoes_permissoes_adicionar(id_permissao, status)
  {
    var url = "{{ route('acl.funcoes.permissoes', $funcao->id) }}";

    axios.post(url, [{
      id     : id_permissao,
      status : status
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '2399763a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
