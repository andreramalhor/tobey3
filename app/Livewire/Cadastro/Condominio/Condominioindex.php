<?php

namespace App\Livewire\Cadastro\Condominio;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cadastro\Condominio as DBCondominio;

class Condominioindex extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $pesquisar = '';
    public $orderBy = 'id';
    public $orderAsc = true;

     // Condomínio
     #[Rule('required|min:3')]
     public $bd_uuid;
     public $bd_nome;
     public $bd_cnpj;
     public $bd_ddd;
     public $bd_telefone;
     public $bd_logradouro;
     public $bd_numero;
     public $bd_complemento;
     public $bd_bairro;
     public $bd_cidade;
     public $bd_cep;    
     public $bd_uf = 'MG';
 
     // Foto
     #[Rule('image|nullable')]
     public $foto;
 
     public $condominio = [];
     public $condominioId;
     public $modal_type;
     public $tab_active = 'tab-condominio';
     
     protected $listeners = ['chamarMetodo' => 'deletar'];
 
     protected $rules = [
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
         // $this->bd_vlr_venda = 'R$ ' . number_format((str_replace(['.', ','], ['', '.'], $this->bd_vlr_venda)), 2, ',', '.');
         $this->bd_vlr_custo = 'R$ ' . number_format((str_replace(['.', ','], ['', '.'], $this->bd_vlr_frete) + str_replace(['.', ','], ['', '.'], $this->bd_vlr_impostos) +  str_replace(['.', ','], ['', '.'], $this->bd_vlr_custo_comissao) + str_replace(['.', ','], ['', '.'], $this->bd_vlr_cst_adicional) + str_replace(['.', ','], ['', '.'], $this->bd_vlr_nota)), 2, ',', '.');
     }
 
     public function criar()
     {
         $this->reset();
         $this->openModal('criar');
     }
 
     public function gravar()
     {
         $this->validate();
 
         $condominio = DBCondominio::create([
             'uuid'         =>  \Str::uuid(),
             'nome'         =>  $this->bd_nome,
             'cnpj'         =>  $this->bd_cnpj,
             'ddd'          =>  $this->bd_ddd,
             'telefone'     =>  $this->bd_telefone,
             'logradouro'   =>  $this->bd_logradouro,
             'numero'       =>  $this->bd_numero,
             'complemento'  =>  $this->bd_complemento,
             'bairro'       =>  $this->bd_bairro,
             'cidade'       =>  $this->bd_cidade,
             'cep'          =>  $this->bd_cep,    
             'uf'           =>  $this->bd_uf,
         ]);
 
         if($this->foto)
         {
             $nomearquivo = $condominio->id.'.png';
 
             $img = Image::make($this->foto);
             $img->resize(320, 320);
             $img->save('stg/img/prod/' . $nomearquivo);
         }
 
         $this->dispatch('swal:alert', [
             'title'     => 'Criado!',
             'text'      => 'Condomínio cadastrado com sucesso!',
             'icon'      => 'success',
             'iconColor' => 'green',
         ]);
 
         $this->resetExcept('condominioId');
         $this->closeModal();
     }
 
     public function editar($id)
     {
         $condominio = DBCondominio::findOrFail($id);
         $this->condominioId                        = $id;
         $this->foto                             = $condominio->srcFoto;
         $this->bd_nome                          = $condominio->nome;
         $this->bd_tipo                          = $condominio->tipo;
         $this->bd_ativo                         = $condominio->ativo;
         $this->bd_id_categoria                  = $condominio->id_categoria;
         $this->bd_tipo_preco                    = $condominio->tipo_preco;
         $this->bd_vlr_venda                     = $condominio->vlr_venda;
         $this->bd_vlr_cst_adicional                 = $condominio->vlr_cst_adicional;
         $this->bd_tipo_comissao                 = $condominio->tipo_comissao;
         $this->bd_prc_comissao                  = $condominio->prc_comissao;
         $this->bd_tempo_retorno                 = $condominio->tempo_retorno;
         $this->bd_duracao                       = $condominio->duracao;
         $this->bd_fidelidade_pontos_ganhos      = $condominio->fidelidade_pontos_ganhos;
         $this->bd_fidelidade_pontos_necessarios = $condominio->fidelidade_pontos_necessarios;
         $this->bd_unidade                       = $condominio->unidade;
         $this->bd_marca                         = $condominio->marca;
         $this->bd_cod_nota                      = $condominio->cod_nota;
         $this->bd_cod_barras                    = $condominio->cod_barras;
         $this->bd_estoque_min                   = $condominio->estoque_min;
         $this->bd_estoque_max                   = $condominio->estoque_max;
         $this->bd_ncm_prod_serv                 = $condominio->ncm_prod_serv;
         $this->bd_ipi_prod_serv                 = $condominio->ipi_prod_serv;
         $this->bd_icms_prod_serv                = $condominio->icms_prod_serv;
         $this->bd_simples_prod_serv             = $condominio->simples_prod_serv;
         // $this->bd_vlr_mercado                   = $condominio->vlr_mercado;
         $this->bd_vlr_nota                      = $condominio->vlr_nota;
         $this->bd_vlr_frete                     = $condominio->vlr_frete;
         $this->bd_vlr_impostos                  = $condominio->vlr_impostos;
         $this->bd_vlr_comissao                  = $condominio->vlr_comissao;
         $this->bd_vlr_custo_comissao            = $condominio->vlr_custo_comissao;
         $this->bd_vlr_marg_contribuicao         = $condominio->vlr_marg_contribuicao;
         $this->bd_marg_contribuicao             = $condominio->marg_contribuicao;
         $this->bd_vlr_custo                     = $condominio->vlr_custo;
         $this->bd_vlr_custo_estoque             = $condominio->vlr_custo_estoque;
         $this->bd_margem_custo                  = $condominio->margem_custo;
         $this->bd_consumo_medio                 = $condominio->consumo_medio;
         $this->bd_cmv_prod_serv                 = $condominio->cmv_prod_serv;
         $this->bd_curva_abc                     = $condominio->curva_abc;
         $this->bd_id_fornecedor                 = $condominio->id_fornecedor;
         $this->bd_descricao                     = $condominio->descricao;
         $this->bd_status                        = $condominio->status;
         
         $this->atualizarValores();
         $this->openModal('editar');
     }
 
     public function atualizar()
     {
         if ($this->condominioId)
         {
             $condominio = DBCondominio::findOrFail($this->condominioId);
             $condominio->update([
                 'nome'                          => $this->bd_nome,
                 'tipo'                          => $this->bd_tipo,
                 'ativo'                         => $this->bd_ativo,
                 'id_categoria'                  => $this->bd_id_categoria,
                 'tipo_preco'                    => $this->bd_tipo_preco,
                 'vlr_venda'                     => $this->bd_vlr_venda,
                 'vlr_cst_adicional'                 => $this->bd_vlr_cst_adicional,
                 'tipo_comissao'                 => $this->bd_tipo_comissao,
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
                 'vlr_custo_comissao'            => $this->bd_vlr_custo_comissao,
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
                 $nomearquivo = $condominio->id.'.png';
 
                 $img = Image::make($this->foto);
                 $img->resize(320, 320);
                 $img->save('stg/img/prod/' . $nomearquivo);
             }
 
             $this->dispatch('swal:alert', [
                 'title'     => 'Atualizado!',
                 'text'      => 'Condomínio atualizada com sucesso!',
                 'icon'      => 'success',
                 'iconColor' => 'green',
             ]);
 
             $this->closeModal();
             $this->reset();
         }
     }
     
     public function mostrar($id)
     {
 dd(121);
         $condominio = DBCondominio::findOrFail($id);
         $this->condominio                          = $condominio;
         $this->condominioId                        = $id;
         $this->foto                             = $condominio->srcFoto;
         $this->bd_nome                          = $condominio->nome;
         $this->bd_tipo                          = $condominio->tipo;
         $this->bd_ativo                         = $condominio->ativo;
         $this->bd_id_categoria                  = $condominio->id_categoria;
         $this->bd_tipo_preco                    = $condominio->tipo_preco;
         $this->bd_vlr_venda                     = $condominio->vlr_venda;
         $this->bd_vlr_cst_adicional                 = $condominio->vlr_cst_adicional;
         $this->bd_tipo_comissao                 = $condominio->tipo_comissao;
         $this->bd_prc_comissao                  = $condominio->prc_comissao;
         $this->bd_tempo_retorno                 = $condominio->tempo_retorno;
         $this->bd_duracao                       = $condominio->duracao;
         $this->bd_fidelidade_pontos_ganhos      = $condominio->fidelidade_pontos_ganhos;
         $this->bd_fidelidade_pontos_necessarios = $condominio->fidelidade_pontos_necessarios;
         $this->bd_unidade                       = $condominio->unidade;
         $this->bd_marca                         = $condominio->marca;
         $this->bd_cod_nota                      = $condominio->cod_nota;
         $this->bd_cod_barras                    = $condominio->cod_barras;
         $this->bd_estoque_min                   = $condominio->estoque_min;
         $this->bd_estoque_max                   = $condominio->estoque_max;
         $this->bd_ncm_prod_serv                 = $condominio->ncm_prod_serv;
         $this->bd_ipi_prod_serv                 = $condominio->ipi_prod_serv;
         $this->bd_icms_prod_serv                = $condominio->icms_prod_serv;
         $this->bd_simples_prod_serv             = $condominio->simples_prod_serv;
         // $this->bd_vlr_mercado                   = $condominio->vlr_mercado;
         $this->bd_vlr_nota                      = $condominio->vlr_nota;
         $this->bd_vlr_frete                     = $condominio->vlr_frete;
         $this->bd_vlr_impostos                  = $condominio->vlr_impostos;
         $this->bd_vlr_comissao                  = $condominio->vlr_comissao;
         $this->bd_vlr_custo_comissao            = $condominio->vlr_custo_comissao;
         $this->bd_vlr_marg_contribuicao         = $condominio->vlr_marg_contribuicao;
         $this->bd_marg_contribuicao             = $condominio->marg_contribuicao;
         $this->bd_vlr_custo                     = $condominio->vlr_custo;
         $this->bd_vlr_custo_estoque             = $condominio->vlr_custo_estoque;
         $this->bd_margem_custo                  = $condominio->margem_custo;
         $this->bd_consumo_medio                 = $condominio->consumo_medio;
         $this->bd_cmv_prod_serv                 = $condominio->cmv_prod_serv;
         $this->bd_curva_abc                     = $condominio->curva_abc;
         $this->bd_id_fornecedor                 = $condominio->id_fornecedor;
         $this->bd_descricao                     = $condominio->descricao;
         $this->bd_status                        = $condominio->status;
         
         $this->atualizarValores();
         $this->openModal('mostrar');
     }
 
     public function remover($id)
     {
         $condominio = DBCondominio::find($id);
 
         $this->dispatch('swal:confirm', [
             'title'        => $condominio->nome,
             'text'         => 'Tem certeza que quer deletar o condomínio?',
             'icon'         => 'warning',
             'iconColor'    => 'orange',
             'idEvent'      => $condominio->id,
         ]);
     }
 
     public function deletar($id)
     {
         $condominio = DBCondominio::find($id);
 
         $filePath = public_path("stg/img/prod/{$condominio->id}.png");
         if (file_exists($filePath))
         {
             unlink($filePath);
             $texto = 'Condominio e foto deletada com sucesso!';
         }
 
         $condominio->delete();
 
         $this->dispatch('swal:alert', [
             'title'         => 'Deletado!',
             'text'          => $texto ?? 'Condomínio deletada com sucesso!',
             'icon'          => 'success',
             'iconColor'     => 'green',
         ]);
 
         $this->resetExcept('condominioId');
     }
 
    public function render()
    {
        $condominios = DBCondominio::
                            procurar($this->pesquisar)->
                            orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')->
                            paginate($this->perPage);

        return view('livewire/condominio/index', [
            'condominios' => $condominios,
        ])->layout('layouts/app');
    }

}
