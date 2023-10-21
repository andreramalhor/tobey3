<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Traits\WithModal;

class Modal extends Component
{
    use withModal;

    public $component;

    public $params = [];
    
    public $show = false;

    protected $listeners = ['open', 'close'];
    
    public function open($component, $params = [])
    {
        dump('components.modal-open');
        $this->show = true;
        $this->component = $component;
        $this->params = $params;
    }
    
    public function close()
    {
        dump('components.modal-close');
        $this->show = false;
    }
    
    public function render()
    {
        dump('components.modal-render');
        return view('livewire/components/modal');
    }
}
