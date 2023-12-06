<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

use App\Models\Pessoa\Cliente;

class Facebook extends Model
{
	use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados

  public $timestamps = true;

  protected $table      = 'mkt_facebook';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_cliente',
    'data',
    'vlr_gasto',
    'alcance',
    'cliques',
    'mensagens_recebidas',
    'comentarios',
    'interacoes',
    'cst_interacao',
    'ctr',
    'cpc',
    'cst_mensagem',
    'cpm',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function FinLancamentos()
  {
    return $this->hasOne(Pessoa::class, 'id_cliente', 'id');    
  }

  public function getDataAttribute($value)
  {
    return \Carbon\Carbon::parse($value)->format('d/M');
    // return \Carbon\Carbon::parse($value)->format('d/m/Y');
  }
}