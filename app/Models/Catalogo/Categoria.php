<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $table      = 'cat_categorias';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'tipo',
        'nome',
        'descricao',
    ];

    // RELACIONAMENTOS  ===========================================================================================


    // MUTATORS         ===========================================================================================


    // FUNÇÕES          ===========================================================================================


    // AUXILIARES       ===========================================================================================
    public static function pesquisar($pesquisar)
    {
        return empty($pesquisar)
            ? static::query()
            : static::query()->where('id', 'like', '%'. $pesquisar .'%')->
                             orWhere('nome', 'like', '%'. $pesquisar .'%')->
                             orWhere('tipo', 'like', '%'. $pesquisar .'%')->
                             orWhere('descricao', 'like', '%'. $pesquisar .'%');
    }

    public static function procurar($pesquisa)
    {
        return empty($pesquisa)
            ? static::query()
            : static::query()->where('nome', 'LIKE', '%'.$pesquisa.'%')
                             ->orWhere('id', 'LIKE', '%'.$pesquisa.'%');
    }
}
