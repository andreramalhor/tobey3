@if ( $modalType == 'show' )

<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Categoria: {{ $categoriaId ? 'Editar categoria' : 'Criar nova categoria' }}
                </h5>
                <x-icon.close />
            </div>
            <div class="modal-body bg-red">
                <form wire:submit.prevent="{{ $categoriaId ? 'update' : 'store' }}">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" wire:model="nome" class="form-control">
                        <span class="text-danger">@error('nome') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" wire:model="tipo" class="form-control">
                        <span class="text-danger">@error('tipo') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea wire:model="descricao" class="form-control" rows="4"></textarea>
                        <span class="text-danger">@error('descricao') {{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-4">
                        {{ $categoriaId ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                    <button type="button" wire:click="closeModal" class="btn btn-default mt-4">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
