<?php

namespace App\Http\Controllers\pdv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PDV\Caixa;
use App\Models\PDV\Venda;
use App\Models\Atendimento\Pessoa;
use App\Models\Configuracao\Tipo_de_Venda;
use App\Models\Financeiro\ContaInterna;
use App\Models\Gerenciamento\Empresa;
use App\Models\Financeiro\RecebimentoCartao;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Venda\Equipe;  //avaliar necesidade
use App\Models\Cadastro\ServicoProduto;  //avaliar necesidade

class VendasController extends Controller
{
  public function vendas()
  {
    return view('sistema.pdv.vendas.index');
  }

  public function vendas_tabelar(Request $request)
  {
    $vendas = Venda::
                      orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                      orderBy('id', 'DESC')->
                      paginate(50)->
                      appends($request->all());

    return view('sistema.pdv.vendas.tabelar', [
      'vendas' => $vendas,
    ]);
  }

  public function vendas_mostrar($id)
  {
    $venda = Venda::find($id);
    $tipos  = Tipo_de_Venda::get();

    return view('sistema.pdv.vendas.mostrar', [
      'venda' => $venda,
      'tipos'  => $tipos,
    ]);
  }

  public function vendas_adicionar()
  {
    $clientes = Pessoa::
                        orderBy('apelido')->
                        get();
                        
                        
    // $caixa             = $this->temCaixa();
    
    // $produtos_servicos = ServicoProduto::orderBy('nome', 'ASC')->get()->groupby('ecgklyqfdcoguyj.nome');
    // $venda             = Venda::find($request->id ?? null);
    // $profissionais = Pessoa::whereHas('aistggwbdgrrher', function ($q) {
    //                     $q->where('nome', '=', 'Colaborador');
    //                   })->get();
      
    // $vendas = [];
     
    return view('sistema.pdv.vendas.adicionar',[
    //   'caixa'             => $caixa,
      'clientes' => $clientes,
    //   // 'profissionais'     => $profissionais,
    //   'produtos_servicos' => $produtos_servicos,
    //   'venda'             => $venda,
    ]);
  }

  public function vendas_resumo(Request $request)
  {
    $venda = collect($request->all());
    $venda->pdv_vendas = collect($venda['pdv_vendas']);
    $venda->pdv_vendas_detalhes = collect($venda['pdv_vendas_detalhes']);
    $venda->pdv_vendas_pagamentos = collect($venda['pdv_vendas_pagamentos']);
    

    if(isset($venda['pdv_vendas']['id_cliente']))
    {
      $venda->cliente = Pessoa::find($venda['pdv_vendas']['id_cliente']);
    }
    
    return view('sistema.pdv.vendas.auxiliares.venda_resumo', [
      'venda' => $venda,
    ]);
  }
  
  // public function vendas_etapa_cliente()
  // {
  //   $clientes = app('App\Http\Controllers\Atendimento\PessoasController')->pessoas_plucar();

  //   return view('sistema.pdv.vendas.auxiliares.step0_cliente',[
  //     'clientes' => $clientes,
  //   ]);
  // }
  
  public function vendas_etapa_servprod()
  {
    $servicos = app('App\Http\Controllers\Cadastro\CatalogoController')->servprod_plucar();

    return view('sistema.pdv.vendas.auxiliares.step1_servprod',[
      'servicos' => $servicos,
    ]);
  }
  
  // FORMAS DE PAGAMENTOS 
  public function vendas_etapa_pagamento(Request $request)
  {
    $formas_pagamentos = Forma_Pagamento::
                            // select($request->distinct ?? 'forma')->
                            where('local', '=', 'venda')->orWhere('local', '=', 'ambos')->
                            // where('forma', 'like', '%'.$request->forma.'%')->
                            // where('tipo', 'like', '%'.$request->tipo.'%')->
                            // where('bandeira', 'like', '%'.$request->bandeira.'%')->
                            // where('parcela', $request->parcela == null ? 'like' : '=', $request->parcela == null ? '%'.$request->parcela.'%' : $request->parcela)->
                            // where('prazo', '>=', 0)->
                            // where('recebimento', 'like', '%'.$request->recebimento.'%')->
                            // distinct()->
                            // pluck('id', $pesquisa->distinct ?? 'forma');
                            get();

                            // return $formas_pagamentos;
    return view('sistema.pdv.vendas.auxiliares.step2_pagamento',[
      'formas_pagamentos' => $formas_pagamentos,
    ]);
  }
  
  // public function vendas_etapa_pagamento()
  // {

