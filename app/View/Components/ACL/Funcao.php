<?php

namespace App\View\Components\ACL;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\ACL\Funcao as DBFuncao;

class Funcao extends Component
{
    public $destino;
    public $colunas;
    public $status;
    public $pessoa = [];
    public $name;

    public function __construct($destino, $status=null, $pessoa=null, $colunas=1, $name=null)
    {
        $this->destino = $destino;
        $this->status  = $status;
        $this->pessoa  = $pessoa;
        $this->colunas = $colunas;
        $this->name    = $name;
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
                return view('components.acl.funcao.checkbox', [
                    'contem'  => $this->pessoa,
                    'status'  => $this->status,
                    'colunas' => $this->colunas,
                    'name'    => $this->name,
                ]);
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
