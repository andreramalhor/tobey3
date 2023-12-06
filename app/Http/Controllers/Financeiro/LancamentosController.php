<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Financeiro\Banco;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\RecebimentoCartao;
use App\Models\Financeiro\ContaInterna;
use App\Models\Financeiro\Compra;
use App\Models\Financeiro\CompraDetalhe;
use App\Models\Financeiro\CompraPagamento;
use App\Models\Financeiro\AReceber;
use App\Models\Atendimento\Pessoa;
use App\Models\Catalogo\ServicoProduto;
use App\Models\Configuracao\ContaContabil;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Gerenciamento\Empresa;

use App\Models\Financeiro\Divida;

class LancamentosController extends Controller
{
  public function dashboard()
  {
    return view('sistema.financeiro.dashboard');
  }

  public function dashboard_saldo_final_c6()
  {
    $entrada = Lancamento::
                          where('local', '=', 'C6')->
                          where('tipo', '=', 'Entrada')->
                          sum('valor');
 
    $saida = Lancamento::
                          where('local', '=', 'C6')->
                          where('tipo', '=', 'Saída')->
                          sum('valor');
 
    return $entrada - $saida;
  }

  public function dashboard_saldo_final_assas()
  {
    $entrada = Lancamento::
                          where('local', '=', 'ASSAS')->
                          where('tipo', '=', 'Entrada')->
                          sum('valor');
 
    $saida = Lancamento::
                          where('local', '=', 'ASSAS')->
                          where('tipo', '=', 'Saída')->
                          sum('valor');

    return $entrada - $saida;
  }

  public function dashboard_saldo_final_geral()
  {
    $entrada = Lancamento::
                          where('tipo', '=', 'Entrada')->
                          sum('valor');
 
    $saida = Lancamento::
                          where('tipo', '=', 'Saída')->
                          sum('valor');

    return $entrada - $saida;
  }

  // =====================================================================================================================================================================

  public function bancos()
  {
    return view('sistema.financeiro.bancos.index');
  }

  public function bancos_tabelar()
  {
    $bancos = Banco::withTrashed()->get();

    return view('sistema.financeiro.bancos.tabelar', [
      'bancos' => $bancos,
    ]);
  }

  public function bancos_mostrar($id)
  {
    $banco = Banco::find($id);

    return view('sistema.financeiro.bancos.mostrar', [
      'banco' => $banco,
    ]);
  }

  public function bancos_adicionar()
  {
    return view('sistema.financeiro.bancos.adicionar');
  }

  public function bancos_gravar(Request $request)
  {
    $banco = Banco::create($request->all());

    return view('sistema.financeiro.bancos.index');
  }

  public function bancos_editar($id)
  {
    $banco = Banco::find($id);

    return view('sistema.financeiro.bancos.editar', [
      'banco' => $banco,
    ]);
  }

  public function bancos_atualizar(Request $request, $id)
  {
    $banco     = Banco::find($id);
    $banco     = $banco->update($request[0]);
    $atualizado = Banco::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }

  public function bancos_excluir(Request $request, $id)
  {
    $banco = Banco::find($id);    
    $banco->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $banco->toArray(),
    ];

