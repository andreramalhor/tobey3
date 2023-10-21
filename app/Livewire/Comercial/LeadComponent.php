<?php

namespace App\Livewire\Comercial;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Comercial\Lead;

class LeadComponent extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $leads = $this->listar();

        return view('livewire/comercial/lead', [
            'leads' => $leads
        ])->layout('layouts/app');
    }

    public function listar()
    {
        $leads = Lead::
            procurar($this->search)->
            paginate(10);
        
        return $leads;
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
}