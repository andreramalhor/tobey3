<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Cadastro\ProdutoValidator;

use App\Models\Cadastro\ServicoProduto;
use App\Models\Catalogo\Categoria;
use App\Models\Configuracao\ColaboradorProduto;

class ProdutoConsumoController extends Controller
{
  public function index()
  {
    $produtosconsumo = ServicoProduto::where('tipo', 'Consumo')->orderBy('nome')->paginate(9999);
    $marcas = ServicoProduto::where('tipo', 'Produto de Consumo')->select('marca')->distinct()->get();

    return view('sistema.cadastros.produtosconsumo.index',[
      'produtosconsumo'    => $produtosconsumo,
      'marcas'             => $marcas,
    ]);
  }

  public function filtrar(Request $request)
  {
    $dataForm = $request->except('_token');

    $marcas = ServicoProduto::where('tipo', 'Produto')->select('marca')->distinct()->get();

    $produtos = ServicoProduto::where('tipo', 'Produto')->where(function ($query) use ($dataForm)
    {
      if(isset($dataForm['nome']))
        $query->where('nome', 'LIKE', '%'.$dataForm['nome'].'%');

      if(isset($dataForm['marca']))
      {
        $query->where('marca', 'LIKE', '%'.$dataForm['marca'].'%');
      }
    })
    ->paginate(10);

    return view('sistema.cadastros.produtosconsumo.index',[
      'produtos'    => $produtos,
      'marcas'      => $marcas,
      'dataForm'    => $dataForm,
    ]);
  }

  public function create()
  {
    $categorias = Categoria::pluck('nome', 'id');

    return view('sistema.cadastros.produtosconsumo.create', [
      'categorias'    => $categorias,
    ]);
  }
  
  public function triate(ProdutoValidator $request)
  {
    return true;
  }

  public function store(Request $request)
  {
    $dados = ServicoProduto::create($request->all());
   
    $response = [
      'status'   => true,
      'type'     => 'success',
      'message'  => "Produto de consumo '{$dados->nome}' cadastrado com sucesso.",
      'data'     => $dados,
    ];

    return $response;
  }

  public function show($id)
  {
    $produto = ServicoProduto::find($id);

    return view('sistema.cadastros.produtosconsumo.show', [
     'produto'      =>   $produto,
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
    $produtos = ServicoProduto::get();

    return $produtos;
  }

  public function find($id)
  {
    $produto = ServicoProduto::find($id);

    return $produto;
  }

  public function profProd($id_servprod, $id_profexec)
  {
    $dados = ColaboradorProduto::where('id_servprod', '=', $id_servprod)->where('id_profexec', '=', $id_profexec)->first();

    return $dados;
  }

  public function search(Request $request)
  {
    $dados = ServicoProduto::where('tipo', '=', 'Consumo')->where($request->campo, '=', $request->valor)->get();

    if ( $dados->count() == 1 )
    {
      $response = [
        'status'   => false,
        'type'     => 'danger',
        'message'  => 'Este produto já está cadastrado.',
        'data'     => $dados->toArray(),
      ];

      return $response;
    }
    else
    {
      $response = [
        'status'   => true,
        'type'     => 'success',
        'message'  => 'Novo Produto.',
        'data'     => '',
      ];

      return $response;
    }
  }

  public function produtosDesseFornecedor($id)
  {
    $produtos = ServicoProduto::whereHas('QualPessoaForneceEsseProduto', function ($query) use ($id)
                {
                  $query->where('atd_pessoas.id', '=', $id);
                })->
                with('QualCategoriaDisso')->
                get();

    return $produtos;
  }

}
