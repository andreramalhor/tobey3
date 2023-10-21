<?php

namespace App\Livewire\Ferramenta\Kanban;

use Livewire\Component;

use App\Models\Ferramenta\Kanban;

class Kanbanlistar extends Component
{
    public $inicio;
    public $final;

    public function render()
    {
        $Kanbans = $this->listar();
        
        return view('livewire/ferramenta/kanban/listar', [
            'Kanbans' => $Kanbans,
        ])->layout('layouts/app');
    }

    public function listar()
    {
        $inicio = \Carbon\Carbon::now()->startOfMonth();
        $final  = \Carbon\Carbon::now()->endOfmonth();
    
        $Kanbans = Kanban::
            // whereBetween('dt_competencia', [$inicio, $final])->
            // procurar($this->pesquisa)->
            get();
            // paginate();
        
        return $Kanbans;
    }

}
