<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_bancos">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Filtrar</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Banco</label>
              <select class="form-control form-control-sm" name="id_banco" id="id_banco">
                @foreach($bancos as $banco)
                <option value="{{ $banco->id }}" selected="">{{ $banco->nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a class="btn btn-primary btn-xs">Filtrar</a>
      </div>
    </div>
  </div>
</div>
