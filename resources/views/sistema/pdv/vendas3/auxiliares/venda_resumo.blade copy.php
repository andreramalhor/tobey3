<form action="">
  @dump($venda['pdv_vendas_detalhes_id_servprod'], $venda, $venda->produtos)
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Resumo da Venda</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="row invoice-info">
            <div class="col-2">
              <h7><b>CLIENTE</b></h7></br>
              <strong>#id</strong>
              <input type="hidden" name="pdv_vendas[id_cliente]" value="{{ isset($venda->cliente) ? $venda->cliente->id : 0 }}">
              <p class="text-muted mb-1">{{ isset($venda->cliente) ? $venda->cliente->id : '0' }}</p>
              
              <strong>Nome</strong>
              <p class="text-muted mb-1">{{ isset($venda->cliente) ? $venda->cliente->nome : '(Cliente sem cadastro)' }}<br>{{ isset($venda->cliente) ? '('.$venda->cliente->apelido.')' : '' }}</p>
              
              <strong>CPF</strong>
              <p class="text-muted">{{ isset($venda->cliente) ? $venda->cliente->cpf : '000.000.000.00' }}</p>
            </div>
            
            <div class="col-6">
              <h7 class="pl-0"><b>PRODUTOS / SERVIÇOS</b></h7></br>
              <div class="col-12 table-responsive pl-0">
                <table class="table table-sm table-striped no-padding table-valign-middle">
                  <thead class="table-dark">
                    <tr>
                      <th style="width: 10%;">#id</th>
                      <th style="width: 45%;">Descrição</th>
                      <th style="width: 15%;" class="text-right">Valor</th>
                      <th style="width: 15%;" class="text-center">Qtd</th>
                      <th style="width: 15%;" class="text-right">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($venda->produtos))
                    @foreach($venda->produtos as $produto)
                    @dump($venda->produtos, $produto)
                      <tr>
                        <td>33</td>
                        <td>Escova P</td>
                        <td class="text-right">R$ 64,55</td>
                        <td class="text-center">2</td>
                        <td class="text-right">R$ 614,50</td>
                      </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="5" class="text-center">Ainda não foi lançado nenhum produto / serviço.</td>
                      </tr>
                    @endif
                  </tbody>
                  @if(isset($venda->produtos))
                  <tfoot>
                    <tr>
                      <td>4</td>
                      <td></td>
                      <td class="text-right">R$ 64,55</td>
                      <td class="text-center">2</td>
                      <td class="text-right">R$ 614,50</td>
                    </tr>
                  </tfoot>
                  @endif
                </table>
              </div>        
            </div>
            {{--

            <div class="col-4">
              <h7 class="pl-0"><b>PAGAMENTOS</b></h7></br>
              <div class="col-12 table-responsive pl-0">
                <table class="table table-sm table-striped no-padding table-valign-middle">
                  <thead class="table-dark">
                    <tr>
                      <th style="width: 10%;">#id</th>
                      <th style="width: 45%;">Descrição</th>
                      <th style="width: 15%;" class="text-right">Valor</th>
                      <th style="width: 15%;" class="text-center">Qtd</th>
                      <th style="width: 15%;" class="text-right">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($venda->pagamentos))
                      @foreach($venda->pagamentos as $produto)
                      <tr>
                        <td>33</td>
                        <td>Escova P</td>
                        <td class="text-right">R$ 64,55</td>
                        <td class="text-center">2</td>
                        <td class="text-right">R$ 614,50</td>
                      </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="5" class="text-center">Ainda não hã registros de pagamentos.</td>
                      </tr>
                    @endif
                  </tbody>
                  @if(isset($venda->pagamentos))
                  <tfoot>
                    <tr>
                      <td>4</td>
                      <td></td>
                      <td class="text-right">R$ 64,55</td>
                      <td class="text-center">2</td>
                      <td class="text-right">R$ 614,50</td>
                    </tr>
                  </tfoot>
                  @endif
                </table>
              </div> 
            </div>
            --}}
  
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  // alert('s')
  dados = {
    pdv_vendas: {
      id_caixa       : null,
      id_usuario     : null,
      id_agendamento : null,
      id_cliente     : '{{ isset($venda->cliente) ? $venda->cliente->id  : 0 }}',
      qtd_produtos   : null,
      vlr_prod_serv  : null,
      vlr_negociado  : null,
      vlr_dsc_acr    : null,
      vlr_final      : null,
      status         : null,
    }, 
    pdv_vendas_detalhes : {
      id_servprod    : null,
      quantidade     : null,
      vlr_venda      : null,
      vlr_negociado  : null,
      vlr_dsc_acr    : null,
      vlr_final      : null,
      obs            : null,
      status         : null,
    },
    pdv_vendas_pagamentos : null,
    fin_contas_internas : {
      id_origem     : null,
      fonte_origem  : null,
      id_pessoa     : null,
      tipo          : null,
      percentual    : null,
      valor         : null,
      dt_prevista   : null,
      dt_quitacao   : null,
      id_destino    : null,
      fonte_destino : null,
      status        : null,
    },
    fin_recebimento_cartoes : null,
  }

