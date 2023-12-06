<?php

namespace App\Models\pivots;

use Illuminate\Database\Eloquent\Model;

class FuncaoPessoa extends Model
{
  protected $table = 'acl_funcao_pessoa';
  protected $fillable = [
    'id_pessoa',
    'id_funcao',
  ];
}
