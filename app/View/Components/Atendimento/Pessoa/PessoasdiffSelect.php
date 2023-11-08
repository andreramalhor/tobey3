<?php

namespace App\View\Components\Atendimento\Pessoa;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Atendimento\Pessoa;

class PessoasdiffSelect extends Component
{
    public $filtro;

    public function __construct($filtro=null)
    {
        $this->filtro = $filtro;
    }

    public function pessoas()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Pessoa::pessoas()->orderBy('apelido', 'asc')->get()
        // );

        $filtro = $this->filtro;

        return Pessoa::
                        when(!is_null($filtro), function ($q) use ($filtro)
                        {
                            $q->whereDoesntHave('wuclsoqsdppaxmf', function(Builder $query) use ($filtro)
                            {
                                $query->whereIn('nome', $filtro);
                            });
                        })->
                        when(is_null($filtro), function ($q)
                        {
                            $q->doesntHave('eoprtjweornweuq')->get();
                        })->
                        orderBy('apelido', 'asc')->
                        get();
    }

    public function render(): View|Closure|string
    {
        return view('components.atendimento.pessoas.pessoas-select');
    }
}
