<?php

namespace App\Livewire\Financeiro\Lancamento;

use Livewire\Component;

use App\Models\Atendimento\Pessoa;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\Banco;
use App\Models\Comercial\Lead;
use App\Models\Contabilidade\Conta;
use App\Models\Configuracao\Forma_Pagamento;

class LancamentoCriar extends Component
{
    public $tipo;
    public $id_banco;
    public $id_conta;
    public $num_documento;
    public $id_pessoa;
    public $informacao;
    public $vlr_bruto;
    public $vlr_dsc_acr;
    public $vlr_final;
    public $parcela;
    public $id_forma_pagamento;
    public $descricao;
    public $dt_vencimento;
    public $dt_competencia;
    public $dt_recebimento;
    public $dt_confirmacao;
    public $dt_pagamento;
    public $id_usuario_lancamento;
    public $id_usuario_confirmacao;
    public $id_caixa;
    public $id_lancamento_origem;
    public $origem;
    public $status;
    public $clientes = [];
    public $bancos = [];
    public $contas = [];
    public $formas_pagamentos = [];

    public function mount()
    {
        $this->dt_vencimento         = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_competencia        = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_recebimento        = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_confirmacao        = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_pagamento          = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_pagamento          = \Carbon\Carbon::today()->format('Y-m-d');
        $this->clientes              = Pessoa::pluck('nome', 'id');
        $this->bancos                = Banco::pluck('nome', 'id');
        $this->contas                = Conta::pluck('titulo', 'id');
        $this->formas_pagamentos     = Forma_Pagamento::select('forma')->distinct()->get();
        $this->parcela               = 1;
        $this->id_usuario_lancamento = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire/financeiro/lancamento/criar')->layout('layouts/app');
    }

    // protected $rules = [
    //     'nome'         => 'required|min:3',
    //     'telefone'     => 'required',
    //     'id_pessoa'    => 'required',
    //     'id_consultor' => 'required',
    // ];
    
    public function updated($campo)
    {
        dd(1121);
        $this->validateOnly($campo);
    }

    public function listar()
    {
        dd(1121111111111);

        $leads = Lead::
            latest()->
            with('ultimo_atendimento')->
            where($this->tipo_pessoa(), '=', \Auth::User()->id)->
            paginate();
        
        return $leads;
    }

    public function save() 
    {
        dd(111);
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

        redirect()->route('com.leads.empresa');
    }

    public function editar($id) 
    {
                dd(66666);

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
 
    //     // return redirect()->to('/financeiro/lancamento');
    // }


    public function excluir($id)
    {
        dd(85462);

        $lead = Lead::findOrFail($id);
        $lead->delete();

        session()->flash('message', 'Lead excluído com sucesso');
    }

    public function limpar()
    {
        dd(6465564);

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
        dd(8888585);

        $lead = Lead::findOrFail($id);
    }
    
    public function close()
    {
        dd(7687676876);

        $this->dispatch('close');
    }

    public function openModalCreate()
    {
        dd(33334441);

        $this->resetErrorBag();
        $this->openModal = true;
    }

    public static function atualiza_id_forma_pagamento()
    {
        dd(444);
    }

    function tipo_pessoa()
    {
        dd(897879879);

        if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cliente') )
        {
            return 'id_pessoa';
        }
        else if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') )
        {
            return 'id_consultor';
        }
    }

    function trazer_pessoas()
    {
        dd(776767);

        $empresas = Pessoa::empresas()->get();
        $this->empresas = $empresas;
    }
    
    function trazer_vendedores()
    {        dd(21314144);

        $vendedores = Pessoa::vendedores()->get();
        $this->vendedores = $vendedores;
    }
}
