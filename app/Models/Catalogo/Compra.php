<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;         //Se for usar coluna DELETED_AT no banco de dados
use Illuminate\Notifications\Notifiable;              //Se for usar Notifiable (ainda nao sei do q se trata)
use Carbon\Carbon;                                    //Se for usar tempo, timestamp, fuso-horário, função NOW

use App\Models\Atendimento\Pessoa;
use App\Models\PDV\Caixa;
use App\Models\Catalogo\CompraDetalhe;
use App\Models\Catalogo\CompraPagamento;

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

    public function lkerwiucqwbnlks()
    {
        return $this->hasMany(CompraDetalhe::class, 'id_compra', 'id');
    }

    public function AtdPessoasFornecedoresCompras()
    {
        return $this->belongsTo(Pessoa::class, 'id_fornecedor', 'id')->withTrashed();
    }

    public function CatalogoCaixasCompras()
    {
        return $this->belongsTo(Caixa::class, 'id_caixa', 'id');
    }

    public function CatalogoComprasDetalhesProdutos()
    {
        return $this->hasMany(CompraDetalhe::class, 'id_compra', 'id');
    }

    public function CatalogoComprasPagamentosCompras()
    {
        return $this->hasMany(CompraPagamento::class, 'id_compra', 'id');
    }

    public function AtdPessoasVendedores()
    {
        return $this->belongsTo(Pessoa::class, 'id_vendedor', 'id');
    }

    // MUTATORS         ===========================================================================================
    public function setVlrProdServAttribute($value)
    {
        $this->attributes['vlr_prod_serv'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
    }

    public function setVlrNegociadosAttribute($value)
    {
        $this->attributes['vlr_negociados'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
    }

    public function setVlrDscAcrAttribute($value)
    {
        $this->attributes['vlr_dsc_acr'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
    }

    public function setVlrFinalAttribute($value)
    {
        $this->attributes['vlr_final'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
    }

    public function setVlrCustoAttribute($value)
    {
        $this->attributes['vlr_custo'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
    }

    // ================================================================================================================= MÉTODOS

    public function getFornecedorAttribute()
    {
        return $this->ysfyhzfsfarfdha->nome ?? '';
    }

    // ================================================================================================================= ATRIBUTOS (Nomes)
    // AUXILIARES       ===========================================================================================
    public static function procurar($pesquisa)
    {
        return empty($pesquisa)
            ? static::query()
            : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
            ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
    }
}
