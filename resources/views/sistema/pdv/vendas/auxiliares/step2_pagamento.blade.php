<div class="row">
  <div class="pb-4">
    <button class="btn btn-sm btn-primary" onclick="stepper1.previous()">Anterior</button>
    <button class="btn btn-sm btn-success float-end" id="stp_vendas_registrar" onclick="vendas_registrar()">Registrar</button>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="form-group">
          <label for="col-form-label pt-0">Forma de Pagamento</label>
          <select class="form-control form-control-sm" id="forma" onchange="formaspagamentos_preencher( $('#forma'), $('#bandeira') )">
            <option>Carregando . . .</option>
          </select>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <div class="form-group">
          <label for="col-form-label pt-0">Bandeira</label>
          <div class="input-group">
            <select class="form-control form-control-sm" id="bandeira" onchange="formaspagamentos_preencher( $('#bandeira'), $('#parcela') )" disabled="true">
              <option>Carregando . . .</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
        <div class="form-group">
          <label for="col-form-label pt-0">Parcela</label>
          <div class="input-group">
            <select class="form-control form-control-sm" id="parcela" onchange="formaspagamentos_preencher( $('#parcela'), $('#pri_vcto') )">
              <option>Carregando . . .</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
        <div class="form-group">
          <label for="col-form-label pt-0">1º Vencimento</label>
          <div class="input-group">
            <input type="date" class="form-control form-control-sm" id="pri_vcto" disabled="true" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" disabled="true">
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
        <div class="form-group">
          <label for="col-form-label pt-0">Valor</label>
          <div class="input-group">
            <input type="text" class="form-control form-control-sm dinheiro text-right" id="valor" disabled="true">
          </div>
          <span id="vlr_pagamento_feedback" class="pl-1 valid-feedback d-block">Total: <spam id="spam_vlr_total">-</spam> | Restante: <spam id="spam_vlr_restante">-</spam></span>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
        <div class="form-group">      
          <label class="col-form-label pt-0">&nbsp;</label>
          <div class="btn-group btn-block text-center">
            <button type="button" class="btn btn-info disabled" id="venda_pagamentos_adicionar" onclick="venda_pagamentos_adicionar()"><i class="fas fa-arrow-alt-circle-down"></i></button>
            <button type="button" class="btn btn-danger" onclick="formaspagamentos_resetar()"><i class="fas fa-minus-square"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function()
  {
    inputMasksActivate()
  })
  
  formaspagamentos_carregar()
  function formaspagamentos_carregar()
  {
    temp_formas_pagamentos = []
    @foreach($formas_pagamentos as $key => $forma_pagamento)
      temp_formas_pagamentos.push({
        id          : '{{ $forma_pagamento->id }}',
        forma       : '{{ $forma_pagamento->forma }}',
        tipo        : '{{ $forma_pagamento->tipo }}',
        bandeira    : '{{ $forma_pagamento->bandeira }}',
        parcela     : '{{ $forma_pagamento->parcela }}',
        taxa        : '{{ $forma_pagamento->taxa }}',
        prazo       : '{{ $forma_pagamento->prazo }}',
        pri_vcto    : '{{ $forma_pagamento->pri_vcto }}',
        recebimento : '{{ $forma_pagamento->recebimento }}',
        local       : '{{ $forma_pagamento->local }}',
        conferir    : '{{ $forma_pagamento->conferir }}',
        destino     : '{{ $forma_pagamento->destino }}',
      })
    @endforeach
    
    filtrado = temp_formas_pagamentos
    $('#forma').focus()
    formaspagamentos_verifica_valores()
  }
  
  // PREENCHER O CAMPO SEGUINTE
  formaspagamentos_preencher( null, $('#forma'))
  function formaspagamentos_preencher( atual, proximo )
  {
    percorrer_e_remover( proximo )
    
    proximo.empty().append('<option>Selecione . . .</option>')
    collect(filtrado).unique(proximo.attr('id')).each((value, key) =>
    {
      switch (proximo.attr('id'))
      {
        case 'forma':
          proximo.append('<option value="'+value.forma+'">'+value.forma+'</option>')
          proximo.focus()
          break;

        case 'bandeira':
          proximo.append('<option value="'+value.bandeira+'">'+value.bandeira+'</option>')
          proximo.prop('disabled', false).focus()
          break;
  
        case 'parcela':
          proximo.append('<option value="'+value.parcela+'">'+value.parcela+'</option>')
          proximo.prop('disabled', false).focus()
          break;
        
        case 'pri_vcto':
          proximo.append('<option value="'+value.pri_vcto+'">'+value.pri_vcto+'</option>')
          proximo.prop('disabled', false).focus()
          break;
          
        case 'recebimento':
          proximo.append('<option value="'+value.recebimento+'">'+value.recebimento+'</option>')
          proximo.prop('disabled', false).focus()
          break;
          
        case 'tipo':
            proximo.append('<option value="'+value.tipo+'">'+value.tipo+'</option>')
            proximo.prop('disabled', false).focus()
          break;

        default:
          break;
      }
    })
    
    formaspagamentos_conferir_tamanho()
  }
  
  function percorrer_e_remover( campo_a_preencher )
  {
    switch ( campo_a_preencher.attr('id') )
    {
      case 'forma':
        filtrado = collect(filtrado);
      break;
      
      case 'bandeira':
        filtrado = temp_formas_pagamentos
        filtrado = collect(filtrado).filter((value, key) => value.forma == $('#forma').val());
        temp.pdv_vendas_pagamento_forma = $('#forma').val()
      break;

      case 'parcela':
        filtrado = collect(filtrado).filter((value, key) => value.bandeira == $('#bandeira').val());
        temp.pdv_vendas_pagamento_bandeira = $('#bandeira').val()
      break;

      case 'pri_vcto':
        filtrado = collect(filtrado).filter((value, key) => value.parcela == $('#parcela').val());
        temp.pdv_vendas_pagamento_parcela = $('#parcela').val()
      break;

      case 'prazo':
        filtrado = collect(filtrado).filter((value, key) => value.pri_vcto == $('#pri_vcto').val());;
        temp.pdv_vendas_pagamento_pri_vcto = $('#pri_vcto').val()
      break;

      case 'recebimento':
        filtrado = collect(filtrado).filter((value, key) => value.prazo == $('#prazo').val());
        temp.pdv_vendas_pagamento_prazo = $('#prazo').val()
      break;

      case 'tipo':
        filtrado = collect(filtrado).filter((value, key) => value.recebimento == $('#recebimento').val());
        temp.pdv_vendas_pagamento_recebimento = $('#recebimento').val()
      break;

      default:
        console.log(filtrado);  
      break;
    }
  }
  
  function formaspagamentos_conferir_tamanho()
  {
    if(collect(filtrado).count() == 1)
    {
      $('#valor').prop('disabled', false).focus()
      $('#venda_pagamentos_adicionar').removeClass('disabled')
    }
    else
    {
      $('#venda_pagamentos_adicionar').addClass('disabled')
    }
  }

  function venda_pagamentos_adicionar()
  {
    $('#vendas-overlay').show()

    if(collect(filtrado).count())
    {
      let parcela = 1
      while ( parcela <= filtrado.first().parcela )
      {
        temp_pagamentos = {
          "identificador"      : index_p,
          "id_forma_pagamento" : filtrado.first().id,
          "descricao"          : filtrado.first().forma + ' - ' + filtrado.first().bandeira,
          "parcela"            : ("00" + parcela).slice(-2) + '/' + ("00" + filtrado.first().parcela).slice(-2),
          "valor"              : accounting.unformat($('#valor').val()) / filtrado.first().parcela,
          "dt_prevista"        : moment().add((filtrado.first().pri_vcto * parcela ), 'days').format('YYYY-MM-DD'),
          "status"             : 'Em Aberto',
          "conferir"           : filtrado.first().conferir,
          "destino"            : filtrado.first().destino,
        }

        if(filtrado.first().conferir == 1)
        {
          if(filtrado.first().destino == 'fin_contas_internas')
          {
            temp_pagamentos.fin_contas_internas = {
            "fonte_origem"       : 'pdv_vendas_pagamentos', 
            "id_pessoa"          : pdv_vendas.id_cliente, 
            "tipo"               : filtrado.first().forma, 
            "percentual"         : 0, 
            "valor"              : accounting.unformat($('#valor').val()) / filtrado.first().parcela, 
            "dt_quitacao"        : moment().add((filtrado.first().pri_vcto * parcela ), 'days').format('YYYY-MM-DD'), 
            "id_destino"         : null, 
            "fonte_destino"      : null, 
            "status"             : 'Em Aberto', 
            }
          }
          else if(filtrado.first().destino == 'fin_recebimentos_cartoes')
          {
            temp_pagamentos.fin_recebimentos_cartoes = {
              "id_forma_pagamento" : temp_pagamentos.id_forma_pagamento, 
              "vlr_real"           : temp_pagamentos.valor, 
              "prc_descontado"     : filtrado.first().taxa, 
              "vlr_final"          : (temp_pagamentos.valor - ( parseFloat(filtrado.first().taxa) * temp_pagamentos.valor / 100 )), 
              "dt_prevista"        : moment().add((filtrado.first().pri_vcto * parcela ), 'days').format('YYYY-MM-DD'), 
              "status"             : 'Em Aberto', 
              "id_lancamento"      : null, 
              "origem_lancamento"  : null, 
            }
          }
        }

        pdv_vendas_pagamentos.push(temp_pagamentos)
        parcela = parcela + 1
      }
      index_p = index_p + 1
    }
    
    $('#vendas-overlay').hide()

    vendas_form_preencher()
    formaspagamentos_resetar()
  }

  function formaspagamentos_resetar()
  {
    $('#forma').empty().append('<option>Carregando . . .</option>')
    $('#bandeira').prop('disabled', true).empty().append('<option>Carregando . . .</option>')
    $('#parcela').prop('disabled', true).empty().append('<option>Carregando . . .</option>')
    $('#pri_vcto').prop('disabled', true).val(moment().format('YYYY-MM-DD'))
    $('#valor').prop('disabled', true)

    formaspagamentos_verifica_valores()
    filtrado = temp_formas_pagamentos
    formaspagamentos_preencher( null, $('#forma'))
  }

  function formaspagamentos_verifica_valores()
  {
    temp.pdv_vendas_pagamentos_vlr_total    = collect(pdv_vendas_detalhes).sum('vlr_final')
    temp.pdv_vendas_pagamentos_vlr_pago     = collect(pdv_vendas_pagamentos).sum('valor')
    temp.pdv_vendas_pagamentos_vlr_restante = collect(pdv_vendas_detalhes).sum('vlr_final') - collect(pdv_vendas_pagamentos).sum('valor')
    
    $('#valor').val(accounting.formatMoney(temp.pdv_vendas_pagamentos_vlr_restante, ''))
    $('#spam_vlr_total').text(accounting.formatMoney(collect(dados.pdv_vendas_detalhes).sum('vlr_final')))
    $('#spam_vlr_restante').text(accounting.formatMoney(temp.pdv_vendas_pagamentos_vlr_restante))

    if(temp.pdv_vendas_pagamentos_vlr_restante == 0)
    {
      $('#stp_vendas_registrar').removeClass('d-none').removeClass('disabled')
    }
    else
    {
      $('#stp_vendas_registrar').addClass('disabled')
    }

  }

</script>