  //   $formas_pagamentos = Forma_Pagamento::
  //                                       // distinct('forma')->
  //                                       // select('forma', 'id')->
  //                                       get();

  //   return view('sistema.pdv.vendas.auxiliares.step2_pagamento',[
  //     'formas_pagamentos' => $formas_pagamentos,
  //   ]);
  // }

  public function vendas_validar(Request $request, $id)
  {
    $venda = Venda::
                    where($request->campo, '=' , $request->valor)->
                    where('id', '!=' , $request->id)->
                    get();

    switch ($request->campo)
    {
      case 'nome':
        if(strlen($request->valor) == 0)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve estar preenchido."];

        if(strlen($request->valor) < 5)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve ter pelo menos 5 caracteres."];

        if(strlen($request->valor) > 100)
          return ['type' => "error", 'message' => "O campo ".$request->campo." não pode ser superior a 100 caracteres."];

        break;


      case 'apelido':
        if(strlen($request->valor) == 0)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve estar preenchido."];

        if(strlen($request->valor) < 5)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve ter pelo menos 5 caracteres."];

        if(strlen($request->valor) > 50)
          return ['type' => "error", 'message' => "O campo ".$request->campo." não pode ser superior a 100 caracteres."];

        break;
    }

    if(count($venda) != 0)
    {
      $response = [
        'type'     => 'error',
        'message'  => "Uma venda com esse ".$request->campo." já foi cadastrada.",
        'data'     => $venda->toArray(),
      ];

    return $response;
    }
  }

