<?php

namespace App\Models\Atendimento;

use Illuminate\Database\Eloquent\Model;

class PessoaCliente extends Model
{
	public $timestamps = false;

  protected $primaryKey = 'id_cliente';

  protected $table      = 'atd_pessoas_clientes';
  protected $fillable   = [
    'id_pessoa',
	'id_cliente',
	'horario_inicial',
	'horario_final',
  ];

// RELACIONAMENTOS  ===========================================================================================


// MUTATORS         ===========================================================================================


}
