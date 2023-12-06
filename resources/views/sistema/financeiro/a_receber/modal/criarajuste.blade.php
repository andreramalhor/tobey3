<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_criarAjuste">
  <form action="{{ route('comissao.criarAjuste') }}" method="POST" autocomplete="off" id="form_criarAjuste">
    {!! csrf_field() !!}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Lançar Ajuste para {{ $aberto->first()->xeypqgkmimzvknq->apelido }}</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="text" name="id_origem">
            <input type="text" name="fonte_origem"                   value="fin_conta_interna">
            <input type="text" name="id_pessoa"                      value={{ $aberto->first()->id_pessoa }}>
            <input type="text" name="tipo"          id="tipo">
            <input type="text" name="percentual"                     value="1">
            <input type="text" name="valor"         id="valor">
            <input type="text" name="dt_quitacao">
            <input type="text" name="id_destino">
            <input type="text" name="fonte_destino">
            <input type="text" name="status"                         value="Em Aberto">

            <div class="col-4">
              <div class="form-group">
                <label>Descrição</label>
                <input type="text" class="form-control form-control-sm" name="descricao" id="descricao">
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Valor</label>
                <input type="text" class="form-control form-control-sm" id="x_valor" value="{{ number_format(0, 2, ',', '.') }}" style="text-align:right">
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Data Prevista</label>
                <input type="date" class="form-control form-control-sm" name="dt_prevista" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
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