  public function vendas_gravar(Request $request)
  {
    try
    {
      
      $ultima_comanda = Venda::latest()->first();
      $horario_atual  = \Carbon\Carbon::now();
      $horario_ultima = \Carbon\Carbon::parse($ultima_comanda->created_at ?? \Carbon\Carbon::now()->startOfYear() ); 

      if(
          ( $request->pdv_vendas['id_cliente'] ?? 0   != ($ultima_comanda->id_cliente ?? 9999) ) ||               // ser de cliente diferente
          ( $request->pdv_vendas['id_caixa']     != ($ultima_comanda->id_caixa ?? 0)      ) ||               // ser de caixa diferente
          ( $request->pdv_vendas['status']       != ($ultima_comanda->status ?? 0)        ) ||               // ter status diferente
          ( $request->pdv_vendas['qtd_produtos'] != ($ultima_comanda->qtd_produtos ?? 0)  ) ||               // ter diferente qtd de produtos
          ( $request->pdv_vendas['vlr_final']    != ($ultima_comanda->vlr_final ?? 0)     ) ||               // ter diferente valor final
          ( $horario_ultima->diffInSeconds($horario_atual) > 15)                                             // tem mais de 15 segundos da última comanda
        )
      {
        $pdv_venda = Venda::create($request->pdv_vendas);
        
        // SALVAR DETALHES DA VENDA (tentar outra forma depois... de salvar tudo sempre junto)
        // $pdv_venda->dfyejmfcrkolqjh()->createMany($request->pdv_vendas_detalhes);
        foreach ( $request->pdv_vendas_detalhes as $pdv_venda_detalhe )
        {
          $temp_detalhes = $pdv_venda->dfyejmfcrkolqjh()->create($pdv_venda_detalhe);
          // $apsoapsuw = $pdv_venda->dfyejmfcrkolqjh()->create($pdv_venda_detalhe)->hgihnjekboyabez()->create($pdv_venda_detalhe['fin_contas_internas']);
          
          // SALVAR CONTA INTERNA DA COMISSAO
          if(isset($pdv_venda_detalhe['fin_contas_internas']))
          {
            $temp_detalhes->hgihnjekboyabez()->create([
              'fonte_origem'   => $pdv_venda_detalhe['fin_contas_internas']['fonte_origem'],
              'id_pessoa'      => $pdv_venda_detalhe['fin_contas_internas']['id_pessoa'],
              'tipo'           => $pdv_venda_detalhe['fin_contas_internas']['tipo'],
              'percentual'     => $pdv_venda_detalhe['fin_contas_internas']['percentual'],
              'valor'          => $pdv_venda_detalhe['fin_contas_internas']['valor'],
              'dt_prevista'    => $pdv_venda_detalhe['fin_contas_internas']['dt_prevista'],
              'dt_quitacao'    => $pdv_venda_detalhe['fin_contas_internas']['dt_quitacao'] ?? \Carbon\Carbon::today(),
              'status'         => $pdv_venda_detalhe['fin_contas_internas']['status'],
            ]);
          }
        }

        // SALVAR PAGAMENTOS DA VENDA (tentar outra forma depois... de salvar tudo sempre junto)
        // $pdv_venda->xzxfrjmgwpgsnta()->createMany($request->pdv_vendas_pagamentos);
        foreach ( $request->pdv_vendas_pagamentos as $key => $pdv_venda_pagamento )
        {
          $temp_pagamentos = $pdv_venda->xzxfrjmgwpgsnta()->create($pdv_venda_pagamento);
          // $apsoapsuw = $pdv_venda->xzxfrjmgwpgsnta()->create($pdv_venda_pagamento)->pqwnldkwjfencsb()->create($pdv_venda_pagamento['fin_contas_internas']);
          
          // SALVAR CONTA INTERNA DOS PAGAMENTOS
          if(isset($pdv_venda_pagamento['fin_contas_internas']))
          {
            $temp_pagamentos->pqwnldkwjfencsb()->create([
              'fonte_origem'   => $pdv_venda_pagamento['fin_contas_internas']['fonte_origem'],
              'id_pessoa'      => $pdv_venda_pagamento['fin_contas_internas']['id_pessoa'],
              'tipo'           => $pdv_venda_pagamento['fin_contas_internas']['tipo'],
              'percentual'     => $pdv_venda_pagamento['fin_contas_internas']['percentual'],
              'valor'          => $pdv_venda_pagamento['fin_contas_internas']['valor'] * -1,
              'dt_prevista'    => $pdv_venda_pagamento['fin_contas_internas']['dt_prevista'] ?? \Carbon\Carbon::today(),
              'dt_quitacao'    => $pdv_venda_pagamento['fin_contas_internas']['dt_quitacao'] ?? null,
              'status'         => $pdv_venda_pagamento['fin_contas_internas']['status'],
            ]);
          }

          // SALVAR A RECEBER DOS PAGAMENTOS (CARTAO DE CREDITO, BOLETO, DEPOSITO, ETC)
          if(isset($pdv_venda_pagamento['fin_recebimentos_cartoes']))
          {
            $temp_pagamentos->fjwlfkjalpdwepf()->create([
              'id_forma_pagamento' => $pdv_venda_pagamento['fin_recebimentos_cartoes']['id_forma_pagamento'], 
              'vlr_real'           => $pdv_venda_pagamento['fin_recebimentos_cartoes']['vlr_real'], 
              'prc_descontado'     => $pdv_venda_pagamento['fin_recebimentos_cartoes']['prc_descontado'], 
              'vlr_final'          => $pdv_venda_pagamento['fin_recebimentos_cartoes']['vlr_final'], 
              'dt_prevista'        => $pdv_venda_pagamento['fin_recebimentos_cartoes']['dt_prevista'] ?? \Carbon\Carbon::today(), 
              'status'             => $pdv_venda_pagamento['fin_recebimentos_cartoes']['status'], 
              'id_lancamento'      => $pdv_venda_pagamento['fin_recebimentos_cartoes']['id_lancamento'], 
              'origem_lancamento'  => $pdv_venda_pagamento['fin_recebimentos_cartoes']['origem_lancamento'], 
            ]);
          }
        }
        
        $response = [
          'type'     => 'success',
          'message'  => "Venda registrada com sucesso",
          'data'     => $pdv_venda->toArray(),
          'redirect' => route('pdv.vendas.imprimir', $pdv_venda->id ),
        ];
      }
      else
      {
        $response = [
          'type'     => 'warning',
          'message'  => "A última comanda foi registrada em menos de 15 segundos. Caso esteja correto, aguarde.",
        ];
      }

      return $response;


        // // SALVAR DETALHES DA VENDA
        // if ( !empty( $request['pdv_venda_detalhes'] ) )
        // {
        //   foreach ( $request['pdv_venda_detalhes'] as $pdv_venda_detalhe )
        //   {
        //     $pdv_venda_detalhes = $pdv_venda->dfyejmfcrkolqjh()->create($pdv_venda_detalhe)->hgihnjekboyabez()->create($pdv_venda_detalhe['fin_conta_interna']);
        //   }
        // }

        // SALVAR CONTA INTERNA DA COMISSAO
        // return $request['fin_conta_interna'];
        // if ( !empty( $request['fin_conta_interna'] ) )
        // {
        //   foreach ( $request['fin_conta_interna'] as $fin_conta_interna )
        //   {
        //     if($fin_conta_interna['id_pessoa'] != null)
        //     {
        //       $pdv_venda_detalhes->hgihnjekboyabez()->create($fin_conta_interna);
        //     }
        //   }
        // }
        
        // if ( $request->tmp_destino == 'gravar' )
        // {
        //   $response = [
        //     'type'     => 'success',
        //     'message'  => "Venda realizada com sucesso.",
        //     'data'     => $pdv_venda->toArray(),
        //     'redirect' => route('pdv.vendas'),
        //   ];
        // }
        // else if ( $request->tmp_destino == 'pagar' )
        // {
        //   $response = [
        //     'type'     => 'success',
        //     'message'  => "Venda realizada com sucesso.",
        //   ];
        // }
      // }
      // else
      // {
      //   $response = [
      //     'type'     => 'warning',
      //     'message'  => "Venda semelhante já lançada a menos de 15 segundos atrás.",
      //     'data'     => $ultima->toArray(),
      //     'redirect' => route('pdv.vendas'),
      //   ];
      // }

      // return $response;
    }
    catch (ValidatorException $e)
    {
      dd('erro na exception no metodo store do service Venda');
      $response = [
        'success' => false,
        'error'   => true,
        'message' => $e->getMessageBag()
      ];

      return $response;
    }

    return view('sistema.pdv.vendas.index');
  }

