<?php

namespace App\Http\Controllers\Pedagogico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pedagogico\Curso;
use App\Models\Pedagogico\Modulo;
use App\Models\Pedagogico\Turma;

class PedagogicoController extends Controller
{
  public function cursos()
  {
    return view('sistema.pedagogico.cursos.index');
  }

  public function cursos_tabelar(Request $request)
  {
    $cursos = Curso::
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          orwhere('cod', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('sigla', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('horas_semanais', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('duracao', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('carga_horaria', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('vlr_total', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('desc_max', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('parc_max', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('parc_extras', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('tipo_curso', 'LIKE', '%'.$request->pesquisa.'%')->
                          orwhere('status', 'LIKE', '%'.$request->pesquisa.'%');
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->nome ) )
                        {
                          $query->where('nome', 'LIKE', '%'.$request->nome.'%' );
                        }
                        if ( isset( $request->sigla ) )
                        {
                            $query->where('sigla', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->tipo_curso ) )
                        {
                          $query->where('tipo_curso', 'LIKE', '%'.$request->tipo_curso.'%' );
                        }
                        if ( isset( $request->status ) )
                        {
                          $query->where('status', 'LIKE', $request->status );
                        }
                        if ( isset( $request->carga_horaria ) )
                        {
                          $query->where('carga_horaria', 'LIKE', '%'.$request->carga_horaria.'%' );
                        }
                        if ( isset( $request->deleted_at ) )
                        {
                          $query->whereNotNull('deleted_at');
                        }
                      })->
                      orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                      orderBy($request->ordenar_por ?? 'nome', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    return view('sistema.pedagogico.cursos.tabelar', [
      'cursos' => $cursos,
    ]);
  }

  public function cursos_mostrar($id)
  {
    $curso = Curso::find($id);
    $tipos  = Tipo_de_Curso::get();

    return view('sistema.pedagogico.cursos.mostrar', [
      'curso' => $curso,
      'tipos'  => $tipos,
    ]);
  }

  public function cursos_adicionar()
  {
    return view('sistema.pedagogico.cursos.adicionar');
  }

  public function cursos_validar(Request $request, $id)
  {
    $curso = Curso::
                    where($request->campo, '=' , $request->valor)->
                    where('id', '!=' , $request->id)->
                    get();

    switch ($request->campo)
    {
      case 'nome':
        if(strlen($request->valor) == 0)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve estar preenchido."];

        if(strlen($request->valor) < 5)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve ter pelo menos 5 caracteres."];

        if(strlen($request->valor) > 100)
          return ['type' => "error", 'message' => "O campo ".$request->campo." não pode ser superior a 100 caracteres."];

        break;


      case 'apelido':
        if(strlen($request->valor) == 0)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve estar preenchido."];

        if(strlen($request->valor) < 5)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve ter pelo menos 5 caracteres."];

        if(strlen($request->valor) > 50)
          return ['type' => "error", 'message' => "O campo ".$request->campo." não pode ser superior a 100 caracteres."];

        break;
    }

    if(count($curso) != 0)
    {
      $response = [
        'type'     => 'error',
        'message'  => "Uma curso com esse ".$request->campo." já foi cadastrada.",
        'data'     => $curso->toArray(),
      ];

    return $response;
    }
  }

  public function cursos_gravar(Request $request)
  {
    try
    {
      $curso = Curso::create($request->toArray());

      if( $request->foto_temp != null )
      {
        // SALVAR FOTO DO PERFIL DO INSTAGRAM
        $nome         = $curso->id;
        $extensao     = 'png';
        $nameFile     = "{$nome}.{$extensao}";
        $arquivo_foto = "img/atendimentos/cursos/perfil/".$nameFile;

        File::move(public_path($request->foto_temp), public_path($arquivo_foto));
      }

      // SALVAR ENDEREÇOS DA curso
      if ( !empty( json_decode($request->cursos_enderecos) ) )
      {
        foreach ( json_decode($request->cursos_enderecos, true) as $atd_address )
        {
          $curso->uqbchiwyagnnkip()->create($atd_address);
        }
      }

      // SALVAR CONTATOS DA curso
      if ( !empty( json_decode($request->cursos_contatos) ) )
      {
        foreach ( json_decode($request->cursos_contatos, true) as $atd_contatos )
        {
          $curso->ginthgfwxbdhwtu()->create($atd_contatos);
        }
      }

      $response = [
        'type'     => 'success',
        'message'  => "A curso '$curso->nome' foi cadastrada com sucesso.",
        'data'     => $curso->toArray(),
        'redirect' => route('atd.cursos'),
      ];

      return $response;
    }
    catch (ValidatorException $e)
    {
      dd('erro na exception no metodo store do service curso');
      $response = [
        'success' => false,
        'error'   => true,
        'message' => $e->getMessageBag()
      ];

      return $response;
    }

    return view('sistema.pedagogico.cursos.index');
  }

  public function cursos_editar($id)
  {
    $curso = Curso::find($id);

    return view('sistema.pedagogico.cursos.editar', [
      'curso' => $curso,
    ]);
  }

  public function cursos_atualizar(Request $request, $id)
  {
    // return $request->cursos_enderecos->toArray();
    $curso     = Curso::find($id);
    $curso     = $curso->update($request->toArray());
    $atualizado = Curso::find($id);

    // SALVAR ENDEREÇOS DA curso
    if ( !empty( json_decode($request->cursos_enderecos) ) )
    {
      $atualizado->uqbchiwyagnnkip()->delete();
      foreach ( json_decode($request->cursos_enderecos, true) as $atd_address )
      {
        $atualizado->uqbchiwyagnnkip()->create($atd_address);
      }
    }

    // SALVAR CONTATOS DA curso
    if ( !empty( json_decode($request->cursos_contatos) ) )
    {
      $atualizado->ginthgfwxbdhwtu()->delete();
      foreach ( json_decode($request->cursos_contatos, true) as $atd_contatos )
      {
        $atualizado->ginthgfwxbdhwtu()->create($atd_contatos);
      }
    }

    $response = [
      'type'     => 'success',
      'message'  => "A curso '$atualizado->nome' foi atualizada com sucesso.",
      'data'     => $atualizado->toArray(),
      'redirect' => route('atd.cursos'),
    ];

    return $response;
  }

  public function cursos_excluir($id)
  {
    $curso = Curso::find($id);
    $curso->delete();

    $response = [
        'type'    => 'success',
        'message' => "A curso '$curso->nome' foi deleteada com sucesso.",
        'data'    => $curso->toArray(),
    ];

    return $response;
  }

  public function cursos_restaurar($id)
  {
    $curso = Curso::onlyTrashed()->find($id);
    $curso->restore();

    $response = [
        'type'    => 'success',
        'message' => "A curso '$curso->nome' foi restaurada com sucesso.",
        'data'    => $curso->toArray(),
    ];

    return $response;
  }

  public function cursos_pesquisar(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Tipo_de_curso
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = curso
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
  }


  public function cursos_tipos(Request $request, $id)
  {
    $curso = Curso::find($id);
    $tipo   = Tipo_de_Curso::find($request[0]['tipo']);

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $curso->aistggwbdgrrher()->attach($tipo->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $curso->aistggwbdgrrher()->detach($tipo->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

// =======================================================================================================================================================================

  public function modulos()
  {
    return view('sistema.pedagogico.modulos.index');
  }

  public function modulos_tabelar(Request $request)
  {
    $modulos = Modulo::
                        where( function ($query) use ($request)
                        {
                        if ( isset( $request->pesquisa ) )
                        {
                            $query->
                            orwhere('cod', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('descricao', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('carga_horaria', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('qtd_aulas', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('id_curso', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('sigla', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('tipo', 'LIKE', '%'.$request->pesquisa.'%')->
                            orwhere('valor', 'LIKE', '%'.$request->pesquisa.'%');
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                      if ( isset( $request->cod ) )
                      {
                          $query->where('cod', 'LIKE', '%'.$request->cod.'%' );
                      }
                      if ( isset( $request->descricao ) )
                      {
                          $query->where('descricao', 'LIKE', '%'.$request->descricao.'%' );
                      }
                      if ( isset( $request->carga_horaria ) )
                      {
                          $query->where('carga_horaria', 'LIKE', '%'.$request->carga_horaria.'%' );
                      }
                      if ( isset( $request->qtd_aulas ) )
                      {
                          $query->where('qtd_aulas', 'LIKE', '%'.$request->qtd_aulas.'%' );
                      }
                      if ( isset( $request->id_curso ) )
                      {
                          $query->where('id_curso', 'LIKE', '%'.$request->id_curso.'%' );
                      }
                      if ( isset( $request->sigla ) )
                      {
                          $query->where('sigla', 'LIKE', '%'.$request->sigla.'%' );
                      }
                      if ( isset( $request->tipo ) )
                      {
                          $query->where('tipo', 'LIKE', '%'.$request->tipo.'%' );
                      }
                      if ( isset( $request->valor ) )
                      {
                          $query->where('valor', 'LIKE', '%'.$request->valor.'%' );
                      }
                      })->
                      orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
                      orderBy($request->ordenar_por ?? 'descricao', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    return view('sistema.pedagogico.modulos.tabelar', [
      'modulos' => $modulos,
    ]);
  }

  public function modulos_mostrar($id)
  {
    $modulo = Modulo::find($id);
    $tipos  = Tipo_de_Modulo::get();

    return view('sistema.pedagogico.modulos.mostrar', [
      'modulo' => $modulo,
      'tipos'  => $tipos,
    ]);
  }

  public function modulos_adicionar()
  {
    return view('sistema.pedagogico.modulos.adicionar');
  }

  public function modulos_validar(Request $request, $id)
  {
    $modulo = Modulo::
                    where($request->campo, '=' , $request->valor)->
                    where('id', '!=' , $request->id)->
                    get();

    switch ($request->campo)
    {
      case 'nome':
        if(strlen($request->valor) == 0)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve estar preenchido."];

        if(strlen($request->valor) < 5)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve ter pelo menos 5 caracteres."];

        if(strlen($request->valor) > 100)
          return ['type' => "error", 'message' => "O campo ".$request->campo." não pode ser superior a 100 caracteres."];

        break;


      case 'apelido':
        if(strlen($request->valor) == 0)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve estar preenchido."];

        if(strlen($request->valor) < 5)
          return ['type' => "error", 'message' => "O campo ".$request->campo." deve ter pelo menos 5 caracteres."];

        if(strlen($request->valor) > 50)
          return ['type' => "error", 'message' => "O campo ".$request->campo." não pode ser superior a 100 caracteres."];

        break;
    }

    if(count($modulo) != 0)
    {
      $response = [
        'type'     => 'error',
        'message'  => "Uma modulo com esse ".$request->campo." já foi cadastrada.",
        'data'     => $modulo->toArray(),
      ];

    return $response;
    }
  }

  public function modulos_gravar(Request $request)
  {
    try
    {
      $modulo = Modulo::create($request->toArray());

      if( $request->foto_temp != null )
      {
        // SALVAR FOTO DO PERFIL DO INSTAGRAM
        $nome         = $modulo->id;
        $extensao     = 'png';
        $nameFile     = "{$nome}.{$extensao}";
        $arquivo_foto = "img/atendimentos/modulos/perfil/".$nameFile;

        File::move(public_path($request->foto_temp), public_path($arquivo_foto));
      }

      // SALVAR ENDEREÇOS DA modulo
      if ( !empty( json_decode($request->modulos_enderecos) ) )
      {
        foreach ( json_decode($request->modulos_enderecos, true) as $atd_address )
        {
          $modulo->uqbchiwyagnnkip()->create($atd_address);
        }
      }

      // SALVAR CONTATOS DA modulo
      if ( !empty( json_decode($request->modulos_contatos) ) )
      {
        foreach ( json_decode($request->modulos_contatos, true) as $atd_contatos )
        {
          $modulo->ginthgfwxbdhwtu()->create($atd_contatos);
        }
      }

      $response = [
        'type'     => 'success',
        'message'  => "A modulo '$modulo->nome' foi cadastrada com sucesso.",
        'data'     => $modulo->toArray(),
        'redirect' => route('atd.modulos'),
      ];

      return $response;
    }
    catch (ValidatorException $e)
    {
      dd('erro na exception no metodo store do service modulo');
      $response = [
        'success' => false,
        'error'   => true,
        'message' => $e->getMessageBag()
      ];

      return $response;
    }

    return view('sistema.pedagogico.modulos.index');
  }

  public function modulos_editar($id)
  {
    $modulo = Modulo::find($id);

    return view('sistema.pedagogico.modulos.editar', [
      'modulo' => $modulo,
    ]);
  }

  public function modulos_atualizar(Request $request, $id)
  {
    // return $request->modulos_enderecos->toArray();
    $modulo     = Modulo::find($id);
    $modulo     = $modulo->update($request->toArray());
    $atualizado = Modulo::find($id);

    // SALVAR ENDEREÇOS DA modulo
    if ( !empty( json_decode($request->modulos_enderecos) ) )
    {
      $atualizado->uqbchiwyagnnkip()->delete();
      foreach ( json_decode($request->modulos_enderecos, true) as $atd_address )
      {
        $atualizado->uqbchiwyagnnkip()->create($atd_address);
      }
    }

    // SALVAR CONTATOS DA modulo
    if ( !empty( json_decode($request->modulos_contatos) ) )
    {
      $atualizado->ginthgfwxbdhwtu()->delete();
      foreach ( json_decode($request->modulos_contatos, true) as $atd_contatos )
      {
        $atualizado->ginthgfwxbdhwtu()->create($atd_contatos);
      }
    }

    $response = [
      'type'     => 'success',
      'message'  => "A modulo '$atualizado->nome' foi atualizada com sucesso.",
      'data'     => $atualizado->toArray(),
      'redirect' => route('atd.modulos'),
    ];

    return $response;
  }

  public function modulos_excluir($id)
  {
    $modulo = Modulo::find($id);
    $modulo->delete();

    $response = [
        'type'    => 'success',
        'message' => "A modulo '$modulo->nome' foi deleteada com sucesso.",
        'data'    => $modulo->toArray(),
    ];

    return $response;
  }

  public function modulos_restaurar($id)
  {
    $modulo = Modulo::onlyTrashed()->find($id);
    $modulo->restore();

    $response = [
        'type'    => 'success',
        'message' => "A modulo '$modulo->nome' foi restaurada com sucesso.",
        'data'    => $modulo->toArray(),
    ];

    return $response;
  }

  public function modulos_pesquisar(Request $request)
  {
    if ($request->mode == '=')
    {
      $people = Tipo_de_modulo
        ::where('nome', $request->mode, $request->tp)
        ->first()
        ->EFW5VO95LN;
    }
    else
    {
      $people = modulo
        ::orderby('apelido', 'asc')
        ->get();
    }

    return $people;
  }


  public function modulos_tipos(Request $request, $id)
  {
    $modulo = Modulo::find($id);
    $tipo   = Tipo_de_Modulo::find($request[0]['tipo']);

    if ($request[0]['status'] == 'on')
    {
      $atualizar = $modulo->aistggwbdgrrher()->attach($tipo->id);
    }
    else if($request[0]['status'] == 'off')
    {
      $atualizar = $modulo->aistggwbdgrrher()->detach($tipo->id);
    }

    $response = [
        'type'    => 'success',
        'message' => "Atualizado com sucesso.",
    ];

    return $response;
  }

// =======================================================================================================================================================================

  public function turmas(Request $request)
  {
    return view('sistema.pedagogico.turmas.index');
  }

  public function turmas_tabelar(Request $request)
  {
    $turmas = Turma::
                      // whereHas('lcldxgfwmrzybmm', function($q)
                      // {
                        // $q->whereBetween('id_tipo', [2, 8]);
                      // })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->pesquisa ) )
                        {
                          $query->
                          orwhere('cod', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('id_curso', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('sigla', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('dt_inicio', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('dt_final', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('dia_semana', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('horario', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('sala', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('max_alunos', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orwhere('status', 'LIKE', '%'.$request->pesquisa.'%' )->
                          orWhereHas('cbntdakklaoyfih', function ($q) use ($request)
                          {
                            return $q->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
                          })->
                          orWhereHas('sfhqwlkqwqwdlhk', function ($q) use ($request)
                          {
                            return $q->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
                          });
                        }
                      })->
                      where( function ($query) use ($request)
                      {
                        if ( isset( $request->cod ) )
                        {
                          $query->where('cod', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        // if ( isset( $request->id_curso ) )
                        // {
                        //   $query->whereHas('cbntdakklaoyfih', function ($q)
                        //   {
                        //     return $q->where('nome', 'LIKE', '%'.$request->sigla.'%');
                        //   })->get();
                        // }
                        if ( isset( $request->sigla ) )
                        {
                          $query->where('sigla', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->dt_inicio ) )
                        {
                          $query->where('dt_inicio', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->dt_final ) )
                        {
                          $query->where('dt_final', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->dia_semana ) )
                        {
                          $query->where('dia_semana', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->horario ) )
                        {
                          $query->where('horario', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->sala ) )
                        {
                          $query->where('sala', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->max_alunos ) )
                        {
                          $query->where('max_alunos', 'LIKE', '%'.$request->sigla.'%' );
                        }
                        if ( isset( $request->status ) )
                        {
                          $query->where('status', 'LIKE', '%'.$request->status.'%' );
                        }
                        if ( isset( $request->id_instrutor ) )
                        {
                          $query->where('id_instrutor', 'LIKE', '%'.$request->id_instrutor.'%' );
                        }
                        if ( isset( $request->deleted_at ) )
                        {
                          $query->whereNotNull('deleted_at');
                        }
                      })->
                                        // where([
                                        //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
                                        //   // ['sigla'          , 'LIKE', '%'.$request->sigla.'%'],
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
                                        //   // ['sigla'          , 'LIKE', '%'.$request->sigla.'%'],
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
                      orderBy($request->ordenar_por ?? 'sigla', $request->ordem ?? 'ASC')->
                      withTrashed()->
                      paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
                      appends($request->all());

    // $cursos = Curso::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.pedagogico.turmas.tabelar', [
      'turmas' => $turmas,
    ]);
  }

  public function turmas_pegar()
  {
    $turma  = Turma::
                    where('status', 'A')->
                    whereBetween('dt_inicio', [\Carbon\Carbon::now()->subMonths(2), \Carbon\Carbon::now()->addMonths(2) ])->
                    with('cbntdakklaoyfih')->
                    get();

    return $turma;
  }

  public function turmas_listar()
  {
    $turma  = Curso::get();

    return $turma;
  }

  public function turmas_adicionar()
  {
    return view('sistema.pedagogico.cursos.turmas.adicionar');
  }


  public function turmas_gravar(Request $request)
  {
    if($request->json())
    {
      try
      {
        $curso = Curso::find($request->id_curso);
        $curso->lcldxgfwmrzybmm()->syncWithoutDetaching($request->id_tipo);
        $curso->xlwznisvhoqjqpx()->syncWithoutDetaching($request->id_tipo);

        try
        {
          $turma = Turma::findOrFail($request->id_curso);

          return response()->json([
            'turma' => $turma,
            'redirect' => route('atd.turma')
          ], 200);
        }
        catch(\Exception $e)
        {
          $turma = Turma::create([
            'id'                      => $curso->id,
            'sigla'                    => $curso->sigla,
            'dia_pagamento'           => $request->dia_pagamento,
            'username'                => $request->username,
            'email'                   => $curso->email,
            'status'                  => 1,
            'password'                => Hash::make($request->password_confirmation),
          ]);
        }

        $turma['redirect'] = route('atd.turma');

        session()->flash('resposta', [
         'type'     => 'success',
         'message'  => "'$turma->sigla' foi incluído(a) como membro da turma.",
         'data'     => $turma->toArray(),
        ]);

        return $turma;
      }
      catch (ValidatorException $e)
      {
        dd('erro na exception no metodo store do controller curso');
        $response = [
          'success' => false,
          'error'   => true,
          'message' => $e->getMessageBag()
        ];

        return $response;
      }

    }
  }

  public function turmas_excluir($id)
  {
    $turma = Turma::find($id);
    $turma->delete();

    $response = [
        'type'    => 'success',
        'message' => "A turma '$turma->nome' foi deleteada com sucesso.",
        'data'    => $turma->toArray(),
    ];

    return $response;
  }

  public function turmas_restaurar($id)
  {
    $turma = Turma::onlyTrashed()->find($id);
    $turma->restore();

    $response = [
        'type'    => 'success',
        'message' => "A turma '$turma->nome' foi restaurada com sucesso.",
        'data'    => $turma->toArray(),
    ];

    return $response;
  }

  public function turmas_pesquisar(Request $request)
  {

    $dt_inicio = \Carbon\Carbon::parse($request->dt_inicio)->startOfDay();
    $dt_final  = \Carbon\Carbon::parse($request->dt_inicio)->startOfDay()->addDays(7);
    $dia_semana = $request->dia_semana;

    $turmas = Turma::
                    select( 'cod as id', 'dt_inicio as start', 'dt_final as end', 'sigla as title', 'horario', 'dia_semana', 'sala', 'id_curso' )->
                    where('dt_inicio', '<=', $dt_inicio )->
                    where('dt_final', '>=', $dt_final )->
                    where('dia_semana', 'LIKE', $dia_semana )->
                    where('status', '=', 'A' )->
                    // with('cbntdakklaoyfih' )->
                    get();

    return $turmas->toJson();

                    //   $dt_inicio
    // // })->
    // where( function ($query) use ($request)
    // {
    //   if ( isset( $request->pesquisa ) )
    //   {
    //     $query->
    //     orwhere('cod', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('id_curso', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('sigla', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('dt_inicio', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('dt_final', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('dia_semana', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('horario', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('sala', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('max_alunos', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orwhere('status', 'LIKE', '%'.$request->pesquisa.'%' )->
    //     orWhereHas('cbntdakklaoyfih', function ($q) use ($request)
    //     {
    //       return $q->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
    //     })->
    //     orWhereHas('sfhqwlkqwqwdlhk', function ($q) use ($request)
    //     {
    //       return $q->where('nome', 'LIKE', '%'.$request->pesquisa.'%');
    //     });
    //   }
    // })->
    // where( function ($query) use ($request)
    // {
    //   if ( isset( $request->cod ) )
    //   {
    //     $query->where('cod', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   // if ( isset( $request->id_curso ) )
    //   // {
    //   //   $query->whereHas('cbntdakklaoyfih', function ($q)
    //   //   {
    //   //     return $q->where('nome', 'LIKE', '%'.$request->sigla.'%');
    //   //   })->get();
    //   // }
    //   if ( isset( $request->sigla ) )
    //   {
    //     $query->where('sigla', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->dt_inicio ) )
    //   {
    //     $query->where('dt_inicio', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->dt_final ) )
    //   {
    //     $query->where('dt_final', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->dia_semana ) )
    //   {
    //     $query->where('dia_semana', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->horario ) )
    //   {
    //     $query->where('horario', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->sala ) )
    //   {
    //     $query->where('sala', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->max_alunos ) )
    //   {
    //     $query->where('max_alunos', 'LIKE', '%'.$request->sigla.'%' );
    //   }
    //   if ( isset( $request->status ) )
    //   {
    //     $query->where('status', 'LIKE', '%'.$request->status.'%' );
    //   }
    //   if ( isset( $request->id_instrutor ) )
    //   {
    //     $query->where('id_instrutor', 'LIKE', '%'.$request->id_instrutor.'%' );
    //   }
    //   if ( isset( $request->deleted_at ) )
    //   {
    //     $query->whereNotNull('deleted_at');
    //   }
    // })->
    //                   // where([
    //                   //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
    //                   //   // ['sigla'          , 'LIKE', '%'.$request->sigla.'%'],
    //                   //   // ['sexo'          , 'LIKE', '%'.$request->sexo.'%'],
    //                   //   // ['dt_nascimento' , 'LIKE', '%'.$request->dt_nascimento.'%'],
    //                   //   // ['cpf'           , 'LIKE', '%'.$request->cpf.'%'],
    //                   //   // ['observacao'    , 'LIKE', '%'.$request->observacao.'%'],
    //                   //   // ['email'         , 'LIKE', '%'.$request->email.'%'],
    //                   //   // ['facebook'      , 'LIKE', '%'.$request->facebook.'%'],
    //                   //   // ['instagram'     , 'LIKE', '%'.$request->instagram.'%'],
    //                   //   // ['id_criador'    , 'LIKE', '%'.$request->id_criador.'%']
    //                   // ])->
    //                   // orwhere([
    //                   //   // ['apelido'       , 'LIKE', '%'.$request->apelido.'%'],
    //                   //   // ['sigla'          , 'LIKE', '%'.$request->sigla.'%'],
    //                   //   // ['sexo'          , 'LIKE', '%'.$request->sexo.'%'],
    //                   //   // ['dt_nascimento' , 'LIKE', '%'.$request->dt_nascimento.'%'],
    //                   //   ['cpf'           , '=', NULL ],
    //                   //   // ['observacao'    , 'LIKE', '%'.$request->observacao.'%'],
    //                   //   // ['email'         , 'LIKE', '%'.$request->email.'%'],
    //                   //   // ['facebook'      , 'LIKE', '%'.$request->facebook.'%'],
    //                   //   // ['instagram'     , 'LIKE', '%'.$request->instagram.'%'],
    //                   //   // ['id_criador'    , 'LIKE', '%'.$request->id_criador.'%']
    //                   // ])->
    //                   // orderByRaw('-deleted_at DESC')->
    // orderBy(\DB::raw('ISNULL(deleted_at)'), 'DESC')->
    // orderBy($request->ordenar_por ?? 'sigla', $request->ordem ?? 'ASC')->
    // withTrashed()->
    // paginate($request->qtd_page == 'all' ? 999999999 : $request->qtd_page )->
    // appends($request->all());

  }
  
  public function turmas_plucar()
  {
    $turmas = Turma::
                    where('status', '=', 'A')->
                      get();

    return $turmas;
  }

  public function clientes(Request $request)
  {
    return view('sistema.pedagogico.cursos.clientes.index');
  }

  public function clientes_tabelar(Request $request)
  {
    $cursos = Curso::
                      whereHas('lcldxgfwmrzybmm', function($q)
                      {
                        $q->where('id_tipo', '=', 9);
                      })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->pesquisa ) )
                      //   {
                      //     $query->
                      //     orwhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('sigla', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                      //   }
                      // })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->sigla ) )
                      //   {
                      //     $query->where('sigla', 'LIKE', '%'.$request->sigla.'%' )->orwhere('sigla', 'LIKE', '%'.$request->sigla.'%' );
                      //   }
                      //   if ( isset( $request->sexo ) )
                      //   {
                      //     if ($request->sexo == "Não Informado")
                      //     {
                      //       $query->where('sexo', '=', null );
                      //     }
                      //     else
                      //     {
                      //       $query->where('sexo', 'LIKE', '%'.$request->sexo.'%' );
                      //     }
                      //   }
                      //   if ( isset( $request->dt_nascimento ) )
                      //   {
                      //     $query->where('dt_nascimento', 'LIKE', '%'.$request->dt_nascimento.'%' );
                      //   }
                      //   if ( isset( $request->cpf ) )
                      //   {
                      //     $query->where('cpf', 'LIKE', '%'.$request->cpf.'%' );
                      //   }
                      //   if ( isset( $request->deleted_at ) )
                      //   {
                      //     $query->whereNotNull('deleted_at');
                      //   }
                      // })->
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

    // $cursos = Curso::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.pedagogico.cursos.clientes.tabelar', [
      'cursos' => $cursos,
    ]);
  }

  public function clientes_adicionar()
  {
    return view('sistema.pedagogico.cursos.clientes.adicionar');
  }

  public function clientes_gravar(Request $request)
  {
    if($request->json())
    {
      try
      {
        $curso = Curso::find($request->id_curso);
        $curso->lcldxgfwmrzybmm()->syncWithoutDetaching($request->id_tipo);
        $curso->xlwznisvhoqjqpx()->syncWithoutDetaching($request->id_tipo);

        try
        {
          $clientes = Turma::findOrFail($request->id_curso);

          return response()->json([
            'clientes' => $clientes,
            'redirect' => route('atd.clientes')
          ], 200);
        }
        catch(\Exception $e)
        {
          $clientes = Turma::create([
            'id'                      => $curso->id,
            'nome'                    => $curso->nome,
            'dia_pagamento'           => $request->dia_pagamento,
            'username'                => $request->username,
            'email'                   => $curso->email,
            'status'                  => 1,
            'password'                => Hash::make($request->password_confirmation),
          ]);
        }

        $clientes['redirect'] = route('atd.clientes');

        session()->flash('resposta', [
         'type'     => 'success',
         'message'  => "'$clientes->nome' foi incluído(a) como membro da clientes.",
         'data'     => $clientes->toArray(),
        ]);

        return $clientes;
      }
      catch (ValidatorException $e)
      {
        dd('erro na exception no metodo store do controller curso');
        $response = [
          'success' => false,
          'error'   => true,
          'message' => $e->getMessageBag()
        ];

        return $response;
      }

    }
  }

// ============================================================================================================ contatos
  public function contatos(Request $request)
  {
    return view('sistema.pedagogico.cursos.contatos.index');
  }

  public function contatos_tabelar(Request $request)
  {
    $cursos = Contato::
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->pesquisa ) )
                      //   {
                      //     $query->
                      //     orwhere('apelido', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('nome', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('sexo', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('dt_nascimento', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('cpf', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('observacao', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('email', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('facebook', 'LIKE', '%'.$request->pesquisa.'%' )->
                      //     orwhere('instagram', 'LIKE', '%'.$request->pesquisa.'%' );
                      //   }
                      // })->
                      // where( function ($query) use ($request)
                      // {
                      //   if ( isset( $request->nome ) )
                      //   {
                      //     $query->where('nome', 'LIKE', '%'.$request->nome.'%' )->orwhere('nome', 'LIKE', '%'.$request->nome.'%' );
                      //   }
                      //   if ( isset( $request->sexo ) )
                      //   {
                      //     if ($request->sexo == "Não Informado")
                      //     {
                      //       $query->where('sexo', '=', null );
                      //     }
                      //     else
                      //     {
                      //       $query->where('sexo', 'LIKE', '%'.$request->sexo.'%' );
                      //     }
                      //   }
                      //   if ( isset( $request->dt_nascimento ) )
                      //   {
                      //     $query->where('dt_nascimento', 'LIKE', '%'.$request->dt_nascimento.'%' );
                      //   }
                      //   if ( isset( $request->cpf ) )
                      //   {
                      //     $query->where('cpf', 'LIKE', '%'.$request->cpf.'%' );
                      //   }
                      //   if ( isset( $request->deleted_at ) )
                      //   {
                      //     $query->whereNotNull('deleted_at');
                      //   }
                      // })->
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

    // $cursos = Curso::
                       // where('id', '!=', 2)->
                       // paginate(25);

    return view('sistema.pedagogico.cursos.contatos.tabelar', [
      'cursos' => $cursos,
    ]);
  }

  public function contatos_adicionar()
  {
    return view('sistema.pedagogico.cursos.contatos.adicionar');
  }

  public function contatos_gravar(Request $request)
  {
    if (isset($request->nome) && isset($request->empresa) && isset($request->email) && isset($request->telefone) && isset($request->mensagem))
    {
      try
      {
        $contatos = Contato::create([
              'nome'     => $request->nome,
              'empresa'  => $request->empresa,
              'email'    => $request->email,
              'telefone' => $request->telefone,
              'mensagem' => $request->mensagem,
            ]);

        session()->flash('resposta', [
          'type'     => 'success',
          'message'  => "Obrigado por nos contactar.",
          'data'     => $contatos->toArray(),
        ]);

        return 'success';
      }
      catch (ValidatorException $e)
      {
        dd('erro na exception no metodo store do controller curso');
        $response = [
          'success' => false,
          'error'   => true,
          'message' => $e->getMessageBag()
        ];

        return $response;
      }
    }
    else
    {
      return 'warning';
    }
  }



// ============================================================================================================ contatos


  public function clientes_dashboard()
  {
    return view('sistema.cursos.clientes.dashboard');
  }

  public function todos_clientes()
  {
    $clientes = Curso::get();

    return $clientes;
  }


// ============================================================================================================ contatos



  public function cursos_listar_fornecedores()
  {
    $fornecedores = Curso::select('id', 'nome')->get();

    return $fornecedores;
  }

  // =======================================================================================================================================================================

  public function projecao()
  {
    return view('sistema.pedagogico.projecao.index');
  }
}
