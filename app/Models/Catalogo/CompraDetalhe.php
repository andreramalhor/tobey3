<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata)
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\Catalogo\Produto;
use App\Models\Catalogo\ContaInterna;

class CompraDetalhe extends Model
{
  use Notifiable;                                     //Se for usar Notifiable (ainda nao sei do q se trata)

  public $timestamps    = true; // or true
  protected $table      = 'fin_compras_detalhes';
  protected $primaryKey = 'id';
  protected $fillable   = [
    'id_compra',
    'id_servprod',
    'qtd',
    'vlr_compra',
    'vlr_negociado',
    'vlr_dsc_acr',
    'vlr_final',
    'status',
  ];

    // ================================================================================================================= RELACIONAMENTOS
    public function aldkekciajsgqwp()
    {
        return $this->belongsTo(Compra::class, 'id_compra', 'id' );
    }

    public function odkqoweiwoeiowj()
    {
        return $this->belongsTo(Produto::class, 'id_servprod', 'id' )->withTrashed();
    }

    public function CatalogoProfissionaisComprasDetalhes()
    {
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id' );
    }

    public function pqwnldkwjfencsb()
    {
        // dd($this->hasOne(ContaInterna::class, 'id_origem', 'id'));
        // return $this->hasOne(ContaInterna::class, 'id_origem', 'id')->where('fonte_origem', with(new static)->getTable());
        // dd($this->hasOne(ContaInterna::class, 'id_origem', 'id')->where('fonte_origem', with(new static)->getTable()));
        return $this->hasOne(ContaInterna::class, 'id_origem', 'id' );
        // return $this->hasOne(ContaInterna::class, 'id_origem', 'id')->where('tipo', 'Comissão');
    }

    // public function setVlrCompraAttribute($value)
    // {
    //     $this->attributes['vlr_compra'] = $value / 100;
    // }

    // public function setVlrNegociadoAttribute($value)
    // {
    //     $this->attributes['vlr_negociado'] = $value / 100;
    // }

    // public function setVlrDscAcrAttribute($value)
    // {
    //     $this->attributes['vlr_dsc_acr'] = $value / 100;
    // }

    // public function setVlrFinalAttribute($value)
    // {
    //     $this->attributes['vlr_final'] = $value / 100;
    // }

//   public static function boot()
//   {
//     parent::boot();
//     self::deleting(function($compra_detalhe)
//     {
//       $compra_detalhe->pqwnldkwjfencsb()->each(function($conta_interna)
//       {
//         $conta_interna->delete();
//       });
//     });
//   }
    // AUXILIARES       ===========================================================================================
    public static function procurar($pesquisa)
    {
      return empty($pesquisa)
      ? static::query()
      : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
                       ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
    }

}
