<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Component;
use Livewire\Comercial\Lead\Atender;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\Lead;
use App\Models\Comercial\LeadConversa;

class Empresa extends Component
{
    public $lead_id;
    public $lead;
    public $resultado = 'Manter contato';
    public $conversa;
    public $nivel_interesse = 'frio';
    public $id_pessoa;
    public $nome;
    public $telefone;
    public $obs;
    public $cidade;
    public $email;
    public $id_origem;
    public $interesse;
    public $id_turma;
    public $status;
    public $favorito;
    public $arquivado;
    public $proximo_atendimento;

    public function render()
    {
        $empresas = $this->empresas();

        return view('livewire/comercial/lead/empresa', [
            'empresas' => $empresas,
        ])->layout('layouts/app');
    }

    public function mount()
    {
        $this->proximo_atendimento = \Carbon\Carbon::now()->addDays(1)->format('Y-m-d 09:00');
    }

    public function empresas()
    {
        return Pessoa::minhas_empresas()->get();
    }

    public function trazer_leads($id)
    {
        $id_pessoa = $id;
        $leads = Lead::proximo_atendimento($id);

        if(isset($leads))
        {
            $this->lead             = $leads;
            $this->lead_id          = $leads->id;
            $this->id_pessoa        = $leads->id_pessoa;
            $this->resultado        = $leads->ultimo_atendimento->resultado ?? 'Manter contato';
            $this->nivel_interesse  = $leads->ultimo_atendimento->nivel_interesse ?? 'frio';
        }
        else
        {
            $this->novo_lead($id);
            // redirect()->route('com.leads.criar');
        }
    }

    public function novo_lead($id)
    {
        return view('livewire/comercial/lead/criar_atender');
    }

    public function atendido()
    {
        $lead = Lead::find($this->lead_id);

        $lead->update([
            'proximo_atendimento' => $this->proximo_atendimento,
        ]);

        $novaConversa = new LeadConversa([
            'resultado'           => $this->resultado,
            'id_consultor'        => auth()->user()->id,
            'conversa'            => $this->conversa,
            'nivel_interesse'     => $this->nivel_interesse,
            'proximo_atendimento' => $this->proximo_atendimento,
        ]);

        $lead->fghtvxswwryiiil()->save($novaConversa);

        return redirect()->route('com.leads.empresa');

    }
}
