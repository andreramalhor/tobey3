@if ( $modalType == 'editar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="atualizar">
                <div class="modal-header border-bottom-0 py-2 px-0">
                    <ul class="nav nav-tabs w-100">
                        <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Editar banco</h3>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#tab-banco">Banco</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-banco">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Dados</label>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="bd_nome">Nome</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_nome') is-invalid @enderror" wire:model="bd_nome" placeholder="Nome">
                                                    @error('bd_nome')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_num_banco">Nº do banco</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_num_banco') is-invalid @enderror" wire:model="bd_num_banco" placeholder="000">
                                                    @error('bd_num_banco')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_num_agencia">Nº da agência</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_num_agencia') is-invalid @enderror" wire:model="bd_num_agencia" placeholder="0000">
                                                    @error('bd_num_agencia')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_num_conta">Nº da conta</label>
                                                    <input type="text" class="form-control form-control-sm @error('bd_num_conta') is-invalid @enderror" wire:model="bd_num_conta" placeholder="00000-0">
                                                    @error('bd_num_conta')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="bd_saldo_inicial">Saldo inicial</label>
                                                    <input type="text" class="form-control form-control-sm text-right @error('bd_saldo_inicial') is-invalid @enderror" wire:model="bd_saldo_inicial" placeholder="0,00">
                                                    @error('bd_saldo_inicial')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
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
                    <button type="submit" class="btn btn-secondary mt-4" style="margin-top: 0px !important;">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
