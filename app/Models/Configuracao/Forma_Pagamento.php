<?php

namespace App\Models\Configuracao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Financeiro\RecebimentoCartao;

class Forma_Pagamento extends Model
{
  use SoftDeletes;
  public $timestamps    = true;

  protected $table      = 'ger_formas_pagamentos';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'forma',
    'tipo',
    'bandeira',
    'parcela',
    'taxa',
    'prazo',
    'pri_vcto',
    'recebimento',
    'local',
    'conferir',
    'destino',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function lkasjdoqwrjlfew()
  {
    return $this->hasMany(RecebimentoCartao::class, 'id_forma_pagamento', 'id');    
  }
  
  public function AtdServicoColaborador()
  {
    return $this->belongsToMany(Produto::class, 'cnf_colaborador_servico', 'id', 'id_servprod');
  }

// MÉTODOS          ===========================================================================================


// ATRIBUTOS        ===========================================================================================
}