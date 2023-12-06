<?php

namespace App\Models\Configuracao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

class ContaContabil extends Model
{
  use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados
  public $timestamps   = true;

  protected $table      = 'con_plano_contas';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'nivel',
    'conta',
    'descricao',
    'conta_pai',
    'imprime',
    'soma',
    'conta_fim',
  ];
  
// RELACIONAMENTOS  ===========================================================================================

  
// MÉTODOS          ===========================================================================================


// ATRIBUTOS        ===========================================================================================

}