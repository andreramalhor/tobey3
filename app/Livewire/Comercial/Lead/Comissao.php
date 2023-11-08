<?php

namespace App\Livewire\Comercial\Lead;

use Livewire\Attributes\Rule;
use App\Models\Comercial\Lead as DBLead;
use Livewire\Component;
use Livewire\WithPagination;

class Comissao extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $lead;
    #[Rule('required|min:3')]
    public $nome;

    #[Rule('required')]
    public $telefone;

    public $cidade;
    public $endereco;
    public $email;
    public $id_origem;
    public $obs;
    public $id_pessoa;
    public $id_consultor;
    public $status;
    public $valor;
    public $produto;
    public $conversas;


    public $resultado = 'Manter contato';
    public $conversa;
    public $conversaDisable = '';
    public $nivel_interesse = 'Frio';
    public $proximo_atendimento;


    public $isOpen = 0;
    public $leadId;
    public $leadType;

    public $filtro_empresa;
    public $filtro_nome;
    public $filtro_conversa;
    public $filtro_telefone;
    public $filtro_nivel;
    public $filtro_favorito;
    public $filtro_status;
    public $filtro_resultado;
    public $filtro_dt_retorno;

    public $file;

    public $rules = [
        'file' => 'file|mimes:pdf,doc,xls,csv,xlsx',
        'nome' => 'required|min:3',
        'telefone' => 'required',
    ];

    public function mount()
    {
        $this->proximo_atendimento = \Carbon\Carbon::tomorrow()->setHour(9)->setMinute(0)->setSecond(0)->format('Y-m-d H:i:s');
        $this->id_consultor = auth()->user()->id;
    }

    public function create()
    {
        $this->reset();
        $this->leadType = 'criarEditar';
        $this->openModal();
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

    public function store()
    {
        $this->validate();

        DBLead::create([
            'nome'         => $this->nome,
            'telefone'     => $this->telefone,
            'cidade'       => $this->cidade,
            'endereco'     => $this->endereco,
            'email'        => $this->email,
            'id_origem'    => $this->id_origem,
            'obs'          => $this->obs,
            'id_pessoa'    => $this->id_pessoa,
            'id_consultor' => $this->id_consultor,
            'status'       => $this->status,
            'valor'        => $this->valor,
            'produto'      => $this->produto,
        ])->fghtvxswwryiiil()->create([
            'id_consultor'        => $this->id_consultor,
            'resultado'           => $this->resultado,
            'conversa'            => $this->conversa,
            'nivel_interesse'     => $this->nivel_interesse,
            'proximo_atendimento' => $this->proximo_atendimento,
        ]);

        $this->dispatch('updated', [
            'title'     => 'Lead criado com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('leadId');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->lead = DBLead::findOrFail($id);

        $this->leadId       = $id;
        $this->leadType     = 'criarEditar';
        $this->nome         = $this->lead->nome;
        $this->telefone     = $this->lead->telefone;
        $this->cidade       = $this->lead->cidade;
        $this->endereco     = $this->lead->endereco;
        $this->email        = $this->lead->email;
        $this->id_origem    = $this->lead->id_origem;
        $this->obs          = $this->lead->obs;
        $this->id_pessoa    = $this->lead->id_pessoa;
        $this->id_consultor = $this->lead->id_consultor;
        $this->status       = $this->lead->status;
        $this->valor        = $this->lead->valor;
        $this->produto      = $this->lead->produto;
        $this->openModal();
    }

    public function update()
    {
        if ($this->leadId)
        {
            $lead = DBLead::findOrFail($this->leadId);
            $lead->update([
                'nome'         => $this->nome,
                'telefone'     => $this->telefone,
                'cidade'       => $this->cidade,
                'endereco'     => $this->endereco,
                'email'        => $this->email,
                'id_origem'    => $this->id_origem,
                'obs'          => $this->obs,
                'id_pessoa'    => $this->id_pessoa,
                'id_consultor' => $this->id_consultor,
                'status'       => $this->status,
                'valor'        => $this->valor,
                'produto'      => $this->produto,
            ]);

            $this->dispatch('updated', [
                'title'     => 'Lead atualizado com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function atender($id)
    {
        $this->reset();
        $this->lead     = DBLead::findOrFail($id);
        $this->leadId   = $id;
        $this->leadType = 'atender';
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
            $lead->touch();

            $this->dispatch('updated', [
                'title'     => 'Atendimento registrado com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $this->dispatch('updated', [
            'title'        => 'Lead deletado com sucesso!',
            'icon'         => 'success',
            'iconColor'    => 'green',
            'confirmation' => true,
        ]);

        DBLead::find($id)->delete();

        $this->resetExcept('leadId');
    }

    // public function listar()
    // {
        // dump(static::query(),       111);
        // // static::query()

        // // static::query()
        // $leads = DBLead::
        //                 filtro()->
        //                 // when($this->pesquisa, function ($query1)
        //                 // {
        //                 //     $query1->whereHas('qexgzmnndqxmyks', function ($subQuery1)
        //                 //     {
        //                 //         $subQuery1->where('nome', 'LIKE', '%' . $this->pesquisa . '%');
        //                 //     })->
        //                 //     orWhere('descricao', 'LIKE', '%' . $this->pesquisa . '%');
        //                 // })->
        //                 when($this->filtro_empresa, function ($q)
        //                 {
        //                     $this->filtro_empresa != 'Todas as empresas' ? $q->where('id_pessoa', '=', $this->filtro_empresa) : $q;
        //                 })->
        //                 when($this->filtro_nome, function ($q)
        //                 {
        //                     $q->where('nome', 'LIKE', '%' . $this->filtro_nome . '%')->orWhere('obs', 'LIKE', '%' . $this->filtro_nome . '%');
        //                 })->
        //                 when($this->filtro_conversa, function ($q)
        //                 {
        //                     $q->whereHas('fghtvxswwryiiil', function ($subq)
        //                     {
        //                         $subq->where('conversa', 'LIKE', '%' . $this->filtro_conversa . '%');
        //                     });
        //                 })->
        //                 when($this->filtro_telefone, function ($q)
        //                 {
        //                     $q->where('telefone',  'LIKE', '%' . $this->filtro_telefone . '%');
        //                 })->
        //                 when($this->filtro_nivel, function ($q)
        //                 {
        //                     $q->whereHas('akdjwlkefjdlkfn', function ($subq)
        //                     {
        //                         $subq->where('nivel_interesse', '=', $this->filtro_nivel );
        //                     });
        //                 })->
        //                 // when($this->filtro_favorito, function ($q)
        //                 // {
                        //     $q->where('favorito', '=', $this->filtro_favorito);
                        // })->
                        // when($this->filtro_status, function ($q)
                        // {
                        //     $q->where('status', '=', $this->filtro_status);
                        // })->
                        // when($this->filtro_resultado, function ($q)
                        // {
                        //     $q->where('resultado', '=', $this->filtro_resultado);
                        // })->
                        // when($this->filtro_dt_retorno, function ($q)
                        // {
                        //     $q->where('proximo_atendimento', '=', $this->filtro_dt_retorno);
                        // })->
                        // orderBy('proximo_atendimento', 'asc')->
                        // paginate();

        // return $leads;
    // }

    public function pesquisas()
    {
        return DBLead::filtro()->
                        where('id', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('id_pessoa', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('telefone', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('obs', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('cidade', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('email', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('id_origem', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('interesse', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('id_consultor', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('status', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('favorito', 'LIKE', '%'.$pesquisa.'%')->
                        orWhere('arquivado', 'LIKE', '%'.$pesquisa.'%');

                        // when($this->filtro_empresa, function ($q)
                        // {
                        //     ;
                        // })->
                        // when($this->filtro_nome, function ($q)
                        // {
                        //     $q->where('nome', 'LIKE', '%' . $this->filtro_nome . '%')->orWhere('obs', 'LIKE', '%' . $this->filtro_nome . '%');
                        // })->
                        // when($this->filtro_conversa, function ($q)
                        // {
                        //     $q->whereHas('fghtvxswwryiiil', function ($subq)
                        //     {
                        //         $subq->where('conversa', 'LIKE', '%' . $this->filtro_conversa . '%');
                        //     });
                        // })->
                        // when($this->filtro_telefone, function ($q)
                        // {
                        //     $q->where('telefone',  'LIKE', '%' . $this->filtro_telefone . '%');
                        // })->
                        // when($this->filtro_nivel, function ($q)
                        // {
                        //     $q->whereHas('akdjwlkefjdlkfn', function ($subq)
                        //     {
                        //         $subq->where('nivel_interesse', '=', $this->filtro_nivel );
                        //     });
                        // })->paginate();
    }

    public function render()
    {
        $leads = DBLead::filtro();

        // pesquisas()->paginate();

        return view('livewire/comercial/lead/comissao/index', [
            'leads' => $leads->paginate(),
        ])->layout('layouts/app');
    }

}
