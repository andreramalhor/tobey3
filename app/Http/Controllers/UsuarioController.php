<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Atendimento\Pessoa;

class UsuarioController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function profile()
  {

    $user = [];

    return view('sistema.usuario.admin.profile', [
      'user' => $user,
    ]);
  }

  public function recover_password(Request $request)
  {
    if(!isset($request->senha_nova) || !isset($request->senha_nova_confirmar))
    {
      $response = [
        'error'   => false,
        'type'    => 'error',
        'message' => 'Os campos de senha nova e confirmação devem estar preenchidos.',
      ];
    }
    else if($request->senha_nova != $request->senha_nova_confirmar)
    {
      $response = [
        'error'   => false,
        'type'    => 'error',
        'message' => 'A nova senha e a confirmação não correspondem.',
      ];
    }
    else if(strlen($request->senha_nova) < 4 || strlen($request->senha_nova) > 12 )
    {
      $response = [
        'error'   => false,
        'type'    => 'error',
        'message' => 'A senha deve ter entre 4 e 12 caracteres.',
      ];
    }
    else if(Hash::check($request->senha_atual, \Auth::User()->password))
    {
      $user = Pessoa::find(\Auth::User()->id)->fill([
        'password' => Hash::make($request->senha_nova)
      ])->save();
        
      $response = [
        'error'   => false,
        'type'    => 'success',
        'message' => 'A senha alterada com sucesso!',
      ];
    }
    else
    {
      $response = [
        'error'   => false,
        'type'    => 'error',
        'message' => 'A senha atual não está correta!',
      ];
    }

    return $response;
  }
}
