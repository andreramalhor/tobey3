@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Editar Função</h3>
      </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $banco->nome }}" onchange="bancos_editar(this)">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Número do Banco</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="num_banco" id="num_banco" value="{{ $banco->num_banco }}" onchange="bancos_editar(this)">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Número da Agência</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="num_agencia" id="num_agencia" value="{{ $banco->num_agencia }}" onchange="bancos_editar(this)">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Número da Conta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="num_conta" id="num_conta" value="{{ $banco->num_conta }}" onchange="bancos_editar(this)">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Saldo Inicial</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="saldo_inicial" id="saldo_inicial" value="{{ $banco->saldo_inicial }}" onchange="bancos_editar(this)">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Cód. da Carteira</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="cod_carteira" id="cod_carteira" value="{{ $banco->cod_carteira }}" onchange="bancos_editar(this)">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Chave PIX</label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm" name="chave_pix" id="chave_pix" value="{{ $banco->chave_pix }}" onchange="bancos_editar(this)">
                <option value='' {{ $banco->chave_pix == '' ? 'selected' : ''}}>Nenhum</option>
                <option value='cpf_cnpj' {{ $banco->chave_pix == 'cpf_cnpj' ? 'selected' : ''}}>CPF/CNPJ</option>
                <option value='telefone' {{ $banco->chave_pix == 'telefone' ? 'selected' : ''}}>Telefone</option>
                <option value='email' {{ $banco->chave_pix == 'email' ? 'selected' : ''}}>E-mail</option>
                <option value='aleatória' {{ $banco->chave_pix == 'aleatória' ? 'selected' : ''}}>Aleatória</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">PIX</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="pix" id="pix"  value="{{ $banco->pix }}" onchange="bancos_editar(this)">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="{{ route('fin.bancos') }}" class="btn btn-secondary">Finalizar e Voltar</a>
  </div>
</div>
<br>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#overlay-dashboard').hide();
  });

  function bancos_editar(item)
  {    
    var url  = "{{ route('fin.bancos.atualizar', $banco->id) }}";

    axios.put(url, [{
      [item.name]: item.value,
    }])
    .then( function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
@include('includes.catch', [ 'codigo_erro' => '4713780a' ] )
  }

  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endsection
