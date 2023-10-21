<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados
use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\PDV\Venda;
use App\Models\PDV\VendaPagamento;
use App\Models\Configuracao\Forma_Pagamento;

class RecebimentoCartao extends Model
{
  use SoftDeletes;
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps = true;


  protected $table      = 'fin_recebimentos_cartoes';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_pagamento',
    'id_forma_pagamento',
    'vlr_real',
    'prc_descontado',
    'vlr_final',
    'dt_prevista',
    'dt_recebimento',
    'status',
    'id_banco',
    'id_lancamento',
    'origem_lancamento',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function hthgoawwqzbxhdh()
  {
    return $this->belongsTo(VendaPagamento::class, 'id_pagamento', 'id');
  }

  public function qjslcnhfdjsftre()
  {
    return $this->hasOneThrough(
      Venda::class,             // Model Alvo
      VendaPagamento::class,    // Model intermediaria
      'id',                     // Chave da tabela intermediaria que liga com a que eu estou ...
      'id',                     // Chave da tabela alvo que liga na tabela intermediaria...
      'id_pagamento',           // Chave local da tabela que estou...
      'id_venda');              // Chave da tabela intermediaria que liga com a tabela alvo ...
  }

  public function gevmgwjvzgdexwm()
  {
    return $this->belongsTo(Forma_Pagamento::class, 'id_forma_pagamento', 'id' );
  }
  
  public function saskldaskdkdfjlskjflsdjf_VendaPagamentol()
  {
    return $this->belongsTo(VendaPagamento::class, 'id_forma_pagamento', 'id' )->withTrashed();
  }


// MUTATORS         ===========================================================================================
// MÉTODOS          ===========================================================================================
}
