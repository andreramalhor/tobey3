<div class="row">
  <div class="pb-5">
    <button class="btn btn-sm btn-primary float-end" onclick="stepper1.next()">Próximo</button>
  </div>
</div>
<div class="row">
  <div class="col-2">
    <div class="form-group">
      <label for="col-form-label">Adicionar Cliente</label>
      <span class="btn btn-sm btn-primary btn-block" onclick="cliente_adicionar()"><i class="fas fa-user-plus"></i></span>
    </div>
  </div>
  <div class="col-1"></div>
  <div class="col-6">
    <div class="form-group">
      <label for="col-form-label">Nome do Cliente</label>
      <select class="form-control form-control-sm select2" onchange="cliente_selecionado( this.value )">
        <option value="0">( Cliente sem cadastro )</option>
        @foreach($clientes as $cliente)
        <option value="{{ $cliente->id }}">{{ $cliente->nomes }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-1"></div>
  <div class="col-2">
    <div class="form-group">
      <label for="col-form-label">Informações do Cliente</label>
      <span class="btn btn-sm btn-primary btn-block disabled" id='btn_cliente_info' onclick="cliente_info()"><i class="fas fa-circle-info"></i></span>    
    </div>
  </div>
</div>

@push('js')
<script>
  function cliente_adicionar()
  {
    alert('abrir modal cliente_adicionar')
  }

  function cliente_selecionado( id )
  {
    pdv_vendas = {
      id_caixa       : "{{ \Auth::User()->abcde->first()->id ?? 00 }}",
      id_usuario     : "{{ \Auth::User()->id }}",
      id_agendamento : null,
      id_cliente     : id,
      qtd_produtos   : null,
      vlr_prod_serv  : null,
      vlr_negociado  : null,
      vlr_dsc_acr    : null,
      vlr_final      : null,
      status         : 'Finalizada',
    }
    
    if( id != 0)
    {
      $('#btn_cliente_info').removeClass('disabled')
    }
    else
    {
      $('#btn_cliente_info').addClass('disabled')
    }
    vendas_form_preencher()
  }

  function cliente_info()
  {
    alert('abrir modal cliente_info')
  }
</script>
@endpush