<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Financeiro\Banco;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\RecebimentoCartao;
use App\Models\Financeiro\ContaInterna;
use App\Models\Atendimento\Pessoa;
use App\Models\Catalogo\ServicoProduto;

class LancamentoController extends Controller
{
  public function index()
  {    
    $lancamentos = Lancamento::orderBy('id', 'desc')->paginate();

    return view('sistema.financeiro.lancamentos.index', [
      'lancamentos' => $lancamentos,
    ]);
  }

  public function filtrar(Request $request)
  {
    $dataForm = $request->except('_token');

    if($request->dt_inicio OR $request->dt_final)
    {
      $dt_inicio = $request->dt_inicio.'00:00:00';
      $dt_final  = $request->dt_final.'23:59:59';
    }
    else
    {
      $dt_inicio = \Carbon\Carbon::now()->startOfYear();
      $dt_final  = \Carbon\Carbon::now()->endOfMonth();
    }

    $marcas = Lancamento::where('tipo', 'Serviço')->where('tipo', 'Serviço')->select('marca')->distinct()->get();

    $servicos = Lancamento::where('tipo', 'Serviço')->where('tipo', 'Serviço')->where(function ($query) use ($dataForm)
    {
      if(isset($dataForm['nome']))
        $query->where('nome', 'LIKE', '%'.$dataForm['nome'].'%');

      if(isset($dataForm['marca']))
      {
        $query->where('marca', 'LIKE', '%'.$dataForm['marca'].'%');
      }
    })
    ->paginate(10);

    return view('sistema.cadastros.servicos.index',[
      'servicos'    => $servicos,
      'marcas'      => $marcas,
      'dataForm'    => $dataForm,
    ]);
  }

  public function create(Request $request)
  {

    $pessoas          = Pessoa::get();

    // $produtos = ServicoProduto::where('tipo', '=', 'Produto')->get()->groupby('QualCategoriaDisso.nome');
    $produtos = [];

    $lancamento             = Lancamento::find($request->id);

    $lancamentos = [];

    return view('sistema.financeiro.lancamentos.create',[
      'pessoas'  => $pessoas,
      // 'profissionais'     => $profissionais,
      'produtos' => $produtos,
      'lancamento'   => $lancamento,
    ]);
  }

  public function procurar($id)
  {
    $lancamento = Lancamento::with('FinanceiroLancamentosDetalhesProdutos')->find($id);

    return $lancamento;
  }

