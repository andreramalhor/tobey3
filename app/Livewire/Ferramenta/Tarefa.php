<?php

namespace App\Livewire\Ferramenta;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Ferramenta\Tarefa as DBTarefa;

class Tarefa extends Component
{
    public $id_criador;

    #[Rule('required')]
    public $id_responsavel;

    #[Rule('required|min:3')]
    public $titulo;

    public $descricao;
    public $status = 'Aguardando';
    public $prazo;
    public $arquivado;

    public $isOpen = 0;
    public $tarefaId;

    public function create()
    {
        $this->reset();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();
        DBTarefa::create([
            'id_criador'     => auth()->user()->id,
            'id_responsavel' => $this->id_responsavel,
            'titulo'         => $this->titulo,
            'descricao'      => $this->descricao,
            'status'         => $this->status,
            'prazo'          => $this->prazo,
            'arquivado'      => $this->arquivado,
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Tarefa criada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('tarefaId');
        $this->closeModal();
    }

    public function edit($id)
    {
        $tarefa = DBTarefa::findOrFail($id);
        $this->tarefaId = $id;
        $this->id_criador      = $tarefa->id_criador;
        $this->id_responsavel  = $tarefa->id_responsavel;
        $this->titulo          = $tarefa->titulo;
        $this->descricao       = $tarefa->descricao;
        $this->status          = $tarefa->status;
        $this->prazo           = $tarefa->prazo;
        $this->arquivado       = $tarefa->arquivado;

        $this->openModal();
    }

    public function update()
    {
        if ($this->tarefaId)
        {
            $tarefa = DBTarefa::findOrFail($this->tarefaId);
            $tarefa->update([
                'id_criador'     => auth()->user()->id,
                'id_responsavel' => $this->id_responsavel,
                'titulo'         => $this->titulo,
                'descricao'      => $this->descricao,
                'status'         => $this->status,
                'prazo'          => $this->prazo,
                'arquivado'      => $this->arquivado,
            ]);

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Tarefa atualizado com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $tarefa = DBTarefa::find($id)->delete();

        $this->dispatch('swal:confirm', [
            'title'        => $tarefa->titulo,
            'text'         => 'Tem certeza que quer deletar a tarefa?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $tarefa->id,
        ]);

        $this->resetExcept('tarefaId');
    }

    public function marcar($id, $status)
    {
        $tarefa = DBTarefa::findOrFail($id);

        switch ($status)
        {
            case 'Aguardando':
            case 'Urgente':
            case 'Atrasado':
            case 'Outro':
                $tarefa->update([ 'status' => 'Concluído' ]);
                break;
            case 'Concluído':
                $tarefa->update([ 'status' => 'Aguardando' ]);
                break;
        }

        $this->dispatch('swal:alert', [
            'title'     => 'Atualizado!',
            'text'      => 'Status tarefa: '.$tarefa->status.' !',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

    }

    public function render()
    {
        $tarefas = DBTarefa::
                            // where('id_responsavel', '=', auth()->user()->id)->
                            // orderByRaw("
                            //     FIELD(status, 'Urgente') DESC,
                            //     FIELD(status, 'Atrasado') DESC,
                            //     FIELD(status, 'Aguardando') DESC,
                            //     FIELD(status, 'Concluido') ASC
                            // ")->
                            get();

        return view('livewire/ferramenta/tarefa/index', [
            'tarefas' => $tarefas,
        ])->layout('layouts/app');
    }
}
