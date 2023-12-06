@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Relatórios</h3>
      </div>
      <div class="card-body">
        <div class="row bring-up">
          <div class="col-md-6">
            <p>Vendas</p>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/vendas') }}"><i class="fas fa-dollar-sign"></i> Geral</a>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/comissoes') }}"><i class="fas fa-hand-holding-dollar"></i> Comissões</a>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/vendas_xxx') }}"><i class="fas fa-users"></i> $ Parceiro</a>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/vendas_yyy') }}"><i class="fab fa-product-hunt"></i> $ Prod./Serv.</a>
          </div>
          <div class="col-md-6">
            <p>Cliente</p>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/clientes_aaa') }}"><i class="fas fa-calendar-days"></i> Dias ausentes</a>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/aniversariantes') }}"><i class="fas fa-cake-candles"></i> Aniversariantes</a>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/devedores') }}"><i class="fas fa-file-invoice-dollar"></i> Devedores</a>
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/comCredito') }}"><i class="fas fa-circle-dollar-to-slot"></i> Credores</a>
            <p>Outros</p>
            @can('Administrador do Sistema')
            <a class="btn btn-app" style="min-width: 125px;" href="{{ url('relatorio/nf_cartoes') }}"><i class="fas fa-receipt"></i> NF Cartões</a>
            @endcan
          </div>
        </div>

        <div class="row bring-up">
          <div class="col-md-6">
            @can('Administrador do Sistema')
            <p>Application Buttons with Badge Colors</p>
            <a class="btn btn-app" style="min-width: 125px;"><span class="badge bg-success">300</span><i class="fas fa-barcode"></i> Products</a>
            <a class="btn btn-app" style="min-width: 125px;"><span class="badge bg-purple">891</span><i class="fas fa-users"></i> Users</a>
            <a class="btn btn-app" style="min-width: 125px;"><span class="badge bg-teal">67</span><i class="fas fa-inbox"></i> Orders</a>
            <a class="btn btn-app" style="min-width: 125px;"><span class="badge bg-info">12</span><i class="fas fa-envelope"></i> Inbox</a>
            <a class="btn btn-app" style="min-width: 125px;"><span class="badge bg-danger">531</span><i class="fas fa-heart"></i> Likes</a>
          </div>
          <div class="col-md-6">
            <p>Application Buttons with Custom Colors</p>
            <a class="btn btn-app bg-secondary" style="min-width: 125px;"><span class="badge bg-success">300</span><i class="fas fa-barcode"></i> Products</a>
            <a class="btn btn-app bg-success" style="min-width: 125px;"><span class="badge bg-purple">891</span><i class="fas fa-users"></i> Users</a>
            <a class="btn btn-app bg-danger" style="min-width: 125px;"><span class="badge bg-teal">67</span><i class="fas fa-inbox"></i> Orders</a>
            <a class="btn btn-app bg-warning" style="min-width: 125px;"><span class="badge bg-info">12</span><i class="fas fa-envelope"></i> Inbox</a>
            <a class="btn btn-app bg-info" style="min-width: 125px;"><span class="badge bg-danger">531</span><i class="fas fa-heart"></i> Likes</a>
            @endcan
          </div>
        </div>
      </div>
    </div>   
  </div>
</div>

<div class="row">

  <div class="col-md-6">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Relatórios de Produtos / Serviços</h3>
      </div>
      <div class="card-body">
        <a href="{{ route('relatorio.inventory') }}">  
          <div class="callout callout-info">
            <h6>Relatório de <strong>ESTOQUE</strong></h6>
            <p>Relatório com estoque dos Produtos.</p>
            <p>Colunas: ID, Cliente, Serviço, Valores (serviço, desc/acre, valor pago), Profissional, Comissão (perc. e valor).</p>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Lista de Espera</h3>
      </div>
      <div class="card-body">
        <a href="{{ route('relatorio.lista_espera_noivas') }}">  
          <div class="callout callout-warning">
            <h6>Inauguração <strong>Sala de Noivas</strong></h6>
            <p>Relatório com estoque dos Produtos.</p>
            <p>Colunas: ID, Cliente, Serviço, Valores (serviço, desc/acre, valor pago), Profissional, Comissão (perc. e valor).</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')

@stop