</script>

<!-- <div class="row invoice-info">
  <div class="row pb-2">
    <strong>PRODUTOS / SERVIÇOS</strong>
  </div>
  <div class="col-2 invoice-col">
    <strong># Prod./Serv.</strong><br>
    <span>33.</span>
  </div>
  <div class="col-6 invoice-col">
    <strong>Descrição</strong><br>
    <span>Escova P</span>
  </div>
  <div class="col-4 invoice-col">
    <strong class="text-right">Valor</strong><br>
    <span class="text-right">R$ 100,00</span>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <dl>
      <dt class="col-sm-1">ID do Cliente:</dt>
      <dd class="col-sm-5">103203</dd>
      <dt class="col-sm-1">Nome Cliente:</dt>
      <dd class="col-sm-5">André Ramalho Celestino Rocha da Silva Sauro</dd>
    </dl>
    <div class="row pb-2">
      <strong>DADOS DO CLIENTE</strong>
    </div>
    <div class="col-2 invoice-col">
      <strong># Cliente</strong><br>
      <span>15021</span>
    </div>
    <div class="col-6 invoice-col">
      <strong>Nome</strong><br>
      <span>André Ramalho Celestino Rocha da Silva Sauro</span>
    </div>
    <div class="col-4 invoice-col">
      <strong>CPF</strong><br>
      <span>080.496.416-51</span>
    </div>
  </div>
</div>
<div class="row">
  
  <div class="col-4">
    <dl>
      <dt># Cliente</dt>
      <dd>303122</dd>
      <dt>Nome Cliente</dt>
      <dd>André Ramalho Celestino Rocha da Silva Sauro</dd>
      <dd>Donec id elit non mi porta gravida at eget metus.</dd>
      <dt>Malesuada porta</dt>
      <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
    </dl>
    <dl class="row">
      <dt class="col-sm-3">ID do Cliente:</dt>
      <dd class="col-sm-9">103203</dd>
      <dt class="col-sm-3">Nome Cliente:</dt>
      <dd class="col-sm-9">André Ramalho Celestino Rocha da Silva Sauro</dd>
    </dl>
  </div>
  <div class="col-3"></div>
  <div class="col-2"></div>
  <div class="col-3">
    <dl class="row">
      <dt class="col-sm-4">Euismod</dt>
      <dd class="col-sm-8">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
      <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
      <dt class="col-sm-4">Malesuada porta</dt>
      <dd class="col-sm-8">Etiam porta sem malesuada magna mollis euismod.</dd>
      <dt class="col-sm-4">Felis euismod semper eget lacinia</dt>
      <dd class="col-sm-8">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
    </dl>
  </div>
</div>
</div>
<div class="card-footer">
  <form action="#" method="post">
    <div class="input-group">
      <input type="text" name="message" placeholder="Type Message ..." class="form-control">
      <span class="input-group-append">
        <a class="btn btn-primary">Send</a>
      </span>
    </div>
  </form>
</div>
</div>
</div> -->
