<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class beerandcode extends Component
{
    public $texto;
    public $tipo;
    public $mensagem;

    public function __construct($texto,$tipo,$mensagem)
    {
        $this->texto = $texto;
        $this->tipo = $tipo;
        $this->mensagem = $mensagem;
    }

    public function render(): View|Closure|string
    {
        return view('components.beerandcode');
    }

    public function nomes($nome)
    {
        return [
            'andre',
            'lucas',
            'mabel',
            $nome
        ];
    }
}
