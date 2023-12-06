<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Configuracao\Mensagem;
use App\Models\Atendimento\Pessoa;
use App\Models\Atendimento\Agendamento;

class MensagemController extends Controller
{
  public function mensagens()
  {
    return view('sistema.configuracao.mensagens.index');
  }

  public function mensagens_tabelar()
  {
    $mensagens = Mensagem::get();

    return view('sistema.configuracao.mensagens.tabelar', [
      'mensagens'  => $mensagens,
    ]);
  }

  public function create()
  {

  }

  public function store(Request $request)
  {
    $event = Mensagem::create($request->all());
      
    $response = [
      'error'   => false,
      'type'    => 'success',
      'message' => 'Conta '.$event->descricao.'" criado com sucesso.',
      'data'    => $event,
    ];

    // return route('mensagens.index')->with($response);
    return redirect()->back()->with($response);

  }

  public function show($id)
  {

  }

  public function mensagens_editar($id)
  {
    $mensagem = Mensagem::find($id);

    return view('sistema.configuracao.mensagens.editar', [
      'mensagem' => $mensagem,
    ]);
  }

  public function mensagens_atualizar(Request $request, $id)
  {
    $mensagem = Mensagem::find($id);
    $mensagem->update($request->all());
    
    $response = [
      'error'    => false,
      'type'     => 'success',
      'message'  => 'Mensagem atualizada com sucesso.',
      'data'     => $mensagem,
      'redirect' => route('cfg.mensagens'),
    ];

    return $response;    
  }

  public function destroy($id)
  {

  }

  public function search(Request $request)
  {
    $mensagens = Mensagem::where('conta_pai', '=', $request->conta_pai)->where('nivel', '=', $request->nivel)->orderBy('conta')->get();

    return $mensagens;
  }

  public function dre()
  {
    $mensagens            = Mensagem::where('imprime', '=', 'Sim')->orderBy('conta')->get();
    $pagamentos_vendas = VendaPagamento::where('id', '!=', 82)->where('id', '!=', 83)->where('dt_prevista', '>=', '2021-01-01 00:00:00')->where('dt_prevista', '<=', '2021-12-31 23:59:59')->select(\DB::raw('SUM(valor) AS valor'), 'id_forma_pagamento', \DB::raw('MONTH(dt_prevista) AS month'))->groupby('month', 'id_forma_pagamento')->orderBy('month')->get();
    $comissoes         = ContaInterna::whereBetween('updated_at', ['2021-01-01 00:00:00', '2021-12-31 23:59:59'])->whereIn('fonte_origem', ['pdv_vendas_detalhes', 'fin_conta_interna'])->where('status', '=', 'Pago')->select(\DB::raw('SUM(valor) AS valor'), 'id_pessoa', \DB::raw('MONTH(updated_at) AS month'))->groupby('month', 'id_pessoa')->orderBy('month')->get();

    $receitas    = Venda::where('created_at', '>=', '2021-01-01 00:00:00')->where('created_at', '<=', '2021-12-31 23:59:59')->orderBy('created_at')->select('*', \DB::raw('MONTH(created_at) month'))->get()->groupby('month');
    $lancamentos = Lancamento::where('dt_recebimento', '>=', '2021-01-01 00:00:00')->where('dt_recebimento', '<=', '2021-12-31 23:59:59')->select(\DB::raw('SUM(vlr_final) AS valor'), 'id_conta', \DB::raw('MONTH(dt_recebimento) AS month'))->groupby('month', 'id_conta')->orderBy('id_conta')->orderBy('month')->get();

    // dd($lancamentos);
    // $pessoas = Venda::where('created_at', '>=', '2021-01-01 00:00:00')->where('created_at', '<=', '2021-12-31 23:59:59')->orderBy('created_at')->get();
    return view('sistema.mensagens.dre', [
      'mensagens'             => $mensagens,
      'receitas'           => $receitas,
      'lancamentos'        => $lancamentos,
      'pagamentos_vendas'  => $pagamentos_vendas,
      'comissoes'          => $comissoes,
    ]);
  }

  public function mensagens_plucar( $imprime = null, $lanca = null )
  {
    $mensagens = Mensagem::
            where('imprime', '=', 'Sim')->
            orderBy('conta')->
            get();

    return $mensagens;
  }

