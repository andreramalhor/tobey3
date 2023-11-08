<?php

namespace App\View\Components\Atendimento\Pessoa;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Atendimento\Pessoa;

class PessoasSelect extends Component
{
    public $filtro;
    public $sinal;

    public function __construct($filtro=null, $sinal="=")
    {
        $this->filtro = $filtro;
        $this->sinal  = $sinal;
    }

    public function pessoas()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Pessoa::pessoas()->orderBy('apelido', 'asc')->get()
        // );
        $filtro = $this->filtro;
        $sinal  = $this->sinal;

        return Pessoa::
                        when(!is_null($filtro), function ($q) use ($filtro, $sinal)
                        {
                            $q->whereHas('wuclsoqsdppaxmf', function(Builder $query) use ($filtro, $sinal)
                            {
                                $query->where('nome', $sinal, $filtro);
                            });
                        })->
                        orderBy('apelido', 'asc')->
                        get();
    }

    public function render(): View|Closure|string
    {
        return view('components.atendimento.pessoas.pessoas-select');
    }
}
