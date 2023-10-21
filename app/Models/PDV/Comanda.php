<?php

namespace App\Models\PDV;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados
use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Caixa;
use App\Models\PDV\ComandaDetalhe;
use App\Models\PDV\ComandaPagamento;

class Comanda extends Model
{
	use SoftDeletes;                                    //Se for usar coluna DELETED_AT no banco de dados
  use Notifiable;                                 		//Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps    = true;
  protected $table      = 'pdv_comandas';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_caixa', 
    'id_usuario', 
    'id_agendamento', 
    'id_cliente', 
    'qtd_produtos', 
    'vlr_prod_serv', 
    'vlr_negociados', 
    'vlr_dsc_acr', 
    'vlr_final', 
    'status', 
  ];

// ================================================================================================================= RELACIONAMENTOS
  public function QualClienteDessaComanda()
  {
    return $this->belongsTo(Pessoa::class, 'id_cliente', 'id')->withTrashed();
  }

  public function PDVCaixasComandas()
  {
    return $this->belongsTo(Caixa::class, 'id_caixa', 'id');    
  }

  public function PDVComandasDetalhesProdutos()
  {
    return $this->hasMany(ComandaDetalhe::class, 'id_comanda', 'id');    
  }

  public function PDVComandasPagamentosComandas()
  {
    return $this->hasMany(ComandaPagamento::class, 'id_comanda', 'id');    
  }

  public function AtdPessoasVendedores()
  {
    return $this->belongsTo(Pessoa::class, 'id_vendedor', 'id');    
  }

// ================================================================================================================= MÉTODOS

// ================================================================================================================= ATRIBUTOS (Nomes)

}
