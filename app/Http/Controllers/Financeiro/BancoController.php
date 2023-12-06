<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Financeiro\Banco;
use App\Models\PDV\Caixa;

class BancoController extends Controller
{
  public function index()
  {
    $bancos = Banco::get();

    return view('sistema.financeiro.caixas.index', [
      'caixa'  => $banco,
      'caixas' => $bancos,
    ]);
  }

  public function filtrar(Request $request)
  {
    $dataForm = $request->except('_token');

    if($request->dt_inicio OR $request->dt_final)
    {
      $dt_inicio = $request->dt_inicio.'00:00:00';
      $dt_final  = $request->dt_final.'23:59:59';
    }
    else
    {
      $dt_inicio = \Carbon\Carbon::now()->startOfYear();
      $dt_final  = \Carbon\Carbon::now()->endOfMonth();
    }

    $marcas = Banco::where('tipo', 'Serviço')->where('tipo', 'Serviço')->select('marca')->distinct()->get();

    $servicos = Banco::where('tipo', 'Serviço')->where('tipo', 'Serviço')->where(function ($query) use ($dataForm)
    {
      if(isset($dataForm['nome']))
        $query->where('nome', 'LIKE', '%'.$dataForm['nome'].'%');

      if(isset($dataForm['marca']))
      {
        $query->where('marca', 'LIKE', '%'.$dataForm['marca'].'%');
      }
    })
    ->paginate(10);

    return view('sistema.cadastros.servicos.index',[
      'servicos'    => $servicos,
      'marcas'      => $marcas,
      'dataForm'    => $dataForm,
    ]);
  }

  public function create()
  {
    return view('sistema.financeiro.caixas.create');
  }

  public function procurar(Request $request)
  {
    $banco = Banco::where('id_banco', '=', $request->id_banco)->orderBy('id', 'desc')->first();

    return $banco;
  }

  public function store(Request $request)
  {
    $banco = Banco::create($request->toArray());

    session()->flash('resposta', [
      'type'    => 'success',
      'message' => "O caixa '$banco->id' foi aberto com sucesso.",
      'data'    => $banco->toArray(),
   ]);

    return redirect()->route('pdv.caixas');
  }

  public function show($id)
  {

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



  // BANCOS 
  public function load_Bancos()
  {
    return Banco::get();
  }

  public function store_Bancos(Request $request)
  {    
    $dados = Banco::create($request->all());
    $dados->type     = 'success';
    $dados->message  = "Tipo '".$dados->nome."' adicionado com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function show_Bancos($id)
  {

  }

  public function edit_Bancos($id)
  {

  }

  public function update_Bancos(Request $request, $id)
  {

  }

  public function delete_Bancos($id)
  {
    $tipo = Banco::find($id);

    $nome    = $tipo->nome;
    $dados['data']    = $tipo->delete();
    $dados['type']    = 'warning';
    $dados['message'] = "Tipo '$nome' removido com sucesso.";

    session()->flash('resposta', [
     'type'     => $dados['type'],
     'message'  => $dados['message'],
     'data'     => $dados,
   ]);

    return $dados;
  }

  public function transferencia($id)
  {
    return Banco::where('id', '!=', $id)->get();
  }


  public function CaixaAberto($id_banco)
  {
    $dados = Caixa::where('id_banco', '=', $id_banco)->where('status', '=', 'Aberto')->first();

    if(isset($dados->id) && ($dados->id > 1))
    {
      $id_caixa = $dados->id;
    }
    else
    {
      $id_caixa = null;      
    }

    return $id_caixa;
  }

  public function bancos_saldos_widgets()
  {
    $saldos = Banco::get(['id', 'nome', 'saldo_inicial']);
    
    return $saldos; 
  }
}
