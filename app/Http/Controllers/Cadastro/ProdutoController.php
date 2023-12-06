<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Cadastro\ProdutoValidator;

use App\Models\Cadastro\ServicoProduto;
use App\Models\Catalogo\Categoria;
use App\Models\Configuracao\ColaboradorProduto;

class ProdutoController extends Controller
{
  public function index()
  {
    $produtos = ServicoProduto::where('tipo', 'Produto')->orderBy('nome')->paginate(9999);
    $marcas = ServicoProduto::where('tipo', 'Produto')->select('marca')->distinct()->get();

    return view('sistema.cadastros.produtos.index',[
      'produtos'    => $produtos,
      'marcas'      => $marcas,
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

    return view('sistema.cadastros.produtos.index',[
      'produtos'    => $produtos,
      'marcas'      => $marcas,
      'dataForm'    => $dataForm,
    ]);
  }

  public function create()
  {
    $categorias = Categoria::pluckr('nome', 'id');

    return view('sistema.cadastros.produtos.create', [
      'categorias'    => $categorias,
    ]);
  }
  
  public function triate(ProdutoValidator $request)
  {
    return true;
  }

  public function store(ProdutoValidator $request)
  {
    if($request->json())
    {
      $dados = Produto::store($request);

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
    $produto = ServicoProduto::find($id);

    return view('sistema.cadastros.produtos.show', [
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

  // public function load(Request $request)
  // {
  //   $produtos = ServicoProduto::get();

  //   return $produtos;
  // }

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

  public function produtosDesseFornecedor($id)
  {
    $produtos = ServicoProduto::
                where('tipo', 'Produto')->
                orwhere('tipo', 'Consumo')->
                whereHas('QualPessoaForneceEsseProduto', function ($query) use ($id)
                {
                  $query->where('atd_pessoas.id', '=', $id);
                })->
                with('QualCategoriaDisso')->
                get();

    return $produtos;
  }

  public function load(Request $request)
  {
    $pessoas = Pessoa::
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->iptSearch ) )
                        {
                          $query->
                          orwhere('apelido', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('nome', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('sexo', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('dt_nascimento', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('cpf', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('observacao', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('email', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('facebook', 'LIKE', '%'.$request->iptSearch.'%' )->
                          orwhere('instagram', 'LIKE', '%'.$request->iptSearch.'%' );
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->apelido ) )
                        {
                          $query->where('nome', 'LIKE', '%'.$request->apelido.'%' )->orwhere('apelido', 'LIKE', '%'.$request->apelido.'%' );
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
                      orderBy($request->ordenar_por ?? 'apelido', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

// return $pessoas;
    return view('sistema.atendimentos.pessoas.table', [
     'pessoas'      =>   $pessoas,
   ])->render();
  }
}
