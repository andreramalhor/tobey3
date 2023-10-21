<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ACL\Funcao;

class Permissao extends Model
{
	use SoftDeletes;
  public $timestamps = false;

  protected $primaryKey = 'id';
  protected $table      = 'acl_permissoes';
  protected $fillable   = [
    'nome',
    'nivel',
    'ordem',
    'grupo',
    'menu',
    'descricao',
  ];
  protected $appends = [
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function dzjvxinawjwtnfa()
  {
    return $this->belongsToMany(Funcao::class, 'acl_permissoes_funcoes', 'id_permissao', 'id_funcao' );
  }

  // public function kdfalsjdlkPROFISSIONALasjdlaskjdlkasjd() // kdfalsjdlk_p_r_o_f_i_s_s_i_o_n_a_lasjdlaskjdlkasjd no jquery
  // {
  //   return $this->hasOne(Pessoa::class, 'id', 'id_profexec');
  // }

  // public function kdfalsjdlkSERVICOPRODUTOasjdlaskjdlkasjd() // zlpekczgsltqgwg no jquery
  // {
  //   return $this->hasOne(ServicoProduto::class, 'id', 'id_servprod');
  // }
}
