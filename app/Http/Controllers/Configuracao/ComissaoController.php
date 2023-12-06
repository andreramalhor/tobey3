<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Atendimento\Pessoa;
use App\Models\Cadastro\ServicoProduto;
use App\Models\pivots\ColaboradorServico;

use App\Models\Configuracao\Tipo_de_Pessoa;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Financeiro\Banco;
use App\Models\Catalogo\Marca;
use App\Models\Financeiro\ContaInterna;
use App\Models\Financeiro\Lancamento;

class ComissaoController extends Controller
{
  public function index()
  {
    $pessoas = Pessoa::whereHas('aistggwbdgrrher', function (Builder $query) {
      $query->where('nome', 'LIKE', 'Profissional');
    })->get();

    // $servicos = ServicoProduto::where('tipo', '=', 'Produto')->with('QualCategoriaDisso')->orderBy('nome')->get()->groupBy('QualCategoriaDisso.nome');
    $catalogo = ServicoProduto::with('QualCategoriaDisso')->orderBy('nome')->get()->groupBy('tipo');

    return view('sistema.configuracao.comissoes.index', [
      'pessoas'   => $pessoas,
      'catalogo'  => $catalogo,
    ]);
  }

  public function comissoes_widget()
  {
    $start = \Carbon\Carbon::today()->startOfMonth();
    $end   = \Carbon\Carbon::today()->endOfMonth();
    
    $comissoes = ContaInterna::
                              whereBetween('dt_prevista', [$start, $end])->
                              where('id_pessoa', '=', \Auth::User()->id )->
                              get(['id', 'dt_prevista', 'valor', 'fonte_origem', 'tipo', 'status']);
                                  
    return response()->json($comissoes);
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

  public function configurarTodas(Request $request)
  {
    if ($request->prc_comissao == null)
    {
      $dados_tratados = [
        'id_servprod'      => $request->id_servprod * 1,
        'prc_comissao'    => 0,
        'id_profexec' => $request->id_profexec * 1,
        'executa'         => 'Não',
      ];
    }
    else
    {
      $dados_tratados = [
        'id_servprod'      => $request->id_servprod * 1,
        'prc_comissao'    => $request->prc_comissao / 100,
        'id_profexec' => $request->id_profexec * 1,
        'executa'         => 'Sim',
      ];
    }

    $servico    = ServicoProduto::find($dados_tratados['id_servprod']);
    $pesquisado = ColaboradorServico::
        where('id_profexec', '=', $request['id_profexec'])
      ->where('id_servprod', '=', $request['id_servprod'])
      ->get();
 

    if($pesquisado->count() == 1)
    {
      $comissao = ColaboradorServico::find($pesquisado->first()->id);
      $comissao->prc_comissao = $dados_tratados['prc_comissao'];
      $comissao->executa      = $dados_tratados['executa'];
      $comissao->save();
    }
    if($pesquisado->count() == 0)
    {
      $comissao = new ColaboradorServico;
      $comissao->id_profexec = $request['id_profexec'];
      $comissao->id_servprod      = $request['id_servprod'];
      $comissao->prc_comissao    = $dados_tratados['prc_comissao'];
      $comissao->executa         = $dados_tratados['executa'];
      $comissao->save();
    }
    if($pesquisado->count() > 1)
    {
      foreach ($pesquisado as $value)
      {
        $comissao = ColaboradorServico::find($value->id);
        $comissao->delete();
      }

      $comissao = new ColaboradorServico;
      $comissao->id_profexec = $request['id_profexec'];
      $comissao->id_servprod      = $request['id_servprod'];
      $comissao->prc_comissao    = $dados_tratados['prc_comissao'];
      $comissao->executa         = $dados_tratados['executa'];
      $comissao->save();
    }

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Comissão do Serviço "'.$servico->nome.'" ajustado(a) com sucesso.',
      'data'    => $servico->toArray(),
    ];

    return $response;
  }