  public function store(Request $request)
  {
    $lancamento = Lancamento::updateOrCreate(
      [ 'id' => $request->id ], collect($request)->toArray()
    );

    if(sizeof($request->fin_lancamento_detalhe) > 0)
    {
      foreach ($request->fin_lancamento_detalhe as $key => $value)
      {
        $lancamento_detalhe = $lancamento->FinanceiroLancamentosDetalhesProdutos()->create($value);
      }
    }

    $response = [
      'type'     => 'success',
      'message'  => "A Lancamento '$lancamento->id' foi aberto com sucesso.",
      'data'     => $lancamento,
    ];

    return $response;
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

  public function recebimentoCartoes()
  {
    $from = \Carbon\Carbon::today()->subDays(3);
    $to   = \Carbon\Carbon::today()->addDays(3);
   
    $recebimentos = RecebimentoCartao::
                            whereBetween('dt_prevista', [$from, $to])->
                            select(\DB::raw('sum(vlr_real) as vlr_real, sum(vlr_real - vlr_final) as vlr_desc, sum(vlr_final) as vlr_receber, count(*) as qtd_recebimentos, dt_prevista, id_forma_pagamento'))->
                            groupBy('dt_prevista', 'id_forma_pagamento')->
                            where('status', '=', 'Aguardando Validação')->
                            with(['gevmgwjvzgdexwm' => function ($q) {
                                $q->orderBy('tipo', 'asc');
                            }])->
                            get();

    // return view('sistema.financeiro.recebimentocartao.index',[
    return view('sistema.financeiro.recebimentocartao.teste',[
      // 'bancos'  => $bancos,
      'recebimentos' => $recebimentos,
    ]);
  }

  public function confirmarCartoes(Request $request)
  {
    $banco     = Banco::find($request->id_banco);
    $recebidos = collect(json_decode($request['fin_recebCartoes']));

    return view('sistema.financeiro.recebimentocartao.confirmar',[
      'banco'     => $banco,
      'recebidos' => $recebidos,
    ]);
  }

  public function cartoesConfirmados(Request $request)
  {
    $fin_lancamentos = $request->fin_lancamentos;

    foreach($fin_lancamentos as $key => $lancamento)
    {
      $confirmados = Lancamento::create($lancamento);
      
      foreach($lancamento['fin_pagamentos_cartoes'] as $key2 => $cartaoRecebido)
      {
        $cartao = collect(json_decode($cartaoRecebido));
        $recebimentoCartao = RecebimentoCartao::find($cartao['id']);
        $recebimentoCartao->origem_lancamento = 'fin_lancamentos';
        $recebimentoCartao->id_lancamento     = $confirmados->id;
        $recebimentoCartao->status            = 'Recebido';
        $recebimentoCartao->save();
      }

      // foreach($fin_recebCartoes as $key => $cartao)
      // {
      //   $cartao = RecebimentoCartao::update()      
      // }
    }

    return $this->recebimentoCartoes();


    return view('sistema.financeiro.recebimentocartao.confirmar',[
      'bancos'      => $bancos,
      'recebidos'   => $recebidos,
    ]);
  }

  public function d_gerais()
  {
    $bancos  = Banco::get();
    $pessoas = Pessoa::get();

    return view('sistema.financeiro.lancamentos.despesas',[
      'bancos'  => $bancos,
      'pessoas' => $pessoas,
    ]);
  }

  public function lancar_d_gerais(Request $request)
  {
    $fin_lancamento = collect($request->all(), true);

    if(isset($vlr_dsc_acr))
    {
      $vlr_dsc_acr = str_replace(",", ".", str_replace(".", "", str_replace(".", "", str_replace(".", "", $fin_lancamento['vlr_dsc_acr']))));
    }
    else
    {
      $vlr_dsc_acr = 0;
    }
    $vlr_bruto   = str_replace(",", ".", str_replace(".", "", str_replace(".", "", str_replace(".", "", $fin_lancamento['vlr_bruto']))));
    $vlr_final   = str_replace(",", ".", str_replace(".", "", str_replace(".", "", str_replace(".", "", $fin_lancamento['vlr_final']))));

    $despesa = new Lancamento;
    $despesa->tipo                    = $fin_lancamento['tipo'];
    $despesa->id_banco                = $fin_lancamento['id_banco'];
    $despesa->id_conta                = $fin_lancamento['id_conta'];
    $despesa->num_documento           = $fin_lancamento['num_documento'];
    $despesa->id_cliente              = $fin_lancamento['id_cliente'];
    $despesa->informacao              = $fin_lancamento['informacao'];
    $despesa->vlr_bruto               = $vlr_bruto;
    $despesa->vlr_dsc_acr             = $vlr_dsc_acr;
    $despesa->vlr_final               = $vlr_final;
    $despesa->parcela                 = $fin_lancamento['parcela'];
    $despesa->id_forma_pagamento      = $fin_lancamento['id_forma_pagamento'];
    $despesa->descricao               = $fin_lancamento['descricao'];
    $despesa->dt_vencimento           = $fin_lancamento['dt_vencimento'];
    $despesa->dt_recebimento          = $fin_lancamento['dt_recebimento'];
    $despesa->dt_confirmacao          = $fin_lancamento['dt_confirmacao'];
    $despesa->id_usuario_lancamento   = $fin_lancamento['id_usuario_lancamento'];
    $despesa->id_usuario_confirmacao  = $fin_lancamento['id_usuario_confirmacao'];
    $despesa->id_caixa                = $fin_lancamento['id_caixa'];
    $despesa->id_lancamento_origem    = $fin_lancamento['id_lancamento_origem'];
    $despesa->origem                  = $fin_lancamento['origem'];
    $despesa->status                  = $fin_lancamento['status'];
    $despesa->save();

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Lançado '.$despesa->informacao.', no valor de R$ '.$despesa->vlr_final.' , realizado com sucesso.',
      'data'    => $fin_lancamento->toArray(),
      'redirect' => route('lancamento.index'),
    ];

    return $response;
  }
  
  public function r_gerais()
  {
    $bancos  = Banco::get();
    $pessoas = Pessoa::get();

    return view('sistema.financeiro.lancamentos.receitas',[
      'bancos'  => $bancos,
      'pessoas' => $pessoas,
    ]);
  }

