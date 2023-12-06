<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_compras">
  <form action="{{ route('compra.filtrar') }}" method="POST" autocomplete="off" id="form_compras">
    {!! csrf_field() !!}
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
            @include('includes.form.text', [ 'colunas' => '12', 'name' => 'nome', 'id' => 'nome', 'label' => 'Nome', 'value' => $dataForm['nome'] ?? '' ])

            <div class="col-12">
              <div class="form-group">
                <label>Marca</label>
                <select class="form-control form-control-sm" name="marca" id="marca">
                  

                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="reset" class="btn btn-default btn-xs" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary btn-xs">Filtrar</button>
        </div>
      </div>
    </div>
  </form>
</div>
