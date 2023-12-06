<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Builder;

use App\Models\Configuracao\ContaContabil;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\ContaInterna;
use App\Models\PDV\Venda;
use App\Models\PDV\VendaPagamento;

class ContabilController extends Controller
{
  public function index()
  {
    $contas = ContaContabil::get();

    return view('sistema.configuracao.contabil.index', [
      'contas'  => $contas,
    ]);
  }

  public function create()
  {

  }

  public function store(Request $request)
  {
    $event = ContaContabil::create($request->all());
      
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Conta '.$event->descricao.'" criado com sucesso.',
      'data'    => $event,
    ];

    // return route('contabil.index')->with($response);
    return redirect()->back()->with($response);

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

  public function search(Request $request)
  {
    $contas = ContaContabil::where('conta_pai', '=', $request->conta_pai)->where('nivel', '=', $request->nivel)->orderBy('conta')->get();

    return $contas;
  }

  public function dre()
  {
    $contas            = ContaContabil::where('imprime', '=', 'Sim')->orderBy('conta')->get();
    $pagamentos_vendas = VendaPagamento::where('id', '!=', 82)->where('id', '!=', 83)->where('dt_prevista', '>=', '2021-01-01 00:00:00')->where('dt_prevista', '<=', '2021-12-31 23:59:59')->select(\DB::raw('SUM(valor) AS valor'), 'id_forma_pagamento', \DB::raw('MONTH(dt_prevista) AS month'))->groupby('month', 'id_forma_pagamento')->orderBy('month')->get();
    $comissoes         = ContaInterna::whereBetween('updated_at', ['2021-01-01 00:00:00', '2021-12-31 23:59:59'])->whereIn('fonte_origem', ['pdv_vendas_detalhes', 'fin_conta_interna'])->where('status', '=', 'Pago')->select(\DB::raw('SUM(valor) AS valor'), 'id_pessoa', \DB::raw('MONTH(updated_at) AS month'))->groupby('month', 'id_pessoa')->orderBy('month')->get();

    $receitas    = Venda::where('created_at', '>=', '2021-01-01 00:00:00')->where('created_at', '<=', '2021-12-31 23:59:59')->orderBy('created_at')->select('*', \DB::raw('MONTH(created_at) month'))->get()->groupby('month');
    $lancamentos = Lancamento::where('dt_recebimento', '>=', '2021-01-01 00:00:00')->where('dt_recebimento', '<=', '2021-12-31 23:59:59')->select(\DB::raw('SUM(vlr_final) AS valor'), 'id_conta', \DB::raw('MONTH(dt_recebimento) AS month'))->groupby('month', 'id_conta')->orderBy('id_conta')->orderBy('month')->get();

    // dd($lancamentos);
    // $pessoas = Venda::where('created_at', '>=', '2021-01-01 00:00:00')->where('created_at', '<=', '2021-12-31 23:59:59')->orderBy('created_at')->get();
    return view('sistema.contabil.dre', [
      'contas'             => $contas,
      'receitas'           => $receitas,
      'lancamentos'        => $lancamentos,
      'pagamentos_vendas'  => $pagamentos_vendas,
      'comissoes'          => $comissoes,
    ]);
  }

  public function contas_plucar( $imprime = null, $lanca = null )
  {
    $contas = ContaContabil::
            where('imprime', '=', 'Sim')->
            where('tem_lancamento', 'LIKE', $lanca )->
            orderBy('conta')->
            get();

    return $contas;
  }
}
