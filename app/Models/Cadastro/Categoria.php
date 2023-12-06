<?php

namespace App\Models\Cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Cadastro\ServicoProduto;

class Categoria extends Model
{
	use SoftDeletes;

	public $timestamps = true;

	protected $table = 'cat_categorias';
	protected $primaryKey = 'id';
	protected $fillable = [
		'tipo',
		'nome',
		'descricao'
	];
	protected $guarded = [];
// RELACIONAMENTOS  ===========================================================================================
  public function QDZU9JO2W4UA3WE()
  {
    return $this->hasMany(ServicoProduto::class, 'id_categoria', 'id')->withTrashed();
  }

  public function PZGY650RMFKJ9W7()
  {
    return $this->hasMany(ServicoProduto::class, 'id_categoria', 'id')->where('tipo', '=', 'Produto')->withTrashed();
  }

  public function LZS394PQT9KN8UZ()
  {
    return $this->hasMany(ServicoProduto::class, 'id_categoria', 'id')->where('tipo', '=', 'Serviço')->withTrashed();
  }

  public function Y6VUVJ8QLZOSW1G()
  {
    return $this->hasMany(ServicoProduto::class, 'id_categoria', 'id')->where('tipo', '=', 'Consumo')->withTrashed();
  }
}
