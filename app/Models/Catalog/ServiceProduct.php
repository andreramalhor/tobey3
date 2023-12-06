<?php

namespace App\Models\Catalog;

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

class ServiceProduct extends Model
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
    // 'categoria',
	];

// RELACIONAMENTOS  ===========================================================================================
  public function i8tk3ymx5u()
  {
    return $this->belongsToMany(Pessoa::class, 'cnf_fornecedor_produto', 'id_servprod', 'id_fornecedor');
  }

  public function gbikot40ki()
  {
    return $this->hasOne(Categoria::class, 'id', 'id_categoria');
  }

  public function a349c74m03()
  {
    return $this->belongsToMany(Pessoa::class, 'cnf_fornecedor_produto', 'id_servprod', 'id_fornecedor');
  }
  
// GETTERS AND SETTER  ========================================================================================
  public function getEstoqueAtualAttribute()
  {
    $comprado = CompraDetalhe::where('id_servprod', $this->id)->sum('qtd');
    $vendido = VendaDetalhe::where('id_servprod', $this->id)->count();
    
    return $comprado - $vendido;
  }

  public function getCategoriaAttribute()
  {
  	return $this->gbikot40ki->nome;
  }
}
