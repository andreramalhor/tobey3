@extends('layouts.app')

@section('content')
<form action="{{ route('fin.bancos.gravar') }}" method="POST" id="form_clientes_adicionar" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Criar Função</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Número do Banco</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="num_banco" id="num_banco" placeholder="000">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Número da Agência</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="num_agencia" id="num_agencia" placeholder="0000">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Número da Conta</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="num_conta" id="num_conta" placeholder="000000-0">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Saldo Inicial</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="saldo_inicial" id="saldo_inicial" placeholder="0,00">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Cód. da Carteira</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="cod_carteira" id="cod_carteira" placeholder="00000">
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Chave PIX</label>
            <div class="col-sm-10">
              <select class="form-control form-control-sm" name="chave_pix" id="chave_pix">
                <option value="">Nenhum</option>
                <option value="cpf_cnpj">CPF/CNPJ</option>
                <option value="telefone">Telefone</option>
                <option value="email">E-mail</option>
                <option value="aleatória">Aleatória</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">PIX</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="pix" id="pix" placeholder="PIX">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('fin.bancos') }}" class="btn btn-secondary">Cancelar</a>
      <button type="submit" class="btn btn-success float-right">Criar</button>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection
