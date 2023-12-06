<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ACL\Funcao;
use App\Models\ACL\Permissao;
use App\Models\Atendimento\Pessoa;

class ACLController extends Controller
{
  public function usuarios()
  {
    return view('sistema.sistema.acl.usuarios.index');
  }

  public function usuarios_tabelar()
  {
    $usuarios = Pessoa::where('username', '!=', null)->orderBy('nome')->get();

    return view('sistema.sistema.acl.usuarios.tabelar', [
      'usuarios' => $usuarios,
    ]);
  }

  public function usuarios_mostrar($id)
  {
    $pessoa = Pessoa::find($id);

    return view('sistema.sistema.acl.usuarios.mostrar', [
      'pessoa' => $pessoa,
    ]);
  }

  public function usuarios_adicionar()
  {
    return view('sistema.sistema.acl.usuarios.adicionar');
  }

  public function usuarios_gravar(Request $request, $id)
  {
    return 9999;

    //   $pessoa     = Pessoa::find($id);
    //   $pessoa     = $pessoa->update($request->toArray());
    //   $atualizado = Pessoa::find($id);
  
    //   // SALVAR ENDEREÇOS DA PESSOA
    //   if ( !empty( json_decode($request->pessoas_enderecos) ) )
    //   {
    //     $atualizado->uqbchiwyagnnkip()->delete();
    //     foreach ( json_decode($request->pessoas_enderecos, true) as $atd_address )
    //     {
    //       $atualizado->uqbchiwyagnnkip()->create($atd_address);
    //     }
    //   }
  
    //   // SALVAR CONTATOS DA PESSOA
    //   if ( !empty( json_decode($request->pessoas_contatos) ) )
    //   {
    //     $atualizado->ginthgfwxbdhwtu()->delete();
    //     foreach ( json_decode($request->pessoas_contatos, true) as $atd_contatos )
    //     {
    //       $atualizado->ginthgfwxbdhwtu()->create($atd_contatos);
    //     }
    //   }
  
    //   // SALVAR FOTO DA IMAGEM DO PRODUTO
    //   if( $request->imagem_temp != null )
    //   {
    //     $nome         = $atualizado->id;
    //     $extensao     = 'png';
    //     $nameFile     = "{$nome}.{$extensao}";
    //     $arquivo_foto = "img/atendimentos/pessoas/".$nameFile;
        
    //     File::move(public_path($request->imagem_temp), public_path($arquivo_foto));
    //   }
  
    //   $response = [
    //     'type'     => 'success',
    //     'message'  => "A pessoa '$atualizado->nome' foi atualizada com sucesso.",
    //     'data'     => $atualizado->toArray(),
    //     'redirect' => route('atd.pessoas'),
    //   ];
  
    //   return $response;
    // }

    // $pessoa = Pessoa::create($request->all());

    // return view('sistema.sistema.acl.usuarios.index');
  }

  public function usuarios_editar($id)
  {
    $pessoa = Pessoa::find($id);
    $permissoes = Permissao::get();

    return view('sistema.sistema.acl.usuarios.editar', [
      'pessoa'     => $pessoa,
      'permissoes' => $permissoes,
    ]);
  }

  public function usuarios_remover(Request $request, $id)
  {
    $pessoa = Pessoa::find($id);
    $pessoa->username       = null;
    $pessoa->password       = null;
    $pessoa->remember_token = null;
    $pessoa->update();

    $response = [
        'type'    => 'success',
        'message' => 'Usuário `{$pessoa->apelido} removido com sucesso.',
        'data'    => $pessoa->toArray(),
    ];

    return $response;
  }

  public function usuarios_excluir_dependentes($id)
  {
    $pessoa = Pessoa::find($id);
    // $pessoa = Pessoa::onlyTrashed()->find($id);
    $pessoa->restore();

    $response = [
        'type'    => 'success',
        'message' => "Restaurado com sucesso.",
        'data'    => $pessoa->toArray(),
    ];

    return $response;
  }

  public function usuarios_atualizar(Request $request, $id)
  {
    $pessoa                 = Pessoa::find($id);
    $pessoa->username       = $request->username;
    $pessoa->password       = bcrypt( $request->password );
    $pessoa->update();

    $response = [
        'type'     => 'success',
        'message'  => 'Usuário '.$pessoa->apelido.' adicionado com sucesso.',
        'data'     => $pessoa->toArray(),
        'redirect' => route('acl.usuarios'),
  ];

    return $response;    
  }

  public function usuarios_permissoes(Request $request, $id)
  {
    $pessoa    = Pessoa::find($id);
    $permissao = Permissao::find($request[0]['id']);

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $pessoa->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $pessoa->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }


  public function usuarios_usuarios_tabelar($id)
  {
    $pessoa = Pessoa::find($id);

    return view('sistema.sistema.acl.usuarios.auxiliares.tab_usuarios_usuarios', [
      'usuarios' => $pessoa->znufwevbqgruklz,
    ]);
  }

