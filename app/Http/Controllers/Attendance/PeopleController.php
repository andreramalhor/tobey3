<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Database\Eloquent\Builder;

use App\Models\User;
use App\Models\Atendimento\Pessoa;
// use App\Models\Configuracao\ColaboradorServico;
use App\Models\Configuracao\Tipo_de_Pessoa;
use App\Models\pivots\FuncaoPessoa;

class PeopleController extends Controller
{
  public function searchPerson(Request $request)
  {
    $people = Pessoa
      ::where('nome', 'LIKE', '%'.$request->nome.'%')
      ->take(10)
      ->with('aistggwbdgrrher')
      ->get();

    return $people;
  }

  public function typePerson(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Tipo_de_Pessoa
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

  public function changeTypePerson(Request $request)
  {
    if ($request->change == 'detach')
    {
      $apelido = Pessoa::find($request->id)->apelido;
      $people  = Pessoa::find($request->id)->aistggwbdgrrher()->detach([9]);

      $response = [
        'type'     => 'warning',
        'message'  => "{$apelido} removido como fornecedor",
      ];
    }
    else if ($request->change == 'syncWithoutDetaching')
    {
      $apelido = Pessoa::find($request->id)->apelido;
      $people  = Pessoa::find($request->id)->aistggwbdgrrher()->syncWithoutDetaching([9]);

      $response = [
        'type'     => 'success',
        'message'  => "{$apelido} adicionado como fornecedor",
      ];
    }

    return $response;
  }
}
