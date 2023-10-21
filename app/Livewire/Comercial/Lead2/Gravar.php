<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Comercial\Lead;

class Gravar extends Component
{
    use WithPagination;

    public $nome, $telefone, $cidade, $endereco, $email, $interesse, $id_origem, $status, $obs, $id_pessoa, $id_consultor;
    public $conversa;
    public $openModal = false;
    
    public function render()
    {
        $leads = $this->listar();
     
        return view('livewire/comercial/lead/index', [
            'leads' => $leads
        ])->layout('layouts/app');
    }

    protected $rules = [
        'nome'         => 'required|min:1',
        'telefone'     => 'required|min:1',
        'cidade'       => 'required|min:1',
        'endereco'     => 'required|min:1',
        'email'        => 'required|min:1',
        'interesse'    => 'required|min:1',
        'id_origem'    => 'required|min:1',
        'status'       => 'required|min:1',
        'obs'          => 'required|min:1',
        'id_pessoa'    => 'required|min:1',
        'id_consultor' => 'required|min:1',
    ];
    
    public function updated($campo)
    {
        $this->validateOnly($campo);
    }

    public function listar()
    {
        $leads = Lead::
            latest()->
            with('ultimo_atendimento')->
            where($this->tipo_pessoa(), '=', \Auth::User()->id)->
            paginate();
        
        return $leads;
    }

    public function save() 
    {
        $this->validate();
        
        $lead = Lead::create([
            'nome'         => $this->nome,
            'telefone'     => $this->telefone,
            'cidade'       => $this->cidade,
            'endereco'     => $this->endereco,
            'email'        => $this->email,
            'interesse'    => $this->interesse,
            'id_origem'    => $this->id_origem,
            'status'       => $this->status,
            'obs'          => $this->obs,
            'id_pessoa'    => $this->id_pessoa,
            'id_consultor' => $this->id_consultor,
        ]);

        $lead->ultimo_atendimento()->create([
            'conversa' => $this->conversa
        ]);

        session()->flash('success', 'Lead gravado com sucesso');

        $this->close();
        
        $this->reset();
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
        $lead = Lead::findOrFail($id);

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

    function tipo_pessoa()
    {
        if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cliente') )
        {
            return 'id_pessoa';
        }
        else if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cendedor') )
        {
            return 'id_consultor';
        }
    }

}
