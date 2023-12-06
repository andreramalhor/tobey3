<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Financeiro\Compra;
use App\Models\Financeiro\CompraDetalhe;
use App\Models\Atendimento\Pessoa;           // remover

class ComprasController extends Controller
{
  public function index()
  {
    return view('system.financial.purcharses.1index');
    // return view('sistema.atendimentos.pessoas.index');
  }

  public function load(Request $request)
  {
    $compras = Compra::
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->iptSearch ) )
                        {
                          $query->
                          whereHas('ysfyhzfsfarfdha', function ($query) use ($request)
                          {
                            $query->where('nome', 'like', '%'.$request->iptSearch.'%');
                          })->
                          // orwhere('fornecedor', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('tipo', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('qtd_produtos', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('vlr_final', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('status', 'LIKE', '%'.$request->iptSearch.'%' );
                        }
                      })->
                      orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                      orderBy('id', 'desc')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

// return $pessoas;
    return view('system.financial.purcharses.parts.table', [
      'compras'      =>   $compras,
    ])->render();
  }

  // Chama tela de escolha dos fornecedores
  public function fornecedores(Request $request)
  {
    return view('system.financial.purcharses.2provider');
  }

  // Grava compra com fornecedor e redireciona para tela dos produtos
  public function products2(Request $request)
  {
    $data = new Compra;
    $data->id_caixa       = \Auth::User()->abcde->first()->id ?? null;
    $data->id_usuario     = \Auth::User()->id;
    $data->id_fornecedor  = $request->id_fornecedor;
    $data->qtd_produtos   = null;
    $data->vlr_prod_serv  = null;
    $data->vlr_negociados = null;
    $data->vlr_dsc_acr    = null;
    $data->vlr_final      = null;
    $data->status         = 'Aberto';
    $data->save();

    return route('purcharses.items', $data->id);
  }

  public function items(Request $request)
  {
    return view('system.financial.purcharses.3procuts');
  }
// ==================================================================================================================================
  public function create()
  {
    return view('system.financial.purcharses.2provider');
  }

  public function store(Request $request)
  {
    $data = new Compra;
    $data->tipo           = $request->tipo;
    $data->id_caixa       = \Auth::User()->abcde->first()->id ?? null;
    $data->id_usuario     = \Auth::User()->id;
    $data->id_fornecedor  = $request->id_fornecedor;
    $data->qtd_produtos   = null;
    $data->vlr_prod_serv  = null;
    $data->vlr_negociados = null;
    $data->vlr_dsc_acr    = null;
    $data->vlr_final      = null;
    $data->status         = 'Aberto';
    $data->save();

    return route('purcharses.edit', $data->id);
  }

  public function store1(Request $request)
  {    
    $compra = new Compra;
    $compra->tipo           = null;
    $compra->id_caixa       = null;
    $compra->id_usuario     = \Auth::User()->id;
    $compra->id_fornecedor  = null;
    $compra->qtd_produtos   = null;
    $compra->vlr_prod_serv  = null;
    $compra->vlr_negociados = null;
    $compra->vlr_dsc_acr    = null;
    $compra->vlr_final      = null;
    $compra->status         = 'Aberto';
    $compra->save();

    foreach($request['qtd_'] as $produto => $qtd_produto)
    {
      if ($qtd_produto != 0)
      {
        $compra_detalhe = new CompraDetalhe;
        $compra_detalhe->id_compra     = $compra->id;
        $compra_detalhe->id_servprod    = $produto;
        $compra_detalhe->qtd           = $qtd_produto;
        $compra_detalhe->vlr_compra    = 0;
        $compra_detalhe->vlr_negociado = 0;
        $compra_detalhe->vlr_dsc_acr   = 0;
        $compra_detalhe->vlr_final     = 0;
        $compra_detalhe->status        = 'Aberto';
        $compra_detalhe->save();
      }
    }
    
    $response = [
      'error'    => false,
      'type'     => 'success',
      'message'  => 'Compra '.$compra->id.' realizado com sucesso.',
      'data'     => $compra->toArray(),
      'redirect' => route('fin.compras'),
    ];

    return $response;
  }

  public function show($id)
  {

  }

  public function edit($id)
  {
    $data = Compra::find($id);

    return view('system.financial.purcharses.3products', [
      'data'    =>    $data,
    ]);
  }

  public function products(Request $request, $id)
  {
    $details = collect($request->fin_purcharse_details);

    $data = Compra::find($id);
    $data->qtd_produtos   = $details->count();
    $data->vlr_prod_serv  = null;
    $data->vlr_negociados = null;
    $data->vlr_dsc_acr    = null;
    $data->vlr_final      = $details->sum('vlr_final');
    $data->status         = 'Aberto';
    $data->save();

    foreach ($details->where('qtd', '>', 0) as $key => $detail)
    {
      $data2 = new CompraDetalhe;
      $data2->id_compra     = $data->id;
      $data2->id_servprod    = $detail['id'];
      $data2->qtd           = $detail['qtd'];
      $data2->vlr_compra    = $detail['vlr_unit'];
      $data2->vlr_negociado = $detail['vlr_unit'];
      $data2->vlr_dsc_acr   = 0;
      $data2->vlr_final     = $detail['vlr_unit'];
      $data2->status        = 'Aberto';
      $data2->save();
    }

    return route('purcharses.payments', $data->id);
  }

  public function confirmacao(Request $request)
  {
    $dados_da_compra       = $request->dados_da_compra;
    $impostos_compras      = $request->impostos_compras;
    $fin_purcharse_details = collect(json_decode($request->fin_purcharse_details));

    return view('system.financial.purcharses.3confirmacao', [
      'dados_da_compra'         =>    $dados_da_compra,
      'impostos_compras'        =>    $impostos_compras,
      'fin_purcharse_details'   =>    $fin_purcharse_details,
    ]);
  }

  public function pagamentos(Request $request)
  {
    dd($request->all());
    $dados_da_compra       = $request->dados_da_compra;
    $impostos_compras      = $request->impostos_compras;
    $fin_purcharse_details = collect(json_decode($request->fin_purcharse_details));

    return view('system.financial.purcharses.3confirmacao', [
      'dados_da_compra'         =>    $dados_da_compra,
      'impostos_compras'        =>    $impostos_compras,
      'fin_purcharse_details'   =>    $fin_purcharse_details,
    ]);
  }

  public function payments2(Request $request, $id)
  {
    $data = Compra::find($id);

    return view('system.financial.purcharses.4payments', [
      'data'    =>    $data,
    ]);
  }

  public function finish(Request $request)
  {
    $fin_compras            = collect($request->fin_compra);
    $fin_compras_detalhes   = collect($request->fin_compra_detalhes);
    $fin_compras_pagamentos = collect($request->fin_compra_pagamentos);

    return $fin_compras[0]['íd'];
    // $data = Compra::find($fin_compra['id']);
    return $data;
  }

  public function destroy($id)
  {

  }
}
