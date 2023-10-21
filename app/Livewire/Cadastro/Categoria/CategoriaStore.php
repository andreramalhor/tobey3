<?php

namespace App\Livewire\Cadastro\Categoria;

use App\Models\Cadastro\Categoria as DBCategoria;
use Livewire\Component;

class CategoriaStore extends Component
{
    public $tipo;
    public $nome;
    public $descricao;
    public $openModal = false;

    protected $rules = [
        'nome' => ['required', 'unique:cat_categorias,nome', 'min:2', 'max:30'],
        'tipo' => ['required'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModalToCreateCategoria()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function store()
    {
        DBCategoria::create([
            'tipo' => $this->tipo,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
        ]);

        $this->dispatch('updated', [
            'title'     => 'Categoria criada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->dispatch('close-modal');

        $this->reset();
    }

    public function render()
    {
        return view('livewire/cadastro/categoria/categoria-store');
    }
}
