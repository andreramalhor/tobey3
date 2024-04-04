@if ( $modal_type == 'mostrar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="modal-header border-bottom-0 py-2 px-0">
                <ul class="nav nav-tabs w-100">
                    <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Condomínio:  {{ $bd_nome }}</h3>
                    <li class="nav-item">
                        <a class="nav-link {{ $tab_active == 'tab-servico' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-servico" wire:click="tabActive('tab-servico')">Condomínio</a>
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
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade {{ $tab_active == 'tab-servico' ? 'show active' : '' }}" id="tab-servico">
                        <div class="row">
                            <ul class="todo-list">
                                <label>Condomínio</label>
                                <li>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="bd_nome">Nome</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_nome') is-invalid @enderror" wire:model="bd_nome" disabled="disabled">
                                                @error('bd_nome')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="bd_cnpj">CNPJ</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_cnpj') is-invalid @enderror" wire:model="bd_cnpj" disabled="disabled">
                                                @error('bd_cnpj')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <label>Contato</label>
                                <li>
                                    <div class="row">
                                        
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="bd_ddd">DDD</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_ddd') is-invalid @enderror" wire:model="bd_ddd" disabled="disabled">
                                                @error('bd_ddd')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="bd_telefone">Telefone</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_telefone') is-invalid @enderror" wire:model="bd_telefone" disabled="disabled">
                                                @error('bd_telefone')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br>
                                <label>Endereço</label>
                                <li>
                                    <div class="row">
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_cep">CEP</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_cep') is-invalid @enderror" wire:model="bd_cep" disabled="disabled">
                                                @error('bd_cep')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="bd_logradouro">Logradouro</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_logradouro') is-invalid @enderror" wire:model="bd_logradouro" disabled="disabled">
                                                @error('bd_logradouro')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="bd_numero">Núm</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_numero') is-invalid @enderror" wire:model="bd_numero" disabled="disabled">
                                                @error('bd_numero')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label for="bd_coplemento">Complemento</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_coplemento') is-invalid @enderror" wire:model="bd_coplemento" disabled="disabled">
                                                @error('bd_coplemento')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_bairro">Bairro</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_bairro') is-invalid @enderror" wire:model="bd_bairro" disabled="disabled">
                                                @error('bd_bairro')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="bd_cidade">Cidade</label>
                                                <input type="text" class="form-control form-control-sm @error('bd_cidade') is-invalid @enderror" wire:model="bd_cidade" disabled="disabled">
                                                @error('bd_cidade')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                            </div>
                                        </div>
                                        
                                        <x-adminlte.form.input.select col="1" label="UF" name="uf" placeholder="UF" >
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AP">AP</option>
                                            <option value="AM">AM</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MT">MT</option>
                                            <option value="MS">MS</option>
                                            <option value="MG" selected>MG</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PR">PR</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SP">SP</option>
                                            <option value="SE">SE</option>
                                            <option value="TO">TO</option>
                                        </x-adminlte.form.input.select>                                            
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
                                        <span class="info-box-number text-center text-muted mb-0">{{ 0 }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Média de valor cobrado</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format(0 , 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor bruto arrecadado</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format(0, 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor custo bruto</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format(0, 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimativa de lucro</span>
                                        <span class="info-box-number text-center text-muted mb-0">R$ {{ number_format( 0, 2, ',', '.') }}</span>
                                        <span class="info-box-text text-center text-muted"><small>Custo informado: R$ {{ $condominio->vlr_custo ?? 0 }}</small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Consumo médio</span>
                                        <span class="info-box-number text-center text-muted mb-0"></span>
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
                                                <span class="form-control form-control-sm text-right" readonly>{{ $bd_vlr_custo ?? 0}}</span>
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