  public function vendas_pagar($id)
  {
    $venda = Venda::find($id);

    return view('sistema.pdv.vendas.pagar', [
      'venda' => $venda,
    ]);
  }

  public function vendas_pago(Request $request, $id)
  // $object = collect($(request)>sum('valor');
  {
    try
    {
      $ultima = Venda::latest()->first();

      if(
        (\Carbon\Carbon::parse($ultima->created_at)->format('Y-m-d H:i:s') < \Carbon\Carbon::now()->subSeconds(15)->format('Y-m-d H:i:s')) === TRUE || 
        ($request['pdv_venda']['id_caixa'] != $ultima->id_caixa) === TRUE ||
        ($request['pdv_venda']['id_cliente'] != $ultima->id_cliente) === TRUE ||
        ($request['pdv_venda']['status'] != $ultima->status) === TRUE
      )
      { 
        // ATUALIZAR INFORMAÇOES DA VENDA
        $pdv_venda = Venda::find($id);
        $pdv_venda->qtd_produtos   = $pdv_venda->dfyejmfcrkolqjh->count();
        $pdv_venda->vlr_prod_serv  = $pdv_venda->dfyejmfcrkolqjh->sum('vlr_prod_serv');
        $pdv_venda->vlr_negociado  = $pdv_venda->dfyejmfcrkolqjh->sum('vlr_negociado');
        $pdv_venda->vlr_dsc_acr    = $pdv_venda->dfyejmfcrkolqjh->sum('vlr_dsc_acr');
        $pdv_venda->vlr_final      = $pdv_venda->dfyejmfcrkolqjh->sum('vlr_final');
        $pdv_venda->status         = 'Finalizada';
        $pdv_venda->update();

        // ATUALIZAR INFORMAÇOES DO DETALHE DA VENDA
        if ( !empty( $pdv_venda->dfyejmfcrkolqjh ) )
        {
          foreach ( $pdv_venda->dfyejmfcrkolqjh as $pdv_venda_detalhe )
          {
            $pdv_venda_detalhe->status = 'Finalizada';
            $pdv_venda_detalhe->update();
          }
        }


        // SALVAR PAGAMENTOS DA VENDA
        if ( !empty( $request->all() ) )
        {
          if( $pdv_venda->xzxfrjmgwpgsnta->count() == 0 )
          {
            foreach ( $request->all() as $pdv_venda_pagamento )
            {
              $pdv_venda_pagamentos = $pdv_venda->xzxfrjmgwpgsnta()->create($pdv_venda_pagamento);

              // CASO SEJA FIADO OU CONTA INTERNA, COLOCADO PAGAMENTO EM CONTA_INTERNA
              if( $pdv_venda_pagamento['forma_pagamento'] == 'Fiado' || $pdv_venda_pagamento['forma_pagamento'] == 'Conta Interna' )
              {
                $conta_interna = new ContaInterna;
                $conta_interna->id_origem     = $pdv_venda_pagamentos->id;
                $conta_interna->fonte_origem  = 'pdv_vendas_pagamentos';
                $conta_interna->id_pessoa     = $pdv_venda->id_cliente;
                $conta_interna->tipo          = $pdv_venda_pagamento['forma_pagamento'];
                $conta_interna->percentual    = 1;
                $conta_interna->valor         = ($pdv_venda_pagamentos->valor * -1);
                $conta_interna->dt_prevista   = $pdv_venda_pagamentos->dt_prevista;   //verificar se nao vai dar erro
                $conta_interna->dt_quitacao   = null;
                $conta_interna->status        ='Em Aberto';
                $conta_interna->save();
              }
            
              // CASO SEJA CARTÃO DE CRÉDITO, COLOCADO NA TABELA DE RECEBIMENTOCARTAO
              $forma_pagamento = Forma_Pagamento::find($pdv_venda_pagamento['id_forma_pagamento']);

              if ($forma_pagamento->taxa != 0)
              {
                $pgto_cartao = new RecebimentoCartao;
                $pgto_cartao->id_pagamento       = $pdv_venda_pagamentos->id ?? null;
                $pgto_cartao->id_forma_pagamento = $pdv_venda_pagamento['id_forma_pagamento'] ?? null;
                $pgto_cartao->vlr_real           = $pdv_venda_pagamento['valor'] ?? null;
                $pgto_cartao->prc_descontado     = $forma_pagamento->taxa ?? null;
                $pgto_cartao->vlr_final          = $pdv_venda_pagamento['valor'] - ($pdv_venda_pagamento['valor'] * $forma_pagamento->taxa / 100) ?? null;
                $pgto_cartao->dt_prevista        = $pdv_venda_pagamentos->dt_prevista ?? null;
                $pgto_cartao->status             = $pdv_venda_pagamento['status'] ?? null;
                $pgto_cartao->id_lancamento      = null;
                $pgto_cartao->origem_lancamento  = null;
                $pgto_cartao->save();
              }            
            }
          }
          else
          {
            $response = [
              'type'     => 'warning',
              'message'  => "Comanda já possui pagamento cadastrado.",
              'data'     => $pdv_venda->toArray(),
              'redirect' => route('pdv.vendas'),
            ];
          }
        }

        $response = [
          'type'     => 'success',
          'message'  => "Pagamento realizado com sucesso.",
          'data'     => $pdv_venda->toArray(),
          'redirect' => route('pdv.vendas'),
        ];
      }
      else
      {
        return 999;
      }

      return $response;
    }
    catch (ValidatorException $e)
    {
      dd('erro na exception no metodo store do service Venda');
      $response = [
        'success' => false,
        'error'   => true,
        'message' => $e->getMessageBag()
      ];

      return $response;
    }
  }
  
