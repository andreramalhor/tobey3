<?php

namespace App\Livewire\Ferramenta\Tarefa;

use Livewire\Component;

use App\Models\Ferramenta\Tarefa;

class TarefaCriar extends Component
{
    public $titulo = '';
 
    public function render()
    {
        return view('livewire/ferramenta/tarefa/criar');
    }

    public function save()
    {
        Tarefa::create([
            'titulo' => $this->titulo,
            'arquivado' => 0,
            'feito' => 0,
            'id_pessoa' => auth()->user()->id
        ]);

        $this->reset('titulo');

        $this->dispatch('nome-do-evento')->to(TarefaListar::class);
    }
    
}
