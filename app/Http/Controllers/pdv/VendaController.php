<?php

namespace App\Http\Controllers\pdv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PDV\Caixa;
use App\Models\PDV\Venda;
use App\Models\PDV\VendaDetalhe;
use App\Models\PDV\VendaPagamento;
use App\Models\Financeiro\ContaInterna;
use App\Models\Atendimento\Pessoa;
use App\Models\Cadastro\ServicoProduto;
use App\Models\Gerenciamento\Empresa;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Financeiro\RecebimentoCartao;

class VendaController extends Controller
{
  public function index()
  {
    $caixa = $this->temCaixa();

    if (isset($caixa['db']))
    {
      $dado  = $caixa['db'];
    }

    if( $caixa['Abrir'] == 'OK' )
    {
      return redirect()->route('pdv.caixas')->withErrors(['Antes de realizar uma comanda, Você deve "Abrir" ou "Reabrir" um caixa na data de Hoje!!!']) ;
    }

    $vendas = Venda::orderBy('id', 'desc')->withTrashed()->paginate();

    return view('sistema.pdv.vendas.index', [
      'vendas' => $vendas,
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

    $marcas = Venda::where('tipo', 'Serviço')->where('tipo', 'Serviço')->select('marca')->distinct()->get();

    $servicos = Venda::where('tipo', 'Serviço')->where('tipo', 'Serviço')->where(function ($query) use ($dataForm)
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
    // dd($request);
    $caixa             = $this->temCaixa();
    $clientes          = Pessoa::get();

    $produtos_servicos = ServicoProduto::get()->groupby('QualCategoriaDisso.nome');
    $venda             = Venda::find($request->id);
    // $profissionais = Pessoa::whereHas('aistggwbdgrrher', function ($q) {
    //                     $q->where('nome', '=', 'Colaborador');
    //                   })->get();

    $vendas = [];

    return view('sistema.pdv.vendas.create',[
      'caixa'             => $caixa,
      'clientes'          => $clientes,
      // 'profissionais'     => $profissionais,
      'produtos_servicos' => $produtos_servicos,
      'venda'             => $venda,
    ]);
  }

  public function procurar($id)
  {
    $venda = Venda::with('dfyejmfcrkolqjh')->find($id);

    return $venda;
  }

  public function mostrarItens($id)
  {
    $itens = VendaDetalhe::with('hgihnjekboyabez')->where('id_venda', '=', $id)->get();

    return view('sistema.pdv.vendas.mostraritens', [
      'itens' => $itens,
    ]);
  }

  public function store(Request $request)
  {
    $venda = Venda::updateOrCreate(
      [ 'id' => $request->id ], collect($request)->toArray()
      // [ 'status' => 'Aberta', 'id_cliente' => ->id_cliente, 'id_usuario' => $request->id_usuario ]
      // [ 'status' => 'Aberta', 'id_cliente' => $request->id_cliente, 'id_usuario' => $request->id_usuario ]
    );
    // return $venda;

    if(sizeof($request->pdv_venda_detalhe) > 0)
    {
      $venda_detalhe = $venda
                            ->dfyejmfcrkolqjh()->create($request->pdv_venda_detalhe)
                            ->hgihnjekboyabez()->create($request->fin_conta_interna);
    }
    // // $venda_detalhe = $venda->dfyejmfcrkolqjh()->create( $request->pdv_venda_detalhe );
    // $venda_detalhe = $venda->dfyejmfcrkolqjh()->updateOrCreate(
    //   [ 'id' => $request->id, 'id_venda' => $venda->id ],
    //   [ $request->pdv_venda_detalhe ]
    // );

    $response = [
      'type'     => 'success',
      'message'  => "A venda '$venda->id' foi aberto com sucesso.",
      'data'     => $venda,
    ];

    return $response;
  }

  public function apagarItem($id)
  {
    // $itens = Venda::with('dfyejmfcrkolqjh', 'dfyejmfcrkolqjh.hgihnjekboyabez')->find($id);
    $item = VendaDetalhe::find($id);
    $nome = $item->kcvkongmlqeklsl->nome;

    $item->hgihnjekboyabez->delete();
    $item->delete();
    
    $response = [
      'type'     => 'success',
      'message'  => "O Item '$nome' foi apagado da comanda com sucesso.",
      'data'     => $nome,
    ];

    return $response;
  }

  public function pagar($id)
  {
    $venda = Venda::find($id);

    return view('sistema.pdv.vendas.pagar', [
      'venda' => $venda,
    ]);
  }

  public function registrar(Request $request)
  {
    try
    {
      \DB::beginTransaction();
      $comanda    = collect(json_decode($request['pdv_comanda']));
      $detalhes   = collect(json_decode($request['pdv_comanda_detalhes']));
      $pagamentos = collect(json_decode($request['pdv_comanda_pagamentos']));
      
      // dd($detalhes->sum('vlr_venda'), $comanda,$detalhes,$pagamentos);                   // corrigir dados abaixo depois
      $pdv_comanda                  = Venda::find($comanda['id']);
      $pdv_comanda->qtd_produtos    = $detalhes->count('id');
      $pdv_comanda->vlr_prod_serv   = $detalhes->sum('vlr_final');
      $pdv_comanda->vlr_negociados  = $detalhes->sum('vlr_final');
      $pdv_comanda->vlr_dsc_acr     = 0;
      $pdv_comanda->vlr_final       = $detalhes->sum('vlr_final');
      $pdv_comanda->status          = 'Finalizado';
      $pdv_comanda->save();

      // dd($detalhes->vlr_final, $comanda,$detalhes,$pagamentos);                   // corrigir dados abaixo depois
      foreach ($detalhes->all() as $i => $detalhe)
      {
        $detalhes                     = VendaDetalhe::find($detalhe->id);
        $detalhes->vlr_dsc_acr        = 0;
        $detalhes->vlr_venda          = $detalhes->vlr_final;
        $detalhes->vlr_negociado      = $detalhes->vlr_final;
        $detalhes->status             = 'Finalizado';
        $detalhes->save();
      }

      foreach ($pagamentos->all() as $i => $pagamento)
      {
        $pdv_pagamentos = new VendaPagamento;
        $pdv_pagamentos->id_venda                  = $pdv_comanda->id;
        $pdv_pagamentos->id_forma_pagamento        = $pagamento->id_forma_pagamento;
        if( $pagamento->forma_pagamento == $pagamento->bandeira )
        {
          $pdv_pagamentos->descricao               = $pagamento->forma_pagamento.' ('.$pagamento->tipo.')';
        }
        else
        {
          $pdv_pagamentos->descricao               = $pagamento->forma_pagamento.' - '.$pagamento->bandeira.' ('.$pagamento->tipo.')';
        }
        $pdv_pagamentos->parcela                   = $pagamento->parcela;
        $pdv_pagamentos->valor                     = $pagamento->valor;
        $pdv_pagamentos->status                    = $pagamento->status;
        $pdv_pagamentos->dt_prevista               = $pagamento->dt_recebimento;
        $pdv_pagamentos->save();

        if( $pagamento->forma_pagamento == 'Fiado' OR $pagamento->forma_pagamento == 'Conta Interna' )
        {
          $conta_interna = new ContaInterna;
          $conta_interna->id_origem     = $pdv_pagamentos->id;
          $conta_interna->fonte_origem  = 'pdv_vendas_pagamentos';
          $conta_interna->id_pessoa     = $comanda['id_cliente'];
          $conta_interna->tipo          = $pagamento->forma_pagamento;
          $conta_interna->percentual    = 1;
          $conta_interna->valor         = $pdv_pagamentos->valor * - 1;
          $conta_interna->dt_prevista   = $pdv_pagamentos->dt_prevista;   //verificar se nao vai dar erro
          $conta_interna->dt_quitacao   = null;
          $conta_interna->status        ='Em Aberto';
          $conta_interna->save();
        }

        $forma_pagamento = Forma_Pagamento::find($pagamento->id_forma_pagamento);

        if ($forma_pagamento->taxa != 0)
        {
          $pgto_cartao = new RecebimentoCartao;
          $pgto_cartao->id_pagamento       = $pdv_pagamentos->id ?? null;
          $pgto_cartao->id_forma_pagamento = $pagamento->id_forma_pagamento ?? null;
          $pgto_cartao->vlr_real           = $pagamento->valor ?? null;
          $pgto_cartao->prc_descontado     = $forma_pagamento->taxa ?? null;
          $pgto_cartao->vlr_final          = $pagamento->valor - ($pagamento->valor * $forma_pagamento->taxa / 100) ?? null;
          $pgto_cartao->dt_prevista        = $pagamento->dt_recebimento ?? null;
          $pgto_cartao->status             = $pagamento->status ?? null;
          $pgto_cartao->id_lancamento      = null;
          $pgto_cartao->origem_lancamento  = null;
          $pgto_cartao->save();
        }
      }

      \DB::commit();

      session()->flash('resposta', [
       'error'    => false,
       'type'     => 'success',
       'message'  => 'Comanda '.$pdv_comanda->id.' realizada com sucesso no caixa de número '.$pdv_comanda->id_caixa.', no valor total de R$ '.$pdv_pagamentos->valor.', em '.$pdv_pagamentos->forma_pagamento.'.',
       'data'     => $comanda,
      ]); 

      return redirect()->route('pdv.vendas.show', [$comanda['id']]);
    }
    catch (ValidatorException $e)
    {
      \DB::rollback();
            
      $response = $this->excessao($e); 

      return $response;
    }
  }

  public function show($id)
  {
    $venda = Venda::find($id);
    $empresa = Empresa::first();

    return view('sistema.pdv.vendas.show', [
      'venda'            =>      $venda,
      'empresa'          =>      $empresa,
    ]);
  }

  public function modal($id)
  {
    $empresa = Empresa::first();

    $venda = Venda::
                  // with('lufqzahwwexkxli')->
                  // with('dfyejmfcrkolqjh.hgihnjekboyabez.xeypqgkmimzvknq')->
                  // with('dfyejmfcrkolqjh.kcvkongmlqeklsl')->
                  // with('ssqlnxsbyywplanVendas.qmbnkthuczqdsdn')->
                  find($id);
    
                  // return view('sistema.pdv.vendas.auxiliares.mod_venda_mostrar', [
      return view('sistema.pdv.vendas.auxiliares.mod_venda_mostrar_conteudo', [
      'venda'            =>      $venda,
      'empresa'          =>      $empresa,
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
    $venda = Venda::find($id);
    $verificar_comissoes = 'OK';

    if($venda->PDVCaixasVendas->status == "Aberto" )
    {
      foreach($venda->dfyejmfcrkolqjh as $detalhes)
      {
        if ( $detalhes->VerdadeiraContaInternaComissao->status != "Aberto" )
        {
          $verificar_comissoes = "Tem Pago";
        }
      }

      if($verificar_comissoes == 'OK')
      {
        $venda->status = "Excluído";
        $venda->update();
        $venda->delete();
      }
      else
      {
        return response()->json('Essa venda não pode ser excluída. Ela possui comissões que já foram pagas.', 422);  //i'm not getting any json with errors
      }

    }
    else
    {
      return "O caixa a que esta venda percente já está fechado. Reabra e tente novamente.";
    }
  }

  public function temCaixa($id = null)
  {
    if( !isset($id) )
    {
      $caixa_db = Caixa::
              where('id_usuario_abertura','=', \Auth::user()->id)->
              where('status','=', 'Aberto')->
              first();
    }
    else{
    dd('úúúúúúúúú');
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

  public function vendasPorProduto($id)
  {
    $vendas = VendaDetalhe::
                          where('id_servprod', '=', $id)->
                          with(['sbbgaqleesuzlus' => function ($query)
                          {
                            $query->select('id', 'id_cliente')->with(['lufqzahwwexkxli']);
                          }])->
                          orderBy('created_at', 'ASC')->
                          // withTrashed()->
                          paginate(10);
    return $vendas;
  }
}
