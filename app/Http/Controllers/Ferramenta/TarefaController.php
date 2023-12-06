<?php

namespace App\Http\Controllers\Ferramenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ferramenta\Tarefa;

class TarefaController extends Controller
{
  // protected $repository;
  // protected $service;

  // public function __construct(PessoaRepository $repository, PessoaService $service)
  // {
    // $this->repository   = $repository;
    // $this->service      = $service;
  // }

  public function index()
  {
    return view('sistema.ferramentas.tarefas.index');
  }

  public function list(Request $request)
  {
    $tasks = Tarefa::
              where('user_id', \Auth::User()->id)->
              orwhere('responsavel', \Auth::User()->id)->
              withTrashed()->
              orderByRaw('!ISNULL(deleted_at), deleted_at DESC, created_at DESC')->
              get();
          
    return $tasks;
  }

  public function create()
  {
    return view('sistema.ferramentas.tarefas.create');
  }

  public function store(Request $request)
  {
    $dados = Tarefa::create($request->all());
    
    $response = [
      'typ' => 'success',
      'msg' => 'Tarefa "'.$dados->tarefa.'" criada com sucesso.'
    ];

    return $response;
  }

  public function show($id)
  {
    $pessoa = $this->repository->find($id);

    return view('sistema.atendimento.pessoas.show', [
      'pessoa' => $pessoa,
    ]);
  }

  public function edit($id)
  {
    $pessoa = $this->repository->find($id);

    return view('sistema.atendimento.pessoas.edit', [
      'pessoa' => $pessoa,
    ]);
  }

  public function update(Request $request, $id)
  {
    $tarefa = Tarefa::withTrashed()->find($id);

    if($request->done == 'true')
    {
      $tarefa->update([
        'feito_por' => \Auth::User()->id,
      ]);
      
      $tarefa->delete($id);

      $response = [
        'typ' => 'success',
        'msg' => 'Tarefa "'.$tarefa->tarefa.'" feita com sucesso.'
      ];
    }
    else
    {
      $tarefa->update([
        'feito_por' => null,
      ]);

      $tarefa->restore();

      $response = [
        'typ' => 'warning',
        'msg' => 'Tarefa "'.$tarefa->tarefa.'" desfeita.'
      ];
    }

    return $response;
  }

  public function destroy($id)
  {
    // $deleted = $tarefa->forceDelete($id);

    return '6';
    $tarefa = Tarefa::find($id);

    $deleted = $tarefa->delete($id);

  }

  public function tabela(Request $request)
  {
    if($request->ajax())
    {
      $query = $request->get('query');
      
      if($query != '')
      {
        $pessoas = $this->repository->findWhere([
                    ['tarefa', 'like', '%'.$query.'%' ],
                    ['id_empresa', '=', \Auth::User()->id_empresa ],
                  ]);
      }
      else
      {
        $pessoas = $this->repository->all();
      }
    }

    return view('sistema.atendimento.pessoas.table', [
     'pessoas'      =>   $pessoas,
    ]);
  }

  public function profissionalProduto($id)
  {
    // $dado = $this->repository->find($id)->AtdProdutosPessoas;
    $dado = $this->repository->Servicos($id);

    return response()->json($dado);
  }

  public function info($id)
  {
    $dado = $this->repository->with('AtdPessoasTipos')->find($id);

    return response()->json($dado);
  }

  public function aniversariantes()
  {
    $dados = $this->repository->Aniversariantes();

    return view('sistema.relatorio.aniversariantes', [
     'dados'   =>   $dados,
    ]);
  }

}
