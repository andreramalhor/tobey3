<?php

namespace App\View\Components\Atendimento\Pessoa;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Atendimento\Pessoa;

class ColaboradoresSelect extends Component
{
    public function __construct()
    {

    }

    public function colaboradores()
    {
        return Pessoa::colaboradores()->orderBy('apelido', 'asc')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.atendimento.pessoas.colaboradores-select');
    }
}
