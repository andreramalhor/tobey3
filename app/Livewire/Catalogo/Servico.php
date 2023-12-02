<?php

namespace App\Livewire\Catalogo;

use Livewire\Attributes\Rule;
use App\Models\Catalogo\Servico as DBServico;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image;

class Servico extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    // Serviço / Produto
    public $bd_tipo = 'Serviço';
    #[Rule('required|min:3')]
    public $bd_nome;
    #[Rule('required')]
    public $bd_id_categoria;
    public $bd_ativo;
    public $bd_descricao;

    public $bd_marca = 14;
    public $bd_id_fornecedor;
    public $bd_unidade = 13;
    public $bd_ncm_prod_serv = 19;
    public $bd_cod_nota = 15;
    public $bd_cod_barras = 16;
    public $bd_estoque_min = 17;
    public $bd_estoque_max = 18;

    public $bd_duracao = 10;

    // Valores
    public $bd_tipo_preco = 'Preço fixo';
    public $bd_vlr_venda = '0,00';

    public $bd_vlr_custo = '0,00';
    public $bd_vlr_frete = '0,00';
    public $bd_vlr_impostos = '0,00';
    public $bd_cst_adicional = '0,00';
    public $bd_vlr_nota = '0,00';

    public $bd_tipo_comissao = 'Valor fixo';
    public $bd_prc_comissao = 8;
    public $bd_vlr_comissao = '0,00';

    public $bd_ipi_prod_serv = 20;
    public $bd_icms_prod_serv = 21;
    public $bd_simples_prod_serv = 22;

    // Programa de fidelidade
    public $bd_fidelidade_pontos_ganhos = 11;
    public $bd_fidelidade_pontos_necessarios = 12;

    // Indicadores
    public $bd_tempo_retorno = 9;
    public $bd_consumo_medio = 32;
    public $bd_curva_abc = 34;
    public $bd_cmv_prod_serv = 33;
    public $bd_vlr_marg_contribuicao = '0,00';
    public $bd_marg_contribuicao = 28;
    public $bd_margem_custo = 31;
    public $bd_vlr_custo_estoque = '0,00';
    public $bd_status = 37;

    // Indicadores
    #[Rule('image|nullable')]
    public $foto;

    public $servico = [];
    public $modalType;
    public $servicoId;

    protected $listeners = ['chamarMetodo' => 'remove'];

    public function create()
    {
        $this->reset();
        $this->openModal('criar');
    }

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->modalType = '';
    }

    public function store()
    {
        // $this->validate();

        $servico = DBServico::create([
            'nome'                          => $this->bd_nome,
            'tipo'                          => $this->bd_tipo,
            'ativo'                         => $this->bd_ativo,
            'id_categoria'                  => $this->bd_id_categoria,
            'tipo_preco'                    => $this->bd_tipo_preco,
            'vlr_venda'                     => $this->bd_vlr_venda,
            'cst_adicional'                 => $this->bd_cst_adicional,
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

        if($this->foto)
        {
            $nomearquivo = $servico->id.'.png';

            $img = Image::make($this->foto);
            $img->resize(320, 320);
            $img->save('stg/img/prod/' . $nomearquivo);
        }

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Servico cadastrada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('servicoId');
        $this->closeModal();
    }

    public function show($id)
    {
        $this->servico = DBServico::findOrFail($id);

        $this->openModal('mostrar');
    }

    public function edit($id)
    {
        $servico = DBServico::findOrFail($id);
        $this->servicoId = $id;
        $this->foto      = $servico->srcFoto;
        $this->bd_nome                          = $servico->nome;
        $this->bd_tipo                          = $servico->tipo;
        $this->bd_ativo                         = $servico->ativo;
        $this->bd_id_categoria                  = $servico->id_categoria;
        $this->bd_tipo_preco                    = $servico->tipo_preco;
        $this->bd_vlr_venda                     = $servico->vlr_venda;
        $this->bd_cst_adicional                 = $servico->cst_adicional;
        $this->bd_prc_comissao                  = $servico->prc_comissao;
        $this->bd_tempo_retorno                 = $servico->tempo_retorno;
        $this->bd_duracao                       = $servico->duracao;
        $this->bd_fidelidade_pontos_ganhos      = $servico->fidelidade_pontos_ganhos;
        $this->bd_fidelidade_pontos_necessarios = $servico->fidelidade_pontos_necessarios;
        $this->bd_unidade                       = $servico->unidade;
        $this->bd_marca                         = $servico->marca;
        $this->bd_cod_nota                      = $servico->cod_nota;
        $this->bd_cod_barras                    = $servico->cod_barras;
        $this->bd_estoque_min                   = $servico->estoque_min;
        $this->bd_estoque_max                   = $servico->estoque_max;
        $this->bd_ncm_prod_serv                 = $servico->ncm_prod_serv;
        $this->bd_ipi_prod_serv                 = $servico->ipi_prod_serv;
        $this->bd_icms_prod_serv                = $servico->icms_prod_serv;
        $this->bd_simples_prod_serv             = $servico->simples_prod_serv;
        $this->bd_vlr_mercado                   = $servico->vlr_mercado;
        $this->bd_vlr_nota                      = $servico->vlr_nota;
        $this->bd_vlr_frete                     = $servico->vlr_frete;
        $this->bd_vlr_comissao                  = $servico->vlr_comissao;
        $this->bd_vlr_marg_contribuicao         = $servico->vlr_marg_contribuicao;
        $this->bd_marg_contribuicao             = $servico->marg_contribuicao;
        $this->bd_vlr_custo                     = $servico->vlr_custo;
        $this->bd_vlr_custo_estoque             = $servico->vlr_custo_estoque;
        $this->bd_margem_custo                  = $servico->margem_custo;
        $this->bd_consumo_medio                 = $servico->consumo_medio;
        $this->bd_cmv_prod_serv                 = $servico->cmv_prod_serv;
        $this->bd_curva_abc                     = $servico->curva_abc;
        $this->bd_id_fornecedor                 = $servico->id_fornecedor;
        $this->bd_descricao                     = $servico->descricao;
        $this->bd_status                        = $servico->status;
        $this->openModal('editar');
    }

    public function update()
    {
        if ($this->servicoId)
        {
            $servico = DBServico::findOrFail($this->servicoId);
            $servico->update([
                'nome'                          => $this->bd_nome,
                'tipo'                          => $this->bd_tipo,
                'ativo'                         => $this->bd_ativo,
                'id_categoria'                  => $this->bd_id_categoria,
                'tipo_preco'                    => $this->bd_tipo_preco,
                'vlr_venda'                     => $this->bd_vlr_venda,
                'cst_adicional'                 => $this->bd_cst_adicional,
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

            if($this->foto)
            {
                $nomearquivo = $servico->id.'.png';

                $img = Image::make($this->foto);
                $img->resize(320, 320);
                $img->save('stg/img/prod/' . $nomearquivo);
            }

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Servico atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $servico = DBServico::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $servico->nome,
            'text'         => 'Tem certeza que quer deletar a servico?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $servico->id,
        ]);
    }

    public function remove($id)
    {
        $servico = DBServico::find($id);

        $filePath = public_path("stg/img/prod/{$servico->id}.png");
        if (file_exists($filePath))
        {
            unlink($filePath);
            $texto = 'Servico e foto deletada com sucesso!';
        }

        $servico->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Servico deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('servicoId');
    }

    public function listar()
    {
        $servicos = DBServico::
                            procurar($this->pesquisar)->
                            paginate(10);

        return $servicos;
    }

    public function render()
    {
        $servicos = $this->listar();

        return view('livewire/catalogo/servico/index', [
            'servicos' => $servicos,
        ])->layout('layouts/app');
    }
}
