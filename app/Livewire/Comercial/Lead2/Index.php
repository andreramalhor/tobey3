<?php

namespace App\Livewire\Comercial\Lead;

use App\Imports\LeadsImport;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Comercial\Lead;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $pesquisa = '';
    public $file;

    public $rules = [
        'file' => 'file|mimes:pdf,doc,xls,csv,xlsx',
    ];

    public function render()
    {
        $leads = $this->listar();
        $origens = Lead::lista_origem();

        return view('livewire/comercial/lead/index', [
            'leads' => $leads,
            'origens' => $origens
        ])->layout('layouts/app');
    }

    public function listar()
    {
        if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Cliente') )
        {
            $leads = Lead::
                        latest()->
                        with('ultimo_atendimento')->
                        where('id_pessoa', '=', \Auth::User()->id)->
                        paginate();
        }
        else if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') )
        {
            $leads = Lead::
                        latest()->
                        with('ultimo_atendimento')->
                        where('id_consultor', '=', \Auth::User()->id)->
                        paginate();
        }
        else
        {
            $leads = Lead::
                        latest()->
                        with('ultimo_atendimento')->
                        paginate();
        }

        return $leads;
    }

    public function atender($id)
    {
        $this->dispatch('comercial.lead.atender', id: $id);
    }

    public function import()
    {
        Excel::import($this->file, LeadsImport::class);

        return redirect()->back();
    }

    public function submit()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,txt'
        ]);

        Excel::import(new LeadsImport, $this->file);

        session()->flash('message', 'Post successfully updated.');


        // return redirect()->back();
    }
}
