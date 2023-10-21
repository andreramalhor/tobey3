<?php

namespace App\Livewire\Comercial\Lead\Graficos;

use Livewire\Component;
use App\Models\Comercial\LeadConversa;

class ChartAtendimento extends Component
{
    public $titulo;

    public $mes_id_crt = 'leads_atendimentos_mes';
    public $mes_rotulos = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    public $mes_valores = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    public $ano_id_crt = 'leads_atendimentos_ano';
    public $ano_rotulos = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    public $ano_valores = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    public function __construct()
    {
        $this->titulo = 'Leads Atendidos';
    }

    public function render()
    {
        return view('livewire/comercial/lead/graficos/chart-atendidos');
    }

    public function mount(LeadConversa $leads)
    {
        $mes_inicio = \Carbon\Carbon::now()->startOfMonth();
        $mes_final  = \Carbon\Carbon::now()->endOfMonth();

        $ano_inicio = \Carbon\Carbon::now()->startOfYear();
        $ano_final  = \Carbon\Carbon::now()->endOfYear();

        $mes_leads = $leads->filtro()->
                                whereBetween('created_at', [$mes_inicio, $mes_final])->
                                selectRaw('DAY(created_at) as dia, COUNT(*) as total')->
                                groupBy('dia', 'dia')->
                                get();

        $ano_leads = $leads->filtro()->
                                whereBetween('created_at', [$ano_inicio, $ano_final])->
                                // orderBy('created_at')->
                                selectRaw('MONTH(created_at) as mes, COUNT(*) as total')->
                                groupBy('mes', 'mes')->
                                get();

        foreach ($mes_leads as $lead)
        {
            $indexRotulos = $lead->dia - 1;
            $this->mes_valores[$indexRotulos] = $lead->total;
        }

        foreach ($ano_leads as $lead)
        {
            $indexRotulos = $lead->mes - 1;
            $this->ano_valores[$indexRotulos] = $lead->total;
        }
    }
}