    return $response;
  }

  public function bancos_restaurar($id)
  {
    $banco = Banco::onlyTrashed()->find($id);
    $banco->restore();
      
    $response = [
        'type'    => 'success',
        'message' => "O banco '$banco->nome' foi restaurado com sucesso.",
        'data'    => $banco->toArray(),
    ];

    return $response;
  }

  public function bancos_extrato(Request $request, $id)
  {
    // $inicio = \Carbon\Carbon::today()->startOfMonth();
    $inicio = '2023-01-01 00:00:00';
    $final  = \Carbon\Carbon::today()->endOfMonth();
    
    $saldo_inicial = Banco::find($id)->saldo_inicial;

    $receitas = Lancamento::
                        where('id_banco', '=', $id)->
                        where('tipo', '=', 'R')->
                        where('status', '=', 'Confirmado')->
                        where('dt_recebimento', '<', $inicio)->
                        sum('vlr_final');
    
    $despesas = Lancamento::
                        where('id_banco', '=', $id)->
                        where('tipo', '=', 'D')->
                        where('status', '=', 'Confirmado')->
                        where('dt_recebimento', '<', $inicio)->
                        sum('vlr_final');
   
    $transferencias = Lancamento::
                        where('id_banco', '=', $id)->
                        where('tipo', '=', 'T')->
                        where('status', '=', 'Confirmado')->
                        where('dt_recebimento', '<', $inicio)->
                        sum('vlr_final');

    $recebimentoCartoes_receitas = RecebimentoCartao::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        where('dt_recebimento', '<', $inicio)->
                        // withTrashed()->
                        sum('vlr_final');
                        
    $contasAReceberAlunos_receitas = AReceber::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        where('dt_recebimento', '<', $inicio)->
                        // withTrashed()->
                        sum('vlr_final');

    $saldo_anterior = $saldo_inicial + $receitas - $despesas + $transferencias + $recebimentoCartoes_receitas + $contasAReceberAlunos_receitas;

    $lancamentos = Lancamento::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        whereBetween('dt_recebimento', [$inicio, $final])->
                        withTrashed()->
                        get();
                        
    $recebimentoCartoes = RecebimentoCartao::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        whereBetween('dt_recebimento', [$inicio, $final])->
                        withTrashed()->
                        get();
                        
    $contasAReceberAlunos = AReceber::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        whereBetween('dt_recebimento', [$inicio, $final])->
                        withTrashed()->
                        get();
                    
    return view('sistema.financeiro.bancos.auxiliares.inc_extrato_tabelar', [
      'saldo_anterior' => $saldo_anterior,
      'lancamentos'    => $lancamentos->merge($recebimentoCartoes)->merge($contasAReceberAlunos),
    ]);
  }

  public function bancos_plucar()
  {
    $bancos = Banco::pluck('nome', 'id');

    return $bancos;
  }

  // =====================================================================================================================================================================

  // =====================================================================================================================================================================

  public function comissoes()
  {
    return view('sistema.financeiro.comissoes.index');
  }

  public function comissoes_tabelar()
  {
    $comissoes = ContaInterna::whereHas('afjgmenkewjekff', function (Builder $query)
    {
      dd('s');
      $query->where('id_funcao', 'LIKE', '3');
    })->paginate();
    dd($comissoes);
    return view('sistema.financeiro.comissoes.tabelar', [
      'comissoes' => $comissoes,
    ]);
  }

  public function comissoes_abert_prof()
  {

    $colaboradores = Pessoa::
                            whereHas('wuclsoqsdppaxmf', function(Builder $query)
                            {
                              $query->
                              where('nome', '=', 'Colaborador')->
                              orWhere('nome', '=', 'Parceiro');
                            })->
                            with('opmnhtrvanmesd')->
                            orderBy('apelido', 'ASC')->
                            // whereHas('opmnhtrvanmesd', function(Builder $query)
                            // {
                            //   $query->
                            //   where('fonte_origem', '=', 'pdv_vendas_detalhes')->
                            //   where('status', '=', 'Em aberto');
                            // })->
                            get(['id', 'apelido']);

    return view('sistema.financeiro.comissoes.auxiliares.card_abert_prof', [
      'colaboradores' => $colaboradores,
    ]);
  }

  public function comissoes_fechd_prof()
  {
    $colaboradores = Pessoa::
                            whereHas('wuclsoqsdppaxmf', function(Builder $query)
                            {
                              $query->
                              where('nome', '=', 'Colaborador')->
                              orWhere('nome', '=', 'Parceiro');
                            })->
                            orderBy('apelido', 'ASC')->
                            get(['id', 'apelido']);

    return view('sistema.financeiro.comissoes.auxiliares.card_fechd_prof', [
      'colaboradores' => $colaboradores,
    ]);
  }
  
  public function comissoes_prof_abert($id)
  {
    $profissional = Pessoa::find($id);
    $comissoes    = ContaInterna::
                              // where('fonte_origem', '=', 'pdv_vendas_detalhes')->
                              where('status', '=', 'Em aberto')->
                              where('id_pessoa', '=', $id)->
                              get();

    return view('sistema.financeiro.comissoes.auxiliares.card_prof_abert', [
      'comissoes'    => $comissoes,
      'profissional' => $profissional,
    ]);
  }
  
  public function comissoes_prof_fechd($id)
  {
    $profissional = Pessoa::find($id);
    $comissoes    = ContaInterna::
                              // where('fonte_origem', '=', 'pdv_vendas_detalhes')->
                              where('status', '=', 'Pago')->
                              where('id_pessoa', '=', $id)->
                              get();

    return view('sistema.financeiro.comissoes.auxiliares.card_prof_fechd', [
      'comissoes'    => $comissoes,
      'profissional' => $profissional,
    ]);
  }

  public function comissoes_prof_quitada($quitacao)
  {
    $comissoes = ContaInterna::
                              where('status', '=', 'Pago')->
                              where('id_destino', '=', $quitacao)->
                              get();
    return view('sistema.financeiro.comissoes.auxiliares.card_prof_pagas', [
      'comissoes'    => $comissoes,
    ]);
  }

  public function comissoes_pagar(Request $request, $id)
  {
    $lancamento = new Lancamento;
    $lancamento->tipo                    = 'D';
    $lancamento->id_banco                = \Auth::User()->abcde->first()->id_banco ?? 1;
    $lancamento->id_conta                = null;
    $lancamento->num_documento           = null;
    $lancamento->id_cliente              = $id;
    $lancamento->informacao              = 'Pagamento de comissões de '.Pessoa::find($id)->apelido;
    $lancamento->vlr_bruto               = collect($request->all())->sum('valor');
    $lancamento->vlr_dsc_acr             = 0;
    $lancamento->vlr_final               = collect($request->all())->sum('valor');
    $lancamento->parcela                 = '01/01';
    $lancamento->id_forma_pagamento      = 1;
    $lancamento->descricao               = null;
    $lancamento->dt_vencimento           = \Carbon\Carbon::today();
    $lancamento->dt_recebimento          = \Carbon\Carbon::today();
    $lancamento->dt_confirmacao          = \Carbon\Carbon::today();
    $lancamento->id_usuario_lancamento   = \Auth::User()->id;
    $lancamento->id_usuario_confirmacao  = \Auth::User()->id;
    $lancamento->id_caixa                = \Auth::User()->abcde->first()->id ?? null;
    $lancamento->id_lancamento_origem    = null;
    $lancamento->origem                  = 'fin_conta_interna';
    $lancamento->status                  = 'Confirmado';
    $lancamento->save();

    foreach ($request->all() as $key => $comissao)
    {
      $comissoes = ContaInterna::find($comissao['id']);
      $comissoes->dt_quitacao   = \Carbon\Carbon::today();
      $comissoes->id_destino    = $lancamento->id;
      $comissoes->fonte_destino = 'fin_lancamentos';
      $comissoes->status        = 'Pago';
      $comissoes->update();
    }


    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Pagamento de comissões de '.Pessoa::find($id)->apelido.' realizado com sucesso.',
      'data'    => $lancamento->toArray(),
      'redirect' => route('fin.comissoes'),
    ];

    return $response;
  }

  public function comissoes_mostrar($id)
  {
    $comissao = Comissao::find($id);

    return view('sistema.financeiro.comissoes.mostrar', [
      'comissao' => $comissao,
    ]);
  }

  public function comissoes_adicionar()
  {
    return view('sistema.financeiro.comissoes.adicionar');
  }

  public function comissoes_gravar(Request $request)
  {
    $comissao = Comissao::create($request->all());

    return view('sistema.financeiro.comissoes.index');
  }

  public function comissoes_editar($id)
  {
    $comissao = Comissao::find($id);

    return view('sistema.financeiro.comissoes.editar', [
      'comissao' => $comissao,
    ]);
  }

  public function comissoes_atualizar(Request $request, $id)
  {
    $comissao     = Comissao::find($id);
    $comissao     = $comissao->update($request[0]);
    $atualizado = Comissao::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }

  public function comissoes_excluir(Request $request, $id)
  {
    $comissao = Comissao::find($id);    
    $comissao->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $comissao->toArray(),
    ];

    return $response;
  }

  public function comissoes_restaurar($id)
  {
    $comissao = Comissao::onlyTrashed()->find($id);
    $comissao->restore();
      
    $response = [
        'type'    => 'success',
        'message' => "O comissao '$comissao->nome' foi restaurado com sucesso.",
        'data'    => $comissao->toArray(),
    ];

    return $response;
  }

  public function comissoes_extrato(Request $request, $id)
  {
    $inicio = \Carbon\Carbon::today()->startOfMonth();
    $inicio = '2022-01-01 00:00:00';
    $final  = \Carbon\Carbon::today()->endOfMonth();
   
    $entrada = Lancamento::
                        where('tipo', '=', 'E')->
                        where('id_comissao', '=', $id)->
                        where('dt_pagamento', '<', $inicio)->
                        sum('vlr_final');
   
    $saidas = Lancamento::
                        where('tipo', '=', 'S')->
                        where('id_comissao', '=', $id)->
                        where('dt_pagamento', '<', $inicio)->
                        sum('vlr_final');
   
    $transferencias = Lancamento::
                        where('tipo', '=', 'T')->
                        where('id_comissao', '=', $id)->
                        where('dt_pagamento', '<', $inicio)->
                        sum('vlr_final');
    
    $saldo_anterior = $entrada - $saidas + $transferencias;

    $lancamentos = Lancamento::
                        where('id_comissao', '=', $id)->
                        whereBetween('dt_pagamento', [$inicio, $final])->
                        withTrashed()->
                        orderBy('dt_pagamento', 'ASC')->
                        get();

    return view('sistema.financeiro.comissoes.auxiliares.inc_extrato_tabelar', [
      'lancamentos'    => $lancamentos,
      'saldo_anterior' => $saldo_anterior,
    ]);
  }

  public function comissoes_plucar()
  {
    $comissoes = Comissao::pluck('nome', 'id');

    return $comissoes;
  }

  // =====================================================================================================================================================================


  public function lancamentos()
  {
    return view('sistema.financeiro.lancamentos.index');
  }

  public function lancamentos_tabelar_confirmados()
  {
    $lancamentos = Lancamento::
                      where('id_caixa', '=', \Auth::User()->abcde->first()->id ?? null )->
                      where('status', '=', 'Confirmado' )->
                      // where('id_banco', '=', \Auth::User()->abcde->first()->id_banco )->
                      paginate();

    return $lancamentos;
  }

  public function lancamentos_tabelar_nao_confirmados()
  {
    $lancamentos = Lancamento::
                      where('id_caixa', '=', null )->
                      where('status', '!=', 'Confirmado' )->
                      paginate();

    return $lancamentos;
  }
  
  public function lancamentos_tabelar(Request $request)
  {
    $lancamentos = Lancamento::
                where( function ($query) use ($request)
                {
                  if ( isset( $request->pesquisa ) )
                  {
                    $query->
                    where('informacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                    orwhere('descricao', 'LIKE', '%'.$request->pesquisa.'%' );
                  }
                })->
                where( function ($query) use ($request)
                {
                  // if ( isset( $request->id_banco ) )
                  // {
                  //    $query->where('id_banco', 'LIKE', '%'.$request->id_banco.'%' )->orwhere('id_banco', 'LIKE', '%'.$request->id_banco.'%' );
                  // }
                  // if ( isset( $request->id_cliente ) )
                  // {
                  //    dd($request->id_cliente);
                  //    $query->where('id_cliente', 'LIKE', '%'.$request->id_cliente.'%' )->orwhere('id_cliente', 'LIKE', '%'.$request->id_cliente.'%' );
                  // }
                  // if ( isset( $request->nome ) )
                  // {
                  //    $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orwhere('nome', 'LIKE', '%'.$request->nome.'%' );
                  // }
                  // if ( isset( $request->sexo ) )
                  // {
                  //    if ($request->sexo == "Não Informado")
                  //    {
                  //       $query->where('sexo', '=', null );
                  //    }
                  //    else
                  //    {
                  //       $query->where('sexo', 'LIKE', '%'.$request->sexo.'%' );
                  //    }
                  // }
                  // if ( isset( $request->dt_nascimento ) )
                  // {
                  //    $query->where('dt_nascimento', 'LIKE', '%'.$request->dt_nascimento.'%' );
                  // }
                  if ( isset( $request->id_banco ) )
                  {
                    $query->where('id_banco', '=', $request->id_banco );
                  }
                  if ( isset( $request->id_cliente ) )
                  {
                    $query->where('id_cliente', '=', $request->id_cliente );
                  }
                  if ( isset( $request->id_caixa ) )
                  {
                    $query->where('id_caixa', '=', $request->id_caixa );
                  }
                  if ( isset( $request->status ) )
                  {
                    $query->where('status', '=', $request->status );
                  }
                  // if ( isset( $request->deleted_at ) )
                  // {
                  //    $query->whereNotNull('deleted_at');
                  // }
                })->
                // where([
                  //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
                  //   // ['nome'          , 'LIKE', '%'.$request->nome.'%'],
                  //   // ['sexo'          , 'LIKE', '%'.$request->sexo.'%'],
                  //   // ['dt_nascimento' , 'LIKE', '%'.$request->dt_nascimento.'%'],
                  //   // ['cpf'           , 'LIKE', '%'.$request->cpf.'%'],
                  //   // ['observacao'    , 'LIKE', '%'.$request->observacao.'%'],
                  //   // ['email'         , 'LIKE', '%'.$request->email.'%'],
                  //   // ['facebook'      , 'LIKE', '%'.$request->facebook.'%'],
                  //   // ['instagram'     , 'LIKE', '%'.$request->instagram.'%'],
                  //   // ['id_criador'    , 'LIKE', '%'.$request->id_criador.'%']
                  // ])->
                  // orwhere([
                    //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
                    //   // ['nome'          , 'LIKE', '%'.$request->nome.'%'],
                    //   // ['sexo'          , 'LIKE', '%'.$request->sexo.'%'],
                    //   // ['dt_nascimento' , 'LIKE', '%'.$request->dt_nascimento.'%'],
                    //   ['cpf'           , '=', NULL ],
                    //   // ['observacao'    , 'LIKE', '%'.$request->observacao.'%'],
                    //   // ['email'         , 'LIKE', '%'.$request->email.'%'],
                    //   // ['facebook'      , 'LIKE', '%'.$request->facebook.'%'],
                    //   // ['instagram'     , 'LIKE', '%'.$request->instagram.'%'],
                    //   // ['id_criador'    , 'LIKE', '%'.$request->id_criador.'%']
                    // ])->
                    // orderByRaw('-deleted_at DESC')->
                orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                orderBy(\DB::raw('ISNULL(dt_pagamento)'), 'DESC')->
                // orderBy(\DB::raw('ISNULL(dt_vencimento)'), 'DESC')->
                // orderBy(\DB::raw('dt_pagamento'), 'DESC')->
                orderBy($request->ordenar_por ?? 'dt_pagamento', $request->ordem ?? 'DESC')->
                orderBy(\DB::raw('dt_vencimento'), 'DESC')->
                // orderBy('dt_vencimento', 'DESC')->
                // orderBy('dt_vencimento')->
                // orderBy('dt_pagamento', 'DESC')->
                withTrashed()->
                paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                appends($request->all());
    
    return view('sistema.financeiro.lancamentos.tabelar', [
      'lancamentos' => $lancamentos,
    ]);
  }

  public function lancamentos_mostrar($id)
  {
    $empresa = Empresa::first();

    $lancamento = Lancamento::find($id);

    return view('sistema.financeiro.lancamentos.mostrar', [
      'dado' => $lancamento,
      'empresa' => $empresa,
    ]);
  }

  public function lancamentos_mostrar_modal($id)
  {
    $lancamento = Lancamento::find($id);

    return $lancamento;
  }

  public function lancamentos_confirmar(Request $request, $id)
  {
    $lancamento = Lancamento::find($id);
    $confirmado = $lancamento->update($request->confirmar);

    if (isset($request->extras['vlr_taxa_boleto']))
    {
      $nova_taxa_boleto = new Lancamento;
      $nova_taxa_boleto->id_banco              = $request->confirmar['id_banco'];
      $nova_taxa_boleto->tipo                  = 'S';
      $nova_taxa_boleto->nome                  = $lancamento->nome;
      $nova_taxa_boleto->id_cliente            = $request->confirmar['id_cliente'];
      $nova_taxa_boleto->cpf                   = $lancamento->cpf;
      $nova_taxa_boleto->email                 = $lancamento->email;
      $nova_taxa_boleto->forma_pagamento       = $request->confirmar['forma_pagamento'];
      $nova_taxa_boleto->tipo_cobranca         = 'Taxa de Boleto';
      $nova_taxa_boleto->vlr_original          = $request->extras['vlr_taxa_boleto'];
      $nova_taxa_boleto->vlr_final              = $request->extras['vlr_taxa_boleto'];
      $nova_taxa_boleto->parcela               = \Carbon\Carbon::parse($lancamento->dt_vencimento)->month.'/12';
      $nova_taxa_boleto->descricao             = 'Taxa de Boleto - '.$lancamento->QEXGZMNNDQXMYKS->apelido;
      $nova_taxa_boleto->dt_vencimento         = $lancamento->dt_vencimento;
      $nova_taxa_boleto->dt_pagamento          = $request->confirmar['dt_pagamento'];
      $nova_taxa_boleto->dt_confirmacao        = $request->confirmar['dt_confirmacao'];
      $nova_taxa_boleto->status                = 'Confirmado';
      $nova_taxa_boleto->id_criador            = $request->confirmar['id_criador'];
      $nova_taxa_boleto->save();
    }

    if (isset($request->extras['vlr_taxa_mensagem']))
    {
      $nova_taxa_mensagem = new Lancamento;
      $nova_taxa_mensagem->id_banco              = $request->confirmar['id_banco'];
      $nova_taxa_mensagem->tipo                  = 'S';
      $nova_taxa_mensagem->nome                  = $lancamento->nome;
      $nova_taxa_mensagem->id_cliente            = $request->confirmar['id_cliente'];
      $nova_taxa_mensagem->cpf                   = $lancamento->cpf;
      $nova_taxa_mensagem->email                 = $lancamento->email;
      $nova_taxa_mensagem->forma_pagamento       = $request->confirmar['forma_pagamento'];
      $nova_taxa_mensagem->tipo_cobranca         = 'Taxa Mensageira';
      $nova_taxa_mensagem->vlr_original          = $request->extras['vlr_taxa_mensagem'];
      $nova_taxa_mensagem->vlr_final              = $request->extras['vlr_taxa_mensagem'];
      $nova_taxa_mensagem->parcela               = \Carbon\Carbon::parse($lancamento->dt_vencimento)->month.'/12';
      $nova_taxa_mensagem->descricao             = 'Taxa Mensageira - '.$lancamento->QEXGZMNNDQXMYKS->apelido;
      $nova_taxa_mensagem->dt_vencimento         = $lancamento->dt_vencimento;
      $nova_taxa_mensagem->dt_pagamento          = $request->confirmar['dt_pagamento'];
      $nova_taxa_mensagem->dt_confirmacao        = $request->confirmar['dt_confirmacao'];
      $nova_taxa_mensagem->status                = 'Confirmado';
      $nova_taxa_mensagem->id_criador            = $request->confirmar['id_criador'];
      $nova_taxa_mensagem->save();
    }

    if (isset($request->extras['vlr_taxa_nf']))
    {
      $nova_taxa_nf = new Lancamento;
      $nova_taxa_nf->id_banco              = $request->confirmar['id_banco'];
      $nova_taxa_nf->tipo                  = 'S';
      $nova_taxa_nf->nome                  = $lancamento->nome;
      $nova_taxa_nf->id_cliente            = $request->confirmar['id_cliente'];
      $nova_taxa_nf->cpf                   = $lancamento->cpf;
      $nova_taxa_nf->email                 = $lancamento->email;
      $nova_taxa_nf->forma_pagamento       = $request->confirmar['forma_pagamento'];
      $nova_taxa_nf->tipo_cobranca         = 'Taxa de Nota Fiscal';
      $nova_taxa_nf->vlr_original          = $request->extras['vlr_taxa_nf'];
      $nova_taxa_nf->vlr_final              = $request->extras['vlr_taxa_nf'];
      $nova_taxa_nf->parcela               = \Carbon\Carbon::parse($lancamento->dt_vencimento)->month.'/12';
      $nova_taxa_nf->descricao             = 'Taxa de Nota Fiscal - '.$lancamento->QEXGZMNNDQXMYKS->apelido;
      $nova_taxa_nf->dt_vencimento         = $lancamento->dt_vencimento;
      $nova_taxa_nf->dt_pagamento          = $request->confirmar['dt_pagamento'];
      $nova_taxa_nf->dt_confirmacao        = $request->confirmar['dt_confirmacao'];
      $nova_taxa_nf->status                = 'Confirmado';
      $nova_taxa_nf->id_criador            = $request->confirmar['id_criador'];
      $nova_taxa_nf->save();
    }

    return $lancamento;
  }

  public function lancamentos_transferencia(Request $request)
  {
    $transf_origem = new Lancamento;
    $transf_origem->id_banco              = $request->transf_O['id_banco'];
    $transf_origem->tipo                  = 'T';
    $transf_origem->nome                  = 'Nautica Digital';
    $transf_origem->id_cliente            = 1;
    $transf_origem->cpf                   = null;
    $transf_origem->email                 = null;
    $transf_origem->forma_pagamento       = null;
    $transf_origem->tipo_cobranca         = null;
    $transf_origem->vlr_original          = $request->transf_O['vlr_original'];
    $transf_origem->vlr_final              = $request->transf_O['vlr_original'];
    $transf_origem->parcela               = '01/01';
    $transf_origem->descricao             = 'Transferência '.$request->transf_O['id_banco'].' > '.$request->transf_D['id_banco'];
    $transf_origem->dt_vencimento         = \Carbon\Carbon::now();
    $transf_origem->dt_pagamento          = \Carbon\Carbon::now();
    $transf_origem->dt_confirmacao        = \Carbon\Carbon::now();
    $transf_origem->status                = 'Confirmado';
    $transf_origem->id_criador            = \Auth::User()->id;
    $transf_origem->save();

    $transf_destino = new Lancamento;
    $transf_destino->id_banco             = $request->transf_D['id_banco'];
    $transf_destino->tipo                 = 'T';
    $transf_destino->nome                 = 'Nautica Digital';
    $transf_destino->id_cliente           = 1;
    $transf_destino->cpf                  = null;
    $transf_destino->email                = null;
    $transf_destino->forma_pagamento      = null;
    $transf_destino->tipo_cobranca        = null;
    $transf_destino->vlr_original         = $request->transf_O['vlr_original'];
    $transf_destino->vlr_final             = $request->transf_O['vlr_original'];
    $transf_destino->parcela              = '01/01';
    $transf_destino->descricao            = 'Transferência '.$request->transf_O['id_banco'].' > '.$request->transf_D['id_banco'];
    $transf_destino->dt_vencimento        = \Carbon\Carbon::now();
    $transf_destino->dt_pagamento         = \Carbon\Carbon::now();
    $transf_destino->dt_confirmacao       = \Carbon\Carbon::now();
    $transf_destino->status               = 'Confirmado';
    $transf_destino->id_criador           = \Auth::User()->id;
    $transf_destino->save();

    return true;
  }

  public function lancamentos_entrada(Request $request)
  {
    $entrada = new Lancamento;
    $entrada->id_banco              = $request->entrada['id_banco'];
    $entrada->tipo                  = 'E';
    $entrada->nome                  = $request->entrada['cliente'];
    $entrada->id_cliente            = 0;
    $entrada->cpf                   = null;
    $entrada->email                 = null;
    $entrada->forma_pagamento       = $request->entrada['forma_pagamento'];
    $entrada->tipo_cobranca         = $request->entrada['categoria'];
    $entrada->vlr_original          = $request->entrada['vlr_final'];
    $entrada->vlr_final              = $request->entrada['vlr_final'];
    $entrada->parcela               = '01/01';
    $entrada->descricao             = $request->entrada['descricao'];
    $entrada->dt_vencimento         = \Carbon\Carbon::now();
    $entrada->dt_pagamento          = \Carbon\Carbon::now();
    $entrada->dt_confirmacao        = \Carbon\Carbon::now();
    $entrada->status                = 'Confirmado';
    $entrada->id_criador            = \Auth::User()->id;
    $entrada->save();

    return true;

  }

  public function lancamentos_saida(Request $request)
  {
    $saida = new Lancamento;
    $saida->id_banco              = $request->saida['id_banco'];
    $saida->tipo                  = 'D';
    $saida->nome                  = $request->saida['cliente'];
    $saida->id_cliente            = 0;
    $saida->cpf                   = null;
    $saida->email                 = null;
    $saida->forma_pagamento       = $request->saida['forma_pagamento'];
    $saida->tipo_cobranca         = $request->saida['categoria'];
    $saida->vlr_original          = $request->saida['vlr_final'];
    $saida->vlr_final              = $request->saida['vlr_final'];
    $saida->parcela               = '01/01';
    $saida->descricao             = $request->saida['descricao'];
    $saida->dt_vencimento         = \Carbon\Carbon::now();
    $saida->dt_pagamento          = \Carbon\Carbon::now();
    $saida->dt_confirmacao        = \Carbon\Carbon::now();
    $saida->status                = 'Confirmado';
    $saida->id_criador            = \Auth::User()->id;
    $saida->save();

    return true;
  }

  public function lancamentos_adicionar($d)
  {
    switch ($d)
    {
      case 'transferencia':
        return view('sistema.financeiro.lancamentos.modais_adicionar.mod_transferencias', [
          'bancos' => Banco::pluck('nome', 'id'),
        ]);
        break;

      case 'desp_indicou_ganhou':
        return view('sistema.financeiro.lancamentos.modais_adicionar.mod_desp_indicou_ganhou', [
          'pessoas' => Pessoa::orderBy('nome', 'asc')->pluck('nome', 'id'),
        ]);
        break;

      case 'desp_adiantamento':

        $pessoas = Pessoa::whereHas('lcldxgfwmrzybmm', function (Builder $query) {
                      $query->where('nome', 'LIKE', 'Colaborador');
                    })->
                    orderBy('nome', 'asc')->
                    pluck('nome', 'id');

        return view('sistema.financeiro.lancamentos.modais_adicionar.mod_desp_adiantamento', [
          'pessoas' => $pessoas,
        ]);
        break;

      case 'despesa_geral':
        return view('sistema.financeiro.lancamentos.modais_adicionar.mod_despesa_geral', [
          'pessoas' => Pessoa::orderBy('nome', 'asc')->pluck('nome', 'id'),
        ]);
        break;
        
      case 'receita_geral':
        return view('sistema.financeiro.lancamentos.modais_adicionar.mod_receita_geral', [
          'pessoas' => Pessoa::orderBy('nome', 'asc')->pluck('nome', 'id'),
        ]);
        break;
      
      default:
        # code...
        break;
    }
  }

  public function lancamentos_gravar(Request $request)
  {
    switch ($request->tipo)
    {
      case 'transferencia':
        $response = $this->lancar_transferencia($request->all());
        break;
        
      case 'desp_indicou_ganhou':
        $response = $this->lancar_despesa($request->all());
        break;
        
      case 'desp_adiantamento':
        $response = $this->lancar_vale($request->all());
        break;
      
      case 'despesa_geral':
        $response = $this->lancar_despesa($request->all());
        break;
      
      case 'receita_geral':
        $response = $this->lancar_despesa($request->all());
        break;
      
      
        
        default:
        $response = 1;
        # code...
        break;
    }

    return $response;

    // if(sizeof($request->fin_lancamento_detalhe) > 0)
    // {
    //   foreach ($request->fin_lancamento_detalhe as $key => $value)
    //   {
    //     $lancamento_detalhe = $lancamento->FinanceiroLancamentosDetalhesProdutos()->create($value);
    //   }
    // }

    // $response = [
    //   'type'     => 'success',
    //   'message'  => "A Lancamento '$lancamento->id' foi aberto com sucesso.",
    //   'data'     => $lancamento,
    // ];

    // return $response;

    // $lancamento = Lancamento::create($request->all());

    // return view('sistema.financeiro.lancamentos.index');
  }

  public function lancamentos_editar($id)
  {
    $lancamento = Lancamento::find($id);

    return view('sistema.financeiro.lancamentos.editar', [
      'lancamento' => $lancamento,
    ]);
  }

  public function lancamentos_atualizar(Request $request, $id)
  {
    $lancamento     = Lancamento::find($id);
    $lancamento     = $lancamento->update($request[0]);
    $atualizado = Lancamento::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }

  public function lancamentos_excluir(Request $request, $id)
  {
    $lancamento = Lancamento::find($id);    
    $lancamento->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $lancamento->toArray(),
    ];

    return $response;
  }

  public function lancamentos_restaurar($id)
  {
    $lancamento = Lancamento::onlyTrashed()->find($id);
    $lancamento->restore();
      
    $response = [
        'type'    => 'success',
        'message' => "O lancamento '$lancamento->nome' foi restaurado com sucesso.",
        'data'    => $lancamento->toArray(),
    ];

    return $response;
  }

  public function lancamentos_mensalidades($id)
  {
    $mensalidades = Lancamento::
                            select('vlr_final', 'dt_vencimento', 'dt_pagamento', 'status')->
                            where('id_cliente', '=', 11)->
                            where('tipo_cobranca', '=', 'Parcela')->
                            get();
    return $mensalidades;
  }

  public function lancamentos_despesas_mes()
  {
    $start = \Carbon\Carbon::today()->startOfMonth();
    $end   = \Carbon\Carbon::today()->endOfMonth();
    
    $despesas_mes = Lancamento::
                            whereBetween('dt_pagamento', [$start, $end])->
                            where('tipo', '=', 'D')->
                            sum('vlr_final');

    return $despesas_mes;
  }

  // =====================================================================================================================================================================

  // FUNÇÕES "PROGRAMADAS"

  public function gerar_lancamentos_parcelas()
  {
    $clientes = Pessoa::
                      whereHas('lcldxgfwmrzybmm', function (Builder $query)
                      {
                        $query->where('nome', '=', 'Clientes');
                      })->
                      get();

    foreach ($clientes as $cliente)
    {
      $lancamento = Lancamento::
                              where('id_cliente', '=', $cliente->id)->
                              where('tipo_cobranca', '=', 'Parcela')->
                              whereYear('dt_vencimento', '=', \Carbon\Carbon::today()->format('Y'))->
                              whereMonth('dt_vencimento', '=', \Carbon\Carbon::today()->format('m'))->
                              first();

      if( !isset($lancamento) )
      {
        $novo_lancamento = new Lancamento;
        $novo_lancamento->id_banco              = null;
        $novo_lancamento->tipo                  = 'E';
        $novo_lancamento->nome                  = $cliente->nome;
        $novo_lancamento->id_cliente            = $cliente->id;
        $novo_lancamento->cpf                   = $cliente->cpf;
        $novo_lancamento->email                 = $cliente->email;
        $novo_lancamento->forma_pagamento       = null;
        $novo_lancamento->tipo_cobranca         = 'Parcela';
        $novo_lancamento->vlr_original          = $cliente->valor_mensal;
        $novo_lancamento->vlr_final              = $cliente->valor_mensal;
        $novo_lancamento->parcela               = \Carbon\Carbon::now()->month.'/12';
        $novo_lancamento->descricao             = 'Parcela - '.$cliente->apelido;
        $novo_lancamento->dt_vencimento         = \Carbon\Carbon::now()->day($cliente->dia_pagamento);
        $novo_lancamento->dt_pagamento          = null;
        $novo_lancamento->dt_confirmacao        = null;
        $novo_lancamento->status                = 'Aguardando';
        $novo_lancamento->id_criador            = 1;
        $novo_lancamento->save();
      }
    }
  }



  // =====================================================================================================================================================================












































  public function contratos()
  {
    $ano = 2021;
    $ano = 2022;

    $dados = Lancamento::
                                    whereHas('QEXGZMNNDQXMYKS.lcldxgfwmrzybmm', function (Builder $query)
                                    {
                                      $query->where('nome', 'like', 'Clientes');
                                    })->
                                    with('QEXGZMNNDQXMYKS.lcldxgfwmrzybmm')->
                                    Where('tipo', '=', 'E')->
                                    Where('tipo_cobranca', '=', 'Parcela')->
                                    WhereYear('dt_vencimento', $ano)->
                                    orderBy('id_cliente', 'asc')->
                                    get(['id_cliente', 'vlr_final', 'dt_vencimento', 'status'])->
                                    groupBy('id_cliente')->
                                    transform(function($item, $k)
                                    {
                                      return $item->groupBy(function($item)
                                      {
                                        return \Carbon\Carbon::parse($item->dt_vencimento)->format('m');
                                      });
                                    });

    $totais = Lancamento::
                                    whereHas('QEXGZMNNDQXMYKS.lcldxgfwmrzybmm', function (Builder $query)
                                    {
                                      $query->where('nome', 'like', 'Clientes');
                                    })->
                                    Where('tipo', '=', 'E')->
                                    Where('tipo_cobranca', '=', 'Parcela')->
                                    WhereYear('dt_vencimento', $ano)->
                                    get(['id_cliente', 'vlr_final', 'dt_vencimento', 'status'])->
                                    groupBy(function($item)
                                    {
                                      return \Carbon\Carbon::parse($item->dt_vencimento)->format('m');
                                    });

    return view('sistema.financeiro.contratos.index', [
      'dados'  => $dados,
      'totais' => $totais,
    ]);
  }








  public function index()
  {
    $dividas = Divida::orderBy('id', 'desc')->get();
    
    return view('sistema.financeiro.dividas.index', [
      'dividas' => $dividas,
    ]);
  }

  public function create(Request $request)
  {
    return view('sistema.financeiro.dividas.create');
  }

  public function store(Request $request)
  {
    $divida = Divida::create($request->all());

    return redirect()->route('dividas.index');
  }

  public function show($id)
  {
    $divida = Divida::find($id);

    return view('sistema.financeiro.dividas.show', [
      'divida' => $divida,
    ]);
  }

  public function edit($id)
  {
    $divida = Divida::find($id);

    return view('sistema.financeiro.dividas.edit', [
      'divida' => $divida,
    ]);
  }

  public function update(Request $request, $id)
  {
    $divida = Divida::find($id)->update($request->all());

    return redirect()->route('dividas.index');
  }

  public function destroy($id)
  {
    $divida = Divida::find($id)->delete();

    return redirect()->route('dividas.index');
  }





  public function EntradasSaidasSimples()
  {
    $lancamentos = Lancamento::orderBy('id', 'desc')->paginate();
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


  public function procurar($id)
  {
    $lancamento = Lancamento::with('FinanceiroLancamentosDetalhesProdutos')->find($id);

    return $lancamento;
  }





  public function rec_cartoes()
  {
    return view('sistema.financeiro.recebimentocartao.index');
  }

  public function rec_cartoes_tabelar(Request $request)
  {
    $rec_cartoes = RecebimentoCartao::
                          whereDate('dt_prevista', '=', $request->dt_consulta ?? \Carbon\Carbon::today())->
                          where('status', '=', 'Em Aberto')->
                          orderBy('dt_prevista', 'desc')->
                          get();

    return view('sistema.financeiro.recebimentocartao.tabelar', [
      'rec_cartoes' => $rec_cartoes,
    ]);
  }

  // public function rec_cartoes_mostrar($id)
  // public function rec_cartoes_adicionar()
  // public function rec_cartoes_gravar(Request $request, $id)
  public function rec_cartoes_editar($id)
  {
    $recebimento     = RecebimentoCartao::find($id);
    $forma_pagamento = Forma_Pagamento::get();

    return view('sistema.financeiro.recebimentocartao.editar', [
      'recebimento'     => $recebimento,
      'forma_pagamento' => $forma_pagamento,
    ]);

  }

  public function rec_cartoes_atualizar(Request $request, $id)
  {
    $recebimento = RecebimentoCartao::find($id);
    $recebimento = $recebimento->update($request->all());
    $atualizado  = RecebimentoCartao::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }
  // public function rec_cartoes_excluir(Request $request, $id)
  // public function rec_cartoes_remover(Request $request, $id)
  // public function rec_cartoes_restaurar($id)
  

  public function rec_cartoes_widgets(Request $request)
  {
    if( isset( $request->start) )
    {
      $start = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start )->startOfDay();
    }
    else
    {
      $start = \Carbon\Carbon::today()->subDays(1);
    }
    
    $end   = \Carbon\Carbon::today()->addDays(6);  

    $recebimentos_cartoes = RecebimentoCartao::
                                    join('ger_formas_pagamentos', 'fin_recebimentos_cartoes.id_forma_pagamento', '=', 'ger_formas_pagamentos.id')->
                                    select('forma', 'dt_prevista', 'vlr_final', 'status', 'fin_recebimentos_cartoes.id')->
                                    // where('status', '=', 'Em Aberto')->
                                    whereBetween('dt_prevista', [$start, $end])->
                                    orderBy('dt_prevista')->
                                    get();

    $dia0_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(0)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia1_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(1)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia2_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(2)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia3_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(3)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia4_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(4)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia5_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(5)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia6_c = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(6)->format('Y-m-d'))->where('forma', '=', 'Cartão de Crédito')->sum('vlr_final');
    $dia0_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(0)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia1_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(1)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia2_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(2)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia3_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(3)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia4_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(4)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia5_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(5)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia6_d = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(6)->format('Y-m-d'))->where('forma', '=', 'Cartão de Débito')->sum('vlr_final');
    $dia0_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(0)->format('Y-m-d'))->pluck('id');
    $dia1_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(1)->format('Y-m-d'))->pluck('id');
    $dia2_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(2)->format('Y-m-d'))->pluck('id');
    $dia3_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(3)->format('Y-m-d'))->pluck('id');
    $dia4_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(4)->format('Y-m-d'))->pluck('id');
    $dia5_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(5)->format('Y-m-d'))->pluck('id');
    $dia6_t = $recebimentos_cartoes->where('dt_prevista', '=', \Carbon\Carbon::parse($start)->addDays(6)->format('Y-m-d'))->pluck('id');
    
    return [
      'recebimentos_cartoes' => $recebimentos_cartoes,
      'labels' => [
        \Carbon\Carbon::parse($start)->addDays(0),
        \Carbon\Carbon::parse($start)->addDays(1),
        \Carbon\Carbon::parse($start)->addDays(2),
        \Carbon\Carbon::parse($start)->addDays(3),
        \Carbon\Carbon::parse($start)->addDays(4),
        \Carbon\Carbon::parse($start)->addDays(5),
        \Carbon\Carbon::parse($start)->addDays(6),
      ],
      'datasets'  => [
        [
          'label'            => 'Crédito',
          'dados'            => [ $dia0_c, $dia1_c, $dia2_c, $dia3_c, $dia4_c, $dia5_c,  $dia6_c ],
          'backgroundColor'  => 'rgb(220, 20, 60, 90)',
        ],
        [
          'label'            => 'Débito',
          'dados'            => [ $dia0_d, $dia1_d, $dia2_d, $dia3_d, $dia4_d, $dia5_d,  $dia6_d ],
          'backgroundColor'  => 'rgb(240, 128, 128, 90)',
        ],
      ],
    ];
  }

  public function rec_cartoes_confirmar(Request $request)
  {
    $recebimentos_cartoes = RecebimentoCartao::
                              // where('status', '=', 'Em Aberto')->
                              where('dt_prevista', \Carbon\Carbon::parse($request->dt_prevista)->format('Y-m-d'))->
                              orderBy('dt_prevista')->
                              get();
                              
    return view('widgets.recebimento_cartoes.mod_tabela',[
      'recebimentos_cartoes' => $recebimentos_cartoes,
    ]);
  }
  
  public function rec_cartoes_confirmar_sel(Request $request)
  {
    $recebimento = RecebimentoCartao::
                              whereIn('id', $request->selecionados)->
                              update([
                                'dt_recebimento' => $request->dt_recebimento,
                                'id_banco'       => $request->id_banco,
                                'status'         => 'Confirmado'
                              ]);
                            
    $response = [
      'type'    => 'success',
      'message' => $recebimento.' recebimento(s) de cartão(ões) foram confirmados com sucesso.',
    ];

    return $response;
  }

  public function recebimentoCartoes()
  {
    $from = \Carbon\Carbon::today()->subDays(3);
    $to   = \Carbon\Carbon::today()->addDays(3);
   
    $recebimentos = RecebimentoCartao::
                            whereBetween('dt_prevista', [$from, $to])->
                            select(\DB::raw('sum(vlr_real) as vlr_real, sum(vlr_real - vlr_final) as vlr_desc, sum(vlr_final) as vlr_receber, count(*) as qtd_recebimentos, dt_prevista, id_forma_pagamento'))->
                            groupBy('dt_prevista', 'id_forma_pagamento')->
                            where('status', '=', 'Em Aberto')->
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
    $banco     = Banco::find($request->identificador);
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
    return 1111;
    $colaboradores = Pessoa::whereHas('lcldxgfwmrzybmm', function (Builder $query) {
      $query->where('nome', 'LIKE', 'Colaborador');
    })->get();
    
    return view('sistema.financeiro.lancamentos.vale',[
      'colaboradores'      => $colaboradores,
    ]);
  }

  public function lancar_vale($request)
  {
    $fin_lancamento = collect($request[0], true);
    
    $conta_interna = new ContaInterna;
    $conta_interna->id_origem      = null;
    $conta_interna->fonte_origem   = 'fin_lancamentos';
    $conta_interna->id_pessoa      = $fin_lancamento['id_pessoa'] ?? '';
    $conta_interna->tipo           = $fin_lancamento['informacao'] ?? '';
    $conta_interna->percentual     = 1;
    $conta_interna->valor          = $fin_lancamento['vlr_final'] * -1 ?? '';
    $conta_interna->dt_prevista    = $fin_lancamento['dt_vencimento'] ?? '';
    $conta_interna->dt_quitacao    = null;
    $conta_interna->status         = 'Em aberto';
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

    return $response;
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

  public function lancar_transferencia($dados)
  {
    $dado_O = Lancamento::create($dados[0]);
    $dado_D = Lancamento::create($dados[1]);

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => $dado_O->informacao.', no valor de R$ '.$dado_D->vlr_final.' , realizado com sucesso.',
      'data'    => $dado_O->toArray(),
    ];

    return $response;
  }

  public function lancar_despesa($dados)
  {
    $dado = Lancamento::create($dados[0]);

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Despesa no valor de R$ '.$dado->vlr_final.', lançada com sucesso.',
      'data'    => $dado->toArray(),
    ];

    return $response;
  }
  // =====================================================================================================================================================================

  public function compras()
  {
    // dd('lancamnetos controller @ compras');

    // return view('sistema.financeiro.compras.index');

    // $compras = Compra::paginate();

    // return view('sistema.financeiro.compras.index', 
    // [
    //   'compras'    => $compras,
    // ]);
  }

  public function compras_tabelar()
  {
    $compras = Compra::withTrashed()->get();

    return view('sistema.financeiro.compras.tabelar', [
      'compras' => $compras,
    ]);
  }

  public function compras_mostrar($id)
  {
    $compra = Compra::find($id);

    return view('sistema.financeiro.compras.mostrar', [
      'compra' => $compra,
    ]);
  }

  public function compras_adicionar_produtos()
  {
    return view('sistema.financeiro.compras.adicionar_produtos');
  }

  public function compras_adicionar_fornecedor()
  {
    return view('sistema.financeiro.compras.adicionar_fornecedor');
  }

  public function compras_create1(Request $request)
  {
    if ( !empty( json_decode($request->cat_produtos) ) )
    {
      $qtd_prods = 0;
      $qtd_total = 0;
      $vlr_total = 0;

      foreach ( json_decode($request->cat_produtos, true) as $cat_produtos )
      {
        if ($cat_produtos['N_qtd'] > 0)
        {
          if ($cat_produtos['N_vlr_custo'] != '')
          {
            $valor_custo = $cat_produtos['N_vlr_custo'];
          }
          else
          {
            if ($cat_produtos['vlr_custo'] != '')
            {
              $valor_custo = $cat_produtos['vlr_custo'];
            }
            else
            {
              $valor_custo = 0;
            }
          }
        }

        if ($cat_produtos['N_qtd'] > 0)
        {
          $qtd_prods = $qtd_prods + 1;
          $qtd_total = $qtd_total + $cat_produtos['N_qtd'];
          $vlr_total = $vlr_total + ( floatval($valor_custo) * $cat_produtos['N_qtd'] );
        }
      }

      $compra = new Compra;
      $compra->tipo           = null;
      $compra->id_caixa       = null;
      $compra->id_usuario     = \Auth::User()->id;
      $compra->id_fornecedor  = null;
      $compra->qtd_produtos   = $qtd_total;
      $compra->vlr_prod_serv  = $vlr_total;
      $compra->vlr_negociados = $vlr_total;
      $compra->vlr_dsc_acr    = 0;
      $compra->vlr_final      = $vlr_total;
      $compra->statuS         = 'Passo 1';
      $compra->save();

      foreach ( json_decode($request->cat_produtos, true) as $cat_produtos )
      {
        if ($cat_produtos['N_qtd'] > 0)
        {
          if ($cat_produtos['N_vlr_custo'] != '')
          {
            $valor_custo = $cat_produtos['N_vlr_custo'];
          }
          else
          {
            if ($cat_produtos['vlr_custo'] != '')
            {
              $valor_custo = $cat_produtos['vlr_custo'];
            }
            else
            {
              $valor_custo = 0;
            }
          }

          $compra_detalhe = new CompraDetalhe;
          $compra_detalhe->id_compra     = $compra->id;
          $compra_detalhe->id_servprod    = $cat_produtos['id'];
          $compra_detalhe->qtd           = $cat_produtos['N_qtd'];
          $compra_detalhe->vlr_compra    = $valor_custo;
          $compra_detalhe->vlr_negociado = $valor_custo;
          $compra_detalhe->vlr_dsc_acr   = 0;
          $compra_detalhe->vlr_final     = $valor_custo;
          $compra_detalhe->status        = 'Aguardando';
          $compra_detalhe->save();
        }
      }
    }

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Produtos adicionado a compra com sucesso. Status: Aguardando.',
      // 'data'    => $compra->toArray(),
      'redirect' => route('fin.compras.adicionar-fornecedor'),
    ];

    return $response;
  }

  public function compras_create2(Request $request)
  {
    $dados_compra   = $request->dados_compra;
    $dados_produtos = json_decode($request->dados_produtos, true);
    $dados_parcelas = $request->dados_parcelas;

    $registrar_compra = $this->registrar_compra($dados_compra);
    $registrar_compra_detalhe = $this->registrar_compra_detalhe($dados_produtos, $registrar_compra);
    $registrar_compra_pagamentos = $this->registrar_compra_pagamentos($dados_parcelas, $registrar_compra);

    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Compra '.$registrar_compra->id.', no valor de R$ '.$registrar_compra->vlr_final.' , realizado com sucesso.',
      'data'    => $registrar_compra->toArray(),
      'redirect' => route('fin.compras'),
    ];

    return $response;
  }

  public function registrar_compra($compra)
  {
    $total_custo_compra = str_replace(",", ".", str_replace(".", "", $compra['total_custo_compra']));
    $vlr_total_compra   = str_replace(",", ".", str_replace(".", "", $compra['vlr_total_compra']));
    $id_fornecedor      = intval($compra['id_fornecedor']);
    $total_qtd_compra   = intval($compra['total_qtd_compra']);

    $compra = new Compra;
    $compra->tipo           = null;
    $compra->id_caixa       = null;
    $compra->id_usuario     = \Auth::User()->id;
    $compra->id_fornecedor  = $id_fornecedor;
    $compra->qtd_produtos   = $total_qtd_compra;
    $compra->vlr_prod_serv  = $total_custo_compra;
    $compra->vlr_negociados = $total_custo_compra;
    $compra->vlr_dsc_acr    = 0;
    $compra->vlr_final      = $vlr_total_compra;
    $compra->status         = 'Passo 1';
    $compra->save();

    return $compra;
  }

  public function registrar_compra_detalhe($compra_detalhe, $registrar_compra)
  {
    foreach ( $compra_detalhe as $cat_produtos )
    {
      if ($cat_produtos['N_qtd'] > 0)
      {
        if ($cat_produtos['N_vlr_custo'] != '')
        {
          $valor_custo = $cat_produtos['N_vlr_custo'];
        }
        else
        {
          if ($cat_produtos['vlr_custo'] != '')
          {
            $valor_custo = $cat_produtos['vlr_custo'];
          }
          else
          {
            $valor_custo = 0;
          }
        }

        $compra_detalhe = new CompraDetalhe;
        $compra_detalhe->id_compra     = $registrar_compra->id;
        $compra_detalhe->id_servprod    = $cat_produtos['id'];
        $compra_detalhe->qtd           = $cat_produtos['N_qtd'];
        $compra_detalhe->vlr_compra    = $valor_custo;
        $compra_detalhe->vlr_negociado = $valor_custo;
        $compra_detalhe->vlr_dsc_acr   = 0;
        $compra_detalhe->vlr_final     = $valor_custo;
        $compra_detalhe->status        = 'Aguardando';
        $compra_detalhe->save();
      }
    }

    return true;
  }

  public function registrar_compra_pagamentos($compra_pagamentos, $registrar_compra)
  {
    foreach ( $compra_pagamentos as $parcela )
    {
      $preco = str_replace(",", ".", str_replace(".", "", $parcela['p_vlr_liq']));

      $compra_detalhe = new CompraPagamento;
      $compra_detalhe->id_compra          = $registrar_compra->id;
      $compra_detalhe->id_forma_pagamento = $parcela['p_form_rbto'];
      $compra_detalhe->descricao          = $parcela['tipo'];
      $compra_detalhe->parcela            = $parcela['parcela'];
      $compra_detalhe->valor              = $preco;
      $compra_detalhe->status             = 'Aguardando';
      $compra_detalhe->dt_prevista        = $parcela['dt_vencimento'];
      $compra_detalhe->save();
    }

    return true;
  }

  public function compras_gravar(Request $request)
  {
    $compra = Compra::create($request->all());

    return view('sistema.financeiro.compras.index');
  }

  public function compras_editar($id)
  {
    $compra = Compra::find($id);

    return view('sistema.financeiro.compras.editar', [
      'compra' => $compra,
    ]);
  }

  public function compras_atualizar(Request $request, $id)
  {
    $compra     = Compra::find($id);
    $compra     = $compra->update($request[0]);
    $atualizado = Compra::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }

  public function compras_excluir(Request $request, $id)
  {
    $compra = Compra::find($id);    
    $compra->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $compra->toArray(),
    ];

    return $response;
  }

  public function compras_restaurar($id)
  {
    $compra = Compra::onlyTrashed()->find($id);
    $compra->restore();
      
    $response = [
        'type'    => 'success',
        'message' => "O compra '$compra->nome' foi restaurado com sucesso.",
        'data'    => $compra->toArray(),
    ];

    return $response;
  }

  public function compras_extrato(Request $request, $id)
  {
    $inicio = \Carbon\Carbon::today()->startOfMonth();
    $inicio = '2022-01-01 00:00:00';
    $final  = \Carbon\Carbon::today()->endOfMonth();
   
    $entrada = Lancamento::
                        where('tipo', '=', 'E')->
                        where('id_compra', '=', $id)->
                        where('dt_pagamento', '<', $inicio)->
                        sum('vlr_final');
   
    $saidas = Lancamento::
                        where('tipo', '=', 'S')->
                        where('id_compra', '=', $id)->
                        where('dt_pagamento', '<', $inicio)->
                        sum('vlr_final');
   
    $transferencias = Lancamento::
                        where('tipo', '=', 'T')->
                        where('id_compra', '=', $id)->
                        where('dt_pagamento', '<', $inicio)->
                        sum('vlr_final');
    
    $saldo_anterior = $entrada - $saidas + $transferencias;

    $lancamentos = Lancamento::
                        where('id_compra', '=', $id)->
                        whereBetween('dt_pagamento', [$inicio, $final])->
                        withTrashed()->
                        orderBy('dt_pagamento', 'ASC')->
                        get();

    return view('sistema.financeiro.compras.auxiliares.inc_extrato_tabelar', [
      'lancamentos'    => $lancamentos,
      'saldo_anterior' => $saldo_anterior,
    ]);
  }
  // =====================================================================================================================================================================

  public function comprasPorProduto($id)
  {
    $compras = CompraDetalhe::
    where('id_servprod', '=', $id)->
    with(['aldkekciajsgqwp' => function ($query)
    {
      $query->select('id', 'id_fornecedor')->with(['ysfyhzfsfarfdha']);
    }])->
    paginate(10);

    return $compras;
  }

// =================================================================================================================================================

  public function comissaoforasistema()
  {
    $url = ltrim( parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_PATH ) , '/' );

    $id = explode( '/' , $url );

    $aberto = ContaInterna::where('id_pessoa', $id[0])->where('status', 'Em aberto')->where('created_at','>=' ,'2020-09-01 00:00:00')->orderBy('dt_prevista', 'asc' )->get();

    return view('site.conferencia.tabela', [
      'aberto'    => $aberto,
    ]);
}

}
