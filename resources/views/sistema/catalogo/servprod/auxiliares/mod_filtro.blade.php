<div class="modal fade" id="modal_produtos_filtrar" aria-hidden="true" style="display: none; color: black;">
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
                <label>Nome</label>
                <input type="text" class="form-control form-control-sm" name="nome" id="nome">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Tipo</label>
                  <input type="text" class="form-control form-control-sm" name="tipo" id="tipo">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Categoria</label>
                <select class="form-control form-control-sm" name="id_categoria" id="id_categoria">
                  <option value=""></option> 
                  <option value="1">Cabelo (Serviço)</option>
                  <option value="2">Manicure e Pedicure (Serviço)</option>
                  <option value="3">Alongamento de Unhas (Serviço)</option>
                  <option value="4">Depilação (Serviço)</option>
                  <option value="5">Designer de Sobrancelhas (Serviço)</option>
                  <option value="6">Cílios (Serviço)</option>
                  <option value="7">Produção (Serviço)</option>
                  <option value="8">Estética (Serviço)</option>
                  <option value="9">Cabelo (Produto)</option>
                  <option value="10">Corpo (Produto)</option>
                  <option value="11">Unhas (Produto)</option>
                  <option value="99">Atribuir Depois</option>
                  <option value="13">Produtos de Consumo (Cozinha)</option>
                  <option value="12">Lanches / Geladeira</option>
                </select>
              </div>
            </div>

            <div class="col-6"></div>
            <div class="col-2">
              <div class="form-group">
                <label>Itens por Pág.</label>
                <select class="form-control form-control-sm" name="qtd_page" id="qtd_page">
                  <option value="10">10</option> 
                  <option value="15">15</option> 
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
                  <option value="nome">Nome</option> 
                  <option value="tipo">Tipo</option> 
                  <option value="id_categoria">Categoria</option> 
                  <option value="vlr_venda">Valor de Venda</option> 
                  <option value="vlr_custo">Valor de Custo</option> 
                  <option value="marca">Marca</option> 
                  <option value="estoque_atual">Estoque Atual</option> 
                </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Ordem</label>
                <select class="form-control form-control-sm" name="ordem" id="ordem">
                  <option value="asc">Asc</option> 
                  <option value="desc">Desc</option> 
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between" style="padding: 6px 12px">
          <a class="btn btn-default" style="color:black" data-bs-dismiss="modal" id='cancel_modal_funcoes_usuarios_incluir'>Cancel</a>

          {{-- <button type="button" class="btn btn-default btn-sm" id="btn_clean" onclick="cleanFilter()" data-bs-dismiss="modal">Limpar</button> --}}

          <button type="button" class="btn btn-primary btn-sm" onclick="produtos_tabelar()" data-bs-dismiss="modal">Filtrar</button>
        </div>
      </div>
    </div>
  </form>
</div>
