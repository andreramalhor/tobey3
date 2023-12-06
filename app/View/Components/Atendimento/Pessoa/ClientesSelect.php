<?php

namespace App\View\Components\Atendimento\Pessoa;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Atendimento\Pessoa;

class ClientesSelect extends Component
{
    public function __construct()
    {

    }

    public function clientes()
    {
        // return cache()->rememberForever( //live pinguim Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Pessoa::clientes()->orderBy('apelido', 'asc')->get()
        // );
        return Pessoa::
                    clientes()->
                    orderBy('apelido', 'asc')->
                    get();
    }

    public function render(): View|Closure|string
    {
        return view('components.atendimento.pessoas.clientes-select');
    }
}
