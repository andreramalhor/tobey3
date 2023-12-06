<div class="modal fade" id="modal_agendamentos_filtrar" aria-hidden="true" style="display: none; color: black;">
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
                <input type="text" class="form-control form-control-sm" name="id_cliente" id="id_cliente">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Profissional</label>
                <input type="text" class="form-control form-control-sm" name="id_profexec" id="id_profexec">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Serviço</label>
                <input type="text" class="form-control form-control-sm" name="id_servprod" id="id_servprod">
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control form-control-sm" name="sexo" id="sexo">
                  <option value="">Todos</option> 
                  <option value="Agendado">Agendado</option>
                  <option value="Confirmado">Confirmado</option>
                  <option value="Finalizado">Finalizado</option>
                  <option value="Atrasado">Atrasado</option>
                  <option value="Faltou">Faltou</option>
                  <option value="Fixa">Fixa</option>
                  <option value="Fechado">Fechado</option>
                </select>
              </div>
            </div>
            <div class="col-4"></div>
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
                  <option value="id" selected>ID</option> 
                  <option value="id_cliente">ID Cliente</option> 
                  <option value="id_servprod">ID Serviço</option> 
                  <option value="id_profexec">ID Profissional</option> 
                  <option value="start">Início</option> 
                  <option value="end">Final</option> 
                  <option value="obs">Observação</option> 
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

          <button type="button" class="btn btn-primary btn-sm" onclick="agendamentos_tabelar()" data-bs-dismiss="modal">Filtrar</button>
        </div>
      </div>
    </div>
  </form>
</div>
