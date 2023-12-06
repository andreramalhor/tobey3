<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Financeiro\Compra;
use App\Models\Financeiro\CompraDetalhe;
use App\Models\Atendimento\Pessoa;           // remover

class PurcharsesController extends Controller
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
                          orwhere('status', 'LIKE', '%'.$request->iptSearch.'%' );                        }
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
  public function providers(Request $request)
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

  public function payments($id)
  {
    $data = Compra::find($id);

    return view('system.financial.purcharses.4payments', [
      'data'    =>    $data,
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
