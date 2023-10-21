<?php

namespace App\Models\PDV;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Caixa;
use App\Models\PDV\VendaDetalhe;
use App\Models\PDV\VendaPagamento;
use App\Models\Financeiro\ContaInterna;
use App\Models\Financeiro\RecebimentoCartao;
use App\Models\Configuracao\Forma_Pagamento;

class Venda extends Model
{
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 
 
  public $timestamps    = true;
  protected $table      = 'pdv_vendas';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_caixa', 
    'id_usuario', 
    'id_cliente', 
    'qtd_produtos', 
    'vlr_prod_serv', 
    'vlr_negociados', 
    'vlr_dsc_acr', 
    'vlr_final', 
    'status',
  ];

// ================================================================================================================= RELACIONAMENTOS
  public function lufqzahwwexkxli()
  {
    return $this->belongsTo(Pessoa::class, 'id_cliente', 'id')->withTrashed();
  }

  public function PDVCaixasVendas()
  {
    return $this->belongsTo(Caixa::class, 'id_caixa', 'id');    
  }

  public function dfyejmfcrkolqjh()
  {
    return $this->hasMany(VendaDetalhe::class, 'id_venda', 'id');
  }

  public function xzxfrjmgwpgsnta()
  {
    return $this->hasMany(VendaPagamento::class, 'id_venda', 'id');    
  }

  public function askldalskdjaskl()
  {
    return $this->xzxfrjmgwpgsnta()->sum('valor');
  }

  public function kdebvgdwqkqnwqk()
  {
    return $this->hasManyThrough(
      ContaInterna::class,          // Model Alvo
      VendaDetalhe::class,          // Model Através
      'id_venda',
      'id_origem',
      'id',
      'id')->where('fonte_origem', '=', 'pdv_vendas_detalhes');
  }

  public function afewfefuwoenoei()
  {
    return $this->hasManyThrough(
      Forma_Pagamento::class,       // Model Alvo
      VendaPagamento::class,        // Model Através
      'id_venda',
      'id',
      'id',
      'id_forma_pagamento');
  }

  public function snfbexhswnenrks()
  {
    return $this->hasManyThrough(
      ContaInterna::class,
      VendaPagamento::class,
      'id_venda',
      'id_origem',
      'id',
      'id')->where('fonte_origem', '=', 'pdv_vendas_pagamentos');
  }
  
  public function skjasklruwrkwej()
  {
    return $this->hasManyThrough(
      RecebimentoCartao::class,
      VendaPagamento::class,
      'id_venda',
      'id_pagamento',
      'id',
      'id');
  }

  public function AtdPessoasVendedores()
  {
    return $this->belongsTo(Pessoa::class, 'id_vendedor', 'id');    
  }

// ================================================================================================================= MÉTODOS

  public static function boot()
  {
    parent::boot();
    self::deleting(function($venda)
    {
      // before delete() method call this
      $venda->dfyejmfcrkolqjh()->each(function($detalhe)
      {
        $detalhe->delete(); // <-- direct deletion
      });
      
      $venda->xzxfrjmgwpgsnta()->each(function($pagamento)
      {
        $pagamento->delete(); // <-- raise another deleting event on Post to delete comments
      });
      
      // $venda->kdebvgdwqkqnwqk()->each(function($conta_interna_comissao)
      // {
      //   $conta_interna_comissao->delete(); // <-- raise another deleting event on Post to delete comments
      // });
      
      // $venda->snfbexhswnenrks()->each(function($conta_interna_pagamento)
      // {
      //   $conta_interna_pagamento->delete(); // <-- raise another deleting event on Post to delete comments
      // });
      
      // $venda->skjasklruwrkwej()->each(function($recebimento_cartao)
      // {
      //   $recebimento_cartao->delete(); // <-- raise another deleting event on Post to delete comments
      // });
      // do the rest of the cleanup...
    });
  }
// ================================================================================================================= ATRIBUTOS (Nomes)

}
