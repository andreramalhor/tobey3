<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Financeiro\Banco;
use App\Models\Atendimento\Pessoa;
use App\Models\Configuracao\Forma_Pagamento;
use App\Models\Contabilidade\Conta;

class Lancamento extends Model
{
	use SoftDeletes;

  public $timestamps = true;

  protected $table      = 'fin_lancamentos';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'tipo',
    'id_banco',
    'id_conta',
    'num_documento',
    'id_pessoa',
    'informacao',
    'vlr_bruto',
    'vlr_dsc_acr',
    'vlr_final',
    'parcela',
    'id_forma_pagamento',
    'descricao',
    'dt_vencimento',
    'dt_competencia',
    'dt_recebimento',
    'dt_confirmacao',
    'dt_pagamento',
    'id_usuario_lancamento',
    'id_usuario_confirmacao',
    'id_caixa',
    'id_lancamento_origem',
    'origem',
    'status',
    'centro_custo',
  ];


  // AUXILIARES              ===========================================================================================
  public static function procurar($pesquisa)
  {
    return empty($pesquisa)
    ? static::query()
    : static::query()->where('informacao', 'LIKE', '%'.$pesquisa.'%')
                     ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
  }

// ================================================================================================================= RELACIONAMENTOS
  public function yaapdycfbplzkeg()
  {
    return $this->belongsTo(Banco::class, 'id_banco', 'id');
  }

  public function qexgzmnndqxmyks()
  {
    return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id')->withTrashed();
  }

  public function qlwiqwuheqlefkd()
  {
    return $this->belongsTo(Conta::class, 'id_conta', 'id')->withTrashed();
  }

  public function PDVCaixas()
  {
    return $this->belongsTo(Caixa::class, 'id_caixa', 'id');
  }

  public function AtdUsuariosLancador()
  {
    return $this->belongsTo(Pessoa::class, 'id_usuario_lancamento', 'id')->withTrashed();
  }

  public function AtdUsuariosConfirmador()
  {
    return $this->belongsTo(Pessoa::class, 'id_usuario_confirmacao', 'id')->withTrashed();
  }

  public function ueifnsjfwefnskd()
  {
    return $this->hasOne(Forma_Pagamento::class, 'id', 'id_forma_pagamento');
  }

  public function GerPlanoContas()
  {
    return $this->belongsTo(PlanoConta::class, 'conta', 'id');
  }
// ================================================================================================================= MÉTODOS

  // ================================================================================================================= ATRIBUTOS (Nomes)
  public function getSaldoFinalAttribute()
  {
    $saldo_final =
                 - $this->where('tipo', 'S')->sum('vlr_final')
                 + $this->where('tipo', 'E')->sum('vlr_final')
                 + $this->where('tipo', 'T')->sum('vlr_final');

    return $saldo_final;
  }

  public function getColorAttribute()
  {
    switch ($this->tipo)
    {
      case 'D':
        return 'danger';
        break;
      case 'R':
        return 'success';
        break;
      case 'T':
        return 'warning';
        break;
      default:
        return 'default';
        break;
    }
  }

  // public function getFormaPagamentoAttribute($value)
  // {
  //   $nome = FormaPagamento::find($value)->forma;

  //   return $nome;
  // }
}
