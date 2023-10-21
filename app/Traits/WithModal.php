<?php

namespace App\Traits;

use App\Livewire\Test\Index;

trait WithModal
{
    public function openModal($component, $params = [])
    {
        dump('trait-openModal');
        $this->dispatch('open', $component, $params)->to('components.modal');
    }
    
    public function closeModal()
    {
        dump('trait-closeModal');
        $this->dispatch('close')->to('components.modal');
    }
}