<?php

namespace App\Livewire\Financeiro\Lancamento;

use Livewire\Component;
use App\Models\Financeiro\Lancamento as DBLancamento;

class Lancamentostore extends Component
{
  public $p_tipo;
  public $p_inicio;
  public $p_final;
  public $p_informacao;
  public $p_banco;
  public $p_conta;
  public $p_valor;
  public $p_pesquisar = '';
  
  
  public $tipo;
  public $id_banco;
  public $id_conta;
  public $num_documento;
  public $id_pessoa;
  public $informacao;
  public $vlr_bruto;
  public $vlr_dsc_acr;
  public $vlr_final;
  public $parcela;
  public $id_forma_pagamento;
  public $descricao;
  public $dt_vencimento;
  public $dt_competencia;
  public $dt_recebimento;
  public $dt_confirmacao;
  public $dt_pagamento;
  public $id_usuario_lancamento;
  public $id_usuario_confirmacao;
  public $id_caixa;
  public $id_lancamento_origem;
  public $origem;
  public $status;
  public $centro_custo;
  
  public $lancamento = [];
  public $modalType;
  public $lancamentoId;
  
  protected $listeners = ['chamarMetodo' => 'remove'];

  protected $rule = [
    'informacao' => 'required|min:3'
  ];

  public function updated($propertyName)
  {
    $this->validationOnly($propertyName);
  }

  public function store()
  {
    $this->validate();
    
    $lancamento = DBLancamento::create([
      'tipo'                   => $this->tipo,
      'id_banco'               => $this->id_banco,
      'id_conta'               => $this->id_conta,
      'num_documento'          => $this->num_documento,
      'id_pessoa'              => $this->id_pessoa,
      'informacao'             => $this->informacao,
      'vlr_bruto'              => $this->vlr_bruto,
      'vlr_dsc_acr'            => $this->vlr_dsc_acr,
      'vlr_final'              => $this->vlr_final,
      'parcela'                => $this->parcela,
      'id_forma_pagamento'     => $this->id_forma_pagamento,
      'descricao'              => $this->descricao,
      'dt_vencimento'          => $this->dt_vencimento,
      'dt_competencia'         => $this->dt_competencia,
      'dt_recebimento'         => $this->dt_recebimento,
      'dt_confirmacao'         => $this->dt_confirmacao,
      'dt_pagamento'           => $this->dt_pagamento,
      'id_usuario_lancamento'  => $this->id_usuario_lancamento,
      'id_usuario_confirmacao' => $this->id_usuario_confirmacao,
      'id_caixa'               => $this->id_caixa,
      'id_lancamento_origem'   => $this->id_lancamento_origem,
      'origem'                 => $this->origem,
      'status'                 => $this->status,
      'centro_custo'           => $this->centro_custo,
    ]);
    
    $this->dispatch('swal:alert', [
      'title'     => 'Criado!',
      'text'      => 'Lançamento cadastrado com sucesso!',
      'icon'      => 'success',
      'iconColor' => 'green',
    ]);
    
    session()->flash('success', 'Lancamento Created!');
    $this->reset();
  }
  
  public function listar()
  {
      $lancamentos = DBLancamento::
                          procurar($this->p_pesquisar)->
                          where('id_empresa', '=', 1)->
                          whereBetween('dt_competencia', [$this->p_inicio, $this->p_final])->
                          when($this->p_informacao, function ($query1)
                          {
                              $query1->whereHas('qexgzmnndqxmyks', function ($subQuery1)
                              {
                                  $subQuery1->where('nome', 'LIKE', '%' . $this->p_informacao . '%');
                              })->
                              orWhere('informacao', 'LIKE', '%' . $this->p_informacao . '%');
                          })->
                          when($this->p_conta, function ($query2)
                          {
                              $query2->whereHas('qlwiqwuheqlefkd', function ($subQuery2)
                              {
                                  $subQuery2->where('titulo', 'LIKE', '%' . $this->p_conta . '%')->
                                              orwhere('id', 'LIKE', '%' . $this->p_conta . '%');
                              });
                          })->
                          when($this->p_valor, function ($q)
                          {
                              $q->where('vlr_final', '=', $this->p_valor);
                          })->
                          when($this->p_banco, function ($query3)
                          {
                              $query3->where('id_banco', '=', $this->p_banco);
                          })->
                          when($this->p_tipo, function ($query4)
                          {
                              $query4->where('tipo', '=', $this->p_tipo);
                          })->
                          orderBy('dt_competencia', 'asc')->
                          get();

    return $lancamentos;
  }

  public function render()
  {
    $lancamentos = $this->listar();

    return view('livewire/financeiro/lancamento/criar', [
        'lancamentos' => $lancamentos,
    ])->layout('layouts/app');
  }

}