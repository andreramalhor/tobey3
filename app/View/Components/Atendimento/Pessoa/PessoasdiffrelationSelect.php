<?php

namespace App\View\Components\Atendimento\Pessoa;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Atendimento\Pessoa;

class PessoasdiffrelationSelect extends Component
{
    public $relacionamento;
    public $selecionado;

    public function __construct($relacionamento, $selecionado=null)
    {
        $this->relacionamento = $relacionamento;
        $this->selecionado    = $selecionado;
    }

    public function pessoas()
    {
        // return cache()->rememberForever( //live pinguin Laravel Blade Components - Parte 2 - a partir d minuto 49
            // 'user::manager',
            // fn() => Pessoa::pessoas()->orderBy('apelido', 'asc')->get()
        // );

        $relacionamento = $this->relacionamento;

        return Pessoa::doesntHave($relacionamento)->orderBy('apelido', 'asc')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.atendimento.pessoas.pessoas-select', [
            'selecionado' => $this->selecionado,
        ]);
    }
}
