<?php

namespace App\Models\Pedagogico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

// use App\Models\pivots\ColaboradorServico as ColabServ;

class Modulo extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'cod';
  protected $table      = 'ped_modulos';
  protected $fillable   = [
    'cod',
    'descricao',
    'carga_horaria',
    'qtd_aulas',
    'id_curso',
    'sigla',
    'tipo',
    'valor',
  ];
  // protected $appends = [];

// RELACIONAMENTOS  ===========================================================================================
// MUTATORS         ===========================================================================================

}
