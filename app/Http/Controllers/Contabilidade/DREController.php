<?php

namespace App\Http\Controllers\Contabilidade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contabilidade\Conta;
use App\Models\PDV\Venda;
use App\Models\PDV\VendaPagamento;
use App\Models\Financeiro\ContaInterna;
use App\Models\Financeiro\Lancamento;

class DREController extends Controller
{
  public function dre()
  {
    $start = \Carbon\Carbon::today()->startOfYear();
    $end   = \Carbon\Carbon::today()->endOfYear();

    $contas = Conta::
                        where('imprime', '=', 'Sim')->
                        orderBy('conta')->
                        get();

    $pagamentos_vendas = VendaPagamento::
                        // where('id', '!=', 82)->
                        // where('id', '!=', 83)->
                        where('dt_prevista', '>=', $start)->
                        where('dt_prevista', '<=', $end)->
                        select(\DB::raw('SUM(valor) AS valor'), 'id_forma_pagamento', \DB::raw('MONTH(dt_prevista) AS month'))->
                        groupby('month', 'id_forma_pagamento')->
                        orderBy('month')->
                        get();
    
    $comissoes = ContaInterna::
                        whereBetween('updated_at', [ $start, $end ])->
                        whereIn('fonte_origem', ['pdv_vendas_detalhes', 'fin_conta_interna'])->
                        where('status', '=', 'Pago')->
                        select(\DB::raw('SUM(valor) AS valor'), 'id_pessoa', \DB::raw('MONTH(updated_at) AS month'))->
                        groupby('month', 'id_pessoa')->
                        orderBy('month')->
                        get();

    $receitas = Venda::
                        where('created_at', '>=', $start)->
                        where('created_at', '<=', $end)->
                        orderBy('created_at')->
                        select('*', \DB::raw('MONTH(created_at) month'))->
                        get()->
                        groupby('month');

    $lancamentos = Lancamento::
                        where('dt_recebimento', '>=', $start)->
                        where('dt_recebimento', '<=', $end)->
                        select(\DB::raw('SUM(vlr_final) AS valor'), 'id_conta', \DB::raw('MONTH(dt_recebimento) AS month'))->
                        groupby('month', 'id_conta')->
                        orderBy('id_conta')->
                        orderBy('month')->
                        get();

    // dd($lancamentos);
    // $pessoas = Venda::where('created_at', '>=', $start)->
                        // where('created_at', '<=', $end)->
                        // orderBy('created_at')->
                        // get();

    return view('sistema.contabilidade.dre.index', [
      'contas'             => $contas,
      'receitas'           => $receitas,
      'lancamentos'        => $lancamentos,
      'pagamentos_vendas'  => $pagamentos_vendas,
      'comissoes'          => $comissoes,
    ]);

    // return view('sistema.contabilidade.dre.index');
  }

