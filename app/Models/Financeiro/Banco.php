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
    'saldo_atual',
  ];

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
    //Tabela Lançamentos
    $despesas = Lancamento::
                      where('id_banco', '=', $this->id)->
                      where('status', '=', 'Confirmado')->
                      whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->
                      where('tipo', '=', 'D')->
                      sum('vlr_final');
    
    //Tabela Lançamentos
    $receitas = Lancamento::
                      where('id_banco', '=', $this->id)->
                      where('status', '=', 'Confirmado')->
                      whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->
                      where('tipo', '=', 'R')->
                      sum('vlr_final');

    //Tabela Lançamentos
    $transferencias = Lancamento::
                      where('id_banco', '=', $this->id)->
                      where('status', '=', 'Confirmado')->
                      whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->
                      where('tipo', '=', 'T')->
                      sum('vlr_final');

    //Tabela Venda Pagamento (em dinheiro)
    $pagamentos_vendas = Caixa::
                      where('id_banco', '=', $this->id)->
                      latest()->
                      first();
                      // get();

                      //Parcelas Cursos Pagas
    $parcelas_cursos = AReceber::
                      where('id_banco', '=', $this->id)->
                      where('status', '=', 'Confirmado')->
                      whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->
                      sum('vlr_final');

    //Recebimento de vendas em Cartão de Crédito
    $recebimento_cartao = RecebimentoCartao::
                      where('id_banco', '=', $this->id)->
                      where('status', '=', 'Confirmado')->
                      whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->
                      sum('vlr_final');

    return                                      $this->saldo_inicial
                                                         - $despesas
                                                         + $receitas
                                                   + $transferencias
 + (!isset($pagamentos_vendas) ? 0 : $pagamentos_vendas->saldo_atual) 
                                                  + $parcelas_cursos 
                                               + $recebimento_cartao;
  }


}