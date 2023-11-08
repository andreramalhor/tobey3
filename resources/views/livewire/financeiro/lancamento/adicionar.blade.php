@if ($modalType == 'store')
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $lancamentoId ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $lancamentoId ? 'Editar lancamento' : 'Criar nova lancamento' }}
                    </h5>
                    <x-icon.close />
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control form-control-sm @error('tipo') is-invalid @enderror" wire:model="tipo">
                                    <option value="R">Receita</option>
                                    <option value="D">Despesa</option>
                                    <option value="T" disabled>Transferência</option>
                                </select>
                                @error("tipo")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dt_competencia">Data de competência</label>
                                <input type="date" class="form-control form-control-sm @error('dt_competencia') is-invalid @enderror" wire:model="dt_competencia">
                                @error("dt_competencia")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dt_vencimento">Data de vencimento</label>
                                <input type="date" class="form-control form-control-sm @error('dt_vencimento') is-invalid @enderror" wire:model="dt_vencimento">
                                @error("dt_vencimento")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dt_recebimento">Data de recebimento</label>
                                <input type="date" class="form-control form-control-sm @error('dt_recebimento') is-invalid @enderror" wire:model="dt_recebimento">
                                @error("dt_recebimento")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dt_confirmacao">Data de confirmação</label>
                                <input type="date" class="form-control form-control-sm @error('dt_confirmacao') is-invalid @enderror" wire:model="dt_confirmacao">
                                @error("dt_confirmacao")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dt_pagamento">Data de pagamento</label>
                                <input type="date" class="form-control form-control-sm @error('dt_pagamento') is-invalid @enderror" wire:model="dt_pagamento">
                                @error("dt_pagamento")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <x-atendimento.pessoa.pessoas-select col="3" name="id_pessoa" selecionado="" label="Pessoa" />

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="informacao">Descrição</label>
                                <input type="text" class="form-control form-control-sm @error('informacao') is-invalid @enderror" wire:model.live="informacao" placeholder="Descrição">
                                @error("informacao")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="num_documento">Núm. Doc.</label>
                                <input type="text" class="form-control form-control-sm text-right @error('num_documento') is-invalid @enderror" wire:model="num_documento" placeholder="Núm. Documento">
                                @error("num_documento")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="vlr_bruto">Valor Bruto</label>
                                <input type="text" class="form-control form-control-sm text-right @error('vlr_bruto') is-invalid @enderror" wire:model="vlr_bruto" placeholder="0,00">
                                @error("vlr_bruto")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="vlr_dsc_acr">Desc./Acrésc.</label>
                                <input type="text" class="form-control form-control-sm text-right @error('vlr_dsc_acr') is-invalid @enderror" wire:model="vlr_dsc_acr" placeholder="0,00">
                                @error("vlr_dsc_acr")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="vlr_final">Valor Pago</label>
                                <input type="text" class="form-control form-control-sm text-right @error('vlr_final') is-invalid @enderror" wire:model="vlr_final" placeholder="0,00">
                                @error("vlr_final")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <x-financeiro.banco.bancos-select col="3" name="id_banco" selecionado="" label="Banco/Local" />

                        <x-contabilidade.planoconta.planocontas-select col="3" name="id_conta" selecionado="" label="Conta Contábil" />

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="centro_custo">Centro de custo</label>
                                <select class="form-control form-control-sm @error('centro_custo') is-invalid @enderror" wire:model="centro_custo">
                                    <option>Converta Soluções</option>
                                    <option>Marketing</option>
                                    <option>Call Center</option>
                                    <option>Investimento André</option>
                                </select>
                                @error("centro_custo")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        {{-- <x-gerenciamento.formapagamento.formas-select col="3" name="id_forma_pagamento" selecionado="" label="Forma de pagamento" /> --}}
                        <x-financeiro.banco.formas-select col="3" name="id_forma_pagamento" selecionado="" label="Forma de pagamento" />

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="parcela">Parcela</label>
                                <input type="text" class="form-control form-control-sm text-right @error('parcela') is-invalid @enderror" wire:model="parcela">
                                @error("parcela")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control form-control-sm text-right @error('status') is-invalid @enderror" wire:model="status" placeholder="status">
                                @error("status")<span class="text-danger">{{ $message }}</spam>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-4">
                        {{ $lancamentoId ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
