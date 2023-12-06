<?php

namespace App\Models\Cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Models\Atendimento\Pessoa;
use App\Models\PDV\VendaDetalhe;
use App\Models\Financeiro\CompraDetalhe;
use App\Models\Financeiro\ContaPessoa;
use App\Models\Catalogo\Categoria;
use App\Models\pivots\ColaboradorServico;
use App\Models\pivots\FornecedorProduto;

class ServicoProduto extends Model
{
	use SoftDeletes;

	protected $primaryKey = 'id';
	protected $table      = 'cat_produtos_servicos';
	protected $fillable   = [
		'tipo',
		'ativo',
		'nome',
		'id_categoria',
		'tipo_preco',
		'vlr_venda',
		'cst_adicional',
		'prc_comissao',
		'tempo_retorno',
		'duracao',
		'fidelidade_pontos_ganhos',
		'fidelidade_pontos_necessarios',

		'unidade',
		'marca',

		'cod_nota',
		'cod_barras',
		'estoque_min',
		'estoque_max',
		'ncm_prod_serv',
		'ipi_prod_serv',
		'icms_prod_serv',
		'simples_prod_serv',
		'vlr_mercado',
		'vlr_nota',
		'vlr_frete',
		'vlr_comissao',
		'vlr_marg_contribuicao',
		'marg_contribuicao',
		'vlr_custo',
		'vlr_custo_estoque',
		'margem_custo',
		'consumo_medio',
		'cmv_prod_serv',
		'curva_abc',
		'id_fornecedor',
		'descricao',
		'status',
	];
	protected $appends = [
    'estoque_atual',
    'link_tipo',
    // 'imagem',
    // 'imagem_servprod',
    // 'mnome',
	];

// RELACIONAMENTOS  ===========================================================================================
  public function ecgklyqfdcoguyj()
  {
    return $this->hasOne(Categoria::class, 'id', 'id_categoria');
  }

  public function xcuwqubcfetnftm()
  {
    return $this->hasManyThrough(
      Pessoa::class,                // Model Final
      FornecedorProduto::class,     // Model Meio
      'id_servprod',                 // Chave estrangeira na model Meio ...
      'id',                         // Chave principal na model Final ...
      'id',                         // Chave principal na model que estou ...
      'id_fornecedor');             // Chave principal na model Meio ...
  }

  public function aksjaldjfwjlwfp()
  {
    return $this->hasMany(ColaboradorServico::class, 'id_servprod', 'id');
  }

  public function weqlkwejqlkjlks()
  {
    return $this->belongsToMany(Pessoa::class, 'cnf_colaborador_servico', 'id_servprod', 'id_profexec')->withPivot(['executa', 'prc_comissao']);
  }

  public function QualPessoaForneceEsseProduto()
  {
    return $this->belongsToMany(Pessoa::class, 'cnf_fornecedor_produto', 'id_servprod', 'id_fornecedor');
  }

  public function ServicoOuProdutoNoDetalheDaComanda()
  {
    return $this->hasMany(VendaDetalhe::class, 'id_servprod', 'id');
  }

  public function ProdutoNoDetalheDaComanda()
  {
    return $this->hasMany(CompraDetalhe::class, 'id_servprod', 'id');
  }

  public function PivotServicoAteContaPessoaPassandoPorDetalhe()
  {
    return $this->hasManyThrough(
      ContaPessoa::class,           // Model Alvo
      VendaDetalhe::class,        // Model Através
      'id',                         // Chave estrangeira na model Através ...
      'id_origem',                  // Chave estrangeira na model Alvo...
      'id',                         // Chave principal na model que estou...
      'id_servprod');              // Chave principal na model Através...
  }

  public function smenhgskqwmdjwe()
  {
    return $this->hasMany(ColaboradorServico::class, 'id_servprod', 'id');
  }

  public function smenhgskqwmdjwz()
  {
    // return $this->belongsTo(ColabServ::class, 'id', 'id_servprod' );
    return $this->belongsTo(ColaboradorServico::class, 'id', 'id_servprod')->withPivot(['executa', 'prc_comissao']);;
  }

  public static function boot()
  {
    parent::boot();

    static::deleting(function($prod_serv)
    {
      $prod_serv->smenhgskqwmdjwe()->delete();
    });
}

// MUTATORS         ===========================================================================================

	public function setVlrVendaAttribute($value)
	{
    $this->attributes['vlr_venda'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

	public function setVlrMercadoAttribute($value)
	{
    $this->attributes['vlr_mercado'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}
	
	public function setVlrNotaAttribute($value)
	{
    $this->attributes['vlr_nota'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

	public function setVlrFreteAttribute($value)
	{
    $this->attributes['vlr_frete'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

	public function setVlrComissaoAttribute($value)
	{
    $this->attributes['vlr_comissao'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

	public function setVlrMargContribuicaoAttribute($value)
	{
    $this->attributes['vlr_marg_contribuicao'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

	public function setVlrCustoAttribute($value)
	{
    $this->attributes['vlr_custo'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

	public function setVlrCustoEstoqueAttribute($value)
	{
    $this->attributes['vlr_custo_estoque'] = str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $value)));
	}

  public function getEstoqueAtualAttribute()
  {
    $comprado = CompraDetalhe::where('id_servprod', $this->id)->sum('qtd');
		
    $vendido = VendaDetalhe::where('id_servprod', $this->id)->count();
		
    return $comprado - $vendido;
  }
	
  public function getImagemAttribute()
  {
    if(file_exists(public_path('/img/catalogo/servsprods/'.$this->id.'.png')))
    {
      return asset('/img/catalogo/servsprods/'.$this->id.'.png');
    }
    else
    {
      return asset('/img/catalogo/servsprods/0.png');
    }
  }
	
  public function getImagemServProdAttribute()
  {
    if(file_exists(public_path('/img/catalogo/servsprods/'.$this->id.'.png')))
    {
      return '<img src="'.asset('/img/catalogo/servsprods/'.$this->id.'.png').'" alt="'.$this->nome.'" class="border border-secondary rounded" width="50px">';
    }
    else
    {
      return '<img src="'.asset('/img/catalogo/servsprods/0.png').'" alt="'.$this->nome.'" class="border border-secondary rounded" width="50px">';
    }
  }
  
  public function getLinkTipoAttribute()
  {
    switch ($this->tipo)
    {
      case 'Serviço':
        return 'servicos';
        break;

      case 'Produto':
        return 'produtos';
        break;

      case 'Consumo':
        return 'consumo';
        break;
    }
  }

  public function getMnomeAttribute()
  {
    if($this->marca == null)
    {
      return $this->marca.' | '.$this->nome;
    }
    else
    {
      return $this->marca.' | '.$this->nome;
    }
  }
}
