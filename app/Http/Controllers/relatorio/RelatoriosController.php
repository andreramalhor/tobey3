<?php

namespace App\Http\Controllers\relatorio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Models\PDV\Caixa;
// use App\Models\Financeiro\Banco;
// use App\Models\Financeiro\Lancamento;
use App\Models\PDV\Venda;
use App\Models\PDV\VendaDetalhe;
use App\Models\Atendimento\Agendamento;
use App\Models\Atendimento\Pessoa;
use App\Models\Financeiro\ContaInterna;
use App\Models\Cadastro\ServicoProduto;
use App\Models\Relatorio\lista_espera_inauguracao_noivas;

class RelatoriosController extends Controller
{
  public function index()
  {
    return view('sistema.relatorio.index');
  }

  public function vendas( Request $request)
   {
    if(!$request->exists('dataForm'))
    {
      $dataForm['dt_inicio'] = \Carbon\Carbon::today()->startOfDay();
      $dataForm['dt_final']  = \Carbon\Carbon::today()->endOfDay();
    }
    else
    {
      $request = $request->except('_token');

      $dataForm = explode(" - ", $request['dataForm']);
      $dataForm['dt_inicio'] = \Carbon\Carbon::createFromFormat('d/m/Y', $dataForm[0])->startOfDay();
      $dataForm['dt_final'] = \Carbon\Carbon::createFromFormat('d/m/Y', $dataForm[1])->endOfDay();
    }
    
    $vendas = Venda::
                    where('created_at', '>=', $dataForm['dt_inicio'])->
                    where('created_at', '<=', $dataForm['dt_final'])->
                    orderBy('created_at')->
                    paginate(999999);
    
    return view('sistema.relatorio.vendas', [
      'vendas'   => $vendas,
      'dataForm' => $dataForm,
    ]);
  }

  public function vendas_xxx(Request $request)
  {
    if(!$request->exists('dataForm'))
    {
      $dataForm['dt_inicio'] = \Carbon\Carbon::today()->subDays(20)->startOfDay();
      $dataForm['dt_final']  = \Carbon\Carbon::today()->endOfDay();
    }
    else
    {
      $request = $request->except('_token');

      $dataForm = explode(" - ", $request['dataForm']);
      $dataForm['dt_inicio'] = \Carbon\Carbon::createFromFormat('d/m/Y', $dataForm[0])->startOfDay();
      $dataForm['dt_final']  = \Carbon\Carbon::createFromFormat('d/m/Y', $dataForm[1])->endOfDay();
    }
    
    $vendas_detalhes = VendaDetalhe::
                          join('fin_contas_internas', function($join)
                          {
                            $join->on('pdv_vendas_detalhes.id', '=', 'fin_contas_internas.id_origem')
                                 ->where('fin_contas_internas.fonte_origem', 'pdv_vendas_detalhes');
                          })->
                          select('pdv_vendas_detalhes.*', 'fin_contas_internas.id as fin_id', 'fin_contas_internas.id_origem as fin_id_origem', 'fin_contas_internas.id_pessoa as fin_id_pessoa', 'fin_contas_internas.tipo as fin_tipo', 'fin_contas_internas.percentual as fin_percentual', 'fin_contas_internas.valor as fin_valor', 'fin_contas_internas.dt_prevista as fin_dt_prevista', 'fin_contas_internas.dt_quitacao as fin_dt_quitacao', 'fin_contas_internas.id_destino as fin_id_destino', 'fin_contas_internas.fonte_destino as fin_fonte_destino', 'fin_contas_internas.status as fin_status')->
                          // select('id_venda', 'quantidade', 'fin_contas_internas.id_pessoa')->
                          // with('hgihnjekboyabez')->
                          whereBetween('pdv_vendas_detalhes.created_at', [$dataForm['dt_inicio'], $dataForm['dt_final']])->
                          // groupBy('hgihnjekboyabez.id_pessoa')->
                          // first();
                          // limit(4);
                          get();
    
    return view('sistema.relatorio.vendas.vendas_xxx', [
      'vendas_detalhes' => $vendas_detalhes,
      'dataForm'        => $dataForm,
    ]);
  }

