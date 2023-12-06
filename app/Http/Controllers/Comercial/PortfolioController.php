<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Comercial\Portfolio;

class PortfolioController extends Controller
{
  public function portfolio()
  {
    $portfolio = Portfolio::get();

    return view('sistema.comercial.portfolio.index', [
      'portfolio' => $portfolio,
    ]);
  }

  public function portfolio_tabelar(Request $request)
  {
    if( \Auth::User()->temFuncao('Gerente Comercial') )
    {
        $portfolio = Lead::
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
        $portfolio = Lead::
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



    return view('sistema.comercial.portfolio.tabelar', [
      'portfolio' => $portfolio,
    ]);
  }

  public function portfolio_adicionar()
  {
    return view('sistema.comercial.portfolio.adicionar');
  }

  public function portfolio_editar($id)
  {
    $lead = Lead::find($id);

    return view('sistema.comercial.portfolio.editar', [
      'lead' => $lead,
    ]);
  }

  public function portfolio_confirmar_edicao(Request $request, $id)
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

    return view('sistema.comercial.portfolio.index');
  }

  public function portfolio_excluir($id)
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

  public function portfolio_restaurar($id)
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

  public function portfolio_ficha(Request $request)
  {
    if(\Auth::User()->id == 6 || \Auth::User()->id == 7)
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
    else
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

    return $dados;
  }

  public function portfolio_mostrar($slug)
  {
    $portfolio = Portfolio::
                      where('slug', '=', $slug)->
                      first();

    return view('sistema.comercial.portfolio.mostrar', [
      'portfolio' => $portfolio,
    ]);
  }

  public function portfolio_create(Request $request)
  {
    try
    {
      $portfolio = new Portfolio;
      $portfolio->titulo       = $request->titulo;
      $portfolio->slug         = \Str::slug($request->titulo);
      $portfolio->conteudo     = $request->conteudo;
      $portfolio->save();

      $response = [
        'type'     => 'success',
        'message'  => $portfolio->titulo." foi adicionado com sucesso.",
        'redirect' => route('com.portfolio'),
      ];

      return $response;
    }
    catch (\Exception $error)
    {
      return $error->getMessage();
      return back()->with('error', "Ocorreu um erro inesperado: {$error->getMessage()}");
    }
  }

  public function portfolio_atualizar(Request $request, $id)
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

}
