@extends('layouts.app')

@section('content')
<section class="content-header p-0">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1>CRM <small>(Customer Relationship Management)</small></h1>
      </div>
      <div class="col-sm-2 p-0">
        <div class="btn-group">
          <a href="{{ route('com.leads') }}" class="btn btn-default">Ver Todos</a>
          <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false"></button>
          <div class="dropdown-menu dropdown-menu-end" role="menu" style="">
            <a class="dropdown-item" href="#">Favoritas</a>
            <a class="dropdown-item" href="#">Arquivadas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Perdidos</a>
            <a class="dropdown-item" href="#">Ganhos</a>
          </div>
        </div>
        <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal_lead_create">Novo Lead</button>
      </div>
    </div>
  </div>
</section>

<div class="row accordion" id="accordion">
  <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-1">
    <div class="card card-row">
      <div class="card-header" style="background-color: #ae87d0; color: white; font-weight: bold;">
        <h3 class="card-title float-none text-center">Entrada do Lead</h3>
      </div>
      <div class="card-body p-2" id="entrada_lead">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="text-center"><strong> . . . </strong></h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-1">
    <div class="card card-row">
      <div class="card-header" style="background-color: #7851a9; color: white; font-weight: bold;">
        <h3 class="card-title float-none text-center">Apresentação do Curso</h3>
      </div>
      <div class="card-body p-2" id="apresentacao_curso">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="text-center"><strong> . . . </strong></h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-1">
    <div class="card card-row">
      <div class="card-header" style="background-color: #522d80; color: white; font-weight: bold;">
        <h3 class="card-title float-none text-center">Proposta Enviada</h3>
      </div>
      <div class="card-body p-2" id="proposta_enviada">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="text-center"><strong> . . . </strong></h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-1">
    <div class="card card-row">
      <div class="card-header" style="background-color: #330066; color: white; font-weight: bold;">
        <h3 class="card-title float-none text-center">Negociando</h3>
      </div>
      <div class="card-body p-2" id="negociando_venda">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="text-center"><strong> . . . </strong></h5>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@include('sistema.comercial.crm.auxiliares.mod_create')
@include('sistema.comercial.crm.auxiliares.mod_show')

@endsection

@section('js')
  @include('sistema.comercial.crm.assets.js')
@endsection

@section('css')
  @include('sistema.comercial.crm.assets.css')
@endsection
