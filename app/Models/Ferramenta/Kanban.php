<?php

namespace App\Models\Ferramenta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kanban extends Model
{
  use SoftDeletes;
  public $timestamps   = true;

  protected $table      = 'fer_kanban';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_coluna',
    'nivel',
    // 'conta',
    'titulo',
    'conta_pai',
    'imprime',
    'soma',
    'tem_lancamento',
    'conta_fim',
  ];
  protected $appends = [
  ];
  
  // RELACIONAMENTOS  ===========================================================================================
  public function kasdjamdlwjqeew()
  {
    return $this->hasMany(Lancamento::class, 'id_conta', 'id');
  }

  // MÉTODOS          ===========================================================================================

  

  // ATRIBUTOS        ===========================================================================================


  // FUNCIOES SECUNDARIAS =======================================================================================

  
}