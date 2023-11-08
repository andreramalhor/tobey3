<?php

namespace App\Livewire\Financeiro;

use Livewire\Attributes\Rule;
use App\Models\Financeiro\Lancamento as DBLancamento;
use Livewire\Component;
use Livewire\WithPagination;

class Lancamento extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $p_tipo;
    public $p_inicio;
    public $p_final;
    public $p_informacao;
    public $p_banco;
    public $p_conta;
    public $p_valor;
    public $p_pesquisar = '';


    public $tipo;
    public $id_banco;
    public $id_conta;
    public $num_documento;
    public $id_pessoa;
    #[Rule('required|min:3')]
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

    public $lancamento = [];
    public $modalType;
    public $lancamentoId;

    protected $listeners = ['chamarMetodo' => 'remove'];

    public function mount()
    {
        $this->p_inicio = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->p_final  = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
    }
    public function create()
    {
        $this->reset();

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
        // $this->formas_pagamentos     = Forma_Pagamento::select('forma')->distinct()->get();

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
    }

    public function store()
    {
        $this->validate();

        $lancamento = DBLancamento::create([
            'tipo'                   => $this->tipo,
            'id_banco'               => $this->id_banco,
            'id_conta'               => $this->id_conta,
            'num_documento'          => $this->num_documento,
            'id_pessoa'              => $this->id_pessoa,
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

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Lançamento cadastrado com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('lancamentoId');
        $this->closeModal();
    }

    public function show($id)
    {
        $this->lancamento = DBLancamento::findOrFail($id);

        $this->openModal('show');
    }

    public function edit($id)
    {
        $lancamento = DBLancamento::findOrFail($id);
        $this->lancamentoId = $id;
        $this->tipo                   = $lancamento->tipo;
        $this->id_banco               = $lancamento->id_banco;
        $this->id_conta               = $lancamento->id_conta;
        $this->num_documento          = $lancamento->num_documento;
        $this->id_pessoa              = $lancamento->id_pessoa;
        $this->informacao             = $lancamento->informacao;
        $this->vlr_bruto              = $lancamento->vlr_bruto;
        $this->vlr_dsc_acr            = $lancamento->vlr_dsc_acr;
        $this->vlr_final              = $lancamento->vlr_final;
        $this->parcela                = $lancamento->parcela;
        $this->id_forma_pagamento     = $lancamento->id_forma_pagamento;
        $this->descricao              = $lancamento->descricao;
        $this->dt_vencimento          = $lancamento->dt_vencimento;
        $this->dt_competencia         = $lancamento->dt_competencia;
        $this->dt_recebimento         = $lancamento->dt_recebimento;
        $this->dt_confirmacao         = $lancamento->dt_confirmacao;
        $this->dt_pagamento           = $lancamento->dt_pagamento;
        $this->id_usuario_lancamento  = $lancamento->id_usuario_lancamento;
        $this->id_usuario_confirmacao = $lancamento->id_usuario_confirmacao;
        $this->id_caixa               = $lancamento->id_caixa;
        $this->id_lancamento_origem   = $lancamento->id_lancamento_origem;
        $this->origem                 = $lancamento->origem;
        $this->status                 = $lancamento->status;
        $this->centro_custo           = $lancamento->centro_custo;

        $this->openModal('store');
    }

    public function update()
    {
        if ($this->lancamentoId)
        {
            $lancamento = DBLancamento::findOrFail($this->lancamentoId);
            $lancamento->update([
                'tipo'                   => $this->tipo,
                'id_banco'               => $this->id_banco,
                'id_conta'               => $this->id_conta,
                'num_documento'          => $this->num_documento,
                'id_pessoa'              => $this->id_pessoa,
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

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Lançamento atualizado com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $lancamento = DBLancamento::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $lancamento->nome,
            'text'         => 'Tem certeza que quer deletar o lançamento?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $lancamento->id,
        ]);
    }

    public function remove($id)
    {
        $lancamento = DBLancamento::find($id);

        $lancamento->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Lançamento deletado com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('lancamentoId');
    }

    public function listar()
    {
        $lancamentos = DBLancamento::
                            procurar($this->p_pesquisar)->
                            where('id_empresa', '=', 1)->
                            whereBetween('dt_competencia', [$this->p_inicio, $this->p_final])->
                            when($this->p_informacao, function ($query1)
                            {
                                $query1->whereHas('qexgzmnndqxmyks', function ($subQuery1)
                                {
                                    $subQuery1->where('nome', 'LIKE', '%' . $this->p_informacao . '%');
                                })->
                                orWhere('informacao', 'LIKE', '%' . $this->p_informacao . '%');
                            })->
                            when($this->p_conta, function ($query2)
                            {
                                $query2->whereHas('qlwiqwuheqlefkd', function ($subQuery2)
                                {
                                    $subQuery2->where('titulo', 'LIKE', '%' . $this->p_conta . '%')->
                                                orwhere('id', 'LIKE', '%' . $this->p_conta . '%');
                                });
                            })->
                            when($this->p_valor, function ($q)
                            {
                                $q->where('vlr_final', '=', $this->p_valor);
                            })->
                            when($this->p_banco, function ($query3)
                            {
                                $query3->where('id_banco', '=', $this->p_banco);
                            })->
                            when($this->p_tipo, function ($query4)
                            {
                                $query4->where('tipo', '=', $this->p_tipo);
                            })->
                            orderBy('dt_competencia', 'asc')->
                            get();


        return $lancamentos;
    }

    public function render()
    {
        $lancamentos = $this->listar();

        return view('livewire/financeiro/lancamento/index', [
            'lancamentos' => $lancamentos,
        ])->layout('layouts/app');
    }
}
