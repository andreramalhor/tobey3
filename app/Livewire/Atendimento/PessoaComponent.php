<?php

namespace App\Livewire\Atendimento;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Atendimento\Pessoa;

class PessoaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';

    public $nome;
    public $apelido;
    public $dt_nascimento;
    public $email;
    public $sexo;
    public $cpf;
    public $instagram;
    public $observacao;
    public $ddd;
    public $telefone;
    public $cep;
    public $logradouro;
    public $numero;
    public $bairro;
    public $cidade;
    public $uf = 'MG';
    public $kjahdkwkbewtoip = [];
    
    public $rules = [
        'nome' => 'required|min:3',
    ];

    public function save()
    {
        $this->validate();
 
        Pessoa::create([
            'apelido'       => $this->nome,
            'nome'          => $this->nome,
            'dt_nascimento' => $this->dt_nascimento,
            'email'         => $this->email,
            'sexo'          => $this->sexo,
            'cpf'           => $this->cpf,
            'instagram'     => $this->instagram,
            'observacao'    => $this->observacao,
            'id_criador'    => auth()->user()->id,
            'ddd'           => $this->ddd,
            'telefone'      => $this->telefone,
            'cep'           => $this->cep,
            'logradouro'    => $this->logradouro,
            'numero'        => $this->numero,
            'bairro'        => $this->bairro,
            'cidade'        => $this->cidade,
            'uf'            => $this->uf,
        ])->kjahdkwkbewtoip();
     }
    
    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function render()
    {
        $pessoas = $this->listar();
     
        return view('livewire/atendimento/pessoa', [
            'pessoas' => $pessoas
        ])->layout('layouts.app');
    }

    public function listar()
    {
        $pessoas = Pessoa::
            procurar($this->search)->
            paginate(10);
        
        return $pessoas;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
