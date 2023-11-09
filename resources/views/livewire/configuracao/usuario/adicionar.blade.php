@if ( $modalType == 'store' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $usuarioId ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{$usuarioId ? 'Editar usuario' : 'Adicionar usuário' }}
                    </h5>
                    <x-icon.close />
                </div>
                <div class="modal-body p-2" style="max-height: 70vh; overflow-y: auto;">
                    <ul class="todo-list">
                        <x-atendimento.pessoa.Pessoasdiffrelation-select col="12" relacionamento="eoprtjweornweuq" name="id_pessoa" selecionado="{{ $id_pessoa ?? null }}" label="Pessoa"  wire:change="preencher_email" />

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" wire:model="email" wire:tap="preencher_email">
                                @error('email') <div class="invalid-feedback"> {{ $message ?? 'teste de mensagem de erro'}} </div> @enderror
                            </div>
                        </div>

                        <x-adminlte.form.input.text col="12" label="Senha" name="password" disabled="disabled" />

                        <li>
                            <div class="row">
                                <label>Funções</label>
                                <x-acl.funcao destino="checkbox" colunas="2" name="funcoes" label="Funções" />
                            </div>
                        </li>
                        <br>
                    </ul>
                </div>

                <div class="modal-footer p-0">
                    <button type="submit" class="btn btn-primary mt-4">
                        {{ $usuarioId ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
