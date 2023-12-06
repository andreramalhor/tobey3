<div class="card">
  <div class="card-header">
    <h3 class="card-title">Sobre Preços</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-4">
        <label class="col-form-label">Tipo de Preço</label>
        <select class="form-control form-control-sm" name="tipo_preco">
          <option value="Preço fixo" {{ (isset($servico->tipo_preco) && $servico->tipo_preco == 'Preço fixo') ? 'selected' : '' }}>Preço fixo</option>
          <option value="Preço variável" {{ (isset($servico->tipo_preco) && $servico->tipo_preco == 'Preço variável') ? 'selected' : '' }}>Preço variável</option>
          <option value="Consumo" {{ (isset($servico->tipo_preco) && $servico->tipo_preco == 'Consumo') ? 'selected' : '' }}>Consumo</option>
        </select>
      </div>
      
      <div class="col-3">
        <div class="form-group">
          <label class="col-form-label">Preço de Venda<font color="red">*</font></label>
          <input type="text" class="form-control form-control-sm" name="vlr_venda" value="{{ $servico->vlr_venda ?? 0 }}">
        </div>
      </div>
    </div>
  </div>
</div>