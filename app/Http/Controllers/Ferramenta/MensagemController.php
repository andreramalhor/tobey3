<?php

namespace App\Http\Controllers\Ferramenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ferramenta\Contato;

class MensagemController extends Controller
{
  public function mensagens()
  {
    return view('sistema.ferramentas.mensagens.index');
  }
  
  public function mensagens_widget()
  {
    $mensagens = Contato::
                        where('read_at', '=', null)->
                        get();

    return view('includes.navbar.menu-item-messages-nao-lidas', [
    'mensagens' => $mensagens,
    ]);
  }
  
  public function mensagens_tabelar()
  {
    $mensagens = Contato::
                        where('read_at', '=', null)->
                        get();

    return view('sistema.ferramentas.mensagens.auxiliares.inc_tabelar', [
      'mensagens' => $mensagens,
    ]);
  }
  
  public function mensagens_mostrar($id)
  {
    $mensagens = Contato::find($id);
  
    return view('sistema.ferramentas.mensagens.mostrar', [
      'mensagens' => $mensagens,
    ]);
  }
  
  public function mensagens_adicionar()
  {
    return view('sistema.sistema.acl.funcoes.adicionar');
  }
  
  public function mensagens_gravar(Request $request)
  {
    $mensagem = Contato::create($request->all());

    return true;
  }
  
  public function mensagens_editar($id)
  {
    $funcao = Funcao::find($id);
    $permissoes = Permissao::get();
  
    return view('sistema.sistema.acl.funcoes.editar', [
      'funcao'     => $funcao,
      'permissoes' => $permissoes,
    ]);
  }
  
  public function mensagens_excluir(Request $request, $id)
  {
    $mensagem = Contato::find($id);
    $mensagem->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $mensagem->toArray(),
    ];
  
    return $response;
  }
  
  public function mensagens_atualizar(Request $request, $id)
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

}
