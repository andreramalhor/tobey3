<?php

namespace App\Livewire\PDV;

use App\Models\PDV\Caixa as DBCaixa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image;

class Caixa extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    // Serviço / Produto
    public $bd_id_banco;
    public $bd_id_usuario_abertura;
    public $bd_vlr_abertura;
    public $bd_vlr_fechamento;
    public $bd_status;
    public $bd_dt_abertura;
    public $bd_dt_fechamento;
    public $bd_dt_validacao;
    public $bd_id_usuario_validacao;

    // Dinheiro
    public $bd_nota200;
    public $bd_nota100;
    public $bd_nota50;
    public $bd_nota20;
    public $bd_nota10;
    public $bd_nota5;
    public $bd_nota2;
    public $bd_moeda100;
    public $bd_moeda50;
    public $bd_moeda25;
    public $bd_moeda10;
    public $bd_moeda5;
    public $bd_moeda1;

    public $caixa = [];
    public $caixaId;
    public $modal_type;
    public $tab_active = 'tab-caixa';
    
    
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

        $caixa = DBCaixa::create([
            'id_banco'                      => $this->bd_id_banco,
            'id_usuario_abertura'           => $this->bd_id_usuario_abertura,
            'vlr_abertura'                  => $this->bd_vlr_abertura,
            'vlr_fechamento'                => $this->bd_vlr_fechamento,
            'status'                        => $this->bd_status,
            'dt_abertura'                   => $this->bd_dt_abertura,
            'dt_fechamento'                 => $this->bd_dt_fechamento,
            'dt_validacao'                  => $this->bd_dt_validacao,
            'id_usuario_validacao'          => $this->bd_id_usuario_validacao,
            'nota200'                       => $this->bd_nota200,
            'nota100'                       => $this->bd_nota100,
            'nota50'                        => $this->bd_nota50,
            'nota20'                        => $this->bd_nota20,
            'nota10'                        => $this->bd_nota10,
            'nota5'                         => $this->bd_nota5,
            'nota2'                         => $this->bd_nota2,
            'moeda100'                      => $this->bd_moeda100,
            'moeda50'                       => $this->bd_moeda50,
            'moeda25'                       => $this->bd_moeda25,
            'moeda10'                       => $this->bd_moeda10,
            'moeda5'                        => $this->bd_moeda5,
            'moeda1'                        => $this->bd_moeda1,
        ]);

        if($this->foto)
        {
            $nomearquivo = $caixa->id.'.png';

            $img = Image::make($this->foto);
            $img->resize(320, 320);
            $img->save('stg/img/prod/' . $nomearquivo);
        }

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Serviço cadastrada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('caixaId');
        $this->closeModal();
    }

    public function editar($id)
    {
        $caixa = DBCaixa::findOrFail($id);
        $this->caixaId                          = $id;
        $this->bd_id_banco                      = $caixa->id_banco;
        $this->bd_id_usuario_abertura           = $caixa->id_usuario_abertura;
        $this->bd_vlr_abertura                  = $caixa->vlr_abertura;
        $this->bd_vlr_fechamento                = $caixa->vlr_fechamento;
        $this->bd_status                        = $caixa->status;
        $this->bd_dt_abertura                   = $caixa->dt_abertura;
        $this->bd_dt_fechamento                 = $caixa->dt_fechamento;
        $this->bd_dt_validacao                  = $caixa->dt_validacao;
        $this->bd_id_usuario_validacao          = $caixa->id_usuario_validacao;
        $this->bd_nota200                       = $caixa->nota200;
        $this->bd_nota100                       = $caixa->nota100;
        $this->bd_nota50                        = $caixa->nota50;
        $this->bd_nota20                        = $caixa->nota20;
        $this->bd_nota10                        = $caixa->nota10;
        $this->bd_nota5                         = $caixa->nota5;
        $this->bd_nota2                         = $caixa->nota2;
        $this->bd_moeda100                      = $caixa->moeda100;
        $this->bd_moeda50                       = $caixa->moeda50;
        $this->bd_moeda25                       = $caixa->moeda25;
        $this->bd_moeda10                       = $caixa->moeda10;
        $this->bd_moeda5                        = $caixa->moeda5;
        $this->bd_moeda1                        = $caixa->moeda1;
        
        $this->atualizarValores();
        $this->openModal('editar');
    }

    public function atualizar()
    {
        if ($this->caixaId)
        {
            $caixa = DBCaixa::findOrFail($this->caixaId);
            $caixa->update([
                'id_banco'                      => $this->bd_id_banco,
                'id_usuario_abertura'           => $this->bd_id_usuario_abertura,
                'vlr_abertura'                  => $this->bd_vlr_abertura,
                'vlr_fechamento'                => $this->bd_vlr_fechamento,
                'status'                        => $this->bd_status,
                'dt_abertura'                   => $this->bd_dt_abertura,
                'dt_fechamento'                 => $this->bd_dt_fechamento,
                'dt_validacao'                  => $this->bd_dt_validacao,
                'id_usuario_validacao'          => $this->bd_id_usuario_validacao,
                'nota200'                       => $this->bd_nota200,
                'nota100'                       => $this->bd_nota100,
                'nota50'                        => $this->bd_nota50,
                'nota20'                        => $this->bd_nota20,
                'nota10'                        => $this->bd_nota10,
                'nota5'                         => $this->bd_nota5,
                'nota2'                         => $this->bd_nota2,
                'moeda100'                      => $this->bd_moeda100,
                'moeda50'                       => $this->bd_moeda50,
                'moeda25'                       => $this->bd_moeda25,
                'moeda10'                       => $this->bd_moeda10,
                'moeda5'                        => $this->bd_moeda5,
                'moeda1'                        => $this->bd_moeda1,
            ]);

            if($this->foto)
            {
                $nomearquivo = $caixa->id.'.png';

                $img = Image::make($this->foto);
                $img->resize(320, 320);
                $img->save('stg/img/prod/' . $nomearquivo);
            }

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Serviço atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }
    
    public function mostrar($id)
    {        
        $caixa = DBCaixa::findOrFail($id);
        $this->caixaId                          = $id;
        $this->bd_id_banco                      = $caixa->id_banco;
        $this->bd_id_usuario_abertura           = $caixa->id_usuario_abertura;
        $this->bd_vlr_abertura                  = $caixa->vlr_abertura;
        $this->bd_vlr_fechamento                = $caixa->vlr_fechamento;
        $this->bd_status                        = $caixa->status;
        $this->bd_dt_abertura                   = $caixa->dt_abertura;
        $this->bd_dt_fechamento                 = $caixa->dt_fechamento;
        $this->bd_dt_validacao                  = $caixa->dt_validacao;
        $this->bd_id_usuario_validacao          = $caixa->id_usuario_validacao;
        $this->bd_nota200                       = $caixa->nota200;
        $this->bd_nota100                       = $caixa->nota100;
        $this->bd_nota50                        = $caixa->nota50;
        $this->bd_nota20                        = $caixa->nota20;
        $this->bd_nota10                        = $caixa->nota10;
        $this->bd_nota5                         = $caixa->nota5;
        $this->bd_nota2                         = $caixa->nota2;
        $this->bd_moeda100                      = $caixa->moeda100;
        $this->bd_moeda50                       = $caixa->moeda50;
        $this->bd_moeda25                       = $caixa->moeda25;
        $this->bd_moeda10                       = $caixa->moeda10;
        $this->bd_moeda5                        = $caixa->moeda5;
        $this->bd_moeda1                        = $caixa->moeda1;
        
        $this->atualizarValores();
        $this->openModal('mostrar');
    }

    public function remover($id)
    {
        $caixa = DBCaixa::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $caixa->nome,
            'text'         => 'Tem certeza que quer deletar a serviço?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $caixa->id,
        ]);
    }

    public function deletar($id)
    {
        $caixa = DBCaixa::find($id);

        $filePath = public_path("stg/img/prod/{$caixa->id}.png");
        if (file_exists($filePath))
        {
            unlink($filePath);
            $texto = 'Caixa e foto deletada com sucesso!';
        }

        $caixa->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Serviço deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('caixaId');
    }

    public function listar()
    {
        $caixas = DBCaixa::
                            procurar($this->pesquisar)->
                            orderByRaw("FIELD(status, 'Aberto', 'Fechado', 'Validado', 'Teste') ASC")->
                            orderBy('dt_abertura' , 'ASC')->
                            paginate(10);

        return $caixas;
    }

    public function render()
    {
        $caixas = $this->listar();

        return view('livewire/pdv/caixa/index', [
            'caixas' => $caixas,
        ])->layout('layouts/app');
    }
}
