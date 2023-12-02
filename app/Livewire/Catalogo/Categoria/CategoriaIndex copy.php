<?php

namespace App\Livewire\Cadastro\Categoria;

use App\Models\Cadastro\Categoria as DBCategoria;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriaIndex extends Component
{
    use WithPagination;
    public $porpagina = 10;
    public $pesquisar = '';
    public $ordenarpor = 'id';
    public $ordemasc = 'true';

    public function render()
    {
        $categorias = DBCategoria::
                                    pesquisar($this->pesquisar)->
                                    orderBy('id', 'desc')->
                                    // orderBy($this->ordenarpor, $this->ordemasc ? 'asc' : 'desc' )->
                                    paginate($this->porpagina);

        return view('livewire/cadastro/categoria/categoria-index', [
            'categorias'  =>  $categorias
        ])->layout('layouts/app');
    }
}