  public function vendas_avatar(Request $request)
  {
    if ($request->hasFile('image') && $request->file('image')->isValid())
    {
      $this->validate($request, ['image' => 'required|file|image|mimes:jpeg,png,gif,svg']);

      $image     = $request->file('image');
      $extension = $image->extension();
      $nome      = time().'.'.$image->extension();
      $filePath  = public_path('/img/pdvs/vendas/temp');

      $img = Image::make($image->path());
      $img->resize(250, 250);
      $img->encode('png', 75);
      $img->save($filePath.'/'.$nome);

      $temp_endereco = '/img/pdvs/vendas/temp'.'/'.$nome;

      return $temp_endereco;
    }
  }

  public function vendas_avatar_remove(Request $request)
  {
    File::delete(public_path($request->temp_foto));

    return true;
  }

  public function vendas_editar($id)
  {
    $venda = Venda::find($id);

    return view('sistema.pdv.vendas.editar', [
      'venda' => $venda,
    ]);
  }

  public function vendas_atualizar(Request $request, $id)
  {
    // return $request->vendas_enderecos->toArray();
    $venda     = Venda::find($id);
    $venda     = $venda->update($request->toArray());
    $atualizado = Venda::find($id);

    // SALVAR ENDEREÇOS DA PESSOA
    if ( !empty( json_decode($request->vendas_enderecos) ) )
    {
      $atualizado->uqbchiwyagnnkip()->delete();
      foreach ( json_decode($request->vendas_enderecos, true) as $atd_address )
      {
        $atualizado->uqbchiwyagnnkip()->create($atd_address);
      }
    }

    // SALVAR CONTATOS DA PESSOA
    if ( !empty( json_decode($request->vendas_contatos) ) )
    {
      $atualizado->ginthgfwxbdhwtu()->delete();
      foreach ( json_decode($request->vendas_contatos, true) as $atd_contatos )
      {
        $atualizado->ginthgfwxbdhwtu()->create($atd_contatos);
      }
    }

    $response = [
      'type'     => 'success',
      'message'  => "A venda '$atualizado->nome' foi atualizada com sucesso.",
      'data'     => $atualizado->toArray(),
      'redirect' => route('atd.vendas'),
    ];

    return $response;
  }

  public function vendas_excluir($id)
  {
    $venda = Venda::find($id);
    $venda->delete();

    $response = [
        'type'    => 'success',
        'message' => "A venda '$id' foi deleteada com sucesso.",
        'data'    => $venda->toArray(),
    ];

    return $response;
  }

