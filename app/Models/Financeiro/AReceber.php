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

class AReceber extends Model
{
  use SoftDeletes;
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps = true;

  protected $table      = 'fin_a_receber';
  protected $primaryKey = 'id';
  protected $fillable = [
    'id_pessoa',
    'tipo_pagamento',
    'nome',
    'id_usuario',
    'id_contrato',
    'num_aluno',
    'tipo',
    'forma_pagamento',
    'parcela',
    'vlr_bruto',
    'desconto',
    'vlr_liquido',
    'vlr_pago',
    'tarifa',
    'vlr_final',
    'vlr_desconto_acrescimo',
    'dt_vencimento',
    'dt_pagamento',
    'dt_lancamento',
    'status',
    'id_banco',
    'id_caixa',
    'forma_receb',
    'turma',
    'dt_recebimento',
    'origem_lancamento',
    'id_lancamento',
  ];

  protected $appends = [
    'cor_status',
  ];

// RELATIONS         ===========================================================================================
public function qlkwwimdsodmaof()
{
  return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id_rsschool' )->withTrashed();
}

public function lkerewklrjwerjw() 
{
  return $this->belongsTo(Pessoa::class, 'id_usuario', 'id' )->withTrashed();
}


// MUTATORS         ===========================================================================================
public function getCorStatusAttribute()
{
  switch ($this->status)
  {
    case 'Atrasado':
        return 'danger';
        break;
    case 'Em aberto':
        return 'warning';
        break;
    case 'Fechado':
        return 'info';
        break;
    case 'Pago':
        return 'success';
        break;
    default:
        return 'default';
  }
}
// MÉTODOS          ===========================================================================================

}