  public function pagamentos()
  {
    $aberto = ContaInterna::
                where('status', 'Aberto')->
                whereHas('xeypqgkmimzvknq', function($q)
                {
                  $q->whereHas('aistggwbdgrrher', function($y)
                  {
                    $y->where('id_tipo', '=', 4);  // Colaborador
                  });
                })->
                get();

    $pago   = ContaInterna::
                where('status', 'Pago')->
                where('id_pessoa', 14)->
                whereHas('xeypqgkmimzvknq', function($q)
                {
                  $q->whereHas('aistggwbdgrrher', function($y)
                  {
                    $y->where('id_tipo', '=', 4);  // Colaborador
                  });
                })->
                get();
    // dd($pago);
    return view('sistema.financeiro.comissoes.index', [
     'aberto'     =>   $aberto,
     'pago'       =>   $pago,
    ]);
  }

  public function pagarProfissional($id)
  {
    $aberto = ContaInterna::
            where('id_pessoa', $id)->
            where('status', 'Aberto')->
            get();

    return view('sistema.financeiro.comissoes.pagarprofissional', [
     'aberto'     =>   $aberto,
    ]);
  }

  public function pagoProfissional($id = 1, $lancamento = 1)
  {
    dd('~');
    $pago = ContaInterna::
            where('id_pessoa', $id)->
            where('id_destino', $lancamento)->
            where('status', 'Pago')->
            get();

    return view('sistema.financeiro.comissoes.pagoprofissional', [
     'pago'     =>   $pago,
    ]);
  }

  public function pagamentoComissoes(Request $request)
  {
    $fin_comissoes = collect(json_decode($request['fin_comissoes']));

    $lancamento = new Lancamento;
    $lancamento->tipo                    = 'D';
    $lancamento->id_banco                = \Auth::User()->abcde->first()->id_banco;
    $lancamento->id_conta                = null;                                                                                                      //DEFINIR CONTA CONTABIL COMISSAO
    $lancamento->num_documento           = 'Pagamento Comissão';
    $lancamento->id_cliente              = $request->id_pessoa;
    $lancamento->informacao              = 'Comissoes de '.$request->nome_profissional.', do dia '.\Carbon\Carbon::parse($fin_comissoes->min('dt_prevista'))->format('d/m/Y').' à '.\Carbon\Carbon::parse($fin_comissoes->max('dt_prevista'))->format('d/m/Y');
    $lancamento->vlr_bruto               = $request->vlr_final;
    $lancamento->vlr_dsc_acr             = 0;
    $lancamento->vlr_final               = $request->vlr_final;
    $lancamento->parcela                 = '01/01';
    $lancamento->id_forma_pagamento      = 1;
    $lancamento->descricao               = 'Dinheiro';
    $lancamento->dt_vencimento           = \Carbon\Carbon::today();
    $lancamento->dt_recebimento          = \Carbon\Carbon::today();
    $lancamento->dt_confirmacao          = null;
    $lancamento->id_usuario_lancamento   = \Auth::User()->id;
    $lancamento->id_usuario_confirmacao  = null;
    $lancamento->id_caixa                = \Auth::User()->abcde->first()->id;
    $lancamento->id_lancamento_origem    = null;
    $lancamento->origem                  = 'fin_conta_interna';
    $lancamento->status                  = 'Confirmado';
    $lancamento->save();

    foreach($fin_comissoes as $comissao)
    {
      $fin_conta_interna = ContaInterna::find($comissao->id);
      $fin_conta_interna->status         = 'Pago';
      $fin_conta_interna->dt_quitacao    = \Carbon\Carbon::now();
      $fin_conta_interna->id_destino     = $lancamento->id;
      $fin_conta_interna->fonte_destino  = 'fin_lancamentos';
      $fin_conta_interna->update();
    }

    return $this->pagamentos();
  }

