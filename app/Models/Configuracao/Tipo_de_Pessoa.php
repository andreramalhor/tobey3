<?php

namespace App\Models\Configuracao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

use App\Models\Atendimento\Pessoa;
use App\Models\pivots\FuncaoPessoa;

class Tipo_de_Pessoa extends Model
{
  use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados

  public 		$timestamps = true;
  protected $primaryKey = 'id';
  protected $table      = 'cfg_tipos_de_pessoas';
  protected $fillable   = [
    'nome',
    'descricao',
    'categoria',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function efw5vo95ln()
  {
    return $this->hasManyThrough(
      Pessoa::class,                   // Model Alvo
      FuncaoPessoa::class,               // Model Através
      'id_tipo',                       // Chave estrangeira na model Através ...
      'id',                            // Chave estrangeira na model Alvo...
      'id',                            // Chave principal na model que estou...
      'id_pessoa');                    // Chave principal na model Através...
  }

// MÉTODOS          ===========================================================================================


// ATRIBUTOS        ===========================================================================================
}
