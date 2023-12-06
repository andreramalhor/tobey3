<div class="modal fade" id="modal_leads_filtrar" aria-hidden="true" style="display: none; color: black;">
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
            <div class="col-3">
              <div class="form-group">
                <label>Interesse</label>
                <select class="form-control form-control-sm" name="interesse" id="interesse">
                    <option value="">Todos</option>
                    <option value="frio">Frio</option>
                    <option value="morno">Morno</option>
                    <option value="quente">Quente</option>
                </select>
            </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control form-control-sm" name="status" id="status">
                  <option value="">Todos</option>
                  <option value="entrada_lead">Entrada do Lead</option>
                  <option value="apresentacao_curso">Apresentação do Curso</option>
                  <option value="proposta_enviada">Proposta Enviada</option>
                  <option value="negociando_venda">Negociando</option>
                  <option value="perdido">Perdidos</option>
                  <option value="ganho">Ganhos</option>
                  <option value="arquivado">Arquivados</option>
                  <option value="favoritos">Favoritos</option>
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
                  <option value="updated_at">Atualização</option>
                  <option value="nome">Nome</option>
                  <option value="cidade">Cidade</option>
                  <option value="id_origem">Origem</option>
                  <option value="interesse">Interesse</option>
                  <option value="status">Status</option>
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
          <a class="btn btn-default btn-sm" style="color:black" data-bs-dismiss="modal">Cancel</a>
          <button type="button" class="btn btn-primary btn-sm" onclick="leads_tabelar()" data-bs-dismiss="modal">Filtrar</button>
        </div>
      </div>
    </div>
  </form>
</div>
