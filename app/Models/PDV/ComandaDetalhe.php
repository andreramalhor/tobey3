<?php

namespace App\Models\PDV;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata) 
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\Catalogo\Produto;
use App\Models\PDV\Comanda;
use App\Models\Financeiro\ContaPessoa;

class ComandaDetalhe extends Model
{
  use Notifiable;                                     //Se for usar Notifiable (ainda nao sei do q se trata) 

  public $timestamps    = true; // or true
  protected $table      = 'pdv_comandas_detalhes';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_comanda',
    'id_servprod',
    'vlr_venda',
    'vlr_negociado',
    'vlr_dsc_acr',
    'vlr_final',
    'status',
  ];

// ================================================================================================================= RELACIONAMENTOS
  public function LigacaoDeContaClienteOuProfissional()
  {
    return $this->hasOne(ContaPessoa::class, 'id_origem', 'id')->where('fonte_origem', with(new static)->getTable());
    // dd($this->hasOne(ContaPessoa::class, 'id_origem', 'id')->where('fonte_origem', with(new static)->getTable()));
    // return $this->hasOne(ContaPessoa::class, 'id_origem', 'id')->where('tipo', 'Comissão');
  }
  public function LigacaoDoProdutoNaComandaComComissaoPaga ()
  {
    return $this->hasOne(ContaPessoa::class, 'id_origem', 'id');
  }

  public function EsseDetalheDeQualComanda()
  {
    return $this->belongsTo(Comanda::class, 'id_comanda', 'id' );
  }

  public function PDVProdutosComandasDetalhes()
  {
    return $this->belongsTo(Produto::class, 'id_servprod', 'id' )->withTrashed();
  }

  public function PDVProfissionaisComandasDetalhes()
  {
    return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id' );
  }

}
