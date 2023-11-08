<?php

namespace App\Livewire\Financeiro\Lancamento;

use Livewire\Component;

use App\Models\Atendimento\Pessoa;
use App\Models\Financeiro\Lancamento;
use App\Models\Financeiro\Banco;
use App\Models\Contabilidade\Conta;

class Lancamentodashboard extends Component
{
    public $periodo;
    public $inicio;
    public $final;

    public $clientes_callcenter = [];
    public $clientes_marketing = [];
    public $clientes_converta = [];
    public $pessoal = [];


    public function decrement()
    {
        $this->inicio  = \Carbon\Carbon::parse($this->inicio)->startOfMonth()->subMonths('1')->format('Y-m-d');
        $this->final   = \Carbon\Carbon::parse($this->inicio)->endOfMonth()->format('Y-m-d');
        $this->periodo = \Carbon\Carbon::parse($this->inicio)->format('M/Y');
    }

    public function increment()
    {
        $this->inicio  = \Carbon\Carbon::parse($this->inicio)->startOfMonth()->addMonths('1')->format('Y-m-d');
        $this->final   = \Carbon\Carbon::parse($this->inicio)->endOfMonth()->format('Y-m-d');
        $this->periodo = \Carbon\Carbon::parse($this->inicio)->format('M/Y');
    }


    public function listar()
    {
        $lancamentos = Lancamento::
                            where('id_empresa', '=', 1)->
                            whereBetween('dt_competencia', [$this->inicio, $this->final]);

        return $lancamentos;
    }


    public function render()
    {
        $this->inicio = \Carbon\Carbon::parse($this->inicio)->startOfMonth()->subMonths('1')->format('Y-m-d') ?? \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->final  = \Carbon\Carbon::parse($this->final)->endOfMonth()->format('Y-m-d') ?? \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');

        $this->clientes_marketing  = $this->clientes_marketing();
        $this->clientes_callcenter = $this->clientes_callcenter();
        $this->clientes_converta   = $this->clientes_converta();
        $this->pessoal             = $this->pessoal();

        return view('livewire/financeiro2/lancamento2/dashboard')->layout('layouts/app');
    }

    public function clientes_callcenter()
    {
        return $this->
                    listar()->
                    where('centro_custo', '=', 'CallCenter')->
                    where('id_conta', '=', '169')->
                    get();
    }

    public function clientes_marketing()
    {
        return $this->
                    listar()->
                    where('centro_custo', '=', 'Marketing')->
                    where('id_conta', '=', '169')->
                    get();
    }

    public function clientes_converta()
    {
        return $this->
                    listar()->
                    where('centro_custo', '=', 'Converta Soluções')->
                    where('id_conta', '=', '169')->
                    get();
    }

    public function pessoal()
    {
        return $this->
                    listar()->
                    wherein('id_conta', [167, 170])->
                    get();
    }
}
