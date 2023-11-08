<?php

namespace App\View\Components\Financeiro\Banco;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Financeiro\Banco as DBBanco;

class BancosSelect extends Component
{
    public function __construct()
    {

    }

    public function bancos()
    {
        return DBBanco::orderBy('nome', 'asc')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components/financeiro/banco/bancos-select');
    }
}
