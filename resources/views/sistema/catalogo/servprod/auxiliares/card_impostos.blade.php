<div class="card">
  <div class="card-header">
    <h3 class="card-title">Impostos</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-3">
        <div class="form-group">
          <label class="col-form-label">NCM</label>
          <input type="text" class="form-control form-control-sm" name="ncm_prod_serv" value="{{ $servprod->ncm_prod_serv ?? 0 }}">
        </div>
      </div>
      
      <div class="col-3">
        <div class="form-group">
          <label class="col-form-label">IPI</label>
          <input type="text" class="form-control form-control-sm" name="ipi_prod_serv" value="{{ $servprod->ipi_prod_serv ?? 0 }}">
        </div>
      </div>
      
      <div class="col-3">
        <div class="form-group">
          <label class="col-form-label">ICMS</label>
          <input type="text" class="form-control form-control-sm" name="icms_prod_serv" value="{{ $servprod->icms_prod_serv ?? 0 }}">
        </div>
      </div>
      
      <div class="col-3">
        <div class="form-group">
          <label class="col-form-label">Simples Nacional</label>
          <input type="text" class="form-control form-control-sm" name="simples_prod_serv" value="{{ $servprod->simples_prod_serv ?? 0 }}">
        </div>
      </div>

    </div>
  </div>
</div>