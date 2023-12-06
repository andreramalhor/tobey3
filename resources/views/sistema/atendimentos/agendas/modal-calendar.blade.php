<div class="modal fade" id="modal-calendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="message"></div>
        <form id="formEvent">
          <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">Título</label>
            <div class="col-sm-8">
              <input type="text" name="title" class="form-control" id="title" placeholder="Título" value="">
              <input type="hidden" name="id" id="id">
            </div>
          </div>
          <div class="form-group row">
            <label for="start" class="col-sm-4 col-form-label">Início</label>
            <div class="col-sm-8">
              <input type="text" name="start" class="form-control date-time" id="start" placeholder="Início" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="end" class="col-sm-4 col-form-label">Final</label>
            <div class="col-sm-8">
              <input type="text" name="end" class="form-control date-time" id="end" placeholder="Final" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-sm-4 col-form-label">Descrição</label>
            <div class="col-sm-8">
              <textarea name="description" class="form-control" id="description" placeholder="Descrição" value="" rows="4"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="color" class="col-sm-4 col-form-label">Cor</label>
            <div class="col-sm-8">
              <input type="color" name="color" id="color" placeholder="Cor" value="">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-danger deleteEvent">Excluir</button>
        <button type="button" class="btn btn-primary saveEvent">Salvar</button>
      </div>
    </div>
  </div>
</div>