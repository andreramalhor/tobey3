<div class="card">
  <div class="card-header">
    <h3 class="card-title">Sobre Preços</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <label class="col-form-label">Tipo de Preço</label>
        <select class="form-control form-control-sm" name="tipo_preco">
          <option value="Preço fixo" {{ (isset($servprod->tipo_preco) && $servprod->tipo_preco == 'Preço fixo') ? 'selected' : '' }}>Preço fixo</option>
          <option value="Preço variável" {{ (isset($servprod->tipo_preco) && $servprod->tipo_preco == 'Preço variável') ? 'selected' : '' }}>Preço variável</option>
          {{-- <option value="Consumo" {{ (isset($servprod->tipo_preco) && $servprod->tipo_preco == 'Consumo') ? 'selected' : '' }}>Consumo</option> --}}
        </select>
      </div>
      
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="form-group">
          <label class="col-form-label">Preço de Venda<font color="red">*</font></label>
          <input type="text" class="form-control form-control-sm text-right dinheiro" name="vlr_venda" value="{{ $servprod->vlr_venda ?? '0,00' }}">
          <input type="hidden" name="vlr_mercado" value="0">
          <input type="hidden" name="vlr_nota" value="0">
          <input type="hidden" name="vlr_frete" value="0">
          <input type="hidden" name="vlr_comissao" value="0">
          <input type="hidden" name="vlr_marg_contribuicao" value="0">
          <input type="hidden" name="vlr_custo" value="0">
          <input type="hidden" name="vlr_custo_estoque" value="0">
        </div>
      </div>
      
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="form-group">
          <label class="col-form-label">Comissão Padrão</label>
          <input type="text" class="form-control form-control-sm text-right percentual" name="prc_comissao" value="{{ $servprod->prc_comissao ?? 0 }}">
          <input type="hidden" name="ativo" value="1">
        </div>
      </div>
    </div>
  </div>
</div>