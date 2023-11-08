@if ($modalType == 'show')
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_pessoa">
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="{{ $pessoa->src_foto }}" alt="User profile picture"  data-bs-tooltip="tooltip" data-bs-title="{{ $pessoa->apelido }}">
                                        </div>
                                        <h3 class="profile-username text-center">{{ $pessoa->apelido }}</h3>
                                        <p class="text-muted text-center">{{ $pessoa->nome }}</p>
                                        <hr>
                                        <span class="text-center">
                                            <strong><i class="fas fa-birthday-cake mr-1"></i> Dt Nascimento</strong>
                                            @if(isset($pessoa->dt_nascimento))
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->age }} anos)</font></p>
                                            @else
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> - </font></p>
                                            @endif
                                        </span>
                                        <span class="text-center">
                                            <strong><i class="far fa-id-card mr-1"></i>CPF / CNPJ</strong>
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $pessoa->cpf ?? "-" }}</font></p>
                                        </span>
                                        <span class="text-center">
                                            <strong><i class="far fa-file-alt mr-1"></i> Observação</strong>
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $pessoa->observacao ?? "-" }}</font></p>
                                        </span>
                                        <span class="text-center">
                                            <strong><i class="far fa-file-alt mr-1"></i> Saldo</strong>
                                            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ number_format($pessoa->saldo_conta ?? 0, 2, ',', '.') }}</font></p>
                                        </span>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Sobre</h3>
                                    </div>
                                    <div class="card-body">
                                        <strong><i class="fas fa-phone mr-1"></i> Contatos</strong>
                                        @if($pessoa->telefone)
                                        <p class="text-muted" style="margin-bottom: 2px">
                                            <font size="2">
                                                <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>({{ $pessoa->ddd }}) {{ $pessoa->telefone }}
                                                <a class="float-right btn btn-default btn-xs" href="https://api.whatsapp.com/send?phone=55{{ $pessoa->tellink }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                            </font>
                                        </p>
                                        @else
                                        <p class="text-muted"><font size="2,8">Não há contatos cadastrados.</font></p>
                                        @endif
                                        <hr>
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Localização</strong>
                                        @if($pessoa->endereco)
                                        <p class="text-muted" style="margin-bottom: 2px">
                                            <font size="2">
                                                <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
                                                {{ $pessoa->logradouro }}, {{ $pessoa->numero }} {{ $pessoa->complemento != null ? "(".$pessoa->complemento.")" : "" }} - {{ $pessoa->bairro }} <br>
                                                {{ $pessoa->cidade }} - {{ $pessoa->uf }}
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
                                                @if($pessoa->instagram)
                                                <a class="btn btn-default btn-xs" href="https://www.instagram.com/{{ $pessoa->instagram }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Instagram"><i class="fa-brands fa-instagram"></i></a> {{ $pessoa->instagram }}
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
                                    <div class="card-body p-2">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="sobre">
                                                @include('livewire.atendimento.pessoa.show.01_inc_mostrar_sobre')
                                            </div>
                                            <div class="tab-pane" id="tipo">
                                                @include('livewire.atendimento.pessoa.show.02_inc_mostrar_tipo')
                                            </div>
                                            <div class="tab-pane" id="painel">
                                                {{-- @include('livewire.atendimento.pessoa.show.01_inc_mostrar_painel') --}}
                                            </div>
                                            <div class="tab-pane" id="agendamentos">
                                                {{-- @include('livewire.atendimento.pessoa.show.inc_mostrar_agendamentos') --}}
                                            </div>
                                            <div class="tab-pane" id="financeiro">
                                                {{-- @include('livewire.atendimento.pessoa.show.inc_mostrar_financeiro') --}}
                                            </div>
                                            <div class="tab-pane" id="vendas">
                                                {{-- @include('livewire.atendimento.pessoa.show.inc_mostrar_vendas') --}}
                                            </div>
                                            <div class="tab-pane" id="comissoes_produtos">
                                                {{-- @include('livewire.atendimento.pessoa.show.inc_mostrar_comissoes_p') --}}
                                            </div>
                                            <div class="tab-pane" id="comissoes_servicos">
                                                {{-- @include('livewire.atendimento.pessoa.show.inc_mostrar_comissoes_s') --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
