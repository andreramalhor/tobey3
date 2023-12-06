<?php

namespace App\Models\pivots;

use Illuminate\Database\Eloquent\Model;

class FuncoesPessoas extends Model
{
  protected $table = 'acl_funcoes_pessoas';
  protected $fillable = [
    'id_funcao',
    'id_pessoa',
  ];
}
