@if ( $modal_type == 'mostrar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="modal-header border-bottom-0 py-2 px-0">
                <ul class="nav nav-tabs w-100">
                    <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Serviço:  {{ $bd_nome }}</h3>
                    <li class="nav-item">
                        <a class="nav-link {{ $tab_active == 'tab-servico' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-servico" wire:click="tabActive('tab-servico')">Serviço</a>
                    </li>
                    @if ( $modal_type == 'mostrar' )
                    <li class="nav-item">
                        <a class="nav-link {{ $tab_active == 'tab-indicadores' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-indicadores" wire:click="tabActive('tab-indicadores')">Indicadores</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $tab_active == 'tab-valores' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-valores" wire:click="tabActive('tab-valores')">Valores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $tab_active == 'tab-prog_fidelidade' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-prog_fidelidade" wire:click="tabActive('tab-prog_fidelidade')">Prog. Fidelidade</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link {{ $tab_active == 'tab-foto' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-foto" wire:click="tabActive('tab-foto')">Foto</a>
                    </li>
                </ul>
            </div>
            @php( $vlr_custo_bruto = $servico->rfidfugoduhoehn->sum('quantidade') * str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $servico->vlr_custo))) )
            @php( $vlr_arrecadado  = $servico->rfidfugoduhoehn->sum('vlr_final'))
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade {{ $tab_active == 'tab-servico' ? 'show active' : '' }}" id="tab-servico">
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
                                                <input type="text" class="form-control form-control-sm @error('bd_nome') is-invalid @enderror" wire:model="bd_nome" placeholder="Nome" disabled="disabled">
                                                @error('bd_nome')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <x-catalogo.categorias-select col="2" label="Categoria" name="bd_id_categoria" tipo="Serviço" disabled="disabled" />

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label><br/>
                                                <div class="form-check">
                                                    <input type="checkbox" @error('bd_ativo') is-invalid @enderror id="bd_ativo" wire:model="bd_ativo" checked="checked" disabled="disabled">
                                                    <label class="" for="bd_ativo">&nbsp;Ativo</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bd_descricao">Descrição</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_descricao') is-invalid @enderror" wire:model="bd_descricao" placeholder="Descrição" disabled="disabled">
                                                @error('bd_descricao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        
                                        @if($bd_tipo == 'Produto')
                                        {{-- Produto --}}
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_marca">Marca</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_marca') is-invalid @enderror" wire:model="bd_marca" placeholder="Marca" disabled="disabled">
                                                @error('bd_marca')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <x-atendimento.pessoa.pessoas-select col="2" label="Fornecedor" name="bd_id_fornecedor" filtro="Fornecedor" />

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_unidade">Unidade</label>
                                                <select class="form-control form-control-sm @error('bd_unidade') is-invalid @enderror" wire:model="bd_unidade" disabled="disabled">
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
                                                <input type="text" class="form-control form-control-sm @error('bd_ncm_prod_serv') is-invalid @enderror" wire:model="bd_ncm_prod_serv" placeholder="NCM" disabled="disabled">
                                                @error('bd_ncm_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_cod_nota">Cód. Nota</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_cod_nota') is-invalid @enderror" wire:model="bd_cod_nota" placeholder="Cód. Nota" disabled="disabled">
                                                @error('bd_cod_nota')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_cod_barras">Cód. Barras</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_cod_barras') is-invalid @enderror" wire:model="bd_cod_barras" placeholder="Cód. Barras" disabled="disabled">
                                                @error('bd_cod_barras')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_estoque_min">Estoque Mínimo</label>
                                                <input type="text" class="form-control form-control-sm text-center @error('bd_estoque_min') is-invalid @enderror" wire:model="bd_estoque_min" placeholder="estoque_min" disabled="disabled">
                                                @error('bd_estoque_min')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_estoque_max">Estoque Máximo</label>
                                                <input type="text" class="form-control form-control-sm text-center @error('bd_estoque_max') is-invalid @enderror" wire:model="bd_estoque_max" placeholder="estoque_max" disabled="disabled">
                                                @error('bd_estoque_max')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        @elseif($bd_tipo == 'Serviço')
                                        {{-- Serviço --}}
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_duracao">Tempo de execução</label>
                                                <input type="text" class="form-control form-control-sm text-center tempo @error('bd_duracao') is-invalid @enderror" wire:model="bd_duracao" placeholder="Duração do serviço" disabled="disabled">
                                                @error('bd_duracao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if ( $modal_type == 'mostrar' )
                    <div class="tab-pane fade {{ $tab_active == 'tab-indicadores' ? 'show active' : '' }}" id="tab-indicadores">
                        <div class="row">
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Quantidade de execuções</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $servico->rfidfugoduhoehn->sum('quantidade') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Média de valor cobrado</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format($vlr_arrecadado / $servico->rfidfugoduhoehn->sum('quantidade') , 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor bruto arrecadado</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format($vlr_arrecadado, 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor custo bruto</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format($vlr_custo_bruto, 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimativa de lucro</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format( $vlr_arrecadado - $vlr_custo_bruto, 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted"><small>Custo informado: R$ {{ $servico->vlr_custo }}</small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Consumo médio</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            {{ number_format($servico->rfidfugoduhoehn->whereBetween('created_at', [ \Carbon\Carbon::now()->subDays(30), \Carbon\Carbon::now()])->sum('quantidade') / 30, 2, ',', '.' ) }} | 
                                            {{ number_format($servico->rfidfugoduhoehn->whereBetween('created_at', [ \Carbon\Carbon::now()->subDays(90), \Carbon\Carbon::now()])->sum('quantidade') / 90, 2, ',', '.' ) }}
                                        </span>
                                        <span class="info-box-text text-center text-muted">
                                            <small>30 dias | 90 dias</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Margem de lucro</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            @php( $margem_de_lucro = ( ( $vlr_arrecadado - $vlr_custo_bruto ) / $vlr_arrecadado ?? 0.001 ) * 100 )
                                            {{ number_format( $margem_de_lucro , 2, ',', '.') }} % = R$ {{ number_format( $margem_de_lucro * str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $servico->vlr_venda))) / 100, 2, ',', '.') }} 
                                        </span>
                                        <span class="info-box-text text-center text-muted">
                                            <small>Margem de Lucro (%) = ( ( Lucro - Custo ) / Lucro ) x 100</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Margem de custo</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            @php( $margem_de_custo = 100 - ( ( $vlr_arrecadado - $vlr_custo_bruto ) / $vlr_arrecadado ?? 0.001 ) * 100 )
                                            {{ number_format( $margem_de_custo , 2, ',', '.') }} % = R$ {{ number_format( $margem_de_custo * str_replace(',', '.',str_replace('.', '',str_replace('R$ ', '', $servico->vlr_venda))) / 100, 2, ',', '.') }} 
                                        </span>
                                        <span class="info-box-text text-center text-muted">
                                            <small>Margem de Custo (%) = 100 - ( ( ( Lucro - Custo ) / Lucro ) x 100 )</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if(1==2)
                            <li>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bd_tempo_retorno">tempo_retorno</label>
                                            <input type="text" class="form-control form-control-sm @error('bd_tempo_retorno') is-invalid @enderror" wire:model="bd_tempo_retorno" placeholder="tempo_retorno" disabled="disabled">
                                            @error('bd_tempo_retorno')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bd_curva_abc">curva_abc</label>
                                            <input type="text" class="form-control form-control-sm @error('bd_curva_abc') is-invalid @enderror" wire:model="bd_curva_abc" placeholder="curva_abc" disabled="disabled">
                                            @error('bd_curva_abc')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bd_cmv_prod_serv">cmv_prod_serv</label>
                                            <input type="text" class="form-control form-control-sm @error('bd_cmv_prod_serv') is-invalid @enderror" wire:model="bd_cmv_prod_serv" placeholder="cmv_prod_serv" disabled="disabled">
                                            @error('bd_cmv_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="bd_vlr_marg_contribuicao">Margem de contribuição</label>
                                            <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_marg_contribuicao') is-invalid @enderror" wire:model="bd_vlr_marg_contribuicao" placeholder="0" disabled="disabled">
                                            @error('bd_vlr_marg_contribuicao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bd_marg_contribuicao">marg_contribuicao</label>
                                            <input type="text" class="form-control form-control-sm @error('bd_marg_contribuicao') is-invalid @enderror" wire:model="bd_marg_contribuicao" placeholder="marg_contribuicao" disabled="disabled">
                                            @error('bd_marg_contribuicao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bd_margem_custo">margem_custo</label>
                                            <input type="text" class="form-control form-control-sm @error('bd_margem_custo') is-invalid @enderror" wire:model="bd_margem_custo" placeholder="margem_custo" disabled="disabled">
                                            @error('bd_margem_custo')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="bd_vlr_custo_estoque">Custo Estoque</label>
                                            <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_custo_estoque') is-invalid @enderror" wire:model="bd_vlr_custo_estoque" placeholder="Custo Estoque" disabled="disabled">
                                            @error('bd_vlr_custo_estoque')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bd_status">status</label>
                                            <input type="text" class="form-control form-control-sm @error('bd_status') is-invalid @enderror" wire:model="bd_status" placeholder="status" disabled="disabled">
                                            @error('bd_status')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="tab-pane fade {{ $tab_active == 'tab-valores' ? 'show active' : '' }}" id="tab-valores">
                        <div class="row">
                            <ul class="todo-list">
                                <label>Valores de preço</label>
                                <li>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_tipo_preco">Tipo de preço</label>
                                                <select class="form-control form-control-sm @error('bd_tipo_preco') is-invalid @enderror" wire:model="bd_tipo_preco" disabled="disabled">
                                                    <option value="Preço fixo">Preço fixo</option>
                                                    <option value="Preço variável">Preço variável</option>
                                                </select>
                                                @error('bd_tipo_preco')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_venda">Venda</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_venda') is-invalid @enderror" wire:model="bd_vlr_venda" placeholder="0" disabled="disabled">
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
                                                <label for="bd_vlr_nota">Valor do serviço</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_nota') is-invalid @enderror" wire:model="bd_vlr_nota" wire:change="atualizarValores" disabled="disabled">
                                                @error('bd_vlr_nota')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        @if($bd_tipo == 'Produto')
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_frete">Frete</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_frete') is-invalid @enderror" wire:model="bd_vlr_frete" wire:change="atualizarValores" disabled="disabled">
                                                @error('bd_vlr_frete')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_impostos">Impostos</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_impostos') is-invalid @enderror" wire:model="bd_vlr_impostos" wire:change="atualizarValores" disabled="disabled">
                                                @error('bd_vlr_impostos')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_custo_comissao">Custo com comissão</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_custo_comissao') is-invalid @enderror" wire:model="bd_vlr_custo_comissao" wire:change="atualizarValores" disabled="disabled">
                                                @error('bd_vlr_custo_comissao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_cst_adicional">Custo adicional</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_cst_adicional') is-invalid @enderror" wire:model="bd_vlr_cst_adicional" wire:change="atualizarValores" disabled="disabled">
                                                @error('bd_vlr_cst_adicional')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_custo">Custo Total</label>
                                                <span class="form-control form-control-sm text-right" readonly>{{ $bd_vlr_custo }}</span>
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
                                                <select class="form-control form-control-sm @error('bd_tipo_comissao') is-invalid @enderror" wire:model.live="bd_tipo_comissao" disabled="disabled">
                                                    <option value="Valor fixo">Valor fixo</option>
                                                    <option value="% Venda">% Venda</option>
                                                    <option value="% Lucro">% Lucro</option>
                                                </select>
                                                @error('bd_tipo_comissao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        @if($bd_tipo_comissao == '% Venda' || $bd_tipo_comissao == '% Lucro')
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_prc_comissao">Perc. comissão</label>
                                                <input type="text" class="form-control form-control-sm text-center percentual @error('bd_prc_comissao') is-invalid @enderror" wire:model="bd_prc_comissao" placeholder="0" disabled="disabled">
                                                @error('bd_prc_comissao')
                                                <div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_vlr_comissao">Valor comissão</label>
                                                <input type="text" class="form-control form-control-sm text-right dinheiro @error('bd_vlr_comissao') is-invalid @enderror" wire:model="bd_vlr_comissao" placeholder="0" disabled="disabled">
                                                @error('bd_vlr_comissao')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if ('Ativar despois q corrigir partes de ipi, icms, simples, etc.' == 1)
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_ipi_prod_serv">ipi_prod_serv</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_ipi_prod_serv') is-invalid @enderror" wire:model="bd_ipi_prod_serv" placeholder="ipi_prod_serv" disabled="disabled">
                                                @error('bd_ipi_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_icms_prod_serv">icms_prod_serv</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_icms_prod_serv') is-invalid @enderror" wire:model="bd_icms_prod_serv" placeholder="icms_prod_serv" disabled="disabled">
                                                @error('bd_icms_prod_serv')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_simples_prod_serv">simples_prod_serv</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_simples_prod_serv') is-invalid @enderror" wire:model="bd_simples_prod_serv" placeholder="simples_prod_serv" disabled="disabled">
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
                                                <input type="text" class="form-control form-control-sm @error('bd_fidelidade_pontos_ganhos') is-invalid @enderror" wire:model="bd_fidelidade_pontos_ganhos" placeholder="0" disabled="disabled">
                                                @error('bd_fidelidade_pontos_ganhos')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="bd_fidelidade_pontos_necessarios">Pontos necessários</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_fidelidade_pontos_necessarios') is-invalid @enderror" wire:model="bd_fidelidade_pontos_necessarios" placeholder="0" disabled="disabled">
                                                @error('bd_fidelidade_pontos_necessarios')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                                            <input type="file" wire:model="foto" class="btn btn-secondary col start" disabled="disabled">
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
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
