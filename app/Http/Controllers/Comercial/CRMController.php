<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comercial\Lead;

class CRMController extends Controller
{
  public function __construct()
  {
    $fila   = [ 6 , 7 ];
    $novo   = Lead::orderBy('id')->whereNull('id_consultor')->first();
    $ultimo = isset(Lead::orderByDesc('id')->whereNotNull('id_consultor')->first()->id_consultor) ? Lead::orderByDesc('id')->whereNotNull('id_consultor')->first()->id_consultor : 7;

    if (isset($novo))
    {
      if ( $ultimo == $fila[0] )
      {
        $novo->id_consultor = $fila[1];
        $novo->status       = 'entrada_lead';
        $novo->update();
      }
      else if ($ultimo == $fila[1])
      {
        $novo->id_consultor = $fila[0];
        $novo->status       = 'entrada_lead';
        $novo->update();
      }
      else
      {
        $novo->id_consultor = $fila[1];
        $novo->status       = 'entrada_lead';
        $novo->update();
      }
    }
  }

  public function crm()
  {
    return view('sistema.comercial.kanban.index');
  }

  public function crm_tabelar()
  {
    $kanban = Kanban::withTrashed()->get();

    return view('sistema.comercial.kanban.tabelar', [
      'kanban' => $kanban,
    ]);
  }

  public function crm_mostrar($id)
  {
    $kaban = Kanban::find($id);

    return view('sistema.comercial.kanban.mostrar', [
      'kaban' => $kaban,
    ]);
  }

  public function crm_adicionar()
  {
    return view('sistema.comercial.kanban.adicionar');
  }

  public function crm_gravar(Request $request)
  {
    $kaban = Kanban::create($request->all());

    return view('sistema.comercial.kanban.index');
  }

  public function crm_editar($id)
  {
    $kaban = Kanban::find($id);

    return view('sistema.comercial.kanban.editar', [
      'kaban' => $kaban,
    ]);
  }

  public function crm_excluir(Request $request, $id)
  {
    $kaban = Kanban::find($id);

    $kaban->delete();

    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $kaban->toArray(),
    ];

