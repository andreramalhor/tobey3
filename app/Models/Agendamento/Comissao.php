<?php

namespace App\Models\Agendamento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Atendimento\Agendamento;

class Comissao extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'id';
  protected $table      = 'agd_comissoes';
  protected $fillable   = [
    'id_agendamento', 
    'prc_comissao', 
    'vlr_comissao', 
    'status', 
  ];
  protected $appends = [
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function kwdlsdnasdmlwhd()
  {
    return $this->hasOne(Agendamento::class, 'id', 'id_agendamento');
  }

// MUTATORS         ===========================================================================================
  public function setPrcComissaoAttribute($value)
  {
    return $this->attributes['prc_comissao'] = $value / 100;
  }

  public function setVlrComissaoAttribute($value)
  {
    return 11111111111;
    return $this->attributes['vlr_comissao'] = $this->convert_dinheiro_decimal($value);
  }

  public function setStatusAttribute($value)
  {
    return $this->attributes['status'] = 'dsdhskd';
    if($value == null)
    {
      return $this->attributes['status'] = 'Agendado';
    }
    else
    {
      return $this->attributes['status'] = 'sss';
    }
  }
}
