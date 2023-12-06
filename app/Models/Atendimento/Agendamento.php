<?php

namespace App\Models\Atendimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Atendimento\Pessoa;
use App\Models\Agendamento\Comissao;
use App\Models\Cadastro\ServicoProduto;

class Agendamento extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'id';
  protected $table      = 'atd_agendamentos';
  protected $fillable   = [
    'id_empresa',
    'start',
    'end',
    'id_cliente',
    'id_profexec',
    'id_servprod',
    'id_comanda',
    'valor',
    'id_criador',
    'status',
    'obs',
    'id_venda_detalhe',
    'prc_comissao',
    'vlr_comissao',
    'grupo',
  ];
  protected $appends = [
    'title',
    'color',
    'resourceId',
    'textColor',
    // 'badge',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function jkweviewflkjdas()
  {
    return $this->hasOne(Empresa::class, 'id', 'id_empresa')->withTrashed();;
  }

  public function xhooqvzhbgojbtg()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id_cliente')->withTrashed();;
  }

  public function hhmaqpijffgfhmj()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id_profexec')->withTrashed();;
  }

  public function zlpekczgsltqgwg()
  {
    return $this->hasOne(ServicoProduto::class, 'id', 'id_servprod');
  }

  public function eiuroereuwnofiw()
  {
    return $this->hasOne(Pessoa::class, 'id', 'id_criador');
  }

  public function sadlqwdnlaskdla()
  {
    return $this->hasOne(Comissao::class, 'id_agendamento', 'id');
  }

// MUTATORS         ===========================================================================================
  // public function setProfissaoAttribute($value)
  // {
    // $this->attributes['profissao'] = ucwords(trim($value));
  // }



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
    if($this->id_cliente == null || $this->id_cliente == 10942)
    {
      $titulo = $this->obs.' ('.$this->zlpekczgsltqgwg->nome.')';
    }
    else
    {
      $titulo = optional($this->xhooqvzhbgojbtg)->apelido.' ('.$this->zlpekczgsltqgwg->nome.')';
    }
    
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
      
      case 'Fixa':
        return 'goldenrod';  //wheat
        break;
      
      case 'Fechado':
        return 'grey';  // lightgray
        break;
        
      default:
        return 'black';
        break;
    }
  }

  // #F1C40F
  // amarelo
  
  // #FFA000
  // amarelo amber

  // #F57C00
  // laranha

  // #D32F2F
  // vermelho
  
  // #C2185B
  // pink
  
  // #7B1FA2
  // roxo
  
  // #1976D2
  // azul

  // #388E3C
  // verde

  // #5D4037
  // marron


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
      case 'Fixa':
        return 'goldenrod';
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

}
