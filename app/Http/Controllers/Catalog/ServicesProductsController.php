<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Catalog\ServiceProduct;
use App\Models\pivots\ProviderProduct;

class ServicesProductsController extends Controller
{
  public function index()
  {

  }

  public function create()
  {

  }

  public function store(Request $request)
  {
    $data = new ServiceProduct;
    $data->tipo                          = $request->tipo;
    $data->ativo                         = $request->ativo;
    $data->nome                          = $request->nome;
    $data->id_categoria                  = $request->id_categoria;
    $data->tipo_preco                    = $request->tipo_preco;
    $data->vlr_venda                     = $request->vlr_venda;
    $data->vlr_cst_adicional                 = $request->vlr_cst_adicional;
    $data->prc_comissao                  = $request->prc_comissao;
    $data->tempo_retorno                 = $request->tempo_retorno;
    $data->duracao                       = $request->duracao;
    $data->fidelidade_pontos_ganhos      = $request->fidelidade_pontos_ganhos;
    $data->fidelidade_pontos_necessarios = $request->fidelidade_pontos_necessarios;

    $data->unidade                       = $request->unidade;
    $data->marca                         = $request->marca;

    $data->cod_nota                      = $request->cod_nota;
    $data->cod_barras                    = $request->cod_barras;
    $data->estoque_min                   = $request->estoque_min;
    $data->estoque_max                   = $request->estoque_max;
    $data->ncm_prod_serv                 = $request->ncm_prod_serv;
    $data->ipi_prod_serv                 = $request->ipi_prod_serv;
    $data->icms_prod_serv                = $request->icms_prod_serv;
    $data->simples_prod_serv             = $request->simples_prod_serv;
    $data->vlr_mercado                   = $request->vlr_mercado;
    $data->vlr_nota                      = $request->vlr_nota;
    $data->vlr_frete                     = $request->vlr_frete;
    $data->vlr_comissao                  = $request->vlr_comissao;
    $data->vlr_marg_contribuicao         = $request->vlr_marg_contribuicao;
    $data->marg_contribuicao             = $request->marg_contribuicao;
    $data->vlr_custo                     = $request->vlr_custo;
    $data->margem_custo                  = $request->margem_custo;
    $data->consumo_medio                 = $request->consumo_medio;
    $data->cmv_prod_serv                 = $request->cmv_prod_serv;
    $data->curva_abc                     = $request->curva_abc;
    $data->id_fornecedor                 = $request->id_fornecedor;
    $data->descricao                     = $request->descricao;
    $data->status                        = $request->status;
    $data->save();

    $data->i8tk3ymx5u()->attach($request->id_fornecedor);

    return $data;
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

  public function providersProducts($id)
  {
    $products = ProviderProduct
      ::where('id_fornecedor', '=', $id)
      ->with('idp8nnq72l.QualCategoriaDisso')
      ->get();
      
    return $products;
  }

  public function searchProduct(Request $request)
  {
    $product = ServiceProduct
      ::where('nome', 'LIKE', '%'.$request->nome.'%')
      ->take(10)
      ->with('i8tk3ymx5u')
      ->get();

    return $product;
  }

  public function changeProvider(Request $request)
  {
    if ($request->change == 'detach')
    {
      $nome   = ServiceProduct::find($request->id)->nome;
      $people = ServiceProduct::find($request->id)->a349c74m03()->detach([$request->provider]);
      $response = [
        'type'     => 'warning',
        'message'  => "{$nome} removido como fornecedor",
      ];
    }
    else if ($request->change == 'syncWithoutDetaching')
    {
      $nome   = ServiceProduct::find($request->id)->nome;
      $people = ServiceProduct::find($request->id)->a349c74m03()->syncWithoutDetaching([$request->provider]);

      $response = [
        'type'     => 'success',
        'message'  => "{$nome} adicionado como fornecedor",
      ];
    }

    return $response;
  }
}
