<?php

namespace App\Livewire\Comercial\Lead\Graficos;

use Livewire\Component;
use App\Models\Comercial\LeadConversa;

class ChartAtendidoDiario extends Component
{
    public $rotulos = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    public $valores = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    public $titulo;
    public $id_crt;

    public function __construct()
    {
        $this->titulo = 'Leads Atendidos (' . \Carbon\Carbon::today()->format('M/Y') . ')';
        $this->id_crt = 'leads_atendidos_mes';
    }

    public function render()
    {
        return view('livewire/comercial/lead/graficos/chart');
    }

    public function mount(LeadConversa $leads)
    {
        $inicio = \Carbon\Carbon::now()->startOfMonth();
        $final  = \Carbon\Carbon::now()->endOfMonth();

        $leads = $leads->filtro()->
            whereBetween('created_at', [$inicio, $final])->
            selectRaw('DAY(created_at) as dia, COUNT(*) as total')->
            groupBy('dia', 'dia')->
            get();

        foreach ($leads as $lead)
        {
            $indexRotulos = $lead->dia - 1;
            $this->valores[$indexRotulos] = $lead->total;
        }
     }
}
