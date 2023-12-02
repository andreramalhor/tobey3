<?php

namespace App\View\Components\Catalogo;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Catalogo\Servico as DBServico;

class ServicosSelect extends Component
{
    public $tipo;
    public $id_fornecedor;

    public function __construct($tipo, $id_fornecedor=null)
    {
        $this->tipo = $tipo;
        $this->id_fornecedor = $id_fornecedor;
    }

    public function categorias()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Servico::clientes()->orderBy('apelido', 'asc')->get()
        // );

        return DBServico::
                        where('tipo', '=', $this->tipo)->
                        when($this->id_fornecedor, function ($q)
                        {
                            $q-where('id_fornecedor', '=', $this->id_fornecedor);
                        })->
                        get();
    }

    public function render(): View|Closure|string
    {
        return view('components.catalogo.categorias-select');
    }
}
