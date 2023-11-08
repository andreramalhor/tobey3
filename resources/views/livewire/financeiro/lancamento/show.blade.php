@if ($modalType == 'show')
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_lancamento">
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="{{ $lancamento->src_foto }}" alt="User profile picture"  data-bs-tooltip="tooltip" data-bs-title="{{ $lancamento->apelido }}">
                                        </div>
                                        <h3 class="profile-username text-center">{{ $lancamento->apelido }}</h3>
                                        <p class="text-muted text-center">{{ $lancamento->nome }}</p>
                                        <hr>
                                        <span class="text-center">
                                            <strong><i class="fas fa-birthday-cake mr-1"></i> Dt Nascimento</strong>
                                            @if(isset($lancamento->dt_nascimento))
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ \Carbon\Carbon::parse($lancamento->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($lancamento->dt_nascimento)->age }} anos)</font></p>
                                            @else
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> - </font></p>
                                            @endif
                                        </span>
                                        <span class="text-center">
                                            <strong><i class="far fa-id-card mr-1"></i>CPF / CNPJ</strong>
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $lancamento->cpf ?? "-" }}</font></p>
                                        </span>
                                        <span class="text-center">
                                            <strong><i class="far fa-file-alt mr-1"></i> Observação</strong>
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $lancamento->observacao ?? "-" }}</font></p>
                                        </span>
                                        <span class="text-center">
                                            <strong><i class="far fa-file-alt mr-1"></i> Saldo</strong>
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ number_format($lancamento->saldo_conta ?? 0, 2, ',', '.') }}</font></p>
                                        </span>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Sobre</h3>
                                    </div>
                                    <div class="card-body">
                                        <strong><i class="fas fa-phone mr-1"></i> Contatos</strong>
                                        @if($lancamento->telefone)
                                        <p class="text-muted" style="margin-bottom: 2px">
                                            <font size="2">
                                                <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>({{ $lancamento->ddd }}) {{ $lancamento->telefone }}
                                                <a class="float-right btn btn-default btn-xs" href="https://api.whatsapp.com/send?phone=55{{ $lancamento->tellink }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                            </font>
                                        </p>
                                        @else
                                        <p class="text-muted"><font size="2,8">Não há contatos cadastrados.</font></p>
                                        @endif
                                        <hr>
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Localização</strong>
                                        @if($lancamento->endereco)
                                        <p class="text-muted" style="margin-bottom: 2px">
                                            <font size="2">
                                                <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
                                                {{ $lancamento->logradouro }}, {{ $lancamento->numero }} {{ $lancamento->complemento != null ? "(".$lancamento->complemento.")" : "" }} - {{ $lancamento->bairro }} <br>
                                                {{ $lancamento->cidade }} - {{ $lancamento->uf }}
                                            </font>
                                        </p>
                                        @else
                                        <p class="text-muted"><font size="2,8">Não há endereços cadastrados.</font></p>
                                        @endif
                                        <hr>
                                        <strong><i class="fas fa-vector-square mr-1"></i> Midias Sociais</strong>
                                        <p class="text-muted" style="margin-bottom: 2px">
                                            <font size="2">
                                                <span style="font-size: 7px;"></span>
                                                @if($lancamento->instagram)
                                                <a class="btn btn-default btn-xs" href="https://www.instagram.com/{{ $lancamento->instagram }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Instagram"><i class="fa-brands fa-instagram"></i></a> {{ $lancamento->instagram }}
                                                <br>
                                                @else
                                                <p class="text-muted"><font size="2,8">Não há mídias sociais cadastrados.</font></p>
                                                @endif
                                            </font>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#sobre" data-bs-toggle="tab">Sobre</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#tipo" data-bs-toggle="tab">Tipo</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#painel" data-bs-toggle="tab">Painel</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#agendamentos" data-bs-toggle="tab">Agendamentos</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#vendas" data-bs-toggle="tab">Comandas</a></li>
                                            @can('Funções.Visualizar')
                                            <li class="nav-item"><a class="nav-link" href="#financeiro" data-bs-toggle="tab">Financeiro</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#comissoes_produtos" data-bs-toggle="tab">Comissões Produtos</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#comissoes_servicos" data-bs-toggle="tab">Comissões Serviços</a></li>
                                            @endcan
                                        </ul>
                                        <x-icon.close />
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="sobre">
                                                @include('livewire.atendimento.lancamento.show.02_inc_mostrar_sobre')
                                            </div>
                                            <div class="tab-pane" id="tipo">
                                                @include('livewire.atendimento.lancamento.show.inc_mostrar_tipo')
                                            </div>
                                            <div class="tab-pane" id="painel">
                                                {{-- @include('livewire.atendimento.lancamento.show.01_inc_mostrar_painel') --}}
                                            </div>
                                            <div class="tab-pane" id="agendamentos">
                                                {{-- @include('livewire.atendimento.lancamento.show.inc_mostrar_agendamentos') --}}
                                            </div>
                                            <div class="tab-pane" id="financeiro">
                                                {{-- @include('livewire.atendimento.lancamento.show.inc_mostrar_financeiro') --}}
                                            </div>
                                            <div class="tab-pane" id="vendas">
                                                {{-- @include('livewire.atendimento.lancamento.show.inc_mostrar_vendas') --}}
                                            </div>
                                            <div class="tab-pane" id="comissoes_produtos">
                                                {{-- @include('livewire.atendimento.lancamento.show.inc_mostrar_comissoes_p') --}}
                                            </div>
                                            <div class="tab-pane" id="comissoes_servicos">
                                                {{-- @include('livewire.atendimento.lancamento.show.inc_mostrar_comissoes_s') --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>








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
                    {{ $lancamentoId ? 'Atualizar' : 'Cadastrar' }}
                </button>
                <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
