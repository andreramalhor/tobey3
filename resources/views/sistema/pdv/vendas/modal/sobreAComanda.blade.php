<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_sobreAComanda">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Dados da Comanda</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @include('includes.form.text', [ 'colunas' => '12', 'name' => 'id_comanda',     'id' => 'm0_id_comanda',       'label' => '# Comanda',                            'value' => $dataForm['id_comanda'] ?? '' ])
          @include('includes.form.text', [ 'colunas' => '3',                              'id' => 'm0_id_cliente',       'label' => '# Cliente',                            'value' => $dataForm['id_cliente'] ?? '' ])
          @include('includes.form.text', [ 'colunas' => '9',                              'id' => 'm0_nome_cliente',     'label' => 'Nome do Cliente',                      'value' => $dataForm['nome_cliente'] ?? '' ])
          @include('includes.form.text', [ 'colunas' => '12',                             'id' => 'm0_qtd_produtos',     'label' => 'Quantidade de Produtos e/ou Serviços', 'value' => $dataForm['qtd_produtos'] ?? 0 ])
          @include('includes.form.text', [ 'colunas' => '12',                             'id' => 'm0_vlr_dsc_acr',      'label' => 'Valores Descontados ou acrescidos',    'value' => $dataForm['vlr_dsc_acr'] ?? 0 ])
          @include('includes.form.text', [ 'colunas' => '6',                              'id' => 'm0_vlr_prod_serv',    'label' => 'Valores dos Produtos',                 'value' => $dataForm['vlr_prod_serv'] ?? 0 ])
          @include('includes.form.text', [ 'colunas' => '6',                              'id' => 'm0_vlr_negociados',   'label' => 'Valores Negociados',                   'value' => $dataForm['vlr_negociados'] ?? 0 ])
        </div>
      </div>
    </div>
  </div>
</div>
