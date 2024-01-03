<?php

namespace App\Livewire\Atendimento\Agendamento;

use App\Models\Atendimento\Agendamento as DBAgendamento;
use App\Models\Atendimento\AgendaOrdem as DBAgendaOrdem;
use Livewire\Component;
use Intervention\Image\Facades\Image;

class Criar extends Component
{
    protected $listeners = [
        'adsasdas'        => 'aaaa'
    ];

    protected $rules = [
        'bd_start' => 'required',
        'bd_id_profexec' => 'required',
    ];

    public function aaaa($type)
    {
        dd(34443111);
    }

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

    public function criar( $informacoes )
    {
        dd(
            $this->dispatch('modalAberto', ['tipoModal' => 111])->to(Dashboard::class)
        );
        // $this->bd_id               = null ;
        // $this->bd_id_empresa       = 1 ;
        $this->bd_start            = \Carbon\Carbon::parse($informacoes['start']);
        $this->bd_end              = \Carbon\Carbon::parse($informacoes['end']);
        $this->bd_duracao          = $this->bd_start->diff($this->bd_end)->format('%H:%I:%S');
        // $this->bd_id_cliente       = null ;
        $this->bd_id_profexec      = $informacoes['resource']['id'];
        // $this->bd_id_servprod      = null ;
        // $this->bd_id_comanda       = null ;
        // $this->bd_valor            = null ;
        // $this->bd_id_criador       = null ;
        // $this->bd_obs              = null ;
        // $this->bd_status           = null ;
        // $this->bd_id_venda_detalhe = null ;
        // $this->bd_prc_comissao     = null ;
        // $this->bd_vlr_comissao     = null ;
        // $this->bd_grupo            = null ;
    
// resource
//     id
//     title
//     extendedProps
//         ordem
//         area
//         src_foto
// start
// end
// startStr
// endStr
// allDay

    
        $this->reset();
        $this->openModal('criar');
    }

    public function gravar()
    {
        // $this->validate();

        $agendamento = DBAgendamento::create([
            'id_empresa'       => $this->bd_id_empresa,
            'start'            => $this->bd_start,
            'end'              => $this->bd_end,
            'id_cliente'       => $this->bd_id_cliente,
            'id_profexec'      => $this->bd_id_profexec,
            'id_servprod'      => $this->bd_id_servprod,
            'id_comanda'       => $this->bd_id_comanda,
            'valor'            => $this->bd_valor,
            'id_criador'       => $this->bd_id_criador,
            'obs'              => $this->bd_obs,
            'status'           => $this->bd_status,
            'id_venda_detalhe' => $this->bd_id_venda_detalhe,
            'prc_comissao'     => $this->bd_prc_comissao,
            'vlr_comissao'     => $this->bd_vlr_comissao,
            'grupo'            => $this->bd_grupo,
        ]);

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Agendamento cadastrado com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('agendamentoId');
        $this->closeModal();
    }

