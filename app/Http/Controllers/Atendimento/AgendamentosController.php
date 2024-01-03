<?php

namespace App\Http\Controllers\Atendimento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Atendimento\AgendaOrdem as DBAgendaOrdem;
use App\Models\Atendimento\Agendamento as DBAgendamento;

class AgendamentosController extends Controller
{
	public function resources()
	{
		return DBAgendaOrdem::
							select('ordem', 'area', 'id_pessoa' )->
							where('auth_user', '=', auth()->User()->id)->
							with('oewoekdwjzsdlkd')->
							get()->
							map(function (DBAgendaOrdem $model)
							{
								return [ 
									'id'       => $model->id_pessoa,
									'ordem'    => $model->ordem,
									'area'     => $model->area,
									'title'    => $model->oewoekdwjzsdlkd->apelido,
									'src_foto' => $model->oewoekdwjzsdlkd->src_foto,
								];
							});
	}

	public function events()
    {
        $start  = (!empty($request->start)) ? ($request->start) : ('');
        $end    = (!empty($request->end)) ? ($request->end) : ('');
        
        $start  = \Carbon\Carbon::today()->startOfDay();
        $end    = \Carbon\Carbon::today()->endOfDay();
        
        $returnedColumns = [
            'id',
            'start',
            'end',
            'id_cliente',
            'id_profexec',
            'id_servprod',
            'id_comanda',
            'valor',
            'obs',
            'status',
            // 'title',
            // 'resourceId'
        ];

		return DBAgendamento::
                            whereBetween('start', [ $start, $end ])->
                            where('id_profexec', '=', [ array_column($this->resources()->toArray(), 'id') ])->
                            get($returnedColumns);
							// ->
							// map(function (DBAgendamento $model)
							// {
								// 	return [ 
									// 		'id'       => $model->id_pessoa,
									// 		'ordem'    => $model->ordem,
									// 		'area'     => $model->area,
									// 		'title'    => $model->oewoekdwjzsdlkd->apelido,
									// 		'src_foto' => $model->oewoekdwjzsdlkd->src_foto,
								// 	];
							// });
	}

	public function agendamentos_index()
	{
		$resources = $this->resources();
		$events    = $this->events();

		return view('sistema/atendimentos/agendamentos/index', [
			'resources' => $resources,
			'events'    => $events,
		]);
	}
	
  public function agendamentos_widget()
  {
    $start = \Carbon\Carbon::today()->startOfMonth();
    $end   = \Carbon\Carbon::today()->endOfMonth();

    $agendamentos = Agendamento::
                                whereBetween('start', [$start, $end])->
                                where('id_profexec', '=', \Auth::User()->id )->
                                get(['id', 'start', 'id_profexec', 'status']);
                                
    return response()->json($agendamentos);
  }
  
  public function agendamentos_semana_widget()
  {
    $start = \Carbon\Carbon::today()->startOfWeek();
    $end   = \Carbon\Carbon::today()->endOfWeek();

    $agendamentos = Agendamento::
                                whereBetween('start', [$start, $end])->
                                where('status', '!=', 'Excluído' )->
                                count();

    return $agendamentos;
  }
  
  public function carregar(Request $request)
  {
    $returnedColumns = [
      'id',
      'start',
      'end',
      'id_cliente',
      'id_profexec',
      'id_servprod',
      'id_comanda',
      'valor',
      'obs',
      'status',
      // 'title',
      // 'resourceId'
    ];

    // 'kdfalsjdlk_c_l_i_e_n_t_easjdlaskjdlkasjd'{
      // 'apelido',
      // 'nome',
      // 'nomes',

    $start  = (!empty($request->start)) ? ($request->start) : ('');
    $end    = (!empty($request->end)) ? ($request->end) : ('');

    $eventos = Agendamento::WhereBetween('start', [ $start, $end ])->get($returnedColumns);
    
    return response()->json($eventos);
  }
  
  public function loadEvents(Request $request)
  {
    $returnedColumns = [
      'id',
      'start',
      'end',
      'id_cliente',
      'id_profexec',
      'id_servprod',
      'id_comanda',
      'valor',
      'obs',
      'status',
      // 'title',
      // 'resourceId'
    ];

    // 'kdfalsjdlk_c_l_i_e_n_t_easjdlaskjdlkasjd'{
      // 'apelido',
      // 'nome',
      // 'nomes',

    $start  = (!empty($request->start)) ? ($request->start) : ('');
    $end    = (!empty($request->end)) ? ($request->end) : ('');

    $events = Agendamento::WhereBetween('start', [ $start, $end ])->get($returnedColumns);

    return response()->json($events);
  }