  public function usuarios_usuarios_incluir(Request $request, $id)
  {
    $pessoa    = Pessoa::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $pessoa->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $pessoa->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

  public function usuarios_usuarios_adicionar(Request $request, $id)
  {
    $pessoa  = Pessoa::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $pessoa->znufwevbqgruklz()->syncWithoutDetaching($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Incluído com sucesso.",
    ];

    return $response;
  }

  public function usuarios_usuarios_remover(Request $request, $id)
  {
    $pessoa  = Pessoa::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $pessoa->znufwevbqgruklz()->detach($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Removido com sucesso.",
    ];

    return $response;
  }
// =======================================================================================================================================================================

public function funcoes()
{
  return view('sistema.sistema.acl.funcoes.index');
}

public function funcoes_tabelar()
{
  $funcoes = Funcao::orderBy('id')->get();

  return view('sistema.sistema.acl.funcoes.tabelar', [
    'funcoes' => $funcoes,
  ]);
}

public function funcoes_mostrar($id)
{
  $funcao = Funcao::find($id);

  return view('sistema.sistema.acl.funcoes.mostrar', [
    'funcao' => $funcao,
  ]);
}

public function funcoes_adicionar()
{
  return view('sistema.sistema.acl.funcoes.adicionar');
}

public function funcoes_gravar(Request $request)
{
  $funcao = Funcao::create($request->all());

  return view('sistema.sistema.acl.funcoes.index');
}

public function funcoes_editar($id)
{
  $funcao = Funcao::find($id);
  $permissoes = Permissao::get();

  return view('sistema.sistema.acl.funcoes.editar', [
    'funcao'     => $funcao,
    'permissoes' => $permissoes,
  ]);
}

public function funcoes_excluir(Request $request, $id)
{
  $funcao = Funcao::find($id);

  $deleta_pivot_permissoes = $funcao->PVRBIUSBYF()->delete();
  $deleta_pivot_usuarios   = $funcao->MMBBEYSRJM()->delete();

  $funcao->delete();

  $response = [
      'type'    => 'success',
      'message' => "Deleteado com sucesso.",
      'data'    => $funcao->toArray(),
  ];

  return $response;
}

public function funcoes_excluir_dependentes($id)
{
  $funcao = Funcao::find($id);
  // $funcao = Funcao::onlyTrashed()->find($id);
  $funcao->restore();

  $response = [
      'type'    => 'success',
      'message' => "Restaurado com sucesso.",
      'data'    => $funcao->toArray(),
  ];

  return $response;
}

public function funcoes_atualizar(Request $request, $id)
{
  $funcao     = Funcao::find($id);
  $funcao     = $funcao->update($request[0]);
  $atualizado = Funcao::find($id);

  $response = [
      'type'    => 'success',
      'message' => "Atualizado com sucesso.",
      'data'    => $atualizado->toArray(),
  ];

  return $response;
}

public function funcoes_permissoes(Request $request, $id)
{
  $funcao    = Funcao::find($id);
  $permissao = Permissao::find($request[0]['id']);

  if ($request[0]['status'] == 'on')
  {
    $atualizar = $funcao->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  }
  else if($request[0]['status'] == 'off')
  {
    $atualizar = $funcao->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  }

  $response = [
      'type'    => 'success',
      'message' => "Atualizado com sucesso.",
  ];

  return $response;
}


public function funcoes_usuarios_tabelar($id)
{
  $funcao = Funcao::find($id);

  return view('sistema.sistema.acl.funcoes.auxiliares.tab_funcoes_usuarios', [
    'usuarios' => $funcao->znufwevbqgruklz,
  ]);
}

public function funcoes_usuarios_incluir(Request $request, $id)
{
  $funcao    = Funcao::find($id);
  $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

  if ($request[0]['status'] == 'on')
  {
    $atualizar = $funcao->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  }
  else if($request[0]['status'] == 'off')
  {
    $atualizar = $funcao->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  }

  $response = [
      'type'    => 'success',
      'message' => "Atualizado com sucesso.",
  ];

  return $response;
}

public function funcoes_usuarios_adicionar(Request $request, $id)
{
  $funcao  = Funcao::find($id);
  $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

  $atualizar = $funcao->znufwevbqgruklz()->syncWithoutDetaching($usuario);

  $response = [
      'type'    => 'success',
      'message' => "Incluído com sucesso.",
  ];

  return $response;
}

public function funcoes_usuarios_remover(Request $request, $id)
{
  $funcao  = Funcao::find($id);
  $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

  $atualizar = $funcao->znufwevbqgruklz()->detach($usuario);

  $response = [
      'type'    => 'success',
      'message' => "Removido com sucesso.",
  ];

  return $response;
}
// =======================================================================================================================================================================

  public function permissoes()
  {
    return view('sistema.sistema.acl.permissoes.index');
  }

  public function permissoes_tabelar()
  {
    $permissoes = Permissao::orderBy('id', 'asc')->get();

    return view('sistema.sistema.acl.permissoes.tabelar', [
      'permissoes' => $permissoes,
    ]);
  }

  public function permissoes_mostrar($id)
  {
    $permissao = Permissao::find($id);

    return view('sistema.sistema.acl.permissoes.mostrar', [
      'permissao' => $permissao,
    ]);
  }

  public function permissoes_adicionar()
  {
    return view('sistema.sistema.acl.permissoes.adicionar');
  }

  public function permissoes_gravar(Request $request)
  {
    $permissao = Permissao::create($request->all());

    return view('sistema.sistema.acl.permissoes.index');
  }

  public function permissoes_editar($id)
  {
    $permissao = Permissao::find($id);

    return view('sistema.sistema.acl.permissoes.editar', [
      'permissao' => $permissao,
    ]);
  }
// =======================================================================================================================================================================
  public function link_cliente($cliente)
  {
    $url = 'http://www.nauticadigital.com.br/'.$cliente;
    // dd($url);

    return \Redirect::to($url);
  }
}
