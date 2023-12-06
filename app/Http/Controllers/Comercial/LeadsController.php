<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Comercial\Lead;
use App\Models\Comercial\leadTurma;
use App\Models\Atendimento\Pessoa;
use App\Models\ACL\Funcao;

class LeadsController extends Controller
{
  public function leads()
  {
    return view('sistema.comercial.crm.index');
  }

  public function leads_tabelar(Request $request)
  {
    if( \Auth::User()->temFuncao('Gerente Comercial') )
    {
        $leads = Lead::
                      where( function ($query) use ($request)
                      {
                      if ( isset( $request->pesquisa ) )
                      {
                          $query->
                          orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('telefone', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('obs', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('cidade', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('interesse', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('status', 'LIKE', '%'.$request->pesquisa.'%' );
                      }
                      })->
                      where( function ($query) use ($request)
                      {
                      if ( isset( $request->nome ) )
                      {
                          $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
                      }
                      if ( isset( $request->telefone ) )
                      {
                          $query->where('telefone', 'LIKE', '%'.$request->telefone.'%' );
                      }
                      if ( isset( $request->obs ) )
                      {
                          $query->where('obs', 'LIKE', '%'.$request->obs.'%' );
                      }
                      if ( isset( $request->cidade ) )
                      {
                          $query->where('cidade', 'LIKE', '%'.$request->cidade.'%' );
                      }
                      if ( isset( $request->email ) )
                      {
                          $query->where('email', 'LIKE', '%'.$request->email.'%' );
                      }
                      if ( isset( $request->interesse ) )
                      {
                          $query->where('interesse', 'LIKE', '%'.$request->interesse.'%' );
                      }
                      if ( isset( $request->status ) )
                      {
                          $query->where('status', 'LIKE', '%'.$request->status.'%' );
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
                      orderBy($request->ordenar_por ?? 'updated_at', $request->ordem ?? 'DESC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());
    }
    else
    {
        $leads = Lead::
            where('id_consultor', '=', \Auth::User()->id)->
            where( function ($query) use ($request)
            {
            if ( isset( $request->pesquisa ) )
            {
                $query->
                orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                orwhere('telefone', 'LIKE', '%'.$request->pesquisa.'%' )->
                orwhere('obs', 'LIKE', '%'.$request->pesquisa.'%' )->
                orwhere('cidade', 'LIKE', '%'.$request->pesquisa.'%' )->
                orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                orwhere('interesse', 'LIKE', '%'.$request->pesquisa.'%' )->
                orwhere('status', 'LIKE', '%'.$request->pesquisa.'%' );
            }
            })->
            where( function ($query) use ($request)
            {
            if ( isset( $request->nome ) )
            {
                $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
                dd('s');
            }
            if ( isset( $request->telefone ) )
            {
                $query->where('telefone', 'LIKE', '%'.$request->telefone.'%' );
            }
            if ( isset( $request->obs ) )
            {
                $query->where('obs', 'LIKE', '%'.$request->obs.'%' );
            }
            if ( isset( $request->cidade ) )
            {
                $query->where('cidade', 'LIKE', '%'.$request->cidade.'%' );
            }
            if ( isset( $request->email ) )
            {
                $query->where('email', 'LIKE', '%'.$request->email.'%' );
            }
            if ( isset( $request->interesse ) )
            {
                $query->where('interesse', 'LIKE', '%'.$request->interesse.'%' );
            }
            if ( isset( $request->status ) )
            {
                $query->where('status', 'LIKE', '%'.$request->status.'%' );
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
            orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
            withTrashed()->
            paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
            appends($request->all());
    }



    return view('sistema.comercial.crm.tabelar', [
      'leads' => $leads,
    ]);
  }

  public function leads_editar($id)
  {
    $lead = Lead::find($id);

    return view('sistema.comercial.crm.editar', [
      'lead' => $lead,
    ]);
  }

  public function leads_confirmar_edicao(Request $request, $id)
  {
    $lead = Lead::find($id);
    $lead->nome               = $request->nome;
    $lead->telefone           = $request->telefone;
    $lead->obs                = $request->obs;
    $lead->cidade             = $request->cidade;
    $lead->email              = $request->email;
    $lead->interesse          = $request->interesse;
    $lead->id_consultor       = $request->id_consultor;
    $lead->id_turma           = $request->id_turma;
    $lead->id_origem          = $request->id_origem;
    $lead->status             = $request->status;
    $lead->arquivado_favorito = $request->arquivado_favorito;
    $lead->favorito           = $request->favorito;
    $lead->arquivado          = $request->arquivado;
    $lead->created_at         = $request->created_at;
    $lead->updated_at         = $request->updated_at;
    $lead->deleted_at         = $request->deleted_at;
    $lead->update();

    return view('sistema.comercial.crm.index');
  }

  public function leads_excluir($id)
  {
    $lead = Lead::find($id);
    $lead->delete();

    $response = [
        'type'    => 'success',
        'message' => "O lead '$lead->nome' foi deleteado com sucesso.",
        'data'    => $lead->toArray(),
    ];

    return $response;
  }

  public function leads_restaurar($id)
  {
    $lead = lead::onlyTrashed()->find($id);
    $lead->restore();

    $response = [
        'type'    => 'success',
        'message' => "O lead '$lead->nome' foi restaurado com sucesso.",
        'data'    => $lead->toArray(),
    ];

    return $response;
  }

  public function leads_ficha(Request $request)
  {
    if( \Auth::User()->temFuncao('Administrador do Sistema') || \Auth::User()->temFuncao('Gerente Comercial') )
    {
        $dados = Lead::
        with(['fghtvxswwryiiil', 'rtyyvaqazxgdssf' => function( $q )
        {
          return $q->with(['cbntdakklaoyfih']);
        }])->
        // limit(100)->
        get()->map(function ($query) {
          $query->setRelation('fghtvxswwryiiil', $query->fghtvxswwryiiil->take(3));
          return $query;
        });
    }
    else
    {
        $dados = Lead::
        where('id_consultor', '=', \Auth::User()->id)->
        with(['fghtvxswwryiiil', 'rtyyvaqazxgdssf' => function( $q )
        {
          return $q->with(['cbntdakklaoyfih']);
        }])->
        // limit(100)->
        get()->map(function ($query) {
          $query->setRelation('fghtvxswwryiiil', $query->fghtvxswwryiiil->take(3));
          return $query;
        });
    }
    
    return $dados;
  }

  public function leads_mostrar($id)
  {
    $dados = Lead::
                  with(['rtyyvaqazxgdssf.cbntdakklaoyfih', 'fghtvxswwryiiil', 'lskdfjweklwejrq', 'sfwmfkmrbeesfsd.asjfeiemwerfewr.cbntdakklaoyfih'])->
                  find($id);

    return $dados;
  }

  public function leads_create(Request $request)
  {
      try
      {
          $lead = new Lead;
          $lead->nome         = $request->nome;
          $lead->telefone     = $request->telefone;
          $lead->obs          = $request->obs;
          $lead->cidade       = $request->cidade;
          $lead->email        = $request->email;
          $lead->id_origem    = $request->id_origem;
          $lead->interesse    = $request->interesse;
          $lead->status       = $request->status;
          $lead->id_consultor = \Auth::User()->id;
          $lead->save();

          $lead->fghtvxswwryiiil()->create([
              'conversa' => $request->nova_conversa,
            ]);

            // SALVAR TURMAS DE INTERESSE
            if ( !empty( $request->turmas_interesse ) )
            {
                foreach ( $request->turmas_interesse as $turma )
                {
                    $lead_turma = new leadTurma;
                    $lead_turma->id_lead   = $lead->id;
                    $lead_turma->cod_turma = $turma;
                    $lead_turma->save();
                }
            }

      return back()->with('success', 'Obrigado por nos contactar.');
    }
    catch (\Exception $error)
    {
      return $error->getMessage();
      return back()->with('error', "Ocorreu um erro inesperado: {$error->getMessage()}");
    }
  }

  public function leads_atualizar(Request $request, $id)
  {
    $lead = Lead::with('fghtvxswwryiiil', 'sfwmfkmrbeesfsd')->find($id);

    if (isset($request->conversa))
    {
      $lead->fghtvxswwryiiil()->create([
        'conversa' => $request->conversa,
      ]);
      $lead->touch();
    }

    if (isset($request->status))
    {
      $lead->status = $request->status;
      $lead->update();
    }

    if (isset($request->interesse))
    {
      $lead->interesse = $request->interesse;
      $lead->timestamps = false;
      $lead->update();
    }

    if (isset($request->favorito) && ($request->favorito == 1 || $request->favorito == 0 ))
    {
      $lead->favorito = !$request->favorito;
      $lead->timestamps = false;
      $lead->update();
    }

    if ( isset($request['turma']) and $request['tipo'] == 'on' )
    {
        $lead->sfwmfkmrbeesfsd()->create([
            'cod_turma' => $request['turma'],
        ]);
    }
    else if( isset($request['turma']) and $request['tipo'] == 'off' )
    {
        $lead->sfwmfkmrbeesfsd()->where('cod_turma', '=', $request['turma'])->delete();
    }

    $lead->refresh();

    return $lead;
  }

  public function leads_empresas(Request $request)
  {
    $funcao = Funcao::where('nome', $request->filtro)->first();

    if( \Auth::User()->temFuncao('Coordenador') )
    {
      $empresas = \Auth::User()->jlwjilwjldsdslf;
    }
    else if( \Auth::User()->temFuncao('Vendedor') )
    {
      $empresas = \Auth::User()->jlwjilwjldsdslf;
    }
    else
    {
      $empresas = \Auth::User()->jlwjilwjldsdslf;
    }

    return view('sistema.comercial.crm.partes.1_empresas', [
      'empresas' => $empresas,
    ]);
  }

  public function leads_produtos($id)
  {
    $empresa = Pessoa::find($id);
    
    $produtos = $empresa->flkejfoeiasldjp;
    
    return view('sistema.comercial.crm.partes.2_produtos', [
      'produtos' => $produtos,
    ]);
  }

  public function leads_clientes(Request $request, $id)
  {
    $empresa = Pessoa::find($id);

    
    $leads = $empresa->sakljqekliwuwef()->whereHas('sakljqekliwuwef', function (Builder $query)
    {
      $query->->where('favorito', '=', 1);
    })
                                      // where( function ($query) use ($request)
                                      // {
                                      // if ( isset( $request->pesquisa ) )
                                      // {
                                      //     $query->
                                      //     orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                                      //     orwhere('telefone', 'LIKE', '%'.$request->pesquisa.'%' )->
                                      //     orwhere('obs', 'LIKE', '%'.$request->pesquisa.'%' )->
                                      //     orwhere('cidade', 'LIKE', '%'.$request->pesquisa.'%' )->
                                      //     orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                                      //     orwhere('interesse', 'LIKE', '%'.$request->pesquisa.'%' )->
                                      //     orwhere('status', 'LIKE', '%'.$request->pesquisa.'%' );
                                      // }
                                      // })->
                                      // where( function ($query) use ($request)
                                      // {
                                      // if ( isset( $request->nome ) )
                                      // {
                                      //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
                                      // }
                                      // if ( isset( $request->telefone ) )
                                      // {
                                      //     $query->where('telefone', 'LIKE', '%'.$request->telefone.'%' );
                                      // }
                                      // if ( isset( $request->obs ) )
                                      // {
                                      //     $query->where('obs', 'LIKE', '%'.$request->obs.'%' );
                                      // }
                                      // if ( isset( $request->cidade ) )
                                      // {
                                      //     $query->where('cidade', 'LIKE', '%'.$request->cidade.'%' );
                                      // }
                                      // if ( isset( $request->email ) )
                                      // {
                                      //     $query->where('email', 'LIKE', '%'.$request->email.'%' );
                                      // }
                                      // if ( isset( $request->interesse ) )
                                      // {
                                      //     $query->where('interesse', 'LIKE', '%'.$request->interesse.'%' );
                                      // }
                                      // if ( isset( $request->status ) )
                                      // {
                                      //     $query->where('status', 'LIKE', '%'.$request->status.'%' );
                                      // }
                                      // if ( isset( $request->deleted_at ) )
                                      // {
                                      //     $query->whereNotNull('deleted_at');
                                      // }
                                      // appends($request->all());
    
    return view('sistema.comercial.crm.partes.3_leads', [
      'leads' => $leads,
    ]);
  }

  public function leads_procurar($id)
  {
    $lead = Lead::find($id);
        
    return view('sistema.comercial.crm.partes.4_leads_detalhes', [
      'lead' => $lead,
    ]);
  }
}
