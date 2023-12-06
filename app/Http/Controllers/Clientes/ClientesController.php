<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Marketing\Facebook;

class ClientesController extends Controller
{
  public function soma_informacao(Request $request)
  {
    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select($request->dado)->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        sum($request->dado);

    }
    else
    {
      $dados = Facebook::
                        select($request->dado)->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        sum($request->dado);
    }

    return $dados;
  }

  public function chart_acoes_lead(Request $request)
  {
    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select([
                          \DB::raw("SUM(interacoes) as total_interacoes"), 
                          \DB::raw("SUM(cliques) as total_cliques"),
                          \DB::raw("SUM(mensagens_recebidas) as total_mensagens_recebidas"), 
                          \DB::raw("SUM(comentarios) as total_comentarios") 
                        ])->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }
    else
    {
      $dados = Facebook::
                        select([
                          \DB::raw("SUM(interacoes) as total_interacoes"), 
                          \DB::raw("SUM(cliques) as total_cliques"),
                          \DB::raw("SUM(mensagens_recebidas) as total_mensagens_recebidas"), 
                          \DB::raw("SUM(comentarios) as total_comentarios") 
                        ])->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }

    return $dados;
  }

  public function chart_engajamento(Request $request)
  {
    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select('data','interacoes')->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }
    else
    {
      $dados = Facebook::
                        select('data','interacoes')->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }

    return $dados;
  }

  public function chart_cliques(Request $request)
  {
    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select('data','cliques')->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }
    else
    {
      $dados = Facebook::
                        select('data','cliques')->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }

    return $dados;
  }

  public function chart_mensagensRec(Request $request)
  {
    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select('data','mensagens_recebidas')->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();

    }
    else
    {
      $dados = Facebook::
                        select('data','mensagens_recebidas')->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();

    }

    return $dados;
  }

  public function chart_valorGasto(Request $request)
  {

    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select('data','vlr_gasto')->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }
    else
    {
      $dados = Facebook::
                        select('data','vlr_gasto')->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }

    return $dados;
  }

  public function chart_estDiaaDia(Request $request)
  {
    if(isset($request->id_cliente))
    {
      $dados = Facebook::
                        select('data', 'interacoes', 'cliques', 'mensagens_recebidas', 'comentarios', 'vlr_gasto')->
                        where('id_cliente', '=', $request->id_cliente)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();

    }
    else
    {
      $dados = Facebook::
                        select('data', 'interacoes', 'cliques', 'mensagens_recebidas', 'comentarios', 'vlr_gasto')->
                        where('id_cliente', '=', \Auth::User()->id)->
                        where('data', '>=', $request->dt_inicio)->
                        where('data', '<=', $request->dt_final)->
                        get();
    }

    return $dados;
  }

  public function chart_mes_dados_complem(Request $request)
  {
    $cpm = Facebook::
                      where('id_cliente', '=', $request->id_cliente)->
                      where('data', '>=', $request->dt_inicio)->
                      where('data', '<=', $request->dt_final)->
                      sum('cpm');

    $interacoes = Facebook::
                      where('id_cliente', '=', $request->id_cliente)->
                      where('data', '>=', $request->dt_inicio)->
                      where('data', '<=', $request->dt_final)->
                      sum('interacoes');

    $custo_lead = Facebook::
                      where('id_cliente', '=', $request->id_cliente)->
                      where('data', '>=', $request->dt_inicio)->
                      where('data', '<=', $request->dt_final)->
                      avg('cst_interacao');

    $vlr_gasto = Facebook::
                      where('id_cliente', '=', $request->id_cliente)->
                      where('data', '>=', $request->dt_inicio)->
                      where('data', '<=', $request->dt_final)->
                      sum('vlr_gasto');

    $dados['custo_lead']    = $custo_lead;
    $dados['cpm']           = $cpm;
    $dados['leads_quentes'] = ($interacoes * 0.0133);

    return $dados;
  }

  public function load(Request $request)
  {
    $bills = Compra::
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
    return view('system.financial.bills.parts.table', [
      'bills'      =>   $bills,
    ])->render();
  }

  // Chama tela de escolha dos fornecedores
  public function providers(Request $request)
  {
    return view('system.financial.bills.2provider');
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

    return route('bills.items', $data->id);
  }

  public function items(Request $request)
  {
    return view('system.financial.bills.3procuts');
  }
// ==================================================================================================================================
  public function create()
  {
    return view('system.financial.bills.2provider');
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

    return route('bills.edit', $data->id);
  }

  public function show($id)
  {

  }

  public function edit($id)
  {
    $data = Compra::find($id);

    return view('system.financial.bills.3products', [
      'data'    =>    $data,
    ]);
  }

  public function products(Request $request, $id)
  {
    $details = collect($request->fin_bills_details);

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

    return route('bills.payments', $data->id);
  }

  public function payments($id)
  {
    $data = Compra::find($id);

    return view('system.financial.bills.4payments', [
      'data'    =>    $data,
    ]);
  }

  public function payments2(Request $request, $id)
  {
    $data = Compra::find($id);

    return view('system.financial.bills.4payments', [
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
