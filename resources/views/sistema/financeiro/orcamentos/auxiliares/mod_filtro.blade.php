<div class="modal fade" id="modal_lancamentos_filtrar" aria-hidden="true" style="display: none; color: black;">
  <div class="modal-dialog modal-lg">
    <form autocomplete="off" id="form-filtro">
      @csrf
      <div class="modal-content">
        {{-- <div class="overlay-modal-usuario-incluir"> --}}
          {{-- <i class="fas fa-2x fa-sync fa-spin"></i> --}}
        {{-- </div> --}}
        <div class="modal-header bg-navy" style="padding: 8px 16px">
          <h5 class="modal-title">Filtro</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label>Cliente</label>
                <select class="form-control form-control-sm select2" name="id_cliente" id="id_cliente">
                  <option value="">Carregando. . . </option>
                </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Banco</label>
                <select class="form-control form-control-sm" name="id_banco" id="id_banco">
                  <option value="">Todos</option> 
                  <option value="1">C6 Bank</option> 
                  <option value="2">ASAAS</option> 
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Data de Nascimento</label>
                <input type="date" class="form-control form-control-sm" name="dt_nascimento" id="dt_nascimento">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>CPF</label>
                <input type="text" class="form-control form-control-sm" name="cpf" id="cpf">
              </div>
            </div>
            <div class="col-6"></div>
            <div class="col-2">
              <div class="form-group">
                <label>Itens por Pág.</label>
                <select class="form-control form-control-sm" name="qtd_page" id="qtd_page">
                  <option value="10">10</option> 
                  <option value="15" selected>15</option> 
                  <option value="20">20</option> 
                  <option value="25">25</option> 
                  <option value="50">50</option> 
                  <option value="100">100</option> 
                  <option value="all">Todos</option> 
                </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Ordenar por</label>
                <select class="form-control form-control-sm" name="ordenar_por" id="ordenar_por">
                  <option value="dt_pagamento">Data de Pagamento</option> 
                  <option value="id">ID</option> 
                  <option value="cpf">CPF</option> 
                  <option value="instagram">Instagram</option> 
                </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Ordem</label>
                <select class="form-control form-control-sm" name="ordem" id="ordem">
                  <option value="desc">Desc</option> 
                  <option value="asc">Asc</option> 
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <a class="btn btn-default" style="color:black" data-bs-dismiss="modal" id='cancel_modal_funcoes_usuarios_incluir'>Cancel</a>

          {{-- <button type="button" class="btn btn-default btn-sm" id="btn_clean" onclick="cleanFilter()" data-bs-dismiss="modal">Limpar</button> --}}

          <button type="button" class="btn btn-primary btn-sm" onclick="lancamentos_tabelar()" data-bs-dismiss="modal">Filtrar</button>
        </div>
      </div>
    </div>
  </form>
</div>

@push('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  $(window).on('shown.bs.modal', function()
  { 
    $('#id_cliente').select2({
      dropdownParent: $('#modal_lancamentos_filtrar'),
    });
  });

  // pessoas_carregar()
  pss_todos = []
});

function pessoas_carregar()
{
  // console.log('aqui')
  // var url = "{{ route('atd.pessoas.pesquisar', ':tp') }}"
  // var url = url.replace(':tp', "mode=!=")

  // axios.get(url)
  // .then( function(response)
  // {
  //   // console.log(response)
  //   pss_pessoas = collect(response.data)
  //   $("#id_cliente").empty().append('<option value="">Selecione . . . </option>')
  //   pss_pessoas.sortBy('nomes').each((data) =>
  //   {
  //     $("#id_cliente").append('<option value="'+data.id+'">'+data.nomes+'</option>')
  //   })
  // })
  {{-- @include('includes.catch', [ 'codigo_erro' => '3874316a' ] ) --}}
  // .then( function()
  // {
  //   $("#overlay-cliente").hide()
  // })
}
</script>
@endpush