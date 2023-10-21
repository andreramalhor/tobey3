<?php

namespace App\Models\PDV;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados
use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\PDV\Venda;
use App\Models\PDV\VendaDetalhe;
// use App\Models\Gerenciamento\FormaPagamento;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Financeiro\ContaInterna;
use App\Models\Financeiro\RecebimentoCartao;

class VendaPagamento extends Model
{
  // use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados
  use Notifiable;                                     //Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps    = true; // or true
  protected $table      = 'pdv_vendas_pagamentos';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_venda',
    'id_forma_pagamento',
    'descricao',
    'parcela',
    'valor',
    'status',
    'dt_prevista',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function yshghlsawerrgvd()
  {
    return $this->belongsTo(Venda::class, 'id_venda', 'id' );
  }
  
  public function qmbnkthuczqdsdn()
  {
    return $this->belongsTo(Forma_Pagamento::class, 'id_forma_pagamento', 'id' );
  }

  public function pqwnldkwjfencsb()
  {
    // return $this->hasOne(ContaInterna::class, 'id_origem', 'id');
    return $this->hasOne(ContaInterna::class, 'id_origem', 'id')->where('fonte_origem', with(new static)->getTable());
  }

  public function fjwlfkjalpdwepf()
  {
    return $this->hasOne(RecebimentoCartao::class, 'id_pagamento', 'id');
  }

  public function kfwejkahdwqbsal()
  {
    return $this->hasManyThrough(
      Caixa::class, 
      Venda::class, 
      'id', 
      'id', 
      'id_venda', 
      'id_caixa');
  }

// MÉTODOS          ===========================================================================================
  public static function boot()
  {
    parent::boot();
    self::deleting(function($venda_pagamento)
    {
      // before delete() method call this
      $venda_pagamento->pqwnldkwjfencsb()->each(function($conta_interna)
      {
        $conta_interna->delete(); // <-- direct deletion
      });

      $venda_pagamento->fjwlfkjalpdwepf()->each(function($conta_interna)
      {
        $conta_interna->delete(); // <-- direct deletion
      });
    });
  }
  
// ATRIBUTOS        ===========================================================================================
  // public function getFormaPagamentoAttribute($value)
  // {
  //   $nome = Forma_Pagamento::find($value)->forma;

  //   return $nome;
  // }
}
