<?php

namespace App\Models\pivots;

use Illuminate\Database\Eloquent\Model;

class PermissaoFuncao extends Model
{
  protected $table = 'acl_permissoes_funcoes';
  protected $fillable = [
    'id_permissao',
    'id_funcao',
  ];
}