  public function lancar_r_gerais(Request $request)
  {
    $fin_lancamento = collect($request, true);

    if(isset($vlr_dsc_acr))
    {
      $vlr_dsc_acr = str_replace(",", ".", str_replace(".", "", str_replace(".", "", str_replace(".", "", $fin_lancamento['vlr_dsc_acr']))));
    }
    else
    {
      $vlr_dsc_acr = 0;
    }
    $vlr_bruto   = str_replace(",", ".", str_replace(".", "", str_replace(".", "", str_replace(".", "", $fin_lancamento['vlr_bruto']))));
    $vlr_final   = str_replace(",", ".", str_replace(".", "", str_replace(".", "", str_replace(".", "", $fin_lancamento['vlr_final']))));
    
    $despesa = new Lancamento;
    $despesa->tipo                    = $fin_lancamento['tipo'];
    $despesa->id_banco                = $fin_lancamento['id_banco'];
    $despesa->id_conta                = $fin_lancamento['id_conta'];
    $despesa->num_documento           = $fin_lancamento['num_documento'];
    $despesa->id_cliente              = $fin_lancamento['id_cliente'];
    $despesa->informacao              = $fin_lancamento['informacao'];
    $despesa->vlr_bruto               = $vlr_bruto;
    $despesa->vlr_dsc_acr             = $vlr_dsc_acr;
    $despesa->vlr_final               = $vlr_final;
    $despesa->parcela                 = $fin_lancamento['parcela'];
    $despesa->id_forma_pagamento      = $fin_lancamento['id_forma_pagamento'];
    $despesa->descricao               = $fin_lancamento['descricao'];
    $despesa->dt_vencimento           = $fin_lancamento['dt_vencimento'];
    $despesa->dt_recebimento          = $fin_lancamento['dt_recebimento'];
    $despesa->dt_confirmacao          = $fin_lancamento['dt_confirmacao'];
    $despesa->id_usuario_lancamento   = $fin_lancamento['id_usuario_lancamento'];
    $despesa->id_usuario_confirmacao  = $fin_lancamento['id_usuario_confirmacao'];
    $despesa->id_caixa                = $fin_lancamento['id_caixa'];
    $despesa->id_lancamento_origem    = $fin_lancamento['id_lancamento_origem'];
    $despesa->origem                  = $fin_lancamento['origem'];
    $despesa->status                  = $fin_lancamento['status'];
    $despesa->save();

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Lançado '.$despesa->informacao.', no valor de R$ '.$despesa->vlr_final.' , realizado com sucesso.',
      'data'    => $fin_lancamento->toArray(),
    ];

