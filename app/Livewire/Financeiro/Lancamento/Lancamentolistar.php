<?php

namespace App\Livewire\Financeiro\Lancamento;

use Livewire\Component;

use App\Models\Financeiro\Lancamento;

class Lancamentolistar extends Component
{
    public $tipo;
    public $inicio;
    public $final;
    public $pesquisa;
    public $banco;
    public $conta;
    
    public function mount()
    {
        $this->inicio = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->final = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');    
    }

    public function render()
    {
        $lancamentos = $this->listar();
        
        return view('livewire/financeiro/lancamento/listar', [
            'lancamentos' => $lancamentos,
        ])->layout('layouts/app');
    }

    public function listar()
    {    
        $lancamentos = Lancamento::
                            where('id_empresa', '=', 1)->
                            whereBetween('dt_competencia', [$this->inicio, $this->final])->
                            when($this->pesquisa, function ($query1)
                            {
                                $query1->whereHas('qexgzmnndqxmyks', function ($subQuery1)
                                {
                                    $subQuery1->where('nome', 'LIKE', '%' . $this->pesquisa . '%');
                                })->
                                orWhere('descricao', 'LIKE', '%' . $this->pesquisa . '%');
                            })->
                            when($this->conta, function ($query2)
                            {
                                $query2->whereHas('qlwiqwuheqlefkd', function ($subQuery2)
                                {
                                    $subQuery2->where('titulo', 'LIKE', '%' . $this->conta . '%')->
                                                orwhere('id', 'LIKE', '%' . $this->conta . '%');
                                });
                            })->
                            when($this->banco, function ($query3)
                            {
                                $query3->where('id_banco', '=', $this->banco);
                            })->
                            when($this->tipo, function ($query4)
                            {
                                $query4->where('tipo', '=', $this->tipo);
                            })->
                            orderBy('dt_competencia', 'asc')->
                            get();
                            
        return $lancamentos;
    }


    


}
