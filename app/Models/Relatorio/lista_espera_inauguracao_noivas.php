<?php

namespace App\Models\Relatorio;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

class lista_espera_inauguracao_noivas extends Model
{
	use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados

  public $timestamps = true;

  protected $table      = 'rel_lista_espera_inaug_noivas';
  protected $primaryKey = 'id';
  protected $fillable = [
    'nome_completo',
    'email',
    'telefone',
    'observacao',
    'data_casamento',
  ];

}