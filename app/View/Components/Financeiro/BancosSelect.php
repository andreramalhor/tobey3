<?php

namespace App\View\Components\Financeiro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Financeiro\Banco;

class BancosSelect extends Component
{
    public function __construct()
    {

    }

    public function bancos()
    {
        return Banco::orderBy('nome', 'asc')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components/financeiro/bancos-select');
    }
}
