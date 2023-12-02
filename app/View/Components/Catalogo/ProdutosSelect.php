<?php

namespace App\View\Components\Catalogo;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Catalogo\Produto as DBProduto;

class ProdutosSelect extends Component
{
    public $id_fornecedor;

    public function __construct($id_fornecedor=null)
    {
        dump($id_fornecedor, $this->id_fornecedor);
        $this->id_fornecedor = $id_fornecedor;
    }

    public function produtos()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Produto::clientes()->orderBy('apelido', 'asc')->get()
        // );
        return DBProduto::
                        where('tipo', '=', 'Produto')->
                        when($this->id_fornecedor, function ($q)
                        {
                            $q-where('id_fornecedor', '=', $this->id_fornecedor);
                        })->
                        get();
    }

    public function render(): View|Closure|string
    {
        return view('components.catalogo.produtos-select');
    }
}
