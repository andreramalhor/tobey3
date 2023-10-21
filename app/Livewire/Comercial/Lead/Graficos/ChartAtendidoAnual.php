<?php

namespace App\Livewire\Comercial\Lead\Graficos;

use Livewire\Component;
use App\Models\Comercial\LeadConversa;

class ChartAtendidoAnual extends Component
{
    public $rotulos = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    public $valores = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    public $titulo;
    public $id_crt;

    public function __construct()
    {
        $this->titulo = 'Leads Atendidos (' . \Carbon\Carbon::today()->format('M/Y') . ')';
        $this->id_crt = 'leads_atendidos_ano';
    }

    public function render()
    {
        return view('livewire/comercial/lead/graficos/chart');
    }

    public function mount(LeadConversa $leads)
    {
        $inicio = \Carbon\Carbon::now()->startOfYear();
        $final  = \Carbon\Carbon::now()->endOfYear();

        $leads = $leads->filtro()->
            whereBetween('created_at', [$inicio, $final])->
            selectRaw('MONTH(created_at) as mes, COUNT(*) as total')->
            groupBy('mes', 'mes')->
            get();

        foreach ($leads as $lead)
        {
            $indexRotulos = $lead->mes - 1;
            $this->valores[$indexRotulos] = $lead->total;
        }
     }
}
