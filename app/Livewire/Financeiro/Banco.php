<?php

namespace App\Livewire\Financeiro;

use Livewire\Attributes\Rule;
use App\Models\Financeiro\Banco as DBBanco;
use Livewire\Component;
use Livewire\WithPagination;

class Banco extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    public $bd_id;
    public $bd_id_empresa;
    #[Rule('required|min:3')]
    public $bd_nome;
    public $bd_num_banco;
    public $bd_num_agencia;
    public $bd_num_conta;
    public $bd_saldo_inicial;
    public $bd_cod_carteira;
    public $bd_chave_pix;
    public $bd_pix;

    public $modalType;
    public $banco;

    protected $listeners = ['chamarMetodo' => 'deletar'];

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->resetValidation();
    }
    
    public function closeModal()
    {
        $this->modalType = '';
        $this->banco = '';
    }

    public function criar()
    {
        $this->reset();
        $this->openModal('criar');
    }

    public function gravar()
    {
        $this->validate();
        DBBanco::create([
            'id_empresa'    => 1,
            'nome'          => $this->bd_nome ?? null,
            'num_banco'     => $this->bd_num_banco ?? null,
            'num_agencia'   => $this->bd_num_agencia ?? null,
            'num_conta'     => $this->bd_num_conta ?? null,
            'saldo_inicial' => $this->bd_saldo_inicial ?? null,
            'cod_carteira'  => $this->bd_cod_carteira ?? null,
            'chave_pix'     => $this->bd_chave_pix ?? null,
            'pix'           => $this->bd_pix ?? null,
        
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Banco criado com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->reset();
        $this->closeModal();
    }

    public function editar($id)
    {
        $this->banco            = DBBanco::findOrFail($id);
        $this->bd_id            = $id;
        $this->bd_id_empresa    = $this->banco->id_empresa ?? null;
        $this->bd_nome          = $this->banco->nome ?? null;
        $this->bd_num_banco     = $this->banco->num_banco ?? null;
        $this->bd_num_agencia   = $this->banco->num_agencia ?? null;
        $this->bd_num_conta     = $this->banco->num_conta ?? null;
        $this->bd_saldo_inicial = $this->banco->saldo_inicial ?? null;
        $this->bd_cod_carteira  = $this->banco->cod_carteira ?? null;
        $this->bd_chave_pix     = $this->banco->chave_pix ?? null;
        $this->bd_pix           = $this->banco->pix ?? null;

        $this->openModal('editar');
    }

    public function atualizar()
    {
        if ($this->bd_id)
        {
            $this->banco = DBBanco::findOrFail($this->bd_id);
            $this->banco->update([
                'id_empresa'    => 1,
                'nome'          => $this->bd_nome ?? null,
                'num_banco'     => $this->bd_num_banco ?? null,
                'num_agencia'   => $this->bd_num_agencia ?? null,
                'num_conta'     => $this->bd_num_conta ?? null,
                'saldo_inicial' => $this->bd_saldo_inicial ?? null,
                'cod_carteira'  => $this->bd_cod_carteira ?? null,
                'chave_pix'     => $this->bd_chave_pix ?? null,
                'pix'           => $this->bd_pix ?? null,
            ]);

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Banco atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->reset();
            $this->closeModal();
        }
    }

    public function mostrar($id)
    {
        $this->banco = DBBanco::findOrFail($id);
        $this->bd_id            = $id;
        $this->bd_id_empresa    = $this->banco->id_empresa ?? null;
        $this->bd_nome          = $this->banco->nome ?? null;
        $this->bd_num_banco     = $this->banco->num_banco ?? null;
        $this->bd_num_agencia   = $this->banco->num_agencia ?? null;
        $this->bd_num_conta     = $this->banco->num_conta ?? null;
        $this->bd_saldo_inicial = $this->banco->saldo_inicial ?? null;
        $this->bd_cod_carteira  = $this->banco->cod_carteira ?? null;
        $this->bd_chave_pix     = $this->banco->chave_pix ?? null;
        $this->bd_pix           = $this->banco->pix ?? null;

        $this->openModal('mostrar');
    }

    public function remover($id)
    {
        $this->banco = DBBanco::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $this->banco->nome,
            'text'         => 'Tem certeza que quer deletar a banco?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $this->banco->id,
        ]);
    }

    public function deletar($id)
    {
        DBBanco::find($id)->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => 'Banco deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->reset();
    }

    public function listar()
    {
        $bancos = DBBanco::
                                procurar($this->pesquisar)->
                                paginate(10);

        return $bancos;
    }

    public function render()
    {
        $bancos = $this->listar();

        return view('livewire/financeiro/banco/index', [
            'bancos' => $bancos,
        ])->layout('layouts/app');
    }
}