  public function criarAjuste(Request $request)
  {
    try
    {
      $ajuste = $request->all();

      $fin_conta_interna = new ContaInterna;
      $fin_conta_interna->id_origem      = $ajuste['id_origem'];
      $fin_conta_interna->fonte_origem   = $ajuste['fonte_origem'];
      $fin_conta_interna->id_pessoa      = $ajuste['id_pessoa'];
      $fin_conta_interna->tipo           = $ajuste['tipo'];
      $fin_conta_interna->percentual     = $ajuste['percentual'];
      $fin_conta_interna->valor          = $ajuste['valor'];
      $fin_conta_interna->dt_prevista    = $ajuste['dt_prevista'];
      $fin_conta_interna->dt_quitacao    = $ajuste['dt_quitacao'];
      $fin_conta_interna->status         = $ajuste['status'];
      $fin_conta_interna->save();

      $response = [
        'error'   => false,
        'type'    => 'success',
        'message' => 'Ajuste no valor de R$ "'.$fin_conta_interna->valor.'" lançado(a) com sucesso.',
        'data'    => $fin_conta_interna,
      ];
      
      return redirect()->back()->with($response);
    } 
    catch (ValidatorException $e)
    {
      \DB::rollback();

      $response = $this->excessao($e); 

      return $response;
    }





    return $request->all();
    $pago = ContaInterna::
            where('id_pessoa', $id)->
            where('id_destino', $lancamento)->
            where('status', 'Pago')->
            get();

    return view('sistema.financeiro.comissoes.pagoprofissional', [
     'pago'     =>   $pago,
    ]);
  }

  public function editarComissao($id)
  {
    $comissao = ContaInterna::find($id);

    if ($comissao->status != 'Em Aberto')
    {
      dd('Essa comissão já foi paga e não há como alterar. Clique em voltar e tente outra alternativa.');
    }
    else
    {
      return view('sistema.financeiro.comissoes2.edit', [
        'comissao' => $comissao,
      ]);
    }
  }

  public function updateComissao(Request $request)
  {
    $comissao = ContaInterna::find($request->id);
    $antigo_pessoa = $comissao->id_pessoa;

    if($request->status != 'Em Aberto')
    {
      $response = [
        'type'     => 'danger',
        'message'  => 'Essa comissão já foi paga e não há como alterar. Clique em voltar e tente outra alternativa.',
        'redirect' => route('comissao.pagamento'),
      ];

      return $response;
    }
    else
    {
      $comissao->id_pessoa  = $request->id_profexec_fez_servico;
      $comissao->percentual = $request->percentual;
      $comissao->valor      = $request->valor;
      $comissao->update();

      $response = [
        'type'     => 'success',
        'message'  => 'Comissão alterada com sucesso.',
        'data'     => $comissao->toArray(),
        // 'redirect' => route('comissao.pagamento'),
        'redirect' => route('comissao.pagarProfissional', $antigo_pessoa),
      ];
      return $response;
    }
  }

// =================================================================================================================================================
  public function abertas()
  {
    $abertas = ContaInterna::
                            where('id_pessoa', '=', \Auth::User()->id)->
                            where('status', 'Em Aberto')->
                            where('created_at','>=' ,'2020-09-01 00:00:00')->
                            // limit(5)->
                            get();

    return view('sistema.comissoes.abertas', [
      'abertas'    => $abertas,
    ]);         
  }
  
  public function pagas()
  {
    $pagas = ContaInterna::
                            where('id_pessoa', '=', \Auth::User()->id)->
                            where('status', 'Pago')->
                            where('created_at','>=' ,'2020-09-01 00:00:00')->
                            orderBy('dt_quitacao', 'desc')->
                            // select('dt_quitacao', 'id_destino')->
                            // distinct()->
                            // limit()->
                            get()->
                            groupBy('dt_quitacao');
                            
    return view('sistema.comissoes.pagas', [
      'pagas'    => $pagas,
    ]);
  }

  public function comissaoforasistema()
  {
    $url = ltrim( parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_PATH ) , '/' );

    $id = explode( '/' , $url );

    $aberto = ContaInterna::where('id_pessoa', $id[0])->where('status', 'Em Aberto')->where('created_at','>=' ,'2020-09-01 00:00:00')->get();

    return view('site.conferencia.tabela', [
      'aberto'    => $aberto,
    ]);
  }

}