  public function vendas_restaurar($id)
  {
    $venda = Venda::onlyTrashed()->find($id);
    $venda->restore();

    $response = [
        'type'    => 'success',
        'message' => "A venda '$venda->nome' foi restaurada com sucesso.",
        'data'    => $venda->toArray(),
    ];

    return $response;
  }

  public function vendas_pesquisar(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Tipo_de_Venda
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = Venda
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
  }


  public function vendas_tipos(Request $request, $id)
  {
    $venda = Venda::find($id);
    $tipo   = Tipo_de_Venda::find($request[0]['tipo']);

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $venda->aistggwbdgrrher()->attach($tipo->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $venda->aistggwbdgrrher()->detach($tipo->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

  // public function vendas_permissoes(Request $request, $id)
  // {
  //   $venda    = Venda::find($id);
  //   $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $venda->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $venda->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }


  // public function vendas_usuarios_tabelar($id)
  // {
  //   $venda    = Venda::find($id);

  //   return view('sistema.pdv.vendas.auxiliares.tab_vendas_usuarios', [
  //     'usuarios' => $venda->venda_venda,
  //   ]);
  // }

  // public function vendas_usuarios_incluir(Request $request, $id)
  // {
  //   $venda    = Venda::find($id);
  //   $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $venda->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $venda->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }

  // public function vendas_usuarios_adicionar(Request $request, $id)
  // {
  //   $venda  = Venda::find($id);
  //   $usuario = Venda::withTrashed()->find($request[0]['id_venda']);

  //   $atualizar = $venda->venda_venda()->syncWithoutDetaching($usuario);

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Incluído com sucesso.",
  //   ];

  //   return $response;
  // }

  // public function vendas_usuarios_remover(Request $request, $id)
  // {
  //   $venda  = Venda::find($id);
  //   $usuario = Venda::withTrashed()->find($request[0]['id_venda']);

  //   $atualizar = $venda->venda_venda()->detach($usuario);

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Removido com sucesso.",
  //   ];

  //   return $response;
  // }

// =======================================================================================================================================================================
  public function vendas_equipe_verificar_senha(Request $request, $id)
  {
    $venda = Pessoa::find($id);

    if ( Hash::check(  $request->password_atual, $venda->password ) )
    {
      $nova_senha = bcrypt( $request->password );

      $venda->password = $nova_senha;
      $venda->save();

      session()->flash('resposta', [
        'type'     => 'success',
        'message'  => 'Senha alterada com sucesso.',
        'data'     => $venda->toArray(),
      ]);

      $venda['redirect'] = route('atd.vendas.mostrar', $id);
      $venda['type']     = 'success';

      return $venda;
    }
    else
    {
      $response = [
        'type'    => 'error',
        'message' => 'A Senha atual não está correta.',
        'data'    => $venda->toArray(),
      ];

      return $response;
    }
  }

  public function vendas_equipe_alterar_senha($id)
  {
    $equipe = Pessoa::find($id);

    return view('sistema.pdv.vendas.equipe.alterar_senha', [
      'equipe' => $equipe,
    ]);
  }
// =======================================================================================================================================================================


  public function equipe(Request $request)
  {
    return view('sistema.pdv.vendas.equipe.index');
  }

  public function equipe_tabelar(Request $request)
  {
    $vendas = Venda::
                      whereHas('lcldxgfwmrzybmm', function($q)
                      {
                        $q->whereBetween('id_tipo', [2, 8]);
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          orwhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->nome ) )
                        {
                          $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orwhere('nome', 'LIKE', '%'.$request->nome.'%' );
                        }
                        if ( isset( $request->sexo ) )
                        {
                          if ($request->sexo == "Não Informado")
                          {
                            $query->where('sexo', '=', null );
                          }
                          else
                          {
                            $query->where('sexo', 'LIKE', '%'.$request->sexo.'%' );
                          }
                        }
                        if ( isset( $request->dt_nascimento ) )
                        {
                          $query->where('dt_nascimento', 'LIKE', '%'.$request->dt_nascimento.'%' );
                        }
                        if ( isset( $request->cpf ) )
                        {
                          $query->where('cpf', 'LIKE', '%'.$request->cpf.'%' );
                        }
                        if ( isset( $request->deleted_at ) )
                        {
                          $query->whereNotNull('deleted_at');
                        }
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
                      orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    // $vendas = Venda::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.pdv.vendas.equipe.tabelar', [
      'vendas' => $vendas,
    ]);
  }

  public function equipe_listar()
  {
    $equipe = Venda::pluck('id', 'nome');

    return $equipe;
  }

  public function equipe_adicionar()
  {
    return view('sistema.pdv.vendas.equipe.adicionar');
  }

  public function equipe_pesquisar($id)
  {
    $venda = Venda::find($id);

    return $venda;
  }

  public function equipe_gravar(Request $request)
  {
    if($request->json())
    {
      try
      {
        $venda = Venda::find($request->id_venda);
        $venda->lcldxgfwmrzybmm()->syncWithoutDetaching($request->id_tipo);
        $venda->xlwznisvhoqjqpx()->syncWithoutDetaching($request->id_tipo);

        try
        {
          $equipe = Pessoa::findOrFail($request->id_venda);

          return response()->json([
            'equipe' => $equipe,
            'redirect' => route('atd.equipe')
          ], 200);
        }
        catch(\Exception $e)
        {
          $equipe = Pessoa::create([
            'id'                      => $venda->id,
            'nome'                    => $venda->nome,
            'dia_pagamento'           => $request->dia_pagamento,
            'username'                => $request->username,
            'email'                   => $venda->email,
            'status'                  => 1,
            'password'                => Hash::make($request->password_confirmation),
          ]);
        }

        $equipe['redirect'] = route('atd.equipe');

        session()->flash('resposta', [
         'type'     => 'success',
         'message'  => "'$equipe->nome' foi incluído(a) como membro da equipe.",
         'data'     => $equipe->toArray(),
        ]);

        return $equipe;
      }
      catch (ValidatorException $e)
      {
        dd('erro na exception no metodo store do controller Venda');
        $response = [
          'success' => false,
          'error'   => true,
          'message' => $e->getMessageBag()
        ];

        return $response;
      }

    }
  }

  public function clientes(Request $request)
  {
    return view('sistema.pdv.vendas.clientes.index');
  }

  public function clientes_tabelar(Request $request)
  {
    $vendas = Venda::
                      whereHas('lcldxgfwmrzybmm', function($q)
                      {
                        $q->where('id_tipo', '=', 9);
                      })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->pesquisa ) )
                      //   {
                      //     $query->
                      //     orwhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                      //   }
                      // })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->nome ) )
                      //   {
                      //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orwhere('nome', 'LIKE', '%'.$request->nome.'%' );
                      //   }
                      //   if ( isset( $request->sexo ) )
                      //   {
                      //     if ($request->sexo == "Não Informado")
                      //     {
                      //       $query->where('sexo', '=', null );
                      //     }
                      //     else
                      //     {
                      //       $query->where('sexo', 'LIKE', '%'.$request->sexo.'%' );
                      //     }
                      //   }
                      //   if ( isset( $request->dt_nascimento ) )
                      //   {
                      //     $query->where('dt_nascimento', 'LIKE', '%'.$request->dt_nascimento.'%' );
                      //   }
                      //   if ( isset( $request->cpf ) )
                      //   {
                      //     $query->where('cpf', 'LIKE', '%'.$request->cpf.'%' );
                      //   }
                      //   if ( isset( $request->deleted_at ) )
                      //   {
                      //     $query->whereNotNull('deleted_at');
                      //   }
                      // })->
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
                      orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    // $vendas = Venda::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.pdv.vendas.clientes.tabelar', [
      'vendas' => $vendas,
    ]);
  }

  public function clientes_adicionar()
  {
    return view('sistema.pdv.vendas.clientes.adicionar');
  }

  public function clientes_gravar(Request $request)
  {
    if($request->json())
    {
      try
      {
        $venda = Venda::find($request->id_venda);
        $venda->lcldxgfwmrzybmm()->syncWithoutDetaching($request->id_tipo);
        $venda->xlwznisvhoqjqpx()->syncWithoutDetaching($request->id_tipo);

        try
        {
          $clientes = Pessoa::findOrFail($request->id_venda);

          return response()->json([
            'clientes' => $clientes,
            'redirect' => route('atd.clientes')
          ], 200);
        }
        catch(\Exception $e)
        {
          $clientes = Pessoa::create([
            'id'                      => $venda->id,
            'nome'                    => $venda->nome,
            'dia_pagamento'           => $request->dia_pagamento,
            'username'                => $request->username,
            'email'                   => $venda->email,
            'status'                  => 1,
            'password'                => Hash::make($request->password_confirmation),
          ]);
        }

        $clientes['redirect'] = route('atd.clientes');

        session()->flash('resposta', [
         'type'     => 'success',
         'message'  => "'$clientes->nome' foi incluído(a) como membro da clientes.",
         'data'     => $clientes->toArray(),
        ]);

        return $clientes;
      }
      catch (ValidatorException $e)
      {
        dd('erro na exception no metodo store do controller Venda');
        $response = [
          'success' => false,
          'error'   => true,
          'message' => $e->getMessageBag()
        ];

        return $response;
      }

    }
  }

