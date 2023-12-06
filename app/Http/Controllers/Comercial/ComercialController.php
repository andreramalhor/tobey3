<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\Contrato;

class ComercialController extends Controller
{
  public function contratos()
  {
    return view('sistema.comercial.contratos.index');
  }

  public function contratos_tabelar()
  {
    $contratos = Contrato::withTrashed()->paginate();

    return view('sistema.comercial.contratos.tabelar', [
      'contratos' => $contratos,
    ]);
  }

  public function contratos_mostrar($id)
  {
    $kaban = Contrato::find($id);

    return view('sistema.comercial.contratos.mostrar', [
      'kaban' => $kaban,
    ]);
  }

  public function contratos_adicionar()
  {
    $clientes = Pessoa::
                        orderBy('apelido')->
                        get();
    
    return view('sistema.comercial.contratos.adicionar', [
      'clientes' => $clientes,
    ]);
  }

  public function contratos_gravar(Request $request)
  {
    $kaban = Contrato::create($request->all());

    return view('sistema.comercial.contratos.index');
  }

  public function contratos_editar($id)
  {
    $kaban = Contrato::find($id);

    return view('sistema.comercial.contratos.editar', [
      'kaban' => $kaban,
    ]);
  }

  public function contratos_excluir(Request $request, $id)
  {
    $kaban = Contrato::find($id);

    $kaban->delete();

    $response = [
        'type'    => 'success',
        'message' => "Deleteado com sucesso.",
        'data'    => $kaban->toArray(),
    ];

    return view('sistema.comercial.contratos.index')->with($response);
  }

  public function contratos_atualizar(Request $request, $id)
  {
    $kaban  = Contrato::find($id);
    $kaban  = $kaban->update($request->all());
    $atualizado = Contrato::find($id);

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
        'data'    => $atualizado->toArray(),
    ];

    return view('sistema.comercial.contratos.index')->with($response);
  }

  
  
  public function contratos_resumo(Request $request)
  {
    $venda = collect($request->all());
    $venda->com_vendas = collect($venda['com_vendas']);
    $venda->com_contratos_detalhes = collect($venda['com_contratos_detalhes']);
    $venda->com_contratos_pagamentos = collect($venda['com_contratos_pagamentos']);
    

    if(isset($venda['com_vendas']['id_cliente']))
    {
      $venda->cliente = Pessoa::find($venda['com_vendas']['id_cliente']);
    }
    
    return view('sistema.pdv.vendas.auxiliares.venda_resumo', [
      'venda' => $venda,
    ]);
  }
  
  // public function contratos_etapa_cliente()
  // {
  //   $clientes = app('App\Http\Controllers\Atendimento\PessoasController')->pessoas_plucar();

  //   return view('sistema.pdv.vendas.auxiliares.step0_cliente',[
  //     'clientes' => $clientes,
  //   ]);
  // }
  
  public function contratos_etapa_servprod()
  {
    $turmas = app('App\Http\Controllers\Pedagogico\PedagogicoController')->turmas_plucar();

    return view('sistema.comercial.contratos.auxiliares.step1_pedagogico',[
      'turmas' => $turmas,
    ]);
  }
  
  // FORMAS DE PAGAMENTOS 
  public function contratos_etapa_pagamento(Request $request)
  {
    $formas_pagamentos = Forma_Pagamento::
                            // select($request->distinct ?? 'forma')->
                            where('local', '=', 'venda')->orWhere('local', '=', 'ambos')->
                            // where('forma', 'like', '%'.$request->forma.'%')->
                            // where('tipo', 'like', '%'.$request->tipo.'%')->
                            // where('bandeira', 'like', '%'.$request->bandeira.'%')->
                            // where('parcela', $request->parcela == null ? 'like' : '=', $request->parcela == null ? '%'.$request->parcela.'%' : $request->parcela)->
                            // where('prazo', '>=', 0)->
                            // where('recebimento', 'like', '%'.$request->recebimento.'%')->
                            // distinct()->
                            // pluck('id', $pesquisa->distinct ?? 'forma');
                            get();

                            // return $formas_pagamentos;
    return view('sistema.pdv.vendas.auxiliares.step2_pagamento',[
      'formas_pagamentos' => $formas_pagamentos,
    ]);
  }
}
