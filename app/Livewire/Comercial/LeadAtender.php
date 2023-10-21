<?php

namespace App\Livewire\Comercial;

use App\Models\Comercial\Lead as DBLead;
use Livewire\Component;

class LeadAtender extends Component
{
    public $lead;

    public $resultado = 'Manter contato';
    public $conversa;
    public $conversaDisable = '';
    public $nivel_interesse = 'Frio';
    public $proximo_atendimento;


    public $isOpen = 0;

    public function mount()
    {
        $this->proximo_atendimento = \Carbon\Carbon::tomorrow()->setHour(9)->setMinute(0)->setSecond(0)->format('Y-m-d H:i:s');
        $this->id_consultor = auth()->user()->id;
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function atender($id)
    {
        $this->lead = DBLead::findOrFail($id);
        dump($this->lead, $this->lead->nome);

        $this->conversas    = $this->lead->fghtvxswwryiiil;
        $this->leadId       = $id;
        $this->leadType     = 'atender';
        $this->nome         = $this->lead->nome;
        $this->telefone     = $this->lead->telefone;
        $this->cidade       = $this->lead->cidade;
        $this->endereco     = $this->lead->endereco;
        $this->email        = $this->lead->email;
        $this->id_origem    = $this->lead->id_origem;
        $this->status       = $this->lead->status;
        $this->obs          = $this->lead->obs;
        $this->id_pessoa    = $this->lead->id_pessoa;
        $this->id_consultor = $this->lead->id_consultor;
        $this->openModal();
    }

    public function atualizarResultado()
    {
        if ($this->resultado == 'Não tem interesse')
        {
            $this->conversa = $this->resultado;
            $this->conversaDisable = 'disabled="disabled"';
        }
        elseif ($this->resultado == 'Chamada não atendida')
        {
            $this->conversa = $this->resultado;
            $this->conversaDisable = 'disabled="disabled"';
        }
        elseif ($this->resultado == 'Número inexistente')
        {
            $this->conversa = $this->resultado;
            $this->conversaDisable = 'disabled="disabled"';
        }
        elseif ($this->resultado == 'Lead frio')
        {
            $this->conversa = $this->resultado;
            $this->conversaDisable = 'disabled="disabled"';
        }
        else
        {
            $this->conversa = '';
            $this->conversaDisable = '';
        }
    }

    public function registrarAtendimento()
    {
        if ($this->leadId)
        {
            $lead = DBLead::findOrFail($this->leadId);

            $lead->fghtvxswwryiiil()->create([
                'id_consultor'        => $this->id_consultor,
                'resultado'           => $this->resultado,
                'conversa'            => $this->conversa,
                'nivel_interesse'     => $this->nivel_interesse,
                'proximo_atendimento' => $this->proximo_atendimento,
            ]);

            $this->dispatch('updated', [
                'title'     => 'Atendimento registrado com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire/comercial/lead/atender')->layout('layouts/app')->slot('modal');
    }
}