    public function editar($id)
    {
        $agendamento = DBAgendamento::findOrFail($id);
        $this->agendamentoId                        = $id;
        $this->foto                             = $agendamento->srcFoto;
        $this->bd_nome                          = $agendamento->nome;
        $this->bd_tipo                          = $agendamento->tipo;
        $this->bd_ativo                         = $agendamento->ativo;
        $this->bd_id_categoria                  = $agendamento->id_categoria;
        $this->bd_tipo_preco                    = $agendamento->tipo_preco;
        $this->bd_vlr_venda                     = $agendamento->vlr_venda;
        $this->bd_vlr_cst_adicional                 = $agendamento->vlr_cst_adicional;
        $this->bd_tipo_comissao                 = $agendamento->tipo_comissao;
        $this->bd_prc_comissao                  = $agendamento->prc_comissao;
        $this->bd_tempo_retorno                 = $agendamento->tempo_retorno;
        $this->bd_duracao                       = $agendamento->duracao;
        $this->bd_fidelidade_pontos_ganhos      = $agendamento->fidelidade_pontos_ganhos;
        $this->bd_fidelidade_pontos_necessarios = $agendamento->fidelidade_pontos_necessarios;
        $this->bd_unidade                       = $agendamento->unidade;
        $this->bd_marca                         = $agendamento->marca;
        $this->bd_cod_nota                      = $agendamento->cod_nota;
        $this->bd_cod_barras                    = $agendamento->cod_barras;
        $this->bd_estoque_min                   = $agendamento->estoque_min;
        $this->bd_estoque_max                   = $agendamento->estoque_max;
        $this->bd_ncm_prod_serv                 = $agendamento->ncm_prod_serv;
        $this->bd_ipi_prod_serv                 = $agendamento->ipi_prod_serv;
        $this->bd_icms_prod_serv                = $agendamento->icms_prod_serv;
        $this->bd_simples_prod_serv             = $agendamento->simples_prod_serv;
        // $this->bd_vlr_mercado                   = $agendamento->vlr_mercado;
        $this->bd_vlr_nota                      = $agendamento->vlr_nota;
        $this->bd_vlr_frete                     = $agendamento->vlr_frete;
        $this->bd_vlr_impostos                  = $agendamento->vlr_impostos;
        $this->bd_vlr_comissao                  = $agendamento->vlr_comissao;
        $this->bd_vlr_custo_comissao            = $agendamento->vlr_custo_comissao;
        $this->bd_vlr_marg_contribuicao         = $agendamento->vlr_marg_contribuicao;
        $this->bd_marg_contribuicao             = $agendamento->marg_contribuicao;
        $this->bd_vlr_custo                     = $agendamento->vlr_custo;
        $this->bd_vlr_custo_estoque             = $agendamento->vlr_custo_estoque;
        $this->bd_margem_custo                  = $agendamento->margem_custo;
        $this->bd_consumo_medio                 = $agendamento->consumo_medio;
        $this->bd_cmv_prod_serv                 = $agendamento->cmv_prod_serv;
        $this->bd_curva_abc                     = $agendamento->curva_abc;
        $this->bd_id_fornecedor                 = $agendamento->id_fornecedor;
        $this->bd_descricao                     = $agendamento->descricao;
        $this->bd_status                        = $agendamento->status;
        
        $this->atualizarValores();
        $this->openModal('editar');
    }

    public function atualizar()
    {
        if ($this->agendamentoId)
        {
            $agendamento = DBAgendamento::findOrFail($this->agendamentoId);
            $agendamento->update([
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
                $nomearquivo = $agendamento->id.'.png';

                $img = Image::make($this->foto);
                $img->resize(320, 320);
                $img->save('stg/img/prod/' . $nomearquivo);
            }

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Agendamento atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }
    
    public function mostrar($id)
    {        
        $agendamento = DBAgendamento::findOrFail($id);
        $this->agendamento                          = $agendamento;
        $this->agendamentoId                        = $id;
        $this->foto                             = $agendamento->srcFoto;
        $this->bd_nome                          = $agendamento->nome;
        $this->bd_tipo                          = $agendamento->tipo;
        $this->bd_ativo                         = $agendamento->ativo;
        $this->bd_id_categoria                  = $agendamento->id_categoria;
        $this->bd_tipo_preco                    = $agendamento->tipo_preco;
        $this->bd_vlr_venda                     = $agendamento->vlr_venda;
        $this->bd_vlr_cst_adicional                 = $agendamento->vlr_cst_adicional;
        $this->bd_tipo_comissao                 = $agendamento->tipo_comissao;
        $this->bd_prc_comissao                  = $agendamento->prc_comissao;
        $this->bd_tempo_retorno                 = $agendamento->tempo_retorno;
        $this->bd_duracao                       = $agendamento->duracao;
        $this->bd_fidelidade_pontos_ganhos      = $agendamento->fidelidade_pontos_ganhos;
        $this->bd_fidelidade_pontos_necessarios = $agendamento->fidelidade_pontos_necessarios;
        $this->bd_unidade                       = $agendamento->unidade;
        $this->bd_marca                         = $agendamento->marca;
        $this->bd_cod_nota                      = $agendamento->cod_nota;
        $this->bd_cod_barras                    = $agendamento->cod_barras;
        $this->bd_estoque_min                   = $agendamento->estoque_min;
        $this->bd_estoque_max                   = $agendamento->estoque_max;
        $this->bd_ncm_prod_serv                 = $agendamento->ncm_prod_serv;
        $this->bd_ipi_prod_serv                 = $agendamento->ipi_prod_serv;
        $this->bd_icms_prod_serv                = $agendamento->icms_prod_serv;
        $this->bd_simples_prod_serv             = $agendamento->simples_prod_serv;
        // $this->bd_vlr_mercado                   = $agendamento->vlr_mercado;
        $this->bd_vlr_nota                      = $agendamento->vlr_nota;
        $this->bd_vlr_frete                     = $agendamento->vlr_frete;
        $this->bd_vlr_impostos                  = $agendamento->vlr_impostos;
        $this->bd_vlr_comissao                  = $agendamento->vlr_comissao;
        $this->bd_vlr_custo_comissao            = $agendamento->vlr_custo_comissao;
        $this->bd_vlr_marg_contribuicao         = $agendamento->vlr_marg_contribuicao;
        $this->bd_marg_contribuicao             = $agendamento->marg_contribuicao;
        $this->bd_vlr_custo                     = $agendamento->vlr_custo;
        $this->bd_vlr_custo_estoque             = $agendamento->vlr_custo_estoque;
        $this->bd_margem_custo                  = $agendamento->margem_custo;
        $this->bd_consumo_medio                 = $agendamento->consumo_medio;
        $this->bd_cmv_prod_serv                 = $agendamento->cmv_prod_serv;
        $this->bd_curva_abc                     = $agendamento->curva_abc;
        $this->bd_id_fornecedor                 = $agendamento->id_fornecedor;
        $this->bd_descricao                     = $agendamento->descricao;
        $this->bd_status                        = $agendamento->status;
        
        $this->atualizarValores();
        $this->openModal('mostrar');
    }

    public function remover($id)
    {
        $agendamento = DBAgendamento::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $agendamento->nome,
            'text'         => 'Tem certeza que quer deletar a agendamento?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $agendamento->id,
        ]);
    }

