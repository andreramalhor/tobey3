<?php

namespace App\Livewire\Cadastro;

use Livewire\Attributes\Rule;
use App\Models\Cadastro\Categoria as DBCategoria;
use Livewire\Component;
use Livewire\WithPagination;

class Categoria extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    #[Rule('required|min:3')]
    public $nome;

    #[Rule('required')]
    public $tipo;
    public $descricao;

    public $isOpen = 0;
    public $categoriaId;

    protected $listeners = ['chamarMetodo' => 'remove'];

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
        DBCategoria::create([
            'nome' => $this->nome,
            'tipo' => $this->tipo,
            'descricao' => $this->descricao,
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Categoria criada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('categoriaId');
        $this->closeModal();
    }

    public function edit($id)
    {
        $categoria = DBCategoria::findOrFail($id);
        $this->categoriaId = $id;
        $this->nome = $categoria->nome;
        $this->tipo = $categoria->tipo;
        $this->descricao = $categoria->descricao;

        $this->openModal();
    }

    public function update()
    {
        if ($this->categoriaId)
        {
            $categoria = DBCategoria::findOrFail($this->categoriaId);
            $categoria->update([
                'nome' => $this->nome,
                'tipo' => $this->tipo,
                'descricao' => $this->descricao,
            ]);

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Categoria atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $categoria = DBCategoria::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $categoria->nome,
            'text'         => 'Tem certeza que quer deletar a categoria?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $categoria->id,
        ]);
    }

    public function remove($id)
    {
        DBCategoria::find($id)->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => 'Categoria deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('categoriaId');
    }

    public function listar()
    {

        $categorias = DBCategoria::
                                procurar($this->pesquisar)->
                                paginate(10);

        return $categorias;
    }

    public function render()
    {
        $categorias = $this->listar();

        return view('livewire/cadastro/categoria/index', [
            'categorias' => $categorias,
        ])->layout('layouts/app');
    }
}
