<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServprodRequest;
use Image;
use File;

use App\Models\Cadastro\Categoria;
use App\Models\Cadastro\ServicoProduto;
use App\Models\pivots\ColaboradorServico;

class CatalogoController extends Controller
{
  public function categorias()
  {
    return view('sistema.catalogo.categorias.index');
  }

  public function categorias_tabelar()
  {
    $categorias = Categoria::withTrashed()->get();

    return view('sistema.catalogo.categorias.tabelar', [
      'categorias' => $categorias,
    ]);
  }

  public function categorias_mostrar($id)
  {
    $categoria = Categoria::find($id);

    return view('sistema.catalogo.categorias.mostrar', [
      'categoria' => $categoria,
    ]);
  }

  public function categorias_adicionar()
  {
    return view('sistema.catalogo.categorias.adicionar');
  }

  public function categorias_gravar(Request $request)
  {
    $categoria = Categoria::create($request->all());

    return view('sistema.catalogo.categorias.index');
  }

  public function categorias_editar($id)
  {
    $categoria = Categoria::find($id);

    return view('sistema.catalogo.categorias.editar', [
      'categoria' => $categoria,
    ]);
  }

  public function categorias_excluir(Request $request, $id)
  {
    $categoria = Categoria::find($id);

    $categoria->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $categoria->toArray(),
    ];

    return view('sistema.catalogo.categorias.index')->with($response);
  }

  public function categorias_atualizar(Request $request, $id)
  {
    $categoria  = Categoria::find($id);
    $categoria  = $categoria->update($request->all());
    $atualizado = Categoria::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return view('sistema.catalogo.categorias.index')->with($response);
  }

  public function categorias_produtos($id)
  {
    $produtos = ServicoProduto::
                            where('tipo', '=', 'Produto')->
                            where('id_categoria', '=', $id)->
                            // with(['aldkekciajsgqwp' => function ($query)
                            // {
                            //   $query->select('id', 'id_fornecedor')->with(['ysfyhzfsfarfdha']);
                            // }])->
                            paginate(10);
  
    return $produtos;
  //   $categoria    = Categoria::find($id);

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $categoria->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $categoria->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];
    
  //   return $response;
  }


  public function categorias_produtos_tabelar($id)
  {
    $categoria = Categoria::
                              // where('tipo', '=', 'Produto')->
                              find($id);

    return view('sistema.catalogo.categorias.auxiliares.tab_categorias_produtos', [
      'produtos' => $categoria->PZGY650RMFKJ9W7,
    ]);
  }

  public function categorias_servicos($id)
  {
    $servicos = ServicoProduto::
                            where('tipo', '=', 'Serviço')->
                            where('id_categoria', '=', $id)->
                            // with(['aldkekciajsgqwp' => function ($query)
                            // {
                            //   $query->select('id', 'id_fornecedor')->with(['ysfyhzfsfarfdha']);
                            // }])->
                            paginate(10);
  
    return $servicos;
  }

  public function categorias_servicos_tabelar($id)
  {
    $categoria    = Categoria::
                              // where('tipo', '=', 'Serviço')->
                              find($id);

    return view('sistema.catalogo.categorias.auxiliares.tab_categorias_servicos', [
      'servicos' => $categoria->LZS394PQT9KN8UZ,
    ]);
  }

  public function categorias_consumos_tabelar($id)
  {
    $categoria    = Categoria::
                              // where('tipo', '=', 'Consumo')->
                              find($id);

    return view('sistema.catalogo.categorias.auxiliares.tab_categorias_consumos', [
      'consumos' => $categoria->Y6VUVJ8QLZOSW1G,
    ]);
  }

  public function categorias_produtos_incluir(Request $request, $id)
  {
    $categoria    = Categoria::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $categoria->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $categoria->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }

  public function categorias_produtos_adicionar(Request $request, $id)
  {
    $produto   = ServicoProduto::withTrashed()->find($request[0]['id_servprod']);
    $produto->id_categoria = $id;
    $produto->update();

    $response = [
        'type'    => 'success',
        'message' => "Incluído com sucesso.",
    ];
    
    return $response;
  }

  public function categorias_produtos_remover(Request $request, $id)
  {
    $produto = ServicoProduto::withTrashed()->find($request[0]['id_servprod']);
    $produto->id_categoria = null;
    $produto->update();

    $response = [
        'type'    => 'success',
        'message' => "Removido com sucesso.",
    ];
    
    return $response;
  }

  public function categorias_plucar()
  {
    $plucar = Categoria::pluck('nome', 'id');
    
    return $plucar;
  }
  
