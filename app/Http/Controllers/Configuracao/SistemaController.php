<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Configuracao\Tipo_de_Pessoa;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Financeiro\Banco;
use App\Models\Catalogo\Marca;
use App\Models\Catalogo\Categoria;
use App\Models\ACL\Cargo;

class SistemaController extends Controller
{
  public function index()
  {
    return view('sistema.configuracao.sistema.index');
  }

  public function create()
  {

  }

  public function store(Request $request)
  {

  }

  public function show($id)
  {

  }

  public function edit($id)
  {

  }

  public function update(Request $request, $id)
  {

  }

  public function destroy($id)
  {

  }

  // FORMAS DE PAGAMENTOS 
  public function list_FormasDePagamentos(Request $request)
  {
    $formas_pagamentos = Forma_Pagamento::
                            where('forma', 'like', '%'.$request->forma.'%')->
                            // where('tipo', 'like', '%'.$request->tipo.'%')->
                            where('bandeira', 'like', '%'.$request->bandeira.'%')->
                            where('parcela', $request->parcela == null ? 'like' : '=', $request->parcela == null ? '%'.$request->parcela.'%' : $request->parcela)->
                            // where('prazo', '>=', 0)->
                            // where('recebimento', 'like', '%'.$request->recebimento.'%')->
                            distinct($request->distinct ?? 'forma')->
                            // pluck('id', $pesquisa->distinct ?? 'forma');
                            get();

    return $formas_pagamentos;
  }

  public function load_FormasDePagamentos()
  {
    return Forma_Pagamento::get();
  }

  public function store_FormasDePagamentos(Request $request)
  {    
    $dados = Forma_Pagamento::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Forma de Pagamento '".$dados->nome."' adicionado com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_FormasDePagamentos($id)
  {

  }

  public function edit_FormasDePagamentos($id)
  {

  }

  public function update_FormasDePagamentos(Request $request, $id)
  {

  }

  public function delete_FormasDePagamentos($id)
  {
    $tipo = Forma_Pagamento::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Forma de Pagamento '$nome' removido com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  // TIPOS DE PESSOAS 
  public function load_TiposDePessoas()
  {
    return Tipo_de_Pessoa::get();
  }

  public function store_TiposDePessoas(Request $request)
  {    
    $dados = Tipo_de_Pessoa::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Tipo '".$dados->nome."' adicionado com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_TiposDePessoas($id)
  {

  }

  public function edit_TiposDePessoas($id)
  {

  }

  public function update_TiposDePessoas(Request $request, $id)
  {

  }

  public function delete_TiposDePessoas($id)
  {
    $tipo = Tipo_de_Pessoa::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Tipo '$nome' removido com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  // BANCOS 
  public function load_Bancos()
  {
    return Banco::get();
  }

  public function store_Bancos(Request $request)
  {    
    $dados = Banco::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Tipo '".$dados->nome."' adicionado com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_Bancos($id)
  {

  }

  public function edit_Bancos($id)
  {

  }

  public function update_Bancos(Request $request, $id)
  {

  }

  public function delete_Bancos($id)
  {
    $tipo = Banco::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Tipo '$nome' removido com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  // MARCAS 
  public function load_Marcas()
  {
    return Marca::get();
  }

  public function store_Marcas(Request $request)
  {    
    $dados = Marca::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Marca '".$dados->nome."' adicionada com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_Marcas($id)
  {

  }

  public function edit_Marcas($id)
  {

  }

  public function update_Marcas(Request $request, $id)
  {

  }

  public function delete_Marcas($id)
  {
    $tipo = Marca::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Marca '$nome' removida com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  // CATEGORIAS 
  public function load_Categorias()
  {
    return Categoria::get();
  }

  public function store_Categorias(Request $request)
  {    
    $dados = Categoria::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Categoria '".$dados->nome."' adicionada com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_Categorias($id)
  {

  }

  public function edit_Categorias($id)
  {

  }

  public function update_Categorias(Request $request, $id)
  {

  }

  public function delete_Categorias($id)
  {
    $tipo = Categoria::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Categoria '$nome' removida com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  // CARGOS 
  public function load_Cargos()
  {
    return Cargo::get();
  }

  public function store_Cargos(Request $request)
  {    
    $dados = Cargo::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Cargo '".$dados->nome."' adicionado com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_Cargos($id)
  {

  }

  public function edit_Cargos($id)
  {

  }

  public function update_Cargos(Request $request, $id)
  {

  }

  public function delete_Cargos($id)
  {
    $tipo = Cargo::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Cargo '$nome' removido com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

}
