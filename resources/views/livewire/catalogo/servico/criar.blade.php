@if ( $modalType == 'criar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header border-bottom-0 py-2 px-0">
                    <ul class="nav nav-tabs w-100">
                        <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Cadastrar novo serviço</h3>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#tab-servico">Serviço</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#tab-valores">Valores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#tab-prog_fidelidade">Prog. Fidelidade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#tab-settings">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#tab-foto">Foto</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-servico">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Sobre o serviço</label>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.select col="2" label="Tipo"                        name="bd_tipo"                         disabled="disabled" >
                                                <option value="Serviço">Serviço</option>
                                                <option value="Produto">Produto</option>
                                            </x-adminlte.form.input.select>

                                            <x-adminlte.form.input.text col="4" label="Nome"                          name="bd_nome"                          placeholder="Nome" />

                                            <x-catalogo.categorias-select col="2" label="Categoria"                   name="bd_id_categoria"                  tipo="Serviço" />
                                            <x-adminlte.form.input.checkbox col="2" label="Ativo"                     name="bd_ativo"                         checked="true" />

                                            <x-adminlte.form.input.text col="12" label="Descrição"                    name="bd_descricao"                     placeholder="Descrição" />

                                            {{-- produto --}}
                                            {{-- @if($bd_tipo == 'Produto') --}}
                                            <x-adminlte.form.input.text col="3" label="marca"                         name="bd_marca"                         placeholder="marca" />
                                            <x-atendimento.pessoa.pessoas-select col="2" label="Fornecedor"           name="bd_id_fornecedor"                 filtro="Fornecedor" />
                                            <x-adminlte.form.input.text col="3" label="unidade"                       name="bd_unidade"                       placeholder="unidade" />


                                            <x-adminlte.form.input.text col="3" label="ncm_prod_serv"                 name="bd_ncm_prod_serv"                 placeholder="ncm_prod_serv" />
                                            <x-adminlte.form.input.text col="3" label="cod_nota"                      name="bd_cod_nota"                      placeholder="cod_nota" />
                                            <x-adminlte.form.input.text col="3" label="cod_barras"                    name="bd_cod_barras"                    placeholder="cod_barras" />


                                            <x-adminlte.form.input.text col="3" label="estoque_min"                   name="bd_estoque_min"                   placeholder="estoque_min" />
                                            <x-adminlte.form.input.text col="3" label="estoque_max"                   name="bd_estoque_max"                   placeholder="estoque_max" />

                                            {{-- @elseif($bd_tipo == 'Serviço') --}}
                                            {{-- serviço --}}
                                            <x-adminlte.form.input.text col="3" label="duracao"                       name="bd_duracao"                       placeholder="duracao" />

                                            {{-- @endif --}}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-valores">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Valores de preço</label>
                                    <li>
                                        <div class="row">

                                            <x-adminlte.form.input.select col="2" label="Tipo de preço"               name="bd_tipo_preco">
                                                <option value="Preço fixo">Preço fixo</option>
                                                <option value="Preço variável">Preço variável</option>
                                            </x-adminlte.form.input.select>

                                            <x-adminlte.form.input.text col="2" label="Venda"                         name="bd_vlr_venda"                     class="text-right" />
                                        </div>
                                    </li>
                                    <br>
                                    <label>Valores de custo</label>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="2" label="Custo"                         name="bd_vlr_custo"                     class="text-right" />
                                            <x-adminlte.form.input.text col="2" label="Frete"                         name="bd_vlr_frete"                     class="text-right" />

                                            <x-adminlte.form.input.text col="2" label="Impostos"                      name="bd_vlr_impostos"                  class="text-right" />
                                            <x-adminlte.form.input.text col="2" label="Custo adicional"               name="bd_cst_adicional"                 class="text-right" />
                                            <x-adminlte.form.input.text col="2" label="Valor em nota"                 name="bd_vlr_nota"                      class="text-right" />


                                            {{-- <x-adminlte.form.input.text col="2" label="Mercado"                       name="bd_vlr_mercado"                   class="text-right" /> --}}
                                        </div>
                                    </li>
                                    <br>
                                    <label>Valores de comissão</label>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.select col="2" label="Tipo de comissão"            name="bd_tipo_comissao">
                                                <option value="Valor fixo">Valor fixo</option>
                                                <option value="% Venda">% Venda</option>
                                                <option value="% Lucro">% Lucro</option>
                                            </x-adminlte.form.input.select>

                                            <x-adminlte.form.input.text col="2" label="Perc. comissão"                name="bd_prc_comissao"                  class="text-center" />
                                            <x-adminlte.form.input.text col="2" label="Valor comissão"                name="bd_vlr_comissao"                  class="text-right" />

                                            <x-adminlte.form.input.text col="2" label="ipi_prod_serv"                 name="bd_ipi_prod_serv"                 placeholder="ipi_prod_serv" />
                                            <x-adminlte.form.input.text col="2" label="icms_prod_serv"                name="bd_icms_prod_serv"                placeholder="icms_prod_serv" />
                                            <x-adminlte.form.input.text col="2" label="simples_prod_serv"             name="bd_simples_prod_serv"             placeholder="simples_prod_serv" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-prog_fidelidade">
                            <div class="row">
                                <ul class="todo-list">
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="3" label="Pontos ganhos"                 name="bd_fidelidade_pontos_ganhos"      placeholder="0" />
                                            <x-adminlte.form.input.text col="3" label="Pontos necessários"            name="bd_fidelidade_pontos_necessarios" placeholder="0" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-settings">
                            <div class="row">
                                <ul class="todo-list">
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="3" label="tempo_retorno"                 name="bd_tempo_retorno"                 placeholder="tempo_retorno" />
                                            <x-adminlte.form.input.text col="3" label="consumo_medio"                 name="bd_consumo_medio"                 placeholder="consumo_medio" />
                                            <x-adminlte.form.input.text col="3" label="curva_abc"                     name="bd_curva_abc"                     placeholder="curva_abc" />
                                            <x-adminlte.form.input.text col="3" label="cmv_prod_serv"                 name="bd_cmv_prod_serv"                 placeholder="cmv_prod_serv" />
                                            <x-adminlte.form.input.text col="2" label="Margem de contribuição"        name="bd_vlr_marg_contribuicao"         class="text-right" />
                                            <x-adminlte.form.input.text col="3" label="marg_contribuicao"             name="bd_marg_contribuicao"             placeholder="marg_contribuicao" />
                                            <x-adminlte.form.input.text col="3" label="margem_custo"                  name="bd_margem_custo"                  placeholder="margem_custo" />
                                            <x-adminlte.form.input.text col="2" label="Custo Estoque"                 name="bd_vlr_custo_estoque"             class="text-right" />


                                            <x-adminlte.form.input.text col="3" label="status"                        name="bd_status"                        placeholder="status" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-foto">
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
                                                <input type="file" wire:model.live="foto" class="btn btn-secondary col start">
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
