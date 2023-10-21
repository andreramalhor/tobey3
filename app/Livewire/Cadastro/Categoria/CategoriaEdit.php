<?php

namespace App\Livewire\Cadastro\Categoria;

use App\Models\Cadastro\Categoria as DBCategoria;
use Livewire\Component;

class CategoriaEdit extends Component
{
    public $nome, $tipo, $descricao;
    public $categoria;
    public $openModal = false;
    public $formId;


    public function mount($categoria)
    {
        $this->formId = $categoria->id;
    }

    protected $rules = [
        'categroia.nome' => ['required', 'unique:cat_categorias,nome', 'min:2', 'max:30'],
        'categroia.tipo' => ['required'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModalToUpdateCategoria()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function update()
    {
        dd($this->categoria, $this->nome);
        $this->categoria->update([
            'tipo' => $this->categoria->tipo,
            'nome' => $this->categoria->nome,
            'descricao' => $this->categoria->descricao,
        ]);

        $this->dispatch('updated', [
            'title'     => 'Categoria atualizada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);


        $this->dispatch('close-modal');

        $this->reset();
    }

        public function render()
    {
        return view('livewire/cadastro/categoria/categoria-edit');
    }
}
