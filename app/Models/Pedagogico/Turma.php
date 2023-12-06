<?php

namespace App\Models\Pedagogico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Pedagogico\Curso;
use App\Models\Atendimento\Pessoa;
// use App\Models\pivots\ColaboradorServico as ColabServ;

class Turma extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'cod';
  protected $table      = 'ped_turmas';
  protected $fillable   = [
    'cod',
    'id_curso',
    'sigla',
    'dt_inicio',
    'dt_final',
    'dia_semana',
    'horario',
    'sala',
    'max_alunos',
    'status',
    'id_instrutor',
  ];
  protected $appends = [

];

// RELACIONAMENTOS  ===========================================================================================
  public function cbntdakklaoyfih()
  {
    return $this->hasOne(Curso::class, 'cod', 'id_curso')->withTrashed();
  }

  public function sfhqwlkqwqwdlhk()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id_instrutor')->withTrashed();
  }

// MUTATORS         ===========================================================================================
  public function getStatusAttribute($value)
  {
    if($value == 'A')
    {
        return '<span class="badge bg-success">Ativo</span>';
    }
    else if($value == 'C')
    {
        return '<span class="badge bg-warning">Complementar</span>';
    }
    else
    {
        return '<span class="badge bg-danger">Inativo</span>';
    }
  }
}
