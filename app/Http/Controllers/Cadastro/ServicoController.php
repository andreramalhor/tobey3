<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Cadastro\ServicoValidator;
use App\Services\Cadastro\ServicoService;

use App\Models\Cadastro\ServicoProduto;
use App\Models\Catalogo\Categoria;
use App\Models\pivots\ColaboradorServico;

class ServicoController extends Controller
{
  protected $repository;
  protected $service;

  public function __construct(ServicoService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    $servicos = ServicoProduto::where('tipo', 'Serviço')->orderBy('nome')->paginate(9999);
    $marcas = ServicoProduto::where('tipo', 'Serviço')->select('marca')->distinct()->get();

    return view('sistema.cadastros.servicos.index',[
      'servicos'    => $servicos,
      'marcas'      => $marcas,
    ]);
  }

  public function filtrar(Request $request)
  {
    $dataForm = $request->except('_token');

    $marcas = ServicoProduto::where('tipo', 'Serviço')->select('marca')->distinct()->get();

    $servicos = ServicoProduto::where('tipo', 'Serviço')->where(function ($query) use ($dataForm)
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

  public function create()
  {
    $categorias = Categoria::pluckrrrrrr('nome', 'id');

    return view('sistema.cadastros.servicos.create', [
      'categorias'    => $categorias,
    ]);
  }
  
  public function triate(ServicoValidator $request)
  {
    return true;
  }

  public function store(ServicoValidator $request)
  {
    if($request->json())
    {
      $dados = $this->service->store($request);

      session()->flash('resposta', [
       'type'     => $dados['type'],
       'message'  => $dados['message'],
       'data'     => $dados['data'],
      ]);

    return $dados;
    }
  }

  public function show($id)
  {
    $servico = ServicoProduto::find($id);

    return view('sistema.cadastros.servicos.show', [
     'servico'      =>   $servico,
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

  public function load(Request $request)
  {
    $servicos = ServicoProduto::get();

    return $servicos;
  }

  public function find($id)
  {
    $servico = ServicoProduto::with('QualCategoriaDisso')->find($id);

    return $servico;
  }

  public function profServ($id_servprod, $id_profexec)
  {
    $dados = ColaboradorServico::where('id_servprod', '=', $id_servprod)->where('id_profexec', '=', $id_profexec)->first();

    return $dados;
  }

  public function profProd($id_servprod, $id_profexec)
  {
    $dados = ColaboradorServico::where('id_servprod', '=', $id_servprod)->where('id_profexec', '=', $id_profexec)->first();

    return $dados;
  }

  public function produtosDesseFornecedor($id)
  {
    $produtos = ServicoProduto::whereHas('QualPessoaForneceEsseProduto', function ($query) use ($id) {
                    $query->where('atd_pessoas.id', '=', $id);
                })->
                with('QualCategoriaDisso')->
                get();

    return $produtos;
  }

}
