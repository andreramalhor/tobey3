<?php

namespace App\Models\PDV;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
// use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\Financeiro\Banco;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\AReceber;
use App\Models\PDV\Venda;

class Caixa extends Model
{
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 
  // use SoftDeletes;

  public $timestamps = true;

  protected $table      = 'pdv_caixas';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_banco',
    'id_usuario_abertura',
    'vlr_abertura',
    'vlr_fechamento',
    'status',
    'dt_abertura',
    'dt_fechamento',
    'dt_validacao',
    'id_usuario_validacao',
    'nota200',
    'nota100',
    'nota50',
    'nota20',
    'nota10',
    'nota5',
    'nota2',
    'moeda100',
    'moeda50',
    'moeda25',
    'moeda10',
    'moeda5',
    'moeda1',
  ];
  protected $appends = [
    'saldo_atual',
  ];

// RELACIONAMENTOS  ===========================================================================================
  public function rybeyykhpcgwkgr()
  {
    return $this->belongsTo(Banco::class, 'id_banco', 'id');    
  }

  public function kpakdkhqowIqzik()
  {
    return $this->belongsTo(Pessoa::class, 'id_usuario_abertura', 'id')->withTrashed();    
  }

  public function leichtmaeskrpdf()
  {
    return $this->belongsTo(Pessoa::class, 'id_usuario_validacao', 'id')->withTrashed();    
  }

  public function PDVComandas()
  {
    return $this->hasMany(Comanda::class, 'id_caixa', 'id');    
  }

  public function rtafathibgwfust()
  {
    return $this->hasMany(Venda::class, 'id_caixa', 'id');    
  }

  public function PDVComandasPagamentos()
  {
    return $this->hasManyThrough(
      ComandaPagamento::class,        // Model Alvo
      Comanda::class,                 // Model Através
      'id_caixa',                     // Chave estrangeira na model Através ...
      'id_comanda',                   // Chave estrangeira na model Alvo...
      'id',                           // Chave principal na model que estou...
      'id');                          // Chave principal na model Através...
  }

  public function ssqlnxsbyywplan()
  {
    return $this->hasManyThrough(
      VendaPagamento::class,        // Model Alvo
      Venda::class,                 // Model Através
      'id_caixa',                  // Chave estrangeira na model Através ...
      'id_venda',                   // Chave estrangeira na model Alvo...
      'id',                         // Chave principal na model que estou...
      'id');                          // Chave principal na model Através...
  }

  public function wskcngeadbjhpdu()
  {
    return $this->hasMany(Lancamento::class, 'id_caixa', 'id');    
  }

  public function druxvxuskbnfggv()
  {
    return $this->hasMany(AReceber::class, 'id_caixa', 'id');    
  }

// MUTATORS         ===========================================================================================
// MÉTODOS          ===========================================================================================
  public function getSaldoAtualAttribute()
  {
    $saldo_atual = 
                   $this->ssqlnxsbyywplan->where('id_forma_pagamento', 1)->sum('valor')
                 - $this->wskcngeadbjhpdu->where('id_forma_pagamento', 1)->where('tipo', 'D')->sum('vlr_final')
                 + $this->wskcngeadbjhpdu->where('id_forma_pagamento', 1)->where('tipo', 'R')->sum('vlr_final')
                 + $this->wskcngeadbjhpdu->where('id_forma_pagamento', 1)->where('tipo', 'T')->sum('vlr_final')
                 + $this->druxvxuskbnfggv->sum('vlr_final')
                 + $this->vlr_abertura;

    return $saldo_atual;
  }

  public function getCorStatusAttribute()
  {
    switch ($this->status)
    {
      case 'Transportado':
    dd('1');
          return 'danger';
          break;
      case 'Aberto':
          return 'warning';
          break;
      case 'Fechado':
          return 'info';
          break;
      case 'Validado':
          return 'success';
          break;
    }
  }

  // AUXILIARES              ===========================================================================================
  public static function procurar($pesquisa)
  {
    return empty($pesquisa)
    ? static::query()
    : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
                     ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
  }

}