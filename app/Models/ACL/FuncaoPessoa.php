<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FuncaoPessoa extends Model
{
	public $timestamps = false;
	
  protected $table      = 'acl_funcoes_pessoas';
  protected $fillable   = [
    'id_pessoa',
		'id_funcao',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function lkfjdslkfjeldmf()
  {
    return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
  }

// MUTATORS         ===========================================================================================
  public function getTipoAttribute()
  {
    return 's';
  }

}
