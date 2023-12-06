@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Editar Permissão</h3>
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
                <div class="col-sm-5 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $permissao->nome }}" placeholder="Nome" disabled>
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Nível</strong><br>
                </div>
                <div class="col-sm-5 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="nivel" id="nivel" value="{{ $permissao->nivel }}" placeholder="Nível" onchange="atualizar(this)">
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Ordem</strong><br>
                </div>
                <div class="col-sm-5 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="ordem" id="ordem" value="{{ $permissao->ordem }}" placeholder="Ordem" onchange="atualizar(this)">
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Menu</strong><br>
                </div>
                <div class="col-sm-5 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="menu" id="menu" value="{{ $permissao->menu }}" placeholder="Menu" onchange="atualizar(this)">
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>

                <div class="col-sm-2 invoice-col">
                  <strong class="text-muted">Descrição</strong><br>
                </div>
                <div class="col-sm-10 invoice-col">
                  <input type="text" class="form-control form-control-sm" name="descricao" id="descricao" value="{{ $permissao->descricao }}" placeholder="Descrição" onchange="atualizar(this)">
                </div>

                <div class="col-sm-12 invoice-col">
                  <br>
                </div>
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
    <a href="{{ route('acl.permissoes') }}" class="btn btn-secondary">Finalizar e Voltar</a>
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

  function atualizar(item)
  {    
    var url  = "{{ route('acl.permissoes.atualizar', $permissao->id) }}";

    axios.put(url, [{
      [item.name]: item.value,
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '5030330a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
