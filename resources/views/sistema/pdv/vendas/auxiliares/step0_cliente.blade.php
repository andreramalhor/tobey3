<div class="row">
  <div class="pb-5">
    <button class="btn btn-sm btn-primary float-end" onclick="stepper1.next()">Próximo</button>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
    @can('Pessoas.Criar')
    <div class="form-group">
      <label for="col-form-label">Adicionar Cliente</label>
      <a class="btn btn-sm btn-primary btn-block" onclick="cliente_adicionar()" data-bs-tooltip="tooltip" data-bs-title="Cadastrar Pessoa"><i class="fas fa-user-plus"></i></a>
    </div>
    @endcan
  </div>
  <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1"></div>
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
</div>

@push('js')
<script>
  function cliente_adicionar()
  {
    var url = "{{ route('atd.pessoas.adicionar') }}";
        
    axios.get(url)
    .then(function(response)
    {
      // console.log(response.data)
      $('#offcanva-geral-'+id_cnv).css('width', '100%')
      $('#offcanva-geral-'+id_cnv).empty().append(response.data)
    })
    @include('includes.catch', [ 'codigo_erro' => '3136658a' ] )
    .then( function(response)
    {
      $('#offcanva-geral-'+id_cnv).offcanvas('show');
    })
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