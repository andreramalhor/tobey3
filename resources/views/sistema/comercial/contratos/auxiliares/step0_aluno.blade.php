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
      <label for="col-form-label">Nome do Aluno</label>
      <select class="form-control form-control-sm select2" onchange="cliente_selecionado( this.value, 'Nome do Aluno' )">
        <option value="0">Selecione . . .</option>
        @foreach($clientes as $cliente)
        <option value="{{ $cliente->id }}">{{ $cliente->nomes }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-1"></div>
  <div class="col-2">
    <div class="form-group">
      <label for="col-form-label">Origem</label>
      <select class="form-control form-control-sm select2" onchange="cliente_selecionado( this.value, 'Origem' )">
        <option value="1 ">Assistente</option>    
        <option value="2 ">Telemarketing</option>    
        <option value="3 ">Consultor Ext</option>    
        <option value="4 ">Panfletos</option>    
        <option value="5 ">Mala Direta</option>    
        <option value="6 ">Book Fotográf</option>    
        <option value="7 ">Campanha de Indicação</option>    
        <option value="8 ">Renovações</option>    
        <option value="9 ">Corporativo</option>    
        <option value="10">Visitas Antig</option>    
        <option value="11">Compre e Apli</option>    
        <option value="12">TV</option>    
        <option value="13">Jornal</option>    
        <option value="14">Outdoor</option>
        <option value="15">Cartaz</option>
        <option value="16">Faixa</option>
        <option value="17">Muro</option>
        <option value="18">Carro de Som</option>
        <option value="19">Indicação Esp</option>
        <option value="20">Fachada</option>
        <option value="21">Internet/Site</option>
        <option value="22">Lista Telefôn</option>
        <option value="23">Outros</option>
        <option value="24">Rádio</option>
        <option value="25">Facebook</option>
        <option value="26">Google</option>
        <option value="27">Site da Franq</option>
        <option value="28">SMS</option>
        <option value="29">Bing</option>
        <option value="30">Instagram</option>
        <option value="31">Yahoo</option>
        <option value="32">Twitter</option>
        <option value="33">Outlook</option>
        <option value="34">Vendas Online</option>
        <option value="35">Recebimento d</option>
        <option value="36">WhatsApp</option>
        <option value="38">Modelo</option>
        <option value="39">Revista</option>
        <option value="40">Workshop</option>
        <option value="41">BusDoor</option>
        <option value="42">E-Mail Market</option>
        <option value="43">Parceria Pref</option>
        <option value="104">Indicação de Ex-Aluno</option>
        <option selected value="987">Náutica Digital</option>
      </select>
    </div>
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
      <label for="col-form-label">Responsável Legal</label>
      <select class="form-control form-control-sm select2" onchange="cliente_selecionado( this.value, 'Responsável Legal' )">
        <option value="0">Selecione . . .</option>
        @foreach($clientes as $cliente)
        <option value="{{ $cliente->id }}">{{ $cliente->nomes }}</option>
        @endforeach
      </select>
    </div>
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
      <label for="col-form-label">Responsável Financeiro</label>
      <select class="form-control form-control-sm select2" onchange="cliente_selecionado( this.value, 'Responsável Financeiro' )">
        <option value="0">Selecione . . .</option>
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
    alert('abrir modal cliente_adicionar')
  }

  function cliente_selecionado( id , tipo)
  {
    
    com_contratos.id_consultor = "{{ \Auth::User()->id }}";
    com_contratos.dt_cadastro  = moment.now()
    com_contratos.status       = 'Lançando'
    com_contratos.id_origem    = '987'

    switch (tipo)
    {
      case 'Nome do Aluno':
        com_contratos.id_aluno = id;
        break;
    
      case 'Origem':
        com_contratos.id_origem = id;
        break;
    
      case 'Responsável Legal':
        com_contratos.id_responsavel_legal = id;
        break;
    
      case 'Responsável Financeiro':
        com_contratos.id_responsavel_financeiro = id;
        break;
    
      default:
        break;
    }
    
    if( id != 0)
    {
      $('#btn_cliente_info').removeClass('disabled')
    }
    else
    {
      $('#btn_cliente_info').addClass('disabled')
    }
    // vendas_form_preencher()
  }

  function cliente_info()
  {
    alert('abrir modal cliente_info')
  }
</script>
@endpush