<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Component;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\Lead;

class Criar extends Component
{
    public $nome;
    public $telefone;
    public $cidade;
    public $endereco;
    public $email;
    public $interesse = 'frio';
    public $id_origem;
    public $status;
    public $obs;
    public $id_pessoa;
    public $id_consultor;
    public $proximo_atendimento;
    public $empresas = [];
    public $vendedores = [];

    public function mount()
    {
        if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cliente') )
        {
            $this->id_pessoa = \Auth::User()->id;
        }
        if(  \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') )
        {
            $this->id_consultor = \Auth::User()->id;
        }

        $this->proximo_atendimento = \Carbon\Carbon::today();
        $this->trazer_pessoas();
        $this->trazer_vendedores();
    }

    public function render()
    {
        $origens = Lead::lista_origem();
        $leads = $this->listar();

        return view('livewire/comercial/lead/criar', [
            'leads' => $leads,
            'origens' => $origens,
        ])->layout('layouts/app');
    }

    protected $rules = [
        'nome'         => 'required|min:3',
        'telefone'     => 'required',
        'id_pessoa'    => 'required',
    ];

    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function listar()
    {
        if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cliente') )
        {
            $leads = Lead::
                        latest()->
                        with('ultimo_atendimento')->
                        where('id_pessoa', '=', \Auth::User()->id)->
                        paginate();
        }
        else if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') )
        {
            $leads = Lead::
                        latest()->
                        with('ultimo_atendimento')->
                        where('id_consultor', '=', \Auth::User()->id)->
                        paginate();
        }
        else
        {
            $leads = Lead::
                        latest()->
                        with('ultimo_atendimento')->
                        paginate();
        }

        return $leads;
    }

    public function save()
    {
        $this->validate();

        $lead = Lead::create([
            'nome'                => $this->nome,
            'telefone'            => $this->telefone,
            'cidade'              => $this->cidade,
            'endereco'            => $this->endereco,
            'email'               => $this->email,
            'interesse'           => $this->interesse,
            'id_origem'           => $this->id_origem,
            'status'              => $this->status,
            'obs'                 => $this->obs,
            'id_pessoa'           => $this->id_pessoa,
            'id_consultor'        => $this->id_consultor,
            'proximo_atendimento' => $this->proximo_atendimento,
        ]);

        session()->flash('success', 'Lead gravado com sucesso');

        // redirect()->route('com.leads.empresa');
    }

    public function editar($id)
    {
        $lead = Lead::findOrFail($id);


        // $lead = Lead::create([
        $lead =  new Lead();
        $lead->nome         = $this->nome;
        $lead->telefone     = $this->telefone;
        $lead->cidade       = $this->cidade;
        $lead->endereco     = $this->endereco;
        $lead->email        = $this->email;
        $lead->interesse    = $this->interesse;
        $lead->id_origem    = $this->id_origem;
        $lead->status       = $this->status;
        $lead->obs          = $this->obs;
        $lead->id_pessoa    = $this->id_pessoa;
        $lead->id_consultor = $this->id_consultor;
        $lead->save();

        session()->flash('message', 'Lead gravado com sucesso');

        $this->close();

        $this->limpar();
    }

    // public function mount($id)
    // {
    //     $this->lead = Lead::findOrFail($id);
    // }

    // public function gravar()
    // {
    //     $this->validate([
    //         'nome'         => $this->nome,
    //         'telefone'     => $this->telefone,
    //         'cidade'       => $this->cidade,
    //         'endereco'     => $this->endereco,
    //         'email'        => $this->email,
    //         'interesse'    => $this->interesse,
    //         'id_origem'    => $this->id_origem,
    //         'status'       => $this->status,
    //         'obs'          => $this->obs,
    //         'id_pessoa'    => $this->id_pessoa,
    //         'id_consultor' => $this->id_consultor,
    //     ]);

    //     // return redirect()->to('/comercial/lead');
    // }


    public function excluir($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        session()->flash('message', 'Lead excluído com sucesso');
    }

    public function limpar()
    {
        $this->nome         = '';
        $this->telefone     = '';
        $this->cidade       = '';
        $this->endereco     = '';
        $this->email        = '';
        $this->interesse    = '';
        $this->id_origem    = '';
        $this->status       = '';
        $this->obs          = '';
        $this->id_pessoa    = '';
        $this->id_consultor = '';
    }

    public function atender($id)
    {
        return Lead::findOrFail($id);
    }

    public function close()
    {
        $this->dispatch('close');
    }

    public function openModalCreate()
    {
        $this->resetErrorBag();
        $this->openModal = true;
    }

    function trazer_pessoas()
    {
        $empresas = Pessoa::empresas()->get();
        $this->empresas = $empresas;
    }

    function trazer_vendedores()
    {
        $vendedores = Pessoa::vendedores()->get();
        $this->vendedores = $vendedores;
    }
}
