@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      {{-- <div class="overlay" id="overlay_contasContabil">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div> --}}
      <div class="card-header">
        <h3 class="card-title">Plano de Contas</h3>
        <div class="card-tools">
          <div class="btn-group">
            <a class="btn b btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modal_criarContasContabil" id="categorias_contasContabil"><i class="fas fa-plus"></i></a>
            <a class="btn b btn-default btn-sm" onclick="load_contasContabil()"><i class="fas fa-sync-alt"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Nível</th>
              <th class="text-left">Conta</th>
              <th class="text-left">Descrição</th>
              <th class="text-center">Imprime</th>
              <th class="text-center">Soma</th>
              <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody id="tabela-contas-contabil">
            @forelse ($contas->sortBy('conta_pai')->sortBy('conta') as $conta)
              <tr>
                <td class="text-center">{{ $conta->id }}</td>
                <td class="text-center">{{ $conta->nivel }}</td>
                <td class="text-left">{{ $conta->conta }}</td>
                <td class="text-left">{{ $conta->descricao }}</td>
                <td class="text-center">{{ $conta->imprime }}</td>
                <td class="text-center">{{ $conta->soma }}</td>
                <td class="text-center">...</td>
              </tr>
            @empty
              <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_criarContasContabil">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="POST" autocomplete="off" id="form_add_contasContabil">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Criar Nova Conta Contábil</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-2">
              <div class="form-group">
                <label>Nível</label>
                <input type="text" class="form-control form-control-sm" name="nivel" id="nivel" value="">
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Conta</label>
                <input type="text" class="form-control form-control-sm" name="conta" id="conta" value="">
              </div>
            </div>
            <div class="col-8">
              <div class="form-group">
                <label>Descrição</label>
                <input type="text" class="form-control form-control-sm" name="descricao" id="descricao" value="">
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Conta Pai</label>
                <input type="text" class="form-control form-control-sm" name="conta_pai" id="conta_pai" value="">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Imprime</label>
                <select class="form-control form-control-sm" name="imprime" id="imprime">
                  <option value="Sim">Sim</option>
                  <option value="Não">Não</option>
                </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Soma</label>
                <select class="form-control form-control-sm" name="soma" id="soma">
                  <option value="Sim">Sim</option>
                  <option value="Não">Não</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="reset" class="btn btn-default btn-sm" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary btn-sm" type="submit">Criar</button>
        </div>
      </form>
    </div>
  </div>
</div>
  
{{--   
  @push('js')
  <script type="text/javascript">
    $(document).ready( function() {
      load_contasContabil()
    });
  
    function load_contasContabil() {
      $('#overlay_contasContabil').show();
  
      axios.get("{{ route('sistema.load_contasContabil') }}")
      .then(function(response) {
        $('#tabela-contas-contabil').empty();
        
        (response.data).forEach((obj, i) => {
          $('#tabela-contas-contabil').append(
            '<tr>'+
            '<td class="text-center">'+obj.id+'</td>'+
            '<td class="text-left">'+obj.nome+'</td>'+
            '<td class="text-center">'+
            '<div class="btn-group">'+
            '<a onclick="apagarCategorias('+obj.id+');" class="btn btn-outline-danger btn-xs" data-bs-tooltip="tooltip" data-bs-title="Remover"><i class="fas fa-times"></i></a>'+
            '</div>'+
            '</td>'+
            '</tr>'
            );
        });
      })
  @include('includes.catch', [ 'codigo_erro' => '5392695a' ] )
      .then( function(response) {
        $('#overlay_contasContabil').hide();
      })
    }
  
    function criarCategorias() {
      let dados = $('#form_add_contasContabil').serialize();
  
      axios.post('{{ route('sistema.store_contasContabil') }}', dados)
      .then( function(response) {
        // console.log(response)
        toastrjs( response.data.type, response.data.message )
        $('#cancel_contasContabil_contasContabil').click();
        load_contasContabil();
      })
  @include('includes.catch', [ 'codigo_erro' => '9894623a' ] )
    }
  
    function apagarCategorias(id) {
      url = "{{ route('sistema.delete_contasContabil', ':id') }}";
      url = url.replace(':id', id );
  
      axios.post(url)
      .then(function(response) {
        toastrjs( response.data.type, response.data.message )
        $('#cancel_contasContabil_contasContabil').click();
        load_contasContabil();
      })
  @include('includes.catch', [ 'codigo_erro' => '3186765a' ] )
    }
  
    $("#cancel_contasContabil_contasContabil").on('click', function(e) {
      e.preventDefault();
      
      $('#nome').val("");
      $('#descricao').val("");
      $('#categoria').val("");
    });
  
  </script>
  @endpush
  </div>
--}}

@endsection
