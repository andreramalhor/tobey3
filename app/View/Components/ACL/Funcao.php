<?php

namespace App\View\Components\ACL;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\ACL\Funcao as DBFuncao;

class Funcao extends Component
{

    public $destino;

    public function __construct($destino)
    {
        $this->destino = $destino;
    }

    public function funcoes()
    {
        return DBFuncao::get();
    }

    public function render()
    {
        switch ($this->destino)
        {
            case 'checkbox':
                return view('components.acl.funcao.checkbox');
                break;

            case 'select':
                return view('components.acl.funcao.select');
                break;

            default:
                dd(555);
                # code...
                break;
        }
    }
}