  public function mensagens_preencher(Request $request)
  {
    $mensagens = Mensagem::
                          where('area', '=', $request->area)->
                          where('id_empresa', '=', \Auth::User()->id_empresa )->
                          first()->testemsg;

    if($request->area == 'Aniversário')
    {
      $pessoa = Pessoa::find($request->id_pessoa);
    }
    else if ($request->area == 'Agendamento (criação)')
    {
      $agendamento = Agendamento::find($request->id_agendamento);
      $pessoa = $agendamento->xhooqvzhbgojbtg;
    }
    else
    {
      return 'Sem mensagem predefinida';
      $pessoa = Pessoa::find(\Auth::User()->id);
    }

    $mensagem = str_replace(':atd-pessoa-id',                       $pessoa->id ?? 'id',                              $mensagens);
    
    $mensagem = str_replace(':atd-pessoa-apelido',                  $pessoa->apelido ?? 'apelido',                    $mensagem);
    $mensagem = str_replace(':atd-pessoa-nome',                     $pessoa->nome ?? 'nome',                          $mensagem);
    $mensagem = str_replace(':atd-pessoa-dt_nascimento',            $pessoa->dt_nascimento ?? 'dt_nascimento',        $mensagem);
    $mensagem = str_replace(':atd-pessoa-sexo',                     $pessoa->sexo ?? 'sexo',                          $mensagem);
    $mensagem = str_replace(':atd-pessoa-cpf',                      $pessoa->cpf ?? 'cpf',                            $mensagem);
    $mensagem = str_replace(':atd-pessoa-email',                    $pessoa->email ?? 'email',                        $mensagem);
    $mensagem = str_replace(':atd-pessoa-observacao',               $pessoa->observacao ?? 'observacao',              $mensagem);
    $mensagem = str_replace(':atd-pessoa-instagram',                $pessoa->instagram ?? 'instagram',                $mensagem);

    $mensagem = str_replace(':atd-pessoa-endereco-tipo',            optional($pessoa->uqbchiwyagnnkip->first())->tipo_endereco, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-cep',             optional($pessoa->uqbchiwyagnnkip->first())->cep, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-numero',          optional($pessoa->uqbchiwyagnnkip->first())->numero, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-complemento',     optional($pessoa->uqbchiwyagnnkip->first())->complemento, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-logradouro',      optional($pessoa->uqbchiwyagnnkip->first())->logradouro, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-bairro',          optional($pessoa->uqbchiwyagnnkip->first())->bairro, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-cidade',          optional($pessoa->uqbchiwyagnnkip->first())->cidade, $mensagem);
    $mensagem = str_replace(':atd-pessoa-endereco-estado',          optional($pessoa->uqbchiwyagnnkip->first())->estado, $mensagem);

    $mensagem = str_replace(':atd-pessoa-contato-tipo',             optional($pessoa->ginthgfwxbdhwtu->first())->tipo, $mensagem);
    $mensagem = str_replace(':atd-pessoa-contato-ddd',              optional($pessoa->ginthgfwxbdhwtu->first())->ddd, $mensagem);
    $mensagem = str_replace(':atd-pessoa-contato-numero',           optional($pessoa->ginthgfwxbdhwtu->first())->numero, $mensagem);
    
    if( isset($agendamento) && $agendamento->count() > 0 )
    {
      $mensagem = str_replace(':atd-pessoa-agendamento-data',         \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $agendamento->start ?? now())->format('d/m/Y'), $mensagem);
      $mensagem = str_replace(':atd-pessoa-agendamento-inicio',       \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $agendamento->start ?? now())->format('H:i'), $mensagem);
      $mensagem = str_replace(':atd-pessoa-agendamento-ate',          \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $agendamento->end ?? now())->format('H:i'), $mensagem);
      $mensagem = str_replace(':atd-pessoa-agendamento-profissional', optional($agendamento->hhmaqpijffgfhmj)->nome, $mensagem ?? '');
      $mensagem = str_replace(':atd-pessoa-agendamento-servico',      optional($agendamento->zlpekczgsltqgwg)->servico, $mensagem ?? '');
      $mensagem = str_replace(':atd-pessoa-agendamento-status',       $agendamento->status  , $mensagem ?? '');
    }

    return $mensagem;
  }
}
