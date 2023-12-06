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
        <input type="text" class="form-control form-control-sm" name="nome">
      </div>

      <div class="col-3">
        <label class="col-form-label">Tipo</label>
        <select class="form-control form-control-sm" name="tipo">
          <option value="Produto">Produto</option>
          <option value="Serviço">Serviço</option>
          <option value="Consumo">Consumo</option>
        </select>
      </div>

      <div class="col-3">
        <label class="col-form-label">Categoria</label>
        <select class="form-control form-control-sm" name="id_categoria">
          <option value="1">Cabelo (Serviço)</option>
          <option value="2">Manicure e Pedicure (Serviço)</option>
          <option value="3">Alongamento de Unhas (Serviço)</option>
          <option value="4">Depilação (Serviço)</option>
          <option value="5">Designer de Sobrancelhas (Serviço)</option>
          <option value="6">Cílios (Serviço)</option>
          <option value="7">Produção (Serviço)</option>
          <option value="8">Estética (Serviço)</option>
          <option value="9">Cabelo (Produto)</option>
          <option value="10">Corpo (Produto)</option>
          <option value="11">Unhas (Produto)</option>
          <option value="99">Atribuir Depois</option>
          <option value="13">Produtos de Consumo (Cozinha)</option>
          <option value="12">Lanches / Geladeira</option>
        </select>
      </div>
      
      <div class="col-4">
        <label class="col-form-label">Marca</label>
        <input type="text" class="form-control form-control-sm" name="marca">
      </div>
      
      <div class="col-4">
        <label class="col-form-label">Código da Nota Fiscal</label>
        <input type="text" class="form-control form-control-sm" name="cod_nota" value="0">
      </div>
      
      <div class="col-4">
        <label class="col-form-label">Código de Barras</label>
        <input type="text" class="form-control form-control-sm" name="cod_barras" value="0">
      </div>
      
      <div class="col-12">
        <label class="col-form-label">Descrição</label>
        <input type="text" class="form-control form-control-sm" name="descricao">
      </div>

    </div>
  </div>
</div>