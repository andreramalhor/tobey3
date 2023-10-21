<?php

namespace App\Models\Contabilidade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados

use App\Models\Financeiro\Lancamento;

class Conta extends Model
{
  use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados
  public $timestamps   = true;

  protected $table      = 'con_plano_contas';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_empresa',
    'nivel',
    // 'conta',
    'titulo',
    'conta_pai',
    'imprime',
    'soma',
    'tem_lancamento',
    'conta_fim',
  ];
  protected $appends = [
    'nova_conta',
  ];
  
  // RELACIONAMENTOS  ===========================================================================================
  public function klajlksdjalkewq()
  {
    return $this->hasOne(Conta::class, 'id', 'conta_pai');
  }

  public function sasjiqelrhwkejs()
  {
    return $this->hasMany(Conta::class, 'conta_pai', 'id');
  }

  public function jfsdlfeofwepokf()
  {
    return $this->hasMany(Lancamento::class, 'id_conta', 'id');
  }

  // MÉTODOS          ===========================================================================================
  public function getNovaContaAttribute()
  {
    $niv_F = str_pad(optional(optional(optional(optional(optional($this->klajlksdjalkewq)->klajlksdjalkewq)->klajlksdjalkewq)->klajlksdjalkewq)->klajlksdjalkewq)->id , 2 , '0' , STR_PAD_LEFT);
    $niv_E = str_pad(optional(optional(optional(optional($this->klajlksdjalkewq)->klajlksdjalkewq)->klajlksdjalkewq)->klajlksdjalkewq)->id , 2 , '0' , STR_PAD_LEFT);
    $niv_D = str_pad(optional(optional(optional($this->klajlksdjalkewq)->klajlksdjalkewq)->klajlksdjalkewq)->id , 2 , '0' , STR_PAD_LEFT);
    $niv_C = str_pad(optional(optional($this->klajlksdjalkewq)->klajlksdjalkewq)->id , 2 , '0' , STR_PAD_LEFT);
    $niv_B = str_pad(optional($this->klajlksdjalkewq)->id , 2 , '0' , STR_PAD_LEFT);
    $niv_A = str_pad($this->id , 2 , '0' , STR_PAD_LEFT);
    
    if ($niv_A == '00')
    {
      return '';
    }
    else if ($niv_B == '00')
    {
      return $niv_A;
    }
    else if ($niv_C == '00')
    {
      return $niv_B.'.'.$niv_A;
    }
    else if ($niv_D == '00')
    {
      return $niv_C.'.'.$niv_B.'.'.$niv_A;
    }
    else if($niv_E == '00')
    {
      return $niv_D.'.'.$niv_C.'.'.$niv_B.'.'.$niv_A;
    }
    else if ($niv_F == '00')
    {
      return $niv_E.'.'.$niv_D.'.'.$niv_C.'.'.$niv_B.'.'.$niv_A;
    }
    else
    {
      return $niv_F.'.'.$niv_D.'.'.$niv_C.'.'.$niv_B.'.'.$niv_A;
    }
  }

  // ATRIBUTOS        ===========================================================================================


  // FUNCIOES SECUNDARIAS =======================================================================================
  public static function boot()
  {
    parent::boot();
    
    static::deleted(function ($conta)
    {
      $conta->jfsdlfeofwepokf()->update(['id_conta' => $conta->conta_pai]);
    });
  }
}