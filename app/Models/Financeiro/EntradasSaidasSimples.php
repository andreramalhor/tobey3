<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Atendimento\Pessoa;

class EntradasSaidasSimples extends Model
{
	use SoftDeletes;

  public $timestamps = true;

  protected $table      = 'fin_entradas_saidas_extrato';
  protected $primaryKey = 'id';
  protected $fillable = [
		'tipo',
		'local',
		'data_pagamento',
		'valor',
		'descricao',
		'id_cliente',
		'parcela',
  ];
  protected $appends = [
    'saldo_final',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function CAYLZSOFFDLPONA()
  {
    return $this->hasOne(Pessoa::class, 'id','id_cliente')->withTrashed();
  }

// MUTATORS         ===========================================================================================
  public function getSaldoFinalAttribute()
  {
    $saldo_final = 
                 + $this->where('tipo', 'Entrada')->sum('valor')
                 - $this->where('tipo', 'Saída')->sum('valor');

    return $saldo_final;
  }

// MÉTODOS          ===========================================================================================


}