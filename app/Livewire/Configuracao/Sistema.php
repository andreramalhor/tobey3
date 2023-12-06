<?php

namespace App\Livewire\Configuracao;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Sistema extends Component
{
    public $botao_usuarios;
    public $botao_bancos;
        
    #[Rule('required|min:3')]
    public $nome;
    
    #[Rule('required')]
    public $tipo;
    public $descricao;
    
    public $modalType;
    public $sistema;
    public $sistemaId;
    
    protected $listeners = ['chamarMetodo' => 'remove'];
    
    public function mount()
    {
        $this->botao_usuarios = 'active';
    }

    public function selecionarMenu($menu)
    {
        $this->reset();
        $this->$menu = 'active';
    }

    public function create()
    {
        $this->reset();
        $this->openModal('store');
    }

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->modalType = '';
        $this->sistema = '';
    }

    public function store()
    {
        $this->validate();
        DBSistema::create([
            'nome'      => $this->nome,
            'tipo'      => $this->tipo,
            'descricao' => $this->descricao,
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Sistema criada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('sistemaId');
        $this->closeModal();
    }

    public function show($id)
    {
        $this->sistema = DBSistema::findOrFail($id);

        $this->openModal('show');
    }

    public function edit($id)
    {
        $sistema = DBSistema::findOrFail($id);
        $this->sistemaId = $id;
        $this->nome        = $sistema->nome;
        $this->tipo        = $sistema->tipo;
        $this->descricao   = $sistema->descricao;

        $this->openModal('store');
    }

    public function update()
    {
        if ($this->sistemaId)
        {
            $sistema = DBSistema::findOrFail($this->sistemaId);
            $sistema->update([
                'nome' => $this->nome,
                'tipo' => $this->tipo,
                'descricao' => $this->descricao,
            ]);

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Sistema atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $sistema = DBSistema::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $sistema->nome,
            'text'         => 'Tem certeza que quer deletar a sistema?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $sistema->id,
        ]);
    }

    public function remove($id)
    {
        DBSistema::find($id)->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => 'Sistema deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('sistemaId');
    }

    public function render()
    {
        return view('livewire/configuracao/sistema/index')->layout('layouts/app');
    }
}
