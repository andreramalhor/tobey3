<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Component;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\Lead;

class Atender extends Component
{
    public $lead;

    public function mount($id)
    {
        dd(121212);
        $this->lead = Lead::find($id);
    }

    public function render()
    {
        dd(12121244);
        return view('livewire/comercial/lead/atender', [
            'empresas' => Lead::get()
        ])->layout('layouts/app');
    }

}
