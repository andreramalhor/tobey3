<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

use App\Models\Atendimento\Pessoa;

class Divida extends Model
{
	use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados

  public $timestamps = true;

  protected $table      = 'fin_dividas';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_cliente',
    'observacao',
    'atualizada',
    'criado_por',
  ];
  // protected $appends = [
  //   'saldo_banco',
  // ];

// RELACIONAMENTOS  ===========================================================================================
//   public function FinLancamentos()
//   {
//     return $this->hasMany(Lancamento::class, 'id_banco', 'id');    
//   }

  public function asdasdasd()
  {
    return $this->hasMany(Caixa::class, 'id_banco', 'id');    
  }
// // MUTATORS         ===========================================================================================
//   public function getSaldoBancoAttribute()
//   {
//     $saldo =
//               $this->saldo_inicial
//             - Lancamento::where('id_banco', '=', $this->id)->whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->where('tipo', '=', 'D')->sum('vlr_final')
//             + Lancamento::where('id_banco', '=', $this->id)->whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->where('tipo', '=', 'R')->sum('vlr_final')
//             + Lancamento::where('id_banco', '=', $this->id)->whereDate('dt_recebimento', '<=', \Carbon\Carbon::today())->where('tipo', '=', 'T')->sum('vlr_final');

//     return $saldo;
//   }

// MÉTODOS          ===========================================================================================

}