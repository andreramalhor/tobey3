<?php

namespace App\View\Components\Catalogo;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Catalogo\Categoria as DBCategoria;

class CategoriasSelect extends Component
{
    public $tipo;

    public function __construct($tipo)
    {
        $this->tipo = $tipo;
    }

    public function categorias()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Categoria::clientes()->orderBy('apelido', 'asc')->get()
        // );

        return DBCategoria::
                        where('tipo', '=', $this->tipo)->
                        get();
    }

    public function render(): View|Closure|string
    {
        return view('components.catalogo.categorias-select');
    }
}