// PRODUTOS =======================================================================================================================================================================
  public function servprod($tipo)
  {
    return view('sistema.catalogo.servprod.index', [
      'tipo' => $tipo,
    ]);
  }

  public function servprod_tabelar($tipo, Request $request)
  {
    $servsprods = ServicoProduto::
                            where('tipo', '=', $tipo == 'produtos' ? 'Produto': 'Serviço')->
                            where( function ($query) use ($request)
                          {
                            if ( isset( $request->pesquisa ) )
                            {
                              $query->
                              orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                              orwhere('id_categoria', 'LIKE', '%'.$request->pesquisa.'%' )->
                              orwhere('marca', 'LIKE', '%'.$request->pesquisa.'%' );
                            }
                          })->
                          where( function ($query) use ($request)
                          {
                            if ( isset( $request->nome ) )
                            {
                              $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
                            }
                            if ( isset( $request->id_categoria ) )
                            {
                              $query->where('id_categoria', 'LIKE', '%'.$request->id_categoria.'%' );
                            }
                            if ( isset( $request->marca ) )
                            {
                              $query->where('marca', 'LIKE', '%'.$request->marca.'%' );
                            }
                            if ( isset( $request->deleted_at ) )
                            {
                              $query->whereNotNull('deleted_at');
                            }
                          })->
                          orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                          orderBy('id_categoria', 'asc')->
                          orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
                          withTrashed()->
                          paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                          appends($request->all());

    return view('sistema.catalogo.servprod.tabelar', [
      'tipo'         => $tipo,
      'servsprods'  => $servsprods,
      'request'      => $request->all(),
    ]);
  }

  public function servprod_mostrar($tipo, $id)
  {
    $servprod = ServicoProduto::find($id);

    return view('sistema.catalogo.servprod.mostrar', [
      'tipo'       => $tipo,
      'servprod'  => $servprod,
    ]);
  }

  public function servprod_adicionar($tipo)
  {
    return view('sistema.catalogo.servprod.adicionar', [
      'tipo' => $tipo,
    ]);
  }

  public function servprod_gravar($tipo, Request $request)
  {
    try
    {
      $servprod = ServicoProduto::create($request->all());
      
      if( $request->imagem_temp != null )
      {
        // SALVAR FOTO DA IMAGEM DO PRODUTO
        $nome         = $servprod->id;
        $extensao     = 'png';
        $nameFile     = "{$nome}.{$extensao}";
        $arquivo_foto = "img/catalogo/servsprods/".$nameFile;
        
        File::move(public_path($request->imagem_temp), public_path($arquivo_foto));
      }
      

      $response = [
        'type'     => 'success',
        'message'  => "Produto '$servprod->nome' cadastrado com sucesso.",
        'data'     => $servprod->toArray(),
        'redirect' => route('cat.servprod', $tipo),
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
  }    
  
  public function servprod_validar(ServprodRequest $request)
  {
    $servprod = ServicoProduto::create($request->all());

    $response = [
      'type'    => 'success',
      'message' => $servprod->tipo." criado com sucesso.",
      'data'    => $servprod->toArray(),
      'redirect' => route('cat.servprod', $servprod->link_tipo),
    ];
    
    return $response;
  }
  
  public function servprod_avatar(Request $request)
  {
    if ($request->hasFile('image') && $request->file('image')->isValid())
    {
      $this->validate($request, ['image' => 'required|file|image|mimes:jpeg,png,gif,svg,webp']);

      $image     = $request->file('image');
      $extension = $image->extension();
      $nome      = time().'.'.$image->extension();
      $filePath  = public_path('/img/catalogo/servsprods/temp');

      $img = Image::make($image->path());
      $img->resize(250, 250);
      $img->encode('png', 75);
      $img->save($filePath.'/'.$nome);

      $temp_endereco = '/img/catalogo/servsprods/temp'.'/'.$nome;

      return $temp_endereco;
    }
  }

  public function servprod_avatar_remove(Request $request)
  {
    File::delete(public_path($request->temp_foto));

    return true;
  }

  public function servprod_editar($tipo, $id)
  {
    $servprod = ServicoProduto::withTrashed()->find($id);

    return view('sistema.catalogo.servprod.editar', [
      'tipo'       => $tipo,
      'servprod'  => $servprod,
    ]);
  }

  public function servprod_excluir(Request $request, $tipo, $id)
  {
    $servprod = ServicoProduto::find($id);
    $servprod->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $servprod->toArray(),
    ];

    return $response;
  }

  public function servprod_restaurar($tipo, $id)
  {
    $servprod = ServicoProduto::withTrashed()->find($id);
    $servprod->restore();

    $response = [
      'type'    => 'success',
      'message' => "Restaurado com sucesso.",
      'data'    => $servprod->toArray(),
    ];

    return $response;
  }

  public function servprod_procurar($id)
  {
    $servprod = ServicoProduto::with('aksjaldjfwjlwfp')->find($id);

    return $servprod;  
  }

  public function produtos_listar()
  {
    $produtos = ServicoProduto::get();
    
    return $produtos;
  }

  public function produtos_plucar(Request $request)
  {
    $produtos = ServicoProduto::
      where('tipo', '=', 'Produto' )->
      where( function ($query) use ($request)
      {
        if ( isset( $request->ativo ) )
        {
          $query->where('ativo', 'LIKE', '%'.$request->ativo.'%' );
        }
        if ( isset( $request->nome ) )
        {
          $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
        }
        if ( isset( $request->id_categoria ) )
        {
          $query->where('id_categoria', 'LIKE', '%'.$request->id_categoria.'%' );
        }
        if ( isset( $request->tipo_preco ) )
        {
          $query->where('tipo_preco', 'LIKE', '%'.$request->tipo_preco.'%' );
        }
        if ( isset( $request->vlr_venda ) )
        {
          $query->where('vlr_venda', 'LIKE', '%'.$request->vlr_venda.'%' );
        }
        if ( isset( $request->vlr_cst_adicional ) )
        {
          $query->where('vlr_cst_adicional', 'LIKE', '%'.$request->vlr_cst_adicional.'%' );
        }
        if ( isset( $request->prc_comissao ) )
        {
          $query->where('prc_comissao', 'LIKE', '%'.$request->prc_comissao.'%' );
        }
        if ( isset( $request->tempo_retorno ) )
        {
          $query->where('tempo_retorno', 'LIKE', '%'.$request->tempo_retorno.'%' );
        }
        if ( isset( $request->duracao ) )
        {
          $query->where('duracao', 'LIKE', '%'.$request->duracao.'%' );
        }
        if ( isset( $request->fidelidade_pontos_ganhos ) )
        {
          $query->where('fidelidade_pontos_ganhos', 'LIKE', '%'.$request->fidelidade_pontos_ganhos.'%' );
        }
        if ( isset( $request->fidelidade_pontos_necessarios ) )
        {
          $query->where('fidelidade_pontos_necessarios', 'LIKE', '%'.$request->fidelidade_pontos_necessarios.'%' );
        }
        if ( isset( $request->unidade ) )
        {
          $query->where('unidade', 'LIKE', '%'.$request->unidade.'%' );
        }
        if ( isset( $request->marca ) )
        {
          $query->where('marca', 'LIKE', '%'.$request->marca.'%' );
        }
        if ( isset( $request->cod_nota ) )
        {
          $query->where('cod_nota', 'LIKE', '%'.$request->cod_nota.'%' );
        }
        if ( isset( $request->cod_barras ) )
        {
          $query->where('cod_barras', 'LIKE', '%'.$request->cod_barras.'%' );
        }
        if ( isset( $request->estoque_min ) )
        {
          $query->where('estoque_min', 'LIKE', '%'.$request->estoque_min.'%' );
        }
        if ( isset( $request->estoque_max ) )
        {
          $query->where('estoque_max', 'LIKE', '%'.$request->estoque_max.'%' );
        }
        if ( isset( $request->ncm_prod_serv ) )
        {
          $query->where('ncm_prod_serv', 'LIKE', '%'.$request->ncm_prod_serv.'%' );
        }
        if ( isset( $request->ipi_prod_serv ) )
        {
          $query->where('ipi_prod_serv', 'LIKE', '%'.$request->ipi_prod_serv.'%' );
        }
        if ( isset( $request->icms_prod_serv ) )
        {
          $query->where('icms_prod_serv', 'LIKE', '%'.$request->icms_prod_serv.'%' );
        }
        if ( isset( $request->simples_prod_serv ) )
        {
          $query->where('simples_prod_serv', 'LIKE', '%'.$request->simples_prod_serv.'%' );
        }
        if ( isset( $request->vlr_mercado ) )
        {
          $query->where('vlr_mercado', 'LIKE', '%'.$request->vlr_mercado.'%' );
        }
        if ( isset( $request->vlr_nota ) )
        {
          $query->where('vlr_nota', 'LIKE', '%'.$request->vlr_nota.'%' );
        }
        if ( isset( $request->vlr_frete ) )
        {
          $query->where('vlr_frete', 'LIKE', '%'.$request->vlr_frete.'%' );
        }
        if ( isset( $request->vlr_comissao ) )
        {
          $query->where('vlr_comissao', 'LIKE', '%'.$request->vlr_comissao.'%' );
        }
        if ( isset( $request->vlr_marg_contribuicao ) )
        {
          $query->where('vlr_marg_contribuicao', 'LIKE', '%'.$request->vlr_marg_contribuicao.'%' );
        }
        if ( isset( $request->marg_contribuicao ) )
        {
          $query->where('marg_contribuicao', 'LIKE', '%'.$request->marg_contribuicao.'%' );
        }
        if ( isset( $request->vlr_custo ) )
        {
          $query->where('vlr_custo', 'LIKE', '%'.$request->vlr_custo.'%' );
        }
        if ( isset( $request->vlr_custo_estoque ) )
        {
          $query->where('vlr_custo_estoque', 'LIKE', '%'.$request->vlr_custo_estoque.'%' );
        }
        if ( isset( $request->margem_custo ) )
        {
          $query->where('margem_custo', 'LIKE', '%'.$request->margem_custo.'%' );
        }
        if ( isset( $request->consumo_medio ) )
        {
          $query->where('consumo_medio', 'LIKE', '%'.$request->consumo_medio.'%' );
        }
        if ( isset( $request->cmv_prod_serv ) )
        {
          $query->where('cmv_prod_serv', 'LIKE', '%'.$request->cmv_prod_serv.'%' );
        }
        if ( isset( $request->curva_abc ) )
        {
          $query->where('curva_abc', 'LIKE', '%'.$request->curva_abc.'%' );
        }
        if ( isset( $request->id_fornecedor ) )
        {
          $query->where('id_fornecedor', 'LIKE', '%'.$request->id_fornecedor.'%' );
        }
        if ( isset( $request->descricao ) )
        {
          $query->where('descricao', 'LIKE', '%'.$request->descricao.'%' );
        }
        if ( isset( $request->status ) )
        {
          $query->where('status', 'LIKE', '%'.$request->status.'%' );
        }
      })->
      pluck('id', 'nome');
    
    return $produtos;
  }

  public function produtos_paginar(Request $request)
  {
    $produtos = ServicoProduto::
      where('tipo', '=', 'Produto' )->
      where( function ($query) use ($request)
      {
        if ( isset( $request->ativo ) )
        {
          $query->where('ativo', 'LIKE', '%'.$request->ativo.'%' );
        }
        if ( isset( $request->nome ) )
        {
          $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
        }
        if ( isset( $request->id_categoria ) )
        {
          $query->where('id_categoria', 'LIKE', '%'.$request->id_categoria.'%' );
        }
        if ( isset( $request->tipo_preco ) )
        {
          $query->where('tipo_preco', 'LIKE', '%'.$request->tipo_preco.'%' );
        }
        if ( isset( $request->vlr_venda ) )
        {
          $query->where('vlr_venda', 'LIKE', '%'.$request->vlr_venda.'%' );
        }
        if ( isset( $request->vlr_cst_adicional ) )
        {
          $query->where('vlr_cst_adicional', 'LIKE', '%'.$request->vlr_cst_adicional.'%' );
        }
        if ( isset( $request->prc_comissao ) )
        {
          $query->where('prc_comissao', 'LIKE', '%'.$request->prc_comissao.'%' );
        }
        if ( isset( $request->tempo_retorno ) )
        {
          $query->where('tempo_retorno', 'LIKE', '%'.$request->tempo_retorno.'%' );
        }
        if ( isset( $request->duracao ) )
        {
          $query->where('duracao', 'LIKE', '%'.$request->duracao.'%' );
        }
        if ( isset( $request->fidelidade_pontos_ganhos ) )
        {
          $query->where('fidelidade_pontos_ganhos', 'LIKE', '%'.$request->fidelidade_pontos_ganhos.'%' );
        }
        if ( isset( $request->fidelidade_pontos_necessarios ) )
        {
          $query->where('fidelidade_pontos_necessarios', 'LIKE', '%'.$request->fidelidade_pontos_necessarios.'%' );
        }
        if ( isset( $request->unidade ) )
        {
          $query->where('unidade', 'LIKE', '%'.$request->unidade.'%' );
        }
        if ( isset( $request->marca ) )
        {
          $query->where('marca', 'LIKE', '%'.$request->marca.'%' );
        }
        if ( isset( $request->cod_nota ) )
        {
          $query->where('cod_nota', 'LIKE', '%'.$request->cod_nota.'%' );
        }
        if ( isset( $request->cod_barras ) )
        {
          $query->where('cod_barras', 'LIKE', '%'.$request->cod_barras.'%' );
        }
        if ( isset( $request->estoque_min ) )
        {
          $query->where('estoque_min', 'LIKE', '%'.$request->estoque_min.'%' );
        }
        if ( isset( $request->estoque_max ) )
        {
          $query->where('estoque_max', 'LIKE', '%'.$request->estoque_max.'%' );
        }
        if ( isset( $request->ncm_prod_serv ) )
        {
          $query->where('ncm_prod_serv', 'LIKE', '%'.$request->ncm_prod_serv.'%' );
        }
        if ( isset( $request->ipi_prod_serv ) )
        {
          $query->where('ipi_prod_serv', 'LIKE', '%'.$request->ipi_prod_serv.'%' );
        }
        if ( isset( $request->icms_prod_serv ) )
        {
          $query->where('icms_prod_serv', 'LIKE', '%'.$request->icms_prod_serv.'%' );
        }
        if ( isset( $request->simples_prod_serv ) )
        {
          $query->where('simples_prod_serv', 'LIKE', '%'.$request->simples_prod_serv.'%' );
        }
        if ( isset( $request->vlr_mercado ) )
        {
          $query->where('vlr_mercado', 'LIKE', '%'.$request->vlr_mercado.'%' );
        }
        if ( isset( $request->vlr_nota ) )
        {
          $query->where('vlr_nota', 'LIKE', '%'.$request->vlr_nota.'%' );
        }
        if ( isset( $request->vlr_frete ) )
        {
          $query->where('vlr_frete', 'LIKE', '%'.$request->vlr_frete.'%' );
        }
        if ( isset( $request->vlr_comissao ) )
        {
          $query->where('vlr_comissao', 'LIKE', '%'.$request->vlr_comissao.'%' );
        }
        if ( isset( $request->vlr_marg_contribuicao ) )
        {
          $query->where('vlr_marg_contribuicao', 'LIKE', '%'.$request->vlr_marg_contribuicao.'%' );
        }
        if ( isset( $request->marg_contribuicao ) )
        {
          $query->where('marg_contribuicao', 'LIKE', '%'.$request->marg_contribuicao.'%' );
        }
        if ( isset( $request->vlr_custo ) )
        {
          $query->where('vlr_custo', 'LIKE', '%'.$request->vlr_custo.'%' );
        }
        if ( isset( $request->vlr_custo_estoque ) )
        {
          $query->where('vlr_custo_estoque', 'LIKE', '%'.$request->vlr_custo_estoque.'%' );
        }
        if ( isset( $request->margem_custo ) )
        {
          $query->where('margem_custo', 'LIKE', '%'.$request->margem_custo.'%' );
        }
        if ( isset( $request->consumo_medio ) )
        {
          $query->where('consumo_medio', 'LIKE', '%'.$request->consumo_medio.'%' );
        }
        if ( isset( $request->cmv_prod_serv ) )
        {
          $query->where('cmv_prod_serv', 'LIKE', '%'.$request->cmv_prod_serv.'%' );
        }
        if ( isset( $request->curva_abc ) )
        {
          $query->where('curva_abc', 'LIKE', '%'.$request->curva_abc.'%' );
        }
        if ( isset( $request->id_fornecedor ) )
        {
          $query->where('id_fornecedor', 'LIKE', '%'.$request->id_fornecedor.'%' );
        }
        if ( isset( $request->descricao ) )
        {
          $query->where('descricao', 'LIKE', '%'.$request->descricao.'%' );
        }
        if ( isset( $request->status ) )
        {
          $query->where('status', 'LIKE', '%'.$request->status.'%' );
        }
      })->
      with('smenhgskqwmdjwe', 'ecgklyqfdcoguyj')->
      orderBy($request->ordenar_por ?? 'id', $request->ordem ?? 'ASC')->
      paginate($request->per_page == 'all' ? 15 : $request->per_page);
      // // orderByRaw('-deleted_at DESC')->
      // // orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
      // withTrashed()->
      // // appends($request->all());

    return $produtos;
  }
  
  public function produtos_excluir_dependentes($id)
  {
    $produto = ServicoProduto::find($id);
    // $produto = ServicoProduto::onlyTrashed()->find($id);
    $produto->restore();

    $response = [
        'type'    => 'success',
        'message' => "Restaurado com sucesso.",
        'data'    => $produto->toArray(),
    ];

    return $response;
  }

  public function servprod_atualizar(Request $request, $tipo, $id)
  {
    try
    {
      if(isset($request[0]))
      {
        $atualizacoes = $request[0];
      }
      else
      {
        $atualizacoes = $request->all();
      }
      
      $servprod    = ServicoProduto::withTrashed()->find($id);
      $servprod    = $servprod->update($atualizacoes);
      $atualizado = ServicoProduto::withTrashed()->find($id);

      if( $request->imagem_temp != null )
      {
        // SALVAR FOTO DA IMAGEM DO PRODUTO
        $nome         = $atualizado->id;
        $extensao     = 'png';
        $nameFile     = "{$nome}.{$extensao}";
        $arquivo_foto = "img/catalogo/servsprods/".$nameFile;
        
        File::move(public_path($request->imagem_temp), public_path($arquivo_foto));
      }
      
      $response = [
        'type'     => 'success',
        'message'  => "Produto '$atualizado->nome' cadastrado com sucesso.",
        'data'     => $atualizado->toArray(),
        'redirect' => route('cat.servprod', $tipo),
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
  }

  public function produtos_permissoes(Request $request, $id)
  {
    $produto    = ServicoProduto::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $produto->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $produto->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }


  public function produtos_usuarios_tabelar($id)
  {
    $produto    = ServicoProduto::find($id);

    return view('sistema.catalogo.servprod.auxiliares.tab_produtos_usuarios', [
      'usuarios' => $produto->znufwevbqgruklz,
    ]);
  }

  public function produtos_usuarios_incluir(Request $request, $id)
  {
    $produto    = ServicoProduto::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $produto->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $produto->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }

  public function produtos_usuarios_adicionar(Request $request, $id)
  {
    $produto  = ServicoProduto::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $produto->znufwevbqgruklz()->syncWithoutDetaching($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Incluído com sucesso.",
    ];
    
    return $response;
  }

  public function produtos_usuarios_remover(Request $request, $id)
  {
    $produto  = ServicoProduto::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $produto->znufwevbqgruklz()->detach($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Removido com sucesso.",
    ];
    
    return $response;
  }

  public function produtos_listar_compras()
  {
    $produtos = ServicoProduto::
                            where('tipo', '=', 'Produto')->
                            // limit(5)->
                            get();

    return view('sistema.financeiro.compras.auxiliares.inc_produtos', [
      'produtos' => $produtos,
    ]);
  }

  public function produtos_pesquisar($id)
  {
    $produto  = ServicoProduto::find($id);

    return $produto;
  }

// SERVIÇOS =======================================================================================================================================================================
  public function servicos()
  {
    return view('sistema.catalogo.servicos.index');
  }

  public function servicos_tabelar(Request $request)
  {
    $servicos = ServicoProduto::
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          orwhere('tipo', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('id_categoria', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('marca', 'LIKE', '%'.$request->pesquisa.'%' );
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->tipo ) )
                        {
                          $query->where('tipo', 'LIKE', '%'.$request->tipo.'%' );
                        }
                        if ( isset( $request->nome ) )
                        {
                          $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
                        }
                        if ( isset( $request->id_categoria ) )
                        {
                          $query->where('id_categoria', 'LIKE', '%'.$request->id_categoria.'%' );
                        }
                        if ( isset( $request->marca ) )
                        {
                          $query->where('marca', 'LIKE', '%'.$request->marca.'%' );
                        }
                        if ( isset( $request->deleted_at ) )
                        {
                          $query->whereNotNull('deleted_at');
                        }
                      })->
                      where('tipo', '=', 'Serviço')->
                      orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                      orderBy('id_categoria', 'asc')->
                      orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    return view('sistema.catalogo.servicos.tabelar', [
      'servicos' => $servicos,
      'request'  => $request->all(),
    ]);
  }

  public function servicos_mostrar($id)
  {
    dd(1212121);
    $servico = ServicoProduto::find($id);

    return view('sistema.catalogo.servicos.mostrar', [
      'servico' => $servico,
    ]);
  }

  public function servicos_adicionar()
  {
    return view('sistema.catalogo.servicos.adicionar');
  }

  public function servicos_gravar(Request $request)
  {
    $servico = ServicoProduto::create($request->all());

    return view('sistema.catalogo.servicos.index');
  }

  public function servicos_editar($id)
  {
    dd('s');
    $servico = ServicoProduto::find($id);

    return view('sistema.catalogo.servicos.editar', [
      'servico' => $servico,
    ]);
  }

  public function servicos_excluir(Request $request, $id)
  {
    $servico = ServicoProduto::find($id);

    // $deleta_pivot_permissoes = $servico->PVRBIUSBYF()->delete();
    $deleta_pivot_usuarios   = $servico->smenhgskqwmdjwe()->delete();
    
    $servico->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $servico->toArray(),
    ];

    return $response;
  }

  public function servicos_restaurar($id)
  {
    return 'servicos_restaurar';
  }

  public function servicos_listar()
  {
    $servicos = ServicoProduto::get();

    return $servicos;
  }

  public function servicos_plucar(Request $request)
  {
    $servicos = ServicoProduto::
      where('tipo', '=', 'Serviço' )->
      where( function ($query) use ($request)
      {
        if ( isset( $request->ativo ) )
        {
          $query->where('ativo', isset($request->Xativo) ? $request->Xativo : '=' , $request->ativo );
        }
        if ( isset( $request->nome ) )
        {
          $query->where('nome', isset($request->Xnome) ? $request->Xnome : '=' , $request->nome );
        }
        if ( isset( $request->id_categoria ) )
        {
          $query->where('id_categoria', isset($request->Xid_categoria) ? $request->Xid_categoria : '=' , $request->id_categoria );
        }
        if ( isset( $request->tipo_preco ) )
        {
          $query->where('tipo_preco', isset($request->Xtipo_preco) ? $request->Xtipo_preco : '=' , $request->tipo_preco );
        }
        if ( isset( $request->vlr_venda ) )
        {
          $query->where('vlr_venda', isset($request->Xvlr_venda) ? $request->Xvlr_venda : '=' , $request->vlr_venda );
        }
        if ( isset( $request->vlr_cst_adicional ) )
        {
          $query->where('vlr_cst_adicional', isset($request->Xvlr_cst_adicional) ? $request->Xvlr_cst_adicional : '=' , $request->vlr_cst_adicional );
        }
        if ( isset( $request->prc_comissao ) )
        {
          $query->where('prc_comissao', isset($request->Xprc_comissao) ? $request->Xprc_comissao : '=' , $request->prc_comissao );
        }
        if ( isset( $request->tempo_retorno ) )
        {
          $query->where('tempo_retorno', isset($request->Xtempo_retorno) ? $request->Xtempo_retorno : '=' , $request->tempo_retorno );
        }
        if ( isset( $request->duracao ) )
        {
          $query->where('duracao', isset($request->Xduracao) ? $request->Xduracao : '=' , $request->duracao );
        }
        if ( isset( $request->fidelidade_pontos_ganhos ) )
        {
          $query->where('fidelidade_pontos_ganhos', isset($request->Xfidelidade_pontos_ganhos) ? $request->Xfidelidade_pontos_ganhos : '=' , $request->fidelidade_pontos_ganhos );
        }
        if ( isset( $request->fidelidade_pontos_necessarios ) )
        {
          $query->where('fidelidade_pontos_necessarios', isset($request->Xfidelidade_pontos_necessarios) ? $request->Xfidelidade_pontos_necessarios : '=' , $request->fidelidade_pontos_necessarios );
        }
        if ( isset( $request->unidade ) )
        {
          $query->where('unidade', isset($request->Xunidade) ? $request->Xunidade : '=' , $request->unidade );
        }
        if ( isset( $request->marca ) )
        {
          $query->where('marca', isset($request->Xmarca) ? $request->Xmarca : '=' , $request->marca );
        }
        if ( isset( $request->cod_nota ) )
        {
          $query->where('cod_nota', isset($request->Xcod_nota) ? $request->Xcod_nota : '=' , $request->cod_nota );
        }
        if ( isset( $request->cod_barras ) )
        {
          $query->where('cod_barras', isset($request->Xcod_barras) ? $request->Xcod_barras : '=' , $request->cod_barras );
        }
        if ( isset( $request->estoque_min ) )
        {
          $query->where('estoque_min', isset($request->Xestoque_min) ? $request->Xestoque_min : '=' , $request->estoque_min );
        }
        if ( isset( $request->estoque_max ) )
        {
          $query->where('estoque_max', isset($request->Xestoque_max) ? $request->Xestoque_max : '=' , $request->estoque_max );
        }
        if ( isset( $request->ncm_prod_serv ) )
        {
          $query->where('ncm_prod_serv', isset($request->Xncm_prod_serv) ? $request->Xncm_prod_serv : '=' , $request->ncm_prod_serv );
        }
        if ( isset( $request->ipi_prod_serv ) )
        {
          $query->where('ipi_prod_serv', isset($request->Xipi_prod_serv) ? $request->Xipi_prod_serv : '=' , $request->ipi_prod_serv );
        }
        if ( isset( $request->icms_prod_serv ) )
        {
          $query->where('icms_prod_serv', isset($request->Xicms_prod_serv) ? $request->Xicms_prod_serv : '=' , $request->icms_prod_serv );
        }
        if ( isset( $request->simples_prod_serv ) )
        {
          $query->where('simples_prod_serv', isset($request->Xsimples_prod_serv) ? $request->Xsimples_prod_serv : '=' , $request->simples_prod_serv );
        }
        if ( isset( $request->vlr_mercado ) )
        {
          $query->where('vlr_mercado', isset($request->Xvlr_mercado) ? $request->Xvlr_mercado : '=' , $request->vlr_mercado );
        }
        if ( isset( $request->vlr_nota ) )
        {
          $query->where('vlr_nota', isset($request->Xvlr_nota) ? $request->Xvlr_nota : '=' , $request->vlr_nota );
        }
        if ( isset( $request->vlr_frete ) )
        {
          $query->where('vlr_frete', isset($request->Xvlr_frete) ? $request->Xvlr_frete : '=' , $request->vlr_frete );
        }
        if ( isset( $request->vlr_comissao ) )
        {
          $query->where('vlr_comissao', isset($request->Xvlr_comissao) ? $request->Xvlr_comissao : '=' , $request->vlr_comissao );
        }
        if ( isset( $request->vlr_marg_contribuicao ) )
        {
          $query->where('vlr_marg_contribuicao', isset($request->Xvlr_marg_contribuicao) ? $request->Xvlr_marg_contribuicao : '=' , $request->vlr_marg_contribuicao );
        }
        if ( isset( $request->marg_contribuicao ) )
        {
          $query->where('marg_contribuicao', isset($request->Xmarg_contribuicao) ? $request->Xmarg_contribuicao : '=' , $request->marg_contribuicao );
        }
        if ( isset( $request->vlr_custo ) )
        {
          $query->where('vlr_custo', isset($request->Xvlr_custo) ? $request->Xvlr_custo : '=' , $request->vlr_custo );
        }
        if ( isset( $request->vlr_custo_estoque ) )
        {
          $query->where('vlr_custo_estoque', isset($request->Xvlr_custo_estoque) ? $request->Xvlr_custo_estoque : '=' , $request->vlr_custo_estoque );
        }
        if ( isset( $request->margem_custo ) )
        {
          $query->where('margem_custo', isset($request->Xmargem_custo) ? $request->Xmargem_custo : '=' , $request->margem_custo );
        }
        if ( isset( $request->consumo_medio ) )
        {
          $query->where('consumo_medio', isset($request->Xconsumo_medio) ? $request->Xconsumo_medio : '=' , $request->consumo_medio );
        }
        if ( isset( $request->cmv_prod_serv ) )
        {
          $query->where('cmv_prod_serv', isset($request->Xcmv_prod_serv) ? $request->Xcmv_prod_serv : '=' , $request->cmv_prod_serv );
        }
        if ( isset( $request->curva_abc ) )
        {
          $query->where('curva_abc', isset($request->Xcurva_abc) ? $request->Xcurva_abc : '=' , $request->curva_abc );
        }
        if ( isset( $request->id_fornecedor ) )
        {
          $query->where('id_fornecedor', isset($request->Xid_fornecedor) ? $request->Xid_fornecedor : '=' , $request->id_fornecedor );
        }
        if ( isset( $request->descricao ) )
        {
          $query->where('descricao', isset($request->Xdescricao) ? $request->Xdescricao : '=' , $request->descricao );
        }
        if ( isset( $request->status ) )
        {
          $query->where('status', isset($request->Xstatus) ? $request->Xstatus : '=' , $request->status );
        }
      })->
      pluck('id', 'nome');
    
    return $servicos;
  }

  public function servicos_paginar(Request $request)
  {
    $servicos = ServicoProduto::
      where('tipo', '=', 'Serviço' )->
      where( function ($query) use ($request)
      {
        if ( isset( $request->ativo ) )
        {
          $query->where('ativo', 'LIKE', '%'.$request->ativo.'%' );
        }
        if ( isset( $request->nome ) )
        {
          $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
        }
        if ( isset( $request->id_categoria ) )
        {
          $query->where('id_categoria', 'LIKE', '%'.$request->id_categoria.'%' );
        }
        if ( isset( $request->tipo_preco ) )
        {
          $query->where('tipo_preco', 'LIKE', '%'.$request->tipo_preco.'%' );
        }
        if ( isset( $request->vlr_venda ) )
        {
          $query->where('vlr_venda', 'LIKE', '%'.$request->vlr_venda.'%' );
        }
        if ( isset( $request->vlr_cst_adicional ) )
        {
          $query->where('vlr_cst_adicional', 'LIKE', '%'.$request->vlr_cst_adicional.'%' );
        }
        if ( isset( $request->prc_comissao ) )
        {
          $query->where('prc_comissao', 'LIKE', '%'.$request->prc_comissao.'%' );
        }
        if ( isset( $request->tempo_retorno ) )
        {
          $query->where('tempo_retorno', 'LIKE', '%'.$request->tempo_retorno.'%' );
        }
        if ( isset( $request->duracao ) )
        {
          $query->where('duracao', 'LIKE', '%'.$request->duracao.'%' );
        }
        if ( isset( $request->fidelidade_pontos_ganhos ) )
        {
          $query->where('fidelidade_pontos_ganhos', 'LIKE', '%'.$request->fidelidade_pontos_ganhos.'%' );
        }
        if ( isset( $request->fidelidade_pontos_necessarios ) )
        {
          $query->where('fidelidade_pontos_necessarios', 'LIKE', '%'.$request->fidelidade_pontos_necessarios.'%' );
        }
        if ( isset( $request->unidade ) )
        {
          $query->where('unidade', 'LIKE', '%'.$request->unidade.'%' );
        }
        if ( isset( $request->marca ) )
        {
          $query->where('marca', 'LIKE', '%'.$request->marca.'%' );
        }
        if ( isset( $request->cod_nota ) )
        {
          $query->where('cod_nota', 'LIKE', '%'.$request->cod_nota.'%' );
        }
        if ( isset( $request->cod_barras ) )
        {
          $query->where('cod_barras', 'LIKE', '%'.$request->cod_barras.'%' );
        }
        if ( isset( $request->estoque_min ) )
        {
          $query->where('estoque_min', 'LIKE', '%'.$request->estoque_min.'%' );
        }
        if ( isset( $request->estoque_max ) )
        {
          $query->where('estoque_max', 'LIKE', '%'.$request->estoque_max.'%' );
        }
        if ( isset( $request->ncm_prod_serv ) )
        {
          $query->where('ncm_prod_serv', 'LIKE', '%'.$request->ncm_prod_serv.'%' );
        }
        if ( isset( $request->ipi_prod_serv ) )
        {
          $query->where('ipi_prod_serv', 'LIKE', '%'.$request->ipi_prod_serv.'%' );
        }
        if ( isset( $request->icms_prod_serv ) )
        {
          $query->where('icms_prod_serv', 'LIKE', '%'.$request->icms_prod_serv.'%' );
        }
        if ( isset( $request->simples_prod_serv ) )
        {
          $query->where('simples_prod_serv', 'LIKE', '%'.$request->simples_prod_serv.'%' );
        }
        if ( isset( $request->vlr_mercado ) )
        {
          $query->where('vlr_mercado', 'LIKE', '%'.$request->vlr_mercado.'%' );
        }
        if ( isset( $request->vlr_nota ) )
        {
          $query->where('vlr_nota', 'LIKE', '%'.$request->vlr_nota.'%' );
        }
        if ( isset( $request->vlr_frete ) )
        {
          $query->where('vlr_frete', 'LIKE', '%'.$request->vlr_frete.'%' );
        }
        if ( isset( $request->vlr_comissao ) )
        {
          $query->where('vlr_comissao', 'LIKE', '%'.$request->vlr_comissao.'%' );
        }
        if ( isset( $request->vlr_marg_contribuicao ) )
        {
          $query->where('vlr_marg_contribuicao', 'LIKE', '%'.$request->vlr_marg_contribuicao.'%' );
        }
        if ( isset( $request->marg_contribuicao ) )
        {
          $query->where('marg_contribuicao', 'LIKE', '%'.$request->marg_contribuicao.'%' );
        }
        if ( isset( $request->vlr_custo ) )
        {
          $query->where('vlr_custo', 'LIKE', '%'.$request->vlr_custo.'%' );
        }
        if ( isset( $request->vlr_custo_estoque ) )
        {
          $query->where('vlr_custo_estoque', 'LIKE', '%'.$request->vlr_custo_estoque.'%' );
        }
        if ( isset( $request->margem_custo ) )
        {
          $query->where('margem_custo', 'LIKE', '%'.$request->margem_custo.'%' );
        }
        if ( isset( $request->consumo_medio ) )
        {
          $query->where('consumo_medio', 'LIKE', '%'.$request->consumo_medio.'%' );
        }
        if ( isset( $request->cmv_prod_serv ) )
        {
          $query->where('cmv_prod_serv', 'LIKE', '%'.$request->cmv_prod_serv.'%' );
        }
        if ( isset( $request->curva_abc ) )
        {
          $query->where('curva_abc', 'LIKE', '%'.$request->curva_abc.'%' );
        }
        if ( isset( $request->id_fornecedor ) )
        {
          $query->where('id_fornecedor', 'LIKE', '%'.$request->id_fornecedor.'%' );
        }
        if ( isset( $request->descricao ) )
        {
          $query->where('descricao', 'LIKE', '%'.$request->descricao.'%' );
        }
        if ( isset( $request->status ) )
        {
          $query->where('status', 'LIKE', '%'.$request->status.'%' );
        }
      })->
      with('smenhgskqwmdjwe', 'ecgklyqfdcoguyj')->
      paginate($request->per_page == 'all' ? 15 : $request->per_page);
      // // orderByRaw('-deleted_at DESC')->
      // // orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
      // orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
      // withTrashed()->
      // // appends($request->all());

    return $servicos;
  }
  
  public function servicos_excluir_dependentes($id)
  {
    $servico = ServicoProduto::find($id);
    // $servico = ServicoProduto::onlyTrashed()->find($id);
    $servico->restore();

    $response = [
        'type'    => 'success',
        'message' => "Restaurado com sucesso.",
        'data'    => $servico->toArray(),
    ];

    return $response;
  }

  public function servicos_atualizar(Request $request, $id)
  {
    if(isset($request[0]))
    {
      $atualizacoes = $request[0];
    }
    else
    {
      $atualizacoes = $request->all();
    }

    $servico     = ServicoProduto::find($id);
    $servico     = $servico->update($atualizacoes);
    $atualizado = ServicoProduto::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }

  public function servicos_permissoes(Request $request, $id)
  {
    $servico    = ServicoProduto::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $servico->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $servico->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }


  public function servicos_usuarios_tabelar($id)
  {
    $servico    = ServicoProduto::find($id);

    return view('sistema.catalogo.servicos.auxiliares.tab_servicos_usuarios', [
      'usuarios' => $servico->znufwevbqgruklz,
    ]);
  }

  public function servicos_usuarios_incluir(Request $request, $id)
  {
    $servico    = ServicoProduto::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $servico->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $servico->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }

  public function servicos_usuarios_adicionar(Request $request, $id)
  {
    $servico  = ServicoProduto::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $servico->znufwevbqgruklz()->syncWithoutDetaching($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Incluído com sucesso.",
    ];
    
    return $response;
  }

  public function servicos_usuarios_remover(Request $request, $id)
  {
    $servico  = ServicoProduto::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $servico->znufwevbqgruklz()->detach($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Removido com sucesso.",
    ];
    
    return $response;
  }

  public function servicos_pesquisar($id)
  {
    $servico  = ServicoProduto::find($id);

    return $servico;
  }

  
  public function servicos_encontrar($id)
  {
    $servico = ServicoProduto::with('ecgklyqfdcoguyj')->find($id);

    return $servico;
  }

