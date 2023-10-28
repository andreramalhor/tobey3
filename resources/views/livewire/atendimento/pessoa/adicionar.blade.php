@if ($modalType == 'store')
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $pessoaId ? 'Editar pessoa' : 'Criar nova pessoa' }}
                </h5>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_pessoa" data-bs-toggle="tab">Pessoa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_foto" data-bs-toggle="tab">Foto</a></li>
                </ul>
                <x-icon.close />
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="{{ $pessoaId ? 'update' : 'store' }}">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_pessoa">
                            <div class="row">
                                <ul class="todo-list">
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="3" label="Nome" name="nome" placeholder="Nome" />
                                            @error('nome') {{ $message }} @enderror
                                            {{-- <x-adminlte.form.input.text col="2" label="Apelido" name="apelido" placeholder="Apelido" /> --}}
                                            <x-adminlte.form.input.date col="2" label="Data de nascimento" name="dt_nascimento" placeholder="Apelido" />
                                            <x-adminlte.form.input.text col="2" label="E-mail" name="email" placeholder="E-mail" />
                                            <x-adminlte.form.input.text col="2" label="CPF" name="cpf" placeholder="CPF" />
                                            <x-adminlte.form.input.select col="1" label="Sexo" name="sexo" placeholder="sexo" >
                                                <option value="F">F</option>
                                                <option value="M">M</option>
                                            </x-adminlte.form.input.select>
                                            <x-adminlte.form.input.text col="2" label="Instagram" name="instagram" placeholder="instagram" />
                                            <x-adminlte.form.input.text col="12" name="observacao" placeholder="Observação" />
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="1" label="DDD" name="ddd" placeholder="DDD" />
                                            <x-adminlte.form.input.text col="3" label="Telefone" name="telefone" placeholder="9 0000-0000" />
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row">
                                            <x-adminlte.form.input.text col="2" label="CEP" name="cep" placeholder="CEP" />
                                            <x-adminlte.form.input.text col="3" label="Logradouro" name="logradouro" placeholder="Logradouro" />
                                            <x-adminlte.form.input.text col="1" label="Núm."  name="numero" placeholder=""  />
                                            <x-adminlte.form.input.text col="2" label="Bairro" name="bairro" placeholder="Bairro" />
                                            <x-adminlte.form.input.text col="3" label="Cidade" name="cidade" placeholder="Cidade" />
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

                        <div class="tab-pane" id="tab_foto">
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
                                            <input type="file" wire:model.live="foto" class="btn btn-primary col start">
                                            <span class="text-danger">@error('foto') {{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-4">
                        {{ $pessoaId ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
