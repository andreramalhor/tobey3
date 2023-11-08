<?php

namespace App\Livewire\Financeiro\Lancamento;

use Livewire\Component;
use App\Models\Financeiro\Lancamento;

class ChartAnual extends Component
{
    public $rotulos = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    public $receita = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    public $despesa = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    public $titulo;
    public $id_crt;

    public function __construct()
    {
        $this->titulo = 'Lançamentos Cadastrados (' . \Carbon\Carbon::today()->format('Y') . ')';
        $this->id_crt = 'lancamentos_cadastrados_ano';
    }
    public function render()
    {
        return view('livewire/financeiro2/lancamento2/chart');
    }

    public function mount(Lancamento $lancamentos)
    {
        $inicio = \Carbon\Carbon::now()->startOfYear();
        $final  = \Carbon\Carbon::now()->endOfYear();

        $despesas = $lancamentos->
            whereBetween('dt_competencia', [$inicio, $final])->
            where('tipo', '=', 'D')->
            // orderBy('dt_competencia')->
            selectRaw('MONTH(dt_competencia) as mes, SUM(vlr_final) as total')->
            groupBy('mes', 'mes')->
            get();

        $receitas = $lancamentos->
            whereBetween('dt_competencia', [$inicio, $final])->
            where('tipo', '=', 'R')->
            // orderBy('dt_competencia')->
            selectRaw('MONTH(dt_competencia) as mes, SUM(vlr_final) as total')->
            groupBy('mes', 'mes')->
            get();

        foreach ($despesas as $despesa)
        {
            $indexDespesas = $despesa->mes - 1;
            $this->despesa[$indexDespesas] = $despesa->total;
        }

        foreach ($receitas as $receita)
        {
            $indexReceitas = $receita->mes - 1;
            $this->receita[$indexReceitas] = $receita->total;
        }

    }
}
