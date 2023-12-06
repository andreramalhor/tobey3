<?php

namespace App\Models\Atendimento;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PessoaEndereco extends Model
{
	public $timestamps = false;
	
  protected $primaryKey = 'id';
  protected $table      = 'atd_pessoas_enderecos';
  protected $fillable   = [
    'id_pessoa',
    'tipo_endereco',
    'cep',
    'numero',
    'complemento',
    'logradouro',
    'bairro',
    'cidade',
    'uf',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function ATD_Enderecos_Pessoas()
  {
    return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
  }

}
