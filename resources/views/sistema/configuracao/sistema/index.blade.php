@extends('layouts.app')

@section('content')
<div class="row">
  @include('sistema.configuracao.sistema.partes.fin_bancos')
  @include('sistema.configuracao.sistema.partes.cat_marcas')
  @include('sistema.configuracao.sistema.partes.cat_categorias')
  @include('sistema.configuracao.sistema.partes.cfg_tipos_pessoas')
  @include('sistema.configuracao.sistema.partes.cfg_formas_pagamentos')
  @include('sistema.configuracao.sistema.partes.acl_cargos')
</div>
@endsection
