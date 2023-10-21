<?php

namespace App\Livewire\Ferramenta\Tarefa;

use Livewire\Component;

use App\Models\Ferramenta\Tarefa;

class TarefaListar extends Component
{
    protected $listeners = [
        'nome-do-evento' => '$refesh',
        'tarefaatualizada' => '$refesh',
        'tarefacriada' => '$refesh',
    ];

    public function funcaoQuandoEventoRecebido()
    {
        $this->refresh();
    }

    public function render()
    {
        // $tarefas = $this->filtrar();
        $tarefas = Tarefa::
                        where('id_pessoa', '=', auth()->user()->id )->
                        orderBy('feito', 'asc')->
                        get();

        return view('livewire/ferramenta/tarefa/index', [
            'tarefas' => $tarefas
        ])->layout('layouts/app');
    }

    // public function filtrar( $status = 'all')
    // {
    //     // $this->filter = $status;

    //     $tarefas = Tarefa::
    //                     // query()->
    //                     // when($this->filter == 'arquivado', fn($q) => $q->where('arquivado', true))->
    //                     where('id_pessoa', '=', auth()->user()->id )->
    //                     orderBy('feito', 'asc')->
    //                     get();

    //     return $tarefas;
    // }
}
