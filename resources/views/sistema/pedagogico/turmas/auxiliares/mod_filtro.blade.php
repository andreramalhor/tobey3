<div class="modal fade" id="modal_turmas_filtrar" aria-hidden="true" style="display: none; color: black;">
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
                <label>Sigla</label>
                <input type="text" class="form-control form-control-sm" name="sigla" id="sigla">
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Sexo</label>
                <select class="form-control form-control-sm" name="sexo" id="sexo">
                  <option value="">Todos</option>
                  <option value="F">F</option>
                  <option value="M">M</option>
                  <option value="Não Informado">Não Informado</option>
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
                  <option value="sigla">Sigla</option>
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

          <button type="button" class="btn btn-primary btn-sm" onclick="turmas_tabelar()" data-bs-dismiss="modal">Filtrar</button>
        </div>
      </div>
    </div>
  </form>
</div>
