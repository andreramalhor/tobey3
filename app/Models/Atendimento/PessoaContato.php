<?php

namespace App\Models\Atendimento;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PessoaContato extends Model
{
	public $timestamps = false;
	
  protected $primaryKey = 'id';
  protected $table      = 'atd_pessoas_contatos';
  protected $fillable   = [
    'id_pessoa',
		'tipo_contato',
		'ddd',
		'telefone',
		'whatsapp',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function ATD_Contatos_Pessoas()
  {
    return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
  }

// MUTATORS         ===========================================================================================
  public function getTellinkAttribute()
  {
    return $this->ddd.preg_replace("/[^0-9]/", "",$this->telefone);;
  }

}