    return view('sistema.comercial.kanban.index')->with($response);
  }

  public function crm_atualizar(Request $request, $id)
  {
    $kaban  = Kanban::find($id);
    $kaban  = $kaban->update($request->all());
    $atualizado = Kanban::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];

    return view('sistema.comercial.kanban.index')->with($response);
  }

  // public function crm_produtos(Request $request, $id)
  // {
  //   $kaban    = Kanban::find($id);

  //   if ($request[0]['status'] == 'on')
  //   {
  //     $atualizar = $kaban->YXWBGTOOPLYJJAZ()->attach($permissao->id);
  //   }
  //   else if($request[0]['status'] == 'off')
  //   {
  //     $atualizar = $kaban->YXWBGTOOPLYJJAZ()->detach($permissao->id);
  //   }

  //   $response = [
  //       'type'    => 'success',
  //       'message' => "Atualizado com sucesso.",
  //   ];

  //   return $response;
  // }


  public function crm_produtos_tabelar($id)
  {
    $kaban    = Kanban::
                              // where('tipo', '=', 'Produto')->
                              find($id);

    return view('sistema.comercial.kanban.auxiliares.crmnban_produtos', [
      'produtos' => $kaban->PZGY650RMFKJ9W7,
    ]);
  }

  public function crm_servicos_tabelar($id)
  {
    $kaban    = Kanban::
                              // where('tipo', '=', 'Serviço')->
                              find($id);

    return view('sistema.comercial.kanban.auxiliares.crmnban_servicos', [
      'servicos' => $kaban->LZS394PQT9KN8UZ,
    ]);
  }

  public function crm_consumos_tabelar($id)
  {
    $kaban    = Kanban::
                              // where('tipo', '=', 'Consumo')->
                              find($id);

    return view('sistema.comercial.kanban.auxiliares.crmnban_consumos', [
      'consumos' => $kaban->Y6VUVJ8QLZOSW1G,
    ]);
  }

  public function crm_produtos_incluir(Request $request, $id)
  {
    $kaban    = Kanban::find($id);
    $permissao = Permissao::where('nome', $request[0]['permissao'])->first();

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $kaban->YXWBGTOOPLYJJAZ()->attach($permissao->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $kaban->YXWBGTOOPLYJJAZ()->detach($permissao->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

  public function crm_produtos_adicionar(Request $request, $id)
  {
    $produto   = ServicoProduto::withTrashed()->find($request[0]['id_servprod']);
    $produto->id_kaban = $id;
    $produto->update();

    $response = [
        'type'    => 'success',
        'message' => "Incluído com sucesso.",
    ];

    return $response;
  }

  public function crm_produtos_remover(Request $request, $id)
  {
    $produto = ServicoProduto::withTrashed()->find($request[0]['id_servprod']);
    $produto->id_kaban = null;
    $produto->update();

    $response = [
        'type'    => 'success',
        'message' => "Removido com sucesso.",
    ];

    return $response;
  }

// PRODUTOS =======================================================================================================================================================================
  public function produtos()
  {
    return view('sistema.ferramentas.produtos.index');
  }

  public function produtos_tabelar()
  {
    $produtos = ServicoProduto::
                            where('tipo', '=', 'Produto')->
                            orderBy('id_kaban', 'asc')->
                            get();

    return view('sistema.ferramentas.produtos.tabelar', [
      'produtos' => $produtos,
    ]);
  }

  public function produtos_mostrar($id)
  {
    $produto = ServicoProduto::find($id);

    return view('sistema.ferramentas.produtos.mostrar', [
      'produto' => $produto,
    ]);
  }

  public function produtos_adicionar()
  {
    return view('sistema.ferramentas.produtos.adicionar');
  }

  public function produtos_gravar(Request $request)
  {
    $produto = ServicoProduto::create($request->all());

    return view('sistema.ferramentas.produtos.index');
  }

  public function produtos_editar($id)
  {
    dd('s');
    $produto = ServicoProduto::find($id);

    return view('sistema.ferramentas.produtos.editar', [
      'produto' => $produto,
    ]);
  }

  public function produtos_excluir(Request $request, $id)
  {
    $produto = ServicoProduto::find($id);

    $deleta_pivot_permissoes = $produto->PVRBIUSBYF()->delete();
    $deleta_pivot_usuarios   = $produto->MMBBEYSRJM()->delete();

    $produto->delete();

    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $produto->toArray(),
    ];

    return $response;
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

  public function produtos_atualizar(Request $request, $id)
  {
    $produto     = ServicoProduto::find($id);
    $produto     = $produto->update($request[0]);
    $atualizado = ServicoProduto::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];

    return $response;
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

    return view('sistema.ferramentas.produtos.auxiliares.tab_produtos_usuarios', [
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

  public function produtos_listar()
  {
    $produtos  = ServicoProduto::get();

    return $produtos;
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
    return view('sistema.ferramentas.servicos.index');
  }

  public function servicos_tabelar()
  {
    $servicos = ServicoProduto::
                            where('tipo', '=', 'Serviço')->
                            get();

    return view('sistema.ferramentas.servicos.tabelar', [
      'servicos' => $servicos,
    ]);
  }

  public function servicos_mostrar($id)
  {
    $servico = ServicoProduto::find($id);

    return view('sistema.ferramentas.servicos.mostrar', [
      'servico' => $servico,
    ]);
  }

  public function servicos_adicionar()
  {
    return view('sistema.ferramentas.servicos.adicionar');
  }

  public function servicos_gravar(Request $request)
  {
    $servico = ServicoProduto::create($request->all());

    return view('sistema.ferramentas.servicos.index');
  }

  public function servicos_editar($id)
  {
    dd('s');
    $servico = ServicoProduto::find($id);

    return view('sistema.ferramentas.servicos.editar', [
      'servico' => $servico,
    ]);
  }

  public function servicos_excluir(Request $request, $id)
  {
    $servico = ServicoProduto::find($id);

    $deleta_pivot_permissoes = $servico->PVRBIUSBYF()->delete();
    $deleta_pivot_usuarios   = $servico->MMBBEYSRJM()->delete();

    $servico->delete();

    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $servico->toArray(),
    ];

    return $response;
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
    $servico     = ServicoProduto::find($id);
    $servico     = $servico->update($request[0]);
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

    return view('sistema.ferramentas.servicos.auxiliares.tab_servicos_usuarios', [
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

  public function servicos_listar()
  {
    $servico  = ServicoProduto::get();

    return $servico;
  }

  public function servicos_pesquisar($id)
  {
    $servico  = ServicoProduto::find($id);

    return $servico;
  }

// CONSUMO =======================================================================================================================================================================
  public function consumos()
  {
    return view('sistema.ferramentas.consumos.index');
  }

  public function consumos_tabelar()
  {
    $consumos = ServicoProduto::
                            where('tipo', '=', 'Consumo')->
                            get();

    return view('sistema.ferramentas.consumos.tabelar', [
      'consumos' => $consumos,
    ]);
  }

  public function consumos_mostrar($id)
  {
    $consumo = ServicoProduto::find($id);

    return view('sistema.ferramentas.consumos.mostrar', [
      'consumo' => $consumo,
    ]);
  }

  public function consumos_adicionar()
  {
    return view('sistema.ferramentas.consumos.adicionar');
  }

  public function consumos_gravar(Request $request)
  {
    $consumo = ServicoProduto::create($request->all());

    return view('sistema.ferramentas.consumos.index');
  }

  public function consumos_editar($id)
  {
    dd('s');
    $consumo = ServicoProduto::find($id);

    return view('sistema.ferramentas.consumos.editar', [
      'consumo' => $consumo,
    ]);
  }

  public function consumos_excluir(Request $request, $id)
  {
    $consumo = ServicoProduto::find($id);

    $deleta_pivot_permissoes = $consumo->PVRBIUSBYF()->delete();
    $deleta_pivot_usuarios   = $consumo->MMBBEYSRJM()->delete();

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
    $consumo     = ServicoProduto::find($id);
    $consumo     = $consumo->update($request[0]);
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

    return view('sistema.ferramentas.consumos.auxiliares.consumos_usuarios', [
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

  public function permissoes()
  {
    return view('sistema.ferramentas.permissoes.index');
  }

  public function permissoes_tabelar()
  {
    $permissoes = Permissao::orderBy('id', 'asc')->get();

    return view('sistema.ferramentas.permissoes.tabelar', [
      'permissoes' => $permissoes,
    ]);
  }

  public function permissoes_mostrar($id)
  {
    $permissao = Permissao::find($id);

    return view('sistema.ferramentas.permissoes.mostrar', [
      'permissao' => $permissao,
    ]);
  }

  public function permissoes_adicionar()
  {
    return view('sistema.ferramentas.permissoes.adicionar');
  }

  public function permissoes_gravar(Request $request)
  {
    $permissao = Permissao::create($request->all());

    return view('sistema.ferramentas.permissoes.index');
  }

  

  public function dash_page_crm()
  {
    return view('sistema.dashboard.kanban.index');
  }

  public function dash_page_crm_dados()
  {
    // $start = \Carbon\Carbon::today()->startOfMonth();
    $start = '2021-01-01 00:00:00';
    // $end   = \Carbon\Carbon::today()->endOfMonth();
    $end   = '2024-01-01 00:00:00';

    $leads = Lead::
                  whereBetween('created_at', [$start, $end])->
                  select([
                    \DB::raw('DAY(created_at) as dia'),
                    \DB::raw('COUNT(*) as total'),
                  ])->
                  groupBy('dia')->
                  orderBy('dia')->
                  get();

    $labels = [];
    for ($i=1; $i <= \Carbon\Carbon::parse($start)->daysInMonth; $i++)
    {
      array_push($labels, $i);
    }

    $total = $total = [];
    foreach ($leads as $key => $lead)
    {
      $dia[$lead->dia]   = $lead->dia;
      $total[$lead->dia] = $lead->total;
    }

    foreach ($labels as $key => $dias)
    {
      if(!array_key_exists($key, $dia))
      {
        $dia[$key] = 0;
      }
      if(!array_key_exists($key, $total))
      {
        $total[$key] = 0;
      }
    }

    ksort($dia);
    ksort($total);

    return [
      'labels'   => array_values($labels),
      'datasets' => [
        'label'           => 'Quantidade de leads cadastrados',
        'data'            => array_values($total),
        'backgroundColor' => "rgb(56, 142, 60, 1)",   
      ],
    ];
  }
  public function page_crm_dados_funnel()
  {
    // $start = \Carbon\Carbon::today()->startOfMonth();
    $start = '2021-01-01 00:00:00';
    // $end   = \Carbon\Carbon::today()->endOfMonth();
    $end   = '2024-01-01 00:00:00';

    $leads = Lead::
                  whereBetween('created_at', [$start, $end])->
                  select([
                    'status',
                    // \DB::raw('DAY(created_at) as dia'),
                    \DB::raw('COUNT(*) as total'),
                  ])->
                  groupBy('status')->
                  // orderBy('dia')->
                  get();

    $labels = $labels = [ 'Entrada Lead', 'Apresentação do Curso', 'Proposta Enviada', 'Negociando Venda' ];
    $total = $total = [];
    foreach ($leads as $key => $lead)
    {
      switch ($lead->status)
      {
        case 'entrada_lead':
          $total['Entrada Lead']  = $lead->total;
          break;
        
        case 'apresentacao_curso':
          $total['Apresentação do Curso']  = $lead->total;
          break;
        
        case 'proposta_enviada':
          $total['Proposta Enviada']  = $lead->total;
          break;
        
        case 'negociando_venda':
          $total['Negociando Venda']  = $lead->total;
          break;
      }
      // $total[$lead->status]  = $lead->total;
    }

    ksort($labels);
    ksort($total);

    return [
      'labels'   => array_values($labels),
      'datasets' => [
        'label'           => 'Etapas do Funil',
        'data'            => array_values($total),
        'backgroundColor' => [
          "rgb(241, 196, 15, 1)",
          "rgb(245, 124, 0, 1)",
          "rgb(211, 47, 47, 1)",
          "rgb(194, 24, 91, 1)",
          "rgb(25, 118, 210, 1)",
          "rgb(56, 142, 60, 1)"
        ],
      ],
    ];
  }
}
