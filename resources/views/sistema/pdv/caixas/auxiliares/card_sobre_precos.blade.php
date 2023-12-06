<div class="card">
  <div class="card-header">
    <h3 class="card-title">Sobre Preços</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-4">
        <label class="col-form-label">Tipo de Preço</label>
        <select class="form-control form-control-sm" name="tipo_preco">
          <option value="Preço fixo" {{ (isset($produto->tipo_preco) && $produto->tipo_preco == 'Preço fixo') ? 'selected' : '' }}>Preço fixo</option>
          <option value="Preço variável" {{ (isset($produto->tipo_preco) && $produto->tipo_preco == 'Preço variável') ? 'selected' : '' }}>Preço variável</option>
          <option value="Consumo" {{ (isset($produto->tipo_preco) && $produto->tipo_preco == 'Consumo') ? 'selected' : '' }}>Consumo</option>
        </select>
      </div>
      
      <div class="col-3">
        <div class="form-group">
          <label class="col-form-label">Preço de Venda<font color="red">*</font></label>
          <input type="text" class="form-control form-control-sm" name="vlr_venda" value="{{ $produto->vlr_venda ?? 0 }}">
        </div>
      </div>
    </div>
  </div>
</div>