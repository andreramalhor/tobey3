<?php

namespace App\Livewire\Catalogo;

use Livewire\Attributes\Rule;
use App\Models\Catalogo\Compra as DBCompra;
use App\Models\Catalogo\Produto as DBProduto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Compra extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    // fin_compras
    public $passo_1;
    public $fin_compras_id;
    #[Rule('required')]
    public $fin_compras_tipo = 'Produtos para revenda';
    public $fin_compras_id_caixa;                              // excluir
    public $fin_compras_id_usuario;                            // excluir
    public $fin_compras_id_fornecedor;
    public $fin_compras_qtd_produtos = "0";
    public $fin_compras_vlr_prod_serv = "0,00";
    public $fin_compras_vlr_negociados = "0,00";
    public $fin_compras_vlr_dsc_acr = "0,00";
    public $fin_compras_vlr_final = "0,00";
    public $fin_compras_status;


    // fin_compras_detalhes
    public $passo_2;
    public $fin_compras_detalhes = [];
    public $fin_compras_detalhes_id;
    public $fin_compras_detalhes_id_compra;
    public $fin_compras_detalhes_id_servprod;
    public $fin_compras_detalhes_qtd = 1;
    public $fin_compras_detalhes_vlr_compra = "0,00";
    public $fin_compras_detalhes_vlr_negociado = "0,00";
    public $fin_compras_detalhes_vlr_dsc_acr = "0,00";
    public $fin_compras_detalhes_vlr_final = "0,00";
    public $fin_compras_detalhes_vlr_frete = "0,00";
    public $fin_compras_detalhes_vlr_imposto = "0,00";
    public $fin_compras_detalhes_vlr_custo_total = "0,00";
    public $fin_compras_detalhes_status;


    // fin_compras_pagamentos
    public $passo_3;
    public $fin_compras_pagamentos = [];
    public $fin_compras_pagamentos_id;
    public $fin_compras_pagamentos_id_compra;
    public $fin_compras_pagamentos_id_forma_pagamento;
    public $fin_compras_pagamentos_descricao;
    public $fin_compras_pagamentos_parcela;
    public $fin_compras_pagamentos_valor;
    public $fin_compras_pagamentos_dt_prevista;
    public $fin_compras_pagamentos_status;


    public $produtosfornecedor = [];
    public $produtoescolhido = [];
    public $compra = [];
    public $modalType;
    public $compraId;

    protected $listeners = ['chamarMetodo' => 'remove'];

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->modalType = '';
    }

    public function ir_passo_1()
    {
        $this->reset();
        $this->openModal('passo_1');
    }

    public function concluir_passo_1()
    {
        $this->validate();

        $compra = DBCompra::create([
            'tipo'              => $this->fin_compras_tipo,
            // 'id_caixa'          => $this->fin_compras_id_caixa,
            'id_usuario'        => auth()->user()->id,
            'id_fornecedor'     => $this->fin_compras_id_fornecedor,
            'qtd_produtos'      => $this->fin_compras_qtd_produtos,
            'vlr_prod_serv'     => $this->fin_compras_vlr_prod_serv,
            'vlr_negociados'    => $this->fin_compras_vlr_negociados,
            'vlr_dsc_acr'       => $this->fin_compras_vlr_dsc_acr,
            'vlr_final'         => $this->fin_compras_vlr_final,
            'status'            => 'Compra incompleta',
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Compra cadastrada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->closeModal();
        $this->ir_passo_2($compra->id);
    }

    public function ir_passo_2($id_compra)
    {
        $this->reset();
        $this->openModal('passo_2');

        $compra = DBCompra::find($id_compra);

        $this->trazerProdutos($compra->id_fornecedor);
    }

    public function concluir_passo_2()
    {
        $this->validate();

        $compra = DBCompra::create([
            'tipo'              => $this->fin_compras_tipo,
            // 'id_caixa'          => $this->fin_compras_id_caixa,
            'id_usuario'        => auth()->user()->id,
            'id_fornecedor'     => $this->fin_compras_id_fornecedor,
            'qtd_produtos'      => $this->fin_compras_qtd_produtos,
            'vlr_prod_serv'     => $this->fin_compras_vlr_prod_serv,
            'vlr_negociados'    => $this->fin_compras_vlr_negociados,
            'vlr_dsc_acr'       => $this->fin_compras_vlr_dsc_acr,
            'vlr_final'         => $this->fin_compras_vlr_final,
            'status'            => 'Compra incompleta',
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Compra cadastrada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);


        $this->resetExcept('compraId');
        $this->compraId = $compra->id;
        $this->compraId = $compra->id;
        $this->closeModal();

        $this->openModal('passo_2');
    }

    public function show($id)
    {
        $this->compra = DBCompra::findOrFail($id);

        $this->openModal('mostrar');
    }

    public function edit($id)
    {
        $compra = DBCompra::findOrFail($id);
        $this->compraId = $id;
        $this->bd_nome                          = $compra->nome;
        $this->bd_tipo                          = $compra->tipo;
        $this->bd_ativo                         = $compra->ativo;
        $this->bd_id_categoria                  = $compra->id_categoria;
        $this->bd_tipo_preco                    = $compra->tipo_preco;
        $this->bd_vlr_venda                     = $compra->vlr_venda;
        $this->bd_vlr_cst_adicional                 = $compra->vlr_cst_adicional;
        $this->bd_prc_comissao                  = $compra->prc_comissao;
        $this->bd_tempo_retorno                 = $compra->tempo_retorno;
        $this->bd_duracao                       = $compra->duracao;
        $this->bd_fidelidade_pontos_ganhos      = $compra->fidelidade_pontos_ganhos;
        $this->bd_fidelidade_pontos_necessarios = $compra->fidelidade_pontos_necessarios;
        $this->bd_unidade                       = $compra->unidade;
        $this->bd_marca                         = $compra->marca;
        $this->bd_cod_nota                      = $compra->cod_nota;
        $this->bd_cod_barras                    = $compra->cod_barras;
        $this->bd_estoque_min                   = $compra->estoque_min;
        $this->bd_estoque_max                   = $compra->estoque_max;
        $this->bd_ncm_prod_serv                 = $compra->ncm_prod_serv;
        $this->bd_ipi_prod_serv                 = $compra->ipi_prod_serv;
        $this->bd_icms_prod_serv                = $compra->icms_prod_serv;
        $this->bd_simples_prod_serv             = $compra->simples_prod_serv;
        $this->bd_vlr_mercado                   = $compra->vlr_mercado;
        $this->bd_vlr_nota                      = $compra->vlr_nota;
        $this->bd_vlr_frete                     = $compra->vlr_frete;
        $this->bd_vlr_comissao                  = $compra->vlr_comissao;
        $this->bd_vlr_marg_contribuicao         = $compra->vlr_marg_contribuicao;
        $this->bd_marg_contribuicao             = $compra->marg_contribuicao;
        $this->bd_vlr_custo                     = $compra->vlr_custo;
        $this->bd_vlr_custo_estoque             = $compra->vlr_custo_estoque;
        $this->bd_margem_custo                  = $compra->margem_custo;
        $this->bd_consumo_medio                 = $compra->consumo_medio;
        $this->bd_cmv_prod_serv                 = $compra->cmv_prod_serv;
        $this->bd_curva_abc                     = $compra->curva_abc;
        $this->bd_id_fornecedor                 = $compra->id_fornecedor;
        $this->bd_descricao                     = $compra->descricao;
        $this->bd_status                        = $compra->status;
        $this->openModal('editar');
    }

    public function update()
    {
        if ($this->compraId)
        {
            $compra = DBCompra::findOrFail($this->compraId);
            $compra->update([
                'nome'                          => $this->bd_nome,
                'tipo'                          => $this->bd_tipo,
                'ativo'                         => $this->bd_ativo,
                'id_categoria'                  => $this->bd_id_categoria,
                'tipo_preco'                    => $this->bd_tipo_preco,
                'vlr_venda'                     => $this->bd_vlr_venda,
                'vlr_cst_adicional'                 => $this->bd_vlr_cst_adicional,
                'prc_comissao'                  => $this->bd_prc_comissao,
                'tempo_retorno'                 => $this->bd_tempo_retorno,
                'duracao'                       => $this->bd_duracao,
                'fidelidade_pontos_ganhos'      => $this->bd_fidelidade_pontos_ganhos,
                'fidelidade_pontos_necessarios' => $this->bd_fidelidade_pontos_necessarios,
                'unidade'                       => $this->bd_unidade,
                'marca'                         => $this->bd_marca,
                'cod_nota'                      => $this->bd_cod_nota,
                'cod_barras'                    => $this->bd_cod_barras,
                'estoque_min'                   => $this->bd_estoque_min,
                'estoque_max'                   => $this->bd_estoque_max,
                'ncm_prod_serv'                 => $this->bd_ncm_prod_serv,
                'ipi_prod_serv'                 => $this->bd_ipi_prod_serv,
                'icms_prod_serv'                => $this->bd_icms_prod_serv,
                'simples_prod_serv'             => $this->bd_simples_prod_serv,
                'vlr_mercado'                   => $this->bd_vlr_mercado,
                'vlr_nota'                      => $this->bd_vlr_nota,
                'vlr_frete'                     => $this->bd_vlr_frete,
                'vlr_comissao'                  => $this->bd_vlr_comissao,
                'vlr_marg_contribuicao'         => $this->bd_vlr_marg_contribuicao,
                'marg_contribuicao'             => $this->bd_marg_contribuicao,
                'vlr_custo'                     => $this->bd_vlr_custo,
                'vlr_custo_estoque'             => $this->bd_vlr_custo_estoque,
                'margem_custo'                  => $this->bd_margem_custo,
                'consumo_medio'                 => $this->bd_consumo_medio,
                'cmv_prod_serv'                 => $this->bd_cmv_prod_serv,
                'curva_abc'                     => $this->bd_curva_abc,
                'id_fornecedor'                 => $this->bd_id_fornecedor,
                'descricao'                     => $this->bd_descricao,
                'status'                        => $this->bd_status,
            ]);

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Compra atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $compra = DBCompra::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $compra->nome,
            'text'         => 'Tem certeza que quer deletar a compra?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $compra->id,
        ]);
    }

    public function remove($id)
    {
        $compra = DBCompra::find($id);

        $compra->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Compra deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('compraId');
    }

    public function listar()
    {
        $compras = DBCompra::
                            procurar($this->pesquisar)->
                            paginate(10);

        return $compras;
    }

    public function render()
    {
        $compras = $this->listar();

        return view('livewire/catalogo/compra/index', [
            'compras' => $compras,
        ])->layout('layouts/app');
    }

    public function trazerProdutos($id_fornecedor)
    {
        $produtos = DBProduto::where('id_fornecedor', '=', $id_fornecedor)->get();

        $this->produtosfornecedor = $produtos;
    }

    public function sobreProduto()
    {
        $produto = DBProduto::find($this->fin_compras_detalhes_id_servprod);

        $this->produtoescolhido                 = $produto;
        $this->fin_compras_detalhes_id_servprod = $produto->id;
        $this->fin_compras_detalhes_vlr_compra  = $produto->vlr_custo;
    }
}
