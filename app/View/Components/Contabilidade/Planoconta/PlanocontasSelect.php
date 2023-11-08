<?php

namespace App\View\Components\Contabilidade\Planoconta;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Contabilidade\Conta as DBPlanoContas;

class PlanocontasSelect extends Component
{
    public function __construct()
    {

    }

    public function planocontas()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Pessoa::planocontas()->orderBy('apelido', 'asc')->get()
        // );
        return DBPlanoContas::
                    orderBy('titulo', 'asc')->
                    get();
    }

    public function render(): View|Closure|string
    {
        return view('components.contabilidade.planoconta.planocontas-select');
    }
}