  public function list(Request $request)
  {
    if($request->ajax())
    {
      $query = $request->get('query');
      
      if($query != '')
      {
        $agendas = $this->repository->findWhere([
                    ['nome', 'like', '%'.$query.'%' ],
                  ]);
      }
      else
      {
        $agendas = $this->repository->paginate();
      }
    }
    else
    {
      $agendas = $this->repository->paginate();
    }

    return view('sistema/atendimentos/agendamentos/list', [
     'agendas'      =>   $agendas,
    ]);
  }

  public function create()
  {
    return view('sistema/atendimentos/agendamentos/create');
  }

  // public function store(AgendaRequest $request)
  public function store(Request $request)
  {
    $event = Agendamento::create($request->all());
      
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Agendamento de '.$event->title.' criado com sucesso em '.\Carbon\Carbon::parse($event->start)->format('d/m/Y H:i').'.',
      'data'    => $event,
    ];

    return $response;
  }

  public function show($id)
  {
    $agenda = $this->repository->find($id);

    return view('sistema/atendimentos/agendamentos/show', [
      'agenda' => $agenda,
    ]);
  }

  public function edit($id)
  {
    $agenda = $this->repository->find($id);

    return view('sistema/atendimentos/agendamentos/edit', [
      'agenda' => $agenda,
    ]);
  }

  // public function update(AgendaRequest $request)
  public function update(Request $request)
  {
    $event = Agendamento::find($request->id);

    $event->update($request->all());
    
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Agendamento de '.$event->title.' atualizado com sucesso para '.\Carbon\Carbon::parse($event->start)->format('d/m/Y H:i').'.',
      'data'    => $event,
    ];

    return $response;    
  }

  public function destroy(Request $request)
  {
    $event = Agendamento::find($request->id);

    $excluido = Agendamento::destroy($request->id);

    $response = [
      'error'   => false,
      'type'    => 'warning',
      'message' => 'Agendamento de '.$event->title.' excluido com sucesso de '.\Carbon\Carbon::parse($event->start)->format('d/m/Y H:i').'.',
      'data'    => $event,
    ];

    return $event;
  }

  public function profissionalProduto($id)
  {
    // $dado = $this->repository->find($id)->AtdProdutosAgendas;
    $dado = $this->repository->Servico($id);

    return response()->json($dado);
  }

  public function info($id)
  {
    $dado = $this->repository->with('AtdAgendasTipos')->find($id);

    return response()->json($dado);
  }

  public function aniversariantes()
  {
    $dados = $this->repository->Aniversariantes();

    return view('sistema/atendimentos/agendas', [
     'dados'   =>   $dados,
    ]);
  }

  // public function list(Request $request)
  // {
  //   $colaboradores = $this->repository->TipoAgenda($request['tipo']);

  //   return $colaboradores;
  // }
// ===========================================================================================================================


  public function manicure_index()
  {
    $agendamentos   = $this->repository->get();
    $clientes       = $this->repository->clientes();
    $profissionais  = $this->repository->profissionais();

    return view('sistema/atendimentos/agendamentos/manicures',[
      'agendamentos'    => $agendamentos,
      'clientes'        => $clientes,
      'profissionais'   => $profissionais,
    ]);
  }

  public function manicure_loadEvents(Request $request)
  {
    // $returnedColumns = ['id', 'title', 'obs', 'start', 'end', 'color' ];

    $start  = (!empty($request->start)) ? ($request->start) : ('');
    $end    = (!empty($request->end)) ? ($request->end) : ('');

    $events = Agendamento::WhereBetween('start', [ $start, $end ])->get();
    
    return response()->json($events);
  }

  public function manicure_store(AgendaRequest $request)
  {
    $event = Agendamento::create($request->all());

    return $event;
  }

  public function manicure_update(AgendaRequest $request)
  {
    $event = Agendamento::find($request->id);
    $event->update($request->all());
    return $event;
    return response()->json(true);
  }

  public function manicure_destroy(Request $request)
  {
    $event = Agendamento::destroy($request->id);

    return $event;
  }

  public function procurarAgendamentos(Request $request)
  {
    $start = \Carbon\Carbon::today();
    $end   = \Carbon\Carbon::tomorrow();
    
    $agendamentos = Agendamento::
    where('id_cliente', $request->id_cliente)->
                            // where('status', '!=', 'Faltou')->
                            // where('status', '!=', 'Atrasado')->
                            whereBetween('start', [$start, $end])->
                            with('kdfalsjdlkPROFISSIONALasjdlaskjdlkasjd')->
                            with('kdfalsjdlkSERVICOPRODUTOasjdlaskjdlkasjd')->
                            get();
                            
                            return $agendamentos;
  }
  
  public function tabela()
  {
    $agendamentos = Agendamento::orderBy('created_at', 'desc')->paginate(500);

    return view('sistema/atendimentos/agendamentos/tabela',[
      'agendamentos'    => $agendamentos,
    ]);
  }

}
