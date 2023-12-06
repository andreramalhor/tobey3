<?php

namespace App\Models\Atendimento;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\ACL\Funcao;
use App\Models\ACL\Permissao;
use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Caixa;
use App\Models\pivots\FuncaoPessoa;

class PessoaSistema extends Authenticatable
{
  use Notifiable;

  protected $primaryKey = 'id';
  protected $table      = 'atd_pessoas_sistema';
  protected $fillable = [
    'id',
    'nome',
    'username',
    'dia_pagamento',
    'email',
    'email_verified_at',
    'password',
    'status',
    // 'id_pessoa',
    // 'tipo_sistema',
    // 'username',
    // 'email_verified_at',
    // 'password',
    // 'status',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $appends = [
    'FotoPerfil',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

// RELACIONAMENTOS  ===========================================================================================

  public function lcldxgfwmrzybmm()
  {
    return $this->hasMany(FuncaoPessoa::class, 'id_pessoa', 'id');
  }

  public function ATD_Pessoa_Usuario()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id');
  }

  public function ATD_Pessoas_Possui_Caixa()
  {
    return $this->hasMany(Caixa::class, 'id_usuario_abertura', 'id');
  }

  public function abcde()
  {
    return $this->hasMany(Caixa::class, 'id_usuario_abertura', 'id')->where('dt_abertura', '>=', \Carbon\Carbon::today())->where('status', '=', 'Aberto');
  }
  
  public function ACL_Pessoa_Funcao()
  {
    // dd('ACL_Pessoa_Funcao');
    return $this->belongsToMany(Funcao::class, 'acl_funcoes_pessoas', 'id_pessoa', 'id_funcao');
  }

// FUNÇÕES          ===========================================================================================
  public function adminlte_image()
  {
    return asset('/img/atendimentos/pessoas/'.$this->id.'.png');
  // return 'https://picsum.photos/300/300';
  }
  
  public function adminlte_desc()
  {
    return 'That\'s a nice guy';
  }

  public function adminlte_profile_url()
  {
    return route('atd.pessoas.mostrar', $this->id);
  }
  
  public function getFotoPerfilAttribute()
  {
    if(file_exists(public_path('/img/atendimentos/pessoas/'.$this->id.'.png')))
    {
      return asset('/img/atendimentos/pessoas/'.$this->id.'.png');
    }
    else
    {
      return asset('/img/atendimentos/pessoas/0.png');
    }
  }

  // ACL              ===========================================================================================
  
  public function vincauladoAoFuncao(PessoaSistema $funcoes)
  {
    dd('vincauladoAoFuncao');
    if( is_array() || is_object() )
    {
      foreach ($funcoes as $key => $funcao)
      {
        return $this->funcoes->contains('nome', $funcao->nome);
      }
    }
    return $this->funcoes->contains('nome', $funcoes);
  }

  // public function isAdminSistema($admin)    // O Gate verifica, antes de tudo, se possui Tipo 'Administrador do Sistema'
  // {
  //   return $this->AtdPessoasTipos->contains('nome', $admin);
  // }



  public function temPermissao(Permissao $permissao)    // O Gate verifica permissão por permissão na hora de saber se possui o daquele item que ele pretende entrar
  {
    // dd('temPermissao', $permissao);
    return $this->pacoteFuncao($permissao->DZJVXINAWJWTNFA);
  }

  public function pacoteFuncao($funcoes)
  {
    // dd('pacoteFuncao', $funcoes);
    if( is_array($funcoes) || is_object($funcoes) )
    {
      return !! $funcoes->intersect($this->ACL_Pessoa_Funcao)->count();
    }
    return $this->ACL_Pessoa_Funcao->contains('nome', $funcoes);
  }

  public function isAdminSistema($admin)
  {
    // dd('isAdminSistema', $admin);
    return $this->ACL_Pessoa_Funcao->contains('nome', $admin);
  }
}
