<div class="card">
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <input type="hidden" name="imagem_temp" id="imagem_temp" value="">
  <div class="card-header">
    <h3 class="card-title">Dados Produtos</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <label class="col-form-label">Nome<font color="red">*</font></label>
        <input type="text" class="form-control form-control-sm" name="nome" value="{{ $produto->nome ?? '' }}">
      </div>

      <div class="col-3">
        <label class="col-form-label">Tipo</label>
        <select class="form-control form-control-sm" name="tipo">
          <option value="Produto" {{ (isset($produto->tipo) && $produto->tipo == 'Produto') ? 'selected' : '' }}>Produto</option>
          <option value="Serviço" {{ (isset($produto->tipo) && $produto->tipo == 'Serviço') ? 'selected' : '' }}>Serviço</option>
          <option value="Consumo" {{ (isset($produto->tipo) && $produto->tipo == 'Consumo') ? 'selected' : '' }}>Consumo</option>
        </select>
      </div>

      <div class="col-3">
        <label class="col-form-label">Categoria</label>
        <select class="form-control form-control-sm" name="id_categoria">
          <option value="1" {{ (isset($produto->id_categoria) && $produto->id_categoria == 1) ? 'selected' : '' }}>Cursos</option>
          <option value="2" {{ (isset($produto->id_categoria) && $produto->id_categoria == 2) ? 'selected' : '' }}>Produtos (Cabelos)</option>
          <option value="3" {{ (isset($produto->id_categoria) && $produto->id_categoria == 3) ? 'selected' : '' }}>Produtos (Unhas)</option>
          <option value="4" {{ (isset($produto->id_categoria) && $produto->id_categoria == 4) ? 'selected' : '' }}>Produtos (Maquiagem)</option>
          <option value="5" {{ (isset($produto->id_categoria) && $produto->id_categoria == 5) ? 'selected' : '' }}>Produtos (Depilação)</option>
          <option value="6" {{ (isset($produto->id_categoria) && $produto->id_categoria == 6) ? 'selected' : '' }}>Produtos (Barbearia)</option>
          <option value="7" {{ (isset($produto->id_categoria) && $produto->id_categoria == 7) ? 'selected' : '' }}>Camisas e Aventais</option>
          <option value="8" {{ (isset($produto->id_categoria) && $produto->id_categoria == 8) ? 'selected' : '' }}>Apostilas</option>
          <option value="9" {{ (isset($produto->id_categoria) && $produto->id_categoria == 9) ? 'selected' : '' }}>Venda Direta Salon (VD)</option>
          <option value="10" {{ (isset($produto->id_categoria) && $produto->id_categoria == 10) ? 'selected' : '' }}>Serviços Modelos</option>
          <option value="11" {{ (isset($produto->id_categoria) && $produto->id_categoria == 11) ? 'selected' : '' }}>Diamind Nutri (Parceiro)</option>
        </select>
      </div>
      
      <div class="col-4">
        <label class="col-form-label">Marca</label>
        <input type="text" class="form-control form-control-sm" name="marca" value="{{ $produto->marca ?? '' }}">
      </div>
      
      <div class="col-4">
        <label class="col-form-label">Código da Nota Fiscal</label>
        <input type="text" class="form-control form-control-sm" name="cod_nota" value="{{ $produto->cod_nota ?? '' }}">
      </div>
      
      <div class="col-4">
        <label class="col-form-label">Código de Barras</label>
        <input type="text" class="form-control form-control-sm" name="cod_barras" value="{{ $produto->cod_barras ?? '' }}">
      </div>
      
      <div class="col-12">
        <label class="col-form-label">Descrição</label>
        <input type="text" class="form-control form-control-sm" name="descricao" value="{{ $produto->descricao ?? '' }}">
      </div>

    </div>
  </div>
</div>