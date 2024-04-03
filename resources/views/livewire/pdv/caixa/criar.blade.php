@if ( $modal_type == 'criar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <form wire:submit.prevent="gravar">
                <div class="modal-header border-bottom-0 py-2 px-0">
                    <ul class="nav nav-tabs w-100">
                        <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Cadastrar novo serviço</h3>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab_active == 'tab-caixa' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-caixa" wire:click="tabActive('tab-caixa')">Serviço</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade {{ $tab_active == 'tab-caixa' ? 'show active' : '' }}" id="tab-caixa">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Sobre o serviço</label>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_tipo">Tipo</label>
                                                    <select class="form-control form-control-sm @error('bd_tipo') is-invalid @enderror" wire:model="bd_tipo" disabled="disabled">
                                                        <option value="Serviço">Serviço</option>
                                                        <option value="Produto">Produto</option>
                                                    </select>
                                                    @error('bd_tipo')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                        
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="bd_nome">Nome</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_nome') is-invalid @enderror" wire:model="bd_nome" placeholder="Nome">
                                                    @error('bd_nome')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <x-catalogo.categorias-select col="2" label="Categoria" name="bd_id_categoria" tipo="Serviço" />

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label><br/>
                                                    <div class="form-check">
                                                        <input type="checkbox" @error('bd_ativo') is-invalid @enderror id="bd_ativo" wire:model="bd_ativo" checked="checked">
                                                        <label class="" for="bd_ativo">&nbsp;Ativo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="bd_descricao">Descrição</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_descricao') is-invalid @enderror" wire:model="bd_descricao" placeholder="Descrição">
                                                    @error('bd_descricao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            
                                            <x-atendimento.pessoa.pessoas-select col="2" label="Fornecedor" name="bd_id_fornecedor" filtro="Fornecedor" />

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_unidade">Unidade</label>
                                                    <select class="form-control form-control-sm @error('bd_unidade') is-invalid @enderror" wire:model="bd_unidade">
                                                        <option value="Unidade">Unidade</option>
                                                        <option value="Frasco">Frasco</option>
                                                        <option value="Kilos">Kilos</option>
                                                        <option value="Gramas">Gramas</option>
                                                        <option value="Litros">Litros</option>
                                                        <option value="Mililitros">Mililitros</option>
                                                    </select>

                                                    @error('bd_unidade')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_ncm_prod_serv">NCM</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_ncm_prod_serv') is-invalid @enderror" wire:model="bd_ncm_prod_serv" placeholder="NCM">
                                                    @error('bd_ncm_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_cod_nota">Cód. Nota</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_cod_nota') is-invalid @enderror" wire:model="bd_cod_nota" placeholder="Cód. Nota">
                                                    @error('bd_cod_nota')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_cod_barras">Cód. Barras</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_cod_barras') is-invalid @enderror" wire:model="bd_cod_barras" placeholder="Cód. Barras">
                                                    @error('bd_cod_barras')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_estoque_min">Estoque Mínimo</label>
                                                    <input type="text" class="form-control form-control-sm text-center @error('bd_estoque_min') is-invalid @enderror" wire:model="bd_estoque_min" placeholder="estoque_min">
                                                    @error('bd_estoque_min')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_estoque_max">Estoque Máximo</label>
                                                    <input type="text" class="form-control form-control-sm text-center @error('bd_estoque_max') is-invalid @enderror" wire:model="bd_estoque_max" placeholder="estoque_max">
                                                    @error('bd_estoque_max')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tab_active == 'tab-valores' ? 'show active' : '' }}" id="tab-valores">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Valores de preço</label>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_tipo_preco">Tipo de preço</label>
                                                    <select class="form-control form-control-sm @error('bd_tipo_preco') is-invalid @enderror" wire:model="bd_tipo_preco">
                                                        <option value="Preço fixo">Preço fixo</option>
                                                        <option value="Preço variável">Preço variável</option>
                                                    </select>
                                                    @error('bd_tipo_preco')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_venda">Venda</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_venda') is-invalid @enderror" wire:model="bd_vlr_venda" placeholder="0">
                                                    @error('bd_vlr_venda')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <label>Valores de custo</label>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_nota">Custos do serviço</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_nota') is-invalid @enderror" wire:model="bd_vlr_nota" wire:change="atualizarValores">
                                                    @error('bd_vlr_nota')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_impostos">Impostos</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_impostos') is-invalid @enderror" wire:model="bd_vlr_impostos" wire:change="atualizarValores">
                                                    @error('bd_vlr_impostos')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_custo_comissao">Custo com comissão</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_custo_comissao') is-invalid @enderror" wire:model="bd_vlr_custo_comissao" wire:change="atualizarValores">
                                                    @error('bd_vlr_custo_comissao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_cst_adicional">Custo adicional</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_cst_adicional') is-invalid @enderror" wire:model="bd_vlr_cst_adicional" wire:change="atualizarValores">
                                                    @error('bd_vlr_cst_adicional')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_custo">Custo Total</label>
                                                    <span class="form-control form-control-sm text-right" readonly>{{ $bd_vlr_custo ?? 0 }}</span>
                                                    @error('bd_vlr_custo')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            {{-- <x-adminlte.form.input.text col="2" label="Mercado" name="bd_vlr_mercado" class="text-right" /> --}}
                                        </div>
                                    </li>
                                    <br>
                                    <label>Valores de comissão</label>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_tipo_comissao">Tipo de comissão</label>
                                                    <select class="form-control form-control-sm @error('bd_tipo_comissao') is-invalid @enderror" wire:model.live="bd_tipo_comissao">
                                                        <option value="Valor fixo">Valor fixo</option>
                                                        <option value="% Venda">% Venda</option>
                                                        <option value="% Lucro">% Lucro</option>
                                                    </select>
                                                    @error('bd_tipo_comissao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            @if ('Ativar despois q corrigir partes de ipi, icms, simples, etc.' == 1)
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_ipi_prod_serv">ipi_prod_serv</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_ipi_prod_serv') is-invalid @enderror" wire:model="bd_ipi_prod_serv" placeholder="ipi_prod_serv">
                                                    @error('bd_ipi_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_icms_prod_serv">icms_prod_serv</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_icms_prod_serv') is-invalid @enderror" wire:model="bd_icms_prod_serv" placeholder="icms_prod_serv">
                                                    @error('bd_icms_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_simples_prod_serv">simples_prod_serv</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_simples_prod_serv') is-invalid @enderror" wire:model="bd_simples_prod_serv" placeholder="simples_prod_serv">
                                                    @error('bd_simples_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                            @endif
                                            
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tab_active == 'tab-prog_fidelidade' ? 'show active' : '' }}" id="tab-prog_fidelidade">
                            <div class="row">
                                <ul class="todo-list">
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_fidelidade_pontos_ganhos">Pontos ganhos</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_fidelidade_pontos_ganhos') is-invalid @enderror" wire:model="bd_fidelidade_pontos_ganhos" placeholder="0">
                                                    @error('bd_fidelidade_pontos_ganhos')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_fidelidade_pontos_necessarios">Pontos necessários</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_fidelidade_pontos_necessarios') is-invalid @enderror" wire:model="bd_fidelidade_pontos_necessarios" placeholder="0">
                                                    @error('bd_fidelidade_pontos_necessarios')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if(1==2)
                        <div class="tab-pane fade {{ $tab_active == 'tab-indicadores' ? 'show active' : '' }}" id="tab-indicadores">
                            <div class="row">
                                <ul class="todo-list">
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_tempo_retorno">tempo_retorno</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_tempo_retorno') is-invalid @enderror" wire:model="bd_tempo_retorno" placeholder="tempo_retorno">
                                                    @error('bd_tempo_retorno')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_consumo_medio">consumo_medio</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_consumo_medio') is-invalid @enderror" wire:model="bd_consumo_medio" placeholder="consumo_medio">
                                                    @error('bd_consumo_medio')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_curva_abc">curva_abc</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_curva_abc') is-invalid @enderror" wire:model="bd_curva_abc" placeholder="curva_abc">
                                                    @error('bd_curva_abc')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_cmv_prod_serv">cmv_prod_serv</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_cmv_prod_serv') is-invalid @enderror" wire:model="bd_cmv_prod_serv" placeholder="cmv_prod_serv">
                                                    @error('bd_cmv_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_marg_contribuicao">Margem de contribuição</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_marg_contribuicao') is-invalid @enderror" wire:model="bd_vlr_marg_contribuicao" placeholder="0">
                                                    @error('bd_vlr_marg_contribuicao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_marg_contribuicao">marg_contribuicao</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_marg_contribuicao') is-invalid @enderror" wire:model="bd_marg_contribuicao" placeholder="marg_contribuicao">
                                                    @error('bd_marg_contribuicao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_margem_custo">margem_custo</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_margem_custo') is-invalid @enderror" wire:model="bd_margem_custo" placeholder="margem_custo">
                                                    @error('bd_margem_custo')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
    
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_vlr_custo_estoque">Custo Estoque</label>
                                                    <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_custo_estoque') is-invalid @enderror" wire:model="bd_vlr_custo_estoque" placeholder="Custo Estoque">
                                                    @error('bd_vlr_custo_estoque')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="bd_status">status</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_status') is-invalid @enderror" wire:model="bd_status" placeholder="status">
                                                    @error('bd_status')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="tab-pane fade {{ $tab_active == 'tab-foto' ? 'show active' : '' }}" id="tab-foto">
                            <div class="row">
                                <ul class="todo-list">
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="text-center">
                                                    @php($foto = $foto ?? asset('stg/img/empresa/logo.png'))
                                                    <img src="{{ is_string($foto) ? $foto : $foto->temporaryUrl() }}" class="img-circle" style="border: solid 1px #7e7e7e; width: 320px; height: 320px">
                                                </div>
                                            </div>
                                            <div class="col-6 align-self-center">
                                                <input type="file" wire:model="foto" class="btn btn-secondary col start">
                                                <span class="text-danger">@error('foto') {{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default mt-4" wire:click="closeModal" style="margin-top: 0px !important;">Cancelar</button>
                    <button type="submit" class="btn btn-secondary mt-4" style="margin-top: 0px !important;">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