  public function vendas_yyy(Request $request)
  {
    if(!$request->exists('dataForm'))
    {
      $dataForm['dt_inicio'] = \Carbon\Carbon::today()->subDays(20)->startOfDay();
      $dataForm['dt_final']  = \Carbon\Carbon::today()->endOfDay();
    }
    else
    {
      $request = $request->except('_token');

      $dataForm = explode(" - ", $request['dataForm']);
      $dataForm['dt_inicio'] = \Carbon\Carbon::createFromFormat('d/m/Y', $dataForm[0])->startOfDay();
      $dataForm['dt_final']  = \Carbon\Carbon::createFromFormat('d/m/Y', $dataForm[1])->endOfDay();
    }
    
    $vendas_detalhes = VendaDetalhe::
                          whereBetween('pdv_vendas_detalhes.created_at', [$dataForm['dt_inicio'], $dataForm['dt_final']])->
                          get();
    
    return view('sistema.relatorio.vendas.vendas_yyy', [
      'vendas_detalhes' => $vendas_detalhes,
      'dataForm'        => $dataForm,
    ]);
  }

  public function clientes_aaa(Request $request)
  {
    $clientes = Agendamento::
                            whereNotNull('id_cliente')->
                            select('id_cliente',\DB::raw('MAX(start) as agd_start'))->
                            where('start', '<=', \Carbon\Carbon::today()->endOfDay())->
                            orderBy('agd_start', 'asc')->
                            groupBy('id_cliente')->
                            with('xhooqvzhbgojbtg')->
                            paginate();

// $clientes = Pessoa::
//                   leftJoin('atd_agendamentos', 'atd_pessoas.id', '=', 'atd_agendamentos.id_cliente')->
//                   select('atd_pessoas.*', 
//                     // \DB::raw('MAX(atd_agendamentos.id) as agd_id'),
//                     \DB::raw('MAX(atd_agendamentos.start) as agd_start'),
//                     // outras colunas desejadas
//                   )->
//                   // select('atd_pessoas.*', 'atd_agendamentos.id_cliente', 'atd_agendamentos.start as agd_start')->
//                   // groupBy('atd_pessoas.agd_start')->
//                   // select('atd_pessoas.*', 
//                   //   'atd_agendamentos.id            as agd_id', 
//                   //   'atd_agendamentos.start         as agd_start', 
//                   //   'atd_agendamentos.id_cliente    as agd_id_cliente', 
//                   //   'atd_agendamentos.id_profexec   as agd_id_profexec', 
//                   //   'atd_agendamentos.id_servprod   as agd_id_servprod', 
//                   //   'atd_agendamentos.id_comanda    as agd_id_comanda', 
//                   //   'atd_agendamentos.valor         as agd_valor', 
//                   //   'atd_agendamentos.id_criador    as agd_id_criador', 
//                   //   'atd_agendamentos.status        as agd_status', 
//                   // )->
//                   whereNull('atd_agendamentos.deleted_at')->
//                   where('atd_agendamentos.start', '<=', \Carbon\Carbon::today())->
//                   where('atd_agendamentos.status', '!=', 'Excluído')->
//                   groupBy('atd_pessoas.id')->
//                   orderBy('agd_start', 'ASC')->
//                   paginate(999);
//                   // dd($pessoas->first());
//                   dd($clientes);

    return view('sistema.relatorio.clientes_aaa', [
      'clientes'      =>      $clientes,
    ]);
  }

  public function comissoes(Request $request)
  {
    if(!$request->exists('ano'))
    {
      $ano = \Carbon\Carbon::today()->format('Y');
    }
    else
    {
      $request = $request->except('_token');

      $ano = $request['ano'];
    }
    
    $comissoes = ContaInterna::whereBetween('created_at', [$ano.'-01-01 00:00:00', $ano.'-12-31 23:59:59'])->whereIn('fonte_origem', ['pdv_vendas_detalhes', 'fin_conta_interna'])->where('status', '=', 'Pago')->select(\DB::raw('SUM(valor) AS valor'), 'id_pessoa', \DB::raw('MONTH(created_at) AS month'))->groupby('month', 'id_pessoa')->orderBy('month')->get();

    // $comissoes = ContaInterna::where('tipo', '=', 'Comissão')->whereYear('created_at', '=', $ano)->select(\DB::raw('SUM(valor) AS valor'), 'id_pessoa', \DB::raw('MONTH(created_at) AS month'))->groupBy('id_pessoa', 'month')->get();
    // dd($comissoes);
    // return response()->Json($comissoes);
    return view('sistema.relatorio.comissoes', [
      'comissoes' => $comissoes,
      'ano'       => $ano,
    ]);
  }

