<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados
use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\ACL\FuncaoPessoa;
use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Venda;
use App\Models\PDV\VendaDetalhe;
use App\Models\PDV\VendaPagamento;
use App\Models\Cadastro\ServicoProduto;

class ContaInterna extends Model
{
  use SoftDeletes;
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps = true;

  protected $table      = 'fin_contas_internas';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_origem', 
    'fonte_origem', 
    'id_pessoa', 
    'tipo', 
    'percentual', 
    'valor', 
    'dt_prevista', 
    'dt_quitacao', 
    'id_destino', 
    'fonte_destino', 
    'status', 
  ];
  
  public function xeypqgkmimzvknq() 
  {
    return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id' )->withTrashed();
  }

  public function lskjasdlkdflsdj()
  {
    return $this->hasOne(VendaDetalhe::class, 'id', 'id_origem' );
  }

  public function sflfmensjwleneb()
  {
    return $this->hasOne(VendaPagamento::class, 'id', 'id_origem' );
    // return $this->belongsTo(VendaPagamento::class, 'id_origem', 'id' );
  }

  public function akjsdhaksdhOrigem()
  {
    return $this->belongsTo(VendaDetalhe::class, 'id_origem', 'id' );
  }

  public function skfmwuorwmlpdlm()
  {
    return $this->hasOneThrough(
      Venda::class,                 // Model Final
      VendaDetalhe::class,          // Model Meio
      'id',                         // Chave estrangeira na model Meio ...
      'id',                         // Chave principal na model Final ...
      'id_origem',                  // Chave principal na model que estou ...
      'id_venda');                  // Chave principal na model Meio ...
  }

  public function aiuwlwqelejqone()
  {
    return $this->hasOneThrough(
      Venda::class,                 // Model Final
      VendaPagamento::class,          // Model Meio
      'id',                         // Chave estrangeira na model Meio ...
      'id',                         // Chave principal na model Final ...
      'id_origem',                  // Chave principal na model que estou ...
      'id_venda');                  // Chave principal na model Meio ...
  }

  public function ygferchrtuwewhq()
  {
    return $this->hasOneThrough(
      ServicoProduto::class,        // Model Final
      VendaDetalhe::class,          // Model Meio
      'id',                         // Chave estrangeira na model Meio ...
      'id',                         // Chave principal na model Final ...
      'id_origem',                  // Chave principal na model que estou ...
      'id_servprod');              // Chave principal na model Meio ...
  }

  public function afjgmenkewjekff()
  {
    return $this->hasManyThrough(
      FuncaoPessoa::class,          // Model Final
      Pessoa::class,                // Model Meio
      'id',                         // Chave estrangeira na model Meio ...
      'id_funcao',                  // Chave principal na model Final ...
      'id_pessoa',                  // Chave principal na model que estou ...
      'id');                        // Chave principal na model Meio ...
  }

// MUTATORS         ===========================================================================================
// MÉTODOS          ===========================================================================================

}