<?php

namespace App\Models\Cadastro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condominio extends Model
{
	use SoftDeletes;

	public $timestamps = true;

	protected $table = 'cad_condominios';
	protected $primaryKey = 'id';
	protected $fillable = [
    'uuid',
    'nome',
    'cnpj',
    'cep',
    'logradouro',
    'numero',
    'complemento',
    'bairro',
    'cidade',
    'uf',
    'ddd',
    'telefone',
    'sindico',
  ];
	protected $guarded = [];
  
  // RELACIONAMENTOS  ===========================================================================================
  public function lsaksdilqjwriqw()
  {
    return true;
    // return $this->hasMany(ServicoProduto::class, 'id_categoria', 'id')->withTrashed();
  }

  // AUXILIARES              ===========================================================================================
  public static function procurar($pesquisa)
  {
    return empty($pesquisa)
        ? static::query()
        : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
        ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
  }
  
  public function getEnderecoAttribute()
  {
    if($this->logradouro != null || $this->bairro != null)
    {
      return $this->logradouro.', '.$this->numero.' - Bairro: '.$this->bairro.'. '.$this->cidade.'/'.$this->uf;
    }
  }
  
  public function getFoneAttribute()
  {
    if($this->telefone != null)
    {
      return '('.$this->ddd.') '.$this->telefone;
    }
  }
}