  public function devedores(Request $request)
  {
    $contas_internas = ContaInterna::
                            where('status', '=', 'Em Aberto')->
                            select(\DB::raw('sum(valor) as total, id_pessoa'))->
                            groupBy('id_pessoa')->
                            having('total', '<', 0)->
                            orderBy('total', 'desc')->
                            get();
                         
    return view('sistema.relatorio.devedores', [
      'contas_internas' => $contas_internas,
    ]);
  }

  public function comCredito(Request $request)
  {
    $contas_internas = ContaInterna::
                            where('status', '=', 'Em Aberto')->
                            select(\DB::raw('sum(valor) as total, id_pessoa'))->
                            groupBy('id_pessoa')->
                            having('total', '>', 0)->
                            having('id_pessoa', '!=', 3)->       // removi Eulênia
                            orderBy('total', 'asc')->
                            get();

    return view('sistema.relatorio.credores', [
      'contas_internas' => $contas_internas,
    ]);
  }

  public function aniversariantes(Request $request)
  {
    $dataForm = $request->dataForm;

    $pessoas = Pessoa::where(function ($query) use ($dataForm)
    {
      if(!isset($dataForm))
      {
        // $query->whereMonth('dt_nascimento', '=', \Carbon\Carbon::today()->month());
        $query->whereMonth('dt_nascimento', '=', \Carbon\Carbon::today()->format('m'));
      }
      else
      {
        $query->whereMonth('dt_nascimento', '=', $dataForm);
      }
    })->orderByRaw('DATE_FORMAT(dt_nascimento, "%m-%d")')->paginate(9999);

    return view('sistema.relatorio.aniversariantes', [
      'pessoas'   => $pessoas,
      'dataForm'  => $dataForm,
    ]);
  }

  public function nf_cartoes(Request $request)
  {
    $dataForm = $request->dataForm;
    
    if( !isset($dataForm) || $dataForm == null || $dataForm == '' ) 
    {
      $dataForm = \Carbon\Carbon::today()->format('m');
    }

    $dt_inicio = \Carbon\Carbon::createFromDate(\Carbon\Carbon::today()->format('Y'), $dataForm, 10)->startOfMonth();
    $dt_final  = \Carbon\Carbon::createFromDate(\Carbon\Carbon::today()->format('Y'), $dataForm, 10)->endOfMonth();
    // $dt_inicio = \Carbon\Carbon::createFromDate('2023', '01', '01')->startOfDay();
    // $dt_final  = \Carbon\Carbon::createFromDate('2023', '01', '31')->endOfDay();

    $vendas = Venda::
                    whereHas('afewfefuwoenoei', function ($query)
                    {
                      $query->where('forma', 'Cartão de Crédito')->
                              orWhere('forma', 'Cartão de Débito');
                              // orWhere('forma', 'PIX');
                    })->
                    whereBetween('created_at',  [ $dt_inicio, $dt_final ])->
                    get();
// dd($vendas); 

    return view('sistema.relatorio.nf_cartoes', [
      'vendas'    => $vendas,
      'dataForm'  => $dataForm,
    ]);
  }

  public function inventory(Request $request)
  {
    $produtos = ServicoProduto::where('tipo', 'Produto')->get();

    return view('sistema.relatorio.inventory', [
      'produtos'    => $produtos,
      // 'dataForm'  => $dataForm,
    ]);
  }

  public function lista_espera_noivas(Request $request)
  {
    $dados = lista_espera_inauguracao_noivas::orderBy('id', 'desc')->get();

    return view('sistema.relatorio.lista_espera_noivas', [
      'dados'    => $dados,
    ]);
  }
}