  public function dre_tabelar(Request $request)
  {
    $contas = Conta::
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          // orWhere('descricao', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                          // orWhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('descricao', 'LIKE', '%'.$request->pesquisa.'%' );
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->nome ) )
                        {
                          $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orWhere('nome', 'LIKE', '%'.$request->nome.'%' );
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
                                        // orWhere([
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
                      orderBy($request->ordenar_por ?? 'id', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    // $contas = Pessoa::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.contabilidade.contas.tabelar', [
      'contas' => $contas,
    ]);
  }

  public function dre_mostrar($id)
  {
    $conta  = Pessoa::withTrashed()->find($id);
    $funcoes = Funcao::get();

    return view('sistema.atendimentos.pessoas.mostrar', [
      'conta'  => $conta,
      'funcoes' => $funcoes,
    ]);
  }

  public function dre_adicionar()
  {
    return view('sistema.atendimentos.pessoas.adicionar');
  }

  public function dre_validar(Request $request, $id)
  {
    $conta = Pessoa::
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

    if(count($conta) != 0)
    {
      $response = [
        'type'     => 'error',
        'message'  => "Uma pessoa com esse ".$request->campo." já foi cadastrada.",
        'data'     => $conta->toArray(),
      ];

    return $response;
    }
  }

  public function dre_gravar(Request $request)
  {
    try
    {
      $conta = Pessoa::create($request->toArray());

      if( $request->foto_temp != null )
      {
        // SALVAR FOTO DO PERFIL DO INSTAGRAM
        $nome         = $conta->id;
        $extensao     = 'png';
        $nameFile     = "{$nome}.{$extensao}";
        $arquivo_foto = "img/atendimentos/pessoas/".$nameFile;
        
        // File::move(public_path($request->foto_temp), public_path($arquivo_foto));
        File::move(asset($request->foto_temp) , asset($arquivo_foto));
      }

      // SALVAR ENDEREÇOS DA PESSOA
      if ( !empty( json_decode($request->dre_enderecos) ) )
      {
        foreach ( json_decode($request->dre_enderecos, true) as $atd_address )
        {
          $conta->uqbchiwyagnnkip()->create($atd_address);
        }
      }

      // SALVAR CONTATOS DA PESSOA
      if ( !empty( json_decode($request->dre_contatos) ) )
      {
        foreach ( json_decode($request->dre_contatos, true) as $atd_contatos )
        {
          $conta->ginthgfwxbdhwtu()->create($atd_contatos);
        }
      }

      $response = [
        'type'     => 'success',
        'message'  => "A pessoa '$conta->nome' foi cadastrada com sucesso.",
        'data'     => $conta->toArray(),
        'redirect' => route('atd.pessoas'),
      ];

      return $response;
    }
    catch (ValidatorException $e)
    {
      dd('erro na exception no metodo store do service Pessoa');
      $response = [
        'success' => false,
        'error'   => true,
        'message' => $e->getMessageBag()
      ];

      return $response;
    }

    return view('sistema.atendimentos.pessoas.index');
  }

  public function dre_avatar(Request $request)
  {
    if ($request->hasFile('image') && $request->file('image')->isValid())
    {
      $this->validate($request, ['image' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg']);
      
      $image     = $request->file('image');
      $extension = 'png';                                                        // $image->extension()
      $nome      = time().'.'.$image->extension();
      $filePath  = public_path('/img/atendimentos/pessoas/temp');
      // $filePath  = asset('/img/atendimentos/pessoas/temp');eso

      $img = Image::make($image->path());
      $img->resize(250, 250);
      $img->encode('png', 75);
      $img->save($filePath.'/'.$nome);

      $temp_endereco = asset('/img/atendimentos/pessoas/temp'.'/'.$nome);

      return $temp_endereco;
    }
  }

  public function dre_avatar_remove(Request $request)
  {
    File::delete(asset($request->temp_foto));
    // File::delete(public_path($request->temp_foto));

    return true;
  }

  public function dre_editar($id)
  {
    $conta = Pessoa::find($id);

    return view('sistema.atendimentos.pessoas.editar', [
      'conta' => $conta,
    ]);
  }

  public function dre_atualizar(Request $request, $id)
  {
    // return $request->dre_enderecos->toArray();
    $conta     = Pessoa::find($id);
    $conta     = $conta->update($request->toArray());
    $atualizado = Pessoa::find($id);

    // SALVAR ENDEREÇOS DA PESSOA
    if ( !empty( json_decode($request->dre_enderecos) ) )
    {
      $atualizado->uqbchiwyagnnkip()->delete();
      foreach ( json_decode($request->dre_enderecos, true) as $atd_address )
      {
        $atualizado->uqbchiwyagnnkip()->create($atd_address);
      }
    }

    // SALVAR CONTATOS DA PESSOA
    if ( !empty( json_decode($request->dre_contatos) ) )
    {
      $atualizado->ginthgfwxbdhwtu()->delete();
      foreach ( json_decode($request->dre_contatos, true) as $atd_contatos )
      {
        $atualizado->ginthgfwxbdhwtu()->create($atd_contatos);
      }
    }

    // SALVAR FOTO DA IMAGEM DO PRODUTO
    if( $request->imagem_temp != null )
    {
      $nome         = $atualizado->id;
      $extensao     = 'png';
      $nameFile     = "{$nome}.{$extensao}";
      $arquivo_foto = "img/atendimentos/pessoas/".$nameFile;
      
      if (!File::move('$request->imagem_temp', public_path($arquivo_foto)))
      {
        return 238293;
        // Display an error
      }
      return 7766;
      return File::get(asset($request->imagem_temp));
      // File::move(public_path($request->imagem_temp), public_path($arquivo_foto));
      File::copy(asset($request->imagem_temp) , asset($arquivo_foto));
    }
    return 888;

    $response = [
      'type'     => 'success',
      'message'  => "A pessoa '$atualizado->nome' foi atualizada com sucesso.",
      'data'     => $atualizado->toArray(),
      'redirect' => route('atd.pessoas'),
    ];

    return $response;
  }

  public function dre_excluir($id)
  {
    $conta = Pessoa::find($id);
    $conta->delete();

    $response = [
        'type'    => 'success',
        'message' => "A pessoa '$conta->nome' foi deleteada com sucesso.",
        'data'    => $conta->toArray(),
    ];

    return $response;
  }

  public function dre_restaurar($id)
  {
    $conta = Pessoa::onlyTrashed()->find($id);
    $conta->restore();

    $response = [
        'type'    => 'success',
        'message' => "A pessoa '$conta->nome' foi restaurada com sucesso.",
        'data'    => $conta->toArray(),
    ];

    return $response;
  }

  public function dre_pesquisar(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Funcao
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = Pessoa
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
  }

  public function dre_funcoes(Request $request, $id)
  {
    $conta = Pessoa::find($id);
    $funcao = Funcao::find($request[0]['funcao']);

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $conta->lcldxgfwmrzybmm()->attach($funcao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $conta->lcldxgfwmrzybmm()->detach($funcao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

  public function dre_usuario_verificar($username)
  {
    $conta = Pessoa::where('username', '=', $username)->count();

    if($conta == 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // public function dre_permissoes(Request $request, $id)
  // {
  //   $conta    = Pessoa::find($id);
  //   $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }


  // public function dre_usuarios_tabelar($id)
  // {
  //   $conta    = Pessoa::find($id);

  //   return view('sistema.atendimentos.pessoas.auxiliares.tab_dre_usuarios', [
  //     'usuarios' => $conta->pessoa_pessoa,
  //   ]);
  // }

  // public function dre_usuarios_incluir(Request $request, $id)
  // {
  //   $conta    = Pessoa::find($id);
  //   $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }

  // public function dre_usuarios_adicionar(Request $request, $id)
  // {
  //   $conta  = Pessoa::find($id);
  //   $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

  //   $atualizar = $conta->pessoa_pessoa()->syncWithoutDetaching($usuario);

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Incluído com sucesso.",
  //   ];

  //   return $response;
  // }

  // public function dre_usuarios_remover(Request $request, $id)
  // {
  //   $conta  = Pessoa::find($id);
  //   $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

  //   $atualizar = $conta->pessoa_pessoa()->detach($usuario);

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Removido com sucesso.",
  //   ];

  //   return $response;
  // }

  public function dre_plucar()
  {
    $contas = Pessoa::
                      orderBy('apelido', 'ASC')->
                      pluck('id', 'apelido');

    return $contas;
  }

  public function dre_procurar($id)
  {
    $contas = Pessoa::
                      find($id);

    return $contas;
  }

  public function parceiros_plucar()
  {
    $parceiros = Funcao::    
                          where('nome', '=', 'Parceiro')->
                          first()->
                          jrlcgwekejwbwel()->
                          orderBy('nome', 'ASC')->
                          pluck('id', 'nome');

    return $parceiros;
  }

  public function parceiros_servicos($id)
  {
    $servicos = Pessoa::
                        find($id)->
                        kehfywbcsqalfpw()->
                        orderBy('nome', 'ASC')->get()->
                        pluck('id', 'nome');

    return $servicos;
  }

// =======================================================================================================================================================================
  public function dre_equipe_verificar_senha(Request $request, $id)
  {
    $conta = Pessoa::find($id);

    if ( Hash::check(  $request->password_atual, $conta->password ) )
    {
      $nova_senha = bcrypt( $request->password );

      $conta->password = $nova_senha;
      $conta->save();

      session()->flash('resposta', [
        'type'     => 'success',
        'message'  => 'Senha alterada com sucesso.',
        'data'     => $conta->toArray(),
      ]);

      $conta['redirect'] = route('atd.pessoas.mostrar', $id);
      $conta['type']     = 'success';

      return $conta;
    }
    else
    {
      $response = [
        'type'    => 'error',
        'message' => 'A Senha atual não está correta.',
        'data'    => $conta->toArray(),
      ];

      return $response;
    }
  }

  public function dre_equipe_alterar_senha($id)
  {
    $equipe = Pessoa::find($id);

    return view('sistema.atendimento.pessoas.equipe.alterar_senha', [
      'equipe' => $equipe,
    ]);
  }
// =======================================================================================================================================================================


  public function equipe(Request $request)
  {
    return view('sistema.atendimento.pessoas.equipe.index');
  }

  public function equipe_tabelar(Request $request)
  {
    $contas = Pessoa::
                      whereHas('lcldxgfwmrzybmm', function($q)
                      {
                        $q->whereBetween('id_tipo', [2, 8]);
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          orWhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->nome ) )
                        {
                          $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orWhere('nome', 'LIKE', '%'.$request->nome.'%' );
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
                                        // orWhere([
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

    // $contas = Pessoa::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.atendimento.pessoas.equipe.tabelar', [
      'contas' => $contas,
    ]);
  }

  public function equipe_listar()
  {
    $equipe = Pessoa::pluck('id', 'nome');

    return $equipe;
  }

  public function equipe_adicionar()
  {
    return view('sistema.atendimento.pessoas.equipe.adicionar');
  }

  public function equipe_pesquisar($id)
  {
    $conta = Pessoa::find($id);

    return $conta;
  }

  public function equipe_gravar(Request $request)
  {
    if($request->json())
    {
      try
      {
        $conta = Pessoa::find($request->id_pessoa);
        $conta->lcldxgfwmrzybmm()->syncWithoutDetaching($request->id_tipo);
        $conta->xlwznisvhoqjqpx()->syncWithoutDetaching($request->id_tipo);

        try
        {
          $equipe = Pessoa::findOrFail($request->id_pessoa);

          return response()->json([
            'equipe' => $equipe,
            'redirect' => route('atd.equipe')
          ], 200);
        }
        catch(\Exception $e)
        {
          $equipe = Pessoa::create([
            'id'                      => $conta->id,
            'nome'                    => $conta->nome,
            'dia_pagamento'           => $request->dia_pagamento,
            'username'                => $request->username,
            'email'                   => $conta->email,
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
        dd('erro na exception no metodo store do controller Pessoa');
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
    return view('sistema.atendimento.pessoas.clientes.index');
  }

  public function clientes_tabelar(Request $request)
  {
    $contas = Pessoa::
                      whereHas('lcldxgfwmrzybmm', function($q)
                      {
                        $q->where('id_tipo', '=', 9);
                      })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->pesquisa ) )
                      //   {
                      //     $query->
                      //     orWhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                      //   }
                      // })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->nome ) )
                      //   {
                      //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orWhere('nome', 'LIKE', '%'.$request->nome.'%' );
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
                                        // orWhere([
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

    // $contas = Pessoa::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.atendimento.pessoas.clientes.tabelar', [
      'contas' => $contas,
    ]);
  }

  public function clientes_adicionar()
  {
    return view('sistema.atendimento.pessoas.clientes.adicionar');
  }

  public function clientes_gravar(Request $request)
  {
    if($request->json())
    {
      try
      {
        $conta = Pessoa::find($request->id_pessoa);
        $conta->lcldxgfwmrzybmm()->syncWithoutDetaching($request->id_tipo);
        $conta->xlwznisvhoqjqpx()->syncWithoutDetaching($request->id_tipo);

        try
        {
          $clientes = Pessoa::findOrFail($request->id_pessoa);

          return response()->json([
            'clientes' => $clientes,
            'redirect' => route('atd.clientes')
          ], 200);
        }
        catch(\Exception $e)
        {
          $clientes = Pessoa::create([
            'id'                      => $conta->id,
            'nome'                    => $conta->nome,
            'dia_pagamento'           => $request->dia_pagamento,
            'username'                => $request->username,
            'email'                   => $conta->email,
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
        dd('erro na exception no metodo store do controller Pessoa');
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
    return view('sistema.atendimento.pessoas.contatos.index');
  }

  public function contatos_tabelar(Request $request)
  {
    $contas = Contato::
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->pesquisa ) )
                      //   {
                      //     $query->
                      //     orWhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orWhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                      //   }
                      // })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->nome ) )
                      //   {
                      //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orWhere('nome', 'LIKE', '%'.$request->nome.'%' );
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
                                        // orWhere([
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

    // $contas = Pessoa::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.atendimento.pessoas.contatos.tabelar', [
      'contas' => $contas,
    ]);
  }

  public function contatos_adicionar()
  {
    return view('sistema.atendimento.pessoas.contatos.adicionar');
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
        dd('erro na exception no metodo store do controller Pessoa');
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
    return view('sistema.pessoas.clientes.dashboard');
  }

  public function todos_clientes()
  {
    $clientes = Pessoa::get();

    return $clientes;
  }


// ============================================================================================================ contatos
  public function dre_listar_fornecedores()
  {
    $fornecedores = Pessoa::select('id', 'nome')->get();

    return $fornecedores;
  }


  public function searchPerson(Request $request)
  {
    $people = Pessoa
      ::where('nome', 'LIKE', '%'.$request->nome.'%')
      ->take(10)
      ->with('aistggwbdgrrher')
      ->get();

    return $people;
  }

  public function dre_sistema(Request $request)
  {
    $parceiros = Pessoa::
                    whereHas('wuclsoqsdppaxmf', function(Builder $query)
                    {
                      $query->where('nome', '=', 'Parceiro');
                    })->
                    with('aeahvtsijjoprlc')->
                    orderBy('apelido', 'asc')->
                    get();

    return $parceiros;
  }

  public function dre_agenda_parceiras(Request $request)
  {
    $parceiros = Pessoa::
                    whereHas('wuclsoqsdppaxmf', function(Builder $query)
                    {
                      $query->where('nome', '=', 'Parceiro');
                    })->
                    with(['aslfenvkvuelkds' => function ($query) {
                        $query->
                          where('auth_user', '=', \Auth()->User()->id)->
                          orderBy('ordem', 'asc');
                    }])->
                    // with('aslfenvkvuelkds')->
                    // orderByRaw('(SELECT ordem FROM agd_ordem WHERE atd_pessoas.id = agd_ordem.id_pessoa)')->
                    get();

    return $parceiros;
  }
   
  public function dre_agenda_ordem()
  {
    $parceiros = Pessoa::
                        whereHas('wuclsoqsdppaxmf', function(Builder $query)
                        {
                          $query->where('nome', '=', 'Parceiro');
                        })->
                        get();
    
    foreach($parceiros as $key => $parceiro)
    {
      $possui = $parceiro->aslfenvkvuelkds()->
                where([
                  'auth_user' => \Auth()->User()->id,
                  'id_pessoa' => $parceiro->id
                ])->
                first();
        
      if(!isset($possui))
      {
        $possui = $parceiro->aslfenvkvuelkds()->
                create([
                  'auth_user' => \Auth()->User()->id,
                  'id_pessoa' => $parceiro->id,
                  'ordem'     => $key + 100,
                ]);
      }

    }
                              
    if(is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
    {
      $agendas = AgendaOrdem::
                          where('id_pessoa', '=', \Auth()->User()->id)->
                          with('oewoekdwjzsdlkd')->
                          get();
    }
    else
    {
      $agendas = AgendaOrdem::
                          where('auth_user', '=', \Auth()->User()->id)->
                          whereNotNull('ordem')->
                          with('oewoekdwjzsdlkd')->
                          whereHas('oewoekdwjzsdlkd.wuclsoqsdppaxmf', function(Builder $query)
                          {
                            $query->where('nome', '=', 'Parceiro');
                          })->
                          orderBy('ordem', 'ASC')->
                          get();  
    }

    return $agendas;
  }

  public function dre_agenda_ordem_salvar(Request $request)
  {
    $parceiros = AgendaOrdem::
                            where([
                              'auth_user' => \Auth()->User()->id,
                              'id_pessoa' => $request->id_pessoa
                            ])->
                            first();
                           
    $parceiros = AgendaOrdem::find($parceiros->id);
    $parceiros->update($request->toArray());

    return $parceiros;
  }

  public function dre_produto_comissao(Request $request)
  {
    // $conta  = Pessoa::find($request[0]['conta']);
    // $servico = ServicoProduto::find($request[0]['produto']);

    $comissao = ColaboradorServico::
                                  where('id_servprod', '=', $request[0]['id_servprod'])->
                                  where('id_profexec', '=', $request[0]['id_profexec'])->
                                  get()->first();
   
    if($request[0]['status'] == 'on')
    {
      if (isset($comissao))
      {
        $comissao->id_profexec     = $request[0]['id_profexec'];
        $comissao->id_servprod     = $request[0]['id_servprod'];
        $comissao->prc_comissao    = $request[0]['prc_comissao']/100;
        $comissao->update();
      }
      else
      {
        $comissao = new ColaboradorServico;
        $comissao->id_profexec     = $request[0]['id_profexec'];
        $comissao->id_servprod     = $request[0]['id_servprod'];
        $comissao->prc_comissao    = $request[0]['prc_comissao']/100;
        $comissao->save();
      }
    }
    else
    {
      $comissao->delete();
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

  public function dre_vendas($id)
  {
    $vendas = Venda::
                    where('id_cliente', '=', $id)->
                    with('dfyejmfcrkolqjh.kcvkongmlqeklsl')->
                    orderBy('created_at', 'DESC')->
                    paginate();

    return $vendas; 
  }

  public function typePerson(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Funcao
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = Pessoa
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
  }



  // ================================================================================================================================================================================ AGENDA
  public function agendamentos(Request $request)
  {    
    return view('sistema.atendimentos.agendamentos.index');
  }

  public function agendamentos_tabelar(Request $request)
  {
    $agendamentos = Agendamento::
                      where('id_empresa', '=', \Auth::User()->id_empresa)->
    //                   whereDate('start', '=', \Carbon\Carbon::parse($request->dt_agenda))->
    //                   // where( whereDate('created_at', '=', Carbon::today()->toDateString()); )->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
    //                   //     orWhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
    //                   //     orWhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('status', 'LIKE', '%'.$request->pesquisa.'%' )->
    //                   //     orWhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
    //                   //     orWhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
    //                   //     orWhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
    //                   //     orWhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
    //                   //     orWhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('start', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhere('end', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhereHas('xhooqvzhbgojbtg', function(Builder $query) use ($request)
                          {
                            $query->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
                          })->
                          orWhereHas('zlpekczgsltqgwg', function(Builder $query) use ($request)
                          {
                            $query->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
                          });
                        }
                      })->
                      where( function ($query) use ($request)
                      {
    //                   //   if ( isset( $request->nome ) )
    //                   //   {
    //                   //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orWhere('nome', 'LIKE', '%'.$request->nome.'%' );
    //                   //   }
                        if ( isset( $request->status ) )
                        {
                          $query->where('status', '=', $request->status );
                        }
                        if ( isset( $request->id_cliente ) )
                        {
                          $query->where('id_cliente', '=', $request->id_cliente )->
                                  orWhereHas('xhooqvzhbgojbtg', function(Builder $query) use ($request)
                                  {
                                    $query->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
                                  });
                        }
    //                   //   if ( isset( $request->cpf ) )
    //                   //   {
    //                   //     $query->where('cpf', 'LIKE', '%'.$request->cpf.'%' );
    //                   //   }
    //                   //   if ( isset( $request->deleted_at ) )
    //                   //   {
    //                   //     $query->whereNotNull('deleted_at');
    //                   //   }
                      })->
    //                   //                   // where([
    //                   //                   //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
    //                   //                   //   // ['nome'          , 'LIKE', '%'.$request->nome.'%'],
    //                   //                   //   // ['sexo'          , 'LIKE', '%'.$request->sexo.'%'],
    //                   //                   //   // ['dt_nascimento' , 'LIKE', '%'.$request->dt_nascimento.'%'],
    //                   //                   //   // ['cpf'           , 'LIKE', '%'.$request->cpf.'%'],
    //                   //                   //   // ['observacao'    , 'LIKE', '%'.$request->observacao.'%'],
    //                   //                   //   // ['email'         , 'LIKE', '%'.$request->email.'%'],
    //                   //                   //   // ['facebook'      , 'LIKE', '%'.$request->facebook.'%'],
    //                   //                   //   // ['instagram'     , 'LIKE', '%'.$request->instagram.'%'],
    //                   //                   //   // ['id_criador'    , 'LIKE', '%'.$request->id_criador.'%']
    //                   //                   // ])->
    //                   //                   // orWhere([
    //                   //                   //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
    //                   //                   //   // ['nome'          , 'LIKE', '%'.$request->nome.'%'],
    //                   //                   //   // ['sexo'          , 'LIKE', '%'.$request->sexo.'%'],
    //                   //                   //   // ['dt_nascimento' , 'LIKE', '%'.$request->dt_nascimento.'%'],
    //                   //                   //   ['cpf'           , '=', NULL ],
    //                   //                   //   // ['observacao'    , 'LIKE', '%'.$request->observacao.'%'],
    //                   //                   //   // ['email'         , 'LIKE', '%'.$request->email.'%'],
    //                   //                   //   // ['facebook'      , 'LIKE', '%'.$request->facebook.'%'],
    //                   //                   //   // ['instagram'     , 'LIKE', '%'.$request->instagram.'%'],
    //                   //                   //   // ['id_criador'    , 'LIKE', '%'.$request->id_criador.'%']
                                        // ])->
                      orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                      orderBy($request->ordenar_por ?? 'id', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page );
                      // appends($request->all());
    //                   first();
                      
    // // $agendas = Pessoa::
    //                    // where('id', '!=', 2)->
                      //  paginate(25);
                        
    return view('sistema.atendimentos.agendamentos.tabelar', [
      'agendamentos' => $agendamentos,
      'jdfhksd' => $request->all(),
    ]);
  }
  
  public function agendamentos_tabelar2(Request $request)
  {
    if(is_null(\Auth::User()->wuclsoqsdppaxmf) || \Auth::User()->wuclsoqsdppaxmf->contains('nome', 'Parceiro'))
    {
      $agenda = Agendamento::
                      where('id_empresa', '=', \Auth::User()->id_empresa)->
                      whereDate('start', '=', \Carbon\Carbon::parse($request->dt_agenda))->
                      where('id_profexec', '=', \Auth()->User()->id)->
                      get();
    }
    else
    {
      $agenda = Agendamento::
                      where('id_empresa', '=', \Auth::User()->id_empresa)->
                      whereDate('start', '=', \Carbon\Carbon::parse($request->dt_agenda))->
                      where('id_profexec', '=', $request->id_parceiro)-> 
                      get();
    }

    return response()->json($agenda); 
  }

  public function agendamentos_planilhar(Request $request)
  {
    return view('sistema.atendimentos.agendamentos.planilhar');
  }

  public function agendamentos_adicionar(Request $request)
  {
    $clientes = $this->dre_plucar();
    
    return view('sistema.atendimentos.agendamentos.auxiliares.mod_agendamento_adicionar', [
      'clientes'    => $clientes,
      'id_parceiro' => $request->id_parceiro,
    ]);
  }

  public function agendamentos_adicionar_l()
  {
    $clientes       = Pessoa::orderBy('apelido', 'ASC')->pluck('apelido','id');
    $servicos       = ServicoProduto::where('tipo', '=', 'Serviço')->orderBy('nome', 'ASC')->get();
    $parceiros      = Pessoa::
                              whereHas('wuclsoqsdppaxmf', function(Builder $query)
                              {
                                $query->where('nome', '=', 'Parceiro');
                              })->
                              orderBy('ordem', 'ASC')->
                              get();

    return view('sistema.atendimentos.agendamentos.adicionar_lote', [
      'clientes'     => $clientes,
      'servicos'     => $servicos,
      'parceiros'    => $parceiros,
    ]);
  }
  
  public function agendamentos_criar(Request $request)
  {
    $clientes       = Pessoa::orderBy('apelido', 'ASC')->pluck('apelido','id');
    $servicos       = ServicoProduto::where('tipo', '=', 'Serviço')->orderBy('nome', 'ASC')->get();
    $parceiros      = Pessoa::
                              whereHas('wuclsoqsdppaxmf', function(Builder $query)
                              {
                                $query->where('nome', '=', 'Parceiro');
                              })->
                              orderBy('ordem', 'ASC')->
                              get();

    return view('sistema.atendimentos.agendamentos.auxiliares.mod_evento_criar', [
      'clientes'     => $clientes,
      'servicos'     => $servicos,
      'parceiros'    => $parceiros,
      'informacoes'  => $request->all(),    
    ]);
  }

  public function agendamentos_mostrar($id)
  {
    $agendamento  = Agendamento::find($id);
    $clientes     = Pessoa::orderBy('apelido', 'ASC')->pluck('apelido','id');
    $servicos     = ServicoProduto::where('tipo', '=', 'Serviço')->orderBy('nome', 'ASC')->get();

    return view('sistema.atendimentos.agendamentos.auxiliares.mod_evento_mostrar', [
      'agendamento'  => $agendamento,
      'clientes'     => $clientes,
      'servicos'     => $servicos,
    ]);
  }

  // public function agendamentos_adicionar()
  // {
  //   return view('sistema.atendimentos.agendamentos.adicionar');
  // }

  public function agendamentos_validar(Request $request, $id)
  {
    $conta = Pessoa::
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

    if(count($conta) != 0)
    {
      $response = [
        'type'     => 'error',
        'message'  => "Uma pessoa com esse ".$request->campo." já foi cadastrada.",
        'data'     => $conta->toArray(),
      ];

    return $response;
    }
  }

  public function agendamentos_gravar(StoreAgendamentoRequest $request)
  {
    $agendamento = Agendamento::create($request->all());

    $response = [
      'type'     => 'success',
      'message'  => "Agendamento cadastrado com sucesso.",
      'data'     => $agendamento,
    ];

    return $response;
  }

  public function getCurrentValidationFields()
  {
    switch ($this->current_step)
    {
      case 1:
        return ['name', 'email'];
      case 2:
        return ['password', 'password_confirmation'];
    }
  }

  public function validateStep(Request $request)
  {
    $this->validate($request, $this->rules(), [], $this->getCurrentValidationFields());
  }

  public function agendamentos_gravar_lote(Request $request)
  {
    try
    {
      foreach ($request->all() as $agendamento)
      {
        $agendamentos = Agendamento::create($agendamento);
      }

      $response = [
        'type'     => 'success',
        'message'  => "Agendamentos cadastrados com sucesso.",
        'data'     => $agendamentos,
        'redirect' => route('atd.agendamentos'),
      ];

      return $response;
    }
    catch (ValidatorException $e)
    {
      $response = [
        'success' => false,
        'error'   => true,
        'message' => $e->getMessageBag()
      ];

      return $response;
    }
  }

  public function agendamentos_editar($id)
  {
    $agendamento    = Agendamento::find($id);

    $clientes       = Pessoa::orderBy('apelido', 'ASC')->pluck('apelido','id');
    $servicos       = ServicoProduto::where('tipo', '=', 'Serviço')->orderBy('nome', 'ASC')->get();
    $parceiros      = Pessoa::
                              whereHas('wuclsoqsdppaxmf', function(Builder $query)
                              {
                                $query->where('nome', '=', 'Parceiro');
                              })->
                              orderBy('ordem', 'ASC')->
                              get();

    return view('sistema.atendimentos.agendamentos.auxiliares.mod_evento_editar', [
      'agendamento'  => $agendamento,
      'clientes'     => $clientes,
      'servicos'     => $servicos,
      'parceiros'    => $parceiros,
    ]);
  }

  public function agendamentos_atualizar(Request $request, $id)
  {
    $evento = Agendamento::find($id);
    $evento->update($request->all());
    
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Agendamento de '.$evento->title.' atualizado com sucesso para '.\Carbon\Carbon::parse($evento->start)->format('d/m/Y H:i').'.',
      'data'    => $evento,
    ];

    return $response;    
  }

  public function agendamentos_excluir(Request $request, $id)
  {
    $evento = Agendamento::find($id);
    $evento->update($request->all());
    $evento->delete();
    
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Agendamento de '.$evento->title.' excluído com sucesso',
      'data'    => $evento,
    ];

    return $response;    

    return $response;
  }

  public function agendamentos_restaurar($id)
  {
    $conta = Pessoa::onlyTrashed()->find($id);
    $conta->restore();

    $response = [
        'type'    => 'success',
        'message' => "A pessoa '$conta->nome' foi restaurada com sucesso.",
        'data'    => $conta->toArray(),
    ];

    return $response;
  }

  public function agendamentos_pesquisar(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Funcao
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = Pessoa
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
  }

  public function agendamentos_funcoes(Request $request, $id)
  {
    $conta = Pessoa::find($id);
    $funcao = Funcao::find($request[0]['funcao']);

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $conta->lcldxgfwmrzybmm()->attach($funcao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $conta->lcldxgfwmrzybmm()->detach($funcao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

  // public function agendamentos_permissoes(Request $request, $id)
  // {
  //   $conta    = Pessoa::find($id);
  //   $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }


  // public function agendamentos_usuarios_tabelar($id)
  // {
  //   $conta    = Pessoa::find($id);

  //   return view('sistema.atendimentos.agendamentos.auxiliares.tab_agendas_usuarios', [
  //     'usuarios' => $conta->pessoa_pessoa,
  //   ]);
  // }

  // public function agendamentos_usuarios_incluir(Request $request, $id)
  // {
  //   $conta    = Pessoa::find($id);
  //   $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $conta->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }

  // public function agendamentos_usuarios_adicionar(Request $request, $id)
  // {
  //   $conta  = Pessoa::find($id);
  //   $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

  //   $atualizar = $conta->pessoa_pessoa()->syncWithoutDetaching($usuario);

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Incluído com sucesso.",
  //   ];

  //   return $response;
  // }

  // public function agendamentos_usuarios_remover(Request $request, $id)
  // {
  //   $conta  = Pessoa::find($id);
  //   $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

  //   $atualizar = $conta->pessoa_pessoa()->detach($usuario);

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Removido com sucesso.",
  //   ];

  //   return $response;
  // }

  public function agendamentos_plucar()
  {
    $agendas = Pessoa::pluck('nome', 'id');

    return $agendas;
  }

  public function profissionalProduto($id)
  {
    // $dado = $this->repository->find($id)->AtdProdutosAgendas;
    $dado = $this->repository->Servico($id);

    return response()->json($dado);
  }

  public function agendamentos_update(Request $request)
  {
    $event = Agendamento::find($request->id);

    $event->update($request->all());
    
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Agendamento de '.$event->title.' atualizado com sucesso para '.\Carbon\Carbon::parse($event->start)->format('d/m/Y H:i').'.',
      'data'    => $event,
    ];

    return $response;    
  }

  public function agendamentos_carregar(Request $request)
  {
    $returnedColumns = [
      'id',
      'start',
      'end',
      'id_cliente',
      'id_profexec',
      'id_servprod',
      'id_comanda',
      'valor',
      'obs',
      'status',
      // 'title',
      // 'resourceId'
    ];

    // 'kdfalsjdlk_c_l_i_e_n_t_easjdlaskjdlkasjd'{
      // 'apelido',
      // 'nome',
      // 'nomes',

    // $start  = (!empty($request->start)) ? ($request->start) : \Carbon\Carbon::yesterday();
    // $start  = (!empty($request->start)) ? ($request->start) : ('');
    $start  = (!empty($request->start)) ? ($request->start) : \Carbon\Carbon::today()->startOfDay();
    $end    = (!empty($request->end))   ? ($request->end)   : \Carbon\Carbon::today()->endOfDay();

    // $eventos = Agendamento::get();
    $eventos = Agendamento::
                          where('id_empresa', '=', \Auth::User()->id_empresa)->
                          WhereBetween('start', [ $start, $end ])->get($returnedColumns);
    
    return response()->json($eventos);
  }

  public function agendamentos_fixas(Request $request)
  {
    $grupos_fixas = Agendamento::
                      whereNotNull('grupo')->                      
                      where('id_servprod', '!=', 571 )->
                      where('start', '>', now() )->
                      get()->
                      groupBy('grupo');

    return view('sistema.atendimentos.agendamentos.clientes_fixas_tabela', [
      'grupos_fixas' => $grupos_fixas,
    ]);

    return response()->json($eventos);
  }

  public function agendamentos_fixas_deletar(Request $request)
  {
    $grupos_fixas = Agendamento::
                          where('grupo', '=', $request->all())->
                          where('start', '>', now() )->
                          delete();

    $response = [
      'type'     => 'success',
      'message'  => "Os agendamentos fixos dessa pessoa foram excluídos com sucesso.",
    ];

    return $response;
  }

  public function proximosaniversariantes()
  {
    $contas = Pessoa::
      whereRaw('MOD(DAYOFYEAR(dt_nascimento) - DAYOFYEAR(CURDATE()) + 365, 365) <= 7')->
      // whereMonth('dt_nascimento', '=', \Carbon\Carbon::today()->format('m'))->
      // where(function ($query)
      // {
      //   $query->
      //     whereDay('dt_nascimento', '>=', \Carbon\Carbon::today()->format('d'))->
      //     whereDay('dt_nascimento', '<=', \Carbon\Carbon::today()->addDays(90)->format('d'));
      // })->
      orderByRaw('DATE_FORMAT(dt_nascimento, "%m-%d")')->
      // toSql();
      get();

    return $contas;
  }

  public function jsonColaboradores()
  {
    $contas = Pessoa::whereHas('aistggwbdgrrher', function (Builder $query) {
      $query->where('nome', 'LIKE', 'Colaborador');
    })->get();

    return $contas;
  }
  
  public function profExec($id_servprod)
  {
    $colaborador = ColaboradorServico::
                              where('id_servprod', '=', $id_servprod)->
                              with('dwsdjqwqwekowqe')->
                              get();

    return $colaborador;
  }

}
