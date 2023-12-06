<?php

namespace App\Http\Controllers\pdv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PDV\Caixa;
use App\Models\Financeiro\Banco;
use App\Models\Financeiro\Lancamento;
use App\Models\PDV\VendaPagamento;

class CaixasController extends Controller
{
  public function caixas()
  {
    $caixa = $this->check();
    
    $caixas = Caixa::orderBy('id', 'desc')->paginate();

    return view('sistema.pdv.caixas.index', [
      'caixa'  => $caixa,
      'caixas' => $caixas,
    ]);
  }

  public function caixas_tabelar(Request $request)
  {
    $caixa = $this->check();

    $caixas = Caixa::
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          orwhere('id_banco', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('id_usuario_abertura', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('status', 'LIKE', '%'.$request->pesquisa.'%' );
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->id_banco ) )
                        {
                          $query->where('id_banco', 'LIKE', '%'.$request->id_banco.'%' );
                        }
                        if ( isset( $request->id_usuario_abertura ) )
                        {
                          $query->where('id_usuario_abertura', 'LIKE', '%'.$request->id_usuario_abertura.'%' );
                        }
                        if ( isset( $request->status ) )
                        {
                          $query->where('status', 'LIKE', '%'.$request->status.'%' );
                        }
                      })->
                      orderBy($request->ordenar_por ?? 'id', $request->ordem ?? 'DESC')->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());
    
    return view('sistema.pdv.caixas.tabelar', [
      'caixas' => $caixas,
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

    $marcas = Caixa::where('tipo', 'Serviço')->where('tipo', 'Serviço')->select('marca')->distinct()->get();

    $servicos = Caixa::where('tipo', 'Serviço')->where('tipo', 'Serviço')->where(function ($query) use ($dataForm)
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

  public function caixas_adicionar()
  {
    $bancos = Banco::whereDoesntHave('iesbdkwdkadqfgh', function ($query)
    {
      $query->where('status', '=', 'Aberto');
    })->pluck('nome', 'id');

    return view('sistema.pdv.caixas2.create',[
      'bancos' => $bancos,
    ]);
  }

  public function procurar(Request $request)
  {
    $caixa = Caixa::where('id_banco', '=', $request->id_banco)->orderBy('id', 'desc')->get();
   
    if($caixa->count() != 0)
    {
      $caixa['lancamentos'] = Lancamento::where('id_banco', '=', $caixa->first()->id_banco)->where('id_caixa', '=', null)->get();
      
      return response()->json($caixa->first());
    }
        
    $caixa = [];

    return response()->json($caixa);
  }

  public function find($id)
  {
    $caixa = Caixa::where('id_banco', '=', $id)->orderBy('id', 'desc')->first();

    $caixa['lancamentos'] = Lancamento::where('id_banco', '=', $caixa->id_banco)->where('id_caixa', '=', null)->get();

    return $caixa->toJson();
  }

  public function store(Request $request)
  {
    $caixa = Caixa::create($request->toArray());

    $pagamentos = collect(json_decode($request->fin_lancamentos));
    
    foreach ($pagamentos as $i => $pagamento)
    {
      $fin_lancamentos = Lancamento::find($pagamento);
      $fin_lancamentos->id_caixa = $caixa->id;
      $fin_lancamentos->save();
    }

    session()->flash('resposta', [
      'type'    => 'success',
      'message' => "O caixa '$caixa->id' foi aberto com sucesso.",
      'data'    => $caixa->toArray(),
    ]);

    return redirect()->route('pdv.caixas');
  }

  // public function show($id)
  // {
  //   $caixa = Caixa::find($id);

  //   $pagamentos = VendaPagamento::
  //   selectRaw('sum(valor) as liquido, id_forma_pagamento')->
  //   whereHas('yshghlsawerrgvd.PDVCaixasVendas', function ($query) use ($id) {
  //     $query->where('id_caixa', $id);
  //   })->
  //   groupBy('id_forma_pagamento')->
  //   with('qmbnkthuczqdsdn')->
  //   get();

  //   return view('sistema.pdv.caixas.show',[
  //     'caixa'      => $caixa,
  //     'pagamentos' => $pagamentos,
  //   ]);
  // }
  
  public function caixas_mostrar($id)
  {
    $caixa = Caixa::find($id);

    return view('sistema.pdv.caixas.mostrar', [
      'caixa' => $caixa,
    ]);
  }

  public function caixas_imprimir($id)
  {
    $caixa = Caixa::find($id);

    return view('sistema.pdv.caixas.imprimir', [
      'caixa' => $caixa,
    ]);
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

  public function check($id = null)
  {
    if( !isset($id) )
    {
      $caixa_db = Caixa::
      where('id_usuario_abertura','=', \Auth::user()->id)->
      where('status','=', 'Aberto')->
      first();
    }
    else
    {
      $caixa_db = Caixa::
      where('id','=', $id)->
      where('id_usuario_abertura','=', \Auth::user()->id)->
      where('status','=', 'Aberto')->
      first();
    }

    if( isset($caixa_db) )
    {
      $caixa['db']            = $caixa_db;

      if( \Carbon\Carbon::parse($caixa_db->dt_abertura)->isToday() )
      {
        $caixa['Abrir']       = '';
        $caixa['Reabrir']     = 'OK';
        $caixa['Fechar']      = '';
        $caixa['Validar']     = '';
        $caixa['Movimentar']  = 'OK';
      }
      else
      {
        $caixa['Abrir']       = '';
        $caixa['Reabrir']     = '';
        $caixa['Fechar']      = 'OK';
        $caixa['Validar']     = '';
        $caixa['Movimentar']  = '';
      }
    }
    else
    {
      $caixa['Abrir']       = 'OK';
      $caixa['Reabrir']     = '';
      $caixa['Fechar']      = '';
      $caixa['Validar']     = '';
      $caixa['Movimentar']  = '';
    }

    return $caixa;
  }


  public function close($id)
  {
    // if ( Gate::denies('Editar.Caixas') )
      // return redirect()->back()->withErrors(['msg', 'Você não tem acesso para visualizar esta área']) ;

    $caixa = Caixa::find($id);

    return view('sistema.pdv.caixas.caixa_fechar', [
      'caixa'          =>      $caixa,
    ]);
  }

  public function closed(Request $request, $id)
  {
    // if ( Gate::denies('Editar.Caixas') )
      // return redirect()->back()->withErrors(['msg', 'Você não tem acesso para visualizar esta área']) ;

    $dado = Caixa::find($id);
    $dado->update($request->all());

    $response = [
      'error'   => false,
      'type'    => 'warning',
      'message' => 'Caixa '.$dado->id.' encerrado com sucesso, com valor: R$ '.number_format($dado->vlr_fechamento, 2, ',', '.'),
      'data'    => $dado->toArray(),
    ];

    return redirect()->route('pdv.caixas');
  }

  public function reopen($id)
  {
    // if ( Gate::denies('Editar.Caixas') )
      // return redirect()->back()->withErrors(['msg', 'Você não tem acesso para visualizar esta área']) ;

    $caixa = Caixa::find($id);
    $dado = $caixa->update([
      'status'          => 'Aberto',
      'vlr_fechamento'  => null,
      'dt_fechamento'   => null
    ]);

    $response = [
      'error'   => false,
      'type'    => 'warning',
      'message' => 'Caixa '.$caixa->id.' reaberto com sucesso, com saldo atual: R$ '.number_format($caixa->saldo_atual, 2, ',', '.'),
      'data'    => $caixa->toArray(),
    ];

    return redirect()->route('pdv.caixas');
  }

  public function confirm($id)
  {
    // if ( Gate::denies('Validar.Caixas') )
      // return redirect()->back()->withErrors(['msg', 'Você não tem acesso para visualizar esta área']) ;

    $caixa = Caixa::find($id);

    // $plano_contas = PlanoConta::get();

    return view('sistema.pdv.caixas.caixa_validar', [
     'caixa'                       =>   $caixa,
     // 'plano_contas'               =>   $plano_contas,
    ]);
  }

  public function validated(Request $request, $id)
  {
    // if ( Gate::denies('Validar.Caixas') )
      // return redirect()->back()->withErrors(['msg', 'Você não tem acesso para visualizar esta área']) ;

    try
    {
      \DB::beginTransaction();

      $fin_lancamentos          = $request['fin_lancamentos'] ?? null;
      $fin_lancamentos_dinheiro = $request['fin_lancamentos_dinheiro'] ?? null;
      $fin_pagamentos_cartoes   = $request['fin_pagamentos_cartoes'] ?? null;
      $pdv_comandas_pagamentos  = $request['pdv_comandas_pagamentos'] ?? null;
      $pdv_caixas               = $request['pdv_caixas'];

      if ( !empty($fin_lancamentos_dinheiro) )
        foreach ( $fin_lancamentos_dinheiro as $lancamento_dinheiro)
        {
          $v_lancamento_dinheiro = new Lancamento;
          $v_lancamento_dinheiro->tipo                    = $lancamento_dinheiro['tipo'];
          $v_lancamento_dinheiro->id_banco                = $lancamento_dinheiro['id_banco'];
          $v_lancamento_dinheiro->id_conta                = $lancamento_dinheiro['id_conta'];
          $v_lancamento_dinheiro->num_documento           = $lancamento_dinheiro['num_documento'];
          $v_lancamento_dinheiro->id_cliente              = $lancamento_dinheiro['id_cliente'];
          $v_lancamento_dinheiro->informacao              = $lancamento_dinheiro['informacao'];
          $v_lancamento_dinheiro->vlr_bruto               = $lancamento_dinheiro['vlr_bruto'];
          $v_lancamento_dinheiro->vlr_dsc_acr             = $lancamento_dinheiro['vlr_dsc_acr'];
          $v_lancamento_dinheiro->vlr_final               = $lancamento_dinheiro['vlr_final'];
          $v_lancamento_dinheiro->parcela                 = $lancamento_dinheiro['parcela'];
          $v_lancamento_dinheiro->id_forma_pagamento      = $lancamento_dinheiro['id_forma_pagamento'];
          $v_lancamento_dinheiro->descricao               = $lancamento_dinheiro['descricao'];
          $v_lancamento_dinheiro->dt_vencimento           = $lancamento_dinheiro['dt_vencimento'];
          $v_lancamento_dinheiro->dt_recebimento          = $lancamento_dinheiro['dt_recebimento'];
          $v_lancamento_dinheiro->dt_confirmacao          = $lancamento_dinheiro['dt_confirmacao'];
          $v_lancamento_dinheiro->id_usuario_lancamento   = $lancamento_dinheiro['id_usuario_lancamento'];
          $v_lancamento_dinheiro->id_usuario_confirmacao  = $lancamento_dinheiro['id_usuario_confirmacao'];
          $v_lancamento_dinheiro->id_caixa                = $lancamento_dinheiro['id_caixa'];
          $v_lancamento_dinheiro->id_lancamento_origem    = $lancamento_dinheiro['id_lancamento_origem'];
          $v_lancamento_dinheiro->origem                  = $lancamento_dinheiro['origem'];
          $v_lancamento_dinheiro->status                  = $lancamento_dinheiro['status'];
          $v_lancamento_dinheiro->save();
        }

      if ( !empty($fin_lancamentos) )
        foreach ( $fin_lancamentos as $lancamento)
        {
          $v_lancamento = Lancamento::find($lancamento['id']);
          $v_lancamento->dt_confirmacao           = $lancamento['dt_confirmacao'];
          $v_lancamento->id_usuario_confirmacao   = $lancamento['id_usuario_confirmacao'];
          $v_lancamento->status                   = $lancamento['status'];
          $v_lancamento->update();
        }

      // if ( !empty($fin_pagamentos_cartoes) )
      //   foreach ( $fin_pagamentos_cartoes as $pagamento)
      //   {
      //     $v_pagamento = new PagamentoCartao;          
      //     $v_pagamento->id_pagamento        = $pagamento['id_pagamento'];
      //     $v_pagamento->id_forma_pagamento  = $pagamento['id_forma_pagamento'];
      //     $v_pagamento->vlr_real            = $pagamento['vlr_real'];
      //     $v_pagamento->prc_descontado      = $pagamento['prc_descontado'];
      //     $v_pagamento->vlr_final           = $pagamento['vlr_final'];
      //     $v_pagamento->dt_prevista         = $pagamento['dt_prevista'];
      //     $v_pagamento->status              = $pagamento['status'];
      //     $v_pagamento->save();
      //   }

      if ( !empty($pdv_comandas_pagamentos) )
        foreach ( $pdv_comandas_pagamentos as $com_pagamentos)
        {
          $v_comanda_pagamento = VendaPagamento::find($com_pagamentos['id']);
          $v_comanda_pagamento->status              = $com_pagamentos['status'];
          $v_comanda_pagamento->update();
        }

      $dado = Caixa::find($id);   // correto
      $atualizado = $dado->update($pdv_caixas);   // correto

      \DB::commit();

      $response = [
        'error'   => false,
        'type'    => 'success',
        'message' => 'Caixa '.$dado->id.' validado com sucesso, com valor final: R$ '.number_format($dado->vlr_fechamento, 2, ',', '.'),
        'data'    => $dado->toArray(),
      ];

      return redirect()->route('pdv.caixas')->with($response);
    }
    catch (ValidatorException $e)
    {
      \DB::rollback();
            
      $response = $this->excessao($e); 

      return $response;
    }
  }

  public function locais($id = null)
  {
    $dados = Caixa::where('id_banco', '=', $id)->where('status', '=', 'Aberto')->get();

    return $dados;
  }

  public function atualizarContadores(Request $request)
  {
    if($request->ajax())
    {
      $caixa = $this->service->atualizarContadores($request->all());

      try
      {
        $dado = Caixa::find($caixa['id_caixa']);
        $dado->nota200                = $caixa['nota200'] ?? null;
        $dado->nota100                = $caixa['nota100'] ?? null;
        $dado->nota50                 = $caixa['nota50'] ?? null;
        $dado->nota20                 = $caixa['nota20'] ?? null;
        $dado->nota10                 = $caixa['nota10'] ?? null;
        $dado->nota5                  = $caixa['nota5'] ?? null;
        $dado->nota2                  = $caixa['nota2'] ?? null;
        $dado->moeda100               = $caixa['moeda100'] ?? null;
        $dado->moeda50                = $caixa['moeda50'] ?? null;
        $dado->moeda25                = $caixa['moeda25'] ?? null;
        $dado->moeda10                = $caixa['moeda10'] ?? null;
        $dado->moeda5                 = $caixa['moeda5'] ?? null;
        $dado->moeda1                 = $caixa['moeda1'] ?? null;
        $dado->update();

        $response = [
          'error'   => false,
          'type'    => 'success',
          'message' => 'Contadores do Caixa '.$dado->id.' atualizados com sucesso',
          'data'    => $dado->toArray(),
        ];

        return $response;
      } 
      catch (ValidatorException $e)
      {
        \DB::rollback();

        $response = $this->excessao($e); 

        return $response;
      }
    }
    else
    {
      return response('Erro no IF do Controller do atualizacontadores');
    }
  }
}
