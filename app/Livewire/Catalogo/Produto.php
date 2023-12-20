<?php

namespace App\Livewire\Catalogo;

use App\Models\Catalogo\Produto as DBProduto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image;

class Produto extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    // Produto / Serviço
    public $bd_tipo = 'Produto';
    public $bd_nome;
    public $bd_id_categoria;
    public $bd_ativo = 1;
    public $bd_descricao;

    public $bd_marca;
    public $bd_id_fornecedor;
    public $bd_unidade;
    public $bd_ncm_prod_serv;
    public $bd_cod_nota;
    public $bd_cod_barras;
    public $bd_estoque_min = 1;
    public $bd_estoque_max = 10;

    public $bd_duracao = '00:00:00';

    // Valores
    public $bd_tipo_preco = 'Preço fixo';
    public $bd_vlr_venda = 0;

    public $bd_vlr_frete     = 0;
    public $bd_vlr_impostos  = 0;
    public $bd_vlr_cst_adicional = 0;
    public $bd_vlr_nota      = 0;
    public $bd_vlr_custo     = 'R$ 0,00';
    
    public $bd_tipo_comissao = 'Valor fixo';
    public $bd_prc_comissao = 0;
    public $bd_vlr_comissao = 0;

    // Impostos
    public $bd_ipi_prod_serv     = 0;
    public $bd_icms_prod_serv    = 0;
    public $bd_simples_prod_serv = 0;

    // Programa de fidelidade
    public $bd_fidelidade_pontos_ganhos      = 0;
    public $bd_fidelidade_pontos_necessarios = 0;

    // Indicadores
    public $bd_tempo_retorno = 9;
    public $bd_consumo_medio = 32;
    public $bd_curva_abc = 34;
    public $bd_cmv_prod_serv = 33;
    public $bd_vlr_marg_contribuicao = 0;
    public $bd_marg_contribuicao = 28;
    public $bd_margem_custo = 31;
    public $bd_vlr_custo_estoque = 0;
    public $bd_status = 37;

    // Foto
    public $foto;

    public $produto = [];
    public $produtoId;
    public $modal_type;
    public $tab_active = 'tab-produto';
    
    
    protected $listeners = ['chamarMetodo' => 'deletar'];

    protected $rules = [
        'bd_tipo' => 'required|min:3',
        'bd_nome' => 'required',
        'foto'    => 'image|nullable',
    ];

    public function openModal($type)
    {
        $this->modal_type = $type;
        $this->dispatch('mask:apply');
        $this->resetValidation();
    }
    
    public function tabActive($tab_active)
    {
        $this->tab_active = $tab_active;
    }
    
    public function closeModal()
    {
        $this->modal_type = '';
    }
    
    public function updatedBdTipoComissao()
    {
        $this->dispatch('mask:apply');
    }
    
    public function atualizarValores()
    {
        $this->bd_vlr_custo = 'R$ ' . number_format((str_replace(['.', ','], ['', '.'], $this->bd_vlr_frete) + str_replace(['.', ','], ['', '.'], $this->bd_vlr_impostos) + str_replace(['.', ','], ['', '.'], $this->bd_vlr_cst_adicional) + str_replace(['.', ','], ['', '.'], $this->bd_vlr_nota)), 2, ',', '.');
    }

    public function criar()
    {
        $this->reset();
        $this->openModal('criar');
    }

    public function gravar()
    {
        $this->validate();
        // dd(119);

        $produto = DBProduto::create([
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
            // 'vlr_mercado'                   => $this->bd_vlr_mercado,
            'vlr_nota'                      => $this->bd_vlr_nota,
            'vlr_frete'                     => $this->bd_vlr_frete,
            'vlr_impostos'                  => $this->bd_vlr_impostos,
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

        if($this->foto)
        {
            $nomearquivo = $produto->id.'.png';

            $img = Image::make($this->foto);
            $img->resize(320, 320);
            $img->save('stg/img/prod/' . $nomearquivo);
        }

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Produto cadastrada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('produtoId');
        $this->closeModal();
    }

    public function editar($id)
    {
        $produto = DBProduto::findOrFail($id);
        $this->produtoId = $id;
        $this->foto      = $produto->srcFoto;
        $this->bd_nome                          = $produto->nome;
        $this->bd_tipo                          = $produto->tipo;
        $this->bd_ativo                         = $produto->ativo;
        $this->bd_id_categoria                  = $produto->id_categoria;
        $this->bd_tipo_preco                    = $produto->tipo_preco;
        $this->bd_vlr_venda                     = $produto->vlr_venda;
        $this->bd_vlr_cst_adicional                 = $produto->vlr_cst_adicional;
        $this->bd_prc_comissao                  = $produto->prc_comissao;
        $this->bd_tempo_retorno                 = $produto->tempo_retorno;
        $this->bd_duracao                       = $produto->duracao;
        $this->bd_fidelidade_pontos_ganhos      = $produto->fidelidade_pontos_ganhos;
        $this->bd_fidelidade_pontos_necessarios = $produto->fidelidade_pontos_necessarios;
        $this->bd_unidade                       = $produto->unidade;
        $this->bd_marca                         = $produto->marca;
        $this->bd_cod_nota                      = $produto->cod_nota;
        $this->bd_cod_barras                    = $produto->cod_barras;
        $this->bd_estoque_min                   = $produto->estoque_min;
        $this->bd_estoque_max                   = $produto->estoque_max;
        $this->bd_ncm_prod_serv                 = $produto->ncm_prod_serv;
        $this->bd_ipi_prod_serv                 = $produto->ipi_prod_serv;
        $this->bd_icms_prod_serv                = $produto->icms_prod_serv;
        $this->bd_simples_prod_serv             = $produto->simples_prod_serv;
        // $this->bd_vlr_mercado                   = $produto->vlr_mercado;
        $this->bd_vlr_nota                      = $produto->vlr_nota;
        $this->bd_vlr_frete                     = $produto->vlr_frete;
        $this->bd_vlr_impostos                  = $produto->vlr_impostos;
        $this->bd_vlr_comissao                  = $produto->vlr_comissao;
        $this->bd_vlr_marg_contribuicao         = $produto->vlr_marg_contribuicao;
        $this->bd_marg_contribuicao             = $produto->marg_contribuicao;
        $this->bd_vlr_custo                     = $produto->vlr_custo;
        $this->bd_vlr_custo_estoque             = $produto->vlr_custo_estoque;
        $this->bd_margem_custo                  = $produto->margem_custo;
        $this->bd_consumo_medio                 = $produto->consumo_medio;
        $this->bd_cmv_prod_serv                 = $produto->cmv_prod_serv;
        $this->bd_curva_abc                     = $produto->curva_abc;
        $this->bd_id_fornecedor                 = $produto->id_fornecedor;
        $this->bd_descricao                     = $produto->descricao;
        $this->bd_status                        = $produto->status;
        $this->openModal('editar');
    }

    public function atualizar()
    {
        if ($this->produtoId)
        {
            $produto = DBProduto::findOrFail($this->produtoId);
            $produto->update([
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
                // 'vlr_mercado'                   => $this->bd_vlr_mercado,
                'vlr_nota'                      => $this->bd_vlr_nota,
                'vlr_frete'                     => $this->bd_vlr_frete,
                'vlr_impostos'                  => $this->bd_vlr_impostos,
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

            if($this->foto)
            {
                $nomearquivo = $produto->id.'.png';

                $img = Image::make($this->foto);
                $img->resize(320, 320);
                $img->save('stg/img/prod/' . $nomearquivo);
            }

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Produto atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }
    
    public function mostrar($id)
    {
        $this->produto = DBProduto::findOrFail($id);

        $this->openModal('mostrar');
    }

    public function remover($id)
    {
        $produto = DBProduto::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $produto->nome,
            'text'         => 'Tem certeza que quer deletar a produto?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $produto->id,
        ]);
    }

    public function deletar($id)
    {
        $produto = DBProduto::find($id);

        $filePath = public_path("stg/img/prod/{$produto->id}.png");
        if (file_exists($filePath))
        {
            unlink($filePath);
            $texto = 'Produto e foto deletada com sucesso!';
        }

        $produto->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Produto deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('produtoId');
    }

    public function listar()
    {
        $produtos = DBProduto::
                            procurar($this->pesquisar)->
                            paginate(10);

        return $produtos;
    }

    public function render()
    {
        $produtos = $this->listar();

        return view('livewire/catalogo/produto/index', [
            'produtos' => $produtos,
        ])->layout('layouts/app');
    }
}
