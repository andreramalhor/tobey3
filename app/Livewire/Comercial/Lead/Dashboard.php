<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Component;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\Lead;
use App\Models\Comercial\LeadConversa;

class Dashboard extends Component
{
    public $periodo;
    public $inicio;
    public $final;
    public $leads = [];

    public $total_cadastro_mes;
    public $total_cadastro_dia;
    public $total_vendas_mes;
    public $total_vendas_dia;
    public $ultimos_atendimentos;

    public $clientes_callcenter = [];
    public $clientes_marketing = [];
    public $clientes_converta = [];
    public $pessoal = [];

    public function mount()
    {
        $this->inicio = \Carbon\Carbon::parse($this->inicio)->startOfMonth()->format('Y-m-d') ?? \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->final  = \Carbon\Carbon::parse($this->final)->endOfMonth()->format('Y-m-d') ?? \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');

        $this->leads = Lead::get();

        $this->total_cadastro_mes = Lead::whereBetween('created_at', [\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth()])->count();
        $this->total_cadastro_dia = Lead::whereBetween('created_at', [\Carbon\Carbon::now()->startOfDay(), \Carbon\Carbon::now()->endOfDay()])->count();

        $this->total_vendas_mes = LeadConversa::
                                                whereBetween('created_at', [ \Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth() ])->
                                                where('resultado', '=', 'Venda concluída')->
                                                count();

        $this->total_vendas_dia = LeadConversa::
                                                whereBetween('created_at', [ \Carbon\Carbon::now()->startOfDay(), \Carbon\Carbon::now()->endOfDay() ])->
                                                where('resultado', '=', 'Venda concluída')->
                                                count();

        $this->ultimos_atendimentos = Lead::
                                            selectRaw('id_consultor, count(*) as total')->
                                            groupBy('id_consultor')->
                                            with('fghtvxswwryiiil')->
                                            get();
    }

    public function render()
    {
        $this->inicio = \Carbon\Carbon::parse($this->inicio)->startOfMonth()->format('Y-m-d') ?? \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->final  = \Carbon\Carbon::parse($this->final)->endOfMonth()->format('Y-m-d') ?? \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');

        // $this->clientes_marketing  = $this->clientes_marketing();
        // $this->clientes_callcenter = $this->clientes_callcenter();
        // $this->clientes_converta   = $this->clientes_converta();
        // $this->pessoal             = $this->pessoal();

        return view('livewire/comercial/lead/dashboard')->layout('layouts/guest');
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
