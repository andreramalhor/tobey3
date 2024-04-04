<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

// use App\Models\Financeiro\Lancamento;
use App\Models\PDV\Caixa;
use App\Models\PDV\VendaPagamento;

class Banco extends Model
{
	use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados

  public $timestamps = true;

  protected $table      = 'fin_bancos';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_empresa',
    'nome',
    'num_banco',
    'num_agencia',
    'num_conta',
    'saldo_inicial',
    'cod_carteira',
    'chave_pix',
    'pix',
  ];
  protected $appends = [
    // 'saldo_atual',
  ];

  // AUXILIARES              ===========================================================================================
  public static function procurar($pesquisa)
  {
    return empty($pesquisa)
    ? static::query()
    : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
                      ->orWhere('num_banco', 'LIKE', '%'.$pesquisa.'%')
                      ->orWhere('num_agencia', 'LIKE', '%'.$pesquisa.'%')
                      ->orWhere('num_conta', 'LIKE', '%'.$pesquisa.'%')
                      ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
  }

  public static function saldo($id, $dt_limite = null)
  {
    $dt_limite = is_null($dt_limite) ? : $dt_limite;

    $saldoInicial = Banco::find($id)->saldo_inicial;

    $lancamentos = Lancamento::
                            selectRaw("
                              SUM(CASE WHEN tipo = 'D' THEN vlr_final ELSE 0 END) AS despesas,
                              SUM(CASE WHEN tipo = 'R' THEN vlr_final ELSE 0 END) AS receitas,
                              SUM(CASE WHEN tipo = 'T' AND vlr_final < 0 THEN vlr_final ELSE 0 END) AS transferencias_saidas,
                              SUM(CASE WHEN tipo = 'T' AND vlr_final >= 0 THEN vlr_final ELSE 0 END) AS transferencias_entradas
                            ")->
                            where('id_banco', '=', $id)->
                            where('status', '=', 'Confirmado')->
                            whereDate('dt_recebimento', '<=', $dt_limite)->
                            first();

    $pagamentosVendas = Caixa::
                            where('id_banco', '=', $id)->
                            latest()->
                            first();

    // Obter recebimento em cartão de crédito
    $recebimentoCartao = RecebimentoCartao::
                            where('id_banco', '=', $id)->
                            where('status', '=', 'Confirmado')->
                            whereDate('dt_recebimento', '<=', $dt_limite)->
                            sum('vlr_final');

    // Calcular saldo atual
    return $saldoInicial - $lancamentos->despesas + $lancamentos->receitas - $lancamentos->transferencias_saidas + $lancamentos->transferencias_entradas + ($pagamentosVendas ? $pagamentosVendas->saldo_atual : 0) + $recebimentoCartao;
  }
  
  public static function extrato($id, $dt_inicial, $dt_final)
  {
    $dt_inicial = is_null($dt_inicial) ? $dt_inicial : \Carbon\Carbon::now()->startOfMonth();
    $dt_inicial = '2023-01-01';
    $dt_final   = is_null($dt_final)   ? $dt_final   : \Carbon\Carbon::now();

    $lancamentos = Lancamento::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        whereBetween('dt_recebimento', [$dt_inicial, $dt_final])->
                        withTrashed()->
                        get();
                        
    $recebimentoCartoes = RecebimentoCartao::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        whereBetween('dt_recebimento', [$dt_inicial, $dt_final])->
                        withTrashed()->
                        get();
                        
    $contasAReceberAlunos = AReceber::
                        where('id_banco', '=', $id)->
                        where('status', '=', 'Confirmado')->
                        whereBetween('dt_recebimento', [$dt_inicial, $dt_final])->
                        withTrashed()->
                        get();

    return $lancamentos->merge($recebimentoCartoes)->merge($contasAReceberAlunos);
  }

// RELACIONAMENTOS  ===========================================================================================
//   public function FinLancamentos()
//   {
//     return $this->hasMany(Lancamento::class, 'id_banco', 'id');    
//   }

  public function iesbdkwdkadqfgh()
  {
    return $this->hasMany(Caixa::class, 'id_banco', 'id');    
  }

  // MÉTODOS          ===========================================================================================
  public function setSaldoInicialAttribute($value)
  {
    $this->attributes['saldo_inicial'] = str_replace(',', '.', str_replace('.', '', $value));
  }
  
  // MUTATORS         ===========================================================================================
  public function getSaldoAtualAttribute()
  {
    $saldoInicial = $this->saldo_inicial;

    $lancamentos = Lancamento::
                            selectRaw("
                              SUM(CASE WHEN tipo = 'D' THEN vlr_final ELSE 0 END) AS despesas,
                              SUM(CASE WHEN tipo = 'R' THEN vlr_final ELSE 0 END) AS receitas,
                              SUM(CASE WHEN tipo = 'T' AND vlr_final < 0 THEN vlr_final ELSE 0 END) AS transferencias_saidas,
                              SUM(CASE WHEN tipo = 'T' AND vlr_final >= 0 THEN vlr_final ELSE 0 END) AS transferencias_entradas
                            ")->
                            where('id_banco', '=', $this->id)->
                            where('status', '=', 'Confirmado')->
                            whereDate('dt_recebimento', '<=', \Carbon\Carbon::now())->
                            first();

    // // Obter lançamentos
    // $despesas = Lancamento::
    //                         where('id_banco', '=', $this->id)->
    //                         where('status', '=', 'Confirmado')->
    //                         whereDate('dt_recebimento', '<=', \Carbon\Carbon::now())->
    //                         get('vlr_final');

    // // Obter despesas
    // $despesas = Lancamento::
    //                         where('id_banco', '=', $this->id)->
    //                         where('status', '=', 'Confirmado')->
    //                         whereDate('dt_recebimento', '<=', \Carbon\Carbon::now())->
    //                         where('tipo', '=', 'D')->
    //                         sum('vlr_final');

    // // Obter receitas
    // $receitas = Lancamento::
    //                         where('id_banco', '=', $this->id)->
    //                         where('status', '=', 'Confirmado')->
    //                         whereDate('dt_recebimento', '<=', \Carbon\Carbon::now())->
    //                         where('tipo', '=', 'R')->
    //                         sum('vlr_final');

    // // Obter transferências
    // $transferencias = Lancamento::
    //                         where('id_banco', '=', $this->id)->
    //                         where('status', '=', 'Confirmado')->
    //                         whereDate('dt_recebimento', '<=', \Carbon\Carbon::now())->
    //                         where('tipo', '=', 'T')->
    //                         sum('vlr_final');
                            
    // Obter pagamentos de vendas
    $pagamentosVendas = Caixa::
                            where('id_banco', '=', $this->id)->
                            latest()->
                            first();

    // Obter recebimento em cartão de crédito
    $recebimentoCartao = RecebimentoCartao::
                            where('id_banco', '=', $this->id)->
                            where('status', '=', 'Confirmado')->
                            whereDate('dt_recebimento', '<=', \Carbon\Carbon::now())->
                            sum('vlr_final');

    // Calcular saldo atual
    return $saldoInicial - $lancamentos->despesas + $lancamentos->receitas - $lancamentos->transferencias_saidas + $lancamentos->transferencias_entradas + ($pagamentosVendas ? $pagamentosVendas->saldo_atual : 0) + $recebimentoCartao;
    // return $saldoInicial - $despesas + $receitas + $transferencias + ($pagamentosVendas ? $pagamentosVendas->saldo_atual : 0) + $recebimentoCartao;
  }
}