// ============================================================================================================ contatos
  public function contatos(Request $request)
  {
    return view('sistema.pdv.vendas.contatos.index');
  }

  public function contatos_tabelar(Request $request)
  {
    $vendas = Contato::
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->pesquisa ) )
                      //   {
                      //     $query->
                      //     orwhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                      //   }
                      // })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->nome ) )
                      //   {
                      //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orwhere('nome', 'LIKE', '%'.$request->nome.'%' );
                      //   }
                      //   if ( isset( $request->sexo ) )
                      //   {
                      //     if ($request->sexo == "Não Informado")
                      //     {
                      //       $query->where('sexo', '=', null );
                      //     }
                      //     else
                      //     {
                      //       $query->where('sexo', 'LIKE', '%'.$request->sexo.'%' );
                      //     }
                      //   }
                      //   if ( isset( $request->dt_nascimento ) )
                      //   {
                      //     $query->where('dt_nascimento', 'LIKE', '%'.$request->dt_nascimento.'%' );
                      //   }
                      //   if ( isset( $request->cpf ) )
                      //   {
                      //     $query->where('cpf', 'LIKE', '%'.$request->cpf.'%' );
                      //   }
                      //   if ( isset( $request->deleted_at ) )
                      //   {
                      //     $query->whereNotNull('deleted_at');
                      //   }
                      // })->
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
                      orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    // $vendas = Venda::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.pdv.vendas.contatos.tabelar', [
      'vendas' => $vendas,
    ]);
  }

  public function contatos_adicionar()
  {
    return view('sistema.pdv.vendas.contatos.adicionar');
  }

  public function contatos_gravar(Request $request)
  {
    if (isset($request->nome) && isset($request->empresa) && isset($request->email) && isset($request->telefone) && isset($request->mensagem))
    {
      try
      {
        $contatos = Contato::create([
              'nome'     => $request->nome,
              'empresa'  => $request->empresa,
              'email'    => $request->email,
              'telefone' => $request->telefone,
              'mensagem' => $request->mensagem,
            ]);

        session()->flash('resposta', [
          'type'     => 'success',
          'message'  => "Obrigado por nos contactar.",
          'data'     => $contatos->toArray(),
        ]);

        return 'success';
      }
      catch (ValidatorException $e)
      {
        dd('erro na exception no metodo store do controller Venda');
        $response = [
          'success' => false,
          'error'   => true,
          'message' => $e->getMessageBag()
        ];

        return $response;
      }
    }
    else
    {
      return 'warning';
    }
  }



