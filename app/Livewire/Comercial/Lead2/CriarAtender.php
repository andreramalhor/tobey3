<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Component;

use App\Models\Comercial\Lead;

class CriarAtender extends Component
{

    public $nome;
    public $telefone;
    public $cidade;
    public $endereco;
    public $email;
    public $id_origem = 1;
    public $status;
    public $obs;
    public $id_pessoa;
    public $id_consultor;

    public $resultado = 'Manter contato';
    public $conversa;
    public $conversaDisable = '';
    public $nivel_interesse = 'Frio';
    public $proximo_atendimento;

    protected $rules = [
        'nome'         => 'required|min:3',
        'telefone'     => 'required',
        'id_pessoa'    => 'required',
        'conversa'     => 'required',
    ];

    public function mount()
    {
        $this->proximo_atendimento = \Carbon\Carbon::tomorrow()->setHour(9)->setMinute(0)->setSecond(0)->format('Y-m-d H:i:s');
        $this->id_consultor = auth()->user()->id;
    }

    public function save()
    {
        $this->validate();

        Lead::create([
            'nome'                => $this->nome,
            'telefone'            => $this->telefone,
            'cidade'              => $this->cidade,
            'endereco'            => $this->endereco,
            'email'               => $this->email,
            'id_origem'           => $this->id_origem,
            'status'              => $this->status,
            'obs'                 => $this->obs,
            'id_pessoa'           => $this->id_pessoa,
            'id_consultor'        => $this->id_consultor,
        ])->fghtvxswwryiiil()->create([
            'id_consultor'        => $this->id_consultor,
            'resultado'           => $this->resultado,
            'conversa'            => $this->conversa,
            'nivel_interesse'     => $this->nivel_interesse,
            'proximo_atendimento' => $this->proximo_atendimento,
        ]);

        session()->flash('success', 'Lead gravado com sucesso');

        $this->limpar();
        $this->dispatch('lead-created');
    }

    public function close()
    {
        $this->limpar();
    }

    public function limpar()
    {
        $this->nome         = '';
        $this->telefone     = '';
        $this->cidade       = '';
        $this->endereco     = '';
        $this->email        = '';
        $this->interesse    = '';
        $this->id_origem    = '';
        $this->status       = '';
        $this->obs          = '';
        $this->id_pessoa    = '';
        $this->id_consultor = '';
    }

    public function render()
    {
        return view('livewire/comercial/lead/criar_atender');
    }

    public function atualizarResultado()
    {
        switch ($this->resultado)
        {
            case 'Não tem interesse':
            case 'Chamada não atendida':
            case 'Número inexistente':
            case 'Lead frio':
                $this->conversa = 'este e o texto padrao';
                $this->conversaDisable = 'disabled="disabled"';
                break;

                default:
                $this->conversa = 'sdsd';
                $this->conversaDisable = true;

                break;
        }

    }

}
