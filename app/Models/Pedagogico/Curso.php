<?php

namespace App\Models\Pedagogico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

// use App\Models\pivots\ColaboradorServico as ColabServ;

class Curso extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'cod';
  protected $table      = 'ped_cursos';
  protected $fillable   = [
    'cod',
    'nome',
    'sigla',
    'horas_semanais',
    'duracao',
    'carga_horaria',
    'vlr_total',
    'desc_max',
    'parc_max',
    'parc_extras',
    'tipo_curso',
    'status',
  ];
  // protected $appends = [];

// RELACIONAMENTOS  ===========================================================================================
// MUTATORS         ===========================================================================================
  public function getStatusAttribute($value)
  {
    if($value == 'A')
    {
      return '<span class="badge bg-success">Ativo</span>';
    }
    else
    {
    return '<span class="badge bg-danger">Inativo</span>';
    }
  }
}