// ============================================================================================================ contatos


  public function clientes_dashboard()
  {
    return view('sistema.vendas.clientes.dashboard');
  }

  public function todos_clientes()
  {
    $clientes = Venda::get();

    return $clientes;
  }


// ============================================================================================================ contatos



  public function vendas_listar_fornecedores()
  {
    $fornecedores = Venda::select('id', 'nome')->get();

    return $fornecedores;
  }

  public function vendas_imprimir($id)
  {
    $empresa = Empresa::first();

    $venda = Venda::
                  // with('lufqzahwwexkxli')->
                  // with('dfyejmfcrkolqjh.hgihnjekboyabez.xeypqgkmimzvknq')->
                  // with('dfyejmfcrkolqjh.kcvkongmlqeklsl')->
                  // with('ssqlnxsbyywplanVendas.qmbnkthuczqdsdn')->
                  find($id);

    return view('sistema.pdv.vendas.auxiliares.mod_venda_imprimir_conteudo', [
        'venda' => $venda,
        'empresa' => $empresa,
    ]);
  }

  public function vendas_faturamento_mes_widget()
  {
    $start = \Carbon\Carbon::today()->startOfMonth();
    $end   = \Carbon\Carbon::today()->endOfMonth();

    $vendas = Venda::
                    whereBetween('created_at', [$start, $end])->
                    get();

    $total = 0;
    foreach($vendas as $venda)
    {
      $total += $venda->xzxfrjmgwpgsnta()->sum('valor');
    }

    return $total;
  }

  public function searchPerson(Request $request)
  {
    $people = Venda
      ::where('nome', 'LIKE', '%'.$request->nome.'%')
      ->take(10)
      ->with('ATD_Vendas_Tipos')
      ->get();

    return $people;
  }

  public function typePerson(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Tipo_de_Venda
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = Venda
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
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
}