// CONSUMO =======================================================================================================================================================================
  public function consumos()
  {
    return view('sistema.catalogo.consumos.index');
  }

  public function consumos_tabelar()
  {
    $consumos = ServicoProduto::
                            where('tipo', '=', 'Consumo')->
                            get();

    return view('sistema.catalogo.consumos.tabelar', [
      'consumos' => $consumos,
    ]);
  }

  public function consumos_mostrar($id)
  {
    $consumo = ServicoProduto::find($id);

    return view('sistema.catalogo.consumos.mostrar', [
      'consumo' => $consumo,
    ]);
  }

  public function consumos_adicionar()
  {
    return view('sistema.catalogo.consumos.adicionar');
  }

  public function consumos_gravar(Request $request)
  {
    $consumo = ServicoProduto::create($request->all());

    return view('sistema.catalogo.consumos.index');
  }

  public function consumos_editar($id)
  {
    dd('s');
    $consumo = ServicoProduto::find($id);

    return view('sistema.catalogo.consumos.editar', [
      'consumo' => $consumo,
    ]);
  }

  public function consumos_excluir(Request $request, $id)
  {
    $consumo = ServicoProduto::find($id);

    // $deleta_pivot_permissoes = $consumo->PVRBIUSBYF()->delete();
    $deleta_pivot_usuarios   = $consumo->smenhgskqwmdjwe()->delete();
    
    $consumo->delete();
  
    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $consumo->toArray(),
    ];

    return $response;
  }

  public function consumos_excluir_dependentes($id)
  {
    $consumo = ServicoProduto::find($id);
    // $consumo = ServicoProduto::onlyTrashed()->find($id);
    $consumo->restore();

    $response = [
        'type'    => 'success',
        'message' => "Restaurado com sucesso.",
        'data'    => $consumo->toArray(),
    ];

    return $response;
  }

  public function consumos_atualizar(Request $request, $id)
  {
    if(isset($request[0]))
    {
      $atualizacoes = $request[0];
    }
    else
    {
      $atualizacoes = $request->all();
    }

    $consumo     = ServicoProduto::find($id);
    $consumo     = $consumo->update($atualizacoes);
    $atualizado = ServicoProduto::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];
    
    return $response;
  }

  public function consumos_permissoes(Request $request, $id)
  {
    $consumo    = ServicoProduto::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $consumo->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $consumo->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }


  public function consumos_usuarios_tabelar($id)
  {
    $consumo    = ServicoProduto::find($id);

    return view('sistema.catalogo.consumos.auxiliares.consumos_usuarios', [
      'usuarios' => $consumo->znufwevbqgruklz,
    ]);
  }

  public function consumos_usuarios_incluir(Request $request, $id)
  {
    $consumo    = ServicoProduto::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $consumo->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $consumo->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];
    
    return $response;
  }

  public function consumos_usuarios_adicionar(Request $request, $id)
  {
    $consumo  = ServicoProduto::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $consumo->znufwevbqgruklz()->syncWithoutDetaching($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Incluído com sucesso.",
    ];
    
    return $response;
  }

  public function consumos_usuarios_remover(Request $request, $id)
  {
    $consumo  = ServicoProduto::find($id);
    $usuario = Pessoa::withTrashed()->find($request[0]['id_pessoa']);

    $atualizar = $consumo->znufwevbqgruklz()->detach($usuario);

    $response = [
        'type'    => 'success',
        'message' => "Removido com sucesso.",
    ];
    
    return $response;
  }

  public function consumos_listar()
  {
    $consumo  = ServicoProduto::get();

    return $consumo;
  }

  public function consumos_pesquisar($id)
  {
    $consumo  = ServicoProduto::find($id);

    return $consumo;
  }
