<?php

namespace App\Livewire\Configuracao;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use App\Models\User as DBUsuario;
use App\Models\Atendimento\Pessoa as DBPessoa;
use Livewire\Component;
use Livewire\WithPagination;

class Usuario extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';
    public $talagada;

    public $funcoes = [];

    #[Rule('required')]
    public $id_pessoa;

    #[Rule('required|email|unique:users,email,IGNORE_ID')]
    public $email;
    public $password = 123456;

    public $modalType;
    public $usuario;
    public $usuarioId;

    protected $listeners = ['chamarMetodo' => 'remove'];

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
        $this->usuario = '';
    }

    public function preencher_email()
    {
        $pessoa = DBPessoa::find($this->id_pessoa);

        $this->email = $pessoa->email;

        $this->funcoes = $pessoa->kjahdkwkbewtoip->pluck('id');
    }

    public function store()
    {
        $this->validate();

        $pessoa = DBPessoa::find($this->id_pessoa);
        $pessoa->kjahdkwkbewtoip()->sync($this->funcoes);

        DBUsuario::create([
            'id'       => $pessoa->id,
            'name'     => $pessoa->apelido,
            'email'    => $this->email,
            'password' => Hash::make(123456),
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Usuário criado com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('usuarioId');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->usuarioId = $id;
        $this->usuario   = DBUsuario::findOrFail($id);
        $this->id_pessoa = $this->usuario->name;
        $this->email     = $this->usuario->email;
        $this->password  = '*******';
        $this->funcoes   = $this->usuario->kjahdkwkbewtoip->pluck('id');

        $this->openModal('edit');
    }

    public function update()
    {
        if ($this->usuarioId)
        {
            $pessoa = DBPessoa::findOrFail($this->usuarioId);
            $pessoa->kjahdkwkbewtoip()->sync($this->funcoes);

            $pessoa->update([
                'name'     => $pessoa->apelido,
                'email'    => $this->email,
            ]);

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Usuário atualizado com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $usuario = DBUsuario::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $usuario->name,
            'text'         => 'Tem certeza que quer remover o usuário?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $usuario->id,
        ]);
    }

    public function remove($id)
    {
        $usuario = DBUsuario::find($id);
        $usuario->kjahdkwkbewtoip()->detach();
        $usuario->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => 'Usuário removido com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('usuarioId');
    }

    public function listar()
    {
        $usuarios = DBUsuario::
                            procurar($this->pesquisar);

        return $usuarios;
    }

    public function render()
    {
        $usuarios = $this->listar()->orderBy('name', 'asc')->paginate(10);

        return view('livewire/configuracao/usuario/index', [
            'usuarios' => $usuarios,
        ])->layout('layouts/app');
    }
}
