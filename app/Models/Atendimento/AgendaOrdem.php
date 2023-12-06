<?php

namespace App\Models\Atendimento;

use Illuminate\Database\Eloquent\Model;

use App\Models\Atendimento\Pessoa;

class AgendaOrdem extends Model
{
  public $timestamps = false;  

  protected $primaryKey = 'id';
  protected $table      = 'agd_ordem';
  protected $fillable   = [
    'auth_user',
    'ordem',
    'area',
    'id_pessoa',
  ];
  protected $appends = [
  ];
  
// RELACIONAMENTOS  ===========================================================================================
  public function oewoekdwjzsdlkd()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id_pessoa');
  }
  
  public function asirmghaksasjsh()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id_auth');
  }


// MUTATORS         ===========================================================================================
  // public function setProfissaoAttribute($value)
  // {
    // $this->attributes['profissao'] = ucwords(trim($value));
  // }

  public function getStartAttribute($value)
  {
    $dateStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
    $timeStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

    return $value = ($timeStart == '00:00:00') ? $dateStart : $value;
  }

  public function getEndAttribute($value)
  {
    $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
    $timeEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

    return $value = ($timeEnd == '00:00:00') ? $dateEnd : $value;
  }

  // public function setStartAttribute($value)
  // {
  //   $dateStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
  //   $timeStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

  //   return $value = ($timeStart == '00:00:00') ? $dateStart : $value;
  // }

  // public function setEndAttribute($value)
  // {
  //   $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
  //   $timeEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

  //   return $value = ($timeEnd == '00:00:00') ? $dateEnd : $value;
  // }
  public function novoTitulo()
  {
    $titulo = $this->xhooqvzhbgojbtg->apelido.' ('.$this->zlpekczgsltqgwg->nome.')';

    return $titulo;
  }

  public function getTitleAttribute()
  {
    $titulo = $this->xhooqvzhbgojbtg->apelido.' ('.$this->zlpekczgsltqgwg->nome.')';
    return $titulo;
  }

  public function getResourceIdAttribute()
  {
    return $this->id_profexec;
  }

  public function getColorAttribute()
  {
    switch ($this->status)
    {
      case 'Agendado':
        return '#FFFF66';
        break;
      
      case 'Confirmado':
        return 'lightgreen';
        break;
      
      case 'Finalizado':
        return 'lightblue';
        break;
      
      case 'Atrasado':
        return 'lightsalmon';
        break;
      
      case 'Faltou':
        return 'lightcoral';
        break;
      
      default:
        return 'black';
        break;
    }
  }

  public function getTextColorAttribute()
  {
    return 'black';
  }

  public function getBadgeAttribute()
  {
    switch ( $this->status )
    {
      case 'Agendado':
        return 'warning';
        break;
      case 'Confirmado':
        return 'success';
        break;
      case 'Finalizado':
        return 'info';
        break;
      case 'Atrasado':
        return 'orange';
        break;
      case 'Faltou':
        return 'danger';
        break;
      default:
        return 'primary';
        break;
    }
  }
// =================================================================================================

  // public function setObsAttribute($value)
  // {
  //   $this->attributes['obs'] = 'ssssssssssssss';
  // }

  // public function getStartAttribute($value)
  // {
  //   $dateStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
  //   $timeStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

  //   return $value = ($timeStart == '00:00:00') ? $dateStart : $value;
  // }

  // public function getEndAttribute($value)
  // {
  //   $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
  //   $timeEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

  //   return $value = ($timeEnd == '00:00:00') ? $dateEnd : $value;
  // }


  // public static function boot()
  // {
  //   parent::boot();
  //   self::deleting(function($agenda)
  //   { // before delete() method call this
  //     $agenda->oewoekdwjzsdlkd()->each(function($detalhe)
  //     {
  //       $detalhe->delete(); // <-- direct deletion
  //     });
      
  //     $agenda->xzxfrjmgwpgsnta()->each(function($pagamento)
  //     {
  //       $pagamento->delete(); // <-- raise another deleting event on Post to delete comments
  //     });
      
  //     $agenda->kdebvgdwqkqnwqk()->each(function($conta_interna_comissao)
  //     {
  //       $conta_interna_comissao->delete(); // <-- raise another deleting event on Post to delete comments
  //     });
      
  //     $agenda->snfbexhswnenrks()->each(function($conta_interna_pagamento)
  //     {
  //       $conta_interna_pagamento->delete(); // <-- raise another deleting event on Post to delete comments
  //     });
  //     // do the rest of the cleanup...
  //   });
  // }

}