    public function deletar($id)
    {
        $agendamento = DBAgendamento::find($id);

        $filePath = public_path("stg/img/prod/{$agendamento->id}.png");
        if (file_exists($filePath))
        {
            unlink($filePath);
            $texto = 'Agendamento e foto deletada com sucesso!';
        }

        $agendamento->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Agendamento deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('agendamentoId');
    }

    public function listar()
    {
        $agendamentos = DBAgendamento::
                            procurar($this->pesquisar)->
                            paginate(10);

        return $agendamentos;
    }

    public function ordenar()
    {
        $ordem = DBAgendaOrdem::
                                select('ordem', 'area', 'id_pessoa' )->
                                where('auth_user', '=', auth()->User()->id)->
                                with('oewoekdwjzsdlkd')->
                                get();

        $this->ordem = $ordem;
    }

    public function parceiros()
    {
        $ordem = $this->ordem;

        $resources = $ordem->map( function ($item, $key)
        {
            return [ 
                'id'       => $item['id_pessoa'],
                'ordem'    => $item['ordem'],
                'area'     => $item['area'],
                'title'    => $item['oewoekdwjzsdlkd']['apelido'],
                'src_foto' => $item['oewoekdwjzsdlkd']['src_foto'],
            ];
        });

        $this->resources = $resources->toJson();
    }

    public function eventos()
    {
        $start  = (!empty($request->start)) ? ($request->start) : ('');
        $end    = (!empty($request->end)) ? ($request->end) : ('');
        
        $start  = \Carbon\Carbon::today()->startOfDay();
        $end    = \Carbon\Carbon::today()->endOfDay();
        
        $returnedColumns = [
            'id',
            'start',
            'end',
            'id_cliente',
            'id_profexec',
            'id_servprod',
            'id_comanda',
            'valor',
            'obs',
            'status',
            // 'title',
            // 'resourceId'
        ];

        $events = DBAgendamento::
                                whereBetween('start', [ $start, $end ])->
                                where('id_profexec', '=', [ array_column($this->ordem->toArray(), 'id_pessoa') ])->
                                get($returnedColumns);

        $this->events = $events->toJson();
    }

    public function mount()
    {
        $this->ordenar();
        $this->parceiros();
        $this->eventos();
    }
    
    public function render()
    {
        return view('livewire/atendimento/agendamento/index')->layout('layouts/app');
    }
}
