<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ACL\Permissao;
use App\Models\pivots\PermissaoFuncao;
use App\Models\pivots\FuncoesPessoas;

class Funcao extends Model
{
  public $timestamps = false;

  protected $primaryKey = 'id';
  protected $table      = 'acl_funcoes';
  protected $fillable   = [
    'nome',
    'slug',
    'descricao',
  ];
  protected $appends = [
  ];

// RELACIONAMENTOS  ===========================================================================================
public function yxwbgtooplyjjaz()
{
    return $this->belongsToMany(Permissao::class, 'acl_permissoes_funcoes', 'id_funcao', 'id_permissao');
}

public function znufwevbqgruklz()
{
  return $this->belongsToMany(User::class, 'acl_funcoes_pessoas', 'id_funcao', 'id_pessoa');
}

public function PVRBIUSBYF()
{
  return $this->hasMany(PermissaoFuncao::class, 'id_funcao', 'id');
}

public function MMBBEYSRJM()
{
  return $this->hasMany(FuncoesPessoas::class, 'id_funcao', 'id');
}

public function jrlcgwekejwbwel()
{
  return $this->hasManyThrough(
    User::class,
    FuncaoPessoa::class,
    'id_funcao',
    'id',
    'id',
    'id_pessoa');
}

// public function kdfalsjdlkPROFISSIONALasjdlaskjdlkasjd() // kdfalsjdlk_p_r_o_f_i_s_s_i_o_n_a_lasjdlaskjdlkasjd no jquery
  // {
  //   return $this->hasOne(Pessoa::class, 'id', 'id_profexec');
  // }

  // public function kdfalsjdlkSERVICOPRODUTOasjdlaskjdlkasjd() // zlpekczgsltqgwg no jquery
  // {
  //   return $this->hasOne(ServicoProduto::class, 'id', 'id_servprod');
  // }

  public function getColorAttribute()
  {
    switch ($this->nome)
    {
      case 'Administrador do Sistema':
        return 'primary';
      case 'Sócio':
        return 'secondary';
      case 'Colaborador':
        return 'info';
      case 'Gerente Administrativo':
        return 'success';
      case 'Coordenador':
        return 'warning';
      case 'Parceiro':
        return 'danger';
      case 'Cliente':
        return 'indigo';
      case 'Supervisor':
        return 'lightblue';
      case 'Cliente Marketing':
        return 'navy';
      case 'Cliente CallCenter':
        return 'purple';
      case 'Vendedor':
        return 'orange';
      case 'Auxiliar Administrativo':
        return 'pink';
      case 'Secretária':
        return 'maroon';
      case 'Administrador':
        return 'fuchsia';
      case 'Administrador':
        return 'lime';
      case 'Administrador':
        return 'teal';
      case 'Administrador':
        return 'olive';
        break;
    }
  }
}