    return redirect()->route('lancamento.index')->with($response);
  }
  
  public function vale()
  {
    $colaboradores = Pessoa::whereHas('aistggwbdgrrher', function (Builder $query) {
      $query->where('nome', 'LIKE', 'Colaborador');
    })->get();
    
    return view('sistema.financeiro.lancamentos.vale',[
      'colaboradores'      => $colaboradores,
    ]);
  }

  public function lancar_vale(Request $request)
  {
    $fin_lancamento = collect($request[0], true);

    $conta_interna = new ContaInterna;
    $conta_interna->id_origem      = null;
    $conta_interna->fonte_origem   = 'fin_lancamentos';
    $conta_interna->id_pessoa      = $fin_lancamento['id_pessoa'];
    $conta_interna->tipo           = $fin_lancamento['informacao'];
    $conta_interna->percentual     = 1;
    $conta_interna->valor          = $fin_lancamento['vlr_final'] * -1;
    $conta_interna->dt_prevista    = $fin_lancamento['dt_vencimento'];
    $conta_interna->dt_quitacao    = null;
    $conta_interna->status         = 'Em Aberto';
    $conta_interna->save();
    
    $lancar_vale = new Lancamento;
    $lancar_vale->tipo                    = $fin_lancamento['tipo'];
    $lancar_vale->id_banco                = $fin_lancamento['id_banco'];
    $lancar_vale->id_conta                = $fin_lancamento['id_conta'];
    $lancar_vale->num_documento           = $fin_lancamento['num_documento'];
    $lancar_vale->id_cliente              = $fin_lancamento['id_pessoa'];
    $lancar_vale->informacao              = $fin_lancamento['informacao'];
    $lancar_vale->vlr_bruto               = $fin_lancamento['vlr_bruto'];
    $lancar_vale->vlr_dsc_acr             = $fin_lancamento['vlr_dsc_acr'];
    $lancar_vale->vlr_final               = $fin_lancamento['vlr_final'];
    $lancar_vale->parcela                 = $fin_lancamento['parcela'];
    $lancar_vale->id_forma_pagamento      = $fin_lancamento['id_forma_pagamento'];
    $lancar_vale->descricao               = $fin_lancamento['descricao'];
    $lancar_vale->dt_vencimento           = $fin_lancamento['dt_vencimento'];
    $lancar_vale->dt_recebimento          = $fin_lancamento['dt_recebimento'];
    $lancar_vale->dt_confirmacao          = $fin_lancamento['dt_confirmacao'];
    $lancar_vale->id_usuario_lancamento   = $fin_lancamento['id_usuario_lancamento'];
    $lancar_vale->id_usuario_confirmacao  = $fin_lancamento['id_usuario_confirmacao'];
    $lancar_vale->id_caixa                = $fin_lancamento['id_caixa'];
    $lancar_vale->id_lancamento_origem    = $conta_interna->id;
    $lancar_vale->origem                  = $fin_lancamento['origem'];
    $lancar_vale->status                  = $fin_lancamento['status'];
    $lancar_vale->save();

    $atualizar = ContaInterna::find($conta_interna->id);
    $conta_interna->id_origem = $lancar_vale->id;
    $conta_interna->update();

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => $fin_lancamento['informacao'].', no valor de R$ '.$fin_lancamento['vlr_final'].' , realizado com sucesso.',
      'data'    => $fin_lancamento->toArray(),
    ];

    return redirect()->route('lancamento.index')->with($response);
  }

  public function pao()
  {    
    return view('sistema.financeiro.lancamentos.pao');
  }

  public function lancar_pao(Request $request)
  {
    $fin_lancamento = collect($request[0], true);

    $lancar_pao = new Lancamento;
    $lancar_pao->tipo                    = $fin_lancamento['tipo'];
    $lancar_pao->id_banco                = $fin_lancamento['id_banco'];
    $lancar_pao->id_conta                = $fin_lancamento['id_conta'];
    $lancar_pao->num_documento           = $fin_lancamento['num_documento'];
    $lancar_pao->id_cliente              = $fin_lancamento['id_cliente'];
    $lancar_pao->informacao              = $fin_lancamento['informacao'];
    $lancar_pao->vlr_bruto               = $fin_lancamento['vlr_bruto'];
    $lancar_pao->vlr_dsc_acr             = $fin_lancamento['vlr_dsc_acr'];
    $lancar_pao->vlr_final               = $fin_lancamento['vlr_final'];
    $lancar_pao->parcela                 = $fin_lancamento['parcela'];
    $lancar_pao->id_forma_pagamento      = $fin_lancamento['id_forma_pagamento'];
    $lancar_pao->descricao               = $fin_lancamento['descricao'];
    $lancar_pao->dt_vencimento           = $fin_lancamento['dt_vencimento'];
    $lancar_pao->dt_recebimento          = $fin_lancamento['dt_recebimento'];
    $lancar_pao->dt_confirmacao          = $fin_lancamento['dt_confirmacao'];
    $lancar_pao->id_usuario_lancamento   = $fin_lancamento['id_usuario_lancamento'];
    $lancar_pao->id_usuario_confirmacao  = $fin_lancamento['id_usuario_confirmacao'];
    $lancar_pao->id_caixa                = $fin_lancamento['id_caixa'];
    $lancar_pao->id_lancamento_origem    = $fin_lancamento['id_lancamento_origem'];
    $lancar_pao->origem                  = $fin_lancamento['origem'];
    $lancar_pao->status                  = $fin_lancamento['status'];
    $lancar_pao->save();

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Lançado '.$fin_lancamento['informacao'].', no valor de R$ '.$fin_lancamento['vlr_final'].' , realizado com sucesso.',
      'data'    => $fin_lancamento->toArray(),
    ];

    return redirect()->route('lancamento.index')->with($response);
  }

  public function transferencia()
  { 
    $bancos = Banco::get();
    $bancos = Banco::get();
 
    return view('sistema.financeiro.lancamentos.transferencia', [
     'bancos'   =>   $bancos,
    ]);
  }

  public function lancar_transferencia(Request $request)
  {   
    $dado_O = Lancamento::create(collect($request[0])->toArray());
    $dado_D = Lancamento::create(collect($request[1])->toArray());

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => $dado_O->informacao.', no valor de R$ '.$dado_O->vlr_final.' , realizado com sucesso.',
      'data'    => $dado_O->toArray(),
    ];

    return redirect()->route('lancamento.index')->with($response);
  }

}
