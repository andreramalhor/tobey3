<?php

namespace App\Livewire\Ferramenta\Tarefa;

use Livewire\Component;

use App\Models\Ferramenta\Tarefa;

class TarefaItem extends Component
{
    public Tarefa $tarefa;

    protected $rules = [
        'tarefa.feito' => 'boolean',    
    ];
        
    public function render()
    {
        return view('livewire/ferramenta/tarefa/item');
    }
    
    public function updatedTarefa($a, $b)
    {
        $this->tarefa->save();

        $this->dispatch(TarefaListar::class, 'tarefa::atualizada');
    }

    // public function filtrar( $status = 'all')
    // {
        // $this->filter = $status;

        // $tarefas = Tarefa::
        //                 query()->
        //                 when($this->filter == 'feito', fn($q) => $q->where('status', true))->
        //                 when($this->filter == 'pendente', fn($q) => $q->where('status', true))->
        //                 when($this->filter == 'em_andamento', fn($q) => $q->where('status', false))->
        //                 where('id_pessoa', '=', auth()->user()->id )->
        //                 get();

        // return $tarefas;
    // }
}
