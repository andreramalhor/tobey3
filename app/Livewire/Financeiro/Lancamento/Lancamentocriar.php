<?php

namespace App\Livewire\Financeiro\Lancamento;

use Livewire\Component;

use App\Models\Atendimento\Pessoa;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\Banco;
use App\Models\Contabilidade\Conta;
use App\Models\Configuracao\Forma_Pagamento;

class Lancamentocriar extends Component
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
    public $centro_custo;

    public function mount()
    {
        $this->tipo                  = 'R';
        $this->centro_custo          = 'Converta Soluções';
        $this->id_forma_pagamento    = 'Dinheiro';
        $this->parcela               = 1;
        $this->dt_vencimento         = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_competencia        = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_recebimento        = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_confirmacao        = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_pagamento          = \Carbon\Carbon::today()->format('Y-m-d');
        $this->dt_pagamento          = \Carbon\Carbon::today()->format('Y-m-d');
        $this->id_usuario_lancamento = auth()->user()->id;
    }

    public function render()
    {
        $clientes              = Pessoa::pluck('nome', 'id');
        $bancos                = Banco::pluck('nome', 'id');
        $contas                = Conta::pluck('titulo', 'id');
        $formas_pagamentos     = Forma_Pagamento::select('forma')->distinct()->get();
        
        return view('livewire/financeiro/lancamento/criar', [
            'clientes'          => $clientes,
            'bancos'            => $bancos,
            'contas'            => $contas,
            'formas_pagamentos' => $formas_pagamentos,
        ])->layout('layouts/app');
    }
    
    protected $rules = [
        'tipo'                   => 'required',
        'id_banco'               => 'required',
        'id_conta'               => 'nullable',
        'informacao'             => 'nullable',
        'vlr_bruto'              => 'nullable',
        'vlr_dsc_acr'            => 'nullable',
        'vlr_final'              => 'required',
        'parcela'                => 'required',
        'id_forma_pagamento'     => 'required',
        'descricao'              => 'required',
        'dt_vencimento'          => 'required',
        'dt_competencia'         => 'required',
        'dt_recebimento'         => 'required',
        'dt_confirmacao'         => 'required',
        'dt_pagamento'           => 'required',
        'id_usuario_lancamento'  => 'required',
        'id_usuario_confirmacao' => 'nullable',
        'id_caixa'               => 'nullable',
        'id_lancamento_origem'   => 'nullable',
        'origem'                 => 'nullable',
        'status'                 => 'nullable',
        'centro_custo'           => 'required',
    ];
    

    public function save() 
    {
        $this->validate();
        
        $lancamento = Lancamento::create([
            'tipo'                   => $this->tipo,
            'id_banco'               => $this->id_banco,
            'id_conta'               => $this->id_conta,
            'num_documento'          => $this->num_documento,
            'id_pessoa'             => $this->id_pessoa,
            'informacao'             => $this->informacao,
            'vlr_bruto'              => $this->vlr_bruto,
            'vlr_dsc_acr'            => $this->vlr_dsc_acr,
            'vlr_final'              => $this->vlr_final,
            'parcela'                => $this->parcela,
            'id_forma_pagamento'     => $this->id_forma_pagamento,
            'descricao'              => $this->descricao,
            'dt_vencimento'          => $this->dt_vencimento,
            'dt_competencia'         => $this->dt_competencia,
            'dt_recebimento'         => $this->dt_recebimento,
            'dt_confirmacao'         => $this->dt_confirmacao,
            'dt_pagamento'           => $this->dt_pagamento,
            'id_usuario_lancamento'  => $this->id_usuario_lancamento,
            'id_usuario_confirmacao' => $this->id_usuario_confirmacao,
            'id_caixa'               => $this->id_caixa,
            'id_lancamento_origem'   => $this->id_lancamento_origem,
            'origem'                 => $this->origem,
            'status'                 => $this->status,
            'centro_custo'           => $this->centro_custo,
        ]);

        session()->flash('success', 'Lançamento gravado com sucesso');

        redirect()->route('fin.lancamentos.criar');
    }

}
