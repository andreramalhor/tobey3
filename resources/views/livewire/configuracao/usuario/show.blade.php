@if ( $modalType == 'show' )
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
                <div class="modal-body p-2">
                    <ul class="todo-list">
                        <x-adminlte.form.input.text col="12" label="Pessoa" name="id_pessoa" disabled="disabled" />

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
                                <x-acl.funcao destino="checkbox" colunas="2" :pessoa="$usuario->kjahdkwkbewtoip" name="funcoes" label="Funções" />
                            </div>
                        </li>
                        <br>
                    </ul>

                    <button type="submit" class="btn btn-primary mt-4">
                        {{ $usuarioId ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
