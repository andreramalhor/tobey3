<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_sobreOCliente">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sobre o Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-5">
            <div class="row">
              <div class="col-2">
                <div class="widget-user-image">
                  <img class="img-circle text-center" id="m1_picture" src="{{ asset('img/Atendimentos/Pessoas/Perfil/0.png') }}" width="60px" style="margin-left: 10px">
                </div>
              </div>
              <div class="col-2">
                <div class="form-group">
                  <label>ID</label>
                  <input type="text" class="form-control form-control-sm" id="m1_id" disabled="disabled">
                </div>
              </div>
              <div class="col-8">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control form-control-sm" id="m1_nome" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Apelido</label>
                  <input type="text" class="form-control form-control-sm" id="m1_apelido" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>CPF</label>
                  <input type="text" class="form-control form-control-sm" id="m1_cpf" disabled="disabled">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label>Instagram</label>
                  <input type="text" class="form-control form-control-sm" id="m1_instagram" disabled="disabled">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Observação</label>
                  <input type="text" class="form-control form-control-sm" id="m1_observacao" disabled="disabled">
                </div>
              </div>
              <br>
              <div class="col-12">
                <table class="table table-hover table-bordered table-condensed table-sm">
                  <thead>
                    <tr style="background-color: #222d32; color: white;">
                      <th class="text-center">Tipo</th>
                    </tr>
                  </thead>
                  <tbody id="m1_tipos">
                    <tr>
                      <td class="text-center" colspan="2">Nenhum tipo determinado.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-7">
            <table class="table table-hover table-bordered table-condensed table-sm">
              <thead>
                <tr style="background-color: #222d32; color: white;">
                  <th class="text-center">Comanda</th>
                  <th class="text-center">Data</th>
                  <th class="text-center">Produto</th>
                  <th class="text-center">Profissional</th>
                  <th class="text-center">Valor Pago</th>
                </tr>
              </thead>
              <tbody id="m1_vendas">
                <tr>
                  <td class="text-center" colspan="5">Nenhuma venda feita anteriormente.</td>
                </tr>
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
