<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados
use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Caixa;
use App\Models\Financeiro\CompraDetalhe;
use App\Models\Financeiro\CompraPagamento;

class Compra extends Model
{
	use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 
 
  public $timestamps    = true;
  protected $table      = 'fin_compras';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'tipo', 
    'id_caixa', 
    'id_usuario', 
    'id_fornecedor', 
    'qtd_produtos', 
    'vlr_prod_serv', 
    'vlr_negociados', 
    'vlr_dsc_acr', 
    'vlr_final', 
    'status',
  ];
  protected $appends = [
    'fornecedor',
  ];

// ================================================================================================================= RELACIONAMENTOS
  public function ysfyhzfsfarfdha() //fornecedor
  {
    return $this->belongsTo(Pessoa::class, 'id_fornecedor', 'id')->withTrashed();
  }
  
  public function q70ntx1aha()
  {
    return $this->hasMany(CompraDetalhe::class, 'id_compra', 'id');    
  }

  public function AtdPessoasFornecedoresCompras()
  {
    return $this->belongsTo(Pessoa::class, 'id_fornecedor', 'id')->withTrashed();
  }

  public function FinanceiroCaixasCompras()
  {
    return $this->belongsTo(Caixa::class, 'id_caixa', 'id');    
  }

  public function FinanceiroComprasDetalhesProdutos()
  {
    return $this->hasMany(CompraDetalhe::class, 'id_compra', 'id');    
  }

  public function FinanceiroComprasPagamentosCompras()
  {
    return $this->hasMany(CompraPagamento::class, 'id_compra', 'id');    
  }

  public function AtdPessoasVendedores()
  {
    return $this->belongsTo(Pessoa::class, 'id_vendedor', 'id');    
  }

// ================================================================================================================= MÉTODOS

  public function getFornecedorAttribute()
  {
    return $this->ysfyhzfsfarfdha->nome ?? '';
  }

// ================================================================================================================= ATRIBUTOS (Nomes)

}
