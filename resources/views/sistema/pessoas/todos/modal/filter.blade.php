<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_filter">
  <form autocomplete="off" id="form_filter">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card-header d-flex p-0">
          <h5 class="modal-title p-3">Filtro</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label>Nome ou Apelido</label>
                <input type="text" class="form-control form-control-sm" name="apelido" id="apelido">
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
            <hr>
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
                  <option value="apelido">Apelido</option> 
                  <option value="nome">Nome</option> 
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
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-sm" id="btn_clean" onclick="cleanFilter()" data-bs-dismiss="modal">Limpar</button>
          <button type="button" class="btn btn-primary btn-sm" id="btn_filter" onclick="loadPeople()" data-bs-dismiss="modal">Filtrar</button>
        </div>
      </div>
    </div>
    @csrf
  </form>
</div>