// =======================================================================================================================================================================
  // public function servprod_mostrar($id)
  // {
  //   $permissao = Permissao::find($id);

  //   return view('sistema.catalogo.servprod.mostrar', [
  //     'permissao' => $permissao,
  //   ]);
  // }

  // public function servprod_adicionar()
  // {
  //   return view('sistema.catalogo.servprod.adicionar');
  // }

  // public function servprod_gravar(Request $request)
  // {
  //   $permissao = Permissao::create($request->all());

  //   return view('sistema.catalogo.servprod.index');
  // }

  // public function servprod_editar($id)
  // {
  //   $permissao = Permissao::find($id);

  //   return view('sistema.catalogo.servprod.editar', [
  //     'permissao' => $permissao,
  //   ]);
  // }

  public function servprod_buscar($id)
  {
    $servprod = ServicoProduto::find($id);

    return $servprod;
  }

  public function comissao_buscar($id_profexec, $id_servprod)
  {
    $comissao = ColaboradorServico::
                              where('id_profexec', '=', $id_profexec)->
                              where('id_servprod', '=', $id_servprod)->
                              first();

    return $comissao;
  }

  public function servprod_plucar3()
  {
    $servprod = ServicoProduto::
                      pluck('nome', 'id');
                      
    return $servprod;
  }

  public function servprod_plucar()
  {
    $servprod = ServicoProduto::
                      with('ecgklyqfdcoguyj')->
                      orderBy('nome', 'asc')->
                      get();
              
    return $servprod;
  }

  public function servprod_plucar2(Request $request)
  {
    return $tipo = ServicoProduto::paginate();
    
    if($request->type_query == 'plucar')
    {
      $tipo = ServicoProduto::
                    where('tipo', '=', $request->tipo)->
                    where(function ($query) use ($request) 
                    {
                        $query->where('id_categoria', '!=', $request->id_categoria)
                              ->orWhereNull('id_categoria');
                    })->
                    orderBy('nome', 'ASC')->
                    pluck('id', 'nome');
    }
    else
    {
      $tipo = ServicoProduto::
                    where('tipo', '=', $request->tipo)->
                    where(function ($query) use ($request) 
                    {
                        $query->where('id_categoria', '!=', $request->id_categoria)
                              ->orWhereNull('id_categoria');
                    })->
                    orderBy('nome', 'ASC')->
                    get();
    }

    return $tipo;
  }

  public function servprod_executor($id_servprod)
  {
    $produto = ServicoProduto::
                                with(['aksjaldjfwjlwfp' => function ($query)
                                {
                                  $query->
                                  select(['*'])->
                                  with(['dwsdjqwqwekowqe' => function ($query)
                                  {
                                    $query->
                                    select(['apelido', 'id']);
                                  }]);
                                }])->
                                select(['id', 'ativo', 'nome', 'tipo', 'tipo_preco', 'vlr_venda'])->
                                find($id_servprod);

    return response()->json($produto);
    
        // $produto['executores'] = ColaboradorServico::
    //                           where('id_servico', '=', $id_servprod)->
    //                           join('atd_pessoas', 'atd_pessoas.id', '=', 'cnf_colaborador_servico.id_profexec')->
    //                           orderBy('atd_pessoas.apelido')->
    //                           select('cnf_colaborador_servico.*', 'atd_pessoas.apelido')->
    //                           get();

  }

  public function colaborador_executor2($id_servprod)
  {
    $colaborador = ColaboradorServico::
                              where('id_servprod', '=', $id_servprod)->
                              with(['dwsdjqwqwekowqe' => function ($query)
                              {
                                $query->select('id', 'apelido');
                              }])->
                              with(['aslqmpqwplspiry' => function ($query)
                              {
                                $query->select('id', 'nome');
                              }])->
                              get();
    return $colaborador;
  }

}
