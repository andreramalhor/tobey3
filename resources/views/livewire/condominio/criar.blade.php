@if ( $modal_type == 'criar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <form wire:submit.prevent="gravar">
                <div class="modal-header border-bottom-0 py-2 px-0">
                    <ul class="nav nav-tabs w-100">
                        <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Cadastrar novo condomínio</h3>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab_active == 'tab-condominio' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-condominio" wire:click="tabActive('tab-condominio')">Condomínio</a>
                        </li>
                        @if(1==2)
                        <li class="nav-item">
                            <a class="nav-link {{ $tab_active == 'tab-indicadores' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-indicadores" wire:click="tabActive('tab-indicadores')">Indicadores</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ $tab_active == 'tab-foto' ? 'active' : '' }}" data-bs-toggle="pill" href="#tab-foto" wire:click="tabActive('tab-foto')">Foto</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade {{ $tab_active == 'tab-condominio' ? 'show active' : '' }}" id="tab-condominio">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Condomínio</label>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="5" label="Nome" name="nome" placeholder="Nome" />
                                            <x-adminlte.form.input.text col="3" label="CNPJ" name="cnpj" placeholder="CNPJ" />
                                        </div>
                                    </li>
                                    <br>
                                    <label>Contato</label>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="1" label="DDD" name="ddd" placeholder="DDD" />
                                            <x-adminlte.form.input.text col="3" label="Telefone" name="telefone" placeholder="9 0000-0000" />
                                        </div>
                                    </li>
                                    <br>
                                    <label>Endereço</label>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="2" label="CEP" name="cep" placeholder="CEP" />
                                            <x-adminlte.form.input.text col="3" label="Logradouro" name="logradouro" placeholder="Logradouro" />
                                            <x-adminlte.form.input.text col="1" label="Núm."  name="numero" placeholder=""  />
                                            <x-adminlte.form.input.text col="1" label="Complemento"  name="coplemento" placeholder=""  />
                                            <x-adminlte.form.input.text col="2" label="Bairro" name="bairro" placeholder="Bairro" />
                                            <x-adminlte.form.input.text col="2" label="Cidade" name="cidade" placeholder="Cidade" />
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
