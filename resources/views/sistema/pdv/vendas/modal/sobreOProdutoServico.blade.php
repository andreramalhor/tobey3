<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_sobreOProdutoServico">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sobre o Produto / Serviço</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-8">
            <div class="row">
              <div class="col-2">
                <div class="form-group">
                  <label>ID</label>
                  <input type="text" class="form-control form-control-sm" id="m2_id" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Tipo</label>
                  <input type="text" class="form-control form-control-sm" id="m2_tipo" disabled="disabled">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control form-control-sm" id="m2_nome" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Marca</label>
                  <input type="text" class="form-control form-control-sm" id="m2_marca" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Categoria</label>
                  <input type="text" class="form-control form-control-sm" id="m2_categoria" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Tipo do Preço</label>
                  <input type="text" class="form-control form-control-sm" id="m2_tipo_preco" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Duração</label>
                  <input type="time" class="form-control form-control-sm" id="m2_duracao" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Vlr Venda</label>
                  <input type="text" class="form-control form-control-sm text-right" id="m2_vlr_venda" disabled="disabled">
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <label>Profissionais que executam o serviço</label>
            <table class="table table-hover table-bordered table-condensed table-sm">
              <thead>
                <tr style="background-color: #222d32; color: white;">
                  <th class="text-center">Nome</th>
                  <th class="text-center">Comissão</th>
                </tr>
              </thead>
              <tbody id="m2_profissionais">
                <tr>
                  <td class="text-center" colspan="2">Nenhuma profissional executa esse serviço.</td>
                </tr